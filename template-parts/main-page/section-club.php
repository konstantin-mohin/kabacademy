<section id="online" class="basic-clubs">
    <div class="container">
        <div class="basic__top-header">
            <p class="basic__top-header__online">Твое духовное окружение</p>
            <h2 class="basic__top-header__title">
                <svg class="basic__top-header__icon" width="38" height="36">
                    <use href="/svg-symbols.svg#icon-comment"></use>
                </svg>
				<?php the_field( 'mp_mak_title', 'option' ); ?>
            </h2>
            <p class="basic__top-header__text">
				<?php the_field( 'mp_mak_subtitle', 'option' ); ?>
            </p>
        </div>
		<?php $pages = get_field( 'mak_pages', 'option' ); ?>

		<?php if ( ! empty( $pages ) ) { ?>
        <div class="basic-clubs__content">

			<?php
			$newArrs = array_chunk( $pages, 3 );
			foreach ( $newArrs

			as $item_pages ) { ?>
            <div class="basic-clubs__list">
				<?php foreach ( $item_pages as $key => $page ) { ?>
				<?php if ( is_user_in_club() ): ?>
                <a href="<?php the_permalink( $page['mak_pages_page'] ); ?>" class="basic-clubs__item basic-club">
					<?php else: ?>
                    <div class="basic-clubs__item basic-club">
						<?php endif; ?>

						<?php if ( $page['mak_pages_img'] ) { ?>
                            <div class="basic-club__logo">
                                <img src="<?php echo $page['mak_pages_img']; ?>"
                                     alt="<?php echo get_the_title( $page['mak_pages_page'] ); ?>">
                            </div>
						<?php } ?>
                        <div class="basic-club__content">
                            <div class="basic-club__title"><?php echo get_the_title( $page['mak_pages_page'] ); ?></div>
							<?php if ( $page['mak_pages_descr_main_page'] ) { ?>
                                <div class="basic-club__text"><?php echo $page['mak_pages_descr_main_page']; ?></div>
							<?php } ?>
                        </div>
						<?php if ( is_user_in_club() ): ?>
                </a>
				<?php else: ?>
            </div>
		<?php endif; ?>
		<?php } ?>
        </div>

	<?php } ?>

		<?php
		$order_btn = get_field( 'mp_mak_btn', 'option' );
		if ( ! empty( $order_btn ) ) {
			?>
            <a href="<?php echo $order_btn['link']; ?>"
               class="btn basic-clubs__btn"><?php echo $order_btn['text']; ?></a>
		<?php } ?>
    </div>
	<?php } ?>
    </div>
</section>