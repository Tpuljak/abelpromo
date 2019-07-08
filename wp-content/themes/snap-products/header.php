<!doctype html>

<?php
    $urlParams = explode( '/', $_SERVER['REQUEST_URI'] );
?>

<html>
    <head>
        <?php wp_head(); ?>
        <meta name="viewport" content="width=1920">
    </head>
    <nav class="nav">
        <div class="nav-container">
            <a href="#">
                <img src="<?php echo images; ?>/icons/nav/email.svg" alt="">
            </a>
            <a href="#">
            <img src="<?php echo images; ?>/icons/nav/list.svg" alt="">
                Katalog
            </a>
            <a href="#">
            <img src="<?php echo images; ?>/icons/nav/contact.svg" alt="">
                Contact us
            </a>
        </div>
        <div class="nav-shortcuts">
            <a href="#">
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
