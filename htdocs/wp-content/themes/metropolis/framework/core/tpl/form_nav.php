<div class="hb-nav">
	<ul>
		<?php
			$i=1;
			foreach($sections as $key => $value) :
			$section_slug = thb_make_slug($key);

			$class = ($tabindex == $i) ? 'active' : '';
		?>
		<li class="<?php echo $class; ?>">
			<a href="#section-<?php echo $i; ?>"><img src="<?php echo $pageimage.$section_slug.$pageimage_ext; ?>" alt="" /><?php echo $key; ?></a>
			<span></span>
		</li>
		<?php $i++; endforeach; ?>
	</ul>
</div>