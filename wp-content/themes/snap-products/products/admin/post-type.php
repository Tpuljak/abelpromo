<?php
  function register_product_post_type() {
      $productPostTypeOptions = array(
          'label' => 'Products',
          'singular_name' => 'Product',
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'query_var' => true,
          'rewrite' => array('slug' => 'products'),
          'menu_icon' => 'dashicons-cart',
          'supports' => 'title'
          );
      register_post_type('product', $productPostTypeOptions);
  }
  add_action('init', 'register_product_post_type');

  function product_category() {  
    register_taxonomy(  
        'product_category',
        'product',
        array(  
            'hierarchical' => true,  
            'labels' => array(
                'name' => 'Product categories',
                'singular_name' => 'Product category',
                'menu_name' => 'Categories',
            ),
            'query_var' => true,
            'supports' => array('slug', 'title'),
            'show_in_quick_edit' => true,
            'meta_box_cb' => 'product_categories_meta_box'
        )
    );  
}  
add_action( 'init', 'product_category');

function product_categories_meta_box( $post, $box ) {
	$defaults = array( 'taxonomy' => 'category' );
	if ( ! isset( $box['args'] ) || ! is_array( $box['args'] ) ) {
		$args = array();
	} else {
		$args = $box['args'];
	}
	$r        = wp_parse_args( $args, $defaults );
	$tax_name = esc_attr( $r['taxonomy'] );
	$taxonomy = get_taxonomy( $r['taxonomy'] );
	?>
	<div id="taxonomy-<?php echo $tax_name; ?>" class="categorydiv">
		<ul id="<?php echo $tax_name; ?>-tabs" class="category-tabs">
			<li class="tabs"><a href="#<?php echo $tax_name; ?>-all"><?php echo $taxonomy->labels->all_items; ?></a></li>
			<li class="hide-if-no-js"><a href="#<?php echo $tax_name; ?>-pop"><?php echo esc_html( $taxonomy->labels->most_used ); ?></a></li>
		</ul>

		<div id="<?php echo $tax_name; ?>-pop" class="tabs-panel" style="display: none;">
			<ul id="<?php echo $tax_name; ?>checklist-pop" class="categorychecklist form-no-clear" >
				<?php $popular_ids = wp_popular_terms_checklist( $tax_name ); ?>
			</ul>
		</div>

		<div id="<?php echo $tax_name; ?>-all" class="tabs-panel">
			<?php
			$name = ( $tax_name == 'category' ) ? 'post_category' : 'tax_input[' . $tax_name . ']';
			echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
			?>
			<ul id="<?php echo $tax_name; ?>checklist" data-wp-lists="list:<?php echo $tax_name; ?>" class="categorychecklist form-no-clear">
				<?php
				wp_terms_checklist(
					$post->ID,
					array(
						'taxonomy'     => $tax_name,
						'popular_cats' => $popular_ids,
					)
				);
				?>
			</ul>
		</div>
  </div>
	<?php
}
?>