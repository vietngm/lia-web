<?php get_header("empty"); ?>

<?php 
	$fields = get_fields();
	$image = bfi_thumb(get_the_post_thumbnail_url() , array("width"=>400, 'crop'=>false));
	$service_categories = get_field('service_categories');
?>

<head>
  <style>
  .row-header-single {
    justify-content: space-between;
    padding: 0 16px;
  }

  .row-img-single {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
  }

  .row-introduce {
    justify-content: center;
    gap: 36px;
    margin-top: 0px;
  }

  .row-single-button {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
    margin-top: 16px;
  }

  /* .button-booking {
    border-radius: 6px;
    border: 1px solid #ccc;
    padding: 4px 16px;
  } */

  .button-zalo {
    border-radius: 6px;
    padding: 7px 16px;
  }

  .row-title-single {
    text-align: center;
    margin-top: 16px;
  }

  .h1-single {
    margin: 0;
    font-weight: 700;

  }

  .h3-single {
    color: #555;
    margin: 0;
    font-style: italic;
    font-size: 12px;

  }

  .row-single-branch {
    padding: 0px 16px;
  }

  .h2-single {
    margin: 0;
    font-size: 12px;
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

  .diary-number {
    display: flex;
    justify-content: flex-end;
    font-size: 12px;
    margin-top: 12px;
    color: #7a7a7a;
  }

  .row-filter-single {
    display: flex;
    gap: 8px;
    margin-top: 8px;
    flex-wrap: wrap;
  }

  .row-filter-single div {
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
    font-size: 13px;
  }

  .content-introduce img {
    width: 100%;
  }

  .border-zalo-bottom {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .content-video {
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

  .bottom-action {
    transform: translateY(0);
    transition: transform 0.4s ease-in-out;
    /* Hiệu ứng mượt */
  }

  .items-introduce {
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
  </style>
</head>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const bottomAction = document.querySelector(".bottom-action");
  let lastScrollTop = 0;
  let isScrolling;

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    clearTimeout(isScrolling);
    if (scrollTop > lastScrollTop) {
      bottomAction.style.transform = "translateY(100%)";
    } else {
      bottomAction.style.transform = "translateY(0)";
    }
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });
});
</script>
<style>
.image-container {
  position: relative;
}

.image-container img {
  width: 100%;
  display: block;
}

.image-container::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 50%;
  /* Chiều cao vùng mờ */
  background: linear-gradient(to top, white, rgba(255, 255, 255, 0));
}

@keyframes slideInFromLeft {
  from {
    transform: translateX(-100%);
    opacity: 0;
  }

  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slideInFromRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }

  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes rotateAndSlide {
  from {
    transform: translateX(100%) rotate(90deg);
    opacity: 0;
  }

  to {
    transform: translateX(0) rotate(90deg);
    opacity: 1;
  }
}

.rotate-slide {
  animation: rotateAndSlide 1s ease-out forwards;
}

.slide-left {
  animation: slideInFromLeft 1s ease-out forwards;
}

.slide-right {
  animation: slideInFromRight 1s ease-out forwards;
}

header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: white;
  padding: 10px 20px;
  z-index: 1000;
  transform: translateY(-100%);
  transition: transform 0.4s ease-in-out;
  display: flex;
  align-items: center;
}

header.show {
  transform: translateY(0);
  display: flex;
  align-items: center;
}

.doctor-image {
  width: 100%;
  max-width: 400px;
  margin: auto;
}

.doctor-details {
  text-align: left;
  margin: 20px;
}

.menu {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-top: 20px;
}

.menu-item {
  padding: 10px 20px;
  background-color: #f0f0f0;
  border-radius: 8px;
  text-decoration: none;
  color: black;
  font-weight: 500;
}

.menu-item:hover {
  background-color: #ddd;
}

.tab {
  height: 29px !important;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease;
  font-size: 12px;
  border-radius: 6px;
}

.tab.active {
  background: #f0f0f0;
  padding: 0px 16px;
  border-radius: 6px;
  font-size: 12px;

}

