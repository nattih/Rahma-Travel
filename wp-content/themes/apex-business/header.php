<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything upto navigation menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <!-- Mobile Specific Data -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        }

        $apex_business_transparency = get_post_meta( get_the_ID(), '_header_option_value_key', TRUE );
    ?>
    <a class="skip-link" href="#content">
    <?php esc_html_e( 'Skip to content', 'apex-business' ); ?></a>

    <?php if ( get_theme_mod( 'apex_business_loading_bar_setting', true ) ) : ?>
        <div id="loading">
          <div id="pulse">
            <span></span> <!-- Wave 1 -->
            <span></span> <!-- Wave 2 -->
          </div><!-- #pulse -->
        </div><!-- /#loading -->
    <?php endif; ?>

    <?php if ( get_theme_mod( 'apex_business_box_layout_switch_setting' ) ) : ?>
        <div class="box-layout">
    <?php endif; ?>
        <!--== Start Header Area ==-->
        <header class="header-container fixed-spacing <?php echo esc_attr( $apex_business_transparency ); ?>">
            <!-- Start Topbar Area -->
            <?php if ( is_active_sidebar( 'apex-business-topbar-address' )
                    || is_active_sidebar( 'apex-business-topbar-office-hours' )
                    || is_active_sidebar( 'apex-business-topbar-email' )
                    || is_active_sidebar( 'apex-business-topbar-phone' )
                    || has_nav_menu( 'social_menu' ) ) : ?>
                <div class="top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="topbar-widgets">
                                    <?php if ( is_active_sidebar( 'apex-business-topbar-address' ) ) : ?>
                                        <span class="address topbar-content"><span class="fa-map-marker"></span>
                                            <?php dynamic_sidebar( 'apex-business-topbar-address' ); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ( is_active_sidebar( 'apex-business-topbar-office-hours' ) ) : ?>
                                        <span class="office-hour topbar-content"><span class="fa-clock-o"></span>
                                            <?php dynamic_sidebar( 'apex-business-topbar-office-hours' ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( is_active_sidebar( 'apex-business-topbar-phone' ) ) : ?>
                                        <span class="phone topbar-content"><span class="fa fa-phone"></span>
                                            <?php dynamic_sidebar( 'apex-business-topbar-phone' ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div><!-- /.topbar-widgets -->
                            </div><!-- /.col-md-8 -->

                            <div class="col-md-4">
                                <div class="section-right">
                                    <?php if ( is_active_sidebar( 'apex-business-topbar-email' ) ) : ?>
                                        <span class="e-mail topbar-content"><span class="fa-envelope"></span>
                                            <?php dynamic_sidebar( 'apex-business-topbar-email' ); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php
                                        if ( has_nav_menu( 'social_menu' ) ) {
                                            wp_nav_menu(
                                                    array(
                                                        'theme_location'    => 'social_menu',
                                                        'container'         => 'li',
                                                        'menu_id'           => 'menu-social-items',
                                                        'menu_class'        => 'menu-items menu-social',
                                                        'depth'             => 1,
                                                        'link_before'       => '<span class="screen-reader-text">',
                                                        'link_after'        => '</span>',
                                                        'fallback_cb'       => '',
                                                    )
                                            );
                                        }
                                    ?>
                                </div><!-- /.section-right -->
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.top-bar -->
            <?php endif; ?>
            <!-- End Topbar Area -->

            <?php
                $apex_business_header_layout = esc_attr( get_theme_mod( 'apex_business_header_layout_control', 'default' ) );
                get_template_part( 'template-parts/header/header', $apex_business_header_layout );
            ?>
        </header><!-- /.ct-header -->
        <!--== End Header Area ==-->
