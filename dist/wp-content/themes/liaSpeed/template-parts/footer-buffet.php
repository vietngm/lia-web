<?php $is_result = $_SERVER['REQUEST_METHOD'] == "POST" ?>
<?php
$buffets = get_posts(array(
    "post_type" => "package_buffet", 
    "posts_per_page" => -1, 
    "orderby" => "date",     
    "order" => "ASC",       
));


$buffet_data = [];
foreach ($buffets as $buffet) {
    $buffet_data[] = array(
        "ID" => $buffet->ID,
        "title" => get_the_title($buffet->ID),             
        "image" => get_the_post_thumbnail_url($buffet->ID), 
		"note" => get_field("note", $buffet->ID),       
		"description" => get_field("description", $buffet->ID),    
        "custom_field" => get_field("custom_field_key", $buffet->ID), 
		"slogan" => get_field("slogan", $buffet->ID), 
		"tiet_kiem" => get_field("tiet_kiem", $buffet->ID), 
    );
}
?>

<main>
	<div class="buffet-success-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4">
		<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
		<div class="relative z-1 m-auto p-4 rounded-2 bg-white w-full max-w-[600px]">
			<div style="display: flex;align-items: center;justify-content: center;margin-bottom: 24px;">
				<img class="w-10 h-10" src="<?= get_theme_file_uri("assets/images/icons/check-circle.svg") ?>" alt="" />
			</div>
			<div class="text-center text-14" style="position: relative;display: flex;justify-content: center;">
				<span style="font-weight:700;font-size:20px">THÔNG TIN ĐÃ ĐƯỢC GHI NHẬN</span>
				<div class="border-vertical" style="border: 2px solid #1a5478;
					position: absolute;
					width: 35%; 
					display: flex;
					align-items: center;
					justify-content: center;
					bottom: -6px;"></div>
			</div>
			<div style="margin-top:24px;text-align:center">
				*Lưu ý:  Tổng đài viên Phòng khám LiA Beauty sẽ gọi lại
				cho Quý khách để xác nhận thông tin dựa theo 
				đăng ký. Cảm ơn Quý khách hàng đã đăng kí chương trình của
				chúng tôi
			</div>
		</div>
	</div>
	<div id="modal-success" class="modal-success modal-buffet fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4 modal-popup">
		<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
		<div class="relative z-1 m-auto rounded-2 bg-white w-full max-w-[600px] background-modal">
			<div class="section-modal">
				<img class="w-full" src="<?= get_theme_file_uri("assets/images/banner.png") ?>" alt="" />
			</div>
			<div class="p-4">
				<div class="close-modal absolute right-0 top-0 p-2 cursor-pointer">
					<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
				</div>
				<div class="buffet-form-container">
					<input type="hidden" name="order_type" value="mua_cho_toi">
					<div class="name-input" style="position: relative;">
						<input placeholder="*Họ và tên:" type="text" id="name" name="name" required />
					</div>
					<div class="name-input" style="position: relative;">
					<input  placeholder="*Số diện thoại:" type="tel" id="phone" name="phone" required pattern="[0-9]{10}"/>
					</div>
					<div class="input-select mb-4 input-doctor">
						<select name="buffet_package" placeholder="*Gói Buffet yêu thích" required>
							<option value="">Chọn gói buffet:</option>
							<?php foreach ($buffet_data as $buffet) : ?>
								<option value="<?= $buffet["ID"] ?>"><?= $buffet["title"] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<?= wp_nonce_field('buffet_form'); ?>
					<div class="text-center">
						<button type="button" class="submit btn w-full text-center py-2.5 justify-center"
							style="background:#F44025;border:1px solid #FFF;border-radius:24px">
							Gửi thông tin
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-success-people"  class="modal-success modal-people otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4 modal-popup" >
		<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
		<div class="relative z-1 m-auto rounded-2 bg-white w-full max-w-[600px] background-modal" >
			<div class="section-modal">
				<img class="w-full" src="<?= get_theme_file_uri("assets/images/banner.png") ?>" alt="" />
			</div>
			<div class="p-4">
				<div class="close-modal absolute right-0 top-0 p-2 cursor-pointer">
					<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
				</div>
				<div class="buffet-form-container">
				<input type="hidden" name="order_type" value="mua_chung">
				<div class="name-input "  style="position: relative;">
					<input placeholder="*Họ và tên người đại diện:" type="text" id="name" name="name" required />
				</div>
				<div class="name-input"  style="position: relative;">
				<input  placeholder="*Số diện thoại:" type="tel" id="phone" name="phone" required pattern="[0-9]{10}"/>
				</div>
				<div class="input-select mb-4 input-doctor">
					<select name="buffet_package" placeholder="*Gói Buffet yêu thích" required>
                        <option value="">Chọn gói buffet:</option>
                        <?php foreach ($buffet_data as $buffet) : ?>
                            <option value="<?= $buffet["ID"] ?>"><?= $buffet["title"] ?></option>
                        <?php endforeach; ?>
                    </select>
				</div>
				<div class="input-select mb-4 input-doctor">
					<select name="so_luong" placeholder="*Số lượng người mua chung" required>
                        <option value="">*Số lượng người mua chung:</option>
						<option value="2">2 Người</option>
						<option value="3">3 Người</option>
						<option value="4">4 Người</option>
						<option value="5">5 Người</option>
						<option value="6">6 Người</option>
                    </select>
				</div>
				<?= wp_nonce_field('buffet_form_people'); ?>
				<div class="text-center">
					<button class="submit btn w-full  text-center py-2.5 justify-center" style="background:#F44025;border:1px solid #FFF;border-radius:24px">
						Gửi thông tin
					</button>
				</div>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-success-gift"  class=" modal-success modal-gift otp-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4 modal-popup" >
		<div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"></div>
		<div class="relative z-1 m-auto rounded-2 bg-white w-full max-w-[600px] background-modal" >
			<div class="section-modal">
				<img class="w-full" src="<?= get_theme_file_uri("assets/images/banner.png") ?>" alt="" />
			</div>
			<div class="p-4">
				<div class="close-modal absolute right-0 top-0 p-2 cursor-pointer">
					<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
				</div>
				<div class="buffet-form-container">
				<input type="hidden" name="order_type" value="mua_tang">
				<div class="name-input "  style="position: relative;">
					<input placeholder="*Họ và tên người tặng:" type="text" id="name" name="name" required />
				</div>
				<div class="name-input"  style="position: relative;">
    				<input  placeholder="*Số diện thoại:" type="tel" id="phone" name="phone" required pattern="[0-9]{10}"/>
				</div>
				<div class="input-select mb-4 input-doctor">
					<select name="buffet_package" placeholder="*Gói Buffet muốn tặng" required>
                        <option value="">Vé buffet muốn tặng:</option>
                        <?php foreach ($buffet_data as $buffet) : ?>
                            <option value="<?= $buffet["ID"] ?>"><?= $buffet["title"] ?></option>
                        <?php endforeach; ?>
                    </select>
				</div>
				<?= wp_nonce_field('buffet_form'); ?>
				<div class="text-center">
					<button class="submit btn w-full  text-center py-2.5 justify-center" style="background:#F44025;border:1px solid #FFF;border-radius:24px">
						Gửi thông tin
					</button>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="h-[80px]" style="background:#7522A1"></div> -->
	<div class="h-[80px] flex items-center border-[#000] fixed bottom-0 left-0 right-0 bg-white bottom-action ">
		<div class="container">
			<div style="display:flex;align-items:center;gap:12px;justify-content:space-between">
				<div class="col-span-1" >
					<button id="confirm-button-gift"  class="submit "   style="gap:2px;justify-content: center;display:flex;align-items:center;flex-direction: column;" >
							<img class="w-6 h-7" src="<?= get_theme_file_uri("assets/images/shopping-cart.png") ?>" />
						<div style="font-size:12px;color:#FFF">Mua tặng</div>
					</button>
				</div>
				<div class="col-span-1">
					<button  id="confirm-button-people" class="submit  consultant-zalo-bottom"   >
						<div class="border-zalo-bottom">
							<div style="font-weight:700;display:flex;align-items:center;gap: 2px;">Mua chung
							<img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icon.png") ?>" />
							</div>
						</div>
						<div style="font-size:10px">Giảm đến 30%</div>
					</button>
				</div>
				<div class="col-span-1">
					<button id="confirm-button" class="submit  consultant-zalo-bottom"    >
							<div style="font-weight:700">Mua cho tôi</div>
						<div style="font-size:10px">Làm đẹp như Tỷ phú</div>
					</button>
				</div>
			
			</div>
		</div>
	</div>
