<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses',
	array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
$available_gateways    = WC()->payment_gateways->get_available_payment_gateways();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>

<div class="cart__flex">

	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>
    <div class="cart__checkout cart-checkout" data-complect="1">
        <div class="cart-checkout__items">

			<?php
			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}
			?>
        </div>

		<?php if ( $order->get_discount_total() > 0 ) { ?>
            <div class="cart-checkout__discount"></div>
		<?php } ?>
        <div class="cart-checkout__result">
            итого: <?php echo get_woocommerce_currency_symbol(); ?> <?php echo $order->get_subtotal(); ?></div>
    </div>

	<?php do_action( 'woocommerce_order_details_after_order_table_items', $order ); ?>

	<?php if ( $show_customer_details ): ?>

        <div class="cart-address">
			<?php wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) ); ?>
        </div>

	<?php endif; ?>

</div>