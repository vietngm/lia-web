jQuery(function ($) {
	// Open warranty details modal
	$(document).ready(function () {
		$('a[href="#warranty-modal"]').click(function (e) {
			e.preventDefault();
			warrantyModal.style.display = "block";
			document.body.style.overflow = "hidden"; // Prevent scrolling
		});
	});

	// Open refund details modal
	$(document).ready(function () {
		$('a[href="#refund-modal"]').click(function (e) {
			e.preventDefault();
			refundModal.style.display = "block";
			document.body.style.overflow = "hidden"; // Prevent scrolling
		});
	});
});