</main>
<head>
	<style>


		.input-select .select2-selection{
			border-radius: 24px !important;
			z-index: 1000;
		
		}
		.buffet-success-modal {
  display: none; /* Ẩn mặc định */
}

.buffet-success-modal.flex {
  display: flex; /* Hiển thị dạng flex khi có class "flex" */
}
	.label {
		position: absolute;
		top: 11px;
		bottom: 0;
		left: 10px;
		
		font-size: 13px;
	}


	.buffet-form-container {
    color: white;
    border-radius: 10px;
    max-width: 400px;
    margin: auto;
	position: relative;
  }

  .buffet-form-container h3 {
    margin-bottom: 10px;
    font-size: 24px;
    line-height: 1.5;
  }

  .buffet-form-container form {
    display: flex;
    flex-direction: column;
  }

  .buffet-form-container label {
    text-align: left;
    margin-bottom: 5px;
	
  }

  .buffet-form-container input,
  .buffet-form-container select {
    padding: 10px ;
    margin-bottom: 15px;
    border-radius:24px !important;
    border: none;
    width: 100%;
	color: #444;
  }

  #submit-form {
    background: #ff5733;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }

  #submit-form:hover {
    background: #e94e2c;
  }
		.border-zalo-bottom {
    		display: flex;
			align-items: center;
			gap: 4px;
		}
		.consultant-zalo-bottom{
			border-radius: 30px;
			padding: 8px 20px !important;
			display: flex;
			justify-content: center;
			align-items: center;
			background:#fff;
			flex-direction: column;
		}
	
		.bottom-action {
			transform: translateY(0);
			transition: transform 0.4s ease-in-out;
			background: #70209b;
			z-index: 10;
		}
		/* Trạng thái mặc định (ẩn modal) */
	.modal-success {
		display: none; /* Ẩn modal */
		opacity: 0; /* Mờ hoàn toàn */
		transform: scale(0.9); /* Thu nhỏ modal một chút */
		transition: opacity 0.3s ease, transform 0.3s ease; /* Hiệu ứng chuyển đổi */
	}

	/* Trạng thái hiển thị modal */
	.modal-success.show {
		display: flex; /* Hiển thị modal */
		opacity: 1; /* Hiện rõ */
		transform: scale(1); /* Phóng về kích thước ban đầu */

		
	}
	.section-modal{
		background-image: url('http://phongkham.local/wp-content/themes/trangbeautycenter/assets/images/background-2.png');
		background-size: cover;
		background-attachment: scroll;
		background-repeat: round;
		overflow: hidden;
		border-top-left-radius: 16px;
	}

	.rounded-2 {
    border-radius: 16px;
    border-top-left-radius: 20px;
}
.background-modal{
	background-color:#561F63;
	color:#fff;
}
	</style>
