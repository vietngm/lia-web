<?= wp_nonce_field( 'consultation_form' ); ?>
<div class="modal-content modal-content-customized">
  <div class="modal-header">
    <h2>Đăng ký tư vấn</h2>
    <span class="close-modal">&times;</span>
  </div>
  <div class="modal-body">
    <div class="modal-scroll">
      <input type="hidden" name="packageName" value="<?php the_title(); ?>">
      <input type="hidden" name="packageMetric" value="<?=$franchise_fields['m2']; ?>">
      <input type="hidden" name="packageBed" value="<?=$franchise_fields['phong']; ?>">
      <input type="hidden" name="packagePrice" value="<?=$franchise_fields['price']; ?>">
      <input type="hidden" name="packageCapital" value="">
      <input type="hidden" name="packageInvestment" value="">
      <input type="hidden" name="paymentPolicy" value="">

      <div class="package">
        <div class="package-title"><?php the_title(); ?></div>
        <div class="package-list">
          <div class="package-item">
            <div class="package-label">
              <img src="<?php echo get_theme_file_uri('assets/images/icons/dt.svg'); ?>" alt="Investment">
              Đầu tư
            </div>
            <div class="package-value"><?=$franchise_fields['price']; ?> Triệu</div>
          </div>
          <div class="package-item">
            <div class="package-label">
              <img src="<?php echo get_theme_file_uri('assets/images/icons/vr-gray.svg'); ?>" alt="Area">
              Diện tích
            </div>
            <div class="package-value"><?=$franchise_fields['m2']; ?></div>
          </div>
          <div class="package-item">
            <div class="package-label">
              <img src="<?php echo get_theme_file_uri('assets/images/icons/user-gray.svg'); ?>" alt="Beds">
              Công suất
            </div>
            <div class="package-value"><?=$franchise_fields['phong']; ?> giường</div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="fullname">Họ và tên</label>
        <input type="text" id="fullname" name="fullname" required placeholder="Nhập họ và tên của bạn">
        <div class="has-error error-fullname"></div>
      </div>
      <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="tel" id="phone" name="phone" required placeholder="Nhập số điện thoại của bạn">
        <div class="has-error error-phone"></div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Nhập email của bạn">
        <div class="has-error error-email"></div>
      </div>
      <div class="form-group">
        <label for="message">Nội dung</label>
        <textarea id="message" name="message" class="form-input" rows="4"
          placeholder="Nhập yêu cầu tư vấn của bạn"></textarea>
      </div>

      <div class="package-info">
        <div class="package-title">Chi tiết nhượng quyền</div>
        <div class="package-list">
          <div class="package-item">
            <div class="package-label">
              Gói đầu tư
            </div>
            <div class="package-value package-investment">N/A</div>
          </div>
          <div class="package-item">
            <div class="package-label">Vốn đầu tư</div>
            <div class="package-value package-capital"></div>
          </div>
          <div class="package-item">
            <div class="package-label">Chính sách thanh toán</div>
            <div class="package-value package-policy">N/A</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="submit-button js-submit-consultation">Gửi yêu cầu</button>
  </div>
</div>