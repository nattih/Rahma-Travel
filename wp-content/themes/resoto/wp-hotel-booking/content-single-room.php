<?php
/**
 * The template for displaying content single room.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/content-single-room.php.
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
/**
 * hotel_booking_before_single_product hook
 */
do_action( 'hotel_booking_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
} ?>

<?php
	$room_class = '';
	$room_class = ( is_active_sidebar( 'hb-room-sidebar' ) ) ? ' has-sidebar' : ' no-sidebar';
?>
<div class="resoto-room-wrap<?php echo esc_attr( $room_class ); ?>">

	<div id="room-<?php the_ID(); ?>" <?php post_class( 'hb_single_room' ); ?>>

		<?php
		/**
		 * hotel_booking_before_loop_room_summary hook
		 */
		do_action( 'hotel_booking_before_single_room' );
		?>

	    <div class="summary entry-summary">

			<?php
			/**
			 * hotel_booking_single_room_gallery hook
			 */
			do_action( 'hotel_booking_single_room_gallery' );

			/**
			 * room features
			 */
			$post_features_ids = get_post_meta( get_the_id(), '_hb_room_extra' );
			$post_features = array();
			if( !empty( $post_features_ids && $post_features_ids[0] != '' ) ) {
				foreach( $post_features_ids[0] as $post_id ) {
					$post_features[$post_id]['name'] = get_the_title( $post_id );
					$post_features[$post_id]['unit'] = get_post_meta( $post_id, 'tp_hb_extra_room_respondent_name', true );
					$post_features[$post_id]['icon'] = get_post_meta( $post_id, 'resoto_eo_icon', true );
				}
			}

			/**
			 * hotel_booking_loop_room_price hook
			 */
			echo "<div class='bg_single_price_wrap'>";
			do_action( 'hotel_booking_loop_room_price' );
			echo "</div>";

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

			/**
			 * hotel_booking_single_room_infomation hook
			 */
			do_action( 'hotel_booking_single_room_infomation' );
			?>

	    </div>

		<?php
		/**
		 * hotel_booking_after_single_room hook
		 */
		do_action( 'hotel_booking_after_single_room' );
		?>

	</div>

	<?php if( is_active_sidebar( 'hb-room-sidebar' ) ) : ?>
		<div class="sroom-sidebar">
		<?php dynamic_sidebar( 'hb-room-sidebar' ); ?>
		</div>
	<?php endif; ?>

</div>

<?php
/**
 * hotel_booking_after_single_product hook
 */
do_action( 'hotel_booking_after_single_product' ); ?>