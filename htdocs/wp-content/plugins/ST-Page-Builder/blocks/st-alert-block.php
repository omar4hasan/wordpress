<?php
/** Notifications block **/

if(!class_exists('ST_Alert_Block')) {
	class ST_Alert_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => '<i class="fa fa-tasks"></i> Alerts',
				'size' => 'col-md-6',
			);
			
			//create the block
			parent::__construct('st_alert_block', $block_options);
			add_action('wp_ajax_aq_block_alert_add_new', array($this, 'add_alert_item'));
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => 'Alerts',
				'items'=> array(
					1=>array(
						'alert'=>'alert-info',
						'content' => '',
						'close'=>0
					)
				)
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="descriptions">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title:
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
					<a href="#" rel="alert" class="aq-sortable-add-new button">Add New alert</a>
				<p></p>
			</div>	
			<?php
		}
		
		function item($item = array(), $count = 0) {
			$type_options = array(
				'alert-info' => 'Info',
				'alert-danger' => 'Danger',
				'alert-warning' => 'Warning',
				'alert-success' => 'Success',
				'alert-dismissable'=>'Dismissable'
			);
		?>
		<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
			<div class="sortable-head cf">
				<div class="sortable-title">
					<strong><?php echo $type_options[$item['alert']] ?></strong>
				</div>
				<div class="sortable-handle">
					<a href="#">Open / Close</a>
				</div>
			</div>	
		
			<div class="sortable-body">
				<div class="description">
					<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-alert">
						Alert Type<br/>
						<select id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-alert" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][alert]">';
						<?php foreach($type_options as $key=>$value) {?>
							<option value="<?php echo $key ?>" <?php selected( $item['alert'], $key, true )?>><?php echo htmlspecialchars($value) ?></option>
						<?php }?>
						</select>							
					</label>
				</div>
				<div class="description">
					<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
						Content<br/>
						<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
					</label>
				</div>				
				<div class="description">
					<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-close">
						<br/><br/>
						<input type="checkbox" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-close" class="" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][close]" value="1" <?php checked(1, $item['close'] ); ?> />
						Button close
					</label>					
				</div>	
				<div class="cf"></div>				
			<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
			</div>
		</li>
		<?php
		}			
		
		function block($instance) {
			extract($instance);
			$type_options = array(
				'alert-info' => 'Info',
				'alert-danger' => 'Danger',
				'alert-warning' => 'Warning',
				'alert-success' => 'Success',
				'alert-dismissable'=>'Dismissable'
			);			
?>
		<div class="col-lg-6">
			<div class="title"><h2><?php echo esc_attr($title) ?></h2></div>
				<?php foreach($items as $item): ?>
				<div class="alert <?php echo $item['alert'] ?>">
					<?php if($item['close']==1): ?>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php endif ?>				
					<?php echo htmlspecialchars_decode($item['content']) ?>
				</div>
				<?php endforeach ?>
		</div>
<?php
			
		}
		
		function add_alert_item() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the testimonial
			$item = array(
				'alert'=>'Info',
				'content' => '',
				'close'=>0
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