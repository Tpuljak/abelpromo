<?php
  global $language;

  update_language();
?>
      <footer>
        <div>
          <ul class="no-list-style">          
            <li><a href="#" style="font-weight: 900;font-size: 20px;">Information</a></li>
            <li><a href="#">Personal information</a></li>
            <li><a href="#">About Us</a></li>
          </ul>
          <ul class="no-list-style">          
            <li><a href="#" style="font-weight: 900;font-size: 20px;">Company</a></li>
            <li><a href="#">Delivery explained</a></li>
            <li><a href="#">Full Colour Printing</a></li>
            <li><a href="#">Artwork Services</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
          <ul class="no-list-style">
            <li><a href="#" style="font-weight: 900;font-size: 20px;"><?php echo ($language == 'HR') ? 'Kontakt' : 'Contact information'; ?></a></li>
            <li><a href="#">+385 95 3877 080</a></li>
            <li><a href="#">Smiljanićeva 12b</a></li>
            <li><a href="#">21000 Split, Croatia</a></li>
            <li><a href="mailto:sales@abelpromo.com">sales@abelpromo.com</a></li>
          </ul>
          <div style="display: flex; justify-content: flex-start; flex-direction: column;">
            <div>
              <a href="https://www.facebook.com/Abel-Promo-2331781420236824/"><img src="<?php echo images; ?>/social/fejs.svg" style="width: 40px; margin: 3px;"/></a>
              <a href="https://www.instagram.com/Abel_Promo/"><img src="<?php echo images; ?>/social/instagram.svg" style="width: 40px; margin: 3px;"/></a>
            </div>
            <div>
              <a href="https://twitter.com/Abel_Promo"><img src="<?php echo images; ?>/social/tviter.svg" style="width: 40px; margin: 3px;"/></a>
              <a href="https://www.linkedin.com/in/abel-promo-677b24189/"><img src="<?php echo images; ?>/social/linkedin.svg" style="width: 40px; margin: 3px;"/></a>
            </div>
          </div>
        </div>  
      </footer>
    <?php wp_footer(); ?>
  </body>
</html>
