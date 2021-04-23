<?php

require_once(__DIR__ . '/vendor/autoload.php');

use ipinfo\ipinfo\Details;
use ipinfo\ipinfo\IPinfo;

include_once 'inc/loader.php'; // main helper for theme

kab_help()->init();

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'kabacedemy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kabacedemy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on kabacedemy, use a find and replace
		 * to change 'kabacedemy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kabacedemy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'kabacedemy' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'kabacedemy_setup' );

/* Start Disable Continue Shopping Message after Add to Cart
*/

add_filter( 'wc_add_to_cart_message', function( $string, $product_id = 0 ) {
	$blank = '';
	return $blank;
});

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kabacedemy_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kabacedemy' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kabacedemy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">', //<section id="%1$s" class="widget %2$s">
			'after_widget'  => '</section>', //</section>
			// 'before_title'  => '<h2 class="widget-title">',
			// 'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'mak-club',
			'name'          => __( 'Сайдбар Мак-Клуб' ),
			'description'   => 'Для Мак-Клуба',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			// 'before_title'  => '<h3 class="widget-title">',
			// 'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'mak-club-second',
			'name'          => __( 'Сайдбар Мак-Клуб ( отдельная страница )' ),
			'description'   => 'Для Мак-Клуба',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			// 'before_title'  => '<h3 class="widget-title">',
			// 'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'events',
			'name'          => __( 'События' ),
			'description'   => 'Для пост-тайпа "События"',
			'before_widget' => '<span id="%1$s" class="widget %2$s">',
			'after_widget'  => '</span>',
			// 'before_title'  => '<h3 class="widget-title">',
			// 'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'myaccount',
			'name'          => __( 'Мой аккаунт' ),
			'description'   => 'Мой аккаунт',
			'before_widget' => '<span id="%1$s" class="widget %2$s">',
			'after_widget'  => '</span>',
			// 'before_title'  => '<h3 class="widget-title">',
			// 'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'kabacedemy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kabacedemy_scripts() {

	wp_enqueue_style( 'kabacedemy-main-style', get_stylesheet_directory_uri() . '/static/css/main.css', array(),
		current_time( 'timestamp' ) );
	wp_enqueue_style( 'kabacedemy-style', get_stylesheet_uri(), array( 'kabacedemy-main-style' ),
		current_time( 'timestamp' ) );
//	wp_enqueue_style( 'kabacedemy-google-fonts',
//		'https://fonts.googleapis.com/css?family=Open+Sans:300,400,500&display=swap', false );

//	wp_enqueue_style(
//		'kabacedemy-select2',
//		'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css',
//		current_time( 'timestamp' ) );


	wp_enqueue_script( 'kabacedemy-navigation', get_template_directory_uri() . '/js/navigation.js', array(),
		current_time( 'timestamp' ), true );
	wp_enqueue_script( 'kabacedemy-svg4everybody',
		get_template_directory_uri() . '/static/js/separate-js/svg4everybody.min.js', array(),
		current_time( 'timestamp' ), true );
	wp_enqueue_script( 'kabacedemy-main-js', get_template_directory_uri() . '/static/js/main.js', array(),
		current_time( 'timestamp' ), true );

	wp_enqueue_script( 'kabacedemy-video-js', get_template_directory_uri() . '/js/video.js', array(),
		current_time( 'timestamp' ), true );
	wp_enqueue_script( 'kabacedemy-custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ),
		current_time( 'timestamp' ), true );

	wp_localize_script( 'kabacedemy-custom-js', 'kabAjax', array(
		'ajaxurl'     => admin_url( 'admin-ajax.php' ),
		'course_page' => wc_get_account_endpoint_url( 'my-courses' )
	) );

	wp_enqueue_script( 'kabacedemy-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js',
		array( 'jquery' ),
		null, true );

	wp_enqueue_script( 'kabacedemy-swal', 'https://cdn.jsdelivr.net/npm/sweetalert2@10',
		null,
		null, true );

	wp_enqueue_script( 'kabacedemy-tracking-js', get_template_directory_uri() . '/js/tracking.js', array(), current_time( 'timestamp' ), true );
}

add_action( 'wp_enqueue_scripts', 'kabacedemy_scripts' );

