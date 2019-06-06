<?php
  class Product {}

  function transform_to_product_objects($products_DTO, $products) {
    global $language;
    $prepend = '';
    if ($language == 'HR') {
        $prepend .= 'hr_';
    }

    for ($i = 0; $i < count($products_DTO); $i++) {
        $post_id = (string)$products_DTO[$i]->post_id;
        $products[$post_id]->ID = $products_DTO[$i]->post_id;

        $meta_key = $products_DTO[$i]->meta_key;
        $meta_value = $products_DTO[$i]->meta_value;

        switch($meta_key) {
          case $prepend.'product_description':
            $products[$post_id]->description = $meta_value;
            break;
          case 'quantity_choosing_step':
            $products[$post_id]->quantity_choosing_step = $meta_value;
            break;
          case 'additional_options_primer':
            $products[$post_id]->primer = $meta_value;
            break;
          case 'additional_options_white_underrint':
            $products[$post_id]->white_underring = $meta_value;
            break;
          case 'additional_options_engrave':
            $products[$post_id]->engrave = $meta_value;
            break;
          case 'additional_options_uv_varnish':
            $products[$post_id]->uv_varnish = $meta_value;
            break;
          case 'product_details_moq':
            $products[$post_id]->moq = $meta_value;
            break;
          case 'product_details_lead_time':
            $products[$post_id]->lead_time = $meta_value;
            break;
          case 'product_details_colours':
            $products[$post_id]->colours_field = $meta_value;
            break;
          case 'product_details_refill':
            $products[$post_id]->refill = $meta_value;
            break;
          case 'product_details_print_area_width':
            $products[$post_id]->print_area['width'] = $meta_value;
            break;
          case 'product_details_print_area_height':
            $products[$post_id]->print_area['height'] = $meta_value;
            break;
          case 'product_details_print_area_unit':
            $products[$post_id]->print_area['unit'] = $meta_value;
            break;
          case 'image_type':
            $products[$post_id]->image_type = ($meta_value) ? 'diagonal' : 'vertical';
            break;
        }

        if($language == 'HR' && !isset($products[$post_id]->title)) {
          $products[$post_id]->title = $products_DTO[$i]->post_title;
        }
        // if(!isset($products[$post_id]->post_date)) {
        //   $products[$post_id]->post_date = $products_DTO[$i]->post_date;
        // } 
    }

    return $products;
  }

  function get_products_meta($products_query) {
    global $wpdb, $language;
      
    $products_query_result = $wpdb->get_results($products_query);
    
    if (count($products_query_result) == 0) {
        return NULL;
    }

    $products = array();
    $product_IDs = array();
    foreach ($products_query_result as $product) {
        if (isset($product->ID)) {
            $products[(string)$product->ID] = new Product();
            $products[(string)$product->ID]->title = $product->post_title;
            array_push($product_IDs, $product->ID);
        }
    }

    $products_query = "SELECT * FROM wp_postmeta AS postmeta
    INNER JOIN wp_posts AS posts
      ON postmeta.post_id = posts.ID
      WHERE postmeta.meta_key NOT LIKE '\_%'
      AND posts.ID IN (".implode(',', $product_IDs).")";
    
    $products_DTO = $wpdb->get_results($products_query);
    $products = transform_to_product_objects($products_DTO, $products);

    return $products;
  }
?>