<?php
/* List Block */
if(!class_exists('ST_Partner_Block')) {
class ST_Partner_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-picture-o"></i> Clients image',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_partner_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_partner_add_new', array($this, 'add_partner_item'));
	
	}
	
	function form($instance) {
	
		$defaults = array(
			'title' => 'Title Clients',
			'items' => array(
				1 => array(
					'title' => 'New Images',
					'photo' => '', 
					'link' => ''                   
				)
			)
		);
	
	$instance = wp_parse_args($instance, $defaults);
	extract($instance);
	
	?>
	<div class="description">
        <label for="<?php echo $this->get_field_id('title') ?>">
	        Title Partner
	        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
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
			<a href="#" rel="partner" class="aq-sortable-add-new button">Add New</a>
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
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo">
					Photo <em style="font-size: 0.8em;">(Recommended size: 200 x 200 pixel)</em><br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo" class="input-full input-upload" value="<?php echo $item['photo'] ?>" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][photo]">
					<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
				</label>
			</div>
			<div class="tab-desc description">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link">
					Link to Website Client<br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][link]" value="<?php echo $item['link'] ?>" />
				</label>
			</div>
		
		<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
		</div>
	</li>
	<?php
	}
	
	function block($instance) {
	extract($instance);
	$title1 = (!empty($title) ? ' '.esc_attr($title) : '');  
	$gettext1 = (!empty($gettext) ? ' '.esc_attr($gettext) : '');  
    $getlink1 = (!empty($getlink) ? ' '.esc_attr($getlink) : ''); 
	
	$output = '';
	
	$output .= '<div class="container">
		<div class="clients text-center">';
			if(!empty($items)){
				$i=0;
                foreach($items as $item){
					$output.='<div class="col-lg-3 '.($i%4==0?'first':'').'">';
					$output.=(!empty($item['link']) ? '<a href="'.strip_tags($item['link']).'">' : '').'<img src="'.esc_url($item['photo']).'" alt=""  class="img-responsive"/>'.(!empty($item['link']) ? '</a>' : '');   
					$output.='</div>';
					$i++;
				}
            }	
		$output.='
		</div>
	</div>';

	echo $output;

	 }

	/* AJAX add testimonial */
	function add_partner_item() {
	$nonce = $_POST['security'];	
	if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
	
	$count = isset($_POST['count']) ? absint($_POST['count']) : false;
	$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
	
	//default key/value for the testimonial
	$item = array(
		'title' => 'New Images',
		'photo' => '',
		'link' => '' 
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