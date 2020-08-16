<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */

get_header();

if ( have_posts() ) :
?>
<section class="page-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap clearfix vertical-center">
                        <div class="page-title">
                            <h1><?php esc_html_e( 'Search results for: ', 'apex-business' ); ?><?php echo get_search_query(); ?></h1>
                        </div><!-- /.page-title -->
                    </div><!-- /.wrap -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.page-banner-area -->
<?php endif; ?>

<?php if ( have_posts() ) : ?>
    <section class="news-section blog theme-padding">
        <div class="container">
            <div class="row grid">
                <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content/content', 'excerpt' );

                    endwhile; // End of the loop.
                ?>
            </div><!-- /.row -->
            <?php
                // Pagination
                get_template_part( 'template-parts/pagination/pagination', get_post_format() );
            ?>
        </div><!-- /.container -->
    </section><!-- /.news-section theme-padding -->

    <?php else :
            get_template_part( 'template-parts/content/content', 'none' );
        endif;
    ?>
<?php
get_footer();
