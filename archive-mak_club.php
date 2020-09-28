<?php get_header(); ?>

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

                <div class="online-club__content">

                    <!--                <h1 class="online-club__title-main">-->
					<?php //the_archive_title(); ?><!--</h1>-->
                    <h1 class="online-club__title-main">Все отделы клуба</h1>

					<?php $pages = get_field( 'mak_pages', 'option' ); ?>

					<?php if ( ! empty( $pages ) ): ?>
                        <div class="club-departments">
							<?php foreach ( $pages as $page ): ?>

                                <div class="club-departments__item club-department">
                                    <div class="club-department__content">

										<?php if ( $page['mak_pages_img'] ): ?>
                                            <a href="<?php the_permalink( $page['mak_pages_page'] ); ?>"
                                               class="club-department__logo">
                                                <img src="<?php echo $page['mak_pages_img']; ?>"
                                                     alt="<?php echo get_the_title( $page['mak_pages_page'] ); ?>">
                                            </a>
										<?php endif; ?>

                                        <div class="club-department__main">
                                            <a href="<?php the_permalink( $page['mak_pages_page'] ); ?>"
                                               class="club-department__title"><?php echo get_the_title( $page['mak_pages_page'] ); ?></a>

											<?php if ( $page['mak_pages_descr'] ): ?>
                                                <div class="club-department__text">
													<?php echo $page['mak_pages_descr']; ?>
                                                </div>
											<?php endif; ?>
                                        </div>

                                        <!-- mak_pages_show_sidebar -->
                                        <div class="club-department__aside">											
                                           <?php
											switch ( $page['mak_pages_show_sidebar'] ) {
												case 'video':
													echo showVideoMakClub( $page['mak_pages_page'],
														$page['mak_pages_show_line'] );
													break;
												case 'gallery':
													echo showGalleryMakClub( $page['mak_pages_page'] );
													break;
												case 'forum':
                                                    echo showForumMakClub( $page['mak_pages_page'] );
													break;
                                            }
											?>
                                        </div>

                                    </div>
                                </div><!-- /.club-department -->

							<?php endforeach; ?>
                       
                           
                        </div>
					<?php endif; ?>

                </div>
            </section>
        </div>
    </div>
</article>


<?php get_footer(); ?>
