<?php
//Transition
function et_elementor_transition_options() {
    $transition_options = [
        ''                    => esc_html__('None', 'elegant-addons-for-elementor'),
        'fade'                => esc_html__('Fade', 'elegant-addons-for-elementor'),
        'scale-up'            => esc_html__('Scale Up', 'elegant-addons-for-elementor'),
        'scale-down'          => esc_html__('Scale Down', 'elegant-addons-for-elementor'),
        'slide-top'           => esc_html__('Slide Top', 'elegant-addons-for-elementor'),
        'slide-bottom'        => esc_html__('Slide Bottom', 'elegant-addons-for-elementor'),
        'slide-left'          => esc_html__('Slide Left', 'elegant-addons-for-elementor'),
        'slide-right'         => esc_html__('Slide Right', 'elegant-addons-for-elementor'),
        'slide-top-small'     => esc_html__('Slide Top Small', 'elegant-addons-for-elementor'),
        'slide-bottom-small'  => esc_html__('Slide Bottom Small', 'elegant-addons-for-elementor'),
        'slide-left-small'    => esc_html__('Slide Left Small', 'elegant-addons-for-elementor'),
        'slide-right-small'   => esc_html__('Slide Right Small', 'elegant-addons-for-elementor'),
        'slide-top-medium'    => esc_html__('Slide Top Medium', 'elegant-addons-for-elementor'),
        'slide-bottom-medium' => esc_html__('Slide Bottom Medium', 'elegant-addons-for-elementor'),
        'slide-left-medium'   => esc_html__('Slide Left Medium', 'elegant-addons-for-elementor'),
        'slide-right-medium'  => esc_html__('Slide Right Medium', 'elegant-addons-for-elementor'),
    ];

    return $transition_options;
}

// heading Tag
function et_elementor_title_tags() {
    $title_tags = [
        'h1' => esc_html__( 'H1', 'elegant-addons-for-elementor' ),
        'h2' => esc_html__( 'H2', 'elegant-addons-for-elementor' ),
        'h3' => esc_html__( 'H3', 'elegant-addons-for-elementor' ),
        'h4' => esc_html__( 'H4', 'elegant-addons-for-elementor' ),
        'h5' => esc_html__( 'H5', 'elegant-addons-for-elementor' ),
        'h6' => esc_html__( 'H6', 'elegant-addons-for-elementor' ),
        'div'  => esc_html__( 'div', 'elegant-addons-for-elementor' ),
        'span' => esc_html__( 'span', 'elegant-addons-for-elementor' ),
        'p'    => esc_html__( 'p', 'elegant-addons-for-elementor' ),
    ];

    return $title_tags;
}

// Position
function et_elementor_position() {
    $position_options = [
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
    ];

    return $position_options;
}

function ct_post_type_categories() {
    $terms = get_terms(
        array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        )
    );

    $options = array();

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->term_id ] = $term->name;
        }
    }

    return $options;
}

function ct_post_type_tags() {
    $tags = get_tags();

    $options = array();

    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){
        foreach ( $tags as $tag ) {
            $options[ $tag->term_id ] = $tag->name;
        }
    }

    return $options;
}

if ( ! function_exists( 'ct_list_category_names' ) ) :

function ct_list_category_names() {
    foreach( ( get_the_category() ) as $category ) {
        return $category->cat_name;
    }
}

endif;


function eae_pro_notice( $perm ) {
    if ( ELEGANT_ADDONS_PRO == 'free' ) {
            $perm->start_controls_section(
                'eae_section_pro',
                [
                    'label' => __('Upgrade Premium for More Features', 'elegant-addons-elementor'),
                ]
            );

            $perm->add_control(
                'eae_control_get_pro',
                [
                    'label' => __('Unlock more possibilities', 'elegant-addons-elementor'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        '1' => [
                            'title' => __('', 'elegant-addons-elementor'),
                            'icon' => 'fa fa-unlock-alt',
                        ],
                    ],
                    'default' => '1',
                    'description' => '<span class="eae-pro-feature"> Upgrade to  <a href="https://www.elegantaddons.com/upgrade-elegant-addons-elementor" target="_blank">Premium version</a> for more elegant addons and customization options.</span>',
                ]
            );

            $perm->end_controls_section();
        }
}

/**
 * Get Contact Form 7 [ if exists ]
 */
if ( function_exists( 'wpcf7' ) ) {
    function get_contact_form_7_forms(){
        $wpcf7_form_list = get_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'showposts' => 999,
        ));
        $posts = array();

        if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ){
            foreach ( $wpcf7_form_list as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
            return $options;
        }
    }
}

// Elementor Saved Template
function eae_switcher_options() {

    $items = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
        if ( ! empty( $items ) ) {
            $items = wp_list_filter( $items, ['type' => 'section'] );
            $items = wp_list_pluck( $items, 'title', 'template_id' );
            return $items;
        }
    return [];
}

