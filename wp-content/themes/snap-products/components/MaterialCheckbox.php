<?php function MaterialCheckbox($state, $arrow, $type, $info = false) { ?>
    <div class="material-checkbox  <?php echo $state; ?>" type="<?php echo $type; ?>" onclick="checkedChanged(this)">
    <input type="checkbox" name="material">
    <div class="checkbox"></div>
    <img src="<?php echo images; ?>/icons/arrow<?php echo $arrow; ?>.svg" alt="" class="arrow">
    <img src="<?php echo images; ?>/type/<?php echo $type; ?>.png" alt="" class="type">
    <?php if($info) { ?>
      <?php Info($info); ?>
    <?php } ?>
  </div>
<?php } ?> 
