<?php

function tracker_logger( $data ) {
	$log = var_export( $data, true );
	file_put_contents( '/sites/kabacademy.com/public/wp-content/debug.log', "\r\n" . $log, FILE_APPEND );
}

add_action( 'woocommerce_after_checkout_validation', 'filter_checkout_validation', 15, 2 );

function filter_checkout_validation( $data, $errors ) {
	if ( $errors->get_error_code() ) {
		// tracker_logger('Error');
	} else {
		send_tracking();
	}
}

function send_tracking() {

	try {
		$azure_url                      = 'https://prod-119.westeurope.logic.azure.com/workflows/49a6fefb78fc4d3fba4f5a2555fa2293/triggers/manual/paths/invoke/api/startPayment?api-version=2016-10-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=CyebvNfr0PrSx0bdZjH5kgUxw3LzBqYnUed1ccHIb7M';
		$data                           = array();
		$products                       = array();
		$data['googleAnalyticsDetails'] = array();
		foreach ( WC()->cart->get_cart() as $cart_item ) {
			$item_data                = array();
			$item_data['productId']   = $cart_item['data']->get_id();
			$item_data['productName'] = $cart_item['data']->get_title();
			$item_data['price']       = $cart_item['data']->get_price();

			array_push( $products, $item_data );
		}

		$parameter_error                               = 'the parameter is not passed';
		$data['leadId']                                = isset( $_POST['LeadId'] ) ? $_POST['LeadId'] : null;
		$data['paymentId']                             = generate_id();
		$data['firstName']                             = isset( $_POST['billing_first_name'] ) ? $_POST['billing_first_name'] : $parameter_error;
		$data['lastName']                              = isset( $_POST['billing_last_name'] ) ? $_POST['billing_last_name'] : $parameter_error;
		$data['email']                                 = isset( $_POST['billing_email'] ) ? $_POST['billing_email'] : $parameter_error;
		$data['phone']                                 = isset( $_POST['billing_phone'] ) ? $_POST['billing_phone'] : $parameter_error;
		$data['country']                               = isset( $_POST['billing_country'] ) ? $_POST['billing_country'] : $parameter_error;
		$data['city']                                  = isset( $_POST['billing_city'] ) ? $_POST['billing_city'] : $parameter_error;
		$data['ip']                                    = isset( $_POST['customerIP'] ) ? $_POST['customerIP'] : null;
		$data['termsAndConditionAgreement']            = isset( $_POST['terms-field'] ) ? (bool) $_POST['terms-field'] : $parameter_error;
		$data['products']                              = $products;
		$data['googleAnalyticsDetails']['gaClientId']  = $_POST['gaClientId'];
		$data['googleAnalyticsDetails']['gaUserId']    = $_POST['gaUserId'];
		$data['googleAnalyticsDetails']['utmSource']   = $_POST['utmSource'];
		$data['googleAnalyticsDetails']['utmCampaign'] = $_POST['utmCampaign'];
		$data['googleAnalyticsDetails']['utmTerm']     = $_POST['utmTerm'];
		$data['googleAnalyticsDetails']['utmMedium']   = $_POST['utmMedium'];
		$data['googleAnalyticsDetails']['utmContent']  = $_POST['utmContent'];
		$data['totalAmount']                           = WC()->cart->total;
		$data['currency']                              = @get_woocommerce_currency();
		$data['withCoupon']                            = empty( WC()->cart->applied_coupons ) ? false : true;
		$data['withBenefits']                          = false;
		$request_params                                = get_request_params( $data );
		$response                                      = wp_remote_post( $azure_url, $request_params );

		/*  tracker_logger($_POST); */
		if ( is_wp_error( $response ) ) {
			tracker_logger( $response );

			return;
		}

		set_transient( $data['email'], $data['paymentId'], 600 );

	} catch ( Exception $e ) {
		tracker_logger( $e );
	}
}

add_action( 'woocommerce_order_status_completed', 'woocommerce_payment_complete',10, 1 );
add_action( 'woocommerce_order_status_cancelled', 'woocommerce_payment_cancelled', 10, 1 );

function woocommerce_payment_cancelled ( $id ) {
  tracker_logger('Cancelled -> ' . $id);
}

function woocommerce_payment_complete( $id ) {
  $order = new WC_Order($id);
  $order_status = $order->status;
  $order_billing_email = $order->billing_email;
  $paymentId = get_transient($order_billing_email);

  if (!empty($paymentId)) {

    $azure_success = 'https://prod-53.westeurope.logic.azure.com/workflows/829d742110cb4f42b5d217424fbd5222/triggers/manual/paths/invoke/api/notifyPaymentCompleted?api-version=2016-10-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=g8sQN2bL7wtCzf0Ld1KfeYdEWcOJfKlF_i6u4ZLY-kM';
    $order_data = array();
    $order_data['paymentId'] = $paymentId;
    if($order_status === 'completed') {
      $order_data['isSuccess'] = true;
    } else {
      $order_data['isSuccess'] = false;
      $order_data['failureReason'] = 'Order is failed';
    }
    $request_params = get_request_params($order_data);
    $response = wp_remote_post($azure_success, $request_params);
    $response_data = wp_remote_retrieve_body( $response );

    tracker_logger('Success -> ' . $paymentId);
    delete_transient($order_billing_email);

  } else {
    tracker_logger('paymentId is empty');
  }
}

