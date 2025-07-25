<?php get_header(); ?>
<?php $fields = get_fields(); ?>

<main class="is-news">
  <section class="section section-blog">
    <div class="container">
      <div class="flex gap-2 flex-wrap mb-4">
        <a class="text-primary font-semibold" href="/">Trang chủ</a>
        <span>›</span>
        <a href="<?= get_permalink() ?>">Tin tức & Sự kiện</a>
      </div>
    </div>

    <div class="news-category">
      <ul class="news-category-list">
        <?php
          $taxonomy = 'news-category';
          $current_slug = get_query_var('news-category'); // Lấy slug danh mục đang active
        ?>

        <!-- Mục "Tất cả" -->
        <li class="news-category-item <?= empty($current_slug) ? 'active' : '' ?>">
          <a href="/tin-tuc" class="news-category-link">
            <span>Tất cả</span>
          </a>
        </li>

        <!-- Lặp danh mục -->
        <?php
        $terms = get_terms([
          'taxonomy' => $taxonomy,
          'hide_empty' => false,
          'parent' => 0,
          'orderby' => 'menu_order',
          'order' => 'ASC',
        ]);

        foreach ($terms as $term):
          $is_active = ($term->slug === $current_slug) ? 'active' : '';
        ?>
        <li class="news-category-item <?= $is_active ?>">
          <a href="<?= esc_url(get_term_link($term->slug, $taxonomy)) ?>" class="news-category-link">
            <span><?= esc_html($term->name) ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="container">
      <ul class="news-list">
        <?php
        $args = [
          'post_type' => 'tin-tuc',
          'orderby' => 'date',
          'order' => 'DESC',
          'posts_per_page' => -1,
          'post_status' => ['publish', 'private'],
        ];

        // Nếu có slug, thì thêm điều kiện lọc theo taxonomy
        if (!empty($current_slug)) {
          $args['tax_query'] = [
            [
              'taxonomy' => $taxonomy,
              'field'    => 'slug',
              'terms'    => $current_slug,
            ],
          ];
        }

        $the_query = new WP_Query($args);

        while ($the_query->have_posts()) : $the_query->the_post();
        ?>
        <li class="news-item">
          <?php include get_template_directory() . '/loop/news.php'; ?>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
      </ul>
    </div>
  </section>
</main>

<?php get_footer(); ?>