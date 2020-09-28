<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kabacedemy
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

endwhile;
?>

get_footer();
