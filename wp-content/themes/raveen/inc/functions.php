<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

// Get Options
function rivax_get_option($opt1, $opt2 = NULL) {

    global $rivax_raveen_options;

    if(!$rivax_raveen_options && class_exists( 'Redux' )) {
	    $rivax_raveen_options = get_option('rivax_raveen_options');
    }

    if($opt2) {
        $option =  isset($rivax_raveen_options[$opt1][$opt2])? $rivax_raveen_options[$opt1][$opt2] : '';
    }
    else {
        $option = isset($rivax_raveen_options[$opt1])? $rivax_raveen_options[$opt1] : '';
    }

    return apply_filters('rivax_get_option', $option, $opt1, $opt2);
}


// Get Elementor Content to Display
function rivax_get_display_elementor_content($post_id){

    if(!class_exists('Elementor\Plugin')){
        return '';
    }

    $pluginElementor = \Elementor\Plugin::instance();
    $response = $pluginElementor->frontend->get_builder_content_for_display($post_id);

    return $response;
}

// Get template id of layout
function rivax_get_layout_template_id($layout) {

    $template_id = 0;

    if($layout == 'sidebar') {

        if( is_page() ) {
            $template_id =  rivax_get_option('single-page-sidebar-template');
        }
        elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
	        $template_id =  rivax_get_option('woocommerce-sidebar-template');
        }
        elseif( is_single() ) {
            $template_id =  rivax_get_option('single-post-sidebar-template');
        }
        else {
            $template_id =  rivax_get_option('blog-sidebar-template');
        }

    }
    elseif($layout == 'footer') {

        // Singular Footer
        if( is_singular() ) {
            $template_id =  get_post_meta(get_the_ID(), 'rivax_page_footer', true );
        }

        // Global Footer
        if(!$template_id) {
            $template_id = rivax_get_option('site-footer');
        }

    }
    elseif($layout == 'header') {

        // Singular Header
        if( is_singular() ) {
            $template_id = get_post_meta(get_the_ID(), 'rivax_page_header', true );
        }

        // Global Single Post Header
        if(!$template_id && is_singular( 'post' )) {
            $template_id = rivax_get_option('single-post-header');
        }

        // Global Header
        if(!$template_id) {
            $template_id = rivax_get_option('site-header');
        }

    }
    elseif($layout == 'single_top_content' && is_singular( 'post' ) ) {

        $template_id =  get_post_meta(get_the_ID(), 'rivax_page_top_content', true ); // Get From Post Settings
        if(!$template_id) {
            $template_id = rivax_get_option('single-post-top-content-template'); // Get From Theme Options
        }

    }
    elseif($layout == 'single_bottom_content' && is_singular( 'post' ) ) {

        $template_id =  get_post_meta(get_the_ID(), 'rivax_page_bottom_content', true ) ; // Get From Post Settings
        if(!$template_id) {
            $template_id = rivax_get_option('single-post-bottom-content-template'); // Get From Theme Options
        }

    }
    elseif($layout == '404' && is_404() ) {

        $template_id =  rivax_get_option('page-404-template');

    }
    elseif($layout == 'sticky_offcanvas' ) {

        $template_id =  rivax_get_option('site-sticky-offcanvas');

    }
    elseif($layout == 'archive' && ( is_archive() || is_home() || is_search() ) ) {

        $template_id =  rivax_get_option('archive-template');

    }

    return intval($template_id);

}


// Get Rivax Templates List
if( !function_exists('rivax_get_templates_list') ) {
	function rivax_get_templates_list($add_disable = false) {

		$templates_list = array('0' => esc_html__('Default', 'raveen'));

        if($add_disable == 'add_disable') {
	        $templates_list['disable'] = esc_html__('Disable', 'raveen');
        }

		$args = array(
			'numberposts' => -1,
			'post_type' => 'rivax-template',
			'post_status'    => 'publish'
		);
		$templates_posts = get_posts( $args );

		foreach ($templates_posts as $post_item) {
			$templates_list[$post_item->ID] = esc_html($post_item->post_title);
		}

		return $templates_list;
	}
}



/* Get Sidebar Position */
function rivax_get_sidebar_position ($for, $default) {

    // Default Sidebar Position for theme settings
    $sidebar_position = rivax_get_option($for . '-sidebar-position');
    switch ($sidebar_position) {
        case 'left':
        case 'right':
        case 'none':
        case 'none-narrow':
            break;
        default:
            $sidebar_position = 'right';
    }

    // Custom Sidebar Position for the post
    if( $for == 'single-post' || $for == 'single-page' ) {
        switch ( get_post_meta(get_the_ID(), 'rivax_page_sidebar', true ) ) {
            case 'left':
                $sidebar_position = 'left';
                break;
            case 'right':
                $sidebar_position = 'right';
                break;
            case 'none':
                $sidebar_position = 'none';
                break;
            case 'none-narrow':
                $sidebar_position = 'none-narrow';
                break;
            case 'elementor':
                $sidebar_position = 'elementor';
                break;
        }
    }


    // Check Sidebar For Content
    if( in_array($sidebar_position, ['left', 'right']) ) {
        $sidebar_template_id = rivax_get_layout_template_id('sidebar');
        if(!$sidebar_template_id && !is_active_sidebar( 'rivax_sidebar_widgets' )) {
            $sidebar_position = $default;
        }
    }


    return $sidebar_position;

}


// Calculate Post Reading Time
// $post : Post ID or WP_Post object
function rivax_get_reading_time( $post = null ) {
    $post = get_post( $post );

    if ( ! $post ) {
        return false;
    }

    $custom_reading_time = absint(get_post_meta(get_the_ID(), 'rivax_single_reading_time', true));
    if($custom_reading_time) {
        return $custom_reading_time;
    }

    $words_per_minute = absint(rivax_get_option('reading-time-words-per-minute'));
    $words_per_minute = $words_per_minute ?: 255;

    $content = get_post_field( 'post_content', $post );
    $number_of_images = substr_count( strtolower( $content ), '<img ' );

    $content = wp_strip_all_tags( $content );
    $word_count = count( preg_split( '/\s+/', $content ) );

    // Each image is like 25 words
    $word_count += $number_of_images * 25;

    $reading_time = $word_count / $words_per_minute;

    return ceil($reading_time);
}


