<?php
$numberfeat  = of_get_option('feature_slideshow_number');
$args      = array(
    'posts_per_page' => $numberfeat,
	'meta_key' => 'post_feature',
	'meta_value' => 'yes',
    'order' => 'DESC',
    'orderby' => 'DATE',
    'category_name' => $cat
);
$wp_feature  = new WP_Query($args); 

echo '

<div id="feat-slide">
	<div class="flexslider" id="feat-carousel">
		<ul class="slides">';
    while ($wp_feature->have_posts()):
           $wp_feature->the_post();
    $feature  = get_post_meta($post->ID, "post_feature", true);
    $category = get_the_category();
    $image_id = get_post_thumbnail_id();
    $cover    = wp_get_attachment_image_src($image_id, 'feature');
    $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
    $youtube  = get_post_meta($post->ID, "post_youtube", true);
	$no_cover = get_template_directory_uri();
        echo '		
			<li>
				<a href="' . get_permalink() . '">';
        if ($vimeo or $youtube) {
            echo '<div class="feat-bg-video"></div></a>';
        } else {
            echo '<div class="feat-bg"></div></a>';
        }
        
        if ($image_id) {
            echo '
				<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            echo '
				<img src="' . $no_cover . '/images/no-cover/feature.png" alt="no-cover" />';
        }
        
        echo '
				<div class="feat-content">';
        if ($cat != null) {
        } else {
            echo '
					<div class="feat-content-cat">' . $category[0]->cat_name . '</div>';
        }
        echo '
					<div class="feat-content-date">
						<div class="feat-content-day">' . get_the_date('d') . '</div>
						<div class="feat-content-month">' . get_the_date('M') . ' ' . get_the_date('Y') . '</div>
					</div>
					<a href="' . get_permalink() . '"><h2>' . get_the_title() . '</h2></a>	
				</div>
			</li>';
endwhile;

echo '			
		</ul>
	</div>
</div><!-- end #feat-slide --> ';

?>