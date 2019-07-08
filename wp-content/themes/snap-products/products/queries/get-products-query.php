<?php
  function get_products($offset = 0, $how_many = PHP_INT_MAX, $filters = NULL) {
    global $language, $wpdb;

    $prepend = '';

    if ($language == 'HR') {
      $prepend = 'hr_';
    }

    if ($filters == NULL) {
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
      ORDER BY p.post_name ASC
      LIMIT {$offset}, {$how_many}";
    } else {
      $products_query = "SELECT *, t.name AS category, hr_category.meta_value AS hr_category
      FROM $wpdb->posts AS p
      INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id)
      INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
      INNER JOIN $wpdb->terms AS t ON (t.term_id = tt.term_id)
      INNER JOIN $wpdb->termmeta AS hr_category ON (hr_category.term_id = t.term_id)
      WHERE   p.post_status = 'publish' 
          AND p.post_type = 'product'
          AND tt.taxonomy = 'product_category'
          AND hr_category.meta_key = 'product_category_hr'";

      if (in_array('featured', $filters)) {
        $products_query .= " AND t.name = 'Featured'";
      }

      if (in_array('new_products', $filters)) {
        $products_query .= " ORDER BY p.post_date DESC";
      } else {
        $products_query .= " ORDER BY p.post_name ASC";
      }

      $products_query .= " LIMIT {$offset}, {$how_many}";
    }

    // var_dump($products_query);
    return get_products_meta($products_query);
  }
?>