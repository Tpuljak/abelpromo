<?php
  global $language;

  update_language();
?>

<?php get_header(); ?>
<div class="product-page-wrapper">
    <?php Sidebar('vertical'); ?>

    <main class="product">

    <div class="product-title">Vienna mug</div>
    <img src="<?php echo images; ?>/title-break.png" alt="" class="title-break">
    <div class="product-about diagonal">
      <p>With a touchscreen nib and large print area,
the Contour™ Digital Touch is ideal for any promotional requirement. The stylus can be used on both capacitve and resistive touchscreen phones and tablets. The patented barrel has been designed to exploit the full potential of the digital printing process.</p>
      <div class="product-about-icons">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
        <img src="<?php echo images; ?>/icons/360print.svg" alt="">
      </div>
      <div class="product-scheme">
        <img src="<?php echo images; ?>/SCHEME.svg" alt="">
      </div>
      <div class="product-image">
        <img src="https://images-na.ssl-images-amazon.com/images/I/71jMZuJU42L._SX342_.jpg" alt="">
      </div>
    </div>

    <div class="break">
      <span>PRODUCT DETAILS</span>
    </div>

    <div class="product-details">
      <div>
        <label>M.O.Q.:</label>
        <div>
          <b>50</b>
        </div>
      </div>
      <div>
        <label>Lead time:</label>
        <div>
          5 working days
        </div>
      </div>
      <div>
        <label>Colours:</label>
        <div>
          <b>Body:</b> White <br>
          <b>Trim:</b> White, White, White, White, White, White, White
        </div>
      </div>
      <div>
        <label>Refill:</label>
        <div>
          Black, Blue
        </div>
      </div>
      <div>
        <label>Print area:</label>
        <div>
          <b>60</b> x <b>10(8)</b>mm
        </div>
      </div>
    </div>

    <div class="break">
      <span>PRICING</span>
    </div>

      <div class="product-table EU">
          <div>
            <div>
              50
            </div>
            <div>
              100
            </div>
            <div>
              250
            </div>
            <div>
              500
            </div>
            <div>
              1000
            </div>
          </div>
          <div>
            <div>
              0,55
            </div>
            <div>
              0,49
            </div>
            <div>
              0,42
            </div>
            <div>
              0,39
            </div>
            <div>
              0,35
            </div>
          </div>
      </div>

    </main>

    <aside class="order-details">
        <div class="colour">
          <div class="colour-title">Colour</div>
          <div class="colour-wrap">
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
            <img src="<?php echo images; ?>/title-break.png" alt="">
        </div>
        <?php MaterialCheckbox('unchecked', '-full', 'underprint', 'info'); ?>
        <?php MaterialCheckbox('empty', '-full-dotted', 'primer', 'info'); ?>
        <?php MaterialCheckbox('empty', '-lines', 'uv', 'info'); ?>
        <?php MaterialCheckbox('empty', '', 'engrave', 'info'); ?>
        <a class="contact-send product-buy" href="#"><?php echo ($language == 'HR') ? 'Pošalji' : 'Send'; ?></a>
    </aside>

    <?php get_footer(); ?>
</div>
