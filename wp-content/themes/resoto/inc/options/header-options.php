<?php
	/** Header Options **/
	function resoto_header_options( $wp_customize ) {

		/** Header Panel **/
		Kirki::add_panel( 'resoto_header_panel', array(
		    'title'       => esc_html__( 'Header', 'resoto' ),
		    'description' => esc_html__( 'Configure Header', 'resoto' ),
		) );

			/** Top Header **/
			Kirki::add_section( 'resoto_top_header', array(
			    'title'          => esc_html__( 'Top Header', 'resoto' ),
			    'panel'          => 'resoto_header_panel',
			) );

				/** Enable/Disable Top Header **/
				Kirki::add_field( 'resoto_enable_top_header', array(
					'type'        => 'switch',
					'settings'    => 'resoto_enable_top_header',
					'label'       => esc_html__( 'Enable Top Header', 'resoto' ),
					'section'     => 'resoto_top_header',
					'default'     => 0,
					'choices'     => array(
						'on'  => esc_html__( 'Enable', 'resoto' ),
						'off' => esc_html__( 'Disable', 'resoto' ),
					),
				) );

				/** Contact Number **/
				Kirki::add_field( 'resoto_contact_number', array(
					'type'     => 'text',
					'settings' => 'resoto_contact_number',
					'label'    => esc_html__( 'Contact No.', 'resoto' ),
					'description' => esc_html__( 'set the contact number', 'resoto' ),
					'section'  => 'resoto_top_header',
				) );

				/** Email **/
				Kirki::add_field( 'resoto_email', array(
					'type'     => 'text',
					'settings' => 'resoto_email',
					'label'    => esc_html__( 'Email ID', 'resoto' ),
					'description' => esc_html__( 'set the email id', 'resoto' ),
					'section'  => 'resoto_top_header',
				) );

				/** Time **/
				Kirki::add_field( 'resoto_time', array(
					'type'     => 'text',
					'settings' => 'resoto_time',
					'label'    => esc_html__( 'Time', 'resoto' ),
					'description' => esc_html__( 'set the business hour time', 'resoto' ),
					'section'  => 'resoto_top_header',
				) );

				/** Facebook Link **/
				Kirki::add_field( 'resoto_facebook', array(
					'type'     => 'link',
					'settings' => 'resoto_facebook',
					'label'    => __( 'Facebook', 'resoto' ),
					'section'  => 'resoto_top_header',
					'default'  => '',
					'description' => esc_html__( 'set the social link for facebook', 'resoto' ),
				) );

				/** Twitter Link **/
				Kirki::add_field( 'resoto_twitter', array(
					'type'     => 'link',
					'settings' => 'resoto_twitter',
					'label'    => __( 'Twitter', 'resoto' ),
					'section'  => 'resoto_top_header',
					'default'  => '',
					'description' => esc_html__( 'set the social link for twitter', 'resoto' ),
				) );

				/** Instagram Link **/
				Kirki::add_field( 'resoto_instagram', array(
					'type'     => 'link',
					'settings' => 'resoto_instagram',
					'label'    => __( 'Instagram', 'resoto' ),
					'section'  => 'resoto_top_header',
					'default'  => '',
					'description' => esc_html__( 'set the social link for instagram', 'resoto' ),
				) );

				/** Youtube Link **/
				Kirki::add_field( 'resoto_youtube', array(
					'type'     => 'link',
					'settings' => 'resoto_youtube',
					'label'    => __( 'Youtube', 'resoto' ),
					'section'  => 'resoto_top_header',
					'default'  => '',
					'description' => esc_html__( 'set the social link for youtube', 'resoto' ),
				) );

			/** Main Header **/
			Kirki::add_section( 'title_tagline', array(
			    'title'          => esc_html__( 'Main Header', 'resoto' ),
			    'panel'          => 'resoto_header_panel',
			) );

				/** Header Layout **/
				Kirki::add_field( 'resoto_header_layout', array(
					'type'        => 'radio-image',
					'settings'    => 'resoto_header_layout',
					'label'       => esc_html__( 'Header Layout', 'resoto' ),
					'section'     => 'title_tagline',
					'default'     => 'layout1',
					'description' => esc_html__( 'select any one header layout', 'resoto' ),
					'choices'     => array(
						'layout1'   => get_template_directory_uri() . '/assets/images/header-layout1.png',
						'layout2' => get_template_directory_uri() . '/assets/images/header-layout2.png',
					),
				) );

				/** Upgrade Info **/
				Kirki::add_field( 'resoto_more_header_layout', [
					'type'        => 'custom',
					'settings'    => 'resoto_more_header_layout',
					'section'     => 'title_tagline',
					'default'     => '<div style="padding: 10px; background-color: #e97070; color: #e7e7e7; font-size: 14px; font-weight: 600;">' . esc_html__( 'For more header layouts upgrade to pro.', 'resoto' ) . '</div>',
				] );

				/** Show Search Icon **/
				Kirki::add_field( 'resoto_show_search', array(
					'type'        => 'switch',
					'settings'    => 'resoto_show_search',
					'label'       => esc_html__( 'Display Search in Header', 'resoto' ),
					'section'     => 'title_tagline',
					'default'     => '1',
					'choices'     => array(
						'on'  => esc_html__( 'Show', 'resoto' ),
						'off' => esc_html__( 'Hide', 'resoto' ),
					),
				) );

				/** Show Hotel Cart **/
				Kirki::add_field( 'resoto_show_hotelcart', array(
					'type'        => 'switch',
					'settings'    => 'resoto_show_hotelcart',
					'label'       => esc_html__( 'Display Hotel Cart in Header', 'resoto' ),
					'section'     => 'title_tagline',
					'default'     => '1',
					'choices'     => array(
						'on'  => esc_html__( 'Show', 'resoto' ),
						'off' => esc_html__( 'Hide', 'resoto' ),
					),
				) );

			/** Page Banner **/
			Kirki::add_section( 'resoto_hb_search_room', array(
			    'title'          => esc_html__( 'Hotel Search Room', 'resoto' ),
			    'panel'          => 'resoto_header_panel',
			) );

				/** Enable/Disable search room **/
				Kirki::add_field( 'resoto_show_hb_search_rooms', array(
					'type'        => 'switch',
					'settings'    => 'resoto_show_hb_search_rooms',
					'label'       => esc_html__( 'Show/Hide Search Rooms Form', 'resoto' ),
					'section'     => 'resoto_hb_search_room',
					'default'     => '1',
					'choices'     => array(
						'on'  => esc_html__( 'Show', 'resoto' ),
						'off' => esc_html__( 'Hide', 'resoto' ),
					),
				) );

			/** Page Banner **/
			Kirki::add_section( 'resoto_page_banner', array(
			    'title'          => esc_html__( 'Page Banner', 'resoto' ),
			    'panel'          => 'resoto_header_panel',
			) );

				/** Page Banner Color **/
				Kirki::add_field( 'resoto_page_banner_bgcolor', array(
					'type'        => 'color',
					'settings'    => 'resoto_page_banner_bgcolor',
					'label'       => __( 'Background Color', 'resoto' ),
					'description' => esc_html__( 'set the banner background color', 'resoto' ),
					'section'     => 'resoto_page_banner',
					'default'     => '#0088CC',
				) );

				/** Page Banner Image **/
				Kirki::add_field( 'resoto_page_banner_bgimage', array(
					'type'        => 'image',
					'settings'    => 'resoto_page_banner_bgimage',
					'label'       => esc_html__( 'Banner Image', 'resoto' ),
					'description' => esc_html__( 'set the banner background image', 'resoto' ),
					'section'     => 'resoto_page_banner',
					'default'     => '',
				) );

				/** Page Banner Text Color **/
				Kirki::add_field( 'resoto_page_banner_textcolor', array(
					'type'        => 'color',
					'settings'    => 'resoto_page_banner_textcolor',
					'label'       => __( 'Text Color', 'resoto' ),
					'description' => esc_html__( 'set the color for the banner text', 'resoto' ),
					'section'     => 'resoto_page_banner',
					'default'     => '#0088CC',
				) );

				/** Enable/Disable Breadcrumb **/
				Kirki::add_field( 'resoto_display_breadcrumb', array(
					'type'        => 'switch',
					'settings'    => 'resoto_display_breadcrumb',
					'label'       => esc_html__( 'Show/Hide Breadcrumb', 'resoto' ),
					'section'     => 'resoto_page_banner',
					'default'     => '1',
					'choices'     => array(
						'on'  => esc_html__( 'Show', 'resoto' ),
						'off' => esc_html__( 'Hide', 'resoto' ),
					),
				) );

	}

	add_filter( 'kirki/fields', 'resoto_header_options' );