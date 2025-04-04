import { scheduleJob } from "node-schedule";

jQuery(function ($) {
	const job = scheduleJob("*/2 * * * *", function () {
		console.log("The answer to life, the universe, and everything!");
		$(document)
			.find(`.sync-status-item`)
			.empty()
			.append(
				'<span class="dashicons dashicons-yes-alt dashicons-success"></span>'
			);
	});
});
