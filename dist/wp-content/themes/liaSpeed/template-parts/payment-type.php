<div class="investment-dropdown" id="payment-policy">
  <span class="selected-option">Thanh toán một lần</span>
  <div class="dropdown-options">
    <?php 
if ($payment_policy) {
  foreach ($payment_policy as $item) {
    echo '<div class="dropdown-option" data-value="' . esc_attr($item['payment_type']) . '">' . esc_html($item['payment_type']) . '</div>';
  }
}
?>
  </div>
</div>