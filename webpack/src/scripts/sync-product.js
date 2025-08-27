// Đồng bộ sản phẩm
jQuery(function ($) {
	const root = $(this);

	$(document).on("click", ".btn-product", function () {
		const endpoint = root.find('[name="endpoint"]').val();
		const token = root.find('[name="token"]').val();
		const envStatus = root.find('[name="environment"]').val();

		if (!endpoint) {
			$.fancybox("#modal-environment", {
				modal: true,
				showCloseButton: false,
			});
			return false;
		}

		if (!token) {
			$.fancybox("#modal-login", {
				modal: true,
				showCloseButton: false,
			});
			return false;
		}

		$.fancybox("#modal-process", {
			modal: true,
			showCloseButton: false,
		});

		getListProduct(endpoint, token, envStatus);
	});

	$(document).on("change", '[name="op_env"]', function () {
		const value = $(this).val();
		const envText = $("#op_env option:selected").text();
		$('[name="endpoint"]').val(value);
		$('[name="environment"]').val(envText);
	});

	$(".modal-close").on("click", function () {
		$.fancybox.close();
	});

	// Xử lý dữ liệu: lọc và chia nhóm
	async function processData(datas) {
		const dataFilter = datas.filter((data) => data.isDisplay && data.isActive);
		const offsets = [];
		for (let i = 0; i < dataFilter.length; i += 10) {
			offsets.push(dataFilter.slice(i, i + 10));
		}
		return offsets;
	}

	// Gửi dữ liệu từng nhóm
	function saveProductData(data, status) {
		let p = 0;

		function sendNext() {
			if (p >= data.length) {
				$.fancybox.open("#modal-success", {
					modal: true,
					showCloseButton: false,
				});
				console.log("🎉 Đồng bộ hoàn tất.");
				return;
			}

			console.log(`🚀 Đang gửi nhóm ${p + 1}/${data.length}...`);

			$.ajax({
				url: syncDataVars.ajax_url,
				type: "POST",
				data: {
					action: "sync_product_data",
					status: status,
					p: p,
					data: data[p],
				},
				success: function (result) {
					if (result) {
						console.log(`✅ Gửi thành công nhóm ${p + 1}`);
						p++;
						// Gửi tiếp sau 5s
						setTimeout(sendNext, 5000);
					} else {
						console.warn("⚠️ Dữ liệu trả về không hợp lệ:", result);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.error("❌ Lỗi gửi dữ liệu:", textStatus, errorThrown);
					// Vẫn tiếp tục gửi tiếp sau 5s
					p++;
					setTimeout(sendNext, 5000);
				},
			});
		}

		// Bắt đầu
		sendNext();
	}

	// Lấy danh sách sản phẩm (đa trang)
	async function getListProduct(endpoint, token, envStatus, perPage = 10) {
		let page = 1;
		let allData = [];

		try {
			console.log("🔄 Bắt đầu lấy danh sách sản phẩm...");

			// Trang đầu tiên
			const firstResponse = await fetch(
				`${endpoint}/product?perPage=${perPage}&page=${page}`,
				{
					method: "GET",
					headers: {
						Authorization: `Bearer ${token}`,
						"Content-Type": "application/json",
					},
				}
			);

			if (!firstResponse.ok) {
				throw new Error(`${firstResponse.status}`);
			}

			const firstResult = await firstResponse.json();
			const totalPages = firstResult.metadata?.totalPages || 1;
			allData = firstResult.data || [];

			console.log(`✅ Trang 1 / ${totalPages} đã tải`);

			// Lặp các trang còn lại
			for (let i = 2; i <= totalPages; i++) {
				console.log(`🔁 Đang lấy trang ${i} / ${totalPages}`);
				const response = await fetch(
					`${endpoint}/product?perPage=${perPage}&page=${i}`,
					{
						method: "GET",
						headers: {
							Authorization: `Bearer ${token}`,
							"Content-Type": "application/json",
						},
					}
				);

				if (!response.ok) {
					throw new Error(`${response.status}`);
				}

				const result = await response.json();
				if (result && result.data && result.data.length > 0) {
					allData = allData.concat(result.data);
				}
			}

			if (allData.length > 0) {
				console.log(`🎉 Tổng sản phẩm thu được: ${allData.length}`);
				const data = await processData(allData);
				saveProductData(data, envStatus);
			} else {
				console.warn("⚠️ Không có dữ liệu sản phẩm.");
			}
		} catch (error) {
			$.fancybox({ closeExisting: true });
			if (error.message == "401") {
				$.fancybox("#modal-login", {
					modal: true,
					showCloseButton: false,
				});
			} else {
				$.fancybox("#modal-login-again", {
					modal: true,
					showCloseButton: false,
				});
			}
			console.error("❌ Lỗi khi lấy sản phẩm:", error);
		}
	}
});
