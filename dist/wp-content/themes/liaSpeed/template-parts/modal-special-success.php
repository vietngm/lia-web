 
     <?php
        $field = get_query_var('field');
    ?>
    <head>
        <style>
            .topping-row::-webkit-scrollbar {
                display: none;
            }
            .background-modal{
                height: 40%;
                display: flex;
                align-items: center;
                justify-content: center;
                bottom: 0;
                z-index: 1000000;
                position: absolute;
                background:#ffff;
                border-radius: 16px 16px 0px 0px;
            }
            .background-modal-success{
                height: 70%;
                display: flex;
                align-items: center;
                justify-content: center;
                bottom: 0;
                z-index: 1000000;
                position: absolute;
                background:#ffff;
                border-radius: 16px 16px 0px 0px;
            }
            .name-input-promotion input{
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 8px;
                margin-bottom: 10px;
            }
            .success-modal{
			display: none; /* Ẩn modal */
			opacity: 0; /* Mờ hoàn toàn */
			transform: scale(0.9); /* Thu nhỏ modal một chút */
			transition: opacity 0.3s ease, transform 0.3s ease; /* Hiệu ứng chuyển đổi */
		    }

        .success-modal.show {
            display: flex; /* Hiển thị modal */
            opacity: 1; /* Hiện rõ */
            transform: scale(1); /* Phóng về kích thước ban đầu */
        }
        </style>
    </head>
    <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
    <div class="relative m-auto rounded-2 w-full  background-modal p-4 z-[120]" >
        <div class=" overflow-hidden w-full h-full flex flex-col justify-between">
            <div class="flex justify-between items-center w-full">
                <div class="flex items-center w-full" style="flex-direction:column;justify-content:center">
                    <div class="text-center w-full text-16" style="font-weight:700">Nhận Voucher</div>
                </div>
                <div class="close-modal  cursor-pointer">
                    <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
                </div>
            </div>
            <div class=" overflow-auto w-1/2 h-full p-2 topping-row" style="height: 87%;overflow-y: auto;">
                <div class="relative z-1 m-auto rounded-2 w-full max-w-[600px] " >
                    <div class="buffet-form-container">
                        <div class="name-input-promotion"  style="position: relative;">
                            <input  placeholder="Số diện thoại" type="tel" id="phone" name="phone" required pattern="[0-9]{10}"/>
                        </div>
                        <div class="name-voucher"  style="position: relative;">
                            Nhận 10% giảm giá cho lần đầu tiên sử dụng dịch vụ tại LiA Beauty Center
                        </div>
                    </div>
                </div>
		    </div>
            <?= wp_nonce_field('buffet_form_people'); ?>
            <div class="text-center ">
                <button id="success" class="submit btn w-full  text-center py-2.5 justify-center" style="background: linear-gradient(94deg, #E91E63 0%, #fe6f89 40%);border:1px solid #FFF;border-radius:24px">
                    Gửi thông tin
                </button>
            </div>  
        </div>
    </div>
    <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
    <div id="success-modal" class="success-modal fixed hidden top-0 left-0 right-0 bottom-0 z-[120]" >
        <div class="relative m-auto rounded-2 w-full  background-modal-success p-4 z-[120]" >
            <div class=" overflow-hidden w-full h-full flex flex-col justify-between">
                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center w-full" style="flex-direction:column;justify-content:center">
                        <div class="text-center w-full text-16" style="font-weight:700">Nhận Voucher</div>
                    </div>
                    <div class="close-modal  cursor-pointer">
                        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
                    </div>
                </div>
                <div class=" overflow-auto w-1/2 h-full p-2 topping-row" style="height: 87%;overflow-y: auto;">
                    <div class="relative z-1 m-auto rounded-2 w-full max-w-[600px] " >
                        <div>Chúc mừng khách hàng xxx đã thu thập thành công ưu đãi</div>
                        <div>Bạn có thể đến làm</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <script>
        document.addEventListener('DOMContentLoaded', function () {
        // Lấy các phần tử
        const modal = document.getElementById('success');
        const confirmButton = document.getElementById('success-modal');
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