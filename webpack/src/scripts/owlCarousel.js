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
				margin: 0,
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
		nav: true, // Bật nút điều hướng
		dots: false,
		responsiveClass: true,
		responsiveRefreshRate: true,
		autoplay: false,
		margin: 16,
		navText: [
			'<span class="custom-next">&#8592;</span>', // Mũi tên trái
			'<span class="custom-prev">&#8594;</span>', // Mũi tên phải
		],
		responsive: {
			768: { items: 2 },
			960: { items: 6 },
			1200: { items: 6 },
			1920: { items: 6 },
		},
	});
});
