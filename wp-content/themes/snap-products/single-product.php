<?php
  global $language;

  update_language();

  $request_params = get_request_params();

  $product = get_product(get_the_ID());

  if ($product) {
    $product = array_values($product)[0];
  }

  $options = map_additional_options($product);
  // var_dump($product);
  var_dump($options);
?>

<?php get_header(); ?>
<div class="product-page-wrapper">
    <?php Sidebar('vertical'); ?>

    <main class="product">

    <div class="product-title"><?php echo $product->title; ?></div>
    <img src="<?php echo images; ?>/title-break.png" alt="" class="title-break">
    <div class="product-about <?php echo $product->image_type; ?>">
      <p><?php echo $product->description; ?></p>
      <div class="product-about-icons">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
      </div>
      <div class="product-scheme">
        <img src="<?php echo $product->line_drawing; ?>" alt="">
      </div>
      <div class="product-image">
        <img src="<?php echo $product->images[0]->image; ?>" alt="">
      </div>
    </div>

    <div class="break">
      <span><?php echo ($language == 'HR') ? 'DETALJI O PROIZVODU' : 'PRODUCT DETAILS'; ?></span>
    </div>

    <div class="product-details">
      <div>
        <label>M.O.Q.:</label>
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
        <label>Colours:</label>
        <div>
          <?php echo nl2br($product->colours_field); ?>
        </div>
      </div>
      <div>
        <label>Refill:</label>
        <div>
          <?php echo $product->refill; ?>
        </div>
      </div>
      <div>
        <label>Print area:</label>
        <div>
          <b><?php echo $product->print_area['width']; ?></b> x <b><?php echo $product->print_area['height']; ?></b><?php echo $product->print_area['unit']; ?>
        </div>
      </div>
    </div>

    <div class="break">
      <span>PRICING</span>
    </div>

      <div class="product-table EU">
          <div>
            <?php 
              foreach ($product->pricing as $price) {
                ?>
                <div><?php echo $price->number_of_pieces; ?></div>
                <?php
              }
            ?>
          </div>
          <div>
            <?php 
              foreach ($product->pricing as $price) {
                ?>
                <div><?php echo $price->price; ?></div>
                <?php
              }
            ?>
          </div>
      </div>

    </main>

    <aside class="order-details">
        <div class="colour">
          <div class="colour-title">Colour</div>
          <div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
            <div style="background-color: red"></div>
          </div>
        </div>
        <div class="quantity">
          <div class="quantity-title">Quantity</div>
          <div class="quantity-select">
            <span>-</span>
            <span>250</span>
            <span>+</span>
          </div>
        </div>
        <h1><?php echo ($language == 'HR') ? 'Dodatne &' : 'Additional &'; ?><br/><?php echo ($language == 'HR') ? 'dostavljačke opcije' : 'shipping options'; ?></h1>
        <?php PackageCheckbox(); ?> 
        <?php DeliveryCheckbox('green', 'regular', 'INFO BOX'); ?>
        <?php DeliveryCheckbox('orange', '7days'); ?>
        <?php DeliveryCheckbox('red', 'express'); ?>
        <div class="order-details-break">
            <img src="<?php echo images; ?>/border.png" alt="">
        </div>
        <?php 
          foreach ($options as $opt) {
            MaterialCheckbox($opt->checkbox, $opt->icon, $opt->name, $opt->info);
          }
        ?>
        <a class="contact-send" href="#"><?php echo ($language == 'HR') ? 'Pošalji' : 'Send'; ?></a>
    </aside>

    <?php get_footer(); ?>
</div>