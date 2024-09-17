<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Mailchimp_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-mailchimp';
    }

    public function get_title() {
        return esc_html__('Mailchimp', 'raveen');
    }

    public function get_icon() {
        return 'eicon-mailchimp';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }



	public function get_mailchimp_lists(  ) {

		$api_key = rivax_get_option('mailchimp-api-key');

		$options = [];

		$server = explode( '-', $api_key );

		if ( ! isset( $server[1] ) ) {
			return [];
		}

		$transient_id = 'rivax-mailchimp-list';

		if( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$saved_list = get_transient($transient_id);
			if(is_array($saved_list)) {
				return $saved_list;
			}
		}



		$url = 'https://' . $server[1] . '.api.mailchimp.com/3.0/lists';

		$response = wp_remote_post(
			$url,
			[
				'method'      => 'GET',
				'data_format' => 'body',
				'timeout'     => 45,
				'headers'     => [

					'Authorization' => 'apikey ' . $api_key,
					'Content-Type'  => 'application/json; charset=utf-8',
				],
				'body'        => '',
			]
		);

		if ( is_array( $response ) && ! is_wp_error( $response ) ) {

			$body   = (array) json_decode( $response['body'] );
			$listed = isset( $body['lists'] ) ? $body['lists'] : [];

			if ( is_array( $listed ) && count( $listed ) > 0 ) {
				foreach ($listed as $list_item) {
					$options[$list_item->id ] = $list_item->name;
				}
			}
		}


		set_transient( $transient_id, $options );

		return $options;
	}


    protected function register_controls()
    {

        $this->start_controls_section(
            'section_mailchimp',
            [
                'label' => esc_html__( 'Mailchimp', 'raveen' ),
            ]
        );

	    $this->add_control(
		    'mailchimp_api_info',
		    [
			    'type'      => Controls_Manager::RAW_HTML,
			    'raw'       => sprintf(esc_html__('Please set the API Key in %s theme settings %s.', 'raveen'), '<a href="' . admin_url('admin.php?page=rivax-settings') . '" target="_blank">', '</a>'),
			    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',

		    ]
	    );

	    $this->add_control(
		    'mailchimp_list',
		    [
			    'label' => esc_html__( 'Mailchimp List', 'raveen' ),
			    'type' => Controls_Manager::SELECT,
			    'options' => $this->get_mailchimp_lists(),
		    ]
	    );

        $this->end_controls_section();



	    $this->start_controls_section(
		    'section_form',
		    [
			    'label' => esc_html__( 'Form', 'raveen' ),
			    'tab'   => Controls_Manager::TAB_CONTENT,
		    ]
	    );

	    $this->add_control(
		    'enable_name',
		    [
			    'label'        => esc_html__( 'Enable Name?', 'raveen' ),
			    'type'         => Controls_Manager::SWITCHER,
		    ]
	    );

	    $this->add_control(
		    'fname_heading',
		    [
			    'label'     => esc_html__( 'First Name:', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
			    'condition' => [
				    'enable_name!' => '',
			    ],
		    ]
	    );

	    $this->add_control(
		    'fname_label',
		    [
			    'label'       => esc_html__( 'Label', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'placeholder' => esc_html__( 'First Name input label', 'raveen' ),
			    'condition'   => [
				    'enable_name!' => '',
			    ],
		    ]
	    );

	    $this->add_control(
		    'fname_placeholder',
		    [
			    'label'       => esc_html__( 'Placeholder', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'default'     => esc_html__( 'First Name', 'raveen' ),
			    'placeholder' => esc_html__( 'First Name input placeholder', 'raveen' ),
			    'condition'   => [
				    'enable_name!' => '',
			    ],
		    ]
	    );

	    
	    $this->add_control(
		    'lname_heading',
		    [
			    'label'     => esc_html__( 'Last Name:', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
			    'condition' => [
				    'enable_name!' => '',
			    ],
		    ]
	    );

	    $this->add_control(
		    'lname_label',
		    [
			    'label'       => esc_html__( 'Label', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'placeholder' => esc_html__( 'Last Name input label', 'raveen' ),
			    'condition'   => [
				    'enable_name!' => '',
			    ],
		    ]
	    );

	    $this->add_control(
		    'lname_placeholder',
		    [
			    'label'       => esc_html__( 'Placeholder', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'default'     => esc_html__( 'Last Name', 'raveen' ),
			    'placeholder' => esc_html__( 'Last Name input placeholder', 'raveen' ),
			    'condition'   => [
				    'enable_name!' => '',
			    ],
		    ]
	    );


	    $this->add_control(
		    'enable_phone',
		    [
			    'label'        => esc_html__( 'Enable Phone?', 'raveen' ),
			    'type'         => Controls_Manager::SWITCHER,
		    ]
	    );

	    $this->add_control(
		    'phone_heading',
		    [
			    'label'     => esc_html__( 'Phone:', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
			    'condition' => [
				    'enable_phone!' => '',
			    ],
		    ]
	    );

	    $this->add_control(
		    'phone_label',
		    [
			    'label'       => esc_html__( 'Label', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'placeholder' => esc_html__( 'Phone input label', 'raveen' ),
			    'condition'   => [
				    'enable_phone!' => '',
			    ],
		    ]
	    );

	    $this->add_control(
		    'phone_placeholder',
		    [
			    'label'       => esc_html__( 'Placeholder', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'default'     => esc_html__( 'Phone', 'raveen' ),
			    'placeholder' => esc_html__( 'Phone input placeholder', 'raveen' ),
			    'condition'   => [
				    'enable_phone!' => '',
			    ],
		    ]
	    );


	    $this->add_control(
		    'email_heading',
		    [
			    'label'     => esc_html__( 'Email:', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

	    $this->add_control(
		    'email_label',
		    [
			    'label'       => esc_html__( 'Label', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'placeholder' => esc_html__( 'Email input label', 'raveen' ),
		    ]
	    );

	    $this->add_control(
		    'email_placeholder',
		    [
			    'label'       => esc_html__( 'Placeholder', 'raveen' ),
			    'type'        => Controls_Manager::TEXT,
			    'default'     => esc_html__( 'Email', 'raveen' ),
			    'placeholder' => esc_html__( 'Email input placeholder', 'raveen' ),
		    ]
	    );


	    $this->add_control(
		    'button_heading',
		    [
			    'label'     => esc_html__( 'Button:', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

	    $this->add_control(
		    'button_text',
		    [
			    'label'   => esc_html__( 'Text', 'raveen' ),
			    'type'    => Controls_Manager::TEXT,
			    'default' => esc_html__( 'Subscribe', 'raveen' ),
			    'placeholder' => esc_html__( 'Button Text', 'raveen' ),
		    ]
	    );

	    $this->add_control(
		    'button_icon',
		    [
			    'label' => esc_html__( 'Icon', 'raveen' ),
			    'type' => Controls_Manager::ICONS,
		    ]
	    );

	    $this->add_control(
		    'button_icon_position', [
			    'label' => esc_html__('Icon Position', 'raveen'),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [

				    '1' => [
					    'title' => esc_html__('Before', 'raveen'),
					    'icon' => 'eicon-order-start',
				    ],
				    '3' => [
					    'title' => esc_html__('After', 'raveen'),
					    'icon' => 'eicon-order-end',
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button .button-icon' => 'order: {{VALUE}};',
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
					    'max' => 50,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button' => 'gap: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_success_error_label',
		    [
			    'label' => esc_html__( 'Success & Error', 'raveen' ),
			    'tab'   => Controls_Manager::TAB_CONTENT,
		    ]
	    );

	    $this->add_control(
		    'mailchimp_success_message_show_in_editor',
		    [
			    'label'        => esc_html__( 'Success Message Show in Editor?', 'raveen' ),
			    'type'         => Controls_Manager::SWITCHER,
		    ]
	    );

	    $this->add_control(
		    'mailchimp_error_message_show_in_editor',
		    [
			    'label'        => esc_html__( 'Error Message Show in Editor?', 'raveen' ),
			    'type'         => Controls_Manager::SWITCHER,
		    ]
	    );

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_style_form',
		    [
			    'label' => esc_html__('Form', 'raveen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_responsive_control(
		    'form_align', [
			    'label' => esc_html__('Alignment', 'raveen'),
			    'type' => Controls_Manager::CHOOSE,
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
				    '{{WRAPPER}} .rivax-mailchimp-form' => 'justify-content: {{VALUE}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'form_nowrap',
		    [
			    'label' => esc_html__( 'Force Place Items In One Row', 'raveen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [
				    'wrap' => [
					    'title' => esc_html__( 'No', 'raveen' ),
					    'icon' => 'eicon-close',
				    ],
				    'nowrap' => [
					    'title' => esc_html__( 'Yes', 'raveen' ),
					    'icon' => 'eicon-check',
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-form' => 'flex-wrap: {{VALUE}}'
			    ],
		    ]
	    );

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_style_label',
		    [
			    'label' => esc_html__('Label', 'raveen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control(
		    'label_margin',
		    [
			    'label' => esc_html__('Margin', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'label_color',
		    [
			    'label' => esc_html__('Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input-label' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'label_typography',
			    'label' => esc_html__('Typography', 'raveen'),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-input-label',
		    ]);

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_style_input',
		    [
			    'label' => esc_html__('Input', 'raveen'),
			    'tab' => Controls_Manager::TAB_STYLE,
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
				    '{{WRAPPER}} .rivax-mailchimp-form' => 'margin: 0 calc( {{SIZE}}{{UNIT}} / -2 );',
				    '{{WRAPPER}} .rivax-mailchimp-input-wrapper' => 'padding: 0 calc( {{SIZE}}{{UNIT}} / 2 );',
				    '{{WRAPPER}} .rivax-mailchimp-button-wrapper' => 'padding: 0 calc( {{SIZE}}{{UNIT}} / 2 );',
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
				    '{{WRAPPER}} .rivax-mailchimp-form' => 'row-gap: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'input_width',
		    [
			    'label'     => esc_html__( 'Width', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', '%' ],
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 600,
				    ],
				    '%' => [
					    'min' => 0,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input-wrapper' => 'width: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'input_padding',
		    [
			    'label' => esc_html__('Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				    '{{WRAPPER}} .rivax-mailchimp-input input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'input_color',
		    [
			    'label' => esc_html__('Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input input' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_control(
		    'input_placeholder_color',
		    [
			    'label' => esc_html__('Placeholder Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input input::-webkit-input-placeholder, {{WRAPPER}} .rivax-mailchimp-input input::placeholder' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_control(
		    'input_background',
		    [
			    'label' => esc_html__('Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-input input' => 'background: {{VALUE}}',
			    ],
		    ]
	    );

        $this->add_control(
            'input_bg_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-input input' => 'background: {{VALUE}}',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'input_border',
			    'label' => esc_html__( 'Border', 'raveen' ),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-input input',
		    ]
	    );

        $this->add_control('input_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'input_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-input input' => 'border-color: {{VALUE}};',
                ],
            ]);

	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'input_shadow',
			    'label' => esc_html__( 'Box Shadow', 'raveen' ),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-input input',
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'input_typography',
			    'label' => esc_html__('Typography', 'raveen'),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-input input',
		    ]);

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_style_button',
		    [
			    'label' => esc_html__('Button', 'raveen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control(
		    'button_position',
		    [
			    'label'   => esc_html__( 'Button Position', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'inline',
			    'options' => [
				    'inline'           => esc_html__( 'Inline', 'raveen' ),
				    'bottom'           => esc_html__( 'Bottom', 'raveen' ),
				    'float'            => esc_html__( 'Float', 'raveen' ),
			    ],
			    'prefix_class' => 'button-position-',
		    ]
	    );


	    $this->add_responsive_control(
		    'button_width',
		    [
			    'label'   => esc_html__( 'Button Width', 'raveen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'auto',
			    'options' => [
				    'auto'           => esc_html__( 'Auto', 'raveen' ),
				    '100%'            => esc_html__( 'Full', 'raveen' ),
			    ],
			    'condition' => [
				    'button_position' => 'bottom',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button' => 'width: {{VALUE}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'button_align', [
			    'label' => esc_html__('Alignment', 'raveen'),
			    'type' => Controls_Manager::CHOOSE,
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
			    'condition' => [
				    'button_position' => 'bottom',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button-wrapper' => 'text-align: {{VALUE}};',
			    ],
		    ]
	    );


	    $this->add_control(
		    'button_float_right',
		    [
			    'label'     => esc_html__( 'Right', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button-wrapper' => 'right: {{SIZE}}{{UNIT}};',
			    ],
			    'condition' => [
				    'button_position' => 'float',
			    ],
		    ]
	    );

	    $this->add_control(
		    'button_float_left',
		    [
			    'label'     => esc_html__( 'Left', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 0,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button-wrapper' => 'left: {{SIZE}}{{UNIT}};',
			    ],
			    'condition' => [
				    'button_position' => 'float',
			    ],
		    ]
	    );


	    $this->add_control(
		    'button_padding',
		    [
			    'label' => esc_html__('Padding', 'raveen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', 'em', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );



	    $this->add_control(
		    'button_border_radius',
		    [
			    'label' => esc_html__( 'Border Radius', 'raveen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'button_typography',
			    'label' => esc_html__('Typography', 'raveen'),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-button',
		    ]);


	    $this->start_controls_tabs('button_tabs');
	    # Normal State Tab
	    $this->start_controls_tab(
		    'button_tab_normal_state',
		    [
			    'label' => esc_html__('Normal', 'raveen'),
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'button_background',
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-button',
		    ]
	    );

        $this->add_control(
            'heading_button_bg_dark_mode',
            [
                'label'     => esc_html__( 'Background - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_bg_dark_mode',
                'exclude' => [ 'image' ],
                'selector' => 'body.dark-mode {{WRAPPER}} .rivax-mailchimp-button',
            ]
        );

	    $this->add_control(
		    'button_color',
		    [
			    'label' => esc_html__('Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

        $this->add_control(
            'button_color_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-button' => 'color: {{VALUE}}',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'button_border',
			    'label' => esc_html__( 'Border', 'raveen' ),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-button',
		    ]
	    );

        $this->add_control('button_border_color_dark_mode',
            [
                'label' => esc_html__('Border Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-button' => 'border-color: {{VALUE}};',
                ],
            ]);

	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'button_shadow',
			    'label' => esc_html__( 'Box Shadow', 'raveen' ),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-button',
		    ]
	    );

	    $this->end_controls_tab();

	    # Hover State Tab
	    $this->start_controls_tab(
		    'button_tab_hover_state',
		    [
			    'label' => esc_html__('Hover', 'raveen'),
		    ]
	    );

	    $this->add_control(
		    'button_background_hover',
		    [
			    'label' => esc_html__('Background', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button:hover' => 'background-color: {{VALUE}}',
			    ],
		    ]
	    );

        $this->add_control(
            'button_background_hover_dark_mode',
            [
                'label' => esc_html__('Background - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

	    $this->add_control(
		    'button_color_hover',
		    [
			    'label' => esc_html__('Color', 'raveen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button:hover' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

        $this->add_control(
            'button_color_hover_dark_mode',
            [
                'label' => esc_html__('Color - Dark Mode', 'raveen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

	    $this->add_control(
		    'button_border_color_hover',
		    [
			    'label'     => esc_html__( 'Border Color', 'raveen' ),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button:hover' => 'border-color: {{VALUE}};'
			    ],
			    'condition' => [
				    'button_border_border!' => ''
			    ]
		    ]
	    );

        $this->add_control(
            'button_border_color_hover_dark_mode',
            [
                'label'     => esc_html__( 'Border Color - Dark Mode', 'raveen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    'body.dark-mode {{WRAPPER}} .rivax-mailchimp-button:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'button_border_border!' => ''
                ]
            ]
        );

	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'button_box_shadow_hover',
			    'label' => esc_html__( 'Box Shadow', 'raveen' ),
			    'selector' => '{{WRAPPER}} .rivax-mailchimp-button:hover',
		    ]
	    );

	    $this->end_controls_tab();

	    $this->end_controls_tabs();



	    $this->add_control(
		    'button_icon_style_heading',
		    [
			    'label'     => esc_html__( 'Icon', 'raveen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

	    $this->add_control(
		    'button_icon_size',
		    [
			    'label'     => esc_html__( 'Size', 'raveen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 10,
					    'max' => 50,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-mailchimp-button .button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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