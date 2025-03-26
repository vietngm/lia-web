<?php
function ajax_sync_doctor_data(){
	$datas = isset($_REQUEST["data"]) ? $_REQUEST["data"] : [];
	$page = isset($_REQUEST["p"]) ? $_REQUEST["p"] : 0;
	$envStatus = isset($_REQUEST["status"]) ? $_REQUEST["status"] : "";
	$doctors=[];
	$doctorPublishIds = [];
	$doctorDraftIds = [];
	$existedPublicDoctors=[];
	$existedDraftDoctors=[];
	$doctorPublishPosts=[];
	$doctorDraftPosts=[];
	$mergeExistedDoctors = [];
	$mapDoctors = [];
	$diffDoctors = [];
	$newDraftDoctors= [];
	
	try {
		// Tim tat ca dich vu dang ton tai o trang thai publish de cap nhat.
		$queryPublish = array(
			'post_type'=> 'practitioner',
			'post_status'=> 'publish',
			'posts_per_page'=> -1,
		);
		$the_query = null;
		$the_query = new WP_Query($queryPublish);

		while ($the_query->have_posts()):$the_query->the_post();
			$post_id = trim(get_the_ID(),' ');
			$employee_id = get_field('id_sync',$post_id);
			$doctorPublishIds[] = $employee_id;
			$doctorPublishPosts[]=array('employee_id'=>$employee_id,'post_id'=>$post_id);
		endwhile;
		wp_reset_query();

		// Tim tat ca dich vu dang ton tai o trang thai draft de cap nhat.
		$queryDraft = array(
			'post_type'=> 'practitioner',
			'post_status'=> 'draft',
			'posts_per_page'=> -1,
		);
		$the_query = null;
		$the_query = new WP_Query($queryDraft);

		while ($the_query->have_posts()):$the_query->the_post();
			$post_id = trim(get_the_ID(),' ');
			$employee_id = get_field('id_sync',$post_id);
			$doctorDraftIds[] = $employee_id;
			$doctorDraftPosts[]=array('employee_id'=>$employee_id,'post_id'=>$post_id);
		endwhile;
		wp_reset_query();

		$mergeExistedDoctors = array_merge($doctorPublishIds,$doctorDraftIds);
		$mergeExistedDoctors = array_filter($mergeExistedDoctors);

		foreach ($datas as $data) {
			$mapDoctors[] =$data['employeeId'];
			
			// Map status voi cac doctor da ton tai trang thai publish
			if (in_array($data['employeeId'], $doctorPublishIds)) {
					foreach ($doctorPublishPosts as $post) {
						if (($data['employeeId']===$post['employee_id'])) {
							$existedPublicDoctors[] = array('employee_id'=>$data['employeeId'],'post_id'=>$post['post_id']);
						}
					}
			}

			// Map status voi cac doctor da ton tai trang thai draft
			if (in_array($data['employeeId'], $doctorDraftIds)) {
					foreach ($doctorDraftPosts as $post) {
						if (($data['employeeId']===$post['employee_id'])) {
							$existedDraftDoctors[] = array('employee_id'=>$data['employeeId'],'post_id'=>$post['post_id']);
						}
					}
			}
		}

		// Cap nhat price voi cac doctor da ton tai trang thai publish
		foreach ($existedPublicDoctors as $doctor) {
			update_field('status', $envStatus, $doctor['post_id']);
		}

		// Cap nhat price voi cac doctor da ton tai trang thai draft
		foreach ($existedDraftDoctors as $doctor) {
			update_field('status', $envStatus, $doctor['post_id']);
		}

		// So sanh cac doctor o tat ca trang thai voi data request, neu chua co thi tao moi o trang thai Draft doctor
		$diffDoctors=array_merge(array_diff($mergeExistedDoctors,$mapDoctors),array_diff($mapDoctors,$mergeExistedDoctors));

		// Map new draft doctor
		foreach ($datas as $data) {			
			if (in_array($data['employeeId'], $diffDoctors)) {		
				$newDraftDoctors[] = $data;
			}
		}

		foreach( $newDraftDoctors as $data ) {
			$post_id = wp_insert_post(
				array(
					'post_title'	=> $data['name'],
					"post_type" => "practitioner",
					"post_status" => "draft",
				)
			);
			update_field('id_sync', $data['employeeId'], $post_id);
			update_field('status', $envStatus, $post_id);
		}
	} catch (PDOException $e) {
		echo 'Error';
		die();
	}
	echo json_encode(
		array(
			'success' => true,	
			"message" => "Đồng bộ dữ liệu thành công.",
			"page"=>(int)$page,
		)
	);
	die();
}

add_action( 'wp_ajax_sync_doctor_data', 'ajax_sync_doctor_data');
add_action( 'wp_ajax_nopriv_sync_doctor_data', 'ajax_sync_doctor_data');
?>