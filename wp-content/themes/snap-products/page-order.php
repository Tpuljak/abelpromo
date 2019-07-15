<?php
  global $language;

  update_language();

  $request_params = get_request_params();

  if (isset($request_params['product_id'])) {
    $product_id = $request_params['product_id'];

    $product = get_product($product_id);

    if ($product) {
        $product = array_values($product)[0];
    }

    $options = map_additional_options($product);
  }
?>

<?php get_header(); ?>
<div class="order-page-wrapper">
    <?php Sidebar('vertical'); ?>
    <?php 
    // echo do_shortcode('[contact-form-7 id="165" title="Order"]');
    ?>
    <main class="order-form">
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Proizvod' : 'Product'; ?></label>
            <input type="text" name="product" autocomplete="on" placeholder="<?php echo ($language == 'HR') ? 'Ime proizvoda' : 'Product name';?>">
        </div>
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Boja p.' : 'P. color'; ?></label>
            <select name="colour" autocomplete="on">
                <option value="1">boja 1</option>
                <option value="2">boja 2</option>
                <option value="3">boja 3</option>
            </select>
        </div>
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Količina' : 'Pieces'; ?></label>
            <input name="quantity" autocomplete="on" type="number" placeholder="250">
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
            <input type="text" name="address" autocomplete="on" placeholder="Adresa">
        </div>
        <div class="input-field">
            <label><?php echo ($language == 'HR') ? 'Adresa dostave 2' : 'Address 2'; ?></label>
            <input type="text" name="address" autocomplete="on" placeholder="Adresa">
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Grad' : 'City'; ?></label>
                <input type="text" name="city" autocomplete="on"  placeholder="Solin">
            </div>
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Županija' : 'Region'; ?></label>
                <input type="number"  name="region" autocomplete="on" placeholder="Splitsko dalmatinska">
            </div>
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'P. broj' : 'Postal code'; ?></label>
                <input type="number" name="postal" autocomplete="on" placeholder="21210">
            </div>
            <div class="input-field">
                <label><?php echo ($language == 'HR') ? 'Država' : 'Country'; ?></label>
                <input type="number" name="coutry" autocomplete="on" placeholder="Srbija">
            </div>
        </div>
        <div class="input-field input-field-extended">
            <label><?php echo ($language == 'HR') ? 'Dodatan komentar' : 'Additional comment'; ?> </label>
            <textarea type="text" name="comment" autocomplete="on" placeholder="moj komentar" minheight="125"></textarea>
        </div>
    </main>


    <aside class="order-details">
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
        <a class="contact-upload" href="#">
        <input type="file">
            <img src="<?php echo images; ?>/icons/upload.svg" alt="">
            <span><?php echo ($language == 'HR') ? 'Učitaj sliku' : 'Upload artwork'; ?> <br/> <?php echo ($language == 'HR') ? '(opcijonalno)' : '(optional)'; ?></span>
        </a>
        <a class="contact-send" href="#"><?php echo ($language == 'HR') ? 'Pošalji' : 'Send'; ?></a>
    </aside>

    <?php get_footer(); ?>
</div>