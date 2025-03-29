<?php
function my_edit_booking_columns( $columns ){
	if( is_array( $columns ) && ! isset( $columns['booking_status'] ) )
    $columns['booking_status'] = __( 'Trạng thái' );     
    return $columns;
}
function my_manage_booking_columns( $column_name, $post_id){
  $status = get_post_meta($post_id,'booking_status',true);
	if ( $column_name == 'booking_status'){
    $htmlFaile = '<span class="dashicons dashicons-update dashicons-faile js-dashicons-failure"></span>';
    $htmlSuccess = '<span class="dashicons dashicons-yes-alt dashicons-success"></span>';
    ?>
<ul class="sync-status">
  <link data-rel="<?php echo $post_id ?>" class="sync-status-item">
  <?php  echo $status ? $htmlSuccess:$htmlFaile; ?>
  </diliv>
</ul>
<?php
  }
}
add_filter( 'manage_booking_posts_columns', 'my_edit_booking_columns' ) ;
add_action( 'manage_booking_posts_custom_column', 'my_manage_booking_columns', 10, 2 );

function sync_booking(){
  $bookingId= isset($_POST['bookingId']) ? $_POST['bookingId'] : '';
  $post = get_post($bookingId);
  $doctorId = get_post_meta($post->ID,'doctor_id',true);

  if (!$bookingId) {
		echo json_encode(
			array(
				'success'=>false,
				"message" => "Booking Id không đúng"
			)
		);
		die();
	}

// $token = get_option('token') ?? $newToken;
// $service_id = get_field('id_sync',$postId);
// $employee_id = get_field('id_sync',$doctorId);
// $topping_id = get_field('id_sync',$toppingId);
// $sync = get_field('booking_sync',$env_post_id);

// $data_booking = array(
// 	"sync" => $sync,
// 	'phoneNumber'=> $phone,
// 	'fullName' => $note =='' ? 'TBU':$note,
// 	'branchId'=> '',
// 	'appointmentDateTime'=> $date.' '.$time,
// 	'note'=> $noteTopping,
// 	'apiUrl'=> $api_url,
// 	'token'=> $token,
// 	'platformType'=> 'WEB',
// 	'source'=>'LiA',
// 	'status'=> 'WAIT_CONFIRM',
// 	'serviceId'=> $service_id,
// 	'employeeId'=> $employee_id,
// 	'toppingId'=>''
// );
}

function htmlTemplate($post_id){
  $htmlFaile = '<span class="dashicons dashicons-update dashicons-faile js-dashicons-failure"></span>';
  $htmlSuccess = '<span class="dashicons dashicons-yes-alt dashicons-success"></span>';
  $html = ob_get_clean();
?>
<div class="sync-status">
  <div>
    <?php
      // $post = get_post($post_id);
      // $doctorId = get_post_meta($post->ID,'doctor_id',true);
      // print_r($post);
    ?>
  </div>
  <div data-rel="<?php echo $post_id ?>" class="sync-status-item">
    <?php  echo $status ? $htmlSuccess:$htmlFaile; ?>
  </div>
</div>
<?php
// return $html;
}

add_action( 'wp_ajax_sync_booking', 'ajax_sync_booking');
add_action( 'wp_ajax_nopriv_sync_booking', 'ajax_sync_booking');

// $serviceBooking = file_get_contents(get_template_directory() . '/template/booking.php');
// wp_localize_script('my_booking_script', 'bookingData', array(
//   'serviceBooking' => $serviceBooking
// ));
?>