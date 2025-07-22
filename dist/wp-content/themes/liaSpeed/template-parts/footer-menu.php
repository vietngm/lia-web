<?php
	$fields = get_fields("option");
	$footer = $fields['footer'];
	$liaVietNam = $footer['lia_viet_nam'];
	$trachNhiemLia = $footer['trach_nhiem_lia'];
	$thongTinDauTu = $footer['thong_tin_dau_tu'];
?>

<footer class="footer-general">
  <div class="container">
    <div class="footer-logo">
      <a href="/" class="logo">
        <img src="<?= get_theme_file_uri("assets/images/logo.png") ?>" />
      </a>
      <p class="address"><?= $fields["footer"]["contact"]["address"] ?></p>
    </div>
    <hr style="margin-top: 16px;border-top: 1px solid #ddd" />
    <div class="accordion">
      <div class="expand-item accordion-item">
        <div class="accordion-header">
          <span class="accordion-title"><?= $liaVietNam['title'] ?></span>
          <div class="arrow-up"></div>
        </div>
        <div class="expand-content">
          <ul class="expand-desc">
            <?php
					$items = $liaVietNam['items'];
					foreach($items as $item) {
						$link = $item['link'];
						echo '<li class="menu-item"><a href="'.$link['url'].'">'.$link['title'].'</a></li>';
					}
					?>
          </ul>
        </div>
      </div>

      <div class="expand-item accordion-item">
        <div class="accordion-header">
          <span class="accordion-title"><?= $trachNhiemLia['title'] ?></span>
          <div class="arrow-up"></div>
        </div>
        <div class="expand-content">
          <ul class="expand-desc">
            <?php
					$items = $trachNhiemLia['items'];
					foreach($items as $item) {
						$link = $item['link'];
						echo '<li class="menu-item"><a href="'.$link['url'].'">'.$link['title'].'</a></li>';
					}
					?>
          </ul>
        </div>
      </div>

      <div class="expand-item accordion-item">
        <div class="accordion-header">
          <span class="accordion-title"><?= $thongTinDauTu['title'] ?></span>
          <div class="arrow-up"></div>
        </div>
        <div class="expand-content">
          <ul class="expand-desc">
            <?php
					$items = $thongTinDauTu['items'];
					foreach($items as $item) {
						$link = $item['link'];
						echo '<li class="menu-item"><a href="'.$link['url'].'">'.$link['title'].'</a></li>';
					}
					?>
          </ul>
        </div>
      </div>

      <div class="accordion-item">
        <a href="<?=get_permalink(get_page_by_path('tuyen-dung'))?>" class="accordion-header">
          <span class="accordion-title">Thông tin tuyển dụng</span>
          <div class="arrow-go"></div>
        </a>
      </div>

      <div class="accordion-item">
        <a href="<?=get_permalink(get_page_by_path('tin-tuc'))?>" class="accordion-header">
          <span class="accordion-title">Tin tức</span>
          <div class="arrow-go"></div>
        </a>
      </div>
    </div>
  </div>
  <p class="tax-no"><?= $fields["footer"]["contact"]["tax_no"] ?></p>
  </div>
</footer>