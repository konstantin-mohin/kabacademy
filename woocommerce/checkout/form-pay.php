<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$totals = $order->get_order_item_totals();
?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>

<?php
$status_class = '';
if ( $order->get_status() !== 'completed' ) {
	$status_class = 'cart__status--error';
}
?>

<div class="cart__header">
    <h1 class="cart__title">Заказ № <?php echo $order->get_order_number(); ?></h1>
    <div class="cart__date">от <?php echo wc_format_datetime( $order->get_date_created() ); ?></div>
    <div class="cart__status <?php echo $status_class; ?>"><?php echo wc_get_order_status_name( $order->get_status() ); ?></div>
</div>

<form id="order_review" method="post">

	<?php woocommerce_order_details_table( $order->get_id() ); ?>

	<?php if ( $order->needs_payment() ) : ?>
        <div class="cart__payments cart-payments">
			<?php if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			}
			?>
        </div>
	<?php endif; ?>

    <div class="cart-final">
        <input type="hidden" name="woocommerce_pay" value="1"/>

        <div class="cart-final__privacy">
			<?php wc_privacy_policy_text(); ?>
        </div>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_pay_order_button_html',
			'<button type="submit" class="button alt btn cart-final__button cart-final__button--white" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); ?>

		<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>

        <a href="<?php echo wc_get_account_endpoint_url( 'orders' ); ?>"
           class="cart-final__back">← назад на список заказов</a>
    </div>

</form>
