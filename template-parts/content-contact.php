<?php the_content(); ?>

<?php $address_list = get_field( 'contact_addresses' ); ?>
<?php if ( $address_list ): ?>
  <div class="contact__row">
    <?php foreach( $address_list as $address ): ?>
      <div class="contact__item-container">
          <div class="contact__item">
              <div class="contact__item-top"> 
                <img src="<?php echo get_the_post_thumbnail_url( $address->ID ); ?>" class="contact__item__image" alt="<?= $address->post_title; ?>">
                <p class="contact__item__title"><?= $address->post_title; ?></p>
              </div>
              
              <?php $phones = get_field( 'ta_phones', $address->ID ); ?>

              <div class="contact__item__content"> 
                <?php if ( !empty( $phones ) ): ?>
                  <?php foreach ($phones as $phone): ?>
                    <a href="tel:<?php echo kab_help()->helper->clean_tel_number( $phone['ta_phones_item'] ); ?>" class="contact__slider__link">тел.: <?php echo $phone['ta_phones_item'] ?></a>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if ( get_field( 'tp_email', $address->ID ) ): ?>
                  <a href="mailto:<?php the_field( 'tp_email', $address->ID ); ?>" class="contact__slider__link">
                    <?php the_field( 'tp_email', $address->ID ); ?>
                  </a>
                <?php endif; ?> 
              </div>
              
          </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>