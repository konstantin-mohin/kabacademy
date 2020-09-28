<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

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

                <div class="cart-checkout__item" data-price="<?php echo $_product->get_price(); ?>">
                    <div class="cart-checkout__item__image">
						<?php echo $_product->get_image(); ?>
                    </div>

                    <div class="cart-checkout__item__name">
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
        <!--		<div class="cart-checkout__discount" data-price="10"> включая скидку <b>-->
		<?php //echo get_woocommerce_currency_symbol(); ?><!-- 10</b> за заказ комплекта-->
        <!--		</div>-->
        <div class="cart-checkout__result">итого: <?php echo WC()->cart->get_total(); ?></div>
    </div>

</li>

<?php /*
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<?php if ( wc_coupons_enabled() ) { ?>
		<div class="coupon">
			<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
			<?php do_action( 'woocommerce_cart_coupon' ); ?>
		</div>
	<?php } ?>

	<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

	<?php do_action( 'woocommerce_cart_actions' ); ?>

	<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

</form>

*/ ?>

<?php //do_action( 'woocommerce_before_cart_collaterals' ); ?>

<!-- <div class="cart-collaterals"> -->
<?php
/**
 * Cart collaterals hook.
 *
 * @hooked woocommerce_cross_sell_display
 * @hooked woocommerce_cart_totals - 10
 */
//do_action( 'woocommerce_cart_collaterals' );
?>
<!-- </div> -->

<?php //do_action( 'woocommerce_after_cart' ); ?>
