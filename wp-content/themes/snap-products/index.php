<?php get_header(); ?>

<?php
  global $language;

  update_language();

  var_dump($language);
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
