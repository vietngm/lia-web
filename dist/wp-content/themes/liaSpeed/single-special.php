
<?php get_header("empty"); ?>

<?php
$fields = get_fields();

$buffets = get_posts(array(
    "post_type" => "package_buffet", 
    "posts_per_page" => -1, 
    "orderby" => "date",     
    "order" => "ASC",       
));

$selected_buffet_id = get_the_ID();

$buffet_data = [];
foreach ($buffets as $buffet) {
    $buffet_item = array(
        "ID" => $buffet->ID,  // Lấy ID của bài viết
        "title" => get_the_title($buffet->ID),
        "image" => get_the_post_thumbnail_url($buffet->ID),
        "note" => get_field("note", $buffet->ID),
        "description" => get_field("description", $buffet->ID),
		"image_detail" => get_field("image_detail", $buffet->ID),
        "custom_field" => get_field("custom_field_key", $buffet->ID),
		"slogan" => get_field("slogan", $buffet->ID), 
		"tiet_kiem" => get_field("tiet_kiem", $buffet->ID), 
		"tiet_kiem" => get_field("tiet_kiem", $buffet->ID), 
		"image_sosanh" => get_field("image_sosanh", $buffet->ID), 
		"luu_y" => get_field("luu_y", $buffet->ID), 
    );

    if ($buffet->ID == $selected_buffet_id) {
        array_unshift($buffet_data, $buffet_item);
    } else {
        $buffet_data[] = $buffet_item;
    }
}

?>
<head>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>


<main class="background">
	<section class="section">
	<div class="flex items-center  row-header-single" style="z-index: 1;position: relative;">
			<div class="history-back cursor-pointer" data-fallback="<?= get_permalink() ?>">
				<img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-left-white.svg") ?>" alt="" />
			</div>
			<h1 class="px-[60px] text-center text-16 font-bold" style="color:#FFF">ĐẠI TIỆC BUFFET</h1>
			<button style="display: flex;align-items: center;gap:4px;" id="confirm-button-social">
				<img style="width:10px;height:10px" src="<?= get_theme_file_uri("assets/images/group.png") ?>" alt="" />
				<h4 style="color:#FFF;font-size:10px">So sánh</h4>
			</button>
		</div>
		<!-- <div style="width:100%;margin-top: -40px;z-index: 0;position: relative;">
			<img style="width:100%;height:100%" src="<?= get_theme_file_uri("assets/images/banner-1.png") ?>" alt="" />
		</div> -->
		<div class="package_buffet"  >
			<?php if (!empty($buffet_data)) : ?>
    			<div class="swiper-container buffet-slider">
        			<div class="swiper-wrapper">
						<?php foreach ($buffet_data as $buffet) : ?>
							<div class="swiper-slide"  href="<?= get_permalink($buffet['ID']) ?>">
                    			<div class="flex flex-col items-center bg-gradient-to-b from-purple-800 to-purple-600 text-white  rounded-lg">
									<div class="banner title">
										<div class="img_kiem">
											<div class="tiet_kiem">Tiết kiệm : <?= $buffet["tiet_kiem"] ?></div>
											<img class="w-6 h-6" style="width:100% !important;height:40px" src="<?= get_theme_file_uri("assets/images/group_kiem.png") ?>" alt="" />
										</div>
										<div style="position:relative">
											<div class="img_clound">
												<img   src="<?= get_theme_file_uri("assets/images/cluod-2.png") ?>" alt="" />
											</div>
											<h1><?= $buffet["title"] ?></h1>
											<div class="img_clound-2">
												<img   src="<?= get_theme_file_uri("assets/images/cluod.png") ?>" alt="" />
											</div>
										</div>
										<p><?= $buffet["slogan"] ?></p>
									</div>
									<div class="image_buffet">
									   	<?php if (!empty($buffet['image'])) : ?>
											<img src="<?= esc_url($buffet['image']) ?>" 
												alt="Buffet Image" class="w-full h-full object-cover"/>
											<div>
												<div class="swiper-button-next"></div>
												<div class="swiper-button-prev"></div>
											</div>
										<?php endif; ?>	
									</div>
									<div class="image_buffet_detail">
									   <?php if (!empty($buffet['image_detail'])) : ?>
											<img src="<?= esc_url($buffet['image_detail']) ?>" 
												alt="Buffet Image" class="w-full h-full object-cover"/>
										<?php endif; ?>	
									</div>
									
                    			</div>
                			</div>
            			<?php endforeach; ?>
        			</div>
    			</div>
				<div class="swiper-pagination"></div>
			<?php endif; ?>
		</div>
		<div id="modal-success-social"  class="modal-success otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4" >
			<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
			<div class="relative z-1 m-auto rounded-2 bg-white w-full max-w-[600px] p-4" >
				<div class="close-modal absolute right-0 top-0 p-2 cursor-pointer">
					<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
				</div>
				<div class="title-sosanh">
					<h1>SO SÁNH GÓI BUFFET</h1>
				</div>
				<div class="image-sosanh">
					<img style="width:100%;height:100%"  src="<?= esc_url($buffet['image_sosanh']) ?>" 
					alt="Buffet Image" class="w-full h-full object-cover"/>
				</div>
				<div class="luu-y">*Lưu ý: <?= $buffet["luu_y"] ?></div>
			</div>
		</div>
	</section>
	<?php get_template_part( 'template-parts/footer', "buffet"); ?> 
