<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	    <meta name="robots" content="noindex, nofollow">
	    <meta charset="utf-8"> <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <title>Международная академия каббалы</title>
	    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	    <link rel="icon" type="image/x-icon" href="https://kabacademy.com/static/img/content/favicon.png">
    </head>
	<body style="margin:0;padding:0">
		<table align="center" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;border:0">
		    <tbody>
                <tr style="background-image: url( <?php echo get_template_directory_uri() ?>/static/img/assets/letters/bg.png); background-size: cover; height: 150px;">
                    <td style="width:50%;padding-left:8%;padding-right:15px">
                        <a href="https://kabacademy.com/" target="_blank">
                            <img src="<?php echo get_template_directory_uri() ?>/static/img/assets/letters/header-logo.png" alt="" style="display:block;width:100%">
                        </a>
                    </td>
                    <td style="width:50%">
<!--                        <img src="--><?php //echo get_template_directory_uri() ?><!--/static/img/assets/letters/bg.png" alt="" style="display:block;width:100%">-->
                    </td>
                </tr>
            </tbody>
        </table>