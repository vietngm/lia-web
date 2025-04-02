<?php
function autoRefresh(){
	$refreshToken = get_option('refreshToken');
	$env_post_id= check_pages_existed();
	$api_url = get_field('booking_environment',$env_post_id);

	if($refreshToken!=''){
		$curl = curl_init();
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
		else{
			$curl = curl_init();
			$jsonBody = json_encode(array(
				'username' => get_option('username'),
				'password' => get_option('password')
			));
			curl_setopt_array($curl, array(
				CURLOPT_URL => "$api_url/auth/sign-in",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $jsonBody,
				CURLOPT_HTTPHEADER => array('Content-Type: application/json'),)
			);

			if($data['message']=='Unauthorized'){
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
	}	

	return get_option('token');
}
add_action('admin_bar_init', 'autoRefresh');
?>