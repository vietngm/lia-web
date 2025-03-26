<?php 
/**
 * Template name: Đặt lịch
 */
?>

<?php get_header("empty");?>

<script src="https://cdn.jsdelivr.net/gh/HichemTab-tech/OTP-designer-jquery@2.3.1/dist/otpdesigner.min.js"></script>
<head>
<style>
	.section-booking-form{
		padding-top:5.5rem;
	}
		.title_otp_xt {
			font-size: 18px;
			font-weight: 700;
			color: #1a5478;
		}
		.text-14{
			font-size:12px;
			font-weight:300;
		}
		.border-zalo-bottom {
    		display: flex;
			align-items: center;
			gap: 4px;
		}
		.consultant-zalo-bottom{
			border-radius: 30px;
			padding: 8px 0px;
			display: flex;
			justify-content: center;
			align-items: center;
			background: #ECECEC;
			flex-direction: column;
			color: #000;
			
		}
		.bg-round{
			background: #1a5478;
			color: #fff;
		}
		.input-note .input{
			border: 1px solid #ccc;
			border-radius: 10px !important;
			padding: 10px !important;
			width: 100%;
			font-size: 14px;
			height: 100px !important;
		}
		.time-input-content{
			border: 1px solid #ccc;
			border-radius: 10px;
			padding: 8px;
			font-size: 14px;
			cursor: pointer;
			width: 80px;
			text-align: center;
		}
		.booking-time-picker input {
			display: none;
		}
		input:checked + .time-input-content,
				.time-input-content:hover {
        --tw-bg-opacity: 1;
        background-color: #1a5478;
      }
	  input:checked + .time-input-content,
				.time-input-content:hover {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
      }
		
	</style>
</head>
<main>

	<section class="section section-booking-form booking-form ">
		<div class="container">
		
			<div class="modal-success fixed hidden top-0 left-0 right-0 bottom-0 z-[120] p-4">
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
						cho Quý khách để xác nhận thông tin lịch hẹn dựa theo 
						đăng ký. Cảm ơn Quý khách hàng đã sử dụng dịch vụ của
						chúng tôi
					</div>
				</div>
			</div>
	</section>
</main>

<?php get_footer("empty"); ?>
