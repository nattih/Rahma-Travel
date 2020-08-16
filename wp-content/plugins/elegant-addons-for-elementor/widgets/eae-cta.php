<?php
namespace ElegantAddons\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Eae_Cta extends Widget_Base {

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
        return 'eae-cta';
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
        return __( 'EAE Call to Action', 'elegant-addons-for-elementor' );
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
        return 'eicon-call-to-action';
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
            'ct_elementor_description',
            [
                'label'       => esc_html__( 'Description', 'elegant-addons-for-elementor' ),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => [ 'active' => true ],
                'default'     => esc_html__( 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.', 'elegant-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Call to action description', 'elegant-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ct_cta_text_align',
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
                'default' => 'center',
                'toggle' => true,
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ct-cta.text-align,{{WRAPPER}} .ct-cta-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

         $this->start_controls_section(
            'ct_cta_content_style',
            [
                'label' => esc_html__( 'Style', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ct_cta_content_design',
            [
                'label' => __( 'Content Style', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'basic' => __( 'Basic', 'elegant-addons-for-elementor' ),
                    'grid' => __( 'Grid', 'elegant-addons-for-elementor' ),
                    'classic' => __( 'Classic', 'elegant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_cta_grid_content_width',
            [
                'label' => __( 'Content Width', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],

                ],
                'default' => [
                    'size' => 85,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-cta .ct-cta-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ct_cta_content_design' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'ct_cta_grid_gap',
            [
                'label' => __( 'Gap', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],

                ],
                'default' => [
                    'size' => 10,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-cta .ct-cta-content' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ct_cta_content_design' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'ct_cta_classic_position',
            [
                'label' => __( 'Alignment', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __( 'Top', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'ct_cta_content_design' => 'classic',
                ],
                'default' => 'top',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'ct_cta_classic_content_position',
            [
                'label' => __( 'Vertical Align', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'elegant-addons-for-elementor' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-cta-container' => 'vertical-align: {{VALUE}}',
                ],
                'condition' => [
                    'ct_cta_content_design' => 'classic',
                ],
                'default' => 'top',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'ct_cta_classic_image',
            [
                'label' => __( 'Choose Image', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ct_cta_content_design' => 'classic',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ct_cta_classic_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.

                'include' => [],
                'default' => 'large',
                'condition' => [
                    'ct_cta_content_design' => 'classic',
                    'ct_cta_classic_image[id]!' => '',
                ],
            ]
        );
        $this->add_control(
            'ct_cta_background_size',
            [
                'label' => __( 'Size', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => __( 'Cover', 'elegant-addons-for-elementor' ),
                    'contain' => __( 'Contain', 'elegant-addons-for-elementor' ),
                    'auto' => __( 'Auto', 'elegant-addons-for-elementor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-cta-background' => 'background-size: {{VALUE}}',
                ],
                'condition' => [
                    'ct_cta_content_design' => 'classic',
                ],
            ]
        );
        $this->add_control(
            'ct_cta_zoom_direction',
            [
                'label' => __( 'Ken Burns Effect', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'in',
                'options' => [
                    'none' => __( 'None', 'elegant-addons-for-elementor' ),
                    'in' => __( 'Zoom In', 'elegant-addons-for-elementor' ),
                    'out' => __( 'Zoom Out', 'elegant-addons-for-elementor' ),
                ],
                'condition' => [
                    'ct_cta_content_design' => 'classic',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ct_elementor_section_style_text',
            [
                'label' => esc_html__( 'Text', 'elegant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ct_elementor_content_align',
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
                'selectors' => [
                    '{{WRAPPER}} .ct-cta-section .ct-cta-description' => 'text-align: {{VALUE}};',
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'prefix_class' => 'content-align-%s',
            ]
        );

        $this->add_control(
            'ct_elementor_description_color',
            [
                'label'     => esc_html__( 'Description Color', 'elegant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-cta-section .ct-cta-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ct_elementor_description!' => '',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ct_elementor_description_typography',
                'selector'  => '{{WRAPPER}} .ct-cta-section .ct-cta-description',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
                'condition' => [
                    'ct_elementor_description!' => '',
                ],
            ]
        );

        $this->add_control(
            'ct_cta_contant_padding',
            [
                'label' => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ct-cta-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'   => [
                    'unit'  =>'px',
                    'top'   => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left'  => '20',
                ]
            ]
        );

        $this->end_controls_section();

        ct_button_control_content( $this );
        ct_button_control_style( $this );

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

        $content_design = '';
        if ( $settings['ct_cta_content_design'] == 'basic') {
            $content_design = 'ct-cta-text-align';
        } else if ( $settings['ct_cta_content_design'] == 'grid' ) {
            $content_design = 'ct-cta-grid';
        } else if ( $settings['ct_cta_content_design'] == 'classic' ) {
            $content_design = 'ct-cta-classic';
        }

        $bg_image = '';
        if ( ! empty( $settings['ct_cta_classic_image']['id'] ) ) {
            $bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['ct_cta_classic_image']['id'], 'ct_cta_classic_image_size', $settings );
        } elseif ( ! empty( $settings['ct_cta_classic_image']['url'] ) ) {
            $bg_image = $settings['ct_cta_classic_image']['url'];
        }
    ?>
       <div class="ct-cta-section">
            <div class="ct-cta <?php echo $content_design . ' ct-cta-alignment-' . esc_attr( $settings['ct_cta_classic_position'] ); ?>">
                <?php if ( $settings['ct_cta_content_design'] == 'classic' ) { ?>
                    <div class="ct-cta-background-container">
                        <div class="ct-cta-background ct-ken-burn-hover-zoom-<?php echo esc_attr( $settings['ct_cta_zoom_direction'] ); ?>" style="background-image: url( <?php echo esc_url( $bg_image ); ?>);"></div><!-- /.ct-cta-background -->
                    </div><!-- /.ct-cta-background-container -->
                <?php } ?>
                <div class="ct-cta-container">
                    <div class="ct-cta-content">
                        <?php if ( $settings[ 'ct_elementor_description' ] ) : ?>
                            <div class="ct-cta-description">
                                <?php echo wp_kses_post( $settings[ 'ct_elementor_description' ] ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php ct_button_render( $this ); ?>
                </div><!-- /.ct-cta-container -->
            </div>
        </div>
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
        var content_design = '';
        if ( settings.ct_cta_content_design == 'basic' ) {
            content_design = 'ct-cta-text-align';
        } else if ( settings.ct_cta_content_design == 'grid' ) {
            content_design = 'ct-cta-grid';
        } else if ( settings.ct_cta_content_design == 'classic' ) {
            content_design = 'ct-cta-classic';
        }

        var image = {
            id: settings.ct_cta_classic_image.id,
            url: settings.ct_cta_classic_image.url,
            size: settings.ct_cta_classic_image_size_size,
            dimension: settings.ct_cta_classic_image_custom_dimension,
            model: view.getEditModel()
        };
        var image_url = elementor.imagesManager.getImageUrl( image );

    #>
        <div class="ct-cta-section">
            <div class="ct-cta {{ content_design }} ct-cta-alignment-{{ settings.ct_cta_classic_position }}">
                <# if ( settings.ct_cta_content_design == 'classic' ) { #>
                    <div class="ct-cta-background-container">
                        <div class="ct-cta-background ct-ken-burn-hover-zoom-{{settings.ct_cta_zoom_direction}}" style="background-image: url( {{ image_url }} );"></div><!-- /.ct-cta-background -->
                    </div><!-- /.ct-cta-background-container -->
                <# } #>
                <div class="ct-cta-container">
                    <div class="ct-cta-content">
                        <# if ( settings.ct_elementor_description != '') { #>
                            <div class="ct-cta-description">{{{ settings.ct_elementor_description }}}</div>
                        <# } #>
                    </div>
                    <?php ct_button_template(); ?>
                </div><!-- /.ct-cta-container -->
            </div>
        </div>

        <?php
    }

}
