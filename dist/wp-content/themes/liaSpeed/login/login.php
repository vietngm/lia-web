<?php
function custom_login_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login/login-styles.css" />';
}
add_action('login_head', 'custom_login_css');
//--------------------------------------------------------------------------
function add_site_favicon() {
    echo '<link rel="shortcut icon" href="'.get_site_url().'/assets/images/share/meta/favicon.png" type="image/x-icon" />';
}

add_action('login_head', 'add_site_favicon');
add_action('admin_head', 'add_site_favicon');

function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

?>