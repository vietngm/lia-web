
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
		.highlight-filter{
            padding: 12px ;
		}
        .highlight-filter .item{
            width: auto;
            padding: 6px 12px;
            border-radius: 24px;
        }
		.filter-doctor{
			padding-top: 16px;
			padding-bottom: 16px;
		}
		.dropdown-select-ui{
			border-radius: 24px;
		}
        <style>
	.service-tab{
		width: auto !important;
		display: flex !important;
		align-items: center !important;
		padding: 6px 16px !important;
		border-radius: 24px !important;
	}
	.service-tab.item-active{
		background-color: #EDFFE1 !important;
		color:#71AD67 !important;
		border-color: #71AD67 !important;
	}
</style>
<main>  
    <section class="section-doctor " style="padding-top:12px" >
        <h2 style="font-weight:700;padding:0px 12px">Danh sách chuyên viên </h2>
        <div class="highlight-filter">
            <?php foreach ($term_categories as $term_category) :?>
            <div class="item cursor-pointer service-tab" data-id="<?= $term_category->term_id ?>">
                <div class="text" style="font-size:14px;font-weight: 500"><?= $term_category->name ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="container gap-2 flex flex-col" >
            <?php
                $args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post_type' => 'practitioner',
                );
                $the_query = new WP_Query( $args );
            ?>
		    <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php 
                        $doctor_id = get_the_ID(); 
                        $service_categories = get_categories_by_doctor_id($doctor_id);
                        $services = get_posts(array(
                            'post_type' => 'service',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'meta_query' => array(
                                array(
                                    'key' => 'doctors',
                                    'value' => $doctor_id,
                                    'compare' => 'LIKE',
                                ),
                            ),
                        ));
                        $_service_category_ids = array_map(function ($value) {
                            return $value->term_id;
                        }, $service_categories);
                    ?>
                    <div class="docker-item" style="" data-id="<?= implode(",", $_service_category_ids) ?>">
                        <?php
                            get_template_part( 'template-parts/practitioner', 'summary', array(
                                "services" => $services, 
                                "doctor_id" => $doctor_id, 
                                "service_categories" => $service_categories,
                            ));
                        ?>
                        <hr style="border-top:1px solid #f2f2f2;margin-top:12px"/>
                    </div>
                <?php endwhile; ?>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<?php get_template_part( 'template-parts/practitioner', 'contact-modal' ); ?>
<?php get_footer(); ?>