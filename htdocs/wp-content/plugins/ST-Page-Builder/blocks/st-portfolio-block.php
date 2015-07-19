<?php
/* Work Block */
if(!class_exists('ST_Portfolio_Block')) {
class ST_Portfolio_Block extends AQ_Block {
   
   function __construct() {
	    $block_options = array(
	    'name' => '<i class="fa fa-archive"></i> Portfolio',
	    'size' => 'col-md-12',
    );
    
	    //create the widget
	    parent::__construct('st_portfolio_block', $block_options);
    } 
    
   function form($instance){
        $defaults = array(
			'title' => 'Title Portfolio',
			'aftertitle' => '',
		    'show' => '',
			'orderby' => 'title',
			'orderpost' => 'ASC',
			'show_button' => 0,
			'text_button' => 'View Portfolio',
			'link_button' => ''
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
		$orderpost_options = array (
			'ASC' => 'ASC : lowest to highest',
			'DESC' => 'DESC : highest to lowest',	
		);
		
		$orderby_options = array (
			'title' => 'Title',
			'date' => 'Date',
			'rand' => 'Random'
		);
        ?>
		<div class="description">
	        <label for="<?php echo $this->get_field_id('title') ?>">
	        Title Portfolio
	        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
	        </label>
	    </div>
		
		<div class="description">
	        <label for="<?php echo $this->get_field_id('aftertitle') ?>">
	        After title Portfolio
	        <?php echo aq_field_input('aftertitle', $block_id, $aftertitle, $size = 'full') ?>
	        </label>
	    </div>
		<div class="cf"></div>
		
    	<div class="description third">
    		<label for="<?php echo $this->get_field_id('show') ?>">
    			Show post<br/><em style="font-size: 0.8em;">(Number: 6)</em><br/>
    			<?php echo aq_field_input('show', $block_id, $show, $size = 'full',$type = 'number') ?>
    		</label>
    	</div>
		<div class="description third">
    		<label for="<?php echo $this->get_field_id('orderpost') ?>">
    			Sort Order<br/><em style="font-size: 0.8em;">Sort from lowest to highest (Default)</em><br/>
    			<?php echo aq_field_select('orderpost', $block_id, $orderpost_options, $orderpost, $size = 'full') ?>
    		</label>
    	</div>
		<div class="description third last">
    		<label for="<?php echo $this->get_field_id('orderby') ?>">
    			Order by<br/><em style="font-size: 0.8em;">Title (Default)</em><br/>
    			<?php echo aq_field_select('orderby', $block_id, $orderby_options, $orderby, $size = 'full') ?>
    		</label>
    	</div>
		<h3 style="text-align: center;">Button more Portfolio</h3>
		<div class="cf"></div>
  		<div class="description third">
    		<label for="<?php echo $this->get_field_id('show_button') ?>">
    			show_button<br/><em style="font-size: 0.8em;">(Default: hide)</em><br/>
    			<?php echo aq_field_checkbox('show_button', $block_id, $show_button, $size = 'full') ?>
    		</label>
    	</div>
		<div class="description third">
    		<label for="<?php echo $this->get_field_id('text_button') ?>">
    			text_button<br/><em style="font-size: 0.8em;">(Default: View Portfolio)</em><br/>
    			<?php echo aq_field_input('text_button', $block_id, $text_button, $size = 'full') ?>
    		</label>
    	</div>
		<div class="description third last">
    		<label for="<?php echo $this->get_field_id('link_button') ?>">
    			link_button<br/><em style="font-size: 0.8em;">(Link Default: link to archive portfolio page)</em><br/>
    			<?php echo aq_field_input('link_button', $block_id, $link_button, $size = 'full') ?>
    		</label>
    	</div>
		<div class="cf"></div>
        <?php
        } 
   function block($instance){
    extract($instance);
    $title1 = (!empty($title) ? ' '.esc_attr($title) : '');  
    $aftertitle = (!empty($subtitle) ? ' '.htmlspecialchars_decode($aftertitle) : '');  
    $show1 = (!empty($show) ? ' '.esc_attr($show) : '');
	
	$html = array();
	
	$html[] ='<div class="container">';
		$html[] ='<div class="general-title text-center wow fadeInDown">';
			$html[] ='<h1>'.$title1.'</h1>';
			$html[] = $aftertitle;
		$html[] ='</div>';
		
		$html[] ='<div class="text-center clearfix">';
			$html[] ='<nav class="portfolio-filter">';
				$html[] ='<ul>';
					$html[] ='<li><a class="btn btn-primary" href="#" data-filter="*"><span></span>All</a></li>';
					$categories = get_terms('Categories');   
					foreach($categories as $categorie){ 
						$html[] = '<li><a class="btn btn-default" href="#" data-filter=".'.$categorie->slug.'">'.$categorie->name.'</a></li>';
					}
				$html[] ='</ul>';						
			$html[] ='</nav>';			
		$html[] ='</div>';		
	$html[] ='</div>';           
		
	$html[] ='<div class="portfolio-container">';
		$html[] ='<div class="portfolio">';
			/**Protfolio**/
			$args = array(   
				'posts_per_page' => $show1,
				'post_type' => 'portfolio',
				'order' => $orderpost,
				'orderby' => $orderby,   
			);  
			$portfolio = new WP_Query($args);
			$i = 1;						
			 while($portfolio->have_posts()) : $portfolio->the_post();			
				$job =get_post_meta(get_the_ID(),'_cmb_portfolio_job', true);  
				$project = get_post_meta(get_the_ID(), '_cmb_portfolio_project', TRUE);     
				$layout =get_post_meta(get_the_ID(),'_cmb_portfolio_layout', true); 
				$format = get_post_format(get_the_ID(), 'portfolio');

				$cates = get_the_terms(get_the_ID(),'Categories');
				$cate_name ='';
				$cate_slug = ''; 
				$cate_link = '';
				$url = wp_get_attachment_url(get_post_thumbnail_id() );

				foreach((array)$cates as $cate){
					if(count($cates)>0){
						$cate_name .= $cate->name.' &middot; ' ;
						$cate_slug .= $cate->slug .' ';
						$category_id = get_cat_ID($cate->name);
						$cate_link .= '<a href="'.get_category_link($category_id).'">'.$cate->name.'</a> ';							
					} 
				} 

				$gallery = get_post_gallery( get_the_ID(), false );
				$gallery_ids = $gallery['ids'];
				$img_ids = explode(",",$gallery_ids);			
				/**Protfolio Item**/
				$html[] ='<div class="item entry '.$cate_slug.'">';
					$html[] ='<img src="'.$url.'" alt="" />';
					$html[] ='<div class="magnifier">';
						$html[] ='<div class="buttons">';
							$html[] ='<a class="sf" data-gal="prettyPhoto" href="'.$url.'"><span class="fa fa-search"></span></a>';
							$html[] ='<a class="st" rel="bookmark" href="#"><span class="fa fa-heart"></span></a>';
							$html[] ='<a class="sg" rel="bookmark" href="'.get_the_permalink().'"><span class="fa fa-external-link"></span></a>';
						$html[] ='</div>';	
						$html[] ='<div class="description">';
							$html[] ='<hr class="jt" />';	
							$html[] ='<h3>'.get_the_title().'</h3>';	
							$html[] ='<span><i class="fa fa-folder-open-o"></i> '.$cate_link.'</span>';	
						$html[] ='</div>';							
					$html[] ='</div>';
				$html[] ='</div>';
				$i++;
			endwhile;			
		$html[] ='</div>';	
	$html[] ='</div>';	
	
	$html[] ='<div class="clearfix"></div><br/><br/>';	
		
	$show_button = ( isset($show_button) ) ? $show_button : 0;
	if($show_button == 1){
		$html[] ='<div class="btn-wrapper">';
			$html[] ='<div class="jtbutton">';
				if(!empty($link_button)){
					$html[] = '<a href="'.$link_button.'">';
				}else{
					$html[] = '<a href="'.home_url().'/portfolio">';
				}
					$html[] = '<span data-hover="OUR AWESOME WORKS">'.$text_button.'</span>';		
				$html[] ='</a>';
			$html[] ='</div>'; 
		$html[] ='</div>'; 
	}else{}

	echo implode("\n",$html);  


    }
    function update($new_instance, $old_instance) {
	    $new_instance = aq_recursive_sanitize($new_instance);
	    return $new_instance;
	}      
}
}