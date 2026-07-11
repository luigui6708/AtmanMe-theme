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
 * Add loading="lazy" to Spotify iframes
 * Intercepts HTML output to inject the loading attribute.
 */
add_action( 'template_redirect', 'atmanme_start_output_buffering' );
function atmanme_start_output_buffering() {
    // We only buffer output on front-end requests, not admin or feeds
    if ( ! is_admin() && ! is_feed() ) {
        ob_start( 'atmanme_lazy_load_spotify_iframes' );
    }
}

function atmanme_lazy_load_spotify_iframes( $buffer ) {
    // Find all iframes that contain spotify.com in their src
    $pattern = '/<iframe([^>]+src=["\'][^"\']*spotify\.com[^"\']*["\'][^>]*)>/is';

    return preg_replace_callback( $pattern, function( $matches ) {
        $attributes = $matches[1];

        // If loading="lazy" is not already present, append it
        if ( stripos( $attributes, 'loading="lazy"' ) === false ) {
            return '<iframe' . rtrim( $attributes ) . ' loading="lazy">';
        }

        return $matches[0]; // Return unmodified if already lazy loaded
    }, $buffer );
}
