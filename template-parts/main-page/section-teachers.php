<section class="teachers">
    <div class="container">
        <div class="teachers__container">

            <div class="teachers__left">

                <svg class="teachers__logo" width="224" height="47">
                    <use href="svg-symbols.svg#logo-text"></use>
                </svg>

				<?php if ( get_field( 'mp_teachers_img', 'option' ) ): ?>
                    <img src="<?php the_field( 'mp_teachers_img', 'option' ) ?>" alt="Преподователи"
                         class="teachers__image">
				<?php endif; ?>

				<?php if ( get_field( 'mp_teachers_content', 'option' ) ): ?>
					<?php the_field( 'mp_teachers_content', 'option' ); ?>
				<?php endif; ?>

				<?php if ( get_field( 'mp_read_more', 'option' ) ): ?>
                    <a class="teachers__link link__arrow" href="<?php the_field( 'mp_read_more', 'option' ); ?>"
                       target="_blank">
                        <span>Читать полностью</span>
                        <svg class="icon__icon-triangle-right" width="9" height="9">
                            <use href="svg-symbols.svg#icon-triangle-right"></use>
                        </svg>
                    </a>
				<?php endif; ?>

            </div>

            <div class="teachers__right">

				<?php if ( get_field( 'mp_teachers_title', 'option' ) ): ?>
                    <h2 class="teachers__title"><?= the_field( 'mp_teachers_title', 'option' ); ?></h2>
				<?php endif; ?>

				<?php $teachers_list = get_field( 'mp_teachers', 'option' ); ?>

				<?php if ( $teachers_list ): ?>

                    <div class="teachers__row">

						<?php foreach ( $teachers_list as $teacher ): ?>

                            <div class="teachers__item">
                                <div class="teachers__item__media">
                                    <img src="<?php echo get_the_post_thumbnail_url( $teacher->ID, 'full' ); ?>"
                                         alt="<?= $teacher->post_title; ?>">
                                </div>
                                <div class="teachers__item__content">
                                    <div class="teachers__item__name"><?= $teacher->post_title; ?></div>
                                    <div class="teachers__item__text">
										<?= $teacher->post_content; ?>
                                    </div>
                                </div>
                            </div>

						<?php endforeach; ?>

                    </div>

					<?php if ( get_field( 'mp_all_teachers', 'option' ) ): ?>
                        <a class="teachers__link link__arrow" href="<?php the_field( 'mp_all_teachers', 'option' ) ?>"
                           target="_blank">
                            <span>ВСЕ ПРЕПОДАВАТЕЛИ <em>(<?php echo kab_help()->helper->get_count_teachers(); ?>)</em></span>
                            <svg class="icon__icon-triangle-right" width="9" height="9">
                                <use href="svg-symbols.svg#icon-triangle-right"></use>
                            </svg>
                        </a>
					<?php endif; ?>

				<?php endif; ?>

            </div>
        </div>
    </div>
</section>