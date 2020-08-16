<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */

get_header();
?>
  <section class="page-not-found theme-padding">
    <div class="container text-center">
       <div class="row">
          <div class="col-md-12">
              <div class="error-content inner-section">
                  <h2><?php esc_html_e( 'Nothing Found', 'apex-business' ); ?></h2>
                  <h4><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'apex-business' ); ?></h4>
              </div><!-- /.error-content -->
          </div><!-- /.col-md-12 -->
       </div><!-- /.row -->
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="error-search">
            <?php get_search_form(); ?>
          </div><!-- .error-content -->
        </div>
      </div>
    </div><!-- /.container -->
  </section>
<?php
get_footer();
