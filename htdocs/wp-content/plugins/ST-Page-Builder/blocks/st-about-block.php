<?php
/* List Block */
if(!class_exists('ST_About_Block')) {
class ST_About_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-user-md"></i> About',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_about_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_check_add_new', array($this, 'add_check_item'));
	add_action('wp_ajax_aq_block_check_skill_add_new', array($this, 'add_check_skill_item'));
	add_action('wp_ajax_aq_block_check_icon_add_new', array($this, 'add_check_icon_item'));
	}
	
   function form($instance){
        $defaults = array(
            'title' => '', 
			'subtitle' =>'',          
			'aftertitle' =>'', 
            'items' => array(
	            1 => array(
		            'title' => 'New About items',
		            'icon' => 'files-o',
		            'content' => 'New content about',
					'linkitem' => '#'
	            )
            ),
            'skills' => array(
	            1 => array(
					'item_id' => '',
		            'name' => 'New Skill name',
		            'complete' => '70'
	            )
            ),
            'icons' => array(
	            1 => array(
					'item_id' => '',
		            'name' => 'New icon',
		            'icon' => 'lightbulb-o',
					'link' => '#'
	            )
            ),				
			'columm' => '2'
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
		
		$columm_options = array (
			'6' => 'columm 2',
			'4' => 'columm 3',
			'3' => 'columm 4',
			'2' => 'columm 6'
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
        Subtitle
        <?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
        </label>
    </div>
	
	<div class="description">
        <label for="<?php echo $this->get_field_id('aftertitle') ?>">
        Content after title
        <?php echo aq_field_input('aftertitle', $block_id, $aftertitle, $size = 'full') ?>
        </label>				
	</div>
	<div class="cf"></div>

	<h3 style="text-align: center;">ABOUT ITEMS</h3>
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
	    	<a href="#" rel="check" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>
	
	<h3 style="text-align: center;">ABOUT SKILLS</h3>
    <div class="description cf">
	    <ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
		    <?php
			    $skills = is_array($skills) ? $skills : $defaults['skills'];
			    $count = 1;
			    foreach($skills as $skill) {	
				    $this->skill($skill, $count);
				    $count++;
			    }
		    ?>
	    </ul>
	    <p></p>
	    	<a href="#" rel="check_skill" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>
	
	<h3 style="text-align: center;">ABOUT ICONS</h3>
    <div class="description cf">
	    <ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
		    <?php
			    $icons = is_array($icons) ? $icons : $defaults['icons'];
			    $count = 1;
			    foreach($icons as $icon) {	
				    $this->icon($icon, $count);
				    $count++;
			    }
		    ?>
	    </ul>
	    <p></p>
	    	<a href="#" rel="check_icon" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>	
	
	<div class="description third">
		<label for="<?php echo $this->get_field_id('columm') ?>">
			Selected Columm / Row<br/>
			<?php echo aq_field_select('columm', $block_id, $columm_options, $columm) ?>
		</label>
	</div>
    <div class="cf"></div>
<?php
}

function icon($icon = array(), $count = 0) {
?>
	<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
		<div class="sortable-head cf">
			<div class="sortable-title">
				<strong><?php echo $icon['name'] ?> - <span style="color:blue">Width about item ID: <?php echo $icon['item_id'] ?></span></strong>
			</div>
			<div class="sortable-handle">
				<a href="#">Open / Close</a>
			</div>
		</div>
		<div class="sortable-body">
			<div class="description third">
				<label for="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-item_id">
				About Item ID<br/><br/>
				<input type="text" id="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-item_id" class="input-full" name="<?php echo $this->get_field_name('icons') ?>[<?php echo $count ?>][item_id]" value="<?php echo $icon['item_id'] ?>" />
				</label>
			</div>		
		
			<div class="description third">
				<label for="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-name">
					Icon name<br/><br/>
					<input type="text" id="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('icons') ?>[<?php echo $count ?>][name]" value="<?php echo $icon['name'] ?>" />
				</label>
			</div>
			
			<div class="description third last">
				<label for="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-icon">
					Icon <code>Ex: lightbulb-o</code><a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/"> view more icon </a><br/>
					<input type="text" id="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('icons') ?>[<?php echo $count ?>][icon]" value="<?php echo $icon['icon'] ?>"/> 					
				</label>
			</div>

			<div class="tab-desc description">
				<label for="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-link">
					Icon link<br/><em style="font-size: 0.8em;">(Default: #)</em><br/>
					<input type="text" id="<?php echo $this->get_field_id('icons') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('icons') ?>[<?php echo $count ?>][link]" value="<?php echo $icon['link'] ?>" />
				</label>
			</div>			
			
			<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
		</div>
	</li>

  <?php
}

function skill($skill = array(), $count = 0) {
?>
	<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
		<div class="sortable-head cf">
			<div class="sortable-title">
				<strong><?php echo $skill['name'] ?> - <span style="color:blue">Width about item ID: <?php echo $skill['item_id'] ?></span></strong>
			</div>
			<div class="sortable-handle">
				<a href="#">Open / Close</a>
			</div>
		</div>
		<div class="sortable-body">
			<div class="description third">
				<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-item_id">
				About Item ID<br/>
				<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-item_id" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][item_id]" value="<?php echo $skill['item_id'] ?>" />
				</label>
			</div>		
		
			<div class="description third">
				<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-name">
				Skill name<br/>
				<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][name]" value="<?php echo $skill['name'] ?>" />
				</label>
			</div>
			
			<div class="description third last">
				<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-complete">
					Completed Percent (%)<br/>
					<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-complete" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][complete]" value="<?php echo $skill['complete'] ?>"/> 					
				</label>
			</div>

			<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
		</div>
	</li>

  <?php
}

function item($item = array(), $count = 0) {

?>
	<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
		<div class="sortable-head cf">
			<div class="sortable-title">
				<strong><?php echo $item['title'] ?> - <span style="color:red">About Item ID: <?php echo $count ?></span></strong>
			</div>
			<div class="sortable-handle">
				<a href="#">Open / Close</a>
			</div>
		</div>
	<div class="sortable-body">
	<div class="tab-desc description">
		<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
		Title<br/>
<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
	</label>
	</div>
	
	<div class="tab-desc description">
	<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon">
	Icon <code>Ex: lightbulb-o</code><a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/"> view more icon </a><br/>
	<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][icon]" value="<?php echo $item['icon'] ?>" />
	</label>
	</div>

	<div class="tab-desc description">
		<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
			Content item about<br/>
			<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
		</label>
	</div>
	
	<div class="tab-desc description">
	<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-linkitem">
	Link Item About <code>Ex: http://shinetheme.com/</code><br/>
	<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-linkitem" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][linkitem]" value="<?php echo $item['linkitem'] ?>" />
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
		 
		//$output[] = '<div class="container">';
			 $output[] = '<div class="general-title text-center wow fadeInDown">';
				 if(!empty($title)){
					$output[] = '<h1>'.esc_attr($title).'</h1>';
				 }		 
				 if(!empty($subtitle)){
					$output[] = '<p class="subtitle">'.esc_attr($subtitle).'</p>';
				 }		 		 
				 if(!empty($aftertitle)){
					$output[] = htmlspecialchars_decode($aftertitle);
				 }		 
			 $output[] = '</div>';
		 
		 
			$output[] = '<div class="row">'; 
				
				if (!empty($items)) {
					$item_id = 1;
					foreach( $items as $item ) {
						$output[] = '<div class="col-lg-'.esc_attr($columm).' col-md-'.esc_attr($columm).' col-sm-'.esc_attr($columm).' col-xs-12 about-block">';						
							$output[] = '<div class="widget wow bounceInUp">';	
								if(!empty($item['icon'])){
									$output[] = '<i class="fa fa-'.esc_attr($item['icon']).' fa-3x"></i>';
								}
								if(!empty($item['title'])){
									$output[] = '<div class="title"><h2>'.htmlspecialchars_decode($item['title']).'</h2></div>';
								}
								if(!empty($item['content'])){
									$output[] = htmlspecialchars_decode($item['content']);
								}
								/*SKILLS*/							
								$data_skill = array();
								if(count($skills)>0){
									foreach($skills as $skill){
										if($item_id==$skill['item_id']){
											$data_skill[] = '<small>'.esc_attr($skill['name']).'</small>';
											$data_skill[] = '<div class="progress">';
												$data_skill[] = '<div class="progress-bar" role="progressbar" aria-valuenow="'.esc_attr($skill['complete']).'" aria-valuemin="0" aria-valuemax="100" style="width: '.esc_attr($skill['complete']).'%;" data-toggle="tooltip" data-placement="right" title="'.esc_attr($skill['complete']).'%">';
													$data_skill[] = '<span class="sr-only">'.esc_attr($skill['complete']).'% Complete</span>';
												$data_skill[] = '</div>';
											$data_skill[] = '</div>';
										}
									}
								}
								if(count($data_skill)>0){
									$output[] = '<div id="skills" class="skills_bar">';
										$output[] = implode("\n",$data_skill);
									$output[] = '</div>';
								}
								
								/*ICONS*/							
								$data_icon = array();
								if(count($icons)>0){
									foreach($icons as $icon){
										if($item_id==$icon['item_id']){
											$data_icon[] = '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">';
												$data_icon[] = '<div class="service-icon">';
													$data_icon[] = '<div class="dm-icon-effect-1">';
														$data_icon[] = '<a href="'.esc_attr($icon['link']).'" class=""> <i class="hovicon effect-1 sub-a fa fa-'.esc_attr($icon['icon']).' fa-2x"></i> </a>';
													$data_icon[] = '</div>';
													$data_icon[] = '<div class="title"><h3>'.esc_attr($icon['name']).'</h3></div>';
												$data_icon[] = '</div>';
											$data_icon[] = '</div>';
										}
									}
								}
								if(count($data_icon)>0){
									$output[] = '<div class="about_icons text-center">';
										$output[] = implode("\n",$data_icon);
									$output[] = '</div>';
								}																						
							$output[] ='</div>';														
						$output[] ='</div>';	
						
						$item_id++;
					}   
				}		 
			 
				$output[] = '</div>';
			//$output[] = '</div>';
			
		  echo implode("\n",$output);
		    }
		/* AJAX add testimonial */
		function add_check_item() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the testimonial
		$item = array(
			'title' => 'New About items',
            'icon' => 'files-o',
            'content' => 'New content about',
			'linkitem' => '#'
		);
		
		if($count) {
			$this->item($item, $count);
		} else {
			die(-1);
		}
		
		die();
		}
		
		function add_check_skill_item() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the testimonial
			$skill = array(
				'item_id' => '',
				'name' => 'New Skill name',
				'complete' => '70'
			);
			
			if($count) {
				$this->skill($skill, $count);
			} else {
				die(-1);
			}
			
			die();
		}

		function add_check_icon_item() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the testimonial
			$icon = array(
				'item_id' => '',
				'name' => 'New icon',
				'icon' => 'lightbulb-o',
				'link' => '#'
			);
			
			if($count) {
				$this->icon($icon, $count);
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