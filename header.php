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
<div id="page" class="site">

<?php
render_template( 'header.twig', [
    'blogName' => get_bloginfo( 'name' ),
	'homeUrl' => home_url(),
	'menuItems' => get_nav_menu_items_by_location( 'primary' ),
] );
?>

	<div id="content">
