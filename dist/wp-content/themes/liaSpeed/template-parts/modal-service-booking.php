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
	// $post_doctors = get_posts(array(
	// 	"post_type" => "practitioner",
	// 	"posts_per_page" => -1,
	// ));
	// $doctors = [];
	// foreach ($post_doctors as $post_doctor) {
	// 	$workingTimes = get_field("working-time", $post_doctor->ID);
	// 	array_push($doctors, [
	// 		"id" => $post_doctor->ID,
	// 		"title" => $post_doctor->post_title,
	// 		"workingTimes" => $workingTimes,
	// 	]);
	// }

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

  console.log("Danh sách dịch vụ:", services);


  if (storedServiceId) {
    const serviceId = parseInt(storedServiceId);
    const selectedService = services.find(service => service.id === serviceId);

    console.log("Dịch vụ đã chọn:", selectedService);


    if (selectedService) {
      console.log("Dịch vụ đã chọn:", selectedService);

      // Lọc danh sách chuyên viên theo doctorIds của dịch vụ
      const doctorIds = Array.isArray(selectedService.doctorIds) ? selectedService.doctorIds : [];
      const filteredDoctors = doctors.filter(doctor => doctorIds.includes(doctor.id));
      console.log("Danh sách chuyên viên:", filteredDoctors);


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

<head>
  <style>
  .title_otp_xt {
    font-size: 18px;
    font-weight: 700;
    color: #1a5478;
  }

  .text-14 {
    font-size: 12px;
    font-weight: 300;
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

  .booking-service {
    height: 85%;
    display: flex;
    align-items: center;
    justify-content: center;
    bottom: 0;
    z-index: 1;
    position: absolute;
    background: #ffff;
    border-radius: 16px 16px 0px 0px;
  }

  .booking-row {
    text-align: start;
    overflow-y: auto;
    height: 90%;
    padding-bottom: 100px;
    padding: 0px 4px 100px 4px
  }

  .booking-row::-webkit-scrollbar {
    display: none;
  }

  .form-title::before {
    top: 4px
  }

  .edit-topping {
    position: absolute;
    right: 0;
    top: 66px;
    font-size: 8px;
    background: #00BCD4;
    padding: 2px 12px;
    border-radius: 12px;
    color: #FFF;
    font-weight: 700;
    cursor: pointer;
  }

  .byHand {
    display: none;
  }

  .title-topping {
    font-size: 12px;
    font-weight: 600;
    color: #1a5478;
    border-bottom: 1px solid #d3d1d2;
    padding-bottom: 4px;
    margin-bottom: 4px;
  }
  </style>
  </style>
</head>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const totalPrice = localStorage.getItem("totalPrice") || 0;
  const formattedPrice = new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
  document.getElementById("totalPriceBooking").textContent = formattedPrice;

  const serviceName = localStorage.getItem("serviceName") || "Không có dịch vụ";
  const serviceNameElement = document.getElementById("serviceName");
  if (serviceNameElement) {
    serviceNameElement.textContent = serviceName;
  }
  const servicePrice = localStorage.getItem("servicePrice") || 0;
  const formattedPriceService = new Intl.NumberFormat("vi-VN").format(servicePrice) + " đ";
  document.getElementById("servicePrice").textContent = formattedPriceService;

});

function updateUI() {
  const selectedDesire = JSON.parse(localStorage.getItem("selectedDesire"));
  if (selectedDesire !== null) {
    const desireName = selectedDesire.name;
    const desirePrice = selectedDesire.price || 0;
    const formattedPriceDesire = new Intl.NumberFormat("vi-VN").format(desirePrice) + " đ";
    const desireNameElement = document.getElementById("desireName");
    if (desireNameElement) {
      desireNameElement.textContent = desireName;
    }
    const desirePriceElement = document.getElementById("desirePrice");
    if (desirePriceElement) {
      desirePriceElement.textContent = formattedPriceDesire;
    }
  }

  const selectedMaterial = JSON.parse(localStorage.getItem("selectedMaterial"));
  if (selectedMaterial !== null) {
    const materialName = selectedMaterial.name;
    const materialPrice = selectedMaterial.price || 0;
    const formattedPriceMaterial = new Intl.NumberFormat("vi-VN").format(materialPrice) + " đ";
    const materialNameElement = document.getElementById("materialName");
    if (materialNameElement) {
      materialNameElement.textContent = materialName;
    }
    const materialPriceElement = document.getElementById("materialPrice");
    if (materialPriceElement) {
      materialPriceElement.textContent = formattedPriceMaterial;
    }
  }

  const selectedBh = JSON.parse(localStorage.getItem("selectedBh"));
  if (selectedBh !== null) {
    const bhName = selectedBh.name;
    const bhPrice = selectedBh.price || 0;
    const formattedPriceBh = new Intl.NumberFormat("vi-VN").format(bhPrice) + " đ";
    const bhNameElement = document.getElementById("bhName");
    if (bhNameElement) {
      bhNameElement.textContent = bhName;
    }
    const bhPriceElement = document.getElementById("bhPrice");
    if (bhPriceElement) {
      bhPriceElement.textContent = formattedPriceBh;
    }
  }
  if (selectedDesire !== null || selectedMaterial !== null || selectedBh !== null) {
    document.querySelector(".byHand").style.display = "block";
  }
}

function updateNoteTopping() {
  const selectedBh = JSON.parse(localStorage.getItem("selectedBh"));
  const selectedMaterial = JSON.parse(localStorage.getItem("selectedMaterial"));
  const selectedDesire = JSON.parse(localStorage.getItem("selectedDesire"));

  const formatPrice = (price) => new Intl.NumberFormat('vi-VN').format(price) + " đ";

  const noteTopping = [
    selectedBh ? `Bảo hành: ${selectedBh.name} - ${formatPrice(selectedBh.price)}` : "",
    selectedMaterial ? `Vật liệu: ${selectedMaterial.name} - ${formatPrice(selectedMaterial.price)}` : "",
    selectedDesire ? `Mong muốn: ${selectedDesire.name} - ${formatPrice(selectedDesire.price)}` : ""
  ].filter(Boolean).join(" | ");

  $("textarea[name='noteTopping']").val(noteTopping).trigger("change");
}

function updateSelected() {
  const selectedGift = localStorage.getItem("selectedGift") || "Không có quà tặng";
  const selectedGiftElement = document.getElementById("selectedGift");

  if (selectedGiftElement) {
    selectedGiftElement.textContent = selectedGift;
  }
  $("textarea[name='gift']").val(selectedGift).trigger("change");

}
</script>


<style>
.button-select-gift {
  background: rgba(255, 35, 89, .1);
  color: #ff2359;
  padding: 2px 12px;
  border-radius: 6px;

}

.button-select-gift span {
  font-size: 12px;
}
</style>
<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
<div class="relative m-auto rounded-2 bg-white w-full  background-modal p-4 z-[120] booking-service">
  <div class=" overflow-hidden w-full h-full ">
    <div class="flex justify-between items-center w-full">
      <div class="flex items-center w-full" style="flex-direction:column;justify-content:center">
        <div class="text-center w-full text-16" style="font-weight:700">Đặt lịch hẹn</div>
      </div>
      <div class="close-modal  cursor-pointer">
        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
      </div>
    </div>
    <section class="section section-booking-form booking-form booking-row">
      <div class="flex items-center gap-2 mb-2">
        <div class="border-1 border-dashed border-[#ccc] rounded-5 p-2">
          <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/location.svg") ?>" alt="">
        </div>
        <div>
          <div class=" font-semibold">LiA Beauty Center</div>
          <div class="text-10">Số 434, Đường Cao Thắng ( nối dài ), Phường 12, Quận 10, TP.HCM</div>
        </div>
      </div>
      <hr class="my-4" />
      <?= wp_nonce_field( 'booking_order' ); ?>
      <div class="grid grid-cols-2 gap-x-6">
        <div class="lg:col-span-1 col-span-2">
          <h2 class="form-title mb-2" style="font-size:14px">Thông tin khách hàng</h2>
          <input type="hidden" name="postId" value="<?= get_the_ID() ?>" />
          <div class="input-group input-group-left-icon hidden">
            <img class="icon" src="<?= get_theme_file_uri("assets/images/icons/person-gray.svg") ?>" />
            <input class="input" placeholder="Họ và tên khách hàng" name="fullname" />
            <div class="text-12 italic text-red-500 error-fullname"></div>
          </div>
          <div class="input-group input-group-left-icon mb-2">
            <img class="icon" src="<?= get_theme_file_uri("assets/images/icons/phone-gray.svg") ?>" />
            <input class="input" placeholder="Số điện thoại" name="phone" />
            <div class="text-12 italic text-red-500 error-phone"></div>
          </div>
          <div class="input-group input-group-left-icon mb-2">
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
          <label class="flex gap-3 items-center cursor-pointer mb-4">
            <div class="input-checkbox">
              <input type="checkbox" name="foreigner" />
              <div class="icon"></div>
            </div>
            <div class="text-12">Đặt hẹn cho người thân/ bạn bè/ người nước ngoài</div>
          </label>
          <hr class="my-4" />
          <h2 class="form-title mb-2 " style="font-size:14px">Thông tin đơn hàng</h2>
          <div class="input-select mb-4 input-service relative">
            <div class="flex items-center gap-3 justify-between">
              <span id="serviceName" class=" font-bold "></span>
              <span id="servicePrice" class="text-12">
                <?php echo number_format($servicePrice, 0, ',', '.') ?> đ
              </span>
            </div>
            <div class="flex items-center gap-3 justify-between">
              <div class="flex items-center gap-2 button-select-gift">
                <img style="width:20px;height:14px" src="<?= get_theme_file_uri("assets/images/gift1.png") ?>" />
                <span>Quà tặng</span>
              </div>
              <span id="selectedGift" class=" font-bold ">Không có quà tặng</span>
            </div>
            <div class="byHand" style="border:1px dashed #1a5478;padding:8px;border-radius:10px;margin-top:8px">
              <div class="title-topping">Topping</div>
              <button id="edit-topping" class="edit-topping">Sửa</button>
              <div class="flex items-center gap-3 justify-between">
                <span id="desireName" class="text-12 " style="color:#aaa">
                </span>
                <span id="desirePrice" class="text-12 " style="color:#aaa">
                </span>
              </div>
              <div class="flex items-center gap-3 justify-between">
                <span id="materialName" class="text-12 " style="color:#aaa">
                </span>
                <span id="materialPrice" class="text-12 " style="color:#aaa">
                </span>
              </div>
              <div class="flex items-center gap-3 justify-between">
                <span id="bhName" class="text-12 " style="color:#aaa">
                </span>
                <span id="bhPrice" class="text-12 " style="color:#aaa">
                </span>
              </div>
            </div>
          </div>
          <div class="input-select mb-4 input-doctor">
            <select placeholder="Chọn chuyên viên" name="practitioner">
              <option></option>
              <?php foreach ($doctors as $doctor) : ?>
              <option value="<?= $doctor["id"] ?>"><?= $doctor["title"] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="text-12 italic text-red-500 error-doctor"></div>
          </div>
          <hr class="my-4" />
        </div>
        <div class="lg:col-span-1 col-span-2">
          <h2 class="form-title mb-0.5" style="font-size:14px">Lịch hẹn</h2>
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
          <h2 class="form-title mb-2" style="font-size:14px">Ghi chú</h2>
          <div class="input-group input-note mb-0">
            <textarea class="input" rows="3" placeholder="Họ và tên khách hàng" name="note"></textarea>
          </div>
          <div id="noteTopping" class="input-group input-note-topping mb-0" style="display:none">
            <textarea class="input" rows="3" name="noteTopping"></textarea>
          </div>
          <div id="gift" class="input-group input-note-topping mb-0" style="display:none">
            <textarea class="input" rows="3" name="gift"></textarea>
          </div>
        </div>
      </div>

      <!-- <div class="otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4">
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
                        </div> -->
      <div class="modal-success fixed hidden top-0 left-0 right-0 bottom-0 z-[100] p-4" style="z-index: 1200;">
        <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
        <div class="relative z-1 m-auto p-4 rounded-2 bg-white w-full max-w-[600px]">
          <?php get_template_part( 'template-parts/modal', 'popup' ); ?>
        </div>
      </div>
      <div class="h-[80px] flex items-center  fixed bottom-0 left-0 right-0 bg-white bottom-action "
        style=" z-index:10">
        <div class="container">
          <div style="display:flex;align-items:center;gap:12px;justify-content:end">
            <button class="submit btn flex justify-end items-center " style=" background: #009688;
                                        padding: 8px 16px;
                                        border-radius: 24px;
                                        color: #FFF;
                                        font-weight: 700;">
              Xác nhận đặt hẹn : <span id="totalPriceBooking" class=" font-bold"
                style="padding-left:2px;font-size:14px">
                <?php echo number_format($totalPrice, 0, ',', '.') ?> đ
              </span>
            </button>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal-topping');
  const confirmButton = document.getElementById('edit-topping');
  const overlay = modal.querySelector('.bg-black');
  const closeModalButton = modal.querySelector('.close-modal');

  // Mở modal
  confirmButton.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    document.body.classList.add('modal-open'); // Thêm class để chặn scroll
  });

  // Đóng modal
  const closeModal = () => {
    console.log("Đóng modal...");
    if (!modal) {
      console.error("Modal không tồn tại!");
      return;
    }
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
    document.body.classList.remove('modal-open');
  };

  // Đóng khi nhấn nút close
  closeModalButton.addEventListener('click', closeModal);
  overlay.addEventListener('click', closeModal);

  // Lắng nghe sự kiện từ modal
  window.addEventListener("message", function(event) {
    if (event.data.action === "closeModal") {
      closeModal();
    }
  });
});
</script>