jQuery(function ($) {
	$(".expand-item").on("click", function () {
		$(this).toggleClass("active");
		$(this).find(".expand-content").toggleClass("active");
		$(this).find(".arrow-up").toggleClass("active");
		height = $(this).find(".expand-content .expand-desc").height() + 8;

		if ($(this).hasClass("active")) {
			$(this).find(".expand-content").css({
				height: height,
				overflow: "visible",
			});
		} else {
			$(this).find(".expand-content").removeAttr("style");
		}
	});
});
