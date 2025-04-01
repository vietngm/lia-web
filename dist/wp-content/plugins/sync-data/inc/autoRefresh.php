<?php
function autoRefresh(){
	$refreshToken = get_option('refreshToken');
	$curl = curl_init();
	$env_post_id= check_pages_existed();
	$api_url = get_field('booking_environment',$env_post_id);

	// echo $refreshToken;

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

	return 'abc';
}
add_action('admin_bar_init', 'autoRefresh');
?>