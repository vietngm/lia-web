<?php 
function sync_data_settings_page() {
	$token = get_option('token') ?? '';
	$refreshToken = get_option('refreshToken') ?? '';
	echo $token !='' ? '<input type="hidden" name="token" value="'.$token.'" />':'';
	echo $refreshToken !='' ? '<input type="hidden" name="refreshToken" value="'.$refreshToken.'" />':'';
	if (!current_user_can('manage_options')){
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
?>
<div id="login-status" class="login-status<?php echo ($token=='') ? ' error':' updated' ?>">
  <p>
    <strong><?php _e($token=='' ? 'Vui lòng đăng nhập.':'Đăng nhập thành công.', 'menu-sync-data' ); ?></strong>
  </p>
  <?php echo ($token=='') ? '':'<form name="form-sync-data" method="post" action=""><input type="submit" name="logout" id="logout" class="logout" value="Log Out" /></form>' ?>
</div>
<?php
echo '<div class="wrap">';
echo "<h2>" . __( 'Sync data', 'menu-sync-data' ) . "</h2>";
?>
<div id="poststuff">
  <div id="post-body" class="metabox-holder">
    <?php
			include('inc/environment.php');
			if($token==''){ include('templates/auth.php');}
			if($token!=''){include('templates/actions.php');}		
			include('templates/modal.php');
			?>
  </div>
</div>
<?php 
}
?>