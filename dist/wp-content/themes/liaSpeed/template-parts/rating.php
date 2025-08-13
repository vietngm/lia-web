<div class="rating items-center">
  <div class="flex text-10 rating-icon">
    <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
    <span class="name"><?= esc_html($branch_rating); ?></span>
    <span class="value">(<?= esc_html($rating_number); ?>)</span>
  </div>
  <span class="separator">|</span>
  <span class="text-10"><?= count($practitioners_ids); ?></span>
  <span class="text-10">Chuyên viên</span>
</div>