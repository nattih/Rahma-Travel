<?php
get_template_part( 'inc/customizer/functions/functions' );
get_template_part( '/inc/customizer/functions/typography-functions' );

if ( ! function_exists( 'apex_business_enqueue_inline_css' ) ) :

function apex_business_enqueue_inline_css() {
    $apex_business_custom_css = '';

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'body', 'apex_business_body_font_family_control', array(  16, 16, 16), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'h1', 'apex_business_h1_font_family_control', array(  41, 37, 33), array( 1.2, 1.2, 1.2 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'h2', 'apex_business_h2_font_family_control', array(  34, 30, 26), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'h3', 'apex_business_h3_font_family_control', array(  28, 26, 24), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'h4', 'apex_business_h4_font_family_control', array(  20, 20, 20), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'h5', 'apex_business_h5_font_family_control', array(  16, 16, 16), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'h6', 'apex_business_h6_font_family_control', array(  14, 14, 14), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'blockquote, blockquote p, blockquote span, blockquote a', 'apex_business_blockquote_font_family_control', array(  16, 16, 16), array(  1.5, 1.5, 1.5), APEX_BUSINESS_TEXT_COLOR ) );

    $apex_business_custom_css   .= esc_attr( apex_business_font_family( 'a', 'apex_business_link_font_family_control', array(  16, 16, 16), array( 1.5, 1.5, 1.5 ), APEX_BUSINESS_PRIMARY_COLOR ) );


    /***************************************************************************
    * Colors : Primary Color
    ***************************************************************************/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '.footer-bottom', 'border-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '.site-logo a, .site-logo div a:hover', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '.entry-meta li span::before', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '#theme-footer .ct-footer-border-top', 'border-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '.back-to-top span, .link-pages .page-numbers:hover, .link-pages .current .page-numbers, .pagination .nav-links .current, .pagination .nav-links a:hover', 'background-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '.spinner:before', 'border-top-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_primary_color_setting', '.blog-image .post-date', 'background-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /******************************************************************************
    * General Settings : Layout Settings
    ******************************************************************************/
    /** Layout Settings: Container Width **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_website_width_setting', '.container, .box-layout, .box-layout .fixed-header', 'width', array( 1200 ), 'px' );

    /** Layout Settings: Gutter Width **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_gutter_width_setting', '.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12', array( 'padding-left', 'padding-right' ), array( 15, 15, 15 ), 'px' );

    /** Layout Settings: Section Height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_section_height_setting', '.theme-padding', array( 'padding-top', 'padding-bottom' ), array( 72, 72, 72 ), 'px' );

    /** Loading Bar Color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_loading_bar_color_setting', '#loading #pulse span', 'background', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    if (  get_theme_mod( 'apex_business_loading_bar_color_setting', APEX_BUSINESS_PRIMARY_COLOR ) != '' ) {
        $apex_business_custom_css   .= '@keyframes pulse_animation { 0% { box-shadow: 0 0 0 0 ' . esc_attr( get_theme_mod( 'apex_business_loading_bar_color_setting', APEX_BUSINESS_PRIMARY_COLOR ) ) . '; } 100% { box-shadow: 0 0 0 40px rgba(43, 57, 72, 0); } }';
    }

    /***************************************************************************
    * General Settings : Typography Settings
    ***************************************************************************/

    /** Link : hover link color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_link_hover_color_setting', 'a:hover', 'color', array( APEX_BUSINESS_HOVER_COLOR ) );

    /******************************************************************************
    * Header Navigation => Primary Header
    ******************************************************************************/

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_navigation_padding_control', '.header-spacing', array( 'padding-top', 'padding-bottom' ), array( 10, 10, 0 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_logo_height_control', '.site-logo img', array( 'max-width' ), array( 300, 300, 300 ), 'px' );

    /** Header Navigation : text logo font size **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_nav_text_size_control', '.site-logo div', array( 'font-size' ), array( 38, 34, 26 ), 'px' );

    /** Header Navigation : text logo font line Height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_nav_line_height_control', '.site-logo div', array( 'line-height' ), array( 1, 1, 1 ));

    /** Header Navigation : text logo color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_text_logo_color_setting', '.site-logo div a', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

     /** Header Navigation : manu font letter spacing **/
    $apex_business_custom_css   .=  apex_business_customizer_value( 'apex_business_nav_letter_spacing_control', 'nav a', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' ) ;

    /** Header Navigation : Navigation Link Right Left Padding **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_nav_link_rl_padding_control', '.main-nav > li > a', array( 'padding-left', 'padding-right' ), array( 0, 0, 0 ), 'px' );

    /** Header Navigation : Navigation Link top  bottom padding **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_nav_menu_height_control', '.main-nav > li > a', array( 'padding-top', 'padding-bottom' ), array( 0, 0, 0 ), 'px' );

    /** Header Navigation : Navigation Link font family**/
    $apex_business_custom_css   .= apex_business_font_family( 'nav a', 'apex_business_header_font_family_control', array(  41, 37, 33), array( 1.2, 1.2, 1.2 ) );

    /** Header Navigation : header bg color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_bgcolor_setting', '.main-header', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Header Navigation : Navigation Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_text_color_setting', '.main-nav > li > a', 'color', array( APEX_BUSINESS_TEXT_COLOR ) );

     /** Header Navigation : Navigation active Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_link_color_setting', '.main-nav .current-menu-item a', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /** Header Navigation : Navigation active Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_link_hover_color_setting', '.main-nav > li > a:hover, .mobile-menu-container ul > li > a:hover', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /** Header Navigation : Navigation dropdown Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_dropdown_color_setting', '.main-nav .menu-item-has-children .sub-menu li a', 'color', array( APEX_BUSINESS_TEXT_COLOR ) );

    /** Header Navigation : Navigation dropdown Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_dropdown_hover_color_setting', '.main-nav .menu-item-has-children .sub-menu li a:hover', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

     /** Header Navigation : logo vertical spacing **/

     $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_logo_vertical_spacing_control', '.logo-vertical-spacing', array( 'padding-top', 'padding-bottom' ), array( 10, 10, 0 ), 'px' );

     /** Header Navigation : Mobile header nav icons **/
     $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_mobile_header_icon_color_setting', '.header-container .main-header .nav-menu a.menubar-right, .header-container .main-header .mobile-menu-container .menubar-close, .header-container .main-header .mobile-menu-container .dropdown-toggle', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

      /** Header Navigation : Dropdown link padding **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_header_dd_spacing_control', '.sub-menu li', array( 'padding-top', 'padding-bottom' ), array( 0, 0, 0 ), 'px' );

    /***************************************************************************
    * Fixed header Settings
    ***************************************************************************/

    /** Layout Settings: Section Height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_fixed_navigation_control', '.sticky-header', array( 'padding-top', 'padding-bottom' ), array( 10, 10, 10 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_fixed_logo_size_control', '.sticky-header .site-logo .custom-logo', array( 'max-width' ), array( 300, 300, 300 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_fixed_text_logo_size_control', '.sticky-header .site-logo div', array( 'font-size' ), array( 100, 100, 100 ), 'px' );

    /** fixed Hover Settings : fixed header Bg color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_fixed_header_bgcolor_setting', '.sticky-header', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Header Navigation : Navigation active Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_fixed_nav_link_color_setting', '.sticky-header .main-nav > li > a', 'color', array( APEX_BUSINESS_TEXT_COLOR ) );

     /** Header Navigation : text logo color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_fixed_header_text_logo_color_setting', '.sticky-header .site-logo div a', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );


    /***************************************************************************
    * transparent header Settings
    ***************************************************************************/

    /** Layout Settings: Section Height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_navigation_control', '.ct-transparent-header .no-stick', array( 'padding-top', 'padding-bottom' ), array( 10, 10, 10 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_logo_size_control', '.ct-transparent-header .site-logo .ct-transparent-logo img', array( 'max-width' ), array( 300, 300, 300 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_text_logo_size_control', '.ct-transparent-header .site-logo div', array( 'font-size' ), array( 100, 100, 100 ), 'px' );

    /** fixed Hover Settings : fixed header Bg color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_header_bgcolor_setting', '.ct-transparent-header', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Header Navigation : Navigation active Link color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_nav_link_color_setting', '.ct-transparent-header .no-stick .main-nav > li > a', 'color', array( APEX_BUSINESS_WHITE_COLOR ) );

     /** Header Navigation : text logo color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_header_text_logo_color_setting', '.ct-transparent-header .site-logo div a', 'color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Header Navigation : Mobile header icon color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_transparent_mobile_nav_icon_color_settings', '.ct-transparent-header .no-stick .nav-menu a .menubar-right', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );


    /***************************************************************************
    * topbar :  topbar Settings
    ***************************************************************************/

    /** topbar :  topbar bg color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_introduction_background_color_setting', '.top-bar', 'background-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /** topbar :  topbar text color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_introduction_text_color_setting', '.top-bar span, .top-bar ul', 'color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /**  Button Settings : height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_topbar_vertical_spacing_control', '.header-container .top-bar', array( 'padding-top', 'padding-bottom' ), array( 0, 0, 0 ), 'px' );

    /***************************************************************************
    * Button Settings
    ***************************************************************************/

    /** Button Settings : font size **/
    $apex_business_custom_css   .=  apex_business_customizer_value( 'apex_business_button_text_size_control', '.nav-button', array( 'font-size' ), array( 12, 12, 12 ), 'px' );

    /** Button Settings : font color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_text_color_setting', '.nav-button, .nav-button:focus, .nav-button:active', 'color', array( APEX_BUSINESS_TEXT_COLOR ) );

    /** Button Settings : font color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_bgcolor_setting', '.nav-button', 'background-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /**  Button Settings : border width **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_border_width_control', '.nav-button', array( 'border-width' ), array( 1, 1, 1 ), 'px' );

    /**  Button Settings : border radius **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_border_radius_control', '.nav-button', array( 'border-radius' ), array( 3, 3, 3 ), 'px' );

    /** Button Settings : letter spacing **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_letter_spacing_control', '.nav-button', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );

    /** Header Navigation : Navigation Link font family**/
    $apex_business_custom_css   .= apex_business_font_family( '.nav-button', 'apex_business_button_font_family_control', array(  41, 37, 33), array( 1.2, 1.2, 1.2 ) ) ;

    /** Button Hover Settings : bg color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_hover_bgcolor_setting', '.nav-button:hover', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Button Hover Settings : text color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_hover_text_color_setting', '.ct-button:hover, .nav-button:hover', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

     /**  Button Settings : border radius **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_hover_border_radius_control', '.nav-button:hover, .button:hover', array( 'border-radius' ), array( 3, 3, 3 ), 'px' );

    /**  Button Settings : lettern spacing **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_hover_letter_spacing_control', '.nav-button:hover, .nav-button:hover', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );

    /**  Button Settings : width **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_width_control', '.nav-button', array( 'padding-left', 'padding-right' ), array( 30, 30, 30 ), 'px' );

     /**  Button Settings : height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_height_control', '.nav-button', array( 'padding-top', 'padding-bottom' ), array( 10, 10, 10 ), 'px' );

    /** Button Settings : border color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_border_color_setting', '.nav-button', 'border-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /** Button Settings : border hover color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_button_hover_border_color_setting', '.nav-button:hover, .nav-button:hover', 'border-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );


    /***************************************************************************
    * Footer Settings
    ***************************************************************************/
    /** footer Settings : bg color**/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_bgcolor_setting', '.ct-footer-bg', 'background-color', array( APEX_BUSINESS_TEXT_COLOR ) );

    /** footer Settings : background image **/
    $apex_business_custom_css   .= apex_business_backgorund_image( 'apex_business_footer_bgimage_setting', '#theme-footer' );

    /** footer Settings : background repeat **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_bgimage_repeat_setting', '#theme-footer', 'background-repeat', array( 'no-repeat' ) );

    /** footer Settings : background size **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_bgimage_size_setting', '#theme-footer', 'background-size', array( 'auto' ) );

    /** footer Settings : background attachment **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_bgimage_attachment_setting', '#theme-footer', 'background-attachment', array( 'scroll' ) );

    /**  Button Settings : lettern spacing **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_top_border_control', '.ct-footer-border-top', array( 'border-top-width' ), array( 0, 0, 0 ), 'px' );

    /** Footer Settings : border  color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_border_color_setting', '#theme-footer .ct-footer-border-top', 'border-top-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /**  Button Settings : lettern spacing **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_widget_title_bottom_margin_control', '.footer-block .widget-title', array( 'margin-bottom' ), array( 0, 0, 0 ), 'px' );

     /** Footer Settings : Title  color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_widget_title_color_setting', '#theme-footer .footer-block .widget-title', 'color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Footer Settings : Text  color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_widget_text_color_setting', '#theme-footer .footer-block .widget p, #theme-footer .footer-block .widget li, #theme-footer .footer-block .widget td, #theme-footer .footer-block .widget th, #theme-footer .footer-block .widget span, #theme-footer .footer-block .widget th, #theme-footer .footer-block .widget figcaption', 'color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Footer Settings : Link  color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_widget_link_color_setting', '#theme-footer .footer-block .widget a', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /** Footer Settings : Link  color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_footer_widget_link_hover_color_setting', '#theme-footer .footer-block .widget a:hover', 'color', array( APEX_BUSINESS_TEXT_COLOR ) );

     /** bottom bar Settings : bg color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_bgcolor_setting', '.ct-footer-bottom-bg', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** bottom bar Settings : text color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_text_color_setting', '.ct-copyright-content-color', 'color', array( APEX_BUSINESS_TEXT_COLOR ) );

     /** bottom bar Settings : text color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_link_color_setting', '.footer-bottom li a, .footer-bottom .copyright-content a', 'color', array( APEX_BUSINESS_PRIMARY_COLOR ) );

    /** bottom bar Settings : Font-size **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_text_size_control', '.footer-bottom .copyright-content', array( 'font-size' ), array( 14, 14, 14 ), 'px' );

    /** bottom bar Settings : Font-size **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_menu_text_size_control', '#footer-menu li a', array( 'font-size' ), array( 14, 14, 14 ), 'px' );

    /** Bottom bar Settings : top bottom padding **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_padding_control', '.footer-bottom', array( 'padding-top', 'padding-bottom' ), array( 14, 14, 14 ), 'px' );

    /** Bottom bar Settings : top bottom padding **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_padding_control', '.footer-bottom', array( 'padding-top', 'padding-bottom' ), array( 14, 14, 14 ), 'px' );

    /** Bottom bar Settings : border top **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_top_border_control', '.footer-bottom', array( 'border-top-width' ), array( 0, 0, 0 ), 'px' );

    /** Bottom bar Settings : border color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_bottom_bar_border_color_setting', '.footer-bottom', 'border-top-color', array( APEX_BUSINESS_PRIMARY_COLOR ) );


    /*******************************************************************************
    * Sidebar => Sidebar Style
    *******************************************************************************/
    /** Sidebar Settings : bg color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_sidebar_bg_color_setting', '.ct-sidebar .side-bar-widget .sidebar-widgetarea', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ) );


    /*******************************************************************************
    * Banner Settings
    *******************************************************************************/

    /** archive Banner Settings : background image **/
    $apex_business_custom_css   .= apex_business_backgorund_image( 'apex_business_archive_banner_image_setting', '.archive-banner' );

    /** archive Banner Settings : background repeat **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_archive_image_repeat_setting', '.archive-banner', 'background-repeat', array( 'no-repeat' ) );

    /** archive Banner Settings : background size **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_blog_archive_size_setting', '.archive-banner', 'background-size', array( 'auto' ) );

    /** archive Banner Settings : background attachment **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_archive_image_attachment_setting', '.archive-banner', 'background-attachment', array( 'scroll' ) );

    /** archive Banner Settings : color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_archive_text_color_setting', '.archive-banner .banner-content h1', 'color', array( APEX_BUSINESS_WHITE_COLOR ));

    /** archive Banner Settings : bg color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_archive_bg_color_setting', '.archive-banner .color-overlay', 'background-color', array( APEX_BUSINESS_OPACITY_BG_COLOR ));

    /** archive Banner Settings : banner height **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_archive_banner_height_control', '.archive-banner .banner', array( 'height' ), array( 450, 200, 150 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_archive_banner_font_size_control', '.archive-banner .banner-content h1', array( 'font-size' ), array( 48, 34, 10 ), 'px' );

     /** Banner Settings : background image **/
    $apex_business_custom_css   .= apex_business_backgorund_image( 'apex_business_blog_banner_image_setting', '.blog-banner' );

    /** Banner Settings : background repeat **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_banner_image_repeat_setting', '.blog-banner', 'background-repeat', array( 'no-repeat' ) );

    /** Banner Settings : background size **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_blog_banner_size_setting', '.blog-banner', 'background-size', array( 'auto' ) );

    /** Banner Settings : background attachment **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_banner_image_attachment_setting', '.blog-banner', 'background-attachment', array( 'scroll' ) );

    /** Banner Settings : color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_banner_text_color_setting', '.banner-content h1', 'color', array( APEX_BUSINESS_WHITE_COLOR ) );

    /** Banner Settings : bg color **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_banner_bg_color_setting', '.blog-banner .color-overlay', 'background-color', array( APEX_BUSINESS_OPACITY_BG_COLOR ) );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_blog_banner_height_control', '.blog-banner .banner', array( 'height' ), array( 450, 200, 150 ), 'px' );

     $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_blog_banner_font_size_control', '.blog-banner .banner-content h1', array( 'font-size' ), array( 48, 34, 10 ), 'px' );

    /***************************************************************************
    * Back To Top Buttom Settings
    ***************************************************************************/
    /** Back To Top Buttom Settings :border-radius **/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_back_to_top_border_radius_control', '.back-to-top span', array( 'border-radius' ), array( 10, 10, 10 ), 'px' );

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_back_to_top_bgcolor_setting', '.back-to-top span', 'background-color', array( APEX_BUSINESS_PRIMARY_COLOR ));

    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_back_to_top_icon_color_setting', '.back-to-top span', 'color', array( APEX_BUSINESS_WHITE_COLOR ));

    /***************************************************************************
    * Woo settings
    ***************************************************************************/
    $apex_business_custom_css   .= apex_business_customizer_value( 'apex_business_woo_single_bg_color_setting', 'body.single-product .hentry .entry-container', 'background-color', array( APEX_BUSINESS_WHITE_COLOR ));

    // If Premium Setup
    if ( function_exists( 'apex_business_customizer_inline_premium' ) ) {
        $apex_business_custom_css   .= apex_business_customizer_inline_premium( $apex_business_custom_css );
    }

    /** Sidebar : Sidebar Width **/
    $apex_business_sidebar_width =  esc_attr( get_theme_mod( 'apex_business_sidebar_width_control' ) );
    if ( $apex_business_sidebar_width != 33 && !empty( $apex_business_sidebar_width ) ) {
        $apex_business_content_width =  ( 100 - $apex_business_sidebar_width );
        $apex_business_custom_css   .= '.ct-sidebar { width: ' . $apex_business_sidebar_width . '%; } ';
        $apex_business_custom_css   .= '.ct-content-area { width: ' . $apex_business_content_width . '%; }';
    }

    wp_enqueue_style( 'apex-business-style-css', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
    wp_add_inline_style( 'apex-business-style-css', $apex_business_custom_css );
}

endif;

add_action( 'wp_enqueue_scripts', 'apex_business_enqueue_inline_css' );
