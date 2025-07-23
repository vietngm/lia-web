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
<div class="h-[80px] flex items-center border-t-1 border-[#ccc] fixed bottom-0 left-0 right-0 bg-white bottom-action"
  style="border-top:1px solid #eee; z-index:10">
  <div class="container">
    <div style="display:flex;align-items:center;gap:12px;justify-content:space-between">
      <div class="col-span-1">
        <a href="tel:<?= get_field("header_phone", "option") ?>" target="_blank"
          style="gap:2px;justify-content: center;display:flex;align-items:center;flex-direction: column;">
          <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/call-incoming.svg") ?>" />
          <div style="font-size:12px">Hotline</div>
        </a>
      </div>
      <div class="col-span-1">
        <a href="<?= get_permalink(get_field("page_doctor", "option")) ?>" class="consultant-zalo-bottom">
          <div class="border-zalo-bottom">
            <!-- <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/zalo-2.png") ?>" /> -->
            <div style="font-weight:700">Tìm chuyên viên</div>
          </div>
          <div style="font-size:10px">Tư vấn 1-1</div>
        </a>
      </div>
      <div class="col-span-1">
        <a href="<?= get_permalink(get_field("page_booking", "option")) ?>" target="_blank"
          class="consultant-zalo-bottom">
          <div style="font-weight:700">Đặt lịch ngay</div>
          <div style="font-size:10px">Phí khám 0đ</div>
        </a>
      </div>

    </div>
  </div>
</div>