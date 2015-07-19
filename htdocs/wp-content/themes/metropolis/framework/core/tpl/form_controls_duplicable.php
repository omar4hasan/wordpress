<input type="hidden" name="field_type" value="<?php echo $field_type; ?>">
<input type="hidden" name="action" value="thb_duplicable_save" />
<input type="hidden" name="thb_noncename" id="thb_noncename" value="<?php echo wp_create_nonce('thb_duplicable_options'); ?>" />

<div class="hb-apply <?php if(isset($position)) echo $position; ?>">	
	<div class="hb-add">
		<input type="button" class="add-btn" value="+" data-status="" data-template="<?php if(isset($template)) echo $template; ?>" />
	</div>
	<div class="hb-save">
		<input type="submit" name="save" class="button-primary <?php echo $submit_class; ?>" value="<?php if(isset($save)) echo $save; ?>" data-saving-text="<?php echo $saving; ?>" />
	</div>
</div>