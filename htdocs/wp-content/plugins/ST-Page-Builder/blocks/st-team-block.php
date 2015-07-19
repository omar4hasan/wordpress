<?php
/* ourteam Block */
if(!class_exists('ST_Team_Block')) {
class ST_Team_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-group"></i> Our Team',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_team_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_check4_add_new', array($this, 'add_check4_item'));

}
   function form($instance){
        $defaults = array(
			'title' => '', 
			'aftertitle' =>'', 
            'items' => array(
	            	1 => array(
			            'name' => 'New Team',
			            'job' => '',		            
			            'content' => '',
			            'photo' => '',
			            'facebook' => '',
			            'twitter' => '',
			            'googleplus' => '',
						'email' => ''
		            )
            	),
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
	
	<div class="description">
        <label for="<?php echo $this->get_field_id('aftertitle') ?>">
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
	    	<a href="#" rel="check4" class="aq-sortable-add-new button">Add New Team</a>
	    <p></p>
    </div>    
            
    <?php        }
    
    function item($item = array(), $count = 0) {
        ?>
     <li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
        <div class="sortable-head cf">
            <div class="sortable-title">
            	<strong><?php echo $item['name'] ?></strong>
            </div>
            <div class="sortable-handle">
            	<a href="#">Open / Close</a>
            </div>
        </div>
        <div class="sortable-body">
            <div class="tab-desc description half">
                <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-name">
                Name<br/><em style="font-size: 0.8em;">(Please enter name)</em><br/>
                <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][name]" value="<?php echo $item['name'] ?>" />
                </label>
            </div>
            <div class="tab-desc description half last">
                <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-job">
                Job<br/><em style="font-size: 0.8em;">(Please enter job)</em><br/>
                <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-job" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][job]" value="<?php echo $item['job'] ?>" />
                </label>
            </div>         
           	<div class="tab-desc description">
        		<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo">
        			Photo <em style="font-size: 0.8em;">(Recommended size: 50 x 50 pixel)</em><br/>
        			<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo" class="input-full input-upload" value="<?php echo $item['photo'] ?>" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][photo]">
        			<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
        		</label>
        	</div>
            <div class="tab-desc description">
                <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
                Content<br/><em style="font-size: 0.8em;">(Please enter content)</em><br/>
                <textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" ><?php echo $item['content'] ?></textarea>
                </label>
            </div>
     
            <div class="tab-desc description fourth">
                <label for="<?php echo $this->get_field_id('email') ?>-<?php echo $count ?>-email">
                Email<br/><em style="font-size: 0.8em;"></em><br/>
                <input type="text" id="<?php echo $this->get_field_id('email') ?>-<?php echo $count ?>-email" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][email]" value="<?php echo $item['email'] ?>" />
                </label>
            </div>	 
	 
            <div class="tab-desc description fourth">
                <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-facebook">
                Facebook<br/><em style="font-size: 0.8em;">(Example: https://www.facebook.com/user)</em><br/>
                <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-facebook" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][facebook]" value="<?php echo $item['facebook'] ?>" />
                </label>
            </div>
            <div class="tab-desc description fourth">
                <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-twitter">
                Twitter<br/><em style="font-size: 0.8em;">(Example: https://www.twitter.com/user)</em><br/>
                <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-twitter" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][twitter]" value="<?php echo $item['twitter'] ?>" />
                </label>
            </div>
            <div class="tab-desc description fourth last">
                <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-googleplus">
                Google Plus<br/><em style="font-size: 0.8em;">(Example: https://plus.google.com/u/0/116236036606523490579)</em><br/>
                <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-googleplus" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][googleplus]" value="<?php echo $item['googleplus'] ?>" />
                </label>
            </div>
            <p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
            <div class="cf"> </div> 
        </div>
    </li>   
        <?php
        }    
      function block($instance){
    extract($instance); 

            $output = array();
			
			$output[] = '<div class="container">';
				$output[] = '<div class="general-title text-center wow fadeInDown">';
					$output[] = '<h1>'.esc_attr($title).'</h1>';
					$output[] = htmlspecialchars_decode($aftertitle);
				$output[] = '</div>';			
			
				$output[] = '<div class="general_row text-center">';
					if(!empty($items)){
						$i = 0;
						foreach($items as $item){													
							$output[] = '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 '.($i%4==0?'first':'').'">';
								$output[] = '<div class="team_member wow bounceInUp">';																				
									$output[] = '<div class="entry">';
										$output[] = '<img class="img-responsive" src="'.esc_url($item['photo']).'" alt="" />';
										$output[] = '<div class="magnifier">';
											if(!empty($item['email'])){
											$output[] = '<div class="buttons">';
												$output[] = '<a class="st" rel="bookmark" href="'.esc_url($item['email']).'"><span class="fa fa-envelope"></span></a>';
											$output[] = '</div>';
											}											
										$output[] = '</div>';							
									$output[] = '</div>';	
									
									$output[] = '<h3>'.htmlspecialchars_decode($item['name']).' | <small>'.htmlspecialchars_decode($item['job']).'</small></h3>';
									$output[] = wpautop(do_shortcode(htmlspecialchars_decode($item['content'])));										
									$output[] = '<div class="social">';
										if(!empty($item['twitter'])){
											$output[] = '<span><a title="Twitter" href="'.esc_url($item['twitter']).'"><i class="fa fa-twitter"></i></a></span>';
										}
										if(!empty($item['facebook'])){
											$output[] = '<span><a title="Facebook" href="'.esc_url($item['facebook']).'"><i class="fa fa-facebook"></i></a></span>';
										}
										if(!empty($item['googleplus'])){
											$output[] = '<span><a title="Google Plus" href="'.esc_url($item['googleplus']).'"><i class="fa fa-google-plus"></i></a></span>';
										}
									$output[] = '</div>';																			
								$output[] = '</div>';					
							$output[] = '</div>';
							$i++;
						}
					}
				$output[] = '</div>';
			$output[] = '</div>';
			
            echo implode("\n",$output);
   	}
    function add_check4_item() {
    $nonce = $_POST['security'];	
    if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
    
    $count = isset($_POST['count']) ? absint($_POST['count']) : false;
    $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
    
    //default key/value for the testimonial
    $item = array(
		'name' => 'New Team',
		'job' => '',		            
		'content' => '',
		'photo' => '',
		'facebook' => '',
		'twitter' => '',
		'googleplus' => '',
		'email' => ''
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