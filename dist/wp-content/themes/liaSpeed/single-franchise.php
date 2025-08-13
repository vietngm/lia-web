<?php get_header("empty"); ?>
<?php
	$fields = get_fields('option');
  $menus = $fields['header'];
  $contactInfo = $menus['menu_cskh'];
	$franchise_id = get_the_ID();
	$franchise_fields = get_fields($franchise_id);
	$thumbnail_url = get_the_post_thumbnail_url($franchise_id, 'full');
	$investment_data = $franchise_fields['investment_package'];
  $investment_capital = $franchise_fields['investment_capital'];
  $payment_policy = $franchise_fields['payment_policy'];
  $bannerShow =  get_field('banner_show',$franchise_id);
?>

<main class="page-franchise">
  <section class="section-franchise-detail">
    <div class="franchise-header">
      <div class="back-button" onclick="history.back();"
        data-fallback="<?= get_permalink(get_field("home_page", "option")) ?>">
        <img src="<?php echo get_theme_file_uri('assets/images/icons/chevron-left-white.svg'); ?>" alt="Back">
      </div>
      <div class="right-actions">
        <div class="right-action-btn vr-btn ">
          VR
          <img src="<?php echo get_theme_file_uri('assets/images/icons/vr.svg'); ?>" alt="VR">
        </div>
        <div class="right-action-btn active ">Ảnh</div>

      </div>
    </div>
    <img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>" class="franchise-image">
    <div class="main-content">
      <div class="franchise-title">
        <h1><?php the_title(); ?></h1>
      </div>

      <div class="metrics-container">
        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/dt.svg'); ?>" alt="Investment">
            Đầu tư
          </div>
          <div class="metric-value"><?php echo $franchise_fields['price']; ?> Triệu</div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/vr-gray.svg'); ?>" alt="Area">
            Diện tích
          </div>
          <div class="metric-value"><?php echo $franchise_fields['m2']; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/user-gray.svg'); ?>" alt="Beds">
            Công suất
          </div>
          <div class="metric-value"><?php echo $franchise_fields['phong']; ?> giường</div>
        </div>
        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/location-gray.svg'); ?>" alt="Investment">
            Vị trí
            <!-- <span class="location-text"><?php echo $franchise_fields['description']; ?></span> -->
          </div>
          <div class="metric-value"><?php echo $franchise_fields['description']; ?></div>
        </div>
      </div>

      <?php if($bannerShow==1){?>
      <div class="promo-banner">
        <img src="<?php echo get_theme_file_uri('assets/images/5diem.png'); ?>" alt="Promo" class="promo-image">
        <div class="promo-content">
          <div class="promo-title">5 điểm nhượng quyền đang được góp vốn</div>
          <a href="#" class="promo-link">
            <span>Góp vốn ngay</span>
            <span class="promo-link-arrow">→</span>
          </a>
        </div>
      </div>
      <?php } ?>

      <div class="investment-section">
        <div class="franchise-detail">
          <div class="title-box">
            <span>Chi tiết nhượng quyền</span>
          </div>
        </div>
        <div class="investment-options">
          <div class="investment-option">
            <div class="investment-label">Gói đầu tư</div>
            <?php include get_template_directory() . "/template-parts/investment-package.php"; ?>
          </div>

          <div class="investment-option">
            <div class="investment-label">Vốn đầu tư</div>
            <?php include get_template_directory() . "/template-parts/investment-capital.php"; ?>
          </div>

          <div class="investment-option">
            <div class="investment-label">Thanh toán</div>
            <?php include get_template_directory() . "/template-parts/payment-type.php"; ?>
          </div>
        </div>
        <div class="grid-container">
          <div class="grid-item green">
            <h3>30 Ngày</h3>
            <p>Quy trình nhượng quyền</p>
          </div>
          <div class="grid-item yellow">
            <h3>126 Triệu/tháng</h3>
            <p>Doanh thu dự kiến</p>
          </div>
          <div class="grid-item blue">
            <h3>25.2 Triệu/tháng</h3>
            <p>Lợi nhuận dự kiến</p>
          </div>
          <div class="grid-item red">
            <h3>14 Tháng</h3>
            <p>Thời gian hoàn vốn</p>
          </div>
        </div>

      </div>

      <div class="policy-section">
        <?php include get_template_directory() . "/template-parts/content-policy.php"; ?>
      </div>

      <div class="franchise-process">
        <?php include get_template_directory() . "/template-parts/franchise-process.php"; ?>
      </div>

      <div class="footer-actions">
        <div class="help-button">
          <div class="help-icon">?</div>
        </div>
        <div class="action-button register-button">Đăng ký tư vấn</div>
        <div class="action-button deposit-button">Đặt cọc ngay</div>
      </div>
  </section>
