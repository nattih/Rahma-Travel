<?php

/**
 * All active callbacks are coded here
 */

function apex_business_flag_is_topbar_disabled() {
    $apex_business_flag = get_theme_mod( 'apex_business_topbar_switch_setting' );
    if( $apex_business_flag == true ) {
        return true;
    }
    return false;
}

function apex_business_last_item_type() {
    $apex_business_flag = get_theme_mod( 'apex_business_navigation_last_item_setting', 'none' );
    if( $apex_business_flag == 'button' ) {
        return true;
    }
    return false;
}

function apex_business_readmore_Link_callback() {
    $flag = get_theme_mod( 'apex_business_readmore_link_switch_setting' );
    if( $flag == 1 ) {
        return true;
    }
    return false;
}

function apex_business_masonry_columns_callback() {
    $flag = get_theme_mod( 'apex_business_blog_layout_setting');
    if( $flag == 'masonry' ) {
        return true;
    }
    return false;
}

function apex_business_flag_back_to_top_disabled() {
    $apex_business_flag = get_theme_mod( 'apex_business_back_to_top_switch_setting' );
    if( $apex_business_flag == true ) {
        return true;
    }
    return false;
}

function apex_business_flag_bottom_bar_disabled() {
    $apex_business_flag = get_theme_mod( 'apex_business_bottom_bar_switch_setting' );
    if( $apex_business_flag == true ) {
        return true;
    }
    return false;
}

