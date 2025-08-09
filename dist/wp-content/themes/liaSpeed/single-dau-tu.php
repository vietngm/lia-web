<?php get_header("empty"); ?>
<?php
	$fields = get_fields('option');
  $menus = $fields['header'];
  $contactInfo = $menus['menu_cskh'];
  $statuses = get_field('dt_cgddt');

?>
<style>
:root {
  --primary-color: #1A5477;
  --accent-color: #94C347;
  --text-dark: #333;
  --text-medium: #2C2F40;
  --text-light: #888;
  --border-color: #E0E0E0;
  --background-light: #1b54780f;
  --background-mint: rgba(148, 195, 71, 0.1);
}

body {
  font-family: 'Montserrat', sans-serif;
  margin: 0;
  padding: 0;
  background-color: white;
  color: var(--text-dark);
}

.franchise-header {
  position: relative;
  padding: 10px 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #fff;
  height: 50px;
}

.back-button {
  width: 30px;
  height: 30px;
  background-color: rgb(131 131 131 / 80%);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.back-button img {
  width: 16px;
  height: 12px;
  padding-left: 4px;
}

.right-actions {
  display: flex;
  gap: 15px;
  background: #9c9c9c;
  padding: 6px 8px;
  color: #FFF;
  border-radius: 8px;
  position: relative;
  align-items: center;
  width: 26%;
}

.right-action-btn.active {
  background: #FFF;
  color: #000;
  padding: 2px 8px;
  position: absolute;
  right: 0;
  top: 0;
  bottom: 0;
  border-radius: 8px 0px 0px 8px;
  display: flex;
  align-items: center;
  font-weight: 600;
  font-size: 13px;
}

.vr-btn img {
  width: 16px;
}

.vr-btn {
  display: flex;
  align-items: center;
  gap: 4px;
}

.right-action-btn {
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
}

.main-content {
  padding: 0 15px;
}

.franchise-image {
  width: 100%;
  height: auto;
  margin-bottom: 6px;
}

.franchise-title {
  display: flex;
  align-items: center;
  margin-bottom: 6px;
}

.franchise-title h1 {
  font-size: 24px;
  font-weight: bold;
  color: var(--primary-color);
  margin: 0;
  text-transform: uppercase;
}

.dropdown-icon {
  margin-left: 5px;
  width: 16px;
  height: 16px;
}

.metrics-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 15px;
  background-color: var(--background-light);
  padding: 15px;
  border-radius: 10px;
}

