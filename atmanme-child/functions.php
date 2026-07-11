<?php
/**
 * AtmanMe Child Theme Functions
 */

// Enqueue parent theme styles
add_action( 'wp_enqueue_scripts', 'atmanme_child_enqueue_styles' );
function atmanme_child_enqueue_styles() {
    wp_enqueue_style( 'inspiro-parent-style', get_template_directory_uri() . '/style.css' );
}

/**
 * Conditionally block Google Site Kit AdSense ads
 *
 * This will block the rendering of AdSense ads on any page that is NOT
 * a single blog post. The verification tags for Site Kit will remain.
 */
add_filter( 'googlesitekit_adsense_tag_blocked', 'atmanme_block_adsense_non_posts' );
function atmanme_block_adsense_non_posts( $blocked ) {
    // If not a single post of post type 'post', block ads
    if ( ! is_singular( 'post' ) ) {
        return true;
    }

    return $blocked;
}

/**
 * Force English locale on frontend for UI texts
 */
add_filter( 'locale', 'atmanme_force_english_locale' );
function atmanme_force_english_locale( $locale ) {
    if ( ! is_admin() ) {
        return 'en_US';
    }
    return $locale;
}

/**
 * Update navigation menu labels and URLs to English
 */
add_filter( 'wp_nav_menu_objects', 'atmanme_update_nav_menu', 10, 2 );
function atmanme_update_nav_menu( $items, $args ) {
    $slug_mapping = array(
        '/inicio/' => '/home/',
        '/audioterapia/' => '/audio-therapy/',
        '/informes/' => '/reports/',
        '/crecimiento/' => '/growth/'
    );

    $title_mapping = array(
        'Inicio' => 'Home',
        'Audioterapia' => 'Audio Therapy',
        'Informes' => 'Reports',
        'Crecimiento' => 'Growth',
    );

    foreach ( $items as $item ) {
        // Replace URLs
        foreach ( $slug_mapping as $old_slug => $new_slug ) {
            if ( strpos( $item->url, $old_slug ) !== false ) {
                $item->url = str_replace( $old_slug, $new_slug, $item->url );
            }
        }

        // Replace titles if they are in Spanish
        if ( isset( $title_mapping[ $item->title ] ) ) {
            $item->title = $title_mapping[ $item->title ];
        }
    }

    return $items;
}

/**
 * Redirect Spanish slugs to English slugs with 301 Permanent Redirect
 */
add_action( 'template_redirect', 'atmanme_redirect_spanish_slugs' );
function atmanme_redirect_spanish_slugs() {
    global $wp;

    $slug_mapping = array(
        'inicio' => 'home',
        'audioterapia' => 'audio-therapy',
        'informes' => 'reports',
        'crecimiento' => 'growth'
    );

    $requested_path = empty( $wp->request ) ? '' : trim( $wp->request, '/' );

    if ( array_key_exists( $requested_path, $slug_mapping ) ) {
        $new_url = home_url( '/' . $slug_mapping[ $requested_path ] . '/' );
        wp_redirect( $new_url, 301 );
        die();
    }
}

/**
 * One-off script to update Spanish page slugs to English
 */
add_action( 'init', 'atmanme_update_page_slugs' );
function atmanme_update_page_slugs() {
    if ( get_option( 'atmanme_slugs_updated_to_english' ) ) {
        return;
    }

    $slug_mapping = array(
        'inicio' => 'home',
        'audioterapia' => 'audio-therapy',
        'informes' => 'reports',
        'crecimiento' => 'growth'
    );

    foreach ( $slug_mapping as $old_slug => $new_slug ) {
        $page = get_page_by_path( $old_slug );
        if ( $page ) {
            wp_update_post( array(
                'ID' => $page->ID,
                'post_name' => $new_slug
            ) );
        }
    }

    update_option( 'atmanme_slugs_updated_to_english', 1 );
}
