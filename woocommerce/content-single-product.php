<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
?>

<div class="container">
	<?php

	if ( post_password_required() ) {
		echo get_the_password_form(); // WPCS: XSS ok.

		return;
	}

	// Уведомления
	do_action( 'woocommerce_before_single_product' );
	?>
</div>

<?php
/**
 * Hook: woocommerce_before_single_product_summary.
 *
 * @hooked woocommerce_show_product_sale_flash - 10
 * @hooked woocommerce_show_product_images - 20
 */
//do_action( 'woocommerce_before_single_product_summary' );
?>

<!-- <div class="summary entry-summary"> -->
<?php
/**
 * Hook: woocommerce_single_product_summary.
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */
//do_action( 'woocommerce_single_product_summary' );
?>
<!-- </div> -->

<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
//do_action( 'woocommerce_after_single_product_summary' );

$mak_product_show = get_field( 'product_mak_show' );

$user_id = get_current_user_id();
$current_user= wp_get_current_user();
?>

<section class="intro intro-inner intro-inner--second <?php echo ( $mak_product_show ) ? 'intro-club' : '' ?>">
    <div class="intro__background" style="transform:translateX(-173px);">
        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt="<?php the_title(); ?>">
    </div>
    <div class="container">
        <div class="intro__container">
            <div class="intro__left">
                <div class="intro-base">
                    <div class="intro-base__placeholder">
                        <svg class="icon__icon-stripe" width="325px" height="71px">
                            <use href="/svg-symbols.svg#icon-stripe"></use>
                        </svg>
						<?php the_field( 'product_intro_base_placeholder' ); ?>
                    </div>

                    <h2 class="intro-base__title"><?php the_title(); ?></h2>
                </div>
            </div>
            <div class="intro__right">
                <h2 class="intro-inner__title"><?php the_field( 'product_intro_inner_title' ); ?></h2>
                <div class="intro-inner__text">
					<?php the_field( 'product_intro_inner_text' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

if ( ! $mak_product_show ):
	?>
    <div class="basic-inner">
        <div class="container">
            <div class="basic-inner__container">
                <?php 
                
                    if (!wc_customer_bought_product( $customer_email, $user_id, get_the_ID()) ) :
                    
                ?>
                <div class="basic-sidebar">

					<?php
					$user_email = '';
					$user_name  = '';

					if ( is_user_logged_in() ) {
						$curr_user  = wp_get_current_user();
						$user_name  = $curr_user->data->display_name;
						$user_email = $curr_user->data->user_email;
					}
                    
					?>

                    <form method="POST" class="basic-sidebar__form">
						<?php if ( get_field( 'product_intro_base_date' ) ) { ?>
                            <div class="basic-sidebar__form__title">СТАРТ
                                C <?php the_field( 'product_intro_base_date' ); ?></div>
						<?php } ?>

                        <label class="form-label">
                            <input name="billing_first_name" autocomplete="off" value="<?php echo $user_name; ?>">
                            <span>Ваше имя</span>
                        </label>
                        <label class="form-label">
                            <input type="email" name="billing_email" autocomplete="off"
                                   value="<?php echo $user_email; ?>">
                            <span>Ваш e-mail</span>
                        </label>

						<?php if ( $product->is_in_stock() && $product->is_purchasable() ) { ?>
                            <button class="btn basic-sidebar__form__button single_add_to_cart_button button alt"
                                    name="add-to-cart"
                                    value="<?php echo $product->get_id(); ?>">
								<?php echo product_button_name( $product ); ?>
                            </button>
						<?php } elseif ( ! $product->is_purchasable() ) {
							?>
                            <div class="basic-sidebar__product__members basic-sidebar__form__button basic-sidebar__form__button--disabled">
	                            <?php echo __( 'Курс недоступен', 'kabacedemy' ); ?>
                            </div>
							<?php
						} else { ?>
                            <button class="btn basic-sidebar__form__button single_add_to_cart_button button alt"
                                    disabled="disabled">
								<?php echo __( 'Курс недоступен', 'kabacedemy' ); ?>
                            </button>
						<?php } ?>

						<?php sv_wc_memberships_member_discount_product_notice( get_the_ID() ); ?>
                    </form>
                </div>
                
                <?php endif; ?>

				<?php $content_repeater = get_field( 'product_content_item_repeater' ); ?>

				<?php if ( $content_repeater ): ?>
                    <div class="basic-content">
                        <div class="basic-content__row">

							<?php foreach ( $content_repeater as $item ): ?>

                                <div class="basic-content__item <?php echo ( ! $item['product_content_item_icon_arrow'] ) ?: 'basic-content__item--line'; ?>">

									<?php if ( $item['product_content_item_icon'] ): ?>
                                        <div class="basic-content__item__media">
                                            <img src="<?= $item['product_content_item_icon']; ?>"
                                                 alt="<?php the_title(); ?>">
                                        </div>
									<?php endif; ?>

                                    <div class="basic-content__item__body">

										<?php if ( ! empty( $item['product_content_item_title']['product_content_item_title_first'] ) ): ?>
                                            <div class="basic-content__item__title">
                                                <span><?= $item['product_content_item_title']['product_content_item_title_first'] ?></span>
                                                <b><?= $item['product_content_item_title']['product_content_item_title_last'] ?></b>
                                            </div>
										<?php endif; ?>

										<?php if ( $item['product_content_item_subtitle'] ): ?>
                                            <div class="basic-content__item__subtitle"><?= $item['product_content_item_subtitle'] ?></div>
										<?php endif; ?>

										<?php if ( $item['product_content_item_descr'] ) { ?>
                                            <div class="basic-content__item__text">
												<?php echo $item['product_content_item_descr']; ?>
                                            </div>
										<?php } ?>

                                    </div>

                                </div>

							<?php endforeach; ?>

                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="mak-club">
        <div class="container">
            <div class="mak-club__container">
                <!-- Sidebar -->
                <div class="club-sidebar">
                    <div class="club-sidebar__inner club-sidebar-inner">
                        <div class="club-sidebar-inner__title"><?php the_field( 'product_sidebar_title' ); ?></div>
                        <div class="club-sidebar-inner__descr">
							<?php the_field( 'product_sidebar_descr' ); ?>
                        </div>
                        <div class="club-sidebar-inner__image">
                            <img src="<?php the_field( 'product_sidebar_img' ); ?>" alt="<?php the_title(); ?>">
                        </div>
                    </div>

                    <div class="club-sidebar__bottom club-sidebar-bottom">
                        <div class="mak-club__text">
							<?php the_field( 'product_sidebar_content' ); ?>
                        </div>

                        <form method="POST">
                            <button class="btn mak-club__button" name="add-to-cart"
                                    value="<?php echo $product->get_id(); ?>">
                                Записаться в МАК Клуб
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Content -->
                <div class="mak-club-content">
                    <div class="mak-club-content__top">
                        <h1 class="mak-club-content__title"><?php the_field( 'product_mak_title' ); ?></h1>
                        <div class="mak-club__text">
							<?php the_field( 'product_mak_descr' ); ?>
                        </div>
                    </div>

					<?php $mak_pages = get_field( 'product_mak_blocks' ); ?>

					<?php if ( $mak_pages ): ?>
                    <div class="club-cards">
						<?php foreach ( $mak_pages

						as $item ): ?>
						<?php if ( is_user_in_club() ): ?>
                        <a href="<?php the_permalink( $item['mak_id'] ); ?>" class="club-cards__item club-card">
							<?php else: ?>
                            <div class="club-cards__item club-card">
								<?php endif; ?>
                                <div class="club-card__logo">
                                    <img src="<?php echo $item['mak_img']; ?>"
                                         alt="<?php echo get_the_title( $item['mak_id'] ); ?>">
                                </div>
                                <div class="club-card__content">
                                    <div class="club-card__title"><?php echo get_the_title( $item['mak_id'] ); ?></div>
                                    <div class="club-card__subtitle"><?php echo $item['mak_subtitle'] ?></div>
                                </div>
								<?php if ( is_user_in_club() ): ?>
                        </a>
						<?php else: ?>
                    </div>
				<?php endif; ?>
				<?php endforeach; ?>
                </div>
				<?php endif; ?>

                <div class="mak-club-content__bottom">
                    <div class="mak-club__text">
                        <p> Для вступления в онлайн-клуб вам нужно пройти короткий недельный интенсив по науке
                            каббала </p>
                        <p> После просмотра 7-ми роликов и заполнения 7-ми тестов вы получаете приглашение в клуб </p>
                    </div>

                    <form method="POST">
                        <button class="btn mak-club__button" name="add-to-cart"
                                value="<?php echo $product->get_id(); ?>">
                            Записаться в МАК Клуб
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
