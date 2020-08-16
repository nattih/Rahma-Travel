<?php
    if ( !is_page() ) :
        if ( is_active_sidebar( 'apex_business_main_sidebar' ) ) :
?>
            <div class="col-md-4 ct-sidebar ct-sidebar-bg ct-sidebar-padding">
                <div class="sidebar blog-sidebar">
                    <div class="side-bar-widget">
                        <?php dynamic_sidebar( 'apex_business_main_sidebar' ); ?>
                    </div><!-- /.side-bar-widget -->
                </div><!-- /.side-bar -->
            </div><!-- /.col-md-4 -->
<?php
        endif;
    endif;

    if ( is_page() ) :
        if ( is_active_sidebar( 'apex_business_page_sidebar' ) ) :
?>
            <div class="col-md-4 ct-sidebar">
                <div class="sidebar page-sidebar">
                    <div class="side-bar-widget">
                        <?php dynamic_sidebar( 'apex_business_page_sidebar' ); ?>
                    </div><!-- /.side-bar-widget -->
                </div><!-- /.side-bar -->
            </div><!-- /.col-md-4 -->
<?php
        endif;
    endif;
?>
