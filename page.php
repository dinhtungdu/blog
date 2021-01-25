<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	render_view( 'page.twig', [
		'title' => get_the_title(),
		'content' => apply_filters( 'the_content', get_the_content() ),
	] );
endwhile; // End of the loop.

get_footer();
