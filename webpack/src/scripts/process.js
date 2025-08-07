jQuery(document).ready(function ($) {
	$(".progress-wrapper").each(function () {
		const wrapper = $(this);
		const vdt = parseInt(wrapper.data("vondautu")) || 0;
		const vkg = parseInt(wrapper.data("vonkeugoi"));

		if (!vkg || vkg === 0) return;

		const percent = Math.min(Math.round((vkg / vdt) * 100), 100);
		const bar = wrapper.find(".progress-bar");

		// Đặt chiều rộng
		bar.animate({ width: percent + "%" }, 600);

		// Tuỳ chọn: đổi màu theo mức độ
		// if (percent < 30) {
		// 	bar.css("background", "#f44336"); // đỏ
		// } else if (percent < 70) {
		// 	bar.css("background", "#ff9800"); // cam
		// } else {
		// 	bar.css("background", "#4caf50"); // xanh
		// }

		function removeVietnameseTones(str) {
			return str
				.normalize("NFD")
				.replace(/[\u0300-\u036f]/g, "")
				.replace(/đ/g, "d")
				.replace(/Đ/g, "D")
				.replace(/[^\w\s]/gi, "")
				.toLowerCase();
		}

		$(".search-box input").on("input", function () {
			const keyword = removeVietnameseTones($(this).val().trim());

			$(".investment-item").each(function () {
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
});
