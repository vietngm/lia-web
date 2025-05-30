<?php
	$fields = get_fields("option");
?>
<?php
	$_term_categories = get_terms('service-category', array(
		'hide_empty' => false,
	));
	$term_categories = [];
	$term_category_children = [];
	foreach ($_term_categories as $term_category) {
		if (!$term_category->parent) {
			array_push($term_categories, $term_category);
		} else {
			$term_category_children[$term_category->parent] = $term_category_children[$term_category->parent] ?? [];
			array_push($term_category_children[$term_category->parent], $term_category);
		}
	}
	$booking_url = get_permalink($fields['page']['booking']);
?>

<!DOCTYPE html>
<html lang="vi">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <?php wp_head(); ?>
    <script src="https://js.sentry-cdn.com/74f92a32cf3ef20ac6f11653893d702e.min.js" crossorigin="anonymous"></script>

    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=913120683690781&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet" />

    <script>
    const AJAX_URL = "<?= admin_url( 'admin-ajax.php' ) ?>";
    const ASSETS_PATH = "<?= get_theme_file_uri("assets/") ?>";
    </script>

  </head>

  <body>

    <header class="sticky top-0 left-0 right-0 bg-white z-50 shadow-sm">
      <div class="h-[60px] " style="z-index:100" id="ad-container">
        <div
          class="flex border-1 items-center bg-white border border-gray-300 rounded-lg p-2 shadow-md max-w-sm relative gap-2">
          <button onclick="document.getElementById('ad-container').remove()"
            class=" left-2 top-1 text-gray-500 hover:text-gray-800 text-lg">
            <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
          </button>

          <img class="h-10.5" src="<?= get_theme_file_uri("assets/images/logo.png") ?>"
            class="w-10 h-10 rounded-md ml-5">
          <div class="ml-3 flex-1">
            <div class="text-sm font-semibold text-gray-900">LiA - Kết nối & Chia sẻ</div>
            <p class="text-xs text-gray-600" style="font-size:10px">Ứng dụng một nền tảng công nghệ!</p>
          </div>
          <a id="downloadApp" style="    border-radius: 24px;
						padding: 4px 12px;
						background: #1a5478;
						color: #FFF;
						font-size: 12px;" class="bg-blue-500 text-xs font-semibold px-3 py-1 rounded-lg hover:bg-blue-600">
            Tải app
          </a>
        </div>
      </div>
      <?php //include get_template_directory()."/content/header-bk.php"; ?>
    </header>

    <div id="chat-modal" data-open="false"
      class="fixed z-[100] left-0 right-0 bottom-0 top-0 flex items-center justify-center transition-all opacity-0 pointer-events-none data-[open=true]:opacity-100 data-[open=true]:pointer-events-auto">
      <div class="absolute left-0 right-0 bottom-0 top-0 bg-black bg-opacity-50" tbc-toggle-target="#chat-modal"></div>
      <div class="w-full rounded-3 bg-white max-w-[400px] relative">
        <a href="tel:<?= get_field("header_phone", "option") ?>" class="px-4 py-3 flex items-center gap-4">
          <div class="w-7.5 h-7.5 rounded-8 bg-primary flex items-center justify-center cursor-pointer">
            <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/phone-white.svg") ?>" />
          </div>
          <div class="flex-1"><?= get_field("header_phone", "option") ?></div>
        </a>
        <hr />
        <a href="https://zalo.me/trangbeauty" target="_blank" class="px-4 py-3 -ml-1 flex items-center gap-4">
          <img class="w-9 h-9" src="<?= get_theme_file_uri("assets/images/icons/zalo.png") ?>" />
          <div class="flex-1">Nhắn tin qua Zalo</div>
        </a>
        <hr />
        <a href="https://m.me/trangbeautycenter" target="_blank" class="px-4 py-3 flex items-center gap-4">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#2196f3]">
            <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/facebook.svg") ?>" />
          </div>
          <div class="flex-1">Nhắn tin qua Facebook</div>
        </a>
      </div>
    </div>
    <script>
    document.getElementById("downloadApp").addEventListener("click", function(event) {
      event.preventDefault();

      const userAgent = navigator.userAgent || navigator.vendor || window.opera;

      if (/android/i.test(userAgent)) {
        window.location.href = "https://play.google.com/store/apps/details?id=com.liabeauty.liacustomer";
      } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        window.location.href =
          "https://apps.apple.com/us/app/lia-k%E1%BA%BFt-n%E1%BB%91i-chia-s%E1%BA%BB/id6737228105";
      } else {
        alert("Ứng dụng chỉ hỗ trợ trên iOS và Android!");
      }
    });
    </script>