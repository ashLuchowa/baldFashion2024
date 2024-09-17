<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Navigation_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-navigation';
    }

    public function get_title() {
        return esc_html__('Navigation', 'raveen');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    /**
     * Get all registered menus.
     *
     * @return array of menus.
     */
    private function get_menus()
    {
        $menus   = wp_get_nav_menus();
        $options = [];

        if (empty($menus)) {
            return $options;
        }

        foreach ($menus as $menu) {
            $options[$menu->term_id] = $menu->name;
        }

        return $options;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('settings', 'raveen'),
            ]
        );

        $menus = $this->get_menus();

        if ($menus) {
            $this->add_control(
                'menu',
                [
                    'label'       => esc_html__('Select Menu', 'raveen'),
                    'description' => sprintf(esc_html__('Go to the %s Menu screen %s to manage your menus.', 'raveen'), '<a href="' . admin_url('nav-menus.php') . '" target="_blank">', '</a>'),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options'     => $menus,
                    'default'     => array_keys($menus)[0],
                ]
            );
        } else {
            $this->add_control(
                'menu_not_exist',
                [
                    'type'      => Controls_Manager::RAW_HTML,
                    'raw'       => sprintf(esc_html__('There are no menus in your site. Go to the %s Menu screen %s to create one.', 'raveen'), '<a href="' . admin_url('nav-menus.php') . '" target="_blank">', '</a>'),
                ]
            );
        }

        $this->add_control(
            'menu_type',
            [
                'label' => esc_html__( 'Menu Type', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal'  => esc_html__( 'Horizontal', 'raveen' ),
                    'vertical' => esc_html__( 'Vertical', 'raveen' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'H_menu_align', [
                'label' => esc_html__('Alignment', 'raveen'),
                'condition' => ['menu_type' => 'horizontal'],
                'type' => Controls_Manager::CHOOSE,
                'options' => [

                    'flex-start' => [
                        'title' => esc_html__('Start', 'raveen'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'raveen'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('End', 'raveen'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_top_level_style',
            [
                'label' => esc_html__('Top Level', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'label' => esc_html__( 'Typography', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-header-nav > li.menu-item > a, {{WRAPPER}} .rivax-header-v-nav > li.menu-item > a',
            ]
        );

        $this->start_controls_tabs('menu_color_tabs');
        # Normal State Tab
        $this->start_controls_tab(
            'menu_color_tab_normal_state',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]
        );

        $this->add_control(
            'menu_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav > li.menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rivax-header-v-nav > li.menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav > li.menu-item > a' => 'color: {{VALUE}}',
                    'body.dark-mode {{WRAPPER}} .rivax-header-v-nav > li.menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        # Hover State Tab
        $this->start_controls_tab(
            'menu_color_tab_hover_state',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]
        );

        $this->add_control(
            'menu_color_hover',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav > li.menu-item > a:hover, {{WRAPPER}} .rivax-header-nav > li.current-menu-item > a, {{WRAPPER}} .rivax-header-nav > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rivax-header-v-nav > li.menu-item > a:hover, {{WRAPPER}} .rivax-header-v-nav > li.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_color_hover_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav > li.menu-item > a:hover, body.dark-mode {{WRAPPER}} .rivax-header-nav > li.current-menu-item > a, body.dark-mode {{WRAPPER}} .rivax-header-nav > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                    'body.dark-mode {{WRAPPER}} .rivax-header-v-nav > li.menu-item > a:hover, body.dark-mode {{WRAPPER}} .rivax-header-v-nav > li.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'h_menu_hover_shape',
            [
                'label' => esc_html__( 'Hover Shape', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'condition' => ['menu_type' => 'horizontal'],
                'options' => [
                    'hover-style-0'  => esc_html__( 'Style Default', 'raveen' ),
                    'hover-style-1'  => esc_html__( 'Style 1', 'raveen' ),
                    'hover-style-2'  => esc_html__( 'Style 2', 'raveen' ),
                    'hover-style-3'  => esc_html__( 'Style 3', 'raveen' ),
                    'hover-style-4'  => esc_html__( 'Style 4', 'raveen' ),
                    'hover-style-5'  => esc_html__( 'Style 5', 'raveen' ),
                    'hover-style-6'  => esc_html__( 'Style 6', 'raveen' ),
                ],
            ]
        );

        $this->add_control(
            'h_menu_hover_shape_color',
            [
                'label' => esc_html__('Shape Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['menu_type' => 'horizontal'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav > li > a::before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rivax-header-nav-wrapper.hover-style-4 > ul > li > a:hover, {{WRAPPER}} .rivax-header-nav-wrapper.hover-style-4 > ul > li.current-menu-item > a, {{WRAPPER}} .rivax-header-nav-wrapper.hover-style-4 > ul > li.current-menu-ancestor > a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'h_menu_hover_shape_color_dark_mode',
            [
                'label' => esc_html__('Shape Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['menu_type' => 'horizontal'],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav > li > a::before' => 'background: {{VALUE}}',
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav-wrapper.hover-style-4 > ul > li > a:hover, body.dark-mode {{WRAPPER}} .rivax-header-nav-wrapper.hover-style-4 > ul > li.current-menu-item > a, body.dark-mode {{WRAPPER}} .rivax-header-nav-wrapper.hover-style-4 > ul > li.current-menu-ancestor > a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section(
            'section_submenu_style',
            [
                'label' => esc_html__('Submenu', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_typography',
                'label' => esc_html__( 'Typography', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a, {{WRAPPER}} .rivax-header-v-nav .sub-menu li.menu-item > a',
            ]
        );

        $this->add_control(
            'h_submenu_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => ['menu_type' => 'horizontal'],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'h_submenu_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'condition' => ['menu_type' => 'horizontal'],
                'selector' => '{{WRAPPER}} .rivax-header-nav .sub-menu',
            ]
        );

        $this->start_controls_tabs( 'tabs_h_submenu' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_h_submenu_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'h_submenu_bg',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-header-nav .sub-menu',
                'condition' => ['menu_type' => 'horizontal'],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'h_submenu_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'condition' => ['menu_type' => 'horizontal'],
                'selector' => '{{WRAPPER}} .rivax-header-nav .sub-menu',
            ]
        );

        $this->add_control(
            'submenu_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rivax-header-v-nav .sub-menu li.menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'submenu_color_hover',
            [
                'label' => esc_html__('Color Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a:hover, {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-item > a, {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rivax-header-v-nav .sub-menu li.menu-item > a:hover, {{WRAPPER}} .rivax-header-v-nav .sub-menu li.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_h_submenu_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'h_submenu_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu',
                'condition' => ['menu_type' => 'horizontal'],
            ]
        );

        $this->add_control('h_submenu_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'h_submenu_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'submenu_color_dark_mode',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a' => 'color: {{VALUE}}',
                    'body.dark-mode {{WRAPPER}} .rivax-header-v-nav .sub-menu li.menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'submenu_color_hover_dark_mode',
            [
                'label' => esc_html__('Color Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a:hover, body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-item > a, body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                    'body.dark-mode {{WRAPPER}} .rivax-header-v-nav .sub-menu li.menu-item > a:hover, body.dark-mode {{WRAPPER}} .rivax-header-v-nav .sub-menu li.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );
		
		$this->add_control(
            'submenu_bg_hover',
            [
                'label' => esc_html__('Submenu Item Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a:hover, {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-item > a, {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-ancestor > a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'submenu_bg_hover_dark_mode',
            [
                'label' => esc_html__('Submenu Item Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.menu-item > a:hover, body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-item > a, body.dark-mode {{WRAPPER}} .rivax-header-nav .sub-menu li.current-menu-ancestor > a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }


}