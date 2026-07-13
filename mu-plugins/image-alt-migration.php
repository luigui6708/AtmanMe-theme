<?php
/**
 * Plugin Name: Image Alt Migration CLI Command
 * Description: WP-CLI command to migrate missing or non-descriptive image alt texts.
 * Version: 1.0.0
 * Author: AtmanMe
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    class AtmanMe_Image_Alt_Migration_Command {

        /**
         * Migrates missing or non-descriptive image alt texts by using the parent post's title.
         *
         * ## EXAMPLES
         *
         *     wp atmanme migrate-image-alts
         *
         * @when after_wp_load
         */
        public function __invoke( $args, $assoc_args ) {
            WP_CLI::line( "Starting image alt text migration..." );

            $paged = 1;
            $updated = 0;
            $pending = 0;
            $skipped = 0;

            // Create CSV report file
            $upload_dir = wp_upload_dir();
            $report_file = $upload_dir['basedir'] . '/image-alt-migration-report.csv';

            $csv_handle = fopen( $report_file, 'w' );
            if ( $csv_handle ) {
                fputcsv( $csv_handle, array( 'Attachment ID', 'Original Filename', 'Old Alt', 'New Alt', 'Status', 'Reason' ) );
            } else {
                WP_CLI::error( "Could not create report file at: $report_file" );
            }

            while ( true ) {
                $attachments = get_posts( array(
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => 100,
                    'paged'          => $paged,
                    'post_status'    => 'inherit',
                ) );

                if ( empty( $attachments ) ) {
                    break;
                }

                foreach ( $attachments as $attachment ) {
                    $attachment_id = $attachment->ID;
                    $alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
                    $file_path = get_attached_file( $attachment_id );
                    $filename = $file_path ? basename( $file_path ) : '';

                    $is_non_descriptive = false;

                    // Check if alt text is non-descriptive
                    if ( trim( (string) $alt_text ) === '' ) {
                        $is_non_descriptive = true;
                    } elseif ( stripos( $alt_text, 'featured-image' ) !== false || stripos( $alt_text, 'featured image' ) !== false ) {
                        $is_non_descriptive = true;
                    } elseif ( preg_match( '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i', $alt_text ) ) {
                        $is_non_descriptive = true;
                    } elseif ( $filename && strpos( $filename, trim( $alt_text ) ) !== false && strlen( trim( $alt_text ) ) > 0 ) {
                        $is_non_descriptive = true;
                    } elseif ( preg_match( '/[_\-0-9a-zA-Z]+\.(jpg|jpeg|png|gif|webp|svg)/i', $alt_text ) ) {
                        // Sometimes the alt text is literally just the filename with extension
                        $is_non_descriptive = true;
                    }

                    if ( $is_non_descriptive ) {
                        $new_alt = '';

                        // 1. Try to get title from parent post
                        $parent_id = $attachment->post_parent;
                        if ( $parent_id ) {
                            $parent_post = get_post( $parent_id );
                            if ( $parent_post && trim( $parent_post->post_title ) !== '' ) {
                                $new_alt = trim( $parent_post->post_title );
                            }
                        }

                        // 2. Fallback: check if it's used as a featured image somewhere
                        if ( empty( $new_alt ) ) {
                            global $wpdb;
                            $post_with_thumb = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND meta_value = %d LIMIT 1", $attachment_id ) );
                            if ( $post_with_thumb ) {
                                $parent_post = get_post( $post_with_thumb );
                                if ( $parent_post && trim( $parent_post->post_title ) !== '' ) {
                                    $new_alt = trim( $parent_post->post_title );
                                }
                            }
                        }

                        if ( $new_alt !== '' ) {
                            // Update the alt text
                            update_post_meta( $attachment_id, '_wp_attachment_image_alt', $new_alt );
                            $updated++;
                            if ( $csv_handle ) {
                                fputcsv( $csv_handle, array( $attachment_id, $filename, $alt_text, $new_alt, 'Updated', 'Used associated post title' ) );
                            }
                            WP_CLI::log( "Updated ID $attachment_id: '$alt_text' -> '$new_alt'" );
                        } else {
                            $pending++;
                            if ( $csv_handle ) {
                                fputcsv( $csv_handle, array( $attachment_id, $filename, $alt_text, '', 'Pending', 'No related post title found for fallback' ) );
                            }
                            // We don't log a warning for every pending to avoid cluttering output too much, just a log.
                            WP_CLI::log( "Pending ID $attachment_id: Could not determine new alt text." );
                        }
                    } else {
                        $skipped++;
                        // Already has a descriptive alt text
                        if ( $csv_handle ) {
                            fputcsv( $csv_handle, array( $attachment_id, $filename, $alt_text, $alt_text, 'Skipped', 'Already descriptive' ) );
                        }
                    }
                }
                $paged++;
            }

            if ( $csv_handle ) {
                fclose( $csv_handle );
            }

            WP_CLI::success( "Migration completed." );
            WP_CLI::line( "Updated: $updated" );
            WP_CLI::line( "Pending review: $pending" );
            WP_CLI::line( "Skipped (already descriptive): $skipped" );
            WP_CLI::line( "Report saved to: $report_file" );
        }
    }

    WP_CLI::add_command( 'atmanme migrate-image-alts', 'AtmanMe_Image_Alt_Migration_Command' );
}
