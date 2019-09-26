<?php 
include(get_template_directory() . '/products/admin/post-type.php' );
include(get_template_directory() . '/products/helpers.php');
include(get_template_directory() . '/products/queries/get-products-query.php');
include(get_template_directory() . '/products/queries/get-single-product.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require get_template_directory() . '/vendor/PHPMailer/src/Exception.php';
require get_template_directory() . '/vendor/PHPMailer/src/PHPMailer.php';
require get_template_directory() . '/vendor/PHPMailer/src/SMTP.php';

if (function_exists('add_theme_support')) {
    load_theme_textdomain('snap-products');
}
function snap_products_style() {
    wp_enqueue_style( 'snap-products-v2', get_stylesheet_uri() );
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
    $request_params = array();
    parse_str($_SERVER['QUERY_STRING'], $request_params);
    
    global $language;
    $language = 'EN';

    if (isset($request_params['lang'])) {
        $language = $request_params['lang'];
    }

    $filters = [''];

    if (isset($request_params['filters'])) {
        $filters = explode(',', $request_params['filters']);
    }

    $offset = isset($request_params['offset']) ? $request_params['offset'] : 0;
    $limit = isset($request_params['limit']) ? $request_params['limit'] : 10;

    $products = get_products($offset, $limit, $filters);

    if ($products == NULL) {
        return NULL;
    }

    return $products;
}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'products/load-more', array(
        'methods'  => 'POST',
        'callback' => 'load_more'
    ));
});

function get_request_params() {
    $request_params = array();
    parse_str($_SERVER['QUERY_STRING'], $request_params);

    return $request_params;
}

function calculate_prices($product, $delivery) {
    $prices = array();

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

    $x_factors = [1.15, 1.00, 0.93, 0.85, 0.77, 0.70];

    switch ($delivery) {
        case 'regular':
            $c = 1.00;
            break;
        case '7days':
            $c = 1.30;
            break;
        case 'express':
            $c = 2.00;
            break;
        case '48h':
            $c = 2.50;
            break;
        case '24h':
            $c = 3.00;
            break;
        default:
            $c = 1.00;
            break;
    }

    $discount_coeficient = 1;

    if (isset($product->discount_coeficient) && isset($product->on_discount) && $product->on_discount == 1) {
        $discount_coeficient = $product->discount_coeficient;
    }

    foreach ($x_factors as $x) {
        $price = $x * ($a + $b) * $c * $discount_coeficient;

        $price = round($price, 2);

        array_push($prices, $price);
    }

    return $prices;
}

function send_order(WP_REST_Request $request) {
    $to = 'sales@abelpromo.com';
    $subject = 'Upit za proizvod';

    $customer_info = json_decode($request->get_param('customer'));
    $files = $request->get_file_params();

    if (isset($files['files'])) {
        $files = $files['files'];
    }

    $message = get_mail_message_format($customer_info);

    $email = new PHPMailer();
    $email->SetFrom('snap@products.com');
    $email->Subject = $subject;
    $email->Body = $message;
    $email->IsHTML(true);
    $email->AddAddress($to);

    for ($i = 0; $i < count($files['name']); $i++) {
        $path = $files['tmp_name'][$i];
        $name = $files['name'][$i];

        $email->AddAttachment($path, $name);
    }

    // return $message;
    return $email->Send();
}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'order/send', array(
        'methods'  => 'POST',
        'callback' => 'send_order'
    ));
});

function get_mail_message_format($customer_info) {
    $message = "<b>Product:</b> " . $customer_info->productTitle . "<br>";
    $message .= "<b>Product colour:</b> " . $customer_info->productColour . "<br>";
    $message .= "<b>Quantity:</b> " . $customer_info->quantity . "<br>";
    $message .= "<b>Delivery:</b> " . $customer_info->delivery . "<br>";
    
    $options = $customer_info->options;
    $customer = $customer_info->customerInfo;

    $message .= "<b>--Additional options--</b><br>";

    foreach ($options as $key => $value) {
        $message .= "<b>" . ucfirst($key) . "</b>" . ": ";

        if ($value == 1) {
            $message .= "yes<br>";
        } else {
            $message .= "no<br>";
        }
    } 

    $message .= "<b>--Customer info--</b><br>";
    foreach ($customer as $key => $value) {
        $message .= ucfirst($key) . ": " . $value . "<br>";
    }

    return $message;
}
?>