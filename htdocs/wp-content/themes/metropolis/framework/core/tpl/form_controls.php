<input type="hidden" name="action" value="thb_framework_save" />
<input type="hidden" name="thb_noncename" id="thb_noncename" value="<?php echo wp_create_nonce('thb_framework_options'); ?>" />

<div class="hb-apply">	
	<div class="hb-save">
		<input class="ajax_save" type="submit" name="save" value="<?php if(isset($save)) echo $save; ?>" data-saving-text="<?php echo $saving; ?>" />
	</div>
</div>