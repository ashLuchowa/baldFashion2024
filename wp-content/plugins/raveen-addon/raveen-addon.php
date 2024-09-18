<?php
/*
Plugin Name: Raveen Addon
Plugin URI: https://themeforest.net/user/rivaxstudio/
Description: Add rivax templates post type for the theme
Author: Rivax Studio
Author URI: https://themeforest.net/user/rivaxstudio/
Version: 1.2
Text Domain: rivax-addon
License: Themeforest.net
License URI: http://themeforest.net/licenses
*/

// register rivax-template post type
add_action( 'init', 'rivax_addon_register_post_type' );
function rivax_addon_register_post_type() {
    $labels = array(
        'name'               => __('Rivax Templates', 'rivax-addon'),
        'singular_name'      => __('Rivax Template', 'rivax-addon'),
        'menu_name'          => __('Rivax Template', 'rivax-addon'),
        'add_new'            => __('Add New', 'rivax-addon'),
        'add_new_item'       => __('Add New Rivax Template', 'rivax-addon'),
        'new_item'           => __('New Rivax Template', 'rivax-addon'),
        'edit_item'          => __('Edit Rivax Template', 'rivax-addon'),
        'view_item'          => __('View Rivax Template', 'rivax-addon'),
        'all_items'          => __('Rivax Templates', 'rivax-addon'),
        'search_items'       => __('Search Rivax Templates', 'rivax-addon'),
        'not_found'          => __('Not found', 'rivax-addon'),
        'not_found_in_trash' => __('Not found anythings in the trash', 'rivax-addon'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'exclude_from_search' => true,
        'show_in_menu'        =>  'rivax-dashboard',
        'show_in_nav_menus'   =>  false,
        'show_in_admin_bar'   =>  true,
        'show_ui'             =>  true,
        'show_in_rest'        =>  true,
        'rewrite'             => false,
        'menu_icon'           => 'dashicons-admin-links',
        'has_archive'         => false,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'            => array( 'title', 'editor' )
    );

    register_post_type( 'rivax-template', $args );

}



// Get Rivax Templates List
if( !function_exists('rivax_get_templates_list') ) {
	function rivax_get_templates_list($add_disable = false) {

    $templates_list = array('0' => esc_html__('Default', 'rivax-addon'));

	if($add_disable == 'add_disable') {
		$templates_list['disable'] = esc_html__('Disable', 'rivax-addon');
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


// Set post views
add_action('wp_head', 'rivax_set_post_views');
add_action('amp_post_template_head', 'rivax_set_post_views');
function rivax_set_post_views () {
    if( is_singular('post') ) {
        $count_key = 'post_views';
        $count = intval(get_post_meta(get_the_ID(), $count_key, true));
        $count++;
        update_post_meta(get_the_ID(), $count_key, $count);
    }
}



// Add post views to admin
add_filter('manage_post_posts_columns', 'rivax_posts_column_views');
function rivax_posts_column_views($defaults){
    $defaults['post_views'] = esc_html__('Views', 'rivax-addon');
    return $defaults;
}

add_action('manage_post_posts_custom_column', 'rivax_posts_custom_column_views',5,2);
function rivax_posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo rivax_get_post_views(get_the_ID());
    }
}


add_action( 'admin_init', 'rivax_addon_load_text_domain' );
function rivax_addon_load_text_domain () {
    load_plugin_textdomain( 'rivax-addon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
}


// Get Author Social Links
function rivax_author_social ($user_id) {


    $user_metas = get_user_meta($user_id);
    $social = [];

    $social_keys = array(
        'rivax_author_email',
        'rivax_author_website',
        'rivax_author_facebook',
        'rivax_author_twitter',
        'rivax_author_linkedin',
        'rivax_author_whatsapp',
        'rivax_author_instagram',
        'rivax_author_pinterest',
        'rivax_author_dribbble',
        'rivax_author_telegram',
        'rivax_author_youtube',
        'rivax_author_vimeo',
        'rivax_author_github',
        'rivax_author_behance',
        'rivax_author_soundcloud',
        'rivax_author_tumblr',
        'rivax_author_stackoverflow',
    );

    foreach ($social_keys as $social_key) {
        if( isset($user_metas[$social_key]) && !empty($user_metas[$social_key][0])) {
            $social[$social_key] = esc_attr($user_metas[$social_key][0]);
        }
    }


    if(!count($social)) {
        return;
    }

    echo '<ul>';
    if(!empty($social['rivax_author_website'])) {
        echo '<li><a rel="nofollow" class="website" target="_blank" data-title="' . esc_html__('Website: ', 'rivax-addon') . esc_url($social['rivax_author_website']) . '" href="' . esc_url($social['rivax_author_website']) . '"><i class="ri-earth-line"></i></a></li>';
    }

    if(!empty($social['rivax_author_email'])) {
        echo '<li><a rel="nofollow" class="email" data-title="' . esc_html__('Send Me an Email', 'rivax-addon') . '" href="mailto:' . esc_attr($social['rivax_author_email']) . '"><i class="ri-mail-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_facebook'])) {
        echo '<li><a rel="nofollow" class="facebook" target="_blank" data-title="' . esc_html__('Follow Me on Facebook', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_facebook']) . '"><i class="ri-facebook-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_twitter'])) {
        echo '<li><a rel="nofollow" class="twitter" target="_blank" data-title="' . esc_html__('Follow Me on Twitter', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_twitter']) . '"><i class="ri-twitter-x-line"></i></a></li>';
    }

    if(!empty($social['rivax_author_linkedin'])) {
        echo '<li><a rel="nofollow" class="linkedin" target="_blank" data-title="' . esc_html__('Follow Me on Linkedin', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_linkedin']) . '"><i class="ri-linkedin-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_whatsapp'])) {
        echo '<li><a rel="nofollow" class="whatsapp" target="_blank" data-title="' . esc_html__('Follow Me on WhatsApp', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_whatsapp']) . '"><i class="ri-whatsapp-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_instagram'])) {
        echo '<li><a rel="nofollow" class="instagram" target="_blank" data-title="' . esc_html__('Follow Me on Instagram', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_instagram']) . '"><i class="ri-instagram-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_pinterest'])) {
        echo '<li><a rel="nofollow" class="pinterest" target="_blank" data-title="' . esc_html__('Follow Me on Pinterest', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_pinterest']) . '"><i class="ri-pinterest-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_dribbble'])) {
        echo '<li><a rel="nofollow" class="dribbble" target="_blank" data-title="' . esc_html__('Follow Me on Dribbble', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_dribbble']) . '"><i class="ri-dribbble-line"></i></a></li>';
    }

    if(!empty($social['rivax_author_telegram'])) {
        echo '<li><a rel="nofollow" class="telegram" target="_blank" data-title="' . esc_html__('Follow Me on Telegram', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_telegram']) . '"><i class="ri-telegram-fill"></i></a></li>';
    }

    if(!empty($social['rivax_author_youtube'])) {
        echo '<li><a rel="nofollow" class="youtube" target="_blank" data-title="' . esc_html__('Follow Me on Youtube', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_youtube']) . '"><i class="ri-youtube-fill"></i></a></li>';
    }

	if(!empty($social['rivax_author_vimeo'])) {
		echo '<li><a rel="nofollow" class="vimeo" target="_blank" data-title="' . esc_html__('Follow Me on Vimeo', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_vimeo']) . '"><i class="ri-vimeo-fill"></i></a></li>';
	}

    if(!empty($social['rivax_author_github'])) {
        echo '<li><a rel="nofollow" class="github" target="_blank" data-title="' . esc_html__('Follow Me on Github', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_github']) . '"><i class="ri-github-fill"></i></a></li>';
    }

	if(!empty($social['rivax_author_behance'])) {
		echo '<li><a rel="nofollow" class="behance" target="_blank" data-title="' . esc_html__('Follow Me on Behance', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_behance']) . '"><i class="ri-behance-fill"></i></a></li>';
	}

	if(!empty($social['rivax_author_soundcloud'])) {
		echo '<li><a rel="nofollow" class="soundcloud" target="_blank" data-title="' . esc_html__('Follow Me on Soundcloud', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_soundcloud']) . '"><i class="ri-soundcloud-fill"></i></a></li>';
	}

	if(!empty($social['rivax_author_tumblr'])) {
		echo '<li><a rel="nofollow" class="tumblr" target="_blank" data-title="' . esc_html__('Follow Me on Tumblr', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_tumblr']) . '"><i class="ri-tumblr-fill"></i></a></li>';
	}

	if(!empty($social['rivax_author_stackoverflow'])) {
		echo '<li><a rel="nofollow" class="stackoverflow" target="_blank" data-title="' . esc_html__('Follow Me on Stackoverflow', 'rivax-addon') . '" href="' . esc_url($social['rivax_author_stackoverflow']) . '"><i class="ri-stack-overflow-fill"></i></a></li>';
	}

    echo '</ul>';
}



/* Meta Box */
require_once dirname( __FILE__ ) . '/meta-box.php';