</head>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const bottomAction = document.querySelector(".bottom-action"); 
    let lastScrollTop = 0; 
    let isScrolling; 

    window.addEventListener("scroll", () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop; 
        clearTimeout(isScrolling);
        if (scrollTop > lastScrollTop) {
            bottomAction.style.transform = "translateY(100%)";
        } else {
            bottomAction.style.transform = "translateY(0)";
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Lấy các phần tử
    const modal = document.getElementById('modal-success');
    const confirmButton = document.getElementById('confirm-button');
    const overlay = modal.querySelector('.bg-black');
    const closeModalButton = modal.querySelector('.close-modal');

    // Hiển thị modal với hiệu ứng mượt
    confirmButton.addEventListener('click', function () {
        modal.style.display = 'flex'; // Hiển thị modal
        setTimeout(() => {
            modal.classList.add('show'); // Thêm class để bắt đầu hiệu ứng
        }, 10); // Trễ một chút để hiệu ứng chạy mượt hơn
		document.documentElement.style.overflow = 'hidden'; // Ẩn scroll cho html
        document.body.style.overflow = 'hidden'; 
    });

    // Đóng modal với hiệu ứng mượt
    const closeModal = () => {
        modal.classList.remove('show'); // Loại bỏ hiệu ứng
        setTimeout(() => {
            modal.style.display = 'none'; // Ẩn modal sau khi hiệu ứng hoàn tất
        }, 300); // Chờ thời gian hoàn thành hiệu ứng (phù hợp với transition 0.3s)
		document.documentElement.style.overflow = ''; // Reset overflow
        document.body.style.overflow = ''; // Reset overflow
    };

    // Đóng khi nhấn overlay hoặc nút đóng
    closeModalButton.addEventListener('click', closeModal);
});

