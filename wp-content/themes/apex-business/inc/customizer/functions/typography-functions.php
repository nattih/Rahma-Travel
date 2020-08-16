<?php

/*******************************************************************************
 * Loads google fonts to the theme
 * Thanks to themeshaper.com
 *******************************************************************************/

if ( ! function_exists( 'apex_business_fonts_url' ) ) :

function apex_business_fonts_url( $control, $subsets ) {
    $font_control    = esc_attr( get_theme_mod( $control ) );
    $subset          = get_theme_mod( $subsets );

    // Subsets
    if ( is_array( $subset ) ) {
        $subset = implode( ',', $subset );
    }

    // Sanitize handle
    $handle = trim( $font_control );
    $handle = strtolower( $handle );
    $handle = str_replace( ' ', '-', $handle );

    $fonts_url   = '';
    $font_weight = '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
    $font        = $font_control . ':' . $font_weight;
    $query_args  = array(
        'family' => $font,
        'subset' => urlencode( $subset ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    if ( $font_control && ( strpos( $font_control, ',' ) != true ) ) {
        // Enqueue style
        wp_enqueue_style( 'apex-business-gfonts-' . $handle , esc_url_raw( $fonts_url ), array(), '1.0.0'  );
    }
}

endif;

/**
 * [apex_business_font_family description]
 * @param  [string] $css_selector
 * @param  [string] $control the customier control id
 * @return [string] returns custom css
 */
function apex_business_font_family( $css_selector, $control, array $fsz_default, array $lh_default, $fc_default = '' ) {
    $font_family            = get_theme_mod( $control );
    $font_size_control      = str_replace( 'font_family', 'font_size', $control );
    $line_height_control    = str_replace( 'font_family', 'line_height', $control );
    $text_transform_control = str_replace( 'font_family_control', 'text_transform_setting', $control );
    $font_weight_control    = str_replace( 'font_family_control', 'font_weight_setting', $control );
    $font_style_control     = str_replace( 'font_family_control', 'font_style_setting', $control );
    $font_color_control     = str_replace( 'font_family_control', 'color_setting', $control );

    $font_size              = get_theme_mod( $font_size_control );
    $line_height            = get_theme_mod( $line_height_control );
    $text_transform         = get_theme_mod( $text_transform_control );
    $font_weight            = get_theme_mod( $font_weight_control );
    $font_style             = get_theme_mod( $font_style_control );
    $font_color             = get_theme_mod( $font_color_control );
    $return                 = '';

    if ( !empty( $font_family )
        || ( apex_business_media_range( 'font-size', $font_size, $fsz_default[0], 'desktop', 'px' ) != '' )
        || ( apex_business_media_range( 'line-height', $line_height, $lh_default[0] ) != '' )
        || ( !empty( $text_transform ) && $text_transform != 'inherit' )
        || ( !empty( $font_weight ) && $font_weight != 'inherit' )
        || ( !empty( $font_style ) && $font_style != 'inherit' )
        || ( !empty( $font_color ) && $font_color != $fc_default ) ) {
        $return .= $css_selector . ' { ';
    }

    if ( !empty( $font_family ) ) {
        $font_family_val = 'font-family: ' . $font_family . ';';
        $return         .= esc_attr( $font_family_val );
    }

    $return .= esc_attr ( apex_business_media_range( 'font-size', $font_size, $fsz_default[0], 'desktop', 'px' ) );
    $return .= esc_attr( apex_business_media_range( 'line-height', $line_height, $lh_default[0] ) );

    if ( !empty( $text_transform ) && $text_transform != 'inherit' ) {
        $text_transform_val = 'text-transform: ' . $text_transform . ';';
        $return            .= esc_attr( $text_transform_val );
    }

    if ( !empty( $font_weight ) && $font_weight != 'inherit' ) {
        $font_weight_val = 'font-weight: ' . $font_weight . ';';
        $return         .= esc_attr( $font_weight_val );
    }

    if ( !empty( $font_style ) && $font_style != 'inherit' ) {
        $font_style_val = 'font-style: ' . $font_style . ';';
        $return         .= esc_attr( $font_style_val );
    }

    if ( !empty( $font_color ) && $font_color != $fc_default ) {
        $font_color_val = 'color: ' . $font_color . ';';
        $return        .= esc_attr( $font_color_val );
    }

    if ( !empty( $font_family )
        || ( apex_business_media_range( 'font-size', $font_size, $fsz_default[0], 'desktop', 'px' ) != '' )
        || ( apex_business_media_range( 'line-height', $line_height, $lh_default[0] ) != '' )
        || ( !empty( $text_transform ) && $text_transform != 'inherit' )
        || ( !empty( $font_weight ) && $font_weight != 'inherit' )
        || ( !empty( $font_style ) && $font_style != 'inherit' )
        || ( !empty( $font_color ) && $font_color != $fc_default ) ) {
        $return .= ' } ';
    }

    if ( ( apex_business_media_range( 'font-size', $font_size, $fsz_default[1], 'tablet', 'px' ) != '' )
        || ( apex_business_media_range( 'line-height', $line_height, $lh_default[1], 'tablet' ) != '' ) ) {
        $return .= '@media (max-width:768px) { ';
        $return .= $css_selector . ' { ';
        $return .= esc_attr( apex_business_media_range( 'font-size', $font_size, $fsz_default[1], 'tablet', 'px' ) );
        $return .= esc_attr( apex_business_media_range( 'line-height', $line_height, $lh_default[1], 'tablet' ) );
        $return .= '} }';
    }

    if ( ( apex_business_media_range( 'font-size', $font_size, $fsz_default[2], 'mobile', 'px' ) != '' )
        || ( apex_business_media_range( 'line-height', $line_height, $lh_default[2], 'mobile' ) != '' ) ) {
        $return .= '@media (max-width:480px) { ';
        $return .= $css_selector . ' { ';
        $return .= esc_attr( apex_business_media_range( 'font-size', $font_size, $fsz_default[2], 'mobile', 'px' ) );
        $return .= esc_attr( apex_business_media_range( 'line-height', $line_height, $lh_default[2], 'mobile' ) );
        $return .= '} }';
    }

    $subsets = 'apex_business_typography_subsets_control';
    apex_business_fonts_url( $control, $subsets );

    return $return;
}
