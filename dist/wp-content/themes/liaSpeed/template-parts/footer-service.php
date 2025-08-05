<?php
    $field = get_query_var('field');
    $price = !empty($field["price"]) ? $field["price"] : 0;
    $discountPrice = isset($field["discountPrice"]) ? floatval($field["discountPrice"]) : 0;
    $discountPercentage = ($price > 0 && $discountPrice > 0 && $discountPrice < $price) 
        ? round((($price - $discountPrice) / $price) * 100) 
        : 0;
    $basePrice = $discountPrice ?: $price; // Nếu có giảm giá thì lấy giá giảm, không thì lấy giá gốc
?>

<script>
function updateFooterPrice() {
  let savedPrice = localStorage.getItem("totalPrice") || <?= $basePrice ?>;
  document.getElementById("footer-total-price").textContent =
    new Intl.NumberFormat("vi-VN").format(savedPrice) + " đ";
}
updateFooterPrice();
updateBookingInfo();
window.addEventListener("storage", updateFooterPrice);
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const bottomAction = document.querySelector(".bottom-action");
  let lastScrollTop = 0;

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
      bottomAction.style.transform = "translateY(100%)";
    } else {
      bottomAction.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop;
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const totalPrice = localStorage.getItem("totalPrice") || 0;
  const formattedPrice = new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
  document.getElementById("footer-total-price").textContent = formattedPrice;
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const bottomAction = document.querySelector(".bottom-action");
  let lastScrollTop = 0;

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
      bottomAction.style.transform = "translateY(100%)";
    } else {
      bottomAction.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop;
  });
});
</script>

<div class="h-[100px] flex items-center border-t-1 border-[#ccc] fixed bottom-0 left-0 right-0 bg-white bottom-action "
  style="border-top:1px solid #eee; z-index:10">
  <div class="container">
    <div class="flex items-center p-2 justify-end text-12" style="padding-top:12px">
      Tổng cộng :
      <div class="text-12 font-semibold text-red-500 flex items-center gap-2 " style="margin-left:4px">
        <!-- <?php //if (!empty($discountPrice) && $discountPrice < $price) : ?>
        <div class="flex items-center gap-2">
          <span class="text-red-500 ml-2 new-price" style="font-weight:700;font-size:14px">
            <? //number_format($discountPrice, 0, ",", ".") ?><small><u>đ</u></small>
          </span>
        </div>
        <span class="text-gray-400 line-through opacity-70 old-price" style="color:#ccc;font-size:12px">
          <?php //number_format($price, 0, ",", ".") ?><small><u>đ</u></small>
        </span>

        <?php //else : ?>
        <?php //number_format($price, 0, ",", ".") ?> <small><u>đ</u></small>
        <?php //endif; ?> -->

        <!-- Giá hiển thị -->
        <span id="footer-total-price" class="text-red-500 ml-2 new-price" style="font-weight:700;font-size:14px">
          <?= number_format($basePrice, 0, ",", ".") ?><small><u>đ</u></small>
        </span>

        <!-- Giá gốc nếu có giảm giá -->
        <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
        <span class="text-gray-400 line-through opacity-70 old-price" style="color:#ccc;font-size:12px">
          <?= number_format($price, 0, ",", ".") ?><small><u>đ</u></small>
        </span>
        <?php endif; ?>

      </div>
    </div>
    <div style="display:flex;align-items:center;gap:12px;justify-content:space-between;padding-bottom:20px">
      <div class="col-span-1">
        <a href="tel:<?= get_field('header_phone', 'option') ?>" target="_blank"
          style="gap:2px;justify-content: center;display:flex;align-items:center;flex-direction: column;">
          <img class="w-5 h-5" src="<?= get_theme_file_uri('assets/images/icons/call-incoming.svg') ?>" />
          <div style="font-size:12px">Hotline</div>
        </a>
      </div>
      <div class="col-span-1">
        <!-- <a href="<?//= get_permalink(get_field('page_doctor', 'option')) ?>" class="consultant-zalo-bottom-v1"> -->
        <a href="https://liavietnam.vn/danh-sach-chuyen-vien/" class="consultant-zalo-bottom-v1">
          <div class="border-zalo-bottom">
            <div class="text-find-doctor">Tìm chuyên viên</div>
          </div>
          <div style="font-size:10px">Tư vấn 1-1</div>
        </a>
      </div>
      <div class="col-span-1">
        <button id="booking" class="consultant-zalo-bottom-v2">
          <div style="font-weight:700">Đặt lịch ngay</div>
          <div style="font-size:10px" class="discount-text">Tiết kiệm : <?= $discountPercentage ?>%</div>
        </button>
      </div>
    </div>
  </div>

</div>