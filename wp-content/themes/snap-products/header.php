<!doctype html>

<?php
    $urlParams = explode( '/', $_SERVER['REQUEST_URI'] );

    global $language;
?>

<html>
    <head>
        <?php wp_head(); ?>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800&display=swap&subset=latin-ext" rel="stylesheet">
    </head>

    <div class="only-desktop">
        <div>
            This page is only supported on desktop devices!
        </div>
    </div>

    <nav class="nav">
        <div class="nav-container">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo images; ?>/icons/nav/email.svg" alt="">
            </a>
            <a href="http://static.fliphtml5.com/web/demo/HM/index.html#p=4" target="blank">
                <img src="<?php echo images; ?>/icons/nav/list.svg" alt="">
                <?php echo ($language == 'HR') ? 'Katalog' : 'Catalog'; ?>
            </a>
            <a href="mailto:info@abelpromo.com">
                <img src="<?php echo images; ?>/icons/nav/contact.svg" alt="">
                <?php echo ($language == 'HR') ? 'Kontaktiraj nas' : 'Contact us'; ?>
            </a>
        </div>
        <div class="nav-shortcuts">
            <a href="<?php echo home_url('/menu?search-focus=yes'); ?>">
                <img src="<?php echo images; ?>/icons/nav/search.svg" alt="">
            </a>
            <a href="<?php echo home_url('/hr/'.get_url_append($urlParams)); ?>" class="<?php echo ($language == 'HR') ? 'active-language' : ''; ?>">            
                <img src="<?php echo images; ?>/icons/nav/hr.svg" alt="">
            </a>
            <a href="<?php echo home_url(get_url_append($urlParams)); ?>" class="<?php echo ($language == 'EN') ? 'active-language' : ''; ?>">            
                <img src="<?php echo images; ?>/icons/nav/en.svg" alt="">
            </a>
        </div>
    </nav>
