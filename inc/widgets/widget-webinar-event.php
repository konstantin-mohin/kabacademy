<?php

class Webinar_Event_Widget extends WP_Widget {

	/**
	 * Sets up a new Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => 'Дата события в сайдбаре',
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'kabacademy_webinar_event', '(OP) Дата события в сайдбаре', $widget_ops );
	}

	/**
	 * Outputs the content for the current Navigation Menu widget instance.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 *
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		$date_webinar  = get_field( 'mp_intro_webinar_start_date', 'option' );
		$webinar_intro = get_field( 'mp_intro_webinar', 'option' );
		$day           = substr( $date_webinar, 8, 2 );
		$month         = kab_help()->helper->get_month_webinar( substr( $date_webinar, 5, 2 ) );
		$time          = substr( $date_webinar, 11, 5 );
		$year          = substr( $date_webinar, 2, 2 );
		?>

		<?php if ( $date_webinar ): ?>
            <div class="article-sidebar__event">
                <div class="article-sidebar__event__top">
                    <div class="article-sidebar__event__title"><?php echo $title; ?></div>
                    <time class="article-sidebar__event__time">
                        <span class="article-sidebar__event__time__day"><?= $day ?></span>
                        <span class="article-sidebar__event__time__mounth"><?= $month ?></span>
                        <span class="article-sidebar__event__time__year">‘<?= $year ?></span>
                    </time>
                    <div class="article-sidebar__event__hour"><?= $time; ?> ИЗР
                        <span class="article-sidebar__event__hour--other">(<?= $time; ?> МСК)</span>
                    </div>
                    <span class="article-sidebar__event__icon">
					<svg class="icon__icon-arrow-right-big"
                         width="21" height="22">
						<use href="/svg-symbols.svg#icon-arrow-right-big"></use>
					</svg>
				</span>
                </div>
				<?php if ( $webinar_intro ): ?>
                    <div class="article-sidebar__event__body">
                        <p><?= $webinar_intro->post_title; ?></p>
                        <a href="<?php echo get_permalink( $webinar_intro->ID ); ?>"
                           class="link__arrow article-sidebar__event__body__link">
                            <span>подробнее</span>
                            <svg class="icon__icon-triangle-right" width="10" height="10">
                                <use href="/svg-symbols.svg#icon-triangle-right"></use>
                            </svg>
                        </a>
                    </div>
				<?php endif; ?>
            </div>
		<?php endif; ?>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Navigation Menu widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 * @since 3.0.0
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Outputs the settings form for the Navigation Menu widget.
	 *
	 * @param array $instance Current settings.
	 *
	 * @since 3.0.0
	 *
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		$title = @ $instance['title'] ?: 'Заголовок по умолчанию';

		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>">
        </p>

		<?php
	}

}

function register_webinar_event_widget() {
	register_widget( 'Webinar_Event_Widget' );
}

add_action( 'widgets_init', 'register_webinar_event_widget' );