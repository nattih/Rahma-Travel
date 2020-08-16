<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
    <!--== Start footer Area ==-->
    <footer id="theme-footer">
        <?php
                $apex_business_footer_columns = get_theme_mod( 'apex_business_footer_columns_control', 3 );

                if ( $apex_business_footer_columns == '' ) {
                    $apex_business_footer_columns = 3;
                }

                switch ( $apex_business_footer_columns ) {
                    case 1:
                        $apex_business_footer_grid = '12';
                        break;

                    case 2:
                        $apex_business_footer_grid = '6';
                        break;

                    case 3:
                        $apex_business_footer_grid = '4';
                        break;

                    case 4:
                        $apex_business_footer_grid = '3';
                        break;

                    default:
                        $apex_business_footer_grid = '4';
                        break;
                }
        ?>


        <?php if ( is_active_sidebar( 'apex_business_footer_widget_1' )
                    || is_active_sidebar( 'apex_business_footer_widget_2' )
                    || is_active_sidebar( 'apex_business_footer_widget_3' )
                    || is_active_sidebar( 'apex_business_footer_widget_4' ) ) : ?>
            <div class="theme-padding ct-footer-bg ct-footer-border-top">
                <div class="container">
                    <div class="row">

                        <?php for ( $apex_business_i = 1; $apex_business_i <= $apex_business_footer_columns; $apex_business_i++ ) : ?>
                            <div class="col-md-<?php echo esc_attr( $apex_business_footer_grid ); ?>">
                                <?php $apex_business_underline = '';
                                    if ( get_theme_mod( 'apex_business_f_menu_ul_switch_setting' ) ) {
                                        $apex_business_underline = 'menu-underline';
                                    }
                                ?>
                                <div class="footer-block">
                                    <div class="widget footer-widget clearfix <?php echo esc_attr( $apex_business_underline ); ?>">
                                        <?php
                                            if ( is_active_sidebar( "apex_business_footer_widget_$apex_business_i" ) ) {
                                                dynamic_sidebar( "apex_business_footer_widget_$apex_business_i" );
                                            }
                                        ?>
                                    </div><!-- /.widget .footer-widget -->
                                </div><!-- /.footer-block -->
                            </div><!-- /.col-md-? -->
                        <?php endfor; ?>

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-content -->
        <?php endif; ?>
    </footer>

    <?php
        /* translators: %1$s: Anchor link start %2$s: Anchor link end */
        $apex_business_editor       = get_theme_mod( 'apex_business_bottom_bar_content_control', sprintf( __( 'Apex Business WordPress Theme | Designed by %1$sCrafthemes%2$s', 'apex-business' ),
                                    '<a href="https://www.crafthemes.com">',
                                    '</a>'
                                ) );
        $apex_business_layout_type  = get_theme_mod( 'apex_business_footer_layout_control', 'default-bottom-bar' );

        $apex_business_layout_grid  = '6';
        $apex_business_center_class = '';

        if ( $apex_business_layout_type == 'center-bottom-bar' ) {
            $apex_business_layout_grid  = '12';
            $apex_business_center_class = 'footer-center';
        }
    ?>
        <?php if ( get_theme_mod( 'apex_business_bottom_bar_switch_setting', 'true' ) ) : ?>
         <div class="footer-bottom ct-footer-bottom-bg">
            <div class="container">
                <div class="row">
                    <?php if ( $apex_business_layout_type == 'default-bottom-bar' ) : ?>
                        <div class="col-md-<?php echo esc_attr( $apex_business_layout_grid ); ?>">
                            <?php if ( $apex_business_editor ) : ?>
                                <div class="copyright-content ct-copyright-content-color <?php echo esc_attr( $apex_business_center_class ); ?>">
                                    <?php echo wp_kses_post( $apex_business_editor ); ?>
                                </div><!-- /.copyright-content -->
                            <?php endif; ?>
                        </div><!-- /.col-md-? -->
                    <?php endif; ?>

                    <div class="col-md-<?php echo esc_attr( $apex_business_layout_grid ); ?>">
                        <?php
                            $apex_business_left_class = '';

                            if ( $apex_business_layout_type == 'left-bottom-bar' ) {
                                $apex_business_left_class = 'footer-left';
                            }

                            if ( has_nav_menu( 'footer_menu' ) ) {
                                wp_nav_menu(
                                    array(
                                        'theme_location'    => 'footer_menu',
                                        'container'         => 'li',
                                        'menu_id'           => 'footer-menu',
                                        'menu_class'        => 'footer-menu-items ' . $apex_business_center_class . ' ' . $apex_business_left_class,
                                        'depth'             => 1,
                                    )
                                );
                            }
                        ?>
                    </div><!-- /.col-md-? -->
                    <?php if ( ( $apex_business_layout_type == 'center-bottom-bar' ) || ( $apex_business_layout_type == 'left-bottom-bar' ) ) : ?>
                        <?php
                            $apex_business_right_class = '';

                            if ( $apex_business_layout_type == 'left-bottom-bar' ) {
                                $apex_business_right_class = 'footer-right';
                            }
                        ?>
                        <div class="col-md-<?php echo esc_attr( $apex_business_layout_grid ); ?>">
                            <?php if ( $apex_business_editor ) : ?>
                                <div class="copyright-content ct-copyright-content-color <?php echo esc_attr( $apex_business_center_class ); ?> <?php echo esc_attr( $apex_business_right_class ); ?>">
                                    <?php echo wp_kses_post( $apex_business_editor ); ?>
                                </div><!-- /.copyright-content -->
                            <?php endif; ?>
                        </div><!-- /.col-md-? -->
                    <?php endif; ?>

                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-bottom -->
        <?php endif; ?>
    <!--== End footer Area ==-->

    <?php if ( get_theme_mod( 'apex_business_box_layout_switch_setting' ) ) : ?>
        </div>
    <?php endif; ?>

    <?php if ( get_theme_mod( 'apex_business_back_to_top_switch_setting', 'true' ) ) : ?>
        <!--== Start Back to Top ==-->
        <a href="#" class="back-to-top" id="back-to-top" style="">
            <span class="fa <?php echo esc_attr( get_theme_mod( 'apex_business_btt_icon_picker', 'fa-angle-up' ) ); ?>"></span>
        </a>
        <!--== End Back to Top ==-->
    <?php endif; ?>

    <?php wp_footer(); ?>
</body>
</html>
