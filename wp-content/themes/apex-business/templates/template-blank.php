<?php
/**
 * Template Name: Blank Page Template
 * Template Post Type: post, page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <!-- Mobile Specific Data -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="content" class="site-content">
        <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
        ?>
    </div><!-- #content -->
<?php wp_footer(); ?>
</body>
</html>
