window.$ = window.jQuery = $;

$("img.lazy").Lazy();

$(document).ready(function () {
	/*********************************************************************************/
	/************************************ FANCY BOX **********************************/
	Fancybox.bind("[data-fancybox]", {
		// Your custom options
	});
	/************************************ FANCY BOX **********************************/
	/*********************************************************************************/
});
$(document).ready(function () {
	/*********************************************************************************/
	/************************************ BANNER *************************************/
	$(".home-banner").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 500,
		autoplay: true,
		autoplaySpeed: 3000,
		dots: false,
		arrows: false,
		infinite: true,
	});
	$(".product-detail-slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 500,
		autoplay: true,
		autoplaySpeed: 3000,
		dots: false,
		arrows: false,
		infinite: true,
	});
	/************************************ BANNER *************************************/
	/*********************************************************************************/
});
$(document).ready(function () {
	/*********************************************************************************/
	/************************************ SYSTEM SLIDER ******************************/
	$(".home-system-slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 500,
		autoplay: true,
		autoplaySpeed: 3000,
		dots: false,
		arrows: false,
		infinite: true,
	});
	/************************************ SYSTEM SLIDER ******************************/
	/*********************************************************************************/
});
$(document).ready(function () {
	/*********************************************************************************/
	/************************************ PRODUCTS ***********************************/
	$(".highlight-filter").each(function () {
		const $root = $(this);
		const $items = $root.find(".item");
		const isRequired = $root.data("required");

		$items.click(function () {
			const id = $(this).data("id");
			const isActive = !$(this).hasClass("item-active");
			$items.removeClass("item-active");
			if (isActive || isRequired) $(this).addClass("item-active");
			$root.trigger("change");
		});
	});

	$(".product-section").each(function () {
		const $root = $(this);
		const $list = $root.find(".product-list");
		const $sortInput = $root.find('[name="sort"]');
		const $categoryChildrenInput = $root.find('[name="category"]');
		const $categoryChildrenModal = $(".category-modal");
		const $priceInput = $root.find('[name="price"]');
		const $ageInput = $root.find('[name="age"]');
		const $categoryParent = $root.find(".highlight-filter");
		const $loadMoreBtn = $("#load-more");

		const ITEMS_PER_PAGE = 6;
		let currentPage = 1;
		let filteredItems = [];

		function updateListUI() {
			const sort = $sortInput.val();
			const categoryParentId = $categoryParent.find(".item-active").data("id");
			const categoryChildIds = ($categoryChildrenInput.val() || []).map(
				(item) => parseInt(item.split("-")[1])
			);
			const price = $priceInput.val();
			const age = $ageInput.val();

			const [sortBy, sortDirection] = sort ? sort.split("-") : [null, null];
			const [minPrice, maxPrice] = price
				? price.split("-").map((item) => parseInt(item))
				: [0, 99999999999];
			const [minAge, maxAge] = age
				? age.split("-").map((item) => parseInt(item))
				: [0, 99999999999];

			filteredItems = ALL_SERVICES_DATA.filter(function (item) {
				if (categoryParentId && !item.categoryIds.includes(categoryParentId))
					return false;
				if (
					categoryChildIds.length &&
					!item.categoryIds.some((id) => categoryChildIds.includes(id))
				)
					return false;
				if (item.price > maxPrice || item.price < minPrice) return false;
				if (item.minAge > maxAge || item.maxAge < minAge) return false;
				return true;
			});

			filteredItems.sort(function (item1, item2) {
				if (sortBy === "rating") {
					return (
						(item1.rating - item2.rating) * (sortDirection === "desc" ? -1 : 1)
					);
				}
				if (sortBy === "pricing") {
					return (
						(item1.price - item2.price) * (sortDirection === "desc" ? -1 : 1)
					);
				}
				return 0;
			});

			renderItems(1);
		}

		function renderItems(page) {
			const start = 0;
			const end = page * ITEMS_PER_PAGE;

			$list.html("");
			filteredItems.slice(0, end).forEach((item) => {
				$list.append(item.html);
			});

			if (filteredItems.length > end) {
				$loadMoreBtn.show();
			} else {
				$loadMoreBtn.hide();
			}
		}

		$categoryParent.change(updateListUI);
		$sortInput.change(updateListUI);
		$categoryChildrenInput.change(updateListUI);
		$priceInput.change(updateListUI);
		$ageInput.change(updateListUI);

		$loadMoreBtn.click(function () {
			currentPage++;
			renderItems(currentPage);
		});

		updateListUI();
	});

	/************************************ PRODUCTS ***********************************/
	/*********************************************************************************/
});

$(document).ready(function () {
	/*********************************************************************************/
	/************************************ PROMOTION **********************************/
	$(".promotion-filter").each(function () {
		const $root = $(this);
		$root.find(".tab-item").click(function () {
			$root.find(".tab-item").removeClass("active");
			$(this).addClass("active");
			const id = $(this).data("id");
			$root.find(".tab-content").removeClass("active");
			$root.find(`.tab-content[data-id="${id}"]`).addClass("active");
		});
	});
	/************************************ PROMOTION **********************************/
	/*********************************************************************************/
});
$(document).ready(function () {
	/*********************************************************************************/
	/************************************ SHARE SLIDER *******************************/
	$(".home-share-slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 500,
		autoplay: true,
		autoplaySpeed: 3000,
		dots: false,
		arrows: false,
		infinite: true,
	});
	/************************************ SHARE SLIDER *******************************/
	/*********************************************************************************/
});

