jQuery(function() {
	// Switch to work with custom price 
	jQuery(".wlcart-payment2").on("click", function(){
		jQuery("input[name=add-to-cart]").val(jQuery(this).find('input').val());
		jQuery("input[name=product_id]").val(jQuery(this).find('input').val());
		jQuery("#price-custom").val('');
	});

	// Adding a border to a block with a custom price
	jQuery("#price-custom").on("click", function(){
		jQuery(this).parent().trigger("click");
	});

	// Checking fields for emptiness when unpressing a key
	$('.billing_first_name_donation').keyup(function() {
		if ($(this).val() === '') $(this).addClass('wlred');
		else $(this).removeClass('wlred');
	});

	$('.billing_last_name_donation').keyup(function(){
		if ($(this).val() === '') $(this).addClass('wlred');
		else $(this).removeClass('wlred');
	});

	$('.billing_phone_donation').keyup(function(){
		if ($(this).val() === '') $(this).addClass('wlred');
		else $(this).removeClass('wlred');
	});

	$('.billing_email_donation').keyup(function(){
		if ($(this).val() === '') $(this).addClass('wlred');
		else $(this).removeClass('wlred');
	});

	/* 
		Checking the correctness of filling in the phone field in real time.
		phoneRegExp - Regular expression,
		Any letters are removed immediately
	*/

	var phoneRegExp = new RegExp(/^(?=.*[0-9])[+0-9]+$/);

	jQuery('.billing_phone_donation').keyup(function() {
		var val = jQuery(this).val();
		if ( !phoneRegExp.test( val ) ) {
			jQuery(this).val( val.replace(/([^+0-9]+)/gi, '') );
		}
	});


	//Check e-mail for correct filling
	//emailReg - Regular expression
	function validateEmail(email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( email ) ) {
			return false;
		} else {
			return true;
		}
	}


	//Calling the basket through ajax and sending
	function wlcheckout(first_name, last_name, phone, email) {

		jQuery('.wloverlay').show();
		jQuery.ajax({
			url: '/?wc-ajax=checkout',
			method: 'post',
			dataType: 'html',
			data: jQuery('.variations_form').serialize(),
			success: function(data){

				//Avoids unnecessary scrolling
				data = data.replace("main.css","main1.css");
				jQuery('.wltempform').html(data);

				// Filling in the cart fields
				jQuery('.wltempform #billing_first_name').val(first_name.val());
				jQuery('.wltempform #billing_last_name').val(last_name.val());
				jQuery('.wltempform #billing_phone').val(phone.val());
				jQuery('.wltempform #billing_email').val(email.val());

				jQuery(".wltempform #cart-agree").prop('checked', true);

				// Filling in the payment field
				if(document.getElementById('payment_method_paypal2').checked) {
					jQuery(".wltempform #payment_method_paypal").prop('checked', true);
				}else if(document.getElementById('payment_method_pelecard2').checked) {
					jQuery(".wltempform #payment_method_pelecard").prop('checked', true);
				}

				// sending basket
				jQuery(function() {
					jQuery('#place_order').trigger("click");
				});


			}
		});

	}


	// Clearing a full form when opening a modal form 

	jQuery(".wlmodalgo").on("click", function(e){
		jQuery(".variations_form")[0].reset();
		jQuery('.wltempform').empty();
		jQuery('.wlcart__contacts input').removeClass('is-filled');
		jQuery('.wlcart-payments2 label:eq(0)').trigger("click");
		jQuery('#hidden_field').val("");

	});


	// Validating and submitting a form for payment
	jQuery(".wlsubmit").on("click", function(e) {
		//Hiding fields if the form was open, then closed again and reopened 
		window.onbeforeunload = null;
		e.preventDefault();
		$(window).off('beforeunload');
		$('.woocommerce-NoticeGroup li').hide();
		$("input[name=custom_price]").val(jQuery("#price-custom").val());

		let first_name = $(this).parents('.variations_form').find('.billing_first_name_donation');
		let last_name = $(this).parents('.variations_form').find('.billing_last_name_donation');
		let phone = $(this).parents('.variations_form').find('.billing_phone_donation');
		let email = $(this).parents('.variations_form').find('.billing_email_donation');


		//To avoid unnecessary scrolling 
		// jQuery('body').addClass('bodypadding');
		// jQuery('body').addClass('wlfixed');
		$('h3').addClass('wlh3');
		$('.container').addClass('wlcontainer');
		$('h6').addClass('wlh6');

		/*
            Checking fields for emptiness,
            if the field is not filled, then it is outlined with a red border
        */


		if ( first_name.val() === '' ) {
			first_name.addClass('wlred');
			// $('.wlwarninglab').css('display', 'block');
			return false;
		} else {
			first_name.removeClass('wlred');
			$('.wlwarninglab').css('display', 'none');
		}

		if ( last_name.val() === '' ) {
			last_name.addClass('wlred');
			return false;
		} else last_name.removeClass('wlred');


		if ( phone.val() === '' ) {
			phone.addClass('wlred');
			return false;
		} else phone.removeClass('wlred');


		if ( email.val() === '' ) {
			email.addClass('wlred');
			return false;
		} else email.removeClass('wlred');

		// Validating the correct email address
		if (!validateEmail(email.val()))
		{
			email.addClass('wlred');
			$('.woocommerce-NoticeGroup').show();
			$('.woocommerce-NoticeGroup li:eq(0)').show();
			return false;
		}
		else
		{
			$('.woocommerce-NoticeGroup').hide();
			email.removeClass('wlred');
		}

		// Calling cart function via ajax 
		wlcheckout(first_name, last_name, phone, email);


	});


	/* 
		Clearing the cart by calling a hook via Ajax 
		
		The product_id argument can be filled with any value, 
		if you remove it, the hook may not work stably 
	*/
	$('.wlcheckoutf').on("DOMNodeInserted", function (event) {
		$('.wloverlay').hide();
		$.ajax({
			type: "POST",
			url: '/wp-admin/admin-ajax.php',
			data: {action : 'remove_item_from_cart','product_id' : '4'},
			success: function (res) {
				if (res) {
					$('body').removeClass('wlfixed');
				}
			}
		});
	});


    var input = jQuery('.form-label').find('input');
    input.each(function () {
        jQuery(this).toggleClass('is-filled', jQuery(this).val().length > 0);
    });
    input.on('blur', function (e) {
        jQuery(e.currentTarget).toggleClass('is-filled', jQuery(this).val().length > 0);
    });

    $('.review_name').keyup(function(){
        if ($(this).val() === '') $(this).addClass('review_red');
        else $(this).removeClass('review_red');
    });

    $('.review_email').keyup(function(){
        if ($(this).val() === '') $(this).addClass('review_red');
        else $(this).removeClass('review_red');
    });

    $('.review_content').keyup(function(){
        if ($(this).val() === '') $(this).addClass('review_red');
        else $(this).removeClass('review_red');
    });

	jQuery( document ).on( 'submit', '.review_form',  function( e ) {
		e.preventDefault();
		let name = $(this).find('.review_name');
		let email = $(this).find('.review_email');
		let content = $(this).find('.review_content');
		let post_id = $(this).attr('id');
		let current = $(this);

		// if ( name || email || content ) {
		// 	return;
		// }

        // alert(validateEmail(email.val()));

        if ( name.val() === '' ) {
            name.addClass('review_red');
            return;
        }


        if ( email.val() === '' ) {
            email.addClass('review_red');
            return;
        }

        if ( !validateEmail(email.val()) ) {
            email.addClass('review_red');
            return;
        }

        if ( content.val() === '' ) {
            content.addClass('review_red');
            return;
        }

		$.ajax({
			type: "POST",
			url: ajax.url,
			data: {
				action  : 'add_comment',
				nonce   :  ajax.nonce,
				name    :   name.val(),
				email   :   email.val(),
				content :  content.val(),
				post_id :  post_id
			},
			success: function (res) {
				// current.parents('.review_popup').find('.donation_comments').append(res);
                $('.success_comment_message').show();
                name.val('');
                email.val('');
                content.val('');
			}
		});
	});

    jQuery( document ).on( 'click', '.open_comment_form_button',  function( e ) {
        $( ".comment_form_block" ).fadeTo( "fast", 1 );
        $( ".comment_form_block" ).css( "z-index", 10 );
    });

    jQuery( document ).on( 'click', '.comment_form_close',  function( e ) {
        $( ".comment_form_block" ).fadeTo( "fast", 0 );
        $( ".comment_form_block" ).css( "z-index", -1 );
    });






    // jQuery( document ).on( 'click', 'body',  function( e ) {
    //     if(!$(e.target).is('.comment_form_block')) {
    //         $( ".comment_form_block" ).fadeTo( "fast", 0 );
    //     }
    // });










}); 	