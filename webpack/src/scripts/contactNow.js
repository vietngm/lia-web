$(document).ready(function () {
	$(".contact-now").click(function () {
		$("html").animate(
			{
				scrollTop: $("#form").offset().top - 60,
			},
			800 //speed
		);
	});
});
