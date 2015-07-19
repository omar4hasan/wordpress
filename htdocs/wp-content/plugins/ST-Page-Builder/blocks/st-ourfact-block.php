<?php 
class ST_Ourfacts_Block extends AQ_Block{
    function __construct(){
        $block_option=array(
            'name' => '<i class="fa fa-indent"></i> Our Facts',
            'size' => 'col-md-12',
        );
        parent::__construct('st_ourfacts_block', $block_option);
        add_action('wp_ajax_aq_block_ourfacts_add_new', array($this, 'add_ourfacts_item'));
    }
	
    function form($instance){
        $defaults =array(
	        'title' => 'Title',
	        'items'=> array(
	            1=>array(
		            'title' => 'New fact',
		            'number' => ''
	            )
	        ),
			'image'=>'',
			'columm' => '2'
        );        
		
        $instance=wp_parse_args($instance,$defaults);
        extract($instance);
		
		$columm_options = array(
			'2' => '6 Columm',
			'3' => '4 Columm',
			'4' => '3 Columm',
			'6' => '2 Columm',
		);
    ?>    
    <div class="descriptions">
        <label for="<?php echo $this->get_field_id('title') ?>">
	    	Title:
	    	<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
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
	    	<a href="#" rel="ourfacts" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>
    <div class="description">
		<label for="<?php echo $this->get_field_id('columm') ?>">
			Selected Columm / Row <code>Default: 6 Columm / Row</code><br/>
			<?php echo aq_field_select('columm', $block_id, $columm_options, $columm) ?>
		</label>
	</div>
    <?php }
    
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
			    	Enter Title<br/>
			    	<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
		    	</label>
		    </div>
			
		    <div class="tab-desc description">
		        <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-number">
		            Enter Number<br/>
		            <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-number" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][number]" value="<?php echo $item['number'] ?>" />
		        </label>
		    </div>
	    <p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
	    </div>
	</li>
    <?php
    }
    
    function block($instance){
        extract($instance);
		$output = array();
		
		$output[] = '<section id="two-parallax" class="parallax" style="background-image: url(\''.$image.'\');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">';
			$output[] = '<div class="overlay">';
				$output[] = '<div class="container">';
					$output[] = '<div class="general-title text-center wow fadeInDown">';
						$output[] = '<h1>'.htmlspecialchars_decode($title).'</h1>';
					$output[] = '</div>';															
					$output[] = '<div class="stat f-container">';					
						if(!empty($items)){
							foreach($items as $item){									
								$output[] = '<div class="f-element col-lg-'.esc_attr($columm).' col-md-'.esc_attr($columm).' col-sm-6 col-xs-12 facts">';								
									$output[] = '<div class="milestone-counter">';							
										$output[] = '<span class="stat-count highlight">'.htmlspecialchars_decode($item['number']).'</span>';
										$output[] = '<div class="milestone-details">'.htmlspecialchars_decode($item['title']).'</div>';
									$output[] = '</div>';									
								$output[] = '</div>';						
						   }
						}												
					$output[] = '</div>';					
				$output[] = '</div>';				
			$output[] = '</div>';
		$output[] = '</section>';
		
		echo implode("\n",$output);	
	}
    function add_ourfacts_item() {
	    $nonce = $_POST['security'];	
	    if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
	    
	    $count = isset($_POST['count']) ? absint($_POST['count']) : false;
	    $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
	    
	    //default key/value for the testimonial
	    $item = array(
		    'title' => 'New Process',
		    'number' => ''
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