document.addEventListener('DOMContentLoaded', function () {
    // Lấy các phần tử
    const modal = document.getElementById('modal-success-people');
    const confirmButton = document.getElementById('confirm-button-people');
    const overlay = modal.querySelector('.bg-black');
    const closeModalButton = modal.querySelector('.close-modal');

    // Hiển thị modal với hiệu ứng mượt
    confirmButton.addEventListener('click', function () {
        modal.style.display = 'flex'; // Hiển thị modal
        setTimeout(() => {
            modal.classList.add('show'); // Thêm class để bắt đầu hiệu ứng
        }, 10); // Trễ một chút để hiệu ứng chạy mượt hơn
		document.documentElement.style.overflow = 'hidden'; // Ẩn scroll cho html
        document.body.style.overflow = 'hidden'; 
    });

    // Đóng modal với hiệu ứng mượt
    const closeModal = () => {
        modal.classList.remove('show'); // Loại bỏ hiệu ứng
        setTimeout(() => {
            modal.style.display = 'none'; // Ẩn modal sau khi hiệu ứng hoàn tất
        }, 300); // Chờ thời gian hoàn thành hiệu ứng (phù hợp với transition 0.3s)
		document.documentElement.style.overflow = ''; // Reset overflow
        document.body.style.overflow = ''; // Reset overflow
    };

    // Đóng khi nhấn overlay hoặc nút đóng
    closeModalButton.addEventListener('click', closeModal);
});


document.addEventListener('DOMContentLoaded', function () {
    // Lấy các phần tử
    const modal = document.getElementById('modal-success-gift');
    const confirmButton = document.getElementById('confirm-button-gift');
    const overlay = modal.querySelector('.bg-black');
    const closeModalButton = modal.querySelector('.close-modal');

    // Hiển thị modal với hiệu ứng mượt
    confirmButton.addEventListener('click', function () {
        modal.style.display = 'flex'; // Hiển thị modal
        setTimeout(() => {
            modal.classList.add('show'); // Thêm class để bắt đầu hiệu ứng
        }, 10); // Trễ một chút để hiệu ứng chạy mượt hơn
		document.documentElement.style.overflow = 'hidden'; // Ẩn scroll cho html
        document.body.style.overflow = 'hidden'; 
    });

    // Đóng modal với hiệu ứng mượt
    const closeModal = () => {
        modal.classList.remove('show'); // Loại bỏ hiệu ứng
        setTimeout(() => {
            modal.style.display = 'none'; // Ẩn modal sau khi hiệu ứng hoàn tất
        }, 300); // Chờ thời gian hoàn thành hiệu ứng (phù hợp với transition 0.3s)
		document.documentElement.style.overflow = ''; // Reset overflow
        document.body.style.overflow = ''; // Reset overflow
    };

    // Đóng khi nhấn overlay hoặc nút đóng
    closeModalButton.addEventListener('click', closeModal);
});
</script>