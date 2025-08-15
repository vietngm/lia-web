jQuery(function ($) {
	const $modelConsultationSuccess = $(document).find(
		".modal-consultation-success"
	);

	$(document).on("click", ".js-register-investment", function (e) {
		e.preventDefault();

		// const $modal = $("#modal-investment");
		// const postId = $modal.attr("data-id");
		// const postId = $(this).data("id");

		const $modal = $("#modal-investment");
		const postId = $modal.attr("data-id");

		console.log("postId", postId);

		let hasError = false;
		let errorMessages = [];

		// const $modal = $(`#modal-investment-${$(this).data("id")}`);

		const fullname = $modal.find('[name="fullname"]').val().trim();
		const phone = $modal.find('[name="phone"]').val().trim();
		const message = $modal.find('[name="note"]').val().trim();
		// const postId = $(this).data("id");
		const cachinhthucdautu = $modal
			.find('[name="cachinhthucdautu"]:checked')
			.val();

		const errorFullname = $modal.find(".error-fullname");
		const errorPhone = $modal.find(".error-phone");
		const errorInvestment = $modal.find(".error-investment");

		// Xóa lỗi cũ
		errorFullname.text("");
		errorPhone.text("");
		errorInvestment.text("");
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

		if (!cachinhthucdautu) {
			errorInvestment.text("Vui lòng chọn hình thức đầu tư.");
			hasError = true;
			errorMessages.push("Vui lòng chọn hình thức đầu tư.");
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
		const dataInvestment = {
			fullname: fullname,
			phone: phone,
			message: message,
			postId: postId,
			cachinhthucdautu: cachinhthucdautu,
		};

		console.log("Data ready:", dataInvestment);
		submitInvestmentForm(dataInvestment, $modal);

		// TODO: Gọi AJAX nếu cần
	});

	function submitInvestmentForm(dataInvestment, $modal) {
		const data = Object.assign(
			{
				action: "investment_form",
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

					$modelConsultationSuccess.removeClass("hidden").addClass("flex");
					// reset();
					setTimeout(function () {
						$modelConsultationSuccess.addClass("hidden").removeClass("flex");
						window.location.href = "/";
					}, 3000);

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
