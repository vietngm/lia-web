jQuery(function ($) {
	// MỞ MODAL KHI CLICK "MUA NGAY"
	$(document).on("click", ".js-buy-now", function (e) {
		e.preventDefault();

		const $modal = $("#modal-buy-now");
		const postId = $(this).data("id");
		const title = $(this).data("title");
		const price = parseInt($(this).data("price")) || 0;
		const image =
			$(this).data("image") ||
			"<?= get_theme_file_uri('assets/images/noimg64.png') ?>";
		const deliveryFee = 0; // Mặc định = 0
		const total = price + deliveryFee;

		if (!$modal.length) return;

		// Reset lựa chọn cũ
		$modal.find("input[name='deliveryMethod']").prop("checked", false);
		$modal.find("input[name='paymentMethod']").prop("checked", false);
		$modal
			.find(
				"input[name='fullname'], input[name='phone'], textarea[name='address']"
			)
			.val("");
		$modal.find(".has-error").text("");

		// Update thông tin sản phẩm trong modal
		$modal.find(".modal-product-info .title").text(title);
		$modal
			.find(".modal-product-info .price")
			.html(price.toLocaleString("vi-VN") + " <small>đ</small>");
		$modal.find(".modal-product-thumb img").attr("src", image);

		// Update chi tiết hóa đơn ban đầu
		$modal
			.find(".modal-invoice .value")
			.first()
			.html(price.toLocaleString("vi-VN") + " <small>đ</small>");
		$modal
			.find(".modal-invoice-item:nth-child(2) .value")
			.html(deliveryFee.toLocaleString("vi-VN") + " <small>đ</small>");
		$modal
			.find(".modal-invoice-total .value")
			.html(total.toLocaleString("vi-VN") + " <small>đ</small>");
		$modal
			.find(".modal-action-total .value")
			.html(total.toLocaleString("vi-VN") + " <small>đ</small>");

		// Gán lại postId vào input hidden nếu cần
		$modal.find("input[name='postId']").val(postId);

		// Mở modal
		if (!$modal.hasClass("show")) {
			$modal.css("display", "flex");
			setTimeout(() => $modal.addClass("show"), 10);
			$("html, body").css("overflow", "hidden");
		}
	});

	// ĐÓNG MODAL - nút đóng
	$(document).on("click", ".close-modal", function () {
		const $modal = $(this).closest("[id^='modal-buy-now']");
		if (!$modal.length) return;

		$modal.removeClass("show");
		setTimeout(() => {
			$modal.css("display", "none");
			$("html, body").css("overflow", "");
		}, 300);
	});

	// ĐÓNG MODAL - click nền đen
	$(document).on("click", "[id^='modal-buy-now']", function (e) {
		if (e.target === this) {
			$(this).find(".close-modal").trigger("click");
		}
	});

	// CẬP NHẬT PHÍ SHIP KHI CHỌN PHƯƠNG THỨC GIAO HÀNG
	$(document).on("change", "[name='deliveryMethod']", function () {
		const $modal = $("#modal-buy-now");
		const deliveryPrice = parseInt($(this).data("price")) || 0;

		// Lấy giá sản phẩm từ modal
		const priceText = $modal
			.find(".modal-product-info .price")
			.text()
			.replace(/[^\d]/g, "");
		const productPrice = parseInt(priceText) || 0;

		const total = productPrice + deliveryPrice;

		// Cập nhật các chỗ hiển thị tổng tiền
		$modal
			.find(".modal-invoice-item:nth-child(2) .value")
			.html(deliveryPrice.toLocaleString("vi-VN") + " <small>đ</small>");
		$modal
			.find(".modal-invoice-total .value")
			.html(total.toLocaleString("vi-VN") + " <small>đ</small>");
		$modal
			.find(".modal-action-total .value")
			.html(total.toLocaleString("vi-VN") + " <small>đ</small>");
	});

	// XỬ LÝ SUBMIT FORM ĐẶT HÀNG
	$(document).on("click", ".js-submit-buy-now", function (e) {
		e.preventDefault();

		const $modal = $(this).closest("[id^='modal-buy-now']");
		const postId = $modal.find('[name="postId"]').val();

		let hasError = false;
		let errorMessages = [];

		const fullname = $modal.find('[name="fullname"]').val().trim();
		const phone = $modal.find('[name="phone"]').val().trim();
		const address = $modal.find('[name="address"]').val().trim();
		const payment = $modal.find('[name="paymentMethod"]:checked').val();
		const $deliveryOption = $modal.find('[name="deliveryMethod"]:checked');
		const delivery = $deliveryOption.val();
		const deliveryPrice = parseInt($deliveryOption.data("price")) || 0;

		// DOM các lỗi
		const errorFullname = $modal.find(".error-fullname");
		const errorPhone = $modal.find(".error-phone");
		const errorPayment = $modal.find(".error-payment");
		const errorAddress = $modal.find(".error-address");
		const errorDelivery = $modal.find(".error-delivery");

		// Reset lỗi
		errorFullname.text("");
		errorPhone.text("");
		errorPayment.text("");
		errorAddress.text("");
		errorDelivery.text("");

		// Validate
		if (!fullname) {
			errorFullname.text("Vui lòng cho biết họ tên.");
			hasError = true;
			errorMessages.push("Vui lòng cho biết họ tên.");
		}

		if (!phone) {
			errorPhone.text("Vui lòng nhập số điện thoại.");
			hasError = true;
			errorMessages.push("Vui lòng nhập số điện thoại.");
		}

		if (!address) {
			errorAddress.text("Vui lòng cho biết địa chỉ giao hàng.");
			hasError = true;
			errorMessages.push("Vui lòng cho biết địa chỉ giao hàng.");
		}

		if (!delivery) {
			errorDelivery.text("Vui lòng chọn phương thức giao hàng.");
			hasError = true;
			errorMessages.push("Vui lòng chọn phương thức giao hàng.");
		}

		if (!payment) {
			errorPayment.text("Vui lòng chọn hình thức thanh toán.");
			hasError = true;
			errorMessages.push("Vui lòng chọn hình thức thanh toán.");
		}

		if (hasError) {
			Toastify({
				text: errorMessages.join("\n"),
				duration: 3000,
				newWindow: true,
				close: true,
				gravity: "top",
				position: "center",
				stopOnFocus: true,
				style: {
					background: "#ef4444",
				},
			}).showToast();
			return;
		}

		// Gửi dữ liệu nếu hợp lệ
		const dataSubmit = {
			fullname: fullname,
			phone: phone,
			address: address,
			postId: postId,
			delivery: delivery,
			deliveryPrice: deliveryPrice,
			payment: payment,
		};

		submitOrderForm(dataSubmit, $modal);
	});

	function submitOrderForm(dataInvestment, $modal) {
		const $modelConsultationSuccess = $(document).find(
			".modal-consultation-success"
		);
		const data = Object.assign(
			{
				action: "donhang_form",
				_wpnonce: $modal ? $modal.find('[name="_wpnonce"]').val() : "",
			},
			dataInvestment
		);
		const loadingToastify = Toastify({
			text: "Đang gửi thông tin...",
			duration: -1,
			newWindow: true,
			close: true,
			gravity: "top",
			position: "center",
			stopOnFocus: true,
			style: {
				background: "#fff",
				color: "#333",
			},
		});
		loadingToastify.showToast();

		$.ajax({
			url: AJAX_URL,
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function (result) {
				loadingToastify.hideToast();

				if (result.success) {
					$(document).find(".close-modal").click();
					$(document).find(".modal-close").click();

					if (result.redirect) {
						window.location.href = result.redirect;
					} else {
						$modelConsultationSuccess.removeClass("hidden").addClass("flex");
						// reset();
						setTimeout(function () {
							$modelConsultationSuccess.addClass("hidden").removeClass("flex");
							window.location.href = "/";
						}, 3000);
					}

					// if (success) success();
				} else {
					Toastify({
						text: result.message || "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
					if (error) error();
				}
			},
			error: function () {
				loadingToastify.hideToast();
				submitting = false;
				Toastify({
					text: "Đã xảy ra lỗi",
					duration: 3000,
					newWindow: true,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "#ef4444",
					},
				}).showToast();
				if (error) error();
			},
		});
	}
});
