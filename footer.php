</main>

<!--footer--main-->
<footer class="footer <?php if( is_front_page() ) { ?>footer--main<?php } ?>">
    <div class="container">
        <div class="footer__top">
            <div class="footer__top__content">
                <a class="footer__logo" href="<?php echo get_site_url(); ?>">
                    <svg class="footer__logo__icon" width="168"
                         height="35">
                        <use href="/svg-symbols.svg#logo-text"></use>
                    </svg>
                </a>
                <div class="footer__top__text">Образовательная<br>программа</div>
            </div>

            <div class="footer__social">

				<?php if ( get_field( 'youtube_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'youtube_link', 'option' ) ); ?>"
                       class="footer__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Ютуб">
                        <svg class="icon__icon-youtube2" width="34" height="30">
                            <use href="/svg-symbols.svg#icon-youtube2"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'vk_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'vk_link', 'option' ) ); ?>"
                       class="footer__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Вконтакте">
                        <svg class="icon__icon-vk" width="33" height="26">
                            <use href="/svg-symbols.svg#icon-vk"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'fb_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'fb_link', 'option' ) ); ?>"
                       class="footer__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Фейсбук">
                        <svg class="icon__icon-fb" width="26" height="26">
                            <use href="/svg-symbols.svg#icon-fb"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'whatsapp_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'whatsapp_link', 'option' ) ); ?>"
                       class="footer__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Ватсап">
                        <svg class="icon__icon-whatsapp" width="28" height="28">
                            <use href="/svg-symbols.svg#icon-whatsapp"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'telegram_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'telegram_link', 'option' ) ); ?>"
                       class="footer__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Телеграм">
                        <svg class="icon__icon-telegram" width="27" height="25">
                            <use href="/svg-symbols.svg#icon-telegram"></use>
                        </svg>
                    </a>
				<?php } ?>

				<?php if ( get_field( 'instagram_link', 'option' ) ) { ?>
                    <a href="<?php echo esc_url( get_field( 'instagram_link', 'option' ) ); ?>"
                       class="footer__social-link popuper popuper--left"
                       data-popuper="Академия каббалы: Инстаграм">
                        <svg class="icon__icon-instagram" width="26" height="26">
                            <use href="/svg-symbols.svg#icon-instagram"></use>
                        </svg>
                    </a>
				<?php } ?>

            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__bottom__left">

				<?php if ( get_field( 'block_copyright', 'option' ) ) { ?>
                    <div class="footer__copy">
						<?php echo apply_filters( 'the_content', get_field( 'block_copyright', 'option' ) ); ?>
                    </div>
				<?php } ?>
				<?php if ( get_field( 'block_left', 'option' ) ) { ?>
                    <div class="footer__copy__text">
						<?php echo apply_filters( 'the_content', get_field( 'block_left', 'option' ) ); ?>
                    </div>
				<?php } ?>
            </div>

            <div class="footer__bottom__right">
				<?php if ( get_field( 'footer_block_right', 'option' ) ) { ?>
                    <div class="footer__contact">
						<?php echo apply_filters( 'the_content', get_field( 'footer_block_right', 'option' ) ); ?>
                    </div>
				<?php } ?>

				<?php
				wp_nav_menu( [
					'theme_location'  => 'footer_menu',
					'container'       => 'div',
					'container_class' => 'footer__menu',
					'echo'            => true,
					'items_wrap'      => '%3$s',
					'walker'          => new Footer_Menu_Walker(),
				] );
				?>

            </div>
        </div>
    </div>
</footer>

<div class="subfooter">
    <div class="container"><a href="#" class="subfooter__link">Контактная информация</a></div>
</div>

<?php
kab_help()->helper->user_contact_details_notification();
?>

<?php wp_footer(); ?>


<script>
	document.addEventListener('DOMContentLoaded', function () {
		setTimeout(function () {
			const script = document.createElement('script');
			script.src = '//code.jivosite.com/widget.js';
			script.setAttribute('data-jv-id', 'ygZrmdRfik');
			document.body.append(script);
		}, 3000);
	});
</script>

</body>

<?php //if ( defined( 'USER_FORM_MESSAGE' ) ) { ?>
<!--    <ul class="login-errors">-->
<!--        <li>--><?php //echo USER_FORM_MESSAGE; ?><!--</li>-->
<!--    </ul>-->
<?php //} ?>

</html>