// HexColor
function rivax_strToHex( $string, $steps = -10 ) {
    $hex_output = sprintf( '%s', substr( md5( $string ), 0, 6 ) );
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max( -255, min( 255, $steps ) );
    // Split into three parts: R, G and B
    $color_parts = str_split( $hex_output, 2 );
    $output = '#';
    foreach ( $color_parts as $color ) {
        $color = hexdec( $color );
        // Convert to decimal
        $color = max( 0, min( 255, $color + $steps ) );
        // Adjust color
        $output .= str_pad(
            dechex( $color ),
            2,
            '0',
            STR_PAD_LEFT
        );
        // Make two char hex code
    }
    return strToUpper( $output );
}


// Title Tags
function rivax_title_tags() {
    $title_tags = [
        'h1'   => 'H1',
        'h2'   => 'H2',
        'h3'   => 'H3',
        'h4'   => 'H4',
        'h5'   => 'H5',
        'h6'   => 'H6',
        'div'  => 'div',
        'span' => 'span',
        'p'    => 'p',
    ];
    return $title_tags;
}


// Grid Tiles Layouts
function rivax_grid_tiles_layouts() {
    $layouts = [
        '0'         => esc_html__( 'Default', 'raveen' ),
        '1'         => esc_html__( 'Layout 1 (5 items)', 'raveen' ),
        '2'         => esc_html__( 'Layout 2 (4 items)', 'raveen' ),
        '3'         => esc_html__( 'Layout 3 (4 items)', 'raveen' ),
        '4'         => esc_html__( 'Layout 4 (4 items)', 'raveen' ),
        '5'         => esc_html__( 'Layout 5 (4 items)', 'raveen' ),
        '6'         => esc_html__( 'Layout 6 (3 items)', 'raveen' ),
        '7'         => esc_html__( 'Layout 7 (5 items)', 'raveen' ),
        '8'         => esc_html__( 'Layout 8 (5 items)', 'raveen' ),
        '9'         => esc_html__( 'Layout 9 (5 items)', 'raveen' ),
        '10'        => esc_html__( 'Layout 10 (3 items)', 'raveen' ),
        '11'        => esc_html__( 'Layout 11 (3 items)', 'raveen' ),
        '12'        => esc_html__( 'Layout 12 (4 items)', 'raveen' ),
        '13'        => esc_html__( 'Layout 13 (6 items)', 'raveen' ),
        '14'        => esc_html__( 'Layout 14 (5 items)', 'raveen' ),
        '15'        => esc_html__( 'Layout 15 (4 items)', 'raveen' ),
        '16'        => esc_html__( 'Layout 16 (5 items)', 'raveen' ),
        '17'        => esc_html__( 'Layout 17 (5 items)', 'raveen' ),
        '18'        => esc_html__( 'Layout 18 (5 items)', 'raveen' ),
        '19'        => esc_html__( 'Layout 19 (4 items)', 'raveen' ),
        '20'        => esc_html__( 'Layout 20 (5 items)', 'raveen' ),
        '21'        => esc_html__( 'Layout 21 (4 items)', 'raveen' ),
        '22'        => esc_html__( 'Layout 22 (3 items)', 'raveen' ),
        '23'        => esc_html__( 'Layout 23 (6 items)', 'raveen' ),
        '24'        => esc_html__( 'Layout 24 (4 items)', 'raveen' ),
        '25'        => esc_html__( 'Layout 25 (5 items)', 'raveen' ),
        '26'        => esc_html__( 'Layout 26 (6 items)', 'raveen' ),
        '27'        => esc_html__( 'Layout 27 (3 items)', 'raveen' ),
        '28'        => esc_html__( 'Layout 28 (2 items)', 'raveen' ),
        '29'        => esc_html__( 'Layout 29 (2 items)', 'raveen' ),
        '30'        => esc_html__( 'Layout 30 (4 items)', 'raveen' ),
        '31'        => esc_html__( 'Layout 31 (4 items)', 'raveen' ),
        '32'        => esc_html__( 'Layout 32 (3 items)', 'raveen' ),
        '33'        => esc_html__( 'Layout 33 (3 items)', 'raveen' ),
        '34'        => esc_html__( 'Layout 34 (5 items)', 'raveen' ),
        '35'        => esc_html__( 'Layout 35 (5 items)', 'raveen' ),
        '36'        => esc_html__( 'Layout 36 (7 items)', 'raveen' ),
        '37'        => esc_html__( 'Layout 37 (6 items)', 'raveen' ),
    ];

    return $layouts;
}


// Carousel Arrows Icons
function rivax_carousel_arrows_icons () {
    $arrows_icons = [
        'ri-angle-right-solid'              => esc_html__( 'Style 1', 'raveen' ),
        'ri-angle-double-right-solid'       => esc_html__( 'Style 2', 'raveen' ),
        'ri-arrow-alt-circle-right'         => esc_html__( 'Style 3', 'raveen' ),
        'ri-arrow-circle-right-solid'       => esc_html__( 'Style 4', 'raveen' ),
        'ri-arrow-right-solid'              => esc_html__( 'Style 5', 'raveen' ),
        'ri-caret-right-solid'              => esc_html__( 'Style 6', 'raveen' ),
        'ri-caret-square-right'             => esc_html__( 'Style 7', 'raveen' ),
        'ri-chevron-right-solid'            => esc_html__( 'Style 8', 'raveen' ),
        'ri-long-arrow-alt-right-solid'     => esc_html__( 'Style 9', 'raveen' ),
        'ri-arrow-right-b'                  => esc_html__( 'Style 10', 'raveen' ),
        'ri-arrow-right-c'                  => esc_html__( 'Style 11', 'raveen' ),
        'ri-android-arrow-dropright-circle' => esc_html__( 'Style 12', 'raveen' ),
        'ri-chevron-right'                  => esc_html__( 'Style 13', 'raveen' ),
        'ri-arrow-right-a'                  => esc_html__( 'Style 14', 'raveen' ),
        'ri-ios-arrow-thin-right'           => esc_html__( 'Style 15', 'raveen' ),
        'ri-chevron-circle-right-solid'     => esc_html__( 'Style 16', 'raveen' ),
        'ri-ios-redo-outline'               => esc_html__( 'Style 17', 'raveen' ),
        'ri-android-share'                  => esc_html__( 'Style 18', 'raveen' ),
        'ri-arrow-right-line'               => esc_html__( 'Style 19', 'raveen' ),
        'ri-arrow-right-circle-line'        => esc_html__( 'Style 20', 'raveen' ),
        'ri-arrow-right-fill'               => esc_html__( 'Style 21', 'raveen' ),
        'ri-arrow-right-circle-fill'        => esc_html__( 'Style 22', 'raveen' ),
        'ri-arrow-right-s-line'             => esc_html__( 'Style 23', 'raveen' ),
    ];

    return $arrows_icons;
}


