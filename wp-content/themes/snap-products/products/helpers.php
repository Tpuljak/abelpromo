<?php
  class Product {}
  class Price {}
  class Image {}
  class Option {}

  function transform_to_product_objects($products_DTO, $products, $is_single) {
    global $language;
    $prepend = '';
    if ($language == 'HR') {
        $prepend .= 'hr_';
    }

    $pricing = array();
    $discounted_pricing = array();
    $images = array();

    for ($i = 0; $i < count($products_DTO); $i++) {
        $post_id = (string)$products_DTO[$i]->post_id;
        $products[$post_id]->ID = $products_DTO[$i]->post_id;

        $meta_key = $products_DTO[$i]->meta_key;
        $meta_value = $products_DTO[$i]->meta_value;

        switch($meta_key) {
          case $prepend.'product_description':
            $products[$post_id]->description = $meta_value;
            break;
          case 'thumbnail':
            $products[$post_id]->thumbnail = get_field('thumbnail', $post_id);
            break;
          case 'quantity_choosing_step':
            $products[$post_id]->quantity_choosing_step = $meta_value;
            break;
          case 'additional_options_primer':
            $products[$post_id]->primer = $meta_value;
            break;
          case 'additional_options_primer_price':
            $products[$post_id]->primer_price = $meta_value;
            break;
          case 'additional_options_white_underprint_price':
            $products[$post_id]->white_underprint_price = $meta_value;
            break;
          case 'additional_options_white_underprint':
            $products[$post_id]->white_underprint = $meta_value;
            break;
          case 'additional_options_engrave_price':
            $products[$post_id]->engrave_price = $meta_value;
            break;
          case 'additional_options_engrave':
            $products[$post_id]->engrave = $meta_value;
            break;
          case 'additional_options_uv_varnish':
            $products[$post_id]->uv_varnish = $meta_value;
            break;
          case 'additional_options_uv_varnish_price':
            $products[$post_id]->uv_varnish_price = $meta_value;
            break;
          case 'product_details_moq':
            $products[$post_id]->moq = $meta_value;
            break;
          case $prepend.'product_details_lead_time':
            $products[$post_id]->lead_time = $meta_value;
            break;
          case $prepend.'product_details_colours':
            $products[$post_id]->colours_field = $meta_value;
            break;
          case $prepend.'product_details_refill':
            $products[$post_id]->refill = $meta_value;
            break;
          case 'product_details_print_area_width':
            $products[$post_id]->print_area['width'] = $meta_value;
            break;
          case 'product_details_print_area_height':
            $products[$post_id]->print_area['height'] = $meta_value;
            break;
          case 'product_details_print_area_unit':
            $products[$post_id]->print_area['unit'] = $meta_value;
            break;
          case 'image_type':
            $products[$post_id]->image_type = ($meta_value) ? 'diagonal' : 'vertical';
            break;
          case 'line_drawing':
            $products[$post_id]->line_drawing = get_field('line_drawing', $post_id);
            break;
          case 'on_discount':
            $products[$post_id]->on_discount = $meta_value;
            break;
          case 'base_print_price':
            $products[$post_id]->base_print_price = $meta_value;
            break;
          case 'product_price':
            $products[$post_id]->product_price = $meta_value;
            break;
          case (preg_match('/discounted_pricing_.*/', $meta_key) ? true: false):
            $discounted_pricing[$post_id][$meta_key] = $meta_value;
            break;
          case (preg_match('/pricing_.*/', $meta_key) ? true : false):
            $pricing[$post_id][$meta_key] = $meta_value;
            break;
          case (preg_match('/product_images_.*/', $meta_key) ? true : false):
            $images[$post_id][$meta_key] = $meta_value;
            break;
          // default:
          //   var_dump('<pre>' . $meta_key . ' ' . $meta_value . '</pre>');
          //   break;
        }

        if($language == 'HR' && !isset($products[$post_id]->title)) {
          $products[$post_id]->title = $products_DTO[$i]->post_title;
        }
    }

    foreach($pricing as $post_id => $pricing_for_product) {
      $products[$post_id]->pricing = format_pricing($pricing_for_product);
    }

    foreach($discounted_pricing as $post_id => $discounted_pricing_for_product) {
      $products[$post_id]->discounted_pricing = format_pricing($discounted_pricing_for_product);
    }

    foreach($images as $post_id => $images_for_product) {
      if (!$is_single) {
        $first_image_key = array_keys($images_for_product)[0];
        $first_image_value = $images_for_product[$first_image_key];
        
        $images_for_product = array(
          $first_image_key => $first_image_value
        );
      }

      $products[$post_id]->images = format_images($images_for_product, $post_id);
    }

    return $products;
  }

  function format_pricing($pricing) {
    $pricing_formatted = array();

    foreach ($pricing as $key => $value) {
      $key_exploded = explode('_', $key);

      if (!$pricing_formatted[$key_exploded[1]]) {
        $pricing_formatted[$key_exploded[1]] = new Price();
      }

      if ($key_exploded[2] == 'price') {
        $pricing_formatted[$key_exploded[1]]->price = $value;
      } else {
        $pricing_formatted[$key_exploded[1]]->number_of_pieces = $value;
      }
    }

    return $pricing_formatted;
  }

  function format_images($images, $post_id) {
    $images_formatted = array();

    foreach ($images as $key => $value) {
      $key_exploded = explode('_', $key);

      if (!$images_formatted[$key_exploded[2]]) {
        $images_formatted[$key_exploded[2]] = new Image();
      }

      if ($key_exploded[3] == 'image') {
        $images_formatted[$key_exploded[2]]->image = get_field($key, $post_id);
      } else {
        $images_formatted[$key_exploded[2]]->colour = $value;
      }
    }

    return $images_formatted;
  }

  function get_products_meta($products_query, $is_single = false) {
    global $wpdb, $language;
      
    $products_query_result = $wpdb->get_results($products_query);
    
    if (count($products_query_result) == 0) {
        return NULL;
    }

    $products = array();
    $product_IDs = array();
    foreach ($products_query_result as $product) {
        if (isset($product->ID)) {
            $products[(string)$product->ID] = new Product();
            $products[(string)$product->ID]->title = $product->post_title;
            $products[(string)$product->ID]->category = ($language == 'HR') ? $product->hr_category : $product->category;
            $products[(string)$product->ID]->url = get_permalink($product->ID);            
            array_push($product_IDs, $product->ID);
        }
    }

    $products_query = "SELECT * 
    FROM wp_postmeta AS postmeta
    INNER JOIN wp_posts AS posts ON postmeta.post_id = posts.ID
      WHERE postmeta.meta_key NOT LIKE '\_%'
      AND posts.ID IN (".implode(',', $product_IDs).")";
    
    $products_DTO = $wpdb->get_results($products_query);
    $products = transform_to_product_objects($products_DTO, $products, $is_single);

    return $products;
  }

  function map_additional_options($product) {
    global $language;

    update_language();

    $options = array();

    for ($i = 0; $i < 4; $i++) {
      $options[$i] = new Option();
    }

    $options[0]->name = 'underprint';
    $options[1]->name = 'engrave';
    $options[2]->name = 'uv';
    $options[3]->name = 'primer';

    $options[0]->icon = '-full';
    $options[1]->icon = '';
    $options[2]->icon = '-lines';
    $options[3]->icon = '-full-dotted';

    $options[0]->checkbox = ($product->white_underprint) ? 'empty' : 'unchecked';
    $options[1]->checkbox = ($product->engrave) ? 'empty' : 'unchecked';
    $options[2]->checkbox = ($product->uv_varnish) ? 'empty' : 'unchecked';
    $options[3]->checkbox = ($product->primer) ? 'empty' : 'unchecked';

    $options[0]->info = ($language == 'HR') ? 'Dodavanje bijelog sloja ispod dizajna daje neprozirnu bazu koja dopušta da boje doista iskaču, dok bijela ne utječe na nijanse koje ste odabrali za vaš dizajn. Veliki napredak bez ikakvih nedostataka! Također daje vašem dizajnu dodatnu oštrinu, što dovodi do visokokvalitetnog ispisa.' :
                          'Adding a white layer underneath your design gives an opaque base that allows for the colours to truly pop out, while the white does not affect the shades you chose for your design. Great improvement with no drawbacks at all! It also gives your design additional sharpness, leading to high-quality printing.';
    $options[1]->info = ($language == 'HR') ? 'Graviranje je proces obrade rotirajućim rezačima za uklanjanje materijala pomicanjem rezača u objekt.' :
                          'Engraving is the process of machining using rotary cutters to remove material by advancing a cutter into a object.';
    $options[2]->info = ($language == 'HR') ? 'UV lak je prozirna tvrda zaštitna površina ili film. Primjenjuje se kao posljednji korak u postizanju sjajnog ili mat efekta te zaštite. Proizvodima daje dodatnu vrijednost i dubinu.' :
                          'Varnish is a clear transparent hard protective finish or film. It is applied as a final step to achieve gloss or satin effects and protection. It gives extra value and depth to the products.';
    $options[3]->info = ($language == 'HR') ? 'Prajmer omogućuje završnu boju da se lijepi mnogo bolje nego da se koristi sama. U tu svrhu temeljni premaz dizajniran je tako da prianja na površine i formira vezni sloj koji je bolje pripremljen za primanje boje.' :
                          'Primer allows finishing paint to adhere much better than if it were used alone. For this purpose, primer is designed to adhere to surfaces and to form a binding layer that is better prepared to receive the paint.';
    
    return $options;
  }
?>