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
