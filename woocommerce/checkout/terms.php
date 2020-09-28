<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( apply_filters( 'woocommerce_checkout_show_terms',
		true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
	//do_action( 'woocommerce_checkout_before_terms_and_conditions' );

	/**
	 * Terms and conditions hook used to inject content.
	 *
	 * @since 3.4.0.
	 * @hooked wc_checkout_privacy_policy_text() Shows custom privacy policy text. Priority 20.
	 * @hooked wc_terms_and_conditions_page_content() Shows t&c page content. Priority 30.
	 */
	// do_action( 'woocommerce_checkout_terms_and_conditions' );
	?>

	<?php if ( wc_terms_and_conditions_checkbox_enabled() ) { ?>
        <div class="cart-final__agree">
            <input type="checkbox" name="terms" id="cart-agree"
                   class="visually-hidden" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default',
				isset( $_POST['terms'] ) ), true ); ?>>
            <label for="cart-agree">
				<?php wc_terms_and_conditions_checkbox_text(); ?>
            </label>

            <input type="hidden" name="terms-field" value="1"/>
        </div>
	<?php }

	//do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
