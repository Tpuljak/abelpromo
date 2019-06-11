<?php
  include(get_template_directory() . '/products/helpers.php');

  function get_product($product_id) {
    global $language, $wpdb;

    $prepend = '';

    if ($language == 'HR') {
      $prepend = 'hr_';
    }

    $products_query = "SELECT *
    FROM $wpdb->posts AS p
    WHERE   p.ID = {$product_id}
        AND p.post_status = 'publish' 
        AND p.post_type = 'product'
        ";

    return get_products_meta($products_query);
  }
?>