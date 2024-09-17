<?php
/**
 * Breadcrumb function
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


function rivax_breadcrumb() {

    // If the breadcrumb is disabled OR is hidden on mobiles
    if( ! rivax_get_option( 'breadcrumb' ) || is_home() || is_front_page() ){
        return;
    }

    $delimiter   = '<em class="delimiter">&#47;</em>';
    $home_text   = esc_html__( 'Home', 'raveen' );
    $breadcrumb = array();

    $post     = get_post();
    $home_url = esc_url(home_url( '/' ));

    // Home
    $breadcrumb[] = array(
        'url'   => $home_url,
        'name'  => $home_text,
    );

    // Category
    if ( is_category() ){

        $category = get_query_var( 'cat' );
        $category = get_category( $category );

        if( $category->parent !== 0 ){

            $parent_categories = array_reverse( get_ancestors( $category->cat_ID, 'category' ) );

            foreach ( $parent_categories as $parent_category ) {
                $breadcrumb[] = array(
                    'url'  => get_term_link( $parent_category, 'category' ),
                    'name' => get_cat_name( $parent_category ),
                );
            }
        }

        $breadcrumb[] = array(
            'name' => get_cat_name( $category->cat_ID ),
        );
    }

    // Day
    elseif ( is_day() ){

        $breadcrumb[] = array(
            'url'  => get_year_link( get_the_time( 'Y' ) ),
            'name' => get_the_time( 'Y' ),
        );

        $breadcrumb[] = array(
            'url'  => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
            'name' => get_the_time( 'F' ),
        );

        $breadcrumb[] = array(
            'name' => get_the_time( 'd' ),
        );
    }

    // Month
    elseif ( is_month() ){

        $breadcrumb[] = array(
            'url'  => get_year_link( get_the_time( 'Y' ) ),
            'name' => get_the_time( 'Y' ),
        );

        $breadcrumb[] = array(
            'name' => get_the_time( 'F' ),
        );
    }

    // Year
    elseif ( is_year() ){

        $breadcrumb[] = array(
            'name' => get_the_time( 'Y' ),
        );
    }

    // Tag
    elseif ( is_tag() ){

        $breadcrumb[] = array(
            'name' => get_the_archive_title(),
        );
    }

    // Author
    elseif ( is_author() ){

        $author = get_queried_object();

        $breadcrumb[] = array(
            'name' => $author->display_name,
        );
    }

    // Search
    elseif ( is_search() ){

        $breadcrumb[] = array(
            'name' => sprintf( esc_html__( 'Search Results for: %s', 'raveen' ),  get_search_query() ),
        );
    }

    // 404
    elseif ( is_404() ){

        $breadcrumb[] = array(
            'name' => esc_html__( 'Nothing Found', 'raveen' ),
        );
    }

    // Pages
    elseif ( is_page() ){

        $breadcrumb[] = array(
            'name' => get_the_title(),
        );
    }

    // Attachment
    elseif ( is_attachment() ){

        $breadcrumb[] = array(
            'name' => get_the_title(),
        );
    }

    // Single Posts
    elseif ( is_singular() ){

        // Single Post
        if ( get_post_type() == 'post' ){

            $category = get_the_category()[0];

            if( $category->parent !== 0 ){

                $parent_categories = array_reverse( get_ancestors( $category->cat_ID, 'category' ) );

                foreach ( $parent_categories as $parent_category ) {
                    $breadcrumb[] = array(
                        'url'  => get_term_link( $parent_category, 'category' ),
                        'name' => get_cat_name( $parent_category ),
                    );
                }
            }

            $breadcrumb[] = array(
                'url'  => get_term_link( $category->cat_ID, 'category' ),
                'name' => get_cat_name( $category->cat_ID ),
            );

        }

        // Custom Post Type
        else{

            // Get the main Post type archive link
            if( $archive_link = get_post_type_archive_link( get_post_type() ) ){

                $post_type = get_post_type_object( get_post_type() );

                $breadcrumb[] = array(
                    'url'  => $archive_link,
                    'name' => $post_type->labels->singular_name,
                );
            }

            // Get custom Post Types taxonomies
            $taxonomies = get_object_taxonomies( $post, 'objects' );

            if( ! empty( $taxonomies ) && is_array( $taxonomies ) ){
                foreach( $taxonomies as $taxonomy ){
                    if( $taxonomy->hierarchical ){
                        $taxonomy_name = $taxonomy->name;
                        break;
                    }
                }
            }

            if( ! empty( $taxonomy_name ) ){
                $custom_terms = get_the_terms( $post, $taxonomy_name );

                if( ! empty( $custom_terms ) && ! is_wp_error( $custom_terms ) ) {

                    foreach ( $custom_terms as $term ){

                        $breadcrumb[] = array(
                            'url'  => get_term_link( $term ),
                            'name' => $term->name,
                        );

                        break;
                    }
                }
            }
        }

        $breadcrumb[] = array(
            'name' => get_the_title(),
        );
    }

    elseif( is_archive() ){
        $breadcrumb[] = array(
            'name' => get_the_archive_title(),
        );
    }


    // Print the BreadCrumb
    if( ! empty( $breadcrumb ) ){

        $counter = 0;
        $item_list_elements = array();
        $breadcrumb_schema = array(
            '@context' => 'http://schema.org',
            '@type'    => 'BreadcrumbList',
            '@id'      => '#Breadcrumb',
        );

        echo '<nav class="rivax-breadcrumb" id="breadcrumb">';

        foreach( $breadcrumb as $item ) {

            if( ! empty( $item['name'] ) ){
                $counter++;

                if( ! empty( $item['url'] ) ) {
                    echo '<a href="'. esc_url( $item['url'] ) .'">'. wp_strip_all_tags($item['name']) .'</a>'. $delimiter;
                }
                else{
                    echo '<span class="current">' . wp_strip_all_tags($item['name']) . '</span>';

                    global $wp;
                    $item['url'] = esc_url(home_url(add_query_arg(array(),$wp->request)));
                }

                $item_list_elements[] = array(
                    '@type'    => 'ListItem',
                    'position' => $counter,
                    'item'     => array(
                        'name' => $item['name'],
                        '@id'  => $item['url'],
                    )
                );
            }
        }

        echo '</nav>';

        if( rivax_get_option('breadcrumb-schema') ){

            // To remove the latest current element
            $latest_element = array_pop( $item_list_elements );

            if( ! empty( $item_list_elements ) && is_array( $item_list_elements ) ){

                $breadcrumb_schema['itemListElement'] = $item_list_elements;
                echo '<script type="application/ld+json">'. wp_json_encode( $breadcrumb_schema ) .'</script>';
            }
        }
    }

    wp_reset_postdata();
}
