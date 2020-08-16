<?php
	/** Blog Options **/
	function resoto_blog_options( $wp_customize ) {

		$category_list = resoto_category_list('dropdown');
		$category_list_chk = resoto_category_list('checkbox');

		/** Blog Section **/
		Kirki::add_section( 'resoto_blog_options', array(
		    'title'          => esc_html__( 'Blogs', 'resoto' ),
		) );

			/** Blog Layout **/
			Kirki::add_field( 'resoto_blog_layout', array(
				'type'        => 'select',
				'settings'    => 'resoto_blog_layout',
				'label'       => esc_html__( 'Blog Layout', 'resoto' ),
				'section'     => 'resoto_blog_options',
				'default'     => 'layout1',
				'multiple'    => 1,
				'description' => esc_html__( 'select layout for the blog page', 'resoto' ),
				'choices'     => array(
					'layout1' => esc_html__( 'Classic', 'resoto' ),
					'layout2' => esc_html__( 'Grid', 'resoto' ),
				),
			) );

			/** Blog Sidebar Layout **/
			Kirki::add_field( 'resoto_blog_sidebar_layout', array(
				'type'        => 'radio-image',
				'settings'    => 'resoto_blog_sidebar_layout',
				'label'       => esc_html__( 'Sidebar Layout', 'resoto' ),
				'section'     => 'resoto_blog_options',
				'default'     => 'no-sidebar',
				'description' => esc_html__( 'select sidebar layout for the blog page', 'resoto' ),
				'choices'     => array(
					'no-sidebar'   => get_template_directory_uri() . '/assets/images/no-sidebar.png',
					'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
				),
			) );

			/** Exclude Categories **/
			Kirki::add_field( 'resoto_blog_exclude_categories', array(
				'type'        => 'multicheck',
				'settings'    => 'resoto_blog_exclude_categories',
				'label'       => esc_html__( 'Exclude Categories', 'resoto' ),
				'section'     => 'resoto_blog_options',
				'default'     => array(),
				'choices'     => $category_list_chk,
				'description' => esc_html__( 'check the categories to exclude from blog page', 'resoto' ),
			) );

			/** Excerpt Length **/
			Kirki::add_field( 'resoto_blog_excerpt_length', array(
				'type'        => 'slider',
				'settings'    => 'resoto_blog_excerpt_length',
				'label'       => esc_html__( 'Excerpt Length (In Chars)', 'resoto' ),
				'section'     => 'resoto_blog_options',
				'description' => esc_html__( 'set the excerpt length for the blog posts', 'resoto' ),
				'choices'     => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				),
			) );

			/** ReadMore Text **/
			Kirki::add_field( 'resoto_blog_readmore_text', array(
				'type'     => 'text',
				'settings' => 'resoto_blog_readmore_text',
				'label'    => esc_html__( 'Read More Text', 'resoto' ),
				'section'  => 'section_id',
			) );

	}

	add_filter( 'kirki/fields', 'resoto_blog_options' );