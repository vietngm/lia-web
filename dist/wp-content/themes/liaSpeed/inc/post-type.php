<?php

/********************************************* Service **********************************************/
function register_service_post_type(){
	$label = array(
		'name' => 'Dịch vụ',
		'singular_name' => 'Dịch vụ',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Dịch vụ',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
		),
		'hierarchical' => true,
		'taxonomies' => array('service-group-category', 'service-category', 'appropriate-person'),	
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
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'dich-vu', 'with_front' => false)
	);
	register_post_type('service', $args);
}
add_action('init', 'register_service_post_type');

/********************************************* Service Category **********************************************/
function register_service_category_taxonomy() {

	$labels = array(
		'name' => 'Danh mục',
		'singular' => 'Danh mục',
		'menu_name' => 'Danh mục',
		'add_new_item' => 'Thêm mới danh mục',
		'most_used' => 'Gần đây',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'			=> false,
		'rewrite'			=> true,
		'query_var'         => true,
		'publicly_queryable' => true,
		'rewrite'           => array( 'slug' => '', 'with_front' => false ),
	);

	register_taxonomy('service-category', 'post-type', $args);
}

add_action( 'init', 'register_service_category_taxonomy', 0 );

/********************************************* Topping **********************************************/
function register_service_topping_taxonomy() {

	$labels = array(
		'name' => 'Topping',
		'singular' => 'Topping',
		'menu_name' => 'Topping',
		'add_new_item' => 'Thêm mới Topping',
		'most_used' => 'Gần đây',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'			=> false,
		'rewrite'			=> true,
		'query_var'         => true,
		'publicly_queryable' => true,
		'rewrite'           => array( 'slug' => '', 'with_front' => false ),
	);

	register_taxonomy('service-topping', "service", $args);
}

add_action( 'init', 'register_service_topping_taxonomy', 0 );

/********************************************* Appropriate person **********************************************/
function register_appropriate_person_taxonomy() {

	$labels = array(
		'name' => 'Đối tượng phù hợp',
		'singular' => 'Đối tượng phù hợp',
		'menu_name' => 'Đối tượng phù hợp',
		'add_new_item' => 'Thêm mới đối tượng phù hợp',
		'most_used' => 'Gần đây',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'			=> false,
		'rewrite'			=> true,
		'query_var'         => true,
		'publicly_queryable' => true,
		'rewrite'           => array( 'slug' => '', 'with_front' => false ),
	);

	register_taxonomy('appropriate-person', 'post-type', $args);
}

add_action( 'init', 'register_appropriate_person_taxonomy', 0 );

/********************************************* Practitioner **********************************************/
function register_practitioner_post_type(){
	$label = array(
		'name' => 'Chuyên viên',
		'singular_name' => 'Chuyên viên',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Chuyên viên',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
			'editor',
			'page-attributes'
		),
		'hierarchical' => true,
		'taxonomies' => array(),	
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
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'chuyen-vien', 'with_front' => false)
	);
	register_post_type('practitioner', $args);
}
add_action('init', 'register_practitioner_post_type');

/********************************************* Franchise **********************************************/
function register_franchise_post_type(){
	$label = array(
		'name' => 'Mô hình nhượng quyền',
		'singular_name' => 'Mô hình nhượng quyền',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Mô hình nhượng quyền',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
			'editor',
			'page-attributes'
		),
		'hierarchical' => true,
		'taxonomies' => array(),	
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
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'mo-hinh-nhuong-quyen', 'with_front' => false)
	);
	register_post_type('franchise', $args);
}
add_action('init', 'register_franchise_post_type');

/********************************************* Branch **********************************************/
function register_branch_post_type(){
	$label = array(
		'name' => 'Chi nhánh',
		'singular_name' => 'Chi nhánh',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Chi nhánh',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
			'editor',
			'page-attributes'
		),
		'hierarchical' => true,
		'taxonomies' => array(),	
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
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'chi-nhanh', 'with_front' => false)
	);
	register_post_type('branch', $args);
}
add_action('init', 'register_branch_post_type');

/********************************************* Diary **********************************************/
function register_diary_post_type(){
	$label = array(
		'name' => 'Nhật ký',
		'singular_name' => 'Nhật ký',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Nhật ký',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
			'editor',
			'page-attributes'
		),
		'hierarchical' => true,
		'taxonomies' => array(),	
		'show_ui' => true,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'nhat-ky', 'with_front' => false)
	);
	register_post_type('diary', $args);
}
add_action('init', 'register_diary_post_type');

/********************************************* Booking **********************************************/
function register_booking_post_type(){
	$label = array(
		'name' => 'Lịch đặt',
		'singular_name' => 'Lịch đặt',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Lịch đặt',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
			'editor',
			'page-attributes'
		),
		'hierarchical' => true,
		'taxonomies' => array(),	
		'show_ui' => true,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
	);
	register_post_type('booking', $args);
}
add_action('init', 'register_booking_post_type');
	
