<?php

function rate_limit ($cap = 2) {
    $stamp_init = date("Y-m-d H:i:s");
    if( !isset( $_SESSION['FIRST_REQUEST_TIME'] ) ){
            $_SESSION['FIRST_REQUEST_TIME'] = $stamp_init;
    }
    $first_request_time = $_SESSION['FIRST_REQUEST_TIME'];
    $stamp_expire = date( "Y-m-d H:i:s", strtotime( $first_request_time )+( 60 ) );
    if( !isset( $_SESSION['REQ_COUNT'] ) ){
            $_SESSION['REQ_COUNT'] = 0;
    }
    $req_count = $_SESSION['REQ_COUNT'];
    $req_count++;
    if( $stamp_init > $stamp_expire ){//Expired
            $req_count = 1;
            $first_request_time = $stamp_init;
    }
    $_SESSION['REQ_COUNT'] = $req_count;
    $_SESSION['FIRST_REQUEST_TIME'] = $first_request_time;
    header('X-RateLimit-Limit: '.cap);
    header('X-RateLimit-Remaining: ' . ( cap-$req_count ) );
    if( $req_count > $cap){//Too many requests
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Bạn đang gửi quá nhiều yêu cầu, vui lòng đợi trong giây lát."
			)
		);
		die();
    }
}

function verify_booking_form() {
	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'booking_order' ) ) {
		log_error("verify_booking_form", "nonce");
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ"
			)
		);
		die();
	}

	$postId = isset($_POST["postId"]) ? $_POST["postId"] : "";
	$fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
	$referralCode = isset($_POST["referralCode"]) ? $_POST["referralCode"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$foreigner = isset($_POST["foreigner"]) ? $_POST["foreigner"] : false;
	$doctorId = isset($_POST["doctorId"]) ? $_POST["doctorId"] : "";
	$serviceId = isset($_POST["serviceId"]) ? $_POST["serviceId"] : "";
	$toppingId = isset($_POST["toppingId"]) ? $_POST["toppingId"] : "";
	$date = isset($_POST["date"]) ? $_POST["date"] : "";
	$time = isset($_POST["time"]) ? $_POST["time"] : "";
	$note = isset($_POST["note"]) ? $_POST["note"] : "";
	$noteTopping = isset($_POST["noteTopping"]) ? $_POST["noteTopping"] : "";
	$selectedGift = isset($_POST["selectedGift"]) ? $_POST["selectedGift"] : "";
	$noteForLiA = isset($_POST["noteForLiA"]) ? $_POST["noteForLiA"] : "";

	// Check format date time
	if (DateTime::createFromFormat('Y-m-d H:i', "$date $time") === false) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Không đúng định dạng thời gian đặt lịch"
			)
		);
		die();
	}
	// Check doctor
	$doctor = get_post($doctorId);
	$service = get_post($serviceId);
	$topping = get_term($toppingId, "service-topping");

	if (!$doctor || $doctor->post_type != "practitioner") {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Chuyên viên không tồn tại"
			)
		);
		die();
	}

	if (!$service || $service->post_type != "service") {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Dịch vụ không tồn tại"
			)
		);
		die();
	}

	if ($toppingId && !$topping) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Topping không tồn tại"
			)
		);
		die();
	}

	// Check doctor has service
	$serviceDoctorIds = get_field("doctors", $serviceId);
	if (!in_array($doctorId, $serviceDoctorIds)) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Dịch vụ không đúng"
			)
		);
		die();
	}

	// Check doctor has topping
	$prices = get_field("prices", $serviceId) ?? [];
	$toppingPrice = 0;
	foreach ($prices as $price) {
		if ($price["topping"] == $toppingId) {
			$toppingPrice = $price["origin"];
			break;
		}
	}
	if ($toppingId && !$toppingPrice) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Topping không đúng"
			)
		);
		die();
	}

	// Get service price
	$servicePrice = (int) get_field("price", $serviceId);

	// Check booking exited
	$post_bookings = get_posts(array(
		"post_type" => "booking",
		"posts_per_page" => 1,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'date',
				'value' => $date,
				'compare' => '=',
				'type' => 'CHAR'
			),
			array(
				'key' => 'time',
				'value' => $time,
				'compare' => '=',
				'type' => 'CHAR'
			),
			array(
				'key' => 'doctor',
				'value' => $doctorId,
				'compare' => '=',
				'type' => 'CHAR'
			),
		)
	));
	if (count($post_bookings) > 0) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Lịch đã được đặt, vui lòng chọn thời gian khác"
			)
		);
		die();
	}
}

