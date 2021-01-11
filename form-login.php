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

<?php /*
// check if registration enabled
$general_settings    = get_option( 'eb_general' );
$enable_registration = getArrValue( $general_settings, "eb_enable_registration", "" );

if ( $enable_registration == 'yes' ) {
	$fname = getArrValue( $_POST, 'firstname', "" );
	$lname = getArrValue( $_POST, 'lastname', "" );
	$email = getArrValue( $_POST, 'email', "" );
	?>

    <div class="modal__form__title"><?php esc_html_e( 'Register', 'woocommerce' ); ?></div>

    <form method="post" class="modal__form">
		<?php do_action( 'eb_register_form_start' ); ?>

        <div class="form-group">
            <label class="form-label">
                <input type="text" name="firstname" id="reg_firstname" value="<?php echo esc_attr( $fname ); ?>"
                       required/> <span><?php _e( 'First Name', 'eb-textdomain' ); ?></span>
            </label>

            <label class="form-label">
                <input type="text" name="lastname" id="reg_lastname" value="<?php echo esc_attr( $lname ); ?>"
                       required/> <span><?php _e( 'Last Name', 'eb-textdomain' ); ?></span>
            </label>
        </div>

        <div class="form-group">
            <label class="form-label">
                <input type="email" name="email" id="reg_email" value="<?php echo esc_attr( $email ); ?>" required/>
                <span><?php _e( 'Email', 'eb-textdomain' ); ?></span>
            </label>
        </div>


		<?php
		if ( isset( $general_settings['eb_enable_terms_and_cond'] ) && $general_settings['eb_enable_terms_and_cond'] == "yes" && isset( $general_settings['eb_terms_and_cond'] ) ) {
			?>

            <p class="form-row form-row-wide">
                <input type="checkbox" class="input-text" name="reg_terms_and_cond" id="reg_terms_and_cond" required/>
				<?php _e( "I agree to the ", "eb-textdomain" ); ?>
                <span style="cursor: pointer;" id="eb_terms_cond_check"> <u><?php _e( "Terms and Conditions",
							"eb-textdomain" ); ?></u></span>
            </p>

            <div class="eb-user-account-terms">
                <div id="eb-user-account-terms-content" title="<?php _e( "Terms and Conditions", "eb-textdomain" ) ?>">
					<?=
					$general_settings['eb_terms_and_cond'];
					?>
                </div>
            </div>

			<?php
		}
		?>

		<?php do_action( 'eb_register_form' ); ?>

		<?php wp_nonce_field( 'eb-register' ); ?>

        <input type="submit" class="btn modal__form__button" name="register"
               value="<?php esc_html_e( 'Register', 'woocommerce' ); ?>"/>

		<?php do_action( 'eb_register_form_end' ); ?>
    </form>
<?php } */ ?>