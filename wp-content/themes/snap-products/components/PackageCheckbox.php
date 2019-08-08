<?php function PackageCheckbox($is_checked = false) { 
  global $language;
  
  $info = array(
                  'HR' => "Prilagodite pakiranje proizvoda i proizvoda svojim imenom, a vrijednost odmah eksponencijalno raste, čime se dramatično povećava potencijalno zadržavanje i korištenje proizvoda.",
                  'EN' => "Personalise the product and product packaging with your name and the perceived value immediately increases exponentially thereby dramatically increasing the potential retention and utilisation of the product."
  );
  ?>
    <div class="package-checkbox <?php echo $is_checked ? 'checked' : 'empty'; ?>" onclick="checkedChanged(this)">
      <input type="checkbox">
      <div class="package-checkbox-real">
      </div>
      <img src="<?php echo images; ?>/icons/delivery/box.svg" alt="" class="package">
      <?php Info($info[$language]); ?>
    </div>
<?php }