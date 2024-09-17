<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Tag_Cloud_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-tag-cloud';
    }

    public function get_title() {
        return esc_html__('Tag cloud', 'raveen');
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__( 'Layout', 'raveen' ),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__( 'Columns', 'raveen' ),
                'type'           => Controls_Manager::SELECT,
                'default'        => 'auto',
                'options'        => [
                    'auto' => esc_html__( 'Auto', 'raveen' ),
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors_dictionary' => [
                    'auto' => 'display: flex;',
                    '1' => 'display: grid; grid-template-columns: repeat(1, 1fr);',
                    '2' => 'display: grid; grid-template-columns: repeat(2, 1fr);',
                    '3' => 'display: grid; grid-template-columns: repeat(3, 1fr);',
                    '4' => 'display: grid; grid-template-columns: repeat(4, 1fr);',
                    '5' => 'display: grid; grid-template-columns: repeat(5, 1fr);',
                    '6' => 'display: grid; grid-template-columns: repeat(6, 1fr);',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rivax-tag-cloud' => '{{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__( 'Row Gap', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_height',
            [
                'label'     => esc_html__( 'Item Height(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 30,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__( 'Alignment', 'raveen' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'raveen' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'raveen' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'raveen' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'space-between'  => [
                        'title' => esc_html__( 'justify', 'raveen' ),
                        'icon'  => 'eicon-text-align-justify',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'     => esc_html__( 'Show Count', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__( 'Query', 'raveen' ),
            ]
        );

        $this->add_control(
            'item_limit',
            [
                'label' => esc_html__('Item Limit', 'raveen'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label'   => esc_html__( 'Taxonomy', 'raveen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_tag',
                'options' => [
                    'post_tag'       => esc_html__( 'Tags', 'raveen' ),
                    'category'  => esc_html__('Categories', 'raveen'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'raveen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'name'       => esc_html__( 'Name', 'raveen' ),
                    'count'  => esc_html__('Post Count', 'raveen'),
                ],
            ]
        );



        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'raveen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'asc',
                'options' => [
                    'asc'  => esc_html__( 'ASC', 'raveen' ),
                    'desc' => esc_html__( 'DESC', 'raveen' ),
                ],
            ]
        );

        $this->add_control(
            'include',
            [
                'label'       => esc_html__( 'Include', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Tag ID: 12,3,1', 'raveen' ),
            ]
        );

        $this->add_control(
            'exclude',
            [
                'label'       => esc_html__( 'Exclude', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Tag ID: 12,3,1', 'raveen' ),
            ]
        );

        $this->add_control(
            'parent',
            [
                'label'       => esc_html__( 'Parent', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Tag ID: 12', 'raveen' ),
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_style_items',
            [
                'label' => esc_html__( 'Items', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_item_style' );

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'single_background',
            [
                'label'   => esc_html__( 'Single Background', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_background',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item',
                'exclude' => [ 'image' ],
                'condition' => [
                    'single_background' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'heading_item_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'single_background' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_bg_dark_mode',
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-item',
                'exclude' => [ 'image' ],
                'condition' => [
                    'single_background' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'multiple_background',
            [
                'label'       => esc_html__( 'Multiple Background', 'raveen' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => '#000000, #f5f5f5, #999999',
                'condition' => [
                    'single_background' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item',
            ]
        );

        $this->add_control('item_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-item' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_background_hover',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item:hover',
            ]
        );

        $this->add_control(
            'heading_item_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_background_hover_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-item:hover',
            ]
        );

        $this->add_control(
            'item_border_color_hover',
            [
                'label'     => esc_html__( 'Border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'item_border_border!' => ''
                ]
            ]
        );

        $this->add_control(
            'item_border_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-item:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'item_border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_category_name',
            [
                'label' => esc_html__( 'Name', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_name_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_name_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_name_color_hover',
            [
                'label'     => esc_html__( 'Hover Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item:hover .rivax-tag-cloud-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_name_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Hover Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-item:hover .rivax-tag-cloud-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_name_typography',
                'label'    => esc_html__( 'Typography', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-name',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_count',
            [
                'label' => esc_html__( 'Count', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'count_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'count_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'count_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typography',
                'label'    => esc_html__( 'Typography', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_responsive_control(
            'count_spacing',
            [
                'label'     => esc_html__( 'Spacing', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'margin-left: {{SIZE}}px;'
                ],
            ]
        );


        $this->start_controls_tabs( 'tabs_count' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_count_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'count_color_hover',
            [
                'label'     => esc_html__( 'Hover Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item:hover .rivax-tag-cloud-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'count_border',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );


        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_count_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control(
            'count_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'count_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Hover Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-item:hover .rivax-tag-cloud-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_control('count_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'count_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-tag-cloud-count' => 'border-color: {{VALUE}};',
                ],
            ]);



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