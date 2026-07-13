<?php

// Enqueue parent theme styles
add_action( 'wp_enqueue_scripts', 'atmanme_child_enqueue_styles' );
function atmanme_child_enqueue_styles() {
    wp_enqueue_style( 'inspiro-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'atmanme-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'inspiro-parent-style' ), wp_get_theme()->get('Version') );
}

// Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'atmanme_enqueue_fonts' );
function atmanme_enqueue_fonts() {
    wp_enqueue_style( 'atmanme-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap', array(), null );
}

add_filter( 'googlesitekit_adsense_tag_blocked', 'atmanme_block_adsense_non_posts' );
function atmanme_block_adsense_non_posts( $blocked ) {
    if ( ! is_singular( 'post' ) ) {
        return true;
    }
    return $blocked;
}

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

// or by modifying the homepage template part. Since the user said the content might be in a template-part,
// we should override the template part if it exists, or append a script to find and inject safely.
// Since parsing HTML block content with regex is unsafe, we use JS injected via wp_footer,
// but this time targeting the element correctly.
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
// Intercepts HTML output to inject the loading attribute.
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
add_filter( 'locale', 'atmanme_force_english_locale' );
function atmanme_force_english_locale( $locale ) {
    if ( ! is_admin() ) {
        return 'en_US';
    }
    return $locale;
}

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


// Overrides Yoast SEO inconsistent values on all pages by extracting og:title and og:description
add_action('template_redirect', 'atmanme_start_seo_sync_buffering');
function atmanme_start_seo_sync_buffering() {
    if (!is_admin() && !is_feed()) {
        ob_start('atmanme_sync_seo_tags_from_og');
    }
}

function atmanme_sync_seo_tags_from_og($buffer) {
    // Extract og:title using backreferences for quotes
    if (preg_match('/<meta[^>]*?property=[\'"]og:title[\'"][^>]*?content=([\'"])(.*?)\1[^>]*>/is', $buffer, $title_matches) ||
        preg_match('/<meta[^>]*?content=([\'"])(.*?)\1[^>]*?property=[\'"]og:title[\'"][^>]*>/is', $buffer, $title_matches)) {

        $og_title = $title_matches[2];

        // Ensure it is not empty
        if (!empty(trim($og_title))) {
            $escaped_title = addcslashes($og_title, '\\$');
            $buffer = preg_replace('/<title>.*?<\/title>/is', '<title>' . $escaped_title . '</title>', $buffer);
        }
    }

    // Extract og:description using backreferences for quotes
    if (preg_match('/<meta[^>]*?property=[\'"]og:description[\'"][^>]*?content=([\'"])(.*?)\1[^>]*>/is', $buffer, $desc_matches) ||
        preg_match('/<meta[^>]*?content=([\'"])(.*?)\1[^>]*?property=[\'"]og:description[\'"][^>]*>/is', $buffer, $desc_matches)) {

        $og_desc = $desc_matches[2];

        // Ensure it is not empty
        if (!empty(trim($og_desc))) {
            $buffer = preg_replace_callback('/<meta[^>]+>/is', function($matches) use ($og_desc) {
                $meta = $matches[0];
                if (preg_match('/name=[\'"]description[\'"]/is', $meta)) {
                    $meta = preg_replace_callback('/(content=([\'"]))(.*?)\2/is', function($m) use ($og_desc) {
                        $quote = $m[2];
                        $escaped = $og_desc;
                        if ($quote === '"') {
                            $escaped = str_replace('"', '&quot;', $og_desc);
                        } else {
                            $escaped = str_replace("'", '&#039;', $og_desc);
                        }
                        return $m[1] . $escaped . $quote;
                    }, $meta);
                }
                return $meta;
            }, $buffer);
        }
    }

    return $buffer;
}

/**
 * Update author user_nicename to 'atman' to avoid exposing email.
 */
add_action( 'init', 'atmanme_update_author_nicename' );
function atmanme_update_author_nicename() {
    if ( get_option( 'atmanme_author_nicename_updated' ) === 'yes' ) {
        return;
    }

    $user = get_user_by( 'slug', 'luis-aguirre-reynagmail-com' );
    if ( $user ) {
        wp_update_user( array(
            'ID'            => $user->ID,
            'user_nicename' => 'atman'
        ) );
        update_option( 'atmanme_author_nicename_updated', 'yes' );
    } else {
        // Fallback, if slug was different but email is known
        $user_by_email = get_user_by( 'email', 'luis.aguirre.reyna@gmail.com' );
        if ( $user_by_email ) {
            wp_update_user( array(
                'ID'            => $user_by_email->ID,
                'user_nicename' => 'atman'
            ) );
            update_option( 'atmanme_author_nicename_updated', 'yes' );
        } else {
            // Might have already changed, set option anyway to avoid running on every init
            update_option( 'atmanme_author_nicename_updated', 'yes' );
        }
    }
}

/**
 * Redirect old author URL to new author URL.
 */
add_action( 'template_redirect', 'atmanme_redirect_old_author_url' );
function atmanme_redirect_old_author_url() {
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    if ( strpos( $request_uri, '/author/luis-aguirre-reynagmail-com' ) !== false ) {
        wp_redirect( home_url( '/author/atman/' ), 301 );
        die();
    }
}
//
// Require JSON-LD Schema file
require_once get_stylesheet_directory() . '/inc/schema.php';

/**
 * Archetype Quiz - Register Custom Post Type for Leads
 */
function atmanme_register_quiz_lead_cpt() {
    $args = array(
        'label'               => 'Quiz Leads',
        'description'         => 'Leads captured from the Archetype Quiz',
        'public'              => false, // Keep it private
        'show_ui'             => true,
        'show_in_menu'        => true,
        'capability_type'     => 'post',
        'supports'            => array('title'), // Title will be the email
        'hierarchical'        => false,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-email-alt',
        'show_in_rest'        => false,
    );
    register_post_type('quiz_lead', $args);
}
add_action('init', 'atmanme_register_quiz_lead_cpt');

/**
 * Archetype Quiz - Handle AJAX form submission
 */
function atmanme_handle_quiz_lead_submission() {
    // Check nonce
    if ( ! isset( $_POST['quiz_nonce'] ) || ! wp_verify_nonce( $_POST['quiz_nonce'], 'submit_quiz_lead' ) ) {
        wp_send_json_error( array( 'message' => 'Invalid nonce.' ) );
    }

    $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $archetype = isset( $_POST['archetype'] ) ? sanitize_text_field( $_POST['archetype'] ) : '';

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid email address.' ) );
    }

    // TODO: Connect real email provider (Mailchimp/Klaviyo) here in the future
    // Example: send_to_mailchimp($email, $archetype);

    // Save as Custom Post Type
    $post_data = array(
        'post_title'    => $email,
        'post_type'     => 'quiz_lead',
        'post_status'   => 'publish',
        'meta_input'    => array(
            'archetype' => $archetype,
        ),
    );

    $post_id = wp_insert_post( $post_data );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Failed to save lead.' ) );
    }

    wp_send_json_success( array( 'message' => 'Lead saved successfully.' ) );
}
add_action('wp_ajax_atmanme_save_quiz_lead', 'atmanme_handle_quiz_lead_submission');
add_action('wp_ajax_nopriv_atmanme_save_quiz_lead', 'atmanme_handle_quiz_lead_submission');
