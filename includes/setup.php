<?php

add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );

    /**
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    /**
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
    */
    add_theme_support(
        'html5',
        [
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
			'navigation-widgets',
		]
	);

	add_theme_support( 'align-wide' );

    register_nav_menus( [ 'primary' => esc_html__( 'Primary menu' ) ] );
} );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/dist/css/app.css', [], filemtime( get_template_directory() . '/dist/css/app.css' ) );
    wp_enqueue_style( 'font', 'https://fonts.googleapis.com/css2?family=Spartan:wght@400;500;600;700&display=swap' );
	wp_enqueue_script( 'alpine', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js', [], '2.8' );

	wp_dequeue_style( 'wp-block-library' );
	wp_deregister_script('wp-embed');
} );

add_filter( 'script_loader_tag', function ( $tag, $handle ) {
    if ( in_array( $handle, ['alpine'], true ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}
    if ( in_array( $handle, ['style', 'font'], true ) ) {
		$print_tag = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $tag );
		return $print_tag . '<noscript>' . $tag . '</noscript>';
	}
	return $tag;
}, 10, 2 );

/**
 * Disable the emoji's
 */
add_action('init', function () {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
});

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins) {
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type) {
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

		$urls = array_diff($urls, array($emoji_svg_url));
	}

	return $urls;
}
