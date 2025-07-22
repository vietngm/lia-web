<?php
	$fields = get_fields();
	$price = $fields["price"] ?? 0;
	$image = bfi_thumb(get_the_post_thumbnail_url() , array("width"=>400, 'crop'=>false));
	$discountPrice = $fields["discountPrice"] ? $fields["discountPrice"] : 0;
	$discountPercentage = ($price > 0 && $discountPrice < $price) 
    ? round((($price - $discountPrice) / $price) * 100) 
    : 0;
?>
<a href="<?= get_permalink() ?>" class="overflow-hidden h-full flex flex-col rounded-1.5">
  <img class="img aspect-square lazy" data-src="<?= $image ?>" />
  <div class="flex-1 flex flex-col border-1 border-t-0 border-gray-300 rounded-b-1.5 p-2">
    <div class="flex justify-between items-center mb-1.5">
      <div class="flex items-center gap-1">
        <div class="rating text-10" style="font-weight:800;margin-bottom: -2px;">
          <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
          <span class="name"><?= $fields["rating"] ?></span>
          <span class="value">
            (<?= $fields["rating_number"] ?>)
          </span>
        </div>
        <span class="text-10" style="opacity: 0.5;">|</span>
        <span class="text-10">Đặt</span>
        <span class="text-10"><?= $fields["client_number"] ?></span>
      </div>
    </div>
    <h3 class="text-12 text-service-title line-clamp-2 mb-0"><?= get_the_title() ?></h3>
    <!-- <div class="line-clamp-2 text-12 text-gray-600"><?= $fields["note"] ?></div> -->
    <div class="text-12 mt-2">
      <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
      <div class="flex items-center">
        <span class="discount-percentage">
          - <?= $discountPercentage ?>%
        </span>
      </div>
      <div class="flex items-center justify-between mt-1">
        <span class="text-price ml-2" style="font-size:14px">
          <?= number_format($discountPrice, 0, ",", ".") ?><small>đ</small>
        </span>
        <span class="text-gray-400 line-through opacity-70" style="color:#ccc;font-size:12px">
          <?= number_format($price, 0, ",", ".") ?><small>đ</small>
        </span>
      </div>

      <?php else : ?>
      <?= number_format($price, 0, ",", ".") ?> <small><u>đ</u></small>
      <?php endif; ?>
    </div>

  </div>
</a>