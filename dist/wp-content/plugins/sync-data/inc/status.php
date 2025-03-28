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
  <li data-rel="<?php echo $post_id ?>" class="sync-status-item">
    <?php  echo $status ? $htmlSuccess:$htmlFaile; ?>
  </li>
</ul>
<?php
  }
}
add_filter( 'manage_booking_posts_columns', 'my_edit_booking_columns' ) ;
add_action( 'manage_booking_posts_custom_column', 'my_manage_booking_columns', 10, 2 );
?>