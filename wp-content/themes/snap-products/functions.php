<?php 
include(get_template_directory() . '/products/admin/post-type.php' );
include(get_template_directory() . '/products/helpers.php');
include(get_template_directory() . '/products/queries/get-products-query.php');
include(get_template_directory() . '/products/queries/get-single-product.php');

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
    'Info',
    'button',
    'Sidebar',
    'DeliveryCheckbox',
    'MaterialCheckbox',
    'PackageCheckbox',
    'Search',
    'FilterCheckbox'
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

function get_url_append($urlParams) {
    $urlAppend = '';
    foreach ($urlParams as $param) {
        if($param != 'snap-products' && $param != 'hr') {
            $urlAppend .= rtrim($param, '/') . '/';
        }
    }
    $urlAppend = rtrim($urlAppend, '/');
    $urlAppend = ltrim($urlAppend, '/');
    return $urlAppend;
}

function load_more($params) {
    $requestParams = array();
    parse_str($_SERVER['QUERY_STRING'], $requestParams);
    global $language;
    $language = 'EN';

    if (isset($requestParams['lang'])) {
        $language = $requestParams['lang'];
    }

    $offset = isset($requestParams['offset']) ? $requestParams['offset'] : 0;
    $limit = isset($requestParams['limit']) ? $requestParams['limit'] : 10;

    $products = get_products($offset, $limit);

    if ($products == NULL) {
        return NULL;
    }


}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'products/load-more', array(
        'methods'  => 'GET',
        'callback' => 'load_more'
    ));
});

function get_request_params() {
    $requestParams = array();
    parse_str($_SERVER['QUERY_STRING'], $requestParams);

    return $requestParams;
}

function calculate_price($product) {
    if (!isset($product->base_print_price) || !isset($product->product_price)) {
        return NULL;
    }

    $price = 0.0;

    $a = $product->product_price;
    $b0 = $product->base_print_price;
    $b1 = 0.0;
    $b2 = 0.0;
    $b3 = 0.0;
    $b4 = 0.0;

    if (isset($product->white_underprint) && $product->white_underprint) {
        $b1 = $b0 * 0.25;
    }

    if (isset($product->primer) && $product->primer) {
        $b2 = $b0 * 0.5;
    }

    if (isset($product->uv_varnish) && $product->uv_varnish) {
        $b3 = $b0 * 0.25;
    }

    $b = $b0 + $b1 + $b2 + $b3;

    return $price;
}

function send_order(WP_REST_Request $request) {
    //TODO: FIX
    $to = "mail@mail.com";

    $subject = "Upit za proizvod";

    $body = json_decode($request->get_body());

    $message = $body;
    // mail($to, $subject, $message);

    $message = get_mail_message_format($body);

    return $message;
}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'order/send', array(
        'methods'  => 'POST',
        'callback' => 'send_order'
    ));
});

function get_mail_message_format($body) {
    $message = "Product: " . $body->productTitle . "\n";
    $message .= "Product colour: " . $body->productColour . "\n";
    $message .= "Quantity: " . $body->quantity . "\n";
    $message .= "Delivery: " . $body->delivery . "\n";
    $message .= "Custom packaging: " . (($body->customPackage == 0) ? 'Not required' : 'Required') . "\n";
    
    $options = $body->options;
    $customer = $body->customerInfo;

    $message .= "--Additional options--\n";

    foreach ($options as $key => $value) {
        $message .= ucfirst($key) . ": ";

        if ($value == 1) {
            $message .= "yes\n";
        } else {
            $message .= "no\n";
        }
    } 

    $message .= "--Customer info--\n";
    foreach ($customer as $key => $value) {
        $message .= ucfirst($key) . ": " . $value . "\n";
    }

    return $message;
}
?>