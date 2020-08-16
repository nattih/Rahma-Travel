<?php
/**
 * Basic Customizer Options
 */

/*******************************************************************************
 * Register Panels
 ******************************************************************************/
function apex_business_register_panels_setup( $wp_customize ) {
    $wp_customize->add_panel( 'apex_business_general_panel', array(
        'capability'    => 'edit_theme_options',
        'title'         => __( 'General Settings', 'apex-business' ),
        'priority'      => 10,
    ) );

    $wp_customize->add_panel( 'apex_business_header_panel', array(
        'capability'    => 'edit_theme_options',
        'title'         => __( 'Header', 'apex-business' ),
        'priority'      => 2,
    ) );

    $wp_customize->add_panel( 'apex_business_footer_panel', array(
        'capability'    => 'edit_theme_options',
        'title'         => __( 'Footer & Bottom Bar', 'apex-business' ),
        'priority'      => 10,
    ) );

    $wp_customize->add_panel( 'apex_business_blog_panel', array(
        'capability'    => 'edit_theme_options',
        'title'         => __( 'Blog', 'apex-business' ),
        'priority'      => 10,
    ) );

    $wp_customize->add_panel( 'apex_business_breadcrumb_panel', array(
        'capability'    => 'edit_theme_options',
        'title'         => __( 'Breadcrumb', 'apex-business' ),
        'priority'      => 10,
    ) );
}

add_action( 'customize_register', 'apex_business_register_panels_setup');

/*******************************************************************************
 * Accent Color
 ******************************************************************************/

function apex_business_accent_color_setup( $wp_customize ) {

  /******************************** Primary Color *****************************/
    $wp_customize->add_setting( 'apex_business_primary_color_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => APEX_BUSINESS_PRIMARY_COLOR,
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'apex_business_primary_color_control', array(
      'section'  => 'colors',
      'label'    => esc_html__( 'Primary Color', 'apex-business' ),
      'settings' =>  'apex_business_primary_color_setting',
    ) ) );

    $wp_customize->add_setting( 'apex_business_link_color_setting', array(
        'default'           => APEX_BUSINESS_PRIMARY_COLOR,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'apex_business_sanitize_alpha_color',
        'transport'         => 'postMessage'
    ) );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_link_color_control',
            array(
                'label'         => __( 'Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'colors',
                'settings'      => 'apex_business_link_color_setting',
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

    $wp_customize->add_setting( 'apex_business_link_hover_color_setting', array(
        'default'           => APEX_BUSINESS_HOVER_COLOR,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'apex_business_sanitize_alpha_color',
        'transport'         => 'postMessage'
    ) );

    // Alpha Color Picker control.
    $wp_customize->add_control(
        new Apex_Business_Customizer_Alpha_Color_Control(
            $wp_customize,
            'apex_business_link_hover_color_control',
            array(
                'label'         => __( 'Link Hover Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'colors',
                'settings'      => 'apex_business_link_hover_color_setting',
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

  /******************************** Site Description Switch *****************************/
    $wp_customize->add_setting( 'apex_business_transparent_header_logo_setting', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    'default'           => false
    ) );

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'apex_business_transparent_header_logo_control', array(
        'label'         =>  __( 'Transparent Header logo', 'apex-business' ),
        'section'       =>  'title_tagline',
        'settings'      =>  'apex_business_transparent_header_logo_setting',
        'flex_width'    =>  true,
        'flex_height'   =>  true,
        'width'         =>  220,
        'height'        =>  55,
    ) ) );

  $wp_customize->add_setting( 'apex_business_site_description_switch_setting', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    'default'           => false
  ) );

  $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_site_description_switch_control', array(
        'label'       => __( 'Enable Site Tagline?', 'apex-business' ),
        'section'     => 'title_tagline',
        'settings'    => 'apex_business_site_description_switch_setting',
        'type'        => 'ios',
      ) ) );
}

add_action( 'customize_register', 'apex_business_accent_color_setup');
