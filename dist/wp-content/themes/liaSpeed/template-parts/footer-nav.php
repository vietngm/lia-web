<?php
	$fields = get_fields("option");
	$home_url = get_home_url();
	$branch_url = get_permalink($fields['page']['branch']);
	$practitioner_url = get_permalink($fields['page']['practitioner']);
	$menu_url = get_permalink($fields['page']['menu']);

	$is_home = is_home() || is_front_page();
	$is_branch = $fields['page']['branch'] == get_the_ID();
	$is_practitioner = $fields['page']['practitioner'] == get_the_ID();
	$is_menu = $fields['page']['menu'] == get_the_ID();
?>
<div class="h-[80px] lg:hidden"></div>
<div
  class="h-[80px] border-t-1 border-[#eee] fixed bottom-0 left-0 right-0 z-50 bg-white flex items-center justify-center lg:hidden">
  <div class="container flex items-center justify-between ">
    <a href="<?= $home_url ?>" class="w-[85px] py-2 bg-opacity-30 flex flex-col items-center gap-1 rounded-2">
      <?php if ($is_home) : ?>
      <img src="<?= get_theme_file_uri("assets/images/icons/home-gray.svg") ?>" />
      <?php else : ?>
      <img src="<?= get_theme_file_uri("assets/images/icons/home.svg") ?>" />
      <?php endif; ?>
      <div class="text-center text-10 font-medium <?= $is_home ? "text-primary" : "" ?>">Trang chủ</div>
    </a>
    <a href="<?=$branch_url?>" class="w-[85px] py-2 bg-opacity-30 flex flex-col items-center gap-1 rounded-2">
      <?php if ($is_branch) : ?>
      <img src="<?= get_theme_file_uri("assets/images/icons/branch-gray.svg") ?>" />
      <?php else : ?>
      <img src="<?= get_theme_file_uri("assets/images/icons/branch.svg") ?>" />
      <?php endif; ?>
      <div class="text-center text-10 font-medium <?= $is_branch ? "text-primary" : "" ?>">Chi nhánh</div>
    </a>
    <a href="<?=$practitioner_url?>" class="w-[85px] py-2 bg-opacity-30 flex flex-col items-center gap-1 rounded-2">
      <?php if ($is_practitioner) : ?>
      <img src="<?= get_theme_file_uri("assets/images/icons/practi-gray.svg") ?>" />
      <?php else : ?>
      <img src="<?= get_theme_file_uri("assets/images/icons/practi.svg") ?>" />
      <?php endif; ?>
      <div class="text-center text-10 font-medium <?= $is_practitioner ? "text-primary" : "" ?>">Chuyên viên</div>
    </a>
  </div>
</div>