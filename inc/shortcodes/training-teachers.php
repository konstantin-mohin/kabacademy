<?php
add_shortcode( 'training_teachers', 'training_teachers_shortcode_handler' );

function training_teachers_shortcode_handler( $atts )
{

  $query = new WP_Query( [
    'post_type'      => 'teachers',
    'posts_per_page' => -1,
    'orderby'  => 'date',
    'order'   => 'ASC'
  ] );


  if ( $query->have_posts() ) {

    $html = '<div class="training-page__row">';

    while ( $query->have_posts() ) {

        $query->the_post();

        $html .= '<div class="training-page__item">
                    <div class="training-page__item__media">
                      <img src="' . get_the_post_thumbnail_url( $query->post->ID ) . '" alt="' . $query->post->post_title .'"> </div>
                    <div class="training-page__item__content">
                        <div class="training-page__item__name">' . $query->post->post_title . '</div>
                        <div class="training-page__item__text">' . $query->post->post_content . '</div>
                    </div>
                </div>';

    }

    $html .= '</div>';

    wp_reset_postdata();
}

	return $html;
} ?>