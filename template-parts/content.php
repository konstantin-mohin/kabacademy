<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kabacedemy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="article__container">

			<?php get_sidebar(); ?>

            <section class="article-content">
				<?php the_title( '<h1 class="article-content__top__title">', '</h1>' ); ?>

				<?php //kabacedemy_post_thumbnail(); ?>
                <div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kabacedemy' ),
							'after'  => '</div>',
						)
					);
					?>
                </div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
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
                    </footer><!-- .entry-footer -->
				<?php endif; ?>
            </section>

			<?php kabacedemy_entry_footer(); ?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
