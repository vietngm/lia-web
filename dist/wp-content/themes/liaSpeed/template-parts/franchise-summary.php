<?php
    $fields = get_fields();
    $franchise = $args['franchise'];
?>

<style>
.blur-bg {
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(4px);
}

.bg-border {
  width: 100%;
  height: 1px;
  position: absolute;
  border-bottom: 2px solid #961bb329;
  ;
}

.bg-category {
  color: rgb(123, 43, 143);
  border-radius: 5px;
  font-weight: 500;
  font-size: 11px;
  margin-top: 1px;
}

.image-container {
  position: relative;
}

.image-container img {
  width: 100%;
  display: block;
}

.image-container::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 50%;
  background: linear-gradient(to top, white, rgba(255, 255, 255, 0));
}

.button-detail {
  background: #EDFFE1;
  color: #45843B;
  font-weight: 600;
  padding: 4px 12px;
  border: 1px solid #45843B;
  border-radius: 24px;
}

.image-containers {
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
}
</style>
<div class="franchise-slider franchise-tab-content active" id="tab-kisok">
  <div class="content-slider overflow-hidden rounded-2 flex-1 ">

    <?php foreach ( $franchise as $franchiseId ): ?>
    <?php $franchiseFields = get_fields($franchiseId); ?>
    <div class="franchise-slide active" data-slide="kisok-1">
      <div class="slide-content">
        <h1 class="franchise-title"><?= get_the_title($franchiseId) ?></h1>
        <h2 class="franchise-subtitle"><?= $franchiseFields["description"] ?></h2>

        <div class="franchise-stats">
          <h3><?= $franchiseFields['price'] ?> triệu</h3>
          <span class="stat-dot">·</span>
          <h4><?= $franchiseFields['m2'] ?></h4>
          <span class="stat-dot">·</span>
          <h4><?= $franchiseFields['phong'] ?> phòng</h4>
        </div>

        <?php
        $data = array(
            'price'=>$franchiseFields['price'].' triệu',
            'name'=>get_the_title($franchiseId),
            'metric'=>esc_attr($franchiseFields['m2']),
            'bed'=>$franchiseFields['phong'].' phòng',
		);
        ?>
        <div class="franchise-image">
          <img src="<?= get_the_post_thumbnail_url($franchiseId) ?>" alt="LiA Kisok" />
          <div class="franchise-cta">
            <a href="javascript:void(0)" class="franchise-btn tv" rel='<?=json_encode($data);?>' id="register-btn">
              Đăng ký tư vấn
            </a>
            <a href="<?= get_permalink($franchiseId)?>" class="franchise-btn details">Xem chi tiết</a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>