<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Testimonial extends Widget_Base {

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
        return 'eae_testimonial';
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
        return __( 'EAE Testimonial', 'elegant-addons-for-elementor' );
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
        return 'eicon-testimonial-carousel';
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
        return [ 'eae-testimonial', 'eae-slick', 'eae-rating' ];
    }

    public function get_style_depends() {
        return [
            'elegant-addons-css'
        ];
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
            'ct_elementor_testimonial_content_section',
            [
                'label' => __( 'Content', 'elegant-addons-for-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ct_elementor_testimonial_enable_avatar',
            [
                'label' => esc_html__( 'Display Avatar?', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'ct_elementor_avatar',
            [
                'label' => __( 'Testimonial Avatar', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ct_elementor_testimonial_enable_avatar' => 'yes',
                ],
            ]
        );


        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'ct_elementor_image',
                'default'   => 'thumbnail',
                'condition' => [
                    'image[url]!' => '',
                    'ct_elementor_testimonial_enable_avatar' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'ct_elementor_testimonial_name',
            [
                'label' => esc_html__( 'User Name', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'John Doe', 'elegant-addons-for-elementor' ),
                'dynamic' => [ 'active' => true ]
            ]
        );
        $repeater->add_control(
            'ct_elementor_testimonial_company_title',
            [
                'label' => esc_html__( 'Title', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Crafthemes', 'elegant-addons-for-elementor' ),
                'dynamic' => [ 'active' => true ]
            ]
        );

        $repeater->add_control(
            'ct_elementor_testimonial_description',
            [
                'label' => esc_html__( 'Testimonial Description', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Add testimonial description here. Edit and place your own text. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.', 'elegant-addons-for-elementor' ),
            ]
        );


        $repeater->add_control(
            'ct_elementor_estimonial_enable_rating',
            [
                'label' => esc_html__( 'Display Rating?', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
          'ct_elementor_testimonial_rating_number',
          [
             'label'       => __( 'Rating Number', 'elegant-addons-for-elementor' ),
             'type' => Controls_Manager::SELECT,
             'default' => '5',
             'options' => [
                '1'    => __( '1', 'elegant-addons-for-elementor' ),
                '2'    => __( '2', 'elegant-addons-for-elementor' ),
                '3'    => __( '3', 'elegant-addons-for-elementor' ),
                '4'    => __( '4', 'elegant-addons-for-elementor' ),
                '5'    => __( '5', 'elegant-addons-for-elementor' ),
             ],
            'condition' => [
                'ct_elementor_estimonial_enable_rating' => 'yes',
            ],
          ]
        );


        $this->add_control(
            'ct_elementor_testimonial_loop',
            [
                'label' => __( 'Repeater List', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ct_elementor_testimonial_name' => __( 'John Doe', 'elegant-addons-for-elementor' ),
                    ],
                    [
                        'ct_elementor_testimonial_name' => __( 'John Doe', 'elegant-addons-for-elementor' ),
                    ],
                ],
                'title_field' => '{{{ ct_elementor_testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_additional_options',
            [
                'label' => __( 'Additional Options', 'elegant-addons-for-elementor' ),
            ]
        );
        $this->add_control(
            'ct_elementor_fancy_divider_show',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => __( 'Show Fancy Border', 'elegant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'label_off' => __( 'Hide', 'elegant-addons-for-elementor' ),
                'label_on' => __( 'Show', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_testimonial_quotation_show',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => __( 'Quotation Show', 'elegant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'label_off' => __( 'Hide', 'elegant-addons-for-elementor' ),
                'label_on' => __( 'Show', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_show_arrows',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => __( 'Arrows', 'elegant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'label_off' => __( 'Hide', 'elegant-addons-for-elementor' ),
                'label_on' => __( 'Show', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_show_dots',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => __( 'Dots', 'elegant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'label_off' => __( 'Hide', 'elegant-addons-for-elementor' ),
                'label_on' => __( 'Show', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_speed',
            [
                'label' => __( 'Transition Duration', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_elementor_autoplay',
            [
                'label' => __( 'Autoplay', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
                'separator' => 'before',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_elementor_autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'ct_elementor_autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_elementor_loop',
            [
                'label' => __( 'Infinite Loop', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ct_elementor_autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_elementor_pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'ct_elementor_autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ct_elementor_image_size',
                'default' => 'full',
                'separator' => 'before',
            ]
        );

        $ct_slides_per_view = range( 1, 10 );
        $ct_slides_per_view = array_combine( $ct_slides_per_view, $ct_slides_per_view );
        $this->add_responsive_control(
            'ct_elementor_slides_per_view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Slides Per View', 'elegant-addons-for-elementor' ),
                'options' => [ '1' => __( '1', 'elegant-addons-for-elementor' ) ] + $ct_slides_per_view,
                'default' => '1',
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '1',
                'tablet_default' => '1',
                'mobile_default' => '1',
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_slides_to_scroll',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Slides to Scroll', 'elegant-addons-for-elementor' ),
                'description' => __( 'Set how many slides are scrolled per swipe.', 'elegant-addons-for-elementor' ),
                'options' => [ '1' => __( '1', 'elegant-addons-for-elementor' ) ] + $ct_slides_per_view,
                'default' => '1',
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '1',
                'tablet_default' => '1',
                'mobile_default' => '1',
            ]
        );

        $this->end_controls_section();

        eae_pro_notice( $this );

        $this->start_controls_section(
            'ct_elementor_section_testimonial_styles_general',
            [
                'label' => esc_html__( 'Testimonial Styles', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        if ( ELEGANT_ADDONS_PRO == 'pro' ) {
            $testimonial_style = eae_testimonial_content_pro();
        } else {
            $testimonial_style = eae_testimonial_content_free();
        }

        $this->add_control(
            'ct_testimonial_layout',
            [
                'label' => __( 'Layout', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image_stacked',
                'options' => $testimonial_style,
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_alignment',
            [
                'label' => esc_html__( 'Layout Alignment', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elegant-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elegant-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elegant-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'              => 'ct_elementor_testimonial_bg_color2',
                'types'             => [ 'classic', 'gradient' ],
                'selector'          => '{{WRAPPER}} .testimonial-outer',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ct_elementor_testimonial_border',
                'label' => __( 'Border', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .testimonial-outer',
            ]
        );
        $this->add_control(
            'ct_elementor_testimonial_border_radius',
            [
                'label' => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ct_testimonial_box_shadow',
                'label' => __( 'Box Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .testimonial-outer',
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_main_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_main_margin',
            [
                'label' => __( 'Margin', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'ct_elementor_section_testimonial_image_styles',
            [
                'label' => esc_html__( 'Testimonial Image Style', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'ct_elementor_testimonial_enable_avatar'    => 'yes'
                // ]
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_image_width',
            [
                'label' => esc_html__( 'Image Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 75,
                    'unit' => 'px',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .ct-image-above, {{WRAPPER}} .ct-author-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_max_image_width',
            [
                'label' => esc_html__( 'Image Max Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .ct-author-container' => 'max-width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_image_gap',
            [
                'label' => esc_html__( 'Image Horizontal Gap', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .author-details, {{WRAPPER}} .ct-testimonial-right .testimonial-description, {{WRAPPER}} .ct-testimonial-left .testimonial-description' => 'padding-right:{{SIZE}}{{UNIT}}; padding-left:{{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_testimonial_layout',
                            'operator' => '==', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'image_inline',
                        ],
                        [
                            'name' => 'ct_testimonial_layout',
                            'operator' => '==',
                            'value' => 'image_left',
                        ],
                        [
                            'name' => 'ct_testimonial_layout',
                            'operator' => '==',
                            'value' => 'image_right',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_image_gap_vert',
            [
                'label' => esc_html__( 'Image Vertical Gap', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer .ct-image-above .ct-author-img' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial-outer .ct-image-stacked .ct-author-img' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_testimonial_layout',
                            'operator' => '==', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'image_stacked',
                        ],
                        [
                            'name' => 'ct_testimonial_layout',
                            'operator' => '==',
                            'value' => 'image_above',
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ct_elementor_testimonial_image_border',
                'label' => esc_html__( 'Border', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ct-author-container .ct-author-img img',
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%' ],

                'selectors' => [
                    '{{WRAPPER}} .ct-author-container .ct-author-img img' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ct_testimonial_box_image_shadow',
                'label' => __( 'Box Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ct-author-img img',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'ct_elementor_section_testimonial_typography',
            [
                'label' => esc_html__( 'Color &amp; Typography', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_name_heading',
            [
                'label' => __( 'Name', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_name_color',
            [
                'label' => esc_html__( 'User Name Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .testimonial-author' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'ct_elementor_testimonial_name_typography',
                'selector' => '{{WRAPPER}} .testimonial-content .testimonial-author',
            ]
        );

        $this->add_control(
            'ct_testimonial_name_mb',
            [
                'label' => __( 'Margin Bottom', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .testimonial-author' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_company_heading',
            [
                'label'     => __( 'Title', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_company_color',
            [
                'label' => esc_html__( 'Title', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#777777',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'ct_elementor_testimonial_position_typography',
                'selector' => '{{WRAPPER}} .testimonial-content .testimonial-title',
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_description_heading',
            [
                'label' => __( 'Testimonial Text', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_description_color',
            [
                'label' => esc_html__( 'Testimonial Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#7a7a7a',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .testimonial-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'ct_elementor_testimonial_description_typography',
                'selector' => '{{WRAPPER}} .testimonial-content .testimonial-description',
            ]
        );

        $this->add_control(
            'ct_testimonial_description_mb',
            [
                'label' => __( 'Margin Bottom', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content .testimonial-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_testimonial_quotation_typography',
            [
                'label' => esc_html__( 'Quotation Style', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ct_elementor_testimonial_quotation_color',
            [
                'label' => esc_html__( 'Quotation Mark Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.15)',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer .quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'ct_elementor_testimonial_quotation_typography',
                'selector' => '{{WRAPPER}} .testimonial-outer .quote',
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_quotation_top',
            [
                'label' => esc_html__( 'Quotation Postion From Top', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -40,
                        'max' => 100,
                    ]
                ],
                'size_units' => [ '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer .quote' => 'top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_testimonial_quotation_right',
            [
                'label' => esc_html__( 'Quotation Postion From left', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 47,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -40,
                        'max' => 100,
                    ]
                ],
                'size_units' => [ '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-outer .quote' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_testimonial_section_navigation',
            [
                'label' => __( 'Arrows', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_testimonial_heading_arrows',
            [
                'label' => __( 'Arrows', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_size',
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
                'selectors' => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_testimonial_tabs_arrows_style' );

        $this->start_controls_tab(
            'ct_testimonial_tab_arrows_normal',
            [
                'label'                 => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_color',
            [
                'label'                 => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow' => 'color: {{VALUE}}',
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
                'selector'              => '{{WRAPPER}} .testimonials-slide .slick-arrow'
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_border_radius_normal',
            [
                'label'                 => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_testimonial_tab_arrows_hover',
            [
                'label'                 => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_color_hover',
            [
                'label'                 => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_testimonial_arrows_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ct_testimonial_arrow_shadow',
                'label' => __( 'Box Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .testimonials-slide .slick-arrow',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_testimonial_section_dots',
            [
                'label' => __( 'Dots', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_testimonial_pagination_dots_gap',
            [
                'label' => __( 'Dots gap', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],

                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         $this->add_responsive_control(
            'ct_testimonial_pagination_vertical_space',
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
                    '{{WRAPPER}} .testimonials-slide .slick-dots' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ct_testimonial_pagination_size',
            [
                'label' => __( 'Size', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_testimonial_tabs_dots_style' );

        $this->start_controls_tab(
            'ct_testimonial_tab_dots_normal',
            [
                'label'                 => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_testimonial_dots_bg_color_normal',
            [
                'label'                 => __( 'Active Dot Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_testimonial_pagination_active_color',
            [
                'label' => __( 'Inactive Dot Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'ct_testimonial_dots_border_normal',
                'label'                 => __( 'Border', 'elegant-addons-for-elementor' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .testimonials-slide .slick-dots li button'
            ]
        );

        $this->add_control(
            'ct_testimonial_dots_border_radius_normal',
            [
                'label'                 => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_testimonial_dots_arrows_hover',
            [
                'label'                 => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_testimonial_dots_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_testimonial_dots_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .testimonials-slide .slick-dots li button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        ct_fancy_divider_content_controls( $this, 'ct_elementor_fancy_divider_show', 'yes' );
        ct_fancy_divider_style_controls( $this, 'ct_elementor_fancy_divider_show', 'yes' );
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

        if ( $settings['ct_elementor_testimonial_loop'] ) {

            $slider_arrows          = ( $settings['ct_elementor_show_arrows'] == 'yes' ) ? 'true' : 'false';
            $slider_dots            = ( $settings['ct_elementor_show_dots'] == 'yes' ) ? 'true' : 'false';
            $tranistion_duration    = esc_attr( $settings['ct_elementor_speed'] );
            $autoplay               = ( $settings['ct_elementor_autoplay'] == 'yes' ) ? 'true' : 'false';
            $autoplay_speed         = esc_attr( $settings['ct_elementor_autoplay_speed'] );
            $infinite_loop          = ( $settings['ct_elementor_loop'] == 'yes' ) ? 'true' : 'false';
            $pause_on_hover         = ( $settings['ct_elementor_pause_on_hover'] == 'yes' ) ? 'true' : 'false';

            $slides_per_view        = esc_attr( $settings['ct_elementor_slides_per_view'] );
            $slides_per_view_tab    = esc_attr( $settings['ct_elementor_slides_per_view_tablet'] );
            $slides_per_view_mob    = esc_attr( $settings['ct_elementor_slides_per_view_mobile'] );

            $slides_per_scroll      = esc_attr( $settings['ct_elementor_slides_to_scroll'] );
            $slides_per_scroll_tab  = esc_attr( $settings['ct_elementor_slides_to_scroll_tablet'] );
            $slides_per_scroll_mob  = esc_attr( $settings['ct_elementor_slides_to_scroll_mobile'] );

            $testimonial_layout     = '';
            if ( $settings['ct_testimonial_layout'] == 'image_stacked' ) {
                $testimonial_layout  = 'ct-image-stacked';
            }
            ?>

            <div class="testimonials-slide" data-slick='{
                "arrows": <?php echo esc_attr( $slider_arrows ); ?>,
                "dots": <?php echo esc_attr( $slider_dots ); ?>,
                "speed": <?php echo esc_attr( $tranistion_duration ); ?>,
                "autoplay": <?php echo esc_attr( $autoplay ); ?>,
                "autoplaySpeed": <?php echo esc_attr( $autoplay_speed ); ?>,
                "infinite": <?php echo esc_attr( $infinite_loop ); ?>,
                "pauseOnHover": <?php echo esc_attr( $pause_on_hover ); ?>,
                "responsive": [
                {
                    "breakpoint": 9999,
                    "settings": {
                        "slidesToShow": <?php echo esc_attr( $slides_per_view ); ?>,
                        "slidesToScroll": <?php echo esc_attr( $slides_per_scroll ); ?>
                    }
                },
                {
                    "breakpoint": 783,
                    "settings": {
                        "slidesToShow": <?php echo esc_attr( $slides_per_view_tab ); ?>,
                        "slidesToScroll": <?php echo esc_attr( $slides_per_scroll ); ?>
                    }
                },
                {
                    "breakpoint": 600,
                    "settings": {
                        "slidesToShow": <?php echo esc_attr( $slides_per_view_mob ); ?>,
                        "slidesToScroll": <?php echo esc_attr( $slides_per_scroll ); ?>
                    }
                }
            ]
            }'>
            <?php
            foreach (  $settings['ct_elementor_testimonial_loop'] as $item ) {
                ?>
                <div class="single-testimonial">
                    <div class="testimonial-outer">
                        <?php if( $settings['ct_testimonial_layout'] == 'image_above' ) : ?>
                            <?php if( $item['ct_elementor_testimonial_enable_avatar'] == 'yes' ) : ?>
                                <div class="ct-author-container ct-image-above">
                                    <div class="author-border"></div><!-- /.author-border -->
                                    <div class="ct-author-img ct-block-<?php echo esc_attr( $settings['ct_elementor_testimonial_alignment'] ); ?>">
                                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'ct_elementor_image_size', 'ct_elementor_avatar' ) ?>
                                    </div><!-- /.author-img -->
                                </div><!-- /.author-container -->
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if( ( $settings['ct_testimonial_layout'] == 'image_inline' ) ||
                                 ( $settings['ct_testimonial_layout'] == 'image_stacked' ) ||
                                 ( $settings['ct_testimonial_layout'] == 'image_above' ) ) : ?>
                            <div class="testimonial-content">
                                <?php if( $settings['ct_testimonial_quotation_show'] == 'yes' ) { ?>
                                <div class="quote">“</div>
                                <?php } ?>
                                <div class="testimonial-description ct-text-<?php echo esc_attr( $settings['ct_elementor_testimonial_alignment'] ); ?>">
                                    <?php echo wp_kses_post( $item['ct_elementor_testimonial_description'] ); ?>
                                </div><!-- /.testimonial-description -->

                                <div class="author-excerpt ct-block-<?php echo esc_attr( $settings['ct_elementor_testimonial_alignment'] ); ?> <?php echo $testimonial_layout; ?>">
                                    <?php if( $settings['ct_testimonial_layout'] != 'image_above' ) : ?>
                                        <?php if( $item['ct_elementor_testimonial_enable_avatar'] == 'yes' ) : ?>
                                        <div class="ct-author-container">
                                            <div class="author-border"></div><!-- /.author-border -->
                                            <div class="ct-author-img">
                                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'ct_elementor_image_size', 'ct_elementor_avatar' ) ?>
                                            </div><!-- /.author-img -->
                                        </div><!-- /.author-container -->
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if( !empty( $item['ct_elementor_testimonial_name'] ) || !empty( $item['ct_elementor_testimonial_company_title'] ) ) : ?>
                                        <div class="author-details">
                                            <?php if( !empty( $item['ct_elementor_testimonial_name'] ) ) : ?>
                                                <span class="testimonial-author"><?php echo esc_html( $item['ct_elementor_testimonial_name'] ); ?></span><!-- /.testimonial-author -->
                                            <?php endif; ?>
                                            <?php if( !empty( $item['ct_elementor_testimonial_company_title'] ) ) : ?>
                                                <span class="testimonial-title"><?php echo esc_html( $item['ct_elementor_testimonial_company_title'] ); ?></span>
                                            <?php endif; ?>

                                            <?php if( $item['ct_elementor_estimonial_enable_rating'] == 'yes' ) { ?>
                                                <ul class="ct-star-rating" data-stars="5" data-current="<?php echo esc_attr( $item['ct_elementor_testimonial_rating_number'] ); ?>"></ul>
                                            <?php } ?>
                                        </div><!-- /.author-details -->
                                    <?php endif; ?>
                                </div><!-- /.author-excerpt -->
                            </div><!-- /.testimonial-content -->
                        <?php endif; ?>

                        <?php
                            if ( ELEGANT_ADDONS_PRO == 'pro' ) {
                                eae_testimonial_render_pro( $this, $item );
                            }
                        ?>

                        <?php
                            if( $settings['ct_elementor_fancy_divider_show'] == 'yes' ) {
                                ct_fancy_divider_no_condition();
                            }
                        ?>
                    </div><!-- /.testimonial-outer-->
                </div><!-- /.single-testimonial -->

                <?php
            }
            echo '</div><!-- /.testimonials-slide -->';
        }
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
            slider_arrows           = ( settings.ct_elementor_show_arrows == 'yes' ) ? 'true' : 'false';
            slider_dots             = ( settings.ct_elementor_show_dots == 'yes' ) ? 'true' : 'false';
            tranistion_duration     = settings.ct_elementor_speed;
            autoplay                = ( settings.ct_elementor_autoplay == 'yes' ) ? 'true' : 'false';
            autoplay_speed          = settings.ct_elementor_autoplay_speed;
            infinite_loop           = ( settings.ct_elementor_loop == 'yes' ) ? 'true' : 'false';
            pause_on_hover          = ( settings.ct_elementor_pause_on_hover == 'yes' ) ? 'true' : 'false';

            slides_per_view        = settings.ct_elementor_slides_per_view;
            slides_per_view_tab    = settings.ct_elementor_slides_per_view_tablet;
            slides_per_view_mob    = settings.ct_elementor_slides_per_view_mobile;

            slides_per_scroll      = settings.ct_elementor_slides_to_scroll;
            slides_per_scroll_tab  = settings.ct_elementor_slides_to_scroll_tablet;
            slides_per_scroll_mob  = settings.ct_elementor_slides_to_scroll_mobile;

            testimonial_layout     = '';
            if ( settings.ct_testimonial_layout == 'image_stacked' ) {
                testimonial_layout  = 'ct-image-stacked';
            }

        #>
        <# if ( settings.ct_elementor_testimonial_loop.length ) { #>
            <div class="testimonials-slide" data-slick='{
                "arrows": {{ slider_arrows }},
                "dots": {{ slider_dots }},
                "speed": {{ tranistion_duration }},
                "autoplay": {{ autoplay }},
                "autoplaySpeed": {{ autoplay_speed }},
                "infinite": {{ infinite_loop }},
                "pauseOnHover": {{ pause_on_hover }},
                "responsive": [
                {
                    "breakpoint": 9999,
                    "settings": {
                        "slidesToShow": {{ slides_per_view }},
                        "slidesToScroll": {{ slides_per_scroll }}
                    }
                },
                {
                    "breakpoint": 783,
                    "settings": {
                        "slidesToShow": {{ slides_per_view_tab }},
                        "slidesToScroll": {{ slides_per_scroll_tab }}
                    }
                },
                {
                    "breakpoint": 600,
                    "settings": {
                        "slidesToShow": {{ slides_per_view_mob }},
                        "slidesToScroll": {{ slides_per_scroll_mob }}
                    }
                }
            ]
            }'>
            <# _.each( settings.ct_elementor_testimonial_loop, function( item ) { #>
                <div class="single-testimonial">
                    <div class="testimonial-outer">
                            <# if ( settings.ct_testimonial_layout == 'image_above' ) { #>
                                <# if( item.ct_elementor_testimonial_enable_avatar == 'yes' ) { #>
                                <div class="ct-author-container ct-image-above">
                                    <div class="author-border"></div><!-- /.author-border -->
                                    <div class="ct-author-img ct-block-{{ settings.ct_elementor_testimonial_alignment }}">
                                        <img src="{{item.ct_elementor_avatar.url}}">
                                    </div><!-- /.ct-author-img -->
                                </div><!-- /.author-container -->
                                <# } #>
                            <# } #>


                            <# if ( ( settings.ct_testimonial_layout == 'image_inline' ) ||
                             ( settings.ct_testimonial_layout == 'image_stacked' ) ||
                             ( settings.ct_testimonial_layout == 'image_above' ) ) { #>
                                <div class="testimonial-content">
                                    <# if( settings.ct_testimonial_quotation_show == 'yes' ) { #>
                                    <div class="quote">“</div>
                                    <# } #>
                                    <div class="testimonial-description ct-text-{{settings.ct_elementor_testimonial_alignment}}">
                                        {{{item.ct_elementor_testimonial_description}}}
                                    </div><!-- /.testimonial-description -->

                                    <div class="author-excerpt ct-block-{{ settings.ct_elementor_testimonial_alignment }} {{ testimonial_layout }}">
                                        <# if ( settings.ct_testimonial_layout != 'image_above' ) { #>
                                            <# if( item.ct_elementor_testimonial_enable_avatar == 'yes' ) { #>
                                            <div class="ct-author-container">
                                                <div class="author-border"></div><!-- /.author-border -->
                                                <div class="ct-author-img">
                                                    <img src="{{item.ct_elementor_avatar.url}}">
                                                </div><!-- /.ct-author-img -->
                                            </div><!-- /.author-container -->
                                            <# } #>
                                        <# } #>

                                        <# if( item.ct_elementor_testimonial_name.length || item.ct_elementor_testimonial_company_title.length ) { #>
                                            <div class="author-details">
                                                <# if( item.ct_elementor_testimonial_name.length ) { #>
                                                    <span class="testimonial-author">{{item.ct_elementor_testimonial_name}}</span><!-- /.testimonial-author -->
                                                <# } #>
                                                <# if( item.ct_elementor_testimonial_company_title.length ) { #>
                                                    <span class="testimonial-title">{{item.ct_elementor_testimonial_company_title}}</span>
                                                <# } #>

                                                <# if( item.ct_elementor_estimonial_enable_rating == 'yes' ) { #>
                                                    <ul class="ct-star-rating" data-stars="5" data-current="{{ item.ct_elementor_testimonial_rating_number }}"></ul>
                                                <# } #>
                                            </div><!-- /.author-details -->
                                        <# } #>
                                    </div><!-- /.author-excerpt -->
                                </div><!-- /.testimonial-content -->
                            <# } #>

                            <?php
                                if ( ELEGANT_ADDONS_PRO == 'pro' ) {
                                    eae_testimonial_content_template_pro();
                                }
                            ?>

                            <# if( settings.ct_elementor_fancy_divider_show == 'yes' ) { #>
                            <?php ct_fancy_divider_no_condition(); ?>
                            <# } #>
                        </div><!-- /.testimonial-outer-->
                    </div><!-- /.single-testimonial -->
            <# }); #>
            </div><!-- /.testimonials-slide -->
        <# } #>
        <?php
    }

}