.metric-item {
  flex: 1;
  min-width: 100px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.metric-label {
  font-size: 12px;
  color: var(--text-light);
  margin-bottom: 5px;
  display: flex;
  align-items: center;
}

.metric-label img {
  width: 16px;
  height: 16px;
  margin-right: 4px;
}

.metric-value {
  font-size: 16px;
  font-weight: 700;
  color: var(--text-dark);
}

.location-box {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.location-icon {
  width: 16px;
  height: 16px;
  margin-right: 5px;
}

.location-text {
  font-size: 14px;
  color: var(--text-dark);
  font-weight: 700;
}

.promo-banner {
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
}

.promo-title {
  font-size: 13px;
  font-weight: 600;
  color: #B3750E;
}

.promo-link {
  display: flex;
  align-items: center;
  color: #B3750E;
  text-decoration: none;
  font-size: 13px;
}

.promo-link-arrow {
  margin-left: 5px;
}

.section-title {
  font-size: 20px;
  font-weight: 700;
  margin: 18px 0 4px;
  text-align: center;
}

.section-subtitle {
  font-size: 14px;
  color: var(--text-medium);
  text-align: center;
  margin-bottom: 20px;
}

.feature-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-bottom: 30px;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.feature-icon {
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.feature-text {
  font-size: 14px;
  color: var(--text-dark);
}

.investment-section {
  margin-bottom: 42px;
  margin-top: 8px;
}

.investment-options {
  display: flex;
  justify-content: space-between;
  margin-bottom: 24px;
  margin-top: 16px;
}

.investment-option {}

.investment-label {
  font-size: 14px;
  color: var(--text-medium);
  margin-bottom: 6px;
  font-weight: 600;
}

.investment-dropdown {
  position: relative;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  padding: 8px 12px;
  background: white;
  cursor: pointer;
  transition: all 0.3s ease;
}

.investment-dropdown.active {
  border-color: var(--primary-color);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.selected-option {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 14px;
  color: var(--text-dark);
}

.selected-option::after {
  content: '▼';
  font-size: 10px;
  color: var(--text-light);
  transition: transform 0.3s ease;
}

.investment-dropdown.active .selected-option::after {
  transform: rotate(180deg);
}

.dropdown-options {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  margin-top: 4px;
  background: white;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  z-index: 100;
  display: none;
}

.dropdown-option {
  padding: 10px 12px;
  font-size: 14px;
  color: var(--text-dark);
  transition: all 0.2s ease;
}

.dropdown-option:hover {
  background-color: var(--background-light);
}

.dropdown-option.selected {
  background-color: var(--background-light);
  color: var(--primary-color);
  font-weight: 600;
}

.dropdown-option:first-child {
  border-radius: 8px 8px 0 0;
}

.dropdown-option:last-child {
  border-radius: 0 0 8px 8px;
}

.roi-box {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  padding: 0px 18px;
}

.roi-item {}

.roi-value {
  font-size: 36px;
  font-weight: 900;
  color: var(--text-dark);
  margin-bottom: 5px;
  line-height: 1;
}

.roi-value-unit {
  font-size: 14px;
  color: var(--text-medium);
  margin-left: -6px;
}

.roi-label {
  font-size: 14px;
  color: var(--text-light);
}

.policy-section {
  margin-bottom: 30px;
}

.policy-item {
  display: flex;
  align-items: center;
  margin-bottom: 16px;
  margin-top: 16px;
}

.policy-check {
  width: 20px;
  height: 20px;
  margin-right: 10px;
  color: var(--accent-color);
}

.policy-title {
  font-size: 16px;
  font-weight: 600;
  flex: 1;
  color: #058908;
}

.policy-more {
  font-size: 14px;
  color: var(--primary-color);
  text-decoration: none;
}

.warranty-timeline {
  display: flex;
  justify-content: space-between;
  position: relative;
  margin: -38px 0px -45px 12px;
}

.warranty-item {
  width: 100%;
  text-align: center;
  position: relative;
  z-index: 2;
}

.warranty-item img {}

.warranty-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border: 2px solid var(--border-color);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin: 0 auto 10px;
  background-color: #fff;
}

.warranty-value {
  font-size: 20px;
  font-weight: 700;
}

.warranty-unit {
  font-size: 12px;
}

.warranty-text {
  font-size: 12px;
  color: var(--text-medium);
}

.warranty-line {
  position: absolute;
  top: 30px;
  left: 60px;
  right: 60px;
  height: 2px;
  background-color: var(--border-color);
  z-index: 1;
}

.refund-policy {
  margin-top: 30px;
}

.refund-timeline {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  margin: -10px 0px -50px 12px;
}

.refund-item {
  width: 70px;
  text-align: center;
  margin-bottom: 20px;
}

.refund-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border: 2px solid var(--border-color);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 10px;
  font-size: 18px;
  font-weight: 700;
}

.refund-period {
  font-size: 12px;
  color: var(--text-medium);
}

.franchise-process {
  /* margin-top: 30px;
  padding-top: 30px; */
}

.process-title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 15px;
  text-align: center;
}

.footer-actions {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: white;
  display: flex;
  padding: 15px;
  box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
  z-index: 100;
}

.help-button {
  width: 50px;
  height: 50px;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px;
}

.help-icon {
  font-size: 20px;
  color: var(--text-medium);
}

.action-button {
  flex: 1;
  height: 50px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.register-button {
  background-color: white;
  border: 1px solid var(--primary-color);
  color: var(--primary-color);
  margin-right: 10px;
}

.deposit-button {
  background-color: var(--accent-color);
  border: none;
  color: white;
}

.promo-content {
  position: absolute;
  top: 8px;
  left: 20px;
  width: 100%;
  height: 100%;

}

.franchise-detail {
  display: flex;
  align-items: center;
  position: relative;
  margin-top: 8px;
}

.title-box {
  background: linear-gradient(to right, #9CCF79, #e8f5e917);
  padding: 6px 16px;
  font-weight: bold;
  color: black;
  position: relative;
  left: -15px;
}

.line {
  height: 1px;
  width: 41%;
  position: absolute;
  right: 0;
  background: linear-gradient(to right, #e8f5e917, #9CCF79);
  /* Hiệu ứng fade */
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin-top: 24px;
}

.grid-item {
  padding: 16px;
  border-radius: 8px;
  text-align: center;
  font-family: Arial, sans-serif;
}

.grid-item h3 {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 2px;
}

.grid-item p {
  font-size: 12px;
}

/* Màu nền cho từng ô */
.green {
  background-color: #ECFDF5;
}

/* Xanh nhạt */
.yellow {
  background-color: #FFFBEB;
}

/* Vàng nhạt */
.blue {
  background-color: #EFF6FF;
}

/* Xanh dương nhạt */
.red {
  background-color: #FEF2F2;
}

/* Đỏ nhạt */

/* Timeline */
.timeline {
  position: relative;
  max-width: 700px;
  margin-top: 24px;
}

/* Dòng kẻ dọc */
.timeline::before {
  content: "";
  position: absolute;
  left: 98px;
  width: 1px;
  height: 100%;
  background: #0000002e;
}

/* Mỗi item */
.timeline-item {
  display: flex;
  margin-bottom: 30px;
  position: relative;
}

/* Cột trái */
.timeline-left {
  position: relative;
  position: relative;
  text-align: center;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Ngày tháng */
.timeline-date {
  /* font-size: 12px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    display: flex;
    flex-wrap: wrap;
    width: 32px; */
  font-size: 12px;
  font-weight: bold;
  color: #ffffff;
  margin-bottom: 5px;
  display: flex;
  flex-wrap: wrap;
  width: 44px;
  /* border: 1px dashed #cccc; */
  padding: 2px;
  justify-content: center;
  border-radius: 6px;
  background: linear-gradient(to bottom, #9CCF79, #e8f5e917);
}

.timeline-date span {
  font-size: 24px;
  font-weight: bold;
  display: block;
  color: #000;
}

/* Chấm tròn */
.timeline-circle {
  width: 8px;
  height: 8px;
  background: #9ed07d;
  /* border-radius: 50%;
    /* position: absolute; */
  /* left: 72px; */
  /* top: 50%; */
  /* transform: translateY(-50%); */
}

/* Nội dung bên phải */
.timeline-content {
  background: white;
  padding: 8px 12px;
  border-radius: 10px;
  box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;
  flex-grow: 1;
  margin-left: 20px;
}

.timeline-content h3 {
  font-size: 14px;
  font-weight: bold;
  color: #9ed07d;
  margin-bottom: 5px;
}

.timeline-content ul {
  padding-left: 20px;
}

.timeline-content li {
  font-size: 12px;
  margin-bottom: 5px;
}

.timeline-content p {
  font-size: 14px;
}

/* Additional styles for dropdowns */
.investment-dropdown {
  position: relative;
  cursor: pointer;
}

.dropdown-options {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background-color: white;
  border: 1px solid var(--border-color);
  border-radius: 5px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 10;
  margin-top: 5px;
}

.dropdown-option {
  padding: 8px 10px;
  border-bottom: 1px solid var(--border-color);
  font-size: 12px;
}

.dropdown-option:last-child {
  border-bottom: none;
}

.dropdown-option:hover {
  background-color: var(--background-light);
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  overflow-y: auto;
}

.modal-content {
  /* background-color: #fff;
  margin: 15px auto;
  width: 90%;
  max-width: 500px;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); */
  /* animation: modalFadeIn 0.3s; */
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-header {
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid var(--border-color);
}

.modal-header h2 {
  font-size: 18px;
  color: var(--primary-color);
  margin: 0;
}

.close-modal {
  font-size: 24px;
  font-weight: bold;
  color: var(--text-light);
  cursor: pointer;
}

.modal-body {
  padding: 20px;
}

/* Form Styles */
.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-size: 14px;
  color: var(--text-medium);
  margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  font-size: 14px;
}

.submit-button,
.confirm-deposit {
  background-color: var(--accent-color);
  color: white;
  border: none;
  border-radius: 8px;
  padding: 12px 20px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  width: 100%;
  /* margin-top: 10px; */
}

/* Deposit Modal Specific Styles */
.franchise-summary {
  background-color: var(--background-light);
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 20px;
}

.summary-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.summary-label {
  color: var(--text-medium);
  font-size: 14px;
}

.summary-value {
  font-weight: 600;
  color: var(--text-dark);
  font-size: 14px;
}

.deposit-amount {
  text-align: center;
  margin: 20px 0;
  padding: 15px;
  border: 1px solid var(--border-color);
  border-radius: 8px;
}

.deposit-amount h3 {
  font-size: 16px;
  color: var(--text-medium);
  margin-bottom: 10px;
}

.amount {
  font-size: 24px;
  font-weight: 700;
  color: var(--accent-color);
  margin: 10px 0;
}

.note {
  font-size: 12px;
  color: var(--text-light);
  font-style: italic;
}

.payment-methods {
  margin: 20px 0;
}

.payment-methods h3 {
  font-size: 16px;
  margin-bottom: 10px;
}

.payment-option {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.payment-option label {
  margin-left: 10px;
  font-size: 14px;
}

.bank-details {
  background-color: #f9f9f9;
  padding: 15px;
  border-radius: 8px;
  margin-top: 10px;
}

.bank-details p {
  margin: 5px 0;
  font-size: 14px;
}

/* Support Modal Styles */
.support-options {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.support-section {
  /* margin-bottom: 15px; */
}

.support-section h3 {
  font-size: 16px;
  color: var(--primary-color);
  margin-bottom: 15px;
  font-weight: 600;
}

.faq-item {
  border-bottom: 1px solid var(--border-color);
  /* margin-bottom: 10px; */
}

.faq-question {
  padding: 10px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  font-weight: 500;
  font-size: 14px;
}

.toggle-icon {
  font-size: 18px;
  color: var(--accent-color);
}

.faq-answer {
  display: none;
  padding: 0 0 10px;
}

.faq-answer p {
  font-size: 13px;
  color: var(--text-medium);
  line-height: 1.5;
}

.contact-methods {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* .contact-item {
  display: flex;
  align-items: center;
  gap: 10px;
} */

.contact-icon {
  width: 40px;
  height: 40px;
  background-color: var(--background-light);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.contact-icon img {
  width: 20px;
  height: 20px;
}

.contact-info {
  display: flex;
  flex-direction: column;
}

.contact-label {
  font-size: 12px;
  color: var(--text-light);
  margin-bottom: 2px;
}

.contact-value {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-dark);
}

.support-cta {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.call-button,
.chat-button {
  flex: 1;
  height: 45px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.call-button {
  background-color: white;
  border: 1px solid var(--accent-color);
  color: var(--accent-color);
}

.chat-button {
  background-color: var(--accent-color);
  border: none;
  color: white;
}

.faq-item.active .faq-answer {
  display: block;
}

.faq-item.active .toggle-icon {
  transform: rotate(45deg);
}

/* Policy Details Modal Styles */
.policy-details {
  max-height: 70vh;
  overflow-y: auto;
}

.policy-section {
  margin-bottom: 20px;
}

.policy-section h3 {
  font-size: 16px;
  color: var(--primary-color);
  margin-bottom: 10px;
  font-weight: 600;
}

.policy-section p {
  font-size: 14px;
  color: var(--text-medium);
  margin-bottom: 10px;
  line-height: 1.5;
}

.policy-section ul,
.policy-section ol {
  padding-left: 20px;
  margin-bottom: 15px;
}

.policy-section li {
  font-size: 14px;
  color: var(--text-medium);
  margin-bottom: 8px;
  line-height: 1.5;
}

.policy-note {
  background-color: var(--background-light);
  padding: 15px;
  border-radius: 8px;
  margin-top: 20px;
}

.policy-note p {
  font-size: 13px;
  color: var(--text-medium);
  margin: 0;
}

.refund-rates {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 15px 0;
}

.refund-rate-item {
  width: 48%;
  text-align: center;
  margin-bottom: 15px;
}

.rate-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: var(--accent-color);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  font-weight: 700;
  margin: 0 auto 10px;
}

.refund-rate-item p {
  font-size: 12px;
  color: var(--text-medium);
  margin: 0;
}
</style>
<?php 
	$franchise_id = get_the_ID();
	$franchise_fields = get_fields($franchise_id);
	$thumbnail_url = get_the_post_thumbnail_url($franchise_id, 'full');
	$investment_data = $franchise_fields['investment_package'];
  $investment_capital = $franchise_fields['investment_capital'];
  $payment_policy = $franchise_fields['payment_policy'];
  $bannerShow =  get_field('banner_show',$franchise_id);
?>
<?php

?>
<main>
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
          <div class="line"></div>
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