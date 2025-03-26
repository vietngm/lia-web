<?php
/**
 * Plugin Name: Sync Data
 * Plugin URI: http://trangbeautycenter.com/
 * Description: Quan ly & Dong bo du lieu
 * Version: 1.0.0
 * Author: LiA Team
 * Author URI: http://trangbeautycenter.com
 */
include(dirname( __FILE__ ).DIRECTORY_SEPARATOR.'functions.php');
include(dirname( __FILE__ ).DIRECTORY_SEPARATOR.'ui.php');

function sync_data_styles(){
	global $ASSETS_VERSION;
	wp_register_style('sync-data', plugins_url('css/common.css', __FILE__), array(), $ASSETS_VERSION );
	wp_enqueue_style('sync-data');	

	wp_register_script('sync-data', plugins_url('js/sync-data.js', __FILE__), array(), $ASSETS_VERSION);
	wp_enqueue_script('sync-data');

  wp_register_script('modal', plugins_url('js/jquery.fancybox.js', __FILE__), array(), $ASSETS_VERSION);
	wp_enqueue_script('modal');
	wp_register_style('modal-style', plugins_url('css/jquery.fancybox.css', __FILE__), array(), $ASSETS_VERSION);
	wp_enqueue_style('modal-style');
}

add_action('admin_head', 'sync_data_styles');
?>