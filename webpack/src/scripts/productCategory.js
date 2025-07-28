jQuery(function ($) {
	const categoryItems = $(".category-item");
	const productItems = $(".product-item");

	categoryItems.on("click", function (e) {
		e.preventDefault();

		const selectedItem = $(this);
		const selectedSlug = selectedItem.data("term-slug");

		const isActive = selectedItem.hasClass("active");

		// Xoá tất cả active
		categoryItems.removeClass("active");

		if (isActive) {
			// Nếu danh mục đang active mà click lần nữa => bỏ lọc
			productItems.show();
		} else {
			// Set active mới
			selectedItem.addClass("active");

			// Lọc sản phẩm theo slug
			productItems.each(function () {
				const categories = $(this).data("categories").toString().split(",");
				if (categories.includes(selectedSlug)) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		}
	});
});
