<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Fancy_Text_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-fancy-text';
    }

    public function get_title() {
        return esc_html__('Fancy Text', 'raveen');
    }

    public function get_icon() {
        return 'eicon-animated-headline';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    public function get_script_depends() {
        return [ 'rivax-fancy-text' ];
    }

    public function get_style_depends() {
        return [ 'rivax-fancy-text' ];
    }

    protected function register_controls() {


        $this->start_controls_section(
            'section_animation',
            [
                'label' => esc_html__('Animation', 'raveen'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'fancy_animation_type',
            [
                'label' => esc_html__('Animation Type', 'raveen'),
                'type' => Controls_Manager::SELECT,
                'default' => 'clip',
                'options' => [
                    'clip' => esc_html__('Clip', 'raveen'),
                    'rotate-1' => esc_html__('Flip Rotate', 'raveen'),
                    'rotate-2' => esc_html__('letter FadeIn', 'raveen'),
                    'rotate-3' => esc_html__('letter Rotate', 'raveen'),
                    'type' => esc_html__('Typing letter', 'raveen'),
                    'bar-loading' => esc_html__('Bar Loading', 'raveen'),
                    'slide' => esc_html__('Slide Top', 'raveen'),
                    'zoom-out' => esc_html__('Zoom Out', 'raveen'),
                    'zoom-fade' => esc_html__('Zoom Fade', 'raveen'),
                    'scale' => esc_html__('Scale In', 'raveen'),
                    'push' => esc_html__('Push Left', 'raveen'),
                    'bouncing' => esc_html__('Bouncing Effect', 'raveen'),
                ],
            ]
        );

        $this->add_control(
            'fancy_animation_delay',
            [
                'label' => esc_html__('Animation Delay (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['rotate-1', 'rotate-2', 'rotate-3', 'slide', 'zoom-out', 'zoom-fade', 'scale', 'push', 'bouncing'],
                ],
            ]
        );

        $this->add_control(
            'fancy_loading_bar',
            [
                'label' => esc_html__('Animation Delay (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3800,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['bar-loading'],
                ],
            ]
        );

        $this->add_control(
            'fancy_letters_delay',
            [
                'label' => esc_html__('Letters Delay (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 50,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['rotate-2', 'rotate-3', 'scale', 'bouncing'],
                ],
            ]
        );

        $this->add_control(
            'fancy_letters_delay_bar',
            [
                'label' => esc_html__('Letters Delay (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'min'  => 200,
                'max'  => 1000,
                'condition'	=> [
                    'fancy_animation_type' => ['bar-loading'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text.bar-loading .rivax-fancy-text-item.is-visible' => 'transition: {{VALUE}}ms ease-in-out;',
                ],
            ]
        );

        $this->add_control(
            'fancy_type_letters_delay',
            [
                'label' => esc_html__('Type Letters Delay (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 150,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['type'],
                ],
            ]
        );

        $this->add_control(
            'fancy_selection_duration',
            [
                'label' => esc_html__('Selection Duration (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['type'],
                ],
            ]
        );

        $this->add_control(
            'fancy_reveal_duration',
            [
                'label' => esc_html__('Reveal Duration (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['clip'],
                ],
            ]
        );

        $this->add_control(
            'fancy_reveal_animation_delay',
            [
                'label' => esc_html__('Reveal Animation Delay (ms)', 'raveen'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1500,
                'min'  => 1,
                'condition'	=> [
                    'fancy_animation_type' => ['clip'],
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'raveen'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'fancy_text_alignment',
            [
                'type' => Controls_Manager::CHOOSE,
                'label' => esc_html__('Alignment', 'raveen'),
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'raveen'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'raveen'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'raveen'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fancy_prefix_text',
            [
                'label' => esc_html__('Prefix Text', 'raveen'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('This is a ', 'raveen'),
                'description' => esc_html__('Text before fancy text', 'raveen'),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'fancy_text',
            [
                'label' => esc_html__('Fancy Text', 'raveen'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Powerful Theme' , 'raveen'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fancy_text_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text-item{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'fancy_text_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text-item{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'fancy_text_background_color',
            [
                'label' => esc_html__('Background Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text-item{{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'fancy_text_background_color_dark_mode',
            [
                'label' => esc_html__('Background Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text-item{{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
            ]
        );



        $this->add_control(
            'fancy_text_lists',
            [
                'label' => esc_html__('Fancy Lists', 'raveen'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fancy_text' => esc_html__('Most', 'raveen'),
                    ],
                    [
                        'fancy_text' => esc_html__('Powerful', 'raveen'),
                    ],
                    [
                        'fancy_text' => esc_html__( 'Theme', 'raveen'),
                    ],
                ],
                'title_field' => '{{{ fancy_text }}}',
            ]
        );


        $this->add_control(
            'fancy_suffix_text',
            [
                'label' => esc_html__('Suffix Text', 'raveen'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Text after fancy text', 'raveen'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fancy_text_title_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'raveen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h2',
                'options'   => rivax_title_tags(),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__('Heading Text', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'fancy_heading_typography',
                'selector'	 => '{{WRAPPER}} .rivax-fancy-text',
            ]
        );

        $this->add_control(
            'fancy_heading_color',
            [
                'label'		 =>esc_html__('Color', 'raveen'),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .rivax-fancy-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fancy_heading_color_dark_mode',
            [
                'label'		 =>esc_html__('Color - Dark Mode', 'raveen'),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'prefix_style_section',
            [
                'label' => esc_html__('Prefix Text', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'prefix_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-prefix-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('prefix_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-prefix-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_control(
            'prefix_color',
            [
                'label'		 =>esc_html__('Color', 'raveen'),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .rivax-fancy-prefix-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'prefix_color_dark_mode',
            [
                'label'		 =>esc_html__('Color - Dark Mode', 'raveen'),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-prefix-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'prefix_bg',
                'label' => esc_html__( 'Background', 'raveen'),
                'types' => [ 'classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-fancy-prefix-text',
            ]
        );

        $this->add_control(
            'heading_prefix_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'prefix_bg_dark_mode',
                'label' => esc_html__( 'Background', 'raveen'),
                'types' => [ 'classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-fancy-prefix-text',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'fancy_lists_style_section',
            [
                'label' => esc_html__('Fancy Text Lists', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'fancy_lists_typography',
                'selector' => '{{WRAPPER}} .rivax-fancy-text-item',
            ]
        );

        $this->add_control(
            'fancy_lists_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fancy_lists_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $support_gradient = ['clip', 'rotate-1', 'bar-loading', 'slide', 'zoom-out', 'zoom-fade', 'push'];

        $this->add_control(
            'fancy_gradient',
            [
                'label'     => esc_html__( 'Gradient Color', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition'	=> [
                    'fancy_animation_type' => $support_gradient,
                ],
            ]
        );

        $this->add_control(
            'fancy_lists_gradient_color',
            [
                'label' => esc_html__( 'Gradient Color', 'raveen' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition'	=> [
                    'fancy_gradient!' => '',
                    'fancy_animation_type' => $support_gradient,
                ],
            ]
        );

        $this->start_popover();

        $this->add_control(
            'gradient_color_01',
            [
                'label' => esc_html__('Color One', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition'	=> [
                    'fancy_lists_gradient_color' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'gradient_color_02',
            [
                'label' => esc_html__('Color Two', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition'	=> [
                    'fancy_lists_gradient_color' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_color_03',
            [
                'label' => esc_html__('Color Three', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition'	=> [
                    'fancy_lists_gradient_color' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gradient-list .rivax-fancy-text-item' => 'background-image: linear-gradient(90deg, {{gradient_color_01.VALUE}} 0%, {{gradient_color_02.VALUE}} 50%, {{gradient_color_03.VALUE}} 100%)!important',
                ],
            ]
        );

        $this->end_popover();


        $this->add_control(
            'fancy_lists_gradient_color_dark_mode',
            [
                'label' => esc_html__( 'Gradient Color - Dark Mode', 'raveen' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition'	=> [
                    'fancy_gradient!' => '',
                    'fancy_animation_type' => $support_gradient,
                ],
            ]
        );

        $this->start_popover();

        $this->add_control(
            'gradient_color_01_dark_mode',
            [
                'label' => esc_html__('Color One', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition'	=> [
                    'fancy_lists_gradient_color_dark_mode' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'gradient_color_02_dark_mode',
            [
                'label' => esc_html__('Color Two', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition'	=> [
                    'fancy_lists_gradient_color_dark_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_color_03_dark_mode',
            [
                'label' => esc_html__('Color Four', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition'	=> [
                    'fancy_lists_gradient_color_dark_mode' => 'yes',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .gradient-list .rivax-fancy-text-item' => 'background-image: linear-gradient(90deg, {{gradient_color_01_dark_mode.VALUE}} 0%, {{gradient_color_02_dark_mode.VALUE}} 50%, {{gradient_color_03_dark_mode.VALUE}} 100%)!important',
                ],
            ]
        );

        $this->end_popover();


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fancy_lists_bg',
                'label' => esc_html__( 'Background', 'raveen'),
                'types' => [ 'classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-fancy-text-list',
            ]
        );

        $this->add_control(
            'heading_fancy_lists_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fancy_lists_bg_dark_mode',
                'label' => esc_html__( 'Background', 'raveen'),
                'types' => [ 'classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-fancy-text-list',
            ]
        );

        $this->add_responsive_control(
            'fancy_lists_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fancy_lists_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'allowed_dimensions' => ['right', 'left'],
                'placeholder' => [
                    'top' => 'auto',
                    'right' => '',
                    'bottom' => 'auto',
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('fancy_lists_radius',
            [
                'label' => esc_html__('Border Radius', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);


        $this->end_controls_section();


        $this->start_controls_section(
            'fancy_cursor_style_section',
            [
                'label' => esc_html__('Fancy Cursor', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'	=> [
                    'fancy_animation_type' => ['clip', 'bar-loading','type'],
                ],
            ]
        );

        $this->add_control(
            'fancy_cursor_color',
            [
                'label' => esc_html__('Cursor Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text.clip .rivax-fancy-text-list::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rivax-fancy-text.type .rivax-fancy-text-list::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rivax-fancy-text.bar-loading .rivax-fancy-text-list::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fancy_cursor_color_dark_mode',
            [
                'label' => esc_html__('Cursor Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text.clip .rivax-fancy-text-list::after' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text.type .rivax-fancy-text-list::after' => 'background-color: {{VALUE}};',
                    'body.dark-mode {{WRAPPER}} .rivax-fancy-text.bar-loading .rivax-fancy-text-list::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fancy_cursor_width',
            [
                'label' => esc_html__( 'Cursor Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'condition'	=> [
                    'fancy_animation_type' => ['clip','type'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text.clip .rivax-fancy-text-list::after' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .rivax-fancy-text.type .rivax-fancy-text-list::after' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'fancy_cursor_height',
            [
                'label' => esc_html__( 'Cursor Height', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition'	=> [
                    'fancy_animation_type' => ['clip','type'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text.clip .rivax-fancy-text-list::after' => 'height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .rivax-fancy-text.type .rivax-fancy-text-list::after' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'fancy_loading_bar_height',
            [
                'label' => esc_html__( 'Loading Bar Height', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 15,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'condition'	=> [
                    'fancy_animation_type' => 'bar-loading',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-fancy-text.bar-loading .rivax-fancy-text-list::after' => 'height: {{SIZE}}{{UNIT}}',
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