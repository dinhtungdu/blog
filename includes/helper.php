<?php

function render_template( $template, $data = [] ) {
    $twig = Twig::init();

    echo $twig->render($template, $data);
}