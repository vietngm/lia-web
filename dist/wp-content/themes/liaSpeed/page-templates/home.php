<?php 
/**
 * Template name: Trang chủ
 */
?>

<?php get_header();?>

<?php
	$fields = get_fields();
?>
<style>
.section-home-contact {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: space-between;


}

.contact-options {
  display: flex;
  justify-content: space-between;
  width: 100%;
  border: 1px solid #ccc;
  position: relative;
  top: -131px;
  background: #FFF;
  border-radius: 12px;
  padding: 20px;
}

.contact-item {
  width: 30%;
  display: flex;
  gap: 16px;
  text-align: left;
}

.icon {
  margin-bottom: 10px;
}


h2 {
  font-size: 1.2em;
  margin: 0px 0px 6px;
}

p {
  font-size: 0.9em;
  color: #555;
}

.dashed {
  width: 1px;
  background: #ccc;
}

.slick-slide img {
  margin: 0 auto;
}

@keyframes slideOverlay {
  0% {
    left: -100%;
    /* Bắt đầu từ ngoài bên trái */
  }

  100% {
    left: 100%;
    /* Trượt hết sang bên phải */
  }
}

.view-more {
  position: relative;
  color: #8f8f8f;
  font-size: 12px;
  cursor: pointer;
  overflow: hidden;
  display: inline-block;
  padding: 4px 10px;
  border: 1px solid #ccc;
}

.view-more::after {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(173, 216, 230, 0), rgba(173, 216, 230, 0.48), rgba(173, 216, 230, 0));
  animation: slideOverlay 3s linear infinite;
}

.section-title {
  color: #1A5477;
}

.home-description-why {
  width: 270px;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 16px;
  -webkit-line-clamp: 2;
  height: 32px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  margin-top: 6px;
  font-weight: 300;
}

.content-why-choose h3 {
  font-weight: 700;
}

.content-why-choose {
  margin-top: 4px;
}

.dot-why {
  border: 1px solid;
  width: 3px;
  height: 3px;
  border-radius: 100%;
  background: #000;
}

.content-why-choose h4 {
  font-weight: 400;
  font-size: 12px;
}

/* Franchise Navigation */
.franchise-nav {
  display: flex;
  justify-content: space-between;
  padding: 1rem 2rem;
  background: white;
  border-radius: 16px 16px 0 0;
  box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
  position: relative;
  z-index: 1;
  max-width: 1200px;
  margin: 0 auto;
}

.franchise-nav-item {
  font-size: 18px;
  color: #2B6CAD;
  text-decoration: none;
  padding: 0.5rem 0;
  position: relative;
  font-weight: 500;
  cursor: pointer;
  transition: color 0.3s ease;
}

.franchise-nav-item.active {
  font-weight: 700;
  color: #0D5293;
}

.franchise-nav-item.active:after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 100%;
  height: 3px;
  background: #0D5293;
  border-radius: 3px 3px 0 0;
}

/* Franchise Slider */
.franchise-slider {
  background: #fff;
  position: relative;
  max-width: 1200px;
}

.slide-content {
  text-align: center;
}

.franchise-title {
  font-size: 26px;
  font-weight: 900;
  margin-bottom: 4px;
  color: #000;
}

.franchise-subtitle {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 6px;
  color: #333;
}

.franchise-stats {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0rem;
  margin-bottom: 2rem;
  font-size: 16px;
  color: #333;
}

.stat-dot {
  color: #999;
  margin: 0 0.5rem;
}

.franchise-image {
  position: relative;
  max-width: 900px;
  margin: 0 auto 2rem;
  overflow: hidden;
}

.franchise-image img {
  width: 100%;
  height: auto;
  display: block;
}

.navigation-arrows {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  padding: 0 1rem;
  pointer-events: none;
}

.nav-arrow {
  width: 24px;
  height: 24px;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  pointer-events: auto;
  transition: background 0.3s ease;
}

.nav-arrow:hover {
  background: rgba(255, 255, 255, 1);
}


.arrow-icon {
  width: 12px;
  height: 20px;
  stroke: #333;
  stroke-width: 3px;
}

.franchise-cta {
  display: flex;
  justify-content: center;
  gap: 1rem;
  position: absolute;
  z-index: 1;
  bottom: 28px;
  left: 0;
  right: 0;
}

