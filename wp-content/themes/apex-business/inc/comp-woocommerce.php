<?php
// Add new constant that returns true if WooCommerce is active
define( 'WPEX_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );

// Checking if WooCommerce is active
if ( WPEX_WOOCOMMERCE_ACTIVE ) {
    add_action( 'after_setup_theme', function() {
        add_theme_support( 'woocommerce' );

        add_theme_support( 'wc-product-gallery-slider' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
    } );
}
