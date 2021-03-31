<?php
/**
 * Admin new order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails/HTML
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

$user = get_user_by('id', $user_id);
$user_name = $user->first_name ?? $user_login;

?>
<table align="center" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;border:0">
    <tbody>
        <tr>
            <td style="padding:60px 8%">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0">
                    <tbody>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"> Здравствуйте, </td>
                        </tr>
                        <tr>
                            <td style="font-family:Montserrat,sans-serif;font-weight:700;font-size:32px;line-height:130%;letter-spacing:-.05em;padding-bottom:20px;color:#3c5d90"><?php echo  esc_html( $user_name ); ?>! </td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90">
                                <p><?php printf( esc_html__( 'Someone has requested a new password for the following account on %s:', 'woocommerce' ), esc_html( wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ) ) ); ?></p>
                                <p><?php printf( esc_html__( 'Username: %s', 'woocommerce' ), esc_html( $user_name ) ); ?></p>
                                <p><?php esc_html_e( 'If you didn\'t make this request, just ignore this email. If you\'d like to proceed:', 'woocommerce' ); ?></p>
                                <p>
                                    <a class="link" href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'id' => $user_id ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ); ?>"><?php ?>
                                        <?php esc_html_e( 'Click here to reset your password', 'woocommerce' ); ?>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<?php

do_action( 'woocommerce_email_footer', $email );
