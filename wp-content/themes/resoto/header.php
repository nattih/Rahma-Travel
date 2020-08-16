<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Resoto
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php do_action('resoto_responsive_sidemenu'); ?>

<body <?php body_class(); ?>>
<?php do_action( 'resoto_preloader' ); ?>
<?php
    if ( function_exists('wp_body_open') ) {
        wp_body_open();
    }
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'resoto' ); ?></a>

	<?php
		$header_layout = get_theme_mod( 'resoto_header_layout', 'layout1' );
		get_template_part( 'template-parts/header-layouts/header', $header_layout );
	?>

	<?php
		$enable_slider = get_theme_mod( 'resoto_enable_slider', 1 );
		$slider_category = get_theme_mod( 'resoto_slider_category', 0 );
		if( $enable_slider && $slider_category ) {
			do_action( 'resoto_slider' );
		}
	?>

	<?php do_action( 'resoto_hb_search_rooms' ); ?>

	<?php do_action( 'resoto_page_banner' ); ?>

	<div id="content" class="site-content">
		<?php do_action( 'resoto_page_wrapper_start' ); ?>
		<!-- <div class="rcontainer"> -->
