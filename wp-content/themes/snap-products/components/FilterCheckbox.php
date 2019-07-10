<?php function FilterCheckbox($string, $type) { ?>
    <div class="filter-checkbox" type="<?php echo $type; ?>">
        <input type="checkbox" name="filter" >
        <div class="checkbox"></div>
        <?php echo $string; ?>
    </div>
<?php } ?> 
