<?php
/**
 * Add Customizer Options
 * [Sidebar]
 */
function apex_business_sidebar_settings_setup( $wp_customize ) {

    $wp_customize->add_section( 'apex_business_sidebar_settings_section', array(
        'title'       =>  __( 'Sidebar', 'apex-business' ),
        'capability'  => 'edit_theme_options',
        'priority'    =>  10,
    ) );

    $wp_customize->add_setting(
        'apex_business_sidebar_settings_tabs_control', array(
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Tabs_Control(
            $wp_customize, 'apex_business_sidebar_settings_tabs_control', array(
                /* Make sure you edit the following parameters*/
                'section' => 'apex_business_sidebar_settings_section',
                'tabs'    => array(
                    'sidebar'           => array(
                        'nicename' => esc_html__( 'Sidebar Layout', 'apex-business' ),
                        'icon'     => 'font',
                        'controls' => array(
                            'apex_business_default_sidebar_layout_control',
                            'apex_business_page_sidebar_layout_control',
                            'apex_business_single_sidebar_layout_control',
                            'apex_business_archive_sidebar_layout_control',
                        ),
                    ),
                    'sidebar-style '    => array(
                        'nicename' => esc_html__( 'Sidebar Style', 'apex-business' ),
                        'icon'     => 'style',
                        'controls' => array(
                            'apex_business_sidebar_width_control',
                            'apex_business_sidebar_bg_color_control',
                            'apex_business_sidebar_padding_control',
                        ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_default_sidebar_layout_control', array(
            'capability'        => 'edit_theme_options',
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customize_Control_Radio_Image(
            $wp_customize, 'apex_business_default_sidebar_layout_control', array(
                'label'         => esc_html__( 'Default Sidebar layout', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_sidebar_settings_section',
                'choices'       => array(
                    'no-sidebar'    => array(
                        'url'    => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/full-width.png',
                        'label'  => esc_html__( 'No Sidebar', 'apex-business' ),
                    ),
                    'right-sidebar' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-right.png',
                        'label' => esc_html__( 'Right Sidebar', 'apex-business' ),
                    ),
                    'left-sidebar'  => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-left.png',
                        'label' => esc_html__( 'Left Sidebar', 'apex-business' ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_single_sidebar_layout_control', array(
            'default'           => 'no-sidebar',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customize_Control_Radio_Image(
            $wp_customize, 'apex_business_single_sidebar_layout_control', array(
                'label'     => esc_html__( 'Single Post Sidebar layout', 'apex-business' ),
                'priority'  => 25,
                'section'   => 'apex_business_sidebar_settings_section',
                'choices'   => array(
                    'no-sidebar'    => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/full-width.png',
                        'label' => esc_html__( 'No Sidebar', 'apex-business' ),
                    ),
                    'right-sidebar' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-right.png',
                        'label' => esc_html__( 'Right Sidebar', 'apex-business' ),
                    ),
                    'left-sidebar'  => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-left.png',
                        'label' => esc_html__( 'Left Sidebar', 'apex-business' ),
                    ),
                    'center-content' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/both-center.png',
                        'label' => esc_html__( 'Content Center No Sidebar', 'apex-business' ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_page_sidebar_layout_control', array(
            'default'           => 'right-sidebar',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customize_Control_Radio_Image(
            $wp_customize, 'apex_business_page_sidebar_layout_control', array(
                'label'     => esc_html__( 'Single Page Sidebar layout', 'apex-business' ),
                'priority'  => 25,
                'section'   => 'apex_business_sidebar_settings_section',
                'choices'   => array(
                    'no-sidebar'     => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/full-width.png',
                        'label' => esc_html__( 'No Sidebar', 'apex-business' ),
                    ),
                    'right-sidebar'  => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-right.png',
                        'label' => esc_html__( 'Right Sidebar', 'apex-business' ),
                    ),
                    'left-sidebar'   => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-left.png',
                        'label' => esc_html__( 'Left Sidebar', 'apex-business' ),
                    ),
                    'center-content' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/both-center.png',
                        'label' => esc_html__( 'Content Center No Sidebar', 'apex-business' ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_archive_sidebar_layout_control', array(
            'default'           => 'no-sidebar',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customize_Control_Radio_Image(
            $wp_customize, 'apex_business_archive_sidebar_layout_control', array(
                'label'         => esc_html__( 'Archive Page Sidebar layout', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_sidebar_settings_section',
                'choices'       => array(
                    'no-sidebar'    => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/full-width.png',
                        'label' => esc_html__( 'No Sidebar', 'apex-business' ),
                    ),
                    'right-sidebar' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-right.png',
                        'label' => esc_html__( 'Right Sidebar', 'apex-business' ),
                    ),
                    'left-sidebar'  => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/sidebar-left.png',
                        'label' => esc_html__( 'Left Sidebar', 'apex-business' ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_sidebar_width_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_sidebar_width_control', array(
                'label'         => esc_html__( 'Sidebar Width (%)','apex-business' ),
                'section'       => 'apex_business_sidebar_settings_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => false,
                'input_attr'    => array(
                    'desktop'  => array(
                        'min'           => 15,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 33,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_sidebar_bg_color_setting',
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
            'apex_business_sidebar_bg_color_control',
            array(
                'label'         => __( 'Sidebar Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_sidebar_settings_section',
                'settings'      => 'apex_business_sidebar_bg_color_setting',
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
}

add_action( 'customize_register', 'apex_business_sidebar_settings_setup');
