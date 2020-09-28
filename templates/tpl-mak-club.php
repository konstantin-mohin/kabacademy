<?php
/**
 * Template Name: Страница "ТВ"
 * Template Post Type: mak_club
 */

get_header();

do_action( 'view_tvs_page', [ 'mak-tv' ] );

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

					<?php get_sidebar( 'mak-second' ); ?>

                </aside>
                <section class="article-content">

					<?php get_template_part( 'template-parts/tv-pages/breadcrumbs' ); ?>

                    <div class="online-club__content">
						<?php if ( $post_thumbnail ) { ?>
                            <div class="online-club__background">
                                <img src="<?php echo $post_thumbnail ?>" alt="<?php the_title(); ?>">
                            </div>
						<?php } ?>
                        <h1 class="online-club__title-main"><?php the_title(); ?></h1>

                        <div class="broadcast mak-tv">

							<?php
							if ( ! empty( $label ) && $label['value'] !== 'none' ) { ?>
                                <div class="broadcast__label <?php echo ( $label['value'] === 'now' ) ? 'is-active' : '' ?>">
									<?php echo $label['label'] ?>
                                </div>
							<?php } ?>

                            <div id="player" class="broadcast__video broadcast-video"
                                 data-video="<?php echo $video_id; ?>">

								<?php if ( $image_preview ): ?>
                                    <div class="broadcast-video__bg">
                                        <img src="<?php echo $image_preview ?>" alt="<?php the_title(); ?>">
                                    </div>
								<?php endif; ?>

                                <!--                                <div class="broadcast-video__content">-->
                                <!--									--><?php //if ( get_field( 'mak_img_logo' ) ):
								?>
                                <!--                                        <div class="broadcast-video__logo">-->
                                <!--                                            <img src="-->
								<?php //the_field( 'mak_img_logo' );
								?><!--"-->
                                <!--                                                 alt="--><?php //the_title();
								?><!--">-->
                                <!--                                        </div>-->
                                <!--									--><?php //endif;
								?>
                                <!---->
                                <!--									--><?php //if ( get_field( 'mak_id_video' ) ):
								?>
                                <!--                                        <a href="#" class="broadcast-video__start">-->
                                <!--                                            <svg class="icon__icon-broadcast-start"-->
                                <!--                                                 width="38" height="37">-->
                                <!--                                                <use href="/svg-symbols.svg#icon-broadcast-start"></use>-->
                                <!--                                            </svg>-->
                                <!--                                            ЗАПУСТИТЬ ТРАНСЛЯЦИЮ-->
                                <!--                                        </a>-->
                                <!--									--><?php //endif;
								?>
                                <!---->
                                <!--                                </div>-->

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
                            
                            <br><br><br>

                            <div class="broadcast__label">ЛЕНТА КОММЕНТАРИЕВ</div>
                            <div class="broadcast__comments">
                                <div class="comments--youtube">
                                            
                                </div>
                                <?php comments_template(); ?>
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