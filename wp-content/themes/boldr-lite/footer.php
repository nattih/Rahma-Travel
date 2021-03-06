<?php
/**
 *
 * BoldR Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2019 Iceable Media - Mathieu Sarrasin
 *
 * Footer Template
 *
 */


if ( is_active_sidebar( 'footer-sidebar' ) ) :
	?>
	<div id="footer">
		<div class="container">
			<ul>
				<?php dynamic_sidebar( 'footer-sidebar' ); ?>
			</ul>
		</div>
	</div>
	<?php
endif;

?>
<div id="sub-footer">
	<div class="container">
		<div class="sub-footer-left">

			<?php
			/* You are free to modify or replace this by anything you like as per the terms of the GPL license */
			?>

			<?php
			printf(
				// Translators: %1$s is the copyright date, %2$s is the site name (e.g. Copyright © 2018, My Website)
				esc_html__( 'Copyright &copy; %1$s %2$s.', 'boldr-lite' ),
				esc_html( date( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			echo ' ';
			printf(
				// Translators: "Powered by" link to WordPress.org. %1$s is the localized wordpress.org url (e.g. https://en.wordpress.org), %2$s is title attribute for the link ("Semantic Personal Publishing Platform"), %3$s is the anchor ("WordPress")
				wp_kses_post( __( 'Proudly powered by <a href="%1$s" title="%2$s">%3$s</a>.', 'boldr-lite' ) ),
				esc_url( __( 'https://wordpress.org/', 'boldr-lite' ) ),
				esc_attr__( 'Semantic Personal Publishing Platform', 'boldr-lite' ),
				esc_html__( 'WordPress', 'boldr-lite' )
			);
			echo ' ';
			printf(
				// Translators: %s is a link to the theme author's website with the name "Iceable Themes" as anchor
				wp_kses_post( __( 'BoldR design by %s.', 'boldr-lite' ) ),
				'<a href="https://www.iceablethemes.com" title="Free and Premium WordPress Themes">Iceable Themes</a>'
			);
			?>

			<?php
			/* Stop editing here */
			?>

		</div>

		<div class="sub-footer-right">
			<?php
			$footer_menu = array(
				'theme_location' => 'footer-menu',
				'depth'          => 1,
			);
			wp_nav_menu( $footer_menu );
			?>
		</div>
	</div>
</div>

</div>

<?php wp_footer(); ?>

</body>
</html>
