jQuery(function ($) {
	const $root = $(this);

	$(document).on("click", ".register-button", function () {
		const packageCapital = $("#investment-capital .selected-option").text();
		const packageInvestment = $("#investment-package .selected-option").text();
		const paymentPolicy = $("#payment-policy .selected-option").text();
		$(document).find('[name="packageCapital"]').val(packageCapital);
		$(document).find(".package-info .package-capital").text(packageCapital);

		$(document).find('[name="packageInvestment"]').val(packageInvestment);
		$(document)
			.find(".package-info .package-investment")
			.text(packageInvestment);

		$(document).find('[name="paymentPolicy"]').val(paymentPolicy);
		$(document).find(".package-info .package-policy").text(paymentPolicy);
	});

	const $modelConsultationSuccess = $(document).find(
		".modal-consultation-success"
	);

	$(document).on("click", ".js-submit-consultation", function () {
		let hasError = false;
		let errorMessages = [];

		const fullname = $root.find('[name="fullname"]').val();
		const phone = $root.find('[name="phone"]').val();
		const email = $root.find('[name="email"]').val();
		const message = $root.find('[name="message"]').val();

		const packagePrice = $root.find('[name="packagePrice"]').val();
		const packageBed = $root.find('[name="packageBed"]').val();
		const packageMetric = $root.find('[name="packageMetric"]').val();
		const packageName = $root.find('[name="packageName"]').val();

		const packageCapital = $root.find('[name="packageCapital"]').val();
		const packageInvestment = $root.find('[name="packageInvestment"]').val();
		const paymentPolicy = $root.find('[name="paymentPolicy"]').val();

		const errorFullname = $root.find(".error-fullname");
		const errorPhone = $root.find(".error-phone");
		const errorEmail = $root.find(".error-email");

		let dataConsultation = {
			fullname: fullname,
			phone: phone,
			email: email,
			message: message,
			packagePrice: packagePrice + " Triệu",
			packageBed: packageBed + " giường",
			packageMetric: packageMetric,
			packageName: packageName,
			packageCapital: packageCapital,
			packageInvestment: packageInvestment,
			paymentPolicy: paymentPolicy,
		};

		if (!fullname) {
			hasError = true;
			errorMessages.push("Vui lòng cho biết họ tên.");
		}

		hasError |= validateField(
			fullname,
			errorFullname,
			"Vui lòng cho biết họ tên."
		);

		if (!phone) {
			hasError = true;
			errorMessages.push("Vui lòng nhập số điện thoại.");
		}
		hasError |= validateField(
			phone,
			errorPhone,
			"Vui lòng nhập số điện thoại."
		);

		if (!email) {
			hasError = true;
			errorMessages.push("Vui lòng cho biết địa chỉ mail.");
		}

		hasError |= validateField(
			phone,
			errorEmail,
			"Vui lòng cho biết địa chỉ mail."
		);

		if (hasError) {
			Toastify({
				text:
					errorMessages.length === 3
						? "Vui lòng nhập đầy đủ thông tin."
						: errorMessages.join("\n"),
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

		submitForm(dataConsultation);
	});

	function submitForm(dataConsultation, success, error) {
		const data = Object.assign(
			{
				action: "consultation_form",
				_wpnonce: $root.find('[name="_wpnonce"]').val(),
			},
			dataConsultation
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
					$("#registration-modal .close-modal").click();
					$modelConsultationSuccess.removeClass("hidden").addClass("flex");

					reset();
					setTimeout(function () {
						$modelConsultationSuccess.addClass("hidden").removeClass("flex");
						window.location.href = "/";
					}, 3000);

					if (success) success();
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

	function validateField(field, errorElement, errorMessage) {
		if (!field) {
			errorElement.removeClass("hidden");
			errorElement.text(errorMessage);
			return true;
		} else {
			errorElement.empty();
			errorElement.addClass("hidden");
			return false;
		}
	}

	function reset() {
		$root.find('[name="fullname"]').val();
		$root.find('[name="phone"]').val();
		$root.find('[name="email"]').val();
		$root.find('[name="message"]').val();
	}
});
