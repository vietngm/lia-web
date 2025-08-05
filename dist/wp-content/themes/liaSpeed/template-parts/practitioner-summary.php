<?php
    $fields = get_fields();
    $doctor_avatar = bfi_thumb(get_the_post_thumbnail_url(), array("width" => 400, 'crop' => false));
    $doctor_id = get_the_ID();
    $doctor_name = get_the_title();
    $doctor_address = get_field('address', $doctor_id);
    $doctor_experience = get_field('experience', $doctor_id);
    $doctor_rating = get_field('rating', $doctor_id);
    $doctor_customers = get_field('customers', $doctor_id);
    $services = $args['services']; 
    $service_categories = $args['service_categories']; 
    $label = get_field('label', $doctor_id);
    $video_number = get_field('video_number', $doctor_id);
    $rating_number = get_field('rating_number', $doctor_id);
    $kn = get_field('kn', $doctor_id);
    $branch_id = $args['branch_id'];
?>

<div class="practitioner-info relative w-full gap-2 items-center">
  <div class="practitioner-summary">
    <div class="avatar">
      <img src='<?= esc_url($doctor_avatar) ?>' alt="practitioner">
    </div>
    <div class="w-full flex flex-col">
      <div class="flex gap-1 items-center justify-between">
        <div class="flex items-center flex-wrap ">
          <h1 class="font-bold" style="font-size:14px"><?= esc_html($doctor_name); ?></h1>
        </div>
        <div class="flex gap-1 items-center text-12">
          <h4 class="rating">
            <span class="name">
              <?= esc_html($doctor_rating); ?>
            </span>
            <span class="value">
              (<?= esc_html($rating_number); ?>)
            </span>
          </h4>
        </div>
      </div>
      <div class="gap-1 items-center">
        <div class="experience"><?= $doctor_experience ? esc_html($doctor_experience):2; ?> năm kinh nghiệm</div>
        <div class="items-center">
          <h4 class="address"><?= esc_html($doctor_address); ?></h4>
        </div>
      </div>
    </div>
  </div>

  <div class="practitioner-booking items-center">
    <a href="<?= get_permalink($doctor_id) ?>" class="btn btn-default button-detail">Xem chi tiết</a>
    <?php if (count($services) == 0) : ?>
    <div class="btn button-booking disabled">Đặt lịch</div>
    <?php else: ?>
    <a class="btn button-booking js-modal-practitioner-service" data-id="<?= $doctor_id ?>">Đặt lịch</a>
    <?php endif; ?>
  </div>

</div>

