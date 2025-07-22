<?php
	$fields = get_fields("option");
	$home_url = get_home_url();
	$is_menu = $fields['page']['menu'] == get_the_ID();
  $menu_url = get_permalink($fields['page']['menu']);
?>
<div class="container border-b border-gray-300">
  <div class="flex items-center justify-between h-[64px]">
    <a href="<?= get_home_url() ?>" class="flex items-center space-x-4">
      <img style="height:36px" src="<?= get_theme_file_uri("assets/images/logo1.png") ?>" />
    </a>

    <div class="flex items-center gap-4">
      <button class="lg:hidden flex items-center justify-center cursor-pointer" tbc-toggle-target="#chat-modal">
        <img src="<?= get_theme_file_uri("assets/images/icons/phone.svg") ?>" />
      </button>

      <a href="<?=$menu_url?>" class="hamburger">
        <div class="hamburger-wrap">
          <div class="hamburger-line"></div>
          <div class="hamburger-line"></div>
          <div class="hamburger-line"></div>
        </div>
      </a>
    </div>

    <div class="relative flex hidden lg:block">
      <div class="relative flex">
        <form action="<?= home_url('/') ?>" method="get" class="relative ">
          <div style="border-radius:10px ; border:1px solid #ddd;">
            <div>
              <button style="padding-left:8px" type="submit"
                class="pl-3 absolute inset-y-0 bottom-0 top-0 left-0 flex items-center pr-3">
                <img src="<?= get_theme_file_uri('assets/images/icons/search.svg') ?>" alt="Search"
                  class="w-5 h-5 pl-3" />
              </button>
            </div>
            <div style="padding-left:16px">
              <input style="border:none" type="text" name="s" placeholder="Tìm kiếm..."
                class=" focus-input w-full h-10 px-4 pr-10 text-sm rounded-full shadow-sm focus:none focus:ring focus:border-blue-000" />
            </div>
          </div>
        </form>
        <a href="<?=$booking_url?>" style="display:flex;align-item:center;padding-left:12px">
          <img style="width:26px" src="<?= get_theme_file_uri("assets/images/icons/calendar-lines.svg") ?>" />
        </a>
      </div>
    </div>
  </div>
</div>