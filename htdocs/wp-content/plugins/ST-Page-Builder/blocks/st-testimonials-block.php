<?php
/* List Block */
if(!class_exists('ST_Testimonials_Block')) {
class ST_Testimonials_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-thumbs-o-up"></i> Testimonial',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_testimonials_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_test_add_new', array($this, 'add_test_item'));
	
	}
	
	function form($instance) {
	
		$defaults = array(
			'title' => 'Our happy clients',
			'id' => '',
			'class' => 'parallax',
			'items' => array(
				1 => array(
					'title' => 'New Testimonial',
					'content' => '',
					'icon_title' => '',
					'link_title' => '#'
				)
			),
			'icon'=>'',
			'image'=>''
		);
	
	$instance = wp_parse_args($instance, $defaults);
	extract($instance);
	
	?>
	
	<div class="description">
		<label for="<?php echo $this->get_field_id('title') ?>">
			Title
			<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
		</label>
	</div>
	
	<div class="description third">
		<label for="<?php echo $this->get_field_id('id') ?>">
			ID section
			<?php echo aq_field_input('id', $block_id, $id, $size = 'full') ?>
		</label>
	</div>

	<div class="description third">
		<label for="<?php echo $this->get_field_id('class') ?>">
			Class section
			<?php echo aq_field_input('class', $block_id, $class, $size = 'full') ?>
		</label>
	</div>	
	
	<div class="description third last">
		<label for="<?php echo $this->get_field_id('icon') ?>">
			Icon
			<?php echo aq_field_input('icon', $block_id, $icon, $size = 'full') ?>
		</label>
	</div>	
	
	<div class="descriptions">
		<label for="<?php echo $this->get_field_id('image') ?>">
			Image:
			<?php echo aq_field_upload('image', $block_id, $image) ?>
		</label>
	</div>	
	
	<div class="cf"></div>
	
	<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
	<?php
		$items = is_array($items) ? $items : $defaults['items'];
		$count = 1;
		foreach($items as $item) {	
			$this->item($item, $count);
			$count++;
		}
	?>
	</ul>
		<p></p>
		<a href="#" rel="test" class="aq-sortable-add-new button">Add New</a>
		<p></p>
	</div>

	<?php
	}
	
	function item($item = array(), $count = 0) {
	
	?>
	<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
		<div class="sortable-head cf">
			<div class="sortable-title">
				<strong><?php echo $item['title'] ?></strong>
			</div>
			<div class="sortable-handle">
				<a href="#">Open / Close</a>
			</div>
		</div>
		<div class="sortable-body">
			<div class="tab-desc description">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
					Name<br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
				</label>
			</div>
			
			<div class="tab-desc description">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
					Testimonial<br/>
					<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
				</label>
			</div>
			
			<div class="tab-desc description">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon_title">
					Icon<br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon_title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][icon_title]" value="<?php echo $item['icon_title'] ?>" />
				</label>
			</div>

			<div class="tab-desc description">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link_title">
					Link<br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link_title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][link_title]" value="<?php echo $item['link_title'] ?>" />
				</label>
			</div>			
		
		<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
		</div>
	</li>
	<?php
	}
	
	function block($instance) {
	extract($instance);
	
	$output = array();
	
	$output[] = '<section id="'.esc_attr($id).'" class="'.esc_attr($class).'" style="background-image: url(\''.$image.'\');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">';
		$output[] = '<div class="overlay">';
			$output[] = '<div class="container">';
				$output[] = '<div class="general-title text-center wow fadeInDown">';
					$output[] = '<h1>'.htmlspecialchars_decode($title).'</h1>';
					$output[] = '<div class="custom-icon '.esc_attr($icon).'-icon"><i class="fa fa-'.esc_attr($icon).'"></i></div>';
				$output[] = '</div>';		
				
				$output[] = '<div class="testimonial-widget">';
					$output[] = '<div id="owl-'.($icon=='quote-right'?'testimonial':esc_attr($icon)).'" class="owl-carousel text-center">';
					
						if (!empty($items)) {	
							foreach( $items as $item ) {	
								$output[] = '<div class="testimonial">';									
									$output[] = '<p class="lead">'.htmlspecialchars_decode($item['content']).'</p>';													
									if(!empty($item['link_title'])){
										$output[] = '<a href="'.$item['link_title'].'">';
											if(!empty($item['link_title'])){
												$output[] = '<h3>';
													$output[] = '<i class="fa fa-'.esc_attr($item['icon_title']).'"></i> ';
													$output[] = htmlspecialchars_decode($item['title']);
												$output[] = '</h3>';
											}else{
												$output[] = '<h3>'.htmlspecialchars_decode($item['title']).'</h3>';
											}
										$output[] = '</a>';
									}else{
										if(!empty($item['link_title'])){
											$output[] = '<h3>';
												$output[] = '<i class="fa fa-'.esc_attr($item['icon_title']).'"></i> ';
												$output[] = htmlspecialchars_decode($item['title']);
											$output[] = '</h3>';
										}else{
											$output[] = '<h3>'.htmlspecialchars_decode($item['title']).'</h3>';
										}
									}									
								$output[] = '</div>';
							}
						}
					$output[] = '</div>';					
				$output[] = '</div>';					
			$output[] = '</div>';				
		$output[] = '</div>';
	$output[] = '</section>';
	
	echo implode("\n",$output);	
	
	}
	
	/* AJAX add testimonial */
	function add_test_item() {
	$nonce = $_POST['security'];	
	if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
	
	$count = isset($_POST['count']) ? absint($_POST['count']) : false;
	$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
	
	//default key/value for the testimonial
	$item = array(
		'title' => 'New Testimonial',
		'content' => '',
		'icon_title' => '',
		'link_title' => '#'		
	);
	
	if($count) {
		$this->item($item, $count);
	} else {
		die(-1);
	}
	
	die();
	}
	
	function update($new_instance, $old_instance) {
		$new_instance = aq_recursive_sanitize($new_instance);
		return $new_instance;
	}
}
}