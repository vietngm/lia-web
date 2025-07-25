<?php get_header("empty"); ?>
<?php
	$fields = get_fields();
	$price = $fields["price"] ? $fields["price"] : 0;
	$discountPrice = $fields["discountPrice"] ? $fields["discountPrice"] : 0;
	$discountPercentage = ($price > 0 && $discountPrice < $price) 
    ? round((($price - $discountPrice) / $price) * 100) 
    : 0;
	$args = array(
		"post_type" => "service",
		"posts_per_page" => 8,
		"post__not_in" => array(get_the_ID()),
		"tax_query" => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'service-category',
				'field' => 'id',
				'terms' => wp_get_post_terms(get_the_ID(), 'service-category', array('fields' => 'ids')),
				'include_children' => true,
				'operator' => 'IN'
			),
		)
	);
	
	$the_query_related = new WP_Query( $args );
?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const price = <?= isset($fields['discountPrice']) && $fields['discountPrice'] > 0 && $fields['discountPrice'] < $fields['price'] 
            ? $fields['discountPrice'] 
            : (isset($fields['price']) ? $fields['price'] : 0); ?>;

  localStorage.setItem('servicePrice', price);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const serviceName = <?= json_encode(get_the_title()); ?>;
  localStorage.setItem('serviceName', serviceName);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const serviceId = <?= json_encode(get_the_ID()); ?>;
  localStorage.setItem('serviceId', serviceId);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const selectedGift = <?= json_encode(get_the_ID()); ?>;
  localStorage.setItem('selectedGift', selectedGift);
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const radioButtons = document.querySelectorAll('input[name="gift"]');

  function saveToLocalStorage(selectedGift) {
    localStorage.setItem("selectedGift", selectedGift);
    console.log("Đã lưu:", selectedGift);
    updateSelected();
  }

  function updateSelectedGift() {
    const savedGift = localStorage.getItem("selectedGift");
    if (savedGift) {
      document.querySelectorAll('input[name="gift"]').forEach(radio => {
        if (radio.value === savedGift) {
          radio.checked = true;
        }
      });
    }
  }

  // Nếu chỉ có 1 quà, tự động chọn & lưu
  if (radioButtons.length === 1) {
    saveToLocalStorage(radioButtons[0].value);
  }

  // Khi chọn quà, lưu vào localStorage
  radioButtons.forEach(radio => {
    radio.addEventListener("change", function() {
      saveToLocalStorage(this.value);
    });
  });

});
</script>
<script>
window.addEventListener('scroll', function() {
  const header = document.getElementById('page-header');
  if (window.scrollY > 100) {
    header.classList.add('show');
  } else {
    header.classList.remove('show');
  }
});
</script>
<main class="is-service">
  <section class="section-product-header mb-2">
    <header id="page-header">
      <div class="history-back cursor-pointer" data-fallback="<?= get_permalink(get_field("home", "option")) ?>">
        <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-left-gray.svg") ?>" alt="" />
      </div>
      <div>
        <h1 style="padding-left:8px" class=" text-center text-16 font-bold"><?= get_the_title() ?></h1>
      </div>
    </header>
    <div class="container">
      <div class="grid grid-cols-2 gap-4 relative">
        <div class="product-detail-slider mount-slider lg:col-span-1 col-span-2 sm:mt-0 sm:mx-0  -mx-4">
          <?php foreach ($fields["gallery"] as $item) : ?>
          <div>
            <img class="w-full" style="margin-top:0px"
              src="<?= bfi_thumb($item , array("width"=>800, 'crop'=>false)) ?>" />
          </div>
          <?php endforeach; ?>
        </div>
        <div class="lg:col-span-1 col-span-2 flex flex-col">
          <h1 class="text-18 font-semibold"><?= get_the_title(); ?></h1>
          <div class=" flex items-center gap-1">
            <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/tgian.svg") ?>" alt="" />
            <span class="text-12"><?= $fields["time"] ?> phút</span>
          </div>
          <div class="mt-2">
            <p class="text-14"><?= $fields["note"] ?></p>
          </div>
          <div class="flex gap-2 items-center mt-2 " style="justify-content: space-between;">
            <div class="text-16 text-red-500 flex items-center gap-2 justify-between w-full">
              <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
              <div class="flex items-center gap-2 font-semibold">
                <span class="text-price ml-2" style="font-weight:700">
                  <?= number_format($discountPrice, 0, ",", ".") ?> <small>đ</small>
                </span>
                <span class="text-gray-400 line-through opacity-70" style="color:#ccc;font-size:13px">
                  <?= number_format($price, 0, ",", ".") ?> <small>đ</small>
                </span>
              </div>
              <div class="discount-percentages flex items-center gap-1">
                <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/discount.svg") ?>" alt="" />
                <span>-<?= $discountPercentage ?>%</span>
              </div>
              <?php else : ?>
              <span class="font-semibold"><?= number_format($price, 0, ",", ".") ?> <small><u>đ</u></small></span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="block lg:hidden w-full h-[3px] bg-gray-200 mb-2"></div>
  <section>
    <div class="max-w-md mx-auto bg-white p-4 rounded-lg shadow-lg " style="padding-top:0px;padding-bottom:0px">
      <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
        style="font-size:16px;color:#1A5477">Chọn topping</h2>
      <?php if (!empty($fields['desire'])): ?>
      <div class="mt-2">
        <div id="priceData"
          data-price="<?= isset($fields['discountPrice']) && $fields['discountPrice'] > 0 && $fields['discountPrice'] < $fields['price'] ? $fields['discountPrice'] : (isset($fields['price']) ? $fields['price'] : 0); ?>">
        </div>
        <div class="flex justify-between items-center">
          <h3 class="font-medium service-topping-name">
            <?= !empty($fields['name_desire']) ? $fields['name_desire'] : "Hình thức gội đầu" ?> <span class="text-12"
              style="font-weight:300"> ( Chọn 1 ) </span>
          </h3>
          <button id="desire" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="gap-2 mt-2 flex flex-col overflow-x-auto no-scrollbar options-container w-full">
          <?php include get_template_directory()."/content/solution.php"; ?>
        </div>
        <div id="modal-desire" class=" modal-desire fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						set_query_var('field', $fields);
						get_template_part( 'template-parts/modal', "service-desire"); 
					?>
        </div>
      </div>
      <?php endif; ?>
      <div class="w-full  bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php if (!empty($fields['material'])): ?>
      <!-- Vật liệu -->
      <div class="mt-2">
        <div class="flex justify-between items-center">
          <h3 class="font-medium service-topping-name">
            <?= !empty($fields['name_material']) ? $fields['name_material'] : "Topping A" ?><span class="text-12"
              style="font-weight:300"> ( Chọn 1 ) </span>
          </h3>
          <button id="material" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="gap-2 mt-2 flex flex-col overflow-x-auto no-scrollbar options-container w-full">
          <?php include get_template_directory()."/content/timer.php"; ?>
        </div>
        <div id="modal-material" class="modal-material fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						set_query_var('field', $fields);
						get_template_part( 'template-parts/modal', "service-material"); 
					?>
        </div>
      </div>
      <div class="w-full bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php endif; ?>

      <!-- Bảo hành -->
      <?php if (!empty($fields['bh'])): ?>
      <div class="mt-2">
        <div class="flex justify-between items-center">
          <h3 class="font-medium service-topping-name">
            <?= !empty($fields['name_bh']) ? $fields['name_bh'] : "Topping B" ?>
          </h3>
          <button id="bh" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="flex flex-col gap-2 mt-2 ">
          <?php include get_template_directory()."/content/warranty.php"; ?>
        </div>
        <div id="modal-bh" class="modal-bh fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						set_query_var('field', $fields);
						get_template_part( 'template-parts/modal', "service-bh"); 
					?>
        </div>
      </div>
      <div class="w-full bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php endif; ?>
      <?php if (!empty($fields['topping_4'])): ?>
      <!-- Topping 4-->
      <div class="mt-2">
        <div class="flex justify-between items-center">
          <h3 class="font-medium service-topping-name">
            <?= !empty($fields['ten_topping_4']) ? $fields['ten_topping_4'] : "Topping Option" ?> <span class="text-12"
              style="font-weight:300"> ( Chọn 1 ) </span>
          </h3>
          <button id="material" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="gap-2 mt-2 flex flex-col overflow-x-auto no-scrollbar options-container w-full">
          <?php include get_template_directory()."/content/topping4.php"; ?>
        </div>
        <div id="modal-material" class="modal-material fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						//set_query_var('field', $fields);
						//get_template_part( 'template-parts/modal', "service-material"); 
					?>
        </div>
      </div>
      <div class="w-full  bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php endif; ?>

      <?php if (!empty($fields['topping_5'])): ?>
      <!-- Topping 5-->
      <div class="mt-2">
        <div class="flex justify-between items-center">
          <h3 class="font-medium service-topping-name">
            <?= !empty($fields['ten_topping_5']) ? $fields['ten_topping_5'] : "Topping Option" ?> <span class="text-12"
              style="font-weight:300"> ( Chọn 1 ) </span>
          </h3>
          <button id="material" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="gap-2 mt-2 flex flex-col overflow-x-auto no-scrollbar options-container w-full">
          <?php include get_template_directory()."/content/topping5.php"; ?>
        </div>
        <div id="modal-material" class="modal-material fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						//set_query_var('field', $fields);
						//get_template_part( 'template-parts/modal', "service-material"); 
					?>
        </div>
      </div>
      <div class="w-full  bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php endif; ?>

      <div class="section-luuy mt-2">
        <h3 style="font-weight:500">Thêm lưu ý <span class="text-12" style="font-weight:300"> ( Không bắt buộc ) </span>
        </h3>
        <textarea name="noteForLiA" placeholder="Bạn có lưu ý gì dành cho LiA không?"></textarea>
      </div>
      <?php if (!empty($fields['bh']) || !empty($fields['material']) || !empty($fields['desire'])): ?>
      <p id="selectedInfo"></p>
      <p id="totalPrice"></p>
      <!-- Nút xem tất cả topping -->
      <div class="mt-4 text-center">
        <!-- <button id="topping" style=" background:#00AB83;color:#FFF;padding:4px 12px;font-size:14px" class="submit bg-green-500  rounded-2 text-sm  shadow-md hover:bg-green-600 transition">
					Xem tất cả topping &gt;&gt;
				</button> -->
        <div id="modal-topping" class=" modal-topping fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup"
          style="z-index: 1000">
          <?php 
						set_query_var('field', $fields);
						get_template_part( 'template-parts/modal', 'service-topping' ); 
					?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <div class="block lg:hidden w-full h-[2px] bg-gray-200  mb-2"></div>
  <section>
    <div class="max-w-2xl mx-auto bg-white p-4 rounded-lg shadow-md" style="padding-top:0px">
      <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
        style="font-size:16px;color:#1A5477">Chuyên viên</h2>
      <div class="flex overflow-x-auto no-scrollbar gap-3 mt-2">
        <?php foreach ($fields["doctors"] as $doctorId) : ?>
        <?php $doctorFields = get_fields($doctorId); ?>
        <a href="<?= get_permalink($doctorId) ?>" style="background:#F6F6F6"
          class="flex flex-shrink-0 gap-3 px-3 py-2 rounded-2">
          <img class="w-10 h-10 rounded-full  border-text" src="<?= get_the_post_thumbnail_url($doctorId) ?>" />
          <div class="flex-1">
            <span style="font-weight:500 ;font-size:12px"><?= get_the_title($doctorId) ?></span>
            <div class="flex gap-2 items-center">
              <div class="text-12 flex items-center gap-1">
                <div class="flex items-center gap-1">
                  <h2 style="font-weight:500"><?= $doctorFields["rating"] ?></h2>
                </div>
                <div style="color:#ccc">|</div>
                <div class="flex items-center gap-1">
                  <h2 style="font-weight:500 text-12"><?= $doctorFields["client_number"] ?>K+</h2>
                  <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/users.svg") ?>" alt="" />
                </div>
              </div>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>

      <div class="reviews-container">
        <?php include get_template_directory()."/template-parts/content-review.php"; ?>
      </div>

    </div>
  </section>
  <secrion>
    <div class="container">
      <div>
        <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
          style="font-size:16px;color:#1A5477">Cam kết chính sách</h2>
        <?php if (!empty($fields['tt_ht']) || !empty($fields['bh_cs']) ): ?>
        <div class=" flex overflow-x-auto no-scrollbar gap-2 mt-2">
          <div class="border-1 rounded-2 p-2 bg-gray-50" style="border-color:#F6F6F6;background:#F6F6F6">
            <div style="width:220px">
              <?= $fields["tt_ht"] ?>
            </div>
          </div>
          <div class="border-1 rounded-2 p-2 bg-gray-50" style="border-color:#F6F6F6;background:#F6F6F6">
            <div style="width:220px">
              <?= $fields["bh_cs"] ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="mt-4">
        <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
          style="font-size:16px;color:#1A5477">Mô tả chi tiết</h2>
        <div class="max-w-2xl  shadow-lg rounded-lg overflow-hidden mt-2 ">
          <div id="contentBox" class="relative collapsed">
            <div class="contentBox inset-0 flex flex-col justify-center items-center bg-opacity-40">
              <?php if ($fields["description"]) : ?>
              <?= $fields["description"] ?>
              <?php endif; ?>
            </div>
            <div class="overlay"></div>
          </div>
        </div>
        <div class="text-center p-4 z-10">
          <button id="toggleButton" class="text-purple-600 font-semibold hover:underline">
            Xem tất cả ▼
          </button>
        </div>
      </div>
    </div>
  </secrion>
  <div class="block lg:hidden w-full h-[3px] bg-gray-200  mb-2"></div>

  <div id="modal-booking" class="modal-booking fixed hidden top-0 left-0 right-0 bottom-0 z-[120] modal-popup">
    <?php get_template_part( 'template-parts/modal', 'service-booking' ); ?>
  </div>

  <section>
    <div class="container">
      <?php if ($the_query_related->have_posts()) : ?>
      <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
        style="font-size:16px;color:#1A5477">Có thể bạn quan tâm</h2>
      <div class="mb-10 mt-2">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
          <?php while ( $the_query_related->have_posts() ) : $the_query_related->the_post(); ?>
          <div class="col-span-1 product-list-item">
            <?php get_template_part( 'template-parts/service', 'summary' ); ?>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </section>
