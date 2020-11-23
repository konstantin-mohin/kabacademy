<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- Вывод товаров -- checkout/review-order.php -->
<?php
do_action( 'kabacedemy_checkout_order_review' );
do_action( 'woocommerce_before_checkout_billing_form', $checkout );

$disabled = '';
?>


<li class="cart__step cart-step">
    <div class="cart-step__title">Заполните ваши данные</div>
	<?php
	$fields = $checkout->get_checkout_fields( 'billing' );
	?>
    <div class="cart__contacts">
		<?php
		if ( ! is_user_logged_in() ) {
            $fields = array_merge( $fields, $checkout->get_checkout_fields( 'account' ) );
        }
		?>
		<?php foreach ( $fields as $key => $field ) { ?>
			<?php
            $password_field = $key == 'account_password';
			$session_data = WC()->session->get( 'product_form_user_data' );

			if ( ! is_user_logged_in() && ! empty( $session_data ) ) {
				$value = $session_data[ $key ];
			} else {
				$value = $checkout->get_value( $key );

				if ( $key == 'billing_first_name' ) {
					$value = $checkout->get_value( 'first_name' );
				}

				if ( $key == 'billing_last_name' ) {
					$value = $checkout->get_value( 'last_name' );
				}
			}

			if ( $password_field ) {
				$value              = wp_generate_password( 8, false, false );
                if ( ! is_user_logged_in() ) {
                    $field['type'] = 'hidden';
                    $field['label'] = '';
                    $hidePass = true;
                }else{
                    $field['type']      = 'text';
                    $hidePass = false;
                }

			}

			if ( is_user_logged_in() ) {
				$disabled = 'readonly="readonly"';
			}


			?>
            <label for="<?php echo $key; ?>" class="form-label">
                <input
                        type="<?php echo $field['type']; ?>"
                        id="<?php echo $key; ?>"
                        name="<?php echo $key; ?>"
                        value="<?php echo $value; ?>"
					<?php echo $disabled ?>
                >
            <? if (!$hidePass) {?><span><?php echo $field['label']; ?></span><? }?>
				<?php
				if ( $password_field && !$hidePass) {
					echo '<div class="password-toggler"></div>';
				}
				?>
            <? if (!$hidePass) :?></label><? endif;?>


		<?php } ?>

    </div>
</li>


<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
