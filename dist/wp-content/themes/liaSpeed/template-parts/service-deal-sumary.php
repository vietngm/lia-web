<?php 
	$fields = get_fields();
	$post_type = $args["post_type"] ?? "service";

	$doctor_name = get_the_title($fields["doctor"]);
	$doctor_location = get_field("location", $fields["doctor"]);
	$services = get_posts(array(
		"post_type" => "service",
		"posts_per_page" => 3,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'diaries',
				'value' => '"'.get_the_ID().'"',
				'compare' => 'LIKE'
			),
		),
	));
?>

<div class="swiper-slide"  style="margin-right:12px;box-shadow: rgb(50 50 93 / 11%) 0px 30px 60px -12px inset, rgb(0 0 0 / 5%) 0px 18px 36px -18px ;padding:12px;border-radius:8px" >
	<div style="display: flex; flex-direction: column">
		<div style="display: flex;gap:8px">
			<img class="w-10 h-10 rounded-full  border-text" src="<?= $fields["client"]["avatar"] ?>" />
			<div class="flex-1">
				<h4 class="font-semibold"><?= $fields["client"]["fullname"] ?></h4>
				<div style=" display: flex; gap: 4px; align-items: center;">
					<img style="width:10px" src="<?= get_theme_file_uri("assets/images/icons/earth.svg") ?>" />
					<div class="text-[#bbb] text-12"><?= $fields["client"]["status"] ?></div>
				</div>
			</div>
		</div>
		<div class="flex  mb-2 mt-2">
			<div class="flex-1 flex">
				<a href="<?= $fields["image"]["before"] ?>" data-fancybox style="position:relative;width: 100%;display: flex;">
					<img style="border-radius: 4px 0px 0px 4px" class="w-[130px h-[130px] object-cover object-center " src="<?= bfi_thumb($fields["image"]["before"] , array("width"=>600, 'crop'=>false)) ?>" />
					<div class="mt-1 text-center" style="font-size: 10px;position: absolute;bottom: 6px;background: linear-gradient(276deg, rgb(255 255 255 / 43%) 27%, rgb(255 255 255) 86%);padding: 2px 12px;border-radius: 0px 12px 12px 0px;color: #170b0a; ">Trước điều trị</div>
				</a>
				<a href="<?= $fields["image"]["after"] ?>" data-fancybox style="position:relative;width: 100%;display: flex;">
					<img style="border-radius: 0px 4px 4px 0px" class="w-[130px h-[130px] object-cover object-center" src="<?= bfi_thumb($fields["image"]["after"] , array("width"=>600, 'crop'=>false)) ?>" />
					<div class="mt-1 text-center"  style="font-size: 10px;position: absolute;bottom: 6px;background: linear-gradient(276deg, rgb(255 255 255 / 43%) 27%, rgb(255 255 255) 86%);padding: 2px 12px;border-radius: 0px 12px 12px 0px;color: #170b0a;">Sau điều trị</div>
				</a>
			</div>
		</div>
	
		<div class="flex gap-2  items-center mt-2">
			<img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/redo.svg") ?>" />
			<div style="font-size:12px"><?php if ($services && count($services)) : ?> <?php   $service = $services[0]; ?>
					<a href="<?= get_permalink($service) ?>" class="flex-shrink-0  ">
						<div>Đã chia sẻ nhật ký làm đẹp dịch vụ <b class="text-12 font-bold"><?= get_the_title($service) ?></b> được <b><?= get_the_title($fields["doctor"]) ?> </b> phụ trách điều trị tại <b>PK Trang Beauty Center</b> </div>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<div class="mt-2 flex gap-2 mb-4">	
			<?php if ($services && count($services)) : ?>
			<div class="no-scrollbar flex overflow-x-auto  ">
				<?php   $service = $services[0]; ?>
				<a href="<?= get_permalink($service) ?>" class="flex-shrink-0 flex-1 gap-3 flex items-center ">
					<img style="width:40px" class=" rounded-1" src="<?= bfi_thumb(get_the_post_thumbnail_url($service) , array("width"=>400, 'crop'=>false)) ?>" alt="">
					<div class="flex-1">
						<h4 class=" text-12 mb-0.5 font-semibold" style="  width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= get_the_title($service) ?></h4>
						<div class="flex items-center gap-2 text-10 mb-0.5">
							<img class="w-3.5 h-3.5" src="<?= get_theme_file_uri("assets/images/icons/star-black.svg") ?>" />
							<?= get_field("rating", $service) ?> / 5
						</div>
						
					</div>
				</a>
			</div>
			<?php endif; ?>
			<div class="flex gap-2 items-center ">
				<img style="width:40px" class=" rounded-1 border-1 border-[#ccc]" src="<?= get_the_post_thumbnail_url($fields["doctor"]) ?>" />
				<div class="flex-1">
					<h4 class="text-12 mb-0.5 font-semibold" style="  width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= get_the_title($fields["doctor"]) ?></h4>
					<div class="flex items-center gap-2 text-10 mb-0.5">
						<img class="w-3.5 h-3.5" src="<?= get_theme_file_uri("assets/images/icons/star-black.svg") ?>" />
						<?= get_field("rating", $fields["doctor"]) ?> / 5
					</div>
				</div>
			</div>
		</div>
		<div class="mb-2" style="font-size:13px; display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp:3; overflow: hidden;">
			<?= $fields["description"] ?>
		</div>
		<!-- <div id="confirm-button-gift"  class="mb-2" style="font-size:12px;display:flex;justify-content:flex-end;color:#1a5478">
			Xêm thêm >
		</div> -->
	</div>
	
		
