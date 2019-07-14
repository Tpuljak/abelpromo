<?php
  global $language;

  update_language();
?>

<?php get_header(); ?>
<div class="order-page-wrapper">
    <?php Sidebar('vertical'); ?>
    <?php echo do_shortcode('[contact-form-7 id="14" title="Contact form 1"]');?>
    <!-- <main class="order-form">
        <div class="input-field">
            <label>Product</label>
            <input type="text" placeholder="Product name">
        </div>
        <div class="input-field">
            <label>P. color</label>
            <select>
                <option value="1">boja 1</option>
                <option value="2">boja 2</option>
                <option value="3">boja 3</option>
            </select>
        </div>
        <div class="input-field">
            <label>Pieces</label>
            <input type="number" placeholder="250">
        </div>
        <div class="form-divider">
             <span>Customer details</span>
        </div>
        <div class="input-group input-group-label-140">
            <div class="input-field">
                <label>Name</label>
                <input type="text" placeholder="Hrvojka">
            </div>
            <div class="input-field">
                <label>Company</label>
                <input type="text" placeholder="Hrvojka d.o.o.">
            </div>
        </div>
        <div class="input-group input-group-label-140">
            <div class="input-field">
                <label>E-mail</label>
                <input type="text" placeholder="hrvojka69@gmail.com">
            </div>
            <div class="input-field">
                <label>Phone</label>
                <input type="number" placeholder="0912345678">
            </div>
        </div>
        <div class="input-field">
            <label>PID</label>
            <input type="number" placeholder="12345678910">
        </div>
        <div class="form-divider">
            <span>Delivery details</span>
        </div>  
        <div class="input-field">
            <label>Address 1</label>
            <input type="text" placeholder="Adresa">
        </div>
        <div class="input-field">
            <label>Address 2</label>
            <input type="text" placeholder="Adresa">
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label>City</label>
                <input type="text" placeholder="Solin">
            </div>
            <div class="input-field">
                <label>Region</label>
                <input type="number" placeholder="Splitsko dalmatinska">
            </div>
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label>Postal code</label>
                <input type="number" placeholder="21210">
            </div>
            <div class="input-field">
                <label>Country</label>
                <input type="number" placeholder="Srbija">
            </div>
        </div>
        <div class="input-field input-field-extended">
            <label>Additional comment</label>
            <textarea type="text" placeholder="moj komentar" minheight="125"></textarea>
        </div>
    </main> -->

    <aside class="order-details">
        <h1><?php echo ($language == 'HR') ? 'Dodatne &' : 'Additional &'; ?><br/><?php echo ($language == 'HR') ? 'dostavljačke opcije' : 'shipping options'; ?></h1>
        <?php PackageCheckbox(); ?> 
        <?php DeliveryCheckbox('green', 'regular', 'INFO BOX'); ?>
        <?php DeliveryCheckbox('orange', '7days'); ?>
        <?php DeliveryCheckbox('red', 'express'); ?>
        <div class="order-details-break">
            <img src="<?php echo images; ?>/border.png" alt="">
        </div>
        <?php MaterialCheckbox('unchecked', '-full', 'underprint', 'info'); ?>
        <?php MaterialCheckbox('empty', '-full-dotted', 'primer', 'info'); ?>
        <?php MaterialCheckbox('empty', '-lines', 'uv', 'info'); ?>
        <?php MaterialCheckbox('empty', '', 'engrave', 'info'); ?>
        <a class="contact-upload" href="#">
            <img src="<?php echo images; ?>/icons/upload.svg" alt="">
            <span><?php echo ($language == 'HR') ? 'Učitaj sliku' : 'Upload artwork'; ?> <br/> <?php echo ($language == 'HR') ? '(opcijonalno)' : '(optional)'; ?></span>
        </a>
        <a class="contact-send" href="#"><?php echo ($language == 'HR') ? 'Pošalji' : 'Send'; ?></a>
    </aside>

    <?php get_footer(); ?>
</div>
