<?php get_header(); ?>
<?php
	$fields = get_fields();
	$description = get_field('description', $post->ID);
  $hdsd = get_field('hd_sd', $post->ID);
  $tpsp = get_field('tp_sp', $post->ID);
  $dtph = get_field('dt_ph', $post->ID);
  $unitPrice = get_field('unit_price', $post->ID);
  $rating = get_field('danh_gia', $post->ID);
  $ratingCount = get_field('sl_dg', $post->ID);
  $orderCount = get_field('sl_km', $post->ID);
  $firstPrice = $unitPrice ? $unitPrice[0] : [];
  $price = floatval($firstPrice['gia_sp'] ?? 0);
  $discount = floatval($firstPrice['gia_km'] ?? 0);
  $discountPrice = $price-($price * ($discount / 100));

  $tpc = get_field('sp_tpc', $post->ID);
  $spxx = get_field('sp_xx', $post->ID);
  $trong_luong = get_field('sp_tl', $post->ID);
  $kcsp = get_field('sp_kcsp', $post->ID);
  $sp_ttsp = get_field('sp_ttsp', $post->ID);
  $sp_thv = get_field('sp_thv', $post->ID);

  $thumb = get_field('anh_dai_dien', $post->ID);
  
	$args = array(
		"post_type" => "san-pham",
		"posts_per_page" => 8,
		"post__not_in" => array(get_the_ID()),
		"tax_query" => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'product-category',
				'field' => 'id',
				'terms' => wp_get_post_terms(get_the_ID(), 'product-category', array('fields' => 'ids')),
				'include_children' => true,
				'operator' => 'IN'
			),
		)
	);
	
	$the_query_related = new WP_Query( $args );
?>

<main class="is-product-detail">
  <section class="section-product-header mb-2">
    <div class="container">
      <div class="grid grid-cols-2 gap-4 relative">
        <div class="product-detail-slider mount-slider lg:col-span-1 col-span-2 sm:mt-0 sm:mx-0 -mx-4">
          <?php if($thumb){?>
          <div>
            <img class="w-full" src="<?=$thumb['url'] ?>" />
          </div>
          <?php } ?>
          <?php foreach ($fields["product_gallery"] as $item) : ?>
          <div>
            <img class="w-full" style="margin-top:0px"
              src="<?= bfi_thumb($item['url'] , array("width"=>800, 'crop'=>false)) ?>" />
          </div>
          <?php endforeach; ?>
        </div>
        <div class="lg:col-span-1 col-span-2 flex flex-col">
          <div class="flex gap-2 flex-wrap breadcrumb">
            <a class="breadcrumb-home font-semibold" href="/">Trang chủ</a>
            <span>›</span>
            <span class="text-primary">Chi tiết sản phẩm</span>
          </div>
        </div>
        <div class="lg:col-span-1 col-span-2 flex flex-col">
          <div class="product-detail-title">
            <h1><?= get_the_title(); ?></h1>
          </div>

          <div class="flex justify-between items-center mt-2">
            <div class="rating items-center">
              <div class="flex text-10 rating-icon">
                <img src="<?= get_theme_file_uri("assets/images/icons/star.svg") ?>" />
                <span class="name"><?= $rating; ?></span>
                <span class="value">(<?php echo $ratingCount;?>)</span>
              </div>
              <span class="separator">|</span>
              <span class="text-10">Đã bán</span>
              <span class="text-10"><?= $orderCount; ?></span>
            </div>
          </div>

          <div class="flex gap-2 items-center mt-2 " style="justify-content: space-between;">
            <div class="text-16 flex items-center gap-2 justify-between w-full">

              <?php if($discount==0) {?>
              <div class="product-price">
                <span><?= number_format($price, 0, ",", ".") ?></span>
                <small><u>đ</u></small>
              </div>
              <?php } else{ ?>

              <div class="product-km">
                <div class="price-discount">
                  <span><?= number_format($discountPrice, 0, ",", ".") ?></span>
                  <small><u>đ</u></small>
                </div>-
                <div class="price-discount">
                  <span><?= number_format($price, 0, ",", ".") ?></span>
                  <small><u>đ</u></small>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="policy-title">Cam kết chính sách</div>
      <ul class="flex flex-col policy-list">
        <li class="flex items-center justify-between policy-item js-refund-policy">
          <span>Thanh toán & Hoàn tiền</span>
          <div class="arrow-go"></div>
        </li>
        <li class="flex items-center justify-between policy-item js-warranty-policy">
          <span>Bảo hành & Chăm sóc trọn đời</span>
          <div class="arrow-go"></div>
        </li>
      </ul>
    </div>
  </section>
  <secrion>
    <div class="container">
      <div class="policy-title">Mô tả chi tiết</div>
      <div class="max-w-2xl shadow-lg rounded-lg overflow-hidden mt-2">
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
        <button id="toggleButton" class="more-desc-btn hover:underline">
          Xem thêm ▼
        </button>
      </div>
    </div>
  </secrion>
  <section>
    <div class="container">
      <div class="policy-title mb-2 flex items-center justify-between js-product-info">
        Thông tin sản phẩm
        <div class="arrow-go"></div>
      </div>
      <div class="policy-info">
        <table class="w-full">
          <tr>
            <td style="width: 120px;">Tên sản
              phẩm</td>
            <td><?= get_the_title(); ?></td>
          </tr>
          <tr>
            <td>Thành phần chính</td>
            <td><?php echo $tpc; ?></td>
          </tr>
          <tr>
            <td>Thích hợp với</td>
            <td><?php if($sp_thv){
              foreach($sp_thv as $item){
                echo '<div>- '.$item['ten_doi_tuong'].'</div>';
              }
            } ?></td>
          </tr>
          <tr>
            <td>Thuộc tính sản phẩm</td>
            <td><?php if($sp_ttsp){
              foreach($sp_ttsp as $item){
                echo '<div>- '.$item['ten_thuoc_tinh'].'</div>';
              }
            } ?></td>
          </tr>
          <tr>
            <td>Kết cấu sản phẩm</td>
            <td><?php echo $kcsp; ?></td>
          </tr>
          <tr>
            <td>Trọng lượng</td>
            <td><?php echo $trong_luong; ?></td>
          </tr>
          <tr>
            <td>Xuất xứ</td>
            <td><?php echo $spxx; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <?php if ($the_query_related->have_posts()) : ?>
      <h2 class="policy-title">Có thể bạn quan tâm</h2>
      <ul class="product-list">
        <?php while ( $the_query_related->have_posts() ) : $the_query_related->the_post(); ?>
        <li class="product-item">
          <?php include get_template_directory() . '/loop/product.php'; ?>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; wp_reset_postdata(); ?>
      <div class="w-full" style="margin-bottom:16px"></div>
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
</script>
<script>
// function addClassToMainPage() {
//   const mainElement = document.getElementById("mainPageDesire");

//   if (mainElement) {
//     mainElement.classList.add("updated");
//   }
// }
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  // addOptionEvent(".option-desire", "selectedDesire");
  // addOptionEvent(".option-material", "selectedMaterial");
  // addOptionEvent(".option-bh", "selectedBh");
  // updateTotalPrice();
});

