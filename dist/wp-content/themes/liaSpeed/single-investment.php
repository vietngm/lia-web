<?php get_header(); ?>
<?php
	$fields = get_fields('option');
  $menus = $fields['header'];
  $contactInfo = $menus['menu_cskh']; 
	$franchise_id = get_the_ID();	
  $media_dai_dien = get_field('media_dai_dien',$franchise_id);
  $thumbnail_url = get_field('anh_dai_dien',$franchise_id);
  $mohinh= get_field('dt_mh',$franchise_id);
  $vitri = get_field('dt_dia_chi',$franchise_id);
  $cacgiaidoandautu = get_field('dt_cgddt',$franchise_id);
  $investment_gallery =  get_field('investment_gallery',$franchise_id);
  $pageInvestmentId = get_page_by_path('cac-hinh-thuc-dau-tu');
  $cachinhthucdautu = get_field('dshtdt',$pageInvestmentId->ID);
?>
<main class="page-investment">
  <section class="section-franchise-detail">
    <div class="container">
      <div class="franchise-image-container">
        <div class="product-detail-slider mount-slider lg:col-span-1 col-span-2 sm:mt-0 sm:mx-0 -mx-4">
          <?php if($thumbnail_url){?>
          <div>
            <img class="w-full" src="<?= bfi_thumb($thumbnail_url['url'] , array("width"=>400, 'crop'=>false)) ?>" />
          </div>
          <?php } ?>
          <?php foreach ($investment_gallery as $item) : ?>
          <div>
            <img class="w-full" src="<?= bfi_thumb($item['url'] , array("width"=>400, 'crop'=>false)) ?>" />
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="lg:col-span-1 col-span-2 flex flex-col">
        <div class="flex gap-2 flex-wrap breadcrumb">
          <a class="breadcrumb-home font-semibold" href="/">Trang chủ</a>
          <span>›</span>
          <a class="breadcrumb-home font-semibold" href="<?=get_permalink(get_page_by_path('danh-sach-keu-goi'))?>">Kêu
            gọi</a>
          <span>›</span>
          <span class="text-primary">Chi tiết đầu tư</span>
        </div>
      </div>
    </div>
    <div class="main-content">
      <div class="franchise-title">
        <h1><?php the_title(); ?></h1>
      </div>
      <div class="metrics-container">
        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/building.svg'); ?>" alt="Investment">
            Mô hình
          </div>
          <div class="metric-value"><?= $mohinh->post_title; ?></div>
        </div>

        <div class="metric-item">
          <div class="metric-label">
            <img src="<?php echo get_theme_file_uri('assets/images/icons/user-gray.svg'); ?>" alt="Beds">
            Sức chứa
          </div>
          <div class="metric-value"><?php echo $franchise_fields['phong']; ?> giường</div>
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
            <img src="<?php echo get_theme_file_uri('assets/images/icons/location-gray.svg'); ?>" alt="Investment">
            Vị trí
          </div>
          <div class="metric-value"><?php echo $vitri; ?></div>
        </div>
      </div>

      <div class="franchise-description">
        <h2 class="tab-heading">Hình thức đầu tư</h2>
        <?php
          get_template_part( 'template-parts/investment-method', 'info', array(
            "cachinhthucdautu" => $cachinhthucdautu,
          ));
        ?>
      </div>

      <div class="policy-section">
        <?php include get_template_directory() . "/template-parts/content-policy.php"; ?>
      </div>

      <div class="process">
        <h2 class="process-heading">Quy trình thực hiện</h2>
        <?php
          get_template_part( 'template-parts/investment', 'process', array(
            "cacgiaidoandautu" => $cacgiaidoandautu,
          ));
        ?>
      </div>

      <div class="footer-actions">
        <div class="help-button">
          <a href="tel:<?=$contactInfo['dt_cskh']?>" target="_blank"
            style="gap:2px;justify-content: center;display:flex;align-items:center;flex-direction: column;">
            <img class="w-5 h-5" src="<?php echo get_theme_file_uri('assets/images/icons/call-incoming.svg'); ?>">
            <div style="font-size:12px">Hotline</div>
          </a>
        </div>
        <a class="action-button register-button" href="<?=get_permalink(get_page_by_path('danh-sach-keu-goi'))?>">Kêu
          gọi</a>
        <div class="action-button deposit-button">Đăng ký</div>
      </div>
  </section>
</main>

<!-- Modal for Registration -->
<div id="registration-modal" class="modal modal-registration">
  <?php include get_template_directory() . "/template-parts/modal-consultation-register.php"; ?>
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
    // $('a[href="#warranty-modal"]').click(function(e) {
    //   e.preventDefault();
    //   warrantyModal.style.display = 'block';
    //   document.body.style.overflow = 'hidden'; // Prevent scrolling
    // });
  });

  // Open refund details modal
  $(document).ready(function() {
    // $('a[href="#refund-modal"]').click(function(e) {
    //   e.preventDefault();
    //   refundModal.style.display = 'block';
    //   document.body.style.overflow = 'hidden'; // Prevent scrolling
    // });
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
<?php get_footer(); ?>