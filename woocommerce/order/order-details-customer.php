<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$user_id = $order->get_customer_id();

if ( $user_id ) {
	$user = get_user_by( 'ID', $user_id );
	$customer_name = $user->first_name .' '. $user->last_name;
}

?>

<div class="cart-address__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></div>

<div class="cart-address__text">
	<p><?php echo $customer_name; ?></p>
	<p><?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?></p>
	<?php if ( $order->get_billing_phone() ) : ?>
		<p><?php echo esc_html( $order->get_billing_phone() ); ?></p>
	<?php endif; ?>
	<?php if ( $order->get_billing_email() ) : ?>
		<p><?php echo esc_html( $order->get_billing_email() ); ?></p>
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>