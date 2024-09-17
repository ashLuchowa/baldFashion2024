<?php

namespace Elementor;

use RivaxStudio\Traits\Rivax_Group_Control_Query;
use RivaxStudio\Traits\Rivax_Global_Widget_Controls;
use RivaxStudio\Traits\Rivax_Post_skin_base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Post_Elastic_Widget extends Widget_Base {

    use Rivax_Group_Control_Query;
    use Rivax_Global_Widget_Controls;
    use Rivax_Post_skin_base;

    public function get_name() {
        return 'rivax-post-elastic';
    }

    public function get_title() {
        return esc_html__('Post Elastic', 'raveen');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }


    protected function register_layout_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'     => esc_html__( 'Layout', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'grid'     => esc_html__( 'Grid', 'raveen' ),
                    'carousel' => esc_html__( 'Carousel', 'raveen' ),
                ],
                'default'   => 'grid',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__( 'Columns', 'raveen' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '2',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'render_type'    => 'template',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'width: calc(100% / {{SIZE}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'raveen' ),
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
                'render_type'    => 'template',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__( 'Row Gap', 'raveen' ),
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
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout!' => 'carousel',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function register_post_controls(){

        $this->start_controls_section(
            'section_post_settings',
            [
                'label' => esc_html__( 'Post Settings', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label'   => esc_html__( 'Show Image', 'raveen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
                'default' => 'thumbnail',
                'condition' => [
                    'show_image!' => '',
                ],
            ]
        );

        $this->add_control(
            'skip_lazy_loading',
            [
                'label'     => esc_html__( 'Skip Lazy Loading', 'raveen' ),
                'description' => sprintf(esc_html__('Use this to remove lazy loading from %s Largest Contentful Paint (LCP) %s image.', 'raveen'), '<a href="https://gtmetrix.com/dont-lazy-load-lcp-image.html" target="_blank">', '</a>'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '0'     => esc_html__( 'No', 'raveen' ),
                    '1'     => esc_html__( '1 Image', 'raveen' ),
                    '2'     => esc_html__( '2 Images', 'raveen' ),
                    '3'     => esc_html__( '3 Images', 'raveen' ),
                    '4'     => esc_html__( '4 Images', 'raveen' ),
                ],
            ]
        );


        $this->add_responsive_control(
            'thumbnail_position',
            [
                'label' => esc_html__( 'Image Position', 'raveen' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Left', 'raveen' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Right', 'raveen' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Top', 'raveen' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Bottom', 'raveen' ),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'flex-direction: {{VALUE}}'
                ],
                'condition' => [
                    'show_image!' => '',
                ],
            ]
        );


	    $this->add_responsive_control(
		    'thumbnail_zigzag',
		    [
			    'label' => esc_html__( 'Zigzag Position', 'raveen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [
				    'unset' => [
					    'title' => esc_html__( 'No', 'raveen' ),
					    'icon' => 'eicon-close',
				    ],
				    '2' => [
					    'title' => esc_html__( 'Yes', 'raveen' ),
					    'icon' => 'eicon-check',
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .post-item:nth-child(even) .image-outer-wrapper' => 'order: {{VALUE}}'
			    ],
			    'condition' => [
				    'show_image!' => '',
			    ],
		    ]
	    );
		
		$this->add_responsive_control(
            'align_content',
            [
                'label'     => esc_html__( 'Content Alignment', 'raveen' ),
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
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'text-align: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		
		$this->add_control(
            'hide_last_item_on_tablet',
            [
                'label'     => esc_html__( 'Hide Last Item On Tablet', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .post-item:last-of-type' => 'display: none;',
                ],
				'condition' => [
                    'layout' => 'grid',
                ],
				'separator' => 'before',
            ]
        );

        $this->add_control(
            'disable_image_hover_effect',
            [
                'label'     => esc_html__( 'Disable Image Hover Effect', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .image-wrapper:hover img' => 'transform: none;',
                ],
                'separator' => 'before',
            ]
        );

        $this->register_title_controls();

        $this->register_terms_controls();

	    $this->add_control(
		    'terms_position',
		    [
			    'label'     => esc_html__( 'Terms Position', 'raveen' ),
			    'type'      => Controls_Manager::SELECT,
			    'options'   => [
				    'inline'        => esc_html__( 'Inline', 'raveen' ),
				    'inside'    => esc_html__( 'Inside Image', 'raveen' ),
			    ],
			    'default'   => 'inside',
			    'condition' => [
				    'show_terms' => 'yes',
			    ],
		    ]
	    );


	    $this->register_author_controls();

        $this->register_date_controls();

		$this->register_comments_controls();

		$this->register_views_count_controls();

		$this->register_reading_time_controls();

        $this->register_excerpt_controls();

        $this->register_post_format_icon_controls();

        $this->register_read_more_controls();

	    $this->add_control(
		    'show_counter',
		    [
			    'label'     => esc_html__( 'Counter', 'raveen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'separator' => 'before'
		    ]
	    );

	    $this->add_control(
		    'counter_position',
		    [
			    'label'   => esc_html__( 'Position', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'outside-image',
			    'options' => [
				    'inside-image'         => esc_html__( 'Inside Image', 'raveen' ),
				    'outside-image'         => esc_html__( 'Outside Image', 'raveen' ),
			    ],
			    'condition' => [
				    'show_counter' => 'yes'
			    ]
		    ]
	    );

	    $this->add_control(
		    'counter_inside_image_position',
		    [
			    'label'     => esc_html__( 'Inside Position', 'raveen' ),
			    'type'      => Controls_Manager::SELECT,
			    'options'   => [
				    'top-left'          => esc_html__( 'Top Left', 'raveen' ),
				    'top-right'         => esc_html__( 'Top Right', 'raveen' ),
				    'bottom-left'       => esc_html__( 'Bottom Left', 'raveen' ),
				    'bottom-right'      => esc_html__( 'Bottom Right', 'raveen' ),
				    'center-center'      => esc_html__( 'Center Center', 'raveen' ),
				    'center-left'      => esc_html__( 'Center Left', 'raveen' ),
				    'center-right'      => esc_html__( 'Center Right', 'raveen' ),
			    ],
			    'default'   => 'top-left',
			    'condition' => [
				    'show_counter' => 'yes',
				    'counter_position' => 'inside-image',
			    ]
		    ]
	    );

        $this->end_controls_section();

    }


    protected function register_style_post_controls() {

        $this->start_controls_section('section_style_post',
            [
                'label' => esc_html__('Items', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('item_padding',
            [
                'label' => esc_html__('Item Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_item_style');

        $this->start_controls_tab('tab_item_normal',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]
        );

        $this->add_control(
            'heading_item_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .post-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .post-wrapper',
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
                    'body.dark-mode {{WRAPPER}} .post-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .post-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_item_hover',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_hover_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .post-wrapper:hover',
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
                'name' => 'item_hover_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .post-wrapper:hover',
            ]
        );

        $this->add_control('item_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('item_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_hover_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper:hover',
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section('section_style_content',
            [
                'label' => esc_html__('Content', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('content_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('content_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .post-wrapper .content-wrapper',
            ]
        );

        $this->add_control(
            'heading_content_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .post-wrapper .content-wrapper',
            ]
        );
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'content_border',
			    'selector' => '{{WRAPPER}} .post-wrapper .content-wrapper',
		    ]);

        $this->add_control('content_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'content_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .content-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);
			
			$this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .post-wrapper .content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper .content-wrapper',
            ]);

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => esc_html__( 'Image', 'raveen' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control('item_image_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .image-outer-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control(
            'item_image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'raveen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_image_width',
            [
                'label'     => esc_html__( 'Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'vw', 'vh' ],
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
					'vw' => [
                        'min' => 20,
                        'max' => 100,
                    ],
					'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-outer-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_image_height',
            [
                'label'     => esc_html__( 'Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'vw', 'vh' ],
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
					'vw' => [
                        'min' => 20,
                        'max' => 100,
                    ],
					'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-outer-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


	    $this->start_controls_tabs('tabs_item_image_style');

	    $this->start_controls_tab('tab_item_image_normal',
		    [
			    'label' => esc_html__('Normal', 'raveen'),
		    ]);

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'item_image_overlay_color',
			    'label' => esc_html__('Overlay Color', 'raveen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .image-wrapper::before',
		    ]
	    );

	    $this->add_control(
		    'item_image_overlay_height',
		    [
			    'label'     => esc_html__( 'Overlay Height', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .image-wrapper::before' => 'height: {{SIZE}}%;',
			    ],
		    ]
	    );


	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'item_image_border',
			    'selector' => '{{WRAPPER}} .image-wrapper',
		    ]);

        $this->add_control('item_image_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_image_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .image-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

	    $this->add_group_control(Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'item_image_box_shadow',
			    'selector' => '{{WRAPPER}} .image-wrapper',
		    ]);

	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_item_image_hover',
		    [
			    'label' => esc_html__('Hover', 'raveen'),
		    ]);


	    $this->add_control('item_image_hover_border_color',
		    [
			    'label' => esc_html__('Border Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'condition' => [
				    'item_image_border_border!' => '',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .image-wrapper:hover' => 'border-color: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('item_image_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_image_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .image-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]);


	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'item_image_hover_box_shadow',
			    'selector' => '{{WRAPPER}} .image-wrapper:hover',
		    ]);

	    $this->end_controls_tab();
	    $this->end_controls_tabs();

        $this->end_controls_section();

    }


    protected function register_controls() {

        $this->register_layout_controls();
        $this->register_query_builder_controls();
        $this->register_post_controls();
        $this->register_pagination_controls();
        $this->register_carousel_controls();

        $this->register_style_post_controls();
        $this->register_style_post_counter_controls();
        $this->register_style_title_controls();
        $this->register_style_terms_controls();
        $this->register_style_meta_controls();
        $this->register_style_excerpt_controls();
        $this->register_style_post_format_icon_controls();
        $this->register_style_read_more_controls();
        $this->register_style_pagination_controls();
        $this->register_style_carousel_controls();

    }


    protected function render() {

        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}