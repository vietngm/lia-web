<?php
  $productThumb = get_field('anh_dai_dien', $post->ID);
  $description = get_field('description', $post->ID);
  $media = get_field('media_dai_dien', $post->ID);
  $unitPrice = get_field('unit_price', $post->ID);
  $rating = get_field('danh_gia', $post->ID);
  $ratingCount = get_field('sl_dg', $post->ID);
  $orderCount = get_field('sl_km', $post->ID);
  $firstPrice = $unitPrice ? $unitPrice[0] : [];
  $productPrice = floatval($firstPrice['gia_sp'] ?? 0);
  $productDiscount = floatval($firstPrice['gia_km'] ?? 0);
  $productDiscountPrice = $productPrice - ($productPrice * ($productDiscount / 100));
?>

<?php if ($productThumb) { ?>
<div class='product-thumb'>
  <a href="<?php echo get_permalink($post->ID); ?>" class='product-link'>
    <img class="img aspect-square lazy" src="<?= $productThumb['url'] ?>" alt="<?php echo $post->post_title; ?>">
  </a>
</div>
<?php } else { ?>
<div class='product-noimage'>
  <a href="<?php echo get_permalink($post->ID); ?>" class='product-link'>
    <img class="img aspect-square lazy" src="<?php echo get_theme_file_uri('assets/images/noimg64.png'); ?>" width="64"
      height="64" alt="<?php echo $post->post_title; ?>">
  </a>
</div>
<?php } ?>
<div class="product-detail">

  <div class="flex justify-between items-center">
    <div class="rating items-center gap-1">
      <div class="flex text-10 rating-icon" style="font-weight:800;">
        <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
        <span class="name"><?= $rating; ?></span>
        <span class="value">(<?php echo $ratingCount;?>)</span>
      </div>
      <span class="separator">|</span>
      <span class="text-10">Đã bán</span>
      <span class="text-10"><?= $orderCount; ?></span>
    </div>
  </div>
  <a href="<?php echo get_permalink($post->ID); ?>" class='product-link'>
    <span class="product-title">
      <?php the_title(); ?>
    </span>
  </a>
  <?php if($productDiscount==0) {?>
  <div class="product-price">
    <span><?= number_format($productPrice, 0, ",", ".") ?></span>
    <small><u>đ</u></small>
  </div>
  <?php } else{ ?>
  <div class="product-discount">
    <?php echo '-'.$productDiscount.'%';?>
  </div>
  <div class="product-km">
    <div class="price-discount">
      <span><?= number_format($productDiscountPrice, 0, ",", ".") ?></span>
      <small><u>đ</u></small>
    </div>
    <div class="price-through">
      <span><?= number_format($productPrice, 0, ",", ".") ?></span>
      <small><u>đ</u></small>
    </div>
  </div>
  <?php } ?>
</div>
<button class="btn btn-buy-now js-buy-now"
  data-price="<?= $productDiscountPrice ? $productDiscountPrice : $productPrice ?>" data-title="<?= get_the_title() ?>"
  data-id="<?= get_the_ID() ?>" data-image="<?= $productThumb['url'] ?>">Mua ngay</button>