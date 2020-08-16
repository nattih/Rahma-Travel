<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
get_header();
?>

<?php if ( get_theme_mod( 'apex_business_archive_banner_disable_setting', true ) != '' ) : ?>
<section class="main-banner-area archive-banner">
    <div class="banner">
        <div class="color-overlay"></div><!-- /.color-overlay -->
            <div class="banner-content">
                <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
            </div><!-- /.banner-content -->
    </div><!-- /.banner -->
</section><!-- /.main-banner-area -->
<?php endif; ?>

 <?php if ( have_posts() ) : ?>
    <section id="content"  class="theme-padding">
        <div class="container">
            <div class="row">
                <?php
                    $apex_business_fullwidth_stats = 'col-md-8 ct-content-area';
                    if ( !is_active_sidebar( 'apex_business_main_sidebar' )
                        && ( get_theme_mod( 'apex_business_archive_sidebar_layout_control', 'no-sidebar' ) == 'no-sidebar' ) ) {
                        $apex_business_fullwidth_stats = 'col-md-12';
                    }
                ?>
                <?php if ( get_theme_mod( 'apex_business_archive_sidebar_layout_control', 'no-sidebar' ) == 'left-sidebar' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>
                <div class="<?php echo esc_attr( $apex_business_fullwidth_stats ); ?>">
                    <div class="ct-grid">
                        <?php
                            while ( have_posts() ) : the_post();

                                get_template_part( 'template-parts/content/content', 'excerpt' );

                            endwhile; // End of the loop.
                        ?>
                    </div><!-- /.grid -->
                </div><!-- /.col-md-? -->
                <?php if ( get_theme_mod( 'apex_business_archive_sidebar_layout_control', 'no-sidebar' ) == 'right-sidebar' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>
            </div><!-- /.row -->
            <?php
            // Pagination
            get_template_part( 'template-parts/pagination/pagination', get_post_format() );
            ?>

        </div><!-- /.container -->
    </section><!-- /.news-section theme-padding -->

    <?php
        else :
            get_template_part( 'template-parts/content/content', 'none' );
        endif;
    ?>

<?php
get_footer();