$(document).ready(function () {
	/*********************************************************************************/
	/************************************ SHARE SLIDER *******************************/
	$(".content-slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 500,
		autoplay: false,
		autoplaySpeed: 3000,
		dots: true,
		arrows: false,
		infinite: true,
	});
	/************************************ SHARE SLIDER *******************************/
	/*********************************************************************************/
});
$(document).ready(function () {
	$(".input-select").each(function () {
		const $root = $(this);
		const $select = $root.find("select");
		$select.select2({
			placeholder: $select.attr("placeholder"),
			allowClear: true,
		});
	});

	$(".input-btn-group").each(function () {
		const $root = $(this);
		const $select = $root.find("select");
		const $list = $("<div></div>").addClass("option-list");
		$select.css("display", "none");
		$select.before($list);
		const multiple =
			typeof $select.attr("multiple") !== "undefined" &&
			typeof $select.attr("multiple") !== false;

		function updateUI() {
			const options = [];
			$select.find("option").each(function () {
				const value = $(this).val();
				const label = $(this).html();
				if (value || label) options.push({ value, label });
			});
			let values = $select.val();
			if (!multiple) values = values ? [values] : [];
			$list.html("");
			options.forEach(function (option) {
				$list.append(`
					<div class="option-item ${
						values.includes(option.value) ? "active" : ""
					}" data-id="${option.value}">
						${option.label}
					</div>
				`);
			});
		}

		updateUI();
		$select.change(function () {
			updateUI();
		});
		$list.on("click", ".option-item", function () {
			const value = $(this).data("id").toString();
			let values = $select.val();
			if (!multiple) values = values ? [values] : [];
			if (values.includes(value)) {
				values = values.filter((_value) => value != _value);
			} else if (multiple) {
				values = [...values, value];
			} else {
				values = [value];
			}
			$select.val(multiple ? values : values[0]).trigger("change");
		});
	});
});
$(document).ready(function () {
	/*********************************************************************************/
	/************************************ FORM ***************************************/
	$(".booking-form").each(function () {
		const $root = $(this);
		const $inputFullname = $root.find("[name='fullname']");
		const $inputPhone = $root.find("[name='phone']");
		const $inputReferralCode = $root.find("[name='referralCode']");
		const $referralNote = $root.find(".referral-note");
		const $inputForeigner = $root.find("[name='foreigner']");
		const $inputDoctor = $root.find(".input-doctor select");
		const $inputService = $root.find(".input-service select");
		const $storedServiceId = localStorage.getItem("serviceId");
		if ($storedServiceId && $inputService.length) {
			$inputService.val($storedServiceId).trigger("change");
		}
		const $inputServiceWrapper = $root.find(".input-service");
		const $inputTopping = $root.find(".input-topping select");
		const $inputToppingWrapper = $root.find(".input-topping");
		const $estimationPrice = $root.find(".estimate-price");
		const $estimationPriceValue = $root.find(".estimate-price-value");
		const $bookingDateItems = $root.find(
			".booking-date-picker .item:not('.other')"
		);
		const $bookingDateOther = $root.find(".booking-date-picker .item.other");
		const $bookingDateOtherInput = $bookingDateOther.find(".datetimepicker");
		const $bookingTimeWrapper = $root.find(".booking-time-picker");
		const $inputNote = $root.find(`[name="note"]`);
		const $inputNoteTopping = $root.find(`[name="noteTopping"]`);
		const $inputNoteLiA = $(document).find(`[name="noteForLiA"]`);

		const $inputTimesMorning = $root.find(".input-times-morning");
		const $inputTimesAfternoon = $root.find(".input-times-afternoon");
		// const $otp = $root.find(".otp_target");
		// const $otpModel = $root.find(".otp-modal");
		const $modelSuccess = $root.find(".modal-success");

		const $errorFullname = $root.find(".error-fullname");
		const $errorPhone = $root.find(".error-phone");
		const $errorDoctor = $root.find(".error-doctor");
		const $errorService = $root.find(".error-service");
		const $errorTopping = $root.find(".error-topping");
		const $errorDate = $root.find(".error-date");
		const $errorTime = $root.find(".error-time");

		const $submit = $root.find(".submit");

		let formState = {
			fullname: "",
			phone: "",
			referralRate: 0,
			referralCode: "",
			foreigner: false,
			doctorId: null,
			serviceId: $storedServiceId || null,
			toppingId: null,
			date: $bookingDateItems.filter(".active").data("date"),
			time: null,
			note: null,
			noteForLiA: $inputNoteLiA.val() ?? null,
			postId: parseInt($root.find("[name=postId]").val()),
			noteTopping: null,
			selectedGift: localStorage.getItem("selectedGift") || "",
		};
		console.log("Initial formState:", formState);

		const $inputGift = $('input[name="gift"]');

		$inputGift.on("change", function () {
			const selectedGift = $(this).val();
			localStorage.setItem("selectedGift", selectedGift);
			formState.selectedGift = selectedGift;
			console.log("Updated selectedGift:", formState.selectedGift);
		});

		$inputService.on("change", function () {
			const selectedServiceId = $(this).val();
			localStorage.setItem("serviceId", selectedServiceId);
			formState.serviceId = selectedServiceId;
			console.log("Updated serviceId:", formState.serviceId);
		});

		function reset() {
			$inputFullname.val("").trigger("change");
			$inputPhone.val("").trigger("change");
			$inputReferralCode.val("").trigger("change");
			$inputForeigner.prop("checked", false);
			$inputDoctor.val(null).trigger("change");
			$inputNote.val("").trigger("change");
			$inputNoteTopping.val("").trigger("change");
		}

		let submitting = false;

		$submit.click(function () {
			if (submitting) return;
			let hasError = false;
			// if (!formState.fullname) {
			// 	hasError = true;
			// 	$errorFullname.text("Vui lòng nhập Họ và Tên người dùng");
			// }
			let errorMessages = [];
			if (!formState.phone) {
				hasError = true;
				errorMessages.push("Vui lòng nhập số điện thoại");
				$errorPhone.text("Vui lòng nhập Số điện thoại");
			}
			if (!/(0|\+84|84)+([0-9]{9})\b/.test(formState.phone)) {
				hasError = true;
				errorMessages.push("Số điện thoại không đúng định dạng");
				$errorPhone.text("Số điện thoại không đúng định dạng");
			}
			if (!formState.doctorId) {
				hasError = true;
				errorMessages.push("Vui lòng chọn bác sĩ");
				$errorDoctor.text("Vui lòng chọn bác sĩ");
			}
			if (!formState.serviceId) {
				hasError = true;
				errorMessages.push("Vui lòng chọn dịch vụ");
				$errorService.text("Vui lòng chọn dịch vụ");
			}
			// if (!formState.toppingId) {
			// 	hasError = true;
			// 	$errorTopping.text("Vui lòng chọn topping");
			// }
			if (!formState.date) {
				hasError = true;
				errorMessages.push("Vui lòng chọn ngày khám");
				$errorDate.text("Vui lòng chọn ngày khám");
			}
			if (!formState.time) {
				hasError = true;
				errorMessages.push("Vui lòng chọn giờ khám");
				$errorTime.text("Vui lòng chọn giờ khám");
			}
			console.log("Submit data:", formState);

			if (hasError) {
				Toastify({
					text:
						errorMessages.length === 5
							? "Vui lòng nhập đầy đủ thông tin đặt hẹn"
							: errorMessages.join("\n"),
					duration: 3000,
					newWindow: true,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "#ef4444",
					},
				}).showToast();
				return;
			}

			//thêm mới
			submit();
			// sendOtp(function () {
			//   $otpModel.removeClass("hidden").addClass("flex");
			//   $otp.otpdesigner("clear");
			// });
		});

		function sendOtp(success, error) {
			const data = Object.assign(
				{
					action: "booking_form_otp",
					_wpnonce: $root.find('[name="_wpnonce"]').val(),
					_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
				},
				formState
			);
			submitting = true;
			const loadingToastify = Toastify({
				text: "Đang gửi thông tin...",
				duration: -1,
				newWindow: true,
				close: true,
				gravity: "top",
				position: "center",
				stopOnFocus: true,
				style: {
					background: "#fff",
					color: "#333",
				},
			});
			loadingToastify.showToast();
			$.ajax({
				url: AJAX_URL,
				type: "POST",
				dataType: "JSON",
				data: data,
				success: function (result) {
					loadingToastify.hideToast();
					submitting = false;
					if (result.success) {
						if (success) success();
					} else {
						Toastify({
							text: result.message || "Đã xảy ra lỗi",
							duration: 3000,
							newWindow: true,
							close: true,
							gravity: "top",
							position: "center",
							stopOnFocus: true,
							style: {
								background: "#ef4444",
							},
						}).showToast();
						if (error) error();
					}
				},
				error: function () {
					loadingToastify.hideToast();
					Toastify({
						text: "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
					submitting = false;
					if (error) error();
				},
			});
		}

		function submit(success, error) {
			const data = Object.assign(
				{
					action: "booking_form",
					_wpnonce: $root.find('[name="_wpnonce"]').val(),
					_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
				},
				formState
			);

			submitting = true;
			const loadingToastify = Toastify({
				text: "Đang gửi thông tin...",
				duration: -1,
				newWindow: true,
				close: true,
				gravity: "top",
				position: "center",
				stopOnFocus: true,
				style: {
					background: "#fff",
					color: "#333",
				},
			});
			loadingToastify.showToast();

			$.ajax({
				url: AJAX_URL,
				type: "POST",
				dataType: "JSON",
				data: data,
				success: function (result) {
					loadingToastify.hideToast();
					submitting = false;
					if (result.success) {
						console.log(result);
						if (
							result.data &&
							result.data.token != "" &&
							result.data.sync == 1
						) {
							createBooking(result.data);
						}
						console.log("Ket qua tra ve ne");
						// reset();
						$modelSuccess.removeClass("hidden").addClass("flex");
						// setTimeout(function () {
						//   $modelSuccess.addClass("hidden").removeClass("flex");
						//   window.location.href = "/";
						// }, 3000);
						// Toastify({
						//   text: result.message || "Đăng ký thành công",
						//   duration: 3000,
						//   newWindow: true,
						//   close: true,
						//   gravity: "top",
						//   position: "center",
						//   stopOnFocus: true,
						//   style: {
						//     background: "#4a934a",
						//   },
						// }).showToast();
						// setTimeout(function () {
						//   window.location.href = "/";
						// }, 3000);

						if (success) success();
					} else {
						Toastify({
							text: result.message || "Đã xảy ra lỗi",
							duration: 3000,
							newWindow: true,
							close: true,
							gravity: "top",
							position: "center",
							stopOnFocus: true,
							style: {
								background: "#ef4444",
							},
						}).showToast();
						if (error) error();
					}
				},
				error: function () {
					loadingToastify.hideToast();
					submitting = false;
					Toastify({
						text: "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
					if (error) error();
				},
			});
		}

		function triggerRender(prevFormState, nextFormState) {
			if (prevFormState.fullname !== nextFormState.fullname) {
				$errorFullname.text("");
			}
			if (prevFormState.phone !== nextFormState.phone) {
				$errorPhone.text("");
			}

			if (prevFormState.doctorId !== nextFormState.doctorId) {
				$errorDoctor.text("");
				$inputService.val(null).trigger("change");

				if (!nextFormState.doctorId) $inputServiceWrapper.addClass("hidden");
				else {
					$inputServiceWrapper.removeClass("hidden");
					const services = BOOKING_DATA.services.filter(function (serviceData) {
						return serviceData.doctorIds.includes(nextFormState.doctorId);
					});
					$inputService.html("<option></option>");
					services.forEach((service) => {
						$inputService.append(
							new Option(
								`${service.title} - ${formatNumber(service.price)} đ`,
								service.id,
								false,
								false
							)
						);
					});
					$inputService.trigger("change");
				}
			}

			if (prevFormState.serviceId !== nextFormState.serviceId) {
				$errorService.text("");
				$inputTopping.val(null).trigger("change");

				if (!nextFormState.serviceId) $inputToppingWrapper.addClass("hidden");
				else {
					const service = BOOKING_DATA.services.find(
						(service) => service.id === nextFormState.serviceId
					);
					const toppingIds = service.prices.map((price) => price.toppingId);
					const toppings = toppingIds.map((toppingId) =>
						BOOKING_DATA.toppings.find((topping) => topping.id === toppingId)
					);

					$inputToppingWrapper.removeClass("hidden");
					$inputTopping.html("<option></option>");
					service.prices.forEach(function (toppingPrice) {
						const price = toppingPrice.price;
						const toppingId = toppingPrice.toppingId;
						const topping = BOOKING_DATA.toppings.find(
							(topping) => topping.id === toppingId
						);
						$inputTopping.append(
							new Option(
								`${topping.title} - ${formatNumber(price)} đ`,
								topping.id,
								false,
								false
							)
						);
					});
					$inputTopping.trigger("change");
				}
			}

			if (
				prevFormState.toppingId !== nextFormState.toppingId ||
				prevFormState.serviceId !== nextFormState.serviceId ||
				prevFormState.referralRate !== nextFormState.referralRate
			) {
				$errorTopping.text("");
				const service = BOOKING_DATA.services.find(
					(service) => service.id === nextFormState.serviceId
				);
				const servicePrice = service ? service.price : null;
				const toppingPrice = service
					? (
							service.prices.find(
								(price) => price.toppingId === nextFormState.toppingId
							) || {}
					  ).price || 0
					: 0;
				if (servicePrice) {
					const price =
						(servicePrice + toppingPrice) *
						(1 - nextFormState.referralRate / 100);
					$estimationPrice.removeClass("hidden");
					$estimationPriceValue.html(
						`${formatNumber(price)} <small><u>đ</u></small>`
					);
				} else {
					$estimationPrice.addClass("hidden");
				}
			}

			if (prevFormState.date !== nextFormState.date && nextFormState.date) {
				$errorDate.text("");
				const $activeItem =
					window.innerWidth < 700
						? $bookingDateItems.filter(
								`[data-date='${nextFormState.date}']:not(.hidden)`
						  )
						: $bookingDateItems.filter(`[data-date='${nextFormState.date}']`);
				if ($activeItem.length) {
					$bookingDateItems.removeClass("active");
					$bookingDateOther.removeClass("active").find(".inner").html(`
						<div class="plus-icon"></div>
					`);
					$activeItem.addClass("active");
				} else {
					const date = new Date(nextFormState.date);
					$bookingDateItems.removeClass("active");
					$bookingDateOther.addClass("active").find(".inner").html(`
							<div>Thg ${date.getMonth()}</div>
							<div>${date.getDate()}</div>
						`);
				}
			}

			if (prevFormState.time !== nextFormState.time) {
				$errorTime.text("");
			}

			if (
				prevFormState.doctorId !== nextFormState.doctorId ||
				(prevFormState.date !== nextFormState.date && nextFormState.date)
			) {
				if (!nextFormState.doctorId || !nextFormState.date) {
					$bookingTimeWrapper.addClass("pointer-events-none opacity-30");
					return;
				}
				$bookingTimeWrapper.removeClass("pointer-events-none opacity-30");
				const doctor = BOOKING_DATA.doctors.find(
					(doctor) => doctor.id === nextFormState.doctorId
				);
				if (!doctor) return;
				const dayName = [
					"sunday",
					"monday",
					"tuesday",
					"wednesday",
					"thursday",
					"friday",
					"saturday",
				][new Date(nextFormState.date).getDay()];
				const workingTimes = doctor.workingTimes[dayName].sort();
				const morningWorkingTimes = workingTimes.filter(
					(workingTime) => parseInt(workingTime.split(":")[0]) <= 12
				);
				const afternoonWorkingTimes = workingTimes.filter(
					(workingTime) => parseInt(workingTime.split(":")[0]) > 12
				);
				const unavailableTimes = BOOKING_DATA.unavailableTimes
					.filter(
						(unavailableTime) =>
							unavailableTime.date === nextFormState.date &&
							unavailableTime.doctorId === nextFormState.doctorId
					)
					.map((unavailableTime) => unavailableTime.time);

				$inputTimesMorning.html("");
				$inputTimesAfternoon.html("");

				const minDate = new Date();
				minDate.setHours(minDate.getHours() + 2);
				const year = minDate.getFullYear() + "";
				let month = minDate.getMonth() + 1;
				if (month < 10) month = "0" + month;
				let day = minDate.getDate();
				if (day < 10) day = "0" + day;
				let hour = minDate.getHours();
				if (hour < 10) hour = "0" + hour;
				let minute = minDate.getMinutes();
				if (minute < 10) minute = "0" + minute;

				const minDateStr = `${year}-${month}-${day}`;
				const minTimeStr = `${hour}:${minute}`;

				morningWorkingTimes.forEach((morningWorkingTime) => {
					const isDisabled =
						unavailableTimes.includes(morningWorkingTime) ||
						nextFormState.date < minDateStr ||
						(nextFormState.date === minDateStr &&
							morningWorkingTime < minTimeStr);
					$inputTimesMorning.append(`
						<label class="time-input flex-shrink-0 ${isDisabled ? "disabled" : ""}">
							<input ${
								isDisabled ? "disabled" : ""
							} type="radio" name="time" value="${morningWorkingTime}" />
							<div class="time-input-content">${morningWorkingTime}</div>
						</label>
					`);
				});
				afternoonWorkingTimes.forEach((afternoonWorkingTime) => {
					const isDisabled =
						unavailableTimes.includes(afternoonWorkingTime) ||
						nextFormState.date < minDateStr ||
						(nextFormState.date === minDateStr &&
							afternoonWorkingTime < minTimeStr);
					$inputTimesAfternoon.append(`
						<label class="time-input flex-shrink-0 ${isDisabled ? "disabled" : ""}">
							<input ${
								isDisabled ? "disabled" : ""
							} type="radio" name="time" value="${afternoonWorkingTime}" />
							<div class="time-input-content">${afternoonWorkingTime}</div>
						</label>
					`);
				});
			}
		}

		$inputFullname.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.fullname = $inputFullname.val();
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputPhone.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.phone = $inputPhone.val();
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputReferralCode.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.referralCode = $inputReferralCode.val();
			if (nextFormState.referralCode)
				nextFormState.referralRate = parseFloat(
					$referralNote.data("rate") || "0"
				);
			else nextFormState.referralRate = 0;
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputForeigner.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.foreigner = $inputForeigner.is(":checked");
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputDoctor.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.doctorId = parseIntSafe($inputDoctor.val());
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputService.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.serviceId = parseIntSafe($inputService.val());
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputGift.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.selectedGift = parseIntSafe($inputGift.val());
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputTopping.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.toppingId = parseIntSafe($inputTopping.val());
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$bookingDateItems.click(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.date = $(this).data("date");
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$bookingDateItems.click(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.date = $(this).data("date");
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$bookingDateOtherInput.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.date = $bookingDateOtherInput.val();
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$bookingTimeWrapper.on("change", '[name="time"]', function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.time = $bookingTimeWrapper
				.find('[name="time"]:checked')
				.val();
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		$inputNote.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.note = $inputNote.val();
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});
		$inputNoteTopping.change(function () {
			const nextFormState = Object.assign({}, formState);
			nextFormState.noteTopping = $inputNoteTopping.val();
			const prevFormState = formState;
			formState = nextFormState;
			triggerRender(prevFormState, nextFormState);
		});

		// $otpModel.find(".close-modal").click(function () {
		//   $otpModel.addClass("hidden").removeClass("flex");
		// });
		// $otpModel.find(".submit-otp").click(function () {
		//   if ($otp.otpdesigner("code").done) {
		//     submit(function () {
		//       $otpModel.addClass("hidden").removeClass("flex");
		//     });
		//   }
		// });

		$otp.otpdesigner({
			typingDone: function (code) {
				submit(function () {
					$otpModel.addClass("hidden").removeClass("flex");
				});
			},
		});
	});

	/************************************ FORM ***************************************/
	/*********************************************************************************/
});
$(document).ready(function () {
	$(".collapse-container").each(function () {
		const $root = $(this);
		const $items = $root.find(".collapse-item");
		$items.each(function () {
			const $header = $(this).find(".collapse-header");
			const $body = $(this).find(".collapse-body");
			$header.click(function () {
				$items.find(".collapse-body").stop().slideUp(400);
				$body.stop().slideToggle(400);
			});
		});
	});
});
$(document).ready(function () {
	$(".blog-content-slider").each(function () {
		$(this).slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			speed: 500,
			autoplay: true,
			autoplaySpeed: 3000,
			dots: false,
			arrows: false,
			infinite: true,
		});
	});
});
$(document).ready(function () {
	$("[tbc-toggle-target]").click(function () {
		const $root = $(this);
		const targetSelector = $root.attr("tbc-toggle-target");
		const $target = $(targetSelector);
		if (!$target.length) {
			return;
		}
		const open = $target.attr("data-open") == "true";
		$target.attr("data-open", open ? "false" : true);
	});
});
$(document).ready(function () {
	$.datetimepicker.setLocale("vi");
	$(".datetimepicker").each(function () {
		const minDate = $(this).data("minDate");
		const maxDate = $(this).data("maxDate");
		$(this).datetimepicker({
			lang: "vi",
			timepicker: false,
			format: "Y-m-d",
			className: "datepicker",
			minDate: minDate,
			maxDate: maxDate,
		});
	});
});
$(document).ready(function () {
	$(".main-menu").each(function () {
		const $root = $(this);
		const $tabs = $root.find(".menu-cat-item");
		const $contentWrapper = $root.find(".menu-cat-content-wrapper");
		const $contents = $root.find(".menu-cat-content");

		let contentByIds = [];

		function loadContent() {
			contentByIds = [];
			const offset = $contentWrapper.offset().top;
			$contents.each(function () {
				const $content = $(this);
				const id = $content.data("id");
				if (contentByIds.find((item) => item.id === id)) return;
				contentByIds.push({ id: id, top: $content.offset().top - offset });
			});
		}
		loadContent();
		$(window).resize(loadContent);

		$contentWrapper.scroll(function () {
			const scrollTop = $contentWrapper.scrollTop() + 50;
			let index = 0;
			for (; index < contentByIds.length - 1; index++) {
				if (index === 0 && contentByIds[index].top > scrollTop) break;
				if (
					contentByIds[index].top < scrollTop &&
					contentByIds[index + 1].top > scrollTop
				) {
					break;
				}
			}
			const selectedId = contentByIds[index].id;
			if (selectedId === $tabs.filter(".active").data("id")) return;
			$tabs.removeClass("active");
			$tabs.filter(`[data-id="${selectedId}"]`).addClass("active");
		});
		$tabs.click(function () {
			const contentById = contentByIds.find(
				(item) => item.id === $(this).data("id")
			);
			if (!contentById) return;
			const top = contentById.top - 20;
			if (typeof top !== "undefined") {
				$contentWrapper.animate({ scrollTop: top }, 600);
			}
		});
	});
	$(".toggle-menu").click(function () {
		$(".main-menu").toggleClass("active");
		$(".menu-lazy").each(function () {
			$(this).attr("src", $(this).data("src"));
		});
	});
});

function formatNumber(number) {
	return number.toLocaleString("en-US", {
		maximumFractionDigits: 3,
		minimumFractionDigits: 0,
	});
}

function parseIntSafe(number) {
	if (number === "" || number === undefined || number === null) return null;
	try {
		return parseInt(number);
	} catch (error) {
		return null;
	}
}

/*********************************************************************************/
/************************************ DROPDOWN ***********************************/
$("select.dropdown-select").each(function () {
	const $root = $(this);
	const modalClass = $root.data("modalClass");
	const multiple =
		typeof $root.attr("multiple") !== "undefined" &&
		typeof $root.attr("multiple") !== false;
	const placement = $root.attr("placement") || "bottom";
	const classNames = $root.attr("class").replace("dropdown-select", "");
	const placeholder = $root.attr("placeholder");
	const rows = parseInt($root.attr("rows") || "1");
	const options = [];
	$root.find("option").map(function () {
		const value = $(this).attr("value");
		const label = $(this).html();
		const selected =
			typeof $(this).attr("selected") !== "undefined" &&
			$(this).attr("selected") !== false;
		options.push({ value, label, selected });
	});
	$root.css({ display: "none" });

	// Create new element
	const $inputElement = $(
		`
			<div class="dropdown-select-ui ${classNames}">
				<div class='placeholder'>${placeholder}</div>
				<img class='icon-arrow' src='${ASSETS_PATH}images/icons/chevron-bottom-gray.svg' />
			</div>
		`
	);
	$root.after($inputElement);

	// Modal
	const optionElements = options.map(function (option) {
		const $element = $(`
			<div class="option ${option.selected ? "selected" : ""}" data-id="${
			option.value
		}">
				<div class="check"></div>
				<div class="label">${option.label}</div>
			</div>
		`);
		option.$element = $element;
		return { value: option.value, $element: $element };
	});

	const $modalElement = $(
		`
			<div class="dropdown-select-modal ${multiple ? "multiple" : ""} ${
			modalClass || ""
		}">
				<h4 class="title">${placeholder}</h4>
				<div class="options options-${rows}">
				</div>
				<div class="dropdown-footer">
					<div class="btn-confirm btn">Xác nhận</div>
					<div class="btn-reset btn-outline">Đặt lại</div>
				</div>
			</h2>
		`
	);
	optionElements.forEach(function (optionElement) {
		$modalElement.find(".options").append(optionElement.$element);
	});
	$(document.body).append($modalElement);

	// Popover
	window.FloatingUIDOM.autoUpdate(
		$inputElement[0],
		$modalElement[0],
		function () {
			window.FloatingUIDOM.computePosition($inputElement[0], $modalElement[0], {
				placement: placement,
				middleware: [window.FloatingUIDOM.shift()],
			}).then(function (info) {
				$modalElement.css({
					top: info.y,
					left: info.x,
					position: info.strategy,
				});
			});
		}
	);

	// Update value
	function updateValueUI() {
		const values = optionElements
			.filter(function (optionElement) {
				return optionElement.$element.hasClass("selected");
			})
			.map(function (optionElement) {
				return optionElement.value;
			});
		if (multiple) {
			$root.val(values).trigger("change");
			if (values.length) {
				$inputElement.addClass("active");
				$inputElement
					.find(".placeholder")
					.text(`${placeholder} +${values.length}`);
			} else {
				$inputElement.removeClass("active");
				$inputElement.find(".placeholder").text(placeholder);
			}
		} else {
			const value = values[0] || null;
			$root.val(value).trigger("change");
			if (value) {
				const label = options.find(function (option) {
					return option.value === value;
				}).label;
				$inputElement.addClass("active");
				$inputElement.find(".placeholder").text(label);
			} else {
				$inputElement.removeClass("active");
				$inputElement.find(".placeholder").text(placeholder);
			}
		}
	}
	updateValueUI();

	// Selected value handler
	optionElements.forEach(function (optionElement) {
		const $element = optionElement.$element;
		$element.on("click", function () {
			if (!multiple) {
				optionElements.forEach(function (optionElement) {
					optionElement.$element.removeClass("selected");
				});
				$element.addClass("selected");
			} else {
				const selected = $element.hasClass("selected");
				if (selected) $element.removeClass("selected");
				else $element.addClass("selected");
			}
			// Update value
			updateValueUI();
		});
	});
	$root.change(function () {
		const value = Array.isArray($root.val()) ? $root.val() : [$root.val()];
		const modalValue = optionElements
			.filter(function (optionElement) {
				return optionElement.$element.hasClass("selected");
			})
			.map(function (optionElement) {
				return optionElement.value;
			});
		if (value.sort().join("__") === modalValue.sort().join("__")) return;
		$modalElement.find(".options .option").removeClass("selected");
		value.forEach(function (value) {
			$modalElement
				.find(`.options .option[data-id="${value}"]`)
				.addClass("selected");
		});
		updateValueUI();
	});

	// Open modal handler
	$inputElement.on("click", function () {
		$modalElement.toggleClass("open");
	});
	$(document).click(function (event) {
		var $target = $(event.target);
		if (
			!$target.closest($modalElement).length &&
			!$target.closest($inputElement).length
		) {
			$modalElement.removeClass("open");
		}
	});

	// Submit - reset
	$modalElement.find(".btn-confirm").on("click", function () {
		$modalElement.removeClass("open");
	});

	$modalElement.find(".btn-reset").on("click", function () {
		optionElements.forEach(function (optionElement) {
			optionElement.$element.removeClass("selected");
		});
		updateValueUI();
	});
});
/************************************ DROPDOWN ***********************************/
/*********************************************************************************/
$(document).ready(function () {
	$(".mount-slider").removeClass("mount-slider");
});

/*********************************************************************************/
/************************************ DOCTOR CONTACT MODAL ***********************/
$(document).ready(function () {
	$(".section-doctor").each(function () {
		const $root = $(this);
		const $items = $root.find(".docker-item");
		const $filters = $root.find(".highlight-filter");
		const $filterItems = $root.find(".highlight-filter .item");
		$filters.change(function () {
			let id = $filterItems.filter(".item-active").data("id");
			id = id ? id.toString() : id;
			$items.each(function () {
				const ids = $(this).data("id").split(",");
				if (!id || ids.includes(id)) {
					$(this).removeClass("hidden");
				} else {
					$(this).addClass("hidden");
				}
			});
		});
	});
});
$(document).ready(function () {
	let doctorId = null;
	let submitting = false;
	function openZaloContactModal(_doctorId) {
		doctorId = _doctorId;
		$(".zalo-contact-modal").addClass("flex").removeClass("hidden");
	}
	function closeZaloContactModal() {
		if (submitting) return;
		$(".zalo-contact-modal").removeClass("flex").addClass("hidden");
		$(".zalo-contact-modal [name=phone]").val("");
		$(".zalo-contact-modal .error-phone").html("");
	}
	$(".doctor-zalo").click(function () {
		const doctorId = $(this).data("doctor-id");
		openZaloContactModal(doctorId);
		return false;
	});
	$(".zalo-contact-modal .close-modal").click(function () {
		closeZaloContactModal();
	});
	$(".zalo-contact-modal").each(function () {
		const $root = $(this);
		$root.find('[name="phone"]').change(function () {
			$(".zalo-contact-modal .error-phone").html("");
		});
		$root.find(".submit").click(function () {
			if (submitting) return;
			const phone = $root.find('[name="phone"]').val();
			if (!phone) {
				$(".zalo-contact-modal .error-phone").html(
					"Vui lòng nhập số điện thoại"
				);
				return;
			}
			if (!/(0|\+84|84)+([0-9]{9})\b/.test(phone)) {
				$(".zalo-contact-modal .error-phone").html(
					"Số điện thoại không đúng định dạng"
				);
				return;
			}
			const loadingToastify = Toastify({
				text: "Đang gửi thông tin...",
				duration: -1,
				newWindow: true,
				close: true,
				gravity: "top",
				position: "center",
				stopOnFocus: true,
				style: {
					background: "#fff",
					color: "#333",
				},
			});
			loadingToastify.showToast();
			submitting = true;

			const data = {
				action: "doctor_contact_form",
				_wpnonce: $root.find('[name="_wpnonce"]').val(),
				_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
				phone: phone,
				doctorId: doctorId,
			};

			$.ajax({
				url: AJAX_URL,
				type: "POST",
				dataType: "JSON",
				data: data,
				success: function (result) {
					submitting = false;
					loadingToastify.hideToast();
					if (result.success && result.doctorPhone) {
						window.open(`https://zalo.me/${result.doctorPhone}`, "_blank");
						closeZaloContactModal();
						return;
					}
					Toastify({
						text: result.message || "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
				},
				error: function () {
					loadingToastify.hideToast();
					Toastify({
						text: "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
					submitting = false;
				},
			});
		});
	});
});
/************************************ DOCTOR CONTACT MODAL ***********************/
/*********************************************************************************/

$(document).ready(function () {
	$(".history-back").click(function () {
		if (
			document.referrer &&
			new URL(document.referrer).host === new URL(window.location.href).host
		) {
			history.back();
		} else {
			location.replace(
				$(this).data("fallback") || "http://localhost:8888/phongkham/bac-si"
			);
		}
	});
});

$(document).ready(function () {
	$(".indicator-tabs").each(function () {
		const $root = $(this);
		const $tabsWrapper = $root.find(".tabs");
		const $tabs = $root.find(".tabs .tab");
		const $contentsWrapper = $root.find(".tab-contents");
		const $contents = $root.find(".tab-contents .tab-content");
		const $indicator = $(`<div class="indicator"></div>`);
		const $indicatorWrapper = $(`<div class="indicator-wrapper"></div>`);

		$indicatorWrapper.append($indicator);
		$tabsWrapper.append($indicatorWrapper);

		let tabsLocations = [];

		function updateLocations() {
			tabsLocations = [];
			const scrollLeft = $tabsWrapper.scrollLeft();
			$tabs.each(function () {
				const start = scrollLeft + $(this).position().left;
				const end = start + $(this).width();
				tabsLocations.push({ start, end });
			});
		}
		updateLocations();
		$(window).resize(updateLocations);
		setTimeout(updateLocations, 500);
		setTimeout(updateLocations, 1000);
		setTimeout(updateLocations, 3000);

		function updateUI() {
			let activeIndex = -1;
			$tabs.each(function (index) {
				if ($(this).hasClass("active")) {
					activeIndex = index;
				}
			});
			if (activeIndex >= 0) {
				const start = tabsLocations[activeIndex].start;
				const end = tabsLocations[activeIndex].end;
				$indicator.css("left", (start + end) / 2);
				const scrollLeft = $tabsWrapper.scrollLeft();
				const wrapperWidth = $tabsWrapper.innerWidth();
				if (scrollLeft > start) {
					$tabsWrapper.animate({ scrollLeft: start }, 100);
				} else if (scrollLeft + wrapperWidth < end) {
					$tabsWrapper.animate({ scrollLeft: end - wrapperWidth }, 100);
				}

				$contents.removeClass("active");
				$($contents[activeIndex]).addClass("active");
			}
		}
		updateUI();
		setTimeout(updateUI, 500);

		$tabs.click(function (index) {
			$tabs.removeClass("active");
			$(this).addClass("active");
			updateUI();
		});
	});
});

$(".pricing-detail-slider").slick({
	centerMode: true,
	slidesToShow: 1,
	slidesToScroll: 1,
	centerPadding: "40px",
	speed: 500,
	autoplay: false,
	autoplaySpeed: 3000,
	dots: false,
	arrows: false,
	infinite: true,
});

$(document).ready(function () {
	$(".section-advise").each(function () {
		const $root = $(this);
		const $adviseAge = $root.find(".advise-age");
		const $adviseStatus = $root.find(".advise-status");
		const $adviseDesire = $root.find(".advise-desire");
		const $adviseServices = $root.find(".advise-services");
		const $adviseDiaries = $root.find(".advise-diaries");
		const $statusDetail = $root.find(".status-details");
		let state = {
			serviceCategoryId: $root
				.find(".highlight-filter .item-active")
				.data("id"),

			age: $root.find("[name=age]:checked").val(),
			status: $root.find("[name=status]:checked").val(),
			desire: $root.find("[name=desire]:checked").val(),
		};

		function updateUI(prevState, nextState) {
			// Toggle category
			if (prevState.serviceCategoryId !== nextState.serviceCategoryId) {
				$adviseAge.addClass("hidden");
				$adviseStatus.addClass("hidden");
				$adviseDesire.addClass("hidden");
				$adviseServices.addClass("hidden");
				$adviseDiaries.addClass("hidden");
			}
			// Toggle age
			if (prevState.age !== nextState.age) {
				$adviseStatus.addClass("hidden");
				$adviseDesire.addClass("hidden");
				$adviseServices.addClass("hidden");
				$adviseDiaries.addClass("hidden");
				if (nextState.age) {
					$adviseStatus.removeClass("hidden");
				}
			}
			// Toggle status
			if (prevState.status !== nextState.status) {
				if (!nextState.status) $adviseDesire.addClass("hidden");
				else $adviseDesire.removeClass("hidden");
			}

			if (prevState.desire !== nextState.desire) {
				if (!nextState.desire) {
					$adviseServices.addClass("hidden");
					$adviseDiaries.addClass("hidden");
				} else {
					$adviseServices.removeClass("hidden");
					$adviseDiaries.removeClass("hidden");
				}
			}
			// Load age
			const serviceCategoryData = ADVISE_PRICING_DATA.data.find(
				(item) =>
					item["service-category"].term_id === nextState.serviceCategoryId
			);

			console.log({ serviceCategoryData });

			if (
				prevState.serviceCategoryId !== nextState.serviceCategoryId &&
				serviceCategoryData
			) {
				$adviseAge.removeClass("hidden");
				$root.find(".input-advise-age").html("");
				serviceCategoryData.data.map((item) => {
					item.ages.forEach((age) => {
						const label = (() => {
							const values = age.replace(/ /g, "").split("-");
							if (values[0] === "*") return "Dưới " + (parseInt(values[1]) + 1);
							if (values[1] === "*") return "Trên " + (parseInt(values[0]) - 1);
							return values[0] + " - " + values[1];
						})();
						$root.find(".input-advise-age").append(`
							<label class="check-button">
								<input type="radio" name="age" value="${age}" />
								<span class="label">
									${label}
								</span>
							</label>
						`);
					});
				});
			} else {
				$adviseStatus.removeClass("hidden");
			}
			// Load status
			const ageData = serviceCategoryData
				? serviceCategoryData.data.find((item) =>
						item.ages.includes(nextState.age)
				  )
				: [];
			if (
				(prevState.serviceCategoryId !== nextState.serviceCategoryId ||
					prevState.age !== nextState.age) &&
				ageData
			) {
				$root.find(".input-advise-status").html("");
				const addedIds = [];
				ageData.data.forEach((statusData) => {
					if (Array.isArray(statusData.status)) {
						statusData.status.forEach(function (status) {
							if (addedIds.includes(status.id)) return;
							addedIds.push(status.id);
							$root.find(".input-advise-status").append(`
                <label class="flex-shrink-0 cursor-pointer border-1 relative" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;margin-bottom: 24px;margin-left: 10px;border-radius: 10px;">
                  <div class="input-checkbox absolute right-0 top-0">
                    <input type="radio" name="status" value="${status.id}" class="input-status"/>
                    <div class="icon"></div>
                  </div>
                  <img class="w-[150px] flex-shrink-0" src="${status.url}" alt="" />
                </label>
              `);
						});
					} else {
						console.warn(
							"statusData.status is not an array:",
							statusData.status
						);
					}
				});
			} else {
				$adviseDesire.removeClass("hidden");
			}

			console.log({ ageData });

			if (
				(prevState.serviceCategoryId !== nextState.serviceCategoryId ||
					prevState.age !== nextState.age) &&
				ageData
			) {
				$root.find(".input-advise-desire").html("");
				const addedIds = [];
				ageData.data.forEach((desireData) => {
					console.log({ desireData });
					desireData.desire.forEach(function (desires) {
						if (addedIds.includes(desires.id)) return;
						addedIds.push(desires.id);
						$root.find(".input-advise-desire").append(`
            <label class="flex-shrink-0 cursor-pointer border-1  relative" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;margin-bottom: 24px;margin-left: 10px;border-radius: 10px;">
								<div class="input-checkbox absolute right-0 top-0">
									<input type="radio" name="desire" value="${desires.id}" />
									<div class="icon"></div>
								</div>
								<img class="w-[150px] flex-shrink-0" src="${desires.url}" alt="" />
							</label>
            `);
					});
				});
			}
			const statusDatas = ageData
				? ageData.data.filter((item) =>
						item.status.find((status) => nextState.status == status.id)
				  )
				: [];
			const services = (statusDatas || []).reduce(
				(prev, cur) => [...prev, ...cur.services],
				[]
			);
			const diaries = (statusDatas || []).reduce(
				(prev, cur) => [...prev, ...cur.diaries],
				[]
			);
			if (
				(prevState.serviceCategoryId !== nextState.serviceCategoryId ||
					prevState.age !== nextState.age ||
					prevState.status !== nextState.status) &&
				services
			) {
				$root.find(".service").html("");
				$root.find(".diary").html("");
				const displayedServiceIds = [];
				const displayedDiaries = [];
				services.forEach((service) => {
					// Tìm thông tin dịch vụ từ mảng SERVICE_PRICING
					const serviceData = SERVICE_PRICING.filter(
						(item) => item.id === service
					);

					if (serviceData.length > 0) {
						// Kiểm tra xem service id đã được hiển thị chưa
						if (!displayedServiceIds.includes(service)) {
							const serviceItem = serviceData[0]; // Lấy đối tượng dịch vụ từ mảng
							console.log({ serviceItem });

							// Thêm service id vào mảng đã hiển thị
							displayedServiceIds.push(service);

							// Thêm thông tin dịch vụ vào DOM
							$root.find(".service").append(`
                <div class="w-[150px] flex-shrink-0">
                  <a href="${
										serviceItem.link
									}" class="overflow-hidden h-full flex flex-col rounded-1.5">
                    <img class="img aspect-square lazy" src="${
											serviceItem.imageUrl
										}" />
                    <div class="flex-1 flex flex-col border-1 border-t-0 border-gray-300 rounded-b-1.5 p-3">
                      <div class="flex items-center mb-1.5" style="border-bottom:1px dashed #aaa;padding-bottom:8px">
                        <span class="text-10">${
													serviceItem?.rating +
													" / " +
													serviceItem?.rating_number
												} đánh giá</span>
                      </div>
                      <h3 class="text-12 font-semibold line-clamp-2">${
												serviceItem.title
											}</h3>
                      <div class="line-clamp-2 text-12 text-gray-600">${
												serviceItem.note ? serviceItem.note : ""
											}</div>
                      <div class="flex justify-between mt-2 flex-1 items-end">
                        <div class="text-12 font-semibold text-red-500">
                            ${new Intl.NumberFormat("vi-VN", {
															style: "currency",
															currency: "VND",
														}).format(serviceItem?.price)}
                        </div>
                        <div class="flex items-center gap-1">
                          <span class="text-10" style="border:1px solid #aaa;padding:0px 4px;border-radius:4px">${
														serviceItem.client_number
													}</span>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              `);
						}
					}
				});

				diaries.forEach((diary) => {
					// Tìm thông tin dịch vụ từ mảng SERVICE_PRICING
					const diaryData = DIARIES_PRICING.filter((item) => item.id === diary);
					console.log({ diaryData });

					if (diaryData.length > 0) {
						if (!displayedDiaries.includes(diary)) {
							const diaryItem = diaryData[0];
							console.log({ diaryItem });

							displayedDiaries.push(diary);
							let processingContent = "";

							diaryItem.processing?.forEach((processing, index) => {
								processingContent += `
                    <div class="relative pl-4 mb-5 after:w-2 after:h-2 after:absolute after:left-0 after:top-1.5 after:bg-[#999] after:rounded-full before:w-[1px] before:h-full before:bg-[#eee] before:absolute before:left-1 processing-item  data-index="${index}">
                      <div>${processing.time}</div>
                      <div style="font-size:13px; display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp:2; overflow: hidden;">${
												processing.description
											}</div>
                      <div class="mt-2 flex flex-wrap gap-2">
                        ${processing.images
													.map(
														(image) => `
                          <a class="w-[80px] h-[80px] block" href="${image}">
                            <img class="w-full h-full rounded-1" src="${image}" alt="" />
                          </a>
                        `
													)
													.join("")}
                      </div>
                    </div>
                  `;
							});
							$root.find(".diary").append(`
                <div class="swiper-slide"  style="margin-right:12px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;padding:12px;border-radius:8px;gap:4" >
                  <div style="display: flex; flex-direction: column;width:300px">
                    <div style="display: flex;gap:8px">
                      <img class="w-10 h-10 rounded-full border-1 border-text" src=${diaryItem.avatar} />
                      <div class="flex-1">
                        <h4 class="font-semibold">${diaryItem.fullname}</h4>
                        <div style=" display: flex; gap: 4px; align-items: center;">
                          <div class="text-[#bbb] text-12">${diaryItem.status}</div>
                        </div>
                      </div>
                    </div>
                    <div class="flex gap-2  items-center mt-2">
                      <div style="font-size:12px"> 
                          <a class="flex-shrink-0  ">
                            <div>Đã chia sẻ nhật ký làm đẹp dịch vụ <b class="text-12 font-bold">${diaryItem.services.post_title} </b> được <b>${diaryItem.doctor_name} </b> phụ trách điều trị tại <b>PK Trang Beauty Center</b> </div>
                          </a>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="mt-2 flex gap-2 mb-4">	
                      <?php if ($services && count($services)) : ?>
                      <div class="no-scrollbar flex overflow-x-auto  ">
                        <?php   $service = $services[0]; ?>
                        <a href="<?= get_permalink($service) ?>" class="flex-shrink-0 flex-1 gap-3 flex items-center ">
                          <img style="width:40px" class=" rounded-1" src=${diaryItem.services.image} alt="">
                          <div class="flex-1">
                            <h4 class=" text-12 mb-0.5 font-semibold" style="  width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">${diaryItem.services.post_title} </h4>
                            <div class="flex items-center gap-2 text-10 mb-0.5">
                              ${diaryItem.services.rating} / 5
                            </div>
                            
                          </div>
                        </a>
                      </div>
                      <?php endif; ?>
                      <div class="flex gap-2 items-center ">
                        <img style="width:40px" class=" rounded-1 border-1 border-[#ccc]" src=${diaryItem.doctor_image} />
                        <div class="flex-1">
                          <h4 class="text-12 mb-0.5 font-semibold" style="  width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">${diaryItem.doctor_name}</h4>
                          <div class="flex items-center gap-2 text-10 mb-0.5">
                           Đánh giá : ${diaryItem.doctor_rating} / 5
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="flex gap-2 mb-4">
                      <div class="flex-1">
                        <a>
                          <img class="w-[130px h-[130px] rounded-1 object-cover object-center" src=${diaryItem.imageBefore} />
                        </a>
                        <div class="mt-1 text-center" style="font-size:12px">Trước điều trị</div>
                      </div>
                      <div class="flex-1">
                        <a>
                          <img class="w-[130px h-[130px]  rounded-1 object-cover object-center" src=${diaryItem.imageAfter} />
                        </a>
                        <div class="mt-1 text-center"  style="font-size:12px">Sau điều trị</div>
                      </div>
                    </div>
                    <div class="processing-group">
                        ${processingContent}
                      </div>
                      
                    </div>
          
                </div>
              `);
						}
					}
				});
			}

			if (
				nextState.serviceCategoryId &&
				nextState.age &&
				nextState.status &&
				nextState.desire
			) {
				$root.find(".advise-footer").removeClass("hidden");
			} else {
				$root.find(".advise-footer").addClass("hidden");
			}
		}

		$root.find(".highlight-filter").change(function () {
			const nextState = Object.assign({}, state);
			nextState.serviceCategoryId = $root
				.find(".highlight-filter .item-active")
				.data("id");
			$root.find(`[name="serviceCategoryId"]`).val(nextState.serviceCategoryId);
			const prevState = state;
			state = nextState;
			updateUI(prevState, nextState);
		});

		$root.change(`[name=age]`, function () {
			const nextState = Object.assign({}, state);
			nextState.age = $root.find(`[name=age]:checked`).val();
			const prevState = state;
			state = nextState;
			updateUI(prevState, nextState);
		});

		$root.change(`[name=status]`, function () {
			const nextState = Object.assign({}, state);
			nextState.status = $root.find(`[name=status]:checked`).val();
			const prevState = state;
			state = nextState;
			updateUI(prevState, nextState);
		});

		$root.change(`[name=desire]`, function () {
			const nextState = Object.assign({}, state);
			nextState.desire = $root.find(`[name=desire]:checked`).val();
			const prevState = state;
			state = nextState;
			updateUI(prevState, nextState);
		});
	});
	$(".advise-form-popup").each(function () {
		const $root = $(this);
		let submitting = false;

		$root.find(".submit").click(function () {
			if (submitting) return;
			const phone = $root.find('[name="phone"]').val();
			if (!phone) {
				$root.find(".error-phone").html("Vui lòng nhập số điện thoại");
				return;
			}
			if (!/(0|\+84|84)+([0-9]{9})\b/.test(phone)) {
				$root.find(".error-phone").html("Số điện thoại không đúng định dạng");
				return;
			}

			submitting = true;
			const loadingToastify = Toastify({
				text: "Đang gửi thông tin...",
				duration: -1,
				newWindow: true,
				close: true,
				gravity: "top",
				position: "center",
				stopOnFocus: true,
				style: {
					background: "#fff",
					color: "#333",
				},
			});
			loadingToastify.showToast();
			const data = {
				action: "price_form",
				_wpnonce: $root.find('[name="_wpnonce"]').val(),
				_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
				phone: phone,
				...ADVISE_PRICING_FORM_DATA,
			};

			$.ajax({
				url: AJAX_URL,
				type: "POST",
				dataType: "JSON",
				data: data,
				success: function (result) {
					loadingToastify.hideToast();
					if (!result.success) {
						Toastify({
							text: result.message || "Đã xảy ra lỗi",
							duration: 3000,
							newWindow: true,
							close: true,
							gravity: "top",
							position: "center",
							stopOnFocus: true,
							style: {
								background: "#ef4444",
							},
						}).showToast();
					} else {
						$root.hide();
						$("html,body").css("overflow", "auto");
						$(".section-advise-detail").find("[name=phone]").val(phone);
					}
					submitting = false;
				},
				error: function () {
					loadingToastify.hideToast();
					Toastify({
						text: "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
					submitting = false;
				},
			});
		});
	});
	$(".booking-success-modal").each(function () {
		const $root = $(this);
		$root.find(".close").click(function () {
			$root.removeClass("flex").addClass("hidden");
		});
	});
	$(".section-advise-detail").each(function () {
		const $root = $(this);
		let submitting = false;

		$root.find(".submit").click(function () {
			if (submitting) return;
			const phone = $root.find('[name="phone"]').val();
			if (!phone) {
				$root.find(".error-phone").html("Vui lòng nhập số điện thoại");
				return;
			}
			if (!/(0|\+84|84)+([0-9]{9})\b/.test(phone)) {
				$root.find(".error-phone").html("Số điện thoại không đúng định dạng");
				return;
			}

			submitting = true;
			const loadingToastify = Toastify({
				text: "Đang gửi thông tin...",
				duration: -1,
				newWindow: true,
				close: true,
				gravity: "top",
				position: "center",
				stopOnFocus: true,
				style: {
					background: "#fff",
					color: "#333",
				},
			});
			loadingToastify.showToast();
			const data = {
				action: "booking_price_form",
				_wpnonce: $root.find('[name="_wpnonce"]').val(),
				_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
				phone: phone,
				...ADVISE_PRICING_FORM_DATA,
			};

			$.ajax({
				url: AJAX_URL,
				type: "POST",
				dataType: "JSON",
				data: data,
				success: function (result) {
					loadingToastify.hideToast();
					if (!result.success) {
						Toastify({
							text: result.message || "Đã xảy ra lỗi",
							duration: 3000,
							newWindow: true,
							close: true,
							gravity: "top",
							position: "center",
							stopOnFocus: true,
							style: {
								background: "#ef4444",
							},
						}).showToast();
					} else {
						$(".booking-success-modal").addClass("flex").removeClass("hidden");
					}
					submitting = false;
				},
				error: function () {
					loadingToastify.hideToast();
					Toastify({
						text: "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444",
						},
					}).showToast();
					submitting = false;
				},
			});
		});
	});
});
$(".modal-buffet").each(function () {
	const $root = $(this);
	let submitting = false;

	$root.find(".submit").click(function () {
		if (submitting) return; // Đảm bảo không gửi nhiều lần

		const phone = $root.find('[name="phone"]').val(); // Lấy giá trị của số điện thoại
		if (!phone) {
			$root.find(".error-phone").html("Vui lòng nhập số điện thoại");
			return;
		}
		if (!/(0|\+84|84)+([0-9]{9})\b/.test(phone)) {
			$root.find(".error-phone").html("Số điện thoại không đúng định dạng");
			return;
		}

		submitting = true; // Đánh dấu đang gửi form

		// Hiển thị thông báo đang gửi
		const loadingToastify = Toastify({
			text: "Đang gửi thông tin...",
			duration: -1, // Không tự động tắt
			newWindow: true,
			close: true,
			gravity: "top",
			position: "center",
			stopOnFocus: true,
			style: {
				background: "#fff",
				color: "#333",
			},
		});
		loadingToastify.showToast();

		// Dữ liệu gửi đi
		const data = {
			action: "buffet_form",
			_wpnonce: $root.find('[name="_wpnonce"]').val(),
			_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
			phone: phone,
			name: $root.find('[name="name"]').val(),
			buffet_package: $root.find('[name="buffet_package"]').val(),
			order_type: $root.find('[name="order_type"]').val(),
		};

		// Gửi AJAX request
		$.ajax({
			url: AJAX_URL, // URL của admin-ajax.php
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function (result) {
				loadingToastify.hideToast(); // Ẩn thông báo gửi đi
				if (!result.success) {
					Toastify({
						text: result.message || "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444", // Màu đỏ cho thông báo lỗi
						},
					}).showToast();
				} else {
					$root.fadeOut(500, function () {
						// Sau khi fade out, thêm các bước khác:
						$root.hide(); // Ẩn hẳn modal nhập
						document.documentElement.style.overflow = "hidden";
						document.body.style.overflow = "hidden";
						$(".buffet-success-modal")
							.addClass("flex hidden") // Đảm bảo class "hidden" đã được thêm
							.fadeIn(500, function () {
								$(this).removeClass("hidden"); // Gỡ class hidden sau khi fade in hoàn tất
							});

						// Reset form
						$root.find("input[type='text'], input[type='tel'], select").val("");
						$root.find(".error-phone").html("");
						// Ẩn modal thành công sau 3 giây và bật lại scroll
						setTimeout(function () {
							$(".buffet-success-modal").fadeOut(500, function () {
								$(this).addClass("hidden").removeClass("flex");
								// Bật lại scroll sau khi modal bị ẩn
								document.documentElement.style.overflow = "";
								document.body.style.overflow = "";
							});
						}, 3000); // Thời gian ẩn: 3000ms = 3 giây
					});
				}
				submitting = false; // Đánh dấu gửi form xong
			},
			error: function () {
				loadingToastify.hideToast(); // Ẩn thông báo gửi đi khi lỗi
				Toastify({
					text: "Đã xảy ra lỗi",
					duration: 3000,
					newWindow: true,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "#ef4444", // Màu đỏ cho thông báo lỗi
					},
				}).showToast();
				submitting = false; // Đánh dấu gửi form xong
			},
		});
	});
});
$(".modal-people").each(function () {
	const $root = $(this);
	let submitting = false;

	$root.find(".submit").click(function () {
		if (submitting) return; // Đảm bảo không gửi nhiều lần

		const phone = $root.find('[name="phone"]').val(); // Lấy giá trị của số điện thoại
		const quantity = $root.find('[name="so_luong"]').val(); // Lấy giá trị số lượng

		if (quantity <= 0) {
			$root.find(".error-quantity").html("Vui lòng nhập số lượng hợp lệ"); // Hiển thị lỗi nếu không hợp lệ
			return;
		}
		if (!phone) {
			$root.find(".error-phone").html("Vui lòng nhập số điện thoại");
			return;
		}
		if (!/(0|\+84|84)+([0-9]{9})\b/.test(phone)) {
			$root.find(".error-phone").html("Số điện thoại không đúng định dạng");
			return;
		}

		submitting = true; // Đánh dấu đang gửi form

		// Hiển thị thông báo đang gửi
		const loadingToastify = Toastify({
			text: "Đang gửi thông tin...",
			duration: -1, // Không tự động tắt
			newWindow: true,
			close: true,
			gravity: "top",
			position: "center",
			stopOnFocus: true,
			style: {
				background: "#fff",
				color: "#333",
			},
		});
		loadingToastify.showToast();

		// Dữ liệu gửi đi
		const data = {
			action: "buffet_form_people",
			_wpnonce: $root.find('[name="_wpnonce"]').val(),
			_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
			phone: phone,
			name: $root.find('[name="name"]').val(),
			buffet_package: $root.find('[name="buffet_package"]').val(),
			so_luong: quantity,
			order_type: $root.find('[name="order_type"]').val(),
		};

		// Gửi AJAX request
		$.ajax({
			url: AJAX_URL, // URL của admin-ajax.php
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function (result) {
				loadingToastify.hideToast(); // Ẩn thông báo gửi đi
				if (!result.success) {
					Toastify({
						text: result.message || "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444", // Màu đỏ cho thông báo lỗi
						},
					}).showToast();
				} else {
					$root.fadeOut(500, function () {
						// Sau khi fade out, thêm các bước khác:
						$root.hide(); // Ẩn hẳn modal nhập
						document.documentElement.style.overflow = "hidden";
						document.body.style.overflow = "hidden";
						$(".buffet-success-modal")
							.addClass("flex hidden") // Đảm bảo class "hidden" đã được thêm
							.fadeIn(500, function () {
								$(this).removeClass("hidden"); // Gỡ class hidden sau khi fade in hoàn tất
							});

						// Reset form
						$root.find("input[type='text'], input[type='tel'], select").val("");
						$root.find(".error-phone").html("");
						// Ẩn modal thành công sau 3 giây và bật lại scroll
						setTimeout(function () {
							$(".buffet-success-modal").fadeOut(500, function () {
								$(this).addClass("hidden").removeClass("flex");
								// Bật lại scroll sau khi modal bị ẩn
								document.documentElement.style.overflow = "";
								document.body.style.overflow = "";
							});
						}, 3000); // Thời gian ẩn: 3000ms = 3 giây
					});
				}
				submitting = false; // Đánh dấu gửi form xong
			},
			error: function () {
				loadingToastify.hideToast(); // Ẩn thông báo gửi đi khi lỗi
				Toastify({
					text: "Đã xảy ra lỗi",
					duration: 3000,
					newWindow: true,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "#ef4444", // Màu đỏ cho thông báo lỗi
					},
				}).showToast();
				submitting = false; // Đánh dấu gửi form xong
			},
		});
	});
});
$(".modal-gift").each(function () {
	const $root = $(this);
	let submitting = false;

	$root.find(".submit").click(function () {
		if (submitting) return; // Đảm bảo không gửi nhiều lần

		const phone = $root.find('[name="phone"]').val(); // Lấy giá trị của số điện thoại
		if (!phone) {
			$root.find(".error-phone").html("Vui lòng nhập số điện thoại");
			return;
		}
		if (!/(0|\+84|84)+([0-9]{9})\b/.test(phone)) {
			$root.find(".error-phone").html("Số điện thoại không đúng định dạng");
			return;
		}

		submitting = true; // Đánh dấu đang gửi form

		// Hiển thị thông báo đang gửi
		const loadingToastify = Toastify({
			text: "Đang gửi thông tin...",
			duration: -1, // Không tự động tắt
			newWindow: true,
			close: true,
			gravity: "top",
			position: "center",
			stopOnFocus: true,
			style: {
				background: "#fff",
				color: "#333",
			},
		});
		loadingToastify.showToast();

		// Dữ liệu gửi đi
		const data = {
			action: "buffet_form",
			_wpnonce: $root.find('[name="_wpnonce"]').val(),
			_wp_http_referer: $root.find('[name="_wp_http_referer"]').val(),
			phone: phone,
			name: $root.find('[name="name"]').val(),
			buffet_package: $root.find('[name="buffet_package"]').val(),
			order_type: $root.find('[name="order_type"]').val(),
		};

		// Gửi AJAX request
		$.ajax({
			url: AJAX_URL, // URL của admin-ajax.php
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function (result) {
				loadingToastify.hideToast(); // Ẩn thông báo gửi đi
				if (!result.success) {
					Toastify({
						text: result.message || "Đã xảy ra lỗi",
						duration: 3000,
						newWindow: true,
						close: true,
						gravity: "top",
						position: "center",
						stopOnFocus: true,
						style: {
							background: "#ef4444", // Màu đỏ cho thông báo lỗi
						},
					}).showToast();
				} else {
					$root.fadeOut(500, function () {
						// Sau khi fade out, thêm các bước khác:
						$root.hide(); // Ẩn hẳn modal nhập
						document.documentElement.style.overflow = "hidden";
						document.body.style.overflow = "hidden";
						$(".buffet-success-modal")
							.addClass("flex hidden") // Đảm bảo class "hidden" đã được thêm
							.fadeIn(500, function () {
								$(this).removeClass("hidden"); // Gỡ class hidden sau khi fade in hoàn tất
							});

						// Reset form
						$root.find("input[type='text'], input[type='tel'], select").val("");
						$root.find(".error-phone").html("");
						// Ẩn modal thành công sau 3 giây và bật lại scroll
						setTimeout(function () {
							$(".buffet-success-modal").fadeOut(500, function () {
								$(this).addClass("hidden").removeClass("flex");
								// Bật lại scroll sau khi modal bị ẩn
								document.documentElement.style.overflow = "";
								document.body.style.overflow = "";
							});
						}, 3000); // Thời gian ẩn: 3000ms = 3 giây
					});
				}
				submitting = false; // Đánh dấu gửi form xong
			},
			error: function () {
				loadingToastify.hideToast(); // Ẩn thông báo gửi đi khi lỗi
				Toastify({
					text: "Đã xảy ra lỗi",
					duration: 3000,
					newWindow: true,
					close: true,
					gravity: "top",
					position: "center",
					stopOnFocus: true,
					style: {
						background: "#ef4444", // Màu đỏ cho thông báo lỗi
					},
				}).showToast();
				submitting = false; // Đánh dấu gửi form xong
			},
		});
	});
});
