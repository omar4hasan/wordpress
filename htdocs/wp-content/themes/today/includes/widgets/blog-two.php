<?php
class Widget_Blog_Two extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Widget_Blog_Two() {
        $widget_opts = array(
            'classname' => 'widget_blog_two',
            'description' => __('Recent posts on blog your site, style #2.', 'wizedesign')
        );
        $this->WP_Widget('widget-blog#2', __('TODAY - #2 Recent Posts', 'wizedesign'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title    = apply_filters('widget_title', $instance['title']);
        $number   = $instance['number'];
        $category = $instance['category'];
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */
?>
		
	<?php
        $query     = array(
            'posts_per_page' => 1,
            'category_name' => $category
        );
        $queryM    = array(
            'posts_per_page' => $number,
            'category_name' => $category,
            'offset' => 1
        );
        $wp_query  = new WP_Query($query);
        $wp_queryM = new WP_Query($queryM);
        echo '
<div class="widget-blog-two">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            global $post;
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'widget-two');
            $no_cover = get_template_directory_uri();
            $category = get_the_category();
            $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
            $youtube  = get_post_meta($post->ID, "post_youtube", true);
            echo '
	<div class="widget-blog-two-cover">
		<ul>
			<li class="sb-modern-skin">
				<div class="mediaholder">
					<div class="mediaholder_innerwrap">';
            if ($vimeo or $youtube) {
                echo '
						<div class="widget-blog-two-video"></div>';
            } else {
                echo '
						<div class="widget-blog-two-bg"></div>';
            }
            if ($image_id) {
                echo '
						<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
						<img src="' . $no_cover . '/images/no-cover/widget-two.png" alt="no-cover" />';
            }
            echo '
					</div>
				</div>
				<div class="comment-bubble">
					<span class="comment-count">' . get_comments_number() . '</span>
				</div>	
				<div class="slider-left-cat">' . $category[0]->cat_name . '</div>	
				<div class="detailholder"> <span>' . get_the_date('F jS, Y') . '</span>
					<h2>' . get_the_title() . '</h2>
					<p class="excerpt">' . get_excerpt(130) . '<a href="' . get_permalink() . '"><span class="widget-blog-two-cover-link">Read More</span></a></p>
				</div>
			</li>
		</ul>
	</div><!-- end .widget-blog-two-cover -->';
        endwhile;
        
        echo '
	<div class="widget-blog-two-art">                                   
		<ul>';
        while ($wp_queryM->have_posts()):
            $wp_queryM->the_post();
?>

			<li><?php
            $image_id = get_post_thumbnail_id();
            $coverM   = wp_get_attachment_image_src($image_id, 'short-threeM');
            $no_cover = get_template_directory_uri();
            if ($image_id) {
                echo '
				<a href="' . get_permalink() . '"><img src="' . $coverM[0] . '" alt="' . get_the_title() . '" /></a>';
            } else {
                echo '
				<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/thumb.png" alt="no-cover" /></a>';
            }
?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php
            if (strlen($post->post_title) > 50) {
                echo substr(the_title($before = '', $after = '', FALSE), 0, 55) . '...';
            } else {
                the_title();
            } ?></a>
				<span><?php echo get_the_time('F jS, Y'); ?></span>
			</li><?php
        endwhile;
        echo '
        </ul>
    </div><!-- end .widget-blog-two-art -->
</div><!-- end .widget-blog-two -->
';
        wp_reset_query();
?>

		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance             = $old_instance;
        $instance['title']    = strip_tags($new_instance['title']);
        $instance['number']   = strip_tags($new_instance['number']);
        $instance['category'] = strip_tags($new_instance['category']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Recent Posts',
            'number' => 4,
            'category_name' => null
        ));
        // Display the admin form
?>
        <p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('Title:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('title');
?>" name="<?php
        echo $this->get_field_name('title');
?>" value="<?php
        echo $instance['title'];
?>" />
	</p>
		
	<p>
		<label for="<?php
        echo $this->get_field_id('number');
?>"><?php
        _e('Posts Number:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('number');
?>" name="<?php
        echo $this->get_field_name('number');
?>" value="<?php
        echo $instance['number'];
?>" />
	</p>
	
		<p>
		<label for="<?php
        echo $this->get_field_id('category');
?>"><?php
        _e('Category Slug (optional):', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('category');
?>" name="<?php
        echo $this->get_field_name('category');
?>" value="<?php
        echo $instance['category'];
?>" />
	</p>
	<?php
    }
} // end class
add_action('widgets_init', create_function('', 'register_widget("Widget_Blog_Two");'));
?>