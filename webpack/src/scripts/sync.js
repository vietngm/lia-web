jQuery(function ($) {
	root = $(this);
	envOp = root.find('[name="op_env"]');

	$(document).on("click", ".btn-service", function () {
		const endpoint = root.find('[name="endpoint"]').val();
		const token = root.find('[name="token"]').val();
		const envStatus = root.find('[name="environment"]').val();

		if (endpoint === "") {
			$.fancybox("#modal-environment", {
				modal: true,
				showCloseButton: false,
			});
			return false;
		}

		if (token === "") {
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
		getListService(endpoint, token, envStatus);
	});

	$(document).on("click", ".btn-doctor", function (e) {
		const endpoint = root.find('[name="endpoint"]').val();
		const token = root.find('[name="token"]').val();
		const envStatus = root.find('[name="environment"]').val();
		if (endpoint === "") {
			$.fancybox("#modal-environment", {
				modal: true,
				showCloseButton: false,
			});
			return false;
		}

		if (token === "") {
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
		getListDoctor(endpoint, token, envStatus);
	});

	envOp.change(function () {
		const value = $(this).val();
		const envText = $("#op_env option:selected").text();
		root.find('[name="endpoint"]').val(value);
		root.find('[name="environment"]').val(envText);
	});

	async function getListDoctor(endpoint, token, envStatus) {
		try {
			const response = await fetch(`${endpoint}/practitioner`, {
				method: "GET",
				headers: {
					Authorization: `Bearer ${token}`,
					"Content-Type": "application/json",
				},
			});

			if (!response.ok) {
				throw new Error(`${response.status}`);
			}

			const result = await response.json();

			// $.fancybox({ closeExisting: true });

			if (result && result.data) {
				const data = await processData(result.data);
				saveDoctorData(data, envStatus);
				console.log("Success:", data);
			} else {
				console.warn("Không có dữ liệu hợp lệ:", result);
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
			console.error("Lỗi khi lấy dữ liệu:", error);
		}
	}

	async function getListService(endpoint, token, envStatus) {
		try {
			const response = await fetch(`${endpoint}/service?perPage=100`, {
				method: "GET",
				headers: {
					Authorization: `Bearer ${token}`,
					"Content-Type": "application/json",
				},
			});

			if (!response.ok) {
				throw new Error(`${response.status}`);
			}

			const result = await response.json();

			// $.fancybox({ closeExisting: true });

			if (result && result.data) {
				const data = await processData(result.data);
				saveServiceData(data, envStatus);
				console.log("Success:", data);
			} else {
				console.warn("Không có dữ liệu hợp lệ:", result);
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
			console.error("Lỗi khi lấy dữ liệu:", error);
		}
	}

	async function processData(datas) {
		const dataFilter = datas.filter((data) => data.isDisplay && data.isActive);

		const offsets = [];
		for (let i = 0; i < dataFilter.length; i += 10) {
			offsets.push(dataFilter.slice(i, i + 10));
		}

		return offsets;
	}

	$(".modal-close").on("click", function () {
		$.fancybox.close();
	});

	function saveServiceData(data, status) {
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

	function saveDoctorData(data, status) {
		p = 0;
		var interval = setInterval(doStuff, 5000);
		function doStuff() {
			$.ajax({
				url: AJAX_URL,
				type: "POST",
				data: {
					action: "sync_doctor_data",
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

	// setReadonly();
	function setReadonly() {
		root.find($('[data-name~="status"] input')).attr("readonly", true);
		root.find($('[data-name~="id"] input')).attr("readonly", true);
		root.find($('[data-name~="id_sync"] input')).attr("readonly", true);
	}
});
