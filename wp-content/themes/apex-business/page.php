<?php
/**
 * The template for displaying single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();
?>
    <!-- if left sidebar is set -->
    <?php
        $apex_business_fullwidth_stats = 'col-md-8 ct-content-area';
        if ( !is_active_sidebar( 'apex_business_page_sidebar' )
            && ( get_theme_mod( 'apex_business_page_sidebar_layout_control', 'right-sidebar' ) == 'no-sidebar' ) ) {
            $apex_business_fullwidth_stats = 'col-md-12';
        }

        if ( get_theme_mod( 'apex_business_page_sidebar_layout_control', 'right-sidebar' ) == 'center-content' ) {
            $apex_business_fullwidth_stats = 'col-md-8 col-md-offset-2';
        }
    ?>
    <div class="container theme-padding">
        <div class="row">
            <?php if ( get_theme_mod( 'apex_business_page_sidebar_layout_control', 'right-sidebar' ) == 'left-sidebar' ): ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>
            <div class="<?php echo esc_attr( $apex_business_fullwidth_stats ); ?>">

                <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                        endwhile; // End of the loop.
                    else :

                        get_template_part( 'template-parts/content/content', 'none' );

                    endif;
                ?>

            </div><!-- /.col-md-? -->
            <?php if ( get_theme_mod( 'apex_business_page_sidebar_layout_control', 'right-sidebar' ) == 'right-sidebar' ): ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
<?php
get_footer();
