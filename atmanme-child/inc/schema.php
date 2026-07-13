<?php
/**
 * Schema JSON-LD Injection
 * Injects structured data for Article, Paywall, FAQ, Organization, and Person.
 */

// Disable Yoast's default schema to prevent duplication, since we are handling it comprehensively here.
// The user noted there are no visible structured data besides Site Kit, but we add this to be safe.
add_filter( 'wpseo_json_ld_output', '__return_false' );

add_action( 'wp_head', 'atmanme_inject_schema_json_ld', 99 );
function atmanme_inject_schema_json_ld() {
    $schemas = [];

    // 4. Organization + Person sitewide (Footer/Header)
    // Sitewide schema
    $organization_schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        '@id'      => home_url( '/#organization' ),
        'name'     => get_bloginfo( 'name' ),
        'url'      => home_url( '/' ),
        'logo'     => [
            '@type' => 'ImageObject',
            'url'   => get_site_icon_url() ?: get_stylesheet_directory_uri() . '/images/logo.png'
        ]
    ];
    $schemas[] = $organization_schema;

    $person_schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Person',
        '@id'      => home_url( '/#person' ),
        'name'     => 'AtmanMe',
        'url'      => home_url( '/' )
    ];
    $schemas[] = $person_schema;

    // 1 & 2. Article Schema & Paywall (isAccessibleForFree)
    if ( is_single() ) {
        global $post;
        $author_id   = $post->post_author;
        $author_name = get_the_author_meta( 'display_name', $author_id );

        $article_schema = [
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            '@id'           => get_permalink() . '#article',
            'headline'      => get_the_title(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author'        => [
                '@type' => 'Person',
                'name'  => $author_name
            ],
            'publisher'     => [
                '@id' => home_url( '/#organization' )
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id'   => get_permalink()
            ]
        ];

        if ( has_post_thumbnail( $post->ID ) ) {
            $article_schema['image'] = [ get_the_post_thumbnail_url( $post->ID, 'full' ) ];
        }

        // Determine if content is paywalled
        // Checking for common membership signs or fallback to content check
        $is_gated = false;

        // Common membership shortcodes or strings indicating premium content
        $content = $post->post_content;
        if ( has_category( 'premium' ) || has_tag( 'premium' ) ||
             strpos( $content, '[restrict' ) !== false ||
             strpos( $content, 'mepr-active' ) !== false ||
             strpos( $content, 'contentInfo' ) !== false ||
             strpos( $content, 'wp-block-membership' ) !== false ) {
            $is_gated = true;
        }

        // If the user specified that posts have a membership wall, and we detect it:
        // We inject the paywall schema. If no specific detection matches but all posts are gated,
        // we can fallback to true if required, but it's safer to rely on the indicators above.
        // Given "Los posts del blog estan parcialmente bloqueados", we will assume if it's a post, we check for gating.
        // Let's add a filter in case they want to force it.
        $is_gated = apply_filters( 'atmanme_is_post_paywalled', $is_gated, $post );

        if ( $is_gated ) {
            $article_schema['isAccessibleForFree'] = false;
            $article_schema['hasPart'] = [
                [
                    '@type' => 'WebPageElement',
                    'isAccessibleForFree' => false,
                    'cssSelector' => '.contentInfo'
                ]
            ];
        } else {
            $article_schema['isAccessibleForFree'] = true;
        }

        $schemas[] = $article_schema;
    }

    // 3. FAQPage Schema
    // Extract FAQs from content if any
    if ( is_singular() ) {
        global $post;
        $content = $post->post_content;
        $faqs = [];

        // Parse standard summary/details blocks (like Kadence or Gutenberg generic)
        if ( preg_match_all( '/<details[^>]*>(.*?)<\/details>/is', $content, $details_matches ) ) {
            foreach ( $details_matches[1] as $detail ) {
                if ( preg_match( '/<summary[^>]*>(.*?)<\/summary>(.*?)$/is', $detail, $parts ) ) {
                    $faqs[] = [
                        '@type' => 'Question',
                        'name'  => wp_strip_all_tags( $parts[1] ),
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text'  => wp_strip_all_tags( $parts[2] )
                        ]
                    ];
                }
            }
        }

        // Parse Yoast FAQ blocks if present in content
        if ( preg_match_all( '/<div class="schema-faq-section"(.*?)>(.*?)<\/div>/is', $content, $yoast_matches ) ) {
            foreach ( $yoast_matches[0] as $section ) {
                if ( preg_match( '/<strong class="schema-faq-question"[^>]*>(.*?)<\/strong>/is', $section, $q_matches ) &&
                     preg_match( '/<p class="schema-faq-answer"[^>]*>(.*?)<\/p>/is', $section, $a_matches ) ) {
                    $faqs[] = [
                        '@type' => 'Question',
                        'name'  => wp_strip_all_tags( $q_matches[1] ),
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text'  => wp_strip_all_tags( $a_matches[1] )
                        ]
                    ];
                }
            }
        }

        // Parse generic WP block headers/paragraphs that might act as FAQs (fallback if structured block missing)
        // E.g. <h3 class="faq-question">...</h3><p class="faq-answer">...</p>
        if ( preg_match_all( '/<h[2-4][^>]*class="[^"]*faq-question[^"]*"[^>]*>(.*?)<\/h[2-4]>\s*<p[^>]*class="[^"]*faq-answer[^"]*"[^>]*>(.*?)<\/p>/is', $content, $custom_matches ) ) {
            for ( $i = 0; $i < count( $custom_matches[0] ); $i++ ) {
                $faqs[] = [
                    '@type' => 'Question',
                    'name'  => wp_strip_all_tags( $custom_matches[1][$i] ),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => wp_strip_all_tags( $custom_matches[2][$i] )
                    ]
                ];
            }
        }

        if ( ! empty( $faqs ) ) {
            $faq_schema = [
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $faqs
            ];
            $schemas[] = $faq_schema;
        }
    }

    // Output all schemas
    if ( ! empty( $schemas ) ) {
        echo "\n<!-- AtmanMe Custom Schema JSON-LD -->\n";
        foreach ( $schemas as $schema ) {
            echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . "</script>\n";
        }
        echo "<!-- End AtmanMe Custom Schema JSON-LD -->\n";
    }
}
