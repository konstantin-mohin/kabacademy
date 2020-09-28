<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kabacedemy
 */

get_header();
?>

    <article class="article">
        <div class="container">
            <div class="article__container">

				<?php get_sidebar(); ?>

                <section class="article-content">
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__item">
                            <a href="#">Главная</a>
                            <div class="breadcrumbs__separate">
                                <svg width="4" height="8" viewBox="0 0 4 8"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none" stroke="currentColor"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="breadcrumbs__item"><span>Самообразование</span>
                            <div class="breadcrumbs__separate">
                                <svg width="4" height="8" viewBox="0 0 4 8"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none" stroke="currentColor"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="events-content">
						<?php the_archive_title( '<h1 class="events-content__title">', '</h1>' ); ?>

						<?php if ( have_posts() ) : ?>
                            <div class="events-content__row">
							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							$args = array(
								'show_all'           => false,
								'end_size'           => 1,
								'mid_size'           => 1,
								'prev_next'          => false,
								'add_args'           => false,
								'add_fragment'       => '',
								'screen_reader_text' => __( 'Posts navigation' ),
							);

							the_posts_pagination( $args );

						else :

							get_template_part( 'template-parts/content', 'none' ); ?>

                            </div>
						<?php endif; ?>
                    </div>
                </section>

            </div>
        </div>
    </article>
<?php
get_footer();
