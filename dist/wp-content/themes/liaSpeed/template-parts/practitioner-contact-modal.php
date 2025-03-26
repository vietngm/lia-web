<div class="zalo-contact-modal hidden fixed top-0 left-0 right-0 bottom-0 z-[120] p-4">
	<?= wp_nonce_field( 'doctor_contact' ); ?>
	<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
	<div class="relative z-1 m-auto p-5 rounded-2 bg-white w-full max-w-[600px]">
		<div class="close-modal absolute right-0 top-0 p-4 cursor-pointer">
			<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
		</div>
		<img class="w-[200px] mx-auto mb-5" src="<?= get_theme_file_uri("assets/images/zalo-banner.jpg") ?>" alt="" />
		<p class="italic text-12 mb-5">Phòng khám Trang Beauty thu thập số điện thoại để đảm bảo quyền lợi & bảo mật thông tin cá nhân của khách hàng</p>
		<div class="input-group input-group-left-icon mb-6">
			<img class="icon" src="<?= get_theme_file_uri("assets/images/icons/phone-gray.svg") ?>" />
			<input class="input" type="tel" name="phone" placeholder="Số điện thoại" />
			<div class="text-12 italic text-red-500 error-phone"></div>
		</div>
		<div class="text-center">
			<button class="submit btn w-full max-w-[150px] text-center py-2.5 justify-center">Tư vấn ngay</button>
		</div>
	</div>
</div>
