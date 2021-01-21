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
    wp_enqueue_style( 'main', get_template_directory_uri() . '/dist/css/main.css', [], filemtime( get_template_directory() . '/dist/css/main.css' ) );
} );
