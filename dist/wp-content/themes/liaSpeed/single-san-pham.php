<?php get_header("empty"); ?>
<?php
	$fields = get_fields();
	// $price = $fields["price"] ? $fields["price"] : 0;
	// $discountPrice = $fields["discountPrice"] ? $fields["discountPrice"] : 0;
	// $discountPercentage = ($price > 0 && $discountPrice < $price)
  //   ? round((($price - $discountPrice) / $price) * 100) 
  //   : 0;

  // $unitPrice = get_field('unit_price', $post->ID);
  // $ratingCount = get_field('sl_dg', $post->ID);
  // $firstPrice = $unitPrice ? $unitPrice[0] : [];
  // $price = $firstPrice['gia_sp'] ?? 0;
  // $discount = $firstPrice['gia_km'] ?? 0;
  // $discountPercentage = $price-($price * ($discount / 100));


   $unitPrice = get_field('unit_price', $post->ID);
  $ratingCount = get_field('sl_dg', $post->ID);
  $firstPrice = $unitPrice ? $unitPrice[0] : [];
  $price = $firstPrice['gia_sp'] ?? 0;
  $discount = $firstPrice['gia_km'] ?? 0;
  $discountPrice = $price-($price * ($discount / 100));


  $thumb = get_field('anh_dai_dien', $post->ID);
	$args = array(
		"post_type" => "san-pham",
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
<style>
.modal-desire,
.modal-material,
.modal-bh,
.modal-topping,
.modal-pd {
  display: none;
  /* Ẩn modal */
  opacity: 0;
  /* Mờ hoàn toàn */
  transform: scale(0.9);
  /* Thu nhỏ modal một chút */
  transition: opacity 0.3s ease, transform 0.3s ease;
  /* Hiệu ứng chuyển đổi */
}

/* Trạng thái hiển thị modal */
.modal-desire.show,
.modal-material.show,
.modal-bh.show,
.modal-topping.show,
.modal-pd.show {
  display: flex;
  /* Hiển thị modal */
  opacity: 1;
  /* Hiện rõ */
  transform: scale(1);
  /* Phóng về kích thước ban đầu */


}

.swiper-container {
  width: 100%;
  overflow: hidden;
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

.form-title::before {
  background: #1a5478;
  width: 3px;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 7rem;
  /* h-28 trong Tailwind là 7rem */
  background: linear-gradient(to top, white, rgba(255, 255, 255, 0.8), transparent);
  transition: opacity 0.3s ease-in-out;
}

.collapsed {
  height: 300px;
  overflow: hidden;
  transition: height 0.3s ease-in-out;
}

.expanded {
  height: auto;
  transition: height 0.3s ease-in-out;
}

body.modal-open {
  overflow: hidden !important;
  position: fixed;
  /* Cố định vị trí */
  width: 100vw;
  /* Đảm bảo không bị tràn */
  height: 100vh;
  top: 0;
  left: 0;
  right: 0;
}

.options-container {
  display: flex;
  gap: 4px
}

.option-desire,
.option-material,
.option-bh {
  display: flex;
  cursor: pointer;
  position: relative;
  width: 100%;
  transition: all 0.3s;
  background: #fff;
  flex-direction: column;
}

.option-desire img,
.option-material img,
.option-bh img {
  width: 50px;
  height: 50px;
  object-fit: cover;
}

.option-desire .text,
.option-material .text,
.option-bh .text {
  margin-left: 10px;
  flex-grow: 1;
}

.option-desire .text p,
.option-material .text p,
.option-bh .text p {
  margin: 2px 0;
  font-size: 14px;
  color: #333;
}

.option-desire .price,
.option-material .price,
.option-bh .price {
  color: red;
  font-weight: bold;
}

/* Khi được chọn */
.option-desire.selected,
.option-material.selected,
.option-bh.selected {
  border-color: #8C61A8;
  /* Viền tím */
  border-width: 1.5px;
}

.option-desire.selected::after,
.option-material.selected::after,
.option-bh.selected::after {
  content: "✔";
  position: absolute;
  bottom: 2px;
  right: 2px;
  background-color: rgb(255, 255, 255);
  font-size: 5px;
  font-weight: bold;
  padding: 0px;
  border-radius: 50%;
  width: 12px;
  height: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

#selectedInfo,
#totalPrice {
  display: none;
}

.discount-percentages {
  background: #FFEDED;
  border-radius: 24px;
  color: #ef4444;
  font-size: 11px;
  padding: 3px 8px;
}

.flash-sale-btn {
  position: fixed;
  bottom: 130px;
  right: 12px;
  z-index: 1000;
  animation: flash 1s infinite alternate, wobble 2s infinite ease-in-out;
  transform-origin: center bottom;
}

@keyframes flash {
  0% {
    opacity: 1;
  }

  100% {
    opacity: 0.6;
  }
}

@keyframes wobble {

  0%,
  40% {
    transform: rotate(0deg);
  }

  50% {
    transform: rotate(-5deg);
  }

  60% {
    transform: rotate(5deg);
  }

  70% {
    transform: rotate(-5deg);
  }

  80% {
    transform: rotate(5deg);
  }

  90% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(0deg);
  }
}

.gift-service {
  margin-top: 12px;
  border: 1px solid #1a547824;
  border-radius: 8px;
}

.gift-service-child {
  padding: 8px;

}

span.text-bold {
  font-weight: 500;
}

.gift-child {
  background: #ef4444;
  color: #fff;
  padding: 1px 8px;
  border-radius: 24px;
  font-size: 10px;
  font-weight: 600;
}

.promotion-service {
  background: #1a547824;
  border-radius: 7px 7px 0px 0px;
  padding: 4px 8px;
  font-weight: 600;
  overflow: hidden;
}

.image_service img,
.contentBox img {
  width: 100%;
}

.swiper-wrapper {
  height: auto;
}

header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: white;
  padding: 8px 16px;
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

.radio,
.checkbox {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 12px;
  color: #333;
}

textarea {
  width: 100%;
  height: 80px;
  padding: 10px;
  border: 1px solid #eee;
  border-radius: 5px;
  font-size: 14px;
  resize: none;
  margin-top: 4px;
}

.header-review {
  display: flex;
  align-items: center;
  font-size: 14px;
  gap: 8px;
}

.reviews-container {
  margin-top: 16px;
}

.review-card p {
  font-size: 12px
}

.reviews {
  margin-top: 8px;
}

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
}

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
</style>
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
<main>
  <section class=" section-product-header mb-2">
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
          <?php foreach ($fields["product_gallery"] as $item) : ?>
          <div>
            <img class="w-full" style="margin-top:0px"
              src="<?= bfi_thumb($item['url'] , array("width"=>800, 'crop'=>false)) ?>" />
          </div>
          <?php endforeach; ?>
        </div>
        <div class="lg:col-span-1 col-span-2 flex flex-col">
          <div class="product-detail-title">
            <h1 class="text-16 font-semibold"><?= get_the_title(); ?></h1>
            <div class="product-review">
              <span class="scale">8.0</span>
              <span class="total">(<?php echo $ratingCount;?>)</span>
            </div>
          </div>

          <div class="flex gap-2 items-center mt-2 " style="justify-content: space-between;">
            <div class="text-16 flex items-center gap-2 justify-between w-full">

              <?php if($discount==0) {?>
              <div class="product-price">
                <span><?= number_format($price, 0, ",", ".") ?></span>
                <small>đ</small>
              </div>
              <?php } else{ ?>

              <div class="product-km">
                <div class="price-discount">
                  <span><?= number_format($discountPrice, 0, ",", ".") ?></span>
                  <small>đ</small>
                </div>-
                <div class="price-discount">
                  <span><?= number_format($price, 0, ",", ".") ?></span>
                  <small>đ</small>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="block lg:hidden w-full h-[3px] bg-gray-200 mb-2"></div>
  <section>
    <div class="max-w-md mx-auto bg-white p-4 rounded-lg shadow-lg " style="padding-top:0px;padding-bottom:0px">
      <ul class="product-expand">
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Đối tượng phù hợp</span>
            <span class="material-icons">expand_more</span>
          </div>
          <div class="expand-content">
            <div class="expand-desc">1 Dầu Gội Thảo Dược Hà Thủ Ô 2IN1 Cỏ Cây Hoa Lá 450G cải thiện tóc gãy rụng Dầu Gội
              Thảo Dược Hà Thủ Ô 2IN1 Cỏ Cây Hoa Lá 450G cải thiện tóc gãy rụng</div>
          </div>
        </li>
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Hướng dẫn sử dụng</span>
            <span class="material-icons">expand_more</span>
          </div>
          <div class="expand-content">
            <div class="expand-desc">2 Dầu Gội Thảo Dược Hà Thủ Ô 2IN1 Cỏ Cây Hoa Lá 450G cải thiện tóc gãy rụng</div>
          </div>
        </li>
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Thành phần sản phẩm</span>
            <span class="material-icons">expand_more</span>
          </div>
          <div class="expand-content">
            <div class="expand-desc">3 Dầu Gội Thảo Dược Hà Thủ Ô 2IN1 Cỏ Cây Hoa Lá 450G</div>
          </div>
        </li>
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Mô tả chi tiết</span>
            <span class="material-icons">expand_more</span>
          </div>
          <div class="expand-content">
            <div class="expand-desc">4 Dầu Gội Thảo Dược Hà Thủ Ô 2IN1</div>
          </div>
        </li>
      </ul>

      <?php if (!empty($fields['desire'])): ?>
      <div class="mt-2">
        <div id="priceData"
          data-price="<?= isset($fields['discountPrice']) && $fields['discountPrice'] > 0 && $fields['discountPrice'] < $fields['price'] ? $fields['discountPrice'] : (isset($fields['price']) ? $fields['price'] : 0); ?>">
        </div>
        <div class="flex justify-between items-center">
          <h3 class="font-medium">
            <?= !empty($fields['name_desire']) ? $fields['name_desire'] : "Hình thức gội đầu" ?> <span class="text-12"
              style="font-weight:300"> ( Chọn 1 ) </span>
          </h3>
          <button id="desire" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="grid grid-cols-2 gap-3 mt-2 options-container overflow-x-auto no-scrollbar">
          <?php
						$desire_toppings = $fields['desire'];
						if (isset($desire_toppings) && is_array($desire_toppings)) {
							$visible_toppings = array_slice($desire_toppings, 0, 2);
						} else {
							$visible_toppings = []; 
						}
					?>
          <?php foreach ($visible_toppings as $desire_topping) : ?>
          <?php 
						$term = get_term($desire_topping["topping"], 'service-topping'); 
						?>
          <div id="mainPageDesire" data-name="<?= $term->name ?>" data-price="<?= $desire_topping["origin"] ?>"
            style="flex-direction:row" class="option-desire flex items-center relative cursor-pointer gap-2"
            onclick="selectOptionDesire(this)">
            <div style="overflow:hidden">
              <label class="radio">
                <input type="radio" name="desire">
                <?= $term->name ?>
              </label>
            </div>
          </div>
          <?php endforeach; ?>
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
          <h3 class="font-medium">
            <?= !empty($fields['name_material']) ? $fields['name_material'] : "Topping A" ?><span class="text-12"
              style="font-weight:300"> ( Chọn 1 ) </span>
          </h3>
          <button id="material" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="gap-2 mt-2 flex flex-col overflow-x-auto no-scrollbar options-container w-full">
          <?php
						$material_toppings = $fields['material'];
						if (isset($material_toppings) && is_array($material_toppings)) {
							$visible_toppings_material = array_slice($material_toppings, 0, 3);
						} else {
							$visible_toppings_material = []; 
						}
					?>
          <?php foreach ($visible_toppings_material as $material_topping) : ?>
          <?php 
							$term = get_term($material_topping["topping"], 'service-topping'); 
						?>
          <div data-name="<?= $term->name ?>" data-price="<?= $material_topping["origin"] ?>"
            class="option-material  flex-col flex text-sm cursor-pointer " onclick="selectOptionMaterial(this)">
            <div style="overflow:hidden">
              <label class="radio">
                <input type="radio" name="material">
                <?= $term->name ?>
              </label>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div id="modal-material" class="modal-material fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						set_query_var('field', $fields);
						get_template_part( 'template-parts/modal', "service-material"); 
					?>
        </div>
      </div>
      <div class="w-full  bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php endif; ?>

      <!-- Bảo hành -->
      <?php if (!empty($fields['bh'])): ?>
      <div class="mt-2">
        <div class="flex justify-between items-center">
          <h3 class="font-medium">
            <?= !empty($fields['name_bh']) ? $fields['name_bh'] : "Topping B" ?>
          </h3>
          <button id="bh" class="submit text-sm text-gray-500 cursor-pointer"
            style="font-size:12px;color:#646464;font-style:italic"><img class="w-3 h-3"
              src="<?= get_theme_file_uri("assets/images/icons/chamthan.svg") ?>" alt="" /></button>
        </div>
        <div class="flex flex-col gap-2 mt-2 ">
          <?php
						$bh_toppings = $fields['bh'];

						if (isset($bh_toppings) && is_array($bh_toppings)) {
							$visible_toppings_bh = array_slice($bh_toppings, 0, 3);
						} else {
							$visible_toppings_bh = []; 
						}
					?>
          <?php foreach ($visible_toppings_bh as $bh_topping) : ?>
          <?php 
							$term = get_term($bh_topping["topping"], 'service-topping'); 
						?>
          <div data-name="<?= $term->name ?>" data-price="<?= $bh_topping["origin"] ?>"
            class="option-bh flex-col flex  text-sm cursor-pointer " onclick="selectOptionBh(this)">
            <label class="checkbox">
              <input type="checkbox">
              <?= $term->name ?>
            </label>
          </div>
          <?php endforeach; ?>
        </div>
        <div id="modal-bh" class=" modal-bh fixed hidden top-0 left-0 right-0 bottom-0 z-[120]  modal-popup">
          <?php 
						set_query_var('field', $fields);
						get_template_part( 'template-parts/modal', "service-bh"); 
					?>
        </div>
      </div>
      <div class="w-full  bg-gray-200 " style="border-top:1px solid #eee;margin-top:8px"></div>
      <?php endif; ?>

    </div>
  </section>
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

  const totalPrice = servicePrice + selectedDesire.price + selectedMaterial.price + selectedBh.price;
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
?>

<?php get_footer("empty"); ?>