// Print post format icon in default archive
function rivax_print_post_format_icon() {

    $post_format = get_post_format() ? : 'standard';

    if ($post_format == 'standard') {
        return;
    }

    switch ($post_format) {
        case 'gallery':
            $post_format_icon = 'ri-images';
            break;
        case 'video':
            $post_format_icon = 'ri-youtube-line';
            break;
        case 'audio':
            $post_format_icon = 'ri-volume-up-line';
            break;
        case 'link':
            $post_format_icon = 'ri-link-solid';
            break;
        case 'quote':
            $post_format_icon = 'ri-double-quotes-l';
            break;
        default:
            $post_format_icon = 'ri-images';
    }

    ?>
    <div class="post-format-icon rivax-position-top-left">
        <i class="<?php echo esc_html($post_format_icon) ?>"></i>
    </div>
    <?php

}


// Get post views
if(!function_exists('rivax_get_post_views')) {
    function rivax_get_post_views($post_ID){
        $count_key = 'post_views';
        $count = intval( get_post_meta($post_ID, $count_key, true) );
        if($count > 999) {
            $count = substr($count,0, -2) / 10 . 'K';
        }
        return $count;
    }
}




// Get the excerpt
function rivax_get_the_excerpt($length = 0) {

	$excerpt = get_the_excerpt();
	if ($excerpt) {
		$excerpt = wp_strip_all_tags($excerpt);
		$excerpt = str_replace('[…]', '', $excerpt);
		$excerpt = trim($excerpt);
        if( absint($length) < strlen($excerpt) ) {
	        $excerpt = substr($excerpt, 0, absint($length));
	        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
	        $excerpt .= '...';
        }
	}

    return $excerpt;

}



// Query not found message
function rivax_query_not_found_msg () {
    ?>
    <div class="nothing-show">
        <h5><?php esc_html_e('Nothing found!', 'raveen'); ?></h5>
        <p><?php esc_html_e('It looks like nothing was found here!', 'raveen'); ?></p>
    </div>
    <?php
}



