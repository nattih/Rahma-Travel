<?php
/**
 * Add Customizer Options
 * [Layout Settings]
 */

function apex_business_layout_settings_setup( $wp_customize ) {
    $wp_customize->add_section( 'apex_business_layout_settings_section', array(
        'title'       =>  __( 'Layout Settings', 'apex-business' ),
        'priority'    =>  10,
        'capability'  => 'edit_theme_options',
        'panel'       =>  'apex_business_general_panel'
    ) );

    $wp_customize->add_setting( 'apex_business_box_layout_switch_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'default'           => false
    ) );

    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_box_layout_switch_control', array(
        'label'       => __( 'Enable Box Layout?', 'apex-business' ),
        'section'     => 'apex_business_layout_settings_section',
        'settings'    => 'apex_business_box_layout_switch_setting',
        'type'        => 'ios',
    ) ) );

    $wp_customize->add_setting(
        'apex_business_website_width_setting', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_website_width_setting', array(
                'label'         => esc_html__( 'Content width (px)', 'apex-business' ),
                'section'       => 'apex_business_layout_settings_section',
                'type'          => 'range-value',
                'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 700,
                        'max'           => 2000,
                        'step'          => 1,
                        'default_value' => 1200,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_gutter_width_setting', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_gutter_width_setting', array(
                'label'         => esc_html__( 'Gutter width (px)','apex-business' ),
                'section'       => 'apex_business_layout_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 15,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 15,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 15,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_section_height_setting', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_section_height_setting', array(
                'label'         => esc_html__( 'Section height (px)', 'apex-business' ),
                'section'       => 'apex_business_layout_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 72,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 72,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 72,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_lodding_section_setting', array(
     'capability'        => 'edit_theme_options',
     'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control(
     new WP_Customize_Control(
       $wp_customize, 'apex_business_lodding_section_control', array(
           'label'           => esc_html__( 'Lodding Bar', 'apex-business' ),
           'section'         => 'apex_business_layout_settings_section',
           'settings'        => 'apex_business_lodding_section_setting',
           'priority'        => 25,
           'type'            => 'hidden',
       )
     )
    );
    $wp_customize->add_setting( 'apex_business_loading_bar_setting', array(
       'capability'        => 'edit_theme_options',
       'sanitize_callback' => 'absint',
       'default'           => true
    ) );
    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_loading_bar_switch_control', array(
       'label'       => __( 'Enable Loading Bar?', 'apex-business' ),
       'section'     => 'apex_business_layout_settings_section',
       'settings'    => 'apex_business_loading_bar_setting',
       'priority'    => 25,
       'type'        => 'ios',
    ) ) );

    $wp_customize->add_setting( 'apex_business_loading_bar_color_setting', array(
        'default'           => APEX_BUSINESS_PRIMARY_COLOR,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'apex_business_loading_bar_color_control',
            array(
                'section'  => 'apex_business_layout_settings_section',
                'priority' => 25,
                'label'    => esc_html__( 'Loading Bar Color', 'apex-business' ),
                'settings' => 'apex_business_loading_bar_color_setting',
            )
        )
    );
}

add_action( 'customize_register', 'apex_business_layout_settings_setup');
