<?php 

if (function_exists('add_theme_support')) {
    load_theme_textdomain('snap-products');
}
function snap_products_style() {
    wp_enqueue_style( 'snap-products', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'snap_products_style' );
function snap_products_script() {
    wp_enqueue_script( 'hook', get_template_directory_uri() . '/script.js', array(), '', true);
}
add_action( 'wp_enqueue_scripts', 'snap_products_script', 11);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

define( 'images', get_stylesheet_directory_uri() . '/images/' );

function include_templates($templateNames) {
    foreach ($templateNames as $templateName) {
        include(locate_template('./components/'.$templateName.'.php'));
    }
}

$templateNames = array(
    'button',
);

include_templates($templateNames);

?>