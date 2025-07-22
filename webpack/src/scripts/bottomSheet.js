jQuery(function ($) {
	// document.addEventListener("DOMContentLoaded", function () {
	const modal = document.getElementById("bottom-sheet-booking");
	// const confirmButton = $(".js-open-bottom-sheet");
	$(document).on("click", ".js-open-bottom-sheet", function () {
		console.log("WOrk...");

		modal.style.display = "flex";
		setTimeout(() => {
			modal.classList.add("show");
		}, 10);
		document.documentElement.style.overflow = "hidden";
		document.body.style.overflow = "hidden";
	});

	$(document).on("click", ".close-modal", function () {
		modal.classList.remove("show");
		setTimeout(() => {
			modal.style.display = "none";
		}, 300);
		document.documentElement.style.overflow = "";
		document.body.style.overflow = "";
	});
	// const overlay = modal.querySelector(".bg-black");
	// const closeModalButton = modal.querySelector(".close-modal");

	// confirmButton.addEventListener("click", function () {
	// 	modal.style.display = "flex";
	// 	setTimeout(() => {
	// 		modal.classList.add("show");
	// 	}, 10);
	// 	document.documentElement.style.overflow = "hidden";
	// 	document.body.style.overflow = "hidden";
	// });

	// const closeModal = () => {
	// 	modal.classList.remove("show");
	// 	setTimeout(() => {
	// 		modal.style.display = "none";
	// 	}, 300);
	// 	document.documentElement.style.overflow = "";
	// 	document.body.style.overflow = "";
	// };

	// closeModalButton.addEventListener("click", closeModal);
	// });
});
