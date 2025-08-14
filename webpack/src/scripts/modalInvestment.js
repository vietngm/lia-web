jQuery(function ($) {
	const $investmentHotList = $(".js-investment-hot-list");
	let $modalBackup;
	// MỞ MODAL
	$(document).on("click", ".js-investment", function () {
		const modalId = $(this).data("id");
		const modal = document.getElementById(`modal-investment-${modalId}`);
		if (!modal) return;

		$modalBackup = $(modal).next();
		$(modal).appendTo("body");

		if (!modal.classList.contains("show")) {
			modal.style.display = "flex";
			setTimeout(() => modal.classList.add("show"), 10);
			$("html, body").css("overflow", "hidden");
		}

		$investmentHotList.trigger("stop.owl.autoplay");
	});

	// ĐÓNG MODAL - click nút close
	$(document).on("click", ".close-modal", function () {
		const modal = $(this).closest("[id^='modal-investment-']")[0];
		if (!modal) return;

		modal.classList.remove("show");
		// setTimeout(() => (modal.style.display = "none"), 300);

		setTimeout(() => {
			modal.style.display = "none";
			if ($modalBackup && $modalBackup.length) {
				$modalBackup.before(modal);
			}
			$("html, body").css("overflow", "");
			// $(".js-investment-hot-list").trigger("play.owl.autoplay", [3000]);
			$investmentHotList.trigger("play.owl.autoplay", [3000]);
		}, 300);

		// $("html, body").css("overflow", "");
	});

	// ĐÓNG MODAL - click nền đen (background)
	$(document).on("click", "[id^='modal-investment-']", function (e) {
		if (e.target === this) {
			$(this).find(".close-modal").trigger("click");
		}
	});
});
