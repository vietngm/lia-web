<?php
  $is_home = is_home() || is_front_page();
	$fields = get_fields();
	$price = $fields["price"] ?? 0;
	$image = bfi_thumb(get_the_post_thumbnail_url() , array("width"=>400, 'crop'=>false));
	$discountPrice = $fields["discountPrice"] ? $fields["discountPrice"] : 0;
	$discountPercentage = ($price > 0 && $discountPrice < $price) 
    ? round((($price - $discountPrice) / $price) * 100) 
    : 0;
?>
<div class="overflow-hidden h-full flex flex-col rounded-1.5">
  <a href="<?= get_permalink() ?>" class="service-link">
    <img class="img aspect-square lazy" data-src="<?= $image ?>" />
  </a>
  <div class="flex-1 flex flex-col border-1 border-t-0 border-gray-300 rounded-b-1.5 p-2 service-content">
    <div class="flex justify-between items-center mb-1.5">
      <div class="flex items-center gap-1">
        <div class="rating text-10" style="font-weight:800;">
          <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
          <span class="name"><?= $fields["rating"] ?></span>
          <span class="value">(<?= $fields["rating_number"] ?>)</span>
        </div>
        <span class="text-10" style="opacity: 0.5;">|</span>
        <span class="text-10">Đặt</span>
        <span class="text-10"><?= $fields["client_number"] ?></span>
      </div>
    </div>
    <a href="<?= get_permalink() ?>" class="service-link">
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
            <?= number_format($discountPrice, 0, ",", ".") ?><small> <u>đ</u></small>
          </span>
          <span class="text-gray-400 line-through opacity-70" style="color:#ccc;font-size:12px">
            <?= number_format($price, 0, ",", ".") ?><small> <u>đ</u></small>
          </span>
        </div>
        <?php else : ?>
        <?= number_format($price, 0, ",", ".") ?> <small> <u>đ</u></small>
        <?php endif; ?>
      </div>
    </a>
    <?php if($is_home) {?>
    <?php
      $dataToppings = [];
      $toppings_1 = [];
      $toppings_2 = [];
      $toppings_3 = [];
      $toppings_4 = [];
      $toppings_5 = [];

      // Nhom topping 1
      if (!empty($fields['desire']) && is_array($fields['desire'])) {
        foreach ($fields['desire'] as $topping) {
          $term = get_term($topping["topping"], 'service-topping');
          if ($term && !is_wp_error($term)) {
            $toppings_1[] = [
              "name"  => $term->name,
              "price" => $topping["origin"],
            ];
          }
        }
      }
          
      $dataToppings[] = [
        "toppings_1" => [ // 1
          "name"     => $fields['name_desire'] ?? 'N/A',
          "toppings" => $toppings_1,
        ],
      ];

      // Nhom topping 2
      if (!empty($fields['material']) && is_array($fields['material'])) {
        foreach ($fields['material'] as $topping) {
          $term = get_term($topping["topping"], 'service-topping');
          if ($term && !is_wp_error($term)) {
            $toppings_2[] = [
              "name"  => $term->name,
              "price" => $topping["origin"],
            ];
          }
        }
      }
          
      $dataToppings[] = [
        "toppings_2" => [ // 2
          "name"     => $fields['name_material'] ?? 'N/A',
          "toppings" => $toppings_2,
        ],
      ];

      // Nhom topping 3
      if (!empty($fields['bh']) && is_array($fields['bh'])) {
        foreach ($fields['bh'] as $topping) {
          $term = get_term($topping["topping"], 'service-topping');
          if ($term && !is_wp_error($term)) {
            $toppings_3[] = [
              "name"  => $term->name,
              "price" => $topping["origin"],
            ];
          }
        }
      }

      $dataToppings[] = [
        "toppings_3" => [ // 3
          "name"     => $fields['name_bh'] ?? 'N/A',
          "toppings" => $toppings_3,
        ],
      ];

      // Nhom topping 4
      if (!empty($fields['topping_4']) && is_array($fields['topping_4'])) {
        foreach ($fields['topping_4'] as $topping) { 
          $term = get_term($topping["topping"], 'service-topping');
          if ($term && !is_wp_error($term)) {
            $toppings_4[] = [
              "name"  => $term->name,
              "price" => $topping["origin"],
            ];
          }
        }
      }
      
      $dataToppings[] = [
        "toppings_4" => [ // 4
          "name"     => $fields['ten_topping_4'] ?? 'N/A',
          "toppings" => $toppings_4,
        ],
      ];

      // Nhom topping 5
      if (!empty($fields['topping_5']) && is_array($fields['topping_5'])) {
        foreach ($fields['topping_5'] as $topping) { 
          $term = get_term($topping["topping"], 'service-topping');
          if ($term && !is_wp_error($term)) {
            $toppings_5[] = [
              "name"  => $term->name,
              "price" => $topping["origin"],
            ];
          }
        }
      }
      
      $dataToppings[] = [
        "toppings_5" => [ // 5
          "name"     => $fields['ten_topping_5'] ?? 'N/A',
          "toppings" => $toppings_5,
        ],
      ];

      // Encode JSON để dùng trong HTML attribute
      $dataJson = htmlspecialchars(json_encode($dataToppings, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
    ?>
    <button class="btn-booking-service js-open-bottom-sheet"
      data-price="<?= $discountPrice ? $discountPrice : $price ?>" data-title="<?= get_the_title() ?>"
      data-id="<?= get_the_ID() ?>" data-toppings="<?= $dataJson ?>" data-image="<?= $image ?>">Đặt lịch</button>
    <?php } ?>
  </div>
</div>