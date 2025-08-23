jQuery(function ($) {
	const modal = document.getElementById("bottom-sheet-booking");
	if (!modal) return;

	let basePrice = 0;

	// Mở modal
	$(document).on("click", ".js-open-bottom-sheet", function () {
		let toppingsData = $(this).attr("data-toppings");

		const branchId = $(this).data("branch-id");
		const doctorId = $(this).data("doctor-id");
		const branchSelect = $(".js-branch");

		// Nếu có branchId và có select, thì mới chọn chi nhánh
		if (branchId && branchSelect.length) {
			const targetOption = branchSelect.find(
				`option[data-branch-id="${branchId}"]`
			);
			if (targetOption.length) {
				branchSelect.val(targetOption.val()).trigger("change");

				setTimeout(function () {
					if (doctorId) {
						const doctorSelect = $(".input-doctor select");
						const doctorOption = doctorSelect.find(
							`option[value="${doctorId}"]`
						);
						if (doctorOption.length) {
							doctorSelect.val(doctorId).trigger("change");
						}
					}
				}, 200);
			}
		}

		try {
			toppingsData = JSON.parse(toppingsData.replace(/&quot;/g, '"'));
		} catch (e) {
			console.error("Không thể phân tích data-toppings:", e);
			toppingsData = [];
		}

		basePrice = parseFloat($(this).data("price")) || 0;
		const title = $(this).data("title");
		const serviceId = parseInt($(this).data("id"));

		$(this).find('input[name="postId"]').val(serviceId);
		localStorage.setItem("serviceId", serviceId);
		$("#serviceName").text(title);
		$("#servicePrice").text(basePrice.toLocaleString() + " đ");
		$("#serviceImage").attr("src", $(this).data("image"));

		const container = $("#topping-container");
		container.empty();

		toppingsData.forEach((groupObj) => {
			const groupKey = Object.keys(groupObj)[0];
			const groupData = groupObj[groupKey];
			if (!groupData || !groupData.toppings?.length) return;

			const groupTitle = groupData.name || "Tùy chọn";
			const radioName = `topping-${groupKey}`;
			const groupEl = $(
				`<div><span class="topping-title">${groupTitle}</span></div>`
			);
			const itemsContainer = $('<div class="space-y-2 topping-group"></div>');

			groupData.toppings.forEach((item, index) => {
				const itemId = `${radioName}-${index}`;
				const itemHtml = $(`
					<label for="${itemId}" class="flex items-center justify-between cursor-pointer">
						<div class="flex items-center gap-2">
							<input type="radio" name="${radioName}" id="${itemId}" value="${
					item.price
				}" class="topping-radio" />
							<span>${item.name}</span>
						</div>
						<span>${Number(item.price).toLocaleString()} đ</span>
					</label>
				`);
				itemsContainer.append(itemHtml);
			});

			groupEl.append(itemsContainer);
			container.append(groupEl);
		});

		if (!modal.classList.contains("show")) {
			modal.style.display = "flex";
			setTimeout(() => modal.classList.add("show"), 10);
			$("html, body").css("overflow", "hidden");
		}

		calculateTotal(); // Gọi khi modal mở
	});

	// Đóng modal
	$(document).on("click", ".close-modal", function () {
		modal.classList.remove("show");
		localStorage.removeItem("serviceId");
		localStorage.removeItem("noteTopping");
		setTimeout(() => (modal.style.display = "none"), 300);
		$("html, body").css("overflow", "");
	});

	// Đóng modal khi click nền đen
	$(document).on("click", "#bottom-sheet-booking", function (e) {
		if (e.target.id === "bottom-sheet-booking") {
			$(".close-modal").trigger("click");
		}
	});

	// Tính tổng và lưu noteTopping
	function calculateTotal() {
		let total = basePrice;
		const selectedToppings = [];

		// Duyệt từng nhóm
		$("#topping-container > div").each(function () {
			const groupTitle = $(this).find(".topping-title").text().trim();
			const selectedInput = $(this).find(".topping-radio:checked");

			if (selectedInput.length > 0) {
				const price = parseFloat(selectedInput.val()) || 0;
				const name = selectedInput
					.closest("label")
					.find("span")
					.first()
					.text()
					.trim();

				selectedToppings.push({
					group: groupTitle,
					name: name,
					price: price,
				});

				total += price;
			}
		});

		// Cập nhật tổng giá
		$("#totalPriceBooking").text(total.toLocaleString() + " đ");

		// Lưu vào localStorage
		localStorage.setItem("noteTopping", JSON.stringify(selectedToppings));
	}

	// Lắng nghe khi thay đổi topping
	$(document).on("change", ".topping-radio", calculateTotal);
});
