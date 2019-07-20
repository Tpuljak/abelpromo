<?php function PackageCheckbox($is_checked = false) { ?>
    <div class="package-checkbox <?php echo $is_checked ? 'checked' : 'empty'; ?>" onclick="checkedChanged(this)">
      <input type="checkbox">
      <div class="package-checkbox-real">
      </div>
      <img src="<?php echo images; ?>/icons/delivery/box.svg" alt="" class="package">
      <?php Info('test'); ?>
    </div>
<?php } ?> 
