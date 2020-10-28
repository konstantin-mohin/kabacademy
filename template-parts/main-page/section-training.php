<div class="training">
  <div class="container">
    <div class="training__container">
      <div class="training__left"> 
        
        <svg class="training__logo" width="397" height="166">
          <use href="svg-symbols.svg#logo-en"></use>
        </svg>
        
        <?php if ( get_field( 'mp_training_coords', 'option' ) ): ?>
          <div class="training__footer"> 
            <a class="training__footer-link" data-fancybox href="https://www.google.com/maps/search/?api=1&query=<?php the_field( 'mp_training_coords', 'option' ); ?>"> 
              <svg class="header__login__icon" width="29" height="29">
                <use href="svg-symbols.svg#icon-google-maps"></use>
              </svg> 
              <span>google <br>maps</span> </a>  
          </div>
        <?php endif; ?>

        <div class="training__contact">

          <?php if ( get_field( 'mp_training_address', 'option' ) ): ?>
            <div class="training__contact__address">
              <?php the_field( 'mp_training_address', 'option' ); ?>
            </div>
          <?php endif; ?>

          <?php if ( get_field( 'mp_training_phone', 'option' ) ): ?>
            <p class="training__contact__phone">
              tel.: 
              <a href="tel:<?php echo kab_help()->helper->clean_tel_number( get_field( 'mp_training_phone', 'option' ) ); ?>">
                <?php the_field( 'mp_training_phone', 'option' ); ?>
              </a>
            </p>
          <?php endif; ?>

          

          <?php if ( get_field( 'mp_training_coords', 'option' ) ): ?>
            <a class="training__footer-link" data-fancybox
              href="https://www.google.com/maps/search/?api=1&query=<?php the_field( 'mp_training_coords', 'option' ); ?>"> 
              <svg class="header__login__icon" width="29" height="29">
                <use href="svg-symbols.svg#icon-google-maps"></use>
              </svg> 
              <span>google <br>maps</span> 
            </a>
          <?php endif; ?>

        </div>

      </div>

      <div class="training__right">
        <div class="training__numeral">Немного цифр</div>
        <div class="training__studies"> 
          <button class="training__studies__button" type="button"> 
            <svg
              class="icon__icon-reload" width="30" height="30">
              <use href="svg-symbols.svg#icon-reload"></use>
            </svg> 
          </button>
          
          <?php
            if( have_rows('mp_training_numbers', 'option') ):
            while( have_rows('mp_training_numbers', 'option') ) : the_row();
          ?>
          <div class="training__studies__content">
              <div class="training__studies__numbers"><?php echo get_sub_field('mp_training_numbers-num'); ?></div>
              <div class="training__studies__who"><?php echo get_sub_field('mp_training_numbers-text'); ?></div>
          </div>   
          <?php
            endwhile;
            endif;
          ?>
          
          

        </div>

        <form action="https://kabacademy.com/newsletter/input.php" method="POST" class="training__form">
          <div class="training__form__title">Подпишись<br>на нашу рассылку</div>
          <div class="form-group"> 
            <label class="form-label"> 
              <input name="name"> 
              <span>Ваше имя</span> 
            </label> 
            <label class="form-label"> 
              <input type="email" name="name">
              <span>Ваш e-mail</span>
            </label> 
          </div> 

          <button class="btn training__form__button">запишись сейчас!</button>

        </form>

      </div>
    </div>
  </div>
</div>