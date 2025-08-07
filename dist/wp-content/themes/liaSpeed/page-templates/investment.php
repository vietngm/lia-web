<?php 
/**
 * Template name: Danh sách kêu gọi
 */
?>
<?php get_header();?>
<main>
  <section class="section-investment">
    <div class="container">
      <div class="search-container">
        <div class="search-box">
          <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/search.svg") ?>" alt="" />
          <input type="text" placeholder="Tìm mô hình">
        </div>
      </div>
      <div class="investment-list">
        <?php
        $args = array(
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_type' => 'investment',
        );
        $the_query = new WP_Query( $args );
      ?>
        <?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php 
        $investment_id = get_the_ID(); 
        $mohinh = get_field("dt_mh", $investment_id);
        $dia_chi = get_field('dt_dia_chi', $investment_id);
        $open_time = get_field('dt_nkt', $investment_id);
        $investment_name = get_the_title();
        $vondautu = get_field('dt_vdt', $investment_id);
        $vonkeugoi = get_field('dt_vkg', $investment_id);
      ?>
        <div class="investment-item" data-address="<?= esc_attr($dia_chi) ?>"
          data-name="<?= esc_attr($investment_name) ?>">
          <?php
        get_template_part( 'template-parts/investment', 'summary', array(
        "investment_id" => $investment_id, 
        "investment_name" => $investment_name, 
        "mohinh" => $mohinh,
        "dia_chi" => $dia_chi,
        "open_time" => $open_time,
        "vondautu" => $vondautu,
        "vonkeugoi" => $vonkeugoi,
        ));
        ?>
        </div>
        <?php endwhile; ?>
        <?php endif; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>