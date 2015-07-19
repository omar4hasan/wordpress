<?php
/* Post Block */
if(!class_exists('ST_Twitter_Block')) {
class ST_Twitter_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-twitter"></i> Twitter',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_twitter_block', $block_options);

	}
   function form($instance){
        $defaults = array(
			'title' => 'Our happy clients',
			'id' => '',
			'class' => 'parallax',        	
            'user' =>'evanto',
            'num' =>1,
			'icon'=>'',
			'image'=>''
  
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);  ?>
        
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

    	<div class="description">
    		<label for="<?php echo $this->get_field_id('image') ?>">
    			Photo <em style="font-size: 0.8em;">(Your Photo)</em><br/>
    			<?php echo aq_field_input('image', $block_id, $image, $size = 'full',$type = 'text') ?>
    			<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
    		</label>
        </div>		

		<div class="cf"></div>

        <div class="description half">
		<label for="<?php echo $this->get_field_id('user') ?>">
			User<br/><em style="font-size: 0.8em;">(Your user in twitter)</em><br/>
			<?php echo aq_field_input('user', $block_id, $user, $size = 'full',$type = 'text') ?>
		</label>
    	</div>

    	<div class="description third">
		<label for="<?php echo $this->get_field_id('num') ?>">
			Number Status<br/><em style="font-size: 0.8em;">(Your Number Status you want show:)</em><br/>
			<?php echo aq_field_input('num', $block_id, $num, $size = 'min',$type='number' ) ?>
		</label>
    	</div>

  <?php
    }
    function block($instance){
    extract($instance);
	$output = array();

	//get twitter
	$settings = array(
	    'oauth_access_token' => "460485056-XHfLUud3fQToKfseTnoaiSLrWrdKnsiEyiCaJHLX",
	    'oauth_access_token_secret' => "GmYQbQcDXdiWBJFH39GgyG7i7fxVcfaQQT0YgCgh015f7",
	    'consumer_key' => "18ihEuNsfOJokCLb8SAgA",
	    'consumer_secret' => "7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk"
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name='.$user.'&count='.$num;
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$recent_twitter = $twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
	             ->performRequest();
	$twitters = json_decode($recent_twitter,true);	
	//end get twitter	
	
	$output[] = '<section id="'.esc_attr($id).'" class="'.esc_attr($class).'" style="background-image: url(\''.$image.'\');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">';
		$output[] = '<div class="overlay">';
			$output[] = '<div class="container">';
				$output[] = '<div class="general-title text-center wow fadeInDown">';
					$output[] = '<h1>'.htmlspecialchars_decode($title).'</h1>';
					$output[] = '<div class="custom-icon '.esc_attr($icon).'-icon"><i class="fa fa-'.esc_attr($icon).'"></i></div>';
				$output[] = '</div>';		
				
				$output[] = '<div class="testimonial-widget">';
					$output[] = '<div id="owl-'.($icon=='quote-right'?'testimonial':esc_attr($icon)).'" class="owl-carousel text-center">';
					
						if (!isset($twitters['errors']) && count($twitters)>0) {
							foreach( $twitters as $twitter ) {
								$output[] = '<div class="testimonial">';									
									$output[] = '<p class="lead">'.$twitter['text'].'</p>';	

									$output[] = '<h3>';
										$output[] = '<i class="fa fa-clock-o"></i> ';
										$output[] = human_time_diff( get_the_time('U'), strtotime($twitter['created_at']) ) . ' ago';
									$output[] = '</h3>';
																	
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
    function update($new_instance, $old_instance) {
    $new_instance = aq_recursive_sanitize($new_instance);
    return $new_instance;
}
}
}
 ?>