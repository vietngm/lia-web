jQuery(document).ready(function ($) {
	$(".js-news-carousel").owlCarousel({
		center: false,
		items: 1,
		loop: true,
		lazyLoad: true,
		nav: true,
		dots: false,
		responsiveClass: true,
		responsiveRefreshRate: true,
		autoplay: true,
		margin: 16,
		navText: [
			'<span class="custom-next">&#8592;</span>',
			'<span class="custom-prev">&#8594;</span>',
		],
		responsive: {
			768: { items: 2 },
			960: { items: 6 },
			1200: { items: 6 },
			1920: { items: 6 },
		},
	});

	$(".js-investment-hot-list").owlCarousel({
		center: false,
		items: 1,
		loop: true,
		lazyLoad: true,
		nav: false,
		dots: false,
		responsiveClass: true,
		responsiveRefreshRate: true,
		autoplay: true,
		margin: 16,
		responsive: {
			768: { items: 2 },
			960: { items: 6 },
			1200: { items: 6 },
			1920: { items: 6 },
		},
	});
});
