<?php

function render_view( $template, $data = [] ) {
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

	if ( empty( $locations[ $location ] ) ) {
		return [];
	}

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

function get_reading_time( $post_content ) {
	$word_count = str_word_count( strip_tags( $post_content ) );
	$readingtime = ceil( $word_count / 200 );
	if ( $readingtime == 1 ) {
		$timer = ' min read';
	} else {
		$timer = ' mins read';
	}
	return $readingtime . $timer;
}

function get_post_tags( $post_id ) {
	$tags = get_the_tags( $post_id );
	if ( ! $tags ) {
		return [];
	}
	return array_map( function( $tag ) {
		return [
			'title' => $tag->name,
			'url' => get_term_link( $tag, 'post_tag' ),
		];
	}, $tags );
}

function get_formatted_post_data ( $post, $loop = true ) {
	return [
		'title' => $post->post_title,
		'url' => get_permalink( $post ),
		'datetime' => get_the_time( 'U', $post ),
		'date' => human_time_diff( get_the_time( 'U', $post ), current_time( 'U' ) ) . ' ago',
		'readtime' => get_reading_time( apply_filters( 'the_content', get_the_content( null, false, $post ) ) ),
		'tags' => get_post_tags( get_the_ID(), $post->ID ),
		'thumbnail' => get_the_post_thumbnail_url( $post, $loop ? 'thumbnail' : 'post-thumbnail' ),
		'content' => apply_filters( 'the_content', get_the_content( null, false, $post ) ),
		'summary' => $post->post_excerpt,
	];
}
