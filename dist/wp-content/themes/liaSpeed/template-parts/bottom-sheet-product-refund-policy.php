<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
<div class="relative m-auto rounded-2 bg-white w-full background-modal p-4 z-[120] booking-service">
  <div class="overflow-hidden w-full h-full">

    <div class="flex items-center mb-4">
      <div class="font-semibold">Thanh toán & Hoàn tiền</div>
      <div class="close-modal cursor-pointer">
        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
      </div>
    </div>

    <div class="policy-content">
      <?php
$flexible_content = get_field('content', 758);

if ($flexible_content && is_array($flexible_content)) {
  foreach ($flexible_content as $block) {
    if ($block['acf_fc_layout'] === 'content') {
      $content_html = $block['content'] ?? '';

      if (!empty($content_html)) {
        echo wp_kses_post($content_html);
      } else {
        echo '<p><em>Không có nội dung.</em></p>';
      }
    }
  }
} else {
  echo '<p><em>Không có dữ liệu.</em></p>';
}
?>
    </div>
  </div>
</div>