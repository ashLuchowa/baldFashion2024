<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Site_Logo_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-site-logo';
    }

    public function get_title() {
        return esc_html__('Site Logo', 'raveen');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'raveen' ),
            ]
        );


        $this->start_controls_tabs( 'tabs_logos' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_logo_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'retina_image',
            [
                'label' => esc_html__( 'Retina Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'mobile_image',
            [
                'label' => esc_html__( 'Mobile Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_logo_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control(
            'image_dark',
            [
                'label' => esc_html__( 'Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'retina_image_dark',
            [
                'label' => esc_html__( 'Retina Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'mobile_image_dark',
            [
                'label' => esc_html__( 'Mobile Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        

        $this->add_control(
            'title_type',
            [
                'label' => esc_html__( 'Site Title', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'raveen' ),
                    'default' => esc_html__( 'Default', 'raveen' ),
                    'custom' => esc_html__( 'Custom', 'raveen' ),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'custom_title',
            [
                'label' => esc_html__( 'Title Text', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'My Custom Logo',
                'condition' => [
                    'title_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'description_type',
            [
                'label' => esc_html__( 'Tagline', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'raveen' ),
                    'default' => esc_html__( 'Default', 'raveen' ),
                    'custom' => esc_html__( 'Custom', 'raveen' ),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'custom_description',
            [
                'label' => esc_html__( 'Tagline Text', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Tagline',
                'condition' => [
                    'description_type' => 'custom',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'raveen' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'raveen' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'raveen' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'raveen' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label' => esc_html__( 'Logo URL', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'raveen' ),
                    'custom' => esc_html__( 'Custom', 'raveen' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'custom_url',
            [
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://www.your-link.com',
                'condition' => [
                    'url_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__( 'General', 'raveen' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'raveen' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'raveen' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'title_section',
            [
                'label' => esc_html__( 'Site Title', 'raveen' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rivax-logo-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_section',
            [
                'label' => esc_html__( 'Tagline', 'raveen' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .rivax-logo-description',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-logo',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .rivax-logo'
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}