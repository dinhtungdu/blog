<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	render_view( 'single.twig', get_formatted_post_data( $post, false ) );
endwhile; // End of the loop.

get_footer();
