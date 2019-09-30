<?php
  global $language;

  update_language();

  $request_params = get_request_params();

  $product = get_product(get_the_ID());

  if ($product) {
    $product = array_values($product)[0];
  }

  $options = map_additional_options($product);

  $prices = calculate_prices($product, 'regular');

  // var_dump($product);
?>

<?php get_header(); ?>
<div class="product-page-wrapper">
    <?php Sidebar('vertical'); ?>

    <main class="product" product-id="<?php echo get_the_ID(); ?>">

    <div class="product-title"><?php echo $product->title; ?></div>
    <img src="<?php echo images; ?>/title-break.png" alt="" class="title-break">
    <div class="product-about <?php echo $product->image_type; ?>">
      <p><?php echo $product->description; ?></p>
      <div class="product-about-icons">
      <?php 

        $images = get_field('product_icon_gallery', get_the_ID());
        if( $images ) { 
          foreach ($images as $img) {
            ?> <img src="<?php echo ($img['url']); ?>" alt="" srcset=""> <?php
          }
      ?>              
      <?php } ?>

      </div>
      <div class="product-scheme">
        <img src="<?php echo $product->line_drawing; ?>" alt="">
      </div>
      <div class="product-image">
        <img src="<?php echo $product->images[0]->image; ?>" colour="<?php echo strtolower(ltrim($product->images[0]->colour, '#')); ?>" alt="">
      </div>      
        <?php 
            for ($i = 1; $i < count($product->images); $i++) {
              ?>
              <div class="product-image">
                <img src="<?php echo $product->images[$i]->image; ?>" colour="<?php echo strtolower(ltrim($product->images[$i]->colour, '#')); ?>" style="opacity: 0" alt="">
              </div>
              <?php
          }
        ?>
    </div>

    <div class="break">
      <span><?php echo ($language == 'HR') ? 'DETALJI O PROIZVODU' : 'PRODUCT DETAILS'; ?></span>
    </div>

    <div class="product-details">
      <div>
        <label><?php echo ($language == 'HR') ? 'M.N.' : 'M.O.Q.'; ?>:</label>
        <div>
          <b><?php echo $product->moq; ?></b>
        </div>
      </div>
      <div>
        <label>Lead time:</label>
        <div>
          <?php echo $product->lead_time; ?>
        </div>
      </div>
      <div>
        <label><?php echo ($language == 'HR') ? 'Boje:' : 'Colours:'; ?></label>
        <div>
          <?php echo nl2br($product->colours_field); ?>
        </div>
      </div>
      <div>
        <label><?php echo ($language == 'HR') ? 'Punjenje:' : 'Refill:'; ?></label>
        <div>
          <?php echo $product->refill; ?>
        </div>
      </div>
      <div>
        <label><?php echo ($language == 'HR') ? 'Veličina printa:' : 'Print area:'; ?></label>
        <div>
          <b><?php echo $product->print_area['width']; ?></b> x <b><?php echo $product->print_area['height']; ?></b><?php echo $product->print_area['unit']; ?>
        </div>
      </div>
    </div>

    <div class="break">
      <span><?php echo ($language == 'HR') ? 'CIJENE' : 'PRICING'; ?></span>
    </div>

      <div class="product-table <?php echo $language; ?>">
          <div>
            <div>50</div>
            <div>100</div>
            <div>150</div>
            <div>250</div>
            <div>1000</div>
            <div>1001+</div>
          </div>
          <div>
            <?php 
              foreach ($prices as $price) {
                ?>
                <div class="price--number" original-price="<?php echo $price; ?>"><?php echo $price; ?></div>
                <?php
              }
            ?>
          </div>
      </div>

    </main>

    <aside class="order-details">
        <div class="colour">
          <div class="colour-title"><?php echo ($language == 'HR') ? 'Boja' : 'Colour'; ?></div>
          <div class="colour-wrap">
            <?php 
              foreach ($product->images as $img) {
                ?>
                  <div style="background-color: <?php echo $img->colour; ?>" class="colour-switch" colour-name="<?php echo $img->colour_name; ?>"></div>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="quantity">
          <div class="quantity-title"><?php echo ($language == 'HR') ? 'Količina' : 'Quantity'; ?></div>
          <div class="quantity-select">
            <span onclick="decrementQuantity(<?php echo $product->quantity_choosing_step; ?>, <?php echo $product->moq; ?>)">-</span>
            <span class="quantity--number">250</span>
            <span onclick="incrementQuantity(<?php echo $product->quantity_choosing_step; ?>)">+</span>
          </div>
        </div>
        <?php DeliveryCheckbox('green', 'regular', 'INFO BOX', true); ?>
        <?php DeliveryCheckbox('orange', '7days', false, false); ?>
        <?php DeliveryCheckbox('red', 'express', false, false); ?>
        <?php DeliveryCheckbox('darkred', '2days', false, false); ?>
        <?php DeliveryCheckbox('purple', '1day', false, false); ?>
        <div class="order-details-break">
            <img src="<?php echo images; ?>/title-break.png" alt="">
        </div>
        <?php 
          foreach ($options as $opt) {
            MaterialCheckbox($opt->checkbox, $opt->icon, $opt->name, $opt->info);
          }
        ?>
        <a class="contact-send product-buy" onclick="redirectToOrder('<?php echo $language; ?>')">
          <?php echo ($language == 'HR') ? 'Upit' : 'Quote'; ?>
        </a>
    </aside>

    <?php get_footer(); ?>
</div>