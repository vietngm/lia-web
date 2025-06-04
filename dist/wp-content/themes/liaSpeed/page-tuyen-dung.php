<?php get_header(); ?>

<head>
  <link href="style.css" rel="stylesheet" />
</head>
<?php
  $recruitment_id = get_the_ID();
	$recruitment_fields = get_fields($recruitment_id);
	
  $key_visual = $recruitment_fields['td_key_visual'];
  
  $location = $recruitment_fields['khu_vuc'];
  $experience = $recruitment_fields['kinh_nghiem'];
  $salary = $recruitment_fields['thu_nhap_mong_muon'];
  $slungvien = $recruitment_fields['gt_slcv'];
  
  // Gioi thieu
  $gt_tdc = $recruitment_fields['tdc_gt'];
  $gt_tdp = $recruitment_fields['tdp_gt'];
  $gt_soluoc = $recruitment_fields['gioi_thieu_so_luoc'];
  $gt_ndc = $recruitment_fields['noi_dung_chinh'];

  // Yeu cau cong viec
  $yccv_tdc = $recruitment_fields['tdc_yccv'];
  $yccv_tdp = $recruitment_fields['tdp_yccv'];
  $yccv_title = $recruitment_fields['tdcv_yccv'];
  $yccv_group = $recruitment_fields['yeu_cau'];
  $yccv_group_2 = $recruitment_fields['ho_so_chuan_bi'];

  // Quyen loi
  $ql_tdc = $recruitment_fields['title'];
  $ql_tdp = $recruitment_fields['sub_title'];
  $ql_mtn = $recruitment_fields['muc_thu_nhap'];
  $ql_month = $recruitment_fields['so_thang'];
  $ql_noidung = $recruitment_fields['noi_dung'];

  // Lo trinh
  $lt_tdc = $recruitment_fields['td_lt'];
  $lt_thumb = $recruitment_fields['hmhlt'];

  // Van hoa
  $vanhoa_tdc = $recruitment_fields['tdc_vh'];
  $vanhoa_tdp = $recruitment_fields['tdp_vh'];
  $vanhoa_noidung = $recruitment_fields['nd_vh'];

?>
<main class="is-recruitment">
  <div>
    <?php foreach ($key_visual as $item) { ?>
    <li><?=$item['url']?></li>
    <?php } ?>
  </div>
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
      <!-- <div class="recruitment-content">
        <div classs="recruitment-description"> -->
      <?//= the_content(); ?>
      <!-- </div>
      </div> -->

      <div class="recruitment">
        <div class="recruitment-content">
          <div>TUYÊN DUNG</div>
          <div>300 + CHUYÊN VIÊN SPA</div>
          <ul class="block1">
            <?php foreach ($gt_ndc as $item) { ?>
            <li class="item frame-value">
              <div class="tdc"><?=$item['td_ndc']?></div>
              <div class="ndp"><?=$item['nd_ndp']?></div>
              <div class="ndc"><?=$item['nd_ndc']?></div>
            </li>
            <?php } ?>
          </ul>
          <div class="heading">
            <div class="heading-main"><?php echo $gt_tdc; ?></div>
            <div class="heading-sub"><?php echo $gt_tdp; ?></div>
          </div>
          <?=$gt_soluoc;?>

          <a href="#" class="contact-now" title="ỨNG TUYỂN NGAY">
            <span>ỨNG TUYỂN NGAY</span>
            <span class="arrow-shake">→</span>
          </a>

        </div>

        <div class="recruitment-content background mt">
          <div class="heading">
            <div class="heading-main"><?php echo $yccv_tdc; ?></div>
            <div class="heading-sub"><?php echo $yccv_tdp; ?></div>
          </div>

          <div class="border">
            <div class="heading-underline"><?=$yccv_title;?></div>
            <div class="block2">
              <div class="block2-heading"><?php echo $yccv_group['tieu_de'];?></div>
              <ul class="block2 block-list">
                <?php foreach ($yccv_group['noi_dung'] as $item1) { ?>
                <li><span>•</span><span><?=$item1['text'];?></span></li>
                <?php } ?>
              </ul>
            </div>
            <div class="block2">
              <div class="block2-heading"><?php echo $yccv_group_2['title'];?></div>
              <ul class="block2 block-list">
                <?php foreach ($yccv_group_2['noi_dung'] as $item) { ?>
                <li><span>•</span><span><?=$item['text']?></span></li>
                <?php } ?>
              </ul>
            </div>
          </div>

          <div class="border">
            <div class="heading-underline"><?php echo $ql_tdc; ?></div>
            <div class="target">
              <div class="target-heading"><?php echo $ql_tdp; ?></div>
              <div class="target-money">
                <div class="value"><?=$ql_mtn?></div>
                <div class="name">/ tháng</div>
              </div>
              <div class="target-month">Sau <?=$ql_month?> tháng</div>
            </div>

            <ul class="block3 block-list">
              <?php foreach ($ql_noidung as $item) { ?>
              <li><span>•</span><span><?=$item['text_mt']?></span></li>
              <?php } ?>
            </ul>
          </div>
        </div>

        <div class="recruitment-content">
          <div class="way-thumb">
            <img src="<?php echo $lt_thumb['url'];?>" />
          </div>
          <div class="way-heading"><?php echo $lt_tdc; ?></div>
          <a href="#" class="contact-now" title="ỨNG TUYỂN NGAY">
            <span>ỨNG TUYỂN NGAY</span>
            <span class="arrow-shake">→</span>
          </a>
        </div>

        <div class="recruitment-content mt">
          <div class="heading">
            <div class="heading-main"><?php echo $vanhoa_tdc; ?></div>
            <div class="heading-sub"><?php echo $vanhoa_tdp; ?></div>
          </div>
          <ul class="culture culture-list">
            <?php foreach ($vanhoa_noidung as $item) { ?>
            <li class="culture-item">
              <div class="culture-icon"><img src="<?=$item['icon_vh']['url']?>" /></div>
              <div class="culture-title"><?=$item['td_vh']?></div>
              <div class="culture-desc"><?=$item['mt_vh']?></div>
            </li>
            <?php } ?>
          </ul>
        </div>

        <div class="recruitment-contact mt">
          <div class="contact-header">
            <div class="header-sub">FORM ĐĂNG KÝ</div>
            <div class="header-main">ỨNG TUYỂN CHUYÊN VIÊN SPA</div>
          </div>
          <div id="register-recruitment">
            <?= wp_nonce_field( 'recruitment_form' ); ?>
            <div class="content-editor recruitment-form">
              <div class="form-group">
                <label class="form-label" for="name">Họ tên</label>
                <input type="text" id="name" name="fullname" class="form-input" placeholder="Nhập họ tên của bạn"
                  required>
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
                <span class="arrow-shake">→</span>
              </button>

            </div>

          </div>
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