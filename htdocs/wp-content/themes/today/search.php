<?php
get_header();

echo '
<div class="title-head"><h1>Search Results for: '.$_GET['s'].'</h1></div>

<div class="blog-fixed">'; 

$page_layout = page_sidebar_layout();
$src         = null;
$count       = 0;
switch ($page_layout) {
    
    case "sidebar-left":
        echo '
	<div id="page-right">';
        break;
    
    case "sidebar-full":
        echo '
	<div id="page-full">';
        break;
    
    case "sidebar-right":
        echo '
	<div id="page-left">';
        break;
}

if (have_posts())
    while (have_posts()):
        the_post();
        $count++;
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'short-one');
		$no_cover = get_template_directory_uri();
		$category = get_the_category();
		$author   = get_the_author_meta('ID');
        $src .= '
		<div class="bl2page-archive">';
            $src .= '
			<div class="bl2page-cover">';
       		if ($image_id) {
                $src .= '
				<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
            } else {
                $src .= '
				<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/short-one.png" alt="no-cover" /></a>';
            }
			if ($category != null) {
			$src .= '
				<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
			}
			$src .= '
				<div class="comment-bubble">
					<span class="comment-count">' . get_comments_number() . '</span>
				</div>
			</div>';
        $src .= '
			<h2 class="bl2page-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>
			<div class="bl2page-info">' . get_the_time('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a> </div>';
        $src .= '' . get_excerpt(230) . '';
        $src .= '
		</div>';
    endwhile;
if ($count == 0) {
    echo '<h4>' . __('No posts were found!', 'wizedesign') . '</h4>';
}
echo $src;

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