function kabacedemy_scripts_footer() {
	?>
    <script>
        svg4everybody();
    </script>
	<?php
}

// add_action('wp_footer', 'kabacedemy_scripts_footer');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * my-function.php
 */
require get_template_directory() . '/inc/my-functions.php';

/**
 * Walkers
 */
require get_template_directory() . '/inc/walkers/class-top-header-walker.php';
require get_template_directory() . '/inc/walkers/class-footer-menu-walker.php';
require get_template_directory() . '/inc/walkers/class-sidebar-menu-walker.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes/training-teachers.php';
require get_template_directory() . '/inc/shortcodes/op-events-gallery.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widget-special-offer.php';
require get_template_directory() . '/inc/widgets/widget-kabacademy-nav-offer.php';
require get_template_directory() . '/inc/widgets/widget-webinar-event.php';

add_action('init', 'stop');

function stop() {
	$url       = $_SERVER['REQUEST_URI'];
	$url_array = explode( '/', $url );
	if ( in_array( 'my-account', $url_array ) ) {
		if ( $_SERVER['QUERY_STRING'] == 'action=eb_register' ) {
			die();
		}
	}

}

/**
 * Tracking
 */
require get_template_directory() . '/inc/tracking.php';


add_filter( 'woocommerce_admin_billing_fields' , 'order_admin_custom_fields' );
function order_admin_custom_fields( $fields ) {
	$fields['makleadid'] = array(
		'label' => __( 'ID User Azure(makleadid)', 'woocommerce' ),
		'show'  => true,
		'wrapper_class' => 'form-field-wide',
		'style' => '',
	);

	$fields['timezone'] = array(
		'label' => __('Timezone'),
		'show'  => true,
		'wrapper_class' => 'form-field-wide',
		'style' => '',
	);

	return $fields;
}

//var_dump(get_user_by('email', 'voodi.ua@gmail.com')->ID);


/**
 * Get user ip address
 *
 * @return string
 */
function getUserIP() {
	foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
		if (array_key_exists($key, $_SERVER) === true){
			foreach (explode(',', $_SERVER[$key]) as $ip){
				$ip = trim($ip); // just to be safe

				if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
					return $ip;
				}
			}
		}
	}
}


/**
 * Get ip data based on ip
 *
 * @param string $ip ip address.
 * @return Details|null user details based on ip.
 */
function get_ipInfo_data($ip) {
	try {
		$access_token = '41bb9fb7638750';
		$client = new IPinfo($access_token);
		$ipInfo = $client->getDetails($ip);

		return $ipInfo;

	} catch (Throwable $t) {
		ob_start();
		var_dump($t);
		$result = ob_get_clean();

		error_log($result);
		return null;
	}
}

/**
 * Update user and order meta when order is created
 *
 * @param string $order_id Order id we get from hook.
 */
add_action( 'woocommerce_new_order', 'update_data_after_order' );
function update_data_after_order( $order_id ) {
	$ip = get_post_meta( $order_id, '_customer_ip_address', true );
	$user_id = get_post_meta( $order_id, '_customer_user', true );

	$ipInfo = get_ipInfo_data($ip);
	if ( is_null($ipInfo) ) {
		return;
	}

	$city = sanitize_text_field( $ipInfo->city );
	$state = sanitize_text_field( $ipInfo->region );
	$timezone = sanitize_text_field( $ipInfo->timezone );
	$country = sanitize_text_field( $ipInfo->country );

//	update_post_meta($order_id, 'custom_order_ipinfo', $ipInfo);
//	update_post_meta($order_id, 'custom_order_city', $city);
//	update_post_meta($order_id, 'custom_order_country', $country);
//	update_post_meta($order_id, 'custom_order_timezone', $timezone);


	update_post_meta( $order_id, '_billing_city', $city );
	update_post_meta( $order_id, '_billing_state', $state );
	update_post_meta( $order_id, '_billing_timezone', $timezone );
	update_post_meta( $order_id, '_billing_country', $country );


	if ( ( get_user_meta( $user_id, 'city', true ) === '' ) || empty( get_user_meta( $user_id, 'city', true ) ) )  {
		update_user_meta( $user_id, 'city',  $city );

//		create_or_update_moodle_user_data($user_id, ['city' => $city]);
	}

	if ( (get_user_meta( $user_id, 'country', true ) === '' ) || empty( get_user_meta( $user_id, 'country', true ) )) {
		update_user_meta( $user_id, 'country',  $country );

//		create_or_update_moodle_user_data($user_id, ['country' => $country]);
	}

	if ( ( get_field('timezone', 'user_' . $user_id) === '' ) || empty( get_field('timezone', 'user_' . $user_id) ) ) {
		update_field('timezone', $timezone, 'user_' . $user_id);
	}
}