<div id="modal-practitioner-service-<?= $doctor_id ?>" class="modal-booking fixed hidden z-[120] modal-popup">
  <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
  <div class="relative m-auto rounded-2 bg-white w-full background-modal p-4 z-[120] booking-service">
    <div class="overflow-hidden w-full h-full">
      <div class="flex items-center mb-4">
        <div class="font-bold">Chọn dịch vụ</div>
        <div class="close-modal cursor-pointer">
          <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
        </div>
      </div>
      <section class="section section-booking-form booking-form booking-row" style="height: 100%;">
        <ul class="modal-service-list">
          <?php 
          foreach($services as $service){
            $service_id = $service->ID;
            $service_title = $service->post_title;
            $service_price = get_field('price', $service_id);
            $service_discountPrice = get_field('discountPrice', $service_id);
            $service_rating = get_field('rating', $service_id);
            $service_rating_number = get_field('rating_number', $service_id);
            $service_customers = get_field('client_number', $service_id);
            $service_image = get_the_post_thumbnail_url($service_id);
            $price = $service_price ? $service_price : 0;
            $discountPrice = $service_discountPrice ? $service_discountPrice : 0;
            $discountPercentage = ($price > 0 && $discountPrice < $price) 
              ? round((($price - $discountPrice) / $price) * 100) 
              : 0;
            
            $defaultToppings_1 = get_field('desire', $service_id);
            $defaultToppings_2 = get_field('material', $service_id);
            $defaultToppings_3 = get_field('bh', $service_id);
            $defaultToppings_4 = get_field('topping_4', $service_id);
            $defaultToppings_5 = get_field('topping_5', $service_id);

            $dataToppings = [];
            $toppings_1 = [];
            $toppings_2 = [];
            $toppings_3 = [];
            $toppings_4 = [];
            $toppings_5 = [];

      // Nhom topping 1
      if (!empty($defaultToppings_1) && is_array($defaultToppings_1)) {
        foreach ($defaultToppings_1 as $topping) {
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
          "name"     => get_field('name_desire', $service_id) ?? 'N/A',
          "toppings" => $toppings_1,
        ],
      ];

      // Nhom topping 2
      if (!empty($defaultToppings_2) && is_array($defaultToppings_2)) {
        foreach ($defaultToppings_2 as $topping) {
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
          "name"     => get_field('name_material', $service_id) ?? 'N/A',
          "toppings" => $toppings_2,
        ],
      ];

      // Nhom topping 3
      if (!empty($defaultToppings_3) && is_array($defaultToppings_3)) {
        foreach ($defaultToppings_3 as $topping) {
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
          "name"     => get_field('name_bh', $service_id) ?? 'N/A',
          "toppings" => $toppings_3,
        ],
      ];

      // Nhom topping 4
      if (!empty($defaultToppings_4) && is_array($defaultToppings_4)) {
        foreach ($defaultToppings_4 as $topping) { 
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
          "name"     => get_field('ten_topping_4', $service_id) ?? 'N/A',
          "toppings" => $toppings_4,
        ],
      ];

      // Nhom topping 5
      if (!empty($defaultToppings_5) && is_array($defaultToppings_5)) {
        foreach ($defaultToppings_5 as $topping) { 
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
          "name"     => get_field('ten_topping_5', $service_id) ?? 'N/A',
          "toppings" => $toppings_5,
        ],
      ];

      // Encode JSON để dùng trong HTML attribute
      $dataJson = htmlspecialchars(json_encode($dataToppings, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');  
          ?>
          <li class="modal-service-item">
            <div class="modal-service-image">
              <img src="<?= $service_image ?>" alt="<?= $service_title ?>">
            </div>
            <div class="modal-service-content">
              <div class="modal-service-title"><?= $service_title ?></div>
              <div class="flex justify-between items-center">
                <div class="rating items-center">
                  <div class="flex text-10 rating-icon" style="font-weight:800;">
                    <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
                    <span class="name"><?= $service_rating ?></span>
                    <span class="value">(<?= $service_rating_number ?>)</span>
                  </div>
                  <span class="separator">|</span>
                  <span class="text-10">Đặt</span>
                  <span class="text-10"><?= $service_customers ?></span>
                </div>
              </div>
              <div class="modal-service-price">
                <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
                <div class="flex items-center gap-2 font-semibold">
                  <span class="text-price ml-2">
                    <?= number_format($discountPrice, 0, ",", ".") ?> <small><u>đ</u></small>
                  </span>
                  <span class="text-gray-400 line-through opacity-70">
                    <?= number_format($price, 0, ",", ".") ?> <small><u>đ</u></small>
                  </span>
                </div>
                <?php else : ?>
                <span class="text-price"><?= number_format($price, 0, ",", ".") ?> <small><u>đ</u></small></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="modal-service-booking">
              <button class="btn button-booking js-open-bottom-sheet" data-branch-id="<?= $branch_id ?>"
                data-doctor-name="<?= $doctor_name ?>" data-doctor-id="<?= $doctor_id ?>"
                data-price="<?= $discountPrice ? $discountPrice : $price ?>" data-title="<?= $service_title ?>"
                data-id="<?= $service_id ?>" data-toppings="<?= $dataJson ?>" data-image="<?= $service_image ?>">Đặt
                ngay</button>
            </div>
          </li>
          <?php
  }
  ?>
        </ul>
      </section>
    </div>
  </div>

</div>