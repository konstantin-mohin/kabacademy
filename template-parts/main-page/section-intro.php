<?php
$intro_course_left = get_field( 'mp_intro_left_course', 'option' );
$product_mak_frontimg = get_field( 'product_mak_frontimg', $intro_course_left->ID );
?>

<section class="intro front---page">
    
    

	<?php if ( $intro_course_left ) { ?>
        <div class="intro__background">
            <?php if ( $product_mak_frontimg ) { ?>
            <img src="<?php echo $product_mak_frontimg; ?>"
                 alt="<?php echo $intro_course_left->post_title; ?>">
            <?php } else { ?>
            <img src="<?php echo get_the_post_thumbnail_url( $intro_course_left->ID, 'full' ); ?>"
                 alt="<?php echo $intro_course_left->post_title; ?>">
            <?php } ?>
        </div>
	<?php } ?>

    <div class="container">
        <div class="intro__container">
            <div class="intro__left">

                <div class="intro-menu">
                    <a href="#basic" class="intro-menu__link js-link-smooth">
                        <svg class="icon__icon-chart" width="20" height="20">
                            <use href="svg-symbols.svg#icon-chart"></use>
                        </svg>
                        <span>курсы</span>
                    </a>
                    <a href="#online" class="intro-menu__link js-link-smooth">
                        <svg class="icon__icon-comment" width="20" height="20">
                            <use href="svg-symbols.svg#icon-comment"></use>
                        </svg>
                        <span>онлайн клуб</span>
                    </a>
                    <a href="#course" class="intro-menu__link js-link-smooth">
                        <svg class="icon__icon-youtube" width="20" height="20">
                            <use href="svg-symbols.svg#icon-youtube"></use>
                        </svg>
                        <span>самообучение</span>
                    </a>
                </div>

				<?php
				if ( $intro_course_left ) { ?>
                    <div class="intro-base">
						<?php if ( get_field( 'mp_intro_left_course_tape', 'option' ) ) { ?>
                            <div class="intro-base__placeholder">
                                <svg class="icon__icon-stripe" width="325px" height="71px">
                                    <use href="/svg-symbols.svg#icon-stripe"></use>
                                </svg>
								<?php the_field( 'mp_intro_left_course_tape', 'option' ); ?>
                            </div>
						<?php } ?>
                        <h2 class="intro-base__title"><?php echo $intro_course_left->post_title ?></h2>
                    </div>

                    <div class="intro__start">
                        <h3 class="intro__start__title">
							<?php the_field( 'mp_intro_left_course_date_start', 'option' ); ?>
                        </h3>
                        <div class="intro__start__text">
							<?php echo $intro_course_left->post_excerpt; ?>
                        </div>
                        <a class="intro__start__link link__arrow"
                           href="<?php echo esc_url( get_permalink( $intro_course_left->ID ) ); ?>">
                            <span>запишись сейчас</span>
                            <svg class="icon__icon-triangle-right" width="9" height="9">
                                <use href="svg-symbols.svg#icon-triangle-right"></use>
                            </svg>
                        </a>
                    </div>
				<?php } ?>
            </div>
            
            <?php
				$date_webinar  = get_field( 'mp_intro_webinar_start_date', 'option' );
				$webinar_intro = get_field( 'mp_intro_webinar', 'option' );
				$day           = substr( $date_webinar, 8, 2 );
				$month         = kab_help()->helper->get_month_webinar( substr( $date_webinar, 5, 2 ) );
				$time          = substr( $date_webinar, 11, 5 );
				$year          = substr( $date_webinar, 2, 2 );
				?>
           <pre style="display: none;">
               <?php 
                 var_dump($webinar_intro->ID);
               ?>
           </pre>
            <a href="<?php echo get_permalink($webinar_intro->ID); ?>" class="intro__right intro__right--color" style="display: block;">				

                <div class="intro-event">
                    <div class="intro-event__title">Ближайший<br>вебинар</div>
                    <time class="intro-event__time">
                        <span class="intro-event__time__day"><?= $day; ?></span>
                        <span class="intro-event__time__mounth"><?= $month ?></span>
                        <span class="intro-event__time__year">‘<?= $year ?></span>
                    </time>

                    <div class="intro-event__hour"><?= $time; ?> ИЗР
                        <span class="intro-event__hour--other">(<?= $time; ?> МСК)</span>
                    </div>
                </div>

				<?php if ( $webinar_intro ): ?>
                    <div class="intro-slider">
                        <div class="intro-slider__item">
                            <div class="intro-slider__item__title">
								<?= $webinar_intro->post_title; ?>
                            </div>
                            <!-- <div class="intro-slider__item__text">
							  По статье Бааль Сулама "Наука каббала и ее цель"
							</div> -->
                        </div>
                    </div>
				<?php endif; ?>

                <div class="intro-timer">
                    <svg class="intro-timer__icon" width="32" height="32">
                        <use href="svg-symbols.svg#icon-clock"></use>
                    </svg>
                    <div class="intro-timer__text">трансляция начнется через:
                        <span class="intro-timer__text--time timer" data-time="<?= $date_webinar ?> GMT+0200">
                          <span class="timer__days">0 д.</span>&nbsp;
                          <span class="timer__hours">0 ч.</span>&nbsp;
                          <span class="timer__minutes">0 м.</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>