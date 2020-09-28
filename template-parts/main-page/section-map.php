<section class="map" id="map">
    <div class="container">
        <div class="map-wrapper">
			<?php if ( get_field( 'mp_block_map_title', 'option' ) ) { ?>
                <h3 class="map-wrapper__title"><?php the_field( 'mp_block_map_title', 'option' ); ?></h3>
			<?php } ?>

			<?php if ( get_field( 'mp_block_map_descr', 'option' ) ) { ?>
                <p class="map-wrapper__text">
					<?php the_field( 'mp_block_map_descr', 'option' ); ?>
                </p>
                <img src="static/img/assets/map/man.png" alt="Мужик" class="map__man">
			<?php } ?>
        </div>
    </div>
</section>

<div class="sites">
    <div class="container">
        <div class="sites__container">


            <div class="sites__content">
                <p>
                    <b>Уже определился?</b> выбери <br>ближайший город и начни обучение</p>
                <button class="btn sites__content__button" type="button">оставить заявку</button>
            </div>


			<?php $addresses = get_field( 'mp_block_map_contacts', 'option' ); ?>

			<?php if ( get_field( 'mp_block_map_contacts', 'option' ) ): ?>
                <div class="sites__slider">

                    <div class="js-slider slider--fourth"
                         id="sites-slider"
                         data-show-slides="3"
                         data-arrows="sites__slider__button"
                         data-scrollbar="slider-scrollbar">

						<?php foreach ( $addresses as $address ): ?>

                            <div class="sites__item slider__item swiper-slide">
                                <div class="sites__item-top">
                                    <img src="static/img/assets/sites/image-1.jpg" class="sites__item__image" alt="">
                                    <p class="sites__item__title"><?= $address->post_title; ?></p>
                                </div>
                                <div class="sites__item__content">

									<?php $phones = get_field( 'ta_phones', $address->ID ); ?>

									<?php if ( ! empty( $phones ) ): ?>
										<?php foreach ( $phones as $phone ): ?>
                                            <a href="tel:<?php echo kab_help()->helper->clean_tel_number( $phone['ta_phones_item'] ); ?>"
                                               class="sites__slider__link">тел.: <?php echo $phone['ta_phones_item'] ?></a>
										<?php endforeach; ?>
									<?php endif; ?>

									<?php if ( get_field( 'tp_email', $address->ID ) ): ?>
                                        <a href="mailto:<?php the_field( 'tp_email', $address->ID ); ?>"
                                           class="sites__slider__link">
											<?php the_field( 'tp_email', $address->ID ); ?>
                                        </a>
									<?php endif; ?>
                                </div>
                            </div>

						<?php endforeach; ?>

                        <div class="sites__slider__scrollbar slider-scrollbar"></div>
                    </div>
                </div>
			<?php endif; ?>

        </div>
    </div>
</div>