</main>

<!-- Modal for Registration -->
<div id="registration-modal" class="modal modal-registration">
  <?php include get_template_directory() . "/template-parts/modal-consultation-register.php"; ?>
</div>

<!-- Modal for Deposit -->
<div id="deposit-modal" class="modal">
  <div class="modal-content modal-content-customized">
    <div class="modal-header">
      <h2>Đặt cọc nhượng quyền</h2>
      <span class="close-modal">&times;</span>
    </div>
    <div class="modal-body">
      <div class="deposit-info">
        <div class="franchise-summary">
          <div class="summary-item">
            <span class="summary-label">Mô hình:</span>
            <span class="summary-value"><?php the_title(); ?></span>
          </div>
          <div class="summary-item">
            <span class="summary-label">Gói đầu tư:</span>
            <span class="summary-value package-value">Đồng hành</span>
          </div>
          <div class="summary-item">
            <span class="summary-label">Vốn đầu tư:</span>
            <span class="summary-value capital-value">50%</span>
          </div>
          <div class="summary-item">
            <span class="summary-label">Phương thức:</span>
            <span class="summary-value policy-value">Thanh toán một lần</span>
          </div>
        </div>
        <div class="deposit-amount">
          <h3>Số tiền đặt cọc</h3>
          <p class="amount">50 Triệu VNĐ</p>
          <p class="note">* Số tiền đặt cọc sẽ được trừ vào tổng số tiền thanh toán</p>
        </div>
        <div class="payment-methods">
          <h3>Phương thức thanh toán</h3>
          <div class="payment-option">
            <input type="radio" id="bank-transfer" name="payment-method" checked>
            <label for="bank-transfer">Chuyển khoản ngân hàng</label>
          </div>
          <div class="bank-details">
            <p>Ngân hàng: <strong>Vietcombank</strong></p>
            <p>Số tài khoản: <strong>1234567890</strong></p>
            <p>Chủ tài khoản: <strong>Công ty Cổ phần ĐT & PT LIA BEAUTY</strong></p>
            <p>Nội dung: <strong>DC <?php the_title(); ?> [Số điện thoại]</strong></p>
          </div>
        </div>
        <!-- <button class="confirm-deposit">Xác nhận đặt cọc</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal for Support -->
