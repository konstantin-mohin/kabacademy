<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); 

// Получаем данные пользователя

$first_name = get_user_meta( $email->object->ID, 'first_name', true );
$last_name = get_user_meta( $email->object->ID, 'last_name', true );

if (($last_name != '-') && ($last_name))
    $name = $first_name . ' ' . $last_name;
else
    $name = $first_name;

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
                            <td style="font-family:Montserrat,sans-serif;font-weight:700;font-size:32px;line-height:130%;letter-spacing:-.05em;padding-bottom:20px;color:#3c5d90"><?php echo $name; ?>!</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"> Спасибо за создание учетной записи на <a href="<?php echo get_site_url();?>" style="color:#a42bb9;text-decoration:underline;font-weight:600"><?php bloginfo( 'name' ); ?></a>. </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0;margin:35px 0;padding:35px 0;border-top:1px dashed #52b0d8;border-bottom:1px dashed #52b0d8">
                                    <tbody>
                                        <tr>
                                            <td style="font-family:'Open Sans',sans-serif;font-weight:300;font-size:13px;line-height:180%;color:#2c2c2c;padding-bottom:10px"> Ваш логин: <b><?php echo $email->user_login; ?></b> </td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:'Open Sans',sans-serif;font-weight:300;font-size:13px;line-height:180%;color:#2c2c2c"> Ваш пароль: <b>введён при регистрации</b> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"> Линк на страницу вашей учетной записи: <a href="<?php echo get_site_url();?>/my-account/" style="color:#a42bb9;text-decoration:underline;font-weight:600"><?php echo $email->user_login; ?></a> </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<?php do_action( 'woocommerce_email_footer', $email );
