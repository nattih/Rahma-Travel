<?php
/**
 * The template for displaying content archive room.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/content-room.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit(); ?>
<?php
	$room_layout = get_theme_mod( 'resoto_rooms_page_layout', 'list' );
	$post_features_ids = get_post_meta( get_the_id(), '_hb_room_extra' );
	$post_features = array();
	if( !empty( $post_features_ids && $post_features_ids[0] != '' ) ) {
		foreach( $post_features_ids[0] as $post_id ) {
			$post_features[$post_id]['name'] = get_the_title( $post_id );
			$post_features[$post_id]['unit'] = get_post_meta( $post_id, 'tp_hb_extra_room_respondent_name', true );
			$post_features[$post_id]['icon'] = get_post_meta( $post_id, 'mystical_eo_icon', true );
		}
	}

	$excerpt_length = get_theme_mod( 'resoto_room_excerpt_length', 100 );
	$view_more_txt = get_theme_mod( 'resoto_room_viewmore_text', 'View More' );
	$show_desc_text = get_theme_mod( 'resoto_enable_room_desc_text', 1 );

	global $hb_room;
	$rating = $hb_room->average_rating();
?>

<li id="room-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * hotel_booking_before_loop_room_item hook
	 */
	do_action( 'hotel_booking_before_loop_room_item' ); ?>

    <div class="summary entry-summary">

		<?php
		/**
		 * hotel_booking_loop_room_thumbnail hook
		 */
		do_action( 'hotel_booking_loop_room_thumbnail' );

		/** Price and Info Wrap Start **/
		echo "<div class='price-infos'>";

		/**
		 * hotel_booking_loop_room_title hook
		 */
		do_action( 'hotel_booking_loop_room_title' );

		if( $show_desc_text ) {
			echo "<p>";

			echo substr( strip_tags( esc_html( get_the_content() ) ), 0, intval( $excerpt_length ) );

			echo "</p>";
		}

		if( !empty( $post_features ) ) :
			echo "<ul class='room-features'>";
				foreach( $post_features as $feature ) :
					?>
					<li>
						<?php if( isset( $feature['icon'] ) ) : ?>
							<span class="icon <?php echo esc_attr( $feature['icon'] ); ?>" ></span>
						<?php endif; ?>

						<?php if( isset( $feature['name'] ) ) : ?>
							<span class="name"><?php echo esc_html( $feature['name'] ); ?></span>
						<?php endif; ?>
					</li>
					<?php
				endforeach;
			echo "</ul>";
		endif;

		echo "<div class='price-readmore-btn' >";
		/**
		 * hotel_booking_loop_room_price hook
		 */
		do_action( 'hotel_booking_loop_room_price' );

		?>
		<a href="<?php the_permalink(); ?>" class="view-more-btn"><?php echo esc_html( $view_more_txt ); ?></a>
		<?php

		echo "</div>";

		/**
		 * hotel_booking_loop_room_price hook
		 */
		if( $rating ) {
			do_action( 'hotel_booking_loop_room_rating' );
		}

		/** Price and Info Wrap Start **/
		echo "</div>";

		?>

    </div><!-- .summary -->

	<?php
	/**
	 * hotel_booking_after_loop_room_item hook
	 */
	do_action( 'hotel_booking_after_loop_room_item' );
	?>

</li>

<?php
/**
 * hotel_booking_after_loop_room
 */
do_action( 'hotel_booking_after_loop_room' ); ?>