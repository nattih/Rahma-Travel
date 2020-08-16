<?php
	/** Slider Options **/
	function resoto_slider_options( $wp_customize ) {

		$category_list = resoto_category_list('dropdown');

		/** Slider Section **/
		Kirki::add_section( 'resoto_slider_options', array(
		    'title'          => esc_html__( 'Slider', 'resoto' ),
		) );

			/** Enable/Disable Top Header **/
			Kirki::add_field( 'resoto_enable_slider', array(
				'type'        => 'switch',
				'settings'    => 'resoto_enable_slider',
				'label'       => esc_html__( 'Enable Slider', 'resoto' ),
				'section'     => 'resoto_slider_options',
				'default'     => '1',
				'choices'     => array(
					'on'  => esc_html__( 'Enable', 'resoto' ),
					'off' => esc_html__( 'Disable', 'resoto' ),
				),
			) );

			/** Slider Category **/
			Kirki::add_field( 'resoto_slider_category', array(
				'type'        => 'select',
				'settings'    => 'resoto_slider_category',
				'label'       => esc_html__( 'Slider Category', 'resoto' ),
				'description' => esc_html__( 'select a category for the slider', 'resoto' ),
				'section'     => 'resoto_slider_options',
				'default'     => 0,
				'multiple'    => 1,
				'choices'     => $category_list
			) );

			/** Slider Layout **/
			Kirki::add_field( 'resoto_slider_layout', array(
				'type'        => 'select',
				'settings'    => 'resoto_slider_layout',
				'label'       => esc_html__( 'Slider Layout', 'resoto' ),
				'description' => esc_html__( 'select a layout for the slider', 'resoto' ),
				'section'     => 'resoto_slider_options',
				'default'     => 'layout1',
				'multiple'    => 1,
				'choices'     => array(
					'layout1' => esc_html__( 'Left Aligned', 'resoto' ),
					'layout2' => esc_html__( 'Center Aligned', 'resoto' ),
					'layout3' => esc_html__( 'Right Aligned', 'resoto' ),
				),
			) );

			/** Upgrade Info **/
			Kirki::add_field( 'resoto_rev_slider_opt', [
				'type'        => 'custom',
				'settings'    => 'resoto_rev_slider_opt',
				'section'     => 'resoto_slider_options',
				'default'     => '<div style="padding: 10px; background-color: #e97070; color: #e7e7e7; font-size: 14px; font-weight: 600;">' . esc_html__( 'Upgrade to pro theme for more slider options and Revolution Slider.', 'resoto' ) . '</div>',
			] );

			/** Slider Text Color **/
			Kirki::add_field( 'resoto_caption_text_color', array(
				'type'        => 'color',
				'settings'    => 'resoto_caption_text_color',
				'label'       => esc_html__( 'Caption Text Color', 'resoto' ),
				'description' => esc_html__( 'set the color for the caption text', 'resoto' ),
				'section'     => 'resoto_slider_options',
				'default'     => '#616161',
			) );

	}

	add_filter( 'kirki/fields', 'resoto_slider_options' );