<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Search_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-search';
    }

    public function get_title() {
        return esc_html__('Search', 'raveen');
    }

    public function get_icon() {
        return 'eicon-search';
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
            'section_settings',
            [
                'label' => esc_html__('Settings', 'raveen'),
            ]
        );

        $this->add_control(
            'search_type',
            [
                'label' => esc_html__( 'Search Type', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'popup',
                'options' => [
                    'popup'  => esc_html__( 'Popup', 'raveen' ),
                    'inline' => esc_html__( 'Inline', 'raveen' ),
                ],
            ]
        );

        $this->add_control(
            'inline_show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'raveen' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'raveen' ),
                'label_off' => esc_html__( 'No', 'raveen' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['search_type' => 'inline'],
            ]
        );

        $this->add_control(
            'inline_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'condition' => ['search_type' => 'inline'],
            ]
        );

        $this->add_responsive_control(
            'text_align', [
                'label' => esc_html__('Alignment', 'raveen'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [

                    'left' => [
                        'title' => esc_html__('Left', 'raveen'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'raveen'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'raveen'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .popup-search-opener-wrapper' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .inline-search-form-wrapper' => 'text-align: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Button', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .popup-search-opener' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Button Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .popup-search-opener' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_font_size',
            [
                'label' => esc_html__('Button Font Size', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 70,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .submit' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .popup-search-opener' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} .popup-search-opener, {{WRAPPER}} .inline-search-form .submit',
            ]
        );

        $this->add_control(
            'button_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-opener, body.dark-mode {{WRAPPER}} .inline-search-form .submit',
                ],
                'condition' => [
                    'border_border!' => ''
                ]
            ]
        );


        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .submit, {{WRAPPER}} .popup-search-opener' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('search_color_tabs');
        # Normal State Tab
        $this->start_controls_tab(
            'search_color_tab_normal_state',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]
        );

        $this->add_control(
            'button_bg',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-opener, {{WRAPPER}} .inline-search-form .submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-opener, body.dark-mode {{WRAPPER}} .inline-search-form .submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-opener, {{WRAPPER}} .inline-search-form .submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-opener, body.dark-mode {{WRAPPER}} .inline-search-form .submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} .inline-search-form .submit, {{WRAPPER}} .popup-search-opener',
            ]
        );

        $this->end_controls_tab();

        # Hover State Tab
        $this->start_controls_tab(
            'search_color_tab_hover_state',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]
        );

        $this->add_control(
            'button_bg_hover',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-opener:hover, {{WRAPPER}} .inline-search-form .submit:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_hover_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-opener:hover, body.dark-mode {{WRAPPER}} .inline-search-form .submit:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-opener:hover, {{WRAPPER}} .inline-search-form .submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-opener:hover, body.dark-mode {{WRAPPER}} .inline-search-form .submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border_color_hover',
            [
                'label'     => esc_html__( 'Border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-opener:hover, {{WRAPPER}} .inline-search-form .submit:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'border_border!' => ''
                ]
            ]
        );

        $this->add_control(
            'border_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-opener:hover, body.dark-mode {{WRAPPER}} .inline-search-form .submit:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} .inline-search-form .submit:hover, {{WRAPPER}} .popup-search-opener:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section(
            'section_inline_form_style',
            [
                'label' => esc_html__('Form', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['search_type' => 'inline'],
            ]
        );

        $this->add_control(
            'inline_form_width',
            [
                'label' => esc_html__('Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'inline_input_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'inline_form_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} .inline-search-form',
            ]
        );

        $this->add_control(
            'inline_form_border_color_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .inline-search-form' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'inline_form_border_border!' => ''
                ]
            ]
        );

        $this->add_control(
            'inline_form_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form, {{WRAPPER}} .inline-search-form .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'inline_form_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .search-field' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'inline_form_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .inline-search-form .search-field' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'inline_form_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .search-field::-webkit-input-placeholder, {{WRAPPER}} .inline-search-form .search-field::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_field_bg',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inline-search-form .search-field' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_field_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .inline-search-form .search-field' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inline_form_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} .inline-search-form .search-field',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'inline_form_search_field_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .inline-search-form .search-field',
            ]);

        $this->end_controls_section();


        $this->start_controls_section(
            'section_popup_container_style',
            [
                'label' => esc_html__('Popup Container', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['search_type' => 'popup'],
            ]
        );


        $this->add_control(
            'popup_container_form_width',
            [
                'label' => esc_html__('Form Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'popup_container_form_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'popup_container_form_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} .popup-search-form .search-field',
            ]
        );

        $this->add_control(
            'popup_container_form_border_color_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-form .search-field' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'popup_container_form_border_border!' => ''
                ]
            ]
        );

        $this->add_control(
            'popup_container_form_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'popup_container_input_color',
            [
                'label' => esc_html__('Form Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form .search-field' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_input_color_dark_mode',
            [
                'label' => esc_html__('Form Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-form .search-field' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form .search-field::-webkit-input-placeholder, {{WRAPPER}} .popup-search-form .search-field::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_placeholder_color_dark_mode',
            [
                'label' => esc_html__('Placeholder Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-form .search-field::-webkit-input-placeholder, body.dark-mode {{WRAPPER}} .popup-search-form .search-field::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_input_bg',
            [
                'label' => esc_html__('Form Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form .search-field' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_input_bg_dark_mode',
            [
                'label' => esc_html__('Form Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-form .search-field' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_form_icon_color',
            [
                'label' => esc_html__('Icon Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-search-form .submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popup_container_form_icon_color_dark_mode',
            [
                'label' => esc_html__('Icon Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .popup-search-form .submit' => 'color: {{VALUE}}',
                ],
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