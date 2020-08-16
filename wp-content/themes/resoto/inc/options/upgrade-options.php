<?php
    /** Blog Options **/
    function resoto_upgrade_options( $wp_customize ) {
        /** Upgrade Section **/
        // Register custom section types.
            $wp_customize->register_section_type( 'Resoto_Upgrade_Pro_Customize_Section_Pro' );

            // Register sections.
            $wp_customize->add_section(
                new Resoto_Upgrade_Pro_Customize_Section_Pro(
                    $wp_customize,
                    'resoto_upgrade_button',
                    array(
                        'title'    => esc_html__( 'Rezoto', 'resoto' ),
                        'pro_text' => esc_html__( 'Upgrade Now', 'resoto' ),
                        'pro_url'  => 'https://mysticalthemes.com/theme/rezoto',
                        'priority' => 1
                    )
                )
            );
    }

    add_filter( 'customize_register', 'resoto_upgrade_options' );