.franchise-btn {
  padding: 4px 12px;
  border-radius: 5px;
  font-size: 13px;
  font-weight: 500;
  text-decoration: none;
  border: 1px solid #CACACA;
  #ddd;
  background: rgba(255, 255, 255, 0.9);
  color: #333;
  backdrop-filter: blur(5px);
  transition: all 0.3s ease;
  cursor: pointer;
}

.franchise-btn.tv {
  background: transparent;
  color: #FFFF;

}

.franchise-btn.details {}

.franchise-btn:hover {
  background: rgba(255, 255, 255, 1);
  border-color: #bbb;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

/* Franchise Tab Content */
.franchise-tab-content {
  display: none;
}

.franchise-tab-content.active {
  display: block;
}

/* Franchise Slides */
.franchise-slides {
  position: relative;
}

.franchise-slide {
  display: none;
}

.franchise-slide.active {
  display: block;
}

/* Modal Styles */
.franchise-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}

.franchise-modal.active {
  opacity: 1;
  visibility: visible;
}

.modal-content {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  max-width: 500px;
  width: 90%;
  position: relative;
  transform: translateY(20px);
  transition: transform 0.3s ease;
}

.franchise-modal.active .modal-content {
  transform: translateY(0);
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  border-radius: 50%;
  background: #f5f5f5;
}

.modal-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 1rem;
}

.modal-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  font-size: 14px;
  font-weight: 500;
}

.form-input {
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 16px;
}

.form-submit {
  padding: 0.75rem;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  margin-top: 1rem;
}

.custom-prev,
.custom-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  cursor: pointer;
  border-radius: 100%;
  height: 30px;
  width: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  background-color: rgb(255 255 255 / 30%);
  color: #000000;
  opacity: 0.5;
  transition: opacity 0.3s ease-in-out, background-color 0.3s;
  border: 1px solid #D9D9D9;
}

.custom-prev {
  left: 16px;
}

.custom-next {
  right: 16px;
}

/* Khi hover hoặc focus vào nút thì rõ lên */
.custom-prev:hover,
.custom-next:hover,
.custom-prev:focus,
.custom-next:focus {
  opacity: 1;
  /* Hiển thị rõ */
  background-color: #00000021;
  /* Màu nền đậm hơn */
}

.slick-dots {
  position: absolute;
  bottom: 20px;
  display: block;
  width: 100%;
  padding: 0;
  margin: 0;
  list-style: none;
  text-align: center;
}

.slide-content {
  text-align: center;
  border: 1px solid #eee;
  margin: 8px;
  border-radius: 8px;
  padding: 12px;
}
</style>

