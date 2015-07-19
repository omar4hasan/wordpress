<div class="heading_wrapper">
	<h3><?php if(isset($name)) echo $name; ?></h3>
	<?php if(isset($desc) && !empty($desc)) : ?>
	<div class="heading-desc">
		<?php echo $desc; ?>
	</div>
	<?php endif; ?>
</div>