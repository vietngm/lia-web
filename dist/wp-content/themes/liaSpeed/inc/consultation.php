<?php
function register_for_consultation(){
  $label = array(
    'name' => 'ĐK tư vấn',
    'singular_name' => 'ĐK tư vấn',
    'add_new' => 'Thêm mới'
  );
  $args = array(
    'labels' => $label,
    'description' => 'Đăng ký tư vấn nhượng quyền.',
    'supports' => array(
      'title',
      'editor'
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
  register_post_type('dk-tu-van', $args);
}
function disable_editor_for_consultation() {
  remove_post_type_support('dk-tu-van', 'editor');   
}
add_action('init', 'register_for_consultation');
add_action('init', 'disable_editor_for_consultation');
?>