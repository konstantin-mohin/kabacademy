<?php
/*
Template Name: Crowdfunding
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

    <!--		<link rel="stylesheet" href="./style.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/static/css/donation.css  ">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
</head>
<body>


<div class="container">
    <a href="/" class="logo"><img src="<?php echo get_template_directory_uri() ?>/static/img/donation/logo.png" alt="logo"></a>

	<?php
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => 'crowdfunding',
			),
		),
	);
	$the_query = new WP_Query($args);

	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			global $product;

//			WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );

			$id = $product->get_id(); ?>


            <div class="row">
                <div class="col-12">
                    <h3><?php echo the_title(); ?></h3>
                </div>
                <div class="col-md-7 col-sm-12">
                    <h6>Дорогие друзья!</h6>

					<?php echo the_content(); ?>

                </div>
                <div class="col-md-5 clip">
                    <div class="embed-responsive embed-responsive-16by9">
						<?php echo  get_field( 'youtube_link',  $id); ?>
                    </div>
					<?php if( $product->is_type( 'variable' ) ) { ?>
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
                                        <div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout wlww" style='display: none;'>
                                            <ul class="woocommerce-error" role="alert">
                                                <li style='display: none;'>
                                                    Неверный адрес эл. почты для выставления счета</li>
                                            </ul>

                                        </div>
                                        <div class="wlalert" style='display: none;'>
                                            Заказ обрабатывается....пожалуйста, подождите несколько секунд...

                                        </div>


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
                                                            <div class="custom-text" style='margin-top: -12px; margin-bottom: 5px; font-size: 80%; '>другая:</div> <input type="text" id="price-custom" class="price-custom" name="price-custom" value="" >
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
                                            <label for="billing_first_name_donation" class="form-label">
                                                <input type="" id="billing_first_name_donation" class = 'wlbil' name="billing_first_name" value="">

                                                <!--? if (!$hidePass) {?--><span>Имя</span><!--? }?-->
                                                <!--? if (!$hidePass) :?-->
                                            </label>


                                            <label for="billing_last_name_donation" class="form-label">
                                                <input type="" id="billing_last_name_donation" class = 'wlbil' name="billing_last_name" value="">
                                                <span>Фамилия</span>
                                            </label>


                                            <label for="billing_phone_donation" class="form-label">
                                                <input type="tel" id="billing_phone_donation" class = 'wlbil' name="billing_phone" value="">
                                                <span>Телефон</span>
                                            </label>


                                            <label for="billing_email_donation" class="form-label">
                                                <input type="email" id="billing_email_donation" class = 'wlbil' name="billing_email" value="">
                                                <span>Email</span>
                                            </label>


                                            <label for="billing_country" class="form-label">
                                                <input type="email" id="billing_country" name="billing_country" value="">
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



                                    <script>
                                        jQuery(function() {
                                            var input = jQuery('.form-label').find('input');
                                            input.each(function () {
                                                jQuery(this).toggleClass('is-filled', jQuery(this).val().length > 0);
                                            });
                                            input.on('blur', function (e) {
                                                jQuery(e.currentTarget).toggleClass('is-filled', jQuery(this).val().length > 0);
                                            });
                                        });
                                    </script>



                                </div>
                            </div>
                        </div>
					<?php } ?>
                </div>
                <div class="col-7 progress-block">

                    Текущий взнос: <strong><?php echo do_shortcode('[wcj_product_total_orders_sum hide_currency="yes"]') . ' / ' .  do_shortcode('[wcj_product_crowdfunding_goal hide_currency="yes"]') ?> USD</strong>
                    <div class="custom_progress_bar">
						<?php echo do_shortcode('[wcj_product_crowdfunding_goal_remaining_progress_bar]'); ?>
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

<script src="/wp-content/themes/kabacedemy/js/crowdfunding.js"></script>

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


    jQuery( document ).on( 'click', '.add-to',  function( e ) {
        $product_id = jQuery(this).parents('.variations_form').find("input[name=product_id]").val();
        let price =  jQuery(this).parents('.variations_form').find(".price-custom").val();

        Cookies.set($product_id, price);
    });




</script>




