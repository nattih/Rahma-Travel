<?php
// DB Table check
// Applied later
global $wpdb;
$ct_tbl_name = $wpdb->prefix . "ct_mc_sub";
$check_table = $wpdb->get_var( 'select count(id) from ' . $ct_tbl_name );
// Check value of table:ct_notification
// Applied later
global $wpdb;
$ct_tbl_name_2              = $wpdb->prefix . "ct_notification";
$check_table_ct_timestamp   = $wpdb->get_var( 'select ct_timestamp from ' . $ct_tbl_name_2 . ' WHERE ID = 1' );

// Enqueue js file
if ( ! function_exists( 'ct_ctdi_admin_scripts' ) ) :
function ct_ctdi_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'ct-ctdi-jquery-admin-script', PT_CT_CTDI_URL . 'assets/js/jquery-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'ct-ctdi-jquery-admin-script', 'ct_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
endif;
add_action( 'admin_enqueue_scripts', 'ct_ctdi_admin_scripts' );
add_action( 'customize_controls_enqueue_scripts', 'ct_ctdi_admin_scripts' );

/*******************************************************************************
 *  Newsletter Notice
 *******************************************************************************/
// Incldes admin js file

add_action( 'wp_ajax_ct_ctdi_ajax_notice_handler', 'ct_ctdi_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function ct_ctdi_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function ct_ctdi_newsletter_hook_admin_notice() {
        $theme = wp_get_theme();
        $theme_name = $theme->get( 'Name' );
        $theme_author = $theme->get( 'Author' );
        $theme_slug = basename( get_stylesheet_directory() );

        // Check if it's been dismissed...
        if ( ! get_option('dismissed-alert_subscribe', FALSE ) ) {
            // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
            // and added "data-notice" attribute in order to track multiple / different notices
            // multiple dismissible notice states ?>
            <div class="updated notice notice-alert-subscribe-class is-dismissible" data-notice="alert_subscribe">
                <div class="crafthemes-getting-started-notice clearfix">
                    <div class="ct-theme-notice-content">
                            <p style="font-size: 14px;"><?php
                                if( $theme_author == 'Crafthemes' ) {
                                    /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                                    printf( esc_html__( 'Hi there, Thank you for using %1$s. Every month we send helpful guides on how to improve performace of WordPress site and tips to improve website SEO etc. Do you like to subscribe to our newsletter and stay updated?', 'ct_ctdi' ),
                                        $theme_name );
                                } else {
                                    /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                                    printf( esc_html__( 'Hi there, Thank you for choosing Crafthemes. Every month we send helpful guides on how to improve performace of WordPress site and tips to improve website SEO etc. Do you like to subscribe to our newsletter and stay updated?', 'ct_ctdi' ) );
                                }

                            ?></p>

                        <a class="jquery-btn-subscribe button button-primary sub-notice-dismiss ct-button-padding" href="#" data-name="" data-slug=""><?php esc_html_e( 'Yes, sure.', 'ct_ctdi' ); ?></a>
                        <a class="jquery-btn-newsletter-ignore button button-normal sub-notice-dismiss ct-button-padding" href="#" data-name="" data-slug=""><?php esc_html_e( 'No, thanks.', 'ct_ctdi' ); ?></a>
                    </div><!-- /.ct-theme-notice-content -->
                </div>
            </div>
        <?php }
}


// Don't display if already subscribed
$after_time = $check_table_ct_timestamp + ( 60 * 30 ); // 30 mins
if( time() > $after_time ) {
    if ( $check_table == 0 ) {
        add_action( 'admin_notices', 'ct_ctdi_newsletter_hook_admin_notice' );
    }
}

function ct_ctdi_join_subscriber() {
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

add_action( 'wp_ajax_join_subscriber', 'ct_ctdi_join_subscriber' );
