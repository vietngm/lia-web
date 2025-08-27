<?php
function ajax_sync_product_data(){
	$datas = isset($_REQUEST["data"]) ? $_REQUEST["data"] : [];
	$page = isset($_REQUEST["p"]) ? $_REQUEST["p"] : 0;
	$envStatus = isset($_REQUEST["status"]) ? $_REQUEST["status"] : "";
	$products=[];
	$productPublishIds = [];
	$productDraftIds = [];
	$existedPublicProducts=[];
	$existedDraftProducts=[];
	$productPublishPosts=[];
	$productDraftPosts=[];
	$mergeExistedProducts = [];
	$mapProducts = [];
	$diffProducts = [];
	$newDraftProducts= [];
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
			'post_type'=> 'san-pham',
			'post_status'=> 'publish',
			'posts_per_page'=> -1,
		);
		$the_query = null;
		$the_query = new WP_Query($queryPublish);

		while ($the_query->have_posts()):$the_query->the_post();
			$post_id = trim(get_the_ID(),' ');
			$product_id = get_field('id_sync',$post_id);
			$productPublishIds[] = $product_id;
			$productPublishPosts[]=array('product_id'=>$product_id,'post_id'=>$post_id);
		endwhile;
		wp_reset_query();

		// Tim tat ca dich vu dang ton tai o trang thai draft de cap nhat.
		$queryDraft = array(
			'post_type'=> 'san-pham',
			'post_status'=> 'draft',
			'posts_per_page'=> -1,
		);
		$the_query = null;
		$the_query = new WP_Query($queryDraft);

		while ($the_query->have_posts()):$the_query->the_post();
			$post_id = trim(get_the_ID(),' ');
			$product_id = get_field('id_sync',$post_id);
			$productDraftIds[] = $product_id;
			$productDraftPosts[]=array('product_id'=>$product_id,'post_id'=>$post_id);
		endwhile;
		wp_reset_query();

		$productPublishIds = array_filter($productPublishIds);
		$productDraftIds = array_filter($productDraftIds);
		$mergeExistedProducts = array_merge($productPublishIds,$productDraftIds);
		$mergeExistedProducts = array_filter($mergeExistedProducts);

		foreach ($datas as $data) {
			$mapProducts[] =$data['id'];
			
			// Map price voi cac dich vu da ton tai trang thai publish
			if (in_array($data['id'], $productPublishIds)) {
					foreach ($productPublishPosts as $post) {
						if (($data['id']===$post['product_id'])) {
							$existedPublicProducts[] = array('product_id'=>$data['id'],'price'=>$data['price'],'post_id'=>$post['post_id'],'avatar_file'=>$data['avatarFile']);
						}
					}
			}

			// Map price voi cac dich vu da ton tai trang thai draft
			if (in_array($data['id'], $productDraftIds)) {
					foreach ($productDraftPosts as $post) {
						if (($data['id']===$post['product_id'])) {
							$existedDraftProducts[] = array('product_id'=>$data['id'],'price'=>$data['price'],'post_id'=>$post['post_id'],'avatar_file'=>$data['avatarFile']);
						}
					}
			}
		}

		// Cap nhat price voi cac dich vu da ton tai trang thai publish
		foreach ($existedPublicProducts as $product) {
			if($priceSync==1){
				update_field('price', $product['price'], $product['post_id']);
			}
			update_field('status', $envStatus, $product['post_id']);

		}

		// Cap nhat price voi cac dich vu da ton tai trang thai draft
		foreach ($existedDraftProducts as $product) {
			if($priceSync==1){
				update_field('price', $product['price'], $product['post_id']);
			}
			update_field('status', $envStatus, $product['post_id']);
		}

		// So sanh cac product o tat ca trang thai voi data request, neu chua co thi tao moi o trang thai Draft product
		$diffProducts=array_merge(array_diff($mergeExistedProducts,$mapProducts),array_diff($mapProducts,$mergeExistedProducts));

		// Map new draft dich vu
		foreach ($datas as $data) {			
			if (in_array($data['id'], $diffProducts)) {		
				$newDraftProducts[] = $data;
			}
		}

		foreach( $newDraftProducts as $data ) {
			$post_id = wp_insert_post(
				array(
					'post_title'	=> $data['name'],
					"post_type" => "san-pham",
					"post_status" => "draft",
				)
			);
			update_field('id_sync', $data['id'], $post_id);
			if($priceSync==1){
				update_field('price', $data['price'], $post_id);
			}
			update_field('status', $envStatus, $post_id);

			error_log("🟡 Avatar file: " . print_r($data['avatar_file'], true));
			error_log("🟢 Dữ liệu product: " . print_r($data, true));

			$image_url = 'https://lia-dev-space.sgp1.cdn.digitaloceanspaces.com/public-read/SERVICE/ac39f62e-5d14-46d8-aeff-160215bc8a03';
			error_log("❌ Lỗi khi tải ảnh từ URL 123: $image_url");

			// if (!empty($image_url)) {
				download_image_to_custom_field($image_url, $post_id, 'anh_dai_dien');
			// }

		}
	} catch (PDOException $e) {
		echo 'Error';
		die();
	}

	wp_send_json([
		'success' => true,
		'message' => 'Đồng bộ dữ liệu thành công.',
		'page'    => (int)$page,
	]);

	die();
}

add_action( 'wp_ajax_sync_product_data', 'ajax_sync_product_data');
add_action( 'wp_ajax_nopriv_sync_product_data', 'ajax_sync_product_data');

function download_image_to_custom_field($image_url, $post_id, $field_name = 'anh_dai_dien') {
    error_log("🟡 Bắt đầu tải ảnh: $image_url");

    $tmp = download_url($image_url);
    if (is_wp_error($tmp)) {
        error_log("❌ download_url() lỗi: " . $tmp->get_error_message());
        return false;
    }

    $file_array = array(
        'name'     => basename($image_url),
        'tmp_name' => $tmp
    );

    $file = wp_handle_sideload($file_array, array('test_form' => false));

    if (isset($file['error'])) {
        error_log("❌ wp_handle_sideload() lỗi: " . $file['error']);
        @unlink($tmp);
        return false;
    }

    error_log("✅ File đã xử lý: " . print_r($file, true));

    $attachment = array(
        'post_mime_type' => $file['type'],
        'post_title'     => sanitize_file_name($file['file']),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $file['file'], $post_id);
    if (is_wp_error($attach_id)) {
        error_log("❌ wp_insert_attachment() lỗi: " . $attach_id->get_error_message());
        return false;
    }

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);

    update_field($field_name, $attach_id, $post_id);
    error_log("✅ Ảnh đã được gán vào custom field [$field_name] với ID: $attach_id");

    return $attach_id;
}

?>