// function addOptionEvent(selector, storageKey) {
//   document.querySelectorAll(selector).forEach(option => {
//     option.addEventListener("click", function() {
//       const name = this.getAttribute("data-name");
//       const price = parseInt(this.getAttribute("data-price")) || 0;

//       localStorage.setItem(storageKey, JSON.stringify({
//         name,
//         price
//       }));

//       updateCheckedState(selector, name);

//       updateTotalPrice();
//     });
//   });
// }

// function updateCheckedState(selector, name) {
//   document.querySelectorAll(selector).forEach(input => {
//     input.checked = input.getAttribute("data-name") === name;
//   });
// }
</script>
<script>
localStorage.clear();
</script>
<script>
</script>
<?php
get_template_part( 'template-parts/footer', "menu");
set_query_var('field', $fields);
?>
<div id="bottom-sheet-warranty-policy"
  class="modal-booking fixed hidden top-0 left-0 right-0 bottom-0 z-[120] modal-popup">
  <?php get_template_part( 'template-parts/bottom-sheet', 'product-warranty-policy' ); ?>
</div>
<div id="bottom-sheet-refund-policy"
  class="modal-booking fixed hidden top-0 left-0 right-0 bottom-0 z-[120] modal-popup">
  <?php get_template_part( 'template-parts/bottom-sheet', 'product-refund-policy' ); ?>
</div>
<div id="bottom-sheet-product-info"
  class="modal-booking fixed hidden top-0 left-0 right-0 bottom-0 z-[120] modal-popup">
  <?php get_template_part( 'template-parts/bottom-sheet', 'product-info' ); ?>
</div>
<div class="footer-cart-buy-now">
  <button class="btn btn-primary btn-footer js-buy-now" data-price="<?= $discountPrice ? $discountPrice : $price ?>"
    data-title="<?= get_the_title() ?>" data-id="<?= get_the_ID() ?>" data-image="<?= $thumb['url'] ?>">
    Mua ngay
  </button>
</div>
<?php require "form-modal/buy-now.php";?>
<?php get_footer("empty"); ?>