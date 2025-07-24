<?php get_header(); ?>
<?php $fields = get_fields(); ?>

<main class="is-news">
  <section class="section section-blog">
    <div class="container">
      <div class="flex gap-2 flex-wrap mb-4">
        <a class="text-primary font-semibold" href="/">Trang chủ</a>
        <span>›</span>
        <a href="<?= the_permalink() ?>">Tin tức & Sự kiện</a>
      </div>
    </div>

    <div class="news-category">
      <ul class="news-category-list">
        <li class="news-category-item active">
          <a href="/tin-tuc" class="news-category-link">
            <span>Tất cả</span>
          </a>
        </li>
        <?php
          $taxonomy = 'news-category';
          $terms = get_terms(
            $taxonomy, array(
              'hide_empty' => 0,
              'parent' => 0,
              'orderby' => 'menu_order',
              'order' => 'ASC',
            )
          );
        foreach($terms as $term){
          $args = array(
            "orderby" => "slug",
            'hide_empty'    => false, 
            'hierarchical'  => true, 
            'parent'        => $term->term_id
          ); 
        ?>
        <li class="news-category-item">
          <a href="<?php echo get_term_link($term->slug,$taxonomy);?>" class="news-category-link">
            <span><?php echo $term->name; ?></span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </div>

    <div class="container">
      <ul class="news-list">
        <?php
        $arg = array(
          'post_type' => 'tin-tuc',
          'orderby' => 'date',
          'order' => 'desc',
          'posts_per_page' => -1,
          'status' => array('publish', 'private'),
          'tax_query' => array(
            array(
              'taxonomy' => 'news-category',
              'field' => 'slug',
              'terms' => get_query_var('news-category'),
            ),
          ),
        );
        $the_query = new WP_Query($arg);
          while ($the_query->have_posts()) : $the_query->the_post();
        ?>
        <li class="news-item">
          <?php include get_template_directory() . '/loop/news.php'; ?>
        </li>
        <?php endwhile;wp_reset_query();?>
      </ul>
    </div>
  </section>
</main>

<?php get_footer(); ?>