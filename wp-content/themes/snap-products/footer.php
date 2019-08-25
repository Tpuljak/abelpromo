<?php
  global $language;

  update_language();
?>
      <footer>
        <div>
          <ul>
            <li><a href="#">Information</a></li>
            <li><a href="#">Personal information</a></li>
            <li><a href="#">About Us</a></li>
          </ul>
          <ul>
            <li><a href="#">Company</a></li>
            <li><a href="#">Delivery explained</a></li>
            <li><a href="#">Full Colour Printing</a></li>
            <li><a href="#">Artwork Services</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
          <ul class="no-list-style">
            <li><a href="#"><?php echo ($language == 'HR') ? 'Kontakt' : 'Contact information'; ?></a></li>
            <li><a href="#">+385 95 3877 080</a></li>
            <li><a href="#">Smiljanićeva 12b</a></li>
            <li><a href="#">21000 Split, Croatia</a></li>
            <li><a href="mailto:abelint@gmail.com">abelint@gmail.com</a></li>
          </ul>
        </div>  
      </footer>
    <?php wp_footer(); ?>
  </body>
</html>
