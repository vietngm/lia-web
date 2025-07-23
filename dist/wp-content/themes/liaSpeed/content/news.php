   <div class="news-carousel-title">
     <h2>Tin tức & Sự kiện</h2>
   </div>
   <ul class="news-carousel owl-carousel owl-theme js-news-carousel">
     <?php
		$arg = array(
			'post_type' => 'tin-tuc',
			'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => 6,
			'status' => array('publish', 'private')
		);
		$the_query = new WP_Query($arg);
			while ($the_query->have_posts()) : $the_query->the_post();
		?>
     <li class="news-item">
       <?php include get_template_directory() . '/loop/news.php'; ?>
     </li>
     <?php endwhile;wp_reset_query();?>
   </ul>