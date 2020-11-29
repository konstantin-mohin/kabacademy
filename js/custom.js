jQuery(function ($) {

		var wc_custom_checkout_coupons = {
			init: function () {
				$('.cart-promo__form').on('click', 'button.cart-promo__btn-remove', this.remove_coupon);
				$('.cart-promo__form').on('click', 'button.cart-promo__btn-apply', this.submit);

				$(document.body).on('my_custom_event', this.updateFragments);

				$('button.cart-promo__btn-remove').hide();
			},
			submit: function (evt) {
				evt.preventDefault();

				var $form = $(this).parent();

				$(document.body).trigger('wc_fragment_refresh');

				if ($form.is('.processing')) {
					return false;
				}

				$form.addClass('processing');

				var data = {
					security: wc_checkout_params.apply_coupon_nonce,
					coupon_code: $form.find('input[name="coupon_code"]').val()
				};

				$.ajax({
					type: 'POST',
					url: wc_checkout_params.wc_ajax_url.toString().replace('%%endpoint%%', 'apply_coupon'),
					data: data,
					dataType: 'html',
					success: function (code) {

						$('.woocommerce-error, .woocommerce-message').remove();
						$form.removeClass('processing');

						if (code) {
							$('.cart-promo__text').html(code);

							$(document.body).trigger('applied_coupon', [data.coupon_code]);
							$(document.body).trigger('applied_coupon_in_checkout', [data.coupon_code]);
							$(document.body).trigger('update_checkout', {update_shipping_method: false});

							$('button.cart-promo__btn-remove').show();
						}

					},
					complete: function () {
						wc_custom_checkout_coupons.update_cart(true);
					}

				});

				return false;
			},
			remove_coupon: function (evt) {
				evt.preventDefault();

				var $form = $(this).parent(),
					coupon = $form.find('input[name="coupon_code"]').val()
				;

				var data = {
					security: wc_checkout_params.remove_coupon_nonce,
					coupon: coupon
				};

				$.ajax({
					type: 'POST',
					url: wc_checkout_params.wc_ajax_url.toString().replace('%%endpoint%%', 'remove_coupon'),
					data: data,
					success: function (code) {
						$('.woocommerce-error, .woocommerce-message').remove();

						if (code) {
							$('.cart-promo__text').html(code);
							$(document.body).trigger('update_checkout', {update_shipping_method: false});
						}
					},
					error: function (jqXHR) {
						if (wc_checkout_params.debug_mode) {
							/* jshint devel: true */
							console.log(jqXHR.responseText);
						}
					},
					complete: function () {
						$form.find('input[name="coupon_code"]').val('');
						wc_custom_checkout_coupons.update_cart(true);
					},
					dataType: 'html'
				});
			},
			update_cart: function (preserve_notices) {
				var $form = $('.woocommerce-checkout');
				// Make call to actual form post URL.
				//<?php echo esc_url( wc_get_cart_url() ); ?>
				$.ajax({
					type: $form.attr('method'),
					url: $form.attr('action'),
					data: $form.serialize(),
					dataType: 'html',
					success: function (response) {
						wc_custom_checkout_coupons.update_wc_div(response, preserve_notices);
					}
				});
			},
			update_wc_div: function (html_str, preserve_notices) {
				var $html = $.parseHTML(html_str);
				var $new_form = $('.cart-checkout', $html);

				// var $notices = $('.woocommerce-error, .woocommerce-message, .woocommerce-info', $html);


				// No form, cannot do this.
				if ($('.woocommerce-checkout').length === 0) {
					window.location.reload();
					return;
				}

				// Remove errors
				if (!preserve_notices) {
					$('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
				}

				if ($new_form.length === 0) {

					// No items to display now! Replace all cart content.
					// var $cart_html = $('.cart-empty', $html).closest('.woocommerce');
					// $('.cart-checkout').closest('.woocommerce').replaceWith($cart_html);

					// Display errors
					// if ($notices.length > 0) {
					// 	show_notice($notices);
					// }

					// Notify plugins that the cart was emptied.
					// $(document.body).trigger('wc_cart_emptied');
				} else {
					// If the checkout is also displayed on this page, trigger update event.
					// if ($('.woocommerce-checkout').length) {
					// 	$(document.body).trigger('update_checkout');
					// }

					$(document.body).trigger('update_checkout');
					$('.cart-checkout').replaceWith($new_form);

					// if ($notices.length > 0) {
					// 	// show_notice($notices);
					// }
				}
			}
		};

		wc_custom_checkout_coupons.init();

	}
);

// Popup notification
$(document).ready(function () {
	if ($('#hidden-content').length) {


		let interval = setInterval(function () {
			if (!getCookie('user_details_fill')) {
				console.info('Gog');
				var instance = $.fancybox.open({
					src: '#hidden-content',
					type: 'inline',
					opts: {
						afterShow: function (instance, current) {
							console.info('Set cookie');
							setCookie('user_details_fill', 'timeout', {secure: true, 'max-age': 60});
						}
					}
				});
			}

		}, 2000);
	}
});

/*
$(".training__studies__button").on('click', function (e) {
  var button = $(e.currentTarget);
  button.addClass('is-active');
  button.one('animationend', function () {
    $(this).removeClass('is-active');
  });
  var nextItem = $(".training__studies__content:visible").next(".training__studies__content");

  if (nextItem.length == 0) {
    nextItem = $(".training__studies__content:first");
  }

  $(".training__studies__content").hide();
  nextItem.show().css({
    "display": "flex"
  });
});*/


//

$("#commentform").on('submit', function (e) {
	if ($("#comment").val() == '') {
		$("#comment").addClass('comment--error');
		return false;
	}
});


// Cookie
function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

	options = {
		path: '/',
		...options
	};

	if (options.expires instanceof Date) {
		options.expires = options.expires.toUTCString();
	}

	let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

	for (let optionKey in options) {
		updatedCookie += "; " + optionKey;
		let optionValue = options[optionKey];
		if (optionValue !== true) {
			updatedCookie += "=" + optionValue;
		}
	}

	document.cookie = updatedCookie;
}

