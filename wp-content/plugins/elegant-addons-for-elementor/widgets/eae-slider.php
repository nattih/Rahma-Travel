<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Slider extends Widget_Base {

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
        return 'eae_slider';
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
        return __( 'EAE Slider', 'elegant-addons-for-elementor' );
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
        return 'eicon-slider-full-screen';
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
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'eae-slick', 'eae-main-slider'];
    }

    public function get_style_depends() {
        return [ 'animate-css', 'elegant-addons-css' ];
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
            'ct_slider_section_slides',
            [
                'label' => __( 'Slides', 'elegant-addons-for-elementor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'ct_slider_slides_repeater' );

        $repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'elegant-addons-for-elementor' ) ] );

        $repeater->add_control(
            'ct_slider_background_color',
            [
                'label' => __( 'Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#bbbbbb',
            ]
        );

        $repeater->add_control(
            'ct_slider_background_image',
            [
                'label' => __( 'Image', 'Background Control', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-image: url({{URL}})',
                ],
            ]
        );

        $repeater->add_control(
            'ct_slider_background_size',
            [
                'label' => __( 'Size', 'Background Control', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => __( 'Cover', 'Background Control', 'elegant-addons-for-elementor' ),
                    'contain' => __( 'Contain', 'Background Control', 'elegant-addons-for-elementor' ),
                    'auto' => __( 'Auto', 'Background Control', 'elegant-addons-for-elementor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ct-slide-bg-img' => 'background-size: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'ct_slider_background_ken_burns',
            [
                'label' => __( 'Ken Burn Effect', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'separator' => 'before',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'ct_slider_zoom_direction',
            [
                'label' => __( 'Zoom Direction', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'in',
                'options' => [
                    'in' => __( 'In', 'elegant-addons-for-elementor' ),
                    'out' => __( 'Out', 'elegant-addons-for-elementor' ),
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_ken_burns',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        ct_custom_gradient( $repeater, '.slider-overlay', '.ct-gradient-overlay' );

        // $repeater->add_control(
        //     'ct_slider_background_overlay_blend_mode',
        //     [
        //         'label' => __( 'Blend Mode', 'elegant-addons-for-elementor' ),
        //         'type' => Controls_Manager::SELECT,
        //         'options' => [
        //             '' => __( 'Normal', 'elegant-addons-for-elementor' ),
        //             'multiply' => 'Multiply',
        //             'screen' => 'Screen',
        //             'overlay' => 'Overlay',
        //             'darken' => 'Darken',
        //             'lighten' => 'Lighten',
        //             'color-dodge' => 'Color Dodge',
        //             'color-burn' => 'Color Burn',
        //             'hue' => 'Hue',
        //             'saturation' => 'Saturation',
        //             'color' => 'Color',
        //             'exclusion' => 'Exclusion',
        //             'luminosity' => 'Luminosity',
        //         ],
        //         // 'conditions' => [
        //         //     'terms' => [
        //         //         [
        //         //             'name' => 'ct_slider_background_overlay',
        //         //             'value' => 'yes',
        //         //         ],
        //         //     ],
        //         // ],
        //         'selectors' => [
        //             '{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-background-overlay' => 'mix-blend-mode: {{VALUE}}',
        //         ],
        //     ]
        // );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( 'ct_slider_content', [ 'label' => __( 'Content', 'elegant-addons-for-elementor' ) ] );

        $repeater->add_control(
            'ct_slider_heading',
            [
                'label' => __( 'Title & Description', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Slide Heading', 'elegant-addons-for-elementor' ),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'ct_slider_description',
            [
                'label' => __( 'Description', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elegant-addons-for-elementor' ),
                'show_label' => false,
            ]
        );

        ct_button_control_content( $repeater, '', '', 'internal' );

        $repeater->end_controls_tab();

        if ( ELEGANT_ADDONS_PRO == 'pro' ) {
            eae_slider_content_pro( $repeater );
        }

        $repeater->end_controls_tabs();

        $this->add_control(
            'ct_slider_slides',
            [
                'label' => __( 'Slides', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ct_slider_heading' => __( 'Slide 1 Heading', 'elegant-addons-for-elementor' ),
                        'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elegant-addons-for-elementor' ),
                        'button_text' => __( 'Click Here', 'elegant-addons-for-elementor' ),
                        'background_color' => '#833ca3',
                    ],
                    [
                        'ct_slider_heading' => __( 'Slide 2 Heading', 'elegant-addons-for-elementor' ),
                        'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elegant-addons-for-elementor' ),
                        'button_text' => __( 'Click Here', 'elegant-addons-for-elementor' ),
                        'background_color' => '#4054b2',
                    ],
                    [
                        'ct_slider_heading' => __( 'Slide 3 Heading', 'elegant-addons-for-elementor' ),
                        'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elegant-addons-for-elementor' ),
                        'button_text' => __( 'Click Here', 'elegant-addons-for-elementor' ),
                        'background_color' => '#1abc9c',
                    ],
                ],
                'title_field' => '{{{ ct_slider_heading }}}',
            ]
        );

        $this->add_responsive_control(
            'ct_slider_slides_height',
            [
                'label' => __( 'Height', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 400,
                ],
                'size_units' => [ 'px', 'vh', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_slider_section_slider_options',
            [
                'label' => __( 'Slider Options', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SECTION,
            ]
        );

        $this->add_control(
            'ct_slider_navigation',
            [
                'label' => __( 'Navigation', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both' => __( 'Arrows and Dots', 'elegant-addons-for-elementor' ),
                    'arrows' => __( 'Arrows', 'elegant-addons-for-elementor' ),
                    'dots' => __( 'Dots', 'elegant-addons-for-elementor' ),
                    'none' => __( 'None', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'ct_slider_pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ct_slider_autoplay',
            [
                'label'     => __( 'Autoplay', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        if ( ELEGANT_ADDONS_PRO == 'pro' ) {
            $this->add_control(
                'ct_slider_autoplay_speed',
                [
                    'label' => __( 'Autoplay Speed', 'elegant-addons-for-elementor' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5000,
                    'condition' => [
                        'ct_slider_autoplay' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                    ],
                ]
            );
        }

        $this->add_control(
            'ct_slider_infinite',
            [
                'label' => __( 'Infinite Loop', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ct_slider_transition',
            [
                'label' => __( 'Transition', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __( 'Slide', 'elegant-addons-for-elementor' ),
                    'fade' => __( 'Fade', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'ct_slider_transition_speed',
            [
                'label' => __( 'Transition Speed', 'elegant-addons-for-elementor' ) . ' (ms)',
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $this->add_control(
            'ct_slider_content_animation',
            [
                'label' => __( 'Content Animation', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeInUp',
                'options' => [
                    '' => __( 'None', 'elegant-addons-for-elementor' ),
                    'fadeInDown' => __( 'Down', 'elegant-addons-for-elementor' ),
                    'fadeInUp' => __( 'Up', 'elegant-addons-for-elementor' ),
                    'fadeInRight' => __( 'Right', 'elegant-addons-for-elementor' ),
                    'fadeInLeft' => __( 'Left', 'elegant-addons-for-elementor' ),
                    'zoomIn' => __( 'Zoom', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();

        eae_pro_notice( $this );

        $this->start_controls_section(
            'ct_slider_section_style_slides',
            [
                'label' => __( 'Slides', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ct_slider_ct_slider_content_max_width',
            [
                'label' => __( 'Content Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'size' => '66',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slide .slick-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_slider_slides_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slide .slick-slide-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_main_content_position',
            [
                'label' => __( 'Content Position', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    ''              => esc_html__('Default', 'elegant-addons-for-elementor'),
                    'top-left'      => esc_html__('Top Left', 'elegant-addons-for-elementor') ,
                    'top-center'    => esc_html__('Top Center', 'elegant-addons-for-elementor') ,
                    'top-right'     => esc_html__('Top Right', 'elegant-addons-for-elementor') ,
                    'center'        => esc_html__('Center', 'elegant-addons-for-elementor') ,
                    'center-left'   => esc_html__('Center Left', 'elegant-addons-for-elementor') ,
                    'center-right'  => esc_html__('Center Right', 'elegant-addons-for-elementor') ,
                    'bottom-left'   => esc_html__('Bottom Left', 'elegant-addons-for-elementor') ,
                    'bottom-center' => esc_html__('Bottom Center', 'elegant-addons-for-elementor') ,
                    'bottom-right'  => esc_html__('Bottom Right', 'elegant-addons-for-elementor') ,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-container .slick-slide-content' => 'left: {{VALUE}}%; transform: translate( -{{VALUE}}%,-50%);',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_ct_slider_slides_text_align',
            [
                'label' => __( 'Text Align', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elegant-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slide .slick-slide-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_slider_section_style_title',
            [
                'label' => __( 'Title', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ct_slider_heading_spacing',
            [
                'label' => __( 'Spacing', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-title' => 'color: {{VALUE}}',

                ],
            ]
        );
        $this->add_control(
            'ct_slider_heading_bg_color',
            [
                'label' => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-title' => 'background-color: {{VALUE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            'ct_slider_heading_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_slider_heading_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .slick-slide-content .ct-slide-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_slider_section_style_description',
            [
                'label' => __( 'Description', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ct_slider_description_spacing',
            [
                'label' => __( 'Spacing', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_description_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-description' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_control(
            'ct_slider_description_bg_color',
            [
                'label' => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-description' => 'background-color: {{VALUE}}',

                ],
            ]
        );
        $this->add_responsive_control(
            'ct_slider_description_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-content .ct-slide-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_slider_description_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .slick-slide-content .ct-slide-description',
            ]
        );

        $this->end_controls_section();

        ct_button_control_style( $this );

        $this->start_controls_section(
            'ct_slider_navigation_style',
            [
                'label' => __( 'Arrows', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ct_slider_navigation' => [ 'arrows', 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_arrows',
            [
                'label' => __( 'Arrows', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ct_slider_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_arrows_size',
            [
                'label' => __( 'Size', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                    ],
                ],
                'condition' => [
                    'ct_slider_navigation' => [ 'arrows', 'both' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_slider_tabs_arrows_style' );

        $this->start_controls_tab(
            'ct_slider_tab_arrows_normal',
            [
                'label'                 => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_slider_arrows_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_arrows_color',
            [
                'label'                 => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#fff',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'ct_testimonial_arrows_border_normal',
                'label'                 => __( 'Border', 'elegant-addons-for-elementor' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .ct-slick-slider .slick-arrow'
            ]
        );

        $this->add_control(
            'ct_slider_arrows_border_radius_normal',
            [
                'label'                 => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_slider_tab_arrows_hover',
            [
                'label'                 => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_slider_arrows_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_arrows_color_hover',
            [
                'label'                 => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_arrows_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
            'ct_slider_arrow_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_slider_section_dots',
            [
                'label' => __( 'Dots', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_slider_pagination_dots_gap',
            [
                'label' => __( 'Dots gap', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
                // 'condition' => [
                //     'pagination!' => '',
                // ],
            ]
        );

         $this->add_control(
            'ct_slider_pagination_vertical_space',
            [
                'label' => __( 'Vertical Spacing', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
                // 'condition' => [
                //     'pagination!' => '',
                // ],
            ]
        );

        $this->add_control(
            'ct_slider_pagination_size',
            [
                'label' => __( 'Size', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                // 'condition' => [
                //     'pagination!' => '',
                // ],
            ]
        );

        $this->start_controls_tabs( 'ct_slider_tabs_dots_style' );

        $this->start_controls_tab(
            'ct_testimonial_tab_dots_normal',
            [
                'label'                 => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_slider_dots_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#000',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_pagination_active_color',
            [
                'label' => __( 'Active Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li.slick-active button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'ct_slider_dots_border_normal',
                'label'                 => __( 'Border', 'elegant-addons-for-elementor' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .ct-slick-slider .slick-dots li button'
            ]
        );

        $this->add_control(
            'ct_slider_dots_border_radius_normal',
            [
                'label'                 => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_slider_dots_arrows_hover',
            [
                'label'                 => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_slider_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_dots_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ct-slick-slider .slick-dots li button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
        $settings = $this->get_settings_for_display();
        $ct_navigation = '';

        if ( $settings['ct_slider_navigation'] == 'both' ) {
            $ct_navigation = '"arrows": true, "dots": true';
        } else if( $settings['ct_slider_navigation'] == 'arrows' ) {
            $ct_navigation = '"arrows": true, "dots": false';
        } else if ( $settings['ct_slider_navigation'] == 'dots' ) {
            $ct_navigation = '"dots": true, "arrows": false';
        } else if ( $settings['ct_slider_navigation'] == 'none' ) {
            $ct_navigation = '"dots": false, "arrows": false';
        }

        $ct_transition = 'false';
        if( $settings['ct_slider_transition'] == 'fade' ) {
            $ct_transition = 'true';
        }

        if ( isset( $settings['ct_slider_autoplay_speed'] ) ) {
            $autoplay_speed = esc_attr( $settings['ct_slider_autoplay_speed'] );
        } else {
            $autoplay_speed = 5000;
        }

        $pause_on_hover         = ( $settings['ct_slider_pause_on_hover'] == 'yes' ) ? 'true' : 'false';
        $autoplay               = ( $settings['ct_slider_autoplay'] == 'yes' ) ? 'true' : 'false';
        $infinite_loop          = ( $settings['ct_slider_infinite'] == 'yes' ) ? 'true' : 'false';
        $tranistion_duration    = esc_attr( $settings['ct_slider_transition_speed'] );

        $data_animation          = esc_attr( $settings['ct_slider_content_animation'] );
    ?>
         <div class="ct-slick-slider" data-slick='{
                <?php echo $ct_navigation; ?>,
                "pauseOnHover": <?php echo esc_attr( $pause_on_hover ); ?>,
                "autoplay": <?php echo esc_attr( $autoplay ); ?>,
                "autoplaySpeed": <?php echo esc_attr( $autoplay_speed ); ?>,
                "infinite": <?php echo esc_attr( $infinite_loop ); ?>,
                "fade": <?php echo esc_attr( $ct_transition ); ?>,
                "speed": <?php echo esc_attr( $tranistion_duration ); ?>
            }'>
            <?php foreach (  $settings['ct_slider_slides'] as $item ) { ?>
            <?php
                $ct_bg_img = ( $item['ct_slider_background_image']['url'] != '' ) ? "background-image: url( " . esc_url( $item['ct_slider_background_image']['url'] ) . " );" : '' ;

                    $ken_burn_effect = '';
                    if ( $item['ct_slider_background_ken_burns'] == 'yes' ) {
                        if ( $item['ct_slider_zoom_direction'] == 'in' ) {
                            $ken_burn_effect = 'ct-slider-ken-burn-zoom-in';
                        } else if( $item['ct_slider_zoom_direction'] == 'out' ) {
                            $ken_burn_effect = 'ct-slider-ken-burn-zoom-out';
                        }
                    }
            ?>

            <div class="ct-slick-slide elementor-repeater-item-<?php echo $item['_id']; ?>">
                <div class="ct-slide-bg-img <?php echo $ken_burn_effect; ?>" style="<?php echo $ct_bg_img; ?> background-color: <?php echo esc_attr( $item['ct_slider_background_color'] ); ?>"></div><!-- /.ct-slide-bg-img -->
                <div class="slider-overlay ct-gradient-overlay" <?php ct_custom_gradient_render( $item ); ?>></div><!-- /.slider-overlay -->
                <div class="slick-slide-container">
                    <div class="slick-slide-content slide-center text-center ct-position-<?php echo esc_attr( $item['ct_slider_content_position'] ); ?>">
                        <?php if( !empty( $item['ct_slider_heading'] ) ) : ?>
                            <h1 data-animation="<?php echo $data_animation; ?>" class="ct-slide-title"><?php echo esc_html( $item['ct_slider_heading'] ); ?></h1><!-- /.testimonial-author -->
                        <?php endif; ?>
                        <?php if( !empty( $item['ct_slider_description'] ) ) : ?>
                        <p class="ct-slide-description" data-animation="<?php echo $data_animation; ?>"><?php echo esc_html( $item['ct_slider_description'] ); ?></p>
                        <?php endif; ?>
                        <div class="ct-slide-button" data-animation="<?php echo $data_animation; ?>">
                            <?php ct_button_render( $perm = 'none', $settings = $item , $item = true ); ?>
                        </div><!-- /.ct-slide-button -->
                    </div><!-- /.slick-slide-content -->
                </div><!-- /.slick-slide-container -->
            </div><!-- /.ct-slick-slide -->
            <?php } // endfor ?>
        </div><!-- /.ct-slick-slider -->
    <?php
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template() {
        ?>
        <#
            var ct_navigation = '';

            if ( settings.ct_slider_navigation == 'both' ) {
                ct_navigation = '"arrows": true, "dots": true';
            } else if( settings.ct_slider_navigation == 'arrows' ) {
                ct_navigation = '"arrows": true, "dots": false';
            } else if ( settings.ct_slider_navigation == 'dots' ) {
                ct_navigation = '"dots": true, "arrows": false';
            } else if ( settings.ct_slider_navigation == 'none' ) {
                ct_navigation = '"dots": false, "arrows": false';
            }

            var ct_transition = 'false';
            if( settings.ct_slider_transition == 'fade' ) {
                var ct_transition = 'true';
            }

            if( settings.ct_slider_autoplay_speed == '' ) {
                var autoplay_speed      = settings.ct_slider_autoplay_speed;
            } else {
                var autoplay_speed      = 5000;
            }

            var pause_on_hover          = ( settings.ct_slider_pause_on_hover == 'yes' ) ? 'true' : 'false';
            var autoplay                = ( settings.ct_slider_autoplay == 'yes' ) ? 'true' : 'false';

            var infinite_loop           = ( settings.ct_slider_infinite == 'yes' ) ? 'true' : 'false';
            var tranistion_duration     = settings.ct_slider_transition_speed;

            var data_animation          = settings.ct_slider_content_animation;
        #>
            <div class="ct-slick-slider" data-slick='{
                {{ ct_navigation }},
                "pauseOnHover": {{ pause_on_hover }},
                "autoplay": {{ autoplay }},
                "autoplaySpeed": {{ autoplay_speed }},
                "infinite": {{ infinite_loop }},
                "fade": {{ ct_transition }},
                "speed": {{ tranistion_duration }}
            }'>
                <# _.each( settings.ct_slider_slides, function( item ) { #>
                <#
                    var ct_bg_img = ( item.ct_slider_background_image.url != '' ) ? "background-image: url(" + item.ct_slider_background_image.url + " );" : '' ;

                    var ken_burn_effect = '';
                    if ( item.ct_slider_background_ken_burns == 'yes' ) {
                        if ( item.ct_slider_zoom_direction == 'in' ) {
                            ken_burn_effect = 'ct-slider-ken-burn-zoom-in';
                        } else if( item.ct_slider_zoom_direction == 'out' ) {
                            ken_burn_effect = 'ct-slider-ken-burn-zoom-out';
                        }
                    }
                #>
                <div class="ct-slick-slide elementor-repeater-item-{{ item._id }}">
                    <div class="ct-slide-bg-img {{ ken_burn_effect }}" style="{{ ct_bg_img }} background-color: {{ item.ct_slider_background_color }}"></div><!-- /.ct-slide-bg-img -->
                    <div class="slider-overlay ct-gradient-overlay" <?php ct_custom_gradient_content_template(); ?>></div><!-- /.slider-overlay -->
                    <div class="slick-slide-container">
                        <div class="slick-slide-content slide-center text-center ct-position-{{item.ct_slider_content_position}}">
                            <# if( item.ct_slider_heading.length ) { #>
                                <h1 class="ct-slide-title" data-animation="{{ data_animation }}">{{item.ct_slider_heading}}</h1><!-- /.testimonial-author -->
                            <# } #>
                            <# if( item.ct_slider_description.length ) { #>
                                <p class="ct-slide-description" data-animation="{{ data_animation }}">{{item.ct_slider_description}}</p>
                            <# } #>
                            <div class="ct-slide-button" data-animation="{{ data_animation }}">
                                <?php ct_button_template( $item = true ); ?>
                            </div><!-- /.ct-slide-button -->
                        </div><!-- /.slick-slide-content -->
                    </div><!-- /.slick-slide-container -->
                </div><!-- /.ct-slick-slide -->
                <# }); #>
            </div><!-- /.ct-slick-slider -->
        <?php
    }

}
