<?php

/**
 * All active callbacks are coded here
 */

function apex_business_flag_is_topbar_disabled() {
    $apex_business_flag = get_theme_mod( 'apex_business_topbar_switch_setting');
    if( $apex_business_flag == true ) {
        return true;
    }
    return false;
}
