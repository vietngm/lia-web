<?php 
/**
 * Template name: Đặt lịch
 */
?>

<?php get_header();?>

<?php
	// Services
	$post_services = get_posts(array(
		"post_type" => "service",
		"posts_per_page" => -1,
	));
	$services = [];
	foreach ($post_services as $post_service) {
		$doctorIds = get_field("doctors", $post_service->ID);
		$price = get_field("price", $post_service->ID) ?? 0;
		$post_prices = get_field("prices", $post_service->ID) ?? [];
		$prices = [];
	
		if ($post_prices) {
			foreach ($post_prices as $post_price) {
				array_push($prices, array(
					"price" => isset($post_price["origin"]) ? (int)$post_price["origin"] : 0,
					"toppingId" => $post_price["topping"] ?? null,
				));
			}
		}
		array_push($services, [
			"id" => $post_service->ID,
			"title" => $post_service->post_title,
			"doctorIds" => $doctorIds,
			"price" => (int)$price,
			"prices" => $prices,
		]);
	}

	// Doctors
	$post_doctors = get_posts(array(
		"post_type" => "doctor",
		"posts_per_page" => -1,
	));
	$doctors = [];
	foreach ($post_doctors as $post_doctor) {
		$workingTimes = get_field("working-time", $post_doctor->ID);
		array_push($doctors, [
			"id" => $post_doctor->ID,
			"title" => $post_doctor->post_title,
			"workingTimes" => $workingTimes,
		]);
	}

	// Doctors
	$post_doctors = get_posts(array(
		"post_type" => "doctor",
		"posts_per_page" => -1,
	));
	$doctors = [];
	foreach ($post_doctors as $post_doctor) {
		$workingTimes = get_field("working-time", $post_doctor->ID);
		array_push($doctors, [
			"id" => $post_doctor->ID,
			"title" => $post_doctor->post_title,
			"workingTimes" => $workingTimes,
		]);
	}

	// Toppings
	$term_toppings = get_terms('service-topping', array(
		'hide_empty' => false,
	));
	$toppings = [];
	foreach ($term_toppings as $term_topping) {
		array_push($toppings, [
			"id" => $term_topping->term_id,
			"title" => $term_topping->name,
		]);
	}

	// Unavailable
	$today = date( 'Y-m-d' );
	$post_bookings = get_posts(array(
		"post_type" => "booking",
		"posts_per_page" => -1,
		'meta_query' => array(
			array(
				'key' => 'date',
				'value' => $today,
				'compare' => '>=',
				'type' => 'DATE'
			)
		)
	));
	$unavailableTimes = [];
	foreach ($post_bookings as $post_booking) {
		$date = get_field("date", $post_booking->ID);
		$time = get_field("time", $post_booking->ID);
		$doctorId = get_field("doctor", $post_booking->ID);
		$doctorId = $doctorId ? (int) $doctorId : null;
		array_push($unavailableTimes, [
			"date" => $date,
			"time" => $time,
			"doctorId" => $doctorId,
		]);
	}

?>

<script>
const BOOKING_DATA = {
  services: JSON.parse(`<?= json_encode($services) ?>`),
  doctors: JSON.parse(`<?= json_encode($doctors) ?>`),
  toppings: JSON.parse(`<?= json_encode($toppings) ?>`),
  unavailableTimes: JSON.parse(`<?= json_encode($unavailableTimes) ?>`),
};
</script>
<script src="https://cdn.jsdelivr.net/gh/HichemTab-tech/OTP-designer-jquery@2.3.1/dist/otpdesigner.min.js"></script>

