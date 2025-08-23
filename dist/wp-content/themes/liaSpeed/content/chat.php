<div id="chat-modal" data-open="false"
  class="fixed z-[100] left-0 right-0 bottom-0 top-0 flex items-center justify-center transition-all opacity-0 pointer-events-none data-[open=true]:opacity-100 data-[open=true]:pointer-events-auto">
  <div class="absolute left-0 right-0 bottom-0 top-0 bg-black bg-opacity-50" tbc-toggle-target="#chat-modal"></div>
  <div class="w-full rounded-3 bg-white max-w-[400px] relative chat-modal">
    <a href="tel:<?= get_field("header_phone", "option") ?>" class="px-4 py-3 flex items-center gap-4">
      <div class="w-7.5 h-7.5 rounded-8 bg-primary flex items-center justify-center cursor-pointer">
        <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/phone-white.svg") ?>" />
      </div>
      <div class="flex-1"><?= get_field("header_phone", "option") ?></div>
    </a>
    <hr />
    <a href="https://zalo.me/3066530543915113607" target="_blank" class="px-4 py-3 -ml-1 flex items-center gap-4">
      <img class="w-9 h-9" src="<?= get_theme_file_uri("assets/images/icons/zalo.png") ?>" />
      <div class="flex-1">Nhắn tin qua Zalo</div>
    </a>
    <hr />
    <a href="https://m.me/liaspeedbeauty" target="_blank" class="px-4 py-3 flex items-center gap-4">
      <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#2196f3]">
        <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/facebook.svg") ?>" />
      </div>
      <div class="flex-1">Nhắn tin qua Facebook</div>
    </a>
  </div>
</div>