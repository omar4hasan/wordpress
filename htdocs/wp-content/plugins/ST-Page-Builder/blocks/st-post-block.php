<?php
/* Post Block */
if(!class_exists('ST_Post_Block')) {
class ST_Post_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-th"></i> Show post',
		'size' => 'col-md-12',
	);

	//create the widget
	parent::__construct('st_post_block', $block_options);


}
   function form($instance){
        $defaults = array(
			'title' => '',
			'subtitle' =>'',
            'length' =>'25',
            'read' =>'Read more',
            'show' =>'',
			'excludecate' => '',
			'type'=>'featured',
			'text_link_view_all'=>'VIEW ALL POSTS',
			'text_link_hover_view_all'=>'WE WRITE SOMETHINGS'

        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);

		$choose_type = array(
			'list'=>'List',
			'featured'=>'Featured'
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
		<div class="cf"></div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('excludecate') ?>">
                Exclude Category id <br />Ex: <code>-3,-21,-44,-23</code><br/>
				<?php echo aq_field_input('excludecate', $block_id, $excludecate) ?>
			</label>
		</div>
        <div class="description fourth">
		<label for="<?php echo $this->get_field_id('length') ?>">
			Length excerpt<br/><em style="font-size: 0.8em;">(Number: 30)</em><br/>
			<?php echo aq_field_input('length', $block_id, $length, 'full', 'number') ?>
		</label>
    	</div>
    	<div class="description fourth">
		<label for="<?php echo $this->get_field_id('read') ?>">
			Text read<br/><em style="font-size: 0.8em;">(Example: READ BLOG POST)</em><br/>
			<?php echo aq_field_input('read', $block_id, $read, $size = 'full') ?>
		</label>
    	</div>
    	<div class="description fourth last">
		<label for="<?php echo $this->get_field_id('show') ?>">
			Show post<br/><em style="font-size: 0.8em;">(Number: 8)</em><br/>
			<?php echo aq_field_input('show', $block_id, $show, 'full', 'number') ?>
		</label>
    	</div>
    	<div class="description third">
		<label for="<?php echo $this->get_field_id('type') ?>">
			Type<br/><em style="font-size: 0.8em;"></em><br/>
			<?php echo aq_field_select('type', $block_id, $choose_type, $type, 'full') ?>
		</label>
    	</div>
    	<div class="description third">
		<label for="<?php echo $this->get_field_id('text_link_view_all') ?>">
			Text link view all<br/><em style="font-size: 0.8em;"></em><br/>
			<?php echo aq_field_input('text_link_view_all', $block_id, $text_link_view_all, 'full') ?>
		</label>
    	</div>
    	<div class="description third last">
		<label for="<?php echo $this->get_field_id('text_link_hover_view_all') ?>">
			Text Link Hover View All<br/><em style="font-size: 0.8em;"></em><br/>
			<?php echo aq_field_input('text_link_hover_view_all', $block_id, $text_link_hover_view_all, 'full') ?>
		</label>
    	</div>
  <?php
    }
    function block($instance){
    extract($instance);

    $textdoimain = 'jollyque';
    ?>
       <div class="container">
<?php if($type=='featured'): ?>
		<!-- heading -->
		<div class="general-title text-center wow fadeInDown">
			<h1 class="title"><?php echo esc_attr($title); ?></h1>
			<?php if(!empty($subtitle)): ?>
			<p class="subtitle"><?php echo esc_attr($subtitle); ?></p>
			<?php endif ?>
			<hr class="jt" />
		</div>
		<!-- end heading -->
<?php endif ?>
<!-- Recent post section -->
<?php if($type=='featured'): ?>
	<div id="blog_carousel" class="blog_wrapper">
<?php else: ?>
	<div class="blog_wrapper">
<?php endif ?>
   <?php
	if($type=='featured'){
		$column = 'col-lg-12 col-md-12 col-sm-12 col-lg-12';
	}else{
		$column = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}

    $show = (!empty($show) ? ' '.esc_attr($show) : '');
    $excludecate = (!empty($excludecate) ? ' '.esc_attr($excludecate) : '');
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
          $args=array(
		  	'paged' => $paged,
		  	'post_type' => 'post',
            'posts_per_page' => $show,
         	'cat' => $excludecate,
         	'order' => 'DESC',
         	'orderby' => 'date',
         	'post__not_in' => get_option( 'sticky_posts' ),
        );
         $wp_query = new WP_query($args);
         if ( $wp_query -> have_posts() ) :
		 $i=0;
         while ($wp_query -> have_posts()): $wp_query -> the_post();
			$format = get_post_format();
			if ( false === $format ) {
				$format = 'standard';
			}
   ?>

		<div class="<?php echo $column ?> <?php echo $i%3==0?'first':'' ?>">
			<div class="blog-item">
				<div class="entry">
					<?php if($format == 'standard'): ?>
					<?php the_post_thumbnail('thumbnail',array('class'=>'img-responsive')); ?>
					<div class="magnifier">
						<div class="buttons">
							<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
						</div>
					</div><!-- end magnifier -->
					<?php
						elseif($format == 'video'):
							$linkvideo = get_post_meta(get_the_ID(),'_cmb_linkvideo',true);
							if(strpos($linkvideo,'vimeo.com')){
								$url = 'http://player.vimeo.com/video/'.$this->parse_vimeo($linkvideo).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff';
							}else{
								$url = 'http//www.youtube.com/embed/'.$this->parse_youtube($linkvideo);
							}
					?>
						<iframe src="<?php echo $url ?>" width="980" height="551"></iframe>
					<?php
						elseif($format == 'audio'):
							$linkaudio = get_post_meta(get_the_ID(),'_cmb_linkaudio',true);
					?>
						<iframe id="soundcloud<?php echo get_the_ID() ?>" src="https://w.soundcloud.com/player/?url=<?php echo urlencode($linkaudio) ?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
					<?php
						elseif($format == 'gallery'):
							$gallery = get_post_meta(get_the_ID(),'_cmb_gallery');
					?>
						<div class="flexslider">
							<?php if(count($gallery[0])>0): ?>
							<ul class="slides">
								<?php foreach($gallery[0] as $image): ?>
								<li><img src="<?php echo $image ?>" alt="" class="img-responsive" height="300"></li>
								<?php endforeach ?>
							</ul><!-- end slides -->
							<?php endif ?>
						</div><!-- end post-slider -->
					<?php endif ?>
				</div>
			   <div class="blog_header">
					<a href="<?php the_permalink();?>"><h3><?php the_title();?></h3></a>
					<span class="meta">
						<small><?php the_author_posts_link(); ?></small> | <small><a href=""><?php the_time('F j, Y'); ?></a></small> | <small><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></small>
					</span>
				</div><!-- end blog_header -->
				<div class="blog_details">
					<p><?php if($length >= '1'){echo jollyque_excerpt($length);}else{echo jollyque_excerpt(30);}?></p>
				</div><!-- blog_details -->
				<div class="blog_footer">
					<span class="pull-left"><a href="single.html"><i class="fa fa-comment-o"></i> <?php comments_number('0 Comment', '1 Comment','% Comments'); ?></a></span>
					<span class="pull-right"><a href="<?php the_permalink();?>"><?php echo $read; ?></a></span>
				</div><!-- end blog_footer -->
			</div>
		</div><!-- end col-lg-4 -->

    <?php $i++;endwhile;?>

	</div>
	<!-- end fullwidth -->
			<div class="clearfix"></div>
		<?php if($type=='featured'): ?>
			<div class="text-center">
				<div class="jtbutton">
					<a href="<?php echo home_url() ?>/blog" title=""><span data-hover="<?php echo $text_link_hover_view_all ?>"><?php echo $text_link_view_all ?></span></a>
				</div>
			</div><!-- end text-center -->
		<?php else: ?>
			<div class="pagination_wrapper text-center clearfix">
				<!-- Pagination Normal -->
                <ul class="pagination">
					<?php
						$big = 999999999; // need an unlikely integer
						$paging = paginate_links( array(
							 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							 'format' => '?paged=%#%',
							 'current' => max(1, get_query_var('paged') ),
							 'total' => $wp_query->max_num_pages,
							 'next_text'    => __('&raquo;','icreative'),
							 'prev_text'    => __('&laquo;','icreative'),
							 'type'         => 'array',
						) );
						if(count($paging)>0):
							foreach($paging as $p){
								if(strpos($p,'current')){
									echo '<li class="active"><a href="#">'.$p.'</a></li>';
								}else{
									echo '<li>'.$p.'</li>';
								}
							}
						endif;
					?>
				</ul>
			</div><!-- end pagination_wrapper -->
		<?php endif ?>

			<?php
				//echo '<div id="pagenavi_birva">';
					//birva_numeric_posts_nav();
				//echo '</div>';
				endif;
			?>
	</div>
	<!-- end Recent post section -->
    <?php
    }
    function update($new_instance, $old_instance) {
	    $new_instance = aq_recursive_sanitize($new_instance);
	    return $new_instance;
	}

	function parse_youtube($link){

        $regexstr = '~
            # Match Youtube link and embed code
            (?:                             # Group to match embed codes
                (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
                |(?:                        # Group to match if older embed
                    (?:<object .*>)?      # Match opening Object tag
                    (?:<param .*</param>)*  # Match all param tags
                    (?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
                )?                          # End older embed code group
            )?                              # End embed code groups
            (?:                             # Group youtube url
                https?:\/\/                 # Either http or https
                (?:[\w]+\.)*                # Optional subdomains
                (?:                         # Group host alternatives.
                youtu\.be/                  # Either youtu.be,
                | youtube\.com              # or youtube.com
                | youtube-nocookie\.com     # or youtube-nocookie.com
                )                           # End Host Group
                (?:\S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
                ([\w\-]{11})                # $1: VIDEO_ID is numeric
                [^\s]*                      # Not a space
            )                               # End group
            "?                              # Match end quote if part of src
            (?:[^>]*>)?                       # Match any extra stuff up to close brace
            (?:                             # Group to match last embed code
                </iframe>                 # Match the end of the iframe
                |</embed></object>          # or Match the end of the older embed
            )?                              # End Group of last bit of embed code
            ~ix';

        preg_match($regexstr, $link, $matches);

        return $matches[1];

    }

	function parse_vimeo($link){

        $regexstr = '~
            # Match Vimeo link and embed code
            (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
            (?:                         # Group vimeo url
                https?:\/\/             # Either http or https
                (?:[\w]+\.)*            # Optional subdomains
                vimeo\.com              # Match vimeo.com
                (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
                \/                      # Slash before Id
                ([0-9]+)                # $1: VIDEO_ID is numeric
                [^\s]*                  # Not a space
            )                           # End group
            "?                          # Match end quote if part of src
            (?:[^>]*></iframe>)?        # Match the end of the iframe
            (?:<p>.*</p>)?              # Match any title information stuff
            ~ix';

        preg_match($regexstr, $link, $matches);

        return $matches[1];

    }
}
}
 ?>