jQuery(function ($) {
	$(".expand-item").on("click", function () {
		$(".expand-item").removeClass("active");
		$(".expand-item").find(".expand-content").removeClass("active");
		$(".expand-item").find(".expand-content").removeAttr("style");

		$(this).toggleClass("active");

		console.log("item");
		height = $(this).find(".expand-content .expand-desc").height() + 8;
		console.log(height);

		if ($(this).hasClass("active")) {
			$(this).find(".expand-content").toggleClass("active");
			$(this).find(".expand-content").css({
				height: height,
				overflow: "visible",
			});
		} else {
			// $(".expand-content").removeAttr("style");
		}
	});
});
