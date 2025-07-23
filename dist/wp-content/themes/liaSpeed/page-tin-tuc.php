<?php get_header(); ?>

<head>
  <link href="style.css" rel="stylesheet" />
</head>

<main class="is-news">
  <section>
    <div class="key-visual">
      <div class="loop owl-carousel owl-theme">
        <?php foreach ($key_visual as $item) { ?>
        <div class="key-item" style="background-image: url('<?=$item['url']?>')"></div>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="section section-blog">
    <div class="container">
      Thong tin dang cap nhat
    </div>
  </section>

</main>

<?php get_footer(); ?>