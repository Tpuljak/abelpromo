<?php
  global $language;

  update_language();
?>

<?php get_header(); ?>
<div class="menu-page-wrapper">
    <?php Sidebar('vertical'); ?>

    <main class="menu-grid">
        <article class="menu-grid-item menu-item-big"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item menu-item-big"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item menu-item-big"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item menu-item-big"></article>
        <article class="menu-grid-item"></article>
        <article class="menu-grid-item"></article>
    </main>

    <aside class="order-details">
        <?php Search(); ?>
        <?php FilterCheckbox('A - Z', 'all'); ?>
        <?php FilterCheckbox('Discounted', 'discounted'); ?>
        <?php FilterCheckbox('Featured', 'featured'); ?>
        <?php FilterCheckbox('New products', 'new'); ?>
        <?php FilterCheckbox('Lowest price', 'lowest'); ?>
        <?php FilterCheckbox('Highest price', 'highest'); ?>
    </aside>

    <?php get_footer(); ?>
</div>
