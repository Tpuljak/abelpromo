<?php function Sidebar($type='horizontal') { ?>
  <?php 
  global $language;

  update_language();
  ?>
  <aside class="sidebar <?php echo $type; ?>">
    <ul>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=writing'); ?>">
          <img src="<?php echo images; ?>/icons/pisaci-pribor.svg" alt="">
          <span><?php echo  ($language == 'HR') ? 'Pisaći pribor' : 'Writing accessories'; ?></span></a>
      </li>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=remotes'); ?>">
          <img src="<?php echo images; ?>/icons/upaljaci-i-privjesci.svg" alt="">
                  <span><?php echo  ($language == 'HR') ? 'Upravljači i privjesci' : 'Remotes and keychains'; ?></span></a>
      </li>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=technology'); ?>">
          <img src="<?php echo images; ?>/icons/tehnologija.svg" alt="">
                  <span><?php echo  ($language == 'HR') ? 'Tehnologija' : 'Technology'; ?></span></a>
      </li>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=bottles'); ?>">
          <img src="<?php echo images; ?>/icons/boce.svg" alt="">
                  <span><?php echo  ($language == 'HR') ? 'Boce' : 'Bottles'; ?></span></a>
      </li>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=textile'); ?>">
          <img src="<?php echo images; ?>/icons/tekstil.svg" alt="">
                  <span><?php echo  ($language == 'HR') ? 'Tekstil' : 'Textile'; ?></span></a>
      </li>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=stickers'); ?>">
          <img src="<?php echo images; ?>/icons/print.svg" alt="">
                  <span><?php echo  ($language == 'HR') ? 'Print & Cut naljepnice' : 'Print & Cut stickers'; ?></span></a>
      </li>
      <li>
        <a href="<?php echo home_url((($language == 'HR') ? '/hr' : '') .'/menu?filters=diaries'); ?>">
          <img src="<?php echo images; ?>/icons/rokovnici.svg" alt="">
                  <span><?php echo  ($language == 'HR') ? 'Rokovnici' : 'Diaries'; ?></span></a>
      </li>
      <li>
        <a href="#">
          <img src="<?php echo images; ?>/icons/pierre.svg" alt="">
                  <span>Pierre Cardin</span></a>
      </li>
    </ul>
  </aside>
<?php }