<div class="investment-dropdown" id="investment-capital">
  <span class="selected-option">50%</span>
  <div class="dropdown-options">
    <?php 
    if ($investment_capital) {
      foreach ($investment_capital as $item) {
        echo '<div class="dropdown-option" data-value="' . esc_attr($item['expected_value']) . '">' . esc_html($item['expected_value']) . '</div>';
      }
    }
    ?>
  </div>
</div>