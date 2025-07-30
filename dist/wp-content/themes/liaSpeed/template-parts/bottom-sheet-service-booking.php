<?php 
/**
 * Template name: Đặt lịch
 */
?>
<?php
	// Services
	$post_services = get_posts(array(
		"post_type" => "service",
		"posts_per_page" => -1,
	));
  
	$services = [];
  
  $post_branchs = get_posts(array(
		"post_type" => "branch",
		"posts_per_page" => -1,
	));

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
		"post_type" => "practitioner",
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
		$doctorId = get_field("practitioner", $post_booking->ID);
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
  services: <?= json_encode($services, JSON_UNESCAPED_UNICODE); ?>,
  doctors: <?= json_encode($doctors, JSON_UNESCAPED_UNICODE); ?>,
  toppings: <?= json_encode($toppings, JSON_UNESCAPED_UNICODE); ?>,
  unavailableTimes: <?= json_encode($unavailableTimes, JSON_UNESCAPED_UNICODE); ?>
};
</script>
<script>
$(document).ready(function() {
  // Lấy serviceId từ localStorage
  const storedServiceId = localStorage.getItem("serviceId");
  const services = BOOKING_DATA.services;
  const doctors = BOOKING_DATA.doctors; // Danh sách tất cả chuyên viên

  if (storedServiceId) {
    const serviceId = parseInt(storedServiceId);
    const selectedService = services.find(service => service.id === serviceId);

    // console.log("Dịch vụ đã chọn:", selectedService);

    if (selectedService) {
      // console.log("Dịch vụ đã chọn:", selectedService);

      // Lọc danh sách chuyên viên theo doctorIds của dịch vụ
      const doctorIds = Array.isArray(selectedService.doctorIds) ? selectedService.doctorIds : [];
      const filteredDoctors = doctors.filter(doctor => doctorIds.includes(doctor.id));
      // console.log("Danh sách chuyên viên:", filteredDoctors);

      // Cập nhật danh sách chuyên viên vào dropdown
      const doctorSelect = $(".input-doctor select");
      doctorSelect.html('<option value="">Chọn chuyên viên</option>'); // Xóa dữ liệu cũ, thêm option mặc định

      filteredDoctors.forEach(doctor => {
        doctorSelect.append(`<option value="${doctor.id}">${doctor.title}</option>`);
      });
    } else {
      console.log("Không tìm thấy dịch vụ với ID:", serviceId);
    }
  }
});
</script>
<script src="https://cdn.jsdelivr.net/gh/HichemTab-tech/OTP-designer-jquery@2.3.1/dist/otpdesigner.min.js"></script>

<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
<div class="relative m-auto rounded-2 bg-white w-full background-modal p-4 z-[120] booking-service">
  <div class="overflow-hidden w-full h-full">
    <div class="flex items-center mb-4">
      <div class="booking-service-info">
        <div class="booking-service-image">
          <img id="serviceImage" src="" alt="LiA Beauty Center">
        </div>
        <div class="booking-service-content">
          <div id="serviceName" class="booking-service-name"></div>
          <div id="servicePrice" class="booking-service-price">
            <?php echo number_format($servicePrice, 0, ',', '.') ?> đ
          </div>
        </div>
      </div>
      <div class="close-modal cursor-pointer">
        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
      </div>
    </div>

    <section class="section section-booking-form booking-form booking-row">
      <?= wp_nonce_field( 'booking_order' ); ?>

      <div class="grid grid-cols-2 gap-x-6">
        <div class="lg:col-span-1 col-span-2">
          <h2 class="font-semibold mb-2" style="font-size:14px">Thông tin cá nhân</h2>
          <input type="hidden" name="postId" value="<?= get_the_ID() ?>" />
          <div class="input-group">
            <input class="input" placeholder="Họ và tên khách hàng" name="fullname" />
            <div class="text-12 italic text-red-500 error-fullname"></div>
          </div>
          <div class="input-group mb-6">
            <input class="input" placeholder="Số điện thoại" name="phone" />
            <div class="text-12 italic text-red-500 error-phone"></div>
          </div>

          <div>
            <div class="font-semibold branch-name mb-2">Trung tâm & Chuyên viên</div>
            <div class="input-select mb-4 input-branch">
              <select placeholder="Chọn trung tâm" name="branch" class="js-branch">
                <option></option>
                <?php foreach ($post_branchs as $branch) : ?>
                <option value="<?= $branch->post_title ?>" data-branch-id="<?= $branch->ID ?>"
                  data-address="<?=get_field('address',$branch->ID);?>"
                  data-ids="<?php echo json_encode(get_field('chuyen_vien',$branch->ID));?>">
                  <?= $branch->post_title ?></option>
                <?php endforeach; ?>
              </select>
              <div class="text-12 italic text-red-500 error-branch"></div>
            </div>
          </div>
          <div class="input-select mb-4 input-doctor">
            <select placeholder="Chọn chuyên viên" name="practitioner" id="practitioner">
              <option></option>
              <?php foreach ($doctors as $doctor) : ?>
              <option value="<?= $doctor["id"] ?>" data-doctor-id="<?= $doctor["id"] ?>">
                <?= $doctor["title"] ?>
              </option>
              <?php endforeach; ?>
            </select>
            <div class="text-12 italic text-red-500 error-doctor"></div>
          </div>
        </div>
      </div>

      <div class="toppings-group">
        <div class="topping-header">Topping</div>
        <div id="topping-container" class="topping-container">

        </div>
      </div>
      <div>
        <div class="lg:col-span-1 col-span-2">
          <div class="mb-4 font-semibold">Ngày khám mong muốn <span class="text-red-500">*</span></div>
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
          <div class="font-semibold my-4">Giờ khám mong muốn <span class="text-red-500">*</span></div>
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

        </div>
      </div>

      <div class="otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4">
        <?php get_template_part( 'template-parts/modal', 'otp' ); ?>
      </div>

      <div class="modal-success fixed hidden top-0 left-0 right-0 bottom-0 z-[100] p-4" style="z-index: 1200;">
        <?php get_template_part( 'template-parts/modal', 'popup' ); ?>
      </div>

      <div class="h-[80px] flex items-center fixed bottom-0 left-0 right-0 bg-white bottom-action" style="z-index:10">
        <?php get_template_part( 'template-parts/modal', 'booking-confirm' ); ?>
      </div>

    </section>
  </div>
</div>