<?php
	$fields = get_fields("option");
  $is_home = is_home() || is_front_page();
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
    <!-- <script src="https://js.sentry-cdn.com/74f92a32cf3ef20ac6f11653893d702e.min.js" crossorigin="anonymous"></script> -->
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
      <?php if($is_home) { include get_template_directory()."/content/app-download.php"; }?>
      <?php      	
      //  if( !is_page('danh-sach-chuyen-vien') && !is_page('danh-sach-chi-nhanh') && !is_page('tuyen-dung'))
       include get_template_directory()."/content/header.php";
      ?>
    </header>
    <?php include get_template_directory()."/content/chat.php";?>