<?php
function register_recruitment_post_type(){
	$label = array(
		'name' => 'Tuyển dụng',
		'singular_name' => 'Tuyển dụng',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Tuyển dụng',
		'supports' => array(
			'title',
			'revisions',
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
	register_post_type('tuyen-dung', $args);
}
add_action('init', 'register_recruitment_post_type');
?>