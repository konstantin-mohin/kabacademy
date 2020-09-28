<?php
/**
 * Template Name: Страница "Курсы академии"
 * Template Post Type: mak_club
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

    <article class="article online-club">
        <div class="container">
            <div class="article__container">
                <aside class="article-sidebar">

					<?php get_sidebar( 'mak-second' ); ?>

                </aside>
                <section class="article-content">

                    <div class="breadcrumbs">
                        <div class="breadcrumbs__item"><a href="#">Главная</a>
                            <div class="breadcrumbs__separate">
                                <svg width="4" height="8" viewBox="0 0 4 8"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none"
                                          stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="breadcrumbs__item"><span>Самообразование</span>
                            <div class="breadcrumbs__separate">
                                <svg width="4" height="8" viewBox="0 0 4 8"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none"
                                          stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="online-club__content">

						<?php if ( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ): ?>
                            <div class="online-club__background">
                                <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>"
                                     alt="<?php the_title(); ?>">
                            </div>
						<?php endif; ?>

						<?php the_title( '<h1 class="online-club__title-main">', '</h1>' ); ?>

						<?php the_content(); ?>

						<?php $courses = get_field( 'mak_courses' ); ?>
						<?php if ( $courses ): ?>
                            <div class="club-courses">

								<?php 
                                    foreach ( $courses as $course ): 
                                        get_template_part( 'edwiserBridge/content', 'eb_club' );
                                    endforeach; 
                                ?>

                            </div>
						<?php endif; ?>

                    </div>
                </section>
            </div>
        </div>
    </article>

<?php endwhile; ?>


<?php get_footer(); ?>