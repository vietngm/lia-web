jQuery(document).ready(function ($) {
	$(".loop").owlCarousel({
		center: false,
		items: 1,
		loop: true,
		lazyLoad: true,
		nav: false,
		dots: false,
		responsiveClass: true,
		responsiveRefreshRate: true,
		autoplay: true,
		responsive: {
			768: {
				items: 1,
				margin: 8,
			},
			960: {
				items: 1,
				margin: 0,
			},
			1200: {
				items: 1,
				margin: 0,
			},
			1920: {
				items: 1,
				margin: 0,
			},
		},
	});

	$(".js-news-carousel").owlCarousel({
		center: false,
		items: 1,
		loop: true,
		lazyLoad: true,
		nav: false,
		dots: false,
		responsiveClass: true,
		responsiveRefreshRate: true,
		autoplay: true,
		responsive: {
			768: {
				items: 1,
				margin: 0,
			},
			960: {
				items: 6,
				margin: 0,
			},
			1200: {
				items: 6,
				margin: 0,
			},
			1920: {
				items: 6,
				margin: 0,
			},
		},
	});
});
