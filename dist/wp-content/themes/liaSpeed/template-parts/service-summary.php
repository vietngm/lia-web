<?php
	$fields = get_fields();
	$price = $fields["price"] ?? 0;
	$image = bfi_thumb(get_the_post_thumbnail_url() , array("width"=>400, 'crop'=>false));
	$discountPrice = $fields["discountPrice"] ? $fields["discountPrice"] : 0;
	$discountPercentage = ($price > 0 && $discountPrice < $price) 
    ? round((($price - $discountPrice) / $price) * 100) 
    : 0;
?>
<style>
.discount-percentage {
  background: #e91e631c;
  border-radius: 6px;
  color: #ef4444;
  font-size: 11px;
  font-weight: 800;
  padding: 3px 8px;
}
</style>
<a href="<?= get_permalink() ?>" class="overflow-hidden h-full flex flex-col rounded-1.5">
  <img class="img aspect-square lazy" data-src="<?= $image ?>" />
  <div class="flex-1 flex flex-col border-1 border-t-0 border-gray-300 rounded-b-1.5 p-2">
    <div class="flex justify-between items-center mb-1.5"
      style="border-bottom: 1px dashed rgb(227, 227, 227);padding-bottom: 5px;">
      <div class="flex items-center gap-1">
        <div class="rating text-10" style="font-weight:800;margin-bottom: -2px;">
          <span class="name"><?= $fields["rating"] ?></span>
          <span class="value">
            (<?= $fields["rating_number"] ?>)
          </span>
        </div>
      </div>
      <div class="flex items-center ">
        <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/people-gray.svg") ?>" />
        <span class="text-10" style="font-weight:800;margin-left:2px"><?= $fields["client_number"] ?></span>
      </div>
    </div>
    <h3 class="text-12 font-semibold line-clamp-2" style="font-size:13px"><?= get_the_title() ?></h3>
    <div class="line-clamp-2 text-12 text-gray-600"><?= $fields["note"] ?></div>
    <div class="text-12 font-semibold text-red-500 mt-2" style="font-weight:700;font-size:14px">
      <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
      <div class="flex items-center gap-2 ">
        <span class="text-gray-400 line-through opacity-70" style="color:#ccc;font-size:12px">
          <?= number_format($price, 0, ",", ".") ?><small>đ</small>
        </span>
        <span class="discount-percentage ">
          - <?= $discountPercentage ?>%
        </span>
      </div>
      <div class="flex items-center  justify-between ">
        <span class="text-red-500 ml-2" style="font-weight:700;font-size:14px">
          <?= number_format($discountPrice, 0, ",", ".") ?><small>đ</small>
        </span>
      </div>

      <?php else : ?>
      <?= number_format($price, 0, ",", ".") ?> <small><u>đ</u></small>
      <?php endif; ?>
    </div>

  </div>
</a>