<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Resoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( has_post_thumbnail() ) : ?>
		<?php
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
		?>
		<div class="post-image">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
			</a>
		</div>
	<?php endif; ?>

	<div class="post-metas">
		<?php resoto_posted_by( $author_avatar = true ); ?>
		<?php resoto_posted_on(); ?>
		<?php resoto_posted_category( get_the_id() ); ?>
		<?php resoto_comment_box(); ?>
	</div>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'resoto' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'resoto' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->