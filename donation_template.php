<?php
/*
Template Name: Donation
*/
?>

<?php
global $woocommerce;
$woocommerce->cart->empty_cart();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Внести свой вклад</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />


    <!--		<link rel="stylesheet" href="./style.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/static/css/donation.css  ">

</head>

<body>


<div class="container">
    <a href="/" class="logo"><img src="<?php echo get_template_directory_uri() ?>/static/img/donation/logo.png" alt="logo"></a>

	<?php

	global $post;
    $products = get_field('donation',  $post->ID);
    if ( $products ) {

    foreach ( $products as $item ) {
			$id = $item->ID;
			$title = $item->post_title;
            $content = $item->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
		    $product = wc_get_product( $id );

			?>
            <div class="row donation_raw">
                <div class="col-12">
                    <h3><?php echo $title; ?></h3>
                </div>
                <div class="col-md-7 col-sm-12">
                    <h6>Дорогие друзья!</h6>

					<?php echo $content; ?>

                </div>
                <div class="col-md-5 clip">
                    <div class="embed-responsive embed-responsive-16by9">
						<?php echo  get_field( 'youtube_link',  $id); ?>
                    </div>
					<?php if( $product->is_type( 'variable' ) ) { ?>

						<?php
						$comment_args = array(
							'comment_post_ID' => $id,
						);

						$comments = get_comments( array(
							'post_id' => $id,
							'orderby' => 'comment_date_gmt',
							'status' => 'approve',
						) ); ?>

                        <div class="comments_link">
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5565 11.7914C16.5565 13.2952 15.3339 14.5132 13.8244 14.5132H7.22161L3.74947 18.7659L4.77403 14.5132H4.20483C2.6953 14.5132 1.47266 13.2952 1.47266 11.7914V4.19318C1.47266 2.68942 2.6953 1.47144 4.20483 1.47144H13.8244C15.3339 1.47144 16.5565 2.68942 16.5565 4.19318V11.7914Z" stroke="#3C5D90" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.59 14.4224C21.59 15.6495 21.253 16.7994 20.6656 17.7838L21.7197 20.5668L18.6802 19.8772C17.626 20.5872 16.3556 21 14.9895 21C11.342 21 8.38672 18.0559 8.38672 14.4224C8.38672 10.7889 11.342 7.84485 14.9895 7.84485C18.6369 7.84485 21.59 10.7889 21.59 14.4224Z" stroke="#3C5D90" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a data-fancybox data-src="#comment-modal-<?php echo $id; ?>" data-modal="true" href="javascript:;" class="comment_link"><?php echo count($comments) ?> комментариев </a>
                            </p>
                        </div>

                        <div class="review_popup" id="comment-modal-<?php echo $id; ?>">
                            <div data-fancybox-close class="comment_close">&#x2715</div>

                            <div class="comment_popup_top_block">
                                <h4 class="donation_comment_title"><?php echo $title; ?></h4>
                            </div>

                            <div class="donation_comments">
                                <?php foreach( $comments as $comment ) { ?>
                                     <div class="donation_comment_block">
                                        <div class="comment_meta">
                                            <span class="comment_name"> <?php echo sanitize_title($comment->comment_author); ?> </span> <span class="comment_date"><?php echo date("j F Y", strtotime($comment->comment_date_gmt)); ?></span>
                                        </div>

                                        <div class="comment_content"><?php echo sanitize_title($comment->comment_content); ?></div>
                                     </div>
                                <?php } ?>
                            </div>


                            <div class="comment_form_block">

                                <div class="success_comment_message">Спасибо за ваш комментарий! Он будет опубликован как только пройдет модерацию</div>
                                <form class="review_form" id="<?php echo $id ?>">
                                    <div class="comment_block_fields">
                                        <div class="review_form_input_block">
                                            <input type="text" class="review_name" placeholder="Ваше имя">
                                            <input type="text" class="review_email" placeholder="E-mail">
                                        </div>
                                        <textarea name="comment" class="review_content" cols="40" rows="3" placeholder="Текст комментария"></textarea>
                                    </div>
                                    <input type="submit" class="comment_button review_submit open_comment_form_button" value="оставить свой комментарий">
                                </form>
                                <div class="comment_form_close comment_form_close">&#x2715</div>
                            </div>
                            <button class="comment_button open_comment_form_button">оставить свой комментарий</button>

                        </div>

                        <div class="modal-wrapper">

                            <a class="btn btn-primary modal-button wlmodalgo">внести свой вклад</a>
                            <div class="donation-modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <div class="modal-title wllab">
                                        Внести пожертвование
                                    </div>
                                    <div class="modal-label wllab">
                                        сумма вложения
                                    </div>

                                    <div class="variations_form0" style="text-align: center;"></div>
                                    <form name="checkout" method="post" class="wlcheckoutf checkout woocommerce-checkout" action="https://dev.kabacademy.com/checkout/" enctype="multipart/form-data" novalidate="novalidate" style="position: static;">
                                    </form>
                                    <form action="/checkout" class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="150236">

                                        <input type="hidden" name="add-to-cart" value="150398" />
                                        <input type="hidden" name="product_id" value="150398" />
                                        <input type="hidden" name="variation_id" value="90" />
                                        <input type="hidden" value="15" name="change-product-price">
                                        <input type="hidden" id="hidden_field" name="custom_price" class="custom_price" value="22">
                                        <div class="cart__payments cart-payments wlcart-payments2" id="tabs">
											<?php
											foreach ( $product->get_visible_children() as $variation_id ) {
												$variation = wc_get_product( $variation_id ); ?>

												<?php
												if ( $variation->price === '1' ) { ?>
                                                    <label class="cart-payments__item cart-payment wlcart-payment2" id="tab-<?php echo $variation_id; ?>" >

                                                        <input type="radio" class="cart-payment__input wlcart-payment__input" id="price-<?php echo $variation_id; ?>" name="variation_id" value="<?php echo $variation_id; ?>">

                                                        <div class="cart-payment__card wlcart-payment__card">
<!--                                                            <div class="custom-text" style='margin-top: -12px; margin-bottom: 5px; font-size: 80%; '>другая:</div> -->
                                                            <input type="text" id="price-custom" class="price-custom" name="price-custom" value="" placeholder="другая" >
                                                        </div>

                                                    </label>

													<?php
													continue;
												} ?>

                                                <label class="cart-payments__item cart-payment wlcart-payment2  <?php if ( $variation->price === '5' ) echo 'active'; ?>" id="tab-<?php echo $variation_id; ?>">

                                                    <input type="radio" class="cart-payment__input wlcart-payment__input" id="price-<?php echo $variation_id; ?>" name="variation_id" value="<?php echo $variation_id; ?>"
														<?php if ( $variation->price === '5' ) echo 'checked'; ?>>

                                                    <div class="cart-payment__card wlcart-payment__card">
                                                        <div class="cart-payment__title">$ <?php echo $variation->price ?? ''; ?></div>
                                                    </div>


                                                </label>


											<?php } ?>

                                        </div>



                                        <div class="modal-label wllab" style="text-align: left; margin-bottom: 20px;">
                                            Информация о вкладчике
                                        </div>

                                        <div class="cart__contacts wlcart__contacts">
                                            <label for="billing_first_name_donation-<?php echo $id; ?>" class="form-label">
                                                <input type="" class = 'billing_first_name_donation wlbil' id="billing_first_name_donation-<?php echo $id; ?>" name="billing_first_name" value="">

                                                <!--? if (!$hidePass) {?--><span>Имя</span><!--? }?-->
                                                <!--? if (!$hidePass) :?-->
                                            </label>


                                            <label for="billing_last_name_donation-<?php echo $id; ?>" class="form-label">
                                                <input type="" id="billing_last_name_donation-<?php echo $id; ?>" class='billing_last_name_donation wlbil' name="billing_last_name" value="">
                                                <span>Фамилия</span>
                                            </label>


                                            <label for="billing_phone_donation-<?php echo $id; ?>" class="form-label">
                                                <input type="tel" id="billing_phone_donation-<?php echo $id; ?>" class = 'billing_phone_donation wlbil' name="billing_phone" value="">
                                                <span>Телефон</span>
                                            </label>


                                            <label for="billing_email_donation-<?php echo $id; ?>" class="form-label">
                                                <input type="email" id="billing_email_donation-<?php echo $id; ?>" class = 'billing_email_donation wlbil' name="billing_email" value="">
                                                <span>Email</span>
                                            </label>


                                            <label for="billing_country-<?php echo $id; ?>" class="form-label">
                                                <input type="email" id="billing_country-<?php echo $id; ?>" name="billing_country billing_country" value="">
                                                <span>Страна</span>
                                            </label>
                                        </div>

                                        <div class="modal-label wllab" style="text-align: left;">
                                            Способ оплаты
                                        </div>


                                        <div class="cart__payments cart-payments wlcart-payments">
                                            <label class="cart-payments__item cart-payment wlcart-payment">
                                                <input id="payment_method_pelecard2" type="radio" name="payment_method" class="cart-payment__input wlcart-payment__input" value="pelecard" checked="checked" data-order_button_text="перейти к оплате">
                                                <div class="cart-payment__card wlcart-payment__card">
                                                    <div class="cart-payment__title">Кредитная карта</div>
                                                </div>

                                            </label>

                                            <label class="cart-payments__item cart-payment wlcart-payment">
                                                <input id="payment_method_paypal2" type="radio" name="payment_method" class="cart-payment__input wlcart-payment__input" value="paypal" data-order_button_text="Дальше на PayPal">
                                                <div class="cart-payment__card wlcart-payment__card">
                                                    <div class="cart-payment__title">Система PayPal</div>
                                                </div>

                                            </label>



                                            <div class="wlbutton-wrapper">
                                                <div class="btn btn-small button add-to form wlsubmit" style= 'margin-top: 10px;'>Отправить пожертвование</div>
                                                <div class="wlwarninglab"><span>!</span>Не заполнены обязательные поля</div>
                                            </div>


                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
					<?php } ?>
                </div>
                <div class="col-7 progress-block">

                    Текущий взнос: <strong><?php echo do_shortcode('[wcj_product_total_orders_sum hide_currency="yes" product_id="' . $id . '"]') . ' / ' .  do_shortcode('[wcj_product_crowdfunding_goal hide_currency="yes" product_id="' . $id . '"]') ?> USD</strong>
                    <div class="custom_progress_bar">
						<?php echo do_shortcode('[wcj_product_crowdfunding_goal_remaining_progress_bar product_id="' . $id . '"]'); ?>
                    </div>
                </div>
            </div>

			<?php
		}
	}
	wp_reset_postdata();
	?>



    <div class="row">
        <div class="col-md-7">
            <div class="info">
                Ваша поддержка - это конкретное действие, направленное на отдачу. Такие действия каббалисты называют “добрыми
                делами”, с помощью которых все мы продвигаемся в духовном развитии.
                <span>Благодарим вас за поддержку!</span>
            </div>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">

        </div>
    </div>
