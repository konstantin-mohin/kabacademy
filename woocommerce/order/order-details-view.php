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

/*if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}/*

$idsorders = array();
$idworked = false;
$macclub = get_field ('mp_training_products', 'option');
            
if ($order->items) {
        foreach ($order->items as $item) {                    
            $idsorders[] = $order->ID;
        }
}
            
if (isset($idsorders) && in_array($macclub, $idsorders)) {
?>
   <script>
        jQuery('#wi-thanq-wrapper a').replaceWith('<a href="/mak-club/">Мак Клуб</a>');
        setTimeout(function(){
            jQuery('#wi-thanq-wrapper a').replaceWith('<a href="/mak-club/">Мак Клуб</a>');
        }, 1000);
        setTimeout(function(){
            window.location.href = '/mak-club/'; 
        }, 9000);
   </script>
<?php    
}*/
?>

<div class="cabinet-complete__info">
    <div class="cabinet-complete__info-row">
		<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

        <div class="cabinet-complete__info__title"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></div>

        <div class="cabinet-complete__info__list">
			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();
                
                /**Redirect to Mac Club**/  
                
                $cat_ID = $product->category_ids['0'];
                $macclub = get_field ('mp_training_products', 'option');
                //if (($cat_ID == 59) || ($product->id == $macclub)) { 
                if ($product->id == $macclub) { 
                ?>
                <script>
                    jQuery('#wi-thanq-wrapper a').replaceWith('<a href="/mak-club/">Мак Клуб</a>');
                    setTimeout(function go() {
                        let current = 5;
                        if (current < 10) {
                          setTimeout(go, 600);
                        }
                        jQuery('#wi-thanq-wrapper a').replaceWith('<a href="/mak-club/">Мак Клуб</a>');
                        jQuery('#wi-cancel-redirect').attr("disabled", true);
                        current++;
                    }, 600);
                    setTimeout(function(){
                        window.location.href = '/mak-club/'; 
                    }, 6000);
                </script>

                <?php }
                
                /*******/

				wc_get_template(
					'order/order-details-item-view.php',
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

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>

			<?php foreach ( $order->get_order_item_totals() as $key => $total ) { ?>
                <div class="cabinet-complete__info__item">
                    <div class="cabinet-complete__info__item__name"><?php echo esc_html( $total['label'] ); ?></div>
                    <div class="cabinet-complete__info__item__dash"></div>
                    <div class="cabinet-complete__info__item__price">
						<?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); ?>
                    </div>
                </div>
				<?php
			}
			?>
        </div>

		<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
    </div>

	<?php if ( $show_customer_details ): ?>

        <div class="cabinet-complete__info-row">
			<?php wc_get_template( 'order/order-details-customer-view.php', array( 'order' => $order ) ); ?>
        </div>

	<?php endif; ?>
</div>