<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Resoto
 */

global $post;
$sidebar = '';
if( is_page( $post ) ) {
	$sidebar = ( get_post_meta( $post->ID, 'resoto_page_layout', true ) ) ? get_post_meta( $post->ID, 'resoto_page_layout', true ) : '';
} elseif( is_archive() || is_home() ) {
	$sidebarr = get_theme_mod( 'resoto_blog_sidebar_layout', '' );
	$sidebar = ( $sidebarr == 'no-sidebar' ) ? '' : $sidebarr;
} elseif( is_search() || is_single() ) {
	$sidebar = 'right-sidebar';
}

if ( $sidebar && ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->