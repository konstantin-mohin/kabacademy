<?php

class KabacedemyHelper {
	private static $_instance = null;

	static public function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		$this->actions();
		$this->filters();
	}

	private function actions() {

		// add_action( 'wp_print_scripts', array( $this, 'remove_password_strength' ), 10 );

		add_action( 'wp_login', [ $this, 'checkUserCountry' ], 8, 2 );

		add_filter( 'woocommerce_get_script_data', [ $this, 'strength_meter_settings' ], 20, 2 );

		add_action( 'woocommerce_add_cart_item_data', array( $this, 'save_custom_data' ), 10 );

		add_action( 'rest_api_init', array( $this, 'api_registration' ) );

		add_action( 'eb_save_account_details', array( $this, 'disable_user_contact_details_notification' ), 10, 1 );

	}

	private function filters() {
//		add_filter( 'woocommerce_thankyou_order_received_text', 'change_redirect_link_success_order', 11, 2 );
	}

	private function check_user_contact_details() {
		return get_user_meta( get_current_user_id(), '_user_contacts_details', true );
	}

	public function clean_tel_number( $phone ) {
		return str_replace( [ ' ', '(', ')', '-' ], '', $phone );
	}

	public function user_contact_details_notification() {

		if ( $this->check_user_contact_details() && ! is_checkout() ) {
			?>

            <div style="display: none;" class="modal-notification" id="hidden-content">
                <div class="modal__form">
					<?php if ( get_field( 'notification_window_title', 'option' ) ) { ?>
                        <div class="modal__form__title"><?php the_field( 'notification_window_title',
								'option' ); ?></div>
					<?php } ?>
                    <div class="modal__form-content">
						<?php if ( get_field( 'notification_window_content', 'option' ) ) { ?>
							<?php the_field( 'notification_window_content', 'option' ); ?>
						<?php } ?>
                    </div>
					<?php if ( get_field( 'notification_window_link', 'option' ) ) { ?>
                        <a href="<?php the_field( 'notification_window_link', 'option' ); ?>"
                           class="modal__form-link">
                            Переход в Личный кабинет
                        </a>
					<?php } ?>
                </div>
            </div>
			<?php
		}
	}

	public function disable_user_contact_details_notification( $user_id ) {
		update_user_meta( $user_id, '_user_contacts_details', 0 );
	}

	public function change_redirect_link_success_order( $msg, $order ) {
		$options = get_option( 'eb_general' );

		echo preg_replace( '/<a(.*?)href="(.*?)"(.*?)>/', '<a href="' . esc_url( $options['eb_my_course_link'] ) . '">',
			$msg );
	}

	public function remove_password_strength() {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}

	public function strength_meter_settings( $params, $handle ) {

		if ( $handle === 'wc-password-strength-meter' ) {
			$params = array_merge( $params, array(
				'min_password_strength' => 8,
				'i18n_password_error'   => 'пароль',
				'i18n_password_hint'    => ''
			) );
		}

		return $params;

	}

	public function save_custom_data() {

		$data = array();

		if ( isset( $_REQUEST['billing_first_name'] ) ) {
			$data['billing_first_name'] = $_REQUEST['billing_first_name'];
		}

		if ( isset( $_REQUEST['billing_last_name'] ) ) {
			$data['billing_last_name'] = $_REQUEST['billing_last_name'];
		}

		if ( isset( $_REQUEST['billing_email'] ) ) {
			$data['billing_email'] = $_REQUEST['billing_email'];
		}

		WC()->session->set( 'product_form_user_data', $data );
	}

	public function api_registration() {
		register_rest_route(
			'onepix-bridge',
			'/onepix/',
			array(
				'methods'  => 'POST',
				'callback' => array( $this, "external_api_endpoint" ),
			)
		);
	}

	public function external_api_endpoint( $data ) {

		$data = stripcslashes( $_POST["data"] );
		$data = unserialize( $data );

		if ( isset( $_POST["action"] ) && ! empty( $_POST["action"] ) ) {
			switch ( $_POST["action"] ) {
				case 'user_updated':
					$response_data = $this->eb_update_user( $data );
					break;

				default:
					break;
			}
		}

		return $response_data;
	}

	public function eb_update_user( $data ) {
		$wpUserId = getWpUserIdFromMoodleId( $data["user_id"] );

		if ( $wpUserId ) {
			$user = get_user_by( "ID", $wpUserId );

			$userdata = [
				'ID'          => $wpUserId,
				'user_login'  => $data['user_name'],
				'nickname'    => $data['user_name'],
				'user_email'  => $data['email'],
				'description' => $data['description'],
			];

			update_user_meta( $wpUserId, 'first_name', $data['first_name'] );
			update_user_meta( $wpUserId, 'last_name', $data['last_name'] );
			update_user_meta( $wpUserId, 'billing_phone', $data['billing_phone'] );
			update_user_meta( $wpUserId, 'country', $data['country'] );
			update_user_meta( $wpUserId, 'city', $data['city'] );

			$updated = wp_update_user( $userdata );
		}

		return array( "status" => $updated );
	}

	public function get_count_teachers() {
		$args  = [
			'post_type' => 'teachers'
		];
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			return count( $query->posts );
		}

		return 0;

		wp_reset_query();
	}

	public function get_month_webinar( $number ) {
		$month = '';

		switch ( $number ) {
			case ( '01' ):
				$month = 'января';
				break;
			case ( '02' ):
				$month = 'февраля';
				break;
			case ( '03' ):
				$month = 'марта';
				break;
			case ( '04' ):
				$month = 'апреля';
				break;
			case ( '05' ):
				$month = 'мая';
				break;
			case ( '06' ):
				$month = 'июня';
				break;
			case ( '07' ):
				$month = 'июля';
				break;
			case ( '08' ):
				$month = 'августа';
				break;
			case ( '09' ):
				$month = 'сентября';
				break;
			case ( '10' ):
				$month = 'октября';
				break;
			case ( '11' ):
				$month = 'ноября';
				break;
			case ( '12' ):
				$month = 'декабря';
				break;
		}

		return $month;
	}

	/**
     * check if user country is filled
     *
	 * @param $user_login
	 * @param $user
	 */
	public function checkUserCountry($user_login, $user ) {
		$user_country = get_user_meta( $user->ID, 'country', true );
		$ip = getUserIP();
		$ipInfo = get_ipInfo_data($ip);
		if ( is_null($ipInfo) || ( !empty( $user_country )) ) {
            return;
        }
        $country = sanitize_text_field( $ipInfo->country );

		if ( (get_user_meta( $user->ID, 'billing_country', true ) === '' ) || empty( get_user_meta( $user->ID, 'billing_country', true ) )) {
			update_user_meta( $user->ID, 'billing_country',  $country );
		}

		if ( (get_user_meta( $user->ID, 'country', true ) === '' ) || empty( get_user_meta( $user->ID, 'country', true ) )) {
			update_user_meta( $user->ID, 'country',  $country );
		}
//		customDebug($user->ID);
        $moodle_user_id = get_user_meta( $user->ID, 'moodle_user_id', true ); // get moodle user id
        if ( ! is_numeric( $moodle_user_id ) ) {
            return;
        }

        $action = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance();

        $user_data = array(
            'id'      => $moodle_user_id, // moodle user id
            //'user_id'   => $user_id, // wordpress user id
            'country' => $country,
        );

        $moodle_user = $action->userManager()->createMoodleUser( $user_data, 1 );

        if ( isset( $moodle_user['user_updated'] ) && $moodle_user['user_updated'] == 1 ) {
            customDebug( 'Country successfully changed on moodle.' );
        } else {
            customDebug( 'There is a problem in country changed on moodle.' );
        }
     }
}
