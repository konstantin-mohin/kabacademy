<section class="webinars">
    <div class="container">
        <div class="basic__top-header">

            <p class="basic__top-header__online">всегда доступны</p>

            <svg class="basic__top-header__icon" width="38" height="36">
                <use href="svg-symbols.svg#icon-youtube2"></use>
            </svg>

            <?php if (get_field('mp_webinars_title', 'option')): ?>
                <h2 class="basic__top-header__title"><?= the_field('mp_webinars_title', 'option'); ?></h2>
            <?php endif; ?>

            <div class="webinars-header__group">

                <?php if (get_field('youtube_link', 'option')): ?>
                    <a href="<?php the_field('youtube_link', 'option'); ?>" class="webinars-header__link btn">
                        <svg class="webinars-header__link__icon" width="29" height="22">
                            <use href="svg-symbols.svg#icon-youtube2"></use>
                        </svg>
                        <span>Академия на youtube</span>
                    </a>
                <?php endif; ?>

                <?php if (get_field('fb_link', 'option')): ?>
                    <a href="<?php the_field('fb_link', 'option'); ?>" class="webinars-header__link btn">
                        <svg class="webinars-header__link__icon" width="25" height="25">
                            <use href="svg-symbols.svg#icon-fb"></use>
                        </svg>
                        <span>Академия на facebook</span>
                    </a>
                <?php endif; ?>

            </div>

        </div>


        <?php $webinars = get_field('mp_webinars_courses', 'option'); ?>
        <div class="webinars-container">

            <div class="webinars-wrapper">
                <div class="webinars-slider__scrollbar slider-scrollbar"></div>

                <?php foreach ($webinars as $webinar): ?>
                    <a href="<?php echo get_permalink($webinar->ID); ?>" class="card__item" target="_blank">
                        <img src="static/img/assets/course/img-1.png" class="card__item__image" alt="">
                        <div class="card__item__title"><?= $webinar->post_title ?></div>
                        <div class="card__item__text"><?= $webinar->post_excerpt ?></div>
                        <!-- 10 уроков, тесты -->
                    </a>
                <?php endforeach; ?>

            </div>


            <a href="" class="card__item card__item--border">
                <div class="card__item__title card__item__title--little">
                    Прошедшие семинары на различные темы не
                    менее интересны:
                </div>
                <?php
                $courses = get_posts([
                  'numberposts' => -1,
                  'post_type' => 'eb_course'
                ]);
                ?>
                <div class="card__item__text card__item__text--other"><?php echo count($courses); ?> видео
                    в&nbsp;архиве
                </div>
            </a>
        </div>

        <div class="webinars-footer__group">

            <?php if (get_field('youtube_link', 'option')): ?>
                <a href="<?php the_field('youtube_link', 'option'); ?>" class="webinars-header__link btn">
                    <svg class="webinars-header__link__icon" width="29" height="22">
                        <use href="svg-symbols.svg#icon-youtube2"></use>
                    </svg>
                    <span>Академия на youtube</span>
                </a>
            <?php endif; ?>

            <?php if (get_field('fb_link', 'option')): ?>
                <a href="<?php the_field('fb_link', 'option'); ?>" class="webinars-header__link btn">
                    <svg class="webinars-header__link__icon" width="25" height="25">
                        <use href="svg-symbols.svg#icon-fb"></use>
                    </svg>
                    <span>Академия на facebook</span>
                </a>
            <?php endif; ?>

        </div>
    </div>
</section>