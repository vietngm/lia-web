<?php
function my_edit_booking_columns( $columns ){
  ?>
<div id="modal-success" class="modal modal-success">
  <div class="modal-wrap">
    <div class="modal-header">
      <div class="modal-title">Thành công</div>
      <div class="modal-nav">
        <div class="modal-close">&#x2715;</div>
      </div>
    </div>
    <div class="modal-inside">
      <div class="modal-message">
        <div class="modal-label">Dữ liệu đã được đồng bộ <span>&#x2713;</span></div>
      </div>
    </div>
  </div>
</div>
<div id="modal-process" class="modal modal-process">
  <div class="modal-wrap">
    <div class="modal-inside">
      <div class="modal-message">
        <div class="modal-label">Đang đồng bộ...</div>
        <img src="<?php echo plugins_url('../images/ajaxloader.gif', __FILE__) ?>" />
      </div>
    </div>
  </div>
</div>
<?php
	if( is_array( $columns ) && ! isset( $columns['booking_status'] ) )
    $columns['booking_status'] = __( 'Trạng thái' );
    return $columns;
}
function my_manage_booking_columns( $column_name, $post_id){
  $status = get_post_meta($post_id,'booking_status',true);
  $serviceId  = get_field('service',$post_id);
  $idSync = get_field('id_sync',$serviceId);
	if ( $column_name == 'booking_status'){
    $htmlFaile = $idSync!="" ? '<span class="dashicons dashicons-update dashicons-faile js-dashicons-failure red"></span>':'<span class="dashicons dashicons-update dashicons-faile gray"></span>';
    $htmlSuccess = '<span class="dashicons dashicons-yes-alt dashicons-success"></span>';
    ?>
<ul class="sync-status">
  <li data-rel="<?php echo $post_id ?>" class="sync-status-item status-item-<?=$post_id?>">
    <?php  echo $status ? $htmlSuccess:$htmlFaile; ?>
  </li>
</ul>
<?php
  }
}

add_filter( 'manage_booking_posts_columns', 'my_edit_booking_columns' ) ;
add_action( 'manage_booking_posts_custom_column', 'my_manage_booking_columns', 10, 2 );

function ajax_sync_booking(){

  $token= autoRefresh();
  $env_post_id= check_pages_existed();
	$api_url = get_field('booking_environment',$env_post_id);

  // Map data for sync to App
  
  $bookingId= isset($_REQUEST['bookingId']) ? $_REQUEST['bookingId'] : '';
  $post = get_post($bookingId);
  $fullname = get_field('fullname',$bookingId);
  $serviceId  = get_field('service',$bookingId);
  $doctorId = get_field('doctor',$bookingId);
  $noteTopping = get_field('note',$bookingId);
  $service_id = get_field('id_sync',$serviceId);
  $employee_id = get_field('id_sync',$doctorId);
  $sync = get_field('booking_sync',$env_post_id);
  $phone = get_field('phone',$bookingId);
  $date = get_field('date',$bookingId);
  $time = get_field('time',$bookingId);
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
    'serviceId'=> $service_id,
    'employeeId'=> $employee_id,
    'toppingId'=>''
  );

  if (!$bookingId) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Booking Id không đúng"
			)
		);
		die();
	}
  
	echo json_encode(
    array(
      'success'=>true,
      "message" => "Đồng bộ booking thành công",
      "data"=> $data_booking
    )
  );
  
  update_post_meta($bookingId, 'booking_status', 1);
  die();
}

add_action( 'wp_ajax_sync_booking', 'ajax_sync_booking');
add_action( 'wp_ajax_nopriv_sync_booking', 'ajax_sync_booking');
// $serviceBooking = file_get_contents(get_template_directory() . '/template/booking.php');
// wp_localize_script('my_booking_script', 'bookingData', array(
//   'serviceBooking' => $serviceBooking
// ));
?>