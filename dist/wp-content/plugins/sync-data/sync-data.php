<?php
/**
 * Plugin Name: Sync Data
 * Plugin URI: http://trangbeautycenter.com/
 * Description: Quan ly & Dong bo du lieu
 * Version: 1.0.0
 * Author: LiA Team
 * Author URI: http://trangbeautycenter.com
 */

defined('ABSPATH') || exit;
define('SYNC_DATA_VERSION', '1.0.0');
define('SYNC_DATA_DIR', plugin_dir_path(__FILE__));
define('SYNC_DATA_URL', plugin_dir_url(__FILE__));

include(SYNC_DATA_DIR . 'functions.php');
include(SYNC_DATA_DIR . 'ui.php');
add_action('admin_menu', 'sync_data_add_pages');
function sync_data_add_pages() {
    add_options_page(
        __('Sync Data','menu-sync-data'),
        __('Sync Data','menu-sync-data'),
        'manage_options',
        'sync-data',
        'sync_data_settings_page'
    );
}

// Tải CSS/JS và truyền AJAX_URL vào JS
add_action('admin_enqueue_scripts', 'sync_data_enqueue_assets');

function sync_data_enqueue_assets($hook){
	// if ($hook !== 'settings_page_sync-data') return;
	wp_register_style('sync-data', SYNC_DATA_URL . 'css/plugin.css', array(), SYNC_DATA_VERSION );
	wp_enqueue_style('sync-data');	

	wp_register_script('sync-data', SYNC_DATA_URL . 'js/sync-data.js', array('jquery'), SYNC_DATA_VERSION, true);
	wp_enqueue_script('sync-data');

	wp_localize_script('sync-data', 'syncDataVars', [ 
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('sync_data_nonce')
	]);

	wp_register_script('modal', SYNC_DATA_URL . 'js/jquery.fancybox.js', array(), SYNC_DATA_VERSION);
	wp_enqueue_script('modal');

	wp_register_style('modal-style', SYNC_DATA_URL . 'css/jquery.fancybox.css', array(), SYNC_DATA_VERSION);
	wp_enqueue_style('modal-style');
}

?>