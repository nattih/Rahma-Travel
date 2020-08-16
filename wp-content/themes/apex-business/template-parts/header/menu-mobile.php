<?php
/**
 * Mobile Menu
 */
?>
<div class="container mobile-menu-container">
    <div class="row">
        <div class="mobile-navigation">
            <nav class="nav-parent">
                <?php
                    if ( has_nav_menu( 'mobile_menu' ) ) :
                        wp_nav_menu( array(
                            'theme_location'    => 'mobile_menu',
                            'container'         => false,
                            'menu_class'        => 'mobile-nav',
                            'fallback_cb'       => 'wp_page_menu',
                            'depth'             => 4,
                            'walker'            => new Apex_Business_Dropdown_Toggle_Walker_Nav_Menu()
                        ) );
                    else :
                        wp_nav_menu( array(
                            'theme_location'    => 'header_menu',
                            'container'         => 'nav',
                            'fallback_cb'       => 'wp_page_menu',
                            'container_class'   => 'menu-all-pages-container',
                            'menu_class'        => 'main-nav',
                        ) );
                    endif;
                ?>
                <a href="#" class="js-ct-menubar-close menubar-close"><span class="fa fa-times"></span></a>
                <a href="#" class="js-blank-loop"></a>
            </nav>
        </div> <!-- /.mobile-navigation -->
    </div><!-- /.row -->
</div><!-- /.container -->
