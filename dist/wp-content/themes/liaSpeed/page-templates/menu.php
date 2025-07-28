<?php 
/**
 * Template name: Menu
 */
?>
<?php get_header("empty"); ?>
<?php
	$fields = get_fields('option');
  $menus = $fields['header'];
  $contactInfo = $menus['menu_cskh'];
  $nqInfo = $menus['menu_htnq'];
  $thongTinDauTu = $menus['menu_nq'];
  $vechungtoi = $menus['menu_ve_chung_toi'];
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<section class="section-menu">
  <div class="menu">
    <div class="menu-header">
      <button class="back-button">
        <span class="material-icons">arrow_back</span>
      </button>
      <h3>Menu</h3>
    </div>

    <ul class="menu-list">

      <li class="menu-item">
        <div class="menu-header">
          Về chúng tôi
          <span class="material-icons">expand_more</span>
        </div>

        <ul class="submenu">
          <!-- <li><a href="#">Giới thiệu về công ty</a></li>
          <li><a href="#">Tầm nhìn & sứ mệnh</a></li>
          <li><a href="#">Lịch sử</a></li> -->
          <?php
					$items = $vechungtoi['items'];
					foreach($items as $item) {
						$link = $item['link'];
						echo '<li class="submenu-item"><a href="'.$link['url'].'" class="submenu-link">'.$link['title'].'</a></li>';
					}
					?>
        </ul>
      </li>

      <!-- <li class="menu-item">
        <div class="menu-header">Dịch vụ <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li> -->

      <li class="menu-item">
        <div class="menu-header">Nhượng quyền <span class="material-icons">expand_more</span></div>
        <ul class="submenu">
          <?php
					$items = $thongTinDauTu['items'];
					foreach($items as $item) {
						$link = $item['link'];
						echo '<li class="submenu-item"><a href="'.$link['url'].'" class="submenu-link">'.$link['title'].'</a></li>';
					}
					?>
        </ul>
      </li>

      <li class="menu-item">
        <a href="<?=get_permalink(get_page_by_path('tin-tuc'))?>" class="menu-header">Tin tức & sự kiện <span
            class="material-icons">navigate_next</span></a>
        <!-- <ul class="submenu"></ul> -->
      </li>

      <li class="menu-item">
        <a href="<?=get_permalink(get_page_by_path('tuyen-dung'))?>" class="menu-header">Thông tin tuyển dụng
          <span class="material-icons">navigate_next</span>
        </a>
      </li>

      <!-- <li class="menu-item">
        <div class="menu-header">Hỗ trợ <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li> -->
    </ul>

    <div class="menu-contact">
      <div class="menu-contact-item">
        <h4>Chăm sóc khách hàng</h4>
        <p>Hotline: <a href="tel:<?=$contactInfo['dt_cskh']?>"><?=$contactInfo['dt_cskh']?></a></p>
        <p>Email: <?=$contactInfo['email_cskh']?></p>
      </div>
      <div class="menu-contact-item">
        <h4>Hợp tác nhượng quyền</h4>
        <p>Hotline: <a href="tel:<?=$nqInfo['dt_cskh']?>"><?=$nqInfo['dt_cskh']?></a></p>
        <p>Email: <?=$nqInfo['email_cskh']?></p>
      </div>
    </div>
  </div>

</section>
<footer>

</footer>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const menuItems = document.querySelectorAll(".menu-item");

  menuItems.forEach(item => {
    const header = item.querySelector(".menu-header");
    const submenu = item.querySelector(".submenu");
    const icon = header.querySelector(".material-icons");

    header.addEventListener("click", function() {
      const isActive = item.classList.contains("active");

      if (isActive) {
        submenu.style.maxHeight = "0px";
      } else {
        submenu.style.maxHeight = submenu.scrollHeight + "px"; // Lấy chiều cao thực tế của submenu
      }

      item.classList.toggle("active"); // Thêm/xóa class 'active'
    });
  });
});

document.querySelector(".back-button").addEventListener("click", function() {
  window.history.back(); // Quay lại trang trước
});
</script>