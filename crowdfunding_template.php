<?php
/*
Template Name: Crowdfunding
*/

?>
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
		padding: 100px 0 80px 0;
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Внести свой вклад</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!--		<link rel="stylesheet" href="./style.css">-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
//			echo do_shortcode('[wcj_product_crowdfunding_goal]');
//			echo do_shortcode('[wcj_product_crowdfunding_startdate]');
//			echo do_shortcode('[wcj_product_crowdfunding_goal_remaining_progress_bar]');
//			echo do_shortcode('[wcj_product_crowdfunding_goal_remaining]');
//			echo do_shortcode('[wcj_product_crowdfunding_time_remaining_progress_bar]');
//			echo do_shortcode('[wcj_product_total_orders_items]');
//			echo do_shortcode('[wcj_product_total_orders]');
//			echo do_shortcode('[wcj_product_crowdfunding_time_remaining]');
			?>

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
					<a href="/cart/?add-to-cart=<?php echo get_the_ID() ?>"" class="btn btn-primary">внести свой вклад</a>
				</div>
				<div class="col-7 progress-block">

					Текущий взнос (зима 2021): <strong><?php echo do_shortcode('[wcj_product_total_orders_sum hide_currency="yes"]') . ' / ' .  do_shortcode('[wcj_product_crowdfunding_goal hide_currency="yes"]') ?> USD</strong>
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



