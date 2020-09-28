<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kabacedemy
 */

?>

<main class="main">
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

			<?php if ( ! is_view_order_page() && ! is_wc_endpoint_url( 'order-pay' ) ) { ?>
                <div class="cart__header">
					<?php the_title( '<h1 class="cart__title">', '</h1>' ); ?>
                </div>
			<?php } ?>

			<?php the_content(); ?>

        </div>
    </div>
    </div>
</main>
