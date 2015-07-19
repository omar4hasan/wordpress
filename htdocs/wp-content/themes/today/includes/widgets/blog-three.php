<?php
class Widget_Blog_Three extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Widget_Blog_Three() {
        $widget_opts = array(
            'classname' => 'widget_blog_three',
            'description' => __('Recent posts on blog your site, style #3.', 'wizedesign')
        );
        $this->WP_Widget('widget-blog#3', __('TODAY - #3 Recent Posts', 'wizedesign'), $widget_opts);
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
        $query    = array(
            'posts_per_page' => $number,
            'category_name' => $category
        );
        $wp_query = new WP_Query($query);
        echo '
<div class="widget-blog-three">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            global $post;
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'widget-three');
            $no_cover = get_template_directory_uri();
            $cat	  = get_the_category();
            $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
            $youtube  = get_post_meta($post->ID, "post_youtube", true);
            echo '
	<div class="widget-blog-three-art">
		<div class="widget-blog-three-cover">';
            if ($vimeo or $youtube) {
                echo '
			<a href="' . get_permalink() . '"><div class="widget-blog-three-video"></div></a>';
            } else {
                echo '
			<a href="' . get_permalink() . '"><div class="widget-blog-two-bg"></div></a>';
            }
            if ($image_id) {
                echo '
			<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
            } else {
                echo '
			<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/widget-three.png" alt="no-cover" /></a>';
            }
            echo '
			<div class="widget-blog-three-date">
				<div class="widget-blog-three-day">' . get_the_date('d') . '</div>
				<div class="widget-blog-three-month">' . get_the_date('M') . ' ' . get_the_date('Y') . '</div>
			</div>
			<a href="' . get_permalink() . '"><h2>' . get_the_title() . '</h2></a>';
            if ($category != null) {
            } else {
                echo '		
			<div class="slider-left-cat">' . $cat[0]->cat_name . '</div>';
            }
            echo '
		</div>' . get_excerpt(180) . '
	</div><!-- end .widget-blog-three-art -->';
        endwhile;
        echo '
</div><!-- end .widget-blog-three -->
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
add_action('widgets_init', create_function('', 'register_widget("Widget_Blog_Three");'));
?>