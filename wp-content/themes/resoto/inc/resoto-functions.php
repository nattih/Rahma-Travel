<?php
	/** Resoto Responsive Sidemenu **/
	function resoto_responsive_sidemenu_cb() {
		?>
		<div tabindex="1" id="resoto-sidemenu" style="display: none;">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'		 => false,
				) );
			?>
		</div>
		<?php
	}

	add_action( 'resoto_responsive_sidemenu', 'resoto_responsive_sidemenu_cb' );

	/** Resoto Slider **/
	function resoto_slider_cb() {
		if( !is_front_page() ) {
			return;
		}

		$slider_category = get_theme_mod( 'resoto_slider_category', 0 );
		$slider_layout = get_theme_mod( 'resoto_slider_layout', 'layout1' );

		$slider_query = new WP_Query( array( 'category_name' => $slider_category ) );

		if( $slider_query->have_posts() ) {
			?>
			<div class="resoto-slider owl-carousel <?php echo esc_attr( $slider_layout ); ?>">
				<?php
					while( $slider_query->have_posts() ) {
						$slider_query->the_post();

						$style = '';
						if( has_post_thumbnail() ) {
							$slide_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							$style = 'background-image: url("' . $slide_image[0] . '")';
						}
						?>
						<div class="slide" style="<?php echo esc_attr( $style ); ?>">
							<div class="rcontainer">
								<div class="caption-text">
									<h2 class="slide-title">
										<?php echo wp_kses( get_the_title(), array( 'span' => array()) ); ?>
									</h2>
									<div class="text"><?php the_content(); ?></div>
									<a href="<?php the_permalink(); ?>" class="slide-btn">
										<i class="lni-enter"></i><?php esc_html_e( 'Book Rooms', 'resoto' ); ?>
									</a>
								</div>
							</div>
						</div>
						<?php
					}
				?>
			</div>
			<?php
		}
	}
	add_action( 'resoto_slider', 'resoto_slider_cb' );

	/** Resoto Hotel Search Rooms **/
	function resoto_hb_search_rooms_cb() {
		if( !is_front_page() ) {
			return;
		}

		$show_search_rooms_form = get_theme_mod( 'resoto_show_hb_search_rooms', 1 );

		if( $show_search_rooms_form && is_active_sidebar( 'hb-search-rooms' ) ) {
			?>
			<div class="resoto-hb-search-room">
				<?php dynamic_sidebar( 'hb-search-rooms' ); ?>
			</div>
			<?php
		}
	}
	add_action( 'resoto_hb_search_rooms', 'resoto_hb_search_rooms_cb' );

	/** Resoto Page Banner **/
	function resoto_page_banner_cb() {
		if( !is_front_page() ) {
			$banner_color = get_theme_mod( 'resoto_page_banner_bgcolor', '' );
			$banner_image = get_theme_mod( 'resoto_page_banner_bgimage', '' );
			$display_breadcrumb = get_theme_mod( 'resoto_display_breadcrumb', 1 );
			?>
				<div class="resoto-banner">
					<div class="rcontainer">
						<h2 class="page-title"><?php echo wp_kses_post(resoto_get_page_title()); ?></h2>
                        <?php if( $display_breadcrumb ) : ?>
    						<?php
    							resoto_breadcrumb_trail( array(
    								'container' => '',
    								'show_browse' => false,
    							) );
    						?>
                        <?php endif; ?>
					</div>
				</div>
			<?php
		}
	}
	add_action( 'resoto_page_banner', 'resoto_page_banner_cb' );

	/** Category Slug to Id **/
	function resoto_category_slug_to_id( $cats ) {
		$cat_ids = array();

		if( empty( $cats ) ) {
			return array();
		}

		foreach( $cats as $cat => $slug ) {
			$category = get_category_by_slug( $slug );

			$cat_ids[] = $category->term_id;
		}

		return $cat_ids;
	}

	/** Exclude Categories from Blog Page **/
    function resoto_exclude_cat_from_blog($query) {
        $exclude_cats = get_theme_mod('resoto_blog_exclude_categories', '');
        
        $avoid_categories = resoto_category_slug_to_id($exclude_cats);
        
        if ( $query->is_home() ) {
            $query->set('category__not_in', $avoid_categories);
        }
        
        return $query;
    }

    add_filter('pre_get_posts', 'resoto_exclude_cat_from_blog');

    /** Include Container Wrapper only if page is not based on elementor **/
    function resoto_page_wrapper_start_cb() {
    	wp_reset_postdata();
    	if( is_page() && class_exists('\Elementor\Plugin') ) {
    		$built_on_elementor = \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_id());
    		
    		if( !$built_on_elementor ) {
    			?>
    			<div class="rcontainer">
    			<?php
    		}

    	} else {
    		?>
    		<div class="rcontainer">
    		<?php
		}
    }

    add_action( 'resoto_page_wrapper_start', 'resoto_page_wrapper_start_cb' );

    /** Include Container Wrapper only if page is not based on elementor **/
    function resoto_page_wrapper_end_cb() {
    	wp_reset_postdata();
    	if( is_page() && class_exists('\Elementor\Plugin') ) {
    		$built_on_elementor = \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_id());
    		
    		if( !$built_on_elementor ) {
    			?>
    				</div>
    			<?php
    		}
    	} else {
    		?>
    			</div>
    		<?php    	
    	}
    }

    add_action( 'resoto_page_wrapper_end', 'resoto_page_wrapper_end_cb' );

    /** Get Cart Items Count **/
    function resoto_get_cart_items_count() {
    	if( !class_exists( 'WP_Hotel_Booking' ) ) {
    		return;
    	}

		$cart  = WP_Hotel_Booking::instance()->cart;
		$rooms = $cart->get_rooms();
		$cart_items = ($rooms) ? count($rooms) : 0;
		?>
		<i class="resoto-cart-qty"><?php echo esc_html($cart_items); ?></i>
		<?php
	}

	/** Goto Top **/
	function resoto_goto_top_cb() {
		$goto_top = get_theme_mod( 'resoto_goto_top', 1 );
		if( $goto_top ) {
			?>
			<a href="" id="resoto-goto-top"><i class="lni-angle-double-up"></i></a>
			<?php
		}
		?>
		<?php
	}

	add_action( 'resoto_goto_top', 'resoto_goto_top_cb' );

	/** Preloader **/
	function resoto_preloader_cb() {
		$enable_preloader = get_theme_mod( 'resoto_enable_preloader', 1 );

		if( $enable_preloader ) :
		?>
		<div id="resoto-preloader">
			<div class="sk-folding-cube">
			  <div class="sk-cube1 sk-cube"></div>
			  <div class="sk-cube2 sk-cube"></div>
			  <div class="sk-cube4 sk-cube"></div>
			  <div class="sk-cube3 sk-cube"></div>
			</div>
		</div>
		<?php
		endif;
	}

	add_action( 'resoto_preloader', 'resoto_preloader_cb' );

	/** Add Dynamic Fonts **/
	function resoto_dynamic_google_fonts( $google_fonts ) {

		$fonts = array();
		$font_weights = array('400', '500', '600', '700', '800', '900');

		/** Heading Font **/
		$fonts[] = get_theme_mod( 'resoto_heading', '' );
		/** Body Font **/
		$fonts[] = get_theme_mod( 'resoto_body', '' );

		/** Body Font **/
		$fonts[] = get_theme_mod( 'resoto_widget_title', '' );

		foreach( $fonts as $font ) {
			if( !empty( $font ) ) {
				$google_fonts[$font['font-family']] = array(
					'weights' => $font_weights,
				);
			}
		}

		return $google_fonts;
	}

	add_filter( 'resoto_google_fonts', 'resoto_dynamic_google_fonts' );