<?php
add_shortcode( 'op_events_gallery', 'op_events_gallery_shortcode_handler' );

function op_events_gallery_shortcode_handler( $atts )
{

  if ( empty( get_field( 'events_gallery' ) ) ) {
    return;
  }

  $gallery_images = get_field( 'events_gallery' );

  $html = '<div class="article-content__gallery">';
  $html .= '<div class="article-content__gallery__row">';

  foreach ( $gallery_images as $key => $image ) {

    $first_image = ( $key === 0 ) ? 'article-content__gallery__item--big' : '' ; 
    
    $html .= '<a class="article-content__gallery__item '. $first_image .'" href="' . $image . '" data-fancybox="article-gallery-' . get_the_ID() . '">';
    $html .= '<img src="' . $image . '" alt="' . get_the_title() .'">';
    $html .= '</a>';

  }
  
  $html .= '</div>';
  $html .= '<div class="article-content__gallery__scrollbar slider-scrollbar"></div>';
  $html .= '<a class="article-content__gallery__link link__arrow" 
        href="' . get_permalink( get_the_ID() ) . '">
        <span>
          ВСЕ фотографии <em>('. count( $gallery_images ) .')</em>
        </span> 
        <svg class="icon__icon-triangle-right" width="9" height="9">
          <use href="svg-symbols.svg#icon-triangle-right"></use>
        </svg>
    </a>
  </div>';

  return $html;
} ?>