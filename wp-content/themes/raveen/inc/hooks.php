<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


// Add Favicon for AMP
add_action( 'amp_post_template_head', 'wp_site_icon');


// Replace author image
add_filter( 'pre_get_avatar', 'rivax_replace_author_avatar', 10, 3 );
function rivax_replace_author_avatar ($avatar, $id_or_email, $args) {

    if(isset($args["force_default"]) && $args["force_default"]) {
        return $avatar;
    }

	// Get user data.
	if ( is_numeric( $id_or_email ) ) {
		$user = get_user_by( 'id', (int) $id_or_email );
	}
	elseif ( is_object( $id_or_email ) ) {
		$comment = $id_or_email;
		if ( !empty( $comment->user_id ) ) {
			$user = get_user_by( 'id', $comment->user_id );
		} else {
			$user = get_user_by( 'email', $comment->comment_author_email );
		}
		if ( ! $user ) {
			return $avatar;
		}
	} elseif ( is_string( $id_or_email ) ) {
		$user = get_user_by( 'email', $id_or_email );
	} else {
		return $avatar;
	}

	if ( ! $user ) {
		return $avatar;
	}
	$user_id = $user->ID;


	$profile_image_id = intval(get_the_author_meta( 'rivax_author_profile_image_id', $user_id ));
	$profile_image_url = wp_get_attachment_image_url($profile_image_id);
	if($profile_image_url ) {
		return '<img class="avatar avatar-' . (int) $args['size'] . ' photo" src="' . esc_url($profile_image_url) . '" alt="' . esc_attr($user->display_name) . '" loading="lazy" width="' . $args['width'] . '" height="' . $args['height'] . '">';
	}

	return $avatar;

}



// Add class to body
add_filter('body_class', 'rivax_body_class');
function rivax_body_class($classes) {

	if(rivax_get_option('smooth-scroll')) {
		$classes[] = 'rivax-smooth-scroll';
	}

    if(rivax_get_option('remove-site-box')) {
        $classes[] = 'no-site-box';
    }

    if( rivax_dark_mode_current_status() || ( rivax_dark_mode_enabled() && rivax_get_option('always-dark-mode')  ) ) {
        $classes[] = 'dark-mode';
    }

	return $classes;
}



// Full Size for Gif image thumbnail
add_filter('wp_get_attachment_image_src', 'rivax_full_size_gif_images', 10, 4);
function rivax_full_size_gif_images($image, $attachment_id, $size, $icon) {
	if( rivax_get_option('full-size-gif') && ! empty( $image[0] ) ) {

		$format = wp_check_filetype( $image[0] );

		if ( ! empty( $format ) && 'gif' == $format['ext'] && 'full' != $size ) {
			return wp_get_attachment_image_src( $attachment_id, 'full', $icon );
		}

	}

	return $image;
}



// Limit search for custom post types
add_filter('pre_get_posts','rivax_limit_search_post_types',100);
function rivax_limit_search_post_types ($query) {

	$post_types = rivax_get_option('search-post-types');

	if ( is_array($post_types) && count($post_types) && $query->is_search && $query->is_main_query() && !is_admin() ) {
		$query->set('post_type',$post_types);
	}

	return $query;
}



// Performance Settings
add_action('wp', function () {

	if( rivax_get_option('disable-elementor-google-font') ) {
		add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
	}

	if( rivax_get_option('disable-emojis') ) {
		// Prevent Emoji from loading on the front-end
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

	}

}, 11);

add_action( 'wp', function () {

	if( rivax_get_option('disable-woocommerce-assets-out-of-shop') && function_exists( 'is_woocommerce' ) ){

		if(! is_woocommerce() && ! is_cart() && ! is_checkout() && !is_account_page()) {

			remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
			remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
			remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);

			remove_action('wp_enqueue_scripts', [Automattic\WooCommerce\Internal\Orders\OrderAttributionController::class, 'enqueue_scripts_and_styles']);
		}
	}

}, 11 );

add_action( 'wp_enqueue_scripts', function () {

	if( rivax_get_option('disable-extendify') ) {
		wp_dequeue_style( 'redux-extendify-styles' );
	}

	if( rivax_get_option('disable-woocommerce-blocks-assets') ){

		wp_deregister_style('wc-all-blocks-style');
		wp_deregister_style('wc-blocks-vendors-style');
		remove_action('wp_head', 'wc_gallery_noscript');
	}

	if( rivax_get_option('disable-gutenberg-assets') ) {
		if (!is_singular() || ( class_exists( '\Elementor\Plugin' ) && get_the_ID() && Elementor\Plugin::instance()->documents->get( get_the_ID() )->is_built_with_elementor() ) ) {

			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library-theme' );
			wp_dequeue_style( 'global-styles' );
			wp_dequeue_style( 'classic-theme-styles' );
			remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
		}
	}

}, 11 );

add_action( 'wp_default_scripts', function($scripts) {

	if ( !is_admin() && rivax_get_option('disable-jquery-migrate') && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}

} );


if( rivax_get_option('disable-xmlrpc') ) {

    add_filter ( 'xmlrpc_enabled', '__return_false' );
    add_filter ( 'pings_open', '__return_false', 9999 );
    add_filter ( 'wp_headers', function ($headers) {
        unset ( $headers ['X-Pingback'], $headers ['x-pingback'] );
        return $headers;
    } );
}


if ( rivax_get_option('disable-rsdlink') ) {
    remove_action ( 'wp_head', 'rsd_link' );
}


if ( rivax_get_option('disable-shortlink') ) {
    remove_action ( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action ( 'template_redirect', 'wp_shortlink_header', 11 );
}


if ( rivax_get_option('disable-rssfeeds') ) {
    remove_action ( 'wp_head', 'feed_links', 2 );
    remove_action ( 'wp_head', 'feed_links_extra', 3 );
    add_action( 'template_redirect', function() {
        if ( is_feed() ) {
            status_header( 403 );
            die( '403 Forbidden' );
        }
    } );
}


if ( rivax_get_option('disable-generator-tag') ) {
    remove_action ( 'wp_head', 'wp_generator' );
    remove_action ( 'wp_head', 'wc_generator' );
    remove_action ( 'wp_head', array( 'Redux_Functions_Ex', 'meta_tag' ) );
}
