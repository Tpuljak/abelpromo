<?php
  function get_products($offset = 0, $how_many = -1, $filters = ['']) {
    global $language, $wpdb;

    $prepend = '';

    if ($how_many = -1) {
      $how_many = PHP_INT_MAX;
    }

    if ($language == 'HR') {
      $prepend = 'hr_';
    }

    if (empty($filters)) {
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
      $append = '';
      $append_where = '';

      if (in_array('discounted', $filters)) {
        $append .= " INNER JOIN $wpdb->postmeta AS post_meta ON (post_meta.post_id = p.ID)";
        $append_where .= " AND post_meta.meta_key = 'on_discount'";
      }

      $products_query = "SELECT *, t.name AS category, hr_category.meta_value AS hr_category
      FROM $wpdb->posts AS p
      INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id)
      INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
      INNER JOIN $wpdb->terms AS t ON (t.term_id = tt.term_id)
      INNER JOIN $wpdb->termmeta AS hr_category ON (hr_category.term_id = t.term_id)
      {$append}
      WHERE   p.post_status = 'publish' 
          AND p.post_type = 'product'
          {$append_where}
          AND tt.taxonomy = 'product_category'
          AND hr_category.meta_key = 'product_category_hr'";

      if (in_array('featured', $filters)) {
        $products_query .= " AND t.name = 'Featured'";
      } elseif (in_array('writing', $filters)) {
        $products_query .= " AND t.name = 'Writing accessories'";
      }  elseif (in_array('remotes', $filters)) {
        $products_query .= " AND t.name = 'Remotes and keychains'";
      }  elseif (in_array('technology', $filters)) {
        $products_query .= " AND t.name = 'Technology'";
      }  elseif (in_array('bottles', $filters)) {
        $products_query .= " AND t.name = 'Bottles'";
      }  elseif (in_array('textile', $filters)) {
        $products_query .= " AND t.name = 'Textile'";
      }  elseif (in_array('stickers', $filters)) {
        $products_query .= " AND t.name = 'Print &amp; Cut stickers'";
      }  elseif (in_array('diaries', $filters)) {
        $products_query .= " AND t.name = 'Diaries'";
      }

      if (in_array('discounted', $filters)) {
        $products_query .= " AND post_meta.meta_value = 1";
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