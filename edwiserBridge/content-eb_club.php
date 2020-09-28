<?php
/**
 * The template for displaying course archive content.
 */
//Variables
global $post;
global $course;
global $wpdb;
$post_id = $course->ID;

//
$course_options = get_post_meta( $course->ID, 'product_options', true );
$course_class = null;
$user_id      = get_current_user_id();
$logged_in    = ! empty( $user_id );
$enrollManag  = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance()->enrollmentManager();
$has_access   = $enrollManag->userHasCourseAccess( $user_id, $course_options["moodle_post_course_id"][0] );

$course_id = $course_options["moodle_post_course_id"][0];

//Shortcode eb_my_courses.

if ( isset( $has_access ) && $has_access ) {
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
    $course_btn       = 'Перейти';
} else {
	$is_eb_my_courses = false;
	$course_url       = get_permalink($course->ID);
    $course_btn       = 'Записаться';
}
?>



<a href="<?php echo esc_url( $course_url ); ?>" class="club-courses__item club-course">
	<?php if ( get_the_post_thumbnail_url( $course->ID ) ): ?>
        <div class="club-course__logo">
            <img src="<?php echo get_the_post_thumbnail_url( $course->ID ); ?>"
                 alt="<?php echo $course->ID; ?>">
        </div>
	<?php endif; ?>
    <div class="club-course__title"><?php echo $course->post_title; ?></div>

	<?php if ( get_field( 'course_subtitle', $course->ID ) ): ?>
        <div class="club-course__subtitle"><?php the_field( 'course_subtitle', $course->ID ); ?></div>
	<?php endif; ?>

    <button class="club-course__btn"><?php echo $course_btn; ?></button>
</a>

