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

    register_nav_menus( [ 'primary' => esc_html__( 'Primary menu' ) ] );
} );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/dist/css/main.css', [], filemtime( get_template_directory() . '/dist/css/main.css' ) );
    wp_enqueue_style( 'font', 'https://fonts.googleapis.com/css2?family=Spartan:wght@500;600;700&display=swap' );
    wp_enqueue_script( 'alpine', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js', [], '2.8' );
} );

add_filter( 'script_loader_tag', function ( $tag, $handle ) {
    if ( in_array( $handle, ['alpine'], true ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}
    if ( in_array( $handle, ['main-style', 'font'], true ) ) {
		$print_tag = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $tag );
		return $print_tag . '<noscript>' . $tag . '</noscript>';
	}
	return $tag;
}, 10, 2 );
