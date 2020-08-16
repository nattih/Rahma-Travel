<?php
	$footer_layout = get_theme_mod( 'resoto_footer_layout', 'layout1' );
	$copyright_text = get_theme_mod( 'resoto_copyright_text', '' );
?>
<?php if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
	<footer id="colophon" class="site-footer <?php echo esc_attr( $footer_layout ); ?>">
		<div class="rcontainer">
			<div class="top-footer">
					<?php if( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php endif; ?>

					<?php if( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php endif; ?>

					<?php if( is_active_sidebar( 'footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-3' ); ?>
					<?php endif; ?>

					<?php if( is_active_sidebar( 'footer-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-4' ); ?>
					<?php endif; ?>
			</div>		
		</div> <!-- .rcontainer -->
	</footer><!-- #colophon -->
<?php endif; ?>
<div class="bottom-footer">
	<div class="rcontainer">
		<?php
			if( $copyright_text ) {
				echo wp_kses_post( $copyright_text );
			} else {
				echo esc_html__( '&copy; 2019 | All Rights Reserved', 'resoto' );
			}
		?>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf( esc_html__( 'Theme: %1$s by %2$s.', 'resoto' ), 'resoto', '<a href="https://mysticalthemes.com/">MysticalThemes</a>' );
		?>
	</div>
</div>