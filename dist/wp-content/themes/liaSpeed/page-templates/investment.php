<?php 
/**
 * Template name: Danh sách kêu gọi
 */
get_header(); 

function render_investment_item($post) {
  $investment_id = $post->ID;
  $investment_name = get_the_title($investment_id);
  $mohinh = get_field("dt_mh", $investment_id);
  $dia_chi = get_field('dt_dia_chi', $investment_id);
  $open_time = get_field('dt_nkt', $investment_id);
  $vondautu = get_field('dt_vdt', $investment_id);
  $vonkeugoi = get_field('dt_vkg', $investment_id);
  $trangthai = get_field('dt_ttdt', $investment_id);

  get_template_part('template-parts/investment', 'summary', compact(
    'investment_id', 'investment_name', 'mohinh', 'dia_chi', 'open_time', 'vondautu', 'vonkeugoi', 'trangthai'
  ));
}
?>

<main>
  <section class="section-investment">
    <div class="search-container">
      <div class="search-box">
        <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/search.svg") ?>" alt="Tìm kiếm" />
        <input type="text" placeholder="Tìm mô hình" id="search-investment" />
      </div>
    </div>

    <?php 
      $exclude_ids = [];
      $hot_posts = get_posts([
        'post_type' => 'investment',
        'post_status' => 'publish',
        'meta_key' => 'dt_hot',
        'meta_value' => 1,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => -1,
      ]);
    ?>

    <?php if ($hot_posts): ?>
    <div class="investment-hot">
      <div class="investment-hot-item">
        <h3 class="investment-hot-title">
          <img src="<?= get_theme_file_uri("assets/images/fire.png") ?>" alt="Hot">
          <span>Mô hình được săn đón nhất</span>
        </h3>
      </div>
      <div class="investment-hot-list owl-carousel owl-theme js-investment-hot-list">
        <?php foreach ($hot_posts as $post): ?>
        <?php $exclude_ids[] = $post->ID; ?>
        <div class="investment-carousel-item">
          <?php render_investment_item($post); ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <div class="container">
      <div class="investment-title">Mô hình khác</div>
      <div class="investment-list">
        <?php
          $other_posts = get_posts([
            'post_type' => 'investment',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post__not_in' => $exclude_ids,
          ]);
        ?>
        <?php if ($other_posts): ?>
        <?php foreach ($other_posts as $post): ?>
        <?php
              $dia_chi = get_field('dt_dia_chi', $post->ID);
              $investment_name = get_the_title($post->ID);
            ?>
        <div class="investment-item" data-address="<?= esc_attr($dia_chi) ?>"
          data-name="<?= esc_attr($investment_name) ?>">
          <?php render_investment_item($post); ?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>