<main>
  <section class="section-home-banner" style="position:relative">
    <div class="home-banner mount-slider ">
      <?php foreach ($fields["banner"]["images"] as $image) : ?>
      <?php if ($image["url"]) : ?>
      <a href="<?= $image["url"] ?>">
        <img class="w-full" style="height:auto"
          src="<?= bfi_thumb($image["image"] , array("width"=>1440,'crop'=>false)) ?>" />
      </a>
      <?php else : ?>
      <div>
        <img class="w-full" style="height:auto"
          src="<?= bfi_thumb($image["image"] , array("width"=>1440, 'crop'=>false)) ?>" />
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>

  </section>
  <section class="section section-home-about">
    <div class="container">
      <h1 class="section-title"><?= $fields["banner"]["title"] ?></h1>
      <div class="content-editor">
        <?= $fields["banner"]["description"] ?>
      </div>
      <?php if ($fields["banner"]["viewmore"] != null) : ?>
      <a class="btn-outline mt-2 view-more" target="<?= $fields["banner"]["viewmore"]["target"] ?>"
        href="<?= $fields["banner"]["viewmore"]["url"] ?>">
        <?= $fields["banner"]["viewmore"]["title"] ?>
        ->
      </a>
      <?php endif; ?>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <h2 class="section-title"><?= $fields["service"]["title"] ?></h2>
      <?php get_template_part( 'template-parts/service', 'list', array("max_items" => -1) ); ?>
    </div>
  </section>


  <!-- Add the detailed franchise section that matches the image -->
  <div class="franchise-container mt-8">
    <h1 class="section-title" style="padding-left: 16px;"><?= $fields["franchise"]["title"] ?></h1>
    <?php get_template_part( 'template-parts/franchise', 'summary', array("franchise" => $fields["franchise"]["highlight_nhuong_quyen"]) ); ?>
  </div>


  <!-- Registration Modal -->
  <div class="franchise-modal" id="register-modal">
    <?= wp_nonce_field( 'consultation_form' ); ?>
    <div class="modal-content">
      <div class="modal-close" id="close-register-modal">✕</div>
      <h2 class="modal-title">Đăng ký tư vấn</h2>
      <!-- <form class="modal-form" id="register-form"> -->
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label" for="name">Họ tên</label>
          <input type="text" id="name" name="name" class="form-input" placeholder="Nhập họ tên của bạn" required>
          <div class="has-error error-fullname"></div>
        </div>
        <div class="form-group">
          <label class="form-label" for="phone">Số điện thoại</label>
          <input type="tel" id="phone" name="phone" class="form-input" placeholder="Nhập số điện thoại của bạn"
            required>
          <div class="has-error error-phone"></div>
        </div>
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input type="email" id="email" name="email" class="form-input" placeholder="Nhập email của bạn">
          <div class="has-error error-email"></div>
        </div>

        <div class="form-group">
          <label for="message">Nội dung</label>
          <textarea id="message" name="message" class="form-input" rows="4"
            placeholder="Nhập yêu cầu tư vấn của bạn"></textarea>
        </div>
      </div>

      <button type="button" class="form-submit js-home-consultation">Gửi thông tin</button>
      <!-- </form> -->
    </div>
  </div>


  <section class="section">
    <div class="container">
      <h2 class="section-title mb-4">
        <h1 class="section-title"><?= $fields["feature"]["title"] ?></h1>
      </h2>
      <div class=" flex gap-2 mb-2 flex-wrap">
        <?php foreach ( $fields["feature"]["items"] as $item ): ?>
        <a href="<?= $fields["feature"]["viewmore"]["url"] ?>" style="width:175px"
          class="overflow-hidden w-[175px] flex-2 flex-shrink-0 rounded-2 flex flex-col">
          <img class="w-full block aspect-square" src="<?= $item["image"] ?>" />
          <div class="pt-2 pb-3 flex-1">
            <p class="text-12 line-clamp-2"><?= $item["description"] ?></p>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <h2 class="section-title mb-4">
        <h1 class="section-title"><?= $fields["other"]["title"] ?></h1>
      </h2>
      <div class=" flex gap-2 mb-2 flex-wrap">
        <?php foreach ( $fields["other"]["items"] as $item ): ?>
        <a style="width:175px" class="overflow-hidden w-[175px] flex-2 flex-shrink-0 rounded-2 flex flex-col">
          <img class="w-full block aspect-square" src="<?= $item["image"] ?>" />
          <div class="pt-2 pb-3 flex-1">
            <p class="text-12 line-clamp-2"><?= $item["description"] ?></p>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<script>
jQuery(document).ready(function($) {

  // Registration modal
  $('.franchise-btn[id^="register-btn"]').on('click', function() {
    $('#register-modal').addClass('active');
  });

  $('#close-register-modal').on('click', function() {
    $('#register-modal').removeClass('active');
  });

  // Details modal
  $('.franchise-btn[id^="details-btn"]').on('click', function() {
    // Update details based on current tab
    var currentTab = $('.franchise-nav-item.active').data('tab');
    $('#details-title').text('Chi tiết LiA ' + currentTab.charAt(0).toUpperCase() + currentTab.slice(1));

    $('#details-modal').addClass('active');
  });

  $('#close-details-modal').on('click', function() {
    $('#details-modal').removeClass('active');
  });

  // Close modals when clicking outside
  $('.franchise-modal').on('click', function(e) {
    if ($(e.target).hasClass('franchise-modal')) {
      $(this).removeClass('active');
    }
  });

  // Handle form submission
  $('#register-form').on('submit', function(e) {
    e.preventDefault();

    // You can add AJAX form submission here
    alert('Cảm ơn bạn đã đăng ký tư vấn. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất!');

    // Reset form and close modal
    this.reset();
    $('#register-modal').removeClass('active');
  });

  // Download brochure
  $('#download-brochure').on('click', function() {
    alert('Brochure đang được chuẩn bị để tải xuống!');
  });
});
</script>

<?php get_footer(); ?>