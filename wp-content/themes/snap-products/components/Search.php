<?php function Search() { 
    global $language;
    ?>
    <div class="search">
        <input type="text" class="search-input" placeholder="<?php echo ($language == 'HR') ? 'Pretraži': 'Search'; ?>">
        <div style="display: flex; justify-content: center; align-items: center; cursor: pointer;" onclick="searchProducts()">
            <img style="max-width: 60%" src="<?php echo images; ?>/icons/search-icon.svg" />
        </div>
    </div>
<?php }