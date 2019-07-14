<?php
  global $language;

  update_language();

  $request_params = get_request_params();

  $filters = [''];

  if (isset($request_params['filters'])) {
    $filters = explode(',', $request_params['filters']);
  }
  
  $products = get_products($offset = 0, $how_many = 20, $filters);

  $products = array_values($products);

  //TODO: DELETE
  while (count($products) < 14) {
    $products = array_merge($products, $products);
  }

  $chunked = array_chunk($products, 5);
?>

<?php get_header(); ?>
<div class="menu-page-wrapper">
    <?php Sidebar('vertical'); ?>

    <main class="menu-grid">
        <?php
            $condition = 0;
            foreach($chunked as $index => $prods) {
                if ($index % 2 == 0) {
                    $condition = 2;
                } else {
                    $condition = 0;
                }

                foreach ($prods as $p_index => $p) {
                    ?>
                        <article class="menu-grid-item <?php echo ($p_index == $condition) ? 'menu-item-big' : ''; ?>"></article>
                    <?php
                }
            }
        ?>
    </main>

    <aside class="order-details">
        <?php Search(); ?>
        <?php FilterCheckbox('A - Z', 'all'); ?>
        <?php FilterCheckbox('Discounted', 'discounted', in_array('discounted', $filters)); ?>
        <?php FilterCheckbox('Featured', 'featured', in_array('featured', $filters)); ?>
        <?php FilterCheckbox('New products', 'new', in_array('new', $filters)); ?>
        <?php FilterCheckbox('Lowest price', 'lowest', in_array('lowest', $filters)); ?>
        <?php FilterCheckbox('Highest price', 'highest', in_array('highest', $filters)); ?>
    </aside>

    <?php get_footer(); ?>
</div>