</main>
	<style>
		.section{
		padding-bottom: 0px;
		display: flex;
		justify-content: space-between;
		flex-direction: column;
	}
		.luu-y{
			font-style: italic;
			font-weight: 700;
			margin-top: 24px;
		}
		.title-sosanh{
			text-align: center;	
			font-weight: 700;
			font-size: 20px;
			margin-bottom: 16px;
		}
		.img_clound img {
			width: 30% !important;
			height: auto;
		}
	.img_clound {
		position: absolute;
		bottom: 0px;
		left: -14px;
		z-index: 1;
	}
	.img_clound-2 img {
		width: 30% !important;
		height: auto;
	}
	.img_clound-2 {
		position: absolute;
		top: 0px;
		right: -72px;
		z-index: 1;
	}
	.tiet_kiem {
		font-size: 13px;
		font-weight: 500;
		position: absolute;
		top: 7px;
		right: 18px;
		z-index: 10;
	}
	.img_kiem{
		position: absolute;
		top: -34px;
		right: -70px;
		z-index: 1;
	}
	.image_buffet_detail {
    	margin-top: 32px;
		padding: 16px;
	}
	.row-header-single{
		justify-content: space-between;
		padding: 0 16px;
	}
	.row-img-single{
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto;
	}
	.row-introduce{
		justify-content: center;
		gap:36px;
		margin-top: 16px;
	}
	.row-single-button{
		display: flex;
		align-items: center;
		gap:8px;
		justify-content: center;
		margin-top: 16px;
	}
	.button-booking{
		border-radius: 6px;
		border: 1px solid #ccc;
		padding: 4px 16px;
	}
	.button-zalo{
		border-radius: 6px;
		padding: 7px 16px;
	}
	.row-title-single{
		text-align: center;
		margin-top: 16px;
	}
	.h1-single{
		margin: 0;
		font-weight: 700;

	}	
	.h3-single{
		color: #555;
		margin: 0;
		font-style: italic;
		font-size: 12px;

	}
	.row-single-branch {
		padding: 0px 16px;
	}
	.h2-single{
		margin: 0;
		font-size:12px;
		font-weight: 700;
	}
	.child-branch {
		display: flex;
		align-items: center;
		gap: 8px;
		margin-top: 8px;
	}
	.child-branch img {
		border: 1px solid #ccc;
		border-radius: 100%;
		padding: 2px;
	}
	.child-branch-text .location {
		font-weight: 700;
		font-size: 12px;
	}
	.child-branch-text .address {
		font-size: 12px;
	}
	.diary-number{
		display: flex;
		justify-content: flex-end;
		font-size: 12px;
		margin-top: 12px;
		color:#7a7a7a;
	}
	.row-filter-single{
		display: flex;
		gap: 8px;
		margin-top: 8px;
		flex-wrap: wrap;
	}
	.row-filter-single div{
		font-size: 12px;
		border: 1px solid #ccc;
		border-radius: 24px;
		padding: 2px 8px;
	}
	.content-introduce {
		display: flex;	
		gap: 8px;
		flex-direction: column;
	}
	.content-introduce p {
		font-size:13px;
	}
	.content-introduce img {
		width: 100%;
	}

	.content-video{
		position: relative;
		overflow: hidden;
		border-radius: 8px;
		box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	}
	.text-video {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		padding: 8px;
		background: #E6E6E6;
		color: #000;
		border-bottom-left-radius: 8px;
		border-bottom-right-radius: 8px;
		height: 72px;
	}
	.text-description {
		width: 158px;
		overflow: hidden;
		text-overflow: ellipsis;
		line-height: 16px;
		-webkit-line-clamp: 2;
		height: 32px;
		display: -webkit-box;
		-webkit-box-orient: vertical;
		margin-bottom: 4px;
	}

	.items-introduce{
		justify-content: center;
	}
	.indicator-tabs {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
	}
	@media (max-width: 450px) {
		.indicator-tabs {
			display: block;
		}
	}
	.description{
		font-weight:700;
		font-size:16px
	}
	.note p{
		font-weight:300;
	}
	.note strong{
		font-weight:700;
	}

	.section{

	}
	main{
		background-image: url('http://phongkham.local/wp-content/themes/trangbeautycenter/assets/images/background-3.png');
    	background-size: cover;
	}

	.package_buffet {
    color: #fff;
    position: relative;
    overflow: hidden;
	margin-top: 90px;
 
}
	.swiper-container {
        width: 100%;
        max-width: 400px;
		overflow: hidden;
    }

    .swiper-slide-active {
        opacity: 1; 
        transform: scale(1);
		visibility: visible;
    }
	.swiper-slide-active .image_buffet img {
		width: 300px !important;
	}
	.swiper-slide .image_buffet img {
		width: 300px !important;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
	}
    .image_buffet img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
		
    }
	.title {
    font-size: 1.5em;
    margin-top: 36px;
}
	.slogan{
		margin-bottom: 16px;
	}
	:root{
		--swiper-navigation-size: 12px;
	}
	.swiper-button-next {
    width: 24px;
    height: 24px;
    border-radius: 100%;
	padding:2px;
	background:#b8adba47 !important;
	right: -47px;;
	margin-right: 16px;
	transform: translateY(-50%);
	z-index: 10;
	color: #fff;
}
.swiper-button-prev {
    width: 24px;
    height: 24px;
    border-radius: 100%;
	padding:2px;
	background:#b8adba47 !important;
	left: -32px;;
	margin-right: 16px;
	transform: translateY(-50%);
	z-index: 10;
	color: #fff;
}
	.swiper-wrapper{
		position: relative;
		display: flex;
	}
	.image_buffet {
    position: relative;
	margin-top: 20px;
	}
	.text-description {
		width: 70%;
		font-weight: 500;
	}
	.button-detail {
    background: #D9D9D9;
    color: #000;
    padding: 8px 16px;
    width: 70%;
    display: flex;
    align-items: center;
    justify-content: center;
}
	/* Container styles */
