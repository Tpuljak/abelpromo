<?php
  function get_products($offset = 0, $how_many = PHP_INT_MAX) {
    global $language, $wpdb;

    $prepend = '';

    if ($language == 'HR') {
      $prepend = 'hr_';
    }

    $products_query = "SELECT *, t.name AS category, hr_category.meta_value AS hr_category
    FROM $wpdb->posts AS p
    INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id)
    INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
    INNER JOIN $wpdb->terms AS t ON (t.term_id = tt.term_id)
    INNER JOIN $wpdb->termmeta AS hr_category ON (hr_category.term_id = t.term_id)
    WHERE   p.post_status = 'publish' 
        AND p.post_type = 'product'
        AND tt.taxonomy = 'product_category'
        AND hr_category.meta_key = 'product_category_hr'
    ORDER BY p.post_date DESC
    LIMIT {$offset}, {$how_many}";

    return get_products_meta($products_query);
  }
?>