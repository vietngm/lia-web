jQuery(function ($) {
	root = $(this);
	$(document).on("click", ".js-dashicons-failure", function () {
		const bookingId = $(this).parent("li").attr("data-rel");
		getData(bookingId);
	});

	function getData(bookingId) {
		console.log(AJAX_URL);
		console.log(bookingId);

		$.ajax({
			url: AJAX_URL,
			type: "GET",
			data: {
				action: "sync_booking",
				bookingId: "2846",
				data: "",
			},
			success: function (result) {
				if (result) {
					const jsonParse = JSON.parse(result);
					console.log(jsonParse);
					console.log("result");
					console.log(result.success);

					// $.fancybox.open("#modal-success", {
					// 	modal: true,
					// 	showCloseButton: false,
					// });
					// console.log(jsonParse.message);
				} else {
					console.warn("Lỗi: Dữ liệu trả về không hợp lệ.", result);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("Lỗi xảy ra:", textStatus, errorThrown);
			},
		});
	}
});
