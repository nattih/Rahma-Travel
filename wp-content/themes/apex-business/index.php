<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<?php if ( get_theme_mod( 'apex_business_blog_banner_content_setting', esc_html__( 'Blog', 'apex-business' ) ) != '' ) : ?>
<section class="main-banner-area blog-banner">
    <div class="banner">
        <div class="color-overlay"></div><!-- /.color-overlay -->
            <div class="banner-content">
                <h1><?php echo esc_html( get_theme_mod( 'apex_business_blog_banner_content_setting', esc_html__( 'Blog', 'apex-business' ) ) ); ?></h1>
            </div><!-- /.banner-content -->
    </div><!-- /.banner -->
</section><!-- /.main-banner-area -->
<?php endif; ?>

<?php if ( have_posts() ) : ?>
<section id="content" class="theme-padding">
    <div class="container">
        <div class="row">
            <?php
                $apex_business_fullwidth_stats = 'col-md-8 ct-content-area';
                if ( !is_active_sidebar( 'apex_business_main_sidebar' )
                    && ( get_theme_mod( 'apex_business_default_sidebar_layout_control', 'right-sidebar' ) == 'no-sidebar' ) ) {
                    $apex_business_fullwidth_stats = 'col-md-12';
                }

                if ( get_theme_mod( 'apex_business_default_sidebar_layout_control', 'right-sidebar' ) == 'left-sidebar' ) :
                    get_sidebar();
                endif;
            ?>
            <div class="<?php echo esc_attr( $apex_business_fullwidth_stats ); ?>">
                <div class="ct-grid">
                <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content/content' );

                    endwhile; // End of the loop.
                ?>
                </div><!-- /.grid -->
            </div><!-- /.col-md-? -->
            <?php
                if ( get_theme_mod( 'apex_business_default_sidebar_layout_control', 'right-sidebar' ) == 'right-sidebar' ) :
                    get_sidebar();
                endif;
            ?>
        </div><!-- /.row -->
        <?php
            // Pagination
           if ( function_exists( 'apex_business_pagination_op' ) ) {
                apex_business_pagination_op();
           } else {
                get_template_part( 'template-parts/pagination/pagination', get_post_format() );
           }
        ?>
    </div><!-- /.container -->
</section><!-- /.news-section theme-padding -->
<?php
    else :
        get_template_part( 'template-parts/content/content', 'none' );
    endif;

get_footer();
