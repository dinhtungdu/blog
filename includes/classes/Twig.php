<?php

class Twig {
    private static $singleton = null;

    private static $twig = null;

    private function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader( get_template_directory() . '/views');
        self::$twig = new \Twig\Environment($loader, [
			'cache' => get_template_directory() . '/.caches',
			'auto_reload' => true,
			'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			'autoescape' => 'html',
		]);

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			self::$twig->addExtension(new \Twig\Extension\DebugExtension());
		}
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

