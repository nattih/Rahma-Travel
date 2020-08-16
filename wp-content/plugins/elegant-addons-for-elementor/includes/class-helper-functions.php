<?php

namespace ElegantAddons;

if( ! defined('ABSPATH') ) exit;

class Helper_Functions {

    public static function get_category() {

        if( defined('PREMIUM_PRO_ADDONS_VERSION') ) {
            if(isset(get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-short-name'])){
                $category = get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-short-name'];
            }
        }

        return ( isset($category) && '' != $category ) ? $category : 'Elegant Addons';

    }

    public static function get_prefix() {
        return ( isset($prefix) && '' != $prefix ) ? $prefix : 'Elegant';
    }

    public static function get_badge() {
        return ( isset($badge) && '' != $badge ) ? $badge : 'EA';
    }

    /**
     * Get Installed Theme
     *
     * Returns the active theme slug
     *
     * @access public
     * @return string theme slug
     */
    public static function get_installed_theme() {

        $theme = wp_get_theme();

        if( $theme->parent() ) {

            $theme_name = $theme->parent()->get('Name');

        } else {

            $theme_name = $theme->get('Name');

        }

        $theme_name = sanitize_key( $theme_name );

        return $theme_name;
    }
}
