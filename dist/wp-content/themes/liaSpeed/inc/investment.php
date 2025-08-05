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
			'revisions',
			'thumbnail',
			'editor',
		),
		'hierarchical' => true,
		// 'taxonomies' => array(),	
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

		register_taxonomy('investment-category', 'investment', $args);
}

// add_action( 'init', 'register_investment_category_taxonomy', 0 );
?>