function get_request_params( $data ) {
	$headers = array( 'Content-type' => 'application/json' );

	foreach ($data as $key => $value) {
		if($value === 'the parameter is not passed') {
			unset($data[$key]);
		}
	}

	$pload   = array(
		'method'      => 'POST',
		'timeout'     => 400,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking'    => true,
		'headers'     => $headers,
		'body'        => json_encode( $data ),
	);

	return $pload;
}

function generate_id() {
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		// 32 bits for "time_low"
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

		// 16 bits for "time_mid"
		mt_rand( 0, 0xffff ),

		// 16 bits for "time_hi_and_version",
		// four most significant bits holds version number 4
		mt_rand( 0, 0x0fff ) | 0x4000,

		// 16 bits, 8 bits for "clk_seq_hi_res",
		// 8 bits for "clk_seq_low",
		// two most significant bits holds zero and one for variant DCE1.1
		mt_rand( 0, 0x3fff ) | 0x8000,

		// 48 bits for "node"
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	);
}


// Add Google Analytics Events

add_action('woocommerce_review_order_before_payment', 'add_to_cart_google_analytics_events');

function add_to_cart_google_analytics_events( ) {
   global $woocommerce;

   $items = $woocommerce->cart->get_cart();
   $out = array();

   foreach ( $items as $item ) {
    $current_item = array();
    $current_item['name'] = $item['data']->get_title();
    $current_item['id'] = $item['product_id'];
    $current_item['quantity'] = $item['quantity'];
    $current_item['price'] = $item['data']->get_price();

    array_push($out, $current_item);
   }

   ?>
   <script>
   window.onload = (event) => {
    const products = JSON.parse('<?php echo json_encode($out);  ?>');

      dataLayer.push({
        'event': 'addToCart',
        'ecommerce': {
          'currencyCode': '<?php echo get_woocommerce_currency_symbol(); ?>',
          'add': {
            'products': products
          }
        }
      });
    }
   </script>
   <?php
}

add_action( 'woocommerce_before_thankyou', 'purchase_google_analytics_events', 4 );

function purchase_google_analytics_events( $order_id ) {
  $order = wc_get_order( $order_id );
  $order_data = $order->get_data();
  $order_total_tax = $order_data['total_tax'];
  $order_shipping_total = $order_data['shipping_total'];
  $coupons = $order->get_used_coupons();
  $out = array();
  $transaction_id = $order_id;
  $test = '';
  foreach ($order->get_items() as $item_id => $item_data) {
    $current_item = array();
    $product = $item_data->get_product();
    $test = $product;
    $current_item['name'] = $product->get_name();
    $current_item['quantity'] = $item_data->get_quantity();
    $current_item['price'] = $item_data->get_total();
    $current_item['id'] = $item_data['product_id'];
      array_push($out, $current_item);
  }
     ?>
   <script>

    const products = JSON.parse('<?php echo json_encode($out);  ?>');
    const coupons = JSON.parse('<?php echo json_encode($coupons);  ?>');
    const id = '<?php echo $transaction_id;  ?>';
    const tax = '<?php echo $order_total_tax;  ?>';
    const shipping = '<?php echo $order_shipping_total;  ?>';

    console.log('purchase 1', products)
        dataLayer.push({
      'event': 'purchased',
      'ecommerce': {
        'purchase': {
        'actionField': {
          'id': id,
          'tax':tax,
          'shipping': shipping,
          'coupon': coupons,
        },
        'products': products
      }
      }
    });
   </script>
   <?php

}

add_action( 'woocommerce_after_single_product' , 'analytics_on_product_page');

function analytics_on_product_page() {
	global $product;
	
	$product_id = $product->get_id();
  $_product = wc_get_product( $product_id );
  $price = $_product->get_price();
  $title = $_product->get_title();
   ?>
   <script>
   window.onload = (event) => {
   const id = '<?php echo $product_id;  ?>';
   const price = '<?php echo $price;  ?>';
   const title = '<?php echo $title;  ?>';

    dataLayer.push({
        'event': 'productView',
        'ecommerce': {
        'currencyCode': 'USD',
          'detail': {
            'products': [{
              'name': title,
              'id': id,
              'price': price,
            }]
          }
        }
      });
    };
</script>
   <?php
}