function verify_booking_form_otp() {
	$otp = isset($_POST["otp"]) ? $_POST["otp"] : "";
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry'])) {
        if (time() > $_SESSION['otp_expiry']) {
            // OTP đã hết hạn
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiry']);
			echo json_encode(
				array(
					'success'=>false,
					"message" => "OTP đã hết hạn. Vui lòng yêu cầu mã mới."
				)
			);
			die();
        } elseif ($otp == $_SESSION['otp']) {
            // OTP hợp lệ
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiry']);
            
        } else {
            // OTP không đúng
			echo json_encode(
				array(
					'success'=>false,
					"message" => "OTP không hợp lệ. Vui lòng thử lại."
				)
			);
			die();
        }
    } else {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Không có OTP nào được tạo. Vui lòng yêu cầu mã mới."
			)
		);
    }
}


function ajax_booking_form(){
	verify_booking_form();
	// verify_booking_form_otp();

	$postId = isset($_POST["postId"]) ? $_POST["postId"] : "";
	$fullname = isset($_POST["note"]) ? $_POST["note"] : "";
	$referralCode = isset($_POST["referralCode"]) ? $_POST["referralCode"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$foreigner = isset($_POST["foreigner"]) ? $_POST["foreigner"] : false;
	$doctorId = isset($_POST["doctorId"]) ? $_POST["doctorId"] : "";
	$serviceId = isset($_POST["serviceId"]) ? $_POST["serviceId"] : "";
	$toppingId = isset($_POST["toppingId"]) ? $_POST["toppingId"] : "";
	$date = isset($_POST["date"]) ? $_POST["date"] : "";
	$time = isset($_POST["time"]) ? $_POST["time"] : "";
	$note = isset($_POST["note"]) ? $_POST["note"] : "";
	$noteTopping = isset($_POST["noteTopping"]) ? $_POST["noteTopping"] : "";
	$selectedGift = isset($_POST["selectedGift"]) ? $_POST["selectedGift"] : "";
	$noteForLiA = isset($_POST["noteForLiA"]) ? $_POST["noteForLiA"] : "";

	$data_id = wp_insert_post( 
		array(
			'post_title'	=> "$fullname - $date $time - $phone",
			"post_type" => "booking",
			"post_status" => "publish",
			"meta_input" => array(
				"fullname" => $fullname,
				"phone" => $phone,
				"foreigner" => $foreigner,
				"doctor" => $doctorId,
				"service" => $serviceId,
				"topping" => $toppingId,
				"date" => $date,
				"time" => $time,
				"note" => $noteForLiA,
				"noteTopping"=> $noteTopping,
				"selectedGift" => $selectedGift,
				"referralCode" => $referralCode,
			),
		)
	);

	$date_formatted = date( "d/m/Y", strtotime($date) );
	// send_sms_booking_success($phone, $date_formatted);

	include('sync-data.php');
	
	echo json_encode(
		array(
			'success' => true,	
			"message" => "Đăng ký thành công, vui lòng kiểm tra SMS.",
			"data" => $data_booking,
			"data_id"=>$data_id
		)
	);

	// print_r($data_id);
	update_post_meta($data_id, 'booking_status', 1);

	die();
}

add_action( 'wp_ajax_booking_form', 'ajax_booking_form');
add_action( 'wp_ajax_nopriv_booking_form', 'ajax_booking_form');

function ajax_booking_form_otp(){
	verify_booking_form();

	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$otp = random_int(100000, 999999) . "";
	$_SESSION['otp'] = $otp;
	$_SESSION['otp_expiry'] = time() + 600;

	// Send otp
	rate_limit();
	$content = send_sms_otp($phone, $otp);
	if ($content->success > 0) {
		echo json_encode(
			array(
				'success' => true,	
				"message" => "Đã gửi SMS.",
			)
		);
		die();
	}
	else {
		echo json_encode(
			array(
				'success' => false,	
				"message" => "Gửi SMS không thành công.",
				"data" => $content,
			)
		);
		die();
	}
}

add_action( 'wp_ajax_booking_form_otp', 'ajax_booking_form_otp');
add_action( 'wp_ajax_nopriv_booking_form_otp', 'ajax_booking_form_otp');

function ajax_doctor_contact_form(){
	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'doctor_contact' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ"
			)
		);
		die();
	}

	$doctorId = isset($_POST["doctorId"]) ? $_POST["doctorId"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";

	// Check doctor
	$doctor = get_post($doctorId);

	if (!$doctor || $doctor->post_type != "practitioner") {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Chuyên viên không tồn tại"
			)
		);
		die();
	}

	$data_id = wp_insert_post( 
		array(
			'post_title'	=> "$phone",
			"post_type" => "doctor-contact-data",
			"post_status" => "publish",
			"meta_input" => array(
				"phone" => $phone,
				"doctor" => $doctorId,
			),
		)
	);
	
	echo json_encode(
		array(
			'success' => true,
			'doctorPhone' => get_field("phone", $doctorId),
			"message" => "Gửi thông tin thành công."
		)
	);
	die();
}

