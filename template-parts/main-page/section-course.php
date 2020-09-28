<section class="course" id="course">
    <div class="container">
        <div class="basic__top-header">
            <p class="basic__top-header__online">всегда доступны</p>

			<?php if ( get_field( 'mp_courses_title', 'option' ) ): ?>
                <h2 class="basic__top-header__title">
                    <svg class="basic__top-header__icon" width="38" height="36">
                        <use href="svg-symbols.svg#icon-youtube2"></use>
                    </svg>
					<?php the_field( 'mp_courses_title', 'option' ); ?>
                </h2>
			<?php endif; ?>

			<?php if ( get_field( 'mp_courses_subtitle', 'option' ) ): ?>
                <p class="basic__top-header__text">
					<?php the_field( 'mp_courses_subtitle', 'option' ); ?>
                </p>
			<?php endif; ?>
        </div>

		<?php $courses_list = get_field( 'mp_courses_items', 'option' ); ?>


		<?php /*if ( $courses_list ): ?>
            <div class="course__slider js-slider" id="course-slider" data-show-slides="3"
                 data-scrollbar="slider-scrollbar">

				<?php foreach ( $courses_list as $item ) {
					$product = wc_get_product( $item->ID );
					?>

                    <a href="<?php the_permalink( $item->ID ); ?>" class="card__item slider__item swiper-slide">

						<?php if ( get_the_post_thumbnail_url( $item->ID, 'medium' ) ): ?>
                            <img src="<?php echo get_the_post_thumbnail_url( $item->ID, 'medium' ); ?>"
                                 class="card__item__image" alt="<?= $item->post_title; ?>">
						<?php endif; ?>

                        <div class="card__item__title"><?= $item->post_title; ?></div>

						<?php if ( get_field( 'course_subtitle', $item->ID ) ) { ?>
                            <div class="card__item__text"><?php the_field( 'course_subtitle', $item->ID ); ?></div>
						<?php } ?>

						<?php if ( ! empty( $product->get_price() ) ) { ?>
                            <div class="card__item__price">
                                <strong><?php echo get_woocommerce_currency_symbol(); ?><?php echo $product->get_price(); ?></strong>
                            </div>
						<?php } ?>

                    </a>
				<?php } ?>

                <div class="course__slider__scrollbar slider-scrollbar"></div>
            </div>
		<?php endif; */ ?>

		<?php if ( $courses_list ): ?>
            <div class="course__slider js-slider club-courses" id="course-slider" data-show-slides="3"
                 data-scrollbar="slider-scrollbar">

				<?php foreach ( $courses_list as $item ) {
					$product = wc_get_product( $item->ID );
					?>

                    <a href="<?php the_permalink( $item->ID ); ?>" class="swiper-slide club-courses__item club-course card__item">
						<?php if ( get_the_post_thumbnail_url( $item->ID, 'medium_large' ) ): ?>
                            <div class="club-course__logo">
                                <img src="<?php echo get_the_post_thumbnail_url( $item->ID, 'medium_large' ); ?>"
                                     alt="<?= $item->post_title; ?>">
                            </div>
						<?php endif; ?>
                        <div class="club-course__title"><?= $item->post_title; ?></div>

						<?php if ( get_field( 'course_subtitle', $item->ID ) ) { ?>
                            <div class="club-course__subtitle"><?php the_field( 'course_subtitle', $item->ID ); ?></div>
						<?php } ?>

						<?php if ( ! empty( $product->get_price() ) ) { ?>
                            <div class="card__item__price">
                                <strong><?php echo get_woocommerce_currency_symbol(); ?><?php echo $product->get_price(); ?></strong>
                            </div>
						<?php } ?>
                    </a>

				<?php } ?>

                <div class="course__slider__scrollbar slider-scrollbar"></div>
            </div>
		<?php endif; ?>

    </div>
</section>

