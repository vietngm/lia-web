jQuery(function ($) {
	root = $(this);

	$(".btn-auth").on("click", async function (e) {
		const username = root.find('[name="username"]').prop("value");
		const password = root.find('[name="password"]').prop("value");
		const endpoint = root.find('[name="endpoint"]').val();

		if (endpoint === "") {
			$.fancybox("#modal-environment", {
				modal: true,
				showCloseButton: false,
			});
			return false;
		}

		if (username === "" || password === "") {
			$.fancybox("#modal-account", {
				modal: true,
				showCloseButton: false,
			});
			return false;
		}

		$.fancybox("#modal-wait", {
			modal: true,
			showCloseButton: false,
		});

		$.ajax({
			url: endpoint + "/auth/sign-in",
			type: "POST",
			dataType: "JSON",
			data: {
				username: username,
				password: password,
			},
			success: async function (result) {
				if (result) {
					const token = result.data.token;
					const refreshToken = result.data.refreshToken;
					await saveToken(token, refreshToken);
					console.log("Sign in successfully");
				} else {
					console.log(result);
				}
			},
			error: function () {
				$.fancybox("#modal-account", {
					modal: true,
					showCloseButton: false,
				});
				console.log("Loi khong ro ly do.");
			},
		});

		return false;
	});

	async function saveToken(token, refreshToken) {
		$.ajax({
			url: AJAX_URL,
			type: "POST",
			data: {
				action: "auth",
				token: token,
				refreshToken: refreshToken,
			},
			success: async function (result) {
				if (result) {
					$.fancybox({ closeExisting: true });
					$("#post-body").append(htmlActions());
					$("#login-status p strong").text("Đăng nhập thành công.");
					$("#login-status").append(htmlLogout());
					$("#wpbody-content").append(htmlToken(token));
					$("#login").remove();
					$("#login-status").removeClass("error").addClass("updated");
				} else {
					console.log("Token luu khong thanh cong.");
				}
			},
			error: function () {
				console.log("Loi khong ro ly do.");
			},
		});
	}

	function htmlActions() {
		html = '<div class="postbox">';
		html += '<h3 class="hndle"><span>Actions</span></h3>';
		html += '<div class="inside environment">';
		html +=
			'<input type="button" name="service" class="button btn-service" value="Service Sync"/>';
		html +=
			'<input type="button" name="doctor" class="button btn-doctor" value="Doctor Sync"/>';
		html += "</div></div>";
		return html;
	}

	function htmlToken(token) {
		html = `<input type="hidden" name="token" value="${token}">`;
		return html;
	}

	function htmlLogout() {
		html = '<form name="form-sync-data" method="post" action="">';
		html +=
			'<input type="submit" name="logout" id="logout" class="logout" value="Log Out" />';
		html += "</form>";
		return html;
	}
});
