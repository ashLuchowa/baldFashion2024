<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


// Add custom style in theme settings
function rivax_theme_settings_style () {
	wp_enqueue_style('rivax_settings_style', RIVAX_THEME_URI . '/admin/assets/css/settings.css', array(), null);
}
add_action( 'redux/page/rivax_raveen_options/enqueue', 'rivax_theme_settings_style' );




add_action('after_setup_theme', 'rivax_redux_config' );
function rivax_redux_config() {

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $theme = $theme->parent() ?: $theme;

    // This is your option name where all the Redux data is stored.
    $opt_name = "rivax_raveen_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * */
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__('Theme Settings', 'raveen'),
        'page_title'           => esc_html__('Theme Settings', 'raveen'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-hammer',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 72,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'rivax-dashboard',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'rivax-settings',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'output_location'                  => array( 'frontend', 'admin' ),
	    // Admin area: Enqueue dynamic CSS and Google fonts.
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    );

// Add content after the form.
    $args['footer_text'] = '<p>' . esc_html__('Designed by: ', 'raveen') . '<a href="https://themeforest.net/user/rivaxstudio/" target="_blank">Rivax Studio</a>.</p>';

    Redux::set_args( $opt_name, $args );

    /*
 * ---> END ARGUMENTS
 */

 /*
 *
 * ---> START SECTIONS
 *
 */

    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('General', 'raveen'),
        'id'               => 'general_section',
        'desc'             =>  esc_html__('General settings for site', 'raveen'),
        'icon'             => 'el el-cog',
        'fields'           => array(
			array(
                'id'       => 'site-width',
                'type'     => 'slider',
                'title'    => esc_html__('Site Width', 'raveen'),
                'subtitle' => esc_html__('Choose the site width.', 'raveen'),
                'desc'     => esc_html__('Default: 1600.', 'raveen'),
                'default'  => 1600,
                'min'       => 1200,
                'step'      => 10,
                'max'       => 1800,
            ),
            array(
                'id'       => 'sticky-sidebar',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Sticky Sidebar', 'raveen'),
                'subtitle' => esc_html__('Make sidebar sticky.', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),

            array(
                'id'       => 'site-preloader',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Preloader', 'raveen'),
                'subtitle' => esc_html__('Show site preloader transition before site loaded.', 'raveen'),
                'desc'     => '',
                'default'  => false,
            ),

            array(
                'id'       => 'smooth-scroll',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Smooth Scroll', 'raveen'),
                'subtitle' => esc_html__('Smooth scroll in website.', 'raveen'),
                'desc'     => '',
                'default'  => false,
            ),
            array(
                'id'       => 'remove-site-box',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Remove Site Box', 'raveen'),
                'subtitle' => esc_html__('Remove site box style.', 'raveen'),
                'desc'     => '',
            ),

            array(
                'id'       => 'full-size-gif',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Full Size Gif Images', 'raveen'),
                'subtitle' => esc_html__('Use full image size for Gif. It is useful to show gif animation in thumbnail.', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),

        )
    ) );

    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Header', 'raveen'),
        'id'               => 'header_section',
        'desc'             =>  esc_html__('General settings for header', 'raveen'),
        'icon'             => 'el el-website',
        'fields'           => array(

            array(
                'id'       => 'site-header',
                'type'     => 'select',
                'title'    => esc_html__('Site Header Template', 'raveen'),
                'subtitle' => esc_html__('Select header template for your site.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'single-post-header',
                'type'     => 'select',
                'title'    => esc_html__('Single Post Header Template', 'raveen'),
                'subtitle' => esc_html__('Select header template for the single post.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('Default inherit from site header template. You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'disable-sticky-offcanvas',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Disable Sticky Offcanvas', 'raveen'),
                'subtitle'    => esc_html__('Enable this option to disable the Sticky Offcanvas', 'raveen'),
                'desc'     => '',
                'default'  => false,
            ),

            array(
                'id'       => 'site-sticky-offcanvas',
                'type'     => 'select',
                'title'    => esc_html__('Site Sticky OffCanvas', 'raveen'),
                'subtitle' => esc_html__('Select sticky offCanvas for the site.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'sticky-offcanvas-opener-position',
                'type'     => 'select',
                'title'    => esc_html__('Sticky OffCanvas Opener Position', 'raveen'),
                'subtitle' => esc_html__('Select opener position.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'raveen'),
                    'right' => esc_html__('Right', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'left',
            ),
            array(
                'id'       => 'sticky-offcanvas-position',
                'type'     => 'select',
                'title'    => esc_html__('Sticky OffCanvas Position', 'raveen'),
                'subtitle' => esc_html__('Select offCanvas position.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'raveen'),
                    'right' => esc_html__('Right', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'left',
            ),

        )
    ) );

    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Footer', 'raveen'),
        'id'               => 'footer_section',
        'desc'             =>  esc_html__('General settings for footer', 'raveen'),
        'icon'             => 'el el-credit-card',
        'fields'           => array(
            array(
                'id'       => 'site-footer',
                'type'     => 'select',
                'title'    => esc_html__('Site Footer', 'raveen'),
                'subtitle' => esc_html__('Select footer for the site.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'back-to-top',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Back to Top Button', 'raveen'),
                'subtitle' => esc_html__('Enable or disable back to top button.', 'raveen'),
                'desc'     => '',
                'default'  => false,
            ),

            array(
                'id'       => 'back-to-top-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Back to Top Button Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),


        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Sidebar', 'raveen'),
        'id'               => 'sidebar_section',
        'desc'             =>  esc_html__('General settings for sidebar', 'raveen'),
        'icon'             => 'el el-align-left',
        'fields'           => array(
            array(
                'id'       => 'subtitle-756694',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Single Page Sidebar', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-page-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Single Page Sidebar Position', 'raveen'),
                'subtitle' => esc_html__('Select sidebar position for pages.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'raveen'),
                    'right' => esc_html__('Right', 'raveen'),
                    'none' => esc_html__('No Sidebar', 'raveen'),
                    'none-narrow' => esc_html__('No Sidebar + Narrow Content', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'single-page-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Single Page Sidebar Template', 'raveen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'subtitle-355494',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Single Post Sidebar', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-post-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Single Post Sidebar Position', 'raveen'),
                'subtitle' => esc_html__('Select sidebar position for single post.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'raveen'),
                    'right' => esc_html__('Right', 'raveen'),
                    'none' => esc_html__('No Sidebar', 'raveen'),
                    'none-narrow' => esc_html__('No Sidebar + Narrow Content', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'single-post-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Single Post Sidebar Template', 'raveen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'subtitle-755494',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Blog Sidebar', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'blog-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Blog Sidebar Position', 'raveen'),
                'subtitle' => esc_html__('Select sidebar position for blog archive.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'raveen'),
                    'right' => esc_html__('Right', 'raveen'),
                    'none' => esc_html__('No Sidebar', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'blog-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Blog Sidebar Template', 'raveen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'subtitle-756794',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Woocommerce Sidebar', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'woocommerce-shop-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Woocommerce Shop Sidebar Position', 'raveen'),
                'subtitle' => esc_html__('Select sidebar position for woocommerce shop.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'raveen'),
                    'right' => esc_html__('Right', 'raveen'),
                    'none' => esc_html__('No Sidebar', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
	        array(
		        'id'       => 'woocommerce-archive-sidebar-position',
		        'type'     => 'select',
		        'title'    => esc_html__('Woocommerce Archive Sidebar Position', 'raveen'),
		        'subtitle' => esc_html__('Select sidebar position for woocommerce archive.', 'raveen'),
		        'desc'     => '',
		        'options'  => array(
			        'left' => esc_html__('Left', 'raveen'),
			        'right' => esc_html__('Right', 'raveen'),
			        'none' => esc_html__('No Sidebar', 'raveen'),
		        ),
		        'select2'  => array( 'allowClear' => false ),
		        'default'  => 'none',
	        ),
            array(
                'id'       => 'woocommerce-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Woocommerce Sidebar Template', 'raveen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

        )
    ) );



    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Styling', 'raveen'),
        'id'               => 'styling_section',
        'desc'             =>  esc_html__('Styling settings', 'raveen'),
        'icon'             => 'el el-brush',
        'fields'           => array(
            array(
                'id'       => 'accent-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Accent Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'second-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Second Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'body-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Body Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'site-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Site Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'body-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Body Text Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'heading-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Headings Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-progress-bar-bg',
                'type'     => 'color_gradient',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Progress Bar Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'        => array(
                    'from'           => '',
                    'to'             => '',
                ),
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-category-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Category Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-category-bg-hover',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Category Background Hover', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'button-bg-hover',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Button Background Hover', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),



        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Typography', 'raveen'),
        'id'               => 'typography',
        'desc'             => esc_html__('Typography settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-fontsize',
        'fields'           => array(
            array(
                'id'       => 'typography-body',
                'type'     => 'typography',
                'all_styles'      => true,
                'google'      => true,
                'color'      => false,
                'text-align'      => false,
                'subsets'      => false,
                'line-height'      => false,
                'units'       =>'px',
                'title'    => esc_html__('Body Typography', 'raveen'),
            ),
            array(
                'id'       => 'typography-heading',
                'type'     => 'typography',
                'google'      => true,
                'color'      => false,
                'text-align'      => false,
                'subsets'      => false,
                'line-height'      => false,
                'font-size'      => false,
                'title'    => esc_html__('Headings Typography', 'raveen'),
            ),
	        array(
		        'id'       => 'typography-terms',
		        'type'     => 'typography',
		        'google'      => true,
		        'color'      => false,
		        'text-align'      => false,
		        'subsets'      => false,
		        'line-height'      => false,
		        'font-size'      => false,
		        'title'    => esc_html__('Terms Typography', 'raveen'),
	        ),
            array(
                'id'       => 'title-font-size-9856',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Font Size', 'raveen') . '</h2>',
            ),
            array(
                'id'       => 'h1-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H1 Font Size', 'raveen'),
                'subtitle' => esc_html__('Enter H1 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h2-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H2 Font Size', 'raveen'),
                'subtitle' => esc_html__('Enter H2 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h3-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H3 Font Size', 'raveen'),
                'subtitle' => esc_html__('Enter H3 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h4-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H4 Font Size', 'raveen'),
                'subtitle' => esc_html__('Enter H4 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h5-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H5 Font Size', 'raveen'),
                'subtitle' => esc_html__('Enter H5 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h6-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H6 Font Size', 'raveen'),
                'subtitle' => esc_html__('Enter H6 font size. Example: 28px or 1.8rem', 'raveen'),
            ),

            array(
                'id'       => 'title-font-size-984556',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Font Size In Responsive', 'raveen') . '</h2>',
            ),
            array(
                'id'       => 'h1-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H1 Font Size In Mobile And Tablet', 'raveen'),
                'subtitle' => esc_html__('Enter H1 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h2-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H2 Font Size In Mobile And Tablet', 'raveen'),
                'subtitle' => esc_html__('Enter H2 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h3-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H3 Font Size In Mobile And Tablet', 'raveen'),
                'subtitle' => esc_html__('Enter H3 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h4-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H4 Font Size In Mobile And Tablet', 'raveen'),
                'subtitle' => esc_html__('Enter H4 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h5-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H5 Font Size In Mobile And Tablet', 'raveen'),
                'subtitle' => esc_html__('Enter H5 font size. Example: 28px or 1.8rem', 'raveen'),
            ),
            array(
                'id'       => 'h6-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H6 Font Size In Mobile And Tablet', 'raveen'),
                'subtitle' => esc_html__('Enter H6 font size. Example: 28px or 1.8rem', 'raveen'),
            ),


        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Single Post', 'raveen'),
        'id'               => 'single_post_section',
        'desc'             => esc_html__('Single Post settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-pencil',
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('General', 'raveen'),
        'id'               => 'single_post_general',
        'desc'             => esc_html__('Single Post general settings', 'raveen'),
        'subsection'       => true,
        'icon'             => 'el el-cog',
        'fields'           => array(

            array(
                'id'       => 'single-post-top-content-template',
                'type'     => 'select',
                'title'    => esc_html__('Top Content', 'raveen'),
                'subtitle' => esc_html__('Select template to show in top of the post.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'single-post-bottom-content-template',
                'type'     => 'select',
                'title'    => esc_html__('Bottom Content', 'raveen'),
                'subtitle' => esc_html__('Select template to show in bottom of the post.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'disable-comments',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Disable Comments', 'raveen'),
                'subtitle' => esc_html__('Disable comments list and form.', 'raveen'),
                'desc'     => '',
            ),
            array(
                'id'       => 'disable-tags',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Disable Tags', 'raveen'),
                'subtitle' => esc_html__('Disable showing tags from the bottom of posts.', 'raveen'),
                'desc'     => '',
            ),
            array(
                'id'       => 'post-reading-progress-indicator',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Reading Progress Indicator', 'raveen'),
                'subtitle' => esc_html__('Show reading progress indicator in post.', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-post-share-box',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Show Share Box', 'raveen'),
                'subtitle' => esc_html__('Show share box in the single post.', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-post-share-box-options',
                'type'     => 'checkbox',
                'required' => array( 'single-post-share-box', '=', '1' ),
                'title'    => esc_html__('Share Box Options', 'raveen'),
                'subtitle' => esc_html__('Select share box options.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'facebook' => esc_html__('Facebook', 'raveen'),
                    'twitter' => esc_html__('Twitter', 'raveen'),
                    'linkedin' => esc_html__('Linkedin', 'raveen'),
                    'pinterest' => esc_html__('Pinterest', 'raveen'),
                    'telegram' => esc_html__('Telegram', 'raveen'),
                    'email' => esc_html__('Email', 'raveen'),
                    'whatsapp' => esc_html__('WhatsApp', 'raveen'),
                ),
                'default' => array(
                    'facebook' => '1',
                    'twitter' => '1',
                    'linkedin' => '0',
                    'pinterest' => '1',
                    'telegram' => '0',
                    'email' => '1',
                    'whatsapp' => '1',
                )
            ),
            array(
                'id'       => 'single-post-author-box',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Show Author Box', 'raveen'),
                'subtitle' => esc_html__('Show author box in the single post.', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-post-next-prev-posts',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Show Next and Previous Posts', 'raveen'),
                'subtitle' => esc_html__('Show next and Previous posts in the single post.', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-next-prev-posts-title',
                'type'     => 'text',
                'required' => array( 'single-post-next-prev-posts', '=', '1' ),
                'title'    => esc_html__('Next And Previous Posts Title', 'raveen'),
                'subtitle' => esc_html__('Enter your title for the next and Previous posts.', 'raveen'),
                'desc'     => esc_html__('Default value: Other Articles', 'raveen'),
                'default'  => esc_html__('Other Articles', 'raveen'),
            ),
            array(
                'id'       => 'reading-time-words-per-minute',
                'type'     => 'slider',
                'title'    => esc_html__('Reading Time Words Per Minute', 'raveen'),
                'subtitle' => esc_html__('How many words user can read per minute?', 'raveen'),
                'desc'     => esc_html__('Default value: 255', 'raveen'),
                'default'  => 255,
                'min'       => 100,
                'step'      => 10,
                'max'       => 500,
            ),


        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Hero Layout', 'raveen'),
        'id'               => 'single_post_layout',
        'desc'             => esc_html__('Single post hero layout settings', 'raveen'),
        'subsection'       => true,
        'icon'             => 'el el-picture',
        'fields'           => array(
            array(
                'id'       => 'single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Standard Post Layout', 'raveen'),
                'subtitle' => esc_html__('Select default layout for standard posts. You can customize settings for each layout below.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    '1' => esc_html__('Layout 1', 'raveen'),
                    '2' => esc_html__('Layout 2', 'raveen'),
                    '3' => esc_html__('Layout 3', 'raveen'),
                    '4' => esc_html__('Layout 4', 'raveen'),
                    '5' => esc_html__('Layout 5', 'raveen'),
                    '6' => esc_html__('Layout 6', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => '1',
            ),


            array(
                'id'       => 'subtitle-83494',
                'required' => array( 'single-layout', '=', '1' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 1 Settings', 'raveen') . '</h4>',
            ),
			array(
                'id'       => 'single-layout-1-hide-image',
                'type'     => 'switch',
				'required' => array( 'single-layout', '=', '1' ),
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Disable Featured Image', 'raveen'),
                'subtitle'    => '',
                'desc'     => '',
                'default'  => false,
            ),
            array(
                'id'       => 'single-layout-1-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-layout', '=', '1' ),
                'title'    => esc_html__('Post Meta', 'raveen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'raveen'),
                    'author-avatar' => esc_html__('Author Avatar', 'raveen'),
                    'date' => esc_html__('Date', 'raveen'),
                    'date-updated' => esc_html__('Updated Date', 'raveen'),
                    'category' => esc_html__('Category', 'raveen'),
                    'comments' => esc_html__('Comments', 'raveen'),
                    'views' => esc_html__('Views', 'raveen'),
                    'reading-time' => esc_html__('Reading Time', 'raveen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'date-updated' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                )
            ),



            array(
                'id'       => 'subtitle-74374',
                'required' => array( 'single-layout', '=', '2' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 2 Settings', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-layout-2-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-layout', '=', '2' ),
                'title'    => esc_html__('Post Meta', 'raveen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'raveen'),
                    'author-avatar' => esc_html__('Author Avatar', 'raveen'),
                    'date' => esc_html__('Date', 'raveen'),
                    'date-updated' => esc_html__('Updated Date', 'raveen'),
                    'category' => esc_html__('Category', 'raveen'),
                    'comments' => esc_html__('Comments', 'raveen'),
                    'views' => esc_html__('Views', 'raveen'),
                    'reading-time' => esc_html__('Reading Time', 'raveen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'date-updated' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                )
            ),


            array(
                'id'       => 'subtitle-99774',
                'required' => array( 'single-layout', '=', '3' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 3 Settings', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-layout-3-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-layout', '=', '3' ),
                'title'    => esc_html__('Post Meta', 'raveen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'raveen'),
                    'author-avatar' => esc_html__('Author Avatar', 'raveen'),
                    'date' => esc_html__('Date', 'raveen'),
                    'date-updated' => esc_html__('Updated Date', 'raveen'),
                    'category' => esc_html__('Category', 'raveen'),
                    'comments' => esc_html__('Comments', 'raveen'),
                    'views' => esc_html__('Views', 'raveen'),
                    'reading-time' => esc_html__('Reading Time', 'raveen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'date-updated' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                )
            ),


            array(
                'id'       => 'subtitle-67786',
                'required' => array( 'single-layout', '=', '4' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 4 Settings', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-layout-4-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-layout', '=', '4' ),
                'title'    => esc_html__('Post Meta', 'raveen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'raveen'),
                    'author-avatar' => esc_html__('Author Avatar', 'raveen'),
                    'date' => esc_html__('Date', 'raveen'),
                    'date-updated' => esc_html__('Updated Date', 'raveen'),
                    'category' => esc_html__('Category', 'raveen'),
                    'comments' => esc_html__('Comments', 'raveen'),
                    'views' => esc_html__('Views', 'raveen'),
                    'reading-time' => esc_html__('Reading Time', 'raveen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'date-updated' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                )
            ),



            array(
                'id'       => 'subtitle-66890',
                'required' => array( 'single-layout', '=', '5' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 5 Settings', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-layout-5-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-layout', '=', '5' ),
                'title'    => esc_html__('Post Meta', 'raveen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'raveen'),
                    'author-avatar' => esc_html__('Author Avatar', 'raveen'),
                    'date' => esc_html__('Date', 'raveen'),
                    'date-updated' => esc_html__('Updated Date', 'raveen'),
                    'category' => esc_html__('Category', 'raveen'),
                    'comments' => esc_html__('Comments', 'raveen'),
                    'views' => esc_html__('Views', 'raveen'),
                    'reading-time' => esc_html__('Reading Time', 'raveen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'date-updated' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                )
            ),



            array(
                'id'       => 'subtitle-621890',
                'required' => array( 'single-layout', '=', '6' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 6 Settings', 'raveen') . '</h4>',
            ),
            array(
                'id'       => 'single-layout-6-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-layout', '=', '6' ),
                'title'    => esc_html__('Post Meta', 'raveen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'raveen'),
                    'author-avatar' => esc_html__('Author Avatar', 'raveen'),
                    'date' => esc_html__('Date', 'raveen'),
                    'date-updated' => esc_html__('Updated Date', 'raveen'),
                    'category' => esc_html__('Category', 'raveen'),
                    'comments' => esc_html__('Comments', 'raveen'),
                    'views' => esc_html__('Views', 'raveen'),
                    'reading-time' => esc_html__('Reading Time', 'raveen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'date-updated' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                )
            ),

        )
    ) );
	
	
	
	
	Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Table Of Content', 'raveen'),
        'id'               => 'toc_section',
        'desc'             => esc_html__('Insert table of content for single post automatically or use Toc Elementor widget in the sidebar.', 'raveen'),
        'subsection'       => true,
        'icon'             => 'el el-list-alt',
        'fields'           => array(
            array(
                'id'       => 'toc',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Table Of Content', 'raveen'),
                'desc'     => esc_html__('Enable table of content.', 'raveen'),
            ),
            array(
                'id'       => 'toc-inline',
                'type'     => 'switch',
                'required' => array( 'toc', '=', '1' ),
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Insert Automatically', 'raveen'),
                'desc'     => esc_html__('Add table of content to single posts automatically.', 'raveen'),
            ),
            array(
                'id'       => 'toc-hierarchically',
                'type'     => 'switch',
                'required' => array( 'toc', '=', '1' ),
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Show hierarchically', 'raveen'),
                'desc'     => esc_html__('Show the table of content items hierarchically.', 'raveen'),
            ),
            array(
                'id'       => 'toc-counter',
                'type'     => 'switch',
                'required' => array( 'toc', '=', '1' ),
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Show Counter', 'raveen'),
                'desc'     => esc_html__('Show counter for table of content items.', 'raveen'),
            ),
            array(
                'id'       => 'toc-collapsable',
                'type'     => 'switch',
                'required' => array( 'toc', '=', '1' ),
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Collapsable', 'raveen'),
                'desc'     => esc_html__('Show a collapsable button to toggle the table of content items.', 'raveen'),
            ),
            array(
                'id'       => 'toc-disable-in-amp',
                'type'     => 'switch',
                'required' => array( 'toc', '=', '1' ),
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Disable In AMP', 'raveen'),
                'desc'     => esc_html__('Disable table of content in AMP version.', 'raveen'),
            ),
            array(
                'id'       => 'toc-title',
                'type'     => 'text',
                'required' => array( 'toc', '=', '1' ),
                'title'    => esc_html__('Title', 'raveen'),
                'default'  => esc_html__('Table Of Content', 'raveen'),
                'desc'     => esc_html__('Leave empty to hide title.', 'raveen'),
            ),
			array(
                'id'       => 'toc-exclude-class',
                'type'     => 'text',
                'required' => array( 'toc', '=', '1' ),
                'title'    => esc_html__('Exclude Classes', 'raveen'),
                'subtitle' => esc_html__('Exclude headings with these CSS classes.', 'raveen'),
                'desc'     => esc_html__('Separate classes with space.', 'raveen'),
            ),
            array(
                'id'       => 'toc-position',
                'type'     => 'select',
                'required' => array( 'toc', '=', '1' ),
                'title'    => esc_html__('Position', 'raveen'),
                'subtitle' => esc_html__('Select the table of content position.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'top'       => esc_html__('Top', 'raveen'),
                    'after-p'   => esc_html__('After the first paragraph', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'after-p',
            ),
            array(
                'id'       => 'toc-min-count',
                'type'     => 'select',
                'required' => array( 'toc', '=', '1' ),
                'title'    => esc_html__('Minimum Headings Count', 'raveen'),
                'subtitle' => esc_html__('Minimum headings count to show the table of content.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => '3',
            ),
            array(
                'id'       => 'toc-headings-support',
                'type'     => 'checkbox',
                'required' => array( 'toc', '=', '1' ),
                'title'    => esc_html__('Headings To Include', 'raveen'),
                'subtitle' => esc_html__('Select headings to include in table of content.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    '2' => 'H2',
                    '3' => 'H3',
                    '4' => 'H4',
                    '5' => 'H5',
                    '6' => 'H6',
                ),
                'default' => array(
                    '2' => '1',
                    '3' => '1',
                    '4' => '1',
                    '5' => '0',
                    '6' => '0',
                )
            ),


        )
    ) );
	
	
	Redux::set_section( $opt_name, array(
        'title'            => esc_html__('AMP', 'raveen'),
        'id'               => 'amp_section',
        'desc'     => sprintf(esc_html__('If you interested to have an AMP version for your site, please install the %1$s AMP Plugin %2$s. Select Reader Mode for template and Legacy theme and select Posts for Supported Templates.', 'raveen'), '<a target="_blank" href="https://wordpress.org/plugins/amp/"><b>', '</b></a>'),
        'subsection'       => true,
        'icon'             => 'el el-compass',
        'fields'           => array(
            array(
                'id'       => 'amp-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('AMP Logo', 'raveen'),
                'subtitle' => esc_html__('Select your logo for the header.', 'raveen'),
                'desc'     => '',
                'default'  => '',
            ),
            array(
                'id'       => 'amp-logo-width',
                'type'     => 'slider',
                'title'    => esc_html__('AMP Logo Width', 'raveen'),
                'subtitle' => esc_html__('Select the logo width.', 'raveen'),
                'desc'     => esc_html__('Default value: 100', 'raveen'),
                'default'  => 100,
                'min'       => 60,
                'step'      => 5,
                'max'       => 300,
            ),
            array(
                'id'       => 'amp-sidebar-search',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Sidebar Search', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'amp-back-top',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Footer Back to Top', 'raveen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'amp-copyright',
                'type'     => 'text',
                'title'    => esc_html__('Footer Copyright', 'raveen'),
                'default'  => esc_html__('Designed by Rivax Studio. All Rights Reserved.', 'raveen'),
            ),

        )
    ) );
	
	
	
	Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Autoload Next Post', 'raveen'),
        'id'               => 'autoload_next_post_section',
        'desc'             => esc_html__('Automatically load next posts settings', 'raveen'),
        'subsection'       => true,
        'icon'             => 'el el-refresh',
        'fields'           => array(
            array(
                'id'        => 'autoload-next-post',
                'type'      => 'switch',
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Autoload Next Post', 'raveen'),
                'subtitle'  => esc_html__('Automatically load next posts by scroll down.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'        => 'autoload-next-post-same-cat',
                'type'      => 'switch',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Same Category', 'raveen'),
                'subtitle'  => esc_html__('Only load posts which has same categories with the current post.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'        => 'autoload-next-post-content-top',
                'type'      => 'switch',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Load Top Content', 'raveen'),
                'subtitle'  => esc_html__('Load single top content if a template selected from the settings.', 'raveen'),
                'desc'      => esc_html__('Disabled by default for faster loading of the next post.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'        => 'autoload-next-post-content-bottom',
                'type'      => 'switch',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Load Bottom Content', 'raveen'),
                'subtitle'  => esc_html__('Load single bottom content if a template selected from the settings.', 'raveen'),
                'desc'      => esc_html__('Disabled by default for faster loading of the next post.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'        => 'autoload-next-post-share-box',
                'type'      => 'switch',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Load Share Box', 'raveen'),
                'subtitle'  => esc_html__('Load the share box if enabled from the settings.', 'raveen'),
                'desc'      => esc_html__('Disabled by default for faster loading of the next post.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'        => 'autoload-next-post-author-box',
                'type'      => 'switch',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Load Author Box', 'raveen'),
                'subtitle'  => esc_html__('Load the author box if enabled from the settings.', 'raveen'),
                'desc'      => esc_html__('Disabled by default for faster loading of the next post.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'        => 'autoload-next-post-comments',
                'type'      => 'switch',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'on'        => esc_html__('Enable', 'raveen'),
                'off'       => esc_html__('Disable', 'raveen'),
                'title'     => esc_html__('Load Comments Section', 'raveen'),
                'subtitle'  => esc_html__('Load the comments section.', 'raveen'),
                'desc'      => esc_html__('Disabled by default for faster loading of the next post.', 'raveen'),
                'default'   => false,
            ),
            array(
                'id'       => 'autoload-next-post-max',
                'type'     => 'select',
                'required' => array( 'autoload-next-post', '=', '1' ),
                'title'    => esc_html__('Maximum Posts To Load', 'raveen'),
                'subtitle' => esc_html__('Select how many posts can be load.', 'raveen'),
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => '5',
            ),

        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Blog Archive', 'raveen'),
        'id'               => 'blog_section',
        'desc'             => esc_html__('Blog settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-th-list',
        'fields'           => array(
            array(
                'id'       => 'archive-template',
                'type'     => 'select',
                'title'    => esc_html__('Blog Archive Template', 'raveen'),
                'subtitle' => esc_html__('Select template for blog archive.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

	        array(
		        'id'       => 'subtitle-6340587',
		        'type'     => 'raw',
		        'full_width'     => true,
		        'content'     => '<h4>' . esc_html__('Search Settings', 'raveen') . '</h4>',
	        ),
	        array(
		        'id'       => 'search-post-types',
		        'type'     => 'select',
		        'multi'    => true,
		        'title'    => esc_html__('Search Post Types', 'raveen'),
		        'subtitle' => esc_html__('Limit search for custom post types.', 'raveen'),
		        'data'  => 'post_types',
		        'desc'     => esc_html__('WordPress search in all post types by default.', 'raveen'),
				'args'  => array(
						'exclude_from_search'      => false,
					),
	        ),

        )
    ) );


  

    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Page 404', 'raveen'),
        'id'               => 'page404_section',
        'desc'             => esc_html__('Page 404 settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-ban-circle',
        'fields'           => array(
            array(
                'id'       => 'page-404-template',
                'type'     => 'select',
                'title'    => esc_html__('Page 404 Template', 'raveen'),
                'subtitle' => esc_html__('Select template for page 404.', 'raveen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'raveen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

        )
    ) );



    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Dark Mode', 'raveen'),
        'id'               => 'dark_mode_section',
        'desc'             => esc_html__('Dark Mode settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-idea-alt',
        'fields'           => array(
            array(
                'id'       => 'dark-mode',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Dark Mode', 'raveen'),
                'subtitle'     => esc_html__('Enable dark mode for your site.', 'raveen'),
            ),
			array(
                'id'       => 'default-dark-mode',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Default Dark Mode', 'raveen'),
                'subtitle'     => esc_html__('Load site in dark mode as default.', 'raveen'),
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'always-dark-mode',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Always Dark Mode', 'raveen'),
                'subtitle'     => esc_html__('Always load site in dark style and disable the dark mode switcher.', 'raveen'),
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'accent-color-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Accent Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'second-color-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Second Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'body-bg-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Body Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'site-bg-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Site Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'body-color-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Body Text Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'heading-color-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Headings Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'single-category-bg-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Category Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'single-category-bg-hover-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Category Background Hover', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),
            array(
                'id'       => 'button-bg-hover-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Button Background Hover', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'dark-mode', '=', '1' ),
            ),

        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Privacy Notice', 'raveen'),
        'id'               => 'privacy_notice_section',
        'desc'             => esc_html__('Privacy notice settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-bullhorn',
        'fields'           => array(
            array(
                'id'       => 'privacy-notice',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Privacy Notice', 'raveen'),
                'subtitle'     => esc_html__('Show privacy notice popup.', 'raveen'),
                'default'  => false,
            ),
            array(
                'id'       => 'privacy-text',
                'type'     => 'textarea',
                'title'    => esc_html__('Privacy Notice Text', 'raveen'),
                'subtitle' => esc_html__('Input your privacy or cookie notice text, HTML allowed.', 'raveen'),
                'desc'     => '',
                'default'  => html_entity_decode( esc_html__( 'Our site uses cookies. By using this site, you agree to the <a href="#">Privacy Policy</a> and <a href="#">Terms of Use</a>.', 'raveen' ) ),
                'required' => array( 'privacy-notice', '=', '1' ),
            ),
            array(
                'id'       => 'privacy-btn-text',
                'type'     => 'text',
                'title'    => esc_html__('Button Text', 'raveen'),
                'subtitle' => '',
                'default' => esc_html__('Accept', 'raveen'),
                'required' => array( 'privacy-notice', '=', '1' ),
            ),
            array(
                'id'       => 'privacy-position',
                'type'     => 'select',
                'title'    => esc_html__('Privacy Notice Position', 'raveen'),
                'subtitle' => esc_html__('Select position for privacy notice bar.', 'raveen'),
                'desc'     => '',
                'options'  => array(
                    'bottom-left' => esc_html__('Bottom Left', 'raveen'),
                    'bottom-center' => esc_html__('Bottom Center', 'raveen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'bottom-left',
                'required' => array( 'privacy-notice', '=', '1' ),
            ),
            array(
                'id'       => 'privacy-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Color', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'privacy-notice', '=', '1' ),
            ),
            array(
                'id'       => 'privacy-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Background', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'privacy-notice', '=', '1' ),
            ),
            array(
                'id'       => 'privacy-color-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Color - Dark Mode', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'privacy-notice', '=', '1' ),
            ),
            array(
                'id'       => 'privacy-bg-dark',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Background - Dark Mode', 'raveen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
                'required' => array( 'privacy-notice', '=', '1' ),
            ),

        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Breadcrumb', 'raveen'),
        'id'               => 'breadcrumb_section',
        'desc'             => esc_html__('Breadcrumb Bar settings', 'raveen'),
        'subsection'       => false,
        'icon'             => 'el el-bold',
        'fields'           => array(
            array(
                'id'       => 'breadcrumb',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Breadcrumb', 'raveen'),
                'subtitle'     => esc_html__('Show breadcrumb bar.', 'raveen'),
                'default'  => false,
            ),
            array(
                'id'       => 'breadcrumb-schema',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Breadcrumb Schema', 'raveen'),
                'subtitle'     => esc_html__('Output breadcrumb structure data.', 'raveen'),
                'default'  => false,
                'required' => array( 'breadcrumb', '=', '1' ),
            ),

        )
    ) );


	Redux::set_section( $opt_name, array(
		'title'            => esc_html__('Credentials', 'raveen'),
		'id'               => 'credentials_section',
		'desc'             => esc_html__('Credentials settings', 'raveen'),
		'subsection'       => false,
		'icon'             => 'el el-globe',
		'fields'           => array(
			array(
				'id'       => 'mailchimp-api-key',
				'type'     => 'text',
				'title'    => esc_html__('Mailchimp Api Key', 'raveen'),
				'desc'     => sprintf(esc_html__('The API key for connecting with your Mailchimp account. %1$s Get your API key here. %2$s', 'raveen'), '<a target="_blank" href="https://admin.mailchimp.com/account/api"><b>', '</b></a>'),
			),
			array(
				'id'       => 'mailchimp-double-opt-in',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Enable Mailchimp Double Opt In?', 'raveen'),
			),

		)
	) );


	Redux::set_section( $opt_name, array(
		'title'            => esc_html__('Performance', 'raveen'),
		'id'               => 'performance_section',
		'desc'             => esc_html__('Performance settings', 'raveen'),
		'subsection'       => false,
		'icon'             => 'el el-broom',
		'fields'           => array(
			array(
				'id'       => 'disable-elementor-google-font',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Disable Load Elementor Google Font', 'raveen'),
				'desc'    => esc_html__('If you don\'t use google fonts from the elementor, enable this option to prevent loading unused google fonts.', 'raveen'),
			),
			array(
				'id'       => 'disable-emojis',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Disable Emojis', 'raveen'),
				'desc'    => esc_html__('If you don\'t use emojis, enable this option to disable emojis.', 'raveen'),
			),
			array(
				'id'       => 'disable-extendify',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Disable Extendify Gutenberg Assets', 'raveen'),
				'desc'    => esc_html__('If you don\'t use Extendify templates in gutenberg (from Redux Framework), enable this option to disable its assets.', 'raveen'),
			),
			array(
				'id'       => 'disable-woocommerce-assets-out-of-shop',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Disable Woocommerce Assets out Of Shop', 'raveen'),
				'desc'    => esc_html__('By default woocommerce css/js load on entire site. Enable this option to load them just on woocommerce pages.', 'raveen'),
			),
            array(
                'id'       => 'disable-woocommerce-blocks-assets',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'    => esc_html__('Disable Woocommerce Blocks Assets', 'raveen'),
                'desc'    => esc_html__('Disable Woocommerce gutenberg blocks assets.', 'raveen'),
            ),
			array(
				'id'       => 'disable-gutenberg-assets',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Disable Gutenberg Assets Out of Posts', 'raveen'),
				'desc'    => esc_html__('By default gutenberg css load on entire site. Enable this option to disable load them from homepage, category & tag archives and pages build with Elementor.', 'raveen'),
			),
			array(
				'id'       => 'disable-jquery-migrate',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'raveen'),
				'off'     => esc_html__('Disable', 'raveen'),
				'title'    => esc_html__('Disable Jquery Migrate', 'raveen'),
				'desc'    => esc_html__('By default Wordpress load Jquery Migrate. Enable this option to disable load it.', 'raveen'),
			),
            array(
                'id'      => 'disable-xmlrpc',
                'type'    => 'switch',
                'on'      => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'   => esc_html__('Disable XML-RPC + Pingback', 'raveen'),
                'desc'    => esc_html__('Disable support for third-party application access.', 'raveen'),
            ),
            array(
                'id'      => 'disable-rsdlink',
                'type'    => 'switch',
                'on'      => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'   => esc_html__('Disable RSD', 'raveen'),
                'desc'    => esc_html__('Disable the Really Simple Discovery (RSD) tag. If you edit your site from your browser then you do not need it.', 'raveen'),
            ),
            array(
                'id'      => 'disable-shortlink',
                'type'    => 'switch',
                'on'      => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'   => esc_html__('Disable Short Link', 'raveen'),
                'desc'    => esc_html__('Disable the Short Link from the head.', 'raveen'),
            ),
            array(
                'id'      => 'disable-rssfeeds',
                'type'    => 'switch',
                'on'      => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'   => esc_html__('Disable RSS Feeds', 'raveen'),
                'desc'    => esc_html__('Disable the RSS feed links and disable it.', 'raveen'),
            ),
            array(
                'id'      => 'disable-generator-tag',
                'type'    => 'switch',
                'on'      => esc_html__('Enable', 'raveen'),
                'off'     => esc_html__('Disable', 'raveen'),
                'title'   => esc_html__('Disable Generator Tag', 'raveen'),
                'desc'    => esc_html__('Disable the generator tag.', 'raveen'),
            ),

		)
	) );
 


}