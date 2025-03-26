<?php
/*
 Plugin Name: Custom Payment Status
 Description: Thêm cột trạng thái thanh toán vào danh sách bài viết.
 Version: 1.0
 Author: [Your Name]
*/
// Thêm cột Trạng thái thanh toán vào danh sách bài viết
add_filter('manage_post_posts_columns', 'add_payment_status_column');
function add_payment_status_column($columns) {
    // Thêm cột "Trạng thái thanh toán"
    $columns['payment_status'] = 'Trạng thái thanh toán';
    $columns['so_luong'] = 'Số lượng khách đăng kí';
    $columns['buffet_package'] = 'Gói Buffet'; 
    $columns['order_type'] = 'Trạng thái mua hàng'; 
    return $columns;
}

// Hiển thị nội dung trong cột Trạng thái thanh toán
add_action('manage_post_posts_custom_column', 'display_payment_status_column', 10, 2);
function display_payment_status_column($column, $post_id) {
    if ($column == 'payment_status') {
        // Lấy giá trị từ custom field 'payment_status'
        $payment_status = get_field('payment_status', $post_id); // Nếu sử dụng ACF

        // Kiểm tra giá trị và hiển thị trạng thái
        if ($payment_status === '1') {
            echo '<span style="color: green;">Đã thanh toán</span>';
        } elseif ($payment_status === '0') {
            echo '<span style="color: red;">Chưa thanh toán</span>';
        }
            elseif ($payment_status === '2') {
                echo '<span style="color: red;">thanh toán 1 phần</span>';
        } else {
            echo '<span style="color: gray;">Đang cập nhật</span>';
        }
    }
    if ($column == 'so_luong') {
        // Lấy giá trị từ custom field 'quantity'
        $quantity = get_field('so_luong', $post_id); // Nếu sử dụng ACF
        echo $quantity ?: '<span style="color: gray;">Không có</span>'; // Hiển thị số lượng hoặc "Không có"
    }

    if ($column == 'buffet_package') {
        // Lấy giá trị từ custom field 'goi_bufet'
        $goi_buffet = get_field('buffet_package', $post_id); // Nếu sử dụng ACF
        echo $goi_bufet ? $goi_bufet : '<span style="color: gray;">Chưa chọn gói</span>';
    }
    if ($column == 'order_type') {
        $customer_type = get_field('order_type', $post_id); // Nếu sử dụng ACF
        if ($customer_type === 'mua_tang') {
            echo 'Mua tặng';
        } elseif ($customer_type === 'mua_chung') {
            echo 'Mua chung';
        } elseif ($customer_type === 'mua_cho_toi') {
            echo 'Mua cho tôi';
        } else {
            echo '<span style="color: gray;">Chưa xác định</span>';
        }
    }
}

// Thêm giá trị mặc định cho custom field khi tạo bài viết mới (nếu cần)
add_action('save_post', 'set_default_payment_status');
function set_default_payment_status($post_id) {
    // Kiểm tra nếu là bài viết mới và chưa có giá trị 'payment_status'
    if (get_post_type($post_id) === 'post' && !get_field('payment_status', $post_id)) {
        update_field('payment_status', '', $post_id); // Mặc định là "Chưa thanh toán"
    }
    if (!get_field('quantity', $post_id)) {
        update_field('quantity', '0', $post_id); // Mặc định số lượng là 0
    }
    if (!get_field('buffet_package', $post_id)) {
        update_field('buffet_package', '0', $post_id); // Mặc định số lượng là 0
    }
    if (!get_field('order_type', $post_id)) {
        update_field('order_type', '0', $post_id); // Giá trị mặc định là "0"
    }

}
