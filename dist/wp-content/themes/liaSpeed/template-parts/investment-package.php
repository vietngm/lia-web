<div class="investment-dropdown" id="investment-package">
  <span class="selected-option">Đồng hành</span>

  <div class="dropdown-options">
    <?php 
  // $unique_packages = array();
  if ($investment_data) {
      foreach ($investment_data as $item) {
              // $unique_packages[] = $item['package'];
              $selected = ($item['package_name'] === 'Đồng hành') ? ' selected' : '';
              echo '<div class="dropdown-option' . $selected . '" data-value="' . esc_attr($item['package_name']) . '" 
                  data-days="' . esc_attr($item['days']) . '"
                  data-revenue="' . esc_attr($item['revenue']) . '"
                  data-profit="' . esc_attr($item['profit']) . '"
                  data-roi="' . esc_attr($item['payback_time']) . '">' 
                  . esc_html($item['package_name']) . '</div>';
          }
      
  }
  // if (empty($unique_packages)) {
  //     // Fallback options if no data is available
  //     echo '<div class="dropdown-option selected" data-value="dong-hanh" 
  //         data-days="30"
  //         data-revenue="126"
  //         data-profit="25.2"
  //         data-roi="14">Đồng hành</div>';
  //     echo '<div class="dropdown-option" data-value="co-ban"
  //         data-days="25"
  //         data-revenue="150"
  //         data-profit="30"
  //         data-roi="12">Cơ bản</div>';
  //     echo '<div class="dropdown-option" data-value="nang-cao"
  //         data-days="20"
  //         data-revenue="180"
  //         data-profit="36"
  //         data-roi="10">Nâng cao</div>';
  // }
  ?>
  </div>
</div>