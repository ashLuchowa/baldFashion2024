<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Instagram_Widget extends Widget_Base {


    public function get_name() {
        return 'rivax-instagram';
    }

    public function get_title() {
        return esc_html__('Instagram', 'raveen');
    }

    public function get_icon() {
        return 'eicon-instagram-gallery';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__( 'Settings', 'raveen' ),
            ]
        );

        $this->add_control(
            'profile_image',
            [
                'label' => esc_html__( 'Profile Image', 'raveen' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'username',
            [
                'label'       => esc_html__( 'Username', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'default'   => 'RivaxStudio',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Button Text', 'raveen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Follow Me', 'raveen' ),
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__( 'Button Icon', 'raveen' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label'       => esc_html__( 'Tagline', 'raveen' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'We become what we think about!', 'raveen' ),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'     => esc_html__( 'Layout', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1'  => esc_html__( 'Layout 1', 'raveen' ),
                    '2'  => esc_html__( 'Layout 2', 'raveen' ),
                    '3'  => esc_html__( 'Layout 3', 'raveen' ),
                    '4'  => esc_html__( 'Layout 4', 'raveen' ),
                ],
                'default'   => '1',
            ]
        );

        $this->add_control(
            'show_profile_image',
            [
                'label'     => esc_html__( 'Show Profile Image', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_username',
            [
                'label'     => esc_html__( 'Show Username', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_tagline',
            [
                'label'     => esc_html__( 'Show Tagline', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label'     => esc_html__( 'Show Button', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );



        $this->end_controls_section();




        $this->start_controls_section(
            'section_images',
            [
                'label' => esc_html__( 'Images', 'raveen' ),
            ]
        );

        $this->add_control(
            'images_layout',
            [
                'label'     => esc_html__( 'Images Layout', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1'  => esc_html__( 'Layout 1', 'raveen' ),
                    '2'  => esc_html__( 'Layout 2', 'raveen' ),
                    '3'  => esc_html__( 'Layout 3', 'raveen' ),
                    '4'  => esc_html__( 'Layout 4', 'raveen' ),
                    '5'  => esc_html__( 'Layout 5', 'raveen' ),
                ],
                'default'   => '1',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__( 'Columns', 'raveen' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '6',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-images' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
            ]
        );


        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '10',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-images' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__( 'Row Gap', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '10',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-images' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'max_rows',
            [
                'label'              => esc_html__( 'Maximum Rows', 'raveen' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'none' => esc_html__( 'None', 'raveen' ),
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
                'selectors_dictionary' => [
                    'none' => 'grid-auto-rows: 1fr;grid-template-rows: repeat(1, 1fr);',
                    '1' => 'grid-auto-rows: 0;grid-template-rows: repeat(1, 1fr);',
                    '2' => 'grid-auto-rows: 0;grid-template-rows: repeat(2, 1fr);',
                    '3' => 'grid-auto-rows: 0;grid-template-rows: repeat(3, 1fr);',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-images' => '{{VALUE}}'
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
                'default' => 'rivax-small-square',
            ]);

        $this->add_control(
            'images',
            [
                'label' => esc_html__( 'Add Images', 'raveen' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->end_controls_section();




        $this->start_controls_section('section_style_header',
            [
                'label' => esc_html__('Header', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_style_header',
            [
                'label'     => esc_html__( 'Header', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'header_gap',
            [
                'label'     => esc_html__( 'Header & Images Gap', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'heading_style_profile_image',
            [
                'label'     => esc_html__( 'Profile Image', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'profile_image_size',
            [
                'label'     => esc_html__( 'Image Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-profile-img img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'profile_image_margin',
            [
                'label' => esc_html__( 'Margin', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-profile-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'profile_image_border',
                'selector' => '{{WRAPPER}} .rivax-insta-profile-img img',
            ]);

        $this->add_control('profile_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-profile-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'profile_image_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-insta-profile-img img',
            ]);


        $this->add_control(
            'heading_style_username',
            [
                'label'     => esc_html__( 'Username', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('username_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-info .username' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'username_typography',
                'selector' => '{{WRAPPER}} .rivax-insta-info .username',
            ]
        );


        $this->add_control(
            'heading_style_tagline',
            [
                'label'     => esc_html__( 'Tagline', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('tagline_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-info .tagline' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tagline_typography',
                'selector' => '{{WRAPPER}} .rivax-insta-info .tagline',
            ]
        );


        $this->add_control(
            'heading_style_button',
            [
                'label'     => esc_html__( 'Button', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label'     => esc_html__( 'Icon Spacing', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'raveen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .rivax-insta-btn',
            ]
        );



        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab('tab_button_normal',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]);

        $this->add_control('button_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-insta-btn' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-insta-btn' => 'background: {{VALUE}};',
                ],
            ]);


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .rivax-insta-btn',
            ]);

        $this->add_control('button_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-insta-btn' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-insta-btn',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_button_hover',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]);

        $this->add_control('button_hover_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_hover_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-insta-btn:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_hover_background',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn:hover' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_hover_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-insta-btn:hover' => 'background: {{VALUE}};',
                ],
            ]);


        $this->add_control('button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_hover_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-insta-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('button_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-insta-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-insta-btn:hover',
            ]);


        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();



        $this->start_controls_section('section_style_images',
            [
                'label' => esc_html__('Images', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_image_style');

        $this->start_controls_tab('tab_image_normal',
            [
                'label' => esc_html__('Normal', 'raveen'),
            ]);

        $this->add_control('image_overlay',
            [
                'label' => esc_html__('Overlay', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insta-item a::before' => 'background: {{VALUE}};',
                ],
            ]);


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .insta-item',
            ]);

        $this->add_control('image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .insta-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .insta-item',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_image_hover',
            [
                'label' => esc_html__('Hover', 'raveen'),
            ]);

        $this->add_control(
            'image_hover_shape',
            [
                'label'     => esc_html__( 'Hover Shape', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control('image_hover_overlay',
            [
                'label' => esc_html__('Overlay', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insta-item a:hover::before' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('image_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'image_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .insta-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('image_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .insta-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_hover_box_shadow',
                'selector' => '{{WRAPPER}} .insta-item:hover',
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