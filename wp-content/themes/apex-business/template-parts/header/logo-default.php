<?php
/**
 * Header Logo
 */
$apex_business_transparency = get_post_meta( get_the_ID(), '_header_option_value_key', TRUE );

if ( $apex_business_transparency == 'ct-transparent-header'
    && get_theme_mod( 'apex_business_transparent_header_logo_setting' ) ) {

    // Get custom logo url
    $apex_business_custom_logo_id = get_theme_mod( 'custom_logo' );
    $apex_business_logo = wp_get_attachment_image_src( $apex_business_custom_logo_id , 'full' );

    echo '<a class="ct-transparent-logo" href="' . esc_url( home_url( '/' ) ) . '" rel="home"><img src="' . esc_url( wp_get_attachment_url( get_theme_mod( 'apex_business_transparent_header_logo_setting' ) ) ) . '" alt="' . esc_attr__( 'Transparent logo', 'apex-business' ) . '" data-main-logo="' . esc_url( $apex_business_logo[0] ) . '" data-transparent-logo="' . esc_url( wp_get_attachment_url( get_theme_mod( 'apex_business_transparent_header_logo_setting' ) ) ) . '"></a>';
} else if ( has_custom_logo() ) {
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
} else {
    ?>
        <div><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
    <?php
}

if ( get_theme_mod( 'apex_business_site_description_switch_setting', 0 ) ) {
    ?>
        <p><?php bloginfo( 'description' ); ?></p>
    <?php
}
