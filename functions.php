<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $deps = array('twenty-twenty-one-style','twenty-twenty-one-print-style');
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', $deps );
}