.discount-container {
    text-align: center;
    background-color: #f0f0f0; /* Màu nền */
    padding: 20px;
    border-radius: 8px;
    font-family: Arial, sans-serif;
    color: #333;
	margin-top: 16px;
}

/* Heading styles */
.discount-heading {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 20px;
}

/* Discount slider container */
.discount-slider {
    display: flex;
    align-items: center;
    justify-content: space-between;
	position: relative;

}

/* Line between steps */
.discount-line {
    flex-grow: 1;
    height: 1px;
    background-color: #aaa;
    position: relative;
    top: -26px;
}
/* Discount step container */
.discount-step {
    text-align: center;
    width: 50px; /* Độ rộng của mỗi bước */
    position: relative;
}

/* Circle styles */
.discount-circle {
    display: inline-block;
    width: 14px;
    height: 14px;
    background-color: white;
    border: 1px solid #aaa;
    border-radius: 50%;
    margin-bottom: 10px;
}

/* Percentage styles */
.discount-percentage {
    font-size: 14px;
    font-weight: bold;
    margin: 0;
    color: #000;
}

/* Number of people styles */
.discount-people {
    font-size: 12px;
    color: #666;
    margin: 0;
}
.steps-container {
    text-align: center;
    padding: 30px 20px;
    border-radius: 8px;
    font-family: Arial, sans-serif;
    color: white;
}

