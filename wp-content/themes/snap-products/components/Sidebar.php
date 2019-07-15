<?php function Sidebar($type='horizontal') { ?>
  <aside class="sidebar <?php echo $type; ?>">
    <ul>
      <li>
        <a href="<?php echo home_url('/menu?filters=writing'); ?>">
          <img src="<?php echo images; ?>/icons/pisaci-pribor.svg" alt="">
        </a>
      </li>
      <li>
        <a href="<?php echo home_url('/menu?filters=remotes'); ?>">
          <img src="<?php echo images; ?>/icons/upaljaci-i-privjesci.svg" alt="">
        </a>
      </li>
      <li>
        <a href="<?php echo home_url('/menu?filters=technology'); ?>">
          <img src="<?php echo images; ?>/icons/tehnologija.svg" alt="">
        </a>
      </li>
      <li>
        <a href="<?php echo home_url('/menu?filters=bottles'); ?>">
          <img src="<?php echo images; ?>/icons/boce.svg" alt="">
        </a>
      </li>
      <li>
        <a href="<?php echo home_url('/menu?filters=textile'); ?>">
          <img src="<?php echo images; ?>/icons/tekstil.svg" alt="">
        </a>
      </li>
      <li>
        <a href="<?php echo home_url('/menu?filters=stickers'); ?>">
          <img src="<?php echo images; ?>/icons/print.svg" alt="">
        </a>
      </li>
      <li>
        <a href="<?php echo home_url('/menu?filters=diaries'); ?>">
          <img src="<?php echo images; ?>/icons/rokovnici.svg" alt="">
        </a>
      </li>
      <li>
        <a href="#">
          <img src="<?php echo images; ?>/icons/pierre.svg" alt="">
        </a>
      </li>
    </ul>
  </aside>
<?php } ?>
