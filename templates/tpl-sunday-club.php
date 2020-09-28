<?php
/**
 * Template Name: Страница "Воскресный клуб"
 * Template Post Type: mak_club
 */

get_header();

do_action( 'view_tvs_page', [ 'sunday-club' ] );

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

				<?php get_sidebar( 'mak' ); ?>

                <section class="article-content">
					<?php get_template_part( 'template-parts/tv-pages/breadcrumbs' ); ?>

                    <div class="online-club__content">

						<?php if ( $post_thumbnail ) { ?>
                            <div class="online-club__background">
                                <img src="<?php echo $post_thumbnail ?>" alt="<?php the_title(); ?>">
                            </div>
						<?php } ?>

                        <h1 class="online-club__title-main"><?php the_title(); ?></h1>

                        <div class="online-club__fullpage">
                            <div class="broadcast sunday-club">
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

									<?php if ( $field_date ): ?>
                                        <div class="broadcast__time-left intro-timer">
                                            ТРАНСЛЯЦИЯ НАЧНЕТСЯ ЧЕРЕЗ:

                                            <span class="intro-timer__text--time timer"
                                                  data-time="<?php echo $field_date; ?> GMT+0200">
                                                <span class="timer__days">0</span>&nbsp;
                                                <span class="timer__hours">0</span>&nbsp;
                                                <span class="timer__minutes">0</span>
                                              </span>
                                        </div>

                                        <div class="online-club__line"></div>
									<?php endif; ?>

									<?php if ( ! empty( get_the_content() ) ): ?>
                                        <div class="broadcast__text">
											<?php the_content(); ?>
                                        </div>
									<?php endif; ?>
                               
                                    <br><br>
                                
                                    <?php
									$recent_videos = get_field( 'mak_archive_webinars' );

									if ( ! empty( $recent_videos ) ):
										?>
                                        <div class="online-club__title">АРХИВ ПРОШЕДШИХ ВЕБИНАРОВ:</div>

                                        <ul class="online---archive online-club__list online-club-list online-club-list--flex">
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
									<?php endif; ?>

                                </div>
                                
                                

                                <div class="broadcast__aside">
                                    <div class="broadcast__label">ЛЕНТА КОММЕНТАРИЕВ</div>

                                    <div class="broadcast__comments">
                                        <div class="comments--youtube">
                                            
                                        </div>
                                        <?php comments_template(); ?>
                                    </div>
                                </div>

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