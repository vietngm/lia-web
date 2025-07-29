<?php 
/**
 * Template name: Danh sách chuyên viên
 */
?>
<?php get_header();?>

<?php
	$term_categories = get_terms('service-category', array(
		'hide_empty' => false,
		'parent' => 0,
	));
	$services = get_posts(array(
		"post_type" => "service",
		"posts_per_page" => -1,
	));
	$service_doctor_ids = [];
	$service_category_ids = [];
	foreach ($services as $service) {
		$service_doctor_ids[$service->ID] = get_field("doctors", $service->ID);
		$service_category_ids[$service->ID] = [];
		foreach (get_the_terms($service, "service-category") as $category) {
			array_push($service_category_ids[$service->ID], $category->term_id);
		}
	}

  // print_r($services);

	function get_categories_by_doctor_id($doctor_id) {
		global $service_doctor_ids;
		global $service_category_ids;
		global $term_categories;
		
		$category_ids = [];
		foreach ($service_doctor_ids as $service_id => $doctor_ids) {
			if (!is_array($doctor_ids)) {
				continue;
			}
	
			if (!in_array($doctor_id, $doctor_ids)) continue;
	
			if (isset($service_category_ids[$service_id]) && is_array($service_category_ids[$service_id])) {
				$category_ids = array_merge($category_ids, $service_category_ids[$service_id]);
			}
		}
	
		$categories = [];
		if (is_array($term_categories)) {
			foreach ($term_categories as $term_category) {
				if (in_array($term_category->term_id, $category_ids)) {
					array_push($categories, $term_category);
				}
			}
		}
	
		return $categories;
	}
?>

<style>
.highlight-filter {
  padding: 12px;
}

.highlight-filter .item {
  width: auto;
  padding: 6px 12px;
  border-radius: 24px;
}

.filter-doctor {
  padding-top: 16px;
  padding-bottom: 16px;
}

.dropdown-select-ui {
  border-radius: 24px;
}

.search-container {
  width: 100%;
  max-width: 400px;
}

.search-box {
  display: flex;
  align-items: center;
  background: #f6f6f6;
  border-radius: 20px;
  padding: 10px;
  width: 100%;
}

.search-box input {
  font-size: 16px;
  /* Ngăn chặn zoom khi focus */
}

.search-box i {
  color: #888;
  margin-right: 8px;
}

.search-box input {
  border: none;
  outline: none;
  background: transparent;
  flex: 1;
  font-size: 14px;
  color: #333;
}

.filter-sort {
  display: flex;
  justify-content: space-around;
  width: 100%;
  max-width: 400px;
  margin-top: 15px;
}

.filter-btn,
.sort-btn {
  background: transparent;
  border: none;
  font-size: 14px;
  color: #333;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.filter-btn i,
.sort-btn i {
  margin-left: 5px;
}
</style>

<head>

</head>

<main>
  <section class="section-doctor " style="padding-top:12px">
    <h2 style="font-weight:700;padding:0px 12px">Danh sách trung tâm 1</h2>
    <div class="mt-1 p-3">
      <div class="search-container">
        <div class="search-box">
          <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/search.svg") ?>" alt="" />
          <input type="text" placeholder="Tìm địa điểm">
        </div>
      </div>
      <div class="filter-sort">
        <button class="filter-btn gap-1">
          Bộ lọc <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/filter.svg") ?>" alt="" />
        </button>
        <button class="sort-btn gap-1">
          Xếp theo <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/sort.svg") ?>" alt="" />
        </button>
      </div>
    </div>
    <div class="container gap-2 flex flex-col">
      <?php
                $args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post_type' => 'branch',
                );
                $the_query = new WP_Query( $args );
// echo "<pre>";
//                 print_r($the_query);
                // echo "</pre>";
            ?>
      <?php if ( $the_query->have_posts() ) : ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <?php 
                        $doctor_id = get_the_ID(); 
                        $service_categories = get_categories_by_doctor_id(get_field("chuyen_vien", $doctor_id));

                        print_r(get_field("chuyen_vien", $doctor_id));

                        $chuyen_vien_ids = get_field("chuyen_vien", $doctor_id); // $chuyen_vien_ids là mảng các IDs

// Tạo meta_query
$meta_query = array('relation' => 'OR');

foreach ($chuyen_vien_ids as $id) {
    $meta_query[] = array(
        'key'     => 'doctors',
        'value'   => '"' . $id . '"', // Phải có dấu " để so khớp với mảng serialized
        'compare' => 'LIKE', // So sánh LIKE trong mảng
    );
}

                        $services = get_posts(array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_query' => $meta_query,
));
                        $_service_category_ids = array_map(function ($value) {
                            return $value->term_id;
                        }, $service_categories);
                    ?>
      <div class="docker-item" style="" data-id="<?= implode(",", $_service_category_ids) ?>">
        <?php
                            get_template_part( 'template-parts/branch', 'summary', array(
                                "services" => $services, 
                                "doctor_id" => $doctor_id, 
                                "service_categories" => $service_categories,
                            ));
                        ?>
        <hr style="border-top:1px solid #f2f2f2;margin-top:20px" />
      </div>
      <?php endwhile; ?>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>