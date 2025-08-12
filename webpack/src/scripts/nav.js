jQuery(function ($) {
	// Open warranty details modal
	$(document).ready(function () {
		$('a[href="#warranty-modal"]').click(function (e) {
			e.preventDefault();
			$("#warranty-modal").css("display", "block");
			document.body.style.overflow = "hidden"; // Prevent scrolling
		});
	});

	// Open refund details modal
	$(document).ready(function () {
		$('a[href="#refund-modal"]').click(function (e) {
			e.preventDefault();
			// refundModal.style.display = "block";
			$("#refund-modal").css("display", "block");
			document.body.style.overflow = "hidden"; // Prevent scrolling
		});
	});

	$(document).on("click", ".close-modal", function () {
		$(this).closest(".modal").css("display", "none");
		document.body.style.overflow = "auto"; // Re-enable scrolling
	});
});
