<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kabacedemy
 */

?>

<?php
  $post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
  $gallery_images = get_field( 'events_gallery', get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('events-content__item')); ?>>

  <?php if ( $post_thumbnail ): ?>
    <div class="events-content__item__media">
      <img src="<?= $post_thumbnail ?>" alt="<?php the_title(); ?>">
    </div>
  <?php endif; ?>

  <div class="events-content__item__body">

    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="events-content__item__date"><?php echo get_the_date('j F Y'); ?></time>

    <div class="events-content__item__title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </div>

    <?php if ( get_the_excerpt() ): ?>
      <div class="events-content__item__text">
        <?php the_excerpt(); ?>
      </div>
    <?php endif; ?>

    <?php if ( $gallery_images && $post_thumbnail ): ?>
      <?php echo kabacedemy_show_events_gallery( $post_thumbnail, $gallery_images ); ?>
    <?php endif; ?>

    <?php if ( ! $gallery_images && $post_thumbnail ): ?>
      <a class="about__link link__arrow" href="<?php the_permalink( get_the_ID() ); ?>"> 
        <span>читай далее</span> 
        <svg class="icon__icon-triangle-right" width="10" height="10">
          <use href="svg-symbols.svg#icon-triangle-right"></use>
        </svg> 
      </a>
    <?php endif; ?>

    <?php if ( get_edit_post_link() ) : ?>
        <?php
          edit_post_link(
            sprintf(
              wp_kses(
                __( 'Edit <span class="screen-reader-text">%s</span>', 'kabacedemy' ),
                array(
                  'span' => array(
                    'class' => array(),
                  ),
                )
              ),
              wp_kses_post( get_the_title() )
            ),
            '<span class="edit-link">',
            '</span>'
          );
          ?>
  <?php endif; ?>

  </div>

  <?php if ( $gallery_images && ! $post_thumbnail ): ?>
    <?php echo kabacedemy_show_events_gallery( $post_thumbnail, $gallery_images ); ?>
  <?php endif; ?>

</article>