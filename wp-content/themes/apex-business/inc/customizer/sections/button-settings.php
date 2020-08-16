<?php
/**
 * Add Customizer Options
 * [Button]
 */
function apex_business_button_settings_setup( $wp_customize ) {

    $wp_customize->add_section( 'apex_business_button_settings_section', array(
        'title'       =>  __( 'Button Style', 'apex-business' ),
        'capability'  => 'edit_theme_options',
        'priority'    =>  10,
    ) );

    $wp_customize->add_setting(
        'apex_business_button_settings_tabs_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Tabs_Control(
            $wp_customize, 'apex_business_button_settings_tabs_control', array(
                /* Make sure you edit the following parameters*/
                'section' => 'apex_business_button_settings_section',
                'tabs'    => array(
                    'button' => array(
                        'nicename' => esc_html__( 'Button Style', 'apex-business' ),
                        'icon'     => 'font',
                        'controls' => array(
                            'apex_business_button_width_control',
                            'apex_business_button_height_control',
                            'apex_business_button_text_size_control',
                            'apex_business_button_text_color_control',
                            'apex_business_button_bgcolor_control',
                            'apex_business_button_border_width_control',
                            'apex_business_button_border_radius_control',
                            'apex_business_button_letter_spacing_control',
                            'apex_business_button_font_family_control',
                            'apex_business_button_font_weight_control',
                            'apex_business_button_border_color_control',
                        ),
                    ),
                    'style'  => array(
                        'nicename' => esc_html__( 'Hover Style', 'apex-business' ),
                        'icon'     => 'style',
                        'controls' => array(
                            'apex_business_button_hover_bgcolor_control',
                            'apex_business_button_hover_text_color_control',
                            'apex_business_button_hover_border_radius_control',
                            'apex_business_button_hover_letter_spacing_control',
                            'apex_business_button_hover_border_color_control',

                        ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_width_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_width_control', array(
                'label'         => esc_html__( 'Button Width ( px )', 'apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 5,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'tablet'  => array(
                        'min'           => 5,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 20,
                    ),
                    'desktop' => array(
                        'min'           => 5,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_height_control', array(
                'label'         => esc_html__( 'Button Height ( px )', 'apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 5,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'tablet'  => array(
                        'min'           => 5,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'desktop' => array(
                        'min'           => 5,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_text_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_text_size_control', array(
                'label'         => esc_html__( 'Button Font Size','apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 12,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 12,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 12,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_button_font_family_control', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_button_font_family_control', array(
                'label'             => esc_html__( 'Button Font Family', 'apex-business' ),
                'section'           => 'apex_business_button_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );
    $wp_customize->add_setting( 'apex_business_button_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_button_font_weight_control', array(
                'label'       => __( 'Font Weight', 'apex-business' ),
                'section'     => 'apex_business_button_settings_section',
                'settings'    => 'apex_business_button_font_weight_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'   =>  __( 'Default', 'apex-business' ),
                    '100'       =>  __( 'Thin: 100', 'apex-business' ),
                    '200'       =>  __( 'Light: 200', 'apex-business' ),
                    '300'       =>  __( 'Book: 300', 'apex-business' ),
                    '400'       =>  __( 'Normal: 400', 'apex-business' ),
                    '500'       =>  __( 'Medium: 500', 'apex-business' ),
                    '600'       =>  __( 'Semibold: 600', 'apex-business' ),
                    '700'       =>  __( 'Bold: 700', 'apex-business' ),
                    '800'       =>  __( 'Extra Bold: 800', 'apex-business' ),
                    '900'       =>  __( 'Black: 900', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_text_color_setting',
        array(
            'default'           => APEX_BUSINESS_TEXT_COLOR,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_alpha_color',
            'transport'         => 'postMessage'
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_button_text_color_control',
            array(
                'label'         => __( 'Button Text Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_button_settings_section',
                'settings'      => 'apex_business_button_text_color_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_bgcolor_setting',
        array(
            'default'           => APEX_BUSINESS_PRIMARY_COLOR,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'apex_business_sanitize_alpha_color',
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_button_bgcolor_control',
            array(
                'label'         => __( 'Button Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_button_settings_section',
                'settings'      => 'apex_business_button_bgcolor_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_border_width_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_border_width_control', array(
                'label'         => esc_html__( 'Button Border Width','apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_border_color_setting',
        array(
            'default'           => APEX_BUSINESS_PRIMARY_COLOR,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'apex_business_sanitize_alpha_color',
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_button_border_color_control',
            array(
                'label'         => __( 'Border Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_button_settings_section',
                'settings'      => 'apex_business_button_border_color_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_border_radius_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_border_radius_control', array(
                'label'         => esc_html__( 'Button Border Radius','apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 3,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 3,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 3,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_letter_spacing_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_letter_spacing_control', array(
                'label'             => esc_html__( 'Button Text Letter Spacing','apex-business' ),
                'section'           => 'apex_business_button_settings_section',
                'type'              => 'range-value',
                'media_query'       => true,
                'priority'          => 25,
                'input_attr'        => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_hover_bgcolor_setting',
        array(
            'default'           => APEX_BUSINESS_WHITE_COLOR,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_alpha_color',
            'transport'         => 'postMessage'
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_button_hover_bgcolor_control',
            array(
                'label'         => __( 'Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_button_settings_section',
                'settings'      => 'apex_business_button_hover_bgcolor_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_hover_text_color_setting',
        array(
            'default'           => APEX_BUSINESS_PRIMARY_COLOR,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_alpha_color',
            'transport'         => 'postMessage'
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_button_hover_text_color_control',
            array(
                'label'         => __( 'Text Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_button_settings_section',
                'settings'      => 'apex_business_button_hover_text_color_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_hover_border_color_setting',
        array(
            'default'           => APEX_BUSINESS_PRIMARY_COLOR,
            'type'              => 'theme_mod',
            'sanitize_callback' => 'apex_business_sanitize_alpha_color',
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage'
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_button_hover_border_color_control',
            array(
                'label'         => __( 'Border Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_button_settings_section',
                'settings'      => 'apex_business_button_hover_border_color_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_hover_border_radius_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_hover_border_radius_control', array(
                'label'         => esc_html__( 'Border Radius','apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_button_hover_letter_spacing_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_button_hover_letter_spacing_control', array(
                'label'         => esc_html__( 'Text Letter Spacing','apex-business' ),
                'section'       => 'apex_business_button_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 1,
                    ),
                ),
            )
        )
    );

}

add_action( 'customize_register', 'apex_business_button_settings_setup');
