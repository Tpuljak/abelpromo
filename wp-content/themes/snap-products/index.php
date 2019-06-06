<?php get_header(); ?>

<?php
  global $language;

  update_language();

  include(get_template_directory() . '/products/queries/get-products-query.php');

  var_dump(get_products());
?>

<?php
  get_search_form();
  if(have_posts()) {
    while(have_posts()) {
        the_post();
        ?> 
        <div>
            <?php echo the_content(); ?>
        </div>
        <?php
    }
  }
?>

<?php get_footer(); ?>
