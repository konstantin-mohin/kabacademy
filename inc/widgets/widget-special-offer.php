<?php

class Special_Offer_Widget extends WP_Widget {

	function __construct() {

		parent::__construct(
			'special_offer',
			'(OP) Специальное предложение',
			array( 'description' => 'Блок "Специальное предложение"', /*'classname' => 'my_widget',*/ )
		);

		// if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
		// 	add_action('wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ));
		// 	add_action('wp_head', array( $this, 'add_my_widget_style' ) );
		// }
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$descr = apply_filters( 'widget_descr', $instance['descr'] );
		?>
        <div class="article-sidebar__achievement">
            <div class="article-sidebar__achievement__top">
				<?php if ( get_field( 'widget_image', 'widget_' . $args['widget_id'] ) ): ?>
                    <img src="<?php the_field( 'widget_image', 'widget_' . $args['widget_id'] ) ?>"
                         alt="<?php echo $title; ?>">
				<?php endif; ?>
                <h3 class="article-sidebar__achievement__title">
					<?php echo $title; ?>
                </h3>
            </div>

            <p class="article-sidebar__achievement__text">
				<?php echo $descr; ?>
            </p>

            <button class="btn article-sidebar__achievement__button">оставь заявку</button>
        </div>
		<?php
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Заголовок по умолчанию';
		$descr = @ $instance['descr'] ?: '';

		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'descr' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea id="<?php echo $this->get_field_id( 'descr' ); ?>"
                      name="<?php echo $this->get_field_name( 'descr' ); ?>" rows="7" cols="20"
                      class="widefat text"><?php echo esc_attr( $descr ); ?></textarea>
        </p>
		<?php
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 * @see WP_Widget::update()
	 *
	 */
	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['descr'] = ( ! empty( $new_instance['descr'] ) ) ? strip_tags( $new_instance['descr'] ) : '';

		return $instance;
	}

	/*
	  // скрипт виджета
	  function add_my_widget_scripts() {
		  // фильтр чтобы можно было отключить скрипты
		  if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			  return;

		  $theme_url = get_stylesheet_directory_uri();

		  wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	  } */

	/*
	  // стили виджета
	  function add_my_widget_style() {
		  // фильтр чтобы можно было отключить стили
		  if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			  return;
		  ?>
		  <style type="text/css">
			  .my_widget a{ display:inline; }
		  </style>
		  <?php
	  } */

}

function register_special_offer_widget() {
	register_widget( 'Special_Offer_Widget' );
}

add_action( 'widgets_init', 'register_special_offer_widget' );