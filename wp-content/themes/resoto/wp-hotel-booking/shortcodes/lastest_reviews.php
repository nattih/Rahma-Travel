<?php
/**
 * The template for displaying shortcode lastest reviews.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/shortcodes/lastest-reviews.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<div id="hotel_booking_lastest_reviews-<?php echo uniqid(); ?>" class="hotel_booking_lastest_reviews tp-hotel-booking rs-reviews-posts">

	<?php if ( isset( $atts['title'] ) && $atts['title'] ) { ?>
        <h3><?php echo esc_html( $atts['title'] ); ?></h3>
	<?php } ?>

	<?php if( $query->have_posts() ) : ?>
		<ul class="room-list-wrap">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
					if( has_post_thumbnail() ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
						$image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
					}
				?>

				<li>
					<div class="img-wrap">
						<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					</div>
					<div class="room-details">
						<h4><?php the_title(); ?></h4>
						<?php do_action( 'hotel_booking_loop_room_price' ); ?>
						<a href="<?php the_permalink(); ?>" class="book-now-btn">
							<?php esc_html_e( 'Book Now', 'resoto' ); ?>
						</a>
					</div>
				</li>
			<?php endwhile; ?>

		</ul>
	<?php endif; ?>

</div>