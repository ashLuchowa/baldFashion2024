<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Divider_Heading_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-divider-heading';
    }

    public function get_title() {
        return esc_html__('Divider Heading', 'raveen');
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'raveen' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'raveen' ),
                'placeholder' => esc_html__( 'Title', 'raveen' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h2',
                'options'   => rivax_title_tags(),
            ]
        );

        $this->add_responsive_control(
            'heading_align',
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
                'toggle' => false,
                'prefix_class' => 'rivax-align-',
                'selectors_dictionary' => [
                    'left' => 'justify-content: left; text-align: left;',
                    'center' => 'justify-content: center; text-align: center;',
                    'right' => 'justify-content: right; text-align: right;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading, {{WRAPPER}} .subtitle-text-wrap' => '{{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'title_url',
            [
                'label'         => esc_html__( 'Link', 'raveen' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'raveen' ),
            ]
        );

	    $this->add_control(
		    'title_icon',
		    [
			    'label' => esc_html__( 'Icon', 'raveen' ),
			    'type' => Controls_Manager::ICONS,
		    ]
	    );

	    $this->add_control(
		    'subtitle_heading',
		    [
			    'label'     => esc_html__( 'Subtitle', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

	    $this->add_control(
		    'subtitle',
		    [
			    'label' => esc_html__( 'Subtitle', 'raveen' ),
			    'type' => Controls_Manager::TEXT,
			    'placeholder' => esc_html__( 'Subtitle', 'raveen' ),
		    ]
	    );

	    $this->add_responsive_control(
		    'subtitle_position',
		    [
			    'label' => esc_html__( 'Position', 'raveen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [
				    'row' => [
					    'title' => esc_html__( 'Side', 'raveen' ),
					    'icon' => 'eicon-h-align-right',
				    ],
				    'column-reverse' => [
					    'title' => esc_html__( 'Top', 'raveen' ),
					    'icon' => 'eicon-v-align-top',
				    ],
				    'column' => [
					    'title' => esc_html__( 'Bottom', 'raveen' ),
					    'icon' => 'eicon-v-align-bottom',
				    ]
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .title-inner' => 'flex-direction: {{VALUE}};'
			    ]
		    ]
	    );


	    $this->add_responsive_control(
		    'subtitle_v_position',
		    [
			    'label' => esc_html__( 'Vertical Position', 'raveen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [
				    'start' => [
					    'title' => esc_html__( 'Top', 'raveen' ),
					    'icon' => 'eicon-justify-start-v',
				    ],
				    'center' => [
					    'title' => esc_html__( 'Center', 'raveen' ),
					    'icon' => 'eicon-justify-center-v',
				    ],
				    'baseline' => [
					    'title' => esc_html__( 'Baseline', 'raveen' ),
					    'icon' => 'eicon-align-center-h',
				    ],
				    'end' => [
					    'title' => esc_html__( 'Bottom', 'raveen' ),
					    'icon' => 'eicon-justify-end-v',
				    ]
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .title-inner' => 'align-items: {{VALUE}};'
			    ],
			    'condition' => [
				    'subtitle_position!' => ['column', 'column-reverse'],
			    ],
		    ]
	    );

	    $this->add_control(
		    'subtitle_spacing',
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
				    '{{WRAPPER}} .title-inner' => 'gap: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Title', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
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
                    'body.dark-mode {{WRAPPER}} .rivax-divider-heading .title-inner' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );

        $this->start_controls_tabs( 'tabs_title' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_background',
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );


        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_title_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control(
            'title_color_dark_mode',
            [
                'label' => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-divider-heading .title-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_dark_mode',
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();




	    $this->start_controls_section(
		    'section_style_title_icon',
		    [
			    'label' => esc_html__( 'Title Icon', 'raveen' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_responsive_control(
		    'title_icon_margin',
		    [
			    'label' => esc_html__( 'Margin', 'raveen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'title_icon_padding',
		    [
			    'label' => esc_html__( 'Padding', 'raveen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'title_icon_border',
			    'selector' => '{{WRAPPER}} .title-text .icon',
		    ]
	    );

        $this->add_control('title_icon_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title_icon_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-text .icon' => 'border-color: {{VALUE}};',
                ],
            ]);

	    $this->add_control(
		    'title_icon_border_radius',
		    [
			    'label' => esc_html__( 'Border Radius', 'raveen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'title_icon_font_size',
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
				    '{{WRAPPER}} .title-text .icon' => 'font-size: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

        $this->start_controls_tabs( 'tabs_title_icon' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_title_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'title_icon_color',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-text .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_icon_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .title-text .icon',
            ]
        );

        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_title_icon_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control(
            'title_icon_color_dark_mode',
            [
                'label' => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .title-text .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_icon_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .title-text .icon',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_style_subtitle',
		    [
			    'label' => esc_html__( 'Subtitle', 'raveen' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'subtitle_border',
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );

        $this->add_control('subtitle_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'subtitle_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .subtitle-text' => 'border-color: {{VALUE}};',
                ],
            ]);

	    $this->add_control(
		    'subtitle_border_radius',
		    [
			    'label' => esc_html__( 'Border Radius', 'raveen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .subtitle-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'subtitle_padding',
		    [
			    'label' => esc_html__( 'Padding', 'raveen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .subtitle-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'subtitle_typography',
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'subtitle_text_shadow',
			    'label' => esc_html__( 'Text Shadow', 'raveen' ),
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );


        $this->start_controls_tabs( 'tabs_subtitle' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_subtitle_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .subtitle-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'subtitle_background',
                'selector' => '{{WRAPPER}} .subtitle-text',
            ]
        );


        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_subtitle_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control(
            'subtitle_color_dark_mode',
            [
                'label' => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .subtitle-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'subtitle_bg_dark_mode',
                'selector' => 'body.dark-mode {{WRAPPER}} .subtitle-text',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

	    $this->end_controls_section();



        $this->start_controls_section(
            'section_style_divider',
            [
                'label' => esc_html__( 'Divider', 'raveen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => esc_html__( 'Divider Style', 'raveen' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'  => esc_html__( 'Style 1', 'raveen' ),
                    '2'  => esc_html__( 'Style 2', 'raveen' ),
                    '3'  => esc_html__( 'Style 3', 'raveen' ),
                    '4'  => esc_html__( 'Style 4', 'raveen' ),
                    '5'  => esc_html__( 'Style 5', 'raveen' ),
                    '6'  => esc_html__( 'Style 6', 'raveen' ),
                    '7'  => esc_html__( 'Style 7', 'raveen' ),
                    '8'  => esc_html__( 'Style 8', 'raveen' ),
                    '9'  => esc_html__( 'Style 9', 'raveen' ),
                    '10'  => esc_html__( 'Style 10', 'raveen' ),
                    '11'  => esc_html__( 'Style 11', 'raveen' ),
                    '12'  => esc_html__( 'Style 12', 'raveen' ),
                    '13'  => esc_html__( 'Style 13', 'raveen' ),
                    '14'  => esc_html__( 'Style 14', 'raveen' ),
                    '15'  => esc_html__( 'Style 15', 'raveen' ),
                    '16'  => esc_html__( 'Style 16', 'raveen' ),
                    '17'  => esc_html__( 'Style 17', 'raveen' ),
                    '18'  => esc_html__( 'Style 18', 'raveen' ),
                    '19'  => esc_html__( 'Style 19', 'raveen' ),
                    '20'  => esc_html__( 'Style 20', 'raveen' ),
                    '21'  => esc_html__( 'Style 21', 'raveen' ),
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__( 'Color', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading' => '--divider-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color_dark_mode',
            [
                'label' => esc_html__( 'Color - Dark Mode', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-divider-heading' => '--divider-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color_2',
            [
                'label' => esc_html__( 'Color 2', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading' => '--divider-color-2: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color_2_dark_mode',
            [
                'label' => esc_html__( 'Color 2 - Dark Mode', 'raveen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-divider-heading' => '--divider-color-2: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_height',
            [
                'label'     => esc_html__( 'Height', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'height: {{SIZE}}{{UNIT}}; border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_1_width',
            [
                'label'     => esc_html__( 'Divider 1 Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-1' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_2_width',
            [
                'label'     => esc_html__( 'Divider 2 Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-2' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_3_width',
            [
                'label'     => esc_html__( 'Divider 3 Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-3' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_4_width',
            [
                'label'     => esc_html__( 'Divider 4 Width', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-4' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hide_divider_1',
            [
                'label'     => esc_html__( 'Hide Divider 1', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .divider-1' => 'display: none;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hide_divider_2',
            [
                'label'     => esc_html__( 'Hide Divider 2', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .divider-2' => 'display: none;',
                ],
            ]
        );

        $this->add_control(
            'hide_divider_3',
            [
                'label'     => esc_html__( 'Hide Divider 3', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .divider-3' => 'display: none;',
                ],
            ]
        );

        $this->add_control(
            'hide_divider_4',
            [
                'label'     => esc_html__( 'Hide Divider 4', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .divider-4' => 'display: none;',
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