// Get Post svg cover
function rivax_the_svg_cover ($style) {

    $svg_list = [
        'clouds' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 61.7" preserveAspectRatio="none"><path class="st0" opacity="0.2" d="M399.9,61.7V25.3c-1.7-0.6-3.6-0.9-5.5-0.9c-1.9,0-3.7,0.3-5.4,0.8c-2.8-6.1-8.9-10.4-16.1-10.4c-3.3,0-6.3,0.9-8.9,2.4c-5.3-8.2-14.5-13.6-25-13.6c-12.3,0-22.9,7.5-27.4,18.3C308.2,11,298.1,3.1,286.1,3.1c-7,0-13.3,2.7-18.1,7c-1.6-0.5-3.2-0.8-4.9-0.8c-4.4,0-8.4,1.8-11.4,4.6c-3.6-4.9-9.4-8.1-15.9-8.1c-4.6,0-8.9,1.6-12.3,4.3c-3.4-2.7-7.6-4.3-12.3-4.3c-9.7,0-17.8,7-19.5,16.3c-1.4-0.6-3-1-4.7-1c-3.8,0-7.2,1.8-9.4,4.5c-3-7-9.9-11.9-18-11.9c-3.9,0-7.5,1.2-10.6,3.1c-4.9-7-13-11.6-22.2-11.6c-7.3,0-13.9,2.9-18.8,7.6c-4-3-9-4.8-14.5-4.8c-8.4,0-15.8,4.3-20.2,10.8c-1.5-0.7-3.3-1.1-5.1-1.1c-2.6,0-5.1,0.8-7,2.3c-3.8-3-8.6-4.8-13.8-4.8c-7.2,0-13.5,3.4-17.6,8.7c-2.1-1-4.4-1.6-6.8-1.6c-5.1,0-9.6,2.5-12.4,6.4C7.3,27.3,3.8,26.3,0,25.9v35.8H399.9z"/><path class="st0" opacity="0.2" d="M399.9,25.1c-1.6-0.3-3.3-0.5-5-0.5c-6.6,0-12.6,2.5-17.1,6.5c-3.1-10.7-13.1-18.6-24.8-18.6c-8.3,0-15.6,3.9-20.3,9.9c-4.7-6-12.1-9.9-20.3-9.9c-14.3,0-25.8,11.6-25.8,25.8c0,1,0.1,2,0.2,3c-4.7-5.7-11.9-9.4-19.9-9.4c-8,0-15.1,3.6-19.8,9.2c-4.9-4.5-11.4-7.2-18.5-7.2c-8.4,0-15.9,3.8-20.9,9.7c-4.4-9.7-14.2-16.4-25.5-16.4c-5.4,0-10.5,1.5-14.8,4.2c-3.5-10.1-13.1-17.3-24.4-17.3c-9,0-16.9,4.6-21.5,11.5c-3.9-5.3-10.2-8.7-17.3-8.7c-4.8,0-9.2,1.6-12.8,4.2c-3.7-6.4-10.6-10.6-18.5-10.6c-7.2,0-13.5,3.5-17.4,8.9c-2.4-4.2-7-7.1-12.2-7.1c-7.1,0-12.9,5.2-13.9,12c-0.5,0-1,0-1.4,0c-14.1,0-25.6,11.4-25.6,25.6c0,1.2,0.1,2.5,0.3,3.7c-0.8,0.1-1.7,0.3-2.5,0.5v7.6h400L399.9,25.1z"/><path class="st1" d="M399.9,61v-4.9c-2.3-1-4.8-1.5-7.5-1.5c-0.4,0-0.8,0-1.2,0c-2.7-7.3-9.8-12.6-18.1-12.6c-6,0-11.3,2.7-14.8,6.9c-4.8-7.1-12.8-11.7-22-11.7c-8.9,0-16.8,4.4-21.6,11.2C312.6,40.2,305,34,296,34c-6.5,0-12.2,3.2-15.7,8.1c-1.9-0.7-4-1-6.2-1c-5.4,0-10.3,2.2-13.8,5.9c-2.7-7.4-9.8-12.8-18.2-12.8c-6.5,0-12.2,3.2-15.7,8.1c-3.7-2.7-8.2-4.2-13.1-4.2c-9.1,0-16.9,5.4-20.4,13.2c-1.4-0.7-3-1.1-4.7-1.1c-3.2,0-6.1,1.3-8.1,3.5c-3.4-5.4-9.5-9-16.3-9c-3.9,0-7.6,1.2-10.6,3.2c-3.8-8.1-12.1-13.7-21.6-13.7c-6.9,0-13.2,2.9-17.5,7.7c-4.3-4.2-10.2-6.7-16.7-6.7c-9.2,0-17.2,5.1-21.2,12.7c-1.9-1.1-4-1.8-6.4-1.8c-3.9,0-7.3,1.8-9.6,4.7c-3.4-4.4-8.7-7.2-14.7-7.2c-7.3,0-13.6,4.1-16.7,10.2c-2.5-2.4-5.9-3.8-9.7-3.8c-5.2,0-9.7,2.8-12.2,6.9c-1.9-1.4-4.3-2.4-6.8-2.6V61v0.7h399.9V61L399.9,61L399.9,61z"/></svg>',

        'corner' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 45" preserveAspectRatio="none"><polygon class="st0" points="0,38.7 200,0 400,38.7 400,45 0,45 "/></svg>',

        'cross-line' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 59.7" preserveAspectRatio="none"><path class="st0" d="M0,59.7V19.8C0,17.7,1.7,16,3.8,16h0c2.1,0,3.8,1.7,3.8,3.8v14.2c0,2.1,1.7,3.8,3.8,3.8c2.1,0,3.8-1.7,3.8-3.8  V27c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v16.4c0,2.1,1.7,3.8,3.8,3.8c2.1,0,3.8-1.7,3.8-3.8V16.2c0-2.1,1.7-3.8,3.8-3.8h0  c2.1,0,3.8,1.7,3.8,3.8v17.7c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V19.8c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v27.8  c0,2,1.7,3.7,3.7,3.7h0.3c2,0,3.7-1.7,3.7-3.7V3.8c0-2.1,1.7-3.8,3.8-3.8c2.1,0,3.8,1.7,3.8,3.8v34.7c0,2,1.7,3.7,3.7,3.7l0,0  c2,0,3.7-1.7,3.7-3.7V23.4c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v6.7c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V8.9  c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v31.9c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V19.8c0-2.1,1.7-3.8,3.8-3.8h0  c2.1,0,3.8,1.7,3.8,3.8v5.7c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7v-10c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v16.1  c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V19.8c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v27.3c0,2.1,1.7,3.8,3.8,3.8h0  c2.1,0,3.7-1.7,3.7-3.8V5.3c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v32.9c0,2.1,1.7,3.8,3.8,3.8s3.8-1.7,3.8-3.8v-13  c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8V52c0,2.1,1.7,3.8,3.8,3.8h0.1c2.1,0,3.8-1.7,3.8-3.8l-0.1-41.3  c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v29.2c0,2.1,1.7,3.8,3.8,3.8h0c2.1,0,3.8-1.7,3.8-3.8V19.8c0-2.1,1.7-3.8,3.8-3.8h0  c2.1,0,3.8,1.7,3.8,3.8v4.9c0,2.1,1.7,3.8,3.8,3.8c2.1,0,3.8-1.7,3.8-3.8v-9.6c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v15.8  c0,2.1,1.7,3.8,3.8,3.8c2.1,0,3.8-1.7,3.8-3.8V19.8c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v14.2c0,2.1,1.7,3.8,3.8,3.8  c2.1,0,3.8-1.7,3.8-3.8V27c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v16.4c0,2.1,1.7,3.8,3.8,3.8c2.1,0,3.8-1.7,3.8-3.8V16.2  c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v17.7c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V19.8c0-2.1,1.7-3.8,3.8-3.8h0  c2.1,0,3.8,1.7,3.8,3.8v27.8c0,2,1.7,3.7,3.7,3.7h0.3c2,0,3.7-1.7,3.7-3.7V3.8c0-2.1,1.7-3.8,3.8-3.8s3.8,1.7,3.8,3.8v34.7  c0,2,1.7,3.7,3.7,3.7l0,0c2,0,3.7-1.7,3.7-3.7V23.4c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v6.7c0,2,1.7,3.7,3.7,3.7h0.1  c2,0,3.7-1.7,3.7-3.7V8.9c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v31.9c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V19.8  c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v5.7c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7v-10c0-2.1,1.7-3.8,3.8-3.8h0  c2.1,0,3.8,1.7,3.8,3.8v16.1c0,2,1.7,3.7,3.7,3.7h0.1c2,0,3.7-1.7,3.7-3.7V19.8c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v27.3  c0,2.1,1.7,3.8,3.8,3.8h0c2.1,0,3.7-1.7,3.7-3.8V5.3c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v32.9c0,2.1,1.7,3.8,3.8,3.8  s3.8-1.7,3.8-3.8v-13c0-2.1,1.7-3.8,3.8-3.8h0c2.1,0,3.8,1.7,3.8,3.8v34.5H0z"/></svg>',

        'curve' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 35" preserveAspectRatio="none"><path class="st0" d="M0,33.6C63.8,11.8,130.8,0.2,200,0.2s136.2,11.6,200,33.4v1.2H0V33.6z"/></svg>',

        'drops' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 70.8" preserveAspectRatio="none"><path class="st0" d="M400,68c0,0-7.1-0.8-7.1-8.5s6.4-22.1,0-26s-7.3,2.6-6,6.5c1.3,3.9,6.2,14.5-2.6,14.8  c-6.3,0.2-0.8-8.3-7.4-10.2c-3.7-1.1-2,4.6-6.3,4.8c-6.3,0.4-7.8-10.1-7.8-12.4c0-2.3,1.9-28.7,0-32.9c-1.9-4.2-3.6-4.5-5.3-3.7  c-1.7,0.7-4.6,2.5-2,11.2c2.7,8.7,3.4,26,3.8,29.5c0.4,3.6,0.2,8.9-5.3,8.3c-5.6-0.6-0.9-16.1-6.6-15.7c-5.7,0.4-0.6,9-6.5,11.2  s-7.6,0.2-8-4.2c-0.3-4.4-5.9-5-8.6,6c-2.7,11-10.5,9-11.4,0.4s3.6-22.9-4.3-21.9s-3.6,11.9-2.2,14.4s6.3,22.2-6,27.3  c-12.3,5.1-1.7-33.5-10.4-32.9c-8.7,0.7,2.7,24.4-7.5,27.2c-10.2,2.8,0-15.1-7.1-17.6c-7.1-2.5,3.7,10.7-4.1,13.4  c-7.9,2.7-6.6-26.4-6.6-26.4s2.9-14.9-3.2-13.9c-6.1,1-1.7,14.7-0.7,18.6c0.9,3.9,1.7,22.2-7.4,22.5c-12.2,0.4-2.4-23.9-12.2-23.1  c-9.8,0.7,0.2,11.1-8.5,15.2c-2.5,1.2-5.6-5.9-8.7-4.9c-3.2,1-4.2,10.9-9.2,10.1c-5-0.7-4.4-11.5-4.3-18.7c0.1-7.1-3.9-7.9-3.7-2.4  c0.2,5,2.5,16.2-0.2,20.6c-0.5,0.7-1.4,1-2.2,0.5c-1.4-0.8-2.1-1.6-1.9,2.6c0.2,4.9-1.5,7.4-3.7,8c-0.3,0.1-0.6,0.1-0.9,0.1l0,0  c-0.6,0-1.2-0.1-1.8-0.3c-1.4-0.5-3.5-2-3.4-6c0.2-7.6,6.4-22.1,0-26c-6.4-3.9-7.3,2.6-6,6.5s6.2,14.5-2.6,14.8  c-6.3,0.2-0.8-8.3-7.4-10.2c-3.7-1.1-2,4.6-6.3,4.8c-6.3,0.4-7.8-10.1-7.8-12.4c0-2.3,1.9-28.7,0-32.9s-3.6-4.5-5.3-3.7  s-4.6,2.5-2,11.2c2.7,8.7,3.4,26,3.8,29.5c0.4,3.6,0.2,8.9-5.3,8.3c-5.6-0.6-0.9-16.1-6.6-15.7c-5.7,0.4-0.6,9-6.5,11.2  c-5.9,2.2-7.6,0.2-8-4.2s-5.9-5-8.6,6c-2.7,11-10.5,9-11.4,0.4c-0.8-8.6,3.6-22.9-4.3-21.9s-2.7,11.6-2.2,14.4  c0.9,4.8,2.7,25.8-5.4,24.6c-13.1-2-2.2-30.8-11-30.2c-8.7,0.7,2.7,24.4-7.5,27.2C72.5,64,83,41.9,75.6,43.6  C69.9,45,79.4,54.3,71.5,57c-7.9,2.7-6.6-26.4-6.6-26.4s2.9-14.9-3.2-13.9S60.1,31.4,61,35.3s1.7,22.2-7.4,22.5  c-12.2,0.4-2.4-23.9-12.2-23.1c-9.8,0.7,0.8,14.8-8.4,17.4c-7.9,2.3-3.6-10.5-9.5-10.1c-4,0.3,2.9,13.9-8.5,13  c-5-0.4-4.4-11.5-4.3-18.7c0.1-7.1-3.9-7.9-3.7-2.4c0.2,5.5,3,18.5-1.2,21.7c-2.2-0.6-3.4-3.2-3.2,2.1S2,67,0,68v2.8h400V68z"/></svg>',

        'mountains' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 86.4" preserveAspectRatio="none"><path class="st0" opacity="0.2" d="M0,69.3c0,0,76.2-89.2,215-32.8s185,32.8,185,32.8v17H0V69.3z"/><path class="st0" opacity="0.2" d="M0,69.3v17h400v-17c0,0-7.7-93.8-145.8-59.1S89.7,119,0,69.3z"/><path class="st1" d="M0,69.3c0,0,50.3-63.1,197.3-14.2S400,69.3,400,69.3v17H0V69.3z"/></svg>',

        'pyramids' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 45" preserveAspectRatio="none"><polygon class="st0" points="0.5,40.1 49.9,21.2 138.1,40.1 276.4,-0.2 400.5,40.1 400.5,45 0.5,45 "/></svg>',

        'splash' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 50" preserveAspectRatio="none"><g><path class="st0" d="M158.3,19.5c2.6,0.3,1.2-4.2-0.5-2C157.1,18.3,157.4,19.4,158.3,19.5z"/><path class="st0" d="M157.2,8.9c-0.8-0.7-1.8,1.1-1.7,1.4C156.2,11.4,158,9.6,157.2,8.9z"/><path class="st0" d="M171.8,19.1c2.2-0.6,1.1-3.2-0.6-1.3C170.7,18.6,170.9,19.4,171.8,19.1z"/><path class="st0" d="M154,23.1c0.9-0.1,1.2-1.2,0.5-2C152.8,18.9,151.4,23.4,154,23.1z"/><path class="st0" d="M140.5,22.7c0.8,0.2,1.1-0.6,0.6-1.3C139.4,19.6,138.3,22.1,140.5,22.7z"/><path class="st0" d="M140.5,26.9c-1.8,1.9,3.9,2,1.6,0.3C141.7,26.9,140.9,26.5,140.5,26.9z"/><path class="st0" d="M350.3,37.3c-0.1-0.1-0.1-0.2-0.2-0.3c-1-1.3-0.3-3-3.6-3.5c-1.9-0.4-5.3,0.3-7.2,0.7c-3,1-4.3,2.5-7.7,3   c-3.2,0.5-7,0.7-10.3,0.9c-2.8,0.1-5.4,0.1-7.4-1.2c-1.9-1.1-1.7-2.5-4-3.3c-9.3-3.1-15.9,2.9-23.9,4.9c-1.9-1.1-0.2-2.4-0.1-3.6   c-0.3-5-7.3-0.3-10.6,1c-1.7,0.7-3,1-4,1c-0.5-0.1-0.9-0.2-1.4-0.2c-1.7-0.6-2.4-2.3-3.6-3.7c1-0.4,2.1-0.7,2.9-1.4   c1-0.9,0.8-2.2-0.7-2.2c-1.1,0-2.6,1.4-3.3,2c-0.1,0.1-0.2,0.2-0.3,0.4c-2-1.2-5.1-1.4-8.2-0.6c0.5-1.1,1-2.2,0.4-2.8   c-1.1-1.1-3.2,0.6-4.4-0.2c-1.7-1.1,4.7-4.4-0.6-4.7c-1.1,0-2.8,0.3-2.6-1.2c0.1-1.1,2-1,2.2-2.3c0.1-1.4-2.2-1.1-1.1-3   c0.7-1,2.7-1.4,3-2.6c0.3-1.7-1.4-1-2.2-0.5c-1.2,0.8-1.9,2.7-3.3,3.4c-1.1,0.7-2.3,0.2-3,1.8c-0.3,0.8,0.1,3-1,3.4   c-2.4,0.8,0.8-6.1-2.5-4.7c-1.8,0.9-1,4.7-1.7,6.1c-0.5,0.9-1.4,2.6-2.7,2c-0.3-0.2-0.4-0.4-0.5-0.6c0-0.1,0-0.3,0-0.4   c0.1-0.7,0.5-1.5-0.2-1.9c-0.7-0.5-1.8,0.4-2.5,1.2c-0.1,0.1-0.2,0.1-0.2,0.2c-0.1,0.2-0.2,0.3-0.3,0.4c-1.4,1.7-1.1,4.9-3.1,6.8   c-0.6,0.6-2.5,2.1-3.5,1.4c-0.9,2.1-1.6,4.3-2.2,6.6c-0.4,0.3-0.9,0.6-1.4,0.9c-0.9-0.8-1.5-1.9-1.6-3   c-0.4-5.6,11.4-12.7,11.2-16.2c0,0-0.2-0.8-0.2-1.4c-0.3-4.7,6.6-8.2,6.9-9.7c0.1-0.5-0.6-1.2-2.1-1.1c-7.1,0.5-10.1,13-12.6,13.2   c-0.7,0.1-1.7-0.8-1.8-2.2c-0.1-1.4,0.7-2.8,0.6-4.3c-0.1-1.1-0.7-1.1-1.3-1.1c-3.2,0.2-4,13.6-11.1,14.1c-8.7,0.6-5-14-9.5-13.7   c-2.3,0.2-5.4,4-6.1,4.1c-1.9,0.1-0.6-4.3-5.5-4c-0.8,0.1-1.8,0.3-1.8,0.3c-1.8,0.1-0.8-2.9-2.5-2.8c-0.5,0-0.9,0.4-1.4,0.5   c-1.3,0.1-3.6-3-5.8-2.8c-0.9,0.1-2.3,0.8-2.2,2.2c0.2,3.1,5.3,0.9,7.2,5.5c0.7,1.8,0.3,4.4,2.1,5.8c2.2,1.7,10.8,9.5,11.1,13.1   c0.1,1.6-0.1,3.1-0.6,4.2c-0.2,0-0.3,0-0.5,0c-0.2-0.1-0.5-0.2-0.7-0.3c-1.2-2.8-2.5-5.5-4-8.1c-0.9,0.8-3-0.4-3.7-0.9   c-2.2-1.6-2.4-4.8-4-6.3c-0.5-0.6-2.5-2.2-3.3-1.4c-0.9,0.8,0.9,2.2-0.3,3c-1.3,0.8-2.4-0.8-3-1.6c-0.9-1.4-0.6-5.2-2.5-5.8   c-3.5-1,0.6,5.4-1.8,5c-0.3-0.1-0.5-0.3-0.7-0.6c0.6-0.2,0.9-0.7,0.3-1.4c-0.2-0.2-0.5-0.2-0.7-0.1c-0.1-0.5-0.2-0.9-0.3-1.2   c-0.9-1.5-2-0.9-3.2-1.4c-1.4-0.5-2.4-2.3-3.7-2.9c-0.9-0.5-2.6-0.9-2.1,0.8c0.4,1.2,2.5,1.3,3.3,2.2c1.3,1.7-1,1.7-0.7,3.1   c0.3,1.2,2.2,0.8,2.5,1.9c0.4,1.5-1.3,1.4-2.4,1.6c-5.1,1,1.6,3.3,0.1,4.7c-0.6,0.5-1.4,0.4-2.2,0.3c-0.3-0.2-0.8-0.4-1.3-0.6   c-3.7-1.2-7.6-0.9-9.6,0.7c-1,0.8-1.6,2-2.3,2.9c0,0-0.1,0-0.1,0c-0.9,0.1-1.3,0.7-1.1,1.2c-0.2,0.1-0.5,0.3-0.7,0.4   c-0.5,0.1-0.9,0.1-1.4,0.2c-1,0-2.3-0.3-4-1c-3.3-1.3-10.3-6-10.6-1c0.2,1.2,1.8,2.5-0.1,3.6c-8-2-14.7-8-23.9-4.9   c-2.4,0.9-2.1,2.3-4,3.3c-2,1.3-4.6,1.3-7.4,1.2c-3.3-0.2-7.1-0.4-10.3-0.9c-3.4-0.5-4.7-2-7.7-3c-1.9-0.5-5.3-1.1-7.2-0.7   c-3.3,0.5-2.6,2.2-3.6,3.5c-0.3,0.3-0.5,0.7-0.9,0.9c-43.7-2.6-66-5.7-66-5.7V50h400V32.3C400,32.3,385.5,34.9,350.3,37.3z"/><path class="st0" d="M237.9,15c-0.3,0-0.4,0.3-0.4,0.6c0,0.5,0.7,0.9,1.2,0.8c0.4,0,0.6-0.3,0.6-0.7C239.4,15.2,238.5,15,237.9,15z   "/><path class="st0" d="M232.2,9.1c0.7-0.6,1-1.1,1.8-1.4c2.4-1,2.9-2.5,2.8-3c0-0.6-0.5-0.7-1.4-0.6c-2.3,0.2-4,2.2-4.3,3.9   C230.9,9.1,231.4,9.8,232.2,9.1z"/><path class="st0" d="M228.5,5.5c0.4,0,1.5-1.1,1.4-2.5c-0.1-0.7-0.4-1.4-1.1-1.4c-0.6,0-1.6,0.7-1.5,1.7   C227.4,4.4,227.9,5.6,228.5,5.5z"/><path class="st0" d="M222.7,11.8c0.8-0.1,1.6-1.4,1.6-2.2c-0.1-0.8-0.6-1.2-1-1.2c-0.5,0-1.3,0.6-1.2,2   C222,10.7,222.2,11.8,222.7,11.8z"/><path class="st0" d="M196.8,13c0.2-0.2,0.3-0.5,0.2-0.8c0-0.3-1.8-5.6-2.5-5.5c-0.9,0.1-1.3,0.9-1.2,1.8   C193.4,9.4,196.4,13.5,196.8,13z"/><path class="st0" d="M184,11.2c0.3,0,1.1-1,1-2c-0.1-1-0.8-1.6-1.4-1.5c-0.5,0-0.8,1.3-0.7,2C183,10.7,183.6,11.2,184,11.2z"/><path class="st0" d="M178.5,8.7c0.5,0,0.9-0.1,0.9-0.7c-0.1-0.9-0.8-1.9-1.6-1.8c-0.6,0-0.7,0.3-0.7,0.8   C177.1,7.9,177.6,8.8,178.5,8.7z"/><path class="st0" d="M174.4,14.3c0.3-0.1,0.2-0.4,0.2-0.7c0-0.6-0.6-1-1.1-1C172.3,12.8,173.4,14.6,174.4,14.3z"/><path class="st0" d="M202.1,10.7c0.7,0.2,0.7-1.1,0.6-1.6c-0.1-1.3-1.7-2.8-1.6-1.2C201.2,8.6,201.3,10.6,202.1,10.7z"/><path class="st0" d="M203.1,4.1c0,0,0.8,0,0.7-0.7c0-0.4-0.7-1.1-1.2-1.1c-0.3,0-0.5,0.3-0.5,0.7C202.1,3.5,202.5,4,203.1,4.1z"/><path class="st0" d="M227.2,15.6c0.7,0.1,1.6-1.1,1.5-2.3c0-0.5-0.2-0.5-0.5-0.5c-0.8,0.1-1.4,0.8-1.4,1.5   C226.8,14.6,227,15.6,227.2,15.6z"/></g></svg>',

        'split' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 50" preserveAspectRatio="none"><path class="st0" d="M247.4,2.6C221.2,2.6,200,23.8,200,50c0-26.2-21.2-47.4-47.4-47.4H0V50h200h200V2.6H247.4z"/></svg>',

        'tilt' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 55" preserveAspectRatio="none"><polygon class="st0" points="0,55 400,55 0,0 "/></svg>',

        'torn-paper' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 61.7" preserveAspectRatio="none"><path class="st0" d="M400,61.7V17.9c-0.1-1.1-0.4-3.5-0.4-3.5c0-0.4-4-1.2-4,1.2c0,1.3-3.9,1.7-3.9,3.1c0-1-5.1-0.5-5.1,0  c0,0.1-4,2.6-4,2.7c0-0.6-4.8,2.1-4.8,0.9c0-1.3-5,0-5,0.2c0,0.8-3.8,2.6-3.8,3.3c0,0.3-4.7,0.5-4.7,1c0-1.1-3.9,3.4-3.9,2.9  c0-0.2-5.1-0.4-5.1,0.1c0-1.1-4.4,1.1-4.4,1.6c0,2.3-4.3,2.6-4.3,3.4c0,0.8-5.3-2.8-5.3-2.1c0-1.2-5.3-0.6-5.3,0.2  c0-0.4-5.1,2.8-5.1,1.8c0,0.6-4.7-0.1-4.7,0.6c0,0.9-3.4,3-3.4,2.9c0,0.2-3.4,2.4-3.4,2.8c0,1.2-4.8,0.3-4.8,0.1  c0-0.5-4.5,0.5-4.5,0.4c0-0.3-4.6,2.7-4.6,3c0-0.5-4.7-1.4-4.7-2c0,1-4.6,2-4.6,0.9c0,1-4.7,0.8-4.7-0.7c0,0-4.7-0.8-4.7,0.1  c0-0.2-4.6,2.1-4.6,2.2c0-0.1-4.6-0.7-4.6,0.5c0,0.3-4.3-1-4.3-0.6c0-0.1-3.9-2.8-3.9-1.9c0-0.5-3.9-2.1-3.9-2.7c0,0.8-3-3.4-3-3.7  c0,0.1-3.9-1.1-3.9-2.7c0-0.2-4.6-0.2-4.6-0.9c0-0.4-5.1-0.5-5.1-0.7c0-0.2-3.7,3.5-3.7,3.8c0-1.4-3.9,3.1-3.9,2.8  c0-1-4.7,0.5-4.7,1.7c0,0.5-4,0.5-4,1.7c0,0.1-3.6,3.3-3.6,2.9c0-1.3-4.4-0.2-4.4,0.9c0,0.7-4.6-1.2-4.6-0.1c0-1.2-4.1,1.4-4.1,1.7  c0,0.9-4.5-1.6-4.5-0.9c0,1.1-4.1,3.2-4.1,2.7c0-0.1-4.4,1.1-4.4,0.7c0,0.6-4.4,0.1-4.4-0.9c0,1.6-4.4-2.1-4.4-1.8  c0,1.2-4.3,3.9-4.3,2.9c0,0.1-4.3-1.3-4.3-0.6c0,2.1-4.4,0.8-4.4,0.4c0-0.7-3.8-4-3.8-3.4c0-1.7-3.6-2.5-3.6-2.1  c0-0.3-4.2-1.4-4.2-1c0-0.4-4.1,0.4-4.1-1.5c0-1.1-4.6,0.8-4.6-0.6c0,0.2-3.1-3.9-3.1-4c0,0.7-4.4-2.2-4.4-1.6c0,1-4.4-1.6-4.4-1.6  c0-0.4-4.9,0.8-4.9,0.3c0,0.7-4.6-0.2-4.6-0.3c0,0.3-4.4-0.6-4.4-1.4c0-0.4-4.6-1.7-4.6-1.8c0,0.4-4.7,0.6-4.7,0.9  c0,0-4.5,3-4.5,1.4c0,1.9-4.4,0.9-4.4,1.4c0-0.2-5.2-2-5.2-1.8c0,0.6-4.2,2.5-4.2,2.2c0,1.2-3.7,3.9-3.7,3.5c0-0.2-4.4,0.9-4.4,1.6  c0,0.8-5.1-0.2-5.1-0.8c0,0.4-4.5,1.5-4.5,1.5c0,0.7-4.7-0.9-4.7-0.8c0,0.3-4.4-0.7-4.4-1.4c0-0.8-4.7-0.9-4.7-0.1  c0-0.1-4.4-2.5-4.4-1.4c0-0.3-5.1,2-5.1,0.9c0-1.3-4.1-2.5-4.1-2.5c0,0.1-4.5-1.3-4.5-2.5c0-0.6-4.8,3.5-4.8,2.2  c0-0.9-4.3,2.5-4.3,2.4c0-0.6-5.4-1.1-5.4-1.8c0-1.3-4.1,4.2-4.1,3c0-0.2-5.1-0.5-5.1-0.7c0-0.5-3.9,1.2-3.9,1.3  c0-0.3-4.1-0.6-4.1-0.3c0-0.4-4.3,1.3-4.3,1c0,0.2-4.6,0.8-4.6-0.2c0-0.1-2.8-2.7-2.8-3.8c0-2-4.3-0.8-4.3-2c0,0.6-4.5,0.8-4.5-1.6  c0,0.2-2.6-5.2-2.6-4.7c0,1-1.9,0.1-3.2-0.5l0,33.9H400z"/></svg>',

        'triangle' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 45" preserveAspectRatio="none"><polygon class="st0" points="0,39.2 272.4,3.5 400,39.2 400,45 0,45 "/></svg>',

        'wave' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 35" preserveAspectRatio="none"><path class="st0" d="M0,35h400V24.9c0,0-43.8-25.4-114.9-3.4s-107.7,4.1-142.2-9S34.1-6.7,0,12.6V35z"/></svg>',

        'zigzag' => '<svg class="svg-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.4 400 35" preserveAspectRatio="none"><polygon class="st0" points="400,47.3 400,14.2 375,30.7 350,14.2 325,30.7 300,14.2 275,30.7 250,14.2 225,30.7 200,14.2 175,30.7   150,14.2 125,30.7 100,14.2 75,30.7 50,14.2 25,30.7 0,14.2 0,47.3 "/></svg>',

    ];

    if(isset($svg_list[$style])) {
        echo apply_filters('rivax_svg_cover', $svg_list[$style], $style );
    }

}