// passwords in edit-account
$(document).ready(function () {
	$('.cabinet__form__password__title').on('click', function (evt) {
		$('.cabinet__form__password').slideToggle();
	});

	$('#account_password').on('keyup', function (evt) {

		if (evt.target.value.length < 8) {
			$("#place_order").addClass('disabled-btn');
			if(!$(".more-pass").length){
				$("#account_password").after( "<p class='more-pass'>Пароль должен содержать не менее 10 символов</p>" );
			}
		} else {
			$("#place_order").removeClass('disabled-btn');
			if($(".more-pass").length){
				$(".more-pass").remove();
			}
		}

	});

	$('#eb_new_psw').on('keyup', function (evt) {

		if (evt.target.value.length < 8) {
			$(".cabinet__form__button").addClass('disabled-btn');
			if(!$(".more-pass").length){
				$("#eb_new_psw").after( "<p class='more-pass'>Пароль должен содержать не менее 8 символов</p>" );
			}
		} else {
			$(".cabinet__form__button").removeClass('disabled-btn');
			if($(".more-pass").length){
				$(".more-pass").remove();
			}
		}

	});


	// let resetForm = $('.woocommerce-ResetPassword .form-group');
	//
	// resetForm.each(function() {
	//
	// 	if ($( this ).length < 10) {
	// 		$(".woocommerce-Button").addClass('disabled-btn');
	// 	} else {
	// 		$(".woocommerce-Button").removeClass('disabled-btn');
	// 	}
	//
	// });

});

$(document).ready(function () {

	if ($('#country')) {
		$('#country').select2({
			width: '100%',
		});
	}

	$('.bbp-reply-to-link').on('click', function (e) {
		e.preventDefault();
		var comment = $(this).parents(".forum-comment");
		var block = $(this).parents(".forum-comment__main");
		var answer = block.find(".forum-answer");


		$('.forum-comment__main').children().show();

		var name = comment.find(".forum-comment-author__name").text();
		$(".forum-answer__target").text(name);
		block.children().hide();
		answer.show();

		console.log(name);

		$('.forum-answer__header').show();
		$('#bbp_topic_subscription').removeAttr('checked');
		//$('#bbp_reply_to').val(cclick);
		return false;
	});

	$('.forum-comment__btn').on('click', function () {
		var block = $(this).parents(".forum-comment__main");
		block.find('.bbp-reply-to-link').trigger('click');
	});

	$('.cart-step__two-error .close').on('click', function () {
		url = window.location.origin;
		$('.cart-step__two-error').fadeOut();
		window.location.href = url + "/cart";
	});

});


document.addEventListener('DOMContentLoaded', function () {

	const errorBlock = document.querySelector('.woocommerce-error');
	const errorsItems = document.querySelectorAll('.woocommerce-error li');

	// const loginErrorsBlock = document.querySelector('.login-errors');
	const loginErrors = document.querySelectorAll('.login-errors li');

	const iscart = document.querySelector(".cart-step__two-error");

	if (errorBlock) {

		if (iscart) {
			iscart.style.display = "block";
		} else {
			const Toast = Swal.mixin({
				showCloseButton: true,
				backdrop: false,
				showConfirmButton: true,
				timer: 7000,
				timerProgressBar: true,
				onOpen: (toast) => {
					// toast.addEventListener('mouseenter', Swal.stopTimer)
					// toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			});

			if (errorsItems) {
				errorsItems.forEach(function (item, index) {
					Toast.fire({
						icon: 'info',
						html: item.innerHTML
					});
				});
			}

			// if (loginErrors) {
			// 	loginErrors.forEach(function (item, index) {
			// 		Toast.fire({
			// 			icon: 'error',
			// 			html: item.innerHTML
			// 		});
			// 	});
			// }
		}

	}

})