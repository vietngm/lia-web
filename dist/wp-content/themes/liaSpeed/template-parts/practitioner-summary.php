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
?>

<style>
.blur-bg {
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(4px);
}

.bg-border {
  width: 100%;
  height: 1px;
  position: absolute;
  border-bottom: 2px solid #961bb329;
  ;
}

.bg-category {
  color: rgb(123, 43, 143);
  border-radius: 5px;
  font-weight: 500;
  font-size: 11px;
  margin-top: 1px;
}

.image-container {
  position: relative;
}

.image-container img {
  width: 100%;
  display: block;
}

.image-container::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 50%;
  background: linear-gradient(to top, white, rgba(255, 255, 255, 0));
}

.button-detail {
  background: #EDFFE1;
  color: #45843B;
  font-weight: 600;
  padding: 5px 12px;
  border: 1px solid #45843B;
}

.button-booking {
  background: #45843B;
  color: #fff;
  font-weight: 600;
  padding: 5px 12px;
  border: 1px solid #45843B;
}
</style>
<div class="practitioner-info relative w-full gap-2 items-center">
  <div class="practitioner-summary">
    <div class="avatar">
      <img src='<?= esc_url($doctor_avatar) ?>' alt="practitioner">
    </div>
    <div class=" w-full flex flex-col">
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
    <a href="<?= get_permalink($doctor_id) ?>" class="bg-blue-500  rounded-2 px-2 py-1 text-12 button-detail"
      style="font-size: 12px;">Xem chi tiết</a>
    <a class="bg-blue-500 rounded-2 px-2 py-1 text-12 button-booking" style="font-size: 12px;text-align:center;">Đặt
      lịch</a>
  </div>
</div>