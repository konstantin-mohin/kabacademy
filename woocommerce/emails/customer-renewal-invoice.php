<?php
/**
 * Customer renewal invoice email
 *
 * @author  Brent Shepherd
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

do_action( 'woocommerce_email_header', $email_heading, $email ); 

$first_name = $order->get_billing_first_name();
$last_name = $order->get_billing_last_name();

if (($last_name != '-') && ($last_name))
    $name = $first_name . ' ' . $last_name;
else
    $name = $first_name;


// Получаем данные заказа

$items          = $order->get_items();
$data           = $order->get_data();
$total          = $order->get_total();
$subtotal       = $order->get_subtotal();
$product_date   = $data['date_created']->date('d.m.Y');
$taxsumm        = $subtotal - $total;  

foreach ($items as $item_id => $item ) { 
    $product        = wc_get_product( $item['product_id'] );
    $product_files  = $product->get_downloads();                                                
    if ($product_files) { 
        $downloadable = true;
    } 
}
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
                            <td style="font-family:Montserrat,sans-serif;font-weight:700;font-size:32px;line-height:130%;letter-spacing:-.05em;padding-bottom:20px;color:#3c5d90"><?php echo $name; ?>! </td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90">

                          <?php if ( $order->has_status( 'pending' ) ) : ?>
                            <p>
                              Продлите свою подписку на <?php echo esc_html( get_bloginfo( 'name' ) );  ?>. Чтобы оплатить, воспользуйтесь следующей ссылкой <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>">Оплатить</a>
                            </p>
                          <?php elseif ( $order->has_status( 'failed' ) ) : ?>
                            <p>
                              Автоматический платеж для продления подписки на <?php echo esc_html( get_bloginfo( 'name' ) ); ?> не прошел. Чтобы повторно активировать подписку, войдите в систему и оплатите продление на странице своей учетной записи: <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>">Оплатить</a>
                            </p>
                          <?php endif; ?>

                          <?php if ($downloadable) {  ?>
                        <tr> 
                            <td style="font-family:Montserrat,sans-serif;padding:35px 0 25px;font-weight:300;font-size:32px;line-height:120%;letter-spacing:-.05em"> Загрузки </td>
                        </tr>
                        <tr> 
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f9fd;font-family:Montserrat,sans-serif">
                                    <tbody>
                                        <tr>
                                            <th style="padding:30px 13px 0 28px;width:213px;font-weight:600;font-size:10px;line-height:180%;letter-spacing:.35em;text-transform:uppercase;color:#52b0d8;text-align:left"> товар </th>
                                            <th style="padding:30px 13px 0;width:136px;font-weight:600;font-size:10px;line-height:180%;letter-spacing:.35em;text-transform:uppercase;color:#52b0d8;text-align:left"> истекает </th>
                                            <th style="padding:30px 13px 0;width:140px;font-weight:600;font-size:10px;line-height:180%;letter-spacing:.35em;text-transform:uppercase;color:#52b0d8;text-align:left"> скачать </th>
                                        </tr>
                                        <?php 
                                            foreach ($items as $item_id => $item ) { 
                                            $product        = wc_get_product( $item['product_id'] );
                                            $product_name   = $product->get_name();  
                                            $product_files  = $product->get_downloads();  
                                            $product_expiry = $product->get_download_expiry();
                                            if ($product_expiry != '-1')
                                                $product_expiry = date("d.m.Y", strtotime($product_date . '+ ' . $product_expiry . ' days'));
                                            else 
                                                $product_expiry = 'Никогда';
                                                
                                            foreach ($product_files as $file ) {   
                                        ?>
                                        <tr>
                                            <td style="padding:15px 13px 35px 28px;width:213px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top">
                                                <b><?php echo $product_name; ?></b>
                                            </td>
                                            <td style="padding:15px 13px;width:136px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top"> <?php echo $product_expiry; ?> </td>
                                            <td style="padding:15px 13px;width:140px;font-weight:500;font-size:16px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top">
                                                <a href="<?php echo $file["file"]; ?>" style="color:#a42bb9;font-weight:400;text-decoration:underline"> <?php echo $file["name"]; ?> </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td style="padding:35px 0 25px">
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0">
                                    <tbody>
                                        <tr>
                                            <td style="font-family:Montserrat,sans-serif;font-weight:300;font-size:32px;line-height:120%;letter-spacing:-.05em;width:45%"> Заказ #<?php echo $data['id']; ?></td>
                                            <td style="font-family:Montserrat,sans-serif;font-weight:500;font-size:16px;line-height:160%;margin-left:20px;color:#3c5d90;vertical-align:bottom">от <?php echo $product_date; ?></td>
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
