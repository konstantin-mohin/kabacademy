<?php

class Image_Sidebar_Widget extends WP_Widget {

	function __construct() {
		// Запускаем родительский класс
		parent::__construct(
			'sidebar_image',
			'(OP) Изображение в сайдбаре',
			array( 'description' => 'Изображение в сайдбаре' )
		);

		// стили скрипты виджета, только если он активен
//		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
//			add_action( 'wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ) );
//			add_action( 'wp_head', array( $this, 'add_my_widget_style' ) );
//		}
	}

	// Вывод виджета
	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

//		if ( $title ) {
//			echo $args['before_title'] . $title . $args['after_title'];
//		}
		if ( get_field( 'widget_image_sidebar', 'widget_' . $args['widget_id'] ) ) {
		?>

        <div class="article-sidebar__top__bg">
            <img src="<?php echo get_field( 'widget_image_sidebar', 'widget_' . $args['widget_id'] ); ?>" alt="<?php echo $title; ?>">
        </div>

		<?php
		}

		echo $args['after_widget'];
	}

	// Сохранение настроек виджета (очистка)
	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	// html форма настроек виджета в Админ-панели
	function form( $instance ) {
		$title = @ $instance['title'] ?: '';
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:' ); ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>">
        </p>
		<?php
	}
}

// Регистрация класса виджета
add_action( 'widgets_init', 'my_register_widgets' );

function my_register_widgets() {
	register_widget( 'Image_Sidebar_Widget' );
}