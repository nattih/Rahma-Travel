<?php
	function resoto_category_list( $for ) {
		$categories = get_categories();
		$category_list = array();

		if( $for == 'dropdown' ) {
			$category_list[0] = esc_html__( 'Select Category', 'resoto' );
		}

		foreach( $categories as $category ) {
			$category_list[$category->slug] = $category->name;
		}

		return $category_list;
	}