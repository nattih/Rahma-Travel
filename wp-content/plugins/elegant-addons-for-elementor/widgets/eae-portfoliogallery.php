<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Control_Select;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Portfoliogallery extends Widget_Base {

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
        return 'eae_portfolio';
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
        return __( 'EAE Portfolio Gallery', 'elegant-addons-for-elementor' );
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
        return 'eicon-gallery-grid';
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
        return [ 'eae-filterizr', 'eae-scripts' ];
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
            'ct_section_portfolio',
            [
                'label' => __( 'Layout', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_skin',
            [
                'label' => __( 'Layout Skins', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'alpha',
                'options' => [
                    'alpha'     => __( 'Skin1', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_columns',
            [
                'label' => __( 'Columns', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'column3',
                'options' => [
                    'column1' => __( '1', 'elegant-addons-for-elementor' ),
                    'column2' => __( '2', 'elegant-addons-for-elementor' ),
                    'column3' => __( '3', 'elegant-addons-for-elementor' ),
                    'column4' => __( '4', 'elegant-addons-for-elementor' ),
                    'column6' => __( '6', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_post_per_page',

            [
                'label' => __( 'Post Per Page', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'no' ],
                'range' => [
                    'no' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_pagination',
            [
                'label'         => __( 'Pagination', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
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
            'ct_portfolio_masonry',
            [
                'label'         => __( 'Masonry', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'ct_portfolio_item_ratio',
            [
                'label'   => esc_html__( 'Item Height', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'range' => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-filterizr .filtr-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_section_query',
            [
                'label' => esc_html__( 'Query', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_show_filter_bar',
            [
                'label'         => __( 'Category/Tag', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'ct_portfolio_source',
            [
                'label' => __( 'Source', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => [
                    'post'  => __( 'Post', 'elegant-addons-for-elementor' ),
                    'page' => __( 'Page', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_order_by',
            [
                'label'     => __( 'Order By', 'elegant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'date',
                'options'   => [
                    'date'  => __( 'Date', 'elegant-addons-for-elementor' ),
                    'title' => __( 'Title', 'elegant-addons-for-elementor' ),
                    'rand'  => __( 'Random', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_order',
            [
                'label'     => __( 'Order', 'elegant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'desc'  => __( 'DESC', 'elegant-addons-for-elementor' ),
                    'asc'   => __( 'ASC', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

         $this->add_control(
            'ct_taxonomy',
            [
                'label'     => __( 'Taxonomy', 'elegant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'category',
                'options'   => [
                    'category'  => __( 'Category', 'elegant-addons-for-elementor' ),
                    'tags'   => __( 'Tags', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_categories',
            [
                'label'         => __( 'Filter By Category', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __( 'Get posts for specific category(s)', 'elegant-addons-for-elementor' ),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => ct_post_type_categories(),
                'condition' => [
                    'ct_taxonomy' => 'category',
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_tags',
            [
                'label'         => __( 'Filter By Tag', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __( 'Get posts for specific tag(s)', 'elegant-addons-for-elementor' ),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => ct_post_type_tags(),
                'condition' => [
                    'ct_taxonomy' => 'tags',
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_advanceed_section',
            [
                'label' => esc_html__( 'Advanced Options', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_animation',
            [
                'label'     => esc_html__( 'Overlay Animation', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'fade',
                'options'   => et_elementor_transition_options(),
            ]
        );

        $this->add_control(
            'ct_portfolio_show_title',
            [
                'label'         => __( 'Title', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
            'ct_portfolio_title_html_tag',
            [
                'label'     => esc_html__( 'Title HTML Tag', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => et_elementor_title_tags(),
                'default'   => 'h5',
                'condition' => [
                    'ct_portfolio_show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_excerpt',
            [
                'label'         => __( 'Excerpt', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'ct_portfolio_excerpt_limit',
            [
                'label'     => esc_html__( 'Excerpt Limit', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 10,
                'condition' => [
                    'ct_portfolio_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_show_category',
            [
                'label'         => __( 'Category/Tag', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'ct_portfolio_show_link',
            [
                'label'     => __( 'Show Link', 'elegant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'both',
                'options'   => [
                    'post-link'     => __( 'Post link', 'elegant-addons-for-elementor' ),
                    'light-box'     => __( 'Light Box', 'elegant-addons-for-elementor' ),
                    'both'          => __( 'Both', 'elegant-addons-for-elementor' ),
                    'none'          => __( 'None', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_link_type',
            [
                'label'   => esc_html__( 'Link Type', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'elegant-addons-for-elementor'),
                ],
                'condition' => [
                    'ct_portfolio_show_link!' => 'none',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_items_section',
            [
                'label' => esc_html__( 'Items', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_item_gap',
            [
                'label'   => esc_html__( 'Column Gap', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .filtr-item'    => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_row_gap',
            [
                'label'   => esc_html__( 'Row Gap', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .item-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

                'separator' => 'after',
            ]
        );

        $this->add_control(
            'ct_portfolio_overlay_color',
            [
                'label'     => __( 'Overlay Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .bg-overlay' => 'background-color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_overlay_gap',
            [
                'label'   => esc_html__( 'Overlay Gap', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .bg-overlay' => 'margin: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_overlay_content_alignment',
            [
                'label'   => __( 'Overlay Content Alignment', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .post-gallery-content-inner' => 'text-align: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay_content_position',
            [
                'label'   => __( 'Overlay Content Vertical Position', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
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
                'selectors_dictionary' => [
                    'top'    => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'default'   => 'middle',
                'selectors' => [
                    '{{WRAPPER}} .cte-divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'ct_portfolio_title_color',
            [
                'label'     => __( 'Title Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                ],
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .gallery-content-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_portfolio_title_color_typography',
                'label' => __( 'Title Typography', 'elegant-addons-for-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .gallery-content-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_section_style_excerpt',
            [
                'label'     => esc_html__( 'Excerpt', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ct_portfolio_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio__excerpt_margin',
            [
                'label'     => esc_html__( 'Margin', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-excerpt' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_portfolio_excerpt_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_section_style_button',
            [
                'label'     => esc_html__( 'Buttons', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ct_portfolio_show_link!' => 'none',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_portfolio_tabs_button_style' );

        $this->start_controls_tab(
            'ct_portfolio_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_button_text_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .fa' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ct_portfolio_button_box_shadow',
                'selector' => '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .fa',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ct_portfolio_border',
                'label'       => esc_html__( 'Border', 'elegant-addons-for-elementor' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'ct_portfolio_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_portfolio_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_hover_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner:hover .post-link .fa'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_background_hover_color',
            [
                'label'     => esc_html__( 'Background Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_section_style_pagination',
            [
                'label'     => esc_html__( 'Pagination', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ct_portfolio_pagination' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_portfolio_tabs_pagination_style' );

        $this->start_controls_tab(
            'ct_portfolio_tab_pagination_normal',
            [
                'label' => esc_html__( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_pagination_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .page-numbers, {{WRAPPER}} .ct-pagination .page-numbers a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'ct_portfolio_pagination_background',
                'selector'  => '{{WRAPPER}} .ct-pagination .page-numbers',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ct_portfolio_pagination_border',
                'label'    => esc_html__( 'Border', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ct-pagination .page-numbers',
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_pagination_offset',
            [
                'label'     => esc_html__( 'Offset', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination' => 'margin-top: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_pagination_space',
            [
                'label'     => esc_html__( 'Spacing', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .page-numbers'     => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .ct-pagination .page-numbers> *' => 'padding-left: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_pagination_padding',
            [
                'label'     => esc_html__( 'Padding', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .page-numbers' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_pagination_radius',
            [
                'label'     => esc_html__( 'Radius', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .page-numbers' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_pagination_arrow_size',
            [
                'label'     => esc_html__( 'Arrow Size', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .page-numbers .fa' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_portfolio_pagination_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .ct-pagination a, {{WRAPPER}} .pagination span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_portfolio_tab_pagination_hover',
            [
                'label' => esc_html__( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_pagination_hover_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_pagination_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .page-numbers:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ct_portfolio_pagination_hover_background',
                'selector' => '{{WRAPPER}} .ct-pagination .page-numbers:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ct_portfolio_tab_pagination_active',
            [
                'label' => esc_html__( 'Active', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_portfolio_pagination_active_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_pagination_active_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-pagination .current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ct_portfolio_pagination_active_background',
                'selector' => '{{WRAPPER}} .ct-pagination .current',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_section_design_filter',
            [
                'label'     => esc_html__( 'Filter Bar', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ct_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_filter_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-controls' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_portfolio_typography_filter',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .filter-controls .controls span',
            ]
        );

        $this->add_control(
            'ct_portfolio_filter_spacing',
            [
                'label'     => esc_html__( 'Bottom Space', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .controls' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'ct_portfolio_tabs_style_desktop' );

        $this->start_controls_tab(
            'ct_portfolio_filter_tab_desktop',
            [
                'label' => __( 'Desktop', 'elegant-addons-for-elementor' )
            ]
        );

        $this->add_control(
            'ct_portfolio_desktop_filter_normal',
            [
                'label' => esc_html__( 'Normal', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ct_portfolio_color_filter',
            [
                'label'     => esc_html__( 'Text Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_desktop_filter_background',
            [
                'label'     => esc_html__( 'Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_portfolio_desktop_filter_padding',
            [
                'label'      => __('Padding', 'elegant-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ct_portfolio_desktop_filter_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .filter-controls .portfolio-controls-button'
            ]
        );

        $this->add_control(
            'ct_portfolio_desktop_filter_radius',
            [
                'label'      => __('Radius', 'elegant-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ct_portfolio_desktop_filter_shadow',
                'selector' => '{{WRAPPER}} .filter-controls .portfolio-controls-button'
            ]
        );

        $this->add_control(
            'ct_portfolio_filter_item_spacing',
            [
                'label'     => esc_html__( 'Space Between', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button .filter'  => 'padding-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_desktop_filter_active',
            [
                'label' => esc_html__( 'Active', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ct_portfolio_color_filter_active',
            [
                'label'     => esc_html__( 'Text Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button .active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_portfolio_section_style_category',
            [
                'label'      => esc_html__( 'Category', 'elegant-addons-for-elementor' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'ct_portfolio_show_category' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'ct_portfolio_category_color',
            [
                'label'     => esc_html__( 'Category Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-category' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ct_portfolio_category_background',
            [
                'label'     => esc_html__( 'Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-category' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ct_portfolio_category_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .portfolio-category',
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

        $settings   = $this->get_settings_for_display();

        $pagination = esc_html( $settings[ 'ct_portfolio_pagination' ] );

        $post_type  = esc_html( $settings[ 'ct_portfolio_source' ] );
        $post_per   = esc_html( $settings[ 'ct_portfolio_post_per_page' ][ 'size' ] );
        $order_by   = esc_html( $settings[ 'ct_portfolio_order_by' ] );
        $order      = esc_html( $settings[ 'ct_portfolio_order' ] );
        $cat        = ( !empty( $settings['ct_portfolio_categories'] ) ) ? esc_html( implode( ',', $settings['ct_portfolio_categories'] ) ) : '';
        $tag        = ( !empty( $settings['ct_portfolio_tags'] ) ) ? esc_html( implode( ',', $settings['ct_portfolio_tags'] ) ) : '';

        $paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $query_args = array(
            'post_type'         =>  $post_type,
            'posts_per_page'    =>  $post_per,
            'orderby'           =>  $order_by,
            'order'             =>  $order,
            'cat'               =>  $cat,
            'tag_id'            =>  $tag,
            'paged'             =>  $paged
        );

        $portfolio_gallery  = new \WP_Query( $query_args );

        if ( $settings['ct_portfolio_skin'] == 'alpha' ) :
            if ( $settings[ 'ct_portfolio_show_filter_bar' ] == 'yes' ) {
    ?>
        <div class="filter-controls inner-section">
            <div class="controls portfolio-controls-button">
                <span class="button-title filter active" data-filter="all"><?php _e( 'All', 'elegant-addons-for-elementor' ); ?></span>
                <?php if ( $settings[ 'ct_taxonomy' ] == 'category' ) { ?>

                    <?php
                        if( is_array( $settings[ 'ct_portfolio_categories' ] ) ) {
                            foreach ( $settings[ 'ct_portfolio_categories' ] as $value) {
                    ?>
                                <span class="button-title filter" data-filter="<?php echo esc_attr( get_the_category_by_ID( $value ) ); ?>"><?php echo esc_html( get_the_category_by_ID( $value ) ); ?></span>
                    <?php
                            }
                        }
                    ?>

                <?php } elseif ( $settings[ 'ct_taxonomy' ] == 'tags' ) { ?>

                    <?php
                        if( is_array( $settings[ 'ct_portfolio_tags' ] ) ) {
                            foreach ( $settings[ 'ct_portfolio_tags' ] as $value) {
                    ?>
                                <?php $ct_tag_loop = get_tag( $value ); ?>
                                <span class="button-title filter" data-filter="<?php echo esc_attr( $ct_tag_loop->name ); ?>"><?php echo esc_html( $ct_tag_loop->name ); ?></span>
                    <?php
                            }
                        }
                    ?>

                <?php } ?>
            </div><!-- /.controls -->
        </div><!-- /.filtr-controls -->
        <?php } //endif ?>

        <?php if ( $portfolio_gallery->have_posts() ) : ?>
            <?php $masonry = ( esc_attr( $settings[ 'ct_portfolio_masonry' ] ) ) ? 'sameWidth' : 'packed' ; ?>
                <div class="filter-container ct-filterizr" data-layout='<?php echo $masonry; ?>'>
                    <?php
                        switch ( $settings[ 'ct_portfolio_columns' ] ) {
                            case 'column1':
                                $grid = '12';
                                break;

                            case 'column2':
                                $grid = '6';
                                break;

                            case 'column3':
                                $grid = '4';
                                break;

                            case 'column4':
                                $grid = '3';
                                break;

                            case 'column6':
                                $grid = '2';
                                break;

                            default:
                                $grid = '4';
                                break;
                        }

                        while ( $portfolio_gallery->have_posts() ) : $portfolio_gallery->the_post();
                            $settings['thumbnail_size'] = [
                                'id' => get_post_thumbnail_id(),
                            ];

                            $placeholder_image = Utils::get_placeholder_image_src();
                            $thumbnail_html    = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );

                            if ( ! $thumbnail_html ) {
                                $thumbnail_html = '<img src="' . esc_url( $placeholder_image ) . '" alt="' . get_the_title() . '">';
                            }

                            if( has_post_thumbnail() ) {
                                $placeholder_image = esc_url( get_the_post_thumbnail_url() );
                            }

                            // Get all the categories
                            $eae_categories = [];
                            if ( get_the_category() ) {
                                foreach( get_the_category() as $category ) {
                                    $eae_categories[] = $category->cat_name;
                                }

                                $eae_categories = implode( ', ', $eae_categories );
                            }

                            // Get all the Tags
                            $eae_posttags = [];
                            if ( get_the_tags() ) {
                                foreach( get_the_tags() as $ct_tag ) {
                                    $eae_posttags[] = $ct_tag->name . ', ';
                                }

                                $eae_posttags = implode( ', ' , $eae_posttags );
                            }

                            if ( $settings[ 'ct_taxonomy' ] == 'category' ) {
                                $ct_taxonomy_filter =   ( !is_array( $eae_categories ) ) ? $eae_categories : '';
                            } elseif ( $settings[ 'ct_taxonomy' ] == 'tags' ) {
                                $ct_taxonomy_filter =   ( !is_array( $eae_posttags ) ) ? $eae_posttags : '';
                            }

                            switch ( $settings[ 'ct_portfolio_show_link' ] ) {
                                case 'post-link':
                                    $ct_portfolio_links = "<a href='" . esc_url( get_the_permalink() ) . "'><i class='fa fa-link circle-icon' aria-hidden='true'></i></a>";
                                    break;

                                case 'light-box':
                                    $ct_portfolio_links = "<a href='$placeholder_image' data-lightbox='port-lightbox'><i class='fa fa-search circle-icon' aria-hidden='true'></i></a>";
                                    break;

                                case 'both':
                                    $ct_portfolio_links = "<a href='" . esc_url( get_the_permalink() ) . "' class='post-link'><i class='fa fa-link circle-icon' aria-hidden='true'></i></a><a href='$placeholder_image' class='post-link' data-lightbox='port-lightbox'><i class='fa fa-search circle-icon' aria-hidden='true'></i></a>";
                                    break;

                                case 'none':
                                    $ct_portfolio_links = '';
                                    break;

                                default:
                                    $ct_portfolio_links = "<a href='" . esc_url( get_the_permalink() ) . "' class='post-link'><i class='fa fa-link circle-icon' aria-hidden='true'></i></a><a href='$placeholder_image' class='post-link' data-lightbox='port-lightbox'><i class='fa fa-search circle-icon' aria-hidden='true'></i></a>";
                                    break;
                            }
                    ?>

                    <div class="filtr-item col-eae-<?php echo $grid; ?>"
                         data-category="<?php echo esc_attr( $ct_taxonomy_filter ); ?>">
                        <div class="item-container post-gallery-inner" style="margin-top: <?php echo esc_attr( $settings['ct_portfolio_row_gap']['size'] ); ?>px; margin-bottom: <?php echo esc_attr( $settings['ct_portfolio_row_gap']['size'] ); ?>px;">
                            <div class="gallery-thumbnail">
                                <?php echo $thumbnail_html; ?>
                            </div>

                            <div class="position-cover overlay bg-overlay animated <?php echo esc_attr( $settings[ 'ct_portfolio_animation' ] ) ?>">
                                <div class="post-gallery-content">
                                    <div class="post-gallery-content-inner">
                                        <?php
                                            if ( $settings[ 'ct_portfolio_show_title' ] == 'yes' ) {
                                                $ct_header_start = '<' . esc_html( $settings[ 'ct_portfolio_title_html_tag' ] ) . ' class="gallery-content-title">';
                                                $ct_header_end   = '</' . esc_html( $settings[ 'ct_portfolio_title_html_tag' ] ) . '>';

                                                the_title( $ct_header_start, $ct_header_end );
                                            }

                                            if ( $settings[ 'ct_portfolio_excerpt' ] == 'yes' ) {
                                                $ct_trim_excerpt       = get_the_excerpt();
                                                $ct_excerpt_limit      = $settings[ 'ct_portfolio_excerpt_limit' ];
                                                $ct_short_excerpt      = wp_trim_words( $ct_trim_excerpt, $ct_excerpt_limit, $more = '... ' );

                                                echo "<p class='post-excerpt'>" . esc_html( $ct_short_excerpt ) . "</p>";
                                            }

                                            if ( $settings[ 'ct_portfolio_show_category' ] == 'yes' ) {
                                                echo "<p class='portfolio-category'>" . esc_html( $ct_taxonomy_filter ) . '</p>';
                                            }
                                        ?>
                                        <?php echo $ct_portfolio_links; ?>
                                    </div>
                                </div><!-- /.absolute-center -->
                            </div><!-- /.overlay-content -->
                        </div><!-- /.item-container -->
                    </div><!-- /.filtr-item -->

                    <?php endwhile; ?>
                </div><!-- /.filter-container -->
        <?php endif; ?>

        <?php if ( $pagination == 'yes' ) { ?>
            <div class="ct-pagination">
                <?php
                    echo paginate_links( array(
                        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'total'        => $portfolio_gallery->max_num_pages,
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'format'       => '?paged=%#%',
                        'show_all'     => false,
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 1,
                        'prev_next'    => true,
                        'prev_text'    => sprintf( '<i></i> %1$s', __( '<i class="fa fa-angle-left"></i>', 'elegant-addons-for-elementor' ) ),
                        'next_text'    => sprintf( '%1$s <i></i>', __( '<i class="fa fa-angle-right"></i>', 'elegant-addons-for-elementor' ) ),
                        'add_args'     => false,
                        'add_fragment' => '',
                    ) );
                ?>
            </div>
        <?php } // pagination ?>

    <?php
     endif; // skin
    }
}
