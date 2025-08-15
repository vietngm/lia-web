jQuery(function ($) {
	const $investmentHotList = $(".js-investment-hot-list");
	// MỞ MODAL
	$(document).on("click", ".js-investment", function () {
		const postId = $(this).data("id");

		// Lấy modal chính (duy nhất)
		const $modal = $("#modal-investment");

		// Gắn postId để dùng khi submit
		$modal.attr("data-id", postId);

		// --- RESET TRẠNG THÁI ---
		$modal.find("input[type='text'], textarea").val(""); // clear input
		$modal.find("input[type='radio']").prop("checked", false); // uncheck radio
		$modal.find(".error-fullname, .error-phone, .error-investment").text(""); // clear lỗi
		$modal.removeClass("show").hide(); // đảm bảo trạng thái ban đầu

		// TODO: Nếu cần, có thể nạp dữ liệu động vào modal tại đây
		$modal.find(".modal-name").text($(this).data("name"));
		$modal.find(".modal-phong").text($(this).data("phong"));
		$modal.find(".modal-dientich").text($(this).data("dientich"));
		$modal.find(".modal-dia_chi").text($(this).data("diachi"));

		// Hiển thị modal
		$modal.appendTo("body").css("display", "flex");
		setTimeout(() => $modal.addClass("show"), 10);

		// Ẩn scroll nền
		$("html, body").css("overflow", "hidden");

		// Dừng autoplay nếu có
		$investmentHotList.trigger("stop.owl.autoplay");
	});

	// ĐÓNG MODAL - click nút close
	$(document).on("click", ".close-modal", function () {
		const $modal = $("#modal-investment");

		$modal.removeClass("show");

		setTimeout(() => {
			$modal.hide(); // hoặc: .css("display", "none")
			$("html, body").css("overflow", "");

			// Khôi phục carousel autoplay
			$investmentHotList.trigger("play.owl.autoplay", [3000]);
		}, 300);
	});

	// Đóng modal khi click vào nền đen
	$(document).on("click", "#modal-investment", function (e) {
		if (e.target === this) {
			$(this).find(".close-modal").trigger("click");
		}
	});
});
