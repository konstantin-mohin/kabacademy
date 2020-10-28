<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ($current_user->last_name != '-') {    
    $name = $current_user->first_name . ' ' . $current_user->last_name; 
} else {
    $name = $current_user->first_name; 
} 

?>

<p class="woocommerce-myaccount__welcome">
	<?php
	printf(__( 'Добро пожаловать, %1$s', 'woocommerce' ),
		'<strong>' . esc_html( $name ) . '!</strong>',
		esc_url( wc_logout_url() )
	);
	?>
</p>

<p class="woocommerce-myaccount__subtext">
	На странице аккаунта вы можете посмотреть ваши <a href="<?php get_site_url(); ?>/my-account/my-courses/">курсы</a>,	<a href="<?php get_site_url(); ?>/my-account/orders/">заказы</a>, <a href="<?php get_site_url(); ?>/my-account/subscriptions/">подписки</a>, а также<br> <a href="<?php get_site_url(); ?>/my-account/edit-account/">изменить пароль</a> и основную информацию о пользователе.
</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
