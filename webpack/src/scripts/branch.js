jQuery(function ($) {
	$(".js-branch").on("change", function () {
		var address = $("option:selected", this).attr("data-address");
		var branchName = $("option:selected", this).text();
		console.log(address);
		console.log(branchName);

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
		}
	});
});
