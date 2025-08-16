<?php

require "inc/BFI_Thumb.php";
// require "inc/sms/send_sms.php";
require "inc/post-type.php";
require "inc/ajax.php";
require 'login/login.php';

setlocale(LC_ALL, 'vi_VN');
date_default_timezone_set('Asia/Ho_Chi_Minh');

/*************************************************************************************/
/******************************* Add title to wp_head() ******************************/
if (!function_exists('add_title_to_head')){
	function add_title_to_head(){
		echo '<title>' . wp_title( '| LiA Beauty', false, 'right' ) . '</title>';
	}
	add_action( 'wp_head', 'add_title_to_head' );
}
/******************************* Add title to wp_head() ******************************/
/*************************************************************************************/

/*************************************************************************************/
/******************************* Load script *****************************************/
$ASSETS_VERSION = "1.0.0";
function modify_jquery() {
	global $ASSETS_VERSION;
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_theme_file_uri( '/assets/js/jquery-3.7.1.min.js' ), false, $ASSETS_VERSION);
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'modify_jquery');
add_action( "wp_enqueue_scripts", 'load_scripts' );
function load_scripts(){
	global $ASSETS_VERSION;
	wp_enqueue_style( 'tbc', get_stylesheet_uri() );
	wp_enqueue_style( 'slick', get_theme_file_uri( '/assets/css/slick.css' ), array(), $ASSETS_VERSION, "all" );
	wp_enqueue_style( 'slick-theme', get_theme_file_uri( '/assets/css/slick-theme.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'select2', get_theme_file_uri( '/assets/css/select2.min.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'datetimepicker', get_theme_file_uri( '/assets/css/jquery.datetimepicker.min.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'fancybox', get_theme_file_uri( '/assets/css/fancybox.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'toastify', get_theme_file_uri( '/assets/css/toastify.min.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'styles', get_theme_file_uri( '/assets/css/styles.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'custom-style', get_theme_file_uri( '/style.css' ), array(), $ASSETS_VERSION );
	// wp_enqueue_style( 'custom-style', get_theme_file_uri( '/assets/css/custom.css' ), array(), $ASSETS_VERSION );
	wp_enqueue_style( 'common-style', get_theme_file_uri( '/assets/css/common.css' ), array(), $ASSETS_VERSION );

	wp_enqueue_script( 'lazyload', get_theme_file_uri( '/assets/js/jquery.lazyload.min.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'slick', get_theme_file_uri( '/assets/js/slick.min.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'select2', get_theme_file_uri( '/assets/js/select2.min.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'datetimepicker', get_theme_file_uri( '/assets/js/jquery.datetimepicker.full.min.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'fancybox', get_theme_file_uri( '/assets/js/fancybox.umd.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'floating-ui-core', get_theme_file_uri( '/assets/js/floating-ui.core.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'floating-ui-dome', get_theme_file_uri( '/assets/js/floating-ui.dom.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'toastify', get_theme_file_uri( '/assets/js/toastify-js.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'common-customize', get_theme_file_uri( '/assets/js/common.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'booking', get_theme_file_uri( '/assets/js/booking.js' ), array(), $ASSETS_VERSION, true );
	wp_enqueue_script( 'script', get_theme_file_uri( '/assets/js/script.js' ), array(), $ASSETS_VERSION, true );

}
add_action('admin_head', 'load_admin_scripts');
function load_admin_scripts() {
	global $ASSETS_VERSION;
	$script_url = get_theme_file_uri( '/assets/css/admin.css' );
  	echo '<link rel="stylesheet" href="' . $script_url . '?version=' . $ASSETS_VERSION . '" type="text/css" media="all" />';
}
/******************************* Load script *****************************************/
/*************************************************************************************/

/*************************************************************************************/
/******************************* COMMON **********************************************/

//////// Remove admin bar

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	  show_admin_bar(false);
}
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
}
//theme Option:
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Cấu hình LiA',
		'menu_title'	=> 'Cấu hình LiA',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'	=> false
	));
}
/******************************* COMMON **********************************************/
/*************************************************************************************/

function start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session', 1);

add_filter('intermediate_image_sizes_advanced', function($sizes) {
    unset($sizes['thumbnail']); // Xóa kích thước Thumbnail
    unset($sizes['medium']);    // Xóa kích thước Medium
    unset($sizes['large']);     // Xóa kích thước Large
    return $sizes;
});

// $service_summary = file_get_contents(get_template_directory() . '/template-parts/service-summary.php');

// // Truyền dữ liệu từ PHP sang JavaScript
// wp_localize_script('my_script', 'serviceData', array(
//   'serviceSummary' => $service_summary // Dữ liệu sẽ được truyền sang JavaScript
// ));

/*-----------------------------------------------------------------------*/

function getExcerptLimit($count,$excerpt){  
  $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'...';
  return $excerpt;
}

function enqueue_investment_script() {
	// Đưa script JS của bạn vào đây (thay đường dẫn đúng)
	wp_enqueue_script('investment-script', get_template_directory_uri() . '/assets/js/common.js', ['jquery'], null, true);

	// Dữ liệu bạn muốn truyền từ PHP sang JS
	$investment_data = [];

	$args = [
		'post_type'      => 'investment',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	];

	$posts = get_posts($args);
	foreach ($posts as $post) {
		$post_id = $post->ID;

		$investment_data[$post_id] = [
			'name'     => get_the_title($post_id),
			'phong'    => get_field('dt_succhua', $post_id),
			'dientich' => get_field('dt_dientich', $post_id),
			'diachi'   => get_field('dt_dia_chi', $post_id),
		];
	}

	// Truyền sang JS
	wp_localize_script('investment-script', 'investmentData', $investment_data);
}
add_action('wp_enqueue_scripts', 'enqueue_investment_script');