/* Heading styles */
.steps-heading {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Wrapper for step cards */
.steps-wrapper {
    display: flex;
    justify-content: center;
    gap: 20px;
}

/* Individual step card */
.step-card {
    border-radius: 10px;
    width: 106px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

/* Placeholder image style */
.step-image {
    width: 100%;
    height: 150px;
    background-color: #d3d3d3; /* Gray placeholder */
    border-radius: 10px;
    margin-bottom: 10px;
}

/* Step title */
.step-title {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Step description */
.step-description {
    font-size: 12px;
    line-height: 1.4;
}
	.banner {
	position: relative;
	text-align: center;
	color: white;
	margin-bottom: 16px;
}

    /* Tiêu đề */
.banner h1 {
	font-size: 20px;
	font-weight: bold;
	color: #ffffff;
	position: relative;
	border: 2px solid #E3C9B0; /* Viền màu nhạt */
	border-radius: 20px; /* Bo góc */
	text-align: center;
	color: white;
	margin-bottom: 4px;
	padding: 0px 16px;
}

/* Phần giảm giá */
.banner .discount {
	position: absolute;
	top: -30px;
	right: -60px;
	background: #b02d1d; /* Màu đỏ */
	color: white;
	padding: 4px 15px;
	border-radius: 10px; /* Bo tròn */
	font-size: 12px;
	font-weight: bold;
}

/* Text phụ */
.banner p {
	font-size: 16px;
}

.swiper-pagination-bullet {
width: 7px;
height: 7px;
background: white;
opacity: 0.5; /* Mờ đi để không active */
border-radius: 50%;
margin: 0 5px; /* Khoảng cách giữa các bullet */
transition: opacity 0.3s ease, transform 0.3s ease;
}
.swiper-pagination {
	top: 445px !important;
	z-index: auto !important;
}
/* Bullet Active */
.swiper-pagination-bullet-active {
    background: #f2a900; /* Màu vàng cho bullet active */
    opacity: 1; /* Hiển thị rõ */
    transform: scale(1.2); /* Phóng to bullet active */
}

</style>
<script>
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1, // Chỉ hiển thị 1 slide hoàn toàn
        spaceBetween: 0,  // Không có khoảng cách giữa các slide
        loop: true,       // Lặp lại slide
        speed: 800,       // Thời gian chuyển động giữa các slide
        longSwipes: false, // Cấm vuốt qua nhiều slide
		grabCursor: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

document.addEventListener('DOMContentLoaded', function () {
    // Lấy các phần tử
    const modal = document.getElementById('modal-success-social');
    const confirmButton = document.getElementById('confirm-button-social');
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
	// overlay.addEventListener('click', closeModal);
    closeModalButton.addEventListener('click', closeModal);
});

</script>

<?php get_footer("empty"); ?>
