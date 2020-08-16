<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Fancytitle extends Widget_Base {

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
        return 'eae_fancy_title';
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
        return __( 'EAE Fancy Title', 'elegant-addons-for-elementor' );
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
        return 'eicon-heading';
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
            'ct_fancy_title_section',
            [
                'label' => __( 'Fancy Title', 'elegant-addons-for-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ct_fancy_title_main',
            [
                'label' => __( 'Title', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'I am Fancy title', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Type your title here', 'elegant-addons-for-elementor' ),
            ]
        );

         $this->add_control(
            'ct_fancy_title_link',
            [
                'label' => __( 'Link', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'after',
            ]
        );

         $this->add_control(
            'ct_fancy_secondary_title',
            [
                'label' => __( 'Sub Title', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Background Heading', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Type your title here', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_fancy_item_description',
            [
                'label' => __( 'Description', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Default description', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Type your description here', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section();

        if ( function_exists( 'eae_pro_notice' ) ) {
            eae_pro_notice( $this );
        }

        $this->start_controls_section(
            'ct_fancy_title_section_design',
            [
                'label' => __( 'Design', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        if ( ELEGANT_ADDONS_PRO == 'pro' && function_exists( 'eae_fancy_title_offset_pro' ) ) {
            eae_fancy_title_offset_pro( $this );
        }

        $this->add_control(
            'ct_fancy_title_header_tag',
            [
                'label' => __( 'HTML Tag', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'ct_fancy_title_align',
            [
                'label' => __( 'Alignment', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'ct_fancy_secondary_view',
            [
                'label' => __( 'View', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'ct_fancy_title_separator',
            [
                'label' => __( 'Separator', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none'      => __( 'None', 'elegant-addons-for-elementor' ),
                    'separator' => __('Line Separator', 'elegant-addons-for-elementor'),
                    'animated'  => __('Animated Separator', 'elegant-addons-for-elementor'),
                ],
                'default'   => 'animated',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ct_fancy_title_separator_position',
            [
                'label' => __( 'Separator Position', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top'               => __( 'Top', 'elegant-addons-for-elementor' ),
                    'between_headline'  => 'Between Headline And Text',
                    'bottom'            => 'Bottom',
                ],
                'separator' => 'none',
                'default'   =>  'bottom',
                'condition' => [
                   'ct_fancy_title_separator' => 'separator',
                ],
            ]
        );

        $this->add_control(
            'ct_divider_color',
            [
                'label' => __( 'Color', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_control(
            'ct_fancy_title_line_animated_animation_color',
            [
                'label' => __( 'Moving Bar Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .divider::after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_control(
            'ct_pricing_title_line_width',
            [
                'label' => __( 'Line Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'max' => 1170,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-line-divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'separator',
                ],
            ]
        );

        $this->add_control(
            'ct_pricing_title_line_height',
            [
                'label' => __( 'Separator Height', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-line-divider' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'separator',
                ],
            ]
        );

         $this->add_control(
            'ct_fancy_title_line_bg_color',
            [
                'label' => __( 'Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .ct-line-divider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'separator',
                ],
                'default' => '#6ec1e4',
            ]
        );

        /*--------*/

        $this->add_control(
            'ct_fancy_title_animated_separator_position',
            [
                'label' => __( 'Separator Position', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top'               => __( 'Top', 'elegant-addons-for-elementor' ),
                    'between_headline'  => 'Between Headline And Text',
                    'bottom'            => 'Bottom',
                ],
                'separator' => 'none',
                'default'   =>  'bottom',
                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_control(
            'ct_pricing_title_animated_line_width',
            [
                'label' => __( 'Line Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'max' => 1170,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_divider_animation_width',
            [
                'label' => __( 'Animated Bar Width', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-divider::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_control(
            'ct_pricing_title_animated_line_height',
            [
                'label' => __( 'Separator Height', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider, {{WRAPPER}} .divider::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_control(
            'ct_fancy_title_animated_speed',
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
                    'unit' => 'ms',
                    'size' => 3000,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider::after' => 'animation-duration: {{SIZE}}{{UNIT}};',
                ],

                'condition' => [
                   'ct_fancy_title_separator' => 'animated',
                ],
            ]
        );

        $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name'              => 'ct_fancy_title_animated_line_bg_color',
            'types'             => [ 'classic', 'gradient' ],
            'exclude'           => [ 'image' ],
            'selector'          => '{{WRAPPER}} .divider',
            'condition' => [
               'ct_fancy_title_separator' => 'separator',
            ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_fancy_title_section_title_style',
            [
                'label' => __( 'Title', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        if ( ELEGANT_ADDONS_PRO == 'pro' && function_exists( 'eae_fancy_title_gradient_options' ) ) {
            eae_fancy_title_gradient_options( $this );
        }

        $this->add_control(
            'ct_fancy_title_title_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .ct-title, {{WRAPPER}} .ct-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_fancy_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ct-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ct_fancy_title_text_shadow',
                'selector' => '{{WRAPPER}} .ct-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_fancy_secondary_title_style',
            [
                'label' => __( 'Sub Title', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_fancy_secondary_title_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .ct-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_fancy_secondary_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ct-sub-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ct_fancy_secondary_text_shadow',
                'selector' => '{{WRAPPER}} .ct-sub-title',
            ]
        );

        $this->end_controls_section();

         $this->start_controls_section(
            'ct_fancy_secondary_description_style',
            [
                'label' => __( 'Description', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_fancy_secondary_description_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .ct-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_fancy_description_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ct-desc',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ct_fancy_description_text_shadow',
                'selector' => '{{WRAPPER}} .ct-desc',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_fancy_title_design',
            [
                'label' => __( 'Margins', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_fancy_title_margin',
            [
                'label' => __( 'Title Margin', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ct_fancy_secondary_title_margin',
            [
                'label' => __( 'Sub Title Margin', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ct_fancy_title_separator_margin',
            [
                'label' => __( 'Separator Margin', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-divider, {{WRAPPER}} .ct-line-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        $id         = $this->get_id();
        $align      = $settings['ct_fancy_title_align'];

        $target     = $settings['ct_fancy_title_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow   = $settings['ct_fancy_title_link']['nofollow'] ? ' rel="nofollow"' : '';

        $title_link = '';
        $title_end  = '';

        if ( $settings['ct_fancy_title_link']['url'] ) {
            $title_link = '<a href="' . $settings['ct_fancy_title_link']['url'] . '"' . $target . $nofollow . '>';
            $title_end  = '</a>';
        }

        if ( $align == '' ) {
            $align = 'left';
        }
        ?>
        <div class="title-area">

            <?php if ( $settings['ct_fancy_secondary_title'] ) : ?>
                <?php if ( $settings['ct_fancy_title_main'] || $settings['ct_fancy_item_description'] ) : ?>
                <div class="ct-sub-title-content">
                    <div class="ct-sub-title-center ct-sub-title" style="text-align: <?php echo esc_attr( $align ); ?>"><?php echo esc_html( $settings['ct_fancy_secondary_title'] ); ?></div>
                </div><!-- /.ct-sub-title-content -->
                <?php endif ?>
            <?php endif ?>

            <?php if ( ( $settings['ct_fancy_title_animated_separator_position'] == 'top' ) && ( $settings['ct_fancy_title_separator'] == 'animated' ) ) : ?>
                <div class="divider divider-<?php echo esc_attr( $align ); ?> ct-divider"></div><!-- /.divider-center -->
            <?php elseif ( ( $settings['ct_fancy_title_separator_position'] == 'top' ) && ( $settings['ct_fancy_title_separator'] == 'separator' ) ) : ?>
                <div class="ct-line-divider divider-<?php echo esc_attr( $align ); ?>"></div><!-- /.ct-line-divider -->
            <?php endif; ?>

            <?php if ( $settings['ct_fancy_title_main'] ) : ?>
            <?php echo '<' . esc_html( $settings['ct_fancy_title_header_tag'] ) . ' id="'.$id.'" class="ct-title" style="text-align: ' . esc_attr( $align ) . '">' . $title_link . esc_html( $settings['ct_fancy_title_main'] ) . $title_end . '</' . esc_html( $settings['ct_fancy_title_header_tag'] ) . '>'; ?>
            <?php endif ?>

            <?php if ( ( $settings['ct_fancy_title_animated_separator_position'] == 'between_headline' ) && ( $settings['ct_fancy_title_separator'] == 'animated' ) ) : ?>
                <div class="divider divider-<?php echo esc_attr( $align ); ?> ct-divider"></div><!-- /.divider-center -->
            <?php elseif ( ( $settings['ct_fancy_title_separator_position'] == 'between_headline' ) && ( $settings['ct_fancy_title_separator'] == 'separator' ) ) : ?>
                <div class="ct-line-divider divider-<?php echo esc_attr( $align ); ?>"></div><!-- /.ct-line-divider -->
            <?php endif; ?>

            <?php
                if ( $settings['ct_fancy_item_description'] ) :
                    $allowed_html = array(
                        'a' => array(
                            'href' => array(),
                            'title' => array()
                        ),
                        'br' => array(),
                        'em' => array(),
                        'strong' => array(),
                    );

                    echo '<div class="ct-desc" style="text-align: ' . esc_attr( $align ) . '">' . wp_kses( $settings['ct_fancy_item_description'], $allowed_html ) . '</div>';

                endif;
            ?>

            <?php if ( ( $settings['ct_fancy_title_animated_separator_position'] == 'bottom' ) && ( $settings['ct_fancy_title_separator'] == 'animated' ) ) : ?>
                <div class="divider divider-<?php echo esc_attr( $align ); ?> ct-divider"></div><!-- /.divider-center -->
            <?php elseif ( ( $settings['ct_fancy_title_separator_position'] == 'bottom' ) && ( $settings['ct_fancy_title_separator'] == 'separator' ) ) : ?>
                <div class="ct-line-divider divider-<?php echo esc_attr( $align ); ?>"></div><!-- /.ct-line-divider -->
            <?php endif; ?>
        </div><!-- /.title-area-center -->
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
            var align = settings.ct_fancy_title_align;

            if ( align == '' ) {
                var align = 'left';
            }

            var target     = settings.ct_fancy_title_link.is_external ? ' target="_blank"' : '';
            var nofollow   = settings.ct_fancy_title_link.nofollow ? ' rel="nofollow"' : '';

            var title_link = '';
            var title_end  = '';

            if ( settings.ct_fancy_title_link.url ) {
                var title_link = '<a href="' + settings.ct_fancy_title_link.url + '"' + target + nofollow + '>';
                var title_end  = '</a>';
            }
        #>
        <div class="title-area">
            <#
                if( settings.ct_fancy_secondary_title != '' ) {
                    if( ( settings.ct_fancy_title_main != '' ) || ( settings.ct_fancy_item_description != '' ) ) {
            #>
            <div class="ct-sub-title-content">
                <div class="ct-sub-title-center ct-sub-title" style="text-align: {{align}}">{{settings.ct_fancy_secondary_title}}</div>
            </div>
            <#
                    }
                }
            #>

            <# if( ( settings.ct_fancy_title_animated_separator_position == 'top' ) && ( settings.ct_fancy_title_separator == 'animated' ) ) { #>
                <div class="divider divider-animate divider-{{align}} ct-divider"></div><!-- /.divider-center -->
            <# } else if( ( settings.ct_fancy_title_separator_position == 'top' ) && ( settings.ct_fancy_title_separator == 'separator' ) ) { #>
                <div class="ct-line-divider divider-{{align}}"></div><!-- /.ct-line-divider -->
            <# } #>

            <# if( settings.ct_fancy_title_main != '' ) { #>
            <{{settings.ct_fancy_title_header_tag}} class="ct-title" style="text-align: {{align}}">{{{title_link}}}{{settings.ct_fancy_title_main}}{{{title_end}}}</{{settings.ct_fancy_title_header_tag}}>
            <# } #>

            <# if( ( settings.ct_fancy_title_animated_separator_position == 'between_headline' ) && ( settings.ct_fancy_title_separator == 'animated' ) ) { #>
                <div class="divider divider-animate divider-{{align}} ct-divider"></div><!-- /.divider-center -->
            <# } else if( ( settings.ct_fancy_title_separator_position == 'between_headline' ) && ( settings.ct_fancy_title_separator == 'separator' ) ) { #>
                <div class="ct-line-divider divider-{{align}}"></div><!-- /.ct-line-divider -->
            <# } #>

            <# if( settings.ct_fancy_item_description != '' ) { #>
                <div class="ct-desc" style="text-align: {{align}}">{{{settings.ct_fancy_item_description}}}</div>
            <# } #>

            <# if( ( settings.ct_fancy_title_animated_separator_position == 'bottom' ) && ( settings.ct_fancy_title_separator == 'animated' ) ) { #>
                <div class="divider divider-animate divider-{{align}} ct-divider"></div><!-- /.divider-center -->
            <# } else if( ( settings.ct_fancy_title_separator_position == 'bottom' ) && ( settings.ct_fancy_title_separator == 'separator' ) ) { #>
                <div class="ct-line-divider divider-{{align}}"></div><!-- /.ct-line-divider -->
            <# } #>
        </div><!-- /.title-area-center -->
        <?php
    }
}
