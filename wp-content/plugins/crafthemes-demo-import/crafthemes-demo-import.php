<?php
/*
Plugin Name: Crafthemes Demo Import
Plugin URI: https://www.crafthemes.com
Description: Import Crafthemes Demo content.
Version: 1.0.17
Author: aruphash
Author URI: https://profiles.wordpress.org/aruphash/
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: ct-ctdi
*/

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
register_activation_hook( __FILE__, 'plugin_activated' );

class CT_initialize
{
    public static function plugin_activated(){
         // This will run when the plugin is activated, setup the database table
         // Create Subscription database table "ct_mc_sub" & ct_timestamp
            global $wpdb;
            $ct_tbl_name 	= $wpdb->prefix . "ct_mc_sub";
            $ct_tbl_name_2 	= $wpdb->prefix . "ct_notification";

            if( $wpdb->get_var( "show tables like '$ct_tbl_name'" ) != $ct_tbl_name )  {
                $ct_query[] = "CREATE TABLE $ct_tbl_name(
                    id int(10) NOT NULL AUTO_INCREMENT,
                    subscribed varchar (100) DEFAULT '',
                    PRIMARY KEY (id)
                )";

                $ct_query[] = "CREATE TABLE $ct_tbl_name_2(
                    id int(10) NOT NULL AUTO_INCREMENT,
                    ct_timestamp varchar (100) DEFAULT '',
                    PRIMARY KEY (id)
                )";

                require_once( ABSPATH . "wp-admin/includes/upgrade.php" );
                dbDelta( $ct_query );
            }

		    $check_table = $wpdb->get_var( 'select count(id) from ' . $ct_tbl_name_2 );

		        if ( $check_table == 0 ) {

		            $wpdb->insert( $ct_tbl_name_2,
		                array(
		                    'ct_timestamp'  =>  time(),
		                ),
		                array(
		                    '%s',
		                )
		            );
		    }
    }

    public static function plugin_deactivated(){
        // This will run when the plugin is deactivated, use to delete the database table

        global $wpdb;
        $ct_tbl_name    = $wpdb->prefix . "ct_mc_sub";
        $ct_tbl_name_2  = $wpdb->prefix . "ct_notification";

        $drop_ct_tbl_name   = "DROP TABLE IF EXISTS $ct_tbl_name";
        $drop_ct_tbl_name_2 = "DROP TABLE IF EXISTS $ct_tbl_name_2";

        $wpdb->query( $drop_ct_tbl_name );
        $wpdb->query( $drop_ct_tbl_name_2 );
    }
}

register_activation_hook( __FILE__, array('CT_initialize', 'plugin_activated' ));
register_deactivation_hook( __FILE__, array('CT_initialize', 'plugin_deactivated' ));

include( plugin_dir_path( __FILE__ ) . '/inc/CrafthemesClickDemoImport.php' );
include( plugin_dir_path( __FILE__ ) . '/inc/CTDependencies.php' );
include( plugin_dir_path( __FILE__ ) . '/inc/CTAdditionals.php' );
include( plugin_dir_path( __FILE__ ) . '/inc/misc.php' );
register_activation_hook( __FILE__, 'ctdi_activation_logic' );

if ( strpos( get_template(), 'pro' ) == true || strpos( get_template(), 'premium' ) == true ) {
    $plugin_state = 'pro';
} else {
	$plugin_state = 'free';
}

define( 'CT_PLUGIN_STATE' , $plugin_state );

//ct_mc_tbl_create();

add_filter( 'ct-CT_CTDI/import_files', 'CT_CTDI_import_files' );

