<?php
/**
 * Template Name: Страница "Корзина"
 */
get_header();
?>

<div class="cart">
    <div class="container">
        <div class="breadcrumbs">
            <div class="breadcrumbs__item"><a href="#">Главная</a>
                <div class="breadcrumbs__separate">
                    <svg width="4" height="8" viewBox="0 0 4 8"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none" stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div class="breadcrumbs__item"><span>Самообразование</span>
                <div class="breadcrumbs__separate">
                    <svg width="4" height="8" viewBox="0 0 4 8"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none" stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="cart__header">
			<?php the_title( '<h1 class="cart__title">', '</h1>' ); ?>
            <div class="cart-step__two-error" style="display: none;"><span class="close"></span>Этот курс уже в корзине</div>
        </div>

		<?php if ( ! WC()->cart->is_empty() ) { ?>
            <ul class="cart__steps">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
				?>
            </ul>
		<?php } else { ?>
            <script>
                jQuery(function ($) {
				    wiPublic.myCoursesUrl = '<?php echo home_url() ?>';
				});
            </script>
            <div class="empty-cart-title">Ваша корзина пуста, хотите приобрести курс ?</div>
            <div id="wi-thanq-wrapper">
                    <span class="msg">
                    <?php
                    printf(
	                    __( 'You will be redirected to %s within next %s seconds.', WOOINT_TD ),
	                    '<a href="' . esc_url( home_url() ) . '">' . __( 'Главную страницу', WOOINT_TD ) . '</a>',
	                    '<span id="wi-countdown">10</span>'
                    );
                    ?>
                    </span>
                <button id="wi-cancel-redirect" data-wi-auto-redirect="on"><?php _e( 'Cancel', WOOINT_TD ); ?></button>
            </div>
		<?php } ?>
    </div>
</div>

<?php
get_footer();
?>


