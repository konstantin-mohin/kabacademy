<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>

    <li class="cart__step cart-step">
		<?php if ( WC()->cart->needs_payment() ) : ?>
            <div class="cart-step__title">Выберите способ оплаты</div>

            <div class="cart__payments cart-payments">
				<?php if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				}
				?>

				<?php do_action( 'kabacedemy_coupoun_checkout_form', $checkout ); ?>
            </div>
		<?php endif; ?>

        <div class="cart-final">
            <div class="cart-final__privacy">
				<?php wc_get_template( 'checkout/terms.php' ); ?>
            </div>

			<?php

			if ( ! WC()->cart->needs_payment() ) {
				$order_button_text = 'Записаться';
			}

			echo apply_filters( 'woocommerce_order_button_html',
				'<button type="submit" class="button alt btn cart-final__button" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div>
    </li>


<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
