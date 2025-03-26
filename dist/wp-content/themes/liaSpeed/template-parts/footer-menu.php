<?php
	$fields = get_fields("option");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<style>
.logo {
    overflow: hidden;
}

.address {
    font-size: 12px;
	
}

.accordion {
    max-width: 600px;
    margin: auto;
}

.accordion-item {
    border-bottom: 1px solid #ddd;
}

.accordion-header {
    width: 100%;
    background: none;
    border: none;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
	padding: 8px 0px;
}

.accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out; /* Hiệu ứng mở rộng */
}


.accordion-content ul {
    list-style: none;
    padding: 4px;
}

.accordion-content li{
    padding: 4px;
	font-weight:300;
}
.accordion-content p {
    padding: 0px 8px 12px ;
	font-weight:300;
}

footer {
    text-align: center;
    padding: 20px;
    font-size: 12px;
    color: #888;
}
.footer-general{
	padding:0px;
	color:#000;
	text-align:start;
	background-color:#F6F6F6;
	padding:16px 0px;
}
.material-icons{
	font-size:16px;
}
</style>
<footer class="footer-general">
	<div class="container">
		<div class="flex gap-2 items-center">
			<div class="logo" >
				<img src="<?= get_theme_file_uri("assets/images/logo.png") ?>" />
			</div>
			<p class="address">434 Cao Thắng, Phường 12, Quận 10, TP. Hồ Chí Minh</p>
		</div>
		<hr style="margin-top: 16px;border-top: 1px solid #ddd"/>
		<div class="accordion">
            <div class="accordion-item">
                <button class="accordion-header">Về chúng tôi <span class="material-icons">expand_more</span></button>
                <div class="accordion-content">
                    <ul>
                        <li>Câu chuyện về Lia</li>
                        <li>Lãnh đạo của Lia</li>
                        <li>Cơ hội nghề nghiệp</li>
                        <li>Đạo đức và tuân thủ</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Quy trình hợp tác nhượng quyền <span class="material-icons">expand_more</span></button>
                <div class="accordion-content"></div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Chính sách hợp tác <span class="material-icons">expand_more</span></button>
                <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 

						Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Trách nhiệm <span class="material-icons">expand_more</span></button>
                <div class="accordion-content"></div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Hỏi đáp cùng Lia <span class="material-icons">expand_more</span></button>
                <div class="accordion-content"></div>
            </div>
        </div>
		<p style="margin:16px 0px;text-align:center">© 2022 Viện Thẩm Mỹ LIA Beauty. Mã số thuế: 0317197387. Chịu trách nhiệm bởi Võ Mạnh Tân. Designed by LIA MEDIA</p>
		<!-- <h2 class="md:text-20 text-18 font-bold text-center mb-6"><?= $fields["footer"]["title"] ?></h2>
		<div class="grid grid-cols-10 gap-4">
			<div class="md:col-span-4 col-span-10">
				<h3 class="text-16 mb-4 font-semibold"><?= $fields["footer"]["contact"]["title"] ?></h3>
				<div class="flex gap-2 mb-2">
					<div class="w-6 h-6 bg-white rounded-6 flex items-center justify-center">
						<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/location.svg") ?>" />
					</div>
					<div class="flex-1 self-center"><?= $fields["footer"]["contact"]["address"] ?></div>
				</div>
				<div>
					<a href="tel:<?= $fields["footer"]["contact"]["phone"] ?>" class="inline-flex gap-2 mb-2">
						<div class="w-6 h-6 bg-white rounded-6 flex items-center justify-center">
							<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/phone-small.svg") ?>" />
						</div>
						<div class="flex-1 self-center"><?= $fields["footer"]["contact"]["phone"] ?></div>
					</a>
				</div>
				<div>
					<a href="mailto:<?= $fields["footer"]["contact"]["email"] ?>" class="inline-flex gap-2 mb-2">
						<div class="w-6 h-6 bg-white rounded-6 flex items-center justify-center">
							<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/email.svg") ?>" />
						</div>
						<div class="flex-1 self-center"><?= $fields["footer"]["contact"]["email"] ?></div>
					</a>
				</div>
				<div class="flex gap-2 mb-2">
					<div class="w-6 h-6 bg-white rounded-6 flex items-center justify-center">
						<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/clock.svg") ?>" />
					</div>
					<div class="flex-1 self-center"><?= $fields["footer"]["contact"]["time"] ?></div>
				</div>
			</div>
			<div class="md:col-span-3 col-span-10">
				<h3 class="text-16 mb-4 font-semibold"><?= $fields["footer"]["license"]["title"] ?></h3>
				<?php foreach( $fields["footer"]["license"]["items"] as $item ) : ?>
				<a class="flex gap-2 mb-2" href="<?= $item["link"]["url"] ?>" target="<?= $item["link"]["target"] ?>">
					<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-right-white.svg") ?>" />
					<span><?= $item["link"]["title"] ?></span>
				</a>
				<?php endforeach; ?>
			</div>
			<div class="md:col-span-3 col-span-10">
				<h3 class="text-16 mb-4 font-semibold"><?= $fields["footer"]["policy"]["title"] ?></h3>
				<?php foreach( $fields["footer"]["policy"]["items"] as $item ) : ?>
				<a class="flex gap-2 mb-2" href="<?= $item["link"]["url"] ?>" target="<?= $item["link"]["target"] ?>">
					<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-right-white.svg") ?>" />
					<span><?= $item["link"]["title"] ?></span>
				</a>
				<?php endforeach; ?>
			</div>
		</div> -->
	</div>
</footer>
<script>
	document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelectorAll(".accordion-header");

    headers.forEach(header => {
        header.addEventListener("click", function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector(".material-icons");

            if (content.style.maxHeight) {
                content.style.maxHeight = null; // Thu gọn
                icon.textContent = "expand_more"; // Đổi icon về mặc định
            } else {
                content.style.maxHeight = content.scrollHeight + "px"; // Mở rộng
                icon.textContent = "expand_less"; // Đổi icon khi mở
            }
        });
    });
});


</script>
