<?php get_header(); ?>

<?php
  $request_params = get_request_params();

  $product = get_product(get_the_ID());

  if ($product) {
    $product = array_values($product)[0];
  }

  var_dump($product);
?>

<?php get_footer(); ?>