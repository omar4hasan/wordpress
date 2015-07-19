<?php
get_header();
$category = get_the_category();
echo '
<div class="title-head"><h1>'.$category[0]->cat_name.'</h1></div>

<div class="blog-fixed">'; 

$page_layout = page_sidebar_layout();
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

if (have_posts())
    while (have_posts()):
        the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'short-one');
		$no_cover = get_template_directory_uri();
		$author   = get_the_author_meta('ID');
        echo '
		<div class="bl2page-archive">';
            echo '
			<div class="bl2page-cover">';
       		if ($image_id) {
                echo '
				<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
            } else {
                echo '
				<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/short-one.png" alt="no-cover" /></a>';
            }
			echo '
				<div class="comment-bubble">
					<span class="comment-count">' . get_comments_number() . '</span>
				</div>
			</div>';
        echo '
			<h2 class="bl2page-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>
			<div class="bl2page-info">' . get_the_time('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a> </div>';
        echo '' . get_excerpt(230) . '';
        echo '

    </div>';
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