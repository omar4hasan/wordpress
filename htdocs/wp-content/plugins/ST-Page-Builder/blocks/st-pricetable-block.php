<?php
/* List Block */
if(!class_exists('ST_Price_Table_Block')) {
class ST_Price_Table_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-dollar"></i> Price Table',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_price_table_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_pricetable_add_new', array($this, 'add_pricetable_item'));
	
	}
	
	function form($instance) {
	
		$defaults = array(
			'title' => 'price',
			'aftertitle' =>'',           
			'items' => array(
				1 => array(
					'title' => 'New Pricing Table',
					'email' => 5,
					'bonus' => 5,
					'support' => 2,
					'subdomains' => 10,		
					'hosting' => 1,
					'cost' => '$19/Month',
					'link' => '#',
					'text_link' => 'PURCHASE',
					'text_link_hover' => 'ORDER NOW'	
				)
			),		
            'columm' => '3'
		);
     
	$instance = wp_parse_args($instance, $defaults);
	extract($instance);
	
		$column_options = array(
            '6' => '2 Column',
            '4' => '3 Column',
            '3' => '4 Column',
            '2' => '6 Column',
        );
 	?>
	
	 <div class="description">
        <label for="<?php echo $this->get_field_id('title') ?>">
        Title
        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
        </label>
    </div>
	
	<div class="description">
        <label for="<?php echo $this->get_field_id('subtitle') ?>">
        After title
        <?php echo aq_field_input('aftertitle', $block_id, $aftertitle, $size = 'full') ?>
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
			<a href="#" rel="pricetable" class="aq-sortable-add-new button">Add New</a>
		<p></p>
	</div>

    <div class="description half">
		<label for="<?php echo $this->get_field_id('columm') ?>">
			Column Per Row <code>default: 4 Columm.</code><br/>
			<?php echo aq_field_select('columm', $block_id, $column_options, $columm, $block_id, $size = 'full') ?>
		</label>
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
			<div class="tab-desc description third">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-email">
					 Number Email <br/>
					<input type="number" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-email" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][email]" value="<?php echo $item['email'] ?>" />
				</label>
			</div>			
			<div class="tab-desc description third">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-bonus">
					Bonus Points Every Month<br/>
					<input type="number" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-bonus" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][bonus]" value="<?php echo $item['bonus'] ?>" />
				</label>
			</div>
			
			<div class="tab-desc description third last">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-support">
					Support <br/>
					<input type="number" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-support" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][support]" value="<?php echo $item['support'] ?>" />
				</label>
			</div>
			<div class="tab-desc description third">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-subdomains">
					Subdomains <br/>
					<input type="number" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-subdomains" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][subdomains]" value="<?php echo $item['subdomains'] ?>" />
				</label>
			</div>
			<div class="tab-desc description third">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-hosting">
					Hosting <br/>
					<input type="number" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-hosting" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][hosting]" value="<?php echo $item['hosting'] ?>" />
				</label>
			</div>			
			<div class="tab-desc description third last">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-cost">
					Cost/date <br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-cost" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][cost]" value="<?php echo $item['cost'] ?>" />
				</label>
			</div>
			
			<div class="cf"></div>	
			<h3 style="text-align: center;">PURCHASE</h3>				
			<div class="tab-desc description third">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link">
					Link <br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][link]" value="<?php echo $item['link'] ?>" />
				</label>
			</div>
			<div class="tab-desc description third">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-text_link">
					Text Link <br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-text_link" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][text_link]" value="<?php echo $item['text_link'] ?>" />
				</label>
			</div>			
			<div class="tab-desc description third last">
				<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-text_link_hover">
					Text Link Hover <br/>
					<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-text_link_hover" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][text_link_hover]" value="<?php echo $item['text_link_hover'] ?>" />
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
	
	$output[] = '<div class="container">';
		if(!empty($aftertitle)){
			$output[] = '<div class="general-title text-center wow fadeInDown">';
		}else{
			$output[] = '<div class="title">';
		}
			$output[] = '<h1>'.esc_attr($title).'</h1>';	
			if(!empty($aftertitle)){
				$output[] = htmlspecialchars_decode($aftertitle);	
			}
		$output[] = '</div>';	
		
		$output[] = '<div class="pricing_boxes">';
		if(!empty($items)){
			$i=0;
			foreach($items as $item){
				$output[] = '<div class="col-lg-'.$columm.' col-md-'.$columm.' col-sm-6 col-xs-12 '.($i%4==0?'first':'').'">';
					$output[] = '<div class="pricing_detail '.(!empty($aftertitle)?'wow wobble':'').'wow wobble">';
						if(!empty($item['cost'])){
							$output[] = '<span class="priceamount">'.str_replace('/','<br />',$item['cost']).'</span>';
						}
						if(!empty($item['title'])){
							$output[] = '<header><h3>'.esc_attr($item['title']).'</h3></header>';
						}
						$output[] = '<div class="pricing_info">';
							$output[] = '<ul>';
								if(!empty($item['email'])){
									$output[] = '<li>'.esc_attr($item['email']).' Email Account</li>';
								}
								if(!empty($item['bonus'])){
									$output[] = '<li>'.esc_attr($item['bonus']).' Bonus Points Every Month</li>';
								}
								if(!empty($item['support'])){
									$output[] = '<li>'.esc_attr($item['support']).' Months Support</li>';
								}	
								if(!empty($item['subdomains'])){
									$output[] = '<li>'.esc_attr($item['subdomains']).' Subdomains</li>';
								}	
								if(!empty($item['hosting'])){
									$output[] = '<li>'.esc_attr($item['hosting']).' Hosting</li>';
								}									
							$output[] = '</ul>';		

							$output[] = '<footer>';	
								$output[] = '<div class="jtbutton">';	
									$output[] = '<a href="'.$item['link'].'" title=""><span data-hover="'.$item['text_link_hover'].'">'.$item['text_link'].'</span></a>';
								$output[] = '</div>';
							$output[] = '</footer>';
						$output[] = '</div>';
					$output[] = '</div>';
				$output[] = '</div>';
				$i=1;
			}
		}
		$output[] = '</div>';
	$output[] = '</div>';
			
	echo implode("\n",$output);
	
 	}
	/* AJAX add testimonial */
	function add_pricetable_item() {
	$nonce = $_POST['security'];	
	if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
	
	$count = isset($_POST['count']) ? absint($_POST['count']) : false;
	$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
	
	//default key/value for the testimonial
	$item = array(
		'title' => 'New Pricing Table',
		'email' => 5,
		'bonus' => 5,
		'support' => 2,
		'subdomains' => 10,		
		'hosting' => 1,
		'cost' => '$19/Month',
		'link' => '#',
		'text_link' => 'PURCHASE',
		'text_link_hover' => 'ORDER NOW'	
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
