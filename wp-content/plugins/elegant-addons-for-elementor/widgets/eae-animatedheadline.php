<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Animatedheadline extends Widget_Base {

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
        return 'eae_animated_headline';
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
        return __( 'EAE Animated Headline', 'elegant-addons-for-elementor' );
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
        return 'eicon-animation-text';
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
        return [ 'eae-animated-headline', 'eae-animated-js' ];
    }

    public function get_style_depends() {
        return [
            'elegant-addons-css', 'animate-headline-css'
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
            'ct_slider_text_elements',
            [
                'label' => __( 'Headline', 'elegant-addons-for-elementor' ),
            ]
        );

        if ( ELEGANT_ADDONS_PRO == 'pro' ) {
            $headline_style = eae_animated_headline_pro_options();
        } else {
            $headline_style = eae_animated_headline_options();
        }

        $this->add_control(
            'ct_slider_headline_style',
            [
                'label' => __( 'Style', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'type',
                'options' => $headline_style,
                'prefix_class' => 'elementor-headline--style-',
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_slider_before_text',
            [
                'label' => __( 'Before Text', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'This page is', 'elegant-addons-for-elementor' ),
                'placeholder' => __( 'Enter your headline', 'elegant-addons-for-elementor' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ct_slider_highlighted_text',
            [
                'label' => __( 'Highlighted Text', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Amazing', 'elegant-addons-for-elementor' ),
                'label_block' => true,
                // 'condition' => [
                //     'headline_style' => 'highlight',
                // ],
                'separator' => 'none',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_slider_rotating_text',
            [
                'label' => __( 'Animated Text', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter each word in a separate line', 'elegant-addons-for-elementor' ),
                'separator' => 'none',
                'default' => "Better\nBigger\nFaster",
                'rows' => 5,
                // 'condition' => [
                //     'headline_style' => 'rotate',
                // ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'ct_slider_after_text',
            [
                'label' => __( 'After Text', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your headline', 'elegant-addons-for-elementor' ),
                'label_block' => true,
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'ct_slider_link',
            [
                'label' => __( 'Link', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ct_slider_alignment',
            [
                'label' => __( 'Alignment', 'elegant-addons-for-elementor' ),
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
                    '{{WRAPPER}} .ct-animate-header' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_tag',
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
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        eae_pro_notice( $this );

        $this->start_controls_section(
            'ct_slider_section_style_animation',
            [
                'label'     => esc_html__( 'Animation Settings', 'elegant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'heading_animation!' => '',
                // ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_animation_delay',
            [
                'label'     => esc_html__( 'Animation Delay', 'elegant-addons-for-elementor' ) . ' (ms)',
                'type'      => Controls_Manager::NUMBER,
                'default'   => 2500,
                'min'       => 1000,
                'max'       => 20000,
                'step'      => 100,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'rotate-1',
                        ],
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'push',
                        ],
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'scale',
                        ],
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'slide',
                        ],
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'zoom',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_animation_duration_bar',
            [
                'label'     => esc_html__( 'Animation Duration', 'elegant-addons-for-elementor' ) . ' (ms)',
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6000,
                'min'       => 1000,
                'max'       => 50000,
                'step'      => 100,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'loading-bar',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_animation_bar_waiting',
            [
                'label'     => esc_html__( 'Animation Bar Waiting', 'elegant-addons-for-elementor' ) . ' (ms)',
                'type'      => Controls_Manager::NUMBER,
                'default'   => 800,
                'min'       => 1,
                'max'       => 50000,
                'step'      => 10,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'loading-bar',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_animation_clip_duration',
            [
                'label'     => esc_html__( 'Animation Duration', 'elegant-addons-for-elementor' ) . ' (ms)',
                'type'      => Controls_Manager::NUMBER,
                'default'   => 600,
                'min'       => 1,
                'max'       => 50000,
                'step'      => 10,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'clip',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_heading_animation_clip_delay',
            [
                'label'     => esc_html__( 'Animation Delay', 'elegant-addons-for-elementor' ) . ' (ms)',
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1500,
                'min'       => 1,
                'max'       => 50000,
                'step'      => 10,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'ct_slider_headline_style',
                            'operator' => '=', // accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'clip',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'ct_slider_letters_delay',
            [
                'label'     => esc_html__( 'Type Letters Delay', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 60,
                'min'       => 10,
                'max'       => 10000,
                'step'      => 5,
                'condition' => [
                    'ct_slider_headline_style' => 'type',
                ],
            ]
        );

        $this->add_control(
            'ct_slider_start_delay',
            [
                'label'     => esc_html__( 'Animation Start Delay', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1300,
                'min'       => 500,
                'max'       => 10000,
                'step'      => 1,
                'condition' => [
                    'ct_slider_headline_style' => 'type',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_slider_section_style_text',
            [
                'label' => __( 'Headline', 'elegant-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_slider_title_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ah-headline .ct-before-text ' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_slider_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ah-headline .ct-before-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ct_slider_title_shadow',
                'label' => __( 'Text Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ah-headline .ct-before-text',
            ]
        );

        $this->add_control(
            'ct_slider_heading_words_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Animated Text', 'elegant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ct_slider_words_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ah-words-wrapper' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ct_slider_loading_bar_color',
            [
                'label' => __( 'Loading Bar Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ah-headline.loading-bar .ah-words-wrapper::after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'ct_slider_headline_style' => 'loading-bar',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_slider_words_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ah-words-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ct_slider_words_shadow',
                'label' => __( 'Text Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ah-words-wrapper',
            ]
        );

        //

        $this->add_control(
            'ct_slider_after_text_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'After Text', 'elegant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ct_slider_after_text_color',
            [
                'label' => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-after-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ct_slider_after_text_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ct-after-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ct_slider_after_text_shadow',
                'label' => __( 'Text Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ct-after-text',
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();

        $ct_words         = $settings['ct_slider_rotating_text'];
        $ct_words_split   = explode( "\n" , $ct_words );
        $free_values      = array(
                                'a',
                                'b',
                                'c',
                                'd',
                                'e',
                                'f',
                                'g'
                            );

        if ( !in_array( $settings['ct_slider_headline_style'], $free_values ) ) {
    ?>
        <section class="intro ct-animate-header" data-animate="<?php echo esc_attr( $settings['ct_slider_headline_style'] ); ?>" data-delay="<?php echo esc_attr( $settings['ct_slider_heading_animation_delay'] ); ?>" data-typelettersdelay="<?php echo esc_attr( $settings['ct_slider_letters_delay'] ); ?>" data-barduration="<?php echo esc_attr( $settings['ct_slider_heading_animation_duration_bar'] ); ?>" data-typestartdelay="<?php echo esc_attr( $settings['ct_slider_start_delay'] ); ?>" data-barwaiting="<?php echo esc_attr( $settings['ct_slider_heading_animation_bar_waiting'] ); ?>" data-revealduration="<?php echo esc_attr( $settings['ct_slider_heading_animation_clip_duration'] ); ?>" data-revealdelay="<?php echo esc_attr( $settings['ct_slider_heading_animation_clip_delay'] ); ?>">
            <h1 class="ah-headline">
                <?php if( $settings['ct_slider_before_text'] != '' ) : ?>
                    <span class="ct-before-text"><?php echo esc_html( $settings['ct_slider_before_text'] ); ?></span>
                <?php endif; ?>
                <span class="ah-words-wrapper" data-words="<?php echo esc_attr( $settings['ct_slider_rotating_text'] ) ?>">
                    <?php
                        for ( $i = 0; $i <= count( $ct_words_split ) - 1; $i++ ) {
                            if ( $i == 0 ) {
                                echo '<b class="is-visible">' . $ct_words_split[$i] . '</b>';
                            } else {
                                echo '<b class="is-hidden">' . $ct_words_split[$i] . '</b>';
                            }
                        }
                    ?>
                </span>
                <?php if( $settings['ct_slider_after_text'] != '' ) : ?>
                    <span class="ct-after-text"><?php echo esc_html( $settings['ct_slider_after_text'] ); ?></span>
                <?php endif; ?>
            </h1>
        </section>
    <?php
        } // In array
    }

    protected function _content_template() {
        ?>
        <#
            var aWords          =   settings.ct_slider_rotating_text;
            var aWordsSplit     =   aWords.split( "\n" );

            var free_values      = [
                                        'a',
                                        'b',
                                        'c',
                                        'd',
                                        'e',
                                        'f',
                                        'g'
                                    ];

                if( !free_values.includes( settings.ct_slider_headline_style ) ) {
            #>
            <section class="intro ct-animate-header" data-animate="{{ settings.ct_slider_headline_style }}" data-delay="{{ settings.ct_slider_heading_animation_delay }}" data-typelettersdelay="{{ settings.ct_slider_letters_delay }}" data-typestartdelay="{{ settings.ct_slider_start_delay }}" data-barduration="{{ settings.ct_slider_heading_animation_duration_bar }}" data-barwaiting="{{ settings.ct_slider_heading_animation_bar_waiting }}" data-revealduration="{{ settings.ct_slider_heading_animation_clip_duration }}" data-revealdelay="{{ settings.ct_slider_heading_animation_clip_delay }}">
                <h1 class="ah-headline">
                    <# if( settings.ct_slider_before_text != '' ) { #>
                        <span class="ct-before-text">{{ settings.ct_slider_before_text }}</span>
                    <# } #>
                    <span class="ah-words-wrapper" data-words="{{ settings.ct_slider_rotating_text }}">
                        <#
                            for (var i = 0; i <= aWordsSplit.length - 1; i++) {
                                if( i == 0 ) {
                        #>
                                    <b class="is-visible">{{ aWordsSplit[i] }}</b>
                        <#
                                } else {
                        #>
                                    <b class="is-hidden">{{ aWordsSplit[i] }}</b>
                        <#
                                }
                            }
                        #>
                    </span>
                    <# if( settings.ct_slider_after_text != '' ) { #>
                        <span class="ct-after-text">{{ settings.ct_slider_after_text }}</span>
                    <# } #>
                </h1>
            </section>
            <# } #>
        <?php
    }
}
