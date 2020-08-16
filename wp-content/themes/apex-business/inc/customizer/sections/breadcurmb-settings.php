<?php
/**
 * Add Customizer Options
 * [breadcurmb]
 */
function apex_business_bredcurmb_settings_setup( $wp_customize ) {
        // Top Bar Section
    $wp_customize->add_section( 'apex_business_breadcurmb_section', array(
        'title'       =>  __( 'Breadcurmb', 'apex-business' ),
        'capability'  => 'edit_theme_options',
        'priority'    =>  10
    ) );

    $wp_customize->add_setting( 'apex_business_breadcurmb_switch_setting', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'default'           => false
    ) );

    $wp_customize->add_control( new Apex_Business_Customizer_Toggle_Control(
        $wp_customize, 'apex_business_breadcurmb_switch_control',
            array(
                'label'       => __( 'Enable Box Breadcurmb?', 'apex-business' ),
                'section'     => 'apex_business_breadcurmb_section',
                'settings'    => 'apex_business_breadcurmb_switch_setting',
                'type'        => 'ios',
            )
        )
    );
}
add_action( 'customize_register', 'apex_business_bredcurmb_settings_setup');
