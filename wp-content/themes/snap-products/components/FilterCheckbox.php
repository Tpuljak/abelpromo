<?php function FilterCheckbox($string, $type, $is_checked = false) { ?>
    <div class="filter-checkbox <?php echo ($is_checked) ? 'checked' : ''; ?>" type="<?php echo $type; ?>">
        <input type="checkbox" name="filter" >
        <div class="checkbox"></div>
        <?php echo $string; ?>
    </div>
<?php } ?> 
