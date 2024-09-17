<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Category_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-category-box';
    }

    public function get_title() {
        return esc_html__('Category Box', 'raveen');
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }



    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__( 'Columns', 'raveen' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '4',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-categories-box' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
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
                'selectors' => [
                    '{{WRAPPER}} .rivax-categories-box' => 'column-gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .rivax-categories-box' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hide_last_item_on_tablet',
            [
                'label'     => esc_html__( 'Hide Last Item On Tablet', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .cat-item:last-of-type' => 'display: none;',
                ],
            ]
        );

        $this->add_control(
            'hide_last_item_on_mobile',
            [
                'label'     => esc_html__( 'Hide Last Item On Mobile', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .cat-item:last-of-type' => 'display: none;',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_categories',
            [
                'label' => esc_html__( 'Categories', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $categories_list = get_terms(['taxonomy' => 'category', 'fields' => 'id=>name']);


        $repeater = new Repeater();

        $repeater->add_control(
            'category',
            [
                'label'         => esc_html__( 'Category', 'raveen' ),
                'description'   => esc_html__( 'Select a category.', 'raveen' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => $categories_list,

            ]
        );

        $repeater->add_control(
            'category_image',
            [
                'label' => esc_html__( 'Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );


        $this->add_control(
            'category_items',
            [
                'label' => esc_html__( 'Category Items', 'raveen' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__( 'Settings', 'raveen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'open_link_new_tab',
            [
                'label'     => esc_html__( 'Open Link In New Tab', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

	    $this->add_control(
		    'item_animation',
		    [
			    'label'   => esc_html__( 'Animation Style', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'none',
			    'options' => [
				    'none'             => esc_html__( 'None', 'raveen' ),
				    'scale-up'         => esc_html__( 'Scale Up', 'raveen' ),
				    'move-up'          => esc_html__( 'Move Up', 'raveen' ),
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
			    'name' => 'thumbnail',
			    'exclude' => ['custom'],
			    'default' => 'rivax-small',
		    ]
	    );

	    $this->add_responsive_control(
		    'image_height',
		    [
			    'label'     => esc_html__( 'Image Height', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'size_units'=> [ 'px', '%' ],
			    'range'     => [
				    'px' => [
					    'min' => 50,
					    'max' => 400,
				    ],
				    '%' => [
					    'min' => 10,
					    'max' => 150,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .image-wrapper::before' => 'padding-top: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );


	    $this->add_control(
		    'content_position',
		    [
			    'label'   => esc_html__( 'Content Position', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'outside',
			    'options' => [
				    'inside'             => esc_html__( 'Inside', 'raveen' ),
				    'outside'            => esc_html__( 'Outside', 'raveen' ),
			    ],
			    'render_type'    => 'template',
			    'prefix_class' => 'content-position-',
		    ]
	    );

	    $this->add_control(
		    'content_v_align',
		    [
			    'label'   => esc_html__( 'Content Vertical Align', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'center',
			    'options' => [
				    'top'               => esc_html__( 'Top', 'raveen' ),
				    'center'            => esc_html__( 'Center', 'raveen' ),
				    'bottom'            => esc_html__( 'Bottom', 'raveen' ),
			    ],
			    'condition' => [
				    'content_position' => 'inside'
			    ]
		    ]
	    );

	    $this->add_control(
		    'content_align',
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
				    '{{WRAPPER}} .content-wrapper' => 'text-align: {{VALUE}};'
			    ]
		    ]
	    );


	    $this->add_control(
		    'title_tag',
		    [
			    'label'     => esc_html__( 'Title HTML Tag', 'raveen' ),
			    'type'      => Controls_Manager::SELECT,
			    'default'   => 'h3',
			    'options'   => rivax_title_tags(),
		    ]
	    );


        $this->add_control(
            'show_count',
            [
                'label'     => esc_html__( 'Show Posts Count', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'category_count_text',
            [
                'label'     => esc_html__( 'Count Text', 'raveen' ),
                'type'      => Controls_Manager::TEXT,
                'default' => esc_html__( ' Posts' , 'raveen' ),
                'condition' => [
                    'show_count' => 'yes',
                ],
            ]
        );

	    $this->add_control(
		    'count_position',
		    [
			    'label'   => esc_html__( 'Count Position', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'below',
			    'options' => [
				    'beside'           => esc_html__( 'Beside', 'raveen' ),
				    'below'            => esc_html__( 'Below', 'raveen' ),
			    ],
			    'prefix_class' => 'count-position-',
			    'condition' => [
				    'show_count' => 'yes',
			    ],
		    ]
	    );

        $this->end_controls_section();



	    $this->start_controls_section('section_style_cat_item',
		    [
			    'label' => esc_html__('Category Item', 'raveen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]);

	    $this->add_responsive_control('cat_item_padding',
		    [
			    'label' => esc_html__('Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .cat-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_responsive_control('cat_item_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .cat-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);



	    $this->start_controls_tabs('tabs_cat_item_style');

	    $this->start_controls_tab('tab_cat_item_normal',
		    [
			    'label' => esc_html__('Normal', 'raveen'),
		    ]);

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'cat_item_background',
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .cat-item',
		    ]
	    );

        $this->add_control(
            'heading_cat_item_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cat_item_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .cat-item',
            ]
        );


	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'cat_item_border',
			    'selector' => '{{WRAPPER}} .cat-item',
		    ]);

        $this->add_control('cat_item_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'cat_item_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .cat-item' => 'border-color: {{VALUE}};',
                ],
            ]);


	    $this->add_group_control(Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'cat_item_box_shadow',
			    'selector' => '{{WRAPPER}} .cat-item',
		    ]);

	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_cat_item_hover',
		    [
			    'label' => esc_html__('Hover', 'raveen'),
		    ]);

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'cat_item_hover_background',
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .cat-item:hover',
		    ]
	    );

        $this->add_control(
            'heading_cat_item_hover_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cat_item_hover_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .cat-item:hover',
            ]
        );


	    $this->add_control('cat_item_hover_border_color',
		    [
			    'label' => esc_html__('Border Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'condition' => [
				    'cat_item_border_border!' => '',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .cat-item:hover' => 'border-color: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('cat_item_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'cat_item_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .cat-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]);


	    $this->add_group_control(Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'cat_item_hover_box_shadow',
			    'selector' => '{{WRAPPER}} .cat-item:hover',
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

	    $this->add_control('image_margin',
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
			    'selector' => '{{WRAPPER}} .image-wrapper::after',
		    ]
	    );

	    $this->add_control(
		    'image_overlay_opacity',
		    [
			    'label'     => esc_html__( 'Overlay Opacity', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 1,
					    'step' => 0.01,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .image-wrapper::after' => 'opacity: {{SIZE}};',
			    ],
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
				    '{{WRAPPER}} .image-wrapper::after' => 'height: {{SIZE}}%;',
			    ],
		    ]
	    );


	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'image_border',
			    'selector' => '{{WRAPPER}} .image-wrapper',
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

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'image_overlay_hover_color',
			    'label' => esc_html__('Overlay Color', 'raveen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .image-wrapper:hover::after',
		    ]
	    );

	    $this->add_control(
		    'image_overlay_hover_opacity',
		    [
			    'label'     => esc_html__( 'Overlay Opacity', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 1,
					    'step' => 0.01,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .image-wrapper:hover::after' => 'opacity: {{SIZE}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'image_overlay_hover_height',
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
				    '{{WRAPPER}} .image-wrapper:hover::after' => 'height: {{SIZE}}%;',
			    ],
		    ]
	    );


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

	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'image_hover_box_shadow',
			    'selector' => '{{WRAPPER}} .image-wrapper:hover',
		    ]);

	    $this->end_controls_tab();
	    $this->end_controls_tabs();

	    $this->end_controls_section();



	    $this->start_controls_section('section_style_content',
		    [
			    'label' => esc_html__('Content', 'raveen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]);

	    $this->add_control(
		    'content_heading',
		    [
			    'label'     => esc_html__( 'Content Section', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
		    ]
	    );

	    $this->add_control('content_background',
		    [
			    'label' => esc_html__('Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .content-wrapper' => 'background: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('content_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .content-wrapper' => 'background: {{VALUE}};',
                ],
            ]);


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

	    $this->add_control('content_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control('content_margin',
		    [
			    'label' => esc_html__('Margin', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control('content_padding',
		    [
			    'label' => esc_html__('Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);


	    $this->add_control(
		    'title_heading',
		    [
			    'label'     => esc_html__( 'Title', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

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
			    'selector' => '{{WRAPPER}} .title-wrapper a',
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
                'selector' => 'body.dark-mode {{WRAPPER}} .title-wrapper a',
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
                    '{{WRAPPER}} .title-wrapper a' => '--underline-position: {{VALUE}};',
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
                    '{{WRAPPER}} .title-wrapper a' => '--underline-size: {{SIZE}}{{UNIT}};',
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
				    '{{WRAPPER}} .title-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_responsive_control('title_padding',
		    [
			    'label' => esc_html__('Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .title-wrapper .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'title_typography',
			    'label' => esc_html__('Typography', 'raveen'),
			    'selector' => '{{WRAPPER}} .title-wrapper .title',
		    ]);

	    $this->add_responsive_control('title_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .title-wrapper .title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);


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
				    '{{WRAPPER}} .title-wrapper .title a' => 'color: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('title_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-wrapper .title a' => 'color: {{VALUE}};',
                ],
            ]);

	    $this->add_control('title_background',
		    [
			    'label' => esc_html__('Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .title-wrapper .title a' => 'background-color: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('title_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-wrapper .title a' => 'background-color: {{VALUE}};',
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
				    '{{WRAPPER}} .title-wrapper .title a:hover' => 'color: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('title_hover_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-wrapper .title a:hover' => 'color: {{VALUE}};',
                ],
            ]);

	    $this->add_control('title_hover_background',
		    [
			    'label' => esc_html__('Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .title-wrapper .title a:hover' => 'background-color: {{VALUE}};',
			    ],
		    ]);

        $this->add_control('title_hover_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-wrapper .title a:hover' => 'background-color: {{VALUE}};',
                ],
            ]);


	    $this->end_controls_tab();
	    $this->end_controls_tabs();


	    $this->add_control(
		    'count_heading',
		    [
			    'label'     => esc_html__( 'Count', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]
	    );

	    $this->add_control(
		    'count_width',
		    [
			    'label'     => esc_html__( 'Width', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 20,
					    'max' => 200,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .count' => 'width: {{SIZE}}{{UNIT}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]
	    );

	    $this->add_control(
		    'count_height',
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
				    '{{WRAPPER}} .count' => 'height: {{SIZE}}{{UNIT}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]
	    );

	    $this->add_responsive_control('count_margin',
		    [
			    'label' => esc_html__('Margin', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .count-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);

	    $this->add_responsive_control('count_padding',
		    [
			    'label' => esc_html__('Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);


	    $this->add_control('count_color',
		    [
			    'label' => esc_html__('Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .count' => 'color: {{VALUE}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);

        $this->add_control('count_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .count' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_count' => 'yes'
                ]
            ]);

	    $this->add_control('count_background',
		    [
			    'label' => esc_html__('Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .count' => 'background: {{VALUE}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);

        $this->add_control('count_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .count' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'show_count' => 'yes'
                ]
            ]);

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'count_border',
			    'selector' => '{{WRAPPER}} .count',
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);

        $this->add_control('count_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'count_border_border!' => '',
                    'show_count' => 'yes'
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .count' => 'border-color: {{VALUE}};',
                ],
            ]);

	    $this->add_responsive_control('count_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);



	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'count_typography',
			    'label' => esc_html__('Typography', 'raveen'),
			    'selector' => '{{WRAPPER}} .count',
			    'condition' => [
				    'show_count' => 'yes'
			    ]
		    ]);


	    $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}