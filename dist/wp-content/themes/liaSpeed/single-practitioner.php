<?php
  get_header("empty");
	$fields = get_fields();
	$image = bfi_thumb(get_the_post_thumbnail_url() , array("width"=>400, 'crop'=>false));
	$service_categories = get_field('service_categories');
  $doctor_id = get_the_ID();
  $args = array(
    "post_type" => "service",
    "posts_per_page" => -1,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'doctors',
        'value' => $doctor_id,
        'compare' => 'LIKE'
      ),
    ),
  );
  $the_query = new WP_Query( $args );
  $branch = get_posts(array(
    'post_type'      => 'branch',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
    'meta_query'     => array(
      array(
        'key'     => 'chuyen_vien',
        'value'   => $doctor_id,
        'compare' => 'LIKE',
      ),
    ),
  ));
  $branch_id = !empty($branch) ? $branch[0] : null;
?>
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

<header id="page-header"
  style="padding: 16px;position: fixed;top: 0;left: 0;right: 0;z-index: 1;background-color: white;">
  <div class="history-back cursor-pointer flex items-center gap-1"
    data-fallback="<?= get_permalink(get_field("page_doctor", "option")) ?>">
    <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-left-gray.svg") ?>" alt="" />
    <div>Danh sách chuyên viên</div>
  </div>
</header>
<div class="container" style="margin-top: 50px;">
  <div class="mt-2">
    <h1 class="px-[60px] text-center text-16 font-bold"><?= get_the_title() ?></h1>
  </div>
  <div class="relative mx-auto max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="relative">
      <div class=" z-10 relative image-container">
        <img src="<?= $image ?>" alt="Doctor" class="w-full h-auto " />
      </div>
      <div class="text-80 font-extrabold text-gray-200 absolute top-10 left-10 opacity-70" style="font-size: 70px;
				opacity: 4%;
				z-index: 10;
				top: 0;
				left: 0;
				right: 0;
				width: 100%;
				display: flex;
				align-items: center;
				justify-content: center;
				font-family: math;">
        PRACTITIONER
      </div>
      <div class="absolute inset-0 flex flex-col items-center" style="top: 0;
					left: 0;
					right: 0;
					bottom: 0;
					z-index: 10;">

        <div class="relative" style="height: 100%;width: 100%;display: flex;align-items: center;">
          <div class="absolute top-0 left-0 right-0 bottom-0 rotate-slide  "
            style="transform: rotate(90deg);top: -80px;right: 84px;">
            <div class="text-12  text-center"><?= get_field("location") ?></div>
            <div style="color:#9e9e9e" class="text-16 font-bold  text-center"><?= get_the_title() ?></div>
          </div>
          <div style="position: absolute;bottom:0px;right:0" class="slide-right">
            <div class="text-12 text-right">Kinh nghiệm: <?= $fields["experience"] ?? 2 ?></div>
            <div class="text-12 text-right">Đánh giá : <?= $fields["rating_number"] ?></div>
          </div>
          <div style="position: absolute;bottom:173px;" class="slide-left flex flex-col items-center">
            <div class="text-12 text-right">Chuyên</div>
            <div class="text-12 text-center"><?= count($the_query->posts) ?> dịch vụ</div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<main class="container">
  <div class="row-diary">
    <!-- <div class="evaluate-section">
      <div class="background-text">Chuyên viên</div>
      <div>
        <span class="line"></span>
        <span class="main-text">Trải nghiệm</span>
        <span class="line"></span>
      </div>
    </div> -->

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
          <div class="flex flex-col">
            <div>khách hàng đã đánh giá</div>
          </div>

        </div>
        <div class="mt-2">
          <div class="overflow-x-auto no-scrollbar flex gap-2 mb-2 ">
            <?php if ($fields["review_group"]["reviews"]) : foreach ($fields["review_group"]["reviews"] as $review) : ?>
            <div class="bg-gray-50  rounded-lg shadow-sm mb-4" style="       
							margin: 2px;
							width: 300px;
							box-shadow: rgb(247 247 247) 0px 0px 0px 1px, rgb(236 236 236) 0px 0px 0px 1px inset;
							padding: 12px;
							border-radius: 8px;
							background: #ececec69;">
              <div class="flex justify-between items-center" style="width:300px;">
                <div class="flex items-center gap-2">
                  <img style="width:30px ; height:30px"
                    src="<?= !empty($review["image"]) ? $review["image"] : get_theme_file_uri("assets/images/avatar.png") ?>"
                    alt="Avatar" class="w-12 h-12 rounded-full mr-3">
                  <div class=" flex align-start flex-col">
                    <span class="text-lg font-medium"><?= $review["fullname"] ?></span>

                    <div class="rating text-10" style="font-weight:800;width:fit-content">
                      <span class="name"><?= $review["rating"] ?></span>
                      <span class="value">
                        (<?= $review["rating_number"] ?? 5 ?>)
                      </span>
                    </div>
                  </div>
                </div>
                <p class="text-gray-500 text-12" style="margin-right:24px"><?= $review["date"] ?></p>
              </div>
              <div class="mt-2" style="width: 280px;
								overflow: hidden;
								text-overflow: ellipsis;
								line-height: 19px;
								-webkit-line-clamp: 2;
								height: 40px;
								display: -webkit-box;
								-webkit-box-orient: vertical;
								font-size: 13px;">
                <?= $review["content"] ?>
              </div>
              <div class="mt-2 flex gap-2">
                <?php if ($review["gallery"]) : foreach ($review["gallery"] as $image) : ?>
                <img style="width:50px; height:auto; border-radius:6px" src="<?= $image ?>" alt="Image 1"
                  class="w-24 h-24 rounded-lg mr-2">
                <?php endforeach; endif; ?>
              </div>
            </div>
            <?php endforeach; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row-rating mt-4 mb-4">
    <?php include get_template_directory()."/content/practitioner-branch.php"; ?>
  </div>

  <div class="row-service">
    <div class="evaluate-section">
      <div class="practitioner-service-title">
        <span class="main-text">Dịch vụ của <?= get_the_title() ?></span>
      </div>
    </div>
    <div class="content-service mt-4">
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 ">

        <?php if ($the_query->have_posts()) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="col-span-1 product-list-item">
          <?php get_template_part( 'template-parts/service', 'summary', array(
            "doctor_id" => $doctor_id, 
            "branch_id" => $branch_id,
          ) );
          ?>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
      <?php if (count($the_query->posts) <= 0) : ?>
      <div class="grid justify-center items-center">
        Chưa có dịch vụ.
      </div>
      <?php endif;?>
    </div>
  </div>
</main>

<div class="h-[80px]"></div>
<div class="h-[80px] flex items-center fixed bottom-0 left-0 right-0 bg-white bottom-action" style="z-index:10">
  <div class="container">
    <div style="display:flex;align-items:center;gap:12px;justify-content:space-between">
      <div class="col-span-1">
        <a href="tel:<?= get_field("header_phone", "option") ?>" class="consultant-hotline" target="_blank">
          <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/call-incoming.svg") ?>" />
          <div style="font-size:12px">Hotline</div>
        </a>
      </div>
      <div class="col-span-1 w-full">
        <a href="<?= get_permalink(get_field("page_booking", "option")) ?>" class="consultant-zalo-bottom">
          <div style="font-weight:700">Đặt hẹn ngay</div>
          <div style="font-size:10px">Nhận gấp đôi ưu đãi</div>
        </a>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>