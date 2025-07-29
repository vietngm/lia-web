jQuery(function ($) {
	// MỞ MODAL
	$(document).on("click", ".js-modal-branch-service", function () {
		const modalId = $(this).data("id");
		const modal = document.getElementById(`modal-branch-service-${modalId}`);
		if (!modal) return;

		if (!modal.classList.contains("show")) {
			modal.style.display = "flex";
			setTimeout(() => modal.classList.add("show"), 10);
			$("html, body").css("overflow", "hidden");
		}
	});

	// ĐÓNG MODAL - click nút close
	$(document).on("click", ".close-modal", function () {
		const modal = $(this).closest("[id^='modal-branch-service-']")[0];
		if (!modal) return;

		modal.classList.remove("show");
		setTimeout(() => (modal.style.display = "none"), 300);
		$("html, body").css("overflow", "");
	});

	// ĐÓNG MODAL - click nền đen (background)
	$(document).on("click", "[id^='modal-branch-service-']", function (e) {
		if (e.target === this) {
			$(this).find(".close-modal").trigger("click");
		}
	});
});
