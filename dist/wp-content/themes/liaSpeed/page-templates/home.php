<?php 
/**
 * Template name: Trang chủ
 */
?>

<?php get_header();?>

<?php
	$fields = get_fields();
?>

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

  <section class="section">
    <div class="container">
      <h2 class="section-title">Sản phẩm</h2>
      <ul class="product-category">
        <?php
          $taxonomy = 'product-category';
          $terms = get_terms(
            $taxonomy, array(
              'hide_empty' => 0,
              'parent' => 0,
              'orderby' => 'menu_order',
              'order' => 'ASC',
            )
          );
        foreach($terms as $term){
          $args = array(
            "orderby" => "slug",
            'hide_empty'    => false, 
            'hierarchical'  => true, 
            'parent'        => $term->term_id
          ); 
        ?>
        <li class="category-item">
          <a href="<?php echo get_term_link($term->slug,$taxonomy);?>" class="category-link">
            <span><?php echo $term->name; ?></span>
          </a>
        </li>
        <?php } ?>
      </ul>
      <?php get_template_part( 'template-parts/product', 'list' ); ?>
    </div>
  </section>

  <!-- Add the detailed franchise section that matches the image -->
  <div class="container">
    <div class="franchise-container mt-8">
      <h1 class="section-title" style="padding-left: 16px;"><?= $fields["franchise"]["title"] ?></h1>
      <?php get_template_part( 'template-parts/franchise', 'summary', array("franchise" => $fields["franchise"]["highlight_nhuong_quyen"]) ); ?>
    </div>
  </div>

  <?php
  $post_id = 3375;
	$recruitment_fields = get_fields($post_id);
  // Gioi thieu
  $gt_tdc = $recruitment_fields['tdc_gt'];
  $gt_tdp = $recruitment_fields['tdp_gt'];
  // $gt_soluoc = $recruitment_fields['gioi_thieu_so_luoc'];
  // $gt_ndc = $recruitment_fields['noi_dung_chinh'];
  $post_content = get_post($post_id);
  $content = $post_content->post_content;
  $banner = $recruitment_fields['td_banner'];
 ?>
  <div class="container">
    <div class="recruitment">
      <div class="recruitment-content">
        <div class="heading">
          <div class="heading-main"><?php echo $gt_tdc; ?></div>
          <div class="heading-sub"><?php echo $gt_tdp; ?></div>
        </div>
        <div class="recruitment-excerpt"><?php echo $content;?></div>
        <a href="<?php echo get_permalink(get_page_by_path('tuyen-dung')); ?>" class="contact-now"
          title="ỨNG TUYỂN NGAY">
          <span>ỨNG TUYỂN NGAY</span>
          <span class="arrow-shake">→</span>
        </a>
        <img src="<?php echo $banner['url']; ?>" alt="LiA Tuyen dung">
      </div>
    </div>
  </div>

  <section class="section">
    <div class="container">
      <div class="news-header">
        <span>Tin tức & Sự kiện</span>
        <a href="<?= get_permalink(get_page_by_path('tin-tuc')); ?>" class="news-all">Xem tất
          cả <span>&#10095;</span></a>
      </div>
    </div>
    <div class="news">
      <?php get_template_part( 'content/news' ); ?>
    </div>
  </section>

  <!-- Registration Modal -->
  <div class="franchise-modal" id="register-modal">
    <?= wp_nonce_field( 'consultation_form' ); ?>
    <div class="modal-content">
      <div class="modal-close" id="close-register-modal">✕</div>
      <h2 class="modal-title">Đăng ký tư vấn</h2>
      <!-- <form class="modal-form" id="register-form"> -->
      <div class="modal-body">
        <input type="hidden" name="packageName" value="">
        <input type="hidden" name="packageMetric" value="">
        <input type="hidden" name="packageBed" value="">
        <input type="hidden" name="packagePrice" value="">

        <div class="package home">
          <div class="package-title"></div>
          <div class="package-list">
            <div class="package-item">
              <div class="package-label">
                <img src="<?php echo get_theme_file_uri('assets/images/icons/dt.svg'); ?>" alt="Investment">
                Đầu tư
              </div>
              <div class="package-value price"></div>
            </div>
            <div class="package-item">
              <div class="package-label">
                <img src="<?php echo get_theme_file_uri('assets/images/icons/vr-gray.svg'); ?>" alt="Area">
                Diện tích
              </div>
              <div class="package-value metric"></div>
            </div>
            <div class="package-item">
              <div class="package-label">
                <img src="<?php echo get_theme_file_uri('assets/images/icons/user-gray.svg'); ?>" alt="Beds">
                Công suất
              </div>
              <div class="package-value bed"></div>
            </div>
          </div>
        </div>

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