<?php
function register_order_post_type(){
	$label = array(
		'name' => 'Đơn hàng',
		'singular_name' => 'Đơn hàng',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Đơn hàng',
		'supports' => array(
			'title',
		),
		'hierarchical' => true,
		'taxonomies' => array('trang-thai'),
		'show_ui' => true,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-cart',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'don-hang', 'with_front' => false)
	);
	register_post_type('don-hang', $args);
}
add_action('init', 'register_order_post_type');
/********************************************* News Category **********************************************/
	function register_order_taxonomy() {

	$labels = array(
		'name' => 'Trạng thái đơn hàng',
		'singular' => 'Trạng thái',
		'menu_name' => 'Trạng thái',
		'add_new_item' => 'Thêm trạng thái mới',
		'most_used' => 'Gần đây',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_admin_column' => 	false,
		'public'			=> false,
		'rewrite'			=> true,
		'query_var'         => true,
		'publicly_queryable' => true,
		'rewrite'           => array( 'slug' => '', 'with_front' => false ),
	);

	register_taxonomy('trang-thai', 'don-hang', $args);
}

add_action( 'init', 'register_order_taxonomy', 0 );
/********************************************* Order **********************************************/
function ajax_donhang_form(){
	$fullname = sanitize_text_field($_POST["fullname"] ?? '');
	$phone = sanitize_text_field($_POST["phone"] ?? '');
	$address = sanitize_textarea_field($_POST["address"] ?? '');
	$payment = sanitize_text_field($_POST["payment"] ?? '');
	$quantity = intval($_POST["quantity"] ?? 1);
	$postId = intval($_POST["postId"] ?? 0);
	$delivery = sanitize_text_field($_POST["delivery"] ?? '');
	$deliveryPrice = floatval($_POST["deliveryPrice"] ?? 0);

	if (!get_post($postId)) {
		echo json_encode([
			'success' => false,
			'message' => 'Sản phẩm không tồn tại.'
		]);
		die();
	}

	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'buy_now_form' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ."
			)
		);
		die();
	}

	$timestamp = microtime(true);
	$orderDate = date('YmdHis', (int)$timestamp);
	$micro = sprintf("%04d", ($timestamp - floor($timestamp)) * 10000);
	$orderNumber = "#{$orderDate}";
	$thumb = get_field('anh_dai_dien', $postId);
	$productName = get_the_title($postId);
  $unitPrice = get_field('unit_price',$postId);
  $firstPrice = $unitPrice ? $unitPrice[0] : [];
  $price = $firstPrice['gia_sp'] ?? 0;
  $discount = $firstPrice['gia_km'] ?? 0;
  $discountPrice = $price-($price * ($discount / 100));
	$finalPrice =  $discountPrice ? $discountPrice : $price;

	$dh = json_encode([
		'product_id' => $postId,
		'product_name' => $productName,
		'image' => $thumb['url'],
		'quantity' => $quantity,
		'product_price' =>$finalPrice,
		'delivery'=>$delivery,
		'delivery_price'=>$deliveryPrice,
		"order_date" => current_time('mysql'),
	], JSON_UNESCAPED_UNICODE);

	$data_id = wp_insert_post( 
		array(
			'post_title'	=> "Đơn hàng {$orderNumber} - {$fullname} - {$phone}",
			"post_type" => "don-hang",
			"post_status" => "publish",
			"meta_input" => array(
				"dh_htkh" => $fullname,
				"dh_sdtkh" => $phone,
				"dh_dckh" => $address,
				"dh_httt"=>$payment,
				"dh_sp"=>$dh
			),
		)
	);

	echo json_encode(
		array(
			'success' => true,	
			"message" => "Đơn hàng đã được tạo thành công."
		)
	);
	die();
}

add_action( 'wp_ajax_donhang_form', 'ajax_donhang_form');
add_action( 'wp_ajax_nopriv_donhang_form', 'ajax_donhang_form');
?>

<?php
add_action('acf/render_field/name=dh_sp', 'render_oder_list_readonly', 10, 1);
function render_oder_list_readonly($field) {
	echo '<style>#acf-' . esc_attr($field['key']) . ' { display: none !important; }</style>';
	$json = $field['value'];
	$item = json_decode($json, true);

	if (!empty($item) && is_array($item)) {
		$productName = $item['product_name'] ?? '';
		$quantity = intval($item['quantity'] ?? 1);
		$productPrice = floatval($item['product_price'] ?? 0);
		$deliveryPrice = floatval($item['delivery_price'] ?? 0);
		$image = is_array($item['image']) ? $item['image']['url'] : $item['image'];
		$image = esc_url($image ?: get_theme_file_uri('assets/images/noimg64.png'));

		$subtotal = $quantity * $productPrice;
		$total = $subtotal + $deliveryPrice;

		echo '<div class="note-order">';
		echo '<table class="widefat fixed striped">';
		
		// Header
		echo '<thead>';
		echo '<tr>';
		echo '<th>Hình</th>';
		echo '<th>Tên sản phẩm</th>';
		echo '<th>Số lượng</th>';
		echo '<th>Đơn giá</th>';
		echo '<th>Thành tiền</th>';
		echo '</tr>';
		echo '</thead>';

		// Body
		echo '<tbody>';
		echo '<tr>';
		echo '<td><img src="' . $image . '" alt="" style="width:64px; height:auto; border-radius:4px;" /></td>';
		echo '<td>' . esc_html($productName) . '</td>';
		echo '<td>' . esc_html($quantity) . '</td>';
		echo '<td>' . number_format($productPrice, 0, ',', '.') . ' VND</td>';
		echo '<td>' . number_format($subtotal, 0, ',', '.') . ' VND</td>';
		echo '</tr>';
		echo '</tbody>';

		// Footer
		echo '<tfoot>';
		echo '<tr>';
		echo '<th colspan="4" style="text-align:right;">Phí vận chuyển:</th>';
		echo '<th>' . number_format($deliveryPrice, 0, ',', '.') . ' VND</th>';
		echo '</tr>';
		echo '<tr>';
		echo '<th colspan="4" style="text-align:right;">Tổng cộng:</th>';
		echo '<th>' . number_format($total, 0, ',', '.') . ' VND</th>';
		echo '</tr>';
		echo '</tfoot>';

		echo '</table>';
		echo '</div>';
	} else {
		echo '<p><em>Không có sản phẩm.</em></p>';
	}
}