<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Elementor_Custom_Settings {

    /**
     * A reference to an instance of this class.
     */
    private static $instance = null;


    /**
     * Load Construct
     *
     */
    public function __construct(){

        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'container_sticky_settings' ) );
        add_action( 'elementor/frontend/container/before_render',  array( $this, 'container_before_render' ) );

        add_action( 'elementor/element/common/_section_border/after_section_end', array( $this, 'widgets_common_settings' ) );

        add_action( 'elementor/element/container/section_shape_divider/after_section_end', array( $this, 'container_dark_mode' ) );
        add_action( 'elementor/element/heading/section_title_style/after_section_end', array( $this, 'heading_widget_dark_mode' ) );
        add_action( 'elementor/element/image-box/section_style_content/after_section_end', array( $this, 'image_box_widget_dark_mode' ) );
        add_action( 'elementor/element/icon/section_style_icon/after_section_end', array( $this, 'icon_widget_dark_mode' ) );
        add_action( 'elementor/element/icon-box/section_style_content/after_section_end', array( $this, 'icon_box_widget_dark_mode' ) );
        add_action( 'elementor/element/button/section_style/after_section_end', array( $this, 'button_widget_dark_mode' ) );
        add_action( 'elementor/element/icon-list/section_text_style/after_section_end', array( $this, 'icon_list_widget_dark_mode' ) );
        add_action( 'elementor/element/counter/section_title/after_section_end', array( $this, 'counter_widget_dark_mode' ) );
		add_action( 'elementor/element/divider/section_icon_style/after_section_end', array( $this, 'divider_widget_dark_mode' ) );

    }


    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance() {
        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function container_sticky_settings ( $obj ) {

        // Sticky Column
        $obj->start_controls_section(
            'rivax_sticky_column_sticky_section',
            array(
                'label' => esc_html__( 'Rivax Sticky', 'raveen' ),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            )
        );

        $obj->add_control(
            'rivax_sticky_column_sticky_enable',
            array(
                'label'        => esc_html__( 'Sticky Column', 'raveen' ),
                'type'         => Controls_Manager::SWITCHER,
            )
        );

        $obj->end_controls_section();

    }


    public function container_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'section_background_heading_dark_mode',
            [
                'label'     => esc_html__( 'Background', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $obj->start_controls_tabs( 'tabs_bg_dark_mode' );

        /**
         * Normal.
         */
        $obj->start_controls_tab(
            'tab_background_normal_dark_mode',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $obj->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_dark_mode',
                'selector' => 'body.dark-mode {{WRAPPER}}',
            ]
        );

        $obj->add_control(
            'border_color_dark_mode',
            [
                'label'     => esc_html__( 'border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_tab();

        /**
         * Hover.
         */
        $obj->start_controls_tab(
            'tab_background_hover_dark_mode',
            [
                'label' => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $obj->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_dark_mode',
                'selector' => 'body.dark-mode {{WRAPPER}}:hover',
            ]
        );

        $obj->add_control(
            'border_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Border Color Hover', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_tab();

        $obj->end_controls_tabs();


        $obj->add_control(
            'section_background_overlay_heading_dark_mode',
            [
                'label'     => esc_html__( 'Background Overlay', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $obj->start_controls_tabs( 'tabs_background_overlay_dark_mode' );

        /**
         * Normal.
         */
        $obj->start_controls_tab(
            'tab_background_overlay_dark_mode',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $background_overlay_selector = 'body.dark-mode {{WRAPPER}}::before';

        $obj->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay_dark_mode',
                'selector' => $background_overlay_selector,
                'fields_options' => [
                    'background' => [
                        'selectors' => [
                            // Hack to set the `::before` content in order to render it only when there is a background overlay.
                            $background_overlay_selector => '--background-overlay: \'\';',
                        ],
                    ],
                ],
            ]
        );


        $obj->end_controls_tab();

        /**
         * Hover.
         */
        $obj->start_controls_tab(
            'tab_background_overlay_hover_dark_mode',
            [
                'label' => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $background_overlay_hover_selector = 'body.dark-mode {{WRAPPER}}:hover::before';

        $obj->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay_hover_dark_mode',
                'selector' => $background_overlay_hover_selector,
                'fields_options' => [
                    'background' => [
                        'selectors' => [
                            // Hack to set the `::before` content in order to render it only when there is a background overlay.
                            $background_overlay_hover_selector => '--background-overlay: \'\';',
                        ],
                    ],
                ],
            ]
        );

        $obj->end_controls_tab();

        $obj->end_controls_tabs();


        $obj->add_control(
            'shape_dark_mode_heading',
            [
                'label'     => esc_html__( 'Shape Divider', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $obj->add_control(
            'shape_top_color_dark_mode',
            [
                'label'     => esc_html__( 'Top Shape', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} > .e-con-inner > .elementor-shape-top .elementor-shape-fill' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'shape_bottom_color_dark_mode',
            [
                'label'     => esc_html__( 'Bottom Shape', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} > .e-con-inner > .elementor-shape-bottom .elementor-shape-fill' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }

    /**
     * Before container render callback.
     *
     * @param object $element
     *
     * @return void
     */
    public function container_before_render( $element ) {
        $data     = $element->get_data();
        $settings = $data['settings'];


        if ( isset( $settings['rivax_sticky_column_sticky_enable'] ) ) {

            if ( filter_var( $settings['rivax_sticky_column_sticky_enable'], FILTER_VALIDATE_BOOLEAN ) ) {


                $element->add_render_attribute( '_wrapper', array(
                    'class' => 'rivax-sticky-column',
                ) );
            }

        }
    }


    public function heading_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'color_dark_mode',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }

    public function image_box_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'title_color_dark_mode',
            [
                'label'     => esc_html__( 'Title Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-image-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'description_color_dark_mode',
            [
                'label'     => esc_html__( 'Description Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-image-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }


	public function button_widget_dark_mode ( $obj ) {

		$obj->start_controls_section(
			'section_rivax_dark_mode',
			[
				'label' => esc_html__( 'Dark Mode', 'raveen' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$obj->start_controls_tabs( 'tabs_button_style_dark_mode');

		$obj->start_controls_tab(
			'tab_button_normal_dark_mode',
			[
				'label' => esc_html__( 'Normal', 'raveen' ),
			]
		);

		$obj->add_control(
			'button_text_color_dark_mode',
			[
				'label' => esc_html__( 'Text Color', 'raveen' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body.dark-mode {{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_dark_mode',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => 'body.dark-mode {{WRAPPER}} .elementor-button',
			]
		);

		$obj->add_control(
			'button_border_color_dark_mode',
			[
				'label' => esc_html__( 'Border Color', 'raveen' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'body.dark-mode {{WRAPPER}} .elementor-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'tab_button_hover_dark_mode',
			[
				'label' => esc_html__( 'Hover', 'raveen' ),
			]
		);

		$obj->add_control(
			'hover_color_dark_mode',
			[
				'label' => esc_html__( 'Text Color', 'raveen' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body.dark-mode {{WRAPPER}} .elementor-button:hover, body.dark-mode {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
					'body.dark-mode {{WRAPPER}} .elementor-button:hover svg, body.dark-mode {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover_dark_mode',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => 'body.dark-mode {{WRAPPER}} .elementor-button:hover, body.dark-mode {{WRAPPER}} .elementor-button:focus',
			]
		);

		$obj->add_control(
			'button_hover_border_color_dark_mode',
			[
				'label' => esc_html__( 'Border Color', 'raveen' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'body.dark-mode {{WRAPPER}} .elementor-button:hover, body.dark-mode {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->end_controls_section();


	}


    public function icon_box_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'primary_color_dark_mode',
            [
                'label' => esc_html__( 'Icon Primary Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon, body.dark-mode {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'secondary_color_dark_mode',
            [
                'label' => esc_html__( 'Icon Secondary Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'title_color_dark_mode',
            [
                'label'     => esc_html__( 'Title Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'description_color_dark_mode',
            [
                'label'     => esc_html__( 'Description Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }

    public function icon_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'primary_color_dark_mode',
            [
                'label' => esc_html__( 'Primary Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon, body.dark-mode {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon, body.dark-mode {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'secondary_color_dark_mode',
            [
                'label' => esc_html__( 'Secondary Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }

    public function icon_list_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'divider_color_dark_mode',
            [
                'label' => esc_html__( 'Divider Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $obj->add_control(
            'icon_color_dark_mode',
            [
                'label' => esc_html__( 'Icon Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'icon_color_hover_dark_mode',
            [
                'label' => esc_html__( 'Icon Hover', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'text_color_dark_mode',
            [
                'label' => esc_html__( 'Text Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'text_color_hover_dark_mode',
            [
                'label' => esc_html__( 'Text Hover', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }

    public function counter_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'number_color_dark_mode',
            [
                'label' => esc_html__( 'Number Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-counter-number-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->add_control(
            'title_color_dark_mode',
            [
                'label' => esc_html__( 'Title Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }
	
	
	public function divider_widget_dark_mode ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $obj->add_control(
            'color_dark_mode',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'render_type' => 'template',
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}' => '--divider-color: {{VALUE}}',
                ],
            ]
        );

        $obj->add_control(
            'text_color_dark_mode',
            [
                'label' => esc_html__( 'Text Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .elementor-divider__text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'look' => 'line_text',
                ],
            ]
        );

        $obj->add_control(
            'primary_color_dark_mode',
            [
                'label' => esc_html__( 'Icon Primary Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'look' => 'line_icon',
                ],
            ]
        );

        $obj->add_control(
            'secondary_color_dark_mode',
            [
                'label' => esc_html__( 'Icon Secondary Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'look' => 'line_icon',
                    'icon_view!' => 'default',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_section();


    }
	

    public function widgets_common_settings ( $obj ) {

        $obj->start_controls_section(
            'section_rivax_common_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $obj->start_controls_tabs( '_tabs_bg_dark_mode' );

        $obj->start_controls_tab(
            '_tab_background_normal_dark_mode',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $obj->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} > .elementor-widget-container',
            ]
        );

        $obj->add_control(
            '_border_dark_mode',
            [
                'label' => esc_html__( 'Border Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} > .elementor-widget-container' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_tab();

        $obj->start_controls_tab(
            '_tab_background_hover_dark_mode',
            [
                'label' => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $obj->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_background_hover_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}}:hover .elementor-widget-container',
            ]
        );

        $obj->add_control(
            '_border_hover_dark_mode',
            [
                'label' => esc_html__( 'Border Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}}:hover > .elementor-widget-container' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $obj->end_controls_tab();
        $obj->end_controls_tabs();

        $obj->end_controls_section();


    }

}

Rivax_Elementor_Custom_Settings::get_instance();
