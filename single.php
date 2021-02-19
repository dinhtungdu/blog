<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	render_view( 'single.twig', [
		'title' => get_the_title(),
		'content' => apply_filters( 'the_content', get_the_content() ),
		'datetime' => get_the_time( 'U' ),
		'date' => human_time_diff( get_the_time( 'U' ), current_time( 'U' ) ) . ' ago',
		'readtime' => get_reading_time( apply_filters( 'the_content', get_the_content() ) ),
		'tags' => get_post_tags( get_the_ID() ),
		'thumbnail' => get_the_post_thumbnail_url(),
	] );
endwhile; // End of the loop.

get_footer();
