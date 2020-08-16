<?php
	$footer_layout = get_theme_mod( 'resoto_footer_layout', 'layout1' );
	$footer_logo = get_theme_mod( 'resoto_footer_logo', '' );
	$facebook_link = get_theme_mod( 'resoto_footer_facebook', '' );
	$twitter_link = get_theme_mod( 'resoto_footer_twitter', '' );
	$instagram_link = get_theme_mod( 'resoto_footer_instagram', '' );
	$youtube_link = get_theme_mod( 'resoto_footer_youtube', '' );
	$copyright_text = get_theme_mod( 'resoto_copyright_text', '' );
?>
<footer id="colophon" class="site-footer <?php echo esc_attr( $footer_layout ); ?>">
	<?php if( $footer_logo ) : ?>
		<div class="footer-logo-wrap">
			<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr__( 'Footer Logo', 'resoto' ); ?>" />
		</div>
	<?php endif; ?>

	<?php
		if( has_nav_menu( 'footer-menu' ) ) {
			echo "<div class='footer-menu'>";
				wp_nav_menu( array(
				    'theme_location' => 'footer-menu',
				    'container' => false
				) );
			echo "</div>";
		}
	?>

	<?php if( $facebook_link || $twitter_link || $instagram_link || $youtube_link ) : ?>
		<div class="footer-social-links">
			<ul>
				<?php if( $facebook_link ) : ?>	
					<li>
						<a href="<?php echo esc_url( $facebook_link ); ?>"><span class="lni-facebook"></span></a>
					</li>
				<?php endif; ?>
				<?php if( $twitter_link ) : ?>
					<li>
						<a href="<?php echo esc_url( $twitter_link ); ?>"><span class="lni-twitter"></span></a>
					</li>
				<?php endif; ?>
				<?php if( $instagram_link ) : ?>	
					<li>
						<a href="<?php echo esc_url( $instagram_link ); ?>"><span class="lni-instagram"></span></a>
					</li>
				<?php endif; ?>
				<?php if( $youtube_link ) : ?>
					<li>
						<a href="<?php echo esc_url( $youtube_link ); ?>"><span class="lni-youtube"></span></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>

	<div class="site-info">
		<div>
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
	</div> <!-- .site-info -->
</footer><!-- #colophon -->