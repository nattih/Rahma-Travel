/**
 * Update Typography Customizer settings live.
 */

( function( $ ){

    // Declare variables
    var api = wp.customize;

    /**
     * Outputs custom css for responsive controls
     * @param  {[string]} sub_setting   part of the control except theme prefix and 'control' suffix
     * @param  {[string]} css_selector
     * @param  {[string]} css_prop     css property to write
     * @param  {String} ext            css value extension eg: px, in
     * @return {[string]}                css output
     */
    function typography_live_media_load( sub_setting, css_selector, css_prop, ext = '') {
        wp.customize(
            'apex_business_' + sub_setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-typography-' + sub_setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + property_name + ': ' + mobile_value + ext + '; } } @media (min-width: 720px){ ' + selector_name + ' { ' + property_name + ': ' + tablet_value + ext + '; } } @media (min-width: 960px){ ' + selector_name + ' { ' + property_name + ': ' + desktop_value + ext + '; } }</style>';

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

    /**
     * Outputs custom css for non responsive controls
     * @param  {[string]} sub_setting   part of the control except theme prefix
     * @param  {[string]} css_selector
     * @param  {[string]} css_prop     css property to write
     * @return {[string]}                css output
     */
    function typography_live_load( sub_setting, css_selector, css_prop ) {
        wp.customize(
            'apex_business_' + sub_setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var class_name      = 'customizer-typography-' + sub_setting; // Used as id in gfont link
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        if( property_name == 'font-family' ) {
                            var css_link_id      = $( '#' + class_name );
                            var font_weight      = '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
                            var font_url         = 'https://fonts.googleapis.com/css?family=';
                            var font_url_struc   = to.split( ',' )[0];
                            var font_url_struc   = font_url_struc.replace( / /g, "%20" );

                            var full_url         =  font_url + font_url_struc + ':' + font_weight;
                            var head_link_append = '<link id="' + class_name + '" rel="stylesheet" type="text/css" href="' + full_url + '">';

                            if ( css_link_id.length ) {
                                css_link_id.attr( 'href', full_url );
                            } else {
                                $( 'head' ).append( head_link_append );
                            }
                        }

                        var head_append     = '<style class="' + class_name + '">' + selector_name + ' { ' + property_name + ': ' + to + '; }</style>';

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

    var object = new Object();

    object['body']       = 'body';
    object['h1']         = 'h1';
    object['h2']         = 'h2';
    object['h3']         = 'h3';
    object['h4']         = 'h4';
    object['h5']         = 'h5';
    object['h6']         = 'h6';
    object['blockquote, blockquote p, blockquote span, blockquote a'] = 'blockquote';
    object['a']          = 'link';
    object['.main-nav > li > a'] = 'header';
    object['button, .button, .nav-button'] = 'button';
    object['#theme-footer .footer-widget .widget-title'] = 'footer_widget_title';
    object['.single-post .entry-container .entry-header .entry-title'] = 'single_post_title';
    object['.blog .entry-container .entry-header .entry-title a'] = 'blog_title';

    /******** TYPOGRAPHY OPTIONS *********/
    for( var i in object ) {
        var sub_control_font_family     = object[i] + '_font_family_control';
        var sub_control_font_weight     = object[i] + '_font_weight_setting';
        var sub_control_font_style      = object[i] + '_font_style_setting';
        var sub_control_font_color      = object[i] + '_color_setting';
        var sub_control_text_transform  = object[i] + '_text_transform_setting';

        var sub_control_font_size       = object[i] + '_font_size_control';
        var sub_control_line_height     = object[i] + '_line_height_control';

        typography_live_load( sub_control_font_family, i, 'font-family' );
        typography_live_load( sub_control_font_weight, i, 'font-weight' );
        typography_live_load( sub_control_font_style, i, 'font-style' );
        typography_live_load( sub_control_font_color, i, 'color' );
        typography_live_load( sub_control_text_transform, i, 'text-transform' );

        typography_live_media_load( sub_control_font_size, i, 'font-size', 'px' );
        typography_live_media_load( sub_control_line_height, i, 'line-height' );
    }
} ( jQuery ) )
