<?php

namespace ElegantAddons;

use ElegantAddons\Admin\Settings\Modules_Settings;

if( ! defined( 'ABSPATH' ) ) exit();

class Addons_Integration {

    //Class instance
    private static $instance = null;

    //Modules Keys
    private static $modules = null;

    //`premium_Template_Tags` Instance
    protected $templateInstance;


    //Maps Keys
    private static $maps = null;


    /**
    * Initialize integration hooks
    *
    * @return void
    */
    public function __construct() {

        $this->templateInstance = Includes\premium_Template_Tags::getInstance();

        add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'premium_font_setup' ) );

        add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_area' ) );

        add_action( 'elementor/editor/before_enqueue_scripts', array( $this,'enqueue_editor_scripts') );

        add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_preview_styles' ) );

        add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ) );

        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ) );

        add_action( 'wp_ajax_get_elementor_template_content', array( $this, 'get_template_content' ) );

    }

    /**
    * Loads plugin icons font
    * @since 1.0.0
    * @access public
    * @return void
    */
    public function premium_font_setup() {

        wp_enqueue_style(
            'premium-addons-font',
            ELEGANT_ADDONS_URL . 'assets/editor/css/style.css',
            array(),
            ELEGANT_ADDONS_VERSION
        );

        $badge_text = \ElegantAddons\Helper_Functions::get_badge();

        $dynamic_css = sprintf( '[class^="pa-"]::after, [class*=" pa-"]::after { content: "%s"; }', $badge_text ) ;

        wp_add_inline_style( 'premium-addons-font',  $dynamic_css );

    }

    /**
    * Register Frontend CSS files
    * @since 2.9.0
    * @access public
    */
    public function register_frontend_styles() {

        wp_register_style(
            'elegant-addons-css',
            ELEGANT_ADDONS_URL . 'assets/frontend/css/ct-style.css',
            array(),
            ELEGANT_ADDONS_VERSION,
            'all'
        );

        wp_register_style(
            'animate-css',
            ELEGANT_ADDONS_URL . 'assets/frontend/css/animate.css',
            array(),
            ELEGANT_ADDONS_VERSION,
            'all'
        );

        wp_register_style(
            'animate-headline-css',
            ELEGANT_ADDONS_URL . 'assets/frontend/css/jquery.animatedheadline.css',
            array(),
            ELEGANT_ADDONS_VERSION,
            'all'
        );
        wp_register_style(
            'responsive-menu',
            ELEGANT_ADDONS_URL . 'assets/frontend/css/ace-responsive-menu.css',
            array(),
            ELEGANT_ADDONS_VERSION,
            'all'
        );

    }

    /**
     * Enqueue Preview CSS files
     *
     * @since 2.9.0
     * @access public
     *
     */
    public function enqueue_preview_styles() {

        wp_enqueue_style('elegant-addons-css');

        wp_enqueue_style('animate-css');

    }

    /**
     * Load widgets require function
     *
     * @since 1.0.0
     * @access public
     *
     */
    public function widgets_area() {
        $this->widgets_register();
    }

    /**
     * Requires widgets files
     *
     * @since 1.0.0
     * @access private
     */
    private function widgets_register() {

        $check_component_active = self::$modules;

        foreach ( glob( ELEGANT_ADDONS_PATH . 'widgets/' . '*.php' ) as $file ) {

            $slug = basename( $file, '.php' );

            $enabled = isset( $check_component_active[ $slug ] ) ? $check_component_active[ $slug ] : '';

            if ( filter_var( $enabled, FILTER_VALIDATE_BOOLEAN ) || ! $check_component_active ) {
                $this->register_addon( $file );
            }
        }

    }

    /**
     * Registers required JS files
     *
     * @since 1.0.0
     * @access public
    */
    public function register_frontend_scripts() {

        $maps_settings = self::$maps;

        $locale = isset ( $maps_settings['premium-map-locale'] ) ? $maps_settings['premium-map-locale'] : "en";

        wp_register_script(
            'eae-filterizr',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/jquery.filterizr.min.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-slick',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/slick.min.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-testimonial',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/cte-testimonial.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-main-slider',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/cte-main-slider.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-animated-headline',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/jquery.animatedheadline.min.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-animated-js',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/cte-animated-headline.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-rating',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/jquery.starrating.min.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-scripts',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/eae-scripts.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'eae-scrollimg',
            ELEGANT_ADDONS_URL . 'assets/frontend/js/eae-scrollimg.js',
            array('jquery'),
            ELEGANT_ADDONS_VERSION,
            true
        );

        // wp_enqueue_script(
        //     'eae-gmap-js',
        //     ELEGANT_ADDONS_URL . 'assets/frontend/js/eae-gmap.js',
        //     array('jquery'),
        //     ELEGANT_ADDONS_VERSION,
        //     false
        // );
    }

    /*
     * Enqueue editor scripts
     *
     * @since 3.2.5
     * @access public
     */
    public function enqueue_editor_scripts() {
       //  wp_enqueue_script(
       //    	'eae-gmap-js',
       //    	ELEGANT_ADDONS_URL . 'assets/frontend/js/eae-gmap.js',
       //    	array('jquery'),
       //    	ELEGANT_ADDONS_VERSION,
       //    	false
      	// );
    }

    /*
     * Get Template Content
     *
     * Get Elementor template HTML content.
     *
     * @since 3.2.6
     * @access public
     *
     */
    public function get_template_content() {

        $template = $_GET['templateID'];

        if( ! isset( $template ) ) {
            return;
        }

        $template_content = $this->templateInstance->get_template_content( $template );

        if ( empty ( $template_content ) || ! isset( $template_content ) ) {
            wp_send_json_error();
        }

        $data = array(
            'template_content'  => $template_content
        );

        wp_send_json_success( $data );

    }

    /**
     *
     * Register addon by file name.
     *
     * @access public
     *
     * @param  string $file            File name.
     * @param  object $widgets_manager Widgets manager instance.
     *
     * @return void
     */
    public function register_addon( $file ) {

        $widget_manager = \Elementor\Plugin::instance()->widgets_manager;

        $base  = basename( str_replace( '.php', '', $file ) );
        $class = ucwords( str_replace( '-', ' ', $base ) );
        $class = str_replace( ' ', '_', $class );
        $class = sprintf( 'ElegantAddons\Widgets\%s', $class );

        if( 'ElegantAddons\Widgets\Premium_Contactform' != $class ) {
            require $file;
        } else {
            if( function_exists('wpcf7') ) {
                require $file;
            }
        }

        if ( class_exists( $class ) ) {
            $widget_manager->register_widget_type( new $class );
        }

        require_once( ELEGANT_ADDONS_PATH . 'widgets/inc/custom-functions.php' );
        require_once( ELEGANT_ADDONS_PATH . 'widgets/inc/button-elements.php' );
        require_once( ELEGANT_ADDONS_PATH . 'widgets/inc/fancy-border.php' );
        require_once( ELEGANT_ADDONS_PATH . 'widgets/inc/custom-gradient.php' );
        require_once( ELEGANT_ADDONS_PATH . 'widgets/inc/divider-function.php' );
        require_once( ELEGANT_ADDONS_PATH . 'widgets/inc/free-options.php' );

        if ( ELEGANT_ADDONS_PRO == 'pro' ) {
            require_once( ELEGANT_ADDONS_PATH . 'widgets/pro/eae-pro-functions.php' );
        }
    }

    /**
     *
     * Creates and returns an instance of the class
     *
     * @since 1.0.0
     * @access public
     *
     * @return object
     *
     */
   public static function get_instance() {
       if( self::$instance == null ) {
           self::$instance = new self;
       }
       return self::$instance;
   }
}


if ( ! function_exists( 'premium_addons_integration' ) ) {

	/**
	 * Returns an instance of the plugin class.
	 * @since  1.0.0
	 * @return object
	 */
	function premium_addons_integration() {
		return Addons_Integration::get_instance();
	}
}
premium_addons_integration();
