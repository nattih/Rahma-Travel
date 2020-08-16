<?php

// Register Controls
function ct_button_control_content( $perm, $condition_key = '', $condition_val = '', $is_internal = 'external', $alignment = true ) {

    $condition = ( !empty( $condition_key ) && !empty( $condition_val ) ) ? 'condition' : 'nocondition' ;

    if ( $is_internal == 'external' ) {
        $perm->start_controls_section(
            'ct_button_content_section',
            [
                'label' => __( 'Button Content', 'elegant-addons-for-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                $condition => [
                    $condition_key => $condition_val,
                ],
            ]
        );
    }

    if ( ELEGANT_ADDONS_PRO == 'pro' ) {
        $button_style = eae_button_pro_options();
    } else {
        $button_style = eae_button_options();
    }

    $perm->add_control(
        'ct_button_style',
        [
            'label'     => __( 'Button Style', 'elegant-addons-for-elementor' ),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'default'   => 'slide-right',
            'options'   => $button_style,
        ]
    );

    $perm->add_control(
        'ct_button_text',
        [
            'label'         => __( 'Text', 'elegant-addons-for-elementor' ),
            'type'          => \Elementor\Controls_Manager::TEXT,
            'dynamic'       => [
                'active'    => true,
            ],
            'default'       => __( 'Click here', 'elegant-addons-for-elementor' ),
            'placeholder'   => __( 'Click here', 'elegant-addons-for-elementor' ),
        ]
    );

    $perm->add_control(
        'ct_button_link',
        [
            'label'         => __( 'Link', 'elegant-addons-for-elementor' ),
            'type'          => \Elementor\Controls_Manager::URL,
            'dynamic'       => [
                'active'    => true,
            ],
            'placeholder'   => __( 'https://your-link.com', 'elegant-addons-for-elementor' ),
            'default'       => [
                'url'       => '#',
            ],
        ]
    );

    if ( $alignment == true ) {
        $perm->add_responsive_control(
            'ct_button_align',
            [
                'label'         => __( 'Alignment', 'elegant-addons-for-elementor' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => __( 'Left', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'elegant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'eae-elementor%s-align-',
                'default'       => '',
            ]
        );
    }

    $perm->add_control(
        'ct_button_icon_controls',
        [
            'label'         => __( 'Button Icon', 'elegant-addons-for-elementor' ),
            'type'          => \Elementor\Controls_Manager::SWITCHER,
            'label_on'      => __( 'Show', 'elegant-addons-for-elementor' ),
            'label_off'     => __( 'Hide', 'elegant-addons-for-elementor' ),
            'return_value'  => 'yes',
            'default'       => 'no',
        ]
    );

    $perm->add_control(
        'ct_button_selected_icon',
        [
            'label'             => __( 'Icon', 'elegant-addons-for-elementor' ),
            'type'              => \Elementor\Controls_Manager::ICONS,
            'label_block'       => true,
            'fa4compatibility'  => 'icon',
            'condition' => [
               'ct_button_icon_controls' => 'yes',
            ],
        ]
    );



    $perm->add_control(
        'eae_button_selected_icon_size',
        [
            'label' => __( 'Icon Size', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem', 'vw' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'vw' => [
                    'min' => 0,
                    'max' => 10,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ct-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
               'ct_button_icon_controls' => 'yes',
            ],
        ]
    );

    $perm->add_control(
        'ct_button_gutter_spacing',
        [
            'label' => __( 'Gutter Spacing (px)', 'elegant-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ct-button-defaults .button-title' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
            'default' => [
                'unit' => 'px',
                'size' => 6,
            ],

            'condition' => [
               'ct_button_icon_controls' => 'yes',
            ],
        ]
    );

    $perm->add_control(
        'ct_button_view',
        [
            'label'     => __( 'View', 'elegant-addons-for-elementor' ),
            'type'      => \Elementor\Controls_Manager::HIDDEN,
            'default'   => 'traditional',
        ]
    );

    $perm->add_control(
        'ct_button_button_css_id',
        [
            'label'         => __( 'Button ID', 'elegant-addons-for-elementor' ),
            'type'          => \Elementor\Controls_Manager::TEXT,
            'dynamic'       => [
                'active'    => true,
            ],
            'default'       => '',
            'title'         => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'elegant-addons-for-elementor' ),
            'label_block'   => false,
            'description'   => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'elegant-addons-for-elementor' ),
            'separator'     => 'before',

        ]
    );

    if ( $is_internal == 'external' ) {
        $perm->end_controls_section();
    }
}

function ct_button_control_style( $perm, $condition_key = '', $condition_val = '' ) {
    $condition = ( !empty( $condition_key ) && !empty( $condition_val ) ) ? 'condition' : 'nocondition' ;

    $perm->start_controls_section(
        'ct_button_section_style',
        [
            'label' => __( 'Button', 'elegant-addons-for-elementor' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            $condition => [
                $condition_key => $condition_val,
            ],
        ]
    );

    $perm->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'      => 'ct_button_typography',
            'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
            'selector'  => '{{WRAPPER}} .ct-button-defaults .button-title',
        ]
    );

    $perm->add_group_control(
        \Elementor\Group_Control_Text_Shadow::get_type(),
        [
            'name'      => 'ct_button_text_shadow',
            'selector'  => '{{WRAPPER}} .ct-button-defaults .button-title',
        ]
    );

    $perm->start_controls_tabs( 'tabs_button_style' );

    $perm->start_controls_tab(
        'ct_button_tab_button_normal',
        [
            'label'     => __( 'Normal', 'elegant-addons-for-elementor' ),
        ]
    );

    $perm->add_control(
        'ct_button_button_text_color',
        [
            'label'     => __( 'Text Color', 'elegant-addons-for-elementor' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a.button-title, {{WRAPPER}} .button-title:focus, {{WRAPPER}} .button-title' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],
            'default' => '#fff'
        ]
    );

    $perm->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name'              => 'ct_button_background_color',
            'types'             => [ 'classic', 'gradient' ],
            'exclude'           => [ 'image' ],
            'selector'          => '{{WRAPPER}} .ct-button-defaults',
            'fields_options' => [
                'color' => [
                    'default' => '#145c99'
                ],
            ],

        ]
    );

    $perm->add_control(
        'ct_button_underline_color',
        [
            'label'     => __( 'Button Underline Color', 'elegant-addons-for-elementor' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ct-button-underline' => 'background: {{VALUE}};',
            ],
            'condition' => [
               'ct_button_style' => 'slide-underline',
            ],
        ]
    );


    $perm->add_control(
        'ct_button_button_icon_color',
        [
            'label'     => __( 'Icon Color', 'elegant-addons-for-elementor' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ct-button-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],
            'condition' => [
               'ct_button_icon_controls' => 'yes',
            ],
        ]
    );

    $perm->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'      => 'ct_button_normal_border',
            'fields_options' => [
                'border' => [
                    'default' => 'solid',
                ],
                'width' => [
                    'default' => [
                        'top' => '2',
                        'right' => '2',
                        'bottom' => '2',
                        'left' => '2',
                        'isLinked' => false,
                    ],
                ],
            ],
            'selector'  => '{{WRAPPER}} a.ct-button-defaults, {{WRAPPER}} .ct-button-defaults',
        ]
    );

    $perm->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name'      => 'ct_button_button_box_shadow',
            'selector'  => '{{WRAPPER}} .ct-button-defaults',
        ]
    );

    $perm->end_controls_tab();

    $perm->start_controls_tab(
            'ct_button_tab_button_hover',
            [
                'label' => __( 'Hover', 'elegant-addons-for-elementor' ),
            ]
        );

        $perm->add_control(
            'ct_button_hover_text_color',
            [
                'label'     => __( 'Text Color', 'elegant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-button-defaults:hover .button-title' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
                'default' => '#000'
            ]
        );

        $perm->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'              => 'ct_button_hover_background_color',
                'types'             => [ 'classic', 'gradient' ],
                'exclude'           => [ 'image' ],
                'selector'          => '{{WRAPPER}} .ct-button-defaults:hover, {{WRAPPER}} .ct-button-defaults::before,  {{WRAPPER}} .ct-button-defaults:hover .ct-btn-hover',
                'fields_options' => [
                  'color' => [
                    'default' => '#fff'
                  ],
                ],
            ]
        );

        $perm->add_control(
            'ct_button_hover_icon_color',
            [
                'label'     => __( 'Icon Color', 'elegant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ct-button-defaults:hover .ct-button-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
                'condition' => [
                   'ct_button_icon_controls' => 'yes',
                ],
            ]
        );

        $perm->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'ct_button_hover_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '2',
                            'right' => '2',
                            'bottom' => '2',
                            'left' => '2',
                            'isLinked' => false,
                        ],
                    ],
                ],
                'selector'  => '{{WRAPPER}} a.ct-button-defaults:hover, {{WRAPPER}} .ct-button-defaults:hover',
            ]
        );

        $perm->add_control(
            'ct_button_animated_speed',
            [
                'label' => __( 'Animation Speed', 'elegant-addons-for-elementor' ),
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
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ct-button-defaults, {{WRAPPER}} .ct-button-defaults .button-title, {{WRAPPER}} .ct-button-defaults::before, {{WRAPPER}} .ct-button-icon, {{WRAPPER}} .ct-transition' => 'transition-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $perm->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'ct_button_button_hover_box_shadow',
                'selector'  => '{{WRAPPER}} .ct-button-defaults:hover',
            ]
        );

        $perm->end_controls_tab();
        $perm->end_controls_tabs();

        $perm->add_control(
            'ct_button_border_radius',
            [
                'label'         => __( 'Border Radius', 'elegant-addons-for-elementor' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .ct-button-defaults, {{WRAPPER}} .ct-animated-button, {{WRAPPER}} a.ct-button-defaults::before, {{WRAPPER}} .ct-button-defaults::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $perm->add_responsive_control(
            'ct_button_text_padding',
            [
                'label'         => __( 'Padding', 'elegant-addons-for-elementor' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} a.ct-button-defaults, {{WRAPPER}} .ct-button-defaults' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'default' => [
                                'top' => '10',
                                'right' => '20',
                                'bottom' => '10',
                                'left' => '20',
                                'isLinked' => false,
                            ],
            ]
        );

        $perm->add_responsive_control(
            'ct_button_text_margin',
            [
                'label'         => __( 'Margin', 'elegant-addons-for-elementor' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} a.ct-button-defaults, {{WRAPPER}} .ct-button-defaults' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $perm->end_controls_section();
}

// Render
function ct_button_render( $perm, $settings = [], $item = false ) {
    if ( $item == false ) {
        $settings = $perm->get_settings_for_display();
    }

    $target     = $settings['ct_button_link']['is_external'] ? ' target="_blank"' : '';
    $nofollow   = $settings['ct_button_link']['nofollow'] ? ' rel="nofollow"' : '';
    $button_icon = '';

    if ( $settings['ct_button_icon_controls'] == 'yes' ) {
        $button_icon = '<i class="ct-button-icon ' . $settings['ct_button_selected_icon']['value'] . '"></i>';
    }

    if ( $settings['ct_button_text'] ) :
        echo '<div class="ct-button ct-button-align">';

        switch ( $settings[ 'ct_button_style' ] ) {
            case "normal":
                echo '<a  href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . ' class="ct-button-defaults ct-normal-button"><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a>';
                break;

            case "slide-right":
                echo '<div class="cta-button"><a  href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . ' class="ct-button-defaults ct-animated-button ct-button-slide-right"><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a></div><!-- /.cta-button -->';
                break;

            case "slide-from-center":
                echo '<div class="ct-ghost"><a href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . ' class="ct-button-defaults ct-ghost-button"><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a></div>';
                break;

            case "slide-underline":
                echo '<div class="ct-button-defaults ct-slipy-button ct-button-4"><div class="ct-button-underline ct-transition ct-btn-hover"></div><a href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . '><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a></div>';
                break;

            case "slide-circle":
                echo '<div class="ct-button-defaults ct-slipy-button ct-button-3"><div class="ct-button-circle ct-transition ct-btn-hover"></div><a href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . '><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a></div>';
                break;

            case "slide-square":
                echo '<div class="ct-button-defaults ct-slipy-button ct-button-6"><div class="ct-button-spin ct-transition ct-btn-hover"></div><a href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . '><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a></div>';
                break;

            default:
                echo '<div class="cta-button"><a  href="' . $settings['ct_button_link']['url'] . '"' . $target . $nofollow . ' class="ct-button-defaults ct-animated-button ct-button-slide-right"><span class="button-title">' . $settings['ct_button_text'] . '</span>' . $button_icon . '</a></div><!-- /.cta-button -->';

        }

        echo "</div><!-- /.ct-button -->";

    endif;
}

// Content Template
function ct_button_template( $item = false ) {

    if ( $item == true ) {
        ?>
            <# var settings = item; #>
        <?php
    }
    ?>
        <#
        var target      = settings.ct_button_link.is_external ? ' target="_blank"' : '';
        var nofollow    = settings.ct_button_link.nofollow ? ' rel="nofollow"' : '';
        var button_icon = '';

        if ( settings.ct_button_icon_controls == 'yes' ) {
            var button_icon = '<i class="ct-button-icon ' + settings.ct_button_selected_icon.value + '"></i>';
        }
        #>

        <#
            if ( settings.ct_button_text != '' ) {
        #>
                <div class="ct-button ct-button-align">
        <#
                if( settings.ct_button_style == 'normal' ) {
        #>
                    <a href="{{ settings.ct_button_link.url }}"{{ target }}{{ nofollow }} class="ct-button-defaults ct-normal-button"><span class="button-title">{{ settings.ct_button_text }}</span>{{{ button_icon }}}</a>
        <#
                } else if( settings.ct_button_style == 'slide-right' ) {
        #>
                    <div class="cta-button">
                        <a href="{{ settings.ct_button_link.url }}"{{ target }}{{ nofollow }} class="ct-button-defaults ct-animated-button ct-button-slide-right"><span class="button-title">{{ settings.ct_button_text }}</span>{{{ button_icon }}}</a>
                    </div><!-- /.cta-button -->
        <#
                } else if ( settings.ct_button_style == 'slide-from-center' ) {
        #>
                    <div class="ct-ghost"><a href="{{ settings.ct_button_link.url }}"{{ target }}{{ nofollow }} class="ct-button-defaults ct-ghost-button"><span class="button-title">{{ settings.ct_button_text }}</span>{{{ button_icon }}}</a></div>
        <#
                } else if ( settings.ct_button_style == 'slide-underline' ) {
        #>
                    <div class="ct-button-defaults ct-slipy-button ct-button-4"><div class="ct-button-underline ct-transition ct-btn-hover"></div><a href="{{ settings.ct_button_link.url }}"{{ target }}{{ nofollow }}><span class="button-title">{{ settings.ct_button_text }}</span>{{{ button_icon }}}</a></div>
        <#
                } else if ( settings.ct_button_style == 'slide-circle' ) {
        #>
                    <div class="ct-button-defaults ct-slipy-button ct-button-3"><div class="ct-button-circle ct-transition ct-btn-hover"></div><a href="{{ settings.ct_button_link.url }}"{{ target }}{{ nofollow }}><span class="button-title">{{ settings.ct_button_text }}</span>{{{ button_icon }}}</a></div>
        <#
                } else if ( settings.ct_button_style == 'slide-square' ) {
        #>
                    <div class="ct-button-defaults ct-slipy-button ct-button-6"><div class="ct-button-spin ct-transition ct-btn-hover"></div><a href="{{ settings.ct_button_link.url }}"{{ target }}{{ nofollow }}><span class="button-title">{{ settings.ct_button_text }}</span>{{{ button_icon }}}</a></div>
        <#
                }
        #>
                </div><!-- /.ct-button -->
        <#
            }
        #>
    <?php
}
