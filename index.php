<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since 1.0.0
 */

global $posts;

get_header();

render_view( 'archive.twig', [
	'title' => get_the_archive_title(),
	'desc' => strip_tags( get_the_archive_description() ),
	'posts' => array_map( 'get_formatted_post_data', $posts ),
	'isTag' => is_tag(),
] );

get_footer();
