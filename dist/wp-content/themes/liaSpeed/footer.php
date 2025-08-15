<?php get_template_part( 'template-parts/footer', "menu"); ?>
<?php get_template_part( 'template-parts/footer', "nav"); ?>
<?php get_template_part('template-parts/modal','consultation-success'); ?>
<div id="bottom-sheet-booking" class="modal-booking fixed hidden top-0 left-0 right-0 bottom-0 z-[120] modal-popup">
  <?php get_template_part( 'template-parts/bottom-sheet', 'service-booking' ); ?>
</div>
<div id="modal-investment" class="modal modal-animate fixed z-[120]">
  <?php
	$pageInvestmentId = get_page_by_path('cac-hinh-thuc-dau-tu');
	$cachinhthucdautu = get_field('dshtdt',$pageInvestmentId->ID);
	?>
  <?= wp_nonce_field( 'investment_form' ); ?>
  <div class="rounded-2 modal-bottom-sheet">
    <div class="flex modal-header">
      <div class="font-bold">Thông tin mô hình</div>
      <div class="close-modal cursor-pointer">
        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
      </div>
    </div>
    <div class="modal-info">
      <div class="metrics-container">
        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/building.svg'); ?>" alt="Investment">
            Mô hình
          </div>
          <div class="metric-value modal-name"></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/user-gray.svg'); ?>" alt="Beds">
            Sức chứa
          </div>
          <div class="metric-value modal-phong"><?= $phong ?? 'N/A'; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/vr-gray.svg'); ?>" alt="Area">
            Diện tích
          </div>
          <div class="metric-value modal-dientich"><?= $dientich ?? 'N/A'; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/location-gray.svg'); ?>" alt="Investment">
            Vị trí
          </div>
          <div class="metric-value modal-dia_chi"><?=$dia_chi;?></div>
        </div>
      </div>

      <div class="modal-info-content">
        <div class="font-semibold mb-2 mt-6">Thông tin cá nhân</div>
        <input type="hidden" name="postId" value="<?= $investment_id ?>" />
        <div class="input-group">
          <input class="input" placeholder="Họ và tên khách hàng" name="fullname" />
          <div class="has-error error-fullname"></div>
        </div>
        <div class="input-group">
          <input class="input" placeholder="Số điện thoại" name="phone" />
          <div class="has-error error-phone"></div>
        </div>

        <div class="input-group">
          <div class="font-semibold mb-2 mt-6">Hình thức đầu tư</div>
          <ul class="modal-option-investment-list flex flex-col gap-2">
            <?php foreach($cachinhthucdautu as $item): ?>
            <li class="modal-option-investment-item">
              <label class="flex items-center gap-2">
                <input type="radio" name="cachinhthucdautu" class="modal-option-investment"
                  value="<?= $item['ten_hinh_thuc']; ?>" />
                <span><?= $item['ten_hinh_thuc']; ?></span>
              </label>
            </li>
            <?php endforeach; ?>
          </ul>

          <div class="has-error error-investment"></div>
        </div>

        <div class="input-group input-note mb-0 mt-6">
          <div class="font-semibold mb-2">Ghi chú</div>
          <textarea class="input" rows="3" placeholder="Ghi chú" name="note"></textarea>
        </div>
      </div>

    </div>
    <div class="modal-action">
      <button class="btn btn-lg btn-register-investment js-register-investment">Gửi yêu
        cầu</button>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
</body>

</html>