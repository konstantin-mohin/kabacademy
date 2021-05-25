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
</head>
<body>


<style>
    form {
        background: none !important;
    }
    /* The Modal (background) */
    .donation-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.4);
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>





<style>
    html, body {
        height: 100%;
        font-family: Montserrat, serif;
        font-style: normal;
        margin: 0;
        padding: 0;
        font-size: 100%;
    }

    body {
        background: rgb(255, 255, 255);
        /*background: linear-gradient(180deg, rgba(180, 213, 224, 1) 0%, rgba(255, 255, 255, 1) 34%, rgba(255, 255, 255, 1) 100%);*/
        background: no-repeat center 0 url("<?php echo get_template_directory_uri() ?>/static/img/donation/top.png");
    }

    .container {
        max-width: 1234px
    }

    h3 {
        color: #52B0D8;
        font-family: Montserrat, serif;
        font-size: 40px;
        font-style: normal;
        font-weight: 600;
        line-height: 48px;
        letter-spacing: -0.05em;
        text-align: left;
        margin-bottom: 1.5em;

    }

    h6 {
        font-size: 16px;
        font-style: normal;
        font-weight: 600;
        line-height: 24px;
        color: #A42BB9;
    }

    p {
        font-size: 14px;
        font-style: normal;
        font-weight: 300;
        line-height: 24px;


    }

    .btn {
        background: #A42BB9;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 32px;
        text-align: center;
        outline: none;
    }


    .logo {
        display: block;
        margin: 100px 0 80px 0;
        max-width: 300px;
    }

    .progress-block {
        margin: 1.5em 0 2.5em;
    }

    .progress {
        margin-top: 1em;
    }

    .info {
        border: #A42BB9 solid 20px;
        padding: 2em;
        border-bottom: none;
    }

    .info span {
        display: block;
        margin-top: 1.5em;
        color: #A42BB9;
    }


    .clip .btn {
        margin-top: 2em;
        width: 336px;
        line-height: 45px;
        border: 0;
    }


    @media (min-width: 768px) {
        .clip {
            left: 4em;
        }
    }

    div.embed-responsive {
        position: relative;
        display: block;
        width: 100%;
        padding: 0;
        overflow: hidden;
        border: 5px solid white;
    }

    /*.custom_progress_bar progress {*/
    /*    display: flex;*/
    /*    -ms-flex-direction: column;*/
    /*    flex-direction: column;*/
    /*    -ms-flex-pack: center;*/
    /*    justify-content: center;*/
    /*    overflow: hidden;*/
    /*    color: #fff;*/
    /*    text-align: center;*/
    /*    white-space: nowrap;*/
    /*    background-color: #007bff;*/
    /*    transition: width .6s ease;*/
    /*}*/


    .custom_progress_bar progress {
        border-radius: .25rem;
        width: 100%;

    }
    .custom_progress_bar progress::-webkit-progress-bar {
        background-color: #e9ecef;
        border-radius: .25rem;
    }
    .custom_progress_bar progress::-webkit-progress-value {
        background-color: #007bff;
        border-radius: .25rem;
    }
    .custom_progress_bar progress::-moz-progress-bar {
        /* style rules */
    }

</style>
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
						<iframe src="https://www.youtube.com/embed/DfF7pXNRU7w" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
<!--					<a class="btn btn-primary ">внести свой вклад</a>-->

					<?php if( $product->is_type( 'variable' ) ) { ?>
                        <div class="modal-wrapper">
<!--                            <button id="modal-button" class="modal-button">Open Modal</button>-->
                            <a class="btn btn-primary modal-button">внести свой вклад</a>
                            <div class="donation-modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>

                                    <form action="/cart/?add-to-cart=<?php echo get_the_ID() ?>" class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="<?php get_the_ID(); ?>">
                                        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
                                        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />

										<?php
										foreach ( $product->get_visible_children() as $variation_id ) {
											$variation = wc_get_product( $variation_id );
//                                    $product_variation = new WC_Product_Variation($variation_id);
											?>
                                            <div>
                                                <input type="radio" id="huey-<?php echo $variation_id; ?>" name="variation_id" value="<?php echo $variation_id; ?>"
                                                       checked>
                                                <label for="huey-<?php echo $variation_id; ?>"><?php echo $variation->price ?? ''; ?></label>
                                            </div>

										<?php } ?>

                                        <button type="submit" class="btn btn-small button add-to" type="button">Отправить пожертвование</button>
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
<!--						<div class="progress-bar" style="width: 15%"></div>-->
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


    jQuery( document ).on( 'click', '.modal-button',  function( event ) {
        jQuery(this).parents('.modal-wrapper').find('.donation-modal').show();
    });


    jQuery( document ).on( 'click', '.close',  function( event ) {
        jQuery('.donation-modal').hide();
    });


</script>




