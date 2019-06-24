<?php
  global $language;

  update_language();
?>

<?php get_header(); ?>
<div class="order-page-wrapper">
    <?php Sidebar('vertical'); ?>
    <main class="order-form">
        <div class="input-field">
            <label>Proizvod</label>
            <input type="text" placeholder="Ime proizvoda">
        </div>
        <div class="input-field">
            <label>Boja p.</label>
            <select>
                <option value="1">boja 1</option>
                <option value="2">boja 2</option>
                <option value="3">boja 3</option>
            </select>
        </div>
        <div class="input-field">
            <label>Količina</label>
            <input type="number" placeholder="250">
        </div>
        <div class="form-divider">
             <span>Detalji naručitelja</span>
        </div>
        <div class="input-group input-group-label-140">
            <div class="input-field">
                <label>Ime</label>
                <input type="text" placeholder="Hrvojka">
            </div>
            <div class="input-field">
                <label>Firma</label>
                <input type="text" placeholder="Hrvojka d.o.o.">
            </div>
        </div>
        <div class="input-group input-group-label-140">
            <div class="input-field">
                <label>Mail</label>
                <input type="text" placeholder="hrvojka69@gmail.com">
            </div>
            <div class="input-field">
                <label>TEL/MOB</label>
                <input type="number" placeholder="0912345678">
            </div>
        </div>
        <div class="input-field">
            <label>OIB</label>
            <input type="number" placeholder="12345678910">
        </div>
        <div class="form-divider">
            <span>Detalji dostave</span>
        </div>  
        <div class="input-field">
            <label>Adrea dostave 1</label>
            <input type="text" placeholder="Adresa">
        </div>
        <div class="input-field">
            <label>Adrea dostave 2</label>
            <input type="text" placeholder="Adresa">
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label>Grad</label>
                <input type="text" placeholder="Solin">
            </div>
            <div class="input-field">
                <label>Županija</label>
                <input type="number" placeholder="Splitsko dalmatinska">
            </div>
        </div>
        <div class="input-group input-group-label-160">
            <div class="input-field">
                <label>P. broj</label>
                <input type="number" placeholder="21210">
            </div>
            <div class="input-field">
                <label>Država</label>
                <input type="number" placeholder="Srbija">
            </div>
        </div>
        <div class="input-field input-field-extended">
            <label>Additional comment</label>
            <textarea type="text" placeholder="moj komentar" minheight="125"></textarea>
        </div>
    </main>

    <aside class="order-details">
        <h1>Additional &<br/>shipping options</h1>
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
            <span>Upload artwork <br/> (optional)</span>
        </a>
        <a class="contact-send" href="#">Send</a>
    </aside>

    <?php get_footer(); ?>
</div>
