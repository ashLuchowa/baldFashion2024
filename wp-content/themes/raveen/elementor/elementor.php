<?php
namespace RivaxStudio;

use RivaxStudio\Controls\Ajax_Select2;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

final class Rivax_Elementor {

    public static $_instance;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     */
    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Load Construct
     *
     */
    public function __construct(){

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }

        // Controls
        require_once RIVAX_THEME_DIR . '/elementor/controls/ajax-select2.php';


        // Traits
        require_once RIVAX_THEME_DIR . '/elementor/traits/group-control-query.php';
        require_once RIVAX_THEME_DIR . '/elementor/traits/global-widget-controls.php';
        require_once RIVAX_THEME_DIR . '/elementor/traits/post-skin-base.php';


        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));
        add_action('elementor/controls/register', array( $this, 'register_controls' ));
        add_action('elementor/widgets/register', array($this, 'register_widgets'));

    }


    /**
     * Add Elementor widget categories
     * @param $elements_manager
     */
    function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'rivax-elements',
            [
                'title' => esc_html__( 'Rivax Elements', 'raveen' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }


    /**
     * Widgets name
     */
     function get_widgets_name () {

        $widgets = [
            'site-logo',
            'offcanvas',
            'search',
            'current-date',
			'category-box',
            'navigation',
            'tag-cloud',
            'divider-heading',
			'fancy-text',
            'post-kenzo',
            'post-elastic',
            'post-modern',
            'social-icons',
            'mailchimp',
            'instagram',
			'table-of-content',
			'contact-form',
        ];

        return $widgets;
    }


    /**
     * Make Class name of widget
     * @param $widget_name
     * @return string
     */
    public static function make_classname($widget_name) {
        $class_name = str_replace('-', ' ', $widget_name);
        $class_name = ucwords($class_name);
        $class_name = str_replace(' ', '_', $class_name);
        $class_name = 'Rivax_' . $class_name . '_Widget';

        return $class_name;
    }


    /**
     * Init Widgets
     */
    function register_widgets(){

        foreach($this->get_widgets_name() as $widget_name) {

            $file = RIVAX_THEME_DIR . '/elementor/widgets/' . $widget_name . '/' . $widget_name . '.php';

            if(file_exists($file)) {
                require_once $file;

                $class_name = '\Elementor\\' . self::make_classname($widget_name);

                if(class_exists($class_name)){
                    \Elementor\Plugin::instance()->widgets_manager->register( new $class_name() );
                }
            }
        }

    }


    /**
     * Init Controls
     */
    function register_controls(){

        $controls_manager = \Elementor\Plugin::$instance->controls_manager;
        $controls_manager->register( new Ajax_Select2() );

    }

}
Rivax_Elementor::get_instance();