<section class="basic" id="basic">
    <div class="container">

        <div class="basic__top-header">
            <p class="basic__top-header__online">для начинающих</p>

			<?php if ( get_field( 'mp_basic_title', 'option' ) ) { ?>
                <h2 class="basic__top-header__title">
                    <svg class="basic__top-header__icon" width="38" height="36">
                        <use href="/svg-symbols.svg#icon-chart"></use>
                    </svg>
					<?php the_field( 'mp_basic_title', 'option' ); ?>
                </h2>
			<?php } ?>

			<?php if ( get_field( 'mp_basic_date', 'option' ) ) { ?>
                <div class="basic__top-event">
                    <svg class="basic__top-event__icon" width="47" height="47">
                        <use href="/svg-symbols.svg#icon-calendar"></use>
                    </svg>
                    <div class="basic__top-event__item">
                        <p class="basic__top-event__text">Начало ближайшей серии лекций:</p>
                        <p class="basic__top-event__date"><?php the_field( 'mp_basic_date', 'option' ); ?></p>
                    </div>
                </div>
			<?php } ?>
        </div>

		<?php $products = get_field( 'mp_basic_products_repeater', 'option' );
		if ( ! empty( $products ) ) { ?>
            <div class="basic__container">

                <div class="basic__slider js-slider">

					<?php foreach ( $products as $key => $item ): ?>
                        <a href="<?php echo esc_url( get_permalink( $item['mp_basic_products_item']->ID ) ); ?>"
                           class="swiper-slide basic__card basic-card">
							<?php if ( $item['mp_basic_products_duration'] ) { ?>
                                <div class="basic-card__time">
									<?php echo $item['mp_basic_products_duration']; ?>мес
                                </div>
							<?php } ?>
                            <div class="basic-card__inner">

								<?php
								$product_image = $item['mp_basic_products_image']['sizes']['medium_large'];

								if ( ! $product_image ) {
									$product_image = get_the_post_thumbnail_url( $item['mp_basic_products_item']->ID,
										'full' );
								}

								if ( $product_image ) { ?>
                                    <img src="<?php echo $product_image; ?>"
                                         class="basic-card__image"
                                         alt="<?= $item['mp_basic_products_item']->post_title; ?>">
								<?php } ?>

                                <div class="basic-card__arrow">
                                    <svg class="basic-card__arrow__icon" width="15" height="15">
                                        <use href="/svg-symbols.svg#icon-arrow-right-big"></use>
                                    </svg>
                                </div>

                                <p class="basic-card__title"><?php echo $item['mp_basic_products_title']; ?><br>
                                    <b class="basic-card__title--big"><?php echo $item['mp_basic_products_subtitle']; ?> </b>
                                </p>

								<?php if ( ! empty( $item['mp_basic_products_item']->post_excerpt ) ) { ?>
                                    <div class="basic-card__text">
										<?php echo $item['mp_basic_products_item']->post_excerpt; ?>
                                    </div>
								<?php } ?>


								<?php if ( $item['mp_basic_products_date'] ) { ?>
                                    <p class="basic-card__start"> Начало курса:
                                        <span><?php echo $item['mp_basic_products_date']; ?></span></p>
								<?php } ?>
                            </div>
                        </a>
					<?php endforeach; ?>

                </div>
            </div>
		<?php } ?>

        <div class="basic__bottom">
            <div class="basic__price basic-price">
				<?php
				$products_btns = get_field( 'mp_basic_products_btns', 'option' );

				if ( ! empty( $products_btns ) ) {
					foreach ( $products_btns as $btn ) { ?>
                        <div class="basic-price__item">
                            <div class="basic-price__title"><?php echo $btn['title']; ?></div>
                            <a href="<?php echo $btn['link']; ?>"
                               class="btn basic-price__button"> <?php echo $btn['text']; ?>
                                <span class="basic-price__sale"> <?php echo $btn['discount']; ?>
                              <svg class="icon__icon-hexagon" width="48" height="55">
                                  <path d="M24 0L48 13.75V41.25L24 55L0 41.25V13.75L24 0Z" fill="currentColor"/>
                              </svg>
                            </span>
                            </a>
                        </div>
					<?php }
				} ?>
            </div>

			<?php if ( get_field( 'mp_basic_content', 'option' ) ) { ?>
                <div class="basic__bottom__text"><?php the_field( 'mp_basic_content', 'option' ); ?></div>
			<?php } ?>

        </div>

		<?php
		$price_table = get_field( 'mp_basic_table', 'option' );
		if ( isset( $price_table ) && ! empty( $price_table ) ) { ?>
            <div class="table-responsive basic__table table--hidden" id="sales-table">
                <table class="table table-blue">
					<?php if ( ! empty( $price_table['header'] ) ) { ?>
                        <thead>
                        <tr>
							<?php foreach ( $price_table['header'] as $item ) { ?>
                                <th scope="col"><span><?php echo $item['c']; ?></span></th>
							<?php } ?>
                        </tr>
                        </thead>
					<?php } ?>

					<?php if ( ! empty( $price_table['body'] ) ) { ?>
                        <tbody>
						<?php foreach ( $price_table['body'] as $row ) { ?>
                            <tr>
								<?php foreach ( $row as $item ) { ?>
                                    <td><?php echo $item['c']; ?></td>
								<?php } ?>
                            </tr>
						<?php } ?>
                        </tbody>
					<?php } ?>
                </table>
            </div>
		<?php }
		?>
    </div>
</section>