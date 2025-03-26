<?php 
	$fields = get_fields();
	$post_type = $args["post_type"] ?? "service";

	$doctor_name = get_the_title($fields["doctor"]);
	$doctor_location = get_field("location", $fields["doctor"]);
	$services = get_posts(array(
		"post_type" => "service",
		"posts_per_page" => 3,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'diaries',
				'value' => '"'.get_the_ID().'"',
				'compare' => 'LIKE'
			),
		),
	));
?>
		<div class="flex mb-4 mt-2 " style="width:160px">
				<a href="<?= $fields["image"]["before"] ?>" data-fancybox class="relative">
					<img style="width:100px" class="  object-cover object-center" src="<?= bfi_thumb($fields["image"]["before"] , array("width"=>600, 'crop'=>false)) ?>" />
					<div class="mt-1 text-center text-post" style="font-size: 8px;
						width: 81px;
						margin-top: -22px;
						background:#56455a4d;
						overflow: hidden;
						position: relative;
						padding: 5px;
						color: #fff;
						font-weight: 600;" >
						Trước điều trị
					</div>
				</a>
				<a href="<?= $fields["image"]["after"] ?>" data-fancybox class="relative">
					<img style="width:100px" class=" object-cover object-center" src="<?= bfi_thumb($fields["image"]["after"] , array("width"=>600, 'crop'=>false)) ?>" />
					<div class="mt-1 text-center text-post"  style="font-size: 8px;
						width: 81px;
						margin-top: -22px;
						background: #56455a4d;
						overflow: hidden;
						position: relative;
						padding: 5px;
						color: #fff;
						font-weight: 600;">
						Sau điều trị
					</div>
				</a>
				
		</div>


