<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */
get_header();

$apex_business_fullwidth_stats = 'col-md-8 ct-content-area';
if ( !is_active_sidebar( 'apex_business_main_sidebar' )
    && ( get_theme_mod( 'apex_business_single_sidebar_layout_control' ) == 'no-sidebar' ) ) {
    $apex_business_fullwidth_stats = 'col-md-12';
}

if ( get_theme_mod( 'apex_business_single_sidebar_layout_control', 'right-sidebar' ) == 'center-content' ) {
    $apex_business_fullwidth_stats = 'col-md-8 col-md-offset-2';
}
?>
<section id="content" class="single-blog theme-padding">
    <div class="container">
        <div class="row">
            <?php
                if ( get_theme_mod( 'apex_business_single_sidebar_layout_control' ) == 'left-sidebar' ) :
                    get_sidebar();
                endif;
            ?>

            <div class="<?php echo esc_attr( $apex_business_fullwidth_stats ); ?>">
                <?php
                    if ( have_posts() ) :

                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content/content', 'single' );

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

            <?php
                if ( get_theme_mod( 'apex_business_single_sidebar_layout_control', 'right-sidebar' ) == 'right-sidebar' ) :
                    get_sidebar();
                endif;
            ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.single-blogs -->

<?php
get_footer();
