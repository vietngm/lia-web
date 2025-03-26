<?php
function ajax_sync_service_data(){
	$datas = isset($_REQUEST["data"]) ? $_REQUEST["data"] : [];
	$page = isset($_REQUEST["p"]) ? $_REQUEST["p"] : 0;
	$envStatus = isset($_REQUEST["status"]) ? $_REQUEST["status"] : "";
	$services=[];
	$servicePublishIds = [];
	$serviceDraftIds = [];
	$existedPublicServices=[];
	$existedDraftServices=[];
	$servicePublishPosts=[];
	$serviceDraftPosts=[];
	$mergeExistedServices = [];
	$mapServices = [];
	$diffServices = [];
	$newDraftServices= [];
	$env_post_id = "";
	$query = new WP_Query(
		array('post_type'=> 'page','title'=> 'Environments')
	);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$env_post_id = trim(get_the_ID(),' ');
		}
	}
	$priceSync = get_field('price_sync',$env_post_id);
	try {
		// Tim tat ca dich vu dang ton tai o trang thai publish de cap nhat.
		$queryPublish = array(
			'post_type'=> 'service',
			'post_status'=> 'publish',
			'posts_per_page'=> -1,
		);
		$the_query = null;
		$the_query = new WP_Query($queryPublish);

		while ($the_query->have_posts()):$the_query->the_post();
			$post_id = trim(get_the_ID(),' ');
			$service_id = get_field('id_sync',$post_id);
			$servicePublishIds[] = $service_id;
			$servicePublishPosts[]=array('service_id'=>$service_id,'post_id'=>$post_id);
		endwhile;
		wp_reset_query();

		// Tim tat ca dich vu dang ton tai o trang thai draft de cap nhat.
		$queryDraft = array(
			'post_type'=> 'service',
			'post_status'=> 'draft',
			'posts_per_page'=> -1,
		);
		$the_query = null;
		$the_query = new WP_Query($queryDraft);

		while ($the_query->have_posts()):$the_query->the_post();
			$post_id = trim(get_the_ID(),' ');
			$service_id = get_field('id_sync',$post_id);
			$serviceDraftIds[] = $service_id;
			$serviceDraftPosts[]=array('service_id'=>$service_id,'post_id'=>$post_id);
		endwhile;
		wp_reset_query();

		$servicePublishIds = array_filter($servicePublishIds);
		$serviceDraftIds = array_filter($serviceDraftIds);
		$mergeExistedServices = array_merge($servicePublishIds,$serviceDraftIds);
		$mergeExistedServices = array_filter($mergeExistedServices);

		foreach ($datas as $data) {
			$mapServices[] =$data['id'];
			
			// Map price voi cac dich vu da ton tai trang thai publish
			if (in_array($data['id'], $servicePublishIds)) {
					foreach ($servicePublishPosts as $post) {
						if (($data['id']===$post['service_id'])) {
							$existedPublicServices[] = array('service_id'=>$data['id'],'price'=>$data['price'],'post_id'=>$post['post_id']);
						}
					}
			}

			// Map price voi cac dich vu da ton tai trang thai draft
			if (in_array($data['id'], $serviceDraftIds)) {
					foreach ($serviceDraftPosts as $post) {
						if (($data['id']===$post['service_id'])) {
							$existedDraftServices[] = array('service_id'=>$data['id'],'price'=>$data['price'],'post_id'=>$post['post_id']);
						}
					}
			}
		}

		// Cap nhat price voi cac dich vu da ton tai trang thai publish
		foreach ($existedPublicServices as $service) {
			if($priceSync==1){
				update_field('price', $service['price'], $service['post_id']);
			}
			update_field('status', $envStatus, $service['post_id']);
		}

		// Cap nhat price voi cac dich vu da ton tai trang thai draft
		foreach ($existedDraftServices as $service) {
			if($priceSync==1){
				update_field('price', $service['price'], $service['post_id']);
			}
			update_field('status', $envStatus, $service['post_id']);
		}

		// So sanh cac service o tat ca trang thai voi data request, neu chua co thi tao moi o trang thai Draft service
		$diffServices=array_merge(array_diff($mergeExistedServices,$mapServices),array_diff($mapServices,$mergeExistedServices));

		// Map new draft dich vu
		foreach ($datas as $data) {			
			if (in_array($data['id'], $diffServices)) {		
				$newDraftServices[] = $data;
			}
		}

		foreach( $newDraftServices as $data ) {
			$post_id = wp_insert_post(
				array(
					'post_title'	=> $data['name'],
					"post_type" => "service",
					"post_status" => "draft",
				)
			);
			update_field('id_sync', $data['id'], $post_id);
			if($priceSync==1){
				update_field('price', $data['price'], $post_id);
			}
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

add_action( 'wp_ajax_sync_service_data', 'ajax_sync_service_data');
add_action( 'wp_ajax_nopriv_sync_service_data', 'ajax_sync_service_data');
?>