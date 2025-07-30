<?php
  $thumb = get_field('anh_dai_dien', $post->ID);
  $description = get_field('description', $post->ID);
  $media = get_field('media_dai_dien', $post->ID);
  $unitPrice = get_field('unit_price', $post->ID);
  $rating = get_field('danh_gia', $post->ID);
  $ratingCount = get_field('sl_dg', $post->ID);
  $orderCount = get_field('sl_km', $post->ID);
  $firstPrice = $unitPrice ? $unitPrice[0] : [];
  $price = $firstPrice['gia_sp'] ?? 0;
  $discount = $firstPrice['gia_km'] ?? 0;
  $discountPrice = $price-($price * ($discount / 100));
?>
<a href="<?php echo get_permalink($post->ID); ?>" class='product-link'>
  <?php if ($thumb) { ?>
  <div class='product-thumb'>
    <img class="img aspect-square lazy" src="<?php echo $thumb['url'] ?>" alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } else { ?>
  <div class='product-noimage'>
    <img class="img aspect-square lazy" src="<?php echo get_theme_file_uri('assets/images/noimg64.png'); ?>" width="64"
      height="64" alt="<?php echo $post->post_title; ?>">
  </div>
  <?php } ?>
  <div class="product-detail">

    <div class="flex justify-between items-center mb-1.5">
      <div class="rating items-center gap-1">
        <div class="flex text-10" style="font-weight:800;">
          <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
          <span class="name"><?= $rating; ?></span>
          <span class="value">(<?php echo $ratingCount;?>)</span>
        </div>
        <span class="separator">|</span>
        <span class="text-10">Đã bán</span>
        <span class="text-10"><?= $orderCount; ?></span>
      </div>
    </div>

    <div class="product-title">
      <p><?php the_title(); ?></p>
    </div>
    <?php if($discount==0) {?>
    <div class="product-price">
      <span><?= number_format($price, 0, ",", ".") ?></span>
      <small><u>đ</u></small>
    </div>
    <?php } else{ ?>
    <div class="product-discount">
      <?php echo '-'.$discount.'%';?>
    </div>
    <div class="product-km">
      <div class="price-discount">
        <span><?= number_format($discountPrice, 0, ",", ".") ?></span>
        <small><u>đ</u></small>
      </div>
      <div class="price-through">
        <span><?= number_format($price, 0, ",", ".") ?></span>
        <small><u>đ</u></small>
      </div>
    </div>
    <?php } ?>
  </div>
</a>