<head>
  <style>
  .section-booking-form {
    padding-top: 5.5rem;
  }

  .title_otp_xt {
    font-size: 18px;
    font-weight: 700;
    color: #1a5478;
  }

  .text-14 {
    font-size: 12px;
    font-weight: 300;
  }

  .border-zalo-bottom {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .consultant-zalo-bottom {
    border-radius: 30px;
    padding: 8px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #ECECEC;
    flex-direction: column;
    color: #000;

  }

  .bg-round {
    background: #1a5478;
    color: #fff;
  }

  .input-note .input {
    border: 1px solid #ccc;
    border-radius: 10px !important;
    padding: 10px !important;
    width: 100%;
    font-size: 14px;
    height: 100px !important;
  }

  .time-input-content {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 8px;
    font-size: 14px;
    cursor: pointer;
    width: 80px;
    text-align: center;
  }

  .booking-time-picker input {
    display: none;
  }

  input:checked+.time-input-content,
  .time-input-content:hover {
    --tw-bg-opacity: 1;
    background-color: #1a5478;
  }

  input:checked+.time-input-content,
  .time-input-content:hover {
    --tw-text-opacity: 1;
    color: rgb(255 255 255 / var(--tw-text-opacity));
  }
  </style>
</head>
<main>
  <!-- <section class="section-booking-banner w-full h-[200px] relative px-4 flex items-center justify-center">
		<img class="w-full h-full object-cover object-center absolute" src="<?= get_the_post_thumbnail_url() ?>" />
		<div class="w-full h-full absolute bg-black bg-opacity-50"></div>
		<h1 class="relative z-20 text-white text-24 text-center font-bold uppercase">Đặt lịch nhận ưu đãi</h1>
	</section> -->
  <section class="section section-booking-form booking-form ">
    <div class="container">
      <?= wp_nonce_field( 'booking_order' ); ?>
      <div class="grid grid-cols-2 gap-x-6">
        <div class="lg:col-span-1 col-span-2">
          <h2 class="form-title mb-6">Thông tin khách hàng</h2>
          <input type="hidden" name="postId" value="<?= get_the_ID() ?>" />
          <div class="input-group input-group-left-icon hidden">
            <img class="icon" src="<?= get_theme_file_uri("assets/images/icons/person-gray.svg") ?>" />
            <input class="input" placeholder="Họ và tên khách hàng" name="fullname" />
            <div class="text-12 italic text-red-500 error-fullname"></div>
          </div>
          <div class="input-group input-group-left-icon mb-6">
            <img class="icon" src="<?= get_theme_file_uri("assets/images/icons/phone-gray.svg") ?>" />
            <input class="input" placeholder="Số điện thoại" name="phone" />
            <div class="text-12 italic text-red-500 error-phone"></div>
          </div>
          <div class="input-group input-group-left-icon mb-6">
            <img class="icon" src="<?= get_theme_file_uri("assets/images/icons/person-gray.svg") ?>" />
            <?php
							$placeholder = "Mã giới thiệu";
							$referralRate = get_field("referralRate");
							if ($referralRate) {
								$placeholder = "Nhập mã cộng tác viên để giảm $referralRate%";
							}
						?>
            <input class="input" placeholder="<?= $placeholder ?>" name="referralCode" />
          </div>
          <label class="flex gap-3 items-center cursor-pointer mb-6">
            <div class="input-checkbox">
              <input type="checkbox" name="foreigner" />
              <div class="icon"></div>
            </div>
            <div>Đặt hẹn cho người thân/ bạn bè/ người nước ngoài</div>
          </label>
          <hr class="mb-6" />
          <h2 class="form-title mb-6">Phương thức đặt hẹn</h2>
          <div class="input-select mb-4 input-doctor">
            <select placeholder="Chọn chuyên viên" name="doctor">
              <option></option>
              <?php foreach ($doctors as $doctor) : ?>
              <option value="<?= $doctor["id"] ?>"><?= $doctor["title"] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="text-12 italic text-red-500 error-doctor"></div>
          </div>
          <div class="input-select mb-4 input-service hidden">
            <select placeholder="Chọn dịch vụ" name="service">
              <option></option>
            </select>
            <div class="text-12 italic text-red-500 error-service"></div>
          </div>
          <div class="input-btn-group mb-4 input-topping hidden">
            <div class="text-14 font-bold pb-2 border-b-1 mb-3 border-dashed border-[#ccc]">
              Topping dịch vụ
            </div>
            <select name="topping">
              <option></option>
            </select>
            <div class="text-12 italic text-red-500 error-topping"></div>
          </div>
          <div class="estimate-price hidden">
            <div class="flex justify-between mt-4">
              <div class="text-[#606060]">Phí khám dự kiến</div>
              <div class="text-red-500 font-semibold estimate-price-value"></div>
            </div>
          </div>
          <hr class="my-6 lg:hidden block" />
        </div>
        <div class="lg:col-span-1 col-span-2">
          <h2 class="form-title mb-0.5">Lịch hẹn</h2>
          <div class="mb-4">Ngày khám mong muốn <span class="text-red-500">*</span></div>
          <div class="booking-date-picker mb-0">
            <div class="item active" data-date="<?= date("Y-m-d"); ?>">
              <div class="inner">
                <div>Thg <?= date("m") ?></div>
                <div><?= date("d") ?></div>
              </div>
              <div class="text">Hôm nay</div>
            </div>
            <?php for ($i = 1; $i <= 2; $i++): ?>
            <?php $dayTimestamp = strtotime("+$i days"); ?>
            <div class="item" data-date="<?= date('Y-m-d', $dayTimestamp); ?>">
              <div class="inner">
                <div>Thg <?= date('m', $dayTimestamp); ?></div>
                <div><?= date('d', $dayTimestamp); ?></div>
              </div>
            </div>
            <?php endfor; ?>
            <label class="item other">
              <div class="inner">
                <div class="plus-icon"></div>
              </div>
              <div class="text">Ngày khác</div>
              <input type="text" inputmode="none" class="datetimepicker w-full h-0 opacity-0 pointer-events-none block"
                name="date" data-min-date="<?= date("Y-m-d"); ?>" />
            </label>
          </div>

          <div class="text-12 italic text-red-500 error-date"></div>
          <div class="my-4">Giờ khám mong muốn <span class="text-red-500">*</span></div>
          <div class="booking-time-picker pointer-events-none opacity-30">
            <div class="flex">
              <div class="sm:w-[80px] w-[60px] flex gap-3 items-center cursor-pointer">
                Sáng
              </div>
              <div class="flex flex-1 sm:gap-4 gap-3 overflow-x-auto no-scrollbar input-times-morning">
                <?php for ($index = 7; $index <= 12; $index ++) : ?>
                <label class="time-input flex-shrink-0">
                  <input type="radio" name="time" value="<?= $index < 10 ? "0" : "" ?><?= $index ?>:00" />
                  <div class="time-input-content"><?= $index < 10 ? "0" : "" ?><?= $index ?>:00</div>
                </label>
                <?php endfor; ?>
              </div>
            </div>
            <div class="flex mt-4">
              <div class="sm:w-[80px] w-[60px] flex gap-3 items-center cursor-pointer">
                Chiều
              </div>
              <div class="flex flex-1 sm:gap-4 gap-3 overflow-x-auto no-scrollbar input-times-afternoon">
                <?php for ($index = 13; $index <= 19; $index ++) : ?>
                <label class="time-input flex-shrink-0">
                  <input style="display:none" type="radio" name="time" value="<?= $index ?>:00" />
                  <div class="time-input-content"><?= $index ?>:00</div>
                </label>
                <?php endfor; ?>
              </div>
            </div>
          </div>
          <div class="text-12 italic text-red-500 error-time"></div>
          <div class="flex gap-3 mt-4">
            <div class="w-5 h-5 flex items-center justify-center rounded-5 bg-[#bdbdbd]">
              <img class="w-3.5 h-3.5" src="<?= get_theme_file_uri("assets/images/icons/person-white.svg") ?>" />
            </div>
            <div class="flex-1">Đây là khung giờ lý tưởng để đặt hẹn làm đẹp</div>
          </div>
          <hr class="my-6" />
          <h2 class="form-title mb-2">Ghi chú</h2>
          <div class="input-group input-note mb-0">
            <textarea class="input" rows="3" placeholder="Họ và tên khách hàng" name="note"></textarea>
          </div>
        </div>
      </div>

      <div class="otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4">
        <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
        <div class="relative z-1 m-auto p-4 rounded-2 bg-white w-full max-w-[600px]">
          <div class="title_otp_xt">Xác thực mã OTP</div>
          <div class="close-modal absolute right-0 top-0 p-4 cursor-pointer">
            <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
          </div>
          <p class="text-14 mb-5 ">Vui lòng nhập mã OTP gửi tới số điện thoại của bạn</p>
          <div class="otp_target mb-3"></div>
          <div class="text-center">
            <button class="submit-otp btn w-full  text-center py-2.5 justify-center">Xác nhận</button>
          </div>
        </div>
      </div>
      <div class="modal-success fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4">
        <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
        <div class="relative z-1 m-auto p-4 rounded-2 bg-white w-full max-w-[600px]">
          <div style="display: flex;align-items: center;justify-content: center;margin-bottom: 24px;">
            <img class="w-10 h-10" src="<?= get_theme_file_uri("assets/images/icons/check-circle.svg") ?>" alt="" />
          </div>
          <div class="text-center text-14" style="position: relative;display: flex;justify-content: center;">
            <span style="font-weight:700;font-size:20px">THÔNG TIN ĐÃ ĐƯỢC GHI NHẬN</span>
            <div class="border-vertical" style="border: 2px solid #1a5478;
							position: absolute;
							width: 35%; 
							display: flex;
							align-items: center;
							justify-content: center;
							bottom: -6px;"></div>
          </div>
          <div style="margin-top:24px;text-align:center">
            *Lưu ý: Tổng đài viên Phòng khám LiA Beauty sẽ gọi lại
            cho Quý khách để xác nhận thông tin lịch hẹn dựa theo
            đăng ký. Cảm ơn Quý khách hàng đã sử dụng dịch vụ của
            chúng tôi
          </div>
        </div>
      </div>
      <div class="h-[80px]"></div>
      <div class="h-[80px] flex items-center border-t-1 border-[#ccc] fixed bottom-0 left-0 right-0 bg-white">
        <div class="container">
          <div class="grid grid-cols-3 gap-2">
            <div class="col-span-1">
              <a href="<?= get_permalink(get_field("page_doctor", "option")) ?>" class="consultant-zalo-bottom w-full">
                <div class="border-zalo-bottom">
                  <div style="font-weight:700">Tìm chuyên viên</div>
                </div>
                <div style="font-size:10px">Tư vấn ngay</div>
              </a>
            </div>
            <div class="col-span-2">
              <button class="submit btn w-full consultant-zalo-bottom bg-round text-center py-3 px-0 justify-center ">
                <div style="font-weight:700">Xác nhận đặt hẹn</div>
                <div style="font-size:10px">Nhận ngay ưu đãi hấp dẫn</div>
              </button>
            </div>
          </div>
          <!-- <div class="grid grid-cols-3 gap-4">
					<div class="col-span-1">
						<a href="<?= get_permalink(get_field("page_doctor", "option")) ?>" class="btn-outline !rounded-2 w-full text-center py-[11px] px-0 justify-center font-bold">Tìm chuyên viên</a>
					</div>
					<div class="col-span-2">
						<button class="submit btn w-full text-center py-3 px-0 justify-center font-bold">Xác nhận đặt hẹn</button>
					</div>
				</div> -->
        </div>
      </div>
  </section>
</main>

<?php get_footer("empty"); ?>