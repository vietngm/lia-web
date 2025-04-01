async function createBooking(data) {
	const { apiUrl, token } = data;

	try {
		const response = await fetch(`${apiUrl}/booking/web-portal`, {
			method: "POST",
			headers: {
				Authorization: `Bearer ${token}`,
				"Content-Type": "application/json",
			},
			body: JSON.stringify(data),
		});

		if (!response.ok) {
			throw new Error(`${response.status}`);
		}

		const result = await response.json();
		if (result && result.data) {
			console.log("LiA APP:", data);
		} else {
			console.warn("Không có dữ liệu hợp lệ:", result);
		}
	} catch (error) {
		console.error("Lỗi khi lấy dữ liệu:", error);
	}
}
