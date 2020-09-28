<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kabacedemy
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="article-sidebar">
	<?php if ( is_post_type_archive( 'op_events' ) ||
	           is_singular( 'op_events' ) ||
	           is_tax( 'op_cat_events' ) ): ?>
		<?php dynamic_sidebar( 'events' ); ?>
	<?php elseif ( is_account_page() && is_user_logged_in() ): ?>

        <div class="article-sidebar__top">

	        <?php if ( true ) { ?>
                <div class="article-sidebar__top__bg">
                    <img src="https://dev.kabacademy.com/wp-content/uploads/sidebar-2.jpg" alt="">
                </div>
	        <?php } ?>

            <div class="article-sidebar__top__title">
				<?php if ( is_members_area_page() ) { ?>
                    <span><?php echo __( 'Memberships', 'woocommerce-memberships' ); ?></span>
				<?php } else { ?>
                    <span>ЛИЧНЫЙ КАБИНЕТ</span>
				<?php } ?>
                <i class="article-sidebar__top__title__icon">
                    <svg class="icon__icon-arrow-right" width="10" height="17">
                        <use href="/svg-symbols.svg#icon-arrow-right"></use>
                    </svg>
                </i>
            </div>

            <div class="article-sidebar__top__list">

				<?php if ( is_members_area_page() ) { ?>
					<?php echo wc_get_template_part( 'myaccount/my-membership', 'navigation' ); ?>
				<?php } else { ?>
                    <ul>
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php } ?>

            </div>

        </div>
	<?php else: ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>

</aside>