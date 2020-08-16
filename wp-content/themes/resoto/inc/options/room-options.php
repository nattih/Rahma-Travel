<?php
	/** Room Options **/
	function resoto_room_options( $wp_customize ) {

		$category_list = resoto_category_list('dropdown');

		/** Hotel Room Section **/
		Kirki::add_section( 'resoto_room_options', array(
		    'title'          => esc_html__( 'Hotel Rooms', 'resoto' ),
		) );

			/** Rooms Page Layout **/
			Kirki::add_field( 'resoto_rooms_page_layout', array(
				'type'        => 'select',
				'settings'    => 'resoto_rooms_page_layout',
				'label'       => esc_html__( 'Rooms Page Layout', 'resoto' ),
				'section'     => 'resoto_room_options',
				'default'     => 'list',
				'multiple'    => 1,
				'choices'     => array(
					'list' => esc_html__( 'List Layout', 'resoto' ),
					'grid' => esc_html__( 'Grid Layout', 'resoto' ),
				),
				'description' => esc_html__( 'select any one layout for the room page', 'resoto' ),
			) );

			/** Enable/Disable Top Header **/
			Kirki::add_field( 'resoto_enable_room_desc_text', array(
				'type'        => 'switch',
				'settings'    => 'resoto_enable_room_desc_text',
				'label'       => esc_html__( 'Display Description', 'resoto' ),
				'section'     => 'resoto_room_options',
				'default'     => '1',
				'choices'     => array(
					'on'  => esc_html__( 'Show', 'resoto' ),
					'off' => esc_html__( 'Hide', 'resoto' ),
				),
			) );

			/** Excerpt Length **/
			Kirki::add_field( 'resoto_room_excerpt_length', array(
				'type'        => 'slider',
				'settings'    => 'resoto_room_excerpt_length',
				'label'       => esc_html__( 'Excerpt Length (In Chars)', 'resoto' ),
				'section'     => 'resoto_room_options',
				'description' => esc_html__( 'set the length for the excerpt text in room posts', 'resoto' ),
				'choices'     => array(
					'min'  => 0,
					'max'  => 150,
					'step' => 1,
				),
			) );

			/** View More Button Text **/
			Kirki::add_field( 'resoto_room_viewmore_text', array(
				'type'     => 'text',
				'settings' => 'resoto_room_viewmore_text',
				'label'    => esc_html__( 'View More Text', 'resoto' ),
				'description' => esc_html__( 'set view more button text', 'resoto' ),
				'section'  => 'resoto_room_options',
			) );
	}

	add_filter( 'kirki/fields', 'resoto_room_options' );