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
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Lightbox extends Widget_Base {

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
        return 'eae_lightbox';
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
        return __( 'EAE Lightbox', 'elegant-addons-for-elementor' );
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
        return [ 'eae-scripts' ];
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

        if ( ELEGANT_ADDONS_PRO == 'pro' ) {
            $eae_lb_toggler = eae_lightbox_options_pro();
            $eae_lb_content = eae_lightbox_content_pro();
        } else {
            $eae_lb_toggler = eae_lightbox_options_free();
            $eae_lb_content = eae_lightbox_content_free();
        }

        $this->start_controls_section(
            'ct_lightbox_section_content_toggler',
            [
                'label' => __( 'Toggler', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_lightbox_toggler',
            [
                'label'       => esc_html__( 'Select Lightbox Toggler', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'poster',
                'label_block' => true,
                'options'     => $eae_lb_toggler,
            ]
        );

        $this->add_control(
            'ct_lightbox_poster_image',
            [
                'label'   => __( 'Poster Image', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ct_lightbox_toggler' => 'poster',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_responsive_control(
            'ct_lightbox_poster_height',
            [
                'label'   => __( 'Poster Height', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 400,
                ],
                'range' => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 1200,
                        'step' => 5,
                    ]
                ],
                'condition' => [
                    'ct_lightbox_toggler' => 'poster',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-lightbox img' => 'min-height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'ct_lightbox_toggler_icon',
            [
                'label'     => __( 'Icon', 'elegant-addons-for-elementor' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'toggler_icon',
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'ct_lightbox_toggler' => 'icon',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_lightbox_section_content_layout',
            [
                'label' => __( 'Lightbox Content', 'elegant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'ct_lightbox_content',
            [
                'label'       => esc_html__( 'Select Lightbox Content', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'image',
                'label_block' => true,
                'options'     => $eae_lb_content,
            ]
        );

        $this->add_control(
            'ct_lightbox_content_image_src',
            [
                'label'   => __( 'Image Source', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ct_lightbox_content' => 'image',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_lightbox_content_video_src',
            [
                'label'         => __( 'Video Source', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false,
                'default'       => [
                    'url' => __( 'https://quirksmode.org/html5/videos/big_buck_bunny.mp4', 'elegant-addons-for-elementor' ),
                ],
                'placeholder'   => __( 'https://quirksmode.org/html5/videos/big_buck_bunny.mp4', 'elegant-addons-for-elementor' ),
                'label_block'   => true,
                'condition'     => [
                    'ct_lightbox_content' => 'video',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_lightbox_content_youtube',
            [
                'label'         => __( 'YouTube Source', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false,
                'default'       => [
                    'url' => __( 'https://www.youtube.com/watch?v=YE7VzlLtp-4', 'elegant-addons-for-elementor' ),
                ],
                'placeholder'   => __( 'https://www.youtube.com/watch?v=YE7VzlLtp-4', 'elegant-addons-for-elementor' ),
                'label_block'   => true,
                'condition'     => [
                    'ct_lightbox_content' => 'youtube',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_lightbox_content_vimeo',
            [
                'label'         => __( 'Vimeo Source', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false,
                'default'       => [
                    'url' => __( 'https://vimeo.com/1084537', 'elegant-addons-for-elementor' ),
                ],
                'placeholder'   => __( 'https://vimeo.com/1084537', 'elegant-addons-for-elementor' ),
                'label_block'   => true,
                'condition'     => [
                    'ct_lightbox_content' => 'vimeo',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_lightbox_content_google_map',
            [
                'label'         => __( 'Goggle Map Embed URL', 'elegant-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false,
                'default'       => [
                    'url' => __( 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4740.819266853735!2d9.99008871708242!3d53.550454675412404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3f9d24afe84a0263!2sRathaus!5e0!3m2!1sde!2sde!4v1499675200938', 'elegant-addons-for-elementor' ),
                ],
                'placeholder'   => __( 'https://www.google.com/maps/embed?pb', 'elegant-addons-for-elementor' ),
                'label_block'   => true,
                'condition'     => [
                    'ct_lightbox_content' => 'google-map',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ct_lightbox_content_caption',
            [
                'label'   => __( 'Content Caption', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => 'This is a image',
            ]
        );

        $this->end_controls_section();

        ct_button_control_content( $this, 'ct_lightbox_toggler', 'button' );
        ct_button_control_style( $this, 'ct_lightbox_toggler', 'button' );

        eae_pro_notice( $this );

        $this->start_controls_section(
            'ct_lightbox_section_style_lightbox',
            [
                'label' => esc_html__( 'Lightbox', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_lightbox_lightbox_animation',
            [
                'label'   => esc_html__( 'Lightbox Animation', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'lightbox-scale',
                'options' => [
                    'lightbox-slide' => esc_html__( 'Slide', 'elegant-addons-for-elementor' ),
                    'lightbox-fade'  => esc_html__( 'Fade', 'elegant-addons-for-elementor' ),
                    'lightbox-scale' => esc_html__( 'Scale', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'ct_lightbox_content' => 'image',
                ],
            ]
        );

        $this->add_control(
            'ct_lightbox_video_autoplay',
            [
                'label'   => esc_html__( 'Video Autoplay', 'elegant-addons-for-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_lightbox_icon_style',
            [
                'label' => esc_html__( 'Style', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'ct_lightbox_toggler' => 'icon',
                ],
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => __( 'Normal', 'elegant-addons-for-elementor' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ct_lightbox_icon_background',
                'label' => __( 'Background', 'elegant-addons-for-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .ct-button-icon',
            ]
        );

        $this->add_control(
            'ct_lightbox_icon_color',
            [
                'label' => __( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' =>Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_lightbox_icon_size',
            [
                'label' => __( 'Icon Size', 'elegant-addons-for-elementor' ),
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
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ct_lightbox_icon_box_shadow',
                'label' => __( 'Box Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ct-button-icon',
            ]
        );

        $this->add_responsive_control(
            'ct_lightbox_icon_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_lightbox_icon_border',
            [
                'label' => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ct_lightbox_icon_background_hover',
                'label' => __( 'Background', 'elegant-addons-for-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .ct-button-icon:hover',
            ]
        );

        $this->add_control(
            'ct_lightbox_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' =>Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ct_lightbox_icon_size_hover',
            [
                'label' => __( 'Icon Size', 'elegant-addons-for-elementor' ),
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
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon:hover' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ct_lightbox_icon_box_shadow_hover',
                'label' => __( 'Box Shadow', 'elegant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ct-button-icon:hover',
            ]
        );

        $this->add_responsive_control(
            'ct_lightbox_icon_padding_hover',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_lightbox_icon_border_hover',
            [
                'label' => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

         $this->end_controls_tab();


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

        $ct_toggler             = $settings['ct_lightbox_toggler'];
        $ct_lightbox_content    = $settings['ct_lightbox_content'];

        if( $ct_toggler == 'poster' ) {
            $toggler_return = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size', 'ct_lightbox_poster_image' );
        } elseif( $ct_toggler == 'button' ) {
            $toggler_return = ct_button_render( $this );
        } elseif( $ct_toggler == 'icon' ) {
            $toggler_return = '<i class="ct-button-icon ' . $settings['ct_lightbox_toggler_icon']['value'] . '"></i>';
        }

        if( $ct_lightbox_content == 'image' ) {
            $ct_lightbox_val = $settings['ct_lightbox_content_image_src']['url'];
        } elseif( $ct_lightbox_content == 'video' ) {
            $ct_lightbox_val = $settings[ 'ct_lightbox_content_video_src' ]['url'];
        } elseif( $ct_lightbox_content == 'youtube' ) {
            $ct_lightbox_val = $settings['ct_lightbox_content_youtube']['url'];
        } elseif( $ct_lightbox_content == 'vimeo' ) {
            $ct_lightbox_val = $settings['ct_lightbox_content_vimeo']['url'];
        }
        ?>
            <div id="lightbox-overlay" class="lightbox-overlay">
                <a class="lightbox-overlay-close">&times;</a>
            </div><!-- /#lightbox-overlay -->

            <div class="ct-lightbox" data-animation="<?php echo esc_attr( $settings[ 'ct_lightbox_lightbox_animation' ] ); ?>" data-popup-url="<?php echo esc_attr( $ct_lightbox_val ); ?>" data-popup-type="<?php echo esc_attr( $ct_lightbox_content ); ?>" data-autoplay="<?php echo esc_attr( $settings[ 'ct_lightbox_video_autoplay' ] ); ?>">
                <?php echo $toggler_return; ?>
            </div><!-- /.ct-lightbox -->
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
            var ct_toggler             = settings.ct_lightbox_toggler;
            var ct_lightbox_content    = settings.ct_lightbox_content;

            if( ct_toggler == 'poster' ) {
                var toggler_return = '<img src="' + settings.ct_lightbox_poster_image.url + '" />';
            } else if( ct_toggler == 'button' ) {
                var toggler_return = 'button';
            } else if( ct_toggler == 'icon' ) {
                var toggler_return = '<i class="ct-button-icon ' + settings.ct_lightbox_toggler_icon.value + '"></i>';
            }

            if( ct_lightbox_content == 'image' ) {
                var ct_lightbox_val = settings.ct_lightbox_content_image_src.url;
            } else if( ct_lightbox_content == 'video' ) {
                var ct_lightbox_val = 'video';
            } else if( ct_lightbox_content == 'youtube' ) {
                var ct_lightbox_val = settings.ct_lightbox_content_youtube.url;
            } else if( ct_lightbox_content == 'vimeo' ) {
                var ct_lightbox_val = settings.ct_lightbox_content_vimeo.url;
            }
        #>
            <div id="lightbox-overlay" class="lightbox-overlay">
                <a class="lightbox-overlay-close">&times;</a>
            </div><!-- /#lightbox-overlay -->

            <div class="ct-lightbox" data-animation="{{ settings.ct_lightbox_lightbox_animation }}" data-autoplay="{{settings.ct_lightbox_video_autoplay}}" data-popup-url="{{ct_lightbox_val}}" data-popup-type="{{ct_lightbox_content}}">
                <# if( ct_toggler == 'button' ) { #>
                    <?php ct_button_template(); ?>
                <# } else { #>
                    {{{toggler_return}}}
                <# } #>
            </div><!-- /.ct-lightbox -->
        <?php
    }

}
