<?php
	$hide_category_icon = $args["hide_category_icon"] ?? false;
	$max_items = $args["max_items"] ? $args["max_items"] : 6;
	if ($max_items < 0) $max_items = 99999;
	$sticky = $args["sticky"] ?? false;
	$_term_categories = get_terms('service-category', array(
		'hide_empty' => false,
	));
	$term_categories = [];
	$term_category_children = [];
	$term_category_children_mapping = [];
	foreach ($_term_categories as $term_category) {
		if (!$term_category->parent) {
			array_push($term_categories, $term_category);
		} else {
			$term_category_children[$term_category->parent] = $term_category_children[$term_category->parent] ?? [];
			array_push($term_category_children[$term_category->parent], $term_category);
			$term_category_children_mapping[$term_category->parent] = $term_category_children_mapping[$term_category->parent] ?? [];
			array_push($term_category_children_mapping[$term_category->parent], $term_category->term_id);
		}
	}
	$args = array(
		"post_type" => "service",
		"posts_per_page" => -1,
	);
	$the_query_services = new WP_Query( $args );
	$all_services = [];
?>

<div class="product-section" data-max-items="<?= $max_items ?>">
  <div class="<?= $sticky ? "sticky top-[64px]" : "" ?> pt-3 bg-white">
    <div class="highlight-filter pb-3">
      <?php foreach ($term_categories as $term_category) :?>
      <div class="item cursor-pointer service-tab" data-id="<?= $term_category->term_id ?>">
        <div class="service-text"><?= $term_category->name ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <!-- <div class="w-full h-[3px] bg-gray-200"></div>
		<div class="adv-filter">
			<div class="flex items-center gap-2 flex-shrink-0">
				<img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/filter-gray.svg") ?>" />
				<div>Lọc</div>
			</div>
			<div class="flex overflow-x-auto gap-3 no-scrollbar">
				<select class="dropdown-select flex-shrink-0" placeholder="Sắp xếp theo" name="sort" placement="bottom-start">
					<option value="rating-desc">Đánh giá nhiều nhất</option>
					<option value="rating-asc">Đánh giá ít nhất</option>
					<option value="pricing-asc">Giá thấp nhất</option>
					<option value="pricing-desc">Giá cao nhất</option>
				</select>
				<select class="dropdown-select flex-shrink-0" multiple placeholder="Danh mục" name="category" placement="bottom-start" rows="2" data-modal-class="category-modal">
					<?php foreach ($term_category_children as $term_category_id => $term_category_children) : foreach ($term_category_children as $term_category_child) : ?>
					<option value="<?= $term_category_id ?>-<?= $term_category_child->term_id ?>"><?= $term_category_child->name ?></option>
					<?php endforeach; endforeach; ?>
				</select>
				<select class="dropdown-select flex-shrink-0" placeholder="Giá" name="price" placement="bottom-start" rows="2">
					<option value="0-999999">Dưới 1 triệu</option>
					<option value="1000000-3000000">1 - 3 triệu</option>
					<option value="3000000-5000000">3 - 5 triệu</option>
					<option value="5000000-10000000">5 - 10 triệu</option>
					<option value="10000000-20000000">10 - 20 triệu</option>
					<option value="20000000-999999999">Trên 20 triệu</option>
				</select>
				<select class="dropdown-select flex-shrink-0" placeholder="Độ tuổi" name="age" placement="bottom-end" rows="2">
				<option value="0-17">Dưới 18</option>
					<option value="18-25">18 - 25 tuổi</option>
					<option value="26-35">26 - 35 tuổi</option>
					<option value="36-45">36 - 45 tuổi</option>
					<option value="46-55">46 - 55 tuổi</option>
					<option value="55-999">Trên 55 tuổi</option>
				</select>
			</div>
		</div> -->
  </div>
  <div class="product-list grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2" id="product-list">
    <?php if ($the_query_services->have_posts()) : $index = $max_items; ?>
    <?php while ( $the_query_services->have_posts() ) : $index --; $the_query_services->the_post(); ?>
    <?php ob_start(); ?>
    <div class="col-span-1 product-list-item">
      <?php get_template_part( 'template-parts/service', 'summary' ); ?>
    </div>
    <?php 
                $fields = get_fields();
                $price = $fields["price"];
                $term_categories = get_the_terms(get_the_ID(), 'service-category');
                $category_ids = [];
                foreach($term_categories as $term_category) {
                    array_push($category_ids, $term_category->term_id);
                }

                $html = ob_get_clean();
                if ($index >= 0) echo $html;
                $html = str_replace("data-src", "src", $html);
                $service = array(
                    "html" => $html,
                    "rating" => $fields["rating"],
                    "price" => $price,
                    "minAge" => $fields["age"]["all"] == 1 ? 0 : $fields["age"]["from"],
                    "maxAge" => $fields["age"]["all"] == 1 ? 999 : $fields["age"]["to"],
                    "categoryIds" => $category_ids,
                );
                array_push($all_services, $service);
            ?>
    <?php endwhile; ?>
    <?php endif; wp_reset_postdata(); ?>
  </div>
  <div class="text-center mt-4">
    <button id="load-more" class="px-4 py-2 bg-purple-500 rounded">Xem thêm --> </button>
    <button id="hide-more" class="px-4 py-2 bg-gray-500 text-white rounded hidden">Ẩn đi</button>
  </div>

</div>

<head>
  <style>
  #load-more {
    transition: background-color 0.3s ease;
    /* font-size: 12px; */
  }

  #hide-more {
    background-color: #a0aec0;
  }
  </style>
</head>
<script>
const ALL_SERVICES_DATA = JSON.parse(<?= json_encode(json_encode($all_services, JSON_HEX_QUOT)) ?>).map(function(item) {
  item.rating = item.rating ? parseInt(item.rating) : 0;
  item.price = item.price ? parseInt(item.price) : 0;
  item.minAge = item.minAge ? parseInt(item.minAge) : 0;
  item.maxAge = item.maxAge ? parseInt(item.maxAge) : 0;
  return item;
});
const ALL_SERVICE_CATEGORIES_DATA = JSON.parse(
  <?= json_encode(json_encode($term_category_children_mapping, JSON_HEX_QUOT)) ?>);
</script>