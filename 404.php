<?php
get_header();

render_view( '404.twig', [
	'homeUrl' => home_url(),
] );

get_footer();
