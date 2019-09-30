<?php
  global $language;

  update_language();

  $request_params = get_request_params();

  $filters = [''];

  if (isset($request_params['filters'])) {
    $filters = explode(',', $request_params['filters']);
  }
  
  if (isset($request_params['search'])) {
    $filters['search'] = $request_params['search'];
  }

  $products = get_products($offset = 0, $how_many = 20, $filters);

  if ($products != NULL) {
    $products = array_values($products);

    $chunked = array_chunk($products, 5);     
  }
?>

<?php get_header(); ?>
<div class="menu-page-wrapper">
    <?php Sidebar('vertical'); ?>
  
    <?php
        if ($products != NULL) {
            ?> 
            <div style="float: left; width: 50%;">
            <main class="menu-grid"> <?php
            $condition = 0;
            foreach($chunked as $index => $prods) {
                if ($index % 2 == 0) {
                    $condition = 2;
                } else {
                    $condition = 0;
                }

                foreach ($prods as $p_index => $p) {
                    ?>
                        <article class="menu-grid-item <?php echo ($p_index == $condition) ? 'menu-item-big' : ''; ?>" onclick="redirectTo(this, '<?php echo $p->url; ?>', '<?php echo $language; ?>')">
                            <img src="<?php echo ($p->thumbnail); ?>" alt="" srcset="">
                        </article>
                    <?php
                }
            }
            ?> 
            </main> 
            <div style="display: flex; justify-content: center; width: 100%;">
                <div class="load-more" onclick="loadMore()"><?php echo ($language == 'HR') ? 'Učitaj više' : 'Load more'; ?></div>
                <div class="spinner"></div>
                <div class="no-more-products load-more" style="display: none;"><?php echo ($language == 'HR') ? 'Ne postoji više proizvoda u ovoj kategoriji' : 'No more produts in this category'; ?></div>
            </div>
            </div>
            <?php
        }
    ?>
    <?php
        if ($products == NULL) {
            ?> 
                <main style="float: left; width: 50%;">
                    <div class="no-products">
                        <?php 
                            echo ($language == 'HR') ? 'NE POSTOJE PROIZVODI OVE KATEGORIJE.' : 'NO PRODUCTS IN THIS CATEGORY.'; 
                        ?>
                    </div>
                </main>
            <?php
        }
    ?>

    <aside class="order-details">
        <?php Search(); ?>
        <?php FilterCheckbox(($language == 'HR') ? 'A - Ž' : 'A - Z', 'all', in_array('all', $filters)); ?>
        <?php FilterCheckbox(($language == 'HR') ? 'Sniženo' : 'Discounted', 'discounted', in_array('discounted', $filters)); ?>
        <?php FilterCheckbox(($language == 'HR') ? 'Istaknuto' : 'Featured', 'featured', in_array('featured', $filters)); ?>
        <?php FilterCheckbox(($language == 'HR') ? 'Novo' : 'New products', 'new', in_array('new', $filters)); ?>
        <?php FilterCheckbox(($language == 'HR') ? 'Najniža cijena' : 'Lowest price', 'lowest', in_array('lowest', $filters)); ?>
        <?php FilterCheckbox(($language == 'HR') ? 'Najviša cijena' : 'Highest price', 'highest', in_array('highest', $filters)); ?>
    </aside>

    <?php get_footer(); ?>
</div>
