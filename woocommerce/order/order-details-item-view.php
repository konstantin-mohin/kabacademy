<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}

global $current_user;

?>

<div class="cabinet-complete__info__item">
	<div class="cabinet-complete__info__item__name">
		<?php 
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

		echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ); ?>
	</div>
	<div class="cabinet-complete__info__item__dash"></div>
	<div class="cabinet-complete__info__item__price">
		<?php 
			$qty          = $item->get_quantity();
			$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

			if ( $refunded_qty ) {
				$qty_display = esc_html( $qty ) . esc_html( $qty - ( $refunded_qty * -1 ) );
			} else {
				$qty_display = esc_html( $qty );
			}
			
			echo apply_filters( 'woocommerce_order_item_quantity_html', $qty_display, $item );
			echo ' &times; ';
			echo $order->get_formatted_line_subtotal( $item ); 

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

			wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        
			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
		?>
	</div>
</div>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>

<?php endif; ?>
