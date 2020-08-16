<?php
	/** Woocommerce Compatibilities **/

	/** Remove Shop page title **/	
	add_filter( 'woocommerce_show_page_title', '__return_false' );

	/** Remove Breadcrumb from shop pages **/
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );