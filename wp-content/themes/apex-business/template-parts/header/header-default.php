<?php
/**
 * Header Layout: Main header
 */

    $apex_business_fixed_header = '';
    if ( get_theme_mod( 'apex_business_sticky_header_switch_setting' ) ) {
        $apex_business_fixed_header = 'fixed-header';
    }

    $apex_business_transparent_bar = '';
    if ( get_theme_mod( 'apex_business_transparent_header_buttom_border_setting', 0 ) == 1 ) {
        $apex_business_transparent_bar = ( get_post_meta( get_the_ID(), '_header_option_value_key', TRUE ) == 'ct-transparent-header' ) ? 'ct-trans-bar' : '';
    }
?>
<div class="main-header header-spacing no-stick <?php echo esc_attr( $apex_business_fixed_header ); ?>  <?php echo esc_attr( $apex_business_transparent_bar ); ?>">
    <div class="container">
        <div class="row nav-menu">
            <div class="col-md-12 vertical-center header-col">
                <div class="site-logo logo-vertical-spacing">
                    <?php get_template_part( 'template-parts/header/logo', 'default' ); ?>
                </div><!-- /.site-logo -->

                <?php get_template_part( 'template-parts/header/menu', 'main' ); ?>
                <?php get_template_part( 'template-parts/header/menu', 'search' ); ?>

                <!-- Mobile Menu Icon -->
                <?php if ( has_nav_menu( 'mobile_menu' ) || has_nav_menu( 'header_menu' ) ) : ?>
                    <a href="#" class="js-ct-menubar-right menubar-right"><i class="fa fa-bars"></i></a>
                <?php endif; ?>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->

    <?php get_template_part( 'template-parts/header/menu', 'mobile' ); ?>
</div><!-- /.main-header -->
