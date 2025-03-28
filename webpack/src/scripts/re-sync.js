jQuery(function ($) {
	root = $(this);
	$(document).on("click", ".js-dashicons-failure", function () {
		const dataRel = $(this).parent("li").attr("data-rel");
		// console.log(dataRel);
	});
});