/**
 * Create or update moodle user data
 *
 * @param $user_id wordpress user id.
 * @param array $data array of custom data to save.
 */
function create_or_update_moodle_user_data( $user_id, $data = [] ) {
	if ( empty($data) ) return;

	try {
		$action = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance();
		$moodle_user_id = get_user_meta( $user_id, 'moodle_user_id', true ); // get moodle user id
		if ( ! is_numeric( $moodle_user_id ) ) {
			customDebug( 'Non numeric moodle user id' );
			return;
		}

		$user_data = array(
			'id'      => $moodle_user_id, // moodle user id
			//'user_id'   => $user_id, // wordpress user id
//			'country' => $country,
		);

		$user_data = array_merge($user_data, $data);
		$moodle_user = $action->userManager()->createMoodleUser( $user_data, 1 );

		if ( isset( $moodle_user['user_updated'] ) && $moodle_user['user_updated'] == 1 ) {
//			customDebug( 'Country successfully changed on moodle.' );
		} else {
			customDebug( 'There is a problem in changing user data on moodle. function.php' );
		}

	} catch ( Throwable $t ) {
		ob_start();
		var_dump($t);
		$result = ob_get_clean();

		customDebug( 'Exception' . $result );
	}
}





/**
 * Add user profile custom fields.
 *
 * @param $user
 */
add_action('show_user_profile', 'custom_user_profile_fields');
add_action('edit_user_profile', 'custom_user_profile_fields');
function custom_user_profile_fields( $user ) {
	?>
    <table class="form-table">
        <tr>
            <th>
                <label for="code"><?php _e( 'City' ); ?></label>
            </th>
            <td>
                <input type="text" name="city" id="city" value="<?php echo esc_attr( get_user_meta($user->ID, 'city', true) ); ?>" class="regular-text" />
            </td>
        </tr>
    </table>

    <table class="form-table">
        <tr>
            <th>
                <label for="code"><?php _e( 'Country' ); ?></label>
            </th>
            <td>
                <input type="text" name="country" id="country" value="<?php echo esc_attr( get_user_meta($user->ID, 'country', true) ); ?>" class="regular-text" />

            </td>
        </tr>
    </table>
	<?php
}





/**
 * Save user custom fields.
 *
 * @param $user_id User id.
 */
add_action( 'personal_options_update', 'update_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );
function update_extra_profile_fields( $user_id ) {
	if ( current_user_can( 'edit_user', $user_id ) ) {
		update_user_meta( $user_id, 'city', $_POST['city'] );
	}

	if ( current_user_can( 'edit_user', $user_id ) ) {
		update_user_meta( $user_id, 'country', $_POST['country'] );
	}
}





/**
 *  Remove "Change Payment Method" button from the "My Subscriptions" table.
 *
 * @param array $all_actions The $subscription_key => $actions array with all actions that will be displayed for a subscription on the "My Subscriptions" table.
 * @param array $subscriptions All of a given users subscriptions that will be displayed on the "My Subscriptions" table
 */
add_filter( 'wcs_view_subscription_actions', 'remove_change_payment_from_subscription', 10, 2 );
function remove_change_payment_from_subscription( $actions, $subscription ) {
	unset($actions['change_payment_method']);

	return $actions;
}



//echo '<div class="testt" style="display:none">';
//var_dump(get_post_meta(150977, 'custom_order_city', $ip));
//var_dump(get_post_meta(150977, 'custom_order_country', $ip));
//var_dump(get_post_meta(150977, 'custom_order_ip', $ip));
//var_dump(get_post_meta(150977, 'custom_order_ipinfo', $ip));

//echo '</div>';




