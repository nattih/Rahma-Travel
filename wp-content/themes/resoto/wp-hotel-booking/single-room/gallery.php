<?php
/**
 * The template for displaying single room gallery.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room/gallery.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $hb_room;
/**
 * @var $hb_room WPHB_Room
 */
$galleries = $hb_room->get_galleries( false );
?>
<?php if( !empty( $galleries ) ) : ?>
    <div class="gallery-slider-wrap">
        <div class="resoto_hb_gallery owl-carousel">
            <?php foreach( $galleries as $gallery ) : ?>
                <div class="gal-img-wrap">
                    <img src="<?php echo esc_url( $gallery['src'] ); ?>" alt="<?php echo esc_attr( $gallery['alt'] ); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>