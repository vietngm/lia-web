<?php
function register_news_post_type(){
	$label = array(
		'name' => 'Tin tức',
		'singular_name' => 'Tin tức',
		'add_new' => 'Thêm mới'
	);
	$args = array(
		'labels' => $label,
		'description' => 'Tin tức',
		'supports' => array(
			'title',
			'revisions',
			'thumbnail',
			'editor',
		),
		'hierarchical' => true,
		'taxonomies' => array('news-category'),	
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
	register_post_type('tin-tuc', $args);
}
add_action('init', 'register_news_post_type');
/********************************************* News Category **********************************************/
function register_news_category_taxonomy() {

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

	register_taxonomy('news-category', 'tin-tuc', $args);
}

add_action( 'init', 'register_news_category_taxonomy', 0 );
?>