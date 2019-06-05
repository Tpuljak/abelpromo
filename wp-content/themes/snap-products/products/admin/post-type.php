<?php
  function register_product_post_type() {
      $productPostTypeOptions = array(
          'label' => 'Products',
          'singular_name' => 'Product',
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'query_var' => true,
          'rewrite' => array('slug' => 'products'),
          'menu_icon' => 'dashicons-cart',
          'supports' => 'title'
          );
      register_post_type('product', $productPostTypeOptions);
  }
  add_action('init', 'register_product_post_type');
?>