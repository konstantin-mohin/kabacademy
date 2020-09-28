<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kabacedemy
 */

get_header();

while ( have_posts() ) :
	the_post();

	if ( is_checkout() && ! empty( is_wc_endpoint_url( 'order-received' ) ) ) {
		get_template_part( 'template-parts/wc-order', 'received' );
	} elseif ( get_post_type() == 'forum' || get_post_type() == 'topic' ) {
		get_template_part( 'template-parts/content', 'forum' );
	} elseif ( is_view_order_page() || is_wc_endpoint_url( 'order-pay' ) ) {
		get_template_part( 'template-parts/content', 'no-sidebar' );
	} else {
		get_template_part( 'template-parts/content', 'page' );
	}

endwhile; // End of the loop.


get_footer();
