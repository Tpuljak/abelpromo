<?php get_header(); ?>

<?php
  $request_params = get_request_params();

  $filters = [''];

  if (isset($request_params['filters'])) {
    $filters = explode(',', $request_params['filters']);
  }
  
  $products = get_products($offset = 0, $how_many = -1, $filters);
?>

<?php get_footer(); ?>