<?php
	$args = array(
		"post_type" => "booking",
		"posts_per_page" => -1,
    "meta_query" => array(
			array(
				'key' => 'booking_status',
				'value' => 0,
				'compare' => '='
			)
    ),
	);
	$the_query = new WP_Query( $args );
  if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $data_id = get_the_ID();
      $doctorId = get_field('doctor_id',$data_id);
      $postId = get_field('post_id',$data_id);
      $toppingId = get_field('topping_id',$data_id);
      $phone = get_field('phone_number',$data_id);
      $date = get_field('date',$data_id);
      $time = get_field('time',$data_id);
      $noteTopping = get_field('note_topping',$data_id);
      $note = get_field('note',$data_id);
    }
  }
?>