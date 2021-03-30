<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="order_details order-receipt-details">
	<div class="order order-receipt-item">
		<div class="order-receipt-item-left"><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></div>
		<div class="order-receipt-item-right"><strong><?php echo esc_html( $order->get_order_number() ); ?></strong></div>
	</div>
	<div class="date order-receipt-item">
		<div class="order-receipt-item-left"><?php esc_html_e( 'Date:', 'woocommerce' ); ?></div>
		<div class="order-receipt-item-right"><strong><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong></div>
	</div>
	<div class="total order-receipt-item">
		<div class="order-receipt-item-left"><?php esc_html_e( 'Total:', 'woocommerce' ); ?></div>
		<div class="order-receipt-item-right"><strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong></div>
	</div>
	<?php if ( $order->get_payment_method_title() ) : ?>
	<div class="method order-receipt-item">
		<div class="order-receipt-item-left"><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></div>
		<div class="order-receipt-item-right"><strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong></div>
	</div>
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>

<div class="clear"></div>