add_action( 'wp_ajax_doctor_contact_form', 'ajax_doctor_contact_form');
add_action( 'wp_ajax_nopriv_doctor_contact_form', 'ajax_doctor_contact_form');

function ajax_price_form(){
	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'price_form' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ"
			)
		);
		die();
	}

	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$serviceCategoryId = isset($_POST["serviceCategoryId"]) ? $_POST["serviceCategoryId"] : "";
	$age = isset($_POST["age"]) ? $_POST["age"] : "";
	$status = isset($_POST["status"]) ? $_POST["status"] : "";
	$desire = isset($_POST["desire"]) ? $_POST["desire"] : "";

	$data_id = wp_insert_post( 
		array(
			'post_title'	=> "$phone",
			"post_type" => "price-data",
			"post_status" => "publish",
			"meta_input" => array(
				"phone" => $phone,
				"serviceCategoryId" => $serviceCategoryId,
				"age" => $age,
				"status" => $status,
				"desire" => $desire,
			),
		)
	);
	
	echo json_encode(
		array(
			'success' => true,
			"message" => "Gửi thông tin thành công."
		)
	);
	die();
}

add_action( 'wp_ajax_price_form', 'ajax_price_form');
add_action( 'wp_ajax_nopriv_price_form', 'ajax_price_form');

function ajax_booking_price_form(){
	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'booking_price_form' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ"
			)
		);
		die();
	}

	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$serviceCategoryId = isset($_POST["serviceCategoryId"]) ? $_POST["serviceCategoryId"] : "";
	$age = isset($_POST["age"]) ? $_POST["age"] : "";
	$status = isset($_POST["status"]) ? $_POST["status"] : "";
	$desire = isset($_POST["desire"]) ? $_POST["desire"] : "";

	$data_id = wp_insert_post( 
		array(
			'post_title'	=> "$phone",
			"post_type" => "booking-price-data",
			"post_status" => "publish",
			"meta_input" => array(
				"phone" => $phone,
				"serviceCategoryId" => $serviceCategoryId,
				"age" => $age,
				"status" => $status,
				"desire" => $desire,
			),
		)
	);
	
	echo json_encode(
		array(
			'success' => true,
			"message" => "Đặt lịch thành công, tư vấn viên sẽ liên hệ với bạn sớm nhất."
		)
	);
	die();
}

