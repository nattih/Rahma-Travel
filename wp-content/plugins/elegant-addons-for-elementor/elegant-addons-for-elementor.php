<?php
/*
Plugin Name: Elegant Addons for Elementor
Description: Elegant Addons Plugin Includes 13+ premium widgets for Elementor Page Builder.
Plugin URI: https://elegantaddons.com
Version: 1.0.3
Author: Crafthemes
Author URI: https://crafthemes.com
Text Domain: elegant-addons-for-elementor
License: GNU General Public License v3.0
*/

if ( ! defined('ABSPATH') ) exit; // No access of directly access
ini_set( 'memory_limit', '256M' );

// Define Constants
defined('ELEGANT_ADDONS_VERSION') or define('ELEGANT_ADDONS_VERSION', '1.0.1');
defined('ELEGANT_ADDONS_URL') or define('ELEGANT_ADDONS_URL', plugins_url('/', __FILE__));
defined('ELEGANT_ADDONS_PATH') or define('ELEGANT_ADDONS_PATH', plugin_dir_path(__FILE__));
defined('ELEGANT_ADDONS_FILE') or define('ELEGANT_ADDONS_FILE', __FILE__);
defined('ELEGANT_ADDONS_BASENAME') or define('ELEGANT_ADDONS_BASENAME', plugin_basename( ELEGANT_ADDONS_FILE ) );
defined('ELEGANT_ADDONS_STABLE_VERSION') or define('ELEGANT_ADDONS_STABLE_VERSION', '1.0.1');
defined('ELEGANT_ADDONS_PRO') or define('ELEGANT_ADDONS_PRO', 'free');
defined('ELEGANT_ADDONS_PRO_TEXT') or define('ELEGANT_ADDONS_PRO_TEXT', ' ( Pro )');

register_activation_hook( __FILE__, 'eae_activation_logic' );
if ( ! function_exists( 'eae_activation_logic' ) ) {
    function eae_activation_logic() {
        //if dependent plugin is not active
        if ( is_plugin_active( 'elegant-addons-for-elementor/elegant-addons-for-elementor.php' ) ) {
            deactivate_plugins( 'elegant-addons-for-elementor/elegant-addons-for-elementor.php' );
        }

        //if dependent plugin is not active
        if ( is_plugin_active( 'elegant-addons-for-elementor-premium/elegant-addons-for-elementor-premium.php' ) ) {
            deactivate_plugins( 'elegant-addons-for-elementor-premium/elegant-addons-for-elementor-premium.php' );
        }
    }
}

