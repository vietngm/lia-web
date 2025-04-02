<?php
// Auth & save token
function ajax_auth(){
	$token = isset($_REQUEST["token"]) ? $_REQUEST["token"] : null;
	$refreshToken = isset($_REQUEST["refreshToken"]) ? $_REQUEST["refreshToken"] : null;
	$username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : null;
	$password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : null;
	update_option('token',$token);
	update_option('refreshToken',$refreshToken);
	update_option('username',$username);
	update_option('password',$password);
	echo json_encode(
		array(
			'success' => true,	
			'message' => "Sign in successfully.",
			'username' => $username,
			'password' => $password,
		)
	);
	die();
}

add_action( 'wp_ajax_auth', 'ajax_auth');
add_action( 'wp_ajax_nopriv_auth', 'ajax_auth');

// Logout & remove token
function logout(){
	update_option('token','');
	update_option('refreshToken','');
	update_option('username','');
	update_option('password','');
}
if(array_key_exists('logout',$_POST)){
   logout();
}

// Create page config environment
function check_pages_existed(){
	$page_existed="";
	$query = new WP_Query(
    array('post_type'=> 'page','title'=> 'Environments')
	);
 
	if (!empty( $query->post)) {
		$page_existed = $query->post;
	} else {
		$page_existed = create_page('Environments');
	}
	return $page_existed->ID;
}
function create_page($pageName) {
	$createPage = array(
		'post_title'    => $pageName,
		'post_content'  => 'Starter content',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'post_name'     => $pageName
	);
	wp_insert_post( $createPage );
}
add_action('init','check_pages_existed');

// Include ajax sync datas
include('inc/service.php');
include('inc/doctor.php');

add_action('admin_init', 'hide_editor');

function hide_editor() {    
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	if (!isset($post_id))
		return;
	$hide_page = get_the_title($post_id);
	if ($hide_page == 'Environments') {
		remove_post_type_support('page', 'editor');
	}
}
// Auto refresh token
include('inc/autoRefresh.php');
// Include booking status
include('inc/bookingStatus.php');
?>