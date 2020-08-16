<?php
	/** General Options **/
	function resoto_general_options( $wp_customize ) {

		/** Footer Section **/
		Kirki::add_section( 'resoto_general_options', array(
		    'title'          => esc_html__( 'General Settings', 'resoto' ),
		) );

			/** Template Color **/
			Kirki::add_field( 'resoto_template_color', array(
				'type'        => 'radio-image',
				'settings'    => 'resoto_template_color',
				'label'       => esc_html__( 'Template Color', 'resoto' ),
				'section'     => 'resoto_general_options',
				'priority'	  => '1',
				'default'     => 'orange',
				'description' => esc_html__( 'select the template color for site', 'resoto' ),
				'choices'     => array(
					'orange'   => get_template_directory_uri() . '/assets/images/orange.png',
					'brown' => get_template_directory_uri() . '/assets/images/brown.png',
					'blue' => get_template_directory_uri() . '/assets/images/blue.png',
				),
			) );

			/** Upgrade Info **/
			Kirki::add_field( 'resoto_more_template_color', [
				'type'        => 'custom',
				'settings'    => 'resoto_more_template_color',
				'section'     => 'resoto_general_options',
				'default'     => '<div style="padding: 10px; background-color: #e97070; color: #e7e7e7; font-size: 14px; font-weight: 600;">' . esc_html__( 'For unlimited template color upgrade to pro.', 'resoto' ) . '</div>',
			] );

			/** Enable Preloader **/
			Kirki::add_field( 'resoto_enable_preloader', array(
				'type'        => 'switch',
				'settings'    => 'resoto_enable_preloader',
				'label'       => esc_html__( 'Enable Preloader', 'resoto' ),
				'section'     => 'resoto_general_options',
				'default'     => '1',
				'choices'     => array(
					'on'  => esc_html__( 'Show', 'resoto' ),
					'off' => esc_html__( 'Hide', 'resoto' ),
				),
			) );

			/** Enable Go to Top option **/
			Kirki::add_field( 'resoto_goto_top_link', array(
				'type'        => 'switch',
				'settings'    => 'resoto_goto_top_link',
				'label'       => esc_html__( 'Enable Goto Top', 'resoto' ),
				'section'     => 'resoto_general_options',
				'default'     => '1',
				'choices'     => array(
					'on'  => esc_html__( 'Enable', 'resoto' ),
					'off' => esc_html__( 'Disable', 'resoto' ),
				),
			) );

	}

	add_filter( 'kirki/fields', 'resoto_general_options' );