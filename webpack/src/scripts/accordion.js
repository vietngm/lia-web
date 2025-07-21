jQuery(function ($) {
	$(".expand-item").on("click", function () {
		const $item = $(this);
		const $content = $item.find(".expand-content");
		const $desc = $content.find(".expand-desc");
		const $arrow = $item.find(".arrow-up");

		$item.toggleClass("active");
		$content.toggleClass("active");
		$arrow.toggleClass("active");

		const height = $desc.length ? $desc.height() + 8 : 0;

		if ($item.hasClass("active")) {
			$content.css({
				height: height,
				overflow: "visible",
			});
		} else {
			$content.removeAttr("style");
		}
	});
});
