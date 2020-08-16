<?php
/**
 * Add Customizer Options
 * [Blog Settings]
 */

function apex_business_blog_settings_setup( $wp_customize ) {

    // Blog Section
    $wp_customize->add_section( 'apex_business_blog_layout_section', array(
        'title'       =>  __( 'Blog Layout', 'apex-business' ),
        'priority'    =>  1,
        'capability'  => 'edit_theme_options',
        'panel'       =>  'apex_business_blog_panel',
    ) );

    $wp_customize->add_setting( 'apex_business_blog_layout_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'list',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_blog_layout_control', array(
                'label'             => __( 'Blog Layout', 'apex-business' ),
                'section'           => 'apex_business_blog_layout_section',
                'settings'          => 'apex_business_blog_layout_setting',
                'type'              => 'select',
                'priority'          => 25,
                'choices'           =>  array(
                    'list'          =>  __( 'List', 'apex-business' ),
                    'masonry'       =>  __( 'Masonry', 'apex-business' ),
                    ),
            )
        )
    );

    if ( function_exists( 'apex_business_post_scroll_option_customizer' ) ) {
       apex_business_post_scroll_option_customizer( $wp_customize );
    }

    $wp_customize->add_setting(
        'apex_business_masonry_column_number_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_masonry_column_number_control', array(
                'label'             => esc_html__( 'Number Of Columns','apex-business' ),
                'section'           => 'apex_business_blog_layout_section',
                'type'              => 'range-value',
                'priority'          => 25,
                'active_callback'   =>  'apex_business_masonry_columns_callback',
                'media_query'       => false,
                'input_attr'        => array(
                    'desktop'   => array(
                        'min'           => 1,
                        'max'           => 4,
                        'step'          => 1,
                        'default_value' => 3,
                    ),
                ),
            )
        )
    );

    // Blog Section
    $wp_customize->add_section( 'apex_business_blog_section', array(
        'title'       =>  __( 'Blog Metas & Excerpt', 'apex-business' ),
        'priority'    =>  1,
        'panel'       =>  'apex_business_blog_panel',
    ) );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_blog_excerpt_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize, 'apex_business_blog_excerpt_control', array(
            'label'           => esc_html__( 'Excerpt', 'apex-business' ),
            'section'         => 'apex_business_blog_section',
            'settings'        => 'apex_business_blog_excerpt_setting',
            'priority'        => 25,
            'type'            => 'hidden',
        )
      )
    );

    $wp_customize->add_setting( 'apex_business_post_content_style_setting', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'excerpt',
      'sanitize_callback' => 'apex_business_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'apex_business_post_content_style_control', array(
                'label'             => __( 'Post Content', 'apex-business' ),
                'section'           => 'apex_business_blog_section',
                'settings'          => 'apex_business_post_content_style_setting',
                'type'              =>  'select',
                'priority'          => 25,
                'choices'           =>  array(
                    'excerpt'       =>  __( 'Excerpt', 'apex-business' ),
                    'content'       =>  __( 'Content', 'apex-business' ),
                    ),
            )
        )
    );

    $wp_customize->add_setting(
        'apex_business_post_excerpt_length_control', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'apex_business_sanitize_range_value',
            'default'           => 30
        )
    );

    $wp_customize->add_control(
        new Apex_Business_Customizer_Range_Value_Control(
            $wp_customize, 'apex_business_post_excerpt_length_control', array(
                'label'         => esc_html__( 'Excerpt Length','apex-business' ),
                'description'   => esc_html__( 'Set 600 for the entire content', 'apex-business' ),
                'section'       => 'apex_business_blog_section',
                'type'          => 'range-value',
                'media_query'   => false,
                'priority'      => 25,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 600,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
                ),
            )
        )
    );

    $wp_customize->add_setting( 'apex_business_readmore_link_switch_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'default'           => 1
    ) );

    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_readmore_link_switch_control', array(
        'label'       => __( 'Enable Read More Link?', 'apex-business' ),
        'section'     => 'apex_business_blog_section',
        'settings'    => 'apex_business_readmore_link_switch_setting',
        'priority'    => 25,
        'type'        => 'ios',
    ) ) );

     $wp_customize->add_setting( 'apex_business_readmore_button_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'default'           => 0
    ) );

    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control( $wp_customize, 'apex_business_readmore_button_control', array(
        'label'             => __( 'Use Read More Button', 'apex-business' ),
        'section'           => 'apex_business_blog_section',
        'settings'          => 'apex_business_readmore_button_setting',
        'priority'          => 25,
        'type'              => 'ios',
        'active_callback'   => 'apex_business_readmore_Link_callback',
    ) ) );

    $wp_customize->add_setting( 'apex_business_readmore_text_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => __( 'READ MORE', 'apex-business' ),
       )
    );

    $wp_customize->add_control( 'apex_business_readmore_text_control',
       array(
            'label'             => __( 'Read More Button Text', 'apex-business' ),
            'settings'          => 'apex_business_readmore_text_setting',
            'section'           => 'apex_business_blog_section',
            'priority'          => 25,
            'type'              => 'text',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
            'active_callback'   => 'apex_business_readmore_Link_callback',
       )
    );

    // Headline Setting
    $wp_customize->add_setting( 'apex_business_blog_metas_setting', array(
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize, 'apex_business_blog_metas_control', array(
            'label'           => esc_html__( 'Metas', 'apex-business' ),
            'section'         => 'apex_business_blog_section',
            'settings'        => 'apex_business_blog_metas_setting',
            'priority'        => 25,
            'type'            => 'hidden',
        )
      )
    );

   $wp_customize->add_setting( 'apex_business_display_author_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_display_author_control',
       array(
            'label'             => __( 'Display Author', 'apex-business' ),
            'settings'          => 'apex_business_display_author_setting',
            'section'           => 'apex_business_blog_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_display_date_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_display_date_control',
       array(
            'label'             => __( 'Display Date', 'apex-business' ),
            'settings'          => 'apex_business_display_date_setting',
            'section'           => 'apex_business_blog_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_display_category_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_display_category_control',
       array(
            'label'             => __( 'Display Category', 'apex-business' ),
            'settings'          => 'apex_business_display_category_setting',
            'section'           => 'apex_business_blog_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_display_tags_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_display_tags_control',
       array(
            'label'             => __( 'Display Tags', 'apex-business' ),
            'settings'          => 'apex_business_display_tags_setting',
            'section'           => 'apex_business_blog_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_display_comment_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_display_comment_control',
       array(
            'label'             => __( 'Display Comments', 'apex-business' ),
            'settings'          => 'apex_business_display_comment_setting',
            'section'           => 'apex_business_blog_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );


    // single Section
    $wp_customize->add_section( 'apex_business_single_section', array(
        'title'       =>  __( 'Single Metas', 'apex-business' ),
        'priority'    =>  1,
        'panel'       =>  'apex_business_blog_panel',
    ) );

    $wp_customize->add_setting( 'apex_business_single_display_author_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    if ( function_exists( 'apex_business_single_post_option_customizer' ) ) {
       apex_business_single_post_option_customizer( $wp_customize );
    }

    $wp_customize->add_control( 'apex_business_single_display_author_control',
       array(
            'label'             => __( 'Display Author', 'apex-business' ),
            'settings'          => 'apex_business_single_display_author_setting',
            'section'           => 'apex_business_single_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_single_display_date_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_single_display_date_control',
       array(
            'label'             => __( 'Display Date', 'apex-business' ),
            'settings'          => 'apex_business_single_display_date_setting',
            'section'           => 'apex_business_single_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_single_display_comment_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_single_display_comment_control',
       array(
            'label'             => __( 'Display Comments', 'apex-business' ),
            'settings'          => 'apex_business_single_display_comment_setting',
            'section'           => 'apex_business_single_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_single_display_category_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_single_display_category_control',
       array(
            'label'             => __( 'Display Category', 'apex-business' ),
            'settings'          => 'apex_business_single_display_category_setting',
            'section'           => 'apex_business_single_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    $wp_customize->add_setting( 'apex_business_single_display_tags_setting',
       array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'default'           => 1,
       )
    );

    $wp_customize->add_control( 'apex_business_single_display_tags_control',
       array(
            'label'             => __( 'Display Tags', 'apex-business' ),
            'settings'          => 'apex_business_single_display_tags_setting',
            'section'           => 'apex_business_single_section',
            'priority'          => 25,
            'type'              => 'checkbox',
            'capability'        => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
       )
    );

    if ( function_exists( 'apex_business_social_share_customizer' ) ) {
        apex_business_social_share_customizer( $wp_customize );
    }

}

add_action( 'customize_register', 'apex_business_blog_settings_setup');

