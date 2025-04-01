<div class="investment-dropdown" id="payment-policy">
  <span class="selected-option">Thanh toán một lần</span>
  <div class="dropdown-options">
    <?php 
// $unique_policies = array();
if ($payment_policy) {
  foreach ($payment_policy as $item) {
    // $unique_policies[] = $item['payment_policy'];
    echo '<div class="dropdown-option" data-value="' . esc_attr($item['payment_type']) . '">' . esc_html($item['payment_type']) . '</div>';
  }
}
// if (empty($unique_policies)) {
//   // Fallback options if no data is available
//   echo '<div class="dropdown-option" data-value="one-time">Thanh toán một lần</div>';
//   echo '<div class="dropdown-option" data-value="installment">Trả góp</div>';
//   echo '<div class="dropdown-option" data-value="monthly">Thanh toán hàng tháng</div>';
// }
?>
  </div>
</div>