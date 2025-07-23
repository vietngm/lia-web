<?php
  $thumb = get_field('anh_dai_dien', $post->ID);
?>
<a href="<?php echo get_permalink($post->ID); ?>" class='news-link'>
  <?php if ($thumb) { ?>
  <div class='news-thumb'>
    <img class="img aspect-square lazy" src="<?php echo $thumb['url'] ?>" alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } else { ?>
  <div class='news-noimage'>
    <img class="img aspect-square lazy" src="<?php echo get_theme_file_uri('assets/images/noimg64.png'); ?>" width="64"
      height="64" alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } ?>
  <div class="news-detail">
    <div class="news-title">
      <h4><?php the_title(); ?></h4>
    </div>
    <div class="news-more">
      <span><?php echo get_the_date('d/m/Y', $post->ID); ?></span>
      <span>Đọc thêm <i class="arrow-right"></i></span>
    </div>
  </div>
</a>