// Check Dark mode Enabled
function rivax_dark_mode_enabled () {

    return boolval(rivax_get_option('dark-mode'));
}

// Check Dark mode current status
function rivax_dark_mode_current_status() {

    if( rivax_dark_mode_enabled() ) {

        if( !empty($_COOKIE['raveenDarkMode']) && $_COOKIE['raveenDarkMode'] == 'enabled' ) {
            return true;
        }
        elseif( empty($_COOKIE['raveenDarkMode']) && rivax_get_option('default-dark-mode') ) {
            return true;
        }
    }
    return false;
}


/* Check is AMP Version */
function rivax_is_amp () {

    return function_exists('amp_is_request') && amp_is_request();
}


/* Autoload Next Post Indicator */
function rivax_autoload_next_post_indicator() {

    if( rivax_get_option('autoload-next-post') && is_singular('post') && !rivax_is_amp() ) {
        if ( rivax_get_option('autoload-next-post-same-cat') ) {
            $post_prev = get_previous_post( true );
        } else {
            $post_prev = get_previous_post();
        }

        if($post_prev) {
            ?>
            <div id="autoload-next-post-loader" data-loaded="0" data-next="<?php echo absint($post_prev->ID); ?>"><span class="rivax-post-load-more-loader"></span></div>
            <?php
        }
    }
}

/* Autoload Next Post Information for current post */
function rivax_autoload_next_post_info() {
    if( rivax_get_option('autoload-next-post') && !rivax_is_amp() ) {
        ?>
        <div class="autoload-next-post-info" data-id="<?php the_ID(); ?>" data-title="<?php echo esc_attr(get_the_title()); ?>" data-url="<?php echo esc_url(get_the_permalink()); ?>"></div>
        <?php
    }
}