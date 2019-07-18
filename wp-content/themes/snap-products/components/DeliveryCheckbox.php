<?php function DeliveryCheckbox($arrows, $type, $help = false) { ?>
  <div class="delivery-checkbox empty" type="<?php echo $type; ?>" onclick="checkedChanged(this)">
    <input type="radio" name="delivery">
    <div class="checkbox"></div>
    <img src="<?php echo images; ?>/icons/arrows-<?php echo $arrows; ?>.svg" alt="" class="arrows">
    <img src="<?php echo images; ?>/icons/delivery/<?php echo $type; ?>.svg" alt="" class="time">
    <?php if($help) { ?>
      <?php Info($help); ?>
    <?php } ?>
  </div>
<?php } ?> 
