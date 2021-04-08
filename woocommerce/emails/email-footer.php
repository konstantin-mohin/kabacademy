<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
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


?>
<table align="center" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;border:0;background:linear-gradient(180deg,#f2f9fd 0,#fff 100%)">
    <tbody>
        <!--tr>
            <td style="padding:50px 8%;font-family:'Open Sans',sans-serif;font-weight:300;font-size:13px;line-height:180%;color:#2c2c2c"> 
            
            Вы получили это письмо, потому что являетесь участником МАК клуба. Если вы не желаете получать наши письма на эту почту вы можете <a href="<?php echo get_site_url();?>/my-account/edit-account/" style="color:#a42bb9;text-decoration:underline;font-weight:400">изменить её</a> в личном кабинете</td>
        </tr-->
        <tr>
            <td style="padding-top:50px">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0">
                    <tbody>
                        <tr>
                            <td style="width:50%;padding:0 8%">
                                <a href="<?php echo get_site_url(); ?>" target="_blank">
                                    <img src="<?php echo get_template_directory_uri() ?>/static/img/assets/letters/header-logo.png" alt="" style="display:block;width:100%;max-width:155px">
                                </a>
                            </td>
                            <td style="width:50%;padding-right:8%">
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-spacing:0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="<?php echo get_field('youtube_link', 'option'); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri() ?>/static/img/assets/letters/icon-youtube.png" alt="" style="display:block;width:100%;margin:0 auto;max-width:30px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo get_field('vk_link', 'option'); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri() ?>/static/img/assets/letters/icon-vk.png" alt="" style="display:block;width:100%;margin:0 auto;max-width:37px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo get_field('fb_link', 'option'); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri() ?>/static/img/assets/letters/icon-facebook.png" alt="" style="display:block;width:100%;margin:0 auto;max-width:27px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo get_field('whatsapp_link', 'option'); ?>" target="_blank">
                                                    <img src="<?php echo get_template_directory_uri() ?>/static/img/assets/letters/icon-whatsapp.png" alt="" style="display:block;width:100%;margin:0 auto;max-width:28px">
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:50px 8%;font-family:'Open Sans',sans-serif;font-weight:300;font-size:13px;line-height:180%;color:#2c2c2c"> Copyright ©&nbsp;1996-<?php echo date('Y'); ?>. <a href="<?php echo get_site_url(); ?>" style="color:#a42bb9;text-decoration:underline"><?php bloginfo('description'); ?></a>
            </td>
        </tr> 
    </tbody>
</table>