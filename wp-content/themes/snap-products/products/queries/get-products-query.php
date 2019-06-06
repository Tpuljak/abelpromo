<?php
  include(get_template_directory() . '/products/helpers.php');

  function get_products($offset = 0, $how_many = PHP_INT_MAX) {
    global $language, $wpdb;

    $prepend = '';

    if ($language == 'HR') {
      $prepend = 'hr_';
    }

    $products_query = "SELECT *
    FROM $wpdb->posts AS p
    WHERE   p.post_status = 'publish' 
        AND p.post_type = 'product'
    ORDER BY p.post_date DESC
    LIMIT {$offset}, {$how_many}";

    return get_products_meta($products_query);
  }
?>