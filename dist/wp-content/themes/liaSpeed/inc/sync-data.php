<?php
$env_post_id= "";
$newToken = "";
$refreshToken = get_option('refreshToken');
$curl = curl_init();
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

$token = get_option('token') ?? $newToken;
$service_id = get_field('id_sync',$postId);
$employee_id = get_field('id_sync',$doctorId);
$topping_id = get_field('id_sync',$toppingId);
$sync = get_field('booking_sync',$env_post_id);

$data_booking = array(
	"sync" => $sync,
	'phoneNumber'=> $phone,
	'fullName' => $note =='' ? 'TBU':$note,
	'branchId'=> '',
	'appointmentDateTime'=> $date.' '.$time,
	'note'=> $noteTopping,
	'apiUrl'=> $api_url,
	'token'=> $token,
	'platformType'=> 'WEB',
	'status'=> 'WAIT_CONFIRM',
	'serviceId'=> $service_id,
	'employeeId'=> $employee_id,
	'toppingId'=>''
);
?>