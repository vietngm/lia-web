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
/********************************************* Order **********************************************/
function ajax_donhang_form(){
	$fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$cachinhthucdautu = isset($_POST["cachinhthucdautu"]) ? $_POST["cachinhthucdautu"] : "";
	$quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 1;
	$address = isset($_POST["address"]) ? $_POST["address"] : "";
	$postId = isset($_POST["postId"]) ? $_POST["postId"] : "";

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'order_form' ) ) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Yêu cầu không hợp lệ."
			)
		);
		die();
	}

	$existing = get_field('dt_ttkh', $postId);

	if (!is_array($existing)) {
		$existing = [];
	}

	$existing[] = [
		'dh_hoten'   => $fullname,
		'dh_dtkh'    => $phone,
		'dh_htdtkh'  => $cachinhthucdautu,
		'dh_gckh'    => $note,
	];

	// update_field('dt_ttkh', $existing, $postId);
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