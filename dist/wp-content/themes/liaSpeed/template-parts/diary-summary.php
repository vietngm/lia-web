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

<div class="swiper-slide"  style="margin-right:12px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;padding:12px;border-radius:8px;gap:4;width:350px" >
	<div style="display: flex; flex-direction: column">
		<div style="display: flex;gap:8px">
			<img class="w-10 h-10 rounded-full border-1 border-text" src="<?= $fields["client"]["avatar"] ?>" />
			<div class="flex-1">
				<h4 class="font-semibold"><?= $fields["client"]["fullname"] ?></h4>
				<div style=" display: flex; gap: 4px; align-items: center;">
					<img style="width:10px" src="<?= get_theme_file_uri("assets/images/icons/earth.svg") ?>" />
					<div class="text-[#bbb] text-12"><?= $fields["client"]["status"] ?></div>
				</div>
			</div>
		</div>
		<div class="flex gap-2  items-center mt-2">
			<img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/redo.svg") ?>" />
			<div style="font-size:12px"><?php if ($services && count($services)) : ?> <?php   $service = $services[0]; ?>
					<a href="<?= get_permalink($service) ?>" class="flex-shrink-0  ">
						<div>Đã chia sẻ nhật ký làm đẹp dịch vụ <b class="text-12 font-bold"><?= get_the_title($service) ?></b> được <b><?= get_the_title($fields["doctor"]) ?> </b> phụ trách điều trị tại <b>PK LiA Beauty Center</b> </div>
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
	</div>
	<div>
		<div class="flex gap-2 mb-4">
			<div class="flex-1">
				<a href="<?= $fields["image"]["before"] ?>" data-fancybox>
					<img class="w-[130px h-[130px] rounded-1 object-cover object-center" src="<?= bfi_thumb($fields["image"]["before"] , array("width"=>600, 'crop'=>false)) ?>" />
				</a>
				<div class="mt-1 text-center" style="font-size:12px">Trước điều trị</div>
			</div>
			<div class="flex-1">
				<a href="<?= $fields["image"]["after"] ?>" data-fancybox>
					<img class="w-[130px h-[130px]  rounded-1 object-cover object-center" src="<?= bfi_thumb($fields["image"]["after"] , array("width"=>600, 'crop'=>false)) ?>" />
				</a>
				<div class="mt-1 text-center"  style="font-size:12px">Sau điều trị</div>
			</div>
		</div>
		<div class="processing-group">
    <?php $processing_count = 2; ?>
    <?php foreach ( $fields["processing"] ?? [] as $index => $processing ) : ?>
        <div
            class="relative pl-4 mb-5 after:w-2 after:h-2 after:absolute after:left-0 after:top-1.5 after:bg-[#999] after:rounded-full before:w-[1px] before:h-full before:bg-[#eee] before:absolute before:left-1 processing-item <?= $index >= 2 ? 'hidden' : '' ?>" 
            data-index="<?= $index ?>"
        >
            <div><?= $processing["time"] ?></div>
            <div style="font-size:13px; display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp:2; overflow: hidden;"><?= $processing["description"] ?></div>
            <div class="mt-2 flex flex-wrap gap-2">
                <?php foreach ( $processing["images"] ?? [] as $image ) : ?>
                    <a class="w-[80px] h-[80px] block" href="<?= $image ?>">
                        <img class="w-full h-full rounded-1" src="<?= bfi_thumb($image, array("width" => 200, 'crop' => false)) ?>" alt="" /> 
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (count($fields["processing"] ?? []) > $processing_count) : ?>
        <div style="display: flex; justify-content: flex-end;">
            <button class="show-more-btn mt-3 px-4 py-2 bg-blue-500 rounded" style="padding: 4px 14px; background: #7c2c8d; color: #FFF; font-size: 12px;">Xem chi tiết</button>
        </div>
    <?php endif; ?>
</div>
		

	</div>
</div>
<script>
 document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".show-more-btn");

    buttons.forEach(button => {
        const container = button.closest('.processing-group');  // Lấy nhóm chứa nút "Xem chi tiết"
        const processingItems = container.querySelectorAll(".processing-item");

        let isExpanded = false;  // Biến theo dõi trạng thái nhóm

        button.addEventListener("click", function () {
            if (!isExpanded) {
                // Hiển thị tất cả các phần tử trong nhóm
                processingItems.forEach(item => {
                    item.classList.remove("hidden");
                });

                button.textContent = "Thu gọn";
                isExpanded = true;  // Đánh dấu là đã mở rộng
            } else {
                // Chỉ giữ lại 2 phần tử đầu tiên
                processingItems.forEach((item, index) => {
                    if (index >= 2) item.classList.add("hidden");
                });

                button.textContent = "Xem chi tiết";
                isExpanded = false;  // Đánh dấu là đã thu gọn
            }
        });
    });
});





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
</style>




