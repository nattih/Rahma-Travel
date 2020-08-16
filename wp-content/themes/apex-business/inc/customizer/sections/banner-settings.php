<?php
/**
 * Add Customizer Options
 * [Button]
 */
function apex_business_banner_settings_setup( $wp_customize ) {

    $wp_customize->add_section( 'apex_business_banner_settings_section', array(
        'capability'  => 'edit_theme_options',
        'title'       =>  __( 'Banner', 'apex-business' ),
        'panel'       =>  'apex_business_general_panel'
    ) );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_blog_banner_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize, 'apex_business_blog_banner_headline_control', array(
            'label'           => esc_html__( 'Blog Page Banner', 'apex-business' ),
            'section'         => 'apex_business_banner_settings_section',
            'settings'        => 'apex_business_blog_banner_headline_setting',
            'type'            => 'hidden',
        )
      )
    );

    $wp_customize->add_setting( 'apex_business_blog_banner_content_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Blog', 'apex-business' ),
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_blog_banner_content_control',
            array(
                'label'           => __( 'Blog Page Headline', 'apex-business' ),
                'section'         => 'apex_business_banner_settings_section',
                'settings'        => 'apex_business_blog_banner_content_setting',
                'type'            => 'text',
            )
        )
    );

    $wp_customize->selective_refresh->add_partial( 'apex_business_blog_banner_content_partial', array(
        'selector'            => '.banner-content',
        'container_inclusive' => true,
        'settings'            => 'apex_business_blog_banner_content_setting',
    ) );

    $wp_customize->add_setting(
        'apex_business_blog_banner_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_blog_banner_font_size_control', array(
                'label'         => esc_html__( 'Font Size', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'           => 1,
                        'default_value' => 34,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 48,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_blog_banner_image_setting', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_validate_image',
        'default'           => get_template_directory_uri() . '/assets/images/banner.jpg',
    ) );

    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'apex_business_blog_banner_image_control',
           array(
               'label'      => __( 'Upload Blog Banner Image', 'apex-business' ),
               'section'    => 'apex_business_banner_settings_section',
               'settings'   => 'apex_business_blog_banner_image_setting',
           )
       )
    );

    $wp_customize->add_setting( 'apex_business_banner_image_repeat_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'no-repeat',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_banner_image_repeat_control', array(
            'label'           => __( 'Background Repeat', 'apex-business' ),
            'section'         => 'apex_business_banner_settings_section',
            'settings'        => 'apex_business_banner_image_repeat_setting',
            'type'            => 'select',
            'choices'   =>  array(
                'no-repeat'     =>  __( 'No Repeat', 'apex-business' ),
                'repeat'        =>  __( 'Repeat All', 'apex-business' ),
                'repeat-x'      =>  __( 'Repeat X', 'apex-business' ),
                'repeat-y'      =>  __( 'Repeat Y', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_blog_banner_size_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'auto',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_blog_banner_size_control', array(
            'label'           => __( 'Background Size', 'apex-business' ),
            'section'         => 'apex_business_banner_settings_section',
            'settings'        => 'apex_business_blog_banner_size_setting',
            'type'            =>  'select',
            'choices'         =>  array(
                'cover'       =>  __( 'Cover', 'apex-business' ),
                'contain'     =>  __( 'Contain', 'apex-business' ),
                'auto'        =>  __( 'Auto', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_banner_image_attachment_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'scroll',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_banner_image_attachment_control', array(
            'label'       => __( 'Background Attachment', 'apex-business' ),
            'section'     => 'apex_business_banner_settings_section',
            'settings'    => 'apex_business_banner_image_attachment_setting',
            'type'        => 'select',
            'choices'   =>  array(
                'scroll'    =>  __( 'Scroll', 'apex-business' ),
                'fixed'     =>  __( 'Fixed', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_banner_bg_color_setting',
        array(
            'default'           => APEX_BUSINESS_OPACITY_BG_COLOR,
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
            'apex_business_banner_bg_color_control',
            array(
                'label'         => __( 'Banner Color', 'apex-business' ),
                'description'   => __( 'You can also use this option as overlay color if you set background image.', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'settings'      => 'apex_business_banner_bg_color_setting',
                'show_opacity'  => true, // Optional.
                'palette'       => array(
                    APEX_BUSINESS_DEFAULT1_COLOR, // RGB, RGBa, and hex values supported
                    APEX_BUSINESS_DEFAULT2_COLOR,
                    APEX_BUSINESS_DEFAULT3_COLOR, // Different spacing = no problem
                    APEX_BUSINESS_DEFAULT4_COLOR, // Mix of color types = no problem
                )
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_banner_text_color_setting',
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
            'apex_business_banner_text_color_control',
            array(
                'label'         => __( 'Text Color', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'settings'      => 'apex_business_banner_text_color_setting',
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
        'apex_business_blog_banner_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_blog_banner_height_control', array(
                'label'         => esc_html__( 'Banner Height', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 150,
                    ),
                    'tablet'  => array(
                        'min'           => 10,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 200,
                    ),
                    'desktop' => array(
                        'min'           => 100,
                        'max'           => 1200,
                        'step'          => 1,
                        'default_value' => 450,
                    ),
                ),
            )
        )
    );

    // Headline Settings
    $wp_customize->add_setting( 'apex_business_archive_banner_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize, 'apex_business_archive_banner_headline_control', array(
            'label'           => esc_html__( 'Archive Page Banner', 'apex-business' ),
            'section'         => 'apex_business_banner_settings_section',
            'settings'        => 'apex_business_archive_banner_headline_setting',
            'type'            => 'hidden',
        )
      )
    );

    $wp_customize->add_setting( 'apex_business_archive_banner_disable_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'default'           => true
    ) );

    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control(
        $wp_customize, 'apex_business_archive_banner_disable_control',
            array(
                'label'       => __( 'Enable Archive Banner?', 'apex-business' ),
                'section'     => 'apex_business_banner_settings_section',
                'settings'    => 'apex_business_archive_banner_disable_setting',
                'type'        => 'ios',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_archive_banner_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_archive_banner_font_size_control', array(
                'label'         => esc_html__( 'Font Size', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'           => 1,
                        'default_value' => 34,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 48,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_archive_banner_image_setting', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_validate_image',
        'default'           => get_template_directory_uri() . '/assets/images/banner.jpg',
    ) );

    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'apex_business_archive_banner_image_control',
           array(
               'label'      => __( 'Upload Archive Banner Image', 'apex-business' ),
               'section'    => 'apex_business_banner_settings_section',
               'settings'   => 'apex_business_archive_banner_image_setting',
           )
       )
    );

    $wp_customize->add_setting( 'apex_business_archive_image_repeat_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'no-repeat',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_archive_image_repeat_control', array(
            'label'       => __( 'Background Repeat', 'apex-business' ),
            'section'     => 'apex_business_banner_settings_section',
            'settings'    => 'apex_business_archive_image_repeat_setting',
            'type'      =>  'select',
            'choices'   =>  array(
                'no-repeat'     =>  __( 'No Repeat', 'apex-business' ),
                'repeat'        =>  __( 'Repeat All', 'apex-business' ),
                'repeat-x'      =>  __( 'Repeat X', 'apex-business' ),
                'repeat-y'      =>  __( 'Repeat Y', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_blog_archive_size_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'auto',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_blog_archive_size_control', array(
                'label'       => __( 'Background Size', 'apex-business' ),
                'section'     => 'apex_business_banner_settings_section',
                'settings'    => 'apex_business_blog_archive_size_setting',
                'type'        => 'select',
                'choices'     =>  array(
                    'cover'       =>  __( 'Cover', 'apex-business' ),
                    'contain'     =>  __( 'Contain', 'apex-business' ),
                    'auto'        =>  __( 'Auto', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_archive_image_attachment_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'scroll',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_archive_image_attachment_control', array(
            'label'       => __( 'Background Attachment', 'apex-business' ),
            'section'     => 'apex_business_banner_settings_section',
            'settings'    => 'apex_business_archive_image_attachment_setting',
            'type'        => 'select',
            'choices'   =>  array(
                'scroll'    =>  __( 'Scroll', 'apex-business' ),
                'fixed'     =>  __( 'Fixed', 'apex-business' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_archive_bg_color_setting',
        array(
            'default'           => APEX_BUSINESS_OPACITY_BG_COLOR,
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
            'apex_business_archive_bg_color_control',
            array(
                'label'         => __( 'Banner Color', 'apex-business' ),
                'description'   => __( 'You can also use this option as overlay color if you set background image.', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'settings'      => 'apex_business_archive_bg_color_setting',
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
        'apex_business_archive_text_color_setting',
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
            'apex_business_archive_text_color_control',
            array(
                'label'         => __( 'Text Color', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'settings'      => 'apex_business_archive_text_color_setting',
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
        'apex_business_archive_banner_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_archive_banner_height_control', array(
                'label'         => esc_html__( 'Banner Height', 'apex-business' ),
                'section'       => 'apex_business_banner_settings_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 150,
                    ),
                    'tablet'  => array(
                        'min'           => 10,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 200,
                    ),
                    'desktop' => array(
                        'min'           => 100,
                        'max'           => 1200,
                        'step'          => 1,
                        'default_value' => 450,
                    ),
                ),
            )
        )
    );
}

add_action( 'customize_register', 'apex_business_banner_settings_setup');
