   <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2" style="font-size:16px;color:#1A5477">
     Dịch vụ</h2>
   <div class="content-service mt-4">
     <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 ">
       <?php
					$args = array(
						"post_type" => "service",
						"posts_per_page" => -1,
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'doctors',
								'value' => '"'.get_the_ID().'"',
								'compare' => 'LIKE'
							),
						),
					);
					$the_query = new WP_Query( $args );
				?>
       <?php if ($the_query->have_posts()) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
       <div class="col-span-1 product-list-item">
         <?php get_template_part( 'template-parts/service', 'summary' ); ?>
       </div>
       <?php endwhile; endif; wp_reset_postdata(); ?>
     </div>
   </div>