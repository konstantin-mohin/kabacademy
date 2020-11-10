<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<?php
global $current_user, $wp_roles;


$username    = $current_user->user_login;
$first_name  = getArrValue( $_POST, "first_name", $current_user->first_name );
$last_name   = getArrValue( $_POST, "last_name", $current_user->last_name );
$nickname    = getArrValue( $_POST, "nickname", $current_user->nickname );
$email       = getArrValue( $_POST, "email", $current_user->user_email );
$description = getArrValue( $_POST, "description", $current_user->description );
$city        = getArrValue( $_POST, "city", $current_user->city );
$country     = getArrValue( $_POST, "country", $current_user->country );
$phone       = getArrValue( $_POST, "phone", $current_user->billing_phone );

if ( isset( $_SESSION[ 'eb_msgs_' . $current_user->ID ] ) ) {
	echo $_SESSION[ 'eb_msgs_' . $current_user->ID ];
	unset( $_SESSION[ 'eb_msgs_' . $current_user->ID ] );
}
?>
<form method="post" class="edit-account cabinet__form" autocomplete="off">
    <div class="form-group cabinet__form__name">
        <label class="form-label">
            <input type="text" name="first_name" id="first_name" autocomplete="given-name" required
                   value="<?php echo esc_attr( $first_name ); ?>"/>
            <span><?php esc_html_e( 'First name', 'woocommerce' ); ?> *</span>
        </label>

        <label class="form-label">
            <input type="text" name="last_name" id="last_name" autocomplete="family-name" required
                   value="<?php echo esc_attr( $last_name ); ?>"/>
            <span><?php esc_html_e( 'Last name', 'woocommerce' ); ?> *</span>
        </label>

        <!--label class="form-label">
            <input type="text" name="nickname" id="nickname" required value="<-?php echo esc_attr( $nickname ); ?>"/>
            <span><-?php esc_html_e( 'Display name', 'woocommerce' ); ?> *</span>
            <p class="form-label__tip"><-?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></p>
        </label-->

        <label class="form-label">
            <input type="email" name="email" id="email" autocomplete="email" required
                   value="<?php echo esc_attr( $email ); ?>"/>
            <span><?php esc_html_e( 'Email address', 'woocommerce' ); ?> *</span>
        </label>

        <label class="form-label">
            <input type="text" name="phone1" id="phone" required
                   value="<?php echo esc_attr( $phone ); ?>"/>
            <span><?php esc_html_e( 'Phone', 'woocommerce' ); ?></span>
        </label>
    </div>
	<?php
	do_action( 'eb_user_account_show_account_details_fields', $current_user );
	/**
	 * This will add the list of the countrys in the dropdown.
	 */
	wp_enqueue_script( 'edwiserbridge-edit-user-profile' );
	?>
    <div class="form-group">
        <label class="form-label-select">
            <span class="form-label-select-badge"><?php _e( 'Country', 'eb-textdomain' ); ?></span>
            <select name="country" id="country" required></select>
            <input name="eb-selected-country" type="hidden" id="eb-selected-country" value="<?php echo $country; ?>"/>
        </label>

        <label class="form-label">
            <input type="text" name="city" id="city" value="<?php echo esc_attr( $city ); ?>" required/>
            <span><?php _e( 'City', 'eb-textdomain' ); ?> *</span>
        </label>
    </div>

    <h4 class="cabinet__form__password__title">Сменить пароль</h4>

    <div class="form-group cabinet__form__password" style="display: none">
        <label class="form-label">
            <input type="password" name="curr_psw" id="eb_curr_psw" autocomplete="false"/>
            <span><?php esc_html_e( 'Старый пароль', 'woocommerce' ); ?></span>
        </label>

        <label class="form-label">
            <input type="password" name="new_psw" id="eb_new_psw" autocomplete="false"/>
            <span><?php esc_html_e( 'New password', 'woocommerce' ); ?></span>
            <p class="form-label__tip">Не заполняйте, чтобы оставить прежний</p>
        </label>

        <label class="form-label">
            <input type="password" name="confirm_psw" id="eb_confirm_psw" autocomplete="false"/>
            <span><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></span>
        </label>
    </div>

	<?php
	//action hook for plugin and extra fields
	do_action( 'eb_edit_user_profile', $current_user );
	?>

    <button type="submit" class="woocommerce-Button button btn cabinet__form__button" name="save_account_details">
		<?php esc_html_e( 'Save changes', 'woocommerce' ); ?>
    </button>

	<?php wp_nonce_field( 'eb-update-user' ) ?>
    <input name="action" type="hidden" id="action" value="eb-update-user"/>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
