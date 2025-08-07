jQuery(document).ready(function ($) {
	function removeVietnameseTones(str) {
		return str
			.normalize("NFD")
			.replace(/[\u0300-\u036f]/g, "")
			.replace(/đ/g, "d")
			.replace(/Đ/g, "D")
			.replace(/[^\w\s]/gi, "") // Xoá ký tự đặc biệt
			.toLowerCase();
	}

	$(".search-box input").on("input", function () {
		const keyword = removeVietnameseTones($(this).val().trim());

		$(".docker-item").each(function () {
			const name = $(this).data("name") || "";
			const address = $(this).data("address") || "";
			const combined = removeVietnameseTones(name + " " + address);

			if (combined.includes(keyword)) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});
});
