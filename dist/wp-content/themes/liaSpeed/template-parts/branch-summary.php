<?php
    $fields = get_fields();
    $branch_avatar = bfi_thumb(get_the_post_thumbnail_url(), array("width" => 400, 'crop' => false));
    $branch_id = get_the_ID();
    $branch_name = get_the_title();
    $branch_address = get_field('address', $branch_id);
    $branch_rating = get_field('rating', $branch_id);
    $doctor_customers = get_field('customers', $branch_id);
    $services = $args['services']; 
    $service_categories = $args['service_categories']; 
    $label = get_field('label', $branch_id);
    $video_number = get_field('video_number', $branch_id);
    $rating_number = get_field('rating_number', $branch_id);
    $doctor_phone = get_field('phone', $branch_id);
    $open_time = get_field('gio_lam_viec', $branch_id);
?>
<a href="<?= get_permalink() ?>" class="flex relative w-full gap-3  mt-4 branch">
  <div class="image-containers">
    <img src='<?= esc_url($branch_avatar) ?>' alt="practitioner" class="w-32 h-32"
      style="width: 120px; height: auto;  object-fit: cover;">
  </div>
  <div class="w-full flex flex-col gap-1">
    <div class="flex gap-1 items-center justify-between">
      <div class="flex items-center flex-wrap ">
        <h1 class=" font-bold" style="font-size:14px"><?= esc_html($branch_name); ?></h1>
      </div>
      <div class="flex gap-1 items-center text-12 ">
        <h4 class="rating">
          <span class="name">
            <?= esc_html($branch_rating); ?>
          </span>
          <span class="value">
            (<?= esc_html($rating_number); ?>)
          </span>
        </h4>
      </div>
    </div>
    <div class="flex gap-1 items-center">
      <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/location.svg") ?>" alt="" />
      <div class="flex items-center">
        <h4 class="text-12"><?= esc_html($branch_address); ?></h4>
      </div>
    </div>
    <div class="flex gap-1 items-center">
      <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/phone-small.svg") ?>" alt="" />
      <div class="flex items-center">
        <h4 class="text-12"><?= esc_html($doctor_phone); ?></h4>
      </div>
    </div>
    <div class="flex gap-2 items-center">
      <button class="bg-blue-500 rounded-4 px-2 py-1 text-12 button-detail" style="font-size: 12px;">Mở cửa</button>
      <span style="font-weight:bold"><?=$open_time['mo_cua'];?> - <?=$open_time['dong_cua'];?></span>
    </div>
  </div>
</a>