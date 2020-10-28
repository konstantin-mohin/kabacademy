<?php
/**
 * Admin cancelled order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-cancelled-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email );


// Получаем данные пользователя
$first_name = $order->get_billing_first_name();
$last_name = $order->get_billing_last_name();

if (($last_name != '-') && ($last_name))
    $name = $first_name . ' ' . $last_name;
else
    $name = $first_name;


// Получаем данные заказа

$items      = $order->get_items();
$data       = $order->get_data();
$total      = $order->get_total();
$subtotal   = $order->get_subtotal();
$taxsumm    = $subtotal - $total;  
//if ($taxsumm != 0) 
 //   $tax = round($taxsumm / $subtotal * 100, 2);
?>
<table align="center" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;border:0">
    <tbody>
        <tr>
            <td style="padding:60px 8%">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0">
                    <tbody>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"> Приветствуем </td>
                        </tr>
                        <tr>
                            <td style="font-family:Montserrat,sans-serif;font-weight:700;font-size:32px;line-height:130%;letter-spacing:-.05em;padding-bottom:20px;color:#3c5d90">Админ</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"><?php printf( esc_html__( 'Notification to let you know &mdash; order #%1$s belonging to %2$s has been cancelled:', 'woocommerce' ), esc_html( $order->get_order_number() ), esc_html( $order->get_formatted_billing_full_name() ) ); ?></td>
                        </tr>
                        <tr>
                            <td style="padding:35px 0 25px">
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0">
                                    <tbody>
                                        <tr>
                                            <td style="font-family:Montserrat,sans-serif;font-weight:300;font-size:32px;line-height:120%;letter-spacing:-.05em;width:45%"> Заказ #<?php echo $data['id']; ?></td>
                                            <td style="font-family:Montserrat,sans-serif;font-weight:500;font-size:16px;line-height:160%;margin-left:20px;color:#3c5d90;vertical-align:bottom">от <?php echo $data['date_created']->date('d.m.Y'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f9fd;font-family:Montserrat,sans-serif">
                                    <tbody>
                                        <tr>
                                            <th style="padding:30px 13px 0 28px;width:213px;font-weight:600;font-size:10px;line-height:180%;letter-spacing:.35em;text-transform:uppercase;color:#52b0d8;text-align:left"> товар </th>
                                            <th style="padding:30px 13px 0;width:136px;font-weight:600;font-size:10px;line-height:180%;letter-spacing:.35em;text-transform:uppercase;color:#52b0d8;text-align:left"> кол-во </th>
                                            <th style="padding:30px 13px 0;width:140px;font-weight:600;font-size:10px;line-height:180%;letter-spacing:.35em;text-transform:uppercase;color:#52b0d8;text-align:left"> цена </th>
                                        </tr>
                                        <?php 
                                            foreach ($items as $item_id => $item ) { 
                                            $product        = $item->get_data();
                                            $quantity       = $product["quantity"]; 
                                            $product_name   = $product["name"]; 
                                            $product_price  = $product["subtotal"]; 
                                        ?>
                                        <tr>
                                            <td style="padding:15px 13px 15px 28px;width:213px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top">
                                                <b><?php echo $product_name; ?></b>
                                            </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> <?php echo $quantity; ?> шт. </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> 
                                                <b>$ <?php echo $product_price; ?></b> 
                                            </td> 
                                        </tr>
                                        <?php 
                                            } if ($taxsumm) {
                                        ?>
                                        <tr>
                                            <td style="padding:15px 13px 15px 28px;width:213px;font-weight:500;font-size:14px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> Скидка по купону $ <?php echo $taxsumm; ?> </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> 1 шт. </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> <b>- $ <?php echo $taxsumm; ?></b> </td>
                                        </tr>
                                        <?php 
                                            } 
                                        ?>
                                        <tr>
                                            <td style="padding:15px 13px 35px 28px;width:213px;font-weight:500;font-size:14px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> Подитог: </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> <b>$ <?php echo $total?></b> </td>
                                        </tr>
                                    </tbody>
                                </table>
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
