<?php

// Register Controls
function ct_divider_control_content( $perm ) {

    $perm->start_controls_section(
        'ct_section_divider',
        [
            'label' => __( 'Divider', 'elegant-addons-for-elementor' ),
        ]
    );

    $perm->add_responsive_control(
        'ct_divider_align',
        [
            'label' => __( 'Alignment', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
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
        ]
    );

    $perm->add_control(
        'ct_divider_style',
        [
            'label' => __( 'Style', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'fancy_divider' => __( 'Fancy Divider', 'elegant-addons-for-elementor' ),
            ],
            'default' => 'fancy_divider',
        ]
    );

    $perm->add_control(
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
                '{{WRAPPER}} .cte-divider' => 'background-color: {{VALUE}};',
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
                '{{WRAPPER}} .divider::after' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $perm->add_responsive_control(
        'ct_divider_width',
        [
            'label' => __( 'Width', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'range' => [
                'px' => [
                    'max' => 1170,
                ],
            ],
            'default' => [
                'size' => 100,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .cte-divider' => 'width: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .divider::after' => 'width: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .cte-divider, {{WRAPPER}} .divider::after' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $perm->add_responsive_control(
        'ct_divider_gap',
        [
            'label' => __( 'Gap', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'size' => 15,
            ],
            'range' => [
                'px' => [
                    'min' => 2,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cte-divider' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .cte-divider::after' => 'animation-duration: {{SIZE}}{{UNIT}};',
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

// Render
function ct_divider_render( $settings ) {
    $align      = $settings['ct_divider_align'];
    if ( $align == '' ) {
        $align = 'left';
    }

    if ( $settings['ct_divider_style'] == 'fancy_divider' ) {
            echo '<div class="divider divider-'. esc_attr( $align ) .' cte-divider"></div><!-- /.divider-center -->';
    }
}

// Content Template
function ct_divider_template() {
    ?>
       <#
            var align = settings.ct_divider_align;

            if ( align == '' ) {
                var align = 'left';
            }
        #>

        <# if ( settings.ct_divider_style == 'fancy_divider' ) { #>
            <div class="divider cte-divider divider-{{align}}"></div><!-- /.divider-center -->
        <# } #>
    <?php
}
