<?php
/**
 * The template for displaying checkout page.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/checkout/checkout.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.9.7.5
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $cart        WPHB_Cart
 * @var $hb_settings WPHB_Settings
 * @var $customer
 */
global $hb_settings;
$cart = WP_Hotel_Booking::instance()->cart; ?>

<?php do_action( 'hotel_booking_before_checkout_form' ); ?>

	<div id="hotel-booking-payment">

		<form name="hb-payment-form" id="hb-payment-form" method="post"
		      action="<?php echo isset( $search_page ) ? $search_page : ''; ?>">
			<table class="hb_table">
				<thead>
				<tr>
					<th class="hb_room_type"><?php _e( 'Room type', 'resoto' ); ?></th>
					<th class="hb_capacity"><?php _e( 'Capacity', 'resoto' ); ?></th>
					<th class="hb_quantity"><?php _e( 'Quantity', 'resoto' ); ?></th>
					<th class="hb_check_in"><?php _e( 'Check - in', 'resoto' ); ?></th>
					<th class="hb_check_out"><?php _e( 'Check - out', 'resoto' ); ?></th>
					<th class="hb_night"><?php _e( 'Night', 'resoto' ); ?></th>
					<th class="hb_gross_total"><?php _e( 'Gross Total', 'resoto' ); ?></th>
				</tr>
				</thead>

				<?php if ( $rooms = $cart->get_rooms() ) {
					foreach ( $rooms as $cart_id => $room ) {

						/**
						 * @var $room WPHB_Room
						 */
						if ( ( $num_of_rooms = (int) $room->get_data( 'quantity' ) ) == 0 ) {
							continue;
						}
						$cart_extra = $cart->get_extra_packages( $cart_id );
						$sub_total  = $room->get_total( $room->check_in_date, $room->check_out_date, $num_of_rooms, false ); ?>

						<tr class="hb_checkout_item" data-cart-id="<?php echo esc_attr( $cart_id ); ?>">
							<td class="hb_room_type"<?php echo defined( 'WPHB_EXTRA_FILE' ) && $cart_extra ? ' rowspan="' . ( count( $cart_extra ) + 2 ) . '"' : '' ?>>
								<a href="<?php echo esc_url( get_permalink( $room->ID ) ); ?>"><?php echo apply_filters( 'hb_checkout_room_name', $room->name, $room->ID ); ?><?php printf( '%s', $room->capacity_title ? ' (' . $room->capacity_title . ')' : '' ); ?></a>
							</td>
							<td class="hb_capacity"><?php echo sprintf( _n( '%d adult', '%d adults', $room->capacity, 'resoto' ), $room->capacity ); ?> </td>
							<td class="hb_quantity"><?php printf( '%s', $num_of_rooms ); ?></td>
							<td class="hb_check_in"><?php echo date_i18n( hb_get_date_format(), strtotime( $room->get_data( 'check_in_date' ) ) ) ?></td>
							<td class="hb_check_out"><?php echo date_i18n( hb_get_date_format(), strtotime( $room->get_data( 'check_out_date' ) ) ) ?></td>
							<td class="hb_night"><?php echo hb_count_nights_two_dates( $room->get_data( 'check_out_date' ), $room->get_data( 'check_in_date' ) ) ?></td>
							<td class="hb_gross_total">
								<?php echo hb_format_price( $room->total ); ?>
							</td>
						</tr>

						<?php do_action( 'hotel_booking_cart_after_item', $room, $cart_id ); ?>
					<?php }
				} ?>

				<?php do_action( 'hotel_booking_before_cart_total' ); ?>

				<tr class="hb_sub_total">
					<td colspan="7"><?php _e( 'Sub Total', 'resoto' ); ?>
						<span class="hb-align-right hb_sub_total_value">
                        <?php echo hb_format_price( $cart->sub_total ); ?>
                    </span>
					</td>
				</tr>

				<?php if ( $tax = hb_get_tax_settings() ) { ?>
					<tr class="hb_advance_tax">
						<td colspan="7">
							<?php _e( 'Tax', 'resoto' ); ?>
							<?php if ( $tax < 0 ) { ?>
								<span><?php printf( __( '(price including tax)', 'resoto' ) ); ?></span>
							<?php } ?>
							<span class="hb-align-right"><?php echo apply_filters( 'hotel_booking_cart_tax_display', hb_format_price( $cart->total - $cart->sub_total ) ); // abs( $tax * 100 ) . '%' ?></span>
						</td>
					</tr>
				<?php } ?>

				<tr class="hb_advance_grand_total">
					<td colspan="7">
						<?php _e( 'Grand Total', 'resoto' ); ?>
						<span class="hb-align-right hb_grand_total_value"><?php echo hb_format_price( $cart->total ); ?></span>
					</td>
				</tr>

				<?php $advance_payment = ''; ?>
				<?php if ( $advance_payment = $cart->advance_payment ) { ?>
					<tr class="hb_advance_payment">
						<td colspan="7">
							<?php printf( __( 'Advance Payment (%s%% of Grand Total)', 'resoto' ), hb_get_advance_payment() ); ?>
							<span class="hb-align-right hb_advance_payment_value"><?php echo hb_format_price( $advance_payment ); ?></span>
						</td>
					</tr>
					<?php if ( hb_get_advance_payment() < 100 ) { ?>
						<tr class="hb_payment_all">
							<td colspan="7" class="hb-align-right">
								<label class="hb-align-right check-wrap">
									<input type="checkbox" name="pay_all" />
									<span class="checkmark"></span>
									<p>
										<?php _e( 'I want to pay all', 'resoto' ); ?>
									</p>
								</label>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>

			</table>

			<?php if ( ! is_user_logged_in() && ! hb_settings()->get( 'guest_checkout' ) ) { ?>
				<?php printf( __( 'You have to <strong><a href="%1$s">login</a></strong> or <strong><a href="%2$s">register</a></strong> to checkout.', 'resoto' ), wp_login_url( hb_get_checkout_url() ), wp_registration_url() ) ?>
			<?php } else { ?>
				<?php hb_get_template( 'checkout/customer.php', array( 'customer' => $customer ) ); ?>
				<?php hb_get_template( 'checkout/payment-method.php', array( 'customer' => $customer ) ); ?>
				<?php hb_get_template( 'checkout/addition-information.php' ); ?>
				<?php wp_nonce_field( 'hb_customer_place_order', 'hb_customer_place_order_field' ); ?>

				<input type="hidden" name="hotel-booking" value="place_order" />
				<input type="hidden" name="action" value="hotel_booking_place_order" />
				<input type="hidden" name="total_advance"
				       value="<?php echo esc_attr( $cart->advance_payment ? $cart->advance_payment : $cart->total ); ?>" />
				<input type="hidden" name="total_price" value="<?php echo esc_attr( $cart->total ); ?>" />
				<input type="hidden" name="currency" value="<?php echo esc_attr( hb_get_currency() ) ?>">
				<?php if ( $tos_page_id = hb_get_page_id( 'terms' ) ) { ?>
					<p>
						<label>
							<input type="checkbox" name="tos" value="1" />
							<?php printf( __( 'I agree with ', 'resoto' ) . '<a href="%s" target="_blank">%s</a>', get_permalink( $tos_page_id ), get_the_title( $tos_page_id ) ); ?>
						</label>
					</p>
				<?php } ?>
				<p>
					<button type="submit" class="hb_button"><?php _e( 'Check out', 'resoto' ); ?></button>
				</p>

			<?php } ?>
		</form>
	</div>

<?php do_action( 'hotel_booking_after_checkout_form' ); ?>