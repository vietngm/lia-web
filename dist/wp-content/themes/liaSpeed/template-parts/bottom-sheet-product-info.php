<?php
$dtph = get_field('dt_ph', $post->ID);
$hdsd = get_field('hd_sd', $post->ID);
$tpsp = get_field('tp_sp', $post->ID);
// $description = get_field('description', $post->ID);
?>
<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
<div class="relative m-auto rounded-2 bg-white w-full background-modal p-4 z-[120] booking-service">
  <div class="overflow-hidden w-full h-full">

    <div class="flex items-center mb-4">
      <div class="font-semibold">Thông tin sản phẩm</div>
      <div class="close-modal cursor-pointer">
        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
      </div>
    </div>

    <div class="policy-content">
      <ul class="product-info-list">
        <li class="product-info-item">
          <div class="product-info-title">
            Thành phần sản phẩm
          </div>
          <div class="product-info-content">
            <div class="product-info-desc"><?php echo $tpsp;?></div>
          </div>
        </li>
        <li class="product-info-item">
          <div class="product-info-title">
            Đối tượng phù hợp
          </div>
          <div class="product-info-content">
            <div class="product-info-desc"><?php echo $dtph;?></div>
          </div>
        </li>
        <li class="product-info-item">
          <div class="product-info-title">
            Hướng dẫn sử dụng
          </div>
          <div class="product-info-content">
            <div class="product-info-desc"><?php echo $hdsd;?></div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>