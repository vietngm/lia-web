<?php
add_action('acf/render_field/name=noteTopping', 'render_note_topping_list_readonly', 10, 1);

function render_note_topping_list_readonly($field) {
    // Ẩn textarea bằng CSS
    echo '<style>#acf-' . esc_attr($field['key']) . ' { display: none !important; }</style>';

    // Hiển thị danh sách <ul>
    $json = $field['value'];
    $items = json_decode($json, true);

    if (!empty($items) && is_array($items)) {
        echo '<div style="margin-top:10px; padding:10px; background: #f9f9f9; border:1px solid #ccc;">';
        echo '<strong>Dịch vụ đã chọn:</strong>';
        echo '<ul>';
        foreach ($items as $item) {
            echo '<li>';
            echo '<strong>Nhóm:</strong> ' . esc_html($item['group']) . ' | ';
            echo '<strong>Tên:</strong> ' . esc_html($item['name']) . ' | ';
            echo '<strong>Giá:</strong> ' . number_format($item['price']) . ' VND';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p><em>Không có dịch vụ hợp lệ hoặc định dạng JSON sai.</em></p>';
    }
}