<?php

/* Theme Setup */
if ( !function_exists( 'apex_business_setup' ) ):

    function apex_business_setup() {
        /**
         * Adds theme support for featured image
         */
        add_theme_support( 'post-thumbnails' );

        // Add Custom Background support
        add_theme_support( 'custom-background' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        /*
         * Adds theme support for automatically adding document title by WordPress
         */
        add_theme_support( 'title-tag' );
         /**
          * Add theme support for selective refresh for widgets.
          */
        add_theme_support( 'customize-selective-refresh-widgets' );
        /*
         * Make theme available for translation.
         */
        load_theme_textdomain( 'apex-business' );
        /**
         * Adds custom background support.
         */
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
          )
        );

        /**
         * Register Navigation Menu
         */
        register_nav_menus( array (
            'header_menu' => esc_html__( 'Header Menu', 'apex-business' ),
            'mobile_menu' => esc_html__( 'Mobile Menu', 'apex-business' ),
            'social_menu' => esc_html__( 'Social Menu', 'apex-business' ),
            'footer_menu' => esc_html__( 'Footer Menu', 'apex-business' ),
         ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 55,
                'width'       => 220,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
        */
        //add_editor_style( array( 'css/editor-style.css', apex_business_fonts_url() ) );
    }

endif;

add_action( 'after_setup_theme', 'apex_business_setup' );
