<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Contact_Form_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-contact-form';
    }

    public function get_title() {
        return esc_html__('Contact Form', 'raveen');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_info',
            [
                'label' => esc_html__('Info', 'raveen'),
            ]
        );

        $this->add_control(
            'form_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => sprintf(esc_html__('This is a simple form and the message will be sent to the admin email. If you need an advanced form builder %s Browse here %s.', 'raveen'), '<a href="https://wordpress.org/plugins/search/contact/" target="_blank">', '</a>'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'raveen'),
            ]
        );
		
		$this->add_control(
            'show_label',
            [
                'label'     => esc_html__( 'Show Label', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'fields_spacing',
            [
                'label' => esc_html__( 'Fields Spacing', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fields-wrapper' => 'row-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'heading_first_name',
            [
                'label'     => esc_html__( 'First Name', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'first_name_label',
            [
                'label' => esc_html__( 'Label', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'First Name', 'raveen' ),
            ]
        );

        $this->add_control(
            'first_name_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'First Name', 'raveen' ),
            ]
        );

        $this->add_responsive_control(
            'first_name_width',
            [
                'label' => esc_html__( 'Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .first-name-wrap' => 'width: {{SIZE}}%',
                ],
            ]
        );

        $this->add_control(
            'heading_last_name',
            [
                'label'     => esc_html__( 'Last Name', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_last_name',
            [
                'label'     => esc_html__( 'Show Last Name', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'last_name_label',
            [
                'label' => esc_html__( 'Label', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Last Name', 'raveen' ),
                'condition' => [
                    'show_last_name' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'last_name_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Last Name', 'raveen' ),
                'condition' => [
                    'show_last_name' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'last_name_width',
            [
                'label' => esc_html__( 'Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .last-name-wrap' => 'width: {{SIZE}}%',
                ],
                'condition' => [
                    'show_last_name' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_email',
            [
                'label'     => esc_html__( 'Email', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'email_label',
            [
                'label' => esc_html__( 'Label', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Email', 'raveen' ),
            ]
        );

        $this->add_control(
            'email_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Email', 'raveen' ),
            ]
        );

        $this->add_responsive_control(
            'email_width',
            [
                'label' => esc_html__( 'Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .email-wrap' => 'width: {{SIZE}}%',
                ],
            ]
        );

        $this->add_control(
            'heading_subject',
            [
                'label'     => esc_html__( 'Subject', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_subject',
            [
                'label'     => esc_html__( 'Show Subject', 'raveen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'subject_label',
            [
                'label' => esc_html__( 'Label', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Subject', 'raveen' ),
                'condition' => [
                    'show_subject' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'subject_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Subject', 'raveen' ),
                'condition' => [
                    'show_subject' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'subject_width',
            [
                'label' => esc_html__( 'Width', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .subject-wrap' => 'width: {{SIZE}}%',
                    'condition' => [
                        'show_subject' => 'yes',
                    ],
                ],
            ]
        );

        $this->add_control(
            'heading_message',
            [
                'label'     => esc_html__( 'Message', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'message_label',
            [
                'label' => esc_html__( 'Label', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Message', 'raveen' ),
            ]
        );

        $this->add_control(
            'message_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Your Message', 'raveen' ),
            ]
        );

        $this->add_control(
            'heading_button',
            [
                'label'     => esc_html__( 'Button', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_label',
            [
                'label' => esc_html__( 'Label', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_attr__( 'Submit Form', 'raveen' ),
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label' => esc_html__( 'Spacing', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .submit-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .submit-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();


        $this->start_controls_section(
            'section_message',
            [
                'label' => esc_html__('Message', 'raveen'),
            ]
        );

        $this->add_control(
            'success_msg',
            [
                'label' => esc_html__( 'Success', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_attr__( 'Thank you. Your message was sent successfully.', 'raveen' ),
            ]
        );

        $this->add_control(
            'fill_msg',
            [
                'label' => esc_html__( 'Fill All Fields', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_attr__( 'Please fill in all fields.', 'raveen' ),
            ]
        );

        $this->add_control(
            'error_msg',
            [
                'label' => esc_html__( 'Error', 'raveen' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_attr__( 'An error occurred! Please try again.', 'raveen' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_label',
            [
                'label' => esc_html__('Label', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_margin',
            [
                'label' => esc_html__('Margin', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'label_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'label_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'label_shadow',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} label',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} label',
            ]);

        $this->start_controls_tabs( 'tabs_label' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_label_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control('label_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('label_bg',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'label_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} label',
            ]
        );

        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_label_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control('label_color_dark_mode',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} label' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('label_bg_dark_mode',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} label' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('label_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'label_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} label' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_input',
            [
                'label' => esc_html__('Input', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} input, {{WRAPPER}} textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} input, {{WRAPPER}} textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'input_font_size',
            [
                'label' => esc_html__( 'Font Size', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} input, {{WRAPPER}} textarea' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_input' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control('input_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input, {{WRAPPER}} textarea' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('input_bg',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input, {{WRAPPER}} textarea' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'input_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder, {{WRAPPER}} ::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_shadow',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} input, {{WRAPPER}} textarea',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_shadow_focus',
                'label' => esc_html__( 'Box Shadow - Focus', 'raveen' ),
                'selector' => '{{WRAPPER}} input:focus, {{WRAPPER}} textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} input, {{WRAPPER}} textarea',
            ]
        );

        $this->add_control('input_border_color_focus',
            [
                'label' => esc_html__('Border Color - Focus', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'input_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} input:focus, {{WRAPPER}} textarea:focus' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_input_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control('input_color_dark_mode',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} input, body.dark-mode {{WRAPPER}} textarea' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('input_bg_dark_mode',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} input, body.dark-mode {{WRAPPER}} textarea' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control(
            'input_placeholder_color_dark_mode',
            [
                'label' => esc_html__('Placeholder Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} ::-webkit-input-placeholder, body.dark-mode {{WRAPPER}} ::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control('input_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'input_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} input, body.dark-mode {{WRAPPER}} textarea' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('input_border_color_dark_mode_focus',
            [
                'label' => esc_html__('Border Color - Focus', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'input_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} input:focus, body.dark-mode {{WRAPPER}} textarea:focus' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_textarea',
            [
                'label' => esc_html__('Textarea', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'textarea_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .field-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_height',
            [
                'label' => esc_html__( 'Height', 'raveen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .field-wrap textarea' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_submit',
            [
                'label' => esc_html__('Submit Button', 'raveen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'submit_padding',
            [
                'label' => esc_html__('Padding', 'raveen'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'submit_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'raveen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'label' => esc_html__('Typography', 'raveen'),
                'selector' => '{{WRAPPER}} .submit-btn',
            ]);

        $this->start_controls_tabs( 'tabs_submit' );

        /**
         * Normal.
         */
        $this->start_controls_tab(
            'tab_submit_normal',
            [
                'label' => esc_html__( 'Normal', 'raveen' ),
            ]
        );

        $this->add_control('submit_color',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_color_hover',
            [
                'label' => esc_html__('Color - Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-btn:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_bg',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_bg_hover',
            [
                'label' => esc_html__('Background - Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-btn:hover' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_shadow',
                'label' => esc_html__( 'Box Shadow', 'raveen' ),
                'selector' => '{{WRAPPER}} .submit-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_shadow_hover',
                'label' => esc_html__( 'Box Shadow - Hover', 'raveen' ),
                'selector' => '{{WRAPPER}} .submit-btn:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'label' => esc_html__( 'Border', 'raveen' ),
                'selector' => '{{WRAPPER}} .submit-btn',
            ]
        );

        $this->add_control('submit_border_color_hover',
            [
                'label' => esc_html__('Border Color - Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'submit_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .submit-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->end_controls_tab();

        /**
         * Dark Mode.
         */
        $this->start_controls_tab(
            'tab_submit_dark_mode',
            [
                'label' => esc_html__( 'Dark Mode', 'raveen' ),
            ]
        );

        $this->add_control('submit_color_dark_mode',
            [
                'label' => esc_html__('Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .submit-btn' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_color_dark_mode_hover',
            [
                'label' => esc_html__('Color - Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .submit-btn:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_bg_dark_mode',
            [
                'label' => esc_html__('Background', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .submit-btn' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_bg_dark_mode_hover',
            [
                'label' => esc_html__('Background - Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .submit-btn:hover' => 'background: {{VALUE}};',
                ],
            ]);


        $this->add_control('submit_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'submit_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .submit-btn' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('submit_border_color_dark_mode_hover',
            [
                'label' => esc_html__('Border Color - Hover', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'submit_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .submit-btn:hover' => 'border-color: {{VALUE}};',
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