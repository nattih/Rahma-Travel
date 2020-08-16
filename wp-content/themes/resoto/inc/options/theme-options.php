<?php
	function resoto_kirki_configuration() {
	    return array( 'url_path' => get_stylesheet_directory_uri() . '/inc/kirki/' );
	}
	add_filter( 'kirki/config', 'resoto_kirki_configuration' );

    function resoto_enqueue_customizer_scripts() {
    	wp_enqueue_style( 'elementor-icons', get_template_directory_uri() . '/vendors/elementor-icons/css/elementor-icons.min.css' );
        wp_enqueue_style( 'resoto-customizer-styles', get_template_directory_uri() . '/assets/css/customizer-styles.css' );
    }
    add_action( 'customize_controls_enqueue_scripts', 'resoto_enqueue_customizer_scripts' );

    /** Custom Controls **/
    require get_template_directory() . '/inc/custom-controls/upgrade-pro.php';

    /** Helper File **/
	require get_template_directory() . '/inc/options/helper.php';

    /** Theme Options **/
	require get_template_directory() . '/inc/options/general-options.php'; // General Options
	require get_template_directory() . '/inc/options/header-options.php'; // Header Options
	require get_template_directory() . '/inc/options/slider-options.php'; // Slider Options
	require get_template_directory() . '/inc/options/footer-options.php'; // Footer Options
	require get_template_directory() . '/inc/options/blog-options.php'; // Blog Options
	require get_template_directory() . '/inc/options/room-options.php'; // Room Options
    require get_template_directory() . '/inc/options/typography-options.php'; // Typography Options
	require get_template_directory() . '/inc/options/upgrade-options.php'; // Upgrade Options