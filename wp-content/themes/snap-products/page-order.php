<?php
  global $language;

  update_language();

  $request_params = get_request_params();

  $delivery_type = null;

  if (isset($request_params['delivery'])) {
    $delivery_type = $request_params['delivery'];
  }

  if (isset($request_params['product_id'])) {
    $product_id = $request_params['product_id'];

    $product = get_product($product_id);

    if ($product) {
        $product = array_values($product)[0];
    }

    $options = map_additional_options($product);

    foreach ($options as $opt) {
        if (isset($request_params[$opt->name]) && $request_params[$opt->name] == 1) {
            $opt->checkbox = 'checked';
        } 
    }
  }

  if (isset($request_params['active_colour'])) {
      $image_to_del = null;
      $colour_name = '';

      foreach ($product->images as $img) {
          if ($img->colour == "#".(string)$request_params['active_colour']) {
              $image_to_del = $img;
              $colour_name = $img->colour_name;
          }
      }

      if ($image_to_del != null) {
          unset($product->images[array_search($image_to_del, $product->images)]);
      }
  }
?>

<?php get_header(); ?>
<div class="order-page-wrapper">
    <?php Sidebar('vertical'); ?>
    <main class="order-form">
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Proizvod' : 'Product'; ?></label>
            <input type="text" class="input--product-title" name="product" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Ime proizvoda' : 'Product name';?>" value="<?php echo isset($product->title) ? $product->title : ''; ?>">
        </div>
        <div class="input-field" style="position: relative">
            <label><?php echo ($language == 'HR') ? 'Boja p.' : 'P. color'; ?></label>
            <select style="height: 74px !important;" class="colour-dropdown">
                <?php 
                    if (isset($request_params['active_colour'])) {
                        ?>
                            <option value="<?php echo $colour_name ?>" colour-hex="#<?php echo $request_params['active_colour']; ?>"><?php echo $colour_name; ?></option>
                        <?php
                    }
                ?>
                <?php
                    foreach ($product->images as $img) {
                        $colour = $img->colour_name;
                        ?>
                            <option value="<?php echo $colour; ?>" colour-hex="<?php echo $img->colour; ?>"><?php echo $colour; ?></option>
                        <?php
                    }
                ?>
            </select>
            <div class="colour-box" style="position: absolute; border: 1px solid black; right: 30px; top: 50%; transform: translateY(-50%); width: 30px; height: 30px; opacity: 0;"></div>
        </div>
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Količina' : 'Pieces'; ?></label>
            <div class="order-stepper">
            <span onclick="decrementQuantity(<?php echo $product->quantity_choosing_step; ?>, <?php echo $product->moq; ?>)">-</span>
            <span class="quantity--number"><?php echo (isset($request_params['quantity'])) ? $request_params['quantity'] : '50'; ?></span>
            <span onclick="incrementQuantity(<?php echo $product->quantity_choosing_step; ?>)">+</span>
            </div>
        </div>
        <div class="form-divider">
             <span><?php echo ($language == 'HR') ? 'Detalji naručitelja' : 'Customer details'; ?></span>
        </div>
        <div class="input-group input-group-label-140">
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Ime' : 'Name'; ?></label>
                <input type="text" name="name" autocomplete="on" placeholder="Hrvojka">
            </div>
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Firma' : 'Company'; ?></label>
                <input type="text" name="company" autocomplete="on" placeholder="Hrvojka d.o.o.">
            </div>
        </div>
        <div class="input-group input-group-label-140">
            <div class="input-field">
                <label>E-mail</label>
                <input type="text" name="email" autocomplete="on" placeholder="hrvojka69@gmail.com">
            </div>
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'TEL/MOB' : 'Phone'; ?></label>
                <input type="number" name="phone" autocomplete="on" placeholder="0912345678">
            </div>
        </div>
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'OIB' : 'PID'; ?></label>
            <input type="number" name="PID" autocomplete="on" placeholder="12345678910">
        </div>
        <div class="form-divider">
            <span><?php echo ($language == 'HR') ? 'Detalji dostave' : 'Delivery details'; ?></span>
        </div>  
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Adresa dostave 1' : 'Address 1'; ?></label>
            <input type="text" name="address" class="address--1" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Adresa' : 'Addressa'; ?>">
        </div>
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Adresa dostave 2' : 'Address 2'; ?></label>
            <input type="text" name="address" class="address--2" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Adresa' : 'Addressa'; ?>">
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Grad' : 'City'; ?></label>
                <input type="text" name="city" autocomplete="on"  placeholder="<?php echo ($language == 'HR') ? 'Split' : 'New York'; ?>">
            </div>
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Županija' : 'Region'; ?></label>
                <input type="text"  name="region" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Splitsko dalmatinska' : 'New York'; ?>">
            </div>
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'P. broj' : 'Postal code'; ?></label>
                <input type="number" name="postal" autocomplete="on" placeholder="21210">
            </div>
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Država' : 'Country'; ?></label>
                <input type="text" name="country" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Hrvatska' : 'USA'; ?>">
            </div>
        </div>
        <div class="input-field input-field-extended">
            <label><?php echo ($language == 'HR') ? 'Dodatan komentar' : 'Additional comment'; ?> </label>
            <textarea type="text" name="comment" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Moj komentar' : 'My comment'; ?>" minheight="125"></textarea>
        </div>
    </main>


    <aside class="order-details">
        <?php DeliveryCheckbox('green', 'regular', false, ($delivery_type != null && $delivery_type == 'regular') ? true : false); ?>
        <?php DeliveryCheckbox('orange', '7days', false, ($delivery_type != null && $delivery_type == '7days') ? true : false); ?>
        <?php DeliveryCheckbox('red', 'express', false, ($delivery_type != null && $delivery_type == 'express') ? true : false); ?>
        <?php DeliveryCheckbox('darkred', '2days', false, ($delivery_type != null && $delivery_type == '2days') ? true : false); ?>
        <?php DeliveryCheckbox('purple', '1day', false, ($delivery_type != null && $delivery_type == '1day') ? true : false); ?>
        <div class="order-details-break">
        <img src="<?php echo images; ?>/title-break.png" alt="">
        </div>
        <?php 
            if ($options) {
                foreach ($options as $opt) {
                    MaterialCheckbox($opt->checkbox, $opt->icon, $opt->name, $opt->info);
                }
            }
        ?>
        <a class="contact-upload" onclick="uploadFile()">
            <img src="<?php echo images; ?>/icons/upload.svg" alt="">
            <span><?php echo ($language == 'HR') ? 'Učitaj sliku' : 'Upload artwork'; ?> <br/> <?php echo ($language == 'HR') ? '(opcionalno)' : '(optional)'; ?></span>
        </a>
        <div class="file-input-wrapper">
        <input type="file" class="file-input empty" multiple onchange="uploadFileOnChange(this)">
        <div onclick="clearFiles()">X</div>
        </div>
        <a class="contact-send" onclick="sendOrder()"><?php echo ($language == 'HR') ? 'Pošalji' : 'Send'; ?></a>
    </aside>

    <?php get_footer(); ?>
</div>