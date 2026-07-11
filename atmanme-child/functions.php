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
