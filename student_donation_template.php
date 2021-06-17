<?php
/*
Template Name: Student Donation
*/
?>

<?php
global $woocommerce;
$woocommerce->cart->empty_cart();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>


<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/static/css/student-donation.css  ">
<div class="container">
    <!--    <a href="/" class="logo"><img src="--><?php //echo get_template_directory_uri() ?><!--/static/img/donation/logo.png" alt="logo"></a>-->

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
            <div class="row donation_main_content_block">
                <div class="col-12">
                    <h3 class="donation_product_title"><?php echo $title; ?></h3>
                </div>
                <div class="donation_content_block">
                    <h6>Дорогие друзья!</h6>

					<?php echo $content; ?>
                    <a class="d-btn btn-primary modal-button wlmodalgo">оказать помощь</a>
                    <a data-fancybox data-src="#get_help_modal-<?php echo $id; ?>" data-modal="true" href="javascript:;" class="d-btn btn-primary ask_donation">попросить помощь</a>
                    <div class="review_popup" id="get_help_modal-<?php echo $id; ?>">
                        <div data-fancybox-close class="comment_close">&#x2715</div>
                        <form action="" class="ask_donation_form">
                            <div class="ask_donation_input">
    <!--                                <label for="first_name_donation---><?php //echo $id; ?><!--" class="">-->
                                        <input type="" id="first_name_donation-<?php echo $id; ?>" class = 'first_name_donation wlbil' name="first_name" value="" placeholder="Имя">
    <!--                                    <span>Имя</span>-->
    <!--                                </label>-->

    <!--                                <label for="email_donation---><?php //echo $id; ?><!--" class="">-->
                                        <input type="email" id="email_donation-<?php echo $id; ?>" class = 'billing_email_donation wlbil' name="email" value="" placeholder="Email">
    <!--                                    <span>Email</span>-->
    <!--                                </label>-->
                            </div>

                            <div class="ask_donation_textarea">

                                <!--                                    <label for="content_donation---><?php //echo $id; ?><!--" class="form-label">-->
                                <textarea name="" id="content_donation-<?php echo $id; ?>" cols="30" rows="10" class ='content_donation wlbil' placeholder="Сообщения"></textarea>
                                <!--                                        <span>Текст</span>-->
                                <!--                                    </label>-->
                            </div>

                            <button class="ask_donation_button d-btn">Отправить</button>
                        </form>
                    </div>
                </div>
				<?php if( $product->is_type( 'variable' ) ) { ?>
                    <div class="modal-wrapper">
                        <div class="donation-modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="modal-title wllab">
                                    Внести свой вклад
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

									<?php
									if ( is_user_logged_in() ) {
										$email = wp_get_current_user()->user_email;
										$phone = get_user_meta(wp_get_current_user()->ID, 'billing_phone');
										$city = get_user_meta(wp_get_current_user()->ID, 'billing_city');
										$first_name = get_user_meta(wp_get_current_user()->ID, 'first_name');
										$last_name = get_user_meta(wp_get_current_user()->ID, 'last_name');
									}

									?>

                                    <div class="cart__contacts wlcart__contacts">
                                        <label for="billing_first_name_donation-<?php echo $id; ?>" class="form-label">
                                            <input type="" class = 'billing_first_name_donation wlbil first_name_donation' id="billing_first_name_donation-<?php echo $id; ?>" name="billing_first_name" value="<?php echo $first_name[0] ?? '' ?>">
                                            <span>Имя</span>
                                        </label>


                                        <label for="billing_last_name_donation-<?php echo $id; ?>" class="form-label">
                                            <input type="" id="billing_last_name_donation-<?php echo $id; ?>" class='billing_last_name_donation wlbil' name="billing_last_name" value="<?php echo $last_name[0] ?? '' ?>">
                                            <span>Фамилия</span>
                                        </label>


                                        <label for="billing_phone_donation-<?php echo $id; ?>" class="form-label">
                                            <input type="tel" id="billing_phone_donation-<?php echo $id; ?>" class = 'billing_phone_donation wlbil' name="billing_phone" value="<?php echo $phone[0] ?? '' ?>">
                                            <span>Телефон</span>
                                        </label>


                                        <label for="billing_email_donation-<?php echo $id; ?>" class="form-label">
                                            <input type="email" id="billing_email_donation-<?php echo $id; ?>" class = 'billing_email_donation wlbil' name="billing_email" value="<?php echo $email ?? '' ?>">
                                            <span>Email</span>
                                        </label>


                                        <label for="billing_country-<?php echo $id; ?>" class="form-label">
                                            <input type="text" id="billing_country-<?php echo $id; ?>" class="billing_country_donation wlbil" name="billing_country billing_country" value="<?php echo $city[0] ?? '' ?>">
                                            <span>Страна</span>
                                        </label>
                                    </div>

                                    <div class="modal-label wllab" style="text-align: left;">
                                        Способ платежа
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
                                            <div class="d-btn btn-small button add-to form wlsubmit" style= 'margin-top: 10px;'>Отправить</div>
                                            <div class="wlwarninglab"><span>!</span>Не заполнены обязательные поля</div>
                                        </div>


                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
				<?php } ?>

            </div>

			<?php
		}
	}
	wp_reset_postdata();
	?>




</div>
<div class='wloverlay'></div>
<div class="wltempform" style='display: none;'></div>



<script>

    jQuery( document ).on( 'click', '.modal-button',  function( e ) {
        jQuery(this).parents('.donation_main_content_block').find('.donation-modal').show();

        jQuery(this).parents('.donation_main_content_block').find('.donation-modal').find('.price-wrapper').removeClass('active');
        jQuery(this).parents('.donation_main_content_block').find('.donation-modal').find('.variation-price').prop("checked", false);


        jQuery(this).parents('.donation_main_content_block').find('.donation-modal').find('.price-wrapper:first-child').addClass('active');
        jQuery(this).parents('.donation_main_content_block').find('.donation-modal').find('.price-wrapper:first-child').find('.variation-price').prop("checked", true);

        jQuery('.wlbil').focus(); // need because of placeholder not working with default value
        jQuery('.first_name_donation').focus();

        function sayHi() {
            jQuery(this).parents('.donation_main_content_block').find('.donation-modal').find('.price-wrapper').trigger('click');
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

<?php get_footer(); ?>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />


