<?php
/* List Block */
if(!class_exists('ST_Chart_Block')) {
class ST_Chart_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-bar-chart-o"></i> Skill Bars',
		'size' => 'col-md-6',
	);
	
	//create the widget
	parent::__construct('st_chart_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_skillbar_add_new', array($this, 'add_skillbar_item'));
	
	}
	
	function form($instance) {
	
		$defaults = array(
			'title' => 'Title Skill Bars',
			'items' => array(
				1 => array(
					'title' => 'New Skill',
                    'percent' => 5,          
				)
			),
			'animated'=>0,
			'clear'=>0
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
		<a href="#" rel="skillbar" class="aq-sortable-add-new button">Add New</a>
		<p></p>
	</div>
	
	<p class="description">
		<label for="<?php echo $this->get_field_id('animated') ?>">
			Animated<br/>
			<?php echo aq_field_checkbox('animated', $block_id, $animated) ?>
		</label>
	</p>	
	
	<p class="description">
		<label for="<?php echo $this->get_field_id('clear') ?>">
			Clear<br/>
			<?php echo aq_field_checkbox('clear', $block_id, $clear) ?>
		</label>
	</p>			
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
		<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-percent">
			Percent<br/>
			<input type="number" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-percent" class="input-min" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][percent]" value="<?php echo $item['percent'] ?>" />
		</label>
	</div>
	
	<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
	</div>
	</li>
    
	<?php
	}
	
	function block($instance) {
	extract($instance);
?>
<div class="col-lg-6">
	<div class="title"><h2><?php echo esc_attr($title) ?></h2></div>
	<div class="about_skills">
		<?php $i = 1;foreach( $items as $item ): ?>
		<div class="progress progress-striped <?php echo $animated==1?'active':'' ?>">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo strip_tags($item['percent']) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo strip_tags($item['percent']) ?>%"></div>
		</div>
		<?php $i++;;endforeach ?>
	</div><!-- about_skills -->
</div>
<?php if($clear==1){ ?>
<div class="clearfix"></div>
<hr />
<?php
	}
	}
	
	/* AJAX add testimonial */
	function add_skillbar_item() {
	$nonce = $_POST['security'];	
	if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
	
	$count = isset($_POST['count']) ? absint($_POST['count']) : false;
	$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
	
	//default key/value for the testimonial
	$item = array(
		'title' => 'New Skill',
        'percent' => 5,
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
}?>
