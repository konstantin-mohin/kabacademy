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
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>

<li class="cart__step cart-step">
    <div class="cart-step__title">Проверьте ваш заказ</div>

    <div class="cart__checkout cart-checkout" data-complect="">
        <div class="cart-checkout__items">
			<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
				<?php
				$_product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item,
					$cart_item_key );
				$product_id        = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'],
					$cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink',
					$_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>

                <div class="cart-checkout__item">
                    <div class="cart-checkout__item__image">
						<?php echo $_product->get_image(); ?>
                    </div>

                    <div class="cart-checkout__item__name" data-price="<?php echo $_product->get_price(); ?>">
                        <!-- <span>Основы, часть 1:</span> <b>Базовые знания</b> -->
                        <b>
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(),
										$cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name',
									sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ),
										$_product->get_name() ), $cart_item, $cart_item_key ) );
							}
							?>
                        </b>
                    </div>

                    <div><?php sv_wc_memberships_member_discount_product_notice( $product_id ); ?></div>

                    <div class="cart-checkout__item__price">
						<?php
						echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ),
							$cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
                    </div>
					<?php
					echo apply_filters(
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="cart-checkout__item__delete js-cart-checkout-item-delete" aria-label="%s" data-product_id="%s" data-product_sku="%s">
								<svg class="icon__icon-close" width="10" height="10">
									<use href="/svg-symbols.svg#icon-close"></use>
								</svg>
								</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_html__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $_product->get_sku() )
						),
						$cart_item_key
					);
					?>
                </div>

			<?php endforeach; ?>

        </div>
		<?php if ( WC()->cart->has_discount() ) { ?>
            <div class="cart-checkout__discount">

				<?php foreach ( WC()->cart->get_coupons() as $coupon ) { ?>
                    включая скидку
                    <b><?php echo $coupon->get_amount(); ?><?php echo ( $coupon->is_type( 'percent' ) ) ? '%' : ''; ?> </b>
                    по промокоду
				<?php } ?>

            </div>
		<?php } ?>
        <div class="cart-checkout__result"> итого: <?php echo WC()->cart->get_total(); ?></div>
    </div>

</li>