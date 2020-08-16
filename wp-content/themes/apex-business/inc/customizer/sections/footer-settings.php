<?php
/**
 * Add Customizer Options
 * [Footer And Bottom bar]
 */
function apex_business_footer_settings_setup( $wp_customize ) {
    $wp_customize->add_section( 'apex_business_footer_settings_section', array(
        'title'       =>  __( 'Footer', 'apex-business' ),
        'panel'       =>  'apex_business_footer_panel',
        'capability'  => 'edit_theme_options',
        'priority'    =>  10,
    ) );

    $wp_customize->add_setting(
        'apex_business_footer_columns_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'capability'        => 'edit_theme_options',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_footer_columns_control', array(
                'label'         => esc_html__( 'Footer Columns','apex-business' ),
                'section'       => 'apex_business_footer_settings_section',
                'type'          => 'range-value',
                'media_query'   => false,
                'priority'      => 25,
                'input_attr'    => array(
                    'desktop'  => array(
                        'min'           => 1,
                        'max'           => 4,
                        'step'          => 1,
                        'default_value' => 3,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_footer_bgcolor_comment_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_footer_bgcolor_comment_control', array(
        'label'           => esc_html__( 'Footer Background', 'apex-business' ),
        'section'         => 'apex_business_footer_settings_section',
        'settings'        => 'apex_business_footer_bgcolor_comment_setting',
        'type'            => 'hidden',
        'priority'        => 25,
      ) ) );

    $wp_customize->add_setting(
        'apex_business_footer_bgcolor_setting',
        array(
            'default'           => APEX_BUSINESS_TEXT_COLOR,
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
            'apex_business_footer_bgcolor_control',
            array(
                'label'         => __( 'Footer Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_footer_settings_section',
                'settings'      => 'apex_business_footer_bgcolor_setting',
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

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_footer_bgcolor_description_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_footer_bgcolor_description_control', array(
      'description'   => __( 'You can also use this option as overlay color if you set background image.', 'apex-business' ),
      'section'         => 'apex_business_footer_settings_section',
      'settings'        => 'apex_business_footer_bgcolor_description_setting',
      'type'            => 'hidden',
      'priority'        => 25,
    ) ) );

    $wp_customize->add_setting( 'apex_business_footer_bgimage_setting', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'postMessage',
        'default'           =>  get_template_directory_uri() . '/assets/images/banner.jpg',
        'sanitize_callback' => 'apex_business_validate_image',
    ) );

    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'apex_business_footer_bgimage_control',
           array(
               'label'      => __( 'Upload Footer Background Image', 'apex-business' ),
               'priority'   => 25,
               'section'    => 'apex_business_footer_settings_section',
               'settings'   => 'apex_business_footer_bgimage_setting',
           )
       )
    );

    $wp_customize->add_setting( 'apex_business_footer_bgimage_repeat_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'no-repeat',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_footer_bgimage_repeat_control', array(
                'label'             => __( 'Background Repeat', 'apex-business' ),
                'section'           => 'apex_business_footer_settings_section',
                'settings'          => 'apex_business_footer_bgimage_repeat_setting',
                'type'              =>  'select',
                'priority'          => 25,
                'choices'           =>  array(
                    'no-repeat'   =>  __( 'No Repeat', 'apex-business' ),
                    'repeat'      =>  __( 'Repeat All', 'apex-business' ),
                    'repeat-x'    =>  __( 'Repeat X', 'apex-business' ),
                    'repeat-y'    =>  __( 'Repeat Y', 'apex-business' ),
                    ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_footer_bgimage_size_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'auto',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_footer_bgimage_size_control', array(
                'label'             => __( 'Background Size', 'apex-business' ),
                'section'           => 'apex_business_footer_settings_section',
                'settings'          => 'apex_business_footer_bgimage_size_setting',
                'type'              =>  'select',
                'priority'          => 25,
                'choices'           =>  array(
                    'cover'     =>  __( 'Cover', 'apex-business' ),
                    'contain'   =>  __( 'Contain', 'apex-business' ),
                    'auto'      =>  __( 'Auto', 'apex-business' ),
                    ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_footer_bgimage_attachment_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'scroll',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_footer_bgimage_attachment_control', array(
                'label'             => __( 'Background Attachment', 'apex-business' ),
                'section'           => 'apex_business_footer_settings_section',
                'settings'          => 'apex_business_footer_bgimage_attachment_setting',
                'type'              =>  'select',
                'priority'          => 25,
                'choices'           =>  array(
                    'scroll'    =>  __( 'Scroll', 'apex-business' ),
                    'fixed'     =>  __( 'Fixed', 'apex-business' ),
                    ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_footer_style_comment_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_footer_style_comment_control', array(
        'label'           => esc_html__( 'Footer Style & colors', 'apex-business' ),
        'section'         => 'apex_business_footer_settings_section',
        'settings'        => 'apex_business_footer_style_comment_setting',
        'type'            => 'hidden',
        'priority'        => 25,
      ) ) );

    $wp_customize->add_setting(
        'apex_business_footer_top_border_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_footer_top_border_control', array(
                'label'         => esc_html__( 'Footer Top Border','apex-business' ),
                'section'       => 'apex_business_footer_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_footer_border_color_setting',
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
            'apex_business_footer_border_color_control',
            array(
                'label'         => __( 'Footer Top Border Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_footer_settings_section',
                'settings'      => 'apex_business_footer_border_color_setting',
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

    $wp_customize->add_setting( 'apex_business_f_menu_ul_switch_setting', array(
       'capability'        => 'edit_theme_options',
       'sanitize_callback' => 'absint',
       'default'           => true
    ) );
    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, '
        apex_business_f_menu_ul_switch_control', array(
       'label'       => __( 'Enable Footer Menu Underline?', 'apex-business' ),
       'section'     => 'apex_business_footer_settings_section',
       'settings'    => 'apex_business_f_menu_ul_switch_setting',
       'priority'    => 25,
       'type'        => 'ios',
    ) ) );

    $wp_customize->add_setting(
        'apex_business_footer_widget_title_bottom_margin_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_footer_widget_title_bottom_margin_control', array(
                'label'         => esc_html__( 'Widget Title Margin Bottom','apex-business' ),
                'section'       => 'apex_business_footer_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 40,
                    ),
                    'tablet'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 40,
                    ),
                    'desktop' => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 40,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_footer_widget_title_color_setting',
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
            'apex_business_footer_widget_title_color_control',
            array(
                'label'         => __( 'Widget Title Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_footer_settings_section',
                'settings'      => 'apex_business_footer_widget_title_color_setting',
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
        'apex_business_footer_widget_text_color_setting',
        array(
            'default'           => APEX_BUSINESS_WHITE_COLOR,
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
            'apex_business_footer_widget_text_color_control',
            array(
                'label'         => __( 'Widget Text Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_footer_settings_section',
                'settings'      => 'apex_business_footer_widget_text_color_setting',
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

    $wp_customize->add_setting(
        'apex_business_footer_widget_link_color_setting',
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
            'apex_business_footer_widget_link_color_control',
            array(
                'label'         => __( 'Widget link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_footer_settings_section',
                'settings'      => 'apex_business_footer_widget_link_color_setting',
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
        'apex_business_footer_widget_link_hover_color_setting',
        array(
            'default'           => APEX_BUSINESS_TEXT_COLOR,
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
            'apex_business_footer_widget_link_hover_color_control',
            array(
                'label'         => __( 'Widget Link Hover Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_footer_settings_section',
                'settings'      => 'apex_business_footer_widget_link_hover_color_setting',
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

    // If Premium
    if ( function_exists( 'apex_business_footer_widget_option_customizer' ) ) {
       apex_business_footer_widget_option_customizer( $wp_customize );
    }

    //Bottom bar section
    $wp_customize->add_section( 'apex_business_bottom_bar_settings_section', array(
        'title'       =>  __( 'Bottom Bar', 'apex-business' ),
        'panel'       =>  'apex_business_footer_panel',
        'capability'  => 'edit_theme_options',
        'priority'    =>  10,
    ) );

     $wp_customize->add_setting( 'apex_business_bottom_bar_switch_setting', array(
       'capability'        => 'edit_theme_options',
       'sanitize_callback' => 'absint',
       'default'           => true
    ) );

    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_bottom_bar_switch_control', array(
       'label'       => __( 'Enable & Disable Bottom Bar', 'apex-business' ),
       'section'     => 'apex_business_bottom_bar_settings_section',
       'settings'    => 'apex_business_bottom_bar_switch_setting',
       'priority'    => 25,
       'type'        => 'ios',
    ) ) );


    $wp_customize->add_setting(
        'apex_business_footer_layout_control', array(
            'default'           => 'default-bottom-bar',
            'sanitize_callback' => 'sanitize_key',
            'capability'        => 'edit_theme_options',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customize_Control_Radio_Image(
            $wp_customize, 'apex_business_footer_layout_control', array(
                'label'         => esc_html__( 'Bottom Bar Layout types', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_bottom_bar_settings_section',
                'choices'       => array(
                    'default-bottom-bar' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/footer-layout-1.png',
                        'label' => esc_html__( 'Default footer', 'apex-business' ),
                    ),
                    'center-bottom-bar'  => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/footer-layout-2.png',
                        'label' => esc_html__( 'Center footer', 'apex-business' ),
                    ),
                    'left-bottom-bar'  => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/footer-layout-3.png',
                        'label' => esc_html__( 'Widget footer', 'apex-business' ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_bottom_bar_bgcolor_setting',
        array(
            'default'           =>  APEX_BUSINESS_WHITE_COLOR,
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
            'apex_business_bottom_bar_bgcolor_control',
            array(
                'label'         => __( 'Bottom Bar Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_bottom_bar_settings_section',
                'settings'      => 'apex_business_bottom_bar_bgcolor_setting',
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
        'apex_business_bottom_bar_text_color_setting',
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
            'apex_business_bottom_bar_text_color_control',
            array(
                'label'         => __( 'Bottom Bar Text Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_bottom_bar_settings_section',
                'settings'      => 'apex_business_bottom_bar_text_color_setting',
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

    $wp_customize->add_setting(
        'apex_business_bottom_bar_link_color_setting',
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
            'apex_business_bottom_bar_link_color_control',
            array(
                'label'         => __( 'Bottom Bar Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_bottom_bar_settings_section',
                'settings'      => 'apex_business_bottom_bar_link_color_setting',
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

     $wp_customize->add_setting(
        'apex_business_bottom_bar_padding_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
            'capability'        => 'edit_theme_options',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_bottom_bar_padding_control', array(
                'label'         => esc_html__( 'Bottom Bar Vertical Spacing','apex-business' ),
                'section'       => 'apex_business_bottom_bar_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 14,
                        'max'           => 35,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'tablet'  => array(
                        'min'           => 14,
                        'max'           => 36,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'desktop' => array(
                        'min'           => 14,
                        'max'           => 36,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_bottom_bar_text_size_control', array(
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_bottom_bar_text_size_control', array(
                'label'         => esc_html__( 'Bottom Bar Text Size (px)','apex-business' ),
                'section'       => 'apex_business_bottom_bar_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 7,
                        'max'           => 35,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'tablet'  => array(
                        'min'           => 7,
                        'max'           => 36,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'desktop' => array(
                        'min'           => 7,
                        'max'           => 36,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_bottom_bar_menu_text_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_bottom_bar_menu_text_size_control', array(
                'label'         => esc_html__( 'Bottom Bar Menu Text Size (px)','apex-business' ),
                'section'       => 'apex_business_bottom_bar_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 7,
                        'max'           => 35,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'tablet'  => array(
                        'min'           => 7,
                        'max'           => 36,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                    'desktop' => array(
                        'min'           => 7,
                        'max'           => 36,
                        'step'          => 1,
                        'default_value' => 14,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_bottom_bar_content_control', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        /* translators: %1$s: Anchor link start %2$s: Anchor link end */
        'default'           => sprintf( __( 'Apex Business WordPress Theme | Designed by %1$sCrafthemes%2$s', 'apex-business' ),
                                    '<a href="https://www.crafthemes.com">',
                                    '</a>'
                                ),
    ) );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Page_Editor(
            $wp_customize, 'apex_business_bottom_bar_content_control', array(
                'label'     => esc_html__( 'Edit Footer Copyright Text', 'apex-business' ),
                'priority'  => 25,
                'section'   => 'apex_business_bottom_bar_settings_section',
            )
        )
    );

    $wp_customize->selective_refresh->add_partial( 'apex_business_bottom_bar_content_partial', array(
        'selector'            => '.copyright-content',
        'container_inclusive' => true,
        'settings'            => 'apex_business_bottom_bar_content_control',
    ) );

    $wp_customize->add_setting(
        'apex_business_bottom_bar_top_border_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_bottom_bar_top_border_control', array(
                'label'         => esc_html__( 'Footer Top Border','apex-business' ),
                'section'       => 'apex_business_bottom_bar_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_bottom_bar_border_color_setting',
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
            'apex_business_bottom_bar_border_color_control',
            array(
                'label'         => __( 'Footer Top Border Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_bottom_bar_settings_section',
                'settings'      => 'apex_business_bottom_bar_border_color_setting',
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

    $wp_customize->add_section( 'apex_business_back_to_top_settings_section', array(
        'title'       =>  __( 'Back To Top', 'apex-business' ),
        'panel'       =>  'apex_business_footer_panel',
        'capability'  => 'edit_theme_options',
        'priority'    =>  10,
    ) );

    $wp_customize->add_setting( 'apex_business_back_to_top_switch_setting', array(
       'capability'        => 'edit_theme_options',
       'sanitize_callback' => 'absint',
       'default'           => true
    ) );
   $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_back_to_top_switch_control', array(
       'label'       => __( 'Enable Back To Top?', 'apex-business' ),
       'section'     => 'apex_business_back_to_top_settings_section',
       'settings'    => 'apex_business_back_to_top_switch_setting',
       'priority'    => 25,
       'type'        => 'ios',
    ) ) );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_back_to_top_border_radius_control', array(
                'label'         => esc_html__( 'Border Radius (px)','apex-business' ),
                'section'       => 'apex_business_back_to_top_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                ),
                'active_callback'=>'apex_business_flag_back_to_top_disabled',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_back_to_top_bgcolor_setting',
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
            'apex_business_back_to_top_bgcolor_control',
            array(
                'label'         => __( 'Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_back_to_top_settings_section',
                'settings'      => 'apex_business_back_to_top_bgcolor_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                ),
                'active_callback'=>'apex_business_flag_back_to_top_disabled',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_back_to_top_icon_color_setting',
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
            'apex_business_back_to_top_icon_color_control',
            array(
                'label'         => __( 'Icon Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_back_to_top_settings_section',
                'settings'      => 'apex_business_back_to_top_icon_color_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR // Mix of color types = no problem
                ),
                'active_callback'=>'apex_business_flag_back_to_top_disabled',
            )
        )
    );

    // If Premium
    if ( function_exists( 'apex_business_btt_icon_img_option_customizer' ) ) {
       apex_business_btt_icon_img_option_customizer( $wp_customize );
    }
}

add_action( 'customize_register', 'apex_business_footer_settings_setup');
