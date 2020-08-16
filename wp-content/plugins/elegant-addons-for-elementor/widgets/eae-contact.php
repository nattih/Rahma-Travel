<?php
namespace ElegantAddons\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Contact extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'eae-contact';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'EAE Contact Form 7', 'elegant-addons-for-elementor' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_style_depends() {
        return [
            'elegant-addons-css'
        ];
    }

     /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'elegant-addons' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {
       $this->start_controls_section(
            'eae_section_wpcf7_form',
            [
                'label' => esc_html__( 'Contact Form', 'elegant-addons-for-elementor' )
            ]
        );

       if ( function_exists( 'wpcf7' ) ) {
            $this->add_control(
                'eae_wpcf7_form_select',
                [
                    'label' => esc_html__( 'Select your contact form 7', 'elegant-addons-for-elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::SELECT,
                    'options' => get_contact_form_7_forms(),
                ]
            );
        } else {
            $this->add_control(
                'eae_no_contact_form_notice',
                [
                    'label' => __('Download And Install Contact Form 7', 'elegant-addons-elementor'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'default' => '1',
                    'description' => '<p><strong>Elementor Contact Form 7 widget</strong> needs <strong>Contact Form 7</strong> plugin to be installed. Please install the plugin now! </p>',
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_section_contact_form_styles',
            [
                'label' => esc_html__( 'Form Container Styles', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'eae_contact_form_background',
            [
                'label' => esc_html__( 'Form Background Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container' => 'background: {{VALUE}};',
                ],
            ]
        );
        // $this->add_responsive_control(
        //     'eae_contact_form_alignment',
        //     [
        //         'label' => esc_html__( 'Form Alignment', 'elegant-addons-for-elementor' ),
        //         'type' => Controls_Manager::CHOOSE,
        //         'label_block' => true,
        //         'options' => [
        //             'default' => [
        //                 'title' => __( 'Default', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-ban',
        //             ],
        //             'left' => [
        //                 'title' => esc_html__( 'Left', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-align-left',
        //             ],
        //             'center' => [
        //                 'title' => esc_html__( 'Center', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-align-center',
        //             ],
        //             'right' => [
        //                 'title' => esc_html__( 'Right', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-align-right',
        //             ],
        //         ],
        //         'default' => 'default',
        //         'prefix_class' => 'eae-contact-form-align-',
        //     ]
        // );
        $this->add_responsive_control(
            'eae_contact_form_width',
            [
                'label' => esc_html__( 'Form Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input, {{WRAPPER}} .eae-contact-form-container textarea, {{WRAPPER}} .eae-contact-form-container label' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_max_width',
            [
                'label' => esc_html__( 'Form Max Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_margin',
            [
                'label' => esc_html__( 'Form Margin', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_padding',
            [
                'label' => esc_html__( 'Form Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eae_contact_form_border',
                'selector' => '{{WRAPPER}} .eae-contact-form-container',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eae_contact_form_box_shadow',
                'selector' => '{{WRAPPER}} .eae-contact-form-container',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'eae_section_contact_form_field_styles',
            [
                'label' => esc_html__( 'Form Fields Styles', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'eae_contact_form_input_background',
            [
                'label' => esc_html__( 'Input Field Background', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_input_width',
            [
                'label' => esc_html__( 'Input Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, input.wpcf7-date' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_textarea_width',
            [
                'label' => esc_html__( 'Textarea Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_textarea_height',
            [
                'label' => esc_html__( 'Textarea height', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_contact_form_input_margin_buttom',
            [
                'label' => esc_html__( 'Margin Bottom', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea, .eae-contact-form-container input.wpcf7-text, .eae-contact-form-container .wpcf7-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_input_padding',
            [
                'label' => esc_html__( 'Fields Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eae_contact_form_input_border',
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea, .eae-contact-form-container input.wpcf7-date'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eae_contact_form_input_box_shadow',
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea',
            ]
        );
        $this->add_control(
            'eae_contact_form_focus_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Focus State Style', 'elegant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eae_contact_form_input_focus_box_shadow',
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text:focus, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea:focus',
            ]
        );
        $this->add_control(
            'eae_contact_form_input_focus_border',
            [
                'label' => esc_html__( 'Border Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    'body {{WRAPPER}} .eae-contact-form-container input.wpcf7-text:focus, body {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'eae_section_contact_form_typography',
            [
                'label' => esc_html__( 'Color & Typography', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'eae_contact_form_label_color',
            [
                'label' => esc_html__( 'Label Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container, {{WRAPPER}} .eae-contact-form-container .wpcf7-form label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_field_color',
            [
                'label' => esc_html__( 'Field Font Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_placeholder_color',
            [
                'label' => esc_html__( 'Placeholder Font Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eae-contact-form-container ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eae-contact-form-container ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_label_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Label Typography', 'elegant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'eae_contact_form_label_typography',
                'selector' => '{{WRAPPER}} .eae-contact-form-container, {{WRAPPER}} .eae-contact-form-container .wpcf7-form label',
            ]
        );
        $this->add_control(
            'eae_contact_form_heading_input_field',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Input Fields Typography', 'elegant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'eae_contact_form_input_field_typography',
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-text, {{WRAPPER}} .eae-contact-form-container textarea.wpcf7-textarea',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'eae_section_contact_form_submit_button_styles',
            [
                'label' => esc_html__( 'Submit Button Styles', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_submit_btn_width',
            [
                'label' => esc_html__( 'Button Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // $this->add_responsive_control(
        //     'eae_contact_form_submit_btn_alignment',
        //     [
        //         'label' => esc_html__( 'Button Alignment', 'elegant-addons-for-elementor' ),
        //         'type' => Controls_Manager::CHOOSE,
        //         'label_block' => true,
        //         'options' => [
        //             'default' => [
        //                 'title' => __( 'Default', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-ban',
        //             ],
        //             'left' => [
        //                 'title' => esc_html__( 'Left', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-align-left',
        //             ],
        //             'center' => [
        //                 'title' => esc_html__( 'Center', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-align-center',
        //             ],
        //             'right' => [
        //                 'title' => esc_html__( 'Right', 'elegant-addons-for-elementor' ),
        //                 'icon' => 'fa fa-align-right',
        //             ],
        //         ],
        //         'default' => 'default',
        //         'selectors' => [
        //             '{{WRAPPER}} .eae-contact-form-container p input[type=submit]' => 'text-align: {{VALUE}};',
        //         ],
        //     ]
        // );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'eae_contact_form_submit_btn_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit',
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_submit_btn_margin',
            [
                'label' => esc_html__( 'Margin', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_contact_form_submit_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs( 'eae_contact_form_submit_button_tabs' );
        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'elegant-addons-for-elementor' ) ] );
        $this->add_control(
            'eae_contact_form_submit_btn_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_submit_btn_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eae_contact_form_submit_btn_border',
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit',
            ]
        );
        $this->add_control(
            'eae_contact_form_submit_btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'eae_contact_form_submit_btn_hover', [ 'label' => esc_html__( 'Hover', 'elegant-addons-for-elementor' ) ] );
        $this->add_control(
            'eae_contact_form_submit_btn_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_submit_btn_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eae_contact_form_submit_btn_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eae_contact_form_submit_btn_box_shadow',
                'selector' => '{{WRAPPER}} .eae-contact-form-container input.wpcf7-submit',
            ]
        );
        $this->end_controls_section();

        $this->end_controls_section();



    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
       $settings = $this->get_settings();
    ?>

    <?php if ( ! empty( $settings['eae_wpcf7_form_select'] ) ) : ?>
        <div class="eae-contact-form-container">
            <?php echo do_shortcode( '[contact-form-7 id="' . $settings['eae_wpcf7_form_select'] . '" ]' ); ?>
        </div>
    <?php endif; ?>

    <?php
    }
}
