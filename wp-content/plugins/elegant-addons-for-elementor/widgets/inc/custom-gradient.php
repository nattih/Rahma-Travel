<?php
    function ct_custom_gradient( $perm, $class = '', $class_2 = '' ) {
        $perm->add_control(
            'ct_slider_overlay_headline',
            [
                'label' => __( 'Overlay Color', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

         $perm->add_control(
            'ct_slider_background_overlay',
            [
                'label' => __( 'Background Overlay', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elegant-addons-for-elementor' ),
                'label_off' => __( 'Hide', 'elegant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $perm->add_control(
            'ct_slider_background_type',
            [
                'label' => __( 'Background Type', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'color',
                'options' => [
                    'color' => __( 'Color', 'elegant-addons-for-elementor' ),
                    'gradient' => __( 'Gradient', 'elegant-addons-for-elementor' ),
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ]
            ]
        );

        $perm->add_control(
            'ct_elementor_gradient_normal_color',
            [
                'label'                 => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'                  => \Elementor\Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} ' . $class => 'background-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'color',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ]
            ]
        );

        $perm->add_control(
            'ct_elementor_gradient_first_color',
            [
                'label'                 => __( 'Color', 'elegant-addons-for-elementor' ),
                'type'                  => \Elementor\Controls_Manager::COLOR,
                'default'               => '',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'gradient',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'selectors'             => [
                ],
            ]
        );
        $perm->add_control(
            'ct_elementor_gradient_first_location',
            [
                'label' => __( 'location', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'gradient',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $perm->add_control(
            'ct_elementor_gradient_second_color',
            [
                'label'                 => __( 'Second Color', 'elegant-addons-for-elementor' ),
                'type'                  => \Elementor\Controls_Manager::COLOR,
                'default'               => '#f2295b',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'gradient',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $perm->add_control(
            'ct_elementor_gradient_second_location',
            [
                'label' => __( 'location', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'gradient',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $perm->add_control(
            'ct_elementor_gradient_type',
            [
                'label' => __( 'Type', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear' => __( 'Linear', 'elegant-addons-for-elementor' ),
                    'radial' => __( 'Radial', 'elegant-addons-for-elementor' ),
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'gradient',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'prefix_class' => 'elementor-pagination-position-',
            ]
        );
        $perm->add_control(
            'ct_elementor_gradient_position',
            [
                'label' => __( 'Position', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center' => __( 'Center Center', 'elegant-addons-for-elementor' ),
                    'center left' => __( 'Center Left', 'elegant-addons-for-elementor' ),
                    'center right' => __( 'Center Right', 'elegant-addons-for-elementor' ),
                    'top center' => __( 'Top Center', 'elegant-addons-for-elementor' ),
                    'top left' => __( 'Top Left', 'elegant-addons-for-elementor' ),
                    'top right' => __( 'Top Right', 'elegant-addons-for-elementor' ),
                    'bottom center' => __( 'Bottom Center', 'elegant-addons-for-elementor' ),
                    'bottom left' => __( 'Bottom Left', 'elegant-addons-for-elementor' ),
                    'bottom right' => __( 'Bottom Right', 'elegant-addons-for-elementor' ),
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_elementor_gradient_type',
                            'value' => 'radial',
                        ],
                    ],
                ],
                'prefix_class' => 'elementor-pagination-position-',
            ]
        );

        $perm->add_control(
            'ct_elementor_gradient_angle',
            [
                'label' => __( 'Angle', 'elegant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'deg' => [
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'ct_slider_background_type',
                            'value' => 'gradient',
                        ],
                        [
                            'name' => 'ct_slider_background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'prefix_class' => 'elementor-pagination-position-',
            ]
        );
    }

    // Content Template
    function ct_custom_gradient_content_template() {
        ?>
        <#
            if( item.ct_slider_background_type == 'gradient' ) {
                var gradient_val = item.ct_elementor_gradient_angle.size + 'deg';
                if( item.ct_elementor_gradient_type == 'radial' ) {
                    var gradient_val = 'at ' + item.ct_elementor_gradient_position;
                }
        #>
        style="background-image: {{item.ct_elementor_gradient_type}}-gradient( {{ gradient_val }}, {{ item.ct_elementor_gradient_first_color }} {{ item.ct_elementor_gradient_first_location.size }}%, {{ item.ct_elementor_gradient_second_color }} {{ item.ct_elementor_gradient_second_location.size }}% )"
        <# } #>
        <?php
    }

    // Content Template
    function ct_custom_gradient_render( $item = array() ) {

        if ( $item['ct_slider_background_type'] == 'gradient' ) {
            $gradient_val = $item['ct_elementor_gradient_angle']['size'] . 'deg';
            if( $item['ct_elementor_gradient_type'] == 'radial' ) {
                $gradient_val = 'at ' . $item['ct_elementor_gradient_position'];
            }
    ?>
        style="background-image: <?php echo esc_attr( $item["ct_elementor_gradient_type"] ); ?>-gradient( <?php echo $gradient_val; ?>, <?php echo esc_attr( $item["ct_elementor_gradient_first_color"] ) . ' ' . esc_attr( $item["ct_elementor_gradient_first_location"]["size"] ) ?>%, <?php echo esc_attr( $item["ct_elementor_gradient_second_color"] ) . ' ' . esc_attr( $item["ct_elementor_gradient_second_location"]["size"] ) ?>% )"
    <?php
        }
    }
