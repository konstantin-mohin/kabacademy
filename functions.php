<?php
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
