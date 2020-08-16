<?php
/**
 * Template Name: Full Width Template
 * Template Post Type: post, page
 */

get_header();
?>
<div id="site-content">

    <?php

    if ( have_posts() ) {

        while ( have_posts() ) {
            the_post();

            get_template_part( 'template-parts/content/content', 'fullwidth' );
        }
    }

    ?>

</div><!-- #site-content -->
<?php
get_footer();
