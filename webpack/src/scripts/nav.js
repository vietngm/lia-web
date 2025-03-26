$(".hamburger").click(function () {
	$(this).toggleClass("active");
	$("header").toggleClass("active");
	if ($(this).hasClass("active")) {
		$(".mask").toggleClass("active");
		$("body").toggleClass("active");
		var navbar = $(".navbar-wrap");
		window.setTimeout(function () {
			navbar.toggleClass("open");
		}, 300);
	} else {
		$(".navbar-wrap").removeClass("open");
		$("body").removeClass("active");
		var mask = $(".mask");
		window.setTimeout(function () {
			mask.removeClass("active");
		}, 300);
	}

	return false;
});
$(".js-contact").on("click", function () {
	$(".side-right").toggleClass("active");
	$(".mask").toggleClass("open");
});

$(".js-close").on("click", function () {
	$(".side-right").removeClass("active");
	$(".mask").removeClass("open");
});

/*-----------------------------------------------*/
function isTouchDevice() {
	return (
		true ==
		("ontouchstart" in window ||
			(window.DocumentTouch && document instanceof DocumentTouch))
	);
}
/*-----------------------------------------------*/
if (isTouchDevice() === true) {
	$(".js-main-link").on("click", function () {
		var h = $(this).find(".sub-list").innerHeight();

		var root = $(this).parents(".main-item");

		root.find(".sub-wrap").toggleClass("active");
		root.find(".arrow").toggleClass("active");
		return false;
	});
}
if (isTouchDevice() === false) {
	$(".main-item.main-hover").mouseover(function () {
		$("body").addClass("active");
	});
	$(".main-item.main-hover").mouseout(function () {
		$("body").removeClass("active");
	});
}

$(window).scroll(function () {
	if ($(window).scrollTop() > 106) {
		$(".header").addClass("header-fixed");
		$(".header .navbar").addClass("fixed");
	} else {
		$(".header").removeClass("header-fixed");
		$(".header .navbar").removeClass("fixed");
	}
});
