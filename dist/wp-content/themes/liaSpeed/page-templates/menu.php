<?php 
/**
 * Template name: Menu
 */
?>
<?php get_header("empty"); ?>
<?php
	$fields = get_fields();
?>

<style>
/* .menu {
  background: #fff;
}

.submenu {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-in-out;
}

.menu-item.active .submenu {
  max-height: 500px;
}

.material-icons {
  transition: transform 0.3s ease-in-out;
}

.menu-item.active .material-icons {
  transform: rotate(180deg);
}

h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.menu-list {
  list-style: none;
}

.menu-list li {
  border-bottom: 1px solid #eee;
}

.menu-list li:last-child {
  border-bottom: none;
}

.menu-list li a {
  text-decoration: none;
  display: flex;
  justify-content: space-between;
  padding: 4px 12px;
  color: #333;
  font-size: 14px;
  cursor: pointer;
}

.menu-header {
  text-decoration: none;
  display: flex;
  justify-content: space-between;
  padding: 6px 12px;
  color: #333;
  font-size: 14px;
  cursor: pointer;
}
.menu-header i {
  transition: transform 0.3s ease;
}

.submenu li {
  padding: 4px 10px;
  font-size: 13px;
}
.contact {
  margin-top: 20px;
  font-size: 13px;
}
.contact h4 {
  font-size: 14px;
  margin-top: 15px;
}
.section-menu {
  padding: 12px;
  width: 100%;
}
.back-button {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 24px;
  color: #333;
}
.back-button:hover {
  color: #007bff;
} */
</style>

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
          <li><a href="#">Giới thiệu về công ty</a></li>
          <li><a href="#">Tầm nhìn & sứ mệnh</a></li>
          <li><a href="#">Lịch sử</a></li>
        </ul>
      </li>

      <li class="menu-item">
        <div class="menu-header">Dịch vụ <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li>

      <li class="menu-item">
        <div class="menu-header">Nhượng quyền <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li>

      <li class="menu-item">
        <div class="menu-header">Tin tức & sự kiện <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li>

      <li class="menu-item">
        <div class="menu-header">Tuyển dụng <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li>

      <li class="menu-item">
        <div class="menu-header">Hỗ trợ <span class="material-icons">expand_more</span></div>
        <ul class="submenu"></ul>
      </li>
    </ul>

    <div class="contact">
      <h4>Chăm sóc khách hàng</h4>
      <p>Hotline: 0934129060</p>
      <p>Email: cskh.liavietnam@gmail.com</p>

      <h4>Hợp tác nhượng quyền</h4>
      <p>Hotline: 0374466666</p>
      <p>Email: dautu.liavietnam@gmail.com</p>
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