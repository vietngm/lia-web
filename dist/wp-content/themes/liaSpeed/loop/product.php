<a href="<?php echo get_permalink($post->ID); ?>" class='product-link'>
  <?php if (has_post_thumbnail()) { ?>
  <div class='product-thumb'>
    <?php the_post_thumbnail('full', array('class' => 'img-responsive img-view')); ?>
  </div>
  <?php } else { ?>
  <div class='product-noimage'>
    <img src="<?php echo get_site_url(); ?>/assets/images/noimg64.png" width="64" height="64"
      alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } ?>
  <div class="product-title">
    <?php
    $thumb = get_field('anh_dai_dien', $post->ID);
  $description = get_field('description', $post->ID);
  $media = get_field('media_dai_dien', $post->ID);
  // if ($description) {
  //   echo '<div class="product-description">' . $description . '</div>';
  // }
echo '<pre>';
  echo 'Anh dai dien<br/>';
  echo $thumb['url'];
  echo '<br/>Loai media<br/>';
  echo $media.'<br/>';

  echo 'Mo ta<br/>';
  echo getExcerptLimit($description, 100);
  $price = get_field('gia_sp', $post->ID);
  if ($price) {
    echo '<div class="product-price">' . $price . '</div>';
  }
  ?>
    Tieu de
    <?php the_title(); ?>
    <?php echo '</pre>'; ?>
  </div>
</a>