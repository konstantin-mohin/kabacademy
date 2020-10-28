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
    if( ! ( end($request) == 'my-account' && is_account_page() ) ) { 
    $post_slug = str_replace('/', '-', $_SERVER['REQUEST_URI']);
?>

<article id="post<?php echo $post_slug; ?>id" <?php post_class( array( 'article' ) ); ?>> 
  
<?php } else { ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'article' ) ); ?>>

<?php } ?>
    <div class="container">
        <div class="article__container">

			<?php get_sidebar(); ?>
            
            <section class="article-content <?php if( ! ( end($request) == 'my-account' && is_account_page() ) ){ echo 'test'; } ?>">

                <div class="article-content__top">
					<?php the_title( '<h1 class="article-content__top__title">', '</h1>' ); ?>
                    <!-- <p class="article-content__top__subtitle">материалы для желающих самостоятельно развивать знания о каббале</p> -->
                </div>

				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kabacedemy' ),
						'after'  => '</div>',
					)
				);
				?>

				<?php if ( get_edit_post_link() ) { ?>
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
				<?php } ?>
            </section>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
