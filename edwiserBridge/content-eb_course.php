<?php
/**
 * The template for displaying course archive content.
 */
//Variables
global $post;
global $wpdb;
$post_id = $post->ID;

// get currency
$payment_options = get_option( 'eb_paypal' );
$currency        = isset( $payment_options['eb_paypal_currency'] ) ? $payment_options['eb_paypal_currency'] : 'USD';

$course_price_type = 'free';
$course_price      = '0';
$short_description = '';

$course_options = get_post_meta( $post_id, 'eb_course_options', true );
if ( is_array( $course_options ) ) {
	$course_price_type = ( isset( $course_options['course_price_type'] ) ) ? $course_options['course_price_type'] : 'free';
	$course_price      = ( isset( $course_options['course_price'] ) &&
	                       is_numeric( $course_options['course_price'] ) ) ?
		$course_options['course_price'] : '0';
	$course_closed_url = ( isset( $course_options['course_closed_url'] ) ) ?
		$course_options['course_closed_url'] : '#';
	$short_description = ( isset( $course_options['course_short_description'] ) ) ?
		$course_options['course_short_description'] : '';
}

if ( is_numeric( $course_price ) ) {
	if ( $currency == 'USD' ) {
		$course_price_formatted = '$' . $course_price;
	} else {
		$course_price_formatted = $currency . ' ' . $course_price;
	}

	if ( $course_price == 0 ) {
		$course_price_formatted = __( 'Free', 'eb-textdomain' );
	}
}

$course_class = null;
$user_id      = get_current_user_id();
$logged_in    = ! empty( $user_id );
$enrollManag  = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance()->enrollmentManager();
$has_access   = $enrollManag->userHasCourseAccess( $user_id, $post->ID );

/*
 * To add class according to user access
 *
 */
if ( $has_access ) {
	$course_class = 'has-access';
	$h_title      = __( sprintf( 'Click to access %s course', get_the_title( get_the_ID() ) ), 'eb-textdomain' );
} else {
	$course_class = 'no-access';
	$h_title      = __( sprintf( 'Click to read more about %s course', get_the_title( get_the_ID() ) ),
		'eb-textdomain' );
}

$course_id = $post_id;
//Shortcode eb_my_courses.


if ( isset( $is_eb_my_courses ) && $is_eb_my_courses && isset( $attr ) ) {
	$courseMang     = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance()->courseManager();
	$mdl_course_id  = $courseMang->getMoodleCourseId( $course_id );
	$moodle_user_id = get_user_meta( get_current_user_id(), 'moodle_user_id', true );

	$product_id = $wpdb->get_results( 'SELECT `product_id`, `moodle_post_id`
			FROM `' . $wpdb->prefix . "woo_moodle_course` WHERE `moodle_post_id` = " . $course_id . ";", 'ARRAY_A' );

	/*******   two way synch  *******/

	if ( $moodle_user_id && isset( $attr["my_courses_progress"] ) && $attr["my_courses_progress"] ) {
		$showProgress          = 1;
		$courseProgressManager = new app\wisdmlabs\edwiserBridge\EbCourseProgress();
		$progressData          = $courseProgressManager->getCourseProgress();
		$courseId              = array_keys( $progressData );

		if ( in_array( get_the_ID(), $courseId ) ) {
			if ( $progressData[ get_the_ID() ] == 0 ) {
				$progressClass  = "start";
				$progressBtnDiv = "<div class='eb-course-action-btn-start'>" . __( "START",
						"eb-textdomain" ) . "</div>";
			} elseif ( $progressData[ get_the_ID() ] > 0 && $progressData[ get_the_ID() ] < 100 ) {
				$progressClass  = "resume";
				$progressWidth  = $progressData[ get_the_ID() ];
				$progressBtnDiv = "<div class='eb-course-action-btn-resume'>" . __( "RESUME",
						"eb-textdomain" ) . "</div>";
			} else {
				$progressClass  = "completed";
				$progressBtnDiv = "<div class='eb-course-action-btn-completed'>" . __( "COMPLETED",
						"eb-textdomain" ) . "</div>";
			}
		}
	}
	/**********************/


	if ( $moodle_user_id != '' && function_exists( "ebsso\generateMoodleUrl" ) ) {
		$query      = array(
			'moodle_user_id'   => $moodle_user_id, //moodle user id
			'moodle_course_id' => $mdl_course_id,
		);
		$course_url = \ebsso\generateMoodleUrl( $query );
	} else {
		$course_url = EB_ACCESS_URL . '/course/view.php?id=' . $mdl_course_id;
	}
} else {
	$is_eb_my_courses = false;
	$course_url       = get_permalink();
}

?>

<a href="<?php echo esc_url( $course_url ); ?>" class="club-courses__item club-course">
	<?php if ( get_the_post_thumbnail_url( $product_id[0]['product_id'] ) ): ?>
        <div class="club-course__logo">
            <img src="<?php echo get_the_post_thumbnail_url( $product_id[0]['product_id'] ); ?>"
                 alt="<?php the_title(); ?>">
        </div>
	<?php endif; ?>
    <div class="club-course__title"><?php the_title(); ?></div>

	<?php if ( get_field( 'course_subtitle', $product_id[0]['product_id'] ) ): ?>
        <div class="club-course__subtitle"><?php the_field( 'course_subtitle', $product_id[0]['product_id'] ); ?></div>
	<?php endif; ?>

    <button class="club-course__btn">Перейти</button>
</a>

