<?php
get_header();

get_template_part( 'template-parts/main-page/section', 'intro' );
get_template_part( 'template-parts/main-page/section', 'about' );
get_template_part( 'template-parts/main-page/section', 'basic' );
get_template_part( 'template-parts/main-page/section', 'club' );

if ( get_field( 'mp_courses_show', 'option' ) ) {
	get_template_part( 'template-parts/main-page/section', 'course' );
}

if ( get_field( 'mp_block_webinars_show', 'option' ) ) {
	get_template_part( 'template-parts/main-page/section', 'webinars' );
}

if ( get_field( 'mp_block_map_show', 'option' ) ) {
	get_template_part( 'template-parts/main-page/section', 'map' );
}

get_template_part( 'template-parts/main-page/section', 'teachers' );
get_template_part( 'template-parts/main-page/section', 'training' );

get_footer();