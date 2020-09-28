<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package kabacedemy
 */

get_header();
?>

<main class="main">
	<section class="error-404 not-found">
		<div class="container">
			<div class="article__container">

				<?php //get_sidebar(); ?>

				<div class="article-content">

					<h1>Не удалось найти эту страницу.</h1>

				</div>
			</div>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();