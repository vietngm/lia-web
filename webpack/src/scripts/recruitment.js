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

		const locationText = $root.find("#location .selected-option").text();
		const salaryText = $root.find("#salary .selected-option").text();
		const experienceText = $root.find("#experience .selected-option").text();
		$root
			.find('[name="location"')
			.val(locationText == "Vui lòng chọn" ? "" : locationText);

		$root
			.find('[name="experience"')
			.val(experienceText == "Vui lòng chọn" ? "" : experienceText);

		$root
			.find('[name="salary"')
			.val(salaryText == "Vui lòng chọn" ? "" : salaryText);

		const fullname = $root.find('[name="fullname"]').val();
		const phone = $root.find('[name="phone"]').val();
		const email = $root.find('[name="email"]').val();
		const experience = $root.find('[name="experience"').val();
		const location = $root.find('[name="location"').val();
		const salary = $root.find('[name="salary"').val();
		// const message = $root.find('[name="message"]').val();

		// const packagePrice = $root.find('[name="packagePrice"]').val();
		// const packageBed = $root.find('[name="packageBed"]').val();
		// const packageMetric = $root.find('[name="packageMetric"]').val();
		// const packageName = $root.find('[name="packageName"]').val();

		// const packageCapital = $root.find('[name="packageCapital"]').val();
		// const packageInvestment = $root.find('[name="packageInvestment"]').val();
		// const paymentPolicy = $root.find('[name="paymentPolicy"]').val();

		console.log({ location });

		const errorFullname = $root.find(".error-fullname");
		const errorPhone = $root.find(".error-phone");
		const errorEmail = $root.find(".error-email");
		const errorLocation = $root.find(".error-location");
		const errorExperience = $root.find(".error-experience");
		const errorSalary = $root.find(".error-salary");

		let dataRecruitment = {
			fullname: fullname,
			phone: phone,
			email: email,
			location: location,
			experience: experience,
			salary: salary,
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
			email,
			errorEmail,
			"Vui lòng cho biết địa chỉ mail."
		);

		if (!location) {
			hasError = true;
			errorMessages.push("Vui lòng chọn khu vực.");
		}

		hasError |= validateField(
			location,
			errorLocation,
			"Vui lòng chọn khu vực."
		);

		if (!experience) {
			hasError = true;
			errorMessages.push("Vui lòng chọn kinh nghiệm.");
		}

		hasError |= validateField(
			experience,
			errorExperience,
			"Vui lòng chọn kinh nghiệm."
		);

		if (!salary) {
			hasError = true;
			errorMessages.push("Vui lòng chọn mức lương.");
		}

		hasError |= validateField(salary, errorSalary, "Vui lòng chọn mức lương.");

		if (hasError) {
			Toastify({
				text:
					errorMessages.length === 6
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

		// submitForm(dataRecruitment);
	});

	// function submitForm(dataRecruitment, success, error) {
	// 	const data = Object.assign(
	// 		{
	// 			action: "recruitment_form",
	// 			_wpnonce: $root.find('[name="_wpnonce"]').val(),
	// 		},
	// 		dataRecruitment
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

	// 				$modelRecruitmentSuccess.removeClass("hidden").addClass("flex");

	// 				reset();
	// 				setTimeout(function () {
	// 					$modelRecruitmentSuccess.addClass("hidden").removeClass("flex");
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
		$root.find('[name="location"]').val();
		$root.find('[name="salary"]').val();
		$root.find('[name="experience"]').val();
	}
});
