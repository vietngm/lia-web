<?php
        $field = get_query_var('field');
        $price = $field["price"] ? $field["price"] : 0;
        $discountPrice = $field["discountPrice"] ? $field["discountPrice"] : 0;
        $discountPercentage = ($price > 0 && $discountPrice < $price) 
        ? round((($price - $discountPrice) / $price) * 100) 
        : 0;
    ?>
<head>
    <style>
        .border-zalo-bottom {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .consultant-zalo-bottom-v1 {
            border-radius: 8px;
            padding: 6px 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            flex-direction: column;
            border: 1px solid #cacaca;
            width: 120px;
        }
		.bottom-action {
				position: fixed;
				bottom: 0;
				left: 0;
				right: 0;
				background-color: white;
				border-top: 1px solid #eee;
				z-index: 10;
				transform: translateY(0);
				transition: transform 0.4s ease-in-out !important;
				will-change: transform; /* Tối ưu hiệu suất */
				pointer-events: auto; /* Đảm bảo không bị chặn click */
			}
		.modal-booking {
			display: none; /* Ẩn modal */
			opacity: 0; /* Mờ hoàn toàn */
			transform: scale(0.9); /* Thu nhỏ modal một chút */
			transition: opacity 0.3s ease, transform 0.3s ease; /* Hiệu ứng chuyển đổi */
		}

		/* Trạng thái hiển thị modal */
		.modal-booking.show{
			display: flex; /* Hiển thị modal */
			opacity: 1; /* Hiện rõ */
			transform: scale(1); /* Phóng về kích thước ban đầu */

			
		}
        @keyframes shine {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

@keyframes glow {
    0%, 50% {
    box-shadow: 0 0 7px #1a5478;
}
30% {
    box-shadow: 0 0 5px #1a5478;
}
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-2px); }
    50% { transform: translateX(2px); }
    75% { transform: translateX(-1px); }
}

@keyframes sparkle {
    0%, 100% { opacity: 0.6; transform: translateY(0); }
    50% { opacity: 1; transform: translateY(-3px); }
}

/* Nút chính */
.consultant-zalo-bottom-v2 {
    position: relative;
    display: inline-block;
    padding: 6px 24px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    color: white;
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(90deg, #1a5478, #1a5478b8, #1a5478);
    background-size: 200% 100%;
    animation: shine 2.5s infinite linear, glow 1.5s infinite alternate;
    transition: transform 0.2s ease-in-out, box-shadow 0.3s ease-in-out;
}

/* Hiệu ứng rung sau 5 giây để kích thích click */
@keyframes delayedShake {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(3px); }
}
.consultant-zalo-bottom-v2.shake {
    animation: delayedShake 0.3s ease-in-out 5s infinite;
}

/* Hover: Hiệu ứng nhấp nháy mạnh hơn */
.consultant-zalo-bottom-v2:hover {
    transform: scale(1.15);
    box-shadow: 0 0 50px #1a5478;
}

/* Active: Khi bấm xuống */
.consultant-zalo-bottom-v2:active {
    transform: scale(0.95);
    box-shadow: 0 0 15px #1a5478;
}

/* Thêm hiệu ứng lấp lánh */
.consultant-zalo-bottom-v2::after {
    content: "";
    position: absolute;
    top: -20px;
    left: -20px;
    width: 50px;
    height: 50px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 10%, rgba(255, 255, 255, 0) 50%);
    opacity: 0.6;
    animation: sparkle 2.5s infinite linear;
}
.consultant-zalo-bottom-v2 .discount-text {
    font-size: 14px; /* Tăng kích thước chữ */
    font-weight: bold;
    color:rgb(255, 255, 255); /* Màu vàng nhạt giúp dễ nhìn hơn */
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6); /* Bóng mờ giúp chữ không bị chìm */
    letter-spacing: 0.5px; /* Giãn chữ một chút để rõ ràng hơn */
}
    </style>
</head>
<script>
	document.addEventListener("DOMContentLoaded", () => {
    const totalPrice = localStorage.getItem("totalPrice") || 0;
    const formattedPrice = new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
    document.getElementById("footer-total-price").textContent = formattedPrice;
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const bottomAction = document.querySelector(".bottom-action"); 
    let lastScrollTop = 0;

    window.addEventListener("scroll", () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        

        if (scrollTop > lastScrollTop) {
            bottomAction.style.transform = "translateY(100%)";
        } else {
            bottomAction.style.transform = "translateY(0)";
        }

        lastScrollTop = scrollTop;
    });
});


</script>

<div class="h-[100px] flex items-center border-t-1 border-[#ccc] fixed bottom-0 left-0 right-0 bg-white bottom-action " style="border-top:1px solid #eee; z-index:10">
    <div class="container">
        <div class="flex items-center p-2 justify-end text-12" style="padding-top:12px">
        Tổng cộng : 
        <div class="text-12 font-semibold text-red-500 flex items-center gap-2 " style="margin-left:4px">
            <?php if (!empty($discountPrice) && $discountPrice < $price) : ?>
                <div class="flex items-center gap-2">
                    <span class="text-red-500 ml-2 new-price" style="font-weight:700;font-size:14px">
                        <?= number_format($discountPrice, 0, ",", ".") ?><small><u>đ</u></small>
                    </span>
                </div>
                <span class="text-gray-400 line-through opacity-70 old-price" style="color:#ccc;font-size:12px">
                    <?= number_format($price, 0, ",", ".") ?><small><u>đ</u></small>
                </span>
               
            <?php else : ?>
                <?= number_format($price, 0, ",", ".") ?> <small><u>đ</u></small>
            <?php endif; ?>
        </div>
    </div>
        <div style="display:flex;align-items:center;gap:12px;justify-content:space-between;padding-bottom:20px" >
            <div class="col-span-1">
                <a href="tel:<?= get_field('header_phone', 'option') ?>"  target="_blank" style="gap:2px;justify-content: center;display:flex;align-items:center;flex-direction: column;" >
                    <img class="w-5 h-5" src="<?= get_theme_file_uri('assets/images/icons/call-incoming.svg') ?>" />
                    <div style="font-size:12px">Hotline</div>
                </a>
            </div>
            <div class="col-span-1">
                <a href="<?= get_permalink(get_field('page_doctor', 'option')) ?>" class="consultant-zalo-bottom-v1">
                    <div class="border-zalo-bottom">
                        <div style="font-weight:700">Chuyên viên</div>
                    </div>
                    <div style="font-size:10px">Tư vấn 1-1</div>
                </a>
            </div>
            <div class="col-span-1">
				<button id="booking"  class="consultant-zalo-bottom-v2">
                    <div style="font-weight:700">Đặt lịch ngay</div>
                    <div style="font-size:10px" class="discount-text">Tiết kiệm : <?= $discountPercentage ?>%</div>
                </button>
            </div>
        </div>
    </div>
	
</div>