// /********************************************* Doctor contact data **********************************************/
// function register_doctor_contact_data_post_type(){
// 	$label = array(
// 		'name' => 'Liên hệ chuyên viên',
// 		'singular_name' => 'Liên hệ bác sĩ',
// 		'add_new' => 'Thêm mới'
// 	);
// 	$args = array(
// 		'labels' => $label,
// 		'description' => 'Liên hệ bác sĩ',
// 		'supports' => array(
// 			'title',
// 			'thumbnail',
// 			'revisions',
// 			'editor',
// 			'page-attributes'
// 		),
// 		'hierarchical' => true,
// 		'taxonomies' => array(),	
// 		'show_ui' => true,
// 		'public' => false,
// 		'publicly_queryable' => false,
// 		'exclude_from_search' => false,
// 		'show_in_admin_bar' => true,
// 		'show_in_nav_menus' => true,
// 		'query_var' => true,
// 		'capability_type' => 'post',
// 		'show_in_menu' => true,
// 		'menu_position' => 20,
// 		'menu_icon' => 'dashicons-admin-site',
// 		'can_export' => true,
// 		'has_archive' => false,
// 	);
// 	register_post_type('doctor-contact-data', $args);
// }
// add_action('init', 'register_doctor_contact_data_post_type');

// /********************************************* Price contact data **********************************************/
// function register_booking_price_contact_data_post_type(){
// 	$label = array(
// 		'name' => 'Đặt lịch - Nhận báo giá',
// 		'singular_name' => 'Đặt lịch - Nhận báo giá',
// 		'add_new' => 'Thêm mới'
// 	);
// 	$args = array(
// 		'labels' => $label,
// 		'description' => 'Đặt lịch - Nhận báo giá',
// 		'supports' => array(
// 			'title',
// 			'thumbnail',
// 			'revisions',
// 			'editor',
// 			'page-attributes'
// 		),
// 		'hierarchical' => true,
// 		'taxonomies' => array(),	
// 		'show_ui' => true,
// 		'public' => false,
// 		'publicly_queryable' => false,
// 		'exclude_from_search' => false,
// 		'show_in_admin_bar' => true,
// 		'show_in_nav_menus' => true,
// 		'query_var' => true,
// 		'capability_type' => 'post',
// 		'show_in_menu' => true,
// 		'menu_position' => 20,
// 		'menu_icon' => 'dashicons-admin-site',
// 		'can_export' => true,
// 		'has_archive' => false,
// 	);
// 	register_post_type('booking-price-data', $args);
// }
// add_action('init', 'register_booking_price_contact_data_post_type');

/********************************************* Price contact data **********************************************/
function register_price_contact_data_post_type(){
	$label = array(
		'name' => 'Nhận báo giá',
		'singular_name' => 'Nhận báo giá',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Nhận báo giá',
		'supports' => array(
			'title',
			'thumbnail',
			'revisions',
			'editor',
			'page-attributes'
		),
		'hierarchical' => true,
		'taxonomies' => array(),	
		'show_ui' => true,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
	);
	register_post_type('price-data', $args);
}
add_action('init', 'register_price_contact_data_post_type');
/********************************************* Consultation **********************************************/
include get_template_directory() . "/inc/consultation.php";
/********************************************* Product Data **********************************************/
function register_product_post_type(){
	$label = array(
		'name' => 'Sản phẩm',
		'singular_name' => 'Sản phẩm',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Sản phẩm',
		'supports' => array(
			'title',
			'revisions',
		),
		'hierarchical' => true,
		'taxonomies' => array('product-category'),	
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
		'menu_icon' => 'dashicons-admin-site',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'san-pham', 'with_front' => false)
	);
	register_post_type('san-pham', $args);
}
add_action('init', 'register_product_post_type');

function register_product_category_taxonomy() {

	$labels = array(
		'name' => 'Danh mục sản phẩm',
		'singular' => 'Danh mục sản phẩm',
		'menu_name' => 'Danh mục sản phẩm',
		'add_new_item' => 'Thêm mới danh mục sản phẩm',
		'most_used' => 'Gần đây',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'			=> false,
		'rewrite'			=> true,
		'query_var'         => true,
		'publicly_queryable' => true,
		'rewrite'=> array( 'slug' => 'product-category', 'with_front' => false ),
	);

	register_taxonomy('product-category', 'post-type', $args);
}

add_action( 'init', 'register_product_category_taxonomy', 0 );

/********************************************* Recruitment **********************************************/
include get_template_directory() . "/inc/recruitment.php";
/********************************************* News **********************************************/
include get_template_directory() . "/inc/news.php";
/********************************************* Render List **********************************************/
include get_template_directory() . "/inc/render-list.php";