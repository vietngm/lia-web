<div class="postbox">
  <h3 class="box-header"><span>Environments</span></h3>
  <div class="inside">
    <input type="hidden" name="endpoint" value="" />
    <input type="hidden" name="environment" value="" />
    <?php $post_id = check_pages_existed(); ?>
    <select id="op_env" name="op_env">
      <option value="">Select a environment</option>
      <?php
			if($post_id && $post_id!=""){
				$envs = get_field('environments',$post_id);
				if($envs){
					foreach($envs as $item=>$env){
						echo '<option value='.$env['value'].'>'.$env['name'].'</option>';
					}
				}
			}
			?>
    </select>
  </div>
</div>