<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Theme_Setup {

    function __construct() {

        add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
        add_action( 'after_setup_theme', array( $this, 'load_translation' ),1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'elementor_styles' ) );        
        add_action( 'widgets_init', array( $this, 'theme_sidebars' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'default_theme_fonts' ) );
	    add_action('enqueue_block_assets', array( $this, 'default_theme_fonts' ), 90 );
        add_action( 'amp_post_template_head', array( $this, 'amp_fonts' ) );
        add_filter( 'amp_customizer_is_enabled', '__return_false' );

    }

    // Sets up theme defaults and registers support for various WordPress features.
    function theme_setup() {

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable woocommerce support
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 400,
            'gallery_thumbnail_image_width' => 150,
            'single_image_width' => 800,
        ) );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        // Enable support for Post Thumbnail
        add_theme_support( 'post-thumbnails' );

        add_image_size( 'rivax-small', 550, 400, true );
        add_image_size( 'rivax-small-tall', 550, 800, true );
        add_image_size( 'rivax-small-square', 550, 550, true );
        add_image_size( 'rivax-small-masonry', 550 );

        add_image_size( 'rivax-medium', 800, 500, true );
        add_image_size( 'rivax-medium-square', 800, 800, true );
        add_image_size( 'rivax-medium-masonry', 800 );

        add_image_size( 'rivax-large', 1000, 600, true );
        add_image_size( 'rivax-large-wide', 1600, 700, true );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        ) );

        // Enable support for Post Formats.
        add_theme_support( 'post-formats', array(
            'gallery',
            'video',
            'audio',
            'quote',
            'link',
        ) );


        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        register_nav_menus(
            array(
                'primary_menu' => esc_html__( 'Primary menu', 'raveen' ),
                'amp_menu' => esc_html__( 'AMP menu', 'raveen' ),
            )
        );


		if(is_admin()) {

			// Disable Swiper 8.4
			if( get_option('elementor_experiment-e_swiper_latest') != 'active' ) {
				update_option('elementor_experiment-e_swiper_latest', 'active');
			}

			// Disable Default Colors
			if( get_option('elementor_disable_color_schemes') != 'yes' ) {
				update_option('elementor_disable_color_schemes', 'yes');
			}

			// Disable Default Fonts
			if( get_option('elementor_disable_typography_schemes') != 'yes' ) {
				update_option('elementor_disable_typography_schemes', 'yes');
			}

			// Disable extendify
			if( get_option('redux-framework_extendify_plugin_notice') != 'hide' ) {
				update_option('redux-framework_extendify_plugin_notice', 'hide');
			}
        }
		


        // Site width
        $GLOBALS['content_width'] = 860;

    }


    // Make theme available for translation.
    function load_translation () {

        load_theme_textdomain( 'raveen', RIVAX_THEME_DIR . '/languages' );
    }



    // Get Custom Style
    function get_custom_style () {
        $custom_css = '';
        include_once RIVAX_THEME_DIR . '/inc/custom-style.php';
        return $custom_css;
    }


	// Default Theme Fonts
	function default_theme_fonts () {

		if( !rivax_get_option('typography-body', 'font-family') ) {
			$is_ssl = is_ssl() ? 'https' : 'http';

			$fonts_url = "$is_ssl://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap";

			wp_enqueue_style( 'rivax-default-body-fonts', $fonts_url, array(), null );
		}
		
		if( !rivax_get_option('typography-heading', 'font-family') ) {
            $is_ssl = is_ssl() ? 'https' : 'http';

            $fonts_url = "$is_ssl://fonts.googleapis.com/css2?family=Public+Sans:wght@700&display=swap";

            wp_enqueue_style( 'rivax-default-heading-fonts', $fonts_url, array(), null );
        }

	}


    // AMP Fonts
    function amp_fonts () {

        $is_ssl = is_ssl() ? 'https' : 'http';

        $fonts_url = "$is_ssl://fonts.googleapis.com/css2?";

        $body_font_url = '';
        $heading_font_url = '';
        $body_font_family = rivax_get_option('typography-body', 'font-family');
        $heading_font_family = rivax_get_option('typography-heading', 'font-family');

        if( !$body_font_family ) {
            $body_font_url = 'family=Lato:wght@400;700';
        }
        else {
            $body_font_url = 'family=' . str_replace(' ', '+', $body_font_family);

            $body_font_weight = rivax_get_option('typography-body', 'font-weight');
            if( $body_font_weight ) {

                $body_font_style = rivax_get_option('typography-body', 'font-style');
                if( $body_font_style ) {
                    $body_font_url .=  ':' . $body_font_style . ',wght@' . $body_font_weight;
                }
                else {
                    $body_font_url .= ':wght@' . $body_font_weight;
                }

            }

        }


        if($heading_font_family) {
            $heading_font_url = 'family=' . str_replace(' ', '+', $heading_font_family);

            $heading_font_weight = rivax_get_option('typography-heading', 'font-weight');
            if( $heading_font_weight ) {

                $heading_font_style = rivax_get_option('typography-heading', 'font-style');
                if( $heading_font_style ) {
                    $heading_font_url .=  ':' . $heading_font_style . ',wght@' . $heading_font_weight;
                }
                else {
                    $heading_font_url .= ':wght@' . $heading_font_weight;
                }

            }
        }

        $fonts_url .= implode('&', array_filter([$body_font_url, $heading_font_url])) . '&display=swap';

        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo esc_url($fonts_url); ?>">
        <?php

    }


    // Enqueues Theme Scripts And Styles.
    function theme_scripts() {

        // Vendor Styles
        wp_enqueue_style( 'rivax-icon', RIVAX_THEME_URI . '/assets/css/rivax-icon.css', array(), null );
		wp_register_style( 'rivax-fancy-text', RIVAX_THEME_URI . '/assets/css/fancy-text.css', array(), null );

        // Theme Style
		if( rivax_dark_mode_enabled() ) {
            wp_enqueue_style( 'dark-theme', RIVAX_THEME_URI . '/assets/css/dark-theme.css', array(), null );
        }
		
        wp_enqueue_style( 'rivax-theme-style', RIVAX_THEME_URI . '/style.css', array(), null );
        wp_add_inline_style( 'rivax-theme-style', $this->get_custom_style() );

		if( is_single() ) {
			wp_enqueue_style( 'rivax-single', RIVAX_THEME_URI . '/assets/css/single-post.css', array(), null );
		}
		
	    wp_enqueue_style( 'rivax-woocommerce', RIVAX_THEME_URI . '/assets/css/woocommerce.css', array('woocommerce-general'), null );
        
	    if(rivax_get_option('smooth-scroll')) {
		    wp_enqueue_script( 'smooth-scroll', RIVAX_THEME_URI . '/assets/js/smooth-scroll.min.js', array(), '1.4.10', true );
	    }
		
		wp_register_script( 'rivax-fancy-text', RIVAX_THEME_URI . '/assets/js/fancy-text.js', array(), null, true );


        // Comment JS
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // Theme Scripts
        wp_enqueue_script( 'rivax-main-script', RIVAX_THEME_URI . '/assets/js/main.js', array( 'jquery' ), false, true );
        wp_localize_script( 'rivax-main-script', 'rivax_ajax_object',
            array(
                'AjaxUrl' => admin_url( 'admin-ajax.php' ),
            )
        );


    }
	
	
	// Enqueues Elementor Styles. Pre Render
    function elementor_styles() {

        if(!class_exists('Elementor\Plugin')){
            return;
        }

        if ( class_exists( '\Elementor\Plugin' ) ) {
            $elementor = \Elementor\Plugin::instance();
            $elementor->frontend->enqueue_styles();
        }

        if ( class_exists( '\ElementorPro\Plugin' ) ) {
            $elementor_pro = \ElementorPro\Plugin::instance();
            $elementor_pro->enqueue_styles();
        }

        $template_ids = array(
            rivax_get_layout_template_id('sidebar'),
            rivax_get_layout_template_id('footer'),
            rivax_get_layout_template_id('header'),
            rivax_get_layout_template_id('sticky_offcanvas'),
            rivax_get_layout_template_id('single_top_content'),
            rivax_get_layout_template_id('single_bottom_content'),
            rivax_get_layout_template_id('404'),
            rivax_get_layout_template_id('archive'),
        );

        foreach ($template_ids as $template_id) {
            if($template_id) {
                if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                    $css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
                } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                    $css_file = new \Elementor\Post_CSS_File( $template_id );
                }

                $css_file->enqueue();
            }
        }

    }


    // Register sidebars
    function theme_sidebars() {

        register_sidebar( array(
            'name' => esc_html__( 'Sidebar', 'raveen'),
            'id' => 'rivax_sidebar_widgets',
            'description' => esc_html__( 'Default Sidebar Widgets', 'raveen' ),
            'before_widget' => '<div id="%1$s" class="%2$s rivax-sidebar-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar( array(
            'name' => esc_html__( 'Footer', 'raveen'),
            'id' => 'rivax_footer_widgets',
            'description' => esc_html__( 'Default Footer Widgets', 'raveen' ),
            'before_widget' => '<div id="%1$s" class="%2$s rivax-sidebar-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

    }

}

// Lets start plugin
new Rivax_Theme_Setup();
