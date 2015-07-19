<?php
class Widget_Blog_One extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Widget_Blog_One() {
        $widget_opts = array(
            'classname' => 'widget_blog_one',
            'description' => __('Recent posts on blog your site, style #1.', 'wizedesign')
        );
        $this->WP_Widget('widget-blog#1', __('TODAY - #1 Recent Posts', 'wizedesign'), $widget_opts);
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
        global $post;
        $query    = array(
            'posts_per_page' => $number,
            'category_name' => $category
        );
        $wp_query = new WP_Query($query);
        echo '
<div class="widget-blog-one">                                   
	<ul>';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
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
</div><!-- end .widget-blog-one -->
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
add_action('widgets_init', create_function('', 'register_widget("Widget_Blog_One");'));
?>