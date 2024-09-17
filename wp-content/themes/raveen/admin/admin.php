<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Admin_Setup {

    function __construct() {

        add_filter( 'single_template', array( $this, 'single_rivax_template' ) );
        add_action( 'admin_menu', array( $this, 'register_pages' ), 9 );
        add_action( 'admin_init', array( $this, 'redirect_to_welcome' ) );
        add_action('admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action('enqueue_block_editor_assets', array( $this, 'editor_scripts' ), 90 );
        add_filter( 'ocdi/import_files', array( $this, 'import_demo_config' ) );
        add_filter( 'ocdi/plugin_page_setup', array( $this, 'ocdi_plugin_page_setup' ) );

    }



    // Single post preview for rivax-template post type
    function single_rivax_template ($single_template) {
        global $post;

        if ( in_array($post->post_type, ['rivax-template', 'elementor_library']) ) {
            $single_template = RIVAX_THEME_DIR . '/admin/single-rivax-template.php';
        }

        return $single_template;
    }


    // plugin pages
    function register_pages() {
        add_menu_page( esc_html__('Theme Dashboard', 'raveen'), esc_html__('Raveen', 'raveen'), 'manage_options', 'rivax-dashboard', '', 'dashicons-admin-generic', 50 );
        add_submenu_page( 'rivax-dashboard', esc_html__('Theme Dashboard', 'raveen'), esc_html__('Theme Dashboard', 'raveen'), 'manage_options', 'rivax-dashboard',  array($this, 'dashboard_welcome') );

    }


    // Dashboard welcome page
    function dashboard_welcome() {
        include_once RIVAX_THEME_DIR . '/admin/dashboard-welcome.php';
    }

    // Redirect to dashboard page after theme activation.
    function redirect_to_welcome() {
        global $pagenow;
        if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
            wp_safe_redirect( admin_url( "admin.php?page=rivax-dashboard" ) );
            exit;
        }
    }


    // Load admin assets in pages we need
    function admin_scripts($hook) {

        $allow_pages = array(
            'toplevel_page_rivax-dashboard',
            'post-new.php',
            'post.php',
        );

	    if( in_array($hook, $allow_pages) ) {
		    wp_enqueue_style('rivax_admin_style', RIVAX_THEME_URI . '/admin/assets/css/admin.css', array(), null);
	    }

    }


	// Load Gutenberg assets
	function editor_scripts( $hook ) {

		wp_enqueue_style( 'rivax-editor-style', RIVAX_THEME_URI . '/admin/assets/css/editor.css', array(), null);
		wp_add_inline_style( 'rivax-editor-style', $this->get_gutenberg_custom_style() );
	}

	// Admin custom style
	function get_gutenberg_custom_style () {
		$custom_css = '';
		include_once RIVAX_THEME_DIR . '/inc/custom-style-editor.php';
		return $custom_css;
	}


    // Demo importer config. One Click Demo Import plugin
    function import_demo_config() {
        return [
            [
                'import_file_name'             => esc_html__('Personal Demo', 'raveen'),
                'local_import_file'            => RIVAX_THEME_DIR . '/admin/demo/personal/content.xml',
                'local_import_redux'           => [
                    [
                        'file_path'   => RIVAX_THEME_DIR . '/admin/demo/personal/redux.json',
                        'option_name' => 'rivax_raveen_options',
                    ],
                ],
                'import_preview_image_url'     => RIVAX_THEME_URI . '/admin/demo/personal/screenshot.png',
                'preview_url'                  => 'https://landing.rivaxstudio.com/raveen',
            ],
			
			[
		        'import_file_name'             => esc_html__('LifeStyle Demo', 'raveen'),
		        'local_import_file'            => RIVAX_THEME_DIR . '/admin/demo/lifestyle/content.xml',
		        'local_import_redux'           => [
			        [
				        'file_path'   => RIVAX_THEME_DIR . '/admin/demo/lifestyle/redux.json',
				        'option_name' => 'rivax_raveen_options',
			        ],
		        ],
		        'import_preview_image_url'     => RIVAX_THEME_URI . '/admin/demo/lifestyle/screenshot.png',
		        'preview_url'                  => 'https://landing.rivaxstudio.com/raveen',
	        ],
			
	        [
		        'import_file_name'             => esc_html__('Travel Demo', 'raveen'),
		        'local_import_file'            => RIVAX_THEME_DIR . '/admin/demo/travel/content.xml',
		        'local_import_redux'           => [
			        [
				        'file_path'   => RIVAX_THEME_DIR . '/admin/demo/travel/redux.json',
				        'option_name' => 'rivax_raveen_options',
			        ],
		        ],
		        'import_preview_image_url'     => RIVAX_THEME_URI . '/admin/demo/travel/screenshot.png',
		        'preview_url'                  => 'https://landing.rivaxstudio.com/raveen',
	        ],
			
			[
		        'import_file_name'             => esc_html__('Tech Demo', 'raveen'),
		        'local_import_file'            => RIVAX_THEME_DIR . '/admin/demo/tech/content.xml',
		        'local_import_redux'           => [
			        [
				        'file_path'   => RIVAX_THEME_DIR . '/admin/demo/tech/redux.json',
				        'option_name' => 'rivax_raveen_options',
			        ],
		        ],
		        'import_preview_image_url'     => RIVAX_THEME_URI . '/admin/demo/tech/screenshot.png',
		        'preview_url'                  => 'https://landing.rivaxstudio.com/raveen',
	        ],
			
			[
		        'import_file_name'             => esc_html__('Classic Demo', 'raveen'),
		        'local_import_file'            => RIVAX_THEME_DIR . '/admin/demo/classic/content.xml',
		        'local_import_redux'           => [
			        [
				        'file_path'   => RIVAX_THEME_DIR . '/admin/demo/classic/redux.json',
				        'option_name' => 'rivax_raveen_options',
			        ],
		        ],
		        'import_preview_image_url'     => RIVAX_THEME_URI . '/admin/demo/classic/screenshot.png',
		        'preview_url'                  => 'https://landing.rivaxstudio.com/raveen',
	        ],
			
			[
		        'import_file_name'             => esc_html__('Furniture Demo', 'raveen'),
		        'local_import_file'            => RIVAX_THEME_DIR . '/admin/demo/furniture/content.xml',
		        'local_import_redux'           => [
			        [
				        'file_path'   => RIVAX_THEME_DIR . '/admin/demo/furniture/redux.json',
				        'option_name' => 'rivax_raveen_options',
			        ],
		        ],
		        'import_preview_image_url'     => RIVAX_THEME_URI . '/admin/demo/furniture/screenshot.png',
		        'preview_url'                  => 'https://landing.rivaxstudio.com/raveen',
	        ],
        ];
    }


    // change One Click Demo Import settings
    function ocdi_plugin_page_setup( $default_settings ) {
        $default_settings['parent_slug'] = 'rivax-dashboard';
        $default_settings['menu_slug'] = 'rivax-demo-importer';
        return $default_settings;
    }

}

// Call Rivax_Admin_Setup
new Rivax_Admin_Setup();


// Plugins installer
include_once RIVAX_THEME_DIR . '/admin/plugins-installer.php';


// Redux Framework Config
include_once RIVAX_THEME_DIR . '/admin/redux-config.php';