</div>
<div class='wloverlay'></div>
<div class="wltempform" style='display: none;'></div>
<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>
</html>

<script>

    jQuery( document ).on( 'click', '.modal-button',  function( e ) {
        jQuery(this).parents('.modal-wrapper').find('.donation-modal').show();

        jQuery(this).parents('.modal-wrapper').find('.donation-modal').find('.price-wrapper').removeClass('active');
        jQuery(this).parents('.modal-wrapper').find('.donation-modal').find('.variation-price').prop("checked", false);


        jQuery(this).parents('.modal-wrapper').find('.donation-modal').find('.price-wrapper:first-child').addClass('active');
        jQuery(this).parents('.modal-wrapper').find('.donation-modal').find('.price-wrapper:first-child').find('.variation-price').prop("checked", true);


        function sayHi() {
            jQuery(this).parents('.modal-wrapper').find('.donation-modal').find('.price-wrapper').trigger('click');
        }

        setTimeout(sayHi, 1000);
    });


    jQuery( document ).on( 'click', '.close',  function( e ) {
        jQuery('.donation-modal').hide();
    });

    jQuery( document ).on( 'click', '.price-wrapper',  function( e ) {
        jQuery('.price-wrapper').removeClass('active');
        jQuery(this).addClass('active');
    });

    jQuery( document ).on( 'selectstart', '.variation-price-text p',  function( e ) {
        e.preventDefault();
    });

    jQuery( document ).on( 'click', '.price-custom',  function( e ) {
        jQuery(this).parents('.price-wrapper').find('.variation-price').prop("checked", true);
    });

    jQuery( document ).on( 'keyup', '.price-custom',  function( e ) {
        this.value = this.value.replace(/\D/g,'');
    });

</script>




