<?php

class Twig {
    private static $singleton = null;

    private static $twig = null;

    private function __construct() {
        $uploadDir = wp_get_upload_dir();
        $loader = new \Twig\Loader\FilesystemLoader( get_template_directory() . '/views');
        self::$twig = new \Twig\Environment($loader, [
            'cache' => $uploadDir['basedir'] . '/template-caches',
        ]);
    }

    public static function init() {
        if ( self::$singleton === null ) {
            self::$singleton = new self();
        }
        return self::$singleton;
    }

    public static function render( $template, $data = [] ) {
        echo self::$twig->render($template, $data);
    }
}

