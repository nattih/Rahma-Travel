<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Resoto
 */

?>
		<?php do_action( 'resoto_page_wrapper_end' ); ?>
		<!--</div> .rcontainer -->
	</div><!-- #content -->

	<?php
		$footer_layout = get_theme_mod( 'resoto_footer_layout', 'layout1' );
		get_template_part( 'template-parts/footers/footer', $footer_layout );
	?>

</div><!-- #page -->
<?php do_action( 'resoto_goto_top' ); ?>

<?php wp_footer(); ?>

</body>
</html>
