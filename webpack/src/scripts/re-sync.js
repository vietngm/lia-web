jQuery(function ($) {
	root = $(this);
	$(document).on("click", ".js-dashicons-failure", function () {
		const dataRel = $(this).parent("li").attr("data-rel");
		// console.log(dataRel);
	});

	function getData(bookingId, status) {
		p = 0;
		var interval = setInterval(doStuff, 5000);
		function doStuff() {
			$.ajax({
				url: AJAX_URL,
				type: "POST",
				data: {
					action: "sync_service_data",
					status: status,
					p: p,
					data: data[p],
				},
				success: function (result) {
					if (result) {
						const jsonParse = JSON.parse(result);
						if (jsonParse.page == data.length - 1) {
							$.fancybox.open("#modal-success", {
								modal: true,
								showCloseButton: false,
							});
							console.log(jsonParse.message);
						}

						if (jsonParse.page == data.length - 1) {
							clearInterval(interval);
						}
						p++;
					} else {
						console.warn("Lỗi: Dữ liệu trả về không hợp lệ.", result);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.error("Lỗi xảy ra:", textStatus, errorThrown);
				},
			});
		}
	}
});
