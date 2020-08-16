<?php

// Mailchimp Subscribe Function
function ct_mailchimp_subscriber_status( $email, $status, $list_id, $api_key, $merge_fields = array('FNAME' => '','LNAME' => '') ){
    $data = array(
        'apikey'        => $api_key,
            'email_address' => $email,
        'status'        => $status,
        'merge_fields'  => $merge_fields
    );
    $mch_api = curl_init(); // initialize cURL connection

    curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
    curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
    curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
    curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
    curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch_api, CURLOPT_POST, true);
    curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

    $result = curl_exec($mch_api);
    return $result;
}


// Create Subscription database "ct_mc_sub"
// function ct_mc_tbl_create() {
//     global $wpdb;

//     $ct_tbl_name = $wpdb->prefix . "ct_mc_sub";

//     if( $wpdb->get_var( "show tables like '$ct_tbl_name'" ) != $ct_tbl_name )  {
//         $ct_query = "CREATE TABLE $ct_tbl_name(
//             id int(10) NOT NULL AUTO_INCREMENT,
//             subscribed varchar (100) DEFAULT '',
//             PRIMARY KEY (id)
//         )";

//         require_once( ABSPATH . "wp-admin/includes/upgrade.php" );
//         dbDelta( $ct_query );
//     }
// }


// Insert into "ct_mc_sub" table
function ct_mc_tbl_insert( $value ) {
    global $wpdb;
    $ct_tbl_name = $wpdb->prefix . "ct_mc_sub";
    $check_table = $wpdb->get_var( 'select count(id) from ' . $ct_tbl_name );

        if ( $check_table == 0 ) {

            $wpdb->insert( $ct_tbl_name,
                array(
                    'subscribed'  =>  $value,
                ),
                array(
                    '%s',
                )
            );
    }
}

// Hide Subscribe form if accepted
global $wpdb;
$ct_tbl_name = $wpdb->prefix . "ct_mc_sub";
$check_table = $wpdb->get_var( 'select count(id) from ' . $ct_tbl_name );

if ( $check_table != 0 ) {
    add_action('admin_head', 'ct_custom_css');
    function ct_custom_css() {
        echo '<style>
                .newsletter-form {
                    display:none;
                }
              </style>';
    }
}


// Import Respective Theme Demos
$theme = wp_get_theme();
$theme_name = $theme->get( 'Name' );

if( $theme_name == "Apex Business"
    || $theme_name == "Apex Business Premium"
    || $theme_name == "Apex Business Pro" ) {
    include( plugin_dir_path( __FILE__ ) . '/CTImportApex.php' );
} else if ( $theme_name == "Minimalist Blog"
    || $theme_name == "Minimalist Blog Pro"
    || $theme_name == "Minimalist Blog Premium"
    || $theme_name == "Minimalist Premium"
    || $theme_name == "Minimalist Pro" ) {
    include( plugin_dir_path( __FILE__ ) . '/CTImportMinimalist.php' );
} else if ( $theme_name == "Prime Business"
    || $theme_name == "Prime Business Pro"
    || $theme_name == "Prime Business Premium" ) {
    include( plugin_dir_path( __FILE__ ) . '/CTImportPrime.php' );
} else if ( $theme_name == "Writer Blog"
    || $theme_name == "Writer Blog Pro"
    || $theme_name == "Writer Blog Premium"
    || $theme_name == "Writer Premium"
    || $theme_name == "Writer Pro" ) {
    include( plugin_dir_path( __FILE__ ) . '/CTImportWriter.php' );
}
