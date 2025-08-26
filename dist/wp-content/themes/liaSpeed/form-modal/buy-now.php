<div id="modal-buy-now" class="modal modal-animate fixed z-[120]">
  <?php
	$paymentId = get_page_by_path('thong-tin-thanh-toan');
	$payments = get_field('pttt_cpttt',$paymentId->ID);
  $deliveryFee = "30000";
  $deliveryStandand="Tiêu chuẩn";
	?>
  <?= wp_nonce_field( 'buy_now_form' ); ?>
  <div class="rounded-2 modal-bottom-sheet">
    <div class="flex modal-header">
      <div class="font-bold">Thanh toán</div>
      <div class="close-modal cursor-pointer">
        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
      </div>
    </div>
    <div class="modal-info">
      <div class="modal-product-container">
        <div class="modal-product-thumb">
          <img src="<?= get_theme_file_uri("assets/images/noimg64.png") ?>" alt="" />
        </div>
        <div class="modal-product-info">
          <div class="title">N/A</div>
          <div class="price">0 <small>đ</small></div>
        </div>
      </div>

      <div class="modal-info-content">
        <div class="font-semibold mb-2 mt-6">Thông tin cá nhân</div>
        <input type="hidden" name="postId" value="" />
        <div class="input-group">
          <input class="input" placeholder="Họ và tên khách hàng" name="fullname" />
          <div class="has-error error-fullname"></div>
        </div>
        <div class="input-group">
          <input class="input" placeholder="Số điện thoại" name="phone" />
          <div class="has-error error-phone"></div>
        </div>

        <div class="input-group">
          <textarea class="input" rows="3" placeholder="Địa chỉ giao hàng" name="address"></textarea>
          <div class="has-error error-address"></div>
        </div>

        <div class="input-group">
          <div class="font-semibold mb-2 mt-6">Phương thức vận chuyển</div>
          <div class="delivery-method">
            <ul class="modal-delivery-list">
              <li class="modal-delivery-item">
                <div class="delivery-method-subtitle">Tiêu chuẩn</div>
                <label class="flex items-center justify-between py-2 cursor-pointer">
                  <div class="flex items-center space-x-2 gap-2">
                    <span class="text-gray-800">Nhận hàng sau 1 - 3 ngày</span>
                  </div>
                  <div class="flex items-center space-x-2 gap-2">
                    <span><?= number_format($deliveryFee, 0, ",", ".") ?> <small>đ</small></span>
                    <input type="radio" name="deliveryMethod" data-price="<?=$deliveryFee;?>"
                      value="<?=$deliveryStandand?>">
                  </div>
                </label>
              </li>
            </ul>
            <div class="has-error error-delivery"></div>
          </div>
        </div>

        <div class="input-group">
          <div class="font-semibold mb-2 mt-6">Hình thức thanh toán</div>
          <ul class="modal-payment-list">
            <?php foreach($payments as $item): ?>
            <li class="modal-payment-item">
              <label class="flex items-center justify-between py-2 cursor-pointer">
                <span><?= $item['pttt_tht']; ?></span>
                <input type="radio" name="paymentMethod" value="<?= $item['pttt_tht']; ?>" />
              </label>
            </li>
            <?php endforeach; ?>
          </ul>
          <div class="has-error error-payment"></div>
        </div>
        <div class="input-group">
          <div class="font-semibold mb-2 mt-6">Chi tiết thanh toán</div>
          <ul class="modal-invoice">
            <li class="modal-invoice-item">
              <span class="name">Tạm tính(1 sản phẩm)</span>
              <span class="value">0 <small>đ</small></span>
            </li>
            <li class="modal-invoice-item">
              <span class="name">Phí vận chuyển</span>
              <span class="value"><?= number_format($deliveryFee, 0, ",", ".") ?> <small>đ</small></span>
            </li>
          </ul>
          <div class="modal-invoice-total">
            <span class="name">Tổng tạm tính</span>
            <span class="value">0 <small>đ</small></span>
          </div>
        </div>
      </div>

    </div>
    <div class="modal-action">
      <div class="modal-action-total">
        <span class="name">Tổng: </span>
        <span class="value">0 <small>đ</small></span>
      </div>
      <button class="btn btn-lg btn-submit-buy-now js-submit-buy-now">Đặt hàng</button>
    </div>
  </div>
</div>