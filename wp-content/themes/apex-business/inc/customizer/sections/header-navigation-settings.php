<?php
/**
 * Add Customizer Options
 * [Header & navigation]
 */

function apex_business_header_navigation_settings_setup( $wp_customize ) {
    $wp_customize->add_section( 'apex_business_header_navigation_section', array(
        'title'       =>  __( 'Primary Header', 'apex-business' ),
        'priority'    =>  10,
        'capability'  => 'edit_theme_options',
        'panel'       =>  'apex_business_header_panel'
    ) );

    $wp_customize->add_setting(
        'apex_business_navigation_header_tabs_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Tabs_Control(
            $wp_customize, 'apex_business_navigation_header_tabs_control', array(
                /* Make sure you edit the following parameters*/
                'section' => 'apex_business_header_navigation_section',
                'tabs'    => array(
                    'primary_header' => array(
                        'nicename' => esc_html__( 'Primary Header', 'apex-business' ),
                        'icon'     => 'font',
                        'controls' => array(
                            'apex_business_header_layout_control',
                            'apex_business_sticky_header_switch_control',
                            'apex_business_transparent_header_switch_control',
                            'apex_business_navigation_padding_control',
                            'apex_business_navigation_last_item_control',
                            'apex_business_logo_vertical_spacing_control',
                            'apex_business_navigation_last_button_text_control',
                            'apex_business_navigation_last_button_link_control',
                        ),
                    ),
                    'primary_navigation '   => array(
                        'nicename' => esc_html__( 'Header Style', 'apex-business' ),
                        'icon'     => 'text-height',
                        'controls' => array(
                            'apex_business_nav_menu_height_control',
                            'apex_business_header_logo_height_control',
                            'apex_business_nav_text_size_control',
                            'apex_business_nav_line_height_control',
                            'apex_business_nav_letter_spacing_control',
                            'apex_business_header_nav_font_style_control',
                            'apex_business_header_font_headline_control',
                            'apex_business_header_font_family_control',
                            'apex_business_header_font_size_control',
                            'apex_business_header_font_weight_control',
                            'apex_business_header_line_height_control',
                            'apex_business_header_font_style_control',
                            'apex_business_header_text_transform_control',
                            'apex_business_header_color_headline_control',
                            'apex_business_header_bgcolor_control',
                            'apex_business_header_text_color_control',
                            'apex_business_header_link_hover_color_control',
                            'apex_business_header_link_color_control',
                            'apex_business_header_dropdown_color_control',
                            'apex_business_dropdown_animation_control',
                            'apex_business_nav_link_rl_padding_control',
                            'apex_business_header_text_logo_color_control',
                            'apex_business_header_dropdown_hover_color_control',
                            'apex_business_header_mobile_header_control',
                            'apex_business_header_mobile_header_icon_color_control',
                            'apex_business_header_dd_spacing_control',
                        ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_header_layout_control', array(
            'default'           => 'default',
            'sanitize_callback' => 'sanitize_key',
            'capability'        => 'edit_theme_options',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customize_Control_Radio_Image(
            $wp_customize, 'apex_business_header_layout_control', array(
                'label'     => esc_html__( 'Header Layout types', 'apex-business' ),
                'priority'  => 25,
                'section'   => 'apex_business_header_navigation_section',
                'choices'   => array(
                    'default' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/default-header.png',
                        'label' => esc_html__( 'Default Header', 'apex-business' ),
                    ),
                    'center' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/center-header.png',
                        'label' => esc_html__( 'Center Header', 'apex-business' ),
                    ),
                    'widget' => array(
                        'url'   => trailingslashit( get_template_directory_uri() ) . '/inc/customizer/customizer-radio-image/img/widget-header.png',
                        'label' => esc_html__( 'Widget Header', 'apex-business' ),
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_sticky_header_switch_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'default'           => false
    ) );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Toggle_Control(
            $wp_customize, 'apex_business_sticky_header_switch_control',
            array(
                'label'       => __( 'Enable Sticky header?', 'apex-business' ),
                /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                'description'       =>  sprintf( __( 'Goto %1$sFixed Header%2$s Section to style your Sticky header.', 'apex-business' ),
                                            '<a href="javascript:wp.customize.section( \'apex_business_fixed_header_section\' ).focus();">',
                                            '</a>'
                                        ),
                'priority'    => 25,
                'section'     => 'apex_business_header_navigation_section',
                'settings'    => 'apex_business_sticky_header_switch_setting',
                'type'        => 'ios',
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_navigation_last_item_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'none',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_navigation_last_item_control', array(
            'label'         => __( 'Menu Last Item Type', 'apex-business' ),
            'section'       => 'apex_business_header_navigation_section',
            'settings'      => 'apex_business_navigation_last_item_setting',
            'type'          => 'select',
            'priority'      => 25,
            'choices'       =>  array(
                    'none'          =>  __( 'None', 'apex-business' ),
                    'search-icon'   =>  __( 'Search Icon', 'apex-business' ),
                    'button'        =>  __( 'Button', 'apex-business' ),
                  ),
    ) ) );

    $wp_customize->add_setting( 'apex_business_navigation_last_button_text_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Click Here', 'apex-business' ),
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_navigation_last_button_text_control',
            array(
                'label'             => __( 'Button Text', 'apex-business' ),
                /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                'description'       =>  sprintf( __( 'Goto %1$sButton Style%2$s Section to style this button.', 'apex-business' ),
                                            '<a href="javascript:wp.customize.section( \'apex_business_button_settings_section\' ).focus();">',
                                            '</a>'
                                        ),
                'section'           => 'apex_business_header_navigation_section',
                'settings'          => 'apex_business_navigation_last_button_text_setting',
                'priority'          => 25,
                'type'              => 'text',
                'active_callback'   => 'apex_business_last_item_type',
            )
        )
    );

    $wp_customize->selective_refresh->add_partial( 'apex_business_navigation_last_button_text_partial', array(
        'selector'            => '.ct-button.nav-button',
        'container_inclusive' => true,
        'settings'            => 'apex_business_navigation_last_button_text_setting',
    ) );

    $wp_customize->add_setting( 'apex_business_navigation_last_button_link_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( '#', 'apex-business' ),
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_navigation_last_button_link_control',
            array(
                'label'           => __( 'Button Link', 'apex-business' ),
                'section'         => 'apex_business_header_navigation_section',
                'settings'        => 'apex_business_navigation_last_button_link_setting',
                'priority'      => 25,
                'type'            => 'text',
                'active_callback'  => 'apex_business_last_item_type',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_navigation_padding_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_navigation_padding_control', array(
                'label'         => esc_html__( 'Header Padding (px)','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 300,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_logo_vertical_spacing_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_logo_vertical_spacing_control', array(
                'label'         => esc_html__( 'Header Vertical Spacing (px)','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 300,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                ),
            )
        )
    );



    $wp_customize->add_setting(
        'apex_business_header_logo_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_header_logo_height_control', array(
                'label'         => esc_html__( 'Logo Size','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_nav_text_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_nav_text_size_control', array(
                'label'         => esc_html__( 'Header Logo Text Size (px)','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 26,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 34,
                    ),
                    'desktop' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                        'default_value' => 38,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_nav_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_nav_line_height_control', array(
                'label'         => esc_html__( 'Header Line Height (px)','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.5,
                    ),
                ),
            )
        )
    );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_header_font_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_header_font_headline_control', array(
                'label'           => esc_html__( 'Navigation Typography', 'apex-business' ),
                'section'         => 'apex_business_header_navigation_section',
                'settings'        => 'apex_business_header_font_headline_setting',
                'type'            => 'hidden',
                'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_header_dd_spacing_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_header_dd_spacing_control', array(
                'label'         => esc_html__( 'Dropdown Link Spacing', 'apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'    => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 2,
                    ),
                    'tablet'    => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 3,
                    ),
                    'desktop'   => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 5,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_header_font_family_control', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Font_Selector(
            $wp_customize, 'apex_business_header_font_family_control', array(
                'label'             => esc_html__( 'Header Font Family', 'apex-business' ),
                'section'           => 'apex_business_header_navigation_section',
                'priority'          => 25,
                'type'              => 'select',
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_header_font_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_header_font_size_control', array(
                'label'         => esc_html__( 'Header Font Size (px)', 'apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
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

    $wp_customize->add_setting( 'apex_business_header_font_weight_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_header_font_weight_control', array(
            'label'       => __( 'Font Weight', 'apex-business' ),
            'section'     => 'apex_business_header_navigation_section',
            'settings'    => 'apex_business_header_font_weight_setting',
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
        'apex_business_header_line_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_header_line_height_control', array(
                'label'             => esc_html__( 'Header Line Height (px)', 'apex-business' ),
                'section'           => 'apex_business_header_navigation_section',
                'type'              => 'range-value',
                'media_query'       => true,
                'priority'          => 25,
                'input_attr'        => array(
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

    $wp_customize->add_setting( 'apex_business_header_font_style_setting', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'apex_business_header_font_style_control', array(
            'label'       => __( 'Font Style', 'apex-business' ),
            'section'     => 'apex_business_header_navigation_section',
            'settings'    => 'apex_business_header_font_style_setting',
            'type'        =>  'select',
            'priority'    => 25,
            'choices'     =>  array(
                    'inherit'     =>  __( 'Normal', 'apex-business' ),
                    'italic'      =>  __( 'Italic', 'apex-business' ),
                  ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_header_text_transform_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_header_text_transform_control', array(
                'label'       => __( 'Text Transform', 'apex-business' ),
                'section'     => 'apex_business_header_navigation_section',
                'settings'    => 'apex_business_header_text_transform_setting',
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
        'apex_business_nav_letter_spacing_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_nav_letter_spacing_control', array(
                'label'         => esc_html__( 'Header Letter Spacing (px)','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -1,
                        'max'           => 10,
                        'step'          => 0.1,
                        'default_value' => .1,
                    ),
                    'tablet'  => array(
                        'min'           => -1,
                        'max'           => 10,
                        'step'          => 0.1,
                        'default_value' => .1,
                    ),
                    'desktop' => array(
                        'min'           => -1,
                        'max'           => 10,
                        'step'          => 0.1,
                        'default_value' => .1,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_nav_menu_height_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_nav_menu_height_control', array(
                'label'         => esc_html__( 'Menu Vertical Spacing','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 24,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 300,
                        'step'          => 1,
                        'default_value' => 24,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 24,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_nav_link_rl_padding_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_nav_link_rl_padding_control', array(
                'label'         => esc_html__( 'Menu Horizontal Spacing','apex-business' ),
                'section'       => 'apex_business_header_navigation_section',
                'type'          => 'range-value',
                'priority'      => 25,
                'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'tablet'  => array(
                        'min'           => 300,
                        'max'           => 992,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 200,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                ),
            )
        )
    );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_header_color_headline_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_header_color_headline_control', array(
        'label'           => esc_html__( 'Colors', 'apex-business' ),
        'section'         => 'apex_business_header_navigation_section',
        'settings'        => 'apex_business_header_color_headline_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_header_text_logo_color_setting',
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
            'apex_business_header_text_logo_color_control',
            array(
                'label'         => __( 'Text Logo Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_text_logo_color_setting',
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
        'apex_business_header_bgcolor_setting',
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
            'apex_business_header_bgcolor_control',
            array(
                'label'         => __( 'Header Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_bgcolor_setting',
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
        'apex_business_header_text_color_setting',
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
            'apex_business_header_text_color_control',
            array(
                'label'         => __( 'Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_text_color_setting',
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
        'apex_business_header_link_color_setting',
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
            'apex_business_header_link_color_control',
            array(
                'label'         => __( 'Active Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_link_color_setting',
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
        'apex_business_header_link_hover_color_setting',
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
            'apex_business_header_link_hover_color_control',
            array(
                'label'         => __( 'Hover Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_link_hover_color_setting',
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
        'apex_business_header_dropdown_color_setting',
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
            'apex_business_header_dropdown_color_control',
            array(
                'label'         => __( 'Dropdown Text Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_dropdown_color_setting',
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
        'apex_business_header_dropdown_hover_color_setting',
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
            'apex_business_header_dropdown_hover_color_control',
            array(
                'label'         => __( 'Dropdown Hover Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_dropdown_hover_color_setting',
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

    // Mobile Menu customization
    // Headline Setting
    $wp_customize->add_setting( 'apex_business_header_mobile_header_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'apex_business_header_mobile_header_control', array(
        'label'           => esc_html__( 'Mobile Menu', 'apex-business' ),
        'section'         => 'apex_business_header_navigation_section',
        'settings'        => 'apex_business_header_mobile_header_setting',
        'type'            => 'hidden',
        'priority'        => 25,
    ) ) );

    $wp_customize->add_setting(
        'apex_business_header_mobile_header_icon_color_setting',
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
            'apex_business_header_mobile_header_icon_color_control',
            array(
                'label'         => __( 'Mobile menu icon Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_header_navigation_section',
                'settings'      => 'apex_business_header_mobile_header_icon_color_setting',
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


    // Fixed Header customization
    $wp_customize->add_section( 'apex_business_fixed_header_section', array(
        'title'       =>  __( 'Fixed Header', 'apex-business' ),
        'priority'    =>  25,
        'capability'  => 'edit_theme_options',
        'panel'       =>  'apex_business_header_panel'
    ) );

    $wp_customize->add_setting(
        'apex_business_fixed_navigation_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_fixed_navigation_control', array(
                'label'         => esc_html__( 'Fixed Header Height', 'apex-business' ),
                'section'       => 'apex_business_fixed_header_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 150,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'tablet'  => array(
                        'min'           => 10,
                        'max'           => 150,
                        'step'           => 1,
                        'default_value' => 10,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 150,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_fixed_logo_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_fixed_logo_size_control', array(
                'label'         => esc_html__( 'Fixed Logo Size','apex-business' ),
                'section'       => 'apex_business_fixed_header_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 1000,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 1000,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 1000,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_fixed_text_logo_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_fixed_text_logo_size_control', array(
                'label'         => esc_html__( 'Fixed Text Logo Size', 'apex-business' ),
                'section'       => 'apex_business_fixed_header_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 32,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 32,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 32,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_fixed_header_text_logo_color_setting',
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
            'apex_business_fixed_header_text_logo_color_control',
            array(
                'label'         => __( 'Text Logo Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_fixed_header_section',
                'settings'      => 'apex_business_fixed_header_text_logo_color_setting',
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
        'apex_business_fixed_header_bgcolor_setting',
        array(
            'default'           =>  APEX_BUSINESS_WHITE_COLOR,
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
            'apex_business_fixed_header_bgcolor_control',
            array(
                'label'         => __( 'Fixed Header Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_fixed_header_section',
                'settings'      => 'apex_business_fixed_header_bgcolor_setting',
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
        'apex_business_fixed_nav_link_color_setting',
        array(
            'default'           =>  APEX_BUSINESS_TEXT_COLOR,
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
            'apex_business_fixed_nav_link_color_control',
            array(
                'label'         => __( 'Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_fixed_header_section',
                'settings'      => 'apex_business_fixed_nav_link_color_setting',
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

    //Transparent Header

    $wp_customize->add_section( 'apex_business_transparent_header_section', array(
        'title'       =>  __( 'Transparent Header', 'apex-business' ),
        'priority'    =>  25,
        'capability'  => 'edit_theme_options',
        'panel'       =>  'apex_business_header_panel'
    ) );

    $wp_customize->add_setting(
        'apex_business_transparent_navigation_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_transparent_navigation_control', array(
                'label'         => esc_html__( 'Transparent Header Height', 'apex-business' ),
                'section'       => 'apex_business_transparent_header_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 150,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                    'tablet'  => array(
                        'min'           => 10,
                        'max'           => 150,
                        'step'           => 1,
                        'default_value' => 10,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 150,
                        'step'          => 1,
                        'default_value' => 10,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_transparent_logo_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_transparent_logo_size_control', array(
                'label'         => esc_html__( 'Transparent Logo Size','apex-business' ),
                'section'       => 'apex_business_transparent_header_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 500,
                        'step'          => 1,
                        'default_value' => 300,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_transparent_text_logo_size_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_transparent_text_logo_size_control', array(
                'label'         => esc_html__( 'Transparent Text Logo Size', 'apex-business' ),
                'section'       => 'apex_business_transparent_header_section',
                'type'          => 'range-value',
                'media_query'   => true,
                'priority'      => 25,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 32,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 32,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 32,
                    ),
                ),
            )
        )
    );

    if ( function_exists( 'apex_business_transparent_header_border' ) ) {
        apex_business_transparent_header_border( $wp_customize );
    }

    $wp_customize->add_setting(
        'apex_business_transparent_header_text_logo_color_setting',
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
            'apex_business_transparent_header_text_logo_color_control',
            array(
                'label'         => __( 'Text Logo Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_transparent_header_section',
                'settings'      => 'apex_business_transparent_header_text_logo_color_setting',
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
        'apex_business_transparent_header_bgcolor_setting',
        array(
            'default'           =>  APEX_BUSINESS_WHITE_COLOR,
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
            'apex_business_transparent_header_bgcolor_control',
            array(
                'label'         => __( 'Transparent Header Background Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_transparent_header_section',
                'settings'      => 'apex_business_transparent_header_bgcolor_setting',
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
        'apex_business_transparent_nav_link_color_setting',
        array(
            'default'           =>  APEX_BUSINESS_WHITE_COLOR,
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
            'apex_business_transparent_nav_link_color_control',
            array(
                'label'         => __( 'Link Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_transparent_header_section',
                'settings'      => 'apex_business_transparent_nav_link_color_setting',
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
        'apex_business_transparent_mobile_nav_icon_color_settings',
        array(
            'default'           =>  APEX_BUSINESS_PRIMARY_COLOR,
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
            'apex_business_transparent_mobile_nav_icon_color_control',
            array(
                'label'         => __( 'Mobile Header Manu Icon Color', 'apex-business' ),
                'priority'      => 25,
                'section'       => 'apex_business_transparent_header_section',
                'settings'      => 'apex_business_transparent_mobile_nav_icon_color_settings',
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

add_action( 'customize_register', 'apex_business_header_navigation_settings_setup');
