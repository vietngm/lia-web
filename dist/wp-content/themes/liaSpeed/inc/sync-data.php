<?php
$token= autoRefresh();
$env_post_id= check_pages_existed();
$api_url = get_field('booking_environment',$env_post_id);

$service_id = get_field('id_sync',$postId);
$employee_id = get_field('id_sync',$doctorId);
$topping_id = get_field('id_sync',$toppingId);
$sync = get_field('booking_sync',$env_post_id);
$fullname = get_field('fullname',$bookingId);

if($service_id && $sync==1){
	update_post_meta($data_id, 'booking_status', 1);
}

$data_booking = array(
	"sync" => $sync,
	'phoneNumber'=> $phone,
	'fullName' => $fullname =='' ? 'TBU':$fullname,
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