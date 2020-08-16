<?php

// Animated Headline Options
function eae_animated_headline_options() {
    $options = [
                    'slide'         => __( 'Slide', 'elegant-addons-for-elementor' ),
                    'zoom'          => __( 'Zoom', 'elegant-addons-for-elementor' ),
                    'type'          => __( 'Typing ', 'elegant-addons-for-elementor' ),
                    'a'             => __( 'Rotate' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'b'             => __( 'Rotate 2' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'c'             => __( 'Rotate 3' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'd'             => __( 'Loading Bar' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'e'             => __( 'Push' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'f'             => __( 'Scale' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'g'             => __( 'Clip' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                ];

    return $options;
}

// Button Options
function eae_button_options() {
    $options = [
                'normal'                => __( 'Normal', 'elegant-addons-for-elementor' ),
                'slide-right'           => __( 'Slide Right', 'elegant-addons-for-elementor' ),
                'slide-from-center'     => __( 'Slide From Center', 'elegant-addons-for-elementor' ),
                'a'                     => __( 'Slide Underline' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                'b'                     => __( 'Slide Circle' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                'c'                     => __( 'Slide Square' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
            ];

    return $options;
}

// Lightbox Options
function eae_lightbox_options_free() {
    $options = [
                    'poster' => esc_html__( 'Poster', 'elegant-addons-for-elementor' ),
                    'button' => esc_html__( 'Button', 'elegant-addons-for-elementor' ),
                    'a'     => esc_html__( 'Icon' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
            ];

    return $options;
}

// Lightbox Content Options
function eae_lightbox_content_free() {
    $options = [
                    'image'      => esc_html__( 'Image', 'elegant-addons-for-elementor' ),
                    'youtube'    => esc_html__( 'Youtube', 'elegant-addons-for-elementor' ),
                    'a'      => esc_html__( 'Video' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'b'      => esc_html__( 'Vimeo' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
            ];

    return $options;
}

// Testimonial Content Options
function eae_testimonial_content_free() {
    $options = [
                    'image_stacked' => __( 'Image Stacked', 'elegant-addons-for-elementor' ),
                    'a'             => __( 'Image Inline' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'b'             => __( 'Image Above' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'c'             => __( 'Image Left' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
                    'd'             => __( 'Image Right' . ELEGANT_ADDONS_PRO_TEXT, 'elegant-addons-for-elementor' ),
            ];

    return $options;
}
