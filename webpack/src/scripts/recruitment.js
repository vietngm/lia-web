jQuery(function ($) {
	const $root = $(this);
	const experience = document.getElementById("experience");
	const location = document.getElementById("location");
	const salary = document.getElementById("salary");
	const dropdowns = [experience, location, salary];

	// Setup each dropdown
	dropdowns.forEach((dropdown) => {
		const selectedOption = dropdown.querySelector(".selected-option");
		const options = dropdown.querySelector(".dropdown-options");

		// Toggle dropdown when clicked
		selectedOption.addEventListener("click", function (e) {
			e.stopPropagation();

			// Close all other dropdowns first
			dropdowns.forEach((d) => {
				if (d !== dropdown) {
					d.querySelector(".dropdown-options").style.display = "none";
					d.classList.remove("active");
				}
			});

			// Toggle this dropdown
			options.style.display =
				options.style.display === "block" ? "none" : "block";
			dropdown.classList.toggle("active");
		});

		// Handle option selection
		options.querySelectorAll(".dropdown-option").forEach((option) => {
			option.addEventListener("click", function () {
				// Update selected option text
				selectedOption.textContent = this.textContent;

				// Update selected class
				options.querySelectorAll(".dropdown-option").forEach((opt) => {
					opt.classList.remove("selected");
				});
				this.classList.add("selected");

				// Close dropdown
				options.style.display = "none";
				dropdown.classList.remove("active");

				// Update grid with combined selections
				// updateGridFromSelections();

				// Update deposit modal summary
				// updateDepositSummary();
			});
		});
	});

	// Close all dropdowns when clicking outside
	document.addEventListener("click", function () {
		dropdowns.forEach((dropdown) => {
			dropdown.querySelector(".dropdown-options").style.display = "none";
			dropdown.classList.remove("active");
		});
	});

	// const $modelConsultationSuccess = $(document).find(
	// 	".modal-consultation-success"
	// );

	$(document).on("click", ".js-recruitment", function () {
		let hasError = false;
		let errorMessages = [];

		console.log("submit recruitment");

		// const fullname = $root.find('[name="fullname"]').val();
		// const phone = $root.find('[name="phone"]').val();
		// const email = $root.find('[name="email"]').val();
		// const message = $root.find('[name="message"]').val();

		// const packagePrice = $root.find('[name="packagePrice"]').val();
		// const packageBed = $root.find('[name="packageBed"]').val();
		// const packageMetric = $root.find('[name="packageMetric"]').val();
		// const packageName = $root.find('[name="packageName"]').val();

		// const packageCapital = $root.find('[name="packageCapital"]').val();
		// const packageInvestment = $root.find('[name="packageInvestment"]').val();
		// const paymentPolicy = $root.find('[name="paymentPolicy"]').val();

		// const errorFullname = $root.find(".error-fullname");
		// const errorPhone = $root.find(".error-phone");
		// const errorEmail = $root.find(".error-email");

		// let dataConsultation = {
		// 	fullname: fullname,
		// 	phone: phone,
		// 	email: email,
		// 	message: message,
		// 	packagePrice: packagePrice,
		// 	packageBed: packageBed,
		// 	packageMetric: packageMetric,
		// 	packageName: packageName,
		// 	packageCapital: packageCapital,
		// 	packageInvestment: packageInvestment,
		// 	paymentPolicy: paymentPolicy,
		// };

		// if (!fullname) {
		// 	hasError = true;
		// 	errorMessages.push("Vui lòng cho biết họ tên.");
		// }

		// hasError |= validateField(
		// 	fullname,
		// 	errorFullname,
		// 	"Vui lòng cho biết họ tên."
		// );

		// if (!phone) {
		// 	hasError = true;
		// 	errorMessages.push("Vui lòng nhập số điện thoại.");
		// }
		// hasError |= validateField(
		// 	phone,
		// 	errorPhone,
		// 	"Vui lòng nhập số điện thoại."
		// );

		// if (!email) {
		// 	hasError = true;
		// 	errorMessages.push("Vui lòng cho biết địa chỉ mail.");
		// }

		// hasError |= validateField(
		// 	phone,
		// 	errorEmail,
		// 	"Vui lòng cho biết địa chỉ mail."
		// );

		// if (hasError) {
		// 	Toastify({
		// 		text:
		// 			errorMessages.length === 3
		// 				? "Vui lòng nhập đầy đủ thông tin."
		// 				: errorMessages.join("\n"),
		// 		duration: 3000,
		// 		newWindow: true,
		// 		close: true,
		// 		gravity: "top",
		// 		position: "center",
		// 		stopOnFocus: true,
		// 		style: {
		// 			background: "#ef4444",
		// 		},
		// 	}).showToast();
		// 	return;
		// }

		// submitForm(dataConsultation);
	});

	// function submitForm(dataConsultation, success, error) {
	// 	const data = Object.assign(
	// 		{
	// 			action: "consultation_form",
	// 			_wpnonce: $root.find('[name="_wpnonce"]').val(),
	// 		},
	// 		dataConsultation
	// 	);

	// 	const loadingToastify = Toastify({
	// 		text: "Đang gửi thông tin...",
	// 		duration: -1,
	// 		newWindow: true,
	// 		close: true,
	// 		gravity: "top",
	// 		position: "center",
	// 		stopOnFocus: true,
	// 		style: {
	// 			background: "#fff",
	// 			color: "#333",
	// 		},
	// 	});
	// 	loadingToastify.showToast();

	// 	$.ajax({
	// 		url: AJAX_URL,
	// 		type: "POST",
	// 		dataType: "JSON",
	// 		data: data,
	// 		success: function (result) {
	// 			loadingToastify.hideToast();

	// 			if (result.success) {
	// 				$(document).find(".close-modal").click();
	// 				$(document).find(".modal-close").click();

	// 				$modelConsultationSuccess.removeClass("hidden").addClass("flex");

	// 				reset();
	// 				setTimeout(function () {
	// 					$modelConsultationSuccess.addClass("hidden").removeClass("flex");
	// 					window.location.href = "/";
	// 				}, 3000);

	// 				if (success) success();
	// 			} else {
	// 				Toastify({
	// 					text: result.message || "Đã xảy ra lỗi",
	// 					duration: 3000,
	// 					newWindow: true,
	// 					close: true,
	// 					gravity: "top",
	// 					position: "center",
	// 					stopOnFocus: true,
	// 					style: {
	// 						background: "#ef4444",
	// 					},
	// 				}).showToast();
	// 				if (error) error();
	// 			}
	// 		},
	// 		error: function () {
	// 			loadingToastify.hideToast();
	// 			submitting = false;
	// 			Toastify({
	// 				text: "Đã xảy ra lỗi",
	// 				duration: 3000,
	// 				newWindow: true,
	// 				close: true,
	// 				gravity: "top",
	// 				position: "center",
	// 				stopOnFocus: true,
	// 				style: {
	// 					background: "#ef4444",
	// 				},
	// 			}).showToast();
	// 			if (error) error();
	// 		},
	// 	});
	// }

	// function validateField(field, errorElement, errorMessage) {
	// 	if (!field) {
	// 		errorElement.removeClass("hidden");
	// 		errorElement.text(errorMessage);
	// 		return true;
	// 	} else {
	// 		errorElement.empty();
	// 		errorElement.addClass("hidden");
	// 		return false;
	// 	}
	// }

	// function reset() {
	// 	$root.find('[name="fullname"]').val();
	// 	$root.find('[name="phone"]').val();
	// 	$root.find('[name="email"]').val();
	// 	$root.find('[name="message"]').val();
	// }
});
