<?php

namespace Elementor;

use RivaxStudio\Traits\Rivax_Group_Control_Query;
use RivaxStudio\Traits\Rivax_Global_Widget_Controls;
use RivaxStudio\Traits\Rivax_Post_skin_base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Post_Modern_Widget extends Widget_Base {

    use Rivax_Group_Control_Query;
    use Rivax_Global_Widget_Controls;
    use Rivax_Post_skin_base;

    public function get_name() {
        return 'rivax-post-modern';
    }

    public function get_title() {
        return esc_html__('Post Modern', 'raveen');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

	public function get_script_depends() {
		//return [ 'masonry' ];
		if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			return ['masonry'];
		}

		if ( $this->get_settings_for_display( 'layout' ) == 'masonry' ) {
			return [ 'masonry' ];
		} else {
			return [];
		}
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
                    'masonry'  => esc_html__( 'Masonry', 'raveen' ),
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
                'default'            => '3',
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
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'width: calc(100% / {{SIZE}});',
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
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry' => 'margin-left: calc({{SIZE}}{{UNIT}} * -.5); margin-right: calc({{SIZE}}{{UNIT}} * -.5);',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'padding-left: calc({{SIZE}}{{UNIT}} * .5); padding-right: calc({{SIZE}}{{UNIT}} * .5);',
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
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout!' => 'carousel',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function register_post_controls() {

        $this->start_controls_section(
            'section_post_settings',
            [
                'label' => esc_html__( 'Post Settings', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .content-wrapper, {{WRAPPER}} .content-wrapper-inside.rivax-position-bottom' => 'text-align: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .image-wrapper:hover img' => 'transform: none;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'     => esc_html__( 'Image Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'vw', 'vh' ],
                'range'     => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
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
                    '{{WRAPPER}} .image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'exclude' => ['custom'],
            'default' => 'rivax-small',
        ]);

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

        $this->add_control('image_link', [
            'label' => esc_html__('Image Link', 'raveen'),
            'description' => esc_html__('Add link to image.', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
        ]);

        $this->add_control('show_image_svg_cover', [
            'label' => esc_html__('Image Svg Cover', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
        ]);

        $this->add_control(
            'image_svg_cover',
            [
                'label'     => esc_html__( 'Cover Style', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'clouds'            => esc_html__( 'Clouds', 'raveen' ),
                    'corner'            => esc_html__( 'Corner', 'raveen' ),
                    'cross-line'        => esc_html__( 'Cross Line', 'raveen' ),
                    'curve'             => esc_html__( 'Curve', 'raveen' ),
                    'drops'             => esc_html__( 'Drops', 'raveen' ),
                    'mountains'         => esc_html__( 'Mountains', 'raveen' ),
                    'pyramids'          => esc_html__( 'Pyramids', 'raveen' ),
                    'splash'            => esc_html__( 'Splash', 'raveen' ),
                    'split'             => esc_html__( 'Split', 'raveen' ),
                    'tilt'              => esc_html__( 'Tilt', 'raveen' ),
                    'torn-paper'        => esc_html__( 'Torn Paper', 'raveen' ),
                    'triangle'          => esc_html__( 'Triangle', 'raveen' ),
                    'wave'              => esc_html__( 'Wave', 'raveen' ),
                    'zigzag'            => esc_html__( 'Zigzag', 'raveen' ),
                ],
                'default'   => 'clouds',
                'condition' => [
                    'show_image_svg_cover' => 'yes',
                ],
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
	                'inside'        => esc_html__( 'Inside', 'raveen' ),
	                'outside'       => esc_html__( 'Outside', 'raveen' ),
                ],
                'default'   => 'inside',
                'condition' => [
                    'show_terms' => 'yes',
                ],
            ]
        );


        $this->register_author_controls();

	    $this->add_control(
		    'author_position',
		    [
			    'label'     => esc_html__( 'Author Position', 'raveen' ),
			    'type'      => Controls_Manager::SELECT,
			    'options'   => [
				    'inside-top'     => esc_html__( 'Inside Top', 'raveen' ),
				    'inline'        => esc_html__( 'Inline', 'raveen' ),
			    ],
			    'default'   => 'inline',
			    'condition' => [
				    'show_author' => 'yes',
			    ],
		    ]
	    );

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
		    'counter_inside_position',
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
			    ]
		    ]
	    );


        $this->add_control('show_top_content', [
            'label' => esc_html__('Top Content', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
            'separator' => 'before',
        ]);

        $this->add_control('top_content_comments', [
            'label' => esc_html__('Comments', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_top_content' => 'yes',
            ],
        ]);

        $this->add_control('top_content_views', [
            'label' => esc_html__('Views', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_top_content' => 'yes',
            ],
        ]);

        $this->add_control('top_content_reading_time', [
            'label' => esc_html__('Reading Time', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_top_content' => 'yes',
            ],
        ]);

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
                'label' => esc_html__('Padding', 'raveen'),
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
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]);

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

        $this->add_responsive_control('item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

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


        $this->start_controls_section('section_style_image',
            [
            'label' => esc_html__('Image', 'raveen'),
            'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('image_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_image_style');

        $this->start_controls_tab('tab_image_normal',
            [
            'label' => esc_html__('Normal', 'raveen'),
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_overlay_color',
                'label' => esc_html__('Overlay Color', 'raveen'),
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .image-wrapper::before',
            ]
        );

	    $this->add_control(
		    'image_overlay_height',
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
            'name' => 'image_border',
            'selector' => '{{WRAPPER}} .image-wrapper',
        ]);

        $this->add_control('image_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'image_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .image-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('image_border_radius',
            [
            'label' => esc_html__('Border Radius', 'raveen'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
            'name' => 'image_box_shadow',
            'selector' => '{{WRAPPER}} .image-wrapper',
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_image_hover',
            [
            'label' => esc_html__('Hover', 'raveen'),
        ]);

        $this->add_control('image_hover_border_color',
            [
            'label' => esc_html__('Border Color', 'raveen'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'image_border_border!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .image-wrapper:hover' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('image_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'image_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .image-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'image_hover_transform',
            [
                'label'              => esc_html__( 'Transform', 'raveen' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'none' => esc_html__( 'None', 'raveen' ),
                    'move-up' => esc_html__( 'Move Up', 'raveen' ),
                    'scale-up' => esc_html__( 'Scale Up', 'raveen' ),
                ],
                'selectors_dictionary' => [
                    'move-up' => 'transform: translateY(-15px)',
                    'scale-up' => 'transform: scale(1.05)',
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper:hover' => '{{VALUE}}'
                ]
            ]
        );


        $this->add_group_control(
             Group_Control_Box_Shadow::get_type(),
             [
            'name' => 'image_hover_box_shadow',
            'selector' => '{{WRAPPER}} .image-wrapper:hover',
        ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            'image_svg_cover_heading',
            [
                'label'     => esc_html__( 'Svg Cover', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_image_svg_cover' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_svg_cover_height',
            [
                'label'     => esc_html__( 'Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .svg-cover' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_image_svg_cover' => 'yes',
                ],
            ]
        );

        $this->add_control('image_svg_cover_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_image_svg_cover' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .svg-cover' => 'fill: {{VALUE}};',
                ],
            ]);

        $this->add_control('image_svg_cover_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_image_svg_cover' => 'yes',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .svg-cover' => 'fill: {{VALUE}};',
                ],
            ]);


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
				    '{{WRAPPER}} .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

        $this->add_responsive_control('content_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);


        $this->start_controls_tabs('tabs_content_style');

        $this->start_controls_tab('tab_content_normal',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .content-wrapper',
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
                'selector' => 'body.dark-mode {{WRAPPER}} .content-wrapper',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .content-wrapper',
            ]);

        $this->add_control('content_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'content_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .content-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .content-wrapper',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_content_hover',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_hover_background',
                'label' => esc_html__('Background', 'raveen'),
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .post-wrapper:hover .content-wrapper',
            ]
        );

        $this->add_control(
            'heading_content_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_hover_bg_dark_mode',
                'label' => esc_html__('Background', 'raveen'),
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .post-wrapper:hover .content-wrapper',
            ]
        );

        $this->add_control('content_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'content_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper:hover .content-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('content_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'content_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper:hover .content-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_hover_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper:hover .content-wrapper',
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section('section_style_top_content',
            [
                'label' => esc_html__('Top Content', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_top_content' => 'yes',
                ],
            ]);

        $this->add_responsive_control('top_content_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('top_content_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_control(
            'top_content_items_gap',
            [
                'label'     => esc_html__( 'Items Gap', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'top_content_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .top-content',
            ]
        );

        $this->add_control('top_content_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .top-content, .top-content a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'top_content_border',
                'selector' => '{{WRAPPER}} .top-content',
            ]);

        $this->add_responsive_control('top_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'top_content_shadow',
                'selector' => '{{WRAPPER}} .top-content',
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'top_content_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .top-content',
            ]);

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



    protected function render_top_content() {
        if ( !$this->get_settings( 'show_top_content' ) ) {
            return;
        }

        $settings = $this->get_settings_for_display();
        ?>
        <div class="top-content">
            <?php if( $settings['top_content_comments'] ): ?>
            <span class="top-comments" title="<?php esc_html_e('Comments', 'raveen') ?>"><i class="ri-chat-1-line"></i><?php echo get_comments_number(); ?></span>
            <?php endif; ?>

            <?php if( $settings['top_content_views'] ): ?>
                <span class="top-views" title="<?php esc_html_e('Views', 'raveen') ?>"><i class="ri-fire-line"></i><?php echo rivax_get_post_views(get_the_ID()); ?></span>
            <?php endif; ?>

            <?php if( $settings['top_content_reading_time'] ): ?>
                <span class="top-reading-time" title="<?php esc_html_e('Reading Time', 'raveen') ?>"><i class="ri-time-line"></i><?php echo rivax_get_reading_time(); ?></span>
            <?php endif; ?>
        </div>
        <?php
    }



    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}