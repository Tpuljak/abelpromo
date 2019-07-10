<?php
  global $language;

  update_language();

  $products = get_products(0, 10, ['discounted']);

  var_dump($products);
?>

<?php get_header(); ?>
  <?php Sidebar(); ?>

  <div class="slider">
    <div class="inner">
      <img src="<?php echo images . '/slider/FRESIA.jpg'; ?>" alt="" />
      <img src="<?php echo images . '/slider/MAJICE.jpg'; ?>" alt="" />
      <img src="<?php echo images . '/slider/TEHNIKA.jpg'; ?>" alt="" />
    </div>
  </div>

  <section class="branding-options">
    <h2>Branding Options</h2>
    <div>
      <article>
        <h3>Direct Digital Printing</h3>
        <p>Direct digital printing utilises ink jet technology, firing microscopic droplets of ink on top of one another to create an almost limitless spectrum of colours, gradients and shades enabling photo realistic images to be printed directly to the product surface.</p>
        <img src="<?php echo images . '/icons/uv-lamp@2x.png'; ?>" alt="">
      </article>
      <article>
        <h3>Digital Transfer</h3>
        <p>Digital transfers are produced using state of the art digital technology where photographic full colour quality images can be reproduced on a specially formulated film and heat transferred directly onto the product.</p>
        <img src="<?php echo images . '/icons/digital-transfer@2x.png'; ?>" alt="">
      </article>
      <article>
        <h3>Print & Cut</h3>
        <p>High-speed solvent printer cutter devices go beyond extraordinary to deliver a wide range of applications. Precision cutting capability gives you the ability to deliver custom and short-run items such as labels, T-shirt transfers, signage, displays banners, posters, exhibition graphics window clings and more...</p>
        <img src="<?php echo images . '/icons/screw@2x.png'; ?>" alt="">
      </article>
      <article>
        <h3>Engraving</h3>
        <p>Engraving is traditionally used to brand metal substrates and offerrs a higher perceived value than full colour digital printing. Concentrated energy is supplied via a metal rod in the form drill or a mill which removes the surface material to reveal the base metal.</p>
        <img src="<?php echo images . '/icons/pvc@2x.png'; ?>" alt="">
      </article>
      <article>
        <h3>Embroidery</h3>
        <p>Embroidery is the process of decorating fabric or other materials using a needle to apply thread. An embroidered T-shirt or a cap is a perfect form to customize your company logo and make an out- standing brand image</p>
        <img src="<?php echo images . '/icons/igla@2x.png'; ?>" alt="">
      </article>
    </div>
  </section>

  <section class="we-do">
    <div>
      <img src="<?php echo images . '/we-design@2x.png'; ?>" alt="">
      <img class="arrow" src="<?php echo images . '/icons/arrows-green.svg'; ?>" />
      <img src="<?php echo images . '/we-print@2x.png'; ?>" alt="">
      <img class="arrow" src="<?php echo images . '/icons/arrows-orange.svg'; ?>" />
      <img src="<?php echo images . '/we-grow@2x.png'; ?>" alt="">
    </div>
  </section>

  <section class="bottom-hero">
    <h1>Take another step!<span>Promote your self</span></h1>
    <div>
    <a href="#">Email us</a>
    <a href="#">Find us</a>
    </div>
  </section>

<?php get_footer(); ?>
