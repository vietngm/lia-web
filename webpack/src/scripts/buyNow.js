jQuery(function ($) {
	$(document).on("click", ".js-buy-now", function (e) {
		e.preventDefault();

		const modal = $("#modal-buy-now");
		const postId = $(this).data("id");

		console.log("postId", postId);

		if (!modal.length) return;

		if (!modal.hasClass("show")) {
			modal.css("display", "flex");
			setTimeout(() => modal.addClass("show"), 10);
			$("html, body").css("overflow", "hidden");
		}
	});

	// ĐÓNG MODAL - click nút close
	$(document).on("click", ".close-modal", function () {
		const modal = $(this).closest("[id^='modal-buy-now']");
		if (!modal.length) return;

		modal.removeClass("show");

		// Chờ animation mờ dần rồi mới display: none
		setTimeout(() => {
			modal.css("display", "none");
		}, 300); // Phải khớp với thời gian trong CSS transition
	});

	// ĐÓNG MODAL - click nền đen (background)
	$(document).on("click", "[id^='modal-buy-now']", function (e) {
		if (e.target === this) {
			$(this).find(".close-modal").trigger("click");
		}
	});
});
