<?php

namespace Elementor;

use RivaxStudio\Traits\Rivax_Group_Control_Query;
use RivaxStudio\Traits\Rivax_Global_Widget_Controls;
use RivaxStudio\Traits\Rivax_Post_skin_base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Post_Kenzo_Widget extends Widget_Base {

    use Rivax_Group_Control_Query;
    use Rivax_Global_Widget_Controls;
    use Rivax_Post_skin_base;

    public function get_name() {
        return 'rivax-post-kenzo';
    }

    public function get_title() {
        return esc_html__('Post Kenzo', 'raveen');
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

        $this->add_control(
            'grid_tiles_layout',
            [
                'label'     => esc_html__( 'Tiles Layout', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => rivax_grid_tiles_layouts(),
                'default'   => '0',
                'condition' => [
                    'layout' => 'grid',
                ],
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
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'width: calc(100% / {{SIZE}});',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'width: calc(100% / {{SIZE}});',
                ],
                'render_type'    => 'template',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '!=',
                            'value' => 'grid'
                        ],
                        [
                            'name' => 'grid_tiles_layout',
                            'operator' => '==',
                            'value' => '0'
                        ]
                    ]
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
            'content_position',
            [
                'label'     => esc_html__( 'Content Position', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom',
                'options'   => [
                    'center'     => esc_html__( 'Center', 'raveen' ),
                    'bottom'      => esc_html__( 'Bottom', 'raveen' ),
                ],
            ]
        );


        $this->add_control(
            'content_style',
            [
                'label'     => esc_html__( 'Content Style', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'style-1'     => esc_html__( 'Style 1', 'raveen' ),
                    'style-2'     => esc_html__( 'Style 2', 'raveen' ),
                    'style-3'     => esc_html__( 'Style 3', 'raveen' ),
                    'style-4'     => esc_html__( 'Style 4', 'raveen' ),
                    'style-5'     => esc_html__( 'Style 5', 'raveen' ),
                    'style-6'     => esc_html__( 'Style 6', 'raveen' ),
                ],
                'default'   => 'style-1',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Read More Text', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'raveen' ),
                'placeholder' => esc_html__( 'Read More', 'raveen' ),
                'condition' => [
                    'content_style' => 'style-3',
                ],
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
                    '{{WRAPPER}} .content-wrapper-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
             'item_height',
            [
            'label'     => esc_html__( 'Item Height', 'raveen' ),
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
                '{{WRAPPER}} .post-wrapper' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .post-wrapper:hover .image-wrapper img' => 'transform: none;',
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
			'separator' => 'before',
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

        $this->register_title_controls();

        $this->register_post_format_icon_controls();

        $this->register_terms_controls();

	    $this->add_control(
		    'terms_position',
		    [
			    'label'     => esc_html__( 'Terms Position', 'raveen' ),
			    'type'      => Controls_Manager::SELECT,
			    'options'   => [
				    'top'     => esc_html__( 'Top', 'raveen' ),
				    'inline'  => esc_html__( 'Inline', 'raveen' ),
			    ],
			    'default'   => 'top',
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
				    'top'     => esc_html__( 'Top', 'raveen' ),
				    'inline'  => esc_html__( 'Inline', 'raveen' ),
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

        $this->add_control('link_wrapper', [
            'label' => esc_html__('Item Wrapper Link', 'raveen'),
            'description' => esc_html__('Add link to whole item.', 'raveen'),
            'type' => Controls_Manager::SWITCHER,
            'separator' => 'before',
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


        $this->start_controls_tabs('tabs_item_style');

        $this->start_controls_tab('tab_item_normal',
            [
            'label' => esc_html__('Normal', 'raveen'),
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_overlay_color',
                'label' => esc_html__('Overlay Color', 'raveen'),
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .post-wrapper::before',
            ]
        );

	    $this->add_control(
		    'item_overlay_height',
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
				    '{{WRAPPER}} .post-wrapper::before' => 'height: {{SIZE}}%;',
			    ],
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
		    ]);

	    $this->add_responsive_control('top_content_padding',
		    [
			    'label' => esc_html__('Top Content Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .post-wrapper .top-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_responsive_control('content_padding',
		    [
			    'label' => esc_html__('Content Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .post-wrapper .content-wrapper-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_responsive_control('content_margin',
		    [
			    'label' => esc_html__('Content Margin', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .post-wrapper .content-wrapper-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);


	    $this->start_controls_tabs('tabs_content_style');

	    $this->start_controls_tab('tab_content_normal',
		    [
			    'label' => esc_html__('Normal', 'raveen'),
		    ]);

	    $this->add_control('item_content_background',
		    [
			    'label' => esc_html__('Content Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .content-wrapper-inner' => 'background: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('item_content_bg_dark_mode',
            [
                'label' => esc_html__('Content Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .content-wrapper-inner' => 'background: {{VALUE}};',
                ],
            ]);

	    $this->add_responsive_control('item_content_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .content-wrapper-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control('read_more_text_color',
		    [
			    'label' => esc_html__('Read More Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .post-wrapper .read-more' => 'color: {{VALUE}};',
			    ],
			    'condition' => [
				    'content_style' => 'style-3',
			    ],
		    ]);

        $this->add_control('read_more_text_color_dark_mode',
            [
                'label' => esc_html__('Read More Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper .read-more' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'content_style' => 'style-3',
                ],
            ]);


	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_content_hover',
		    [
			    'label' => esc_html__('Hover', 'raveen'),
		    ]);

	    $this->add_control('item_content_hover_background',
		    [
			    'label' => esc_html__('Content Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .post-wrapper:hover .content-wrapper-inner' => 'background: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('item_content_hover_bg_dark_mode',
            [
                'label' => esc_html__('Content Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .post-wrapper:hover .content-wrapper-inner' => 'background: {{VALUE}};',
                ],
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
        $this->register_style_title_controls();
        $this->register_style_post_format_icon_controls();
        $this->register_style_terms_controls();
        $this->register_style_meta_controls();
	    $this->register_style_excerpt_controls();
        $this->register_style_pagination_controls();
        $this->register_style_carousel_controls();

    }



    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}