<div id="support-modal" class="modal">
  <div class="modal-content modal-content-customized">
    <div class="modal-header">
      <h2 class="modal-title">Hỗ trợ</h2>
      <span class="close-modal">&times;</span>
    </div>
    <div class="modal-body">
      <div class="support-options">
        <div class="support-section">
          <h3>Các câu hỏi thường gặp</h3>
          <div class="faq-item">
            <div class="faq-question">
              <span>Quy trình thanh toán như thế nào?</span>
              <span class="toggle-icon">+</span>
            </div>
            <div class="faq-answer">
              <p>Sau khi ký hợp đồng, bạn sẽ thanh toán theo phương thức đã chọn. Đối với thanh toán một lần, bạn cần
                thanh toán toàn bộ số tiền trong vòng 7 ngày. Đối với trả góp, bạn sẽ thanh toán theo lịch đã thỏa thuận
                trong hợp đồng.</p>
            </div>
          </div>
          <div class="faq-item">
            <div class="faq-question">
              <span>Thời gian hoàn vốn được tính như thế nào?</span>
              <span class="toggle-icon">+</span>
            </div>
            <div class="faq-answer">
              <p>Thời gian hoàn vốn được tính dựa trên tổng số tiền đầu tư và lợi nhuận dự kiến hàng tháng, không bao
                gồm các chi phí vận hành và thuế.</p>
            </div>
          </div>
          <div class="faq-item">
            <div class="faq-question">
              <span>LiA có hỗ trợ vận hành không?</span>
              <span class="toggle-icon">+</span>
            </div>
            <div class="faq-answer">
              <p>Có, LiA sẽ hỗ trợ đào tạo và vận hành trong suốt 6 tháng đầu tiên sau khi khai trương, bao gồm đào tạo
                nhân viên, quản lý và hỗ trợ kỹ thuật.</p>
            </div>
          </div>
        </div>

        <div class="support-section">
          <h3>Liên hệ hỗ trợ</h3>
          <div class="contact-methods">
            <div class="contact-item">
              <div class="contact-icon">
                <img src="<?php echo get_theme_file_uri('assets/images/icons/phone.svg'); ?>" alt="Phone">
              </div>
              <div class="contact-info">
                <p class="contact-label">Hotline</p>
                <p class="contact-value"><a href="tel:<?=$contactInfo['dt_cskh']?>"><?=$contactInfo['dt_cskh']?></a></p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">
                <img src="<?php echo get_theme_file_uri('assets/images/icons/email.svg'); ?>" alt="Email">
              </div>
              <div class="contact-info">
                <p class="contact-label">Email</p>
                <p class="contact-value"><?=$contactInfo['email_cskh']?></p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon">
                <img src="<?php echo get_theme_file_uri('assets/images/icons/chat.svg'); ?>" alt="Chat">
              </div>
              <div class="contact-info">
                <p class="contact-label">Live Chat</p>
                <p class="contact-value">Hỗ trợ 24/7</p>
              </div>
            </div>
          </div>
        </div>

        <div class="support-cta">
          <button class="call-button">Gọi ngay</button>
          <!-- <button class="chat-button">Chat với tư vấn viên</button> -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get all dropdowns
  const packageDropdown = document.getElementById('investment-package');
  const capitalDropdown = document.getElementById('investment-capital');
  const policyDropdown = document.getElementById('payment-policy');

  const dropdowns = [packageDropdown, capitalDropdown, policyDropdown];
  const gridContainer = document.querySelector('.grid-container');

  // Full investment data from PHP
  const investmentData = <?php echo json_encode($investment_data); ?>;

  // Setup each dropdown
  dropdowns.forEach(dropdown => {
    const selectedOption = dropdown.querySelector('.selected-option');
    const options = dropdown.querySelector('.dropdown-options');

    // Toggle dropdown when clicked
    selectedOption.addEventListener('click', function(e) {
      e.stopPropagation();

      // Close all other dropdowns first
      dropdowns.forEach(d => {
        if (d !== dropdown) {
          d.querySelector('.dropdown-options').style.display = 'none';
          d.classList.remove('active');
        }
      });

      // Toggle this dropdown
      options.style.display = options.style.display === 'block' ? 'none' : 'block';
      dropdown.classList.toggle('active');
    });

    // Handle option selection
    options.querySelectorAll('.dropdown-option').forEach(option => {
      option.addEventListener('click', function() {
        // Update selected option text
        selectedOption.textContent = this.textContent;

        // Update selected class
        options.querySelectorAll('.dropdown-option').forEach(opt => {
          opt.classList.remove('selected');
        });
        this.classList.add('selected');

        // Close dropdown
        options.style.display = 'none';
        dropdown.classList.remove('active');

        // Update grid with combined selections
        updateGridFromSelections();

        // Update deposit modal summary
        updateDepositSummary();
      });
    });
  });

  // Close all dropdowns when clicking outside
  document.addEventListener('click', function() {
    dropdowns.forEach(dropdown => {
      dropdown.querySelector('.dropdown-options').style.display = 'none';
      dropdown.classList.remove('active');
    });
  });

  // Function to update grid based on all three selections
  function updateGridFromSelections() {
    const selectedPackage = packageDropdown.querySelector('.selected-option').textContent;
    const selectedCapital = capitalDropdown.querySelector('.selected-option').textContent.replace('%', '');
    const selectedPolicy = policyDropdown.querySelector('.selected-option').textContent;

    // Find matching data in the investment_data array
    let matchingData = null;

    if (investmentData && Array.isArray(investmentData)) {
      matchingData = investmentData.find(item =>
        item.package === selectedPackage &&
        item.capital === selectedCapital &&
        item.payment_policy === selectedPolicy
      );

      // If exact match not found, try to find a partial match
      if (!matchingData) {
        matchingData = investmentData.find(item => item.package === selectedPackage);
      }
    }

    // If no matching data found from PHP, use the data attributes from the package dropdown
    if (!matchingData) {
      const selectedPackageOption = packageDropdown.querySelector('.dropdown-option.selected') ||
        packageDropdown.querySelector('.dropdown-option');

      if (selectedPackageOption) {
        matchingData = {
          process_days: selectedPackageOption.dataset.days,
          expected_revenue: selectedPackageOption.dataset.revenue,
          expected_profit: selectedPackageOption.dataset.profit,
          roi_period: selectedPackageOption.dataset.roi
        };
      }
    }

    // Update the grid with the matching data
    if (matchingData) {
      gridContainer.innerHTML = `
                <div class="grid-item green">
                    <h3>${matchingData.process_days}</h3>
                    <p>Quy trình nhượng quyền</p>
                </div>
                <div class="grid-item yellow">
                    <h3>${matchingData.expected_revenue}</h3>
                    <p>Doanh thu dự kiến</p>
                </div>
                <div class="grid-item blue">
                    <h3>${matchingData.expected_profit}</h3>
                    <p>Lợi nhuận dự kiến</p>
                </div>
                <div class="grid-item red">
                    <h3>${matchingData.roi_period}</h3>
                    <p>Thời gian hoàn vốn</p>
                </div>
            `;
    }
  }

  // Initialize with default data
  updateGridFromSelections();

  // Modal functionality
  const registerButton = document.querySelector('.register-button');
  const depositButton = document.querySelector('.deposit-button');
  const helpButton = document.querySelector('.help-button');
  const warrantyMoreButton = document.querySelector('.policy-item:first-child .policy-more');
  const refundMoreButton = document.querySelector('.refund-policy .policy-more');
  const closeButtons = document.querySelectorAll('.close-modal');
  const registrationModal = document.getElementById('registration-modal');
  const depositModal = document.getElementById('deposit-modal');
  const supportModal = document.getElementById('support-modal');
  const warrantyModal = document.getElementById('warranty-modal');
  const refundModal = document.getElementById('refund-modal');
  const registrationForm = document.getElementById('registration-form');
  // const confirmDepositButton = document.querySelector('.confirm-deposit');

  // Open registration modal
  registerButton.addEventListener('click', function() {
    registrationModal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  });

  // Open deposit modal
  depositButton.addEventListener('click', function() {
    updateDepositSummary();
    depositModal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  });

  // Open support modal
  helpButton.addEventListener('click', function() {
    supportModal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  });

  // Open warranty details modal
  $(document).ready(function() {
    $('a[href="#warranty-modal"]').click(function(e) {
      e.preventDefault();
      warrantyModal.style.display = 'block';
      document.body.style.overflow = 'hidden'; // Prevent scrolling
    });
  });

  // Open refund details modal
  $(document).ready(function() {
    $('a[href="#refund-modal"]').click(function(e) {
      e.preventDefault();
      refundModal.style.display = 'block';
      document.body.style.overflow = 'hidden'; // Prevent scrolling
    });
  });

  // Close modals when clicking close button
  closeButtons.forEach(button => {
    button.addEventListener('click', function() {
      registrationModal.style.display = 'none';
      depositModal.style.display = 'none';
      supportModal.style.display = 'none';
      warrantyModal.style.display = 'none';
      refundModal.style.display = 'none';
      document.body.style.overflow = 'auto'; // Allow scrolling again
    });
  });

  // Close modals when clicking outside
  window.addEventListener('click', function(event) {
    if (event.target === registrationModal) {
      registrationModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
    if (event.target === depositModal) {
      depositModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
    if (event.target === supportModal) {
      supportModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
    if (event.target === warrantyModal) {
      warrantyModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
    if (event.target === refundModal) {
      refundModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
  });

  // Handle registration form submission
  //   registrationForm.addEventListener('submit', function(e) {
  //     e.preventDefault();

  //     // Here you would normally send the form data to a server
  //     // For now, we'll just show a success message
  //     alert('Yêu cầu tư vấn của bạn đã được gửi thành công. Chúng tôi sẽ liên hệ sớm nhất!');

  //     // Reset the form and close the modal
  //     registrationForm.reset();
  //     registrationModal.style.display = 'none';
  //     document.body.style.overflow = 'auto';
  //   });

  // Handle deposit confirmation
  // confirmDepositButton.addEventListener('click', function() {
  //   alert('Cảm ơn bạn đã đặt cọc. Vui lòng hoàn tất thanh toán và chúng tôi sẽ liên hệ để xác nhận!');
  //   depositModal.style.display = 'none';
  //   document.body.style.overflow = 'auto';
  // });

  // Support modal functionality
  const faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(question => {
    question.addEventListener('click', function() {
      const faqItem = this.parentNode;
      faqItem.classList.toggle('active');

      const toggleIcon = this.querySelector('.toggle-icon');
      toggleIcon.textContent = faqItem.classList.contains('active') ? '×' : '+';
    });
  });

  // Call button functionality
  const callButton = document.querySelector('.call-button');
  if (callButton) {
    callButton.addEventListener('click', function() {
      window.location.href = 'tel:18009292';
    });
  }

  // Chat button functionality
  const chatButton = document.querySelector('.chat-button');
  if (chatButton) {
    chatButton.addEventListener('click', function() {
      alert('Chức năng chat đang được kết nối. Vui lòng đợi trong giây lát...');
      // Here you would normally initiate a chat session
    });
  }

  // Update deposit modal summary
  function updateDepositSummary() {
    const packageValue = document.querySelector('.package-value');
    const capitalValue = document.querySelector('.capital-value');
    const policyValue = document.querySelector('.policy-value');

    packageValue.textContent = packageDropdown.querySelector('.selected-option').textContent;
    capitalValue.textContent = capitalDropdown.querySelector('.selected-option').textContent;
    policyValue.textContent = policyDropdown.querySelector('.selected-option').textContent;
  }

  // VR and Image toggle
  const vrButton = document.querySelector('.vr-btn');
  const imageButton = document.querySelector('.right-action-btn.active');
  const franchiseImage = document.querySelector('.franchise-image');
  const originalImageSrc = franchiseImage.src;

  vrButton.addEventListener('click', function() {
    if (!this.classList.contains('active')) {
      this.classList.add('active');
      imageButton.classList.remove('active');
      // Change image to VR version
      franchiseImage.src = '<?php echo get_theme_file_uri('assets/images/vr-image.jpg'); ?>';
    }
  });

  imageButton.addEventListener('click', function() {
    if (!this.classList.contains('active')) {
      this.classList.add('active');
      vrButton.classList.remove('active');
      // Change back to original image
      franchiseImage.src = originalImageSrc;
    }
  });
});
</script>
<?php get_footer("empty"); ?>