<?php get_header(); ?>
<?php $fields = get_fields(); ?>
<main class="is-news">
  <section class="section section-blog">
    <div class="container">
      <div class="flex gap-2 flex-wrap mb-4">
        <a class="text-primary font-semibold" href="/">Trang chủ</a>
        <span>›</span>
        <a class="text-primary font-semibold" href="/tin-tuc">Tin tức & Sự kiện</a>
        <span>›</span>
        <a class="" href="<?= the_permalink() ?>">Chi tiết tin tức</a>
      </div>
      <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
        style="font-size:16px;color:#1A5477"><?= get_the_title(); ?></h2>
      <article>
        <?php while (have_posts()): the_post(); ?>
        <div class="article-body">
          <?php $thumb = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
          <div class="news-thumb-detail rounded overflow-hidden mb-4">
            <?php if ($thumb) { ?>
            <img class="img lazy" src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
            <?php } else { ?>
            <img class="img lazy" src="<?php echo get_theme_file_uri('assets/images/noimg64.png'); ?>" width="64"
              height="64" alt="<?php echo $post->post_title; ?>">
            <?php } ?>
          </div>
          <?php the_content(); ?>
        </div>
        <?php endwhile;
        ?>
      </article>
      <div class="w-full" style="margin-bottom:16px"></div>
    </div>
  </section>
</main>
<?php get_footer(); ?>