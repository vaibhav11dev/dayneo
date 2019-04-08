<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table class="totals table shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
		    <td class="product-name"><h5 class="m-0"><?php esc_html_e( 'Product', 'dayneo' ); ?></h5></td>
		    <td class="product-total"><h5 class="m-0 text-right"><?php esc_html_e( 'Total', 'dayneo' ); ?></h5></td>
		</tr>
	</thead>
	<tbody>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<td class="product-name">
							<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
						</td>
						<td class="product-total text-right">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal">
		    <td><h5 class="m-0"><?php esc_html_e( 'Subtotal', 'dayneo' ); ?></h5></td>
		    <td><h5 class="m-0 color-gray text-right"><?php wc_cart_totals_subtotal_html(); ?></h5></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<td><h5 class="m-0"><?php wc_cart_totals_coupon_label( $coupon ); ?></h5></td>
				<td><h5 class="m-0 color-gray text-right"><?php wc_cart_totals_coupon_html( $coupon ); ?></h5></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<td><h5 class="m-0"><?php echo esc_html( $fee->name ); ?></h5></td>
				<td><h5 class="m-0 color-gray text-right"><?php wc_cart_totals_fee_html( $fee ); ?></h5></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                        <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<td><h5 class="m-0"><?php echo esc_html( $tax->label ); ?></h5></td>
						<td><h5 class="m-0 color-gray text-right"><?php echo wp_kses_post( $tax->formatted_amount ); ?></h5></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<td><h5 class="m-0"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h5></td>
					<td><h5 class="m-0 color-gray text-right"><?php wc_cart_totals_taxes_total_html(); ?></h5></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
		    <td><h4 class="m-0"><?php esc_html_e( 'Total', 'dayneo' ); ?></h4></td>
		    <td><h4 class="m-0 text-right"><?php wc_cart_totals_order_total_html(); ?></h4></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>
