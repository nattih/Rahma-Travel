<?php
/**
 * Add Customizer Options
 * [typography Settings]
 */
function apex_business_typography_settings_setup( $wp_customize ) {

    $wp_customize->add_section( 'apex_business_typography_settings_section', array(
        'title'       =>  __( 'Typography Settings', 'apex-business' ),
        'priority'    =>  10,
        'capability'  => 'edit_theme_options',
        'panel'       =>  'apex_business_general_panel'
    ) );

    $wp_customize->add_setting(
        'apex_business_typography_tabs_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Tabs_Control(
            $wp_customize, 'apex_business_typography_tabs_control', array(
                'section' => 'apex_business_typography_settings_section',
                'tabs'    => array(
                    'font_family' => array(
                        'nicename' => esc_html__( 'Font Family', 'apex-business' ),
                        'icon'     => 'font',
                        'controls' => array(
                            'apex_business_body_font_family_control',
                            'apex_business_blockquote_font_family_control',
                            'apex_business_link_font_family_control',
                            'apex_business_h1_font_family_control',
                            'apex_business_h2_font_family_control',
                            'apex_business_h3_font_family_control',
                            'apex_business_h4_font_family_control',
                            'apex_business_h5_font_family_control',
                            'apex_business_h6_font_family_control',
                            'apex_business_typography_subsets_control',
                        ),
                    ),
                    'font_size'   => array(
                        'nicename' => esc_html__( 'Font Size', 'apex-business' ),
                        'icon'     => 'text-height',
                        'controls' => array(
                            'apex_business_body_font_headline_control',
                            'apex_business_body_font_size_control',
                            'apex_business_body_font_weight_control',
                            'apex_business_h1_font_headline_control',
                            'apex_business_h1_font_size_control',
                            'apex_business_h1_font_weight_control',
                            'apex_business_h2_font_headline_control',
                            'apex_business_h2_font_size_control',
                            'apex_business_h2_font_weight_control',
                            'apex_business_h3_font_headline_control',
                            'apex_business_h3_font_size_control',
                            'apex_business_h3_font_weight_control',
                            'apex_business_h4_font_headline_control',
                            'apex_business_h4_font_size_control',
                            'apex_business_h4_font_weight_control',
                            'apex_business_h5_font_headline_control',
                            'apex_business_h5_font_size_control',
                            'apex_business_h5_font_weight_control',
                            'apex_business_h6_font_headline_control',
                            'apex_business_h6_font_size_control',
                            'apex_business_h6_font_weight_control',
                            'apex_business_blockquote_font_headline_control',
                            'apex_business_blockquote_font_size_control',
                            'apex_business_blockquote_font_weight_control',
                            'apex_business_link_font_headline_control',
                            'apex_business_link_font_weight_control',
                        ),
                    ),
                    'font_style' => array(
                        'nicename' => esc_html__( 'Fonts Style', 'apex-business' ),
                        'icon'     => 'text-width',
                        'controls' => array(
                            'apex_business_body_font_style_headline_control',
                            'apex_business_body_line_height_control',
                            'apex_business_body_font_style_control',
                            'apex_business_body_text_transform_control',
                            'apex_business_body_color_control',
                            'apex_business_h1_font_style_headline_control',
                            'apex_business_h1_line_height_control',
                            'apex_business_h1_font_style_control',
                            'apex_business_h1_text_transform_control',
                            'apex_business_h1_color_control',
                            'apex_business_h2_font_style_headline_control',
                            'apex_business_h2_line_height_control',
                            'apex_business_h2_font_style_control',
                            'apex_business_h2_text_transform_control',
                            'apex_business_h2_color_control',
                            'apex_business_h3_font_style_headline_control',
                            'apex_business_h3_line_height_control',
                            'apex_business_h3_font_style_control',
                            'apex_business_h3_text_transform_control',
                            'apex_business_h3_color_control',
                            'apex_business_h4_font_style_headline_control',
                            'apex_business_h4_line_height_control',
                            'apex_business_h4_font_style_control',
                            'apex_business_h4_text_transform_control',
                            'apex_business_h4_color_control',
                            'apex_business_h5_font_style_headline_control',
                            'apex_business_h5_line_height_control',
                            'apex_business_h5_font_style_control',
                            'apex_business_h5_text_transform_control',
                            'apex_business_h5_color_control',
                            'apex_business_h6_font_style_headline_control',
                            'apex_business_h6_line_height_control',
                            'apex_business_h6_font_style_control',
                            'apex_business_h6_text_transform_control',
                            'apex_business_h6_color_control',
                            'apex_business_blockquote_font_style_headline_control',
                            'apex_business_blockquote_line_height_control',
                            'apex_business_blockquote_font_style_control',
                            'apex_business_blockquote_text_transform_control',
                            'apex_business_blockquote_color_control',
                            'apex_business_link_font_style_headline_control',
                            'apex_business_link_font_style_control',
                            'apex_business_link_text_transform_control',
                        ),
                    ),
                ),
            )
        )
    );

    /**
     * Font Family
     */

    $wp_customize->add_setting(
        'apex_business_body_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_body_font_family_control', array(
                'label'             => esc_html__( 'Body Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h1_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_h1_font_family_control', array(
                'label'             => esc_html__( 'H1 Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h2_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_h2_font_family_control', array(
                'label'             => esc_html__( 'H2 Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h3_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_h3_font_family_control', array(
                'label'             => esc_html__( 'H3 Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h4_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_h4_font_family_control', array(
                'label'             => esc_html__( 'H4 Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h5_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_h5_font_family_control', array(
                'label'             => esc_html__( 'H5 Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h6_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_h6_font_family_control', array(
                'label'             => esc_html__( 'H6 Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_blockquote_font_family_control', array(
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_blockquote_font_family_control', array(
                'label'             => esc_html__( 'Blockquote Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_link_font_family_control', array(
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_link_font_family_control', array(
                'label'             => esc_html__( 'Link Font Family', 'apex-business' ),
                'section'           => 'apex_business_typography_settings_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    /**
     * Font Size
     */

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_body_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_body_font_headline_control', array(
        'label'           => esc_html__( 'Body Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_body_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
      ) ) );

    $wp_customize->add_setting(
        'apex_business_body_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_body_font_size_control', array(
                'label'         => esc_html__( 'Body Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_body_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_body_font_weight_control', array(
            'label'       => __( 'Font Weight', 'apex-business' ),
            'section'     => 'apex_business_typography_settings_section',
            'settings'    => 'apex_business_body_font_weight_setting',
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h1_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h1_font_headline_control', array(
        'label'           => esc_html__( 'Heading 1 (H1) Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h1_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
      ) ) );

    $wp_customize->add_setting(
        'apex_business_h1_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h1_font_size_control', array(
                'label'         => esc_html__( 'H1 Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 33,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 37,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 48,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h1_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           =>  'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_h1_font_weight_control', array(
            'label'       => __( 'Font Weight', 'apex-business' ),
            'section'     => 'apex_business_typography_settings_section',
            'settings'    => 'apex_business_h1_font_weight_setting',
            'type'        =>  'select',
            'priority'    => 25,
            'choices'     =>  array(
                'inherit'   =>  __( 'Default', 'apex-business' ),
                '100'       =>  __( 'Thin: 100', 'apex-business' ),
                '100i'      =>  __( 'Thin: italic', 'apex-business' ),
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h2_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h2_font_headline_control', array(
        'label'           => esc_html__( 'Heading 2 (H2) Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h2_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h2_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h2_font_size_control', array(
                'label'         => esc_html__( 'H2 Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 26,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 38,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h2_font_weight_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h2_font_weight_control', array(
                'label'       => __( 'Font Weight', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h2_font_weight_setting',
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h3_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h3_font_headline_control', array(
        'label'           => esc_html__( 'Heading 3 (H3) Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h3_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h3_font_size_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h3_font_size_control', array(
                'label'         => esc_html__( 'H3 Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 24,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 26,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 31,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h3_font_weight_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h3_font_weight_control', array(
            'label'       => __( 'Font Weight', 'apex-business' ),
            'section'     => 'apex_business_typography_settings_section',
            'settings'    => 'apex_business_h3_font_weight_setting',
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h4_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h4_font_headline_control', array(
        'label'           => esc_html__( 'Heading 4 (H4) Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h4_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h4_font_size_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h4_font_size_control', array(
                'label'         => esc_html__( 'H4 Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 20,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 20,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 25,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h4_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h4_font_weight_control', array(
                'label'       => __( 'Font Weight', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h4_font_weight_setting',
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h5_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h5_font_headline_control', array(
        'label'           => esc_html__( 'Heading 5 (H5) Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h5_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h5_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h5_font_size_control', array(
                'label'         => esc_html__( 'H5 Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 23,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h5_font_weight_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h5_font_weight_control', array(
                'label'       => __( 'Font Weight', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h5_font_weight_setting',
                'type'      =>  'select',
                'priority'  => 25,
                'choices'   =>  array(
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h6_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h6_font_headline_control', array(
        'label'           => esc_html__( 'Heading 6 (H6) Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h6_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h6_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h6_font_size_control', array(
                'label'         => esc_html__( 'H6 Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 21,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h6_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           =>  'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select ',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_h6_font_weight_control', array(
            'label'       => __( 'Font Weight', 'apex-business' ),
            'section'     => 'apex_business_typography_settings_section',
            'settings'    => 'apex_business_h6_font_weight_setting',
            'type'      =>  'select',
            'priority'  => 25,
            'choices'   =>  array(
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_blockquote_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_blockquote_font_headline_control', array(
        'label'           => esc_html__( 'Blockquote Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_blockquote_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_blockquote_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_blockquote_font_size_control', array(
                'label'         => esc_html__( 'Blockquote Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'tablet'    => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'desktop'   => array(
                        'min'           => 8,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_blockquote_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_blockquote_font_weight_control', array(
                'label'       => __( 'Font Weight', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_blockquote_font_weight_setting',
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_link_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_link_font_headline_control', array(
        'label'           => esc_html__( 'Link Font', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_link_font_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting( 'apex_business_link_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_link_font_weight_control', array(
                'label'       => __( 'Font Weight', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_link_font_weight_setting',
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

     /**
     * Font Style
     */

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_body_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_body_font_style_headline_control', array(
        'label'           => esc_html__( 'Body Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_body_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );


    $wp_customize->add_setting(
        'apex_business_body_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_body_line_height_control', array(
                'label'         => esc_html__( 'Body Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.01,
                        'default_value' => 1.618,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_body_font_style_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           =>  'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_body_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_body_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'     =>  __( 'Normal', 'apex-business' ),
                    'italic'      =>  __( 'Italic', 'apex-business' ),
                  ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_body_text_transform_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_body_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_body_text_transform_setting',
                'type'        => 'select',
                'priority'    => 25,
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_body_color_setting',
        array(
            'default'           => APEX_BUSINESS_TEXT_COLOR,
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
            'apex_business_body_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_body_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h1_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h1_font_style_headline_control', array(
        'label'           => esc_html__( 'H1 Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h1_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h1_line_height_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h1_line_height_control', array(
                'label'         => esc_html__( 'H1 Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'desktop' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.01,
                        'default_value' => 1.35,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h1_font_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h1_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h1_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h1_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h1_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h1_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h1_color_setting',
        array(
            'default'           =>  APEX_BUSINESS_TEXT_COLOR,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_select',
            'transport'         => 'postMessage'
        )
    );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_h1_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_h1_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_h2_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h2_font_style_headline_control', array(
        'label'           => esc_html__( 'H2 Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h2_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h2_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h2_line_height_control', array(
                'label'         => esc_html__( 'H2 Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.45,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h2_font_style_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h2_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h2_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h2_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h2_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h2_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h2_color_setting',
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
            'apex_business_h2_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_h2_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

     // Headline Setting
    $wp_customize->add_setting( 'apex_business_h3_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h3_font_style_headline_control', array(
        'label'           => esc_html__( 'H3 Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h3_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h3_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h3_line_height_control', array(
                'label'         => esc_html__( 'H3 Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h3_font_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h3_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h3_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h3_text_transform_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h3_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h3_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h3_color_setting',
        array(
            'default'           =>  APEX_BUSINESS_TEXT_COLOR,
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
            'apex_business_h3_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_h3_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

     // Headline Setting
    $wp_customize->add_setting( 'apex_business_h4_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h4_font_style_headline_control', array(
        'label'           => esc_html__( 'H4 Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h4_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h4_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h4_line_height_control', array(
                'label'         => esc_html__( 'H4 Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.01,
                        'default_value' => 1.4,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h4_font_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h4_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h4_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h4_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h4_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h4_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h4_color_setting',
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
            'apex_business_h4_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_h4_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

     // Headline Setting
    $wp_customize->add_setting( 'apex_business_h5_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h5_font_style_headline_control', array(
        'label'           => esc_html__( 'H5 Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h5_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h5_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h5_line_height_control', array(
                'label'         => esc_html__( 'H5 Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet' => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h5_font_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h5_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h5_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h5_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h5_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h5_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h5_color_setting',
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
            'apex_business_h5_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_h5_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

     // Headline Setting
    $wp_customize->add_setting( 'apex_business_h6_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_h6_font_style_headline_control', array(
        'label'           => esc_html__( 'H6 Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_h6_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_h6_line_height_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_h6_line_height_control', array(
                'label'         => esc_html__( 'H6 Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 5,
                        'step'          => 0.01,
                        'default_value' => 1.5,
                    ),
                ),
                'priority' => 25,
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h6_font_style_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h6_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h6_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_h6_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           =>  'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_h6_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_h6_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_h6_color_setting',
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
            'apex_business_h6_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_h6_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

     // Headline Setting
    $wp_customize->add_setting( 'apex_business_blockquote_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_blockquote_font_style_headline_control', array(
        'label'           => esc_html__( 'Blockquote Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_blockquote_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_blockquote_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_blockquote_line_height_control', array(
                'label'         => esc_html__( 'Blockquote Line Height (px)', 'apex-business' ),
                'section'       => 'apex_business_typography_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 992,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_blockquote_font_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select ',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_blockquote_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_blockquote_font_style_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_blockquote_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_blockquote_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_blockquote_text_transform_setting',
                'type'        => 'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );


     $wp_customize->add_setting(
        'apex_business_typography_subsets_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_select',
            'default'           => 'latin',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Select_Multiple (
            $wp_customize, 'apex_business_typography_subsets_control', array(
                'section'           => 'apex_business_typography_settings_section',
                'label'             => esc_html__( 'Font Subsets', 'apex-business' ),
                'description'       => __( 'Select multiple options.', 'apex-business' ),
                'priority'          => 25,
                'choices'           => array(
                    'latin'         => __( 'latin', 'apex-business' ),
                    'latin-ext'     => __( 'latin-ext', 'apex-business' ),
                    'cyrillic'      => __( 'cyrillic', 'apex-business' ),
                    'cyrillic-ext'  => __( 'cyrillic-ext', 'apex-business' ),
                    'greek'         => __( 'greek', 'apex-business' ),
                    'greek-ext'     => __( 'greek-ext', 'apex-business' ),
                    'vietnamese'    => __( 'vietnamese', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_blockquote_color_setting',
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
            'apex_business_blockquote_color_control',
            array(
                'label'         => __( 'Font Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_typography_settings_section',
                'settings'      => 'apex_business_blockquote_color_setting',
                'show_opacity'  => false, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                )
            )
        )
    );

     // Headline Setting
    $wp_customize->add_setting( 'apex_business_link_font_style_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_link_font_style_headline_control', array(
        'label'           => esc_html__( 'link Font Style', 'apex-business' ),
        'section'         => 'apex_business_typography_settings_section',
        'settings'        => 'apex_business_link_font_style_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );


    $wp_customize->add_setting( 'apex_business_link_font_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_link_font_style_control', array(
                'label'       => __( 'Font Style', 'apex-business' ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_link_font_style_setting',
                'type'      =>  'select',
                'priority'  => 25,
                'choices'   =>  array(
                    'inherit'    =>  __( 'Normal', 'apex-business' ),
                    'italic'     =>  __( 'Italic', 'apex-business' ),
                ),
            )
        )
    );


    $wp_customize->add_setting( 'apex_business_link_text_transform_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           =>  'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_link_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                'description'       =>  sprintf( __( 'Goto %1$sColor%2$s Section to set link color.', 'apex-business' ),
                                            '<a href="javascript:wp.customize.section( \'colors\' ).focus();">',
                                            '</a>'
                                        ),
                'section'     => 'apex_business_typography_settings_section',
                'settings'    => 'apex_business_link_text_transform_setting',
                'type'        =>  'select',
                'priority'    => 25,
                'choices'     =>  array(
                    'inherit'       =>  __( 'Default', 'apex-business' ),
                    'uppercase'     =>  __( 'Uppercase', 'apex-business' ),
                    'lowercase'     =>  __( 'Lowercase', 'apex-business' ),
                    'capitalize'    =>  __( 'Capitalize', 'apex-business' ),
                ),
            )
        )
    );

}

add_action( 'customize_register', 'apex_business_typography_settings_setup');
