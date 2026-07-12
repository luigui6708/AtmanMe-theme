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
 */
add_filter( 'googlesitekit_adsense_tag_blocked', 'atmanme_block_adsense_non_posts' );
function atmanme_block_adsense_non_posts( $blocked ) {
    if ( ! is_singular( 'post' ) ) {
        return true;
    }
    return $blocked;
}

/**
 * Handle custom URL for All Reports page without needing database entry
 */
add_action('init', 'atmanme_all_reports_rewrite_rule');
function atmanme_all_reports_rewrite_rule() {
    add_rewrite_rule('^all-reports/?$', 'index.php?all_reports_page=1', 'top');

    // Flush rules if not already set
    if (get_option('atmanme_all_reports_flushed') !== 'yes') {
        flush_rewrite_rules();
        update_option('atmanme_all_reports_flushed', 'yes');
    }
}

add_filter('query_vars', 'atmanme_all_reports_query_vars');
function atmanme_all_reports_query_vars($vars) {
    $vars[] = 'all_reports_page';
    return $vars;
}

add_action('pre_get_posts', 'atmanme_all_reports_pre_get_posts');
function atmanme_all_reports_pre_get_posts($query) {
    if (!is_admin() && $query->is_main_query() && get_query_var('all_reports_page')) {
        // Prevent 404 header by faking a successful query
        $query->is_page = true;
        $query->is_home = false;
        $query->is_404 = false;
        $query->set('post_type', 'page');
        // Setting a dummy post avoids 404 logic downstream
    }
}

add_action('template_include', 'atmanme_all_reports_template_include');
function atmanme_all_reports_template_include($template) {
    if (get_query_var('all_reports_page')) {
        // Force 200 OK status code instead of 404
        status_header(200);
        $custom_template = locate_template('page-templates/all-reports.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    return $template;
}

/**
 * Inject CTA button below Astrology reports on front page via custom shortcode
 * or by modifying the homepage template part. Since the user said the content might be in a template-part,
 * we should override the template part if it exists, or append a script to find and inject safely.
 * Since parsing HTML block content with regex is unsafe, we use JS injected via wp_footer,
 * but this time targeting the element correctly.
 */
add_action('wp_head', 'atmanme_cta_css');
function atmanme_cta_css() {
    if (is_front_page()) {
        echo '<style>
        .atmanme-reports-cta {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 60px;
            clear: both;
            display: block;
            width: 100%;
        }
        .atmanme-reports-cta .wp-block-button__link {
            display: inline-block;
            padding: 12px 30px;
            border: 2px solid var(--wp--preset--color--primary, #333);
            color: var(--wp--preset--color--primary, #333);
            background: transparent;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 0px;
            transition: all 0.3s ease;
        }
        .atmanme-reports-cta .wp-block-button__link:hover {
            background: var(--wp--preset--color--primary, #333) !important;
            color: #fff !important;
        }
        </style>';
    }
}

/**
 * JS Injection for Front Page Reports CTA
 */
add_action('wp_footer', 'atmanme_inject_reports_cta_js');
function atmanme_inject_reports_cta_js() {
    if (!is_front_page()) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Iterate all text nodes to find "Free reports (There are more than 10)"
        var treeWalker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
        var matchNode = null;
        while (treeWalker.nextNode()) {
            if (treeWalker.currentNode.nodeValue.includes('Free reports') || treeWalker.currentNode.nodeValue.includes('There are more than 10')) {
                matchNode = treeWalker.currentNode;
                break;
            }
        }

        if (matchNode) {
            // Found the text. Now find the closest section or block group containing it and the 3 cards.
            // Usually, this is a top-level block like .wp-block-group or section.
            var parent = matchNode.parentElement;
            var container = parent.closest('.wp-block-group, section, .elementor-section');
            if (!container) {
                container = parent.parentElement;
            }

            // Create the CTA element
            var ctaContainer = document.createElement('div');
            ctaContainer.className = 'atmanme-reports-cta';

            var ctaButton = document.createElement('a');
            ctaButton.href = '/all-reports/';
            ctaButton.className = 'wp-block-button__link wp-element-button has-background';
            ctaButton.innerText = 'View all reports';

            ctaContainer.appendChild(ctaButton);

            // Append it to the end of the identified section container
            if (container) {
                container.appendChild(ctaContainer);
            }
        }
    });
    </script>
    <?php
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

/**
 * Custom Yoast SEO Title & Meta Description Translations
 */
add_filter('wpseo_title', 'atmanme_custom_yoast_title', 10, 1);
function atmanme_custom_yoast_title($title) {
    if (is_page('astrology-reports') || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/astrology-reports/') !== false)) {
        return 'Free Astrology Reports, Natal Chart, Horoscope';
    }

    if (is_home() || is_page('blog') || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/blog/') !== false)) {
        return 'AtmanMe Blog - Wellness, Astrology & Personal Growth';
    }

    return $title;
}

add_filter('wpseo_metadesc', 'atmanme_custom_yoast_metadesc', 10, 1);
function atmanme_custom_yoast_metadesc($desc) {
    if (is_home() || is_page('blog') || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/blog/') !== false)) {
        return 'Explore the AtmanMe blog for insightful articles on wellness, astrology, personal growth, and self-discovery. Discover our guides for a balanced life.';
    }
    return $desc;
}

/**
 * JS Injection for /astrology-reports/ H1 Translation
 */
add_action('wp_footer', 'atmanme_inject_astrology_reports_h1_js');
function atmanme_inject_astrology_reports_h1_js() {
    if (is_page('astrology-reports') || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/astrology-reports/') !== false)) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var h1s = document.getElementsByTagName('h1');
            for (var i = 0; i < h1s.length; i++) {
                if (h1s[i].innerText.includes('Informes') || h1s[i].innerText.includes('Astrologicos') || h1s[i].innerText.includes('Astrológicos')) {
                    h1s[i].innerText = 'Free Astrology Reports - Natal Chart and Custom Horoscope';
                }
            }
        });
        </script>
        <?php
    }
}
