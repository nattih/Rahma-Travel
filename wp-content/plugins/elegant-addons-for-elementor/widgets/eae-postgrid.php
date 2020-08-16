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
use Elementor\Icons_Manager;
use Elementor\Core\Files\Assets\Svg\Svg_Handler;

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
class Eae_Postgrid extends Widget_Base {

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
        return 'eae_postgrid';
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
        return __( 'EAE Post Grid', 'elegant-addons-for-elementor' );
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
        return 'eicon-posts-grid';
    }

    public function get_script_depends() {
        return [ 'eae-scripts', 'masonry' ];
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
            'eae_postgrid_section_content_layout',
            [
                'label' => esc_html__( 'Layout', 'elegant-addons-for-elementor' ),
            ]
        );
        // $this->add_control(
        //     'eae_postgrid_skin',
        //     [
        //         'label'       => esc_html__( 'Skin', 'elegant-addons-for-elementor' ),
        //         'type'        => Controls_Manager::SELECT,
        //         'default'     => 'skin1',
        //         'label_block' => true,
        //         'options'     => [
        //             'skin1' => esc_html__( 'Skin1', 'elegant-addons-for-elementor' ),
        //             'skin2' => esc_html__( 'Skin2', 'elegant-addons-for-elementor' ),
        //             'skin3'   => esc_html__( 'Skin3', 'elegant-addons-for-elementor' ),
        //         ],
        //     ]
        // );

        $this->add_control(
            'eae_postgrid_columns',
            [
                'label' => __( 'Columns', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12' => __( '1', 'elegant-addons-for-elementor' ),
                    '6' => __( '2', 'elegant-addons-for-elementor' ),
                    '4' => __( '3', 'elegant-addons-for-elementor' ),
                    '3' => __( '4', 'elegant-addons-for-elementor' ),
                    '2' => __( '6', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_postgrid_post_limit',
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
                    'size' => 3,
                ],
            ]
        );

        // $this->add_control(
        //     'eae_postgrid_pagination',
        //     [
        //         'label'   => esc_html__( 'Pagination', 'elegant-addons-for-elementor' ),
        //         'type'    => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //     ]
        // );

        $this->add_control(
            'eae_postgrid_masonry',
            [
                'label'         => __( 'Masonry', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value'  => 'eae-grid',
                'default'       => 'eae-grid',
            ]
        );

        $this->add_control(
            'eae_postgrid_thumb',
            [
                'label'         => esc_html__( 'Image', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'eae_postgrid_thumbnail_size',
                'label'     => esc_html__( 'Image Size', 'elegant-addons-for-elementor' ),
                'exclude'   => [ 'custom' ],
                'default'   => 'large',
                'condition' => [
                    'eae_postgrid_thumb' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_title',
            [
                'label'   => esc_html__( 'Title', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'eae_postgrid_meta',
            [
                'label'   => esc_html__( 'Meta Data', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'eae_postgrid_tags',
            [
                'label'   => esc_html__( 'Tags', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'eae_postgrid_categories',
            [
                'label'   => esc_html__( 'Categories', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'eae_postgrid_excerpt',
            [
                'label'   => esc_html__( 'Excerpt', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'return_value'  => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'eae_postgrid_excerpt_length',
            [
                'label'     => esc_html__( 'Excerpt Length', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 15,
                'condition' => [
                    'eae_postgrid_excerpt'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_readmore',
            [
                'label'       => esc_html__( 'Readmore Option', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'readmore',
                'label_block' => true,
                'options'     => [
                    'none' => esc_html__( 'None', 'elegant-addons-for-elementor' ),
                    'readmore' => esc_html__( 'Read more Link', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_readmore_title',
            [
                'label' => __( 'Read More Text', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Read More »', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Read More Text', 'elegant-addons-for-elementor' ),
                'condition' => [
                    'eae_postgrid_readmore'   => 'readmore',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_content_query',
            [
                'label' => __( 'Query', 'elegant-addons-for-elementor' ),
            ]
        );

        // $this->add_group_control(
        //     Group_Control_Posts::get_type(),
        //     [
        //         'name'  => 'eae_postgrid_posts',
        //         'label' => __( 'Posts', 'elegant-addons-for-elementor' ),
        //     ]
        // );

        $this->add_control(
            'eae_postgrid_advanced',
            [
                'label' => __( 'Advanced', 'elegant-addons-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'eae_postgrid_orderby',
            [
                'label'   => __( 'Order By', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'  => __( 'Date', 'elegant-addons-for-elementor' ),
                    'title' => __( 'Title', 'elegant-addons-for-elementor' ),
                    'menu_order' => __( 'Menu Order', 'elegant-addons-for-elementor' ),
                    'rand'       => __( 'Random', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_offset',
            [
                'label'     => esc_html__( 'Offset', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 0,
                'condition' => [
                    'posts_post_type!' => 'by_id',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_order',
            [
                'label'   => __( 'Order', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __( 'ASC', 'elegant-addons-for-elementor' ),
                    'desc' => __( 'DESC', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_content_button',
            [
                'label'     => esc_html__( 'Button', 'elegant-addons-for-elementor' ),
                'condition' => [
                    'button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_button_text',
            [
                'label'       => esc_html__( 'Text', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Read More', 'elegant-addons-for-elementor' ),
                'default'     => esc_html__( 'Read More', 'elegant-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'eae_postgrid_post_card_icon',
            [
                'label'       => esc_html__( 'Icon', 'elegant-addons-for-elementor' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'eae_postgrid_icon_align',
            [
                'label'   => esc_html__( 'Icon Position', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__( 'Before', 'elegant-addons-for-elementor' ),
                    'right' => esc_html__( 'After', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'eae_postgrid_post_card_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_style_item',
            [
                'label' => esc_html__( 'Item Layout', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eae_postgrid_column_gap',
            [
                'label'   => esc_html__( 'Columns Gap', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_row_gap',
            [
                'label'   => esc_html__( 'Row Gap', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_postgrid_padding',
            [
                'label'      => esc_html__( 'Content Padding', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [

                    'top'       => '20',
                    'right'     => '20',
                    'bottom'    => '20',
                    'left'      => '20',
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .single-blog .single-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_item_background',
            [
                'label'     => esc_html__( 'Item Background', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .single-blog .single-blog-content' => 'background-color: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eae_postgrid_section_border',
                'label' => __( 'Border', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eae-blog-grid',
            ]
        );

        $this->add_control(
            'eae_postgrid_section_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eae-blog-grid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

                'default'   => [
                    'unit' => 'px',
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3',
                    'left' => '3',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eae_postgrid_main_shadow',
                'selector' => '{{WRAPPER}} .eae-blog-grid',
            ]
        );

        $this->add_control(
            'eae_postgrid_text_align',
            [
                'label' => __( 'Alignment', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'default' => 'left',
                'toggle' => true,

                'selectors' => [
                    '{{WRAPPER}} .single-blog .single-blog-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_style_tags',
            [
                'label'     => esc_html__( 'Tags', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_postgrid_tags' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_tags_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .excerpt-container .ct-tags-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_postgrid_tags_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .excerpt-container .ct-tags-container',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_categories',
            [
                'label'     => esc_html__( 'Categories', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_postgrid_categories' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_categories_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-postgrid .single-blog-content .category-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_postgrid_categories_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .eae-postgrid .single-blog-content .category-container',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_readmore',
            [
                'label'     => esc_html__( 'Read More', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_postgrid_readmore'   => 'readmore',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_rm_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-rm-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_postgrid_rm_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .eae-rm-text',
            ]
        );

        $this->add_responsive_control(
            'eae_postgrid_rm_padding',
            [
                'label'     => esc_html__( 'Margin', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .eae-rm-text' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();




        $this->start_controls_section(
            'eae_postgrid_section_style_title',
            [
                'label'     => esc_html__( 'Title', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_postgrid_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_title_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-postgrid .eae_post_title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_postgrid_title_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .eae-postgrid .eae_post_title a',
            ]
        );

        $this->add_control(
            'eae_postgrid_title_spacing',
            [
                'label' => __( 'Spacing', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-postgrid .eae_post_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'eae_postgrid_section_style_excerpt',
            [
                'label'     => esc_html__( 'Excerpt', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_postgrid_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-postgrid .post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eae_postgrid_excerpt_margin',
            [
                'label'     => esc_html__( 'Margin', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .eae-postgrid .post-excerpt' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_postgrid_excerpt_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .eae-postgrid .post-excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eae_postgrid_section_style_meta',
            [
                'label'     => esc_html__( 'Meta', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eae_postgrid_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_meta_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-meta span, .fa-tags:before' => 'color: {{VALUE}}',
                    //'{{WRAPPER}} .eae-meta' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'eae_postgrid_meta_color',
            [
                'label'     => esc_html__( 'Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-meta *' => 'color: {{VALUE}}',
                    //'{{WRAPPER}} .eae-meta' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eae_postgrid_meta_typography',
                'label'    => esc_html__( 'Typography', 'elegant-addons-for-elementor' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'fields_options' => [

                    'font_size' => [
                        'default' => [
                            'unit' => 'px', 'size' => 12
                        ]
                    ],
                ],
                'selector' => '{{WRAPPER}} .eae-meta *:not(span)',
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
        $settings = $this->get_settings_for_display();

        $post_per   = esc_html( $settings[ 'eae_postgrid_post_limit' ][ 'size' ] );
        $order_by   = esc_html( $settings[ 'eae_postgrid_orderby' ] );
        $order      = esc_html( $settings[ 'eae_postgrid_order' ] );
        $paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $query_args = array(
            'post_type'         =>  'post',
            'posts_per_page'    =>  $post_per,
            'orderby'           =>  $order_by,
            'order'             =>  $order,
            'ignore_sticky_posts' => true,
            'paged'             =>  $paged
        );
        $eae_postgrid_loop  = new \WP_Query( $query_args );

        $eae_grid       = $settings[ 'eae_postgrid_columns' ];
        ?>

        <?php if ( $eae_postgrid_loop->have_posts() ) : ?>
            <div class="eae-postgrid <?php echo esc_attr( $settings['eae_postgrid_masonry'] ); ?>" data-padding-right="<?php echo esc_attr( $settings['eae_postgrid_column_gap']['size'] ); ?>">
        <?php while ( $eae_postgrid_loop->have_posts() ) : $eae_postgrid_loop->the_post(); ?>
            <?php
                $settings['eae_postgrid_thumbnail_size'] = [
                    'id' => get_post_thumbnail_id(),
                ];

                $placeholder_image = Utils::get_placeholder_image_src();
                $thumbnail_html    = Group_Control_Image_Size::get_attachment_image_html( $settings, 'eae_postgrid_thumbnail_size' );

                if ( ! $thumbnail_html ) {
                    $thumbnail_html = '<img src="' . esc_url( $placeholder_image ) . '" alt="' . get_the_title() . '">';
                }

                // Get all the categories inside loop
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
                    foreach( get_the_tags() as $eae_tag ) {
                        $eae_posttags[] = $eae_tag->name;
                    }

                    $eae_posttags = implode( ', ' , $eae_posttags );
                }
            ?>
            <div class="single-blog col-eae-<?php echo esc_attr( $eae_grid ); ?> eae-grid-item" style="margin-bottom: <?php echo esc_attr( $settings['eae_postgrid_row_gap']['size'] ); ?>px;">
                <div class="eae-blog-grid">
                    <?php if( $settings['eae_postgrid_thumb'] == 'yes' ) { ?>
                        <div class="blog-image image-container">
                            <?php echo $thumbnail_html; ?>
                        </div><!-- /.image-container -->
                    <?php } ?>

                    <div class="single-blog-content">
                        <?php
                            if( $settings['eae_postgrid_categories'] == 'yes' ) { ?>
                            <span class="category-container"><?php echo ( !is_array( $eae_categories ) ) ? $eae_categories : ''; ?></span>
                        <?php } ?>
                        <div class="excerpt-container">
                            <?php
                                if( $settings['eae_postgrid_title'] == 'yes' ) {
                                    the_title( sprintf( '<h2 class="eae_post_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                                }

                                if( $settings['eae_postgrid_meta'] == 'yes' ) {
                                    echo '<ul class="eae-meta">';
                                    echo '<li class="eae-author-meta"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span class="fas fa-user"></span>' . get_the_author() .'</a></li>';
                                    echo '<li class="eae-post-date"><span class="fas fa-calendar"></span>' . esc_html( get_the_date() ) . '</li>';
                                    echo '<li><span class="fas fa-comment"></span>' . get_comments_number() . ' ' . esc_html__( 'Comments', 'elegant-addons-for-elementor' ) . '</li>';
                                    echo '</ul>';
                                }

                                if ( $settings[ 'eae_postgrid_excerpt' ] == 'yes' ) {
                                    $eae_trim_excerpt       = get_the_excerpt();
                                    $eae_excerpt_limit      = $settings['eae_postgrid_excerpt_length'];
                                    $eae_short_excerpt      = wp_trim_words( $eae_trim_excerpt, $eae_excerpt_limit, $more = '... ' );

                                    echo "<p class='post-excerpt'>" . esc_html( $eae_short_excerpt ) . "</p>";
                                }

                                if( $settings['eae_postgrid_tags'] == 'yes' && !is_array( $eae_posttags ) ) {
                            ?>
                                <span class="ct-tags-container">
                                    <span class="fas fa-tags"></span>
                                    <?php echo ( !is_array( $eae_posttags ) ) ? $eae_posttags : ''; ?>
                                </span>
                            <?php
                                }
                            ?>
                            <?php if ( !empty( $settings[ 'eae_postgrid_readmore_title' ] ) ) : ?>
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <?php
                                        echo "<p class='eae-rm-text'>" . esc_html( $settings['eae_postgrid_readmore_title'] ) . "</p>";
                                    ?>
                                </a>
                            <?php endif; ?>
                        </div><!-- /.excerpt-container -->
                    </div><!-- /.single-blog-content -->
                </div><!-- /.eae-blog-grid -->
            </div><!-- /.single-blog -->
        <?php endwhile; ?>
            </div><!-- /.eae-postgrid -->
        <?php endif; // Have Post ?>
        <?php
    }

}
