<?php get_header(); ?>

<head>
  <link href="style.css" rel="stylesheet" />
</head>

<style>
:root {
  --primary-color: #1A5477;
  --accent-color: #94C347;
  --text-dark: #333;
  --text-medium: #2C2F40;
  --text-light: #888;
  --border-color: #E0E0E0;
  --background-light: #1b54780f;
  --background-mint: rgba(148, 195, 71, 0.1);
}

.dropdown-icon {
  margin-left: 5px;
  width: 16px;
  height: 16px;
}

.recruitment-dropdown {
  position: relative;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  padding: 8px 12px;
  background: white;
  cursor: pointer;
  transition: all 0.3s ease;
}

.recruitment-dropdown.active {
  border-color: var(--primary-color);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.selected-option {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 14px;
  color: var(--text-dark);
}

.selected-option::after {
  content: '▼';
  font-size: 10px;
  color: var(--text-light);
  transition: transform 0.3s ease;
}

.recruitment-dropdown.active .selected-option::after {
  transform: rotate(180deg);
}

.dropdown-options {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  margin-top: 4px;
  background: white;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  z-index: 100;
  display: none;
}

.dropdown-option {
  padding: 10px 12px;
  font-size: 14px;
  color: var(--text-dark);
  transition: all 0.2s ease;
}

.dropdown-option:hover {
  background-color: var(--background-light);
}

.dropdown-option.selected {
  background-color: var(--background-light);
  color: var(--primary-color);
  font-weight: 600;
}

.dropdown-option:first-child {
  border-radius: 8px 8px 0 0;
}

.dropdown-option:last-child {
  border-radius: 0 0 8px 8px;
}


/* Additional styles for dropdowns */
.recruitment-dropdown {
  position: relative;
  cursor: pointer;
}

.dropdown-options {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background-color: white;
  border: 1px solid var(--border-color);
  border-radius: 5px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 10;
  margin-top: 5px;
}

.dropdown-option {
  padding: 8px 10px;
  border-bottom: 1px solid var(--border-color);
  font-size: 12px;
}

.dropdown-option:last-child {
  border-bottom: none;
}

.dropdown-option:hover {
  background-color: var(--background-light);
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  overflow-y: auto;
}

.modal-content {
  background-color: #fff;
  margin: 15px auto;
  width: 90%;
  max-width: 500px;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  animation: modalFadeIn 0.3s;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-header {
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid var(--border-color);
}

.modal-header h2 {
  font-size: 18px;
  color: var(--primary-color);
  margin: 0;
}

.close-modal {
  font-size: 24px;
  font-weight: bold;
  color: var(--text-light);
  cursor: pointer;
}

.modal-body {
  padding: 20px;
}

/* Form Styles */
.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-size: 14px;
  color: var(--text-medium);
  margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  font-size: 14px;
}

.submit-button,
.confirm-deposit {
  background-color: var(--accent-color);
  color: white;
  border: none;
  border-radius: 8px;
  padding: 12px 20px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  width: 100%;
  margin-top: 10px;
}
</style>
<?php
$recruitment_id = get_the_ID();
	$recruitment_fields = get_fields($recruitment_id);
	// $thumbnail_url = get_the_post_thumbnail_url($recruitment_id, 'full');
	$location = $recruitment_fields['khu_vuc'];
  $experience = $recruitment_fields['kinh_nghiem'];
  $salary = $recruitment_fields['thu_nhap_mong_muon'];
  $slungvien = $recruitment_fields['gt_slcv'];
  $gt_tdc = $recruitment_fields['tdc_gt'];
  $gt_tdp = $recruitment_fields['tdp_gt'];
  $gt_soluoc = $recruitment_fields['gioi_thieu_so_luoc'];
  $gt_ndc = $recruitment_fields['noi_dung_chinh'];

  $yccv_tdc = $recruitment_fields['tdc_yccv'];
  $yccv_tdp = $recruitment_fields['tdp_yccv'];
  $yccv_title = $recruitment_fields['tdcv_yccv'];
  $yccv_group = $recruitment_fields['yeu_cau'];
  $yccv_group_2 = $recruitment_fields['ho_so_chuan_bi'];


  $ql_tdc = $recruitment_fields['title'];
  $ql_tdp = $recruitment_fields['sub_title'];
  $ql_mtn = $recruitment_fields['muc_thu_nhap'];
  $ql_month = $recruitment_fields['so_thang'];
  $ql_noidung = $recruitment_fields['noi_dung'];

?>
<main class="is-recruitment">
  <section class="section-booking-banner w-full h-[200px] relative px-4 flex items-center justify-center">
    <?php $image = get_the_post_thumbnail_url( ) ?>
    <?php if ($image) : ?>
    <img class="w-full h-full object-cover object-center absolute" src="<?= $image ?>" />
    <?php endif; ?>
    <div class="w-full h-full absolute bg-black bg-opacity-50"></div>
    <h1 class="relative z-20 text-white text-24 text-center font-bold uppercase"><?= get_the_title(); ?></h1>
  </section>
  <section class="section section-blog">
    <div class="container pb-4">
      <div class="flex gap-2 flex-wrap mb-8">
        <a class="text-primary font-semibold" href="/">Trang chủ</a>
        <span>›</span>
        <a class="" href="<?= the_permalink() ?>"><?= get_the_title(); ?></a>
      </div>
      <div class="recruitment-content">
        <div classs="recruitment-description">
          <?= the_content(); ?>
        </div>
        <div class="recruitment-heading">
          FORM ĐĂNG KÝ<br>
          ỨNG TUYỂN CHUYÊN VIÊN SPA<br>
        </div>
      </div>

      ------

      <div class="recruitment-content">
        <div class="heading-main"><?php echo $gt_tdc; ?></div>
        <div class="heading-sub"><?php echo $gt_tdp; ?></div>
        <p><?=$gt_soluoc;?></p>
        <ul class="about">
          <?php foreach ($gt_ndc as $item) { ?>
          <li><?=$item['td_ndc']?></li>
          <li><?=$item['nd_ndp']?></li>
          <li><?=$item['nd_ndc']?></li>
          <?php } ?>
        </ul>
      </div>

      ------

      <div class="recruitment-content">
        <div class="heading-main"><?php echo $yccv_tdc; ?></div>
        <div class="heading-sub"><?php echo $yccv_tdp; ?></div>
        <p><?=$yccv_title;?></p>
        ------
        <ul class="about">
          <?php echo $yccv_group['tieu_de'];?>
          <?php foreach ($yccv_group['noi_dung'] as $item1) { ?>
          <li><?=$item1['text'];?></li>
          <?php } ?>
        </ul>
        ------
        <ul class="about">
          <?php echo $yccv_group_2['title'];?>
          <?php foreach ($yccv_group_2['noi_dung'] as $item) { ?>
          <li><?=$item['text']?></li>
          <?php } ?>
        </ul>
      </div>

      ------

      <div class="recruitment-content">
        <div class="heading-main"><?php echo $ql_tdc; ?></div>
        <div class="heading-sub"><?php echo $ql_tdp; ?></div>
        <div><?=$ql_mtn?></div>
        <div><?=$ql_month?></div>

        <ul class="about">
          <?php foreach ($ql_noidung as $item) { ?>
          <li><?=$item['text_mt']?></li>
          <?php } ?>
        </ul>
      </div>

      ------

      <div id="register-recruitment">
        <?= wp_nonce_field( 'recruitment_form' ); ?>
        <div class="content-editor recruitment-form">
          <div class="form-group">
            <label class="form-label" for="name">Họ tên</label>
            <input type="text" id="name" name="fullname" class="form-input" placeholder="Nhập họ tên của bạn" required>
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
            <input type="hidden" name="location" value="">
            <label class="form-label" for="phone">Lựa chọn nơi làm việc trong tương lai</label>
            <div class="recruitment-dropdown" id="location">
              <span class="selected-option">Vui lòng chọn</span>
              <div class="dropdown-options">
                <?php 
    if ($location) {
      foreach ($location as $item) {
        echo '<div class="dropdown-option" data-value="' . esc_attr($item['ten_kv']) . '">' . esc_html($item['ten_kv']) . '</div>';
      }
    }
    ?>
              </div>
            </div>
            <div class="has-error error-location"></div>
          </div>

          <div class="form-group">
            <input type="hidden" name="experience" value="">
            <label class="form-label" for="phone">Bạn đã có kinh nghiệm nghề chưa?</label>
            <div class="recruitment-dropdown" id="experience">
              <span class="selected-option">Vui lòng chọn</span>
              <div class="dropdown-options">
                <?php 
    if ($experience) {
      foreach ($experience as $item) {
        echo '<div class="dropdown-option" data-value="' . esc_attr($item['noi_dung']) . '">' . esc_html($item['noi_dung']) . '</div>';
      }
    }
    ?>
              </div>
            </div>
            <div class="has-error error-experience"></div>
          </div>


          <div class="form-group">
            <input type="hidden" name="salary" value="">
            <label class="form-label" for="phone">Thu nhập mong muốn mỗi tháng</label>
            <div class="recruitment-dropdown" id="salary">
              <span class="selected-option">Vui lòng chọn</span>
              <div class="dropdown-options">
                <?php 
    if ($salary) {
      foreach ($salary as $item) {
        echo '<div class="dropdown-option" data-value="' . esc_attr($item['tu_den_vnd']) . '">' . esc_html($item['tu_den_vnd']) . '</div>';
      }
    }
    ?>
              </div>
            </div>
            <div class="has-error error-salary"></div>
          </div>

          <button type="button" class="button1 js-recruitment" title="ĐĂNG KÝ ỨNG TUYỂN NGAY">
            <span>ĐĂNG KÝ ỨNG TUYỂN NGAY</span>
          </button>

        </div>
      </div>
    </div>
  </section>

  <!-- Modal for Registration -->
  <div id="registration-modal" class="modal modal-recruitment-success">
    <?php include get_template_directory() . "/template-parts/modal-recruitment-success.php"; ?>
  </div>
</main>

<?php get_footer(); ?>