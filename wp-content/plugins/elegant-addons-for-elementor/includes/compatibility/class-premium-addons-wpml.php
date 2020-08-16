<?php

namespace ElegantAddons\Compatibility\WPML;

if ( ! defined('ABSPATH') ) exit; // No access of directly access

if ( ! class_exists ('Premium_Addons_Wpml') ) {

    /**
    * Class Premium_Addons_Wpml.
    */
   class Premium_Addons_Wpml {

       /*
        * Instance of the class
        * @access private
        * @since 3.1.9
        */
        private static $instance = null;

       /**
        * Constructor
        */
       public function __construct() {

           $is_wpml_active = self::is_wpml_active();

           // WPML String Translation plugin exist check.
           if ( $is_wpml_active ) {

               $this->includes();

               add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'translatable_widgets' ] );
           }
       }


       /*
        * Is WPML Active
        *
        * Check if WPML Multilingual CMS and WPML String Translation active
        *
        * @since 3.1.9
        * @access private
        *
        * @return boolean is WPML String Translation
        */
       public static function is_wpml_active() {

           include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

           $wpml_active = is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' );

           $string_translation_active = is_plugin_active( 'wpml-string-translation/plugin.php' );

           return $wpml_active && $string_translation_active;

       }

       /**
        *
        * Includes
        *
        * Integrations class for widgets with complex controls.
        *
        * @since 3.1.9
        */
       public function includes() {

            include_once( 'widgets/carousel.php' );
            include_once( 'widgets/fancy-text.php' );
            include_once( 'widgets/grid.php' );
            include_once( 'widgets/maps.php' );
            include_once( 'widgets/pricing-table.php' );
            include_once( 'widgets/progress-bar.php' );
            include_once( 'widgets/vertical-scroll.php' );

       }

       /**
        * Widgets to translate.
        *
        * @since 3.1.9
        * @param array $widgets Widget array.
        * @return array
        */
       function translatable_widgets( $widgets ) {

           $widgets['premium-addon-banner'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-banner' ],
               'fields'     => [
                   [
                       'field'       => 'premium_banner_title',
                       'type'        => __( 'Banner: Title', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_banner_description',
                       'type'        => __( 'Banner: Description', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_banner_more_text',
                       'type'        => __( 'Banner: Button Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_banner_image_custom_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Banner: URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
                   'premium_banner_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Banner: Button URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];

           $widgets['premium-addon-button'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-button' ],
               'fields'     => [
                   [
                       'field'       => 'premium_button_text',
                       'type'        => __( 'Button: Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_button_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Button: URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];

           $widgets['premium-countdown-timer'] = [
               'conditions' => [ 'widgetType' => 'premium-countdown-timer' ],
               'fields'     => [
                   [
                       'field'       => 'premium_countdown_expiry_text_',
                       'type'        => __( 'Countdown: Expiration Message', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_countdown_day_singular',
                       'type'        => __( 'Countdown: Day Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_day_plural',
                       'type'        => __( 'Countdown: Day Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_week_singular',
                       'type'        => __( 'Countdown: Week Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_week_plural',
                       'type'        => __( 'Countdown: Week Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_month_singular',
                       'type'        => __( 'Countdown: Month Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_month_plural',
                       'type'        => __( 'Countdown: Month Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_year_singular',
                       'type'        => __( 'Countdown: Year Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_year_plural',
                       'type'        => __( 'Countdown: Year Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_hour_singular',
                       'type'        => __( 'Countdown: Hour Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_hour_plural',
                       'type'        => __( 'Countdown: Hour Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_minute_singular',
                       'type'        => __( 'Countdown: Minute Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_minute_plural',
                       'type'        => __( 'Countdown: Minute Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_second_singular',
                       'type'        => __( 'Countdown: Second Singular', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_countdown_second_plural',
                       'type'        => __( 'Countdown: Second Plural', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_countdown_expiry_redirection_' => [
                       'field'       => 'url',
                       'type'        => __( 'Countdown: Direction URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];

           $widgets['premium-counter'] = [
               'conditions' => [ 'widgetType' => 'premium-counter' ],
               'fields'     => [
                   [
                       'field'       => 'premium_counter_title',
                       'type'        => __( 'Counter: Title Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_counter_t_separator',
                       'type'        => __( 'Counter: Thousands Separator', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_counter_preffix',
                       'type'        => __( 'Counter: Prefix', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_counter_suffix',
                       'type'        => __( 'Counter: Suffix', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_dual_heading_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Advanced Heading: Heading URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ]
               ]
           ];

           $widgets['premium-addon-dual-header'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-dual-header' ],
               'fields'     => [
                   [
                       'field'       => 'premium_dual_header_first_header_text',
                       'type'        => __( 'Dual Heading: First Heading', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_dual_header_second_header_text',
                       'type'        => __( 'Dual Heading: Second Heading', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_dual_heading_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Advanced Heading: Heading URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ]
               ]
           ];

           $widgets['premium-carousel-widget'] = [
               'conditions' => [ 'widgetType' => 'premium-carousel-widget' ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\Carousel',
           ];

           $widgets['premium-addon-fancy-text'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-fancy-text' ],
               'fields'     => [
                   [
                       'field'       => 'premium_fancy_prefix_text',
                       'type'        => __( 'Fancy Text: Prefix', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_fancy_suffix_text',
                       'type'        => __( 'Fancy Text: Suffix', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_fancy_text_cursor_text',
                       'type'        => __( 'Fancy Text: Cursor Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
               ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\FancyText',
           ];

           $widgets['premium-img-gallery'] = [
               'conditions' => [ 'widgetType' => 'premium-img-gallery' ],
               'fields'     => [
                   [
                       'field'       => 'premium_gallery_load_more_text',
                       'type'        => __( 'Grid: Load More Button', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ]
               ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\Grid',
           ];

           $widgets['premium-addon-image-button'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-image-button' ],
               'fields'     => [
                   [
                       'field'       => 'premium_image_button_text',
                       'type'        => __( 'Button: Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_image_button_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Button: URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];

           $widgets['premium-image-scroll'] = [
               'conditions' => [ 'widgetType' => 'premium-image-scroll' ],
               'fields'     => [
                   [
                       'field'       => 'link_text',
                       'type'        => __( 'Image Scroll: Link Title', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'link' => [
                       'field'       => 'url',
                       'type'        => __( 'Image Scroll: URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ]
               ]
           ];

           $widgets['premium-addon-image-separator'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-image-separator' ],
               'fields'     => [
                   [
                       'field'       => 'premium_image_separator_image_link_text',
                       'type'        => __( 'Image Separator: Link Title', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   'link' => [
                       'field'       => 'premium_image_separator_image_link',
                       'type'        => __( 'Image Separator: URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ]
               ]
           ];

           $widgets['premium-addon-maps'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-maps' ],
               'fields'     => [
                   [
                       'field'       => 'premium_maps_center_lat',
                       'type'        => __( 'Maps: Center Latitude', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_maps_center_long',
                       'type'        => __( 'Maps: Center Longitude', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ]
               ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\Maps',
           ];

           $widgets['premium-addon-modal-box'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-modal-box' ],
               'fields'     => [
                   [
                       'field'       => 'premium_modal_box_title',
                       'type'        => __( 'Modal Box: Header Title', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_modal_box_content',
                       'type'        => __( 'Modal Box: Content Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'VISUAL',
                   ],
                   [
                       'field'       => 'premium_modal_close_text',
                       'type'        => __( 'Modal Box: Close Button', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_modal_box_button_text',
                       'type'        => __( 'Modal Box: Trigger Button', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_modal_box_selector_text',
                       'type'        => __( 'Modal Box: Trigger Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
               ],
           ];

           $widgets['premium-addon-person'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-person' ],
               'fields'     => [
                   [
                       'field'       => 'premium_person_name',
                       'type'        => __( 'Person: Name', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_person_title',
                       'type'        => __( 'Person: Title', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_person_content',
                       'type'        => __( 'Person: Description', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'AREA',
                   ],
               ],
           ];

           $widgets['premium-addon-pricing-table'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-pricing-table' ],
               'fields'     => [
                   [
                       'field'       => 'premium_pricing_table_title_text',
                       'type'        => __( 'Pricing Table: Title', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_slashed_price_value',
                       'type'        => __( 'Pricing Table: Slashed Price', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_price_currency',
                       'type'        => __( 'Pricing Table: Currency', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_price_value',
                       'type'        => __( 'Pricing Table: Price Value', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_price_separator',
                       'type'        => __( 'Pricing Table: Separator', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_price_duration',
                       'type'        => __( 'Pricing Table: Duration', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_description_text',
                       'type'        => __( 'Pricing Table: Description', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_pricing_table_button_text',
                       'type'        => __( 'Pricing Table: Button Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_pricing_table_button_link',
                       'type'        => __( 'Pricing Table: Button URL', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
                   [
                       'field'       => 'premium_pricing_table_badge_text',
                       'type'        => __( 'Pricing Table: Badge', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
               ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\Pricing_Table',
           ];

           $widgets['premium-addon-progressbar'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-progressbar' ],
               'fields'     => [
                   [
                       'field'       => 'premium_progressbar_left_label',
                       'type'        => __( 'Progress Bar: Left Label', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
               ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\Progress_Bar',
           ];

           $widgets['premium-addon-testimonials'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-testimonials' ],
               'fields'     => [
                   [
                       'field'       => 'premium_testimonial_person_name',
                       'type'        => __( 'Testimonial: Name', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_testimonial_company_name',
                       'type'        => __( 'Testimonial: Company', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_testimonial_company_link',
                       'type'        => __( 'Testimonial: Company Link', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
                   [
                       'field'       => 'premium_testimonial_content',
                       'type'        => __( 'Testimonial: Content', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'AREA',
                   ],
               ],
           ];

           $widgets['premium-addon-title'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-title' ],
               'fields'     => [
                   [
                       'field'       => 'premium_title_text',
                       'type'        => __( 'Title: Text', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ]
               ],
           ];

           $widgets['premium-addon-video-box'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-video-box' ],
               'fields'     => [
                   [
                       'field'       => 'premium_video_box_link',
                       'type'        => __( 'Video Box: Link', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINK',
                   ],
                   [
                       'field'       => 'premium_video_box_description_text',
                       'type'        => __( 'Video Box: Description', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'AREA',
                   ]
               ]
           ];

           $widgets['premium-vscroll'] = [
               'conditions' => [ 'widgetType' => 'premium-vscroll' ],
               'fields'     => [
                   [
                       'field'       => 'dots_tooltips',
                       'type'        => __( 'Vertical Scroll: Tooltips', 'elegant-addons-for-elementor' ),
                       'editor_type' => 'LINE',
                   ]
               ],
               'integration-class' => 'ElegantAddons\Compatibility\WPML\Widgets\Vertical_Scroll',
           ];

           return $widgets;
       }

       /**
         * Creates and returns an instance of the class
         * @since 0.0.1
         * @access public
         * return object
         */
        public static function get_instance() {
            if( self::$instance == null ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

   }

}

if( ! function_exists('premium_addons_wpml') ) {

    /**
    * Triggers `get_instance` method
    * @since 0.0.1
   * @access public
    * return object
    */
    function premium_addons_wpml() {

     Premium_Addons_Wpml::get_instance();

    }

}
premium_addons_wpml();
