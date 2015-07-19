<?php

get_header();

$image_id    = get_post_thumbnail_id($post->ID);
$cover       = wp_get_attachment_image_src($image_id, 'blog-cover');
$slider      = get_post_meta($post->ID, "page_slider", true) == 'yes';
$feature     = get_post_meta($post->ID, "page_feature", true) == 'yes';
$number      = get_post_meta($post->ID, "page_number", true);
$cat         = get_post_meta($post->ID, "page_category", true);
$page_layout = page_sidebar_layout();
$query       = array(
    'post_type' => 'post',
    'category_name' => $cat,
    'posts_per_page' => $number,
    'paged' => $paged
);

echo '
<div class="blog-fixed">';

switch ($page_layout) {
    
    case "sidebar-left":
        echo '
	<div id="blog-right">';
        break;
    
    case "sidebar-full":
        echo '
	<div id="blog-full">';
        break;
    
    case "sidebar-right":
        echo '
	<div id="blog-left">';
        break;
}
?>


<div class="short-title"><h3>Recent Posts</h3></div>

<?php
$wp_query = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'short-one');
		$no_cover = get_template_directory_uri();
        $category = get_the_category();
		$vimeo    = get_post_meta($post->ID, "post_vimeo", true);
        $youtube  = get_post_meta($post->ID, "post_youtube", true);
		$author   = get_the_author_meta('ID');
        echo '
	<div class="bl2page-archive">
		<div class="bl2page-cover">';
	        if ($vimeo or $youtube) {
                echo '
			<a href="' . get_permalink() . '"><div class="short-one-video"></div></a>';
            }
			if ($image_id) {
                echo '
			<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
            } else {
                echo '
			<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/short-one.png" alt="no-cover" /></a>';
            }
            if ($cat != null) {
            } else {
                echo '		
			<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
            }
            echo '
			<div class="comment-bubble">
				<span class="comment-count">' . get_comments_number() . '</span>
			</div>
		</div>';
        echo '
		<h2 class="bl2page-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>
		<div class="bl2page-info">' . get_the_time('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a></div>';
		echo ''.get_excerpt(230).'';
        echo '
    </div><!-- end .bl2page-archive -->
';
    endwhile;

if (function_exists("pagination_wz")) {
    pagination_wz();
}
						
echo '
	</div><!-- end .blog(left&full&right) -->
';

switch ($page_layout) {
    case "sidebar-left":
        echo '
<div id="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "sidebar-full":
        echo '
<div id="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
    case "sidebar-right":
        echo '
<div id="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}

echo '  
</div><!-- end .blog-fixed -->';

get_footer();
?>