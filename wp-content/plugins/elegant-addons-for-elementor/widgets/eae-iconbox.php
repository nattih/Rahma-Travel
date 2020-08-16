<?php
namespace ElegantAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;
use Elementor\Icons_Manager;
use Elementor\Core\Files\Assets\Svg\Svg_Handler;
use Elementor\Group_Control_Background;

use ElementPack\Modules\QueryControl\Module;
use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Iconbox extends Widget_Base {

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
        return 'eae_iconbox';
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
        return __( 'EAE Icon Box', 'elegant-addons-for-elementor' );
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
        return 'eicon-icon-box';
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
            'eae_ib_content_section',
            [
                'label' => __( 'Icon Box', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_icon_type',
            [
                'label'        => esc_html__('Icon Type', 'elegant-addons-for-elementor'),
                'type'         => Controls_Manager::CHOOSE,
                'toggle'       => false,
                'default'      => 'icon',
                'prefix_class' => 'eae-icon-type-',
                'render_type'  => 'template',
                'options'      => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'elegant-addons-for-elementor'),
                        'icon'  => 'fas fa-star'
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'elegant-addons-for-elementor'),
                        'icon'  => 'far fa-image'
                    ]
                ]
            ]
        );

        $this->add_control(
            'eae_ib_icon_select',
            [
                'label'            => __( 'Icon', 'elegant-addons-for-elementor' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'render_type'      => 'template',
                'condition'        => [
                    'eae_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'eae_ib_image_select',
            [
                'label'       => __( 'Image Icon', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'eae_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'eae_ib_title_text',
            [
                'label'   => __( 'Title & Description', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => __( 'Icon Box Heading', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Enter your title', 'elegant-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'eae_ib_title_link',
            [
                'label'        => __( 'Title Link', 'elegant-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'eae_ib_title_link_url',
            [
                'label'       => __( 'Title Link URL', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'eae_ib_title_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'eae_ib_view',
            [
                'label' => __( 'View', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'elementor' ),
                    'stacked' => __( 'Stacked', 'elementor' ),
                    'framed' => __( 'Framed', 'elementor' ),
                ],
                'default' => 'default',
                'prefix_class' => 'eae-ib-view-',
                'condition'        => [
                    'eae_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'eae_ib_shape',
            [
                'label' => __( 'Shape', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __( 'Circle', 'elementor' ),
                    'square' => __( 'Square', 'elementor' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'eae_ib_view!' => 'default',
                    'eae_ib_icon_select[value]!' => '',
                ],
                'prefix_class' => 'eae-ib-shape-',
                'condition'        => [
                    'eae_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'eae_ib_show_separator',
            [
                'label'        => __( 'Title Separator', 'elegant-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'eae_ib_show_readmore',
            [
                'label'        => __( 'Show Read More', 'elegant-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'eae_ib_show_fancy_divider',
            [
                'label'        => __( 'Fancy Divider', 'elegant-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'eae_ib_description_text',
            [
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Enter your description', 'elegant-addons-for-elementor' ),
                'rows'        => 10,
                'separator'   => 'before',
                'show_label'  => false,
            ]
        );

        $this->add_control(
            'eae_ib_position',
            [
                'label'     => __( 'Icon Position', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'default'   => 'top',
                'options'   => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __( 'Top', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle'       => false,
                'condition'    => [
                    'eae_ib_icon_select[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_icon_vertical_alignment',
            [
                'label'   => __( 'Icon Vertical Alignment', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top'   => [
                        'title' => __( 'Top', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'      => 'top',
                'toggle'       => false,
                'prefix_class' => 'elementor-vertical-align-',
                'condition'    => [
                     'eae_ib_position' => ['left', 'right']
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_content_align',
            [
                'label'   => __( 'Content Alignment', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card' => 'text-align: {{VALUE}};',
                ],

                'condition'    => [
                     'eae_ib_position' => ['top']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_readmore',
            [
                'label'     => __( 'Read More', 'elegant-addons-for-elementor' ),
                'condition' => [
                    'eae_ib_show_readmore' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_readmore_align',
            [
                'label'   => __( 'Alignment', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card .eae-ib-read-more' => 'text-align: {{VALUE}}; display:block;',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_readmore_text',
            [
                'label'       => __( 'Text', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default'     => __( 'Read More »', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Read More »', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_ib_readmore_link',
            [
                'label'     => __( 'Link to', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::URL,
                'separator' => 'before',
                'dynamic'   => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'elegant-addons-for-elementor' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition' => [
                    'eae_ib_readmore_text!' => '',
                ]
            ]
        );

        $this->add_control(
            'eae_ib_readmore_icon',
            [
                'label'       => __( 'Icon', 'elegant-addons-for-elementor' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'readmore_icon',
                'separator'   => 'before',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'eae_ib_readmore_icon_align',
            [
                'label'   => __( 'Icon Position', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'   => __( 'Left', 'elegant-addons-for-elementor' ),
                    'right'  => __( 'Right', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'eae_ib_readmore_icon[value]!' => '',
                    'eae_ib_readmore_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_readmore_icon_indent',
            [
                'label' => __( 'Icon Spacing', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'condition' => [
                    'eae_ib_readmore_icon[value]!' => '',
                    'eae_ib_readmore_text!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-rm-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eae-rm-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_content_badge',
            [
                'label'     => __( 'Badge', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_ib_badge_text',
            [
                'label'       => __( 'Badge Text', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'POPULAR',
                'placeholder' => 'Type Badge Title',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'eae_ib_badge_position',
            [
                'label'   => esc_html__( 'Position', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => [
                    'center' => __( 'Center Center', 'elegant-addons-for-elementor' ),
                    'center-left' => __( 'Center Left', 'elegant-addons-for-elementor' ),
                    'center-right' => __( 'Center Right', 'elegant-addons-for-elementor' ),
                    'top-center' => __( 'Top Center', 'elegant-addons-for-elementor' ),
                    'top-left' => __( 'Top Left', 'elegant-addons-for-elementor' ),
                    'top-right' => __( 'Top Right', 'elegant-addons-for-elementor' ),
                    'bottom-center' => __( 'Bottom Center', 'elegant-addons-for-elementor' ),
                    'bottom-left' => __( 'Bottom Left', 'elegant-addons-for-elementor' ),
                    'bottom-right' => __( 'Bottom Right', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_badge_rotate',
            [
                'label'   => esc_html__( 'Rotate', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'range' => [
                    'deg' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eae-ib-tag' => 'transform: rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .eae-ib-tag' => 'transform: rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .eae-ib-tag' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_content_additional',
            [
                'label' => __( 'Additional Options', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'eae_ib_top_icon_vertical_offset',
            [
                'label' => esc_html__('Icon Vertical Offset', 'elegant-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'eae_ib_position' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-icon-box' => 'margin-top: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_top_icon_horizontal_offset',
            [
                'label' => esc_html__('Icon Horizontal Offset', 'elegant-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'eae_ib_position' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-icon-box' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_left_icon_horizontal_offset',
            [
                'label' => esc_html__('Icon Horizontal Offset', 'elegant-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'eae_ib_position' => 'left',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-icon-box' => 'margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_right_icon_horizontal_offset',
            [
                'label' => esc_html__('Icon Horizontal Offset', 'elegant-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'eae_ib_position' => 'right',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-card-icon' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_left_right_icon_vertical_offset',
            [
                'label' => esc_html__('Icon Vertical Offset', 'elegant-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'eae_ib_position' => ['left', 'right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-card-icon' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_title_size',
            [
                'label'   => __( 'Title HTML Tag', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_style_icon_box',
            [
                'label'      => __( 'Icon/Image', 'elegant-addons-for-elementor' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'eae_ib_icon_colors' );

        $this->start_controls_tab(
            'eae_ib_icon_colors_normal',
            [
                'label' => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_ib_icon_color',
            [
                'label'     => __( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.eae-ib-view-stacked .ct-service-card-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.eae-ib-view-framed .ct-service-card-icon, {{WRAPPER}}.eae-ib-view-default .ct-service-card-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
                'condition' => [
                    'eae_icon_type!' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eae_ib_icon_background',
                'selector'  => '{{WRAPPER}} .ct-service-card-icon',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'eae_ib_icon_padding',
            [
                'label'      => esc_html__('Padding', 'elegant-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .ct-service-card-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'eae_ib_icon_border',
                'placeholder' => '1px',
                'separator'   => 'before',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .ct-service-card-icon'
            ]
        );

        $this->add_control(
            'eae_ib_icon_radius',
            [
                'label'      => esc_html__('Radius', 'elegant-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .ct-service-card-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eae_ib_icon_shadow',
                'selector' => '{{WRAPPER}} .ct-service-card-icon'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'eae_ib_icon_typography',
                'selector'  => '{{WRAPPER}} .ct-service-card-icon',
                // 'condition' => [
                //     'eae_icon_type!' => 'image',
                // ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_icon_space',
            [
                'label'     => __( 'Spacing', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'default'   => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-position-right .ct-service-card-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-left .ct-service-card-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-top .ct-service-card-icon'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .ct-service-card-icon'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_icon_size',
            [
                'label' => __( 'Size', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-card-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ct-service-card-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                // 'condition' => [
                //     'image_fullwidth!' => 'yes',
                // ],
            ]
        );

        // $this->add_control(
        //     'eae_ib_image_fullwidth',
        //     [
        //         'label' => __( 'Image Fullwidth', 'elegant-addons-for-elementor' ),
        //         'type'  => Controls_Manager::SWITCHER,
        //         'selectors' => [
        //             '{{WRAPPER}} .ct-service-card-icon' => 'width: 100%;box-sizing: border-box;',
        //         ],
        //         // 'condition' => [
        //         //     'eae_ib_eae_ib_icon_type' => 'image'
        //         // ]
        //     ]
        // );

        $this->add_control(
            'eae_ib_rotate',
            [
                'label'   => __( 'Rotate', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-card-icon i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .ct-service-card-icon img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_icon_background_rotate',
            [
                'label'   => __( 'Background Rotate', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-card-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_image_icon_heading',
            [
                'label'     => __( 'Image Effect', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'eae_icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'eae_ib_css_filters',
                'selector'  => '{{WRAPPER}} .ct-single-service-card img',
                'condition' => [
                    'eae_icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_image_opacity',
            [
                'label' => __( 'Opacity', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'eae_icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_background_hover_transition',
            [
                'label' => __( 'Transition Duration', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-card-icon' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'eae_ib_icon_hover',
            [
                'label' => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_ib_icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.eae-ib-view-stacked .ct-single-service-card:hover .ct-service-card-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.eae-ib-view-framed .ct-single-service-card:hover .ct-service-card-icon, {{WRAPPER}}.eae-ib-view-default .ct-single-service-card:hover .ct-service-card-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
                'condition' => [
                    'eae_icon_type!' => 'image',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eae_ib_icon_hover_background',
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon',
            ]
        );

        // $this->add_control(
        //     'eae_ib_icon_hover_animation',
        //     [
        //         'label' => __( 'Hover Animation', 'elegant-addons-for-elementor' ),
        //         'type' => Controls_Manager::HOVER_ANIMATION,
        //     ]
        // );

        $this->add_control(
            'eae_ib_icon_hover_border_color',
            [
                'label'     => __( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon'  => 'border-color: {{VALUE}};',
                ],
                // 'condition' => [
                //     'eae_ib_icon_border_border!' => '',
                // ],
            ]
        );

        $this->add_control(
            'eae_ib_icon_hover_radius',
            [
                'label'      => esc_html__('Radius', 'elegant-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} ..ct-single-service-card:hover .ct-service-card-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eae_ib_icon_hover_shadow',
                'selector' => '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon'
            ]
        );

        $this->add_control(
            'eae_ib_eae_ib_icon_hover_rotate',
            [
                'label'   => __( 'Rotate', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ..ct-single-service-card:hover .ct-service-card-icon i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_icon_hover_background_rotate',
            [
                'label'   => __( 'Background Rotate', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_image_icon_hover_heading',
            [
                'label'     => __( 'Image Effect', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'eae_icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'eae_ib_css_filters_hover',
                'selector'  => '{{WRAPPER}} .eae-advanced-icon-box:hover .eae-icon-wrapper img',
                'condition' => [
                    'eae_icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_image_opacity_hover',
            [
                'label' => __( 'Opacity', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card:hover .ct-service-card-icon img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'eae_icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_style_content',
            [
                'label' => __( 'Content', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'eae_ib_content_padding',
            [
                'label'      => esc_html__('Padding', 'elegant-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ct-service-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'eae_ib_heading_title',
            [
                'label'     => __( 'Title', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'eae_ib_title_bottom_space',
            [
                'label' => __( 'Spacing', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-service-content .ct-ib-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_title_color',
            [
                'label'     => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-service-content .ct-ib-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_ib_title_typography',
                'selector' => '{{WRAPPER}} .ct-service-content .ct-ib-title',
            ]
        );

        $this->add_control(
            'eae_ib_heading_description',
            [
                'label'     => __( 'Description', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'description_bottom_space',
            [
                'label'     => esc_html__('Spacing', 'elegant-addons-for-elementor'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-service-content .ct-ib-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_description_color',
            [
                'label'     => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-service-content .ct-ib-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_ib_description_typography',
                'selector' => '{{WRAPPER}} .ct-service-content .ct-ib-description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_content_title_separator',
            [
                'label'     => __( 'Title Separator', 'elegant-addons-for-elementor' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_ib_show_separator' => 'yes',
                ],
            ]
        );

        // $this->add_control(
        //     'eae_ib_title_separator_type',
        //     [
        //         'label'   => esc_html__( 'Separator Type', 'elegant-addons-for-elementor' ),
        //         'type'    => Controls_Manager::SELECT,
        //         'default' => 'line',
        //         'options' => [
        //             'line'        => esc_html__( 'Line', 'elegant-addons-for-elementor' ),
        //             'bloomstar'   => esc_html__( 'Bloomstar', 'elegant-addons-for-elementor' ),
        //             'bobbleaf'    => esc_html__( 'Bobbleaf', 'elegant-addons-for-elementor' ),
        //             'demaxa'      => esc_html__( 'Demaxa', 'elegant-addons-for-elementor' ),
        //             'fill-circle' => esc_html__( 'Fill Circle', 'elegant-addons-for-elementor' ),
        //             'finalio'     => esc_html__( 'Finalio', 'elegant-addons-for-elementor' ),
        //             //'fitical'       => esc_html__( 'Fitical', 'elegant-addons-for-elementor' ),
        //             'jemik'       => esc_html__( 'Jemik', 'elegant-addons-for-elementor' ),
        //             //'genizen'       => esc_html__( 'Genizen', 'elegant-addons-for-elementor' ),
        //             'leaf-line'   => esc_html__( 'Leaf Line', 'elegant-addons-for-elementor' ),
        //             //'lendine'       => esc_html__( 'Lendine', 'elegant-addons-for-elementor' ),
        //             'multinus'    => esc_html__( 'Multinus', 'elegant-addons-for-elementor' ),
        //             //'oradox'    => esc_html__( 'Oradox', 'elegant-addons-for-elementor' ),
        //             'rotate-box'  => esc_html__( 'Rotate Box', 'elegant-addons-for-elementor' ),
        //             'sarator'     => esc_html__( 'Sarator', 'elegant-addons-for-elementor' ),
        //             'separk'      => esc_html__( 'Separk', 'elegant-addons-for-elementor' ),
        //             'slash-line'  => esc_html__( 'Slash Line', 'elegant-addons-for-elementor' ),
        //             //'subtrexo'      => esc_html__( 'Subtrexo', 'elegant-addons-for-elementor' ),
        //             'tripline'    => esc_html__( 'Tripline', 'elegant-addons-for-elementor' ),
        //             'vague'       => esc_html__( 'Vague', 'elegant-addons-for-elementor' ),
        //             'zigzag-dot'  => esc_html__( 'Zigzag Dot', 'elegant-addons-for-elementor' ),
        //             'zozobe'      => esc_html__( 'Zozobe', 'elegant-addons-for-elementor' ),
        //         ],
        //         //'render_type' => 'none',
        //     ]
        // );

        $this->add_control(
            'eae_ib_title_separator_border_style',
            [
                'label'   => esc_html__( 'Separator Style', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid'  => esc_html__( 'Solid', 'elegant-addons-for-elementor' ),
                    'dotted' => esc_html__( 'Dotted', 'elegant-addons-for-elementor' ),
                    'dashed' => esc_html__( 'Dashed', 'elegant-addons-for-elementor' ),
                    'groove' => esc_html__( 'Groove', 'elegant-addons-for-elementor' ),
                ],
                // 'condition' => [
                //     'eae_ib_title_separator_type' => 'line'
                // ],
                'selectors'  => [
                    '{{WRAPPER}} .ct-single-service-card .eae-title-separator' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_title_separator_line_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                // 'condition' => [
                //     'title_separator_type' => 'line'
                // ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card .eae-title-separator' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_ib_title_separator_height',
            [
                'label' => __( 'Height', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 15,
                    ]
                ],
                // 'condition' => [
                //     'eae_ib_title_separator_type' => 'line'
                // ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card .eae-title-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'eae_ib_title_separator_width',
            [
                'label' => __( 'Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ]
                ],
                // 'condition' => [
                //     'eae_ib_title_separator_type' => 'line'
                // ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card .eae-title-separator' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eae_ib_eae_ib_title_separator_spacing',
            [
                'label' => __( 'Separator Spacing', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-single-service-card .eae-title-separator-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_style_readmore',
            [
                'label'     => __( 'Read More', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'eae_ib_readmore'       => 'yes',
                // ],
            ]
        );

        $this->add_control(
            'eae_ib_readmore_attention',
            [
                'label' => __( 'Attention', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->start_controls_tabs( 'eae_ib_tabs_readmore_style' );

        $this->start_controls_tab(
            'eae_ib_tab_readmore_normal',
            [
                'label' => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_ib_readmore_text_color',
            [
                'label'     => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-ib-read-more' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eae-ib-read-more svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eae_ib_readmore_background',
                'selector'  => '{{WRAPPER}} .eae-ib-read-more',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'eae_ib_readmore_border',
                'placeholder' => '1px',
                'separator'   => 'before',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .eae-ib-read-more'
            ]
        );

        $this->add_responsive_control(
            'eae_ib_readmore_radius',
            [
                'label'      => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .eae-ib-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eae_ib_readmore_shadow',
                'selector' => '{{WRAPPER}} .eae-ib-read-more',
            ]
        );

        $this->add_responsive_control(
            'eae_ib_readmore_padding',
            [
                'label'      => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eae-ib-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_ib_readmore_typography',
                'selector' => '{{WRAPPER}} .eae-ib-read-more',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'eae_ib_tab_readmore_hover',
            [
                'label' => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'eae_ib_readmore_hover_text_color',
            [
                'label'     => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-ib-read-more:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eae-ib-read-more:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eae_ib_readmore_hover_background',
                'selector'  => '{{WRAPPER}} .eae-ib-read-more:hover',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'eae_ib_readmore_hover_border_color',
            [
                'label'     => __( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-ib-read-more:hover' => 'border-color: {{VALUE}};',
                ],
                // 'condition' => [
                //     'readmore_border_border!' => ''
                // ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eae_ib_readmore_hover_shadow',
                'selector' => '{{WRAPPER}} .eae-ib-read-more:hover',
            ]
        );

        // $this->add_control(
        //     'eae_ib_icon_hover_animation',
        //     [
        //         'label' => __( 'Hover Animation', 'elegant-addons-for-elementor' ),
        //         'type' => Controls_Manager::HOVER_ANIMATION,
        //         //'prefix_class' => 'elementor-animation-',
        //     ]
        // );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_ib_section_style_badge',
            [
                'label'     => __( 'Badge', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'eae_ib_badge' => 'yes',
                // ],
            ]
        );

        $this->add_control(
            'eae_ib_badge_text_color',
            [
                'label'     => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-ib-tag-mark' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eae_ib_badge_background',
                'selector'  => '{{WRAPPER}} .eae-ib-tag-mark',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'eae_ib_badge_border',
                'placeholder' => '1px',
                'separator'   => 'before',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .eae-ib-tag-mark'
            ]
        );

        $this->add_responsive_control(
            'eae_ib_badge_radius',
            [
                'label'      => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .eae-ib-tag-mark' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eae_ib_badge_shadow',
                'selector' => '{{WRAPPER}} .eae-ib-tag-mark',
            ]
        );

        $this->add_responsive_control(
            'eae_ib_badge_padding',
            [
                'label'      => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eae-ib-tag-mark' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_ib_badge_typography',
                'selector' => '{{WRAPPER}} .eae-ib-tag-mark',
            ]
        );

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
        $settings       = $this->get_settings_for_display();

        $target         = $settings['eae_ib_title_link_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow       = $settings['eae_ib_title_link_url']['nofollow'] ? ' rel="nofollow"' : '';

        $rm_target      = $settings['eae_ib_readmore_link']['is_external'] ? ' target="_blank"' : '';
        $rm_nofollow    = $settings['eae_ib_readmore_link']['nofollow'] ? ' rel="nofollow"' : '';

        $title_link = '';
        $title_end  = '';

        if ( $settings['eae_ib_title_link'] ) {
            $title_link = '<a href="' . $settings['eae_ib_title_link_url']['url'] . '"' . $target . $nofollow . '>';
            $title_end  = '</a>';
        }

        $rm_right = '';
        $rm_left = '';

        if ( $settings['eae_ib_readmore_icon_align'] == 'right' ) {
            $rm_right = '<span class="' . $settings['eae_ib_readmore_icon']['value'] . ' eae-rm-right" aria-hidden="true"></span>';
        } else if ( $settings['eae_ib_readmore_icon_align'] == 'left' ) {
            $rm_left  = '<span class="' . $settings['eae_ib_readmore_icon']['value'] . ' eae-rm-left" aria-hidden="true"></span>';
        }
        ?>
        <section class="ct-iconbox-card">
            <div class="ct-card-container">
                <div class="ct-single-service-card">
                    <div class="ct-icon-box">
                        <div class="ct-service-card-icon">
                           <?php
                                if ( $settings['eae_icon_type'] == 'icon' ) {
                                        \Elementor\Icons_Manager::render_icon( $settings['eae_ib_icon_select'], [ 'aria-hidden' => 'true' ] );
                                } else if( $settings['eae_icon_type'] == 'image' ) {
                                    echo wp_get_attachment_image( $settings['eae_ib_image_select']['id'], 'full' );
                                }
                           ?>
                        </div><!-- /.service-card-icon -->
                    </div><!-- /.ct-icon-box -->
                    <div class="ct-service-content">
                        <?php echo $title_link . '<' . $settings['eae_ib_title_size'] . ' class="ct-ib-title">' . esc_html( $settings['eae_ib_title_text'] ) . '</' . $settings['eae_ib_title_size'] . '>' . $title_end; ?>

                        <?php if( $settings[ 'eae_ib_show_separator' ]  == 'yes' ) : ?>
                        <div class="eae-title-separator-section">
                            <div class="eae-title-separator"></div><!-- /.eae-title-separator -->
                        </div><!-- /.eae-title-separator -->
                        <?php endif; ?>
                        <p class="ct-ib-description"><?php echo esc_html( $settings['eae_ib_description_text'] ); ?></p>
                        <?php
                            if ( $settings['eae_ib_show_readmore'] == 'yes' ) {
                                echo '<a href="' . esc_url( $settings['eae_ib_readmore_link']['url'] ) . '"' . $rm_target . $rm_nofollow . ' class="eae-ib-read-more">' . $rm_left . $settings['eae_ib_readmore_text'] . $rm_right . '</a>';
                            }
                        ?>
                    </div><!-- /.services-content -->
                </div><!-- /.single-service-card -->
                <?php if ( $settings['eae_ib_badge_text'] ) : ?>
                    <div class="eae-ib-tag ct-position-abs-<?php echo esc_attr( $settings['eae_ib_badge_position'] ); ?>">
                        <span class="eae-ib-tag-mark">
                                <?php echo esc_html( $settings['eae_ib_badge_text'] ); ?>
                        </span>
                    </div><!-- /.eae-ib-tag -->
                <?php endif ?>
                <?php if( $settings[ 'eae_ib_show_fancy_divider' ]  == 'yes' ) : ?>
                    <div class="section-divider"></div><!-- /.section-divider -->
                <?php endif; ?>
            </div><!-- /.card-container -->
        </section>
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
            var target          = settings.eae_ib_title_link_url.is_external ? ' target="_blank"' : '';
            var nofollow        = settings.eae_ib_title_link_url.nofollow ? ' rel="nofollow"' : '';

            var rm_target       = settings.eae_ib_readmore_link.is_external ? ' target="_blank"' : '';
            var rm_nofollow     = settings.eae_ib_readmore_link.nofollow ? ' rel="nofollow"' : '';

            var title_link      = '';
            var title_end       = '';

            if ( settings.eae_ib_title_link ) {
                var title_link = '<a href="' + settings.eae_ib_title_link_url.url + '"' + target + nofollow + '>';
                var title_end  = '</a>';
            }

            var rm_right = '';
            var rm_left = '';

            if ( settings.eae_ib_readmore_icon_align == 'right' ) {
                var rm_right = '<span class="' + settings.eae_ib_readmore_icon.value + ' eae-rm-right" aria-hidden="true"></span>';
            } else if ( settings.eae_ib_readmore_icon_align == 'left' ) {
                var rm_left  = '<span class="' + settings.eae_ib_readmore_icon.value + ' eae-rm-left" aria-hidden="true"></span>';
            }
        #>

        <section class="ct-iconbox-card">
            <div class="ct-card-container">
                <div class="ct-single-service-card">
                    <div class="ct-icon-box">
                        <div class="ct-service-card-icon">
                            <# if ( settings.eae_icon_type == 'icon' ) { #>
                                <i class="{{ settings.eae_ib_icon_select.value }}" aria-hidden="true"></i>
                            <# } else if( settings.eae_icon_type == 'image' ) { #>
                                <img src="{{ settings.eae_ib_image_select.url }}" alt="image">
                            <# } #>
                        </div><!-- /.service-card-icon -->
                    </div><!-- /.ct-icon-box -->
                    <div class="ct-service-content">
                        {{{title_link}}}<{{settings.eae_ib_title_size}} class="ct-ib-title">{{settings.eae_ib_title_text}}</{{settings.eae_ib_title_size}}>{{{title_end}}}

                        <# if( settings.eae_ib_show_separator== 'yes' ) { #>
                        <div class="eae-title-separator-section">
                            <div class="eae-title-separator"></div><!-- /.eae-title-separator -->
                        </div><!-- /.eae-title-separator -->
                        <# } #>
                        <p class="ct-ib-description">{{settings.eae_ib_description_text}}</p>
                        <# if ( settings.eae_ib_show_readmore == 'yes' ) { #>
                            <a href="{{settings.eae_ib_readmore_link.url}}" {{ rm_target }} {{ rm_nofollow }} class="eae-ib-read-more">{{{rm_left}}}{{settings.eae_ib_readmore_text}}{{{rm_right}}}</a>
                        <# } #>
                    </div><!-- /.services-content -->
                </div><!-- /.single-service-card -->
                <# if( settings.eae_ib_badge_text != '' ) { #>
                    <div class="eae-ib-tag ct-position-abs-{{settings.eae_ib_badge_position}}">
                        <span class="eae-ib-tag-mark">
                            {{ settings.eae_ib_badge_text }}
                        </span>
                    </div><!-- /.eae-ib-tag -->
                <# } #>
                <# if( settings.eae_ib_show_fancy_divider == 'yes' ) { #>
                <div class="section-divider"></div><!-- /.section-divider -->
                <# } #>
            </div><!-- /.card-container -->
        </section>

        <?php

    }

}
