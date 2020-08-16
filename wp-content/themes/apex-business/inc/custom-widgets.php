<?php
/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if ( ! function_exists( 'apex_business_widgets_init' ) ) :

function apex_business_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'apex-business' ),
        'id'            => 'apex_business_main_sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your single post sidebar area.', 'apex-business' ),
        'before_widget' => '<div id="%1$s" class="%2$s sidebar-widgetarea widgetarea clearfix">',
        'after_widget'  => '</div><!-- /.sidebar-widgetarea -->',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'apex-business' ),
        'id'            => 'apex_business_page_sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your single page sidebar area.', 'apex-business' ),
        'before_widget' => '<div id="%1$s" class="%2$s sidebar-widgetarea widgetarea clearfix">',
        'after_widget'  => '</div><!-- /.sidebar-widgetarea -->',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    for ( $apex_business_i = 1; $apex_business_i < 5; $apex_business_i++ ) {
        register_sidebar( array(
            /* translators: %d: Footer widget numbers */
            'name'          => sprintf( esc_html__( 'Footer Widget %d', 'apex-business' ), $apex_business_i ),
            'id'            => "apex_business_footer_widget_$apex_business_i",
            'description'   => esc_html__( 'Add widgets here to appear on your footer section.', 'apex-business' ),
            'before_widget' => '<div id="%1$s" class="%2$s widgetarea clearfix">',
            'after_widget'  => '</div><!-- /.widgetarea -->',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }

    register_sidebar( array(
        'name'          => esc_html__( 'Top bar: Address', 'apex-business' ),
        'id'            => 'apex-business-topbar-address',
        'description'   => esc_html__( 'Add a Text widget here to appear in your left topbar address area.', 'apex-business' ),
        'before_widget' => '<span class="address">',
        'after_widget'  => '</span>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Top bar: Office Hours', 'apex-business' ),
        'id'            => 'apex-business-topbar-office-hours',
        'description'   => esc_html__( 'Add a Text widget here to appear in your left topbar address area.', 'apex-business' ),
        'before_widget' => '<span class="office-hour">',
        'after_widget'  => '</span>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Top bar: Phone', 'apex-business' ),
        'id'            => 'apex-business-topbar-phone',
        'description'   => esc_html__( 'Add a Text widget here to appear in your left topbar call us area.', 'apex-business' ),
        'before_widget' => '<span class="phone topbar-widget">',
        'after_widget'  => '</span>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Top bar: Email', 'apex-business' ),
        'id'            => 'apex-business-topbar-email',
        'description'   => esc_html__( 'Add a Text widget here to appear in your right topbar Email Address area.', 'apex-business' ),
        'before_widget' => '<span class="e-mail topbar-widget">',
        'after_widget'  => '</span>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Header Widget', 'apex-business' ),
        'id'            => 'apex_business_header_widget',
        'description'   => esc_html__( 'Add a header widget here to appear in your right header area.', 'apex-business' ),
        'before_widget' => '<li class="header-widget-item">',
        'after_widget'  => '</li>',
        'before_title'  => '<span class="header-widget-title">',
        'after_title'   => '</span>',
    ) );
}

endif;

add_action( 'widgets_init', 'apex_business_widgets_init' );