if( ! class_exists('Elegant_Addons_Elementor') ) {

    /*
    * Intialize and Sets up the plugin
    */
    class Elegant_Addons_Elementor {

        /**
         * Member Variable
         *
         * @var instance
         */
        private static $instance = null;

        /**
         * Sets up needed actions/filters for the plug-in to initialize.
         *
         * @since 1.0.0
         * @access public
         *
         * @return void
         */
        public function __construct() {

            add_action( 'plugins_loaded', array( $this, 'Elegant_Addons_Elementor_setup' ) );

            add_action( 'elementor/init', array( $this, 'elementor_init' ) );

            add_action( 'init', array( $this, 'init' ), -999 );

            add_action( 'admin_post_premium_addons_rollback', 'post_premium_addons_rollback' );

            register_activation_hook( ELEGANT_ADDONS_FILE, array( $this, 'set_transient' ) );

        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have Elementor installed or activated.
         *
         * @since 1.0.0
         * @access public
         */
        public function admin_notice_missing_main_plugin() {
            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }

            $message = sprintf(
                /* translators: 1: Plugin name 2: Elementor */
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated. Please activate Elementor to continue.', 'elegant-addons-for-elementor' ),
                '<strong>' . esc_html__( 'Elegant Addons for Elementor', 'elegant-addons-for-elementor' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'elegant-addons-for-elementor' ) . '</strong>'
            );

            printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Installs translation text domain and checks if Elementor is installed
         *
         * @since 1.0.0
         * @access public
         *
         * @return void
         */
        public function Elegant_Addons_Elementor_setup() {

            $this->load_domain();

            $this->init_files();
        }

        /**
         * Set transient for admin review notice
         *
         * @since 3.1.7
         * @access public
         *
         * @return void
         */
        public function set_transient() {

            $cache_key = 'premium_notice_' . ELEGANT_ADDONS_VERSION;

            $expiration = 3600 * 72;

            set_transient( $cache_key, true, $expiration );
        }


        /**
         * Require initial necessary files
         *
         * @since 2.6.8
         * @access public
         *
         * @return void
         */
        public function init_files() {

            if ( is_admin() ) {

                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/dep/maintenance.php');
                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/dep/rollback.php');

                require_once ( ELEGANT_ADDONS_PATH . 'includes/class-beta-testers.php');
                require_once ( ELEGANT_ADDONS_PATH . 'includes/plugin.php');
                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/admin-notices.php' );
                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/plugin-info.php');
                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/version-control.php');
                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/reports.php');
                //require_once ( ELEGANT_ADDONS_PATH . 'admin/includes/papro-actions.php');
                $beta_testers = new Elegant_Beta_Testers();

            }

            require_once ( ELEGANT_ADDONS_PATH . 'includes/class-helper-functions.php' );
            //require_once ( ELEGANT_ADDONS_PATH . 'admin/settings/maps.php' );
            //require_once ( ELEGANT_ADDONS_PATH . 'admin/settings/modules-setting.php' );
            require_once ( ELEGANT_ADDONS_PATH . 'includes/elementor-helper.php' );

        }

        /**
         * Load plugin translated strings using text domain
         *
         * @since 2.6.8
         * @access public
         *
         * @return void
         */
        public function load_domain() {

            load_plugin_textdomain( 'elegant-addons-for-elementor' );

        }

        /**
         * Elementor Init
         *
         * @since 2.6.8
         * @access public
         *
         * @return void
         */
        public function elementor_init() {

            require_once ( ELEGANT_ADDONS_PATH . 'includes/compatibility/class-premium-addons-wpml.php' );

            require_once ( ELEGANT_ADDONS_PATH . 'includes/class-addons-category.php' );

        }

        /**
         * Load required file for addons integration
         *
         * @since 2.6.8
         * @access public
         *
         * @return void
         */
        public function init_addons() {
            require_once ( ELEGANT_ADDONS_PATH . 'includes/class-addons-integration.php' );
        }

        /**
         * Load the required files for templates integration
         *
         * @since 3.6.0
         * @access public
         *
         * @return void
         */
        public function init_templates() {
            //Load templates file
            require_once ( ELEGANT_ADDONS_PATH . 'includes/templates/templates.php');
        }

        /*
         * Init
         *
         * @since 3.4.0
         * @access public
         *
         * @return void
         */
        public function init() {

            // Check if Elementor installed and activated
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
                return;
            }

            $this->init_addons();
            $this->init_templates();

        }


        /**
         * Creates and returns an instance of the class
         *
         * @since 2.6.8
         * @access public
         *
         * @return object
         */
        public static function get_instance() {
            if( self::$instance == null ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

    }
}

if ( ! function_exists( 'elegant_addons' ) ) {

	/**
	 * Returns an instance of the plugin class.
	 * @since  1.0.0
	 * @return object
	 */
	function elegant_addons() {
		return Elegant_Addons_Elementor::get_instance();
	}
}

elegant_addons();

if ( ! function_exists( 'ct_style' ) ) {
    function ct_style() {
        /** Enqueue Style Sheets */
        wp_enqueue_style( 'font-awesome-5-free', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'ct_style' );

if ( ELEGANT_ADDONS_PRO == 'pro' ) {
    // Update Checker
    require_once ( ELEGANT_ADDONS_PATH . 'widgets/pro/update/plugin-update-checker.php' );
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'http://www.crafthemes.com/xml/eae/update/json/details.json',
        __FILE__, //Full path to the main plugin file or functions.php.
        'elegant-addons-for-elementor-premium'
    );
}
