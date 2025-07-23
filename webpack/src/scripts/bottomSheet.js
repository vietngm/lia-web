jQuery(function ($) {
	const modal = document.getElementById("bottom-sheet-booking");
	if (!modal) return;

	let basePrice = 0; // Biến lưu giá gốc của dịch vụ

	// Mở modal
	$(document).on("click", ".js-open-bottom-sheet", function () {
		const toppingsData = $(this).data("toppings");
		basePrice = parseFloat($(this).data("price")) || 0;
		const title = $(this).data("title");
		const serviceId = parseInt($(this).data("id")); // Lấy từ data-id trên nút
		localStorage.setItem("serviceId", serviceId); // Ghi đè lên localStorage
		$("#serviceName").text(title);
		$("#servicePrice").text(basePrice.toLocaleString() + " đ");

		if (!Array.isArray(toppingsData)) return;

		const container = $("#topping-container");
		container.empty();

		toppingsData.forEach((groupObj) => {
			const groupKey = Object.keys(groupObj)[0];
			const groupData = groupObj[groupKey];
			if (!groupData || !groupData.toppings?.length) return;

			const groupTitle = groupData.name || "Tùy chọn";
			const radioName = `topping-${groupKey}`;
			const groupEl = $(
				`<div><h3 class="topping-group-title">${groupTitle}</h3></div>`
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

		calculateTotal();
	});

	// Đóng modal
	$(document).on("click", ".close-modal", function () {
		modal.classList.remove("show");
		localStorage.removeItem("serviceId");
		setTimeout(() => (modal.style.display = "none"), 300);
		$("html, body").css("overflow", "");
	});

	// Đóng modal khi click nền đen
	$(document).on("click", "#bottom-sheet-booking", function (e) {
		if (e.target.id === "bottom-sheet-booking") {
			$(".close-modal").trigger("click");
		}
	});

	// Tính tổng
	function calculateTotal() {
		let total = basePrice;
		$(".topping-radio:checked").each(function () {
			const price = parseFloat($(this).val());
			if (!isNaN(price)) total += price;
		});
		$("#totalPriceBooking").text(total.toLocaleString());
	}

	$(document).on("change", ".topping-radio", calculateTotal);
});
