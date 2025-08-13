$(document).ready(function () {
	$(".tab-btn").click(function () {
		// Xóa active khỏi tất cả nút và nội dung
		$(".tab-btn").removeClass("active");
		$(".tab-content").removeClass("active");

		// Gán active cho nút được click và tab tương ứng
		$(this).addClass("active");
		var tabId = $(this).data("tab");
		$("#" + tabId).addClass("active");
	});
});
