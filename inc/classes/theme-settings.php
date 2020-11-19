<?php

class KabacedemyThemeSettings {
	private static $_instance = null;

	static public function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {

	}

	public function init() {
		$this->actions();
		$this->filters();
	}

	public function actions() {
		add_action( 'init', array( $this, 'disable_emojis' ) );
		add_action( 'init', array( $this, 'disable_get_name_param' ), 12 );
		//Disable basic widgets
		add_action( 'widgets_init', array( $this, 'unregister_basic_widgets' ) );
		add_action( 'after_setup_theme', array( $this, 'register_nav_menu' ) );
		add_action( 'template_redirect', [ $this, 'restricted_post_type' ], 15 );

		//Show courses at account page
		add_action( 'woocommerce_account_my-courses_endpoint', [ $this, 'add_my_courses_endpoint' ] );
	}

	public function filters() {
		add_filter( 'woocommerce_checkout_fields', [ $this, 'override_checkout_fields' ] );
		add_filter( 'woocommerce_gateway_icon', [ $this, 'change_icons_gateway' ], 10, 2 );
		add_filter( 'navigation_markup_template', 'change_navigation_template', 10, 2 );
		//Edit link in Account
		add_filter( 'woocommerce_account_menu_items', [ $this, 'remove_my_account_links' ] );
		//Change title in account page
		add_filter( 'the_title', [ $this, 'change_endpoint_title' ], 20, 2 );

		// Username from email -- 19-09-2020
		add_filter( 'pre_user_login', [ $this, 'username_from_email' ] );
	}

	public function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	public function unregister_basic_widgets() {
		unregister_widget( 'WP_Widget_Pages' );            // Виджет страниц
		unregister_widget( 'WP_Widget_Calendar' );         // Календарь
		unregister_widget( 'WP_Widget_Archives' );         // Архивы
		unregister_widget( 'WP_Widget_Links' );            // Ссылки
		unregister_widget( 'WP_Widget_Meta' );             // Мета виджет
		unregister_widget( 'WP_Widget_Search' );           // Поиск
		unregister_widget( 'WP_Widget_Text' );             // Текст
		unregister_widget( 'WP_Widget_Categories' );       // Категории
		unregister_widget( 'WP_Widget_Recent_Posts' );     // Последние записи
		unregister_widget( 'WP_Widget_Recent_Comments' );  // Последние комментарии
		unregister_widget( 'WP_Widget_RSS' );              // RSS
		unregister_widget( 'WP_Widget_Tag_Cloud' );        // Облако меток
		unregister_widget( 'WP_Nav_Menu_Widget' );         // Меню
		unregister_widget( 'WP_Widget_Media_Audio' );      // Audio
		unregister_widget( 'WP_Widget_Media_Video' );      // Video
		unregister_widget( 'WP_Widget_Media_Gallery' );    // Gallery
		unregister_widget( 'WP_Widget_Media_Image' );      // Image
	}

	public function register_nav_menu() {
		register_nav_menus( [
			'top_header'  => 'Меню в шапке (top)',
			'footer_menu' => 'Меню в подвале'
		] );
	}

	/**
	 * Logged user menu
	 */
	public function user_logged_menu() {
		?>
		<?php
		echo do_shortcode( '[wcm_restrict plans="mak-club"]
            <a href="/mak-club/" class="header__login__user__menu__link">Мак клуб</a>
            [/wcm_restrict]' );
		?>
        <a href="/my-account/my-courses/" class="header__login__user__menu__link">Мои курсы</span></a>
        <a href="/my-account/orders/" class="header__login__user__menu__link">Заказы</span></a>
        <div class="header__login__user__menu__separate"></div>
        <a href="<?php wc_get_account_endpoint_url( 'edit-account' ); ?>" class="header__login__user__menu__link">Профиль</a>
        <a href="<?php wp_logout_url( home_url() ) ?>" class="header__login__user__menu__link">Выйти</a>
		<?php
	}

	public function change_icons_gateway( $icon_html, $id ) {
		$base_path = get_stylesheet_directory_uri();

		switch ( $id ) {
			case 'pelecard':
				return "<img src=\"{$base_path}/static/img/assets/cart-new/icon-bank-card.png\" alt=\"{$id}\" />";
			case 'paypal':
				return "<img src=\"{$base_path}/static/img/assets/cart-new/icon-paypal.png\" alt=\"{$id}\" />";
			default:
				return $icon_html;
		}
	}

	public function restricted_post_type() {
		$post_types = [
			'mak_club',
			'forum'
		];

		do_action( 'set_page_cookie' );

		if ( ! is_user_in_club() ) {
			if ( is_post_type_archive( $post_types ) || is_singular( $post_types ) ) {
				wp_redirect( get_field( 'gn_redirect_page', 'option' ) );
				exit();
			}
		}

	}

	public function override_checkout_fields( $fields ) {
		unset( $fields['billing']['billing_company'] );
		unset( $fields['billing']['billing_address_1'] );
		unset( $fields['billing']['billing_address_2'] );
		unset( $fields['billing']['billing_city'] );
		unset( $fields['billing']['billing_postcode'] );
		unset( $fields['billing']['billing_country'] );
		unset( $fields['billing']['billing_state'] );
		unset( $fields['billing']['billing_phone'] );
		unset( $fields['order']['order_comments'] );

		return $fields;
	}

	public function change_navigation_template( $template, $class ) {
		return '<div class="%1$s">
                    <div class="pagination__list">%3$s</div>
                </div>    
                ';
	}

	public function remove_my_account_links( $menu_links ) {
		unset( $menu_links['edit-address'] );
		unset( $menu_links['dashboard'] );
		unset( $menu_links['payment-methods'] );
		unset( $menu_links['downloads'] );

		$menu_links['edit-account'] = 'Детали учетной записи';

		return $menu_links;
	}

	public function add_my_courses_endpoint() {
		echo do_shortcode( '[eb_my_courses recommended_courses_wrapper_title="Рекомендованные курсы" number_of_recommended_courses="0" ]' );
	}

	public function change_endpoint_title( $page_title, $id ) {
		if ( is_wc_endpoint_url( 'edit-account' ) && in_the_loop() ) {
			wc_page_endpoint_title( "Детали учетной записи" );
		} elseif ( is_wc_endpoint_url( 'orders' ) && in_the_loop() ) {
			wc_page_endpoint_title( "Заказы" );
		}

		return $page_title;
	}

	public function disable_get_name_param() {
		if ( isset( $_GET['name'] ) && empty( $_GET['name'] ) ) {
			get_template_part( 404 );
		}
	}

	public function username_from_email( $user_login ) {
		if ( isset( $_POST['billing_email'] ) ) {
			$user_login = $_POST['billing_email'];
		}
		if ( isset( $_POST['email'] ) ) {
			$user_login = $_POST['email'];
		}

		$user_name = explode( '@', $user_login );

		return $user_name[0];
	}
}