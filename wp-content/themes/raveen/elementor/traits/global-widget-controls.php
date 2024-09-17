<?php
namespace RivaxStudio\Traits;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


trait Rivax_Global_Widget_Controls {

    protected function register_pagination_controls() {

        $this->start_controls_section( 'section_pagination', [
            'label' => esc_html__( 'Pagination', 'raveen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout!' => 'carousel',
            ],
        ] );

        $this->add_control(
            'pagination_type',
            [
                'label'     => esc_html__( 'Pagination', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'                  => esc_html__( 'None', 'raveen' ),
                    'numbers'               => esc_html__( 'Numbers', 'raveen' ),
                    'prev_next'             => esc_html__( 'Previous/Next', 'raveen' ),
                    'numbers_and_prev_next' => esc_html__( 'Numbers + Previous/Next', 'raveen' ),
                    'load_more'             => esc_html__( 'Load More Button', 'raveen' ),
                    'infinite_scroll'       => esc_html__( 'Infinite scroll', 'raveen' ),
                ],
            ]
        );

        $this->add_control(
            'pagination_page_limit',
            [
                'label'     => esc_html__( 'Page Limit', 'raveen' ),
                'type'      => Controls_Manager::NUMBER,
                'condition' => [
                    'pagination_type!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'pagination_numbers_shorten',
            [
                'label'     => esc_html__( 'Shorten', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => '',
                'condition' => [
                    'pagination_type' => ['numbers', 'numbers_and_prev_next'],
                ],
            ]
        );

        $this->add_control(
            'pagination_load_more_label',
            [
                'label'     => esc_html__( 'Button Label', 'raveen' ),
                'default'   => esc_html__( 'Load More', 'raveen' ),
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_prev_label',
            [
                'label'     => esc_html__( 'Previous Label', 'raveen' ),
                'default'   => esc_html__( '&laquo; Previous', 'raveen' ),
                'condition' => [
                    'pagination_type' => ['numbers_and_prev_next', 'prev_next'],
                ],
            ]
        );

        $this->add_control(
            'pagination_next_label',
            [
                'label'     => esc_html__( 'Next Label', 'raveen' ),
                'default'   => esc_html__( 'Next &raquo;', 'raveen' ),
                'condition' => [
                    'pagination_type' => ['numbers_and_prev_next', 'prev_next'],
                ],
            ]
        );

        $this->add_control(
            'pagination_align',
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
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination-wrap' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_style_pagination_controls() {
        $this->start_controls_section(
            'section_pagination_style',
            [
                'label'     => esc_html__( 'Pagination', 'raveen' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination_type!' => 'none',
                    'layout!' => 'carousel',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_margin_top',
            [
                'label'     => esc_html__( 'Gap between Posts & Pagination', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '20',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_size',
            [
                'label'     => esc_html__( 'Size', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'sm',
                'options'   => [
                    'xs' => esc_html__( 'Extra Small', 'raveen' ),
                    'sm' => esc_html__( 'Small', 'raveen' ),
                    'md' => esc_html__( 'Medium', 'raveen' ),
                    'lg' => esc_html__( 'Large', 'raveen' ),
                    'xl' => esc_html__( 'Extra Large', 'raveen' ),
                ],
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pagination_typography',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a',
            ]
        );

        $this->start_controls_tabs( 'tabs_pagination' );

        $this->start_controls_tab(
            'tab_pagination_normal',
            [
                'label'     => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_normal',
            [
                'label'     => esc_html__( 'Background Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_normal_dark_mode',
            [
                'label'     => esc_html__( 'Background Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination .page-numbers, body.dark-mode {{WRAPPER}} .rivax-posts-pagination a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination .page-numbers, body.dark-mode {{WRAPPER}} .rivax-posts-pagination a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pagination_link_border_normal',
                'label'       => esc_html__( 'Border', 'raveen' ),
                'selector'    => '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a',

            ]
        );

        $this->add_control('pagination_link_border_normal_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'pagination_link_border_normal_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination .page-numbers, body.dark-mode {{WRAPPER}} .rivax-posts-pagination a' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'pagination_link_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_link_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'pagination_link_box_shadow',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_hover',
            [
                'label'     => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_hover',
            [
                'label'     => esc_html__( 'Background Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Background Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_color_hover',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color_hover',
            [
                'label'     => esc_html__( 'Border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'pagination_link_box_shadow_hover',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination a:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_active',
            [
                'label'     => esc_html__( 'Active', 'raveen' ),
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_active',
            [
                'label'     => esc_html__( 'Background Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_active_dark_mode',
            [
                'label'     => esc_html__( 'Background Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_color_active',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_color_active_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color_active',
            [
                'label'     => esc_html__( 'Border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color_active_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'pagination_link_box_shadow_active',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current',
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label'     => esc_html__( 'Space Between', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_item_width',
            [
                'label'     => esc_html__( 'Item Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_item_height',
            [
                'label'     => esc_html__( 'Item Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'heading_loader',
            [
                'label'     => esc_html__( 'Loader', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'loader_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-post-load-more-loader' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'loader_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-post-load-more-loader' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_responsive_control(
            'loader_size',
            [
                'label'      => esc_html__( 'Size', 'raveen' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 80,
                    ],
                ],
                'default'    => [
                    'size' => 45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-post-load-more-loader' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_carousel_controls() {

        $this->start_controls_section( 'section_carousel_settings', [
            'label' => esc_html__( 'Carousel Settings', 'raveen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout' => 'carousel',
            ],
        ] );

        $this->add_control(
            'carousel_direction',
            [
                'label'       => esc_html__( 'Direction', 'raveen' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'horizontal',
                'options'     => [
                    'horizontal' => esc_html__( 'Horizontal', 'raveen' ),
                    'vertical'   => esc_html__( 'Vertical', 'raveen' ),
                ],
                'render_type'    => 'template',
            ]
        );

        $this->add_responsive_control(
            'carousel_vertical_height',
            [
                'label'       => esc_html__( 'Container Height', 'raveen' ),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 1000,
                        'step' => 10
                    ],
                ],
                'default'     => [
                    'size' => 500,
                ],
                'selectors'   => [
                    '{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'carousel_direction' => 'vertical',
                ],
            ]
        );

        $this->add_control(
            'carousel_effect',
            [
                'label'        => esc_html__( 'Effect', 'raveen' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'slide',
                'options'      => [
                    'slide'    => esc_html__( 'Slide', 'raveen' ),
                    'fade'     => esc_html__( 'Fade', 'raveen' ),
                ],
                'prefix_class' => 'rivax-carousel-effect-',
                'separator'    => 'before',
                'render_type'    => 'template',
            ]
        );


        $this->add_control(
            'carousel_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'carousel_autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed', 'raveen' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'carousel_autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', 'raveen' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'carousel_slides_to_scroll',
            [
                'type'           => Controls_Manager::SELECT,
                'label'          => esc_html__( 'Slides to Scroll', 'raveen' ),
                'default'        => 1,
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'condition' => [
                    'carousel_effect!' => 'fade',
                ],
            ]
        );

        $this->add_control(
            'carousel_centered_slides',
            [
                'label'       => esc_html__( 'Center Slide', 'raveen' ),
                'type'        => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_effect!' => 'fade',
                ],
            ]
        );

        $this->add_control(
            'carousel_grab_cursor',
            [
                'label' => esc_html__( 'Grab Cursor', 'raveen' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_loop',
            [
                'label'   => esc_html__( 'Loop', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'carousel_auto_height',
            [
                'label'   => esc_html__( 'Auto Height', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'carousel_speed',
            [
                'label'   => esc_html__( 'Animation Speed (ms)', 'raveen' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range'   => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 5000,
                        'step' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'carousel_observer',
            [
                'label'       => esc_html__( 'Observer', 'raveen' ),
                'description' => esc_html__( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'raveen' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section( 'section_carousel_navigation', [
            'label' => esc_html__( 'Navigation', 'raveen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout' => 'carousel',
            ],
        ] );

        $this->add_control(
            'carousel_arrows',
            [
                'label'     => esc_html__( 'Arrows', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_arrows_icon',
            [
                'label'     => esc_html__( 'Arrows Icon', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ri-angle-right-solid',
                'options'   => rivax_carousel_arrows_icons(),
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_next_label',
            [
                'label'       => esc_html__( 'Arrow Next Label', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_prev_label',
            [
                'label'       => esc_html__( 'Arrow Previous Label', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_position',
            [
                'label'     => esc_html__( 'Arrows Position', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => [
                    'top'               => esc_html__( 'Top', 'raveen' ),
                    'bottom'            => esc_html__( 'Bottom', 'raveen' ),
                    'center'            => esc_html__( 'Center', 'raveen' ),
                    'top-left'          => esc_html__( 'Top Left', 'raveen' ),
                    'top-center'        => esc_html__( 'Top Center', 'raveen' ),
                    'top-right'         => esc_html__( 'Top Right', 'raveen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'raveen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'raveen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'raveen' ),
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_show_on_hover',
            [
                'label'     => esc_html__( 'Show Arrows on Hover', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_hide_arrow_mobile',
            [
                'label'     => esc_html__( 'Hide Arrows on Mobile', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );


        $this->add_control(
            'carousel_pagination',
            [
                'label'     => esc_html__( 'Pagination', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_pagination_type',
            [
                'label'        => esc_html__( 'Pagination Type', 'raveen' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'bullets',
                'options'      => [
                    'bullets'     => esc_html__( 'Bullets', 'raveen' ),
                    'fraction' => esc_html__( 'Fraction', 'raveen' ),
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_dynamic_bullets',
            [
                'label'     => esc_html__( 'Dynamic Bullets', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_pagination_position',
            [
                'label'     => esc_html__( 'Pagination Position', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => [
                    'top-left'          => esc_html__( 'Top Left', 'raveen' ),
                    'top-center'        => esc_html__( 'Top Center', 'raveen' ),
                    'top-right'         => esc_html__( 'Top Right', 'raveen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'raveen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'raveen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'raveen' ),
                    'center-left'       => esc_html__( 'Center Left', 'raveen' ),
                    'center-right'      => esc_html__( 'Center Right', 'raveen' ),
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->end_controls_section();


    }


    protected function register_style_carousel_controls() {

        $this->start_controls_section(
            'section_carousel_navigation_style',
            [
                'label'      => esc_html__( 'Navigation', 'raveen' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'carousel_navigation_style_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => esc_html__( 'Navigation and Pagination are disabled from navigation setting.', 'raveen' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'carousel_arrows' => '',
                    'carousel_pagination' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_heading',
            [
                'label'     => esc_html__( 'Arrows', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_vertical_offset',
            [
                'label'     => esc_html__( 'Arrows Vertical Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_left_offset',
            [
                'label'     => esc_html__( 'Arrow Left Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_right_offset',
            [
                'label'     => esc_html__( 'Arrow Right Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'carousel_arrows_label_typography',
                'label'     => esc_html__( 'Label Typography', 'raveen' ),
                'selector'  => '{{WRAPPER}} .carousel-nav-prev-label, {{WRAPPER}} .carousel-nav-next-label',
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );


        $this->start_controls_tabs( 'tabs_carousel_arrows_style' );

        $this->start_controls_tab(
            'tabs_carousel_arrows_normal',
            [
                'label'     => esc_html__( 'Normal', 'raveen' ),
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev, body.dark-mode {{WRAPPER}} .carousel-nav-next' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_background',
            [
                'label'     => esc_html__( 'Background', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev, body.dark-mode {{WRAPPER}} .carousel-nav-next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'carousel_arrows_border',
                'selector'  => '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next',
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control('carousel_arrows_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'carousel_arrows!' => '',
                    'carousel_arrows_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev, body.dark-mode {{WRAPPER}} .carousel-nav-next' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'carousel_arrows_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_size',
            [
                'label'     => esc_html__( 'Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_carousel_arrows_hover',
            [
                'label'     => esc_html__( 'Hover', 'raveen' ),
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev:hover, body.dark-mode {{WRAPPER}} .carousel-nav-next:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_background',
            [
                'label'     => esc_html__( 'Background', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev:hover, body.dark-mode {{WRAPPER}} .carousel-nav-next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'carousel_arrows_border_border!' => '',
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_border_color_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev:hover, body.dark-mode {{WRAPPER}} .carousel-nav-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'carousel_arrows_border_border!' => '',
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'hr_847456',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'carousel_arrows!' => '',
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_bullets_heading',
            [
                'label'     => esc_html__( 'Bullets', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_vertical_offset',
            [
                'label'     => esc_html__( 'Vertical Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_horizontal_offset',
            [
                'label'     => esc_html__( 'Horizontal Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'carousel_pagination_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_carousel_pagination_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'carousel_pagination_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'carousel_pagination_border',
                'selector'  => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_control('carousel_pagination_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'carousel_pagination_border_border!' => '',
                    'carousel_pagination!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-pagination' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'carousel_pagination_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'carousel_pagination_shadow',
                'selector' => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_carousel_bullets_style' );

        $this->start_controls_tab(
            'tabs_carousel_bullets_normal',
            [
                'label'     => esc_html__( 'Normal', 'raveen' ),
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_bullets_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_bullets_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_space_between',
            [
                'label'     => esc_html__( 'Space Between', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination-wrapper.type-bullets .carousel-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_width_size',
            [
                'label'     => esc_html__( 'Width(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_height_size',
            [
                'label'     => esc_html__( 'Height(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'raveen'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'carousel_bullets_box_shadow',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_carousel_bullets_active',
            [
                'label'     => esc_html__( 'Active', 'raveen' ),
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_active_bullet_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_active_bullet_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_active_bullet_width',
            [
                'label'     => esc_html__( 'Width(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_active_bullet_height',
            [
                'label'     => esc_html__( 'Height(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_active_bullet_radius',
            [
                'label'      => esc_html__('Border Radius', 'raveen'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'carousel_bullet_active_box_shadow',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'carousel_fraction_heading',
            [
                'label'     => esc_html__( 'Fraction', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'carousel_fraction_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'carousel_fraction_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'carousel_active_fraction_color',
            [
                'label'     => esc_html__( 'Active Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'carousel_active_fraction_color_dark_mode',
            [
                'label'     => esc_html__( 'Active Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'carousel_fraction_typography',
                'label'     => esc_html__( 'Typography', 'raveen' ),
                'selector'  => '{{WRAPPER}} .swiper-pagination-fraction',
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->end_controls_section();
    }



    protected function register_slider_controls() {

        $this->start_controls_section( 'section_slider_settings', [
            'label' => esc_html__( 'Slider Settings', 'raveen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed', 'raveen' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'slider_autoplay' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'slider_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', 'raveen' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'slider_grab_cursor',
            [
                'label' => esc_html__( 'Grab Cursor', 'raveen' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'   => esc_html__( 'Animation Speed (ms)', 'raveen' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1000,
                ],
                'range'   => [
                    'px' => [
                        'min'  => 500,
                        'max'  => 5000,
                        'step' => 100,
                    ],
                ],
            ]
        );


        $this->add_control(
            'slider_observer',
            [
                'label'       => esc_html__( 'Observer', 'raveen' ),
                'description' => esc_html__( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'raveen' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section( 'section_slider_navigation', [
            'label' => esc_html__( 'Navigation', 'raveen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control(
            'slider_arrows',
            [
                'label'     => esc_html__( 'Arrows', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'slider_arrows_icon',
            [
                'label'     => esc_html__( 'Arrows Icon', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ri-angle-right-solid',
                'options'   => rivax_carousel_arrows_icons(),
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_next_label',
            [
                'label'       => esc_html__( 'Arrow Next Label', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_prev_label',
            [
                'label'       => esc_html__( 'Arrow Previous Label', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_position',
            [
                'label'     => esc_html__( 'Arrows Position', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'           => esc_html__( 'Default', 'raveen' ),
                    'top'               => esc_html__( 'Top', 'raveen' ),
                    'bottom'            => esc_html__( 'Bottom', 'raveen' ),
                    'center'            => esc_html__( 'Center', 'raveen' ),
                    'top-left'          => esc_html__( 'Top Left', 'raveen' ),
                    'top-center'        => esc_html__( 'Top Center', 'raveen' ),
                    'top-right'         => esc_html__( 'Top Right', 'raveen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'raveen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'raveen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'raveen' ),
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrow_show_on_hover',
            [
                'label'     => esc_html__( 'Show Arrows on Hover', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_hide_arrow_mobile',
            [
                'label'     => esc_html__( 'Hide Arrows on Mobile', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );


        $this->add_control(
            'slider_pagination',
            [
                'label'     => esc_html__( 'Pagination', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'slider_pagination_type',
            [
                'label'        => esc_html__( 'Pagination Type', 'raveen' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'bullets',
                'options'      => [
                    'bullets'     => esc_html__( 'Bullets', 'raveen' ),
                    'fraction' => esc_html__( 'Fraction', 'raveen' ),
                ],
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_dynamic_bullets',
            [
                'label'     => esc_html__( 'Dynamic Bullets', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'slider_pagination_position',
            [
                'label'     => esc_html__( 'Pagination Position', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => [
                    'top-left'          => esc_html__( 'Top Left', 'raveen' ),
                    'top-center'        => esc_html__( 'Top Center', 'raveen' ),
                    'top-right'         => esc_html__( 'Top Right', 'raveen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'raveen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'raveen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'raveen' ),
                    'center-left'       => esc_html__( 'Center Left', 'raveen' ),
                    'center-right'      => esc_html__( 'Center Right', 'raveen' ),
                ],
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->end_controls_section();


    }


    protected function register_style_slider_controls() {

        $this->start_controls_section(
            'section_slider_navigation_style',
            [
                'label'      => esc_html__( 'Navigation', 'raveen' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_navigation_style_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => esc_html__( 'Navigation and Pagination are disabled from navigation setting.', 'raveen' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'slider_arrows' => '',
                    'slider_pagination' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_heading',
            [
                'label'     => esc_html__( 'Arrows', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_arrows_vertical_offset',
            [
                'label'     => esc_html__( 'Arrows Vertical Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_arrow_left_offset',
            [
                'label'     => esc_html__( 'Arrow Left Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_arrow_right_offset',
            [
                'label'     => esc_html__( 'Arrow Right Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'slider_arrows_label_typography',
                'label'     => esc_html__( 'Label Typography', 'raveen' ),
                'selector'  => '{{WRAPPER}} .carousel-nav-prev-label, {{WRAPPER}} .carousel-nav-next-label',
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );


        $this->start_controls_tabs( 'tabs_slider_arrows_style' );

        $this->start_controls_tab(
            'tabs_slider_arrows_normal',
            [
                'label'     => esc_html__( 'Normal', 'raveen' ),
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev, body.dark-mode {{WRAPPER}} .carousel-nav-next' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_background',
            [
                'label'     => esc_html__( 'Background', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev, body.dark-mode {{WRAPPER}} .carousel-nav-next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_arrows_border',
                'selector'  => '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next',
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control('slider_arrows_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'slider_arrows_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev, body.dark-mode {{WRAPPER}} .carousel-nav-next' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'slider_arrows_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_arrows_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_arrows_size',
            [
                'label'     => esc_html__( 'Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_slider_arrows_hover',
            [
                'label'     => esc_html__( 'Hover', 'raveen' ),
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_hover_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_hover_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev:hover, body.dark-mode {{WRAPPER}} .carousel-nav-next:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_hover_background',
            [
                'label'     => esc_html__( 'Background', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev:hover, body.dark-mode {{WRAPPER}} .carousel-nav-next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_arrows_border_border!' => '',
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_arrows_hover_border_color_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-nav-prev:hover, body.dark-mode {{WRAPPER}} .carousel-nav-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_arrows_border_border!' => '',
                    'slider_arrows!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'hr_847456',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'slider_arrows!' => '',
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'slider_bullets_heading',
            [
                'label'     => esc_html__( 'Bullets', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_pagination_vertical_offset',
            [
                'label'     => esc_html__( 'Vertical Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_pagination_horizontal_offset',
            [
                'label'     => esc_html__( 'Horizontal Offset', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slider_pagination_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_slider_pagination_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slider_pagination_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_pagination_border',
                'selector'  => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_control('slider_pagination_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .carousel-pagination' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'slider_pagination_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_pagination_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'slider_pagination_shadow',
                'selector' => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'slider_pagination!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_slider_bullets_style' );

        $this->start_controls_tab(
            'tabs_slider_bullets_normal',
            [
                'label'     => esc_html__( 'Normal', 'raveen' ),
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'slider_bullets_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'slider_bullets_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_bullets_space_between',
            [
                'label'     => esc_html__( 'Space Between', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination-wrapper.type-bullets .carousel-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_bullets_width_size',
            [
                'label'     => esc_html__( 'Width(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_bullets_height_size',
            [
                'label'     => esc_html__( 'Height(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_bullets_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'raveen'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'slider_bullets_box_shadow',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_slider_bullets_active',
            [
                'label'     => esc_html__( 'Active', 'raveen' ),
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'slider_active_bullet_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'slider_active_bullet_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_active_bullet_width',
            [
                'label'     => esc_html__( 'Width(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_active_bullet_height',
            [
                'label'     => esc_html__( 'Height(px)', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_active_bullet_radius',
            [
                'label'      => esc_html__('Border Radius', 'raveen'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'slider_bullet_active_box_shadow',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'slider_fraction_heading',
            [
                'label'     => esc_html__( 'Fraction', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'slider_fraction_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'slider_fraction_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'slider_active_fraction_color',
            [
                'label'     => esc_html__( 'Active Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'slider_active_fraction_color_dark_mode',
            [
                'label'     => esc_html__( 'Active Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'slider_fraction_typography',
                'label'     => esc_html__( 'Typography', 'raveen' ),
                'selector'  => '{{WRAPPER}} .swiper-pagination-fraction',
                'condition' => [
                    'slider_pagination!' => '',
                    'slider_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->end_controls_section();
    }



	protected function register_author_controls() {

		$this->add_control('show_author', [
			'label' => esc_html__('Author', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
			'separator' => 'before',
		]);

		$this->add_control('show_author_image', [
			'label' => esc_html__('Author Image', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_author' => 'yes',
			],
		]);

		$this->add_control('show_author_icon', [
			'label' => esc_html__('Author Icon', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_author' => 'yes',
			],
		]);

		$this->add_control('show_author_by', [
			'label' => esc_html__('Author By', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_author' => 'yes',
			],
		]);

		$this->add_control(
			'author_by_text',
			[
				'label'       => esc_html__( 'Author By Text', 'raveen' ),
				'type'        => Controls_Manager::TEXT,
				'default'     =>  esc_html__( 'By', 'raveen' ),
				'condition' => [
					'show_author' => 'yes',
					'show_author_by' => 'yes',
				],
			]
		);

	}



    protected function register_date_controls() {

        $this->add_control(
            'show_date',
            [
                'label'     => esc_html__( 'Date', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );

	    $this->add_control(
		    'meta_date_position',
		    [
			    'label'   => esc_html__( 'Position', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'inline',
			    'options' => [
				    'inline'              => esc_html__( 'Inline', 'raveen' ),
				    'under-author'         => esc_html__( 'Under Author', 'raveen' ),
			    ],
			    'condition' => [
				    'show_date' => 'yes'
			    ]
		    ]
	    );

	    $this->add_control(
		    'show_date_icon',
		    [
			    'label'     => esc_html__( 'Icon', 'raveen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'condition' => [
				    'show_date' => 'yes'
			    ]
		    ]
	    );

        $this->add_control(
            'human_diff_time',
            [
                'label'     => esc_html__( 'Human Different Time', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'show_date' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_time',
            [
                'label'     => esc_html__( 'Show Time', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'human_diff_time' => '',
                    'show_date'       => 'yes'
                ]
            ]
        );
    }



	protected function register_comments_controls() {

		$this->add_control('show_comments', [
			'label' => esc_html__('Comments', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'separator' => 'before',
		]);

		$this->add_control('show_comments_icon', [
			'label' => esc_html__('Icon', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_comments' => 'yes',
			],
		]);

		$this->add_control('comments_just_count', [
			'label' => esc_html__('Just Show Count', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_comments' => 'yes',
			],
		]);
	}


	protected function register_views_count_controls() {

		$this->add_control('show_views_count', [
			'label' => esc_html__('Views Count', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'separator' => 'before',
		]);

		$this->add_control('show_views_count_icon', [
			'label' => esc_html__('Icon', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_views_count' => 'yes',
			],
		]);

		$this->add_control(
			'views_count_text',
			[
				'label'       => esc_html__( 'Text', 'raveen' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Views', 'raveen'),
				'condition'   => [
					'show_views_count' => 'yes',
				],
			]
		);
	}


	protected function register_reading_time_controls() {

		$this->add_control('show_reading_time', [
			'label' => esc_html__('Reading Time', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'separator' => 'before',
		]);

		$this->add_control('show_reading_time_icon', [
			'label' => esc_html__('Icon', 'raveen'),
			'type' => Controls_Manager::SWITCHER,
			'condition' => [
				'show_reading_time' => 'yes',
			],
		]);

		$this->add_control(
			'reading_time_text',
			[
				'label'       => esc_html__( 'Text', 'raveen' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Min Read', 'raveen'),
				'condition'   => [
					'show_reading_time' => 'yes',
				],
			]
		);

	}



    protected function register_terms_controls() {

        $this->add_control(
            'show_terms',
            [
                'label'     => esc_html__( 'Terms', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );
		
		$terms = wp_list_pluck(get_taxonomies( ['public'=>true, 'show_ui'=>true], 'objects' ), "label", "name");
        unset($terms["product_cat"], $terms["product_tag"]);

        $this->add_control(
            'terms_taxonomy',
            [
                'label'         => esc_html__( 'Term Taxonomy', 'raveen' ),
                'description'   => esc_html__( 'Select taxonomy related to your post type.', 'raveen' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => $terms,
                'condition' => [
                    'show_terms' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'term_limit',
            [
                'label'         => esc_html__( 'Max Terms', 'raveen' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 1,
                'min'           => 1,
                'condition' => [
                    'show_terms' => 'yes'
                ]
            ]
        );

	    $this->add_responsive_control(
		    'term_wrapper_align',
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
				    ]
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .terms-wrapper' => 'text-align: {{VALUE}};'
			    ],
			    'condition' => [
				    'show_terms' => 'yes'
			    ]
		    ]
	    );

        $this->add_control(
            'show_date_after_terms',
            [
                'label'     => esc_html__( 'Date After Terms', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'show_terms' => 'yes'
                ]
            ]
        );

    }


    protected function register_style_terms_controls() {
        $this->start_controls_section('section_style_term',
            [
                'label' => esc_html__('Term', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_terms' => 'yes',
                ],
            ]);


        $this->add_responsive_control('term_wrapper_margin',
            [
                'label' => esc_html__('Section Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .terms-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('term_margin',
            [
                'label' => esc_html__('Item Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('term_padding',
            [
                'label' => esc_html__('Item Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_term_style');
        $this->start_controls_tab('tab_term_normal',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]);

        $this->add_control('term_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item' => 'background: {{VALUE}};',
                ],
            ]);


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'term_border',
                'selector' => '{{WRAPPER}} .term-item',
            ]);

        $this->add_control('term_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'term_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('term_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'term_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .term-item',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_term_hover',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]);

        $this->add_control('term_hover_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_hover_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item:hover' => 'color: {{VALUE}};',
                ],
            ]);


        $this->add_control('term_hover_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_hover_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item:hover' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'term_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('term_hover_border_color - Dark Mode',
            [
                'label' => esc_html__('Border Color_dark_mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'term_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            'term_shape_title_541',
            [
                'label'     => esc_html__( 'Term Shape', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('term_shape',
            [
                'label'     => esc_html__( 'Term Shape', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

	    $this->add_control('term_shape_both_side',
		    [
			    'label'     => esc_html__( 'Both Side', 'raveen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'selectors' => [
				    '{{WRAPPER}} .term-item span::after' => 'display: inline-block;',
			    ],
			    'condition' => [
				    'term_shape' => 'yes',
			    ],
		    ]
	    );

	    $this->add_control('term_shape_color',
		    [
			    'label' => esc_html__('Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .term-item span::before, {{WRAPPER}} .term-item span::after' => 'background: {{VALUE}};',
			    ],
			    'condition' => [
				    'term_shape' => 'yes',
			    ],
		    ]);

        $this->add_control('term_shape_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .term-item span::before, body.dark-mode {{WRAPPER}} .term-item span::after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'term_shape' => 'yes',
                ],
            ]);


        $this->add_control(
            'term_shape_width',
            [
                'label'     => esc_html__( 'Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .term-item span::before, {{WRAPPER}} .term-item span::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'term_shape' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'term_shape_height',
            [
                'label'     => esc_html__( 'Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
	                '{{WRAPPER}} .term-item span::before, {{WRAPPER}} .term-item span::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'term_shape' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'term_shape_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
	                '{{WRAPPER}} .term-item span::before, {{WRAPPER}} .term-item span::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'term_shape' => 'yes',
                ],
            ]
        );

	    $this->add_control(
		    'term_shape_spacing',
		    [
			    'label'     => esc_html__( 'Spacing', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 1,
					    'max' => 30,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .term-item span' => 'gap: {{SIZE}}{{UNIT}};',
			    ],
			    'condition' => [
				    'term_shape' => 'yes',
			    ],
		    ]
	    );


        $this->add_control(
            'date_after_terms_title_541',
            [
                'label'     => esc_html__( 'Date After Terms', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control('date_after_terms_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_responsive_control('date_after_terms_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_control('date_after_terms_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_control('date_after_terms_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .date-after-terms' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_control('date_after_terms_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_control('date_after_terms_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .date-after-terms' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);


        $this->add_responsive_control('date_after_terms_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_after_terms_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .date-after-terms',
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]);

        $this->add_control(
            'date_after_terms_shape_width',
            [
                'label'     => esc_html__( 'Shape Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms::before' => 'width: {{SIZE}}{{UNIT}};display: inline-block;',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'date_after_terms_shape_height',
            [
                'label'     => esc_html__( 'Shape Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .date-after-terms::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_date_after_terms' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_title_controls() {

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title HTML Tag', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h3',
                'options'   => rivax_title_tags(),
                'separator' => 'before',
            ]
        );

        $this->add_control('title_limit_words',
            [
                'label'     => esc_html__( 'Limit Words', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control( 'title_limit_words_count',
            [
                'label'       => esc_html__( 'Max Words Count', 'raveen' ),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 5,
                'default'     => 10,
                'condition'   => [
                    'title_limit_words' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_limit_words_more_text',
            [
                'label'       => esc_html__( 'More Text', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '...',
                'condition'   => [
                    'title_limit_words' => 'yes',
                ],
            ]
        );


    }


    protected function register_style_title_controls() {
        $this->start_controls_section('section_style_title',
            [
                'label' => esc_html__('Title', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

        $this->add_control(
            'title_hover_style',
            [
                'label'   => esc_html__( 'Hover Style', 'raveen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'          => esc_html__( 'Default', 'raveen' ),
                    'underline-fix'    => esc_html__( 'Underline Fix', 'raveen' ),
                    'middle-fix'       => esc_html__( 'Middle Fix', 'raveen' ),
                    'underline'        => esc_html__( 'Underline', 'raveen' ),
                    'middle-underline' => esc_html__( 'Middle Underline', 'raveen' ),
                    'underline-in-out' => esc_html__( 'Underline In Out', 'raveen' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_shape_hover_background',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper .title a',
                'condition' => [
                    'title_hover_style' => ['underline', 'middle-underline', 'underline-in-out']
                ]
            ]
        );

        $this->add_control(
            'heading_title_shape_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'title_hover_style' => ['underline', 'middle-underline', 'underline-in-out']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_shape_hover_bg_dark_mode',
                'types' => [ 'gradient' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .post-wrapper .title a',
                'condition' => [
                    'title_hover_style' => ['underline', 'middle-underline', 'underline-in-out']
                ]
            ]
        );

        $this->add_control(
            'title_hover_underline_position',
            [
                'label'   => esc_html__( 'Underline Position', 'raveen' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'top'          => esc_html__( 'Top', 'raveen' ),
                    'center'       => esc_html__( 'Center', 'raveen' ),
                    'bottom'       => esc_html__( 'Bottom', 'raveen' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => '--underline-position: {{VALUE}};',
                ],
                'condition' => [
                    'title_hover_style' => ['underline', 'middle-underline', 'underline-in-out']
                ]
            ]
        );

        $this->add_control(
            'title_hover_underline_size',
            [
                'label'     => esc_html__( 'Underline Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => '--underline-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title_hover_style' => ['underline', 'middle-underline', 'underline-in-out']
                ]
            ]
        );

        $this->add_control('title_decoration_hover_color',
            [
                'label' => esc_html__('Decoration Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-animation-underline-fix:hover, {{WRAPPER}} .title-animation-middle-fix:hover' => 'text-decoration-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'title_hover_style' => ['underline-fix', 'middle-fix']
                ]
            ]);

        $this->add_control('title_decoration_hover_color_dark_mode',
            [
                'label' => esc_html__('Decoration Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-animation-underline-fix:hover, body.dark-mode {{WRAPPER}} .title-animation-middle-fix:hover' => 'text-decoration-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'title_hover_style' => ['underline-fix', 'middle-fix']
                ]
            ]);


        $this->add_responsive_control('title_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('title_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .post-wrapper .title',
            ]);

        $this->add_control(
            'title_grid_tiles_sm_font_size',
            [
                'label'     => esc_html__( 'Small Titles Font Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'rem', 'em' ],
                'range'     => [
                    'px' => [
                        'min'  => 13,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min'  => 1,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                    'em' => [
                        'min'  => 1,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => '--sm-tiles-font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout'             => 'grid',
                    'grid_tiles_layout!' => '0',
                ],
            ]
        );

        $this->add_control(
            'title_grid_tiles_sm_line_height',
            [
                'label'     => esc_html__( 'Small Titles Line Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range'     => [
                    'px' => [
                        'min'  => 13,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => 0.8,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => '--sm-tiles-line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout'             => 'grid',
                    'grid_tiles_layout!' => '0',
                ],
            ]
        );


        $this->start_controls_tabs(
            'title_style_tabs'
        );

        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control('title_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_section_background',
            [
                'label' => esc_html__('Section Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_section_bg_dark_mode',
            [
                'label' => esc_html__('Section Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title a' => 'background-color: {{VALUE}};',
                ],
            ]);

	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'title_text_shadow',
			    'label' => esc_html__( 'Text Shadow', 'raveen' ),
			    'selector' => '{{WRAPPER}} .post-wrapper .title a',
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name'     => 'title_border',
			    'selector' => '{{WRAPPER}} .post-wrapper .title',
		    ]
	    );

        $this->add_control('title_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title' => 'border-color: {{VALUE}};',
                ],
            ]);


        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $this->add_control('title_hover_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_hover_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title a:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_section_hover_background',
            [
                'label' => esc_html__('Section Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title:hover' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_section_hover_bg_dark_mode',
            [
                'label' => esc_html__('Section Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title:hover' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_hover_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a:hover' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_hover_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .title a:hover' => 'background-color: {{VALUE}};',
                ],
            ]);

	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'title_hover_text_shadow',
			    'label' => esc_html__( 'Text Shadow', 'raveen' ),
			    'selector' => '{{WRAPPER}} .post-wrapper .title a:hover',
		    ]
	    );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function register_excerpt_controls() {

        $this->add_control('show_excerpt',
            [
                'label'     => esc_html__( 'Excerpt', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control( 'excerpt_length',
            [
                'label'       => esc_html__( 'Excerpt Limit Characters', 'raveen' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 100,
                'min'         => 30,
                'step'        => 5,
                'condition'   => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

    }


    protected function register_style_excerpt_controls() {

        $this->start_controls_section('section_style_excerpt',
            [
                'label' => esc_html__('Excerpt', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]);

        $this->add_control('excerpt_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('excerpt_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .excerpt',
            ]);

        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label'      => esc_html__( 'Margin', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

	    $this->add_control('excerpt_hide_on_mobile',
		    [
			    'label'     => esc_html__( 'Hide On Mobile', 'raveen' ),
			    'type'      => Controls_Manager::SWITCHER,
		    ]
	    );

        $this->end_controls_section();
    }


    protected function register_read_more_controls() {

        $this->add_control('show_read_more',
            [
                'label'     => esc_html__( 'Read More Button', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Read More Text', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'raveen' ),
                'placeholder' => esc_html__( 'Read More', 'raveen' ),
                'condition'   => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

    }


    protected function register_style_read_more_controls() {

        $this->start_controls_section(
            'section_read_more_style',
            [
                'label' => esc_html__( 'Read More', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_read_more' => 'yes',
                ],
            ]
        );


        $this->add_responsive_control(
            'read_more_align',
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
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

	    $this->add_control('read_more_hide_on_mobile',
		    [
			    'label'     => esc_html__( 'Hide On Mobile', 'raveen' ),
			    'type'      => Controls_Manager::SWITCHER,
		    ]
	    );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_margin',
            [
                'label'      => esc_html__( 'Margin', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'label'    => esc_html__( 'Typography', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]
        );


        $this->start_controls_tabs(
            'read_more_style_tabs'
        );

        $this->start_controls_tab(
            'read_more_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]
        );

        $this->add_control(
            'heading_read_more_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-read-more',
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-read-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'read_more_border',
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]
        );

        $this->add_control('read_more_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'read_more_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-read-more' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'read_more_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'read_more_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]);


        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'raveen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_hover_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-read-more:hover',
            ]
        );

        $this->add_control(
            'heading_read_more_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_hover_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-read-more:hover',
            ]
        );

        $this->add_control('read_more_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'read_more_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('read_more_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'read_more_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-read-more:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'read_more_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-read-more:hover',
            ]);

        $this->add_control(
            'read_more_hover_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_color_dark_mode',
            [
                'label'     => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


	    $this->add_control(
		    'read_more_icon_heading',
		    [
			    'label'     => esc_html__( 'Icon', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

	    $this->add_control('read_more_show_icon',
		    [
			    'label'     => esc_html__( 'Show Icon', 'raveen' ),
			    'type'      => Controls_Manager::SWITCHER,
		    ]
	    );

	    $this->add_control(
		    'read_more_icon',
		    [
			    'label' => esc_html__( 'Icon', 'raveen' ),
			    'type' => Controls_Manager::ICONS,
			    'condition' => [
				    'read_more_show_icon' => 'yes',
			    ],
		    ]
	    );

	    $this->add_control(
		    'read_more_icon_position',
		    [
			    'label' => esc_html__( 'Icon position', 'raveen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'toggle' => false,
			    'options' => [
				    'before' => [
					    'title' => esc_html__( 'before', 'raveen' ),
					    'icon' => 'eicon-h-align-right',
				    ],
				    'after' => [
					    'title' => esc_html__( 'after', 'raveen' ),
					    'icon' => 'eicon-h-align-left',
				    ]
			    ],
			    'default' => 'after',
			    'condition' => [
				    'read_more_show_icon' => 'yes',
			    ],
		    ]
	    );

        $this->add_control(
            'read_more_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
	                'read_more_show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon_margin',
            [
                'label'      => esc_html__( 'Margin', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
	                'read_more_show_icon' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

    }



    protected function register_post_format_icon_controls() {

        $this->add_control('show_post_format_icon',
            [
                'label'     => esc_html__( 'Post Format Icon', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

    }


    protected function register_style_post_format_icon_controls() {

        $this->start_controls_section(
            'section_post_format_icon_style',
            [
                'label' => esc_html__( 'Post Format Icon', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_post_format_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'post_format_icon_position',
            [
                'label'     => esc_html__( 'Icon Position', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'top-left',
                'options'   => [
                    'top-left'          => esc_html__( 'Top Left', 'raveen' ),
                    'top-center'        => esc_html__( 'Top Center', 'raveen' ),
                    'top-right'         => esc_html__( 'Top Right', 'raveen' ),
                    'center-center'     => esc_html__( 'Center Center', 'raveen' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_margin',
            [
                'label'      => esc_html__( 'Margin', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .post-format-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_padding',
            [
                'label'     => esc_html__( 'Padding', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 2,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_font_size',
            [
                'label'     => esc_html__( 'Icon Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_format_icon_background',
            [
                'label'     => esc_html__( 'Background', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_format_icon_color',
            [
                'label'     => esc_html__( 'Color', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_format_icon_border',
                'selector' => '{{WRAPPER}} .post-format-icon',
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .post-format-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_format_icon_box_shadow',
                'selector' => '{{WRAPPER}} .post-format-icon',
            ]);


        $this->end_controls_section();

    }





	protected function register_style_post_counter_controls() {

		$this->start_controls_section('section_style_post_counter',
			[
				'label' => esc_html__('Counter', 'raveen'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_counter' => 'yes',
				]
			]);

		$this->add_control(
			'counter_with_zero',
			[
				'label'     => esc_html__( 'Counter With Zero', 'raveen' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .post-counter::before' => 'content: counter(post-num, decimal-leading-zero);;',
				],
			]
		);

		$this->add_control(
			'post_counter_separator',
			[
				'label'   => esc_html__( 'Separator', 'raveen' ),
				'type'    => Controls_Manager::SELECT,
				'default'    => 'none',
				'options' => [
					'none'          => esc_html__( 'None', 'raveen' ),
					'dot'         => esc_html__( 'Dot', 'raveen' ),
					'slash'    => esc_html__( 'Slash', 'raveen' ),
				],
				'selectors_dictionary' => [
					'dot' => 'content: "."',
					'slash' => 'content: "/"',
				],
				'selectors' => [
					'{{WRAPPER}} .post-counter::after' => '{{VALUE}}',
				]
			]
		);


		$this->add_responsive_control(
			'post_counter_vertically',
			[
				'label' => esc_html__( 'Vertically', 'raveen' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Start', 'raveen' ),
						'icon' => 'eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'raveen' ),
						'icon' => 'eicon-justify-center-v',
					],
					'flex-end' => [
						'title' => esc_html__( 'End', 'raveen' ),
						'icon' => 'eicon-align-end-v',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-counter-wrap' => 'align-self: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control('post_counter_padding',
			[
				'label' => esc_html__('Padding', 'raveen'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .post-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]);

		$this->add_responsive_control('post_counter_margin',
			[
				'label' => esc_html__('Margin', 'raveen'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .post-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'post_counter_border',
				'selector' => '{{WRAPPER}} .post-counter',
			]
		);

        $this->add_control('post_counter_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'post_counter_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-counter' => 'border-color: {{VALUE}};',
                ],
            ]);

		$this->add_responsive_control(
			'post_counter_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'raveen' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_counter_width',
			[
				'label'     => esc_html__( 'Width', 'raveen' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-counter' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_counter_height',
			[
				'label'     => esc_html__( 'Height', 'raveen' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-counter' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_counter_box_shadow',
				'selector' => '{{WRAPPER}} .post-counter',
			]);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'post_counter_background',
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .post-counter',
			]
		);

        $this->add_control(
            'heading_post_counter_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_counter_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .post-counter',
            ]
        );

		$this->add_control('post_counter_color',
			[
				'label' => esc_html__('Color', 'raveen'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-counter' => 'color: {{VALUE}};',
				],
			]);

        $this->add_control('post_counter_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-counter' => 'color: {{VALUE}};',
                ],
            ]);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_counter_typography',
				'label' => esc_html__('Typography', 'raveen'),
				'selector' => '{{WRAPPER}} .post-counter',
			]);


		$this->end_controls_section();

	}



    protected function register_style_meta_controls() {

        $this->start_controls_section('section_style_meta',
            [
                'label' => esc_html__('Meta', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

        $this->add_control(
            'meta_container_heading',
            [
                'label'     => esc_html__( 'Container', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'meta_container_align',
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
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', 'raveen' ),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'raveen' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_container_margin',
            [
                'label'      => esc_html__( 'Margin', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .meta-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .meta-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'meta_container_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .meta-wrapper',
            ]
        );

        $this->add_control(
            'heading_meta_container_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'meta_container_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .meta-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'meta_container_border',
                'selector' => '{{WRAPPER}} .meta-wrapper',
            ]
        );

        $this->add_control('meta_container_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'meta_container_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .meta-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'meta_container_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .meta-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'meta_container_box_shadow',
                'selector' => '{{WRAPPER}} .meta-wrapper',
            ]);


        $this->add_control(
            'meta_items_heading',
            [
                'label'     => esc_html__( 'Items', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('meta_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .meta-wrapper' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_author_color',
            [
                'label' => esc_html__('Author Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-wrapper a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_author_color_dark_mode',
            [
                'label' => esc_html__('Author Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .author-wrapper a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_author_hover_color',
            [
                'label' => esc_html__('Author Hover Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-wrapper a:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_author_hover_color_dark_mode',
            [
                'label' => esc_html__('Author Hover Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .author-wrapper a:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_icon_color',
            [
                'label' => esc_html__('Icon Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper i' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_icon_color_dark_mode',
            [
                'label' => esc_html__('Icon Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .meta-wrapper i' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .meta-wrapper',
            ]);

        $this->add_control(
            'meta_author_image_size',
            [
                'label'     => esc_html__( 'Author Image Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-author-wrapper .author-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_author' => 'yes',
                    'show_author_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'meta_divider_heading',
            [
                'label'     => esc_html__( 'Divider', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_divider_disable',
            [
                'label'     => esc_html__( 'Disable', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper > div + div::before' => 'display: none;',
                ],
            ]
        );

        $this->add_control('meta_divider_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper > div + div::before' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('meta_divider_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .meta-wrapper > div + div::before' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'meta_divider_width',
            [
                'label'     => esc_html__( 'Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper > div + div::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'meta_divider_height',
            [
                'label'     => esc_html__( 'Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper > div + div::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('meta_divider_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .meta-wrapper > div + div::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);



        $this->end_controls_section();

    }



}

