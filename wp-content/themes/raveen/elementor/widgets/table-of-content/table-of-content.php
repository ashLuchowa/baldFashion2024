<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Table_Of_Content_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-table-of-content';
    }

    public function get_title() {
        return esc_html__('Table Of Content', 'raveen');
    }

    public function get_icon() {
        return 'eicon-editor-list-ol';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_toc',
            [
                'label' => esc_html__( 'Table Of Content', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'toc_settings_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => sprintf(esc_html__('You can manage this widget settings from the %s theme settings %s.', 'raveen'), '<a href="' . admin_url('admin.php?page=rivax-settings') . '" target="_blank">', '</a>'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        if(!rivax_get_option('toc')) {
            $this->add_control(
                'toc_not_enabled',
                [
                    'type'      => Controls_Manager::RAW_HTML,
                    'raw'       => esc_html__('Please enable the Table Of Content from the theme settings.', 'raveen'),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'toc_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => esc_html__('This widget only shows on the single post.', 'raveen'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_container_style',
            [
                'label' => esc_html__( 'Container', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_bg',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-toc-wrap',
            ]
        );

        $this->add_control(
            'heading_container_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-toc-wrap',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .rivax-toc-wrap',
            ]);

        $this->add_control('container_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'container_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-toc-wrap' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-toc-wrap',
            ]);

        $this->end_controls_section();



        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('title_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .toc-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .toc-header',
            ]
        );

        $this->add_control(
            'heading_title_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .toc-header',
            ]
        );

        $this->add_control('title_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .toc-header' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .toc-header' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .toc-header',
            ]);

        $this->add_control('title_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .toc-header' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .toc-header-title-wrap h3',
            ]);

        $this->add_control(
            'title_collapse_size',
            [
                'label'     => esc_html__( 'Collapse Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .toc-header-collapse' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_items_style',
            [
                'label' => esc_html__( 'Items', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('items_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'items_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .rivax-toc-anchor',
            ]);


        $this->start_controls_tabs('tabs_items_style');
        $this->start_controls_tab('tab_items_normal',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]);

        $this->add_control('items_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-anchor' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('items_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-toc-anchor' => 'color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_items_hover',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]);

        $this->add_control('items_color_hover',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-anchor:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('items_color_hover_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-toc-anchor:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section(
            'section_counter_style',
            [
                'label' => esc_html__( 'Counter', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('counter_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-items.toc-counter li:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_control('counter_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-items.toc-counter li:before' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('counter_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-toc-items.toc-counter li:before' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'counter_size',
            [
                'label'     => esc_html__( 'Counter Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-toc-items.toc-counter li:before' => 'font-size: {{SIZE}}px;',
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