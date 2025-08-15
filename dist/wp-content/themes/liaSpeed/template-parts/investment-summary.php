<?php
  $investment_id = $args['investment_id'];
  $investment_name = $args['investment_name'];
  $mohinh = $args['mohinh'];
  $dia_chi = $args['dia_chi'];
  $open_time = $args['open_time'];
  $mohinh_id = $mohinh->ID;
  $mohinh_name = $mohinh->post_title;
  $vondautu = (int) $args['vondautu'];
  $vonkeugoi = (int) $args['vonkeugoi'];
  $mohinh_avatar = bfi_thumb(get_the_post_thumbnail_url($mohinh_id), array("width" => 400, 'crop' => false));
  $trangthai = $args['trangthai'];
  $trangthai_name = get_term($trangthai, 'investment-tag');
  $trangthai_name = $trangthai_name->name;
  $pageInvestmentId = get_page_by_path('cac-hinh-thuc-dau-tu');
  $cachinhthucdautu = get_field('dshtdt',$pageInvestmentId->ID);
  $dientich = get_field('dt_dientich',$investment_id);
  $phong = get_field('dt_succhua',$investment_id);
?>

<a href="<?= get_permalink($investment_id) ?>" class="investment-info">
  <div class="investment-avatar">
    <img src='<?= esc_url($mohinh_avatar) ?>' alt="Mo hinh dau tu">
  </div>
  <div class="investment-content">
    <h1 class="font-bold" style="font-size:14px"><?= esc_html($investment_name) ?? 'N/A'; ?></h1>
    <div class="investment-money"><?=number_format($vonkeugoi, 0, ",", ".")?> <small><u>đ</u></small> /
      <?=number_format($vondautu, 0, ",", ".")?> <small><u>đ</u></small></div>
    <div class="progress-wrapper" data-vondautu="<?= $vondautu ?>" data-vonkeugoi="<?= $vonkeugoi ?>">
      <div class="progress-container">
        <div class="progress-bar" style="width: 0;"></div>
      </div>
    </div>
    <div class="investment-icon">
      <img src="<?= get_theme_file_uri("assets/images/location.png") ?>" alt="Địa chỉ" />
      <div class="investment-icon-text">
        <?= esc_html($dia_chi) ?? 'N/A'; ?>
      </div>
    </div>
    <?php if ($trangthai) : ?>
    <div class="investment-icon">
      <img src="<?= get_theme_file_uri("assets/images/idea.png") ?>" alt="Trạng thái" />
      <div class="investment-icon-text">
        <?= esc_html($trangthai_name) ?? 'N/A'; ?>
      </div>
    </div>
    <?php endif; ?>
    <div class="investment-icon">
      <img src="<?= get_theme_file_uri("assets/images/calendar.png") ?>" alt="Thời gian" />
      <?= esc_html($open_time) ?? 'N/A'; ?>
    </div>
  </div>
</a>

<div class="investment-action">
  <button class="btn btn-register-investment js-investment" data-id="<?= $investment_id ?>">Đăng ký</button>
</div>

<div id="modal-investment-<?= $investment_id ?>" class="modal modal-animate fixed z-[120]">
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
          <div class="metric-value"><?= $investment_name; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/user-gray.svg'); ?>" alt="Beds">
            Sức chứa
          </div>
          <div class="metric-value"><?= $phong ?? 'N/A'; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/vr-gray.svg'); ?>" alt="Area">
            Diện tích
          </div>
          <div class="metric-value"><?= $dientich ?? 'N/A'; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/location-gray.svg'); ?>" alt="Investment">
            Vị trí
          </div>
          <div class="metric-value"><?=$dia_chi;?></div>
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
      <button class="btn btn-lg btn-register-investment js-register-investment" data-id="<?= $investment_id ?>">Gửi yêu
        cầu</button>
    </div>
  </div>

</div>