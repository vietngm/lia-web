<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
		<?php wp_head(); ?>
		<script
			src="https://js.sentry-cdn.com/74f92a32cf3ef20ac6f11653893d702e.min.js"
			crossorigin="anonymous"
		></script>
		
		<!-- Meta Pixel Code -->
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=913120683690781&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Meta Pixel Code -->

		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />
		<script>
			const AJAX_URL = "<?= admin_url( 'admin-ajax.php' ) ?>";
			const ASSETS_PATH = "<?= get_theme_file_uri("assets/") ?>";
		</script>
	</head>
	<body>
		