<?php
  // $thumb = get_field('anh_dai_dien', $post->ID);
  $thumb = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<a href="<?php echo get_permalink($post->ID); ?>" class='news-link'>
  <?php if ($thumb) { ?>
  <div class='news-thumb'>
    <img class="img lazy" src="<?php echo $thumb; ?>" alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } else { ?>
  <div class='news-noimage'>
    <img class="img lazy" src="<?php echo get_theme_file_uri('assets/images/noimg64.png'); ?>" width="64" height="64"
      alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } ?>
  <div class="news-detail">
    <div class="news-title"><?php the_title(); ?></div>
    <div class="news-date">
      <span><?php echo get_the_date('d/m/Y', $post->ID); ?></span>
      <div class="news-more">Đọc thêm <span>&#10095;</span></div>
    </div>
  </div>
</a>