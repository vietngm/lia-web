import { scheduleJob } from "node-schedule";

jQuery(function ($) {
	const job = scheduleJob("*/2 * * * *", function () {
		$(document)
			.find(`.sync-status-item`)
			.empty()
			.append(
				'<span class="dashicons dashicons-yes-alt dashicons-success"></span>'
			);
	});
});
