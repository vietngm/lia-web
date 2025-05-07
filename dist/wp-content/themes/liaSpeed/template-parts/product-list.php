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
			for($i=0; $i<8; $i++){ 
		?>
   <li class="product-item">
     <?php include get_template_directory() . '/loop/product.php'; ?>
   </li>
   <?php } ?>
   <?php endwhile;wp_reset_query();?>
 </ul>