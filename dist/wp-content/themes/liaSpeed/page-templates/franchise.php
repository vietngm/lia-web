<?php 
/**
 * Template name: Mô hình đầu tư
 */
?>
<?php get_header();?>
<main>
  <section class="section-doctor" style="padding-top:12px">
    <h2 style="font-weight:700;padding:0px 12px">Mô hình đầu tư</h2>
    <div class="mt-1 p-3">
      <div class="search-container">
        <div class="search-box">
          <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/search.svg") ?>" alt="" />
          <input type="text" placeholder="Tìm địa điểm">
        </div>
      </div>
    </div>
    <div class="container gap-4 flex flex-col mb-8">
      <?php
        $args = array(
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_type' => 'branch',
        );
        $the_query = new WP_Query( $args );
      ?>
      <?php if ( $the_query->have_posts() ) : ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <?php 
        $doctor_id = get_the_ID(); 
        $chuyen_vien_ids = get_field("chuyen_vien", $doctor_id);
        $meta_query = array('relation' => 'OR');
        $dia_chi = get_field('address', $doctor_id);
        $branch_name = get_the_title();

        foreach ($chuyen_vien_ids as $id) {
        $meta_query[] = array(
          'key'     => 'doctors',
          'value'   => '"' . $id . '"',
          'compare' => 'LIKE',
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
      <div class="docker-item" style="" data-id="<?= implode(",", $_service_category_ids) ?>"
        data-address="<?= esc_attr($dia_chi) ?>" data-name="<?= esc_attr($branch_name) ?>">
        <?php
        get_template_part( 'template-parts/branch', 'summary', array(
        "services" => $services, 
        "doctor_id" => $doctor_id, 
        "service_categories" => $service_categories,
        "practitioners_ids" => $chuyen_vien_ids,
        ));
        ?>
      </div>
      <?php endwhile; ?>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>