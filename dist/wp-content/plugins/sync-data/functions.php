<?php
// Auth & save token
function ajax_auth(){
	$token = isset($_REQUEST["token"]) ? $_REQUEST["token"] : null;
	$refreshToken = isset($_REQUEST["refreshToken"]) ? $_REQUEST["refreshToken"] : null;
	update_option('token',$token);
	update_option('refreshToken',$refreshToken);
	echo json_encode(
		array(
			'success' => true,	
			"message" => "Sign in successfully.",
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
}
if(array_key_exists('logout',$_POST)){
   logout();
}

// Create page config environment
function check_pages_existed(){
	$query = new WP_Query(
    array('post_type'=> 'page','title'=> 'Environments')
	);
 
	if (!empty( $query->post)) {
		$page_got_by_title = $query->post;
	} else {
		create_page('Environments');
	}
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

// include ajax sync datas
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
function autoRefresh(){
	$refreshToken = get_option('refreshToken');
	$curl = curl_init();
	$env_post_id= "";
	$query = new WP_Query(
		array('post_type'=> 'page','title'=> 'Environments')
	);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$env_post_id = trim(get_the_ID(),' ');
		}
	}

	$api_url = get_field('booking_environment',$env_post_id);

	if($refreshToken!=''){
		curl_setopt_array($curl, array(
		CURLOPT_URL => "$api_url/auth/refresh-token",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_HTTPHEADER => array("Authorization: Bearer $refreshToken"),));

		$response = curl_exec($curl);
		$data = json_decode($response, true);

		if($data['data']){
				$newToken = $data['data']['token'];
				$newRefreshToken=$data['data']['refreshToken'];
				update_option('token',$newToken);
				update_option('refreshToken',$newRefreshToken);
		}
	}
}
add_action('admin_init', 'autoRefresh');
?>