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
	jQuery( "#billing_first_name_donation" ).keyup(function(){ 
		if (jQuery('#billing_first_name_donation').val() == '') {
			jQuery('#billing_first_name_donation').addClass('wlred');
	}
		else {jQuery('#billing_first_name_donation').removeClass('wlred'); }
	});
		
		
	jQuery( "#billing_last_name_donation" ).keyup(function(){ 
		if (jQuery('#billing_last_name_donation').val() == '') {
			jQuery('#billing_last_name_donation').addClass('wlred');
	}
		else {jQuery('#billing_last_name_donation').removeClass('wlred'); }
	});
		
	jQuery( "#billing_phone_donation" ).keyup(function(){ 
		if (jQuery('#billing_phone_donation').val() == '') {
			jQuery('#billing_phone_donation').addClass('wlred');
	}
		else {jQuery('#billing_phone_donation').removeClass('wlred'); }
	});		
	

	jQuery( "#billing_email_donation" ).keyup(function(){ 
		if (jQuery('#billing_email_donation').val() == '') {
			jQuery('#billing_email_donation').addClass('wlred');
	}
		else {jQuery('#billing_email_donation').removeClass('wlred'); }
	});	
		
	
	/* 
		Checking the correctness of filling in the phone field in real time.
		phoneRegExp - Regular expression,
		Any letters are removed immediately
	*/ 
	
	var phoneRegExp = new RegExp(/^(?=.*[0-9])[+0-9]+$/);

	jQuery('#billing_phone_donation').keyup(function() {
		var val = jQuery(this).val();
	if ( !phoneRegExp.test( val ) ) {
		jQuery(this).val( val.replace(/([^+0-9]+)/gi, '') );
		}
	});



	// Clearing a full form when opening a modal form 
	
	jQuery(".wlmodalgo").on("click", function(e){
		jQuery(".variations_form")[0].reset();
		jQuery('.wltempform').empty();
		jQuery('.wlcart__contacts input').removeClass('is-filled');
		jQuery('.wlcart-payments2 label:eq(0)').trigger("click");
		jQuery('#hidden_field').val("");
		
	});	


	// Validating and submitting a form for payment
	jQuery(".wlsubmit").on("click", function(e){
	
		//Hiding fields if the form was open, then closed again and reopened 
		window.onbeforeunload = null;
		e.preventDefault();
		jQuery(window).off('beforeunload');
		jQuery('.woocommerce-NoticeGroup li').hide();
		jQuery("input[name=custom_price]").val(jQuery("#price-custom").val());
		
		//To avoid unnecessary scrolling 
		jQuery('body').addClass('bodypadding');
		jQuery('body').addClass('wlfixed');
		jQuery('h3').addClass('wlh3');
		jQuery('.container').addClass('wlcontainer');
		jQuery('h6').addClass('wlh6');
	
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
	function wlcheckout() {
	
		jQuery('.wloverlay').show();	
		jQuery.ajax({
		url: '/?wc-ajax=checkout',
		method: 'post',
		dataType: 'html',
		data: jQuery('.variations_form').serialize(),
		success: function(data){
			
			// A variable named date avoids unnecessary scrolling 
			data = data.replace("main.css","main1.css");
			jQuery('.wltempform').html(data);
			
			// Filling in the cart fields 
			jQuery('.wltempform #billing_first_name').val(jQuery('#billing_first_name_donation').val());
			jQuery('.wltempform #billing_last_name').val(jQuery('#billing_last_name_donation').val());
			jQuery('.wltempform #billing_phone').val(jQuery('#billing_phone_donation').val());
			jQuery('.wltempform #billing_email').val(jQuery('#billing_email_donation').val());
			
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
	
	  
	/* 
		Checking fields for emptiness,
		if the field is not filled, then it is outlined with a red border
	*/ 
	
	if (jQuery('#billing_first_name_donation').val() == '') {
		jQuery('#billing_first_name_donation').addClass('wlred');
		return false;
	}
	else {jQuery('#billing_first_name_donation').removeClass('wlred'); }
	
	if (jQuery('#billing_last_name_donation').val() == '') {
		jQuery('#billing_last_name_donation').addClass('wlred');
		return false;
	}
	else {jQuery('#billing_last_name_donation').removeClass('wlred'); }

	
	if (jQuery('#billing_phone_donation').val() == '') {
		jQuery('#billing_phone_donation').addClass('wlred');
		return false;
	}
	else {jQuery('#billing_phone_donation').removeClass('wlred'); }

	
	if (jQuery('#billing_email_donation').val() == '') {
		jQuery('#billing_email_donation').addClass('wlred');
		return false;
	}
	else {jQuery('#billing_email_donation').removeClass('wlred'); }
	
	// Validating the correct email address 
	if (!validateEmail(jQuery('#billing_email_donation').val()))
	{
		jQuery('#billing_email_donation').addClass('wlred');
		jQuery('.woocommerce-NoticeGroup').show();
		jQuery('.woocommerce-NoticeGroup li:eq(0)').show();
		return false;
	}
	else
	{
		jQuery('.woocommerce-NoticeGroup').hide();
		jQuery('#billing_email_donation').removeClass('wlred');
	}
	
		// Calling cart function via ajax 
		wlcheckout();
	
	
});


	/* 
		Clearing the cart by calling a hook via Ajax 
		
		The product_id argument can be filled with any value, 
		if you remove it, the hook may not work stably 
	*/ 
	jQuery('.wlcheckoutf').on("DOMNodeInserted", function (event) {  
		jQuery('.wloverlay').hide();
		$.ajax({
		type: "POST",
		url: '/wp-admin/admin-ajax.php',
		data: {action : 'remove_item_from_cart','product_id' : '4'},
		success: function (res) {
			if (res) {
				jQuery('body').removeClass('wlfixed'); 
				}
			}
		});
	});
	

}); 	