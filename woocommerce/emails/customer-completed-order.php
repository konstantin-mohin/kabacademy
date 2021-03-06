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

// Получаем данные пользователя
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
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"> Здравствуйте,</td>
                        </tr>
                        <tr>
                            <td style="font-family:Montserrat,sans-serif;font-weight:700;font-size:32px;line-height:130%;letter-spacing:-.05em;padding-bottom:20px;color:#3c5d90"><?php echo $name; ?>!</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',sans-serif;font-size:14px;line-height:200%;color:#3c5d90"> Мы завершили обработку вашего заказа: </td>
                        </tr>
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

                                        <tr>
                                            <?php
//                                            TODO: add translatable string and dynamic url
                                            $course_url = false;
                                            if ( get_post_meta( $product['product_id'], 'is_product_a_moodle_course', true ) === 'yes' ) {
                                                $product_options = get_post_meta($product['product_id'], 'product_options', true);

                                                if ( $product_options ) {
													$mdl_course_id = $product_options[ 'moodle_course_id' ];
													$course_url = 'https://edu.kabacademy.com/course/view.php?id=' . $mdl_course_id;
                                                }
                                            }
											if ( $course_url ) { ?>
                                                <td style="padding:15px 13px 35px 28px;font-weight:500;font-size:14px;line-height:140%;color:#3c5d90;text-align:left;vertical-align:top">
                                                    <?php echo 'Курс доступен из личного кабинета или по ссылке: <a target="_blunk" href="' . esc_url($course_url) . '">' .  esc_url($course_url) . '</a>';  ?>
                                                </td>
                                           <?php } ?>
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

//ob_start();
//var_dump(\app\wisdmlabs\edwiserBridge\wdm_eb_user_account_url());
//$result = ob_get_clean();

//echo $result;

do_action( 'woocommerce_email_footer', $email );
