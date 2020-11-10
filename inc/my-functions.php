<?php

add_filter( 'wpcf7_autop_or_not', '__return_false' );
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add menus
 */
add_action( 'after_setup_theme', 'kabacedemy_register_nav_menu' );

function kabacedemy_register_nav_menu() {
	register_nav_menus( [
		'top_header'  => 'Меню в шапке (top)',
		'footer_menu' => 'Меню в подвале'
	] );
}

/**
 * Logged user menu
 */

function kabacedemy_user_logged_menu() {

	$html = '';

	$html .= do_shortcode( '[wcm_restrict plans="mak-club"]
      <a href="/mak-club/" class="header__login__user__menu__link">Мак клуб</a>
  [/wcm_restrict]' );

	$html .= '<a href="/my-account/my-courses/" class="header__login__user__menu__link">Мои курсы</span></a>';
	$html .= '<a href="/my-account/orders/" class="header__login__user__menu__link">Заказы</span></a>';
	$html .= '<div class="header__login__user__menu__separate"></div>';
	$html .= '<a href="' . wc_get_account_endpoint_url( 'edit-account' ) . '" class="header__login__user__menu__link">Профиль</a>';
	$html .= '<a href="' . wp_logout_url( home_url() ) . '" class="header__login__user__menu__link">Выйти</a>';

	return $html;

}

/**
 * Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Настройки темы',
		'menu_title' => 'Настройки темы',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Общие настройки',
		'menu_title'  => 'General',
		'parent_slug' => 'theme-general-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Theme Header Settings',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-general-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Theme Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Главная страница',
		'menu_title'  => 'Main page',
		'parent_slug' => 'theme-general-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Отделы Мак-клуб',
		'menu_title'  => 'Mak-club',
		'parent_slug' => 'theme-general-settings',
	) );

}

add_action( 'acf/init', 'my_acf_blocks_init' );

function my_acf_blocks_init() {

	// Check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register a testimonial block.
		acf_register_block_type( array(
			'name'            => 'testimonial',
			'title'           => __( 'Testimonial' ),
			'description'     => __( 'A custom testimonial block.' ),
			'render_template' => 'template-parts/blocks/testimonial/testimonial.php',
			'category'        => 'formatting',
		) );

		// Register a testimonial block.
		acf_register_block_type( array(
			'name'            => 'blockquote',
			'title'           => __( 'Цитата (кастомная)' ),
			'description'     => __( 'A custom blockquote block.' ),
			'render_template' => 'template-parts/blocks/blockquote/blockquote.php',
			'category'        => 'formatting',
		) );

	}
}

/**
 * Custom class to tag form (CF7)
 */
add_filter( 'wpcf7_form_class_attr', 'kabacedemy_form_class_attr' );

function kabacedemy_form_class_attr( $class ) {
	$class .= ' article-content__form';

	return $class;
}

/**
 * Debug
 */

function debug( $var ) {

	if ( $_SERVER['REMOTE_ADDR'] == '193.160.224.112' ) {
		echo '<pre>';
		var_dump( $var );
		echo '</pre>';
	}

}

/**
 * Remove product hooks
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products' );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

/**
 * Events gallery archive view
 */

function kabacedemy_show_events_gallery( $post_thumbnail, $gallery_images ) {

	$class = '';

	if ( ! $post_thumbnail ) {
		$class = 'events-content__item__gallery--vertical';
	}

	$html = '<div class="events-content__item__gallery ' . $class . '">';

	foreach ( $gallery_images as $image ) {

		$html .= '<a class="events-content__item__gallery__item" href="' . $image . '" data-fancybox="event-' . get_the_ID() . '">';
		$html .= '<img src="' . $image . '" alt="' . get_the_title() . '">';
		$html .= '</a>';

	}

	$html .= '<a class="events-content__item__gallery__item events-content__item__gallery__item--last" 
          href="' . get_permalink( get_the_ID() ) . '">
          все ' . count( $gallery_images ) . ' фото
      </a>
    </div>';

	return $html;
}


/**
 * Add custom action for coupon
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
add_action( 'kabacedemy_coupoun_checkout_form', 'woocommerce_checkout_coupon_form', 10, 1 );

/**
 * Checkout
 */
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
add_action( 'kabacedemy_checkout_order_review', 'woocommerce_order_review', 10 );

/**
 * Change checkout submit btn name
 */
add_filter( 'woocommerce_order_button_text', 'kabacedemy_checkout_button_text' );
add_filter( 'wc_pelecard_gateway_order_button_text', 'kabacedemy_checkout_button_text' );

function kabacedemy_checkout_button_text( $button_text ) {
	return 'перейти к оплате';
}

function getYoutubeVideoInfo( $video_id ) {
	$api_key = 'AIzaSyDcH81zF50slFiGdIEw49ykFj1A2zloxKY';

	$youtube = "https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id=" . $video_id . "&part=contentDetails,statistics&key=" . $api_key;

	$curl = curl_init( $youtube );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	$return = curl_exec( $curl );
	curl_close( $curl );

	$return = json_decode( $return, false );

	return $return->items[0];
}

function getYoutubeComments( $video_id ) {

	$api_key = 'AIzaSyDcH81zF50slFiGdIEw49ykFj1A2zloxKY';
	$youtube = "https://www.googleapis.com/youtube/v3/commentThreads?key={$api_key}&textFormat=plainText&part=snippet&videoId={$video_id}&maxResults=100";


	$curl = curl_init( $youtube );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	$return = curl_exec( $curl );
	curl_close( $curl );

	$return = json_decode( $return, false );

	return $return->items;

}

function showVideoMakClub( $id, $title ) {

	$html = '<div class="online-club__label">' . $title . '</div>';

	$html .= '<ul class="online-club__list online-club-list">';

	$videos = get_field( 'mak_archive_webinars', $id );

	if ( $videos ) {
		foreach ( $videos as $video ) {
			$video_info = getYoutubeVideoInfo( $video['mak_archive_webinar_id'] );

			$html .= '<li class="online-club-list__item">
                    <svg class="icon__icon-comment" width="21" height="20">
                    <use href="/svg-symbols.svg#icon-comment"></use>
                  </svg> ';
			$html .= '<a href="' . get_the_permalink( $id ) . '?video=' . $video['mak_archive_webinar_id'] . '">' . $video_info->snippet->title . '</a></li>';
		}
	} else {
		$html .= '<span style="font-size: 13px; color: #ccc; text-align: center; width: 100%; display: inline-block;">Записей трансляций пока нет</span>';
	}

	$html .= '</ul>';

	return $html;
}

function has_bought_items( $user_id = 0, $product_ids = 0 ) {
	global $wpdb;
	$customer_id = $user_id == 0 || $user_id == '' ? get_current_user_id() : $user_id;
	$statuses    = array_map( 'esc_sql', wc_get_is_paid_statuses() );

	if ( is_array( $product_ids ) ) {
		$product_ids = implode( ',', $product_ids );
	}

	if ( $product_ids != ( 0 || '' ) ) {
		$query_line = "AND woim.meta_value IN ($product_ids)";
	} else {
		$query_line = "AND woim.meta_value != 0";
	}

	// Count the number of products
	$product_count_query = $wpdb->get_var( "
        SELECT COUNT(p.ID) FROM {$wpdb->prefix}posts AS p
        INNER JOIN {$wpdb->prefix}postmeta AS pm ON p.ID = pm.post_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi ON p.ID = woi.order_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS woim ON woi.order_item_id = woim.order_item_id
        WHERE p.post_status IN ( 'wc-" . implode( "','wc-", $statuses ) . "' )
        AND pm.meta_key = '_customer_user'
        AND pm.meta_value = $customer_id
        AND woim.meta_key IN ( '_product_id', '_variation_id' )
        $query_line
    " );

	// Return a boolean value if count is higher than 0
	return $product_count_query > 0 ? true : false;
}

function showForumMakClub( $id ) {

	$html = '<div class="online-club__label">Последние обсуждаемые темы:</div>';
	$html .= '<ul class="online-club__list online-club-list-forum">';

	$args  = array(
		'post_type'      => 'topic',
		'posts_per_page' => - 1,
		'meta_key'       => '_bbp_last_active_time', // Make sure topic has some last activity time
		'orderby'        => 'meta_value',

	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		$i = 0;

		while ( $query->have_posts() && ( $i < 3 ) ) {
			$query->the_post();
			$posturl = get_the_permalink( $guid );

			$html .= '<li class="online-club-list__item ' . get_the_id() . '">
                    <svg class="icon__icon-comment" width="21" height="20">
                    <use href="/svg-symbols.svg#icon-comment"></use>
                    </svg> ';
			$html .= '<a href="' . $posturl . '">' . get_the_title() . '</a></li>';

			$i = $i + 1;
		}
	}

	$html .= '</ul>';

	return $html;
}

function showGalleryMakClub( $id ) {

	$courses = get_field( 'mak_courses', $id );

	$html = '<div class="club-department__slider club-department-slider">';
	$html .= '<div class="swiper-wrapper">';

	foreach ( $courses as $course ) {

		$html .= '<a href="' . get_the_permalink( $course->ID ) . '" class="club-department-slider__item club-department-slide swiper-slide">';
		$html .= '<div class="club-department-slide__logo">';

		if ( get_the_post_thumbnail( $course->ID ) ) {
			$html .= '<img src="' . get_the_post_thumbnail_url( $course->ID ) . '" alt="' . $course->post_title . '">';
		}

		$html .= '</div>';
		$html .= '<div class="club-department-slide__title">' . $course->post_title . '</div>';
		if ( get_field( 'course_subtitle', $course->ID ) ) {
			$html .= '<div class="club-department-slide__subtitle">' . get_field( 'course_subtitle',
					$course->ID ) . '</div>';
		}

		$html .= '</a>';

	}

	$html .= '</div><div class="club-department-slider__bottom">
              <div class="club-department-slider__prev"></div>
              <div class="club-department-slider__counter"></div>
              <div class="club-department-slider__next"></div>
            </div>
          </div>';

	return $html;

}

add_action( 'woocommerce_before_calculate_totals', 'one_subcategory_cart_item', 10, 1 );
function one_subcategory_cart_item( $cart ) {

	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	foreach ( $cart->get_cart() as $cart_item ) {
		if ( $cart_item["quantity"] > 1 ) {
			$cart->set_quantity( $cart_item["key"] );
		}
	}
}


add_action( 'woocommerce_checkout_update_user_meta', 'myplugin_user_register', 10, 2 );

function myplugin_user_register( $customer_id, $data ) {

	customDebug( '==============  BEGIN ===========' );

	customDebug( "Create user WP user_id = $customer_id" );

	// if ( ! email_exists( $data['billing_email'] ) ) {
		// Default last_name
		update_user_meta( $customer_id, 'last_name', '-' );
		// добавление сохранения страны
		if ( function_exists( 'geoip_detect2_get_info_from_ip' ) ) {
			$geoIP = geoip_detect2_get_info_from_ip( $_SERVER['REMOTE_ADDR'], null );
			update_user_meta( $customer_id, 'country', $geoIP->country->isoCode );
		}

		if ( isset( $data['billing_email'] ) && isset( $data['account_password'] ) ) {

			customDebug( "Create user WP user_email == {$data['billing_email']}" );

			$user = get_userdata( $customer_id );

			$action = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance();

			$user_data = array(
				'username'  => $user->data->user_login,
				'password'  => $data['account_password'],
				'firstname' => $data['billing_first_name'],
				// 'lastname'  => $data['last_name'],
				'lastname'  => '-',
				'email'     => $data['billing_email'],
				'auth'      => 'manual',
				'lang'      => 'ru',
			);

			customDebug( "Create user WP user_login ==" . serialize( $user->data->user_login ) );

			customDebug( print_r( $user_data, true ) );

			// create a moodle user with above details
			if ( EB_ACCESS_TOKEN != '' && EB_ACCESS_URL != '' ) {
				$moodle_user = $action->userManager()->createMoodleUser( $user_data );

				customDebug( "Request info ==" . serialize( $moodle_user ) );

				if ( isset( $moodle_user['user_created'] ) && $moodle_user['user_created'] == 1 && is_object( $moodle_user['user_data'] ) ) {

					customDebug( "Create user Moodle user_created == " . serialize( $moodle_user['user_created'] ) );
					customDebug( "user_data Moodle == " . serialize( $moodle_user['user_data'] ) );

					update_user_meta( $customer_id, 'moodle_user_id', $moodle_user['user_data']->id );
				}

			}

			update_user_meta( $customer_id, '_user_contacts_details', 1 );

			$test = Onepix_Mailchimp_Admin::addUserToMainchimp( $user_id, 'register' );
		// }
	}

}

add_action( 'wp_loaded', 'kab_block_mak_club', 15 );

function kab_block_mak_club() {

	if ( ! is_user_logged_in() ) {
		$url       = $_SERVER['REQUEST_URI'];
		$url_array = explode( '/', $url );

		if ( in_array( 'my-courses', $url_array ) ) {
			wp_redirect( home_url( '/my-account' ) );
			exit;
		}
	}

}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start(); ?>
    <div class="cart-checkout__result">итого: <?php echo WC()->cart->get_total(); ?></div>
	<?php
	$fragments['div.cart-checkout__result'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_discount_cart' );

function woocommerce_discount_cart( $fragments ) {
	ob_start();
	if ( WC()->cart->has_discount() ) { ?>
        <div class="cart-checkout__discount">

			<?php foreach ( WC()->cart->get_coupons() as $coupon ) { ?>
                включая скидку
                <b><?php echo $coupon->get_amount(); ?><?php echo ( $coupon->is_type( 'percent' ) ) ? '%' : ''; ?> </b>
                по промокоду
			<?php } ?>

        </div>
	<?php }
	$fragments['div.cart-checkout__discount'] = ob_get_clean();

	return $fragments;
}

function get_tv_page_variables( $page_id ) {


	$field_date     = get_field( 'mak_date' );
	$player_type    = get_field( 'mak_type_video' );
	$label          = get_field( 'mak_video_label' );
	$image_preview  = get_field( 'mak_img_video' );
	$post_thumbnail = get_the_post_thumbnail_url( $page_id, 'full' );

	if ( $player_type === 'playlist' ) {
		$video_id = get_field( 'mak_id_playlist' );
	} else {
		$video_id = get_field( 'mak_id_video' );
	}

	if ( isset( $_GET['video'] ) && ! empty( $_GET['video'] ) ) {
		$video_id = $_GET['video'];
	}

	return [
		$video_id,
		$field_date,
		$player_type,
		$label,
		$image_preview,
		$post_thumbnail
	];

}

function get_script_tv_page( $player_type ) {
	?>
    <script>
			function onPlayerReady(event) {
				const videoId = document.getElementById('player').dataset.video;

		  <?php if (( $player_type === 'playlist' ) && ( ( ! isset( $_GET['video'] ) || empty( $_GET['video'] ) ) )) { ?>
				event.target.loadPlaylist({
					listType: 'playlist',
					list: videoId,
					suggestedQuality: 'large'
				});
		  <?php } else { ?>
				event.target.loadVideoById({
					videoId: videoId,
					'suggestedQuality': 'large'
				});
		  <?php } ?>

			}
    </script>
	<?php
}

function ajax_load_comments() {
	if ( isset( $_POST['video_id'] ) && ! empty( $_POST['video_id'] ) ) {
		$video_id = sanitize_text_field( $_POST['video_id'] );

		$comments = getYoutubeComments( $video_id );

		get_template_part( 'template-parts/tv-pages/comments', null, array(
			'comments' => $comments
		) );

		exit();
	}

}

add_action( 'wp_ajax_nopriv_ajax_change_commnets', 'ajax_load_comments', 5 );
add_action( 'wp_ajax_ajax_change_commnets', 'ajax_load_comments', 5 );

function ajax_video_info_api() {
	if ( isset( $_POST['video_id'] ) && ! empty( $_POST['video_id'] ) ) {
		$video_id   = sanitize_text_field( $_POST['video_id'] );
		$video_data = getYoutubeVideoInfo( $video_id );


		if ( ! $video_data ) {
			wp_send_json_error( [
				'message' => 'ERROR'
			] );

			exit();
		}

		wp_send_json_success( [
			'data' => $video_data
		] );

		exit();
	}
}

add_action( 'wp_ajax_nopriv_video_data', 'ajax_video_info_api', 5 );
add_action( 'wp_ajax_video_data', 'ajax_video_info_api', 5 );


function sv_wc_memberships_member_discount_product_notice( $product_id ) {
	if ( ! function_exists( 'wc_memberships' ) ) {
		return;
	}

	$users_discount_on_product = wc_memberships()->get_rules_instance()->get_user_product_purchasing_discount_rules( get_current_user_id(),
		$product_id );

	foreach ( $users_discount_on_product as $membership ) {
		$membership_name = get_the_title( $membership->get_membership_plan_id() );
		$discount        = $membership->get_discount();
		$discount_type   = $membership->get_discount_type();
	}

	if ( $discount_type === 'amount' ) {
		$discount .= get_woocommerce_currency_symbol();
	}

	if ( wc_memberships_user_has_member_discount( $product_id ) ) {
		echo '<div class="basic-sidebar__product__discount">';
		echo sprintf( 'Скидка на курс <strong>%s</strong> в рамках подписки клуба - "%s"', $discount,
			$membership_name );
		echo '</div>';
	}
}

add_filter( 'woocommerce_registration_error_email_exists', function ( $msg, $email ) {
	return "Аккаунт с таким email'ом уже зарегистрирован. Пожалуйста, <a class=\"notification-link\" href=\"/my-account\">авторизуйтесь</a>.";
}, 10, 2 );


add_filter( 'eb_moodle_user_profile_details', 'phone_moodle_user_profile_details', 10, 2 );

function phone_moodle_user_profile_details( $user_data, $update ) {
	global $current_user;

	if ( $update ) {
		$user_data['phone1'] = get_user_meta( $current_user->ID, 'billing_phone', true );
	}

	$user_country = get_user_meta( $current_user->ID, 'country', true );

	if ( ! empty( $user_country ) ) {
		$user_data['country'] = $user_country;
	}

	return $user_data;
}

add_action( 'template_redirect', 'save_account_phone_field', 12 );

function save_account_phone_field() {
	global $current_user;

	if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'],
			'eb-update-user' ) && ! empty( $_POST['action'] ) && 'eb-update-user' === $_POST['action'] ) {
		$phone = sanitize_text_field( $_POST['phone1'] );
		update_user_meta( $current_user->ID, 'billing_phone', $phone );
	}

}

function product_button_name( $product ) {
	$base_text = '';

	if ( $product->get_price() <= 0 ) {
		return 'Записаться';
	}

	if ( WC_Subscriptions_Product::is_subscription( $product->get_id() ) ) {
		$base_text = 'ежемесячно';
	}

	return "Оплатить <span class=\"btn--bold\">" . get_woocommerce_currency_symbol() . "{$product->get_price()}</span> {$base_text}";
}


function is_user_in_club() {
	$membership_plan = 'mak-club';

	return wc_memberships_is_user_active_member( get_current_user_id(), $membership_plan );
}

function is_members_area_page() {
	global $wp;

	$page_id = wc_get_page_id( 'myaccount' );

	return ( $page_id && is_page( $page_id ) && isset( $wp->query_vars['members-area'] ) && ! empty( $wp->query_vars['members-area'] ) );
}


if ( ! is_admin() ) {
	remove_filter( 'woocommerce_account_menu_items', array(
		wc_memberships()->get_frontend_instance()->get_members_area_instance(),
		'add_account_members_area_menu_item'
	), 999 );
}

if ( is_user_in_club() ) {
	add_filter( 'woocommerce_account_menu_items', 'mak_club_menu_items' );

	function mak_club_menu_items( $items ) {
		$custom_items = array(
			'mak-club' => __( 'МАК Клуб', 'woocommerce' ),
		);

		$first_part = array_slice( $items, 0, 2, true );
		$last_part  = array_slice( $items, 2, count( $items ), true );

		return array_merge(
			$first_part,
			$custom_items,
			$last_part
		);
	}

	add_filter( 'woocommerce_get_endpoint_url', 'change_mak_redirect_endpoint', 10, 4 );
	function change_mak_redirect_endpoint( $url, $endpoint, $value, $permalink ) {
		if ( $endpoint == 'mak-club' ) {
			$url = '/mak-club/';
		}

		return $url;
	}
}

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

function get_request_params( $data ) {
	$headers = array( 'Content-type' => 'application/json' );
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

function customDebug( $text ) {
	$str         = '';
	$random_file = fopen( "user_registaration.log", "a+" );
	$str         .= $text;
	fwrite( $random_file, date( '[Y-m-d H:i:s] ' ) . '---' . $str . "\r\n" );
	fclose( $random_file );
}

add_action( 'woocommerce_thankyou', 'send_user_after_order', 12, 1 );

function send_user_after_order( $order_id ) {
	$order = wc_get_order( $order_id );

	$test = Onepix_Mailchimp_Admin::addUserToMainchimp( $order->get_user_id(), 'order', $order );
}

/*Максимальное количество символов в имени при регистрации и заказе*/

add_action( 'woocommerce_checkout_process', 'bbloomer_checkout_fields_custom_validation' );
   
function bbloomer_checkout_fields_custom_validation() { 
   if ( isset( $_POST['billing_first_name'] ) && ! empty( $_POST['billing_first_name'] ) ) {
      if ( strlen( $_POST['billing_first_name'] ) > 20 ) {
         wc_add_notice( 'Максимальное количество символов в имени - 20', 'error' );
      }
   }   
}


// styles for bbpress emails

add_action( 'bbp_subscription_mail_message', 'format_bbpress_emails' );
   
function format_bbpress_emails( $mail ) { 

  ob_start();
	get_template_part("woocommerce/emails/email-header");
  $header = ob_get_contents();
  ob_end_flush();

  ob_start();
	get_template_part("woocommerce/emails/email-footer");
  $footer = ob_get_contents();
  ob_end_flush();

  $content_start = '<table align="center" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;border:0"> <tbody><tr> <td style="padding:60px 8%">';

  $content_end = '</td></tr></tbody></table>';

  $mail = str_replace('-----------', '<br/><br/><br/>', $mail);
  

	return $header . $content_start . $mail . $content_end .$footer;
}


add_action( 'bbp_subscription_mail_headers', 'html_bbpress_emails' );
   
function html_bbpress_emails( $headers ) { 

	$headers[]  = 'Content-Type: ' . get_option( 'html_type' ) . '; charset=' . get_option( 'blog_charset' );;
	return $headers;
}
