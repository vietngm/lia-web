<?php
function register_investment_post_type(){
	$label = array(
		'name' => 'Đầu tư',
		'singular_name' => 'Đầu tư',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Đầu tư',
		'supports' => array(
			'title',
			// 'revisions',
			// 'thumbnail',
			// 'editor',
		),
		'hierarchical' => true,
		'taxonomies' => array('investment-tag'),	
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
		'menu_icon' => 'dashicons-editor-ul',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'dau-tu', 'with_front' => false)
	);
	register_post_type('investment', $args);
}
add_action('init', 'register_investment_post_type');
/********************************************* News Category **********************************************/
	function register_investment_category_taxonomy() {

	$labels = array(
		'name' => 'Tags',
		'singular' => 'Tag',
		'menu_name' => 'Tags',
		'add_new_item' => 'Thêm tag mới',
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

		register_taxonomy('investment-tag', 'dau-tu', $args);
}

add_action( 'init', 'register_investment_category_taxonomy', 0 );

/********************************************* Recruitment **********************************************/
function ajax_investment_form(){
	$fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$cachinhthucdautu = isset($_POST["cachinhthucdautu"]) ? $_POST["cachinhthucdautu"] : "";
	$note = isset($_POST["message"]) ? $_POST["message"] : "";
	$postId = isset($_POST["postId"]) ? $_POST["postId"] : "";

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'investment_form' ) ) {
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
		'dt_hoten'   => $fullname,
		'dt_dtkh'    => $phone,
		'dt_htdtkh'  => $cachinhthucdautu,
		'dt_gckh'    => $note,
	];

	update_field('dt_ttkh', $existing, $postId);
		echo json_encode(
			array(
				'success' => true,	
				"message" => "Đăng ký đầu tư thành công."
			)
		);
		die();
	}

add_action( 'wp_ajax_investment_form', 'ajax_investment_form');
add_action( 'wp_ajax_nopriv_investment_form', 'ajax_investment_form');
?>