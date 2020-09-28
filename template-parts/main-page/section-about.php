<section class="about">
    <div class="container">
        <div class="about__content">
            <div class="about__social">

				<?php if ( get_field( 'youtube_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'youtube_link', 'option' ) ); ?>"
                       class="about__social-link popuper popuper--left" data-popuper="Академия каббалы: Ютуб">
                        <svg class="icon__icon-youtube2" width="23" height="18">
                            <use href="svg-symbols.svg#icon-youtube2"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'vk_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'vk_link', 'option' ) ); ?>"
                       class="about__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Вконтакте">
                        <svg class="icon__icon-vk" width="24" height="16">
                            <use href="svg-symbols.svg#icon-vk"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'fb_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'fb_link', 'option' ) ); ?>"
                       class="about__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Фейсбук">
                        <svg class="icon__icon-fb" width="20" height="20">
                            <use href="svg-symbols.svg#icon-fb"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'whatsapp_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'whatsapp_link', 'option' ) ); ?>"
                       class="about__social-link popuper popuper--left" data-popuper="Академия каббалы: Ватсап">
                        <svg class="icon__icon-whatsapp" width="22" height="22">
                            <use href="svg-symbols.svg#icon-whatsapp"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'telegram_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'telegram_link', 'option' ) ); ?>"
                       class="about__social-link popuper popuper--left" data-popuper="Академия каббалы: Телеграм">
                        <svg class="icon__icon-telegram" width="23" height="20">
                            <use href="svg-symbols.svg#icon-telegram"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'instagram_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'instagram_link', 'option' ) ); ?>"
                       class="about__social-link popuper popuper--left" data-popuper="Академия каббалы: Инстаграм">
                        <svg class="icon__icon-instagram" width="21" height="20">
                            <use href="svg-symbols.svg#icon-instagram"></use>
                        </svg>
                    </a>
				<?php } ?>
            </div>

            <div class="about__content-body">

				<?php if ( get_field( 'mp_about_title', 'option' ) ) { ?>
                    <h2 class="about__title"><?php the_field( 'mp_about_title', 'option' ); ?></h2>
				<?php } ?>


				<?php if ( get_field( 'mp_about_descr', 'option' ) ) { ?>
                    <div class="about__text">
						<?php the_field( 'mp_about_descr', 'option' ); ?>
                    </div>
				<?php } ?>

				<?php if ( get_field( 'mp_about_more', 'option' ) ) { ?>
                    <a class="about__link link__arrow"
                       href="<?php echo esc_url( get_field( 'mp_about_more', 'option' ) ); ?>">
                        <span>читай далее</span>
                        <svg class="icon__icon-triangle-right" width="10" height="10">
                            <use href="svg-symbols.svg#icon-triangle-right"></use>
                        </svg>
                    </a>
				<?php } ?>
            </div>


        </div>
    </div>
</section>