</div>
<div id="modal-success-gift"  class=" modal-success modal-gift otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4 modal-popup" >
		<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
		<div class="p-4">
				<div class="close-modal absolute right-0 top-0 p-2 cursor-pointer">
					<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
				<?php get_template_part( 'template-parts/diary', 'detail', array("post_type" => "doctor") ) ?>
			</div>
		</div>
	</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lấy các phần tử
    const modal = document.getElementById('modal-success-gift');
    const confirmButton = document.getElementById('confirm-button-gift');
    const overlay = modal.querySelector('.bg-black');
    const closeModalButton = modal.querySelector('.close-modal');

    // Hiển thị modal với hiệu ứng mượt
    confirmButton.addEventListener('click', function () {
        modal.style.display = 'flex'; // Hiển thị modal
        setTimeout(() => {
            modal.classList.add('show'); // Thêm class để bắt đầu hiệu ứng
        }, 10); // Trễ một chút để hiệu ứng chạy mượt hơn
		document.documentElement.style.overflow = 'hidden'; // Ẩn scroll cho html
        document.body.style.overflow = 'hidden'; 
    });

    // Đóng modal với hiệu ứng mượt
    const closeModal = () => {
        modal.classList.remove('show'); // Loại bỏ hiệu ứng
        setTimeout(() => {
            modal.style.display = 'none'; // Ẩn modal sau khi hiệu ứng hoàn tất
        }, 300); // Chờ thời gian hoàn thành hiệu ứng (phù hợp với transition 0.3s)
		document.documentElement.style.overflow = ''; // Reset overflow
        document.body.style.overflow = ''; // Reset overflow
    };

    // Đóng khi nhấn overlay hoặc nút đóng
    closeModalButton.addEventListener('click', closeModal);
});
</script>





</script>
<style>


.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    box-sizing: border-box;
	margin-top: 1px;
	margin-bottom: 12px;
	margin-left: 1px;
	padding-bottom: 8px;
}
.processing-item {
    transition: all 0.3s ease-in-out;
}

.processing-item.hidden {
    display: none;
}
.modal-success {
		display: none; /* Ẩn modal */
		opacity: 0; /* Mờ hoàn toàn */
		transform: scale(0.9); /* Thu nhỏ modal một chút */
		transition: opacity 0.3s ease, transform 0.3s ease; /* Hiệu ứng chuyển đổi */
		position: relative;
	}

	/* Trạng thái hiển thị modal */
	.modal-success.show {
		display: flex; /* Hiển thị modal */
		opacity: 1; /* Hiện rõ */
		transform: scale(1); /* Phóng về kích thước ban đầu */

		
	}
</style>




