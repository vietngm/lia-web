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
  <section>
    <div class="container">
      <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2 mt-4"
        style="font-size:16px;color:#1A5477"><?= get_the_title(); ?></h2>
      <article>
        <?php while (have_posts()): the_post(); ?>
        <div class="article-body">
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