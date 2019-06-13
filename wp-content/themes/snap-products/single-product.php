<?php get_header(); ?>

<?php
  $product = get_product(get_the_ID());

  if ($product) {
    $product = array_values($product)[0];
  }
?>

<?php get_footer(); ?>