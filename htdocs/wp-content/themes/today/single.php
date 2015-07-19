<?php
get_header();

$image_id    = get_post_thumbnail_id($post->ID);
$cover       = wp_get_attachment_image_src($image_id, 'blog-cover');
$no_cover    = get_template_directory_uri();
$cover_full  = get_post_meta($post->ID, "post_cover", true) == 'yes';
$gallery     = get_post_meta($post->ID, "post_gallery", true) == 'yes';
$category    = get_the_category();
$page_layout = page_sidebar_layout();


if ($cover_full) {
    echo '
<div class="single-cover"> 
	<div class="blog-cover-bg"></div>';
    if ($image_id) {
        echo '
	<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
	<img src="' . $no_cover . '/images/no-cover/cover-fullwidth.png" alt="no-cover" />';
    }
    echo '
	<h1>';
    if (have_posts())
        while (have_posts()):
            the_post();
            echo get_the_title($post->ID);
        endwhile;
    echo '</h1>
	<span>' . get_the_time('F jS, Y') . '</span>
	<div class="blog-cover-cat">' . $category[0]->cat_name . '</div>
</div><!-- end .single-cover -->
';
}

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

if (have_posts())
    while (have_posts()):
        the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'blog-one');
        $category = get_the_category();
		$vimeo    = get_post_meta($post->ID, "post_vimeo", true);
		$youtube  = get_post_meta($post->ID, "post_youtube", true);
		$author   = get_the_author_meta('ID');
        echo '
		<div class="single-archive">';
        if ($cover_full) {
        } else {
            echo '
			<h1 class="single-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>
			<div class="single-info">' . get_the_time('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a></div>';
            if ($image_id) {
				if ($vimeo or $youtube) {
				} else {
                echo '
			<div class="single-cover-art">
				<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
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
				}
			}
        }
        
        require('admin/video.php');
         
        echo "<p>" . the_content() . "</p>";
        echo '
		</div><!-- end .single-archive -->
';
    endwhile;


if ($gallery) {
    generate_gallery(get_the_ID());
}

echo get_the_tag_list('<div class="single-tag">',' ','</div>');

comments_template('', true);

echo '					
	</div><!-- end .blog(left&full&right) -->
';

switch ($page_layout) {
    case "sidebar-left":
        echo '
<div id="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('single-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "sidebar-full":
        break;
    case "sidebar-right":
        echo '
<div id="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('single-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}

echo '  
</div><!-- end .blog-fixed -->';

get_footer();
?>