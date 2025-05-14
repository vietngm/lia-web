jQuery(function ($) {
	$("#booking").on("click", function () {
		const doctorSelect = $(".input-doctor select");
		doctorSelect.html('<option value="">Chọn chuyên viên</option>');
	});
	$(".js-branch").on("change", function () {
		const doctors = BOOKING_DATA.doctors;
		var address = $("option:selected", this).attr("data-address");
		var branchName = $("option:selected", this).text();
		var ids = $("option:selected", this).attr("data-ids")
			? JSON.parse($("option:selected", this).attr("data-ids"))
			: [];

		const doctorIds = Array.isArray(ids) ? ids : [];
		const filteredDoctors = doctors.filter((doctor) =>
			doctorIds.includes(doctor.id)
		);

		const doctorSelect = $(".input-doctor select");
		doctorSelect.html('<option value="">Chọn chuyên viên</option>');

		if (!address || !branchName) {
			$(".branch-name").empty().append("LiA Beauty Center");
			$(".branch-address")
				.empty()
				.append(
					"Số 434, Đường Cao Thắng ( nối dài ), Phường 12, Quận 10, TP.HCM"
				);
		} else {
			$(".branch-name").empty().append(branchName);
			$(".branch-address").empty().append(address);

			filteredDoctors.forEach((doctor) => {
				doctorSelect.append(
					`<option value="${doctor.id}">${doctor.title}</option>`
				);
			});
		}
	});
});
