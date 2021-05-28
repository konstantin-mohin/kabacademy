<?php
/*
Template Name: Crowdfunding
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Внести свой вклад</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--		<link rel="stylesheet" href="./style.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/static/css/donation.css  ">
</head>
<body>


<div class="container">
    <a href="/" class="logo"><img src="<?php echo get_template_directory_uri() ?>/static/img/donation/logo.png" alt="logo"></a>

	<?php
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => 'crowdfunding',
			),
		),
	);
	$the_query = new WP_Query($args);

	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			global $product;

//			WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );

			$id = $product->get_id(); ?>



            <div class="row">
                <div class="col-12">
                    <h3><?php echo the_title(); ?></h3>
                </div>
                <div class="col-md-7 col-sm-12">
                    <h6>Дорогие друзья!</h6>

					<?php echo the_content(); ?>

                </div>
                <div class="col-md-5 clip">
                    <div class="embed-responsive embed-responsive-16by9">
						<?php echo  get_field( 'youtube_link',  $id); ?>
                    </div>
                    <!--					<a class="btn btn-primary ">внести свой вклад</a>-->

					<?php if( $product->is_type( 'variable' ) ) { ?>
                        <div class="modal-wrapper">
                            <!--                            <button id="modal-button" class="modal-button">Open Modal</button>-->
                            <a class="btn btn-primary modal-button">внести свой вклад</a>
                            <div class="donation-modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <div class="modal-title">
                                        Внести пожертвование
                                    </div>
                                    <div class="modal-label">
                                        сумма вложения
                                    </div>
                                    <form action="/cart/?add-to-cart=<?php echo get_the_ID() ?>" class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="<?php get_the_ID(); ?>">
                                        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
                                        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                                        <div class="form-tabs" id="tabs">
											<?php
											foreach ( $product->get_visible_children() as $variation_id ) {
												$variation = wc_get_product( $variation_id ); ?>
                                                <div class="price-wrapper  <?php if ( $variation->price === '5' ) echo 'active'; ?>" id="tab-<?php echo $variation_id; ?>">
                                                    <label>
                                                        <input type="radio" class="variation-price" id="price-<?php echo $variation_id; ?>" name="variation_id" value="<?php echo $variation_id; ?>"
															<?php if ( $variation->price === '5' ) echo 'checked'; ?>> <div class="variation-price-text"> <p>$ <?php echo $variation->price ?? ''; ?></p> </div>

                                                    </label>
                                                </div>


											<?php } ?>
                                        </div>
                                        <div class="button-wrapper">
                                            <button type="submit" class="btn btn-small button add-to form" type="button">Отправить пожертвование</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
					<?php } ?>
                </div>
                <div class="col-7 progress-block">

                    Текущий взнос: <strong><?php echo do_shortcode('[wcj_product_total_orders_sum hide_currency="yes"]') . ' / ' .  do_shortcode('[wcj_product_crowdfunding_goal hide_currency="yes"]') ?> USD</strong>
                    <div class="custom_progress_bar">
						<?php echo do_shortcode('[wcj_product_crowdfunding_goal_remaining_progress_bar]'); ?>
                    </div>
                </div>
            </div>

			<?php
		}
	}
	wp_reset_postdata();
	?>

    <div class="row">
        <div class="col-md-7">
            <div class="info">
                Ваша поддержка - это конкретное действие, направленное на отдачу. Такие действия каббалисты называют “добрыми
                делами”, с помощью которых все мы продвигаемся в духовном развитии.
                <span>Благодарим вас за поддержку!</span>
            </div>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">

        </div>
    </div>
</div>
</body>
</html>

<script>

    jQuery( document ).on( 'click', '.modal-button',  function( e ) {
        jQuery(this).parents('.modal-wrapper').find('.donation-modal').show();
    });

    jQuery( document ).on( 'click', '.close',  function( e ) {
        jQuery('.donation-modal').hide();
    });

    jQuery( document ).on( 'click', '.price-wrapper',  function( e ) {
        jQuery('#tabs > div').removeClass('active');
        jQuery(this).addClass('active');
    });

    jQuery( document ).on( 'selectstart', '.variation-price-text p',  function( e ) {
        e.preventDefault();
    });

    // window.addEventListener('selectstart', function(e){ e.preventDefault(); });
</script>




