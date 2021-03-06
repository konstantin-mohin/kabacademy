<?php
/**
 * Template Name: Страница "Zoar TV"
 * Template Post Type: mak_club
 */

get_header();

do_action( 'view_tvs_page', [ 'zoar' ] );

while ( have_posts() ) :
	the_post();

	list( $video_id,
		$field_date,
		$player_type,
		$label,
		$image_preview,
		$post_thumbnail ) = get_tv_page_variables( get_the_ID() );
	?>
    <article class="article online-club">
        <div class="container">
            <div class="article__container">

                <aside class="article-sidebar">
					<?php get_sidebar( 'mak' ); ?>
                </aside>

                <section class="article-content">

					<?php get_template_part( 'template-parts/tv-pages/breadcrumbs' ); ?>

                    <div class="online-club__content">

						<?php if ( $post_thumbnail ) { ?>
                            <div class="online-club__background">
                                <img src="<?php echo $post_thumbnail ?>" alt="<?php the_title(); ?>">
                            </div>
						<?php } ?>

                        <h1 class="online-club__title"><?php the_title(); ?></h1>

                        <div class="online-club__fullpage">
                            <div class="broadcast zoar-tv">
                                <div class="broadcast__main">
									<?php
									if ( ! empty( $label ) && $label['value'] !== 'none' ) { ?>
                                        <div class="broadcast__label <?php echo ( $label['value'] === 'now' ) ? 'is-active' : '' ?>"><?php echo $label['label'] ?></div>
									<?php } ?>

                                    <div id="player" class="broadcast__video broadcast-video"
                                         data-video="<?php echo $video_id; ?>">

										<?php if ( $image_preview ): ?>
                                            <div class="broadcast-video__bg">
                                                <img src="<?php echo $image_preview ?>" alt="<?php the_title(); ?>">
                                            </div>
										<?php endif; ?>

                                    </div>                                    
                                    <div class="broadcast__text">
                                        <?php the_content(); ?>
                                        <div class="broadcast__label no---scroll">ЛЕНТА КОММЕНТАРИЕВ</div>
                                        <div class="broadcast__comments no---scroll">
                                            <div class="broadcast__comments comments--youtube">
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<?php $recent_videos = get_field( 'mak_archive_webinars' );
								if ( ! empty( $recent_videos ) ): ?>
                                    <div class="broadcast__aside">
                                        <div class="online-club__title">ПОПУЛЯРНЫЕ ПЕРЕДАЧИ ZOAR.TV</div>

                                        <ul class="online---archive online-club__list online-club-list">
											<?php foreach ( $recent_videos as $video ): ?>
												<?php $video_info = getYoutubeVideoInfo( $video['mak_archive_webinar_id'] ); ?>

                                                <li class="online-club-list__item">
                                                    <svg class="icon__icon-broadcast" width="23" height="22">
                                                        <use href="/svg-symbols.svg#icon-broadcast"></use>
                                                    </svg>
                                                    <a href="#"
                                                       data-video="<?php echo $video['mak_archive_webinar_id']; ?>"><?php echo $video_info->snippet->title; ?></a>
                                                    <!--<span>(4:21)</span>-->
                                                </li>
											<?php endforeach; ?>
                                        </ul>                                        
                                    </div>
								<?php endif; ?>
                            
                                    

                            </div>
                            
                            </div>
                    </div>
                </section>
            </div>
        </div>
    </article>

<?php endwhile; ?>

<?php get_script_tv_page( $player_type ); ?>

<?php get_footer(); ?>