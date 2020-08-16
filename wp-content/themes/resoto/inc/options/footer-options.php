<?php
	/** Footer Options **/
	function resoto_footer_options( $wp_customize ) {

		/** Footer Section **/
		Kirki::add_section( 'resoto_footer_options', array(
		    'title'          => esc_html__( 'Footer', 'resoto' ),
		) );

			/** Footer Layout **/
			Kirki::add_field( 'resoto_footer_layout', array(
				'type'        => 'select',
				'settings'    => 'resoto_footer_layout',
				'label'       => esc_html__( 'Footer Layout', 'resoto' ),
				'section'     => 'resoto_footer_options',
				'default'     => 'layout1',
				'multiple'    => 1,
				'description' => esc_html__( 'select the layout for the footer', 'resoto' ),
				'choices'     => array(
					'layout1' => esc_html__( 'Layout 1', 'resoto' ),
					'layout2' => esc_html__( 'Layout 2', 'resoto' ),
				),
			) );

			/** Footer Widgets Help **/
			Kirki::add_field( 'resoto_footer_widgets_help', array(
				'type'        => 'custom',
				'settings'    => 'resoto_footer_widgets_help',
				'label'       => esc_html__( 'Footer Widgets', 'resoto' ),
				'section'     => 'resoto_footer_options',
				'default'     => '
					<ul style="background-color: #008ec2; padding: 10px; color: #fff">
						<li>'. esc_html__( "Go to Dashboard > Appearance > Widgets", "resoto" ) .'</li>
						<li>'. esc_html__( "Add Widgets to Footer (1-4)", "resoto" ) .'</li>
						<li>'. esc_html__( "Save the widgets", "resoto" ) .'</li>
					</ul>
				',
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout1',
					)
				),
			) );

			/** Footer Logo **/
			Kirki::add_field( 'resoto_footer_logo', array(
				'type'        => 'image',
				'settings'    => 'resoto_footer_logo',
				'label'       => esc_html__( 'Footer Logo', 'resoto' ),
				'section'     => 'resoto_footer_options',
				'default'     => '',
				'description' => esc_html__( 'select the logo for the footer', 'resoto' ),
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout2',
					)
				),
			) );

			/** Footer Menu Help **/
			Kirki::add_field( 'resoto_footer_menu_help', array(
				'type'        => 'custom',
				'settings'    => 'resoto_footer_menu_help',
				'label'       => esc_html__( 'Footer Menu', 'resoto' ),
				'section'     => 'resoto_footer_options',
				'default'     => '
					<ul style="background-color: #008ec2; padding: 10px; color: #fff">
						<li>'. esc_html__( "Go to Dashboard > Appearance > Menus", "resoto" ) .'</li>
						<li>'. esc_html__( "Create a menu for the footer", "resoto" ) .'</li>
						<li>'. esc_html__( "Set the menu location to Footer Menu", "resoto" ) .'</li>
					</ul>
				',
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout2',
					)
				),
			) );

			/** Facebook Link **/
			Kirki::add_field( 'resoto_footer_facebook', array(
				'type'     => 'link',
				'settings' => 'resoto_footer_facebook',
				'label'    => __( 'Facebook Link', 'resoto' ),
				'section'  => 'resoto_footer_options',
				'default'  => '',
				'description' => esc_html__( 'set the social link for facebook', 'resoto' ),
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout2',
					)
				),
			) );

			/** Twitter Link **/
			Kirki::add_field( 'resoto_footer_twitter', array(
				'type'     => 'link',
				'settings' => 'resoto_footer_twitter',
				'label'    => __( 'Twitter Link', 'resoto' ),
				'section'  => 'resoto_footer_options',
				'default'  => '',
				'description' => esc_html__( 'set the social link for twitter', 'resoto' ),
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout2',
					)
				),
			) );

			/** Instagram Link **/
			Kirki::add_field( 'resoto_footer_instagram', array(
				'type'     => 'link',
				'settings' => 'resoto_footer_instagram',
				'label'    => __( 'Instagram Link', 'resoto' ),
				'section'  => 'resoto_footer_options',
				'default'  => '',
				'description' => esc_html__( 'set the social link for instagram', 'resoto' ),
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout2',
					)
				),
			) );

			/** Youtube Link **/
			Kirki::add_field( 'resoto_footer_youtube', array(
				'type'     => 'link',
				'settings' => 'resoto_footer_youtube',
				'label'    => __( 'Youtube Link', 'resoto' ),
				'section'  => 'resoto_footer_options',
				'default'  => '',
				'description' => esc_html__( 'set the social link for youtube', 'resoto' ),
				'active_callback' => array(
					array(
						'setting'  => 'resoto_footer_layout',
						'operator' => '==',
						'value'    => 'layout2',
					)
				),
			) );

			/** Copyright Text **/
			Kirki::add_field( 'resoto_copyright_text', array(
				'type'     => 'textarea',
				'settings' => 'resoto_copyright_text',
				'label'    => esc_html__( 'Copyright Text', 'resoto' ),
				'section'  => 'resoto_footer_options',
				'description' => esc_html__( 'set the copyright text.', 'resoto' ),
			) );

			/** Upgrade Info **/
			Kirki::add_field( 'resoto_more_footer_opts', [
				'type'        => 'custom',
				'settings'    => 'resoto_more_footer_opts',
				'section'     => 'resoto_footer_options',
				'default'     => '<div style="padding: 10px; background-color: #e97070; color: #e7e7e7; font-size: 14px; font-weight: 600;">' . esc_html__( 'Add your own footer copyright text using the pro theme.', 'resoto' ) . '</div>',
			] );

	}

	add_filter( 'kirki/fields', 'resoto_footer_options' );