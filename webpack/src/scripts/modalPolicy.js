jQuery(function ($) {
	// Mở modal
	$(document).on("click", ".js-refund-policy", function () {
		const modal = document.getElementById("bottom-sheet-refund-policy");
		if (!modal) return;

		if (!modal.classList.contains("show")) {
			modal.style.display = "flex";
			setTimeout(() => modal.classList.add("show"), 10);
			$("html, body").css("overflow", "hidden");
		}
	});

	$(document).on("click", ".js-warranty-policy", function () {
		const modal = document.getElementById("bottom-sheet-warranty-policy");
		if (!modal) return;

		if (!modal.classList.contains("show")) {
			modal.style.display = "flex";
			setTimeout(() => modal.classList.add("show"), 10);
			$("html, body").css("overflow", "hidden");
		}
	});

	// Đóng modal — tìm modal gần nhất để đóng
	$(document).on("click", ".close-modal", function () {
		// Tìm modal chứa nút close, có id bắt đầu bằng "bottom-sheet"
		const modal = $(this).closest('[id^="bottom-sheet"]').get(0);

		if (modal) {
			modal.classList.remove("show");
			setTimeout(() => {
				modal.style.display = "none";
				$("html, body").css("overflow", "");
			}, 300);
		}
	});
});