.indicator-wrapper {
  display: none;

}

.tab.active {
  background-color: #007BFF;
  color: white;
}

.tab-content {
  display: none;
  opacity: 0;
  transition: opacity 1s ease;
}

.tab-content.active {
  opacity: 1;
}

.evaluate-section {
  position: relative;
  text-align: center;
  width: 100%;
  max-width: 900px;
  margin-top: 24px;
}

.background-text {
  font-size: 40px;
  font-weight: bold;
  color: rgba(0, 0, 0, 0.05);
  letter-spacing: 6px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  white-space: nowrap;
  pointer-events: none;
}

.main-text {
  font-size: 24px;
  font-weight: bold;
  color: #344e41;
  z-index: 1;
  position: relative;
}

.line {
  display: inline-block;
  width: 25px;
  height: 1px;
  background-color: #344e41;
  vertical-align: middle;
  margin: 0 4px;
  opacity: 0.7;
}

.rating-container {
  display: flex;
  justify-content: space-between;
}

.rating-summary {
  display: flex;
  gap: 4px;
  align-items: center;
}

.rating-score {
  font-size: 56px;
  font-weight: bold;
  color: #4A4A4A;
}

.rating-text,
.rating-count {
  font-size: 14px;
  color: #7A7A7A;
}

.rating-details {
  display: flex;
  gap: 8px;
  align-items: center;

}

.stars {
  font-size: 6px;
  color: #7A7A7A;
}

.progress-bar {
  width: 150px;
  height: 2px;
  background-color: #E5E7EB;
  border-radius: 4px;
  position: relative;
  overflow: hidden;
}

.fill {
  height: 100%;
  background-color: #4A4A4A;
  border-radius: 4px;
}

.consultant-hotline {
  border-radius: 30px;
  padding: 8px 24px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  border: 1px solid #45843B;
  color: #45843B;
  font-weight: 700;
}

.consultant-zalo-bottom {
  border-radius: 30px;
  padding: 8px 24px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #45843B;
  border: 1px solid #45843B;
  color: #fff;
  flex-direction: column;
}

.reviews {
  margin-top: 8px;
}

/* 
.review-card {
  background: #f2f2f291;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 8px;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
  margin: 1px;
}

.review-card h3 {
  font-size: 16px;
  margin-bottom: 5px;
} */

