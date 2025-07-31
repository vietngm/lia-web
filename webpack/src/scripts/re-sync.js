jQuery(function ($) {
	root = $(this);
	$(document).on("click", ".js-dashicons-failure", function () {
		const bookingId = $(this).parent("li").attr("data-rel");
		$.fancybox("#modal-process", {
			modal: true,
			showCloseButton: false,
		});
		getData(bookingId);
	});

	function getData(bookingId) {
		$.ajax({
			url: syncDataVars.ajax_url,
			type: "GET",
			data: {
				action: "sync_booking",
				bookingId: bookingId,
			},
			success: function (result) {
				if (result) {
					const jsonParse = JSON.parse(result);

					if (
						jsonParse.data &&
						jsonParse.data.token != "" &&
						jsonParse.data.sync == 1
					) {
						createBooking(jsonParse.data);
					}
					$(document)
						.find(`.status-item-${bookingId}`)
						.empty()
						.append(
							'<span class="dashicons dashicons-yes-alt dashicons-success"></span>'
						);
				} else {
					console.warn("Lỗi: Dữ liệu trả về không hợp lệ.", result);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("Lỗi xảy ra:", textStatus, errorThrown);
			},
		});
	}

	async function createBooking(data) {
		const { apiUrl, token } = data;
		try {
			const response = await fetch(`${apiUrl}/booking/web-portal`, {
				method: "POST",
				headers: {
					Authorization: `Bearer ${token}`,
					"Content-Type": "application/json",
				},
				body: JSON.stringify(data),
			});

			if (!response.ok) {
				throw new Error(`${response.status}`);
			}

			const result = await response.json();
			if (result && result.data) {
				$.fancybox.open("#modal-success", {
					modal: true,
					showCloseButton: false,
				});
				console.log("LiA APP:", data);
			} else {
				console.warn("Không có dữ liệu hợp lệ:", result);
			}
		} catch (error) {
			console.error("Lỗi khi lấy dữ liệu:", error);
		}
	}
});