</main>

<script>
selectOptionDesire = (element) => {
  const name = element.getAttribute('data-name');
  const price = element.getAttribute('data-price') || "0"; // Đảm bảo không bị null

  console.log("Data nhận vào:", {
    name,
    price
  });

  if (!name) {
    console.warn("Lỗi: data-name không hợp lệ", name);
    return;
  }

  let selectedDesires = JSON.parse(localStorage.getItem('selectedDesire') || "[]");
  if (Array.isArray(selectedDesires)) {
    const index = selectedDesires.findIndex(item => item.name === name);
    // xử lý index...
    selectedDesires.push({
      name,
      price
    });
  } else {
    console.warn('selectedDesires is not an array', selectedDesires);
    selectedDesires.splice(index, 1);
  }

  // const index = selectedDesires.findIndex(item => item.name === name);
  // console.log("Index:", index);

  // if (index !== -1) {
  //   selectedDesires.splice(index, 1);
  // } else {
  //   selectedDesires.push({
  //     name,
  //     price
  //   });
  // }

  console.log("Danh sách sau khi cập nhật:", selectedDesires);

  localStorage.setItem('selectedDesire', JSON.stringify(selectedDesires));

  setTimeout(() => {
    updateTotalPrice(); // Đảm bảo giá tổng cập nhật đúng trước khi cập nhật footer
    updateUI();
    updateNoteTopping();
    updateFooterPrice(); // Cập nhật giá footer sau khi updateTotalPrice hoàn thành
    updateBookingInfo();
  }, 50);

  document.querySelectorAll('.modal-option').forEach(input => {
    input.checked = selectedDesires.some(item => item.name === input.getAttribute('data-name'));
  });
};
</script>
<script>
selectOptionMaterial = (element) => {
  console.log(element);
  const name = element.getAttribute('data-name');
  const price = element.getAttribute('data-price');
  console.log(name, price);

  // Chỉ lưu một tùy chọn duy nhất
  const selectedMaterials = {
    name,
    price
  };

  // Cập nhật lại localStorage
  localStorage.setItem('selectedMaterials', JSON.stringify(selectedMaterials));

  // Cập nhật giao diện
  setTimeout(() => {
    updateTotalPrice(); // Đảm bảo giá tổng cập nhật đúng trước khi cập nhật footer
    updateUI();
    updateNoteTopping();
    updateFooterPrice(); // Cập nhật giá footer sau khi updateTotalPrice hoàn thành
    updateBookingInfo();
  }, 50);

  // Cập nhật trạng thái checkbox: chỉ chọn 1
  document.querySelectorAll('.modal-option-material').forEach(input => {
    input.checked = input.getAttribute('data-name') === name;
  });
};
</script>
<script>
selectOptionBh = (element) => {
  console.log(element);
  const name = element.getAttribute('data-name');
  const price = element.getAttribute('data-price');
  console.log(name, price);

  // Chỉ lưu một tùy chọn duy nhất
  const selectedBh = {
    name,
    price
  };

  // Cập nhật lại localStorage
  localStorage.setItem('selectedBh', JSON.stringify(selectedBh));

  // Cập nhật giao diện
  setTimeout(() => {
    updateTotalPrice(); // Đảm bảo giá tổng cập nhật đúng trước khi cập nhật footer
    updateUI();
    updateNoteTopping();
    updateFooterPrice(); // Cập nhật giá footer sau khi updateTotalPrice hoàn thành
    updateBookingInfo();
  }, 50);

  // Cập nhật trạng thái checkbox: chỉ chọn 1
  document.querySelectorAll('.modal-option-bh').forEach(input => {
    input.checked = input.getAttribute('data-name') === name;
  });
};
</script>

