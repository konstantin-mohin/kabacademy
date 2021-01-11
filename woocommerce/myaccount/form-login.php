<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

    <div class="form-top">


        <div class="modal__form__title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></div>

        <form method="post" class="modal__form">

			<?php //wdmShowNotices(); ?>
            <div class="form-group">
                <label class="form-label">
                    <input type="text" name="wdm_username" id="username"> <span>Ваш email</span>
                </label>
                <label class="form-label">
                    <input type="password" name="wdm_password" id="password"> <span>Ваш пароль</span>
                </label>
            </div>

            <input type="submit" class="eb-login-button btn modal__form__button" name="wdm_login"
                   value="войти на сайт"/>

            <a class="link modal__form__link"
               href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?',
					'woocommerce' ); ?></a>

			<?php wp_nonce_field( 'eb-login' ); ?>
            <input type="hidden" name="rememberme" value="forever"/>
        </form>
    </div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>