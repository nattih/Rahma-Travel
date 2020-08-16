<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Icons_Manager;

use Elementor\Core\Files\Assets\Svg\Svg_Handler;

use ElementPack\Modules\Member\Skins;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Member extends Widget_Base {

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
        return 'eae_member';
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
        return __( 'EAE Member', 'elegant-addons-for-elementor' );
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
        return 'eicon-image-rollover';
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
            'ct_elementor_section_content_layout',
            [
                'label' => esc_html__( 'Layout', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_member_photo',
            [
                'label' => __( 'Choose Image', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'label' => __( 'Image Size', 'elegant-addons-for-elementor' ),
                'exclude' => [ 'custom' ],
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'ct_elementor_name',
            [
                'label'       => esc_html__( 'Name', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'John Doe', 'elegant-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Member Name', 'elegant-addons-for-elementor' ),
                'dynamic'     => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_elementor_role',
            [
                'label'       => esc_html__( 'Role', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Managing Director', 'elegant-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Member Role', 'elegant-addons-for-elementor' ),
                'dynamic'     => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_elementor_description_text',
            [
                'label'       => esc_html__( 'Description', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Type here some info about this team member, the man very important person of our company.', 'elegant-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Member Description', 'elegant-addons-for-elementor' ),
                'rows'        => 10,
            ]
        );

        $this->add_control(
            'ct_elementor_member_social_icon',
            [
                'label'   => esc_html__( 'Social Icon', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_fancy_divider',
            [
                'label' => esc_html__( 'Fancy Divider', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'ct_elementor_fancy_divider_show',
            [
                'label'   => esc_html__( 'Fancy Divider', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_content_social_link',
            [
                'label'     => esc_html__( 'Social Icon', 'elegant-addons-for-elementor' ),
                'condition' => ['ct_elementor_member_social_icon' => 'yes'],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ct_elementor_social_link_title',
            [
                'label'   => esc_html__( 'Title', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Facebook',
            ]
        );

        $repeater->add_control(
            'ct_elementor_social_link',
            [
                'label'   => esc_html__( 'Link', 'elegant-addons-for-elementor' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'http://www.facebook.com/', 'elegant-addons-for-elementor' ),
                'show_external' => true,
            ]
        );

        $repeater->add_control(
            'ct_elementor_social_share_icon',
            [
                'label'   => esc_html__( 'Choose Icon', 'elegant-addons-for-elementor' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'social_icon',
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'ct_elementor_icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a{{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'ct_elementor_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor__social_link_list',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => array_values( $repeater->get_controls() ),
                'default' => [
                    [
                        'ct_elementor_social_link'        => esc_html__( 'http://www.facebook.com/', 'elegant-addons-for-elementor' ),
                        'ct_elementor_social_share_icon'  => ['value' => 'fab fa-facebook-f', 'library' => 'fa-solid'],
                        'ct_elementor_social_link_title'  => 'Facebook',
                    ],
                    [
                        'ct_elementor_social_link'        => esc_html__( 'http://www.twitter.com/', 'elegant-addons-for-elementor' ),
                        'ct_elementor_social_share_icon'  => ['value' => 'fab fa-twitter', 'library' => 'fa-solid'],
                        'ct_elementor_social_link_title'  => 'Twitter',
                    ],
                    [
                        'ct_elementor_social_link'        => esc_html__( 'http://www.google-plus.com/', 'elegant-addons-for-elementor' ),
                        'ct_elementor_social_share_icon'  => ['value' => 'fab fa-google-plus-g', 'library' => 'fa-solid'],
                        'ct_elementor_social_link_title'  => 'Google-Plus',
                    ],
                ],
                'title_field' => '{{{ ct_elementor_social_link_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style',
            [
                'label'     => esc_html__( 'Member', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                //'condition' => [
                    //'_skin' => '',
                //],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_text_align',
            [
                'label'   => esc_html__( 'Text Alignment', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_desc_padding',
            [
                'label'      => esc_html__( 'Description Padding', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_fancy_divider',
            [
                'label' => __( 'Fancy Divider Design', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'ct_elementor_fancy_divider_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_fancy_divider_animated_speed',
            [
                'label' => __( 'Animated Speed', 'elegant-addons-for-elementor' ),
                'description' => __( 'In miliseconds ( 1s = 1000ms )', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'ms', 's' ],
                'range' => [
                    'ms' => [
                        'min' => 50,
                        'max' => 10000,
                        'step' => 500,
                    ],
                    's' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-divider::after' => 'animation-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'ct_elementor_fancy_divider_animation_color',
            [
                'label' => __( 'Moving Bar Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .content-divider::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_divider_color',
            [
                'label' => __( 'Fancy divider Background Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .content-divider' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_divider_animation_width',
            [
                'label' => __( 'Animated Bar Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'max' => 1440,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-divider::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_divider_height',
            [
                'label' => __( 'Height', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 4,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-divider, {{WRAPPER}} .content-divider::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_divider_view',
            [
                'label' => __( 'View', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

         $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style_photo',
            [
                'label' => esc_html__( 'Photo', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('ct_elementor_tabs_photo_style');

        $this->start_controls_tab(
            'ct_elementor_tab_photo_normal',
            [
                'label' => esc_html__( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_photo_background',
            [
                'label'     => esc_html__( 'Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-image-container' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ct_elementor_photo_border',
                'label'       => esc_html__( 'Border', 'elegant-addons-for-elementor' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .ct-team-member-container .ct-image-container',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'ct_elementor_photo_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ct-team-member-container .ct-image-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_photo_opacity',
            [
                'label'   => esc_html__( 'Opacity (%)', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-image-container img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_photo_spacing',
            [
                'label' => esc_html__( 'Spacing', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-image-container'  => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_elementor_tab_photo_hover',
            [
                'label' => esc_html__( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_photo_hover_opacity',
            [
                'label'   => esc_html__( 'Opacity (%)', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-image-container:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style_name',
            [
                'label' => esc_html__( 'Name', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_elementor_name_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-title ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_elementor_name_typography',
                'selector' => '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-title ',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_name_bottom_space',
            [
                'label' => esc_html__( 'Spacing', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style_role',
            [
                'label' => esc_html__( 'Role', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'ct_elementor_role_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_role_bottom_space',
            [
                'label' => esc_html__( 'Spacing', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_elementor_role_typography',
                'selector' => '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-designation',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style_text',
            [
                'label'     => esc_html__( 'Text', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     '_skin' => '',
                // ],
            ]
        );

        $this->add_control(
            'ct_elementor_text_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_elementor_text_typography',
                'selector' => '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-member-info .ct-member-text',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style_social_icon',
            [
                'label'     => esc_html__( 'Social Icon', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['ct_elementor_member_social_icon' => 'yes'],
            ]
        );

        $this->add_control(
            'ct_elementor_icon_content_background',
            [
                'label'     => esc_html__( 'Icons Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_social_icon_content_padding',
            [
                'label'      => esc_html__( 'Icons Padding', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_elementor_tabs_social_icon_style' );

        $this->start_controls_tab(
            'ct_elementor_tab_social_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_icon_background',
            [
                'label'     => esc_html__( 'Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_icon_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ct_elementor_social_icon_border',
                'label'       => esc_html__( 'Border', 'elegant-addons-for-elementor' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .ct-team-member-container .ct-social-links a',
            ]
        );

        $this->add_control(
            'ct_elementor_social_icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ct_elementor_social_icon_vertical',
            [
                'label'     => esc_html__( 'Vertical Spacing', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links' => 'padding-top: {{SIZE}}{{UNIT}};  padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_social_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a i' => 'font-size: {{SIZE}}{{UNIT}};  line-height: {{ct_elementor_social_icon_line_height.SIZE}}{{ct_elementor_social_icon_line_height.UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_social_icon_line_height',
            [
                'label'     => esc_html__( 'Icon Container Size', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-info-container .ct-social-links a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'ct_elementor_social_icon_indent',
            [
                'label'     => esc_html__( 'Icon Spacing', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_elementor_tab_social_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_elementor_icon_hover_background',
            [
                'label'     => esc_html__( 'Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_icon_hover_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_elementor_icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'ct_elementor_social_icon_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-team-member-container .ct-social-links a:hover' => 'border-color: {{VALUE}}',
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
        $settings   = $this->get_settings_for_display();
        ?>
            <div class="ct-team-member-container">
                <div class="ct-image-container">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size', 'ct_elementor_member_photo' ); ?>
                </div><!-- /.image-container -->

                <div class="ct-info-container">
                    <?php if( $settings[ 'ct_elementor_fancy_divider_show' ] ) : ?>
                        <div class="content-divider"></div><!-- /.content-divider -->
                    <?php endif; ?>

                    <?php if( $settings[ 'ct_elementor_member_social_icon' ] ) : ?>
                        <div class="ct-social-links">
                            <?php foreach (  $settings['ct_elementor__social_link_list'] as $item ) : ?>
                                <?php
                                    $target      = ( $item['ct_elementor_social_link']['is_external'] == true ) ? ' target="_blank"' : '';
                                    $nofollow    = ( $item['ct_elementor_social_link']['nofollow']  == true ) ? ' rel="nofollow"' : '';
                                ?>
                                <a href="<?php echo esc_url( $item['ct_elementor_social_link']['url'] ) . '"' . $target . $nofollow ?>><?php \Elementor\Icons_Manager::render_icon( $item['ct_elementor_social_share_icon'], [ 'aria-hidden' => 'true' ] ); ?></a>
                            <?php endforeach; ?>
                        </div><!-- /.social-links -->
                    <?php endif; ?>

                    <?php if ( !empty( $settings[ 'ct_elementor_name' ] )
                                || !empty( $settings[ 'ct_elementor_role' ] )
                                || !empty( $settings[ 'ct_elementor_description_text' ] ) ) : ?>
                        <div class="ct-member-info">
                            <?php if ( !empty( $settings[ 'ct_elementor_name' ] ) ) : ?>
                                <h2 class="ct-member-title"><?php echo esc_html( $settings[ 'ct_elementor_name' ] ); ?></h2>
                            <?php endif; ?>

                            <?php if ( !empty( $settings[ 'ct_elementor_role' ] ) ) : ?>
                                <p class="ct-member-designation"><?php echo esc_html( $settings[ 'ct_elementor_role' ] ); ?></p>
                            <?php endif; ?>

                            <?php if ( !empty( $settings[ 'ct_elementor_description_text' ] ) ) : ?>
                                <p class="ct-member-description"><?php echo esc_html( $settings[ 'ct_elementor_description_text' ] ); ?></p>
                            <?php endif; ?>
                        </div><!-- /.member-info -->
                    <?php endif; ?>
                </div><!-- /.info-container -->
            </div><!-- /.team-member-container -->
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
        <div class="ct-team-member-container">
            <div class="ct-image-container">
                <img src="{{ settings.ct_elementor_member_photo.url }}">
            </div><!-- /.image-container -->

            <div class="ct-info-container">
                <# if( settings.ct_elementor_fancy_divider_show ) { #>
                    <div class="content-divider"></div><!-- /.content-divider -->
                <# } #>
                <# if( settings.ct_elementor_member_social_icon ) { #>
                    <div class="ct-social-links">
                        <# _.each( settings.ct_elementor__social_link_list, function( item ) { #>
                            <#
                                var target    = item.ct_elementor_social_link.is_external ? ' target="_blank"' : '';
                                var nofollow  = item.ct_elementor_social_link.nofollow ? ' rel="nofollow"' : '';
                            #>
                            <a href="{{ item.ct_elementor_social_link.url }}" {{ target }} {{ nofollow }}><i class="{{{ item.ct_elementor_social_share_icon.value }}}"></i></a>
                        <# } ); #>
                    </div><!-- /.social-links -->
                <# } #>

                <# if ( settings.ct_elementor_name.length
                        || settings.ct_elementor_role.length
                        || settings.ct_elementor_description_text.length ) { #>
                    <div class="ct-member-info">
                        <h2 class="ct-member-title">{{ settings.ct_elementor_name }}</h2>
                        <p class="ct-member-designation">{{ settings.ct_elementor_role }}</p>
                        <p class="ct-member-description">{{ settings.ct_elementor_description_text }}</p>
                    </div><!-- /.member-info -->
                <# } #>
            </div><!-- /.info-container -->
        </div><!-- /.team-member-container -->
        <?php
    }

}
