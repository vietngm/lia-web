 <ul class="product-list">
   <?php
		$arg = array(
			'post_type' => 'san-pham',
			'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => 16,
			'status' => array('publish', 'private')
		);
		$the_query = new WP_Query($arg);
			while ($the_query->have_posts()) : $the_query->the_post();
			$terms = wp_get_post_terms(get_the_ID(), 'product-category');
      $term_slugs = wp_list_pluck($terms, 'slug');
		?>
   <li class="product-item" data-categories="<?php echo esc_attr(implode(',', $term_slugs)); ?>">
     <?php include get_template_directory() . '/loop/product.php'; ?>
   </li>

   <?php endwhile;wp_reset_query();?>
 </ul>