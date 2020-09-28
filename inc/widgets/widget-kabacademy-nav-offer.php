<?php

class Kabacademy_Nav_Widget extends WP_Widget {

	/**
	 * Sets up a new Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		parent::__construct(
			'kabacademy_nav_menu',
			'(OP) Навигация в сайдбаре',
			array(
				'description'                 => 'Навигация в сайдбаре',
				'customize_selective_refresh' => true,
			)
		);

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
		// Get menu.
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		$css_class = ! empty( $instance['css_class'] ) ? $instance['css_class'] : '';

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];

		$nav_menu_args = array(
			'fallback_cb'     => '',
			'menu'            => $nav_menu,
			'container'       => 'div',
			'container_class' => 'article-sidebar__top__list',
			'echo'            => true,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		);
		?>

        <div class="article-sidebar__top <?php echo $css_class; ?>">
            <?php if ( get_field( 'widget_image_sidebar', 'widget_' . $args['widget_id'] ) ): ?>
                <div class="article-sidebar__top__bg">
                    <img src="<?php echo get_field( 'widget_image_sidebar', 'widget_' . $args['widget_id'] ); ?>" alt="<?php echo $title; ?>">
                </div>
            <?php endif; ?>

            <div class="article-sidebar__top__title">
                <span><?php echo $title; ?></span>
                <i class="article-sidebar__top__title__icon">
                    <svg class="icon__icon-arrow-right" width="10" height="17">
                        <use href="/svg-symbols.svg#icon-arrow-right"></use>
                    </svg>
                </i>
            </div>

			<?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args,
				$instance ) ); ?>

        </div>

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
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['css_class'] ) ) {
			$instance['css_class'] = sanitize_text_field( $new_instance['css_class'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}

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
		global $wp_customize;
		$title     = isset( $instance['title'] ) ? $instance['title'] : '';
		$css_class = isset( $instance['css_class'] ) ? $instance['css_class'] : '';
		$nav_menu  = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus.
		$menus = wp_get_nav_menus();

		$empty_menus_style     = '';
		$not_empty_menus_style = '';
		if ( empty( $menus ) ) {
			$empty_menus_style = ' style="display:none" ';
		} else {
			$not_empty_menus_style = ' style="display:none" ';
		}

		$nav_menu_style = '';
		if ( ! $nav_menu ) {
			$nav_menu_style = 'display: none;';
		}

		// If no menus exists, direct the user to go and create some.
		?>
        <p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}

			/* translators: %s: URL to create a new menu. */
			printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) );
			?>
        </p>
        <div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>"
                       value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'css_class' ); ?>"><?php _e( 'Css class:' ); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'css_class' ); ?>"
                       name="<?php echo $this->get_field_name( 'css_class' ); ?>"
                       value="<?php echo esc_attr( $css_class ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>"
                        name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu,
							$menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
                        </option>
					<?php endforeach; ?>
                </select>
            </p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
                <p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
                    <button type="button" class="button"><?php _e( 'Edit Menu' ); ?></button>
                </p>
			<?php endif; ?>
        </div>
		<?php
	}

}

function register_kabacedemy_nav_widget() {
	register_widget( 'Kabacademy_Nav_Widget' );
}

add_action( 'widgets_init', 'register_kabacedemy_nav_widget' );