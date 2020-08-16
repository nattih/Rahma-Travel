<?php

function ct_fancy_divider_content_controls( $perm, $condition_key = '', $condition_val = '' ) {

    $condition = ( !empty( $condition_key ) && !empty( $condition_val ) ) ? 'condition' : 'nocondition' ;

    $perm->start_controls_section(
        'ct_section_divider',
        [
            'label' => __( 'Fancy Border', 'elegant-addons-for-elementor' ),
             $condition => [
                $condition_key => $condition_val,
            ],
        ]
    );

    $perm->add_control(
        'ct_divider_style',
        [
            'label' => __( 'Style', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'none'          => __( 'None', 'elegant-addons-for-elementor' ),
                'fancy_divider' => __( 'Fancy Border', 'elegant-addons-for-elementor' ),
            ],
            'default' => 'fancy_divider',
        ]
    );

    $perm->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name'              => 'ct_divider_color',
            'types'             => [ 'classic', 'gradient' ],
            'exclude'           => [ 'image' ],
            'selector'          => '{{WRAPPER}} .content-divider',
            'condition' => [
               'ct_divider_style' => 'fancy_divider',
            ],
        ]
    );

    $perm->add_control(
        'ct_fancy_divider_animation_color',
        [
            'label' => __( 'Moving Bar Color', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#fff',
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                // Stronger selector to avoid section style from overwriting
                '{{WRAPPER}} .content-divider::after' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $perm->add_responsive_control(
        'ct_divider_animation_width',
        [
            'label' => __( 'Animated Bar Width', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
            'condition' => [
               'ct_divider_style' => 'fancy_divider',
            ],
        ]
    );

    $perm->add_responsive_control(
        'ct_divider_height',
        [
            'label' => __( 'Height', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
            'condition' => [
               'ct_divider_style' => 'fancy_divider',
            ],
        ]
    );

    $perm->add_control(
        'ct_divider_view',
        [
            'label' => __( 'View', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::HIDDEN,
            'default' => 'traditional',
        ]
    );

    $perm->end_controls_section();
}

function ct_fancy_divider_style_controls( $perm, $condition_key = '', $condition_val = '' ) {

    $condition = ( !empty( $condition_key ) && !empty( $condition_val ) ) ? 'condition' : 'nocondition' ;

    $perm->start_controls_section(
        'ct_section_fancy_divider',
        [
            'label' => __( 'Fancy Divider Design', 'elegant-addons-for-elementor' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            $condition => [
                $condition_key => $condition_val,
            ],
        ]
    );

    $perm->add_control(
        'ct_fancy_divider_animated_speed',
        [
            'label' => __( 'Animated Speed', 'elegant-addons-for-elementor' ),
            'description' => __( 'In miliseconds ( 1s = 1000ms )', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
                '{{WRAPPER}} .content-divider::after' => 'animation-duration: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $perm->end_controls_section();
}

function ct_fancy_divider_render( $perm ) {
    $settings = $perm->get_settings_for_display();

    if( $settings['ct_divider_style'] == 'fancy_divider' ) {
        echo '<div class="content-divider"></div><!-- /.content-divider -->';
    }
}

function ct_fancy_divider_content_template() {
    ?>
    <# if( settings.ct_divider_style == 'fancy_divider' ) { #>
        <div class="content-divider"></div><!-- /.content-divider -->
    <# } #>
    <?php
}

function ct_fancy_divider_no_condition() {
    echo '<div class="content-divider"></div><!-- /.content-divider -->';
}