.review-meta {
  font-size: 12px;
  color: #777;
  margin-top: 8px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.stars {
  color: #f4b400;
}

/* Bản đồ & địa điểm */
h2 {
  font-size: 18px;
  margin-top: 20px;
}

.location {
  margin-top: 10px;
}

.location iframe {
  border: 0;
  width: 100%;
  height: 150px;
  border-radius: 8px;
}

.place-info {
  background: #fff;
  border-radius: 8px;
  margin-top: 10px;
}

.place-info h3 {
  margin: 5px 0;
  font-size: 16px;
}

.header-review {
  display: flex;
  align-items: center;
  font-size: 16px;
  gap: 8px;
  margin-top: 12px;
}

.review-card p {
  font-size: 12px
}

.branch-card {
  background: white;
  padding: 16px;
  border-radius: 10px;
  margin: auto;
}

.branch-image {
  width: 100px;
  height: 100px;
  border-radius: 10px;
  object-fit: cover;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
  padding: 8px;
}

.branch-title {
  font-size: 18px;
  font-weight: 600;
  margin-top: 12px;
  margin-bottom: 12px;
}

.branch-info {
  display: flex;
  justify-content: space-between;
  gap: 5px;
}

.info-box {
  background: #f1f1f1;
  border-radius: 10px;
  padding: 10px;
  flex: 1;
  text-align: center;
}

.info-label {
  font-size: 12px;
  color: gray;
  font-weight: 300;
}

.info-value {
  font-size: 12px;
  font-weight: 500;
}
</style>
<script>
window.addEventListener('scroll', function() {
  const header = document.getElementById('page-header');
  if (window.scrollY > 300) {
    header.classList.add('show');
  } else {
    header.classList.remove('show');
  }
});
</script>

<header id="page-header">
  <div class="history-back cursor-pointer" data-fallback="<?= get_permalink(get_field("page_doctor", "option")) ?>">
    <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-left-gray.svg") ?>" alt="" />
  </div>
  <div>
    <h1 class="px-[60px] text-center text-16 font-bold"><?= get_the_title() ?></h1>
  </div>
</header>
<div class="history-back cursor-pointer flex items-center gap-1"
  data-fallback="<?= get_permalink(get_field("page_doctor", "option")) ?>" style="padding:16px">
  <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-left-gray.svg") ?>" alt="" />
  <div><?= get_the_title() ?></div>
</div>
<div class="branch-card">
  <div class="flex flex-col items-center justify-center">
    <img class="branch-image" src="<?= $image ?>" alt="" />
    <h2 class="branch-title"><?= get_the_title() ?></h2>
  </div>
  <div class="branch-info">
    <div class="info-box">
      <p class="info-label">Thành lập</p>
      <p class="info-value">5 năm</p>
    </div>
    <div class="info-box">
      <p class="info-label">Lượt đánh giá</p>
      <p class="info-value"> <?= $fields["rating"] ?>/<?= $fields["rating_number"] ?></p>
    </div>
    <div class="info-box">
      <p class="info-label">Có</p>
      <p class="info-value"><?= count($fields["chuyen_vien"]) ?> chuyên viên</p>
    </div>
  </div>
</div>
<main class="container">

  <div class="content-rating mt-4">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
      <div class="flex justify-between items-center" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
        <h4 class="rating">
          <span class="name">
            <?= $fields["rating"] ?></span>
          <span class="value">
            (<?= $fields["rating_number"] ?>)
          </span>
        </h4>
        <div class="flex flex-col ">
          <div>khách hàng đã đánh giá</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row-rating">
    <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2" style="font-size:16px;color:#1A5477">
      Vị trí</h2>
    <div class="location">
      <?= $fields["google_map"] ?>
      <div class="place-info">
        <div class="flex items-center gap-3">
          <img class="w-8 h-8" src="<?= get_theme_file_uri("assets/images/logo1.png") ?>" alt="" />
          <h3 style="font-size:16px;font-weight:700"><?= the_title() ?></h3>
        </div>
        <div style="padding-left:44px">
          <div class="flex items-center gap-1">
            <span><?= $fields["address"] ?></span>
          </div>
          <div class="flex gap-1 items-center">
            <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/phone-small.svg") ?>" alt="" />
            <div class="flex items-center">
              <h4 class="text-12"><?= $fields["phone"] ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row-service">
    <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2" style="font-size:16px;color:#1A5477">
      Chuyên viên</h2>
    <?php include get_template_directory()."/content/branch-employee.php"; ?>
  </div>
  <div class="row-service">
    <?php //include get_template_directory()."/content/service-branch.php"; ?>
  </div>
  <div class="h-[80px]"></div>
</main>

<!-- <div class="h-[80px]"></div>
	<div class="h-[80px] flex items-center  fixed bottom-0 left-0 right-0 bg-white bottom-action " style="z-index:10">
		<div class="container">
			<div style="display:flex;align-items:center;gap:12px;justify-content:space-between">
				<div class="col-span-1" >
					<a href="tel:<?= get_field("header_phone", "option") ?>"  class="consultant-hotline" target="_blank"  >
							<img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/call-incoming.svg") ?>" />
						<div style="font-size:12px">Hotline</div>
					</a>
				</div>
				<div class="col-span-1 w-full">
					<a href="<?= get_permalink(get_field("page_booking", "option")) ?>"  target="_blank" class="consultant-zalo-bottom">
							<div style="font-weight:700">Đặt hẹn ngay</div>
						<div style="font-size:10px">Nhận gấp đôi ưu đãi</div>
					</a>
				</div>
				
			</div>
		</div>
	</div> -->
<?php get_footer("empty"); ?>