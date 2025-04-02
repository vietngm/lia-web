<?php
$token= autoRefresh();
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

$service_id = get_field('id_sync',$postId);
$employee_id = get_field('id_sync',$doctorId);
$topping_id = get_field('id_sync',$toppingId);
$sync = get_field('booking_sync',$env_post_id);

if($service_id){
	update_post_meta($data_id, 'booking_status', 1);
}

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
	'source'=>'LiA',
	'status'=> 'WAIT_CONFIRM',
	'serviceId'=> $service_id ?? '',
	'employeeId'=> $employee_id,
	'toppingId'=>''
);
?>