<?php
  global $language;

  update_language();
?>

<?php get_header(); ?>
<?php Sidebar(); ?>
<?php 
  $id = get_the_ID();

  if ($language == 'HR') {
    $title = get_field('hr_page_title', $id);
    $content = get_field('hr_page_content', $id);
  } else {
    $title = get_the_title();
    $content = get_page($id)->post_content;
  }
?>

<div>
  <h1><?php echo $title; ?></h1>
</div>
<div>
  <div>
    <?php echo $content; ?>
  </div>
</div>
<?php get_footer(); ?>