add_action( 'wp_ajax_booking_price_form', 'ajax_booking_price_form');
add_action( 'wp_ajax_nopriv_booking_price_form', 'ajax_booking_price_form');

function ajax_buffet_form() {
    // Kiểm tra nonce để bảo mật
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'buffet_form' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ"
			)
		);
		die();
	}


    // Lấy dữ liệu từ form
	$order_type = sanitize_text_field($_POST['order_type']); // Loại đơn hàng
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $buffetPackageId = isset($_POST['buffet_package']) ? sanitize_text_field($_POST['buffet_package']) : '';


    // Kiểm tra dữ liệu
    if (empty($name) || empty($phone) || empty($buffetPackageId)) {
        wp_send_json_error(array('message' => 'Vui lòng nhập đầy đủ thông tin.'));
    }

    // Lưu thông tin vào database (ví dụ: tạo bài viết mới)
    $post_id = wp_insert_post(array(
        'post_title'   => "$name - $phone",
        'post_type'    => 'buffet', // Thay bằng post type của bạn
        'post_status'  => 'publish',
        'meta_input'   => array(
            'name'            => $name,
            'phone'           => $phone,
            'buffet_package' => $buffetPackageId,
			'order_type'      => $order_type, // Thêm trường "order_type"
        ),
    ));

    if ($post_id) {
        wp_send_json_success(array('message' => 'Gửi thông tin thành công!'));
    } else {
        wp_send_json_error(array('message' => 'Không thể lưu thông tin. Vui lòng thử lại.'));
    }
}

add_action('wp_ajax_buffet_form', 'ajax_buffet_form');
add_action('wp_ajax_nopriv_buffet_form', 'ajax_buffet_form');

function ajax_buffet_form_people() {
    // Kiểm tra nonce để bảo mật
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'buffet_form_people' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ"
			)
		);
		die();
	}

    // Lấy dữ liệu từ form
	$order_type = sanitize_text_field($_POST['order_type']); // Loại đơn hàng
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $buffetPackageId = isset($_POST['buffet_package']) ? sanitize_text_field($_POST['buffet_package']) : '';
	$quantity = isset($_POST['so_luong']) ? intval($_POST['so_luong']) : 0;

	if ($quantity <= 0) {
        wp_send_json_error(['message' => 'Số lượng không hợp lệ']);
    }
    // Kiểm tra dữ liệu
    if (empty($name) || empty($phone) || empty($buffetPackageId)) {
        wp_send_json_error(array('message' => 'Vui lòng nhập đầy đủ thông tin.'));
    }

    // Lưu thông tin vào database (ví dụ: tạo bài viết mới)
    $post_id = wp_insert_post(array(
        'post_title'   => "$name - $phone",
        'post_type'    => 'buffet', // Thay bằng post type của bạn
        'post_status'  => 'publish',
        'meta_input'   => array(
            'name'            => $name,
            'phone'           => $phone,
            'buffet_package' => $buffetPackageId,
			'so_luong' => $quantity,
			'order_type'      => $order_type, // Thêm trường "order_type"
			
        ),
    ));

    if ($post_id) {
        wp_send_json_success(array('message' => 'Gửi thông tin thành công!'));
    } else {
        wp_send_json_error(array('message' => 'Không thể lưu thông tin. Vui lòng thử lại.'));
    }
}

add_action('wp_ajax_buffet_form_people', 'ajax_buffet_form_people');
add_action('wp_ajax_nopriv_buffet_form_people', 'ajax_buffet_form_people');


// Truyền URL AJAX đến file JavaScript