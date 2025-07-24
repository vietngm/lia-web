<?php get_header(); ?>

<?php $fields = get_fields(); ?>

<main class="is-news">
  <section class="section-booking-banner w-full h-[200px] relative px-4 flex items-center justify-center">
    <?php $image = get_the_post_thumbnail_url( ) ?>
    <img class="w-full h-full object-cover object-center absolute"
      src="<?= $image ? $image : get_theme_file_uri("assets/images/default-banner.jpg") ?>" />
    <div class="w-full h-full absolute bg-black bg-opacity-50"></div>
    <h1 class="relative z-20 text-white text-24 text-center font-bold uppercase"><?= get_the_title(); ?></h1>
  </section>

  <section class="section section-blog">
    <div class="container">
      <ul class="news-list">
        <?php
        $arg = array(
          'post_type' => 'tin-tuc',
          'orderby' => 'date',
          'order' => 'desc',
          'posts_per_page' => -1,
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
    </div>
  </section>
</main>

<?php get_footer(); ?>