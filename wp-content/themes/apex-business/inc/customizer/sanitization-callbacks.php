<?php
/**
 * Sanitization: Select
 *
 * @param  string select setting input.
 * @return string        setting input value.
 */
function apex_business_sanitize_select( $input ) {
  $valid = array(
    'inherit'       =>  'Default',
    '100'           =>  'Thin: 100',
    '200'           =>  'Light: 200',
    '300'           =>  'Book: 300',
    '400'           =>  'Normal: 400',
    '500'           =>  'Medium: 500',
    '600'           =>  'Semibold: 600',
    '700'           =>  'Bold: 700',
    '800'           =>  'Extra Bold: 800',
    '900'           =>  'Black: 900',
    'inherit'       =>  'Normal',
    'italic'        =>  'Italic',
    'uppercase'     =>  'Uppercase',
    'lowercase'     =>  'Lowercase',
    'capitalize'    =>  'Capitalize',
    'fade'          =>  'Fade',
    'slide'         =>  'Slide',
    'no-repeat'     =>  'No Repeat',
    'repeat'        =>  'Repeat All',
    'repeat-x'      =>  'Repeat X',
    'repeat-y'      =>  'Repeat Y',
    'cover'         =>  'Cover',
    'contain'       =>  'Contain',
    'auto'          =>  'Auto',
    'scroll'        =>  'Scroll',
    'fixed'         =>  'Fixed',
    'none'          =>  'none',
    'search-icon'   =>  'Search Icon',
    'button'        =>  'Button',
    'list'          =>  'List',
    'masonry'       =>  'Masonry',
    'excerpt'       =>  'Excerpt',
    'content'       =>  'Content',
    'latin'         =>  'latin',
    'latin-ext'     =>  'latin-ext',
    'cyrillic'      =>  'cyrillic',
    'cyrillic-ext'  =>  'cyrillic-ext',
    'greek'         =>  'greek',
    'greek-ext'     =>  'greek-ext',
    'vietnamese'    =>  'vietnamese',
    'infinite-scroll'    =>  'Infinite Scroll',
    'pagination'    => 'Pagination',
  );

  if ( array_key_exists( $input, $valid ) ) {
    return $input;
  } else {
    return '';
  }
}

/**
 * Sanitization: Alpha color
 *
 * @param  string $color setting input.
 * @return string        setting input value.
 */
function apex_business_sanitize_alpha_color( $color ) {
  if ( '' === $color ) {
    return '';
  }
  if ( false === strpos( $color, 'rgba' ) ) {
    /* Hex sanitize */
    return sanitize_hex_color( $color );
  }
  /* rgba sanitize */
  $color = str_replace( ' ', '', $color );
  sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
  return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

/**
 * Validation: image
 * Control: text, WP_Customize_Image_Control
 *
 * @uses  wp_check_filetype()   https://developer.wordpress.org/reference/functions/wp_check_filetype/
 * @uses  in_array()        http://php.net/manual/en/function.in-array.php
 */

function apex_business_validate_image( $input, $default = '' ) {
  /* default output */
    $output = '';

    /* check file type */
    $filetype = wp_check_filetype( $input );
    $mime_type = $filetype['type'];

    /* only mime type "image" allowed */
    if ( strpos( $mime_type, 'image' ) !== false ){
        $output = $input;
    }

    return $output;
}
