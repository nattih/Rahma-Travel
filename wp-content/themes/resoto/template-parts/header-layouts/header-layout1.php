<?php
	$header_layout = get_theme_mod( 'resoto_header_layout', 'layout1' );
	$enable_top_header = get_theme_mod( 'resoto_enable_top_header', 0 );
	$contact_number = get_theme_mod( 'resoto_contact_number', '' );
	$email = get_theme_mod( 'resoto_email', '' );
	$time = get_theme_mod( 'resoto_time', '' );
	$facebook = get_theme_mod( 'resoto_facebook', '' );
	$twitter = get_theme_mod( 'resoto_twitter', '' );
	$instagram = get_theme_mod( 'resoto_instagram', '' );
	$youtube = get_theme_mod( 'resoto_youtube', '' );

	$sh_class = '';
	$show_search = get_theme_mod( 'resoto_show_search', 1 );
	$show_hotelcart = get_theme_mod( 'resoto_show_hotelcart', 1 );

	if( $show_search || $show_hotelcart ) {
		$sh_class = 'show-sc';
	}
?>
<header id="masthead" class="site-header <?php echo esc_attr( $header_layout ); ?> <?php echo esc_attr( $sh_class ); ?>">
	<?php if( $enable_top_header ) : ?>
		<div class="top-header">
			<div class="rcontainer">
				<?php if( $contact_number || $email || $time ) : ?>
					<div class="left-block">
						<?php if( $contact_number ) : ?>
							<span><i class="lni-phone-handset"></i> <?php echo esc_html( $contact_number ); ?></span>
						<?php endif; ?>

						<?php if( $email ) : ?>
							<span><i class="lni-envelope"></i> <?php echo esc_html( $email ); ?></span>
						<?php endif; ?>

						<?php if( $time ) : ?>
							<span><i class="lni-timer"></i> <?php echo esc_html( $time ); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if( $facebook || $twitter || $instagram || $instagram || $youtube ) : ?>
					<div class="right-block">
						<?php if( $facebook ) : ?>
							<a href="<?php echo esc_url( $facebook ); ?>"><i class="lni-facebook"></i></a>
						<?php endif; ?>
						<?php if( $twitter ) : ?>
							<a href="<?php echo esc_url( $twitter ); ?>"><i class="lni-twitter"></i></a>
						<?php endif; ?>
						<?php if( $instagram ) : ?>
							<a href="<?php echo esc_url( $instagram ); ?>"><i class="lni-instagram"></i></a>
						<?php endif; ?>
						<?php if( $youtube ) : ?>
							<a href="<?php echo esc_url( $youtube ); ?>"><i class="lni-youtube"></i></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="main-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$resoto_description = get_bloginfo( 'description', 'display' );
				if ( $resoto_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $resoto_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<nav id="site-navigation" class="main-navigation">
				<div class="rcontainer">

					<?php if( $show_search ) : ?>
						<div class="resoto-search">
							<span class="lni-search"></span>
							<div class="resoto-search-form">
								<?php get_search_form(); ?>
								<span class="lni-close"></span>
							</div>
						</div>
					<?php endif; ?>

					<a id="simple-menu" href="#resoto-sidemenu"><i class="lni-menu"></i></a>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'		 => false
					) );
					?>

					<?php if( $show_hotelcart ) : ?>
						<div class="resoto-hotelcart">
							<span class="lni-cart"><?php resoto_get_cart_items_count(); ?></span>
							<?php do_shortcode( '[hotel_booking_mini_cart]' ); ?>
						</div>
					<?php endif; ?>
				</div> <!-- .rcontainer -->
			</nav><!-- #site-navigation -->
	</div>
</header><!-- #masthead -->