<?php
    $fields = get_fields();
    $branch_avatar = bfi_thumb(get_the_post_thumbnail_url(), array("width" => 400, 'crop' => false));
    $branch_id = get_the_ID();
    $branch_name = get_the_title();
    $branch_address = get_field('address', $branch_id);
    $branch_rating = get_field('rating', $branch_id);
    $doctor_customers = get_field('customers', $branch_id);
    $services = $args['services'];
    $practitioners_ids = $args['practitioners_ids'];
    $doctor_id = $args['doctor_id'];
    $service_categories = $args['service_categories']; 
    $label = get_field('label', $branch_id);
    $video_number = get_field('video_number', $branch_id);
    $rating_number = get_field('rating_number', $branch_id);
    $doctor_phone = get_field('phone', $branch_id);
    $open_time = get_field('gio_lam_viec', $branch_id);
?>
<div class="branch">
  <div class="branch-info">
    <div class="branch-avatar">
      <img src='<?= esc_url($branch_avatar) ?>' alt="practitioner">
    </div>
    <div class="branch-content">
      <h1 class="font-bold" style="font-size:14px"><?= esc_html($branch_name); ?></h1>
      <div class="flex items-center gap-1">
        <div class="rating text-10" style="font-weight:800;">
          <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
          <span class="name"><?= esc_html($branch_rating); ?></span>
          <span class="value">(<?= esc_html($rating_number); ?>)</span>
        </div>
        <span class="separator" style="opacity: 0.5;">|</span>
        <span class="text-10"><?= count($practitioners_ids); ?></span>
        <span class="text-10">Chuyên viên</span>
      </div>
    </div>
  </div>

  <div class="branch-services">
    <?php
    foreach ($services as $service) { 
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
    ?>
    <div class="branch-services-item">
      <a href="<?= get_permalink($service_id) ?>" class="branch-services-link">
        <div class="branch-services-image">
          <img src="<?= $service_image ?>" alt="<?= $service_title ?>">
        </div>
        <h3 class="text-12 text-service-title line-clamp-2 mb-0"><?= $service_title; ?></h3>
        <div class="text-12">
          <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
          <div class="flex items-center justify-between">
            <span class="text-price" style="font-size:14px">
              <?= number_format($discountPrice, 0, ",", ".") ?><small> <u>đ</u></small>
            </span>
          </div>
          <?php else : ?>
          <?= number_format($price, 0, ",", ".") ?> <small> <u>đ</u></small>
          <?php endif; ?>
        </div>
      </a>
    </div>
    <?php } ?>
  </div>
  <div class="branch-action">
    <button class="btn-booking-service">Đặt hẹn</button>
  </div>
</div>