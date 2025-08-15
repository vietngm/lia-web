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
  <button class="btn btn-register-investment js-investment" data-name="<?= $investment_name ?? 'N/A' ?>"
    data-id="<?= $investment_id ?>" data-phong="<?= $phong ?? 'N/A' ?>" data-dientich="<?= $dientich ?? 'N/A' ?>"
    data-diachi="<?= $dia_chi ?? 'N/A' ?>">Đăng ký</button>
</div>