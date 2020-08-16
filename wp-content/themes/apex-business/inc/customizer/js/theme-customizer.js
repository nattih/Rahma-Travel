(function($){

    /**
     * Outputs custom css for non responsive controls
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @param  {[array]} css_prop css property to write
     * @return {[string]} css output
     */
    function ct_customizer_live_load( setting, css_selector, css_prop, ext = '' ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var class_name      = 'customizer-' + setting; // Used as id in gfont link
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + to + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + to + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + to + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">' + selector_name + ' { ' + desktop_css +' }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( 'head' ).append( head_append );
                        }
                    }
                );
            }
        );
    }

    /**
     * Outputs custom css for backgroung image
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @return {[string]} css output
     */
    function ct_customizer_background_image( setting, css_selector ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var class_name      = 'customizer-' + setting; // Used as id in gfont link
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;

                        var head_append     = '<style class="' + class_name + '">' + selector_name + ' { background-image: url( ' + to +' ); }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( 'head' ).append( head_append );
                        }
                    }
                );
            }
        );
    }

    /**
     * Outputs custom css for responsive controls
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @param  {[array]} css_prop css property to write
     * @param  {String} ext css value extension eg: px, in
     * @return {[string]} css output
     */
    function range_live_media_load( setting, css_selector, css_prop, ext = '' ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-' + setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';
                        var tablet_css      = '';
                        var mobile_css      = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + desktop_value + ext + ';';

                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var tablet_css      = tablet_css + property_name[1] + ': ' + tablet_value + ext + ';';

                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                            var mobile_css      = mobile_css + property_name[1] + ': ' + mobile_value + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + mobile_css + ' } } @media (min-width: 720px){ ' + selector_name + ' { ' + tablet_css + ' } } @media (min-width: 960px){ ' + selector_name + ' { ' + desktop_css + ' } }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( "head" ).append( head_append );
                        }
                    }
                );
            }
        );
    }

    /***************************************************************************
    * General Settings : Typography Settings
    ***************************************************************************/

    /** Link : hover link color **/
    ct_customizer_live_load( 'apex_business_link_hover_color_setting', 'a:hover', [ 'color' ] );

    /***************************************************************************
    * General Settings : Layout Settings
    ***************************************************************************/

    /** Layout Settings: Container Width **/
    ct_customizer_live_load( 'apex_business_website_width_setting', '.container, .box-layout, .box-layout .fixed-header', [ 'width' ], 'px' );

    /** Layout Settings: Gutter Width **/
    range_live_media_load( 'apex_business_gutter_width_setting', '.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12', [ 'padding-left', 'padding-right' ], 'px' );

    /** Layout Settings: Section Height **/
    range_live_media_load( 'apex_business_section_height_setting', '.theme-padding', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** Header Navigation : Primary Header **/
    range_live_media_load( 'apex_business_navigation_padding_control', '.header-spacing', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** Header Navigation : logo vertical spacing **/
    range_live_media_load( 'apex_business_logo_vertical_spacing_control', '.logo-vertical-spacing', [ 'padding-top', 'padding-bottom' ], 'px' );


    /** Header Navigation : Fixed Header **/
    range_live_media_load( 'apex_business_fixed_navigation_control', '.fixed-header-spacing', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** Header Navigation : Logo Width **/
    range_live_media_load( 'apex_business_header_logo_height_control', '.site-logo img', [ 'max-width' ], 'px' );

     /** Header Navigation : Text Logo Width **/
    range_live_media_load( 'apex_business_nav_text_size_control', '.site-logo div', [ 'font-size' ], 'px' );

    /** Header Navigation : Text Logo line height **/
    range_live_media_load( 'apex_business_nav_line_height_control', '.site-logo div', [ 'line-height' ], );

    /** Header Navigation : manu font letter spacing **/
    range_live_media_load( 'apex_business_nav_letter_spacing_control', 'nav a', [ 'letter-spacing' ], 'px' );


    /** Header Navigation : Navigation Link Right Left Padding **/
    range_live_media_load( 'apex_business_nav_link_rl_padding_control', '.main-nav > li > a', [ 'padding-left', 'padding-right'], 'px' );

    /** Header Navigation : Navigation Link top  bottom padding **/
    range_live_media_load( 'apex_business_nav_menu_height_control', '.main-nav > li > a', [ 'padding-top', 'padding-bottom'], 'px' );

    /** Header Navigation : header bg color **/
    ct_customizer_live_load( 'apex_business_header_bgcolor_setting', '.main-header', [ 'background-color' ] );

    /** Header Navigation : Navigation Link Right Left Padding **/
    ct_customizer_live_load( 'apex_business_header_text_color_setting', '.main-nav > li > a', [ 'color' ] );

    /** Header Navigation : header active link color **/
    ct_customizer_live_load( 'apex_business_header_link_color_setting', '.main-nav .current-menu-item a', [ 'color' ] );

    /** Header Navigation : header hover link color **/
    ct_customizer_live_load( 'apex_business_header_link_hover_color_setting', '.main-nav > li > a:hover', [ 'color' ] );

    /** Header Navigation : header dropdown link color **/
    ct_customizer_live_load( 'apex_business_header_dropdown_color_setting', '.main-nav .menu-item-has-children li a', [ 'color' ] );
    /** Header Navigation : header dropdown link color **/
    ct_customizer_live_load( 'apex_business_header_dropdown_hover_color_setting', '.main-nav .menu-item-has-children li a:hover', [ 'color' ] );
    /** Header Navigation : Text Logo color **/
    ct_customizer_live_load( 'apex_business_header_text_logo_color_setting', '.site-logo div a', [ 'color' ] );

    /** Header Navigation : Mobile header nav icons **/
    ct_customizer_live_load( 'apex_business_header_mobile_header_icon_color_setting', '.header-container .main-header .nav-menu a.menubar-right, .header-container .main-header .mobile-menu-container .menubar-close, .header-container .main-header .mobile-menu-container .dropdown-toggle', [ 'color' ] );

    /** Header Navigation : Dropdown link padding **/
    range_live_media_load( 'apex_business_header_dd_spacing_control', '.sub-menu li', [ 'padding-top', 'padding-bottom'], 'px' );



    /***************************************************************************
    * Fixed header Settings
    ***************************************************************************/

    /** Fixed header Settings: Section Height **/
    range_live_media_load( 'apex_business_fixed_navigation_control', '.sticky-header', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** Fixed header Settings: logo width **/
    range_live_media_load( 'apex_business_fixed_logo_size_control', '.sticky-header .site-logo .custom-logo', [ 'max-width' ], 'px' );

    /** Fixed header Settings: fixed_text_logo_size **/
    range_live_media_load( 'apex_business_fixed_text_logo_size_control', '.sticky-header .site-logo div', [ 'font-size' ], 'px' );

    /** Fixed Header Navigation :  Fixed header bg color **/
    ct_customizer_live_load( 'apex_business_fixed_header_bgcolor_setting', '.sticky-header', [ 'background-color' ] );

    /** Fixed Header Navigation :  active link color **/
    ct_customizer_live_load( 'apex_business_fixed_nav_link_color_setting', '.sticky-header .main-nav > li > a', [ 'color' ] );

    /** Fixed Header Navigation : Text Logo color **/
    ct_customizer_live_load( 'apex_business_fixed_header_text_logo_color_setting', '.sticky-header .site-logo div a', [ 'color' ] );



     /***************************************************************************
    * transparent header Settings
    ***************************************************************************/

    /** transparent header Settings: Section Height **/
    range_live_media_load( 'apex_business_transparent_navigation_control', '.ct-transparent-header .no-stick', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** transparent header Settings: logo width **/
    range_live_media_load( 'apex_business_transparent_logo_size_control', '.ct-transparent-header .site-logo .ct-transparent-logo img', [ 'max-width' ], 'px' );

    /** transparent header Settings: fixed_text_logo_size **/
    range_live_media_load( 'apex_business_transparent_text_logo_size_control', '.ct-transparent-header .site-logo div', [ 'font-size' ], 'px' );

    /** transparent header Navigation :  Fixed header bg color **/
    ct_customizer_live_load( 'apex_business_transparent_header_bgcolor_setting', '.ct-transparent-header', [ 'background-color' ] );

    /** transparent header Navigation :  active link color **/
    ct_customizer_live_load( 'apex_business_transparent_nav_link_color_setting', '.ct-transparent-header .no-stick .menu-menu li a', [ 'color' ] );
    /** Fixed Header Navigation :  active link color **/
    ct_customizer_live_load( 'apex_business_transparent_nav_link_color_setting', '.ct-transparent-header .no-stick .main-nav > li > a', [ 'color' ] );

    /** transparent header Navigation : Text Logo color **/
    ct_customizer_live_load( 'apex_business_transparent_header_text_logo_color_setting', '.ct-transparent-header .site-logo div a', [ 'color' ] );

    /** transparent header Navigation : Mobile header icon color **/
    ct_customizer_live_load( 'apex_business_transparent_mobile_nav_icon_color_settings', '.ct-transparent-header .no-stick .nav-menu a .menubar-right', [ 'color' ] );

    /***************************************************************************
    * topbar Settings
    ***************************************************************************/
    /** topbar :  topbar bg color **/
    ct_customizer_live_load( 'apex_business_introduction_background_color_setting', '.top-bar', [ 'background-color' ] );

    /** topbar :  topbar text color **/
    ct_customizer_live_load( 'apex_business_introduction_text_color_setting', '.top-bar span, .top-bar ul', [ 'color' ] );

    /** topbar :  topbar topbar vertical spacing **/
    range_live_media_load( 'apex_business_topbar_vertical_spacing_control', '.header-container .top-bar', [ 'padding-top', 'padding-bottom' ], 'px' );

    /***************************************************************************
    * Button Settings
    ***************************************************************************/

    /** Button Settings : width **/
    range_live_media_load( 'apex_business_button_width_control', '.nav-button', [ 'padding-right', 'padding-left' ], 'px' );

    /** Button Settings : height **/
    range_live_media_load( 'apex_business_button_height_control', '.nav-button', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** Button Settings : Font size **/
    range_live_media_load( 'apex_business_button_text_size_control', '.nav-button', [ 'font-size' ], 'px' );

    /** Button Settings : text color **/
    ct_customizer_live_load( 'apex_business_button_text_color_setting', '.nav-button:focus, .nav-button:active, .nav-button', [ 'color' ] );

    /** Button Settings : bg color **/
    ct_customizer_live_load( 'apex_business_button_bgcolor_setting', '.nav-button', [ 'background-color' ] );

    /** Button Settings : border width **/
    range_live_media_load( 'apex_business_button_border_width_control', '.nav-button', [ 'border-width'], 'px' );

    /** Button Settings : border radius **/
    range_live_media_load( 'apex_business_button_border_radius_control', '.nav-button', [ 'border-radius'], 'px' );

    /** Button Settings : letter spacing **/
    range_live_media_load( 'apex_business_button_letter_spacing_control', '.nav-button', [ 'letter-spacing'], 'px' );

    /** Button hover Settings : bg color **/
    ct_customizer_live_load( 'apex_business_button_hover_bgcolor_setting', '.nav-button:hover, .nav-button:hover', [ 'background-color' ] );

    /** Button hover Settings : bg color **/
    ct_customizer_live_load( 'apex_business_button_hover_text_color_setting', '.nav-button:hover, .nav-button:hover', [ 'color' ] );

    /** Button hover Settings : border radius **/
    range_live_media_load( 'apex_business_button_hover_border_radius_control', '.nav-button:hover, .nav-button:hover', [ 'border-radius'], 'px' );

     /** Button Settings : letter spacing **/
    range_live_media_load( 'apex_business_button_hover_letter_spacing_control', '.nav-button:hover, .nav-button:hover', [ 'letter-spacing'], 'px' );

    /** Button hover Settings : border color **/
    ct_customizer_live_load( 'apex_business_button_border_color_setting', '.nav-button', [ 'border-color' ] );

     /** Button hover Settings : border color **/
    ct_customizer_live_load( 'apex_business_button_hover_border_color_setting', '.nav-button:hover, .nav-button:hover', [ 'border-color' ] );

    /***************************************************************************
    * Sidebar Settings
    ***************************************************************************/

    /** Sidebar Settings : bg color **/
    ct_customizer_live_load( 'apex_business_sidebar_bg_color_setting', '.ct-sidebar .side-bar-widget .sidebar-widgetarea', [ 'background-color' ] );


    /***************************************************************************
    * Footer Settings
    ***************************************************************************/

    /** Footer Settings : bg color **/
    ct_customizer_live_load( 'apex_business_footer_bgcolor_setting', '.ct-footer-bg', [ 'background-color' ] );

    /** Footer Settings : background image **/
    ct_customizer_background_image( 'apex_business_footer_bgimage_setting', '#theme-footer' );

    /** Footer Settings : background repeat **/
    ct_customizer_live_load( 'apex_business_footer_bgimage_repeat_setting', '#theme-footer', [ 'background-repeat' ] );

    /** Footer Settings : background size **/
    ct_customizer_live_load( 'apex_business_footer_bgimage_size_setting', '#theme-footer', [ 'background-size' ] );

    /** Footer Settings : background attachment **/
    ct_customizer_live_load( 'apex_business_footer_bgimage_attachment_setting', '#theme-footer', [ 'background-attachment' ] );

    /** Footer Settings : border top **/
    range_live_media_load( 'apex_business_footer_top_border_control', '#theme-footer .ct-footer-border-top', [ 'border-top-width'], 'px' );

     /** Footer Settings : border  color **/
    ct_customizer_live_load( 'apex_business_footer_border_color_setting', '#theme-footer .ct-footer-border-top', [ 'border-top-color' ] );

    /** Footer Settings : headline margin **/
    range_live_media_load( 'apex_business_footer_widget_title_bottom_margin_control', '.footer-block .widget-title', [ 'margin-bottom'], 'px' );

     /** Footer Settings : Title color **/
    ct_customizer_live_load( 'apex_business_footer_widget_title_color_setting', '#theme-footer .footer-block .widget-title', [ 'color' ] );

     /** Footer Settings : Text color **/
    ct_customizer_live_load( 'apex_business_footer_widget_text_color_setting', '#theme-footer .footer-block .widget p, #theme-footer .footer-block .widget li, #theme-footer .footer-block .widget td, #theme-footer .footer-block .widget th, #theme-footer .footer-block .widget span, #theme-footer .footer-block .widget th, #theme-footer .footer-block .widget figcaption', [ 'color' ] );

     /** Footer Settings : Link color **/
    ct_customizer_live_load( 'apex_business_footer_widget_link_color_setting', '#theme-footer .footer-block .widget a', [ 'color' ] );

    /** Footer Settings : link hover color **/
    ct_customizer_live_load( 'apex_business_footer_widget_link_hover_color_setting', '#theme-footer .footer-block .widget a:hover', [ 'color' ] );

    /** Bottom bar Settings : bg color **/
    ct_customizer_live_load( 'apex_business_bottom_bar_bgcolor_setting', '.ct-footer-bottom-bg', [ 'background-color' ] );

    /** Bottom bar Settings : text color **/
    ct_customizer_live_load( 'apex_business_bottom_bar_text_color_setting', '.ct-copyright-content-color', [ 'color' ] );

    /** Bottom bar Settings : link color **/
    ct_customizer_live_load( 'apex_business_bottom_bar_link_color_setting', '.footer-bottom .copyright-content a, .footer-bottom li a', [ 'color' ] );

    /** Bottom bar Settings : Font-size **/
    range_live_media_load( 'apex_business_bottom_bar_text_size_control', '.footer-bottom .copyright-content', [ 'font-size' ], 'px' );

    /** Bottom bar Settings : Font-size **/
    range_live_media_load( 'apex_business_bottom_bar_menu_text_size_control', '#footer-menu li a', [ 'font-size' ], 'px' );

    /** Bottom bar Settings : top bottom padding **/
    range_live_media_load( 'apex_business_bottom_bar_padding_control', '.footer-bottom', [ 'padding-top', 'padding-bottom' ], 'px' );

    /** Bottom bar Settings : border top **/
    range_live_media_load( 'apex_business_bottom_bar_top_border_control', '.footer-bottom', [ 'border-top-width'], 'px' );

    /** Bottom bar Settings : bg color **/
    ct_customizer_live_load( 'apex_business_bottom_bar_border_color_setting', '.footer-bottom', [ 'border-top-color' ] );

    /***************************************************************************
    * banner Settings
    ***************************************************************************/
    /** archive Banner Settings : background image **/
    ct_customizer_background_image( 'apex_business_archive_banner_image_setting', '.archive-banner' );

     /** archive Banner Settings : background repeat **/
    ct_customizer_live_load( 'apex_business_archive_image_repeat_setting', '.archive-banner', [ 'background-repeat' ] );

    /** archive Banner Settings : background size **/
    ct_customizer_live_load( 'apex_business_blog_archive_size_setting', '.archive-banner', [ 'background-size' ] );

    /** archive Banner Settings : background attachment **/
    ct_customizer_live_load( 'apex_business_archive_image_attachment_setting', '.archive-banner', [ 'background-attachment' ] );

     /** archive Banner Settings : text color **/
    ct_customizer_live_load( 'apex_business_archive_text_color_setting', '.archive-banner .banner-content h1', [ 'color' ] );

     /** archive Banner Settings : bg color **/
    ct_customizer_live_load( 'apex_business_archive_bg_color_setting', '.archive-banner .color-overlay', [ 'background-color' ] );

    /** archive Banner Settings : font-size**/
    range_live_media_load( 'apex_business_archive_banner_font_size_control', '.archive-banner .banner-content h1', [ 'font-size' ], 'px' );

    /** archive Banner Settings : banner height **/
    range_live_media_load( 'apex_business_blog_banner_height_control', '.archive-banner .banner', [ 'height' ], 'px' );

    /** blog Banner Settings : banner height **/
    range_live_media_load( 'apex_business_archive_banner_height_control', '.archive-banner .banner', [ 'height' ], 'px' );

    /** Blog Banner Settings : background image **/
    ct_customizer_background_image( 'apex_business_blog_banner_image_setting', '.blog-banner' );

     /** blog Banner Settings : background repeat **/
    ct_customizer_live_load( 'apex_business_banner_image_repeat_setting', '.blog-banner', [ 'background-repeat' ] );

    /** blog Banner Settings : background size **/
    ct_customizer_live_load( 'apex_business_blog_banner_size_setting', '.blog-banner', [ 'background-size' ] );

    /** blog Banner Settings : background attachment **/
    ct_customizer_live_load( 'apex_business_banner_image_attachment_setting', '.blog-banner', [ 'background-attachment' ] );

    /** blog Banner Settings : text color **/
    ct_customizer_live_load( 'apex_business_banner_text_color_setting', '.blog-banner .banner-content h1', [ 'color' ] );

    /** blog Banner Settings : text color **/
    ct_customizer_live_load( 'apex_business_banner_bg_color_setting', '.blog-banner .color-overlay', [ 'background-color' ] );

    /** blog Banner Settings : banner height **/
    range_live_media_load( 'apex_business_blog_banner_height_control', '.blog-banner .banner', [ 'height' ], 'px' );

    /** blog Banner Settings : banner height **/
    range_live_media_load( 'apex_business_blog_banner_font_size_control', '.blog-banner .banner-content h1', [ 'font-size' ], 'px' );

    /***************************************************************************
    * Back To Top Buttom Settings
    ***************************************************************************/
    /** Back To Top Buttom Settings :border-radius **/
    range_live_media_load( 'apex_business_back_to_top_border_radius_control', '.back-to-top span', [ 'border-radius' ], 'px' );

    ct_customizer_live_load( 'apex_business_back_to_top_bgcolor_setting', '.back-to-top span', [ 'background-color' ] );

    ct_customizer_live_load( 'apex_business_back_to_top_icon_color_setting', '.back-to-top span', [ 'color' ] );

    /***************************************************************************
    * Blog entry style
    ***************************************************************************/
    ct_customizer_live_load( 'apex_business_blog_title_color_setting', '.blog .entry-container .entry-header .entry-title a', [ 'color' ] );

    range_live_media_load( 'apex_business_blog_entry_title_font_size_control', '.blog .entry-container .entry-header .entry-title a', [ 'font-size' ], 'px' );

    ct_customizer_live_load( 'apex_business_blog_entry_meta_color_setting', '.blog .entry-container .entry-meta li span::before', [ 'color' ] );

    /***************************************************************************
    * single post style
    ***************************************************************************/
    ct_customizer_live_load( 'apex_business_single_post_title_color_setting', '.single-post .entry-container .entry-header .entry-title', [ 'color' ] );

    range_live_media_load( 'apex_business_single_post_title_font_size_control', '.single-post .entry-container .entry-header .entry-title', [ 'font-size' ], 'px' );

    ct_customizer_live_load( 'apex_business_single_post_meta_color_setting', '.single-post .entry-container .entry-meta li span::before', [ 'color' ] );

    /***************************************************************************
    * Footer Title style
    ***************************************************************************/

    range_live_media_load( 'apex_business_footer_widget_title_font_size_control', '#theme-footer .footer-widget .widget-title', [ 'font-size' ], 'px' );

    /***************************************************************************
    * Woo settings
    ***************************************************************************/
    ct_customizer_live_load( 'apex_business_woo_single_bg_color_setting', 'body.single-product .hentry .entry-container', [ 'background-color' ] );

    /***************************************************************************
    * Blog Meta
    ***************************************************************************/
    /** Blog : Social Share Color**/
    ct_customizer_live_load( 'apex_business_social_share_color_setting', '.ct-social-share a span', [ 'color' ] );

    // Declare variables
    var api = wp.customize;
    api(
        'apex_business_section_height_control', function( value ) {
            'use strict';
                value.bind(
                    function( to ){
                    var values          = JSON.parse( to );
                    var desktop_value   = JSON.parse( values.desktop );
                    var tablet_value    = JSON.parse( values.tablet );
                    var mobile_value    = JSON.parse( values.mobile );
                    var class_name      = $( '.customizer-website-section-height' );
                    var head_append     = '<style class="customizer-website-section-height">@media (min-width: 320px){ .theme-padding { padding: ' + mobile_value + 'px; } } @media (min-width: 720px){ .theme-padding { padding: ' + tablet_value + 'px; } } @media (min-width: 960px){ .theme-padding { padding: ' + desktop_value + 'px; } }</style>';

                    if (class_name.length) {
                        class_name.replaceWith(head_append);
                    } else {
                        $( 'head' ).append(head_append);
                    }
                }
            );
        }
    ), api(
        'apex_business_sidebar_width_control', function( value ) {
            'use strict';
            value.bind(
                function( to ){
                    var class_name      = 'customizer-sidebar-width'; // Used as id in gfont link
                    var css_class       = $( '.' + class_name );

                    var sidebar_width   = to;
                    var content_width   = ( 100 - to );

                    var head_append     = '<style class="' + class_name + '">.ct-sidebar { width: ' + sidebar_width + '%; } .ct-content-area { width: ' + content_width + '%; }</style>';

                    if ( css_class.length ) {
                        css_class.replaceWith( head_append );
                    } else {
                        $( 'head' ).append( head_append );
                    }
                }
            );
        }
    );

}(jQuery))