// Automatically assign "Front page", "Posts page" and menu locations after the importer is done
function ctdi_after_import_setup( $selected_import ) {
	// Assign menus to their locations.
	$main_menu 		= get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$footer_menu 	= get_term_by( 'name', 'Footer Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'header_menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
			'mobile_menu' => $main_menu->term_id,
			'footer_menu' => $footer_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'ct-CT_CTDI/after_import', 'ctdi_after_import_setup' );

/**
 * Main plugin class with initialization tasks.
 */
class CT_CTDI_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.3.2.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '5.3.2', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		}
		else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Composer autoloader.
			require_once PT_CT_CTDI_PATH . 'vendor/autoload.php';

			// Instantiate the main plugin class *Singleton*.
			$pt_one_click_demo_import = CT_CTDI\CrafthemesClickDemoImport::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'CT_CTDI list', array( 'CT_CTDI\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'CT_CTDI import', array( 'CT_CTDI\WPCLICommands', 'import' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sCrafthemes Demo Import%3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'ct-ctdi' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'PT_CT_CTDI_PATH' ) ) {
			define( 'PT_CT_CTDI_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'PT_CT_CTDI_URL' ) ) {
			define( 'PT_CT_CTDI_URL', plugin_dir_url( __FILE__ ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
	}


	/**
	 * Set plugin version constant -> PT_CT_CTDI_VERSION.
	 */
	public function set_plugin_version_constant() {
		if ( ! defined( 'PT_CT_CTDI_VERSION' ) ) {
			$plugin_data = get_plugin_data( __FILE__ );
			define( 'PT_CT_CTDI_VERSION', $plugin_data['Version'] );
		}
	}
}

// Instantiate the plugin class.
$CT_CTDI_plugin = new CT_CTDI_Plugin();


add_action( 'wp_ajax_ct_ctdi_install_act_plugin', 'ct_ctdi_install_plugin' );
//add_action( 'wp_ajax_nopriv_install_act_plugin', 'ct_install_plugin' );

function ct_ctdi_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    $additional_plugin 	= $_POST[ 'plugin_slug' ][0];
    if ( strpos( get_stylesheet_directory(), 'apex' )  ) {
	    if ( CT_PLUGIN_STATE == 'free' ) {
	    	$plugin_list	= array( 'elementor', 'elegant-addons-for-elementor', 'contact-form-7', $additional_plugin );
	    } else {
	    	$plugin_list	= array( 'elementor', 'elegant-addons-for-elementor-premium', 'contact-form-7', $additional_plugin );
	    }
	} else if ( strpos( get_stylesheet_directory(), 'minimalist' )  ) {
	    if ( CT_PLUGIN_STATE == 'free' ) {
	    	$plugin_list	= array( 'mailchimp-for-wp', $additional_plugin );
	    } else {
	    	$plugin_list	= array( 'mailchimp-for-wp', $additional_plugin );
	    }
	} else {
		$plugin_list	= array( $additional_plugin );
	}

    foreach ( $plugin_list as $plugin ) {
	    $api = plugins_api( 'plugin_information', array(
	        'slug'   => sanitize_key( wp_unslash( $plugin ) ),
	        'fields' => array(
	            'sections' => false,
	        ),
	    ) );

		if( $_POST[ 'plugin_slug' ][1] == 'yes' ) {
			$theme = wp_get_theme();
		    $theme_name = $theme->get( 'Name' );

		    global $current_user;
		    wp_get_current_user();

		    $ct_fname = $current_user->user_firstname;
		    if( $ct_fname == "" ) {
		        $ct_fname = $current_user->display_name;
		    }

		    $email = (string) $current_user->user_email;
		    $status = 'subscribed'; // "subscribed" or "unsubscribed" or "cleaned" or "pending"
		    $list_id = 'a98d9275b4'; // where to get it read above
		    $api_key = '086d5a63916128d33bd6409dc7c90906-us10'; // where to get it read above
		    $merge_fields = array(
		        'FNAME' => $ct_fname,
		        'LNAME' => $theme_name
		    );

			ct_mailchimp_subscriber_status($email, $status, $list_id, $api_key, $merge_fields );
			ct_mc_tbl_insert( 'yes' );
		}


	    // If plugin not installed then install
    	if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin ) ) {
		    if ( strpos( $plugin , 'premium' ) ) {
		    	$premium_plugin_url = 'https://www.crafthemes.com/xml/eae/update/' . $plugin . '.zip';
		    	$upgrader = new Plugin_Upgrader();
  				$result = $upgrader->install( $premium_plugin_url );
		    } else {
			    $skin     = new WP_Ajax_Upgrader_Skin();
		    	$upgrader = new Plugin_Upgrader( $skin );
		    	$result   = $upgrader->install( $api->download_link );
		    }
		}

	    // Activate plugin
	    if ( strpos( $plugin , 'premium' ) ) {
			if ( current_user_can( 'activate_plugin' ) && is_plugin_inactive( $plugin . '/' . $plugin . '.php' ) ) {
				$eae_free_slug = str_replace( '-premium', '', $plugin );
				activate_plugin( $plugin . '/' . $plugin . '.php' );
			}
		} else {
			$install_status = install_plugin_install_status( $api );
		    // If user can activate plugin and if the plugin is not active
			if ( current_user_can( 'activate_plugin', $install_status['file'] ) && is_plugin_inactive( $install_status['file'] ) ) {
				$result = activate_plugin( $install_status['file'] );

				if ( is_wp_error( $result ) ) {
					$status['errorCode']    = $result->get_error_code();
					$status['errorMessage'] = $result->get_error_message();
					wp_send_json_error( $status );
				}
			}
		}
    } // End Foreach

    wp_send_json( $plugin_list );
}

register_activation_hook(__FILE__, function () {
    add_option('ct_ctdi_do_activation_redirect', true);
});

add_action('admin_init', function () {
    if (get_option('ct_ctdi_do_activation_redirect', false)) {
        delete_option('ct_ctdi_do_activation_redirect');
        exit( wp_redirect("admin.php?page=ct-crafthemes-demo-import") );
    }
});
