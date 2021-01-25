<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="sr-only" href="#content"><?php esc_html_e( 'Skip to content' ); ?></a>
<?php wp_body_open(); ?>
<div id="page" class="px-6 leading-normal text-gray-900 site" x-ref="page" x-data>

	<?php render_view( 'header.twig', [
		'blogName' => get_bloginfo( 'name' ),
		'homeUrl' => home_url(),
		'menuItems' => get_nav_menu_items_by_location( 'primary' ),
	] ); ?>

	<main id="content">
