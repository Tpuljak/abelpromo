<?php 
include(get_template_directory() . '/products/admin/post-type.php' );

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
    'Sidebar'
);

include_templates($templateNames);

function update_language() {
    $urlParams = explode( '/', $_SERVER['REQUEST_URI'] );
	global $language;
	if (in_array('hr', $urlParams)) {
		$language = 'HR';
	} else {
		$language = 'EN';
	} 
}

function prepend_default_rewrite_rules( $rules ) {
    // Prepare for new rules
    $new_rules = [];
    // Set up languages, except default one
    $language_slugs = ['hr'];
    // Generate language slug regex
    $languages_slug = '(?:' . implode( '/|', $language_slugs ) . '/)?';
    // Set up the list of rules that don't need to be prefixed
    $whitelist = [
        '^wp-json/?$',
        '^wp-json/(.*)?',
        '^index.php/wp-json/?$',
        '^index.php/wp-json/(.*)?'
    ];
    // Set up the new rule for home page
    $new_rules['(?:' . implode( '/|', $language_slugs ) . ')/?$'] = 'index.php';
    // Loop through old rules and modify them
    foreach ( $rules as $key => $rule ) {
        // Re-add those whitelisted rules without modification
        if ( in_array( $key, $whitelist ) ) {
            $new_rules[ $key ] = $rule;
        // Update rules starting with ^ symbol
        } elseif ( substr( $key, 0, 1 ) === '^' ) { 
            $new_rules[ $languages_slug . substr( $key, 1 ) ] = $rule;
        // Update other rules
        } else {
            $new_rules[ $languages_slug . $key ] = $rule;
        }
    }
    // Return out new rules
    return $new_rules;
}
add_filter( 'rewrite_rules_array', 'prepend_default_rewrite_rules' );

/* Stops unwanted redirects when site doesn't exist */
remove_action('template_redirect', 'redirect_canonical');
?>