<script>
selectOptionTp4 = (element) => {
  console.log(element);
  const name = element.getAttribute('data-name');
  const price = element.getAttribute('data-price');
  console.log(name, price);

  // Chỉ lưu một tùy chọn duy nhất
  const selectedTp4 = {
    name,
    price
  };

  // Cập nhật lại localStorage
  localStorage.setItem('selectedTp4', JSON.stringify(selectedTp4));

  // Cập nhật giao diện
  setTimeout(() => {
    updateTotalPrice(); // Đảm bảo giá tổng cập nhật đúng trước khi cập nhật footer
    updateUI();
    updateNoteTopping();
    updateFooterPrice(); // Cập nhật giá footer sau khi updateTotalPrice hoàn thành
    updateBookingInfo();
  }, 50);

  // Cập nhật trạng thái checkbox: chỉ chọn 1
  // document.querySelectorAll('.modal-option-bh').forEach(input => {
  //   input.checked = input.getAttribute('data-name') === name;
  // });
};
</script>

<script>
selectOptionTp5 = (element) => {
  console.log(element);
  const name = element.getAttribute('data-name');
  const price = element.getAttribute('data-price');
  console.log(name, price);

  // Chỉ lưu một tùy chọn duy nhất
  const selectedTp5 = {
    name,
    price
  };

  // Cập nhật lại localStorage
  localStorage.setItem('selectedTp5', JSON.stringify(selectedTp5));

  // Cập nhật giao diện
  setTimeout(() => {
    updateTotalPrice(); // Đảm bảo giá tổng cập nhật đúng trước khi cập nhật footer
    updateUI();
    updateNoteTopping();
    updateFooterPrice(); // Cập nhật giá footer sau khi updateTotalPrice hoàn thành
    updateBookingInfo();
  }, 50);

  // Cập nhật trạng thái checkbox: chỉ chọn 1
  // document.querySelectorAll('.modal-option-bh').forEach(input => {
  //   input.checked = input.getAttribute('data-name') === name;
  // });
};
</script>

<script>
const swiper = new Swiper('.swiper-container', {
  slidesPerView: 1.1,
  spaceBetween: 6,
  loop: true,
  speed: 800,
  grabCursor: true,

});
</script>
<script>
const contentBox = document.getElementById("contentBox");
const overlay = contentBox.querySelector(".overlay");
const toggleButton = document.getElementById("toggleButton");
let isExpanded = false;

toggleButton.addEventListener("click", () => {
  isExpanded = !isExpanded;

  if (isExpanded) {
    contentBox.classList.remove("collapsed");
    contentBox.classList.add("expanded");

    if (overlay) {
      overlay.style.display = "none";
    }

    toggleButton.innerHTML = "Thu gọn ▲";
  } else {
    contentBox.classList.remove("expanded");
    contentBox.classList.add("collapsed");

    if (overlay) {
      overlay.style.display = "block";
    }

    toggleButton.innerHTML = "Xem tất cả ▼";
  }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  let basePrice = Number(document.getElementById("priceData").getAttribute("data-price"));

  function updateURLPrice(totalPrice) {
    const url = new URL(window.location);
    url.searchParams.set('totalPrice', totalPrice);
    window.history.pushState({}, '', url);
  }

  function getPriceFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('totalPrice') || basePrice;
  }

  let totalPrice = getPriceFromURL();
  const totalPriceElement = document.getElementById("totalPrice");
  totalPriceElement.textContent = `${totalPrice.toLocaleString()} đ`;

  const modal = document.getElementById("modal-topping");
  const openModalButton = document.getElementById("openModal");
  const closeModalButton = document.getElementById("closeModal");

  openModalButton.addEventListener("click", function() {
    modal.classList.remove("hidden");
    modal.style.display = "block";
    totalPrice = getPriceFromURL();
    totalPriceElement.textContent = `${totalPrice.toLocaleString()} đ`;
  });

  if (closeModalButton) {
    closeModalButton.addEventListener("click", function() {
      modal.style.display = "none";
      modal.classList.add("hidden");
    });
  }
});
</script>
<script>
function addClassToMainPage() {
  const mainElement = document.getElementById("mainPageDesire");

  if (mainElement) {
    mainElement.classList.add("updated");
  }
}
</script>
<script>
document.querySelectorAll('.option-desire').forEach(option => {
  option.addEventListener('click', function() {
    const name = this.getAttribute('data-name');
    const price = this.getAttribute('data-price');

    localStorage.setItem('selectedDesire', JSON.stringify({
      name,
      price
    }));
    updateUI();
    updateNoteTopping();
    document.querySelectorAll('.modal-option').forEach(input => {
      input.checked = input.getAttribute('data-name') === name;
    });
  });
});
</script>
<script>
document.querySelectorAll('.option-material').forEach(option => {
  option.addEventListener('click', function() {
    const name = this.getAttribute('data-name');
    const price = this.getAttribute('data-price');

    localStorage.setItem('selectedMaterial', JSON.stringify({
      name,
      price
    }));
    updateUI();
    updateNoteTopping();
    document.querySelectorAll('.modal-option-material').forEach(input => {
      input.checked = input.getAttribute('data-name') === name;
    });
  });
});
</script>
<script>
document.querySelectorAll('.option-bh').forEach(option => {
  option.addEventListener('click', function() {
    const name = this.getAttribute('data-name');
    const price = this.getAttribute('data-price');

    localStorage.setItem('selectedBh', JSON.stringify({
      name,
      price
    }));
    updateUI();
    updateNoteTopping();
    document.querySelectorAll('.modal-option-bh').forEach(input => {
      input.checked = input.getAttribute('data-name') === name;
    });
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  addOptionEvent(".option-desire", "selectedDesire");
  addOptionEvent(".option-material", "selectedMaterial");
  addOptionEvent(".option-bh", "selectedBh");
  addOptionEvent(".option-tp4", "selectedTp4");
  addOptionEvent(".option-tp5", "selectedTp5");

  updateTotalPrice();
});

function addOptionEvent(selector, storageKey) {
  document.querySelectorAll(selector).forEach(option => {
    option.addEventListener("click", function() {
      const name = this.getAttribute("data-name");
      const price = parseInt(this.getAttribute("data-price")) || 0;

      localStorage.setItem(storageKey, JSON.stringify({
        name,
        price
      }));

      updateCheckedState(selector, name);

      updateTotalPrice();
    });
  });
}

function updateCheckedState(selector, name) {
  document.querySelectorAll(selector).forEach(input => {
    input.checked = input.getAttribute("data-name") === name;
  });
}

function updateTotalPrice() {
  const servicePrice = parseInt(localStorage.getItem("servicePrice")) || 0;
  const selectedDesire = JSON.parse(localStorage.getItem("selectedDesire")) || {
    price: 0
  };
  const selectedMaterial = JSON.parse(localStorage.getItem("selectedMaterial")) || {
    price: 0
  };
  const selectedBh = JSON.parse(localStorage.getItem("selectedBh")) || {
    price: 0
  };

  const selectedTp4 = JSON.parse(localStorage.getItem("selectedTp4")) || {
    price: 0
  };

  const selectedTp5 = JSON.parse(localStorage.getItem("selectedTp5")) || {
    price: 0
  };

  const totalPrice = servicePrice + selectedDesire.price + selectedMaterial.price + selectedBh.price + selectedTp4
    .price + selectedTp5.price;
  localStorage.setItem("totalPrice", totalPrice);

  document.getElementById("footer-total-price").textContent =
    new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
  document.getElementById("totalPriceDisplay").textContent =
    new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
  document.getElementById("totalPriceBooking").textContent =
    new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
}
</script>
<script>
localStorage.clear();
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-material');
  const confirmButton = document.getElementById('material');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
  });

  const closeModal = () => {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.documentElement.style.overflow = '';
    document.body.style.overflow = '';
  };

  closeModalButton.addEventListener('click', closeModal);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-desire');
  const confirmButton = document.getElementById('desire');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
  });

  const closeModal = () => {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.documentElement.style.overflow = '';
    document.body.style.overflow = '';
  };

  closeModalButton.addEventListener('click', closeModal);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-bh');
  const confirmButton = document.getElementById('bh');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.body.classList.add('modal-open');
  });

  const closeModal = () => {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.body.classList.remove('modal-open');
  };

  closeModalButton.addEventListener('click', closeModal);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-topping');
  const confirmButton = document.getElementById('topping');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.body.classList.add('modal-open');
  });

  const closeModal = () => {
    console.log("Đóng modal...");
    if (!modal) {
      console.error("Modal không tồn tại!");
      return;
    }
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.body.classList.remove('modal-open');
  };

  closeModalButton.addEventListener('click', closeModal);
  overlay.addEventListener('click', closeModal);

  window.addEventListener("message", function(event) {
    if (event.data.action === "closeModal") {
      closeModal();
    }
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-pd');
  const confirmButton = document.getElementById('detail-pd');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.body.classList.add('modal-open');
  });

  const closeModal = () => {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.body.classList.remove('modal-open');
  };

  closeModalButton.addEventListener('click', closeModal);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-booking');
  const confirmButton = document.getElementById('booking');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
  });

  const closeModal = () => {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.documentElement.style.overflow = '';
    document.body.style.overflow = '';
  };

  closeModalButton.addEventListener('click', closeModal);
  updateModalContent();
});
</script>
<?php get_template_part( 'template-parts/footer', "menu"); ?>
<div style="padding-top:100px"></div>
<?php 
set_query_var('field', $fields);
get_template_part( 'template-parts/footer', "service"); 
?>

<?php get_footer("empty"); ?>