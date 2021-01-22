<?php

function render_template( $template, $data = [] ) {
    $twig = Twig::init();

    echo $twig->render($template, $data);
}

/**
 * Get nav menu items by location
 *
 * @param $location The menu location id
 */
function get_nav_menu_items_by_location( $location, $args = [] ) {

	$queried_object_id = get_queried_object_id();
	$front_page_url    = home_url();

    // Get all locations
    $locations = get_nav_menu_locations();

    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );

    // Get menu items by menu name
	$menu_items = wp_get_nav_menu_items( $object->term_id, $args );

	$prepared_items = [];

	foreach( $menu_items as $item ) {
		if ( (int) $item->object_id === $queried_object_id ) {
			$item->classes[] = 'current-menu-item';
		}

		if ( is_front_page() && untrailingslashit( $front_page_url ) === untrailingslashit( $item->url ) ) {
			$item->classes[] = 'current-menu-item';
		}

		// Prepare class string.
		$item->classes_string = implode( ' ', $item->classes );

		if ( '0' === $item->menu_item_parent ) {
			$prepared_items[ $item->ID ] = $item;
		} else {
			array_walk_recursive(
				$prepared_items,
				function( &$menu, $key ) use ( $item ) {
					if( $item->menu_item_parent == $key ) {
						if( empty( $menu->submenu )) {
							$menu->submenu = [];
						}
						$menu->submenu[] = $item;
					}
				}
			);
		}
	}

    // Return menu post objects
    return $prepared_items;
}
