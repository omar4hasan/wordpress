<?php
/*
Template Name: Blog Style 4
*/

get_header();

if ( is_front_page() ) {
$paged 		 = (get_query_var('page')) ? get_query_var('page') : 1;
	}
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
$queryM      = array(
    'post_type' => 'post',
    'category_name' => $cat
);

if ($image_id) {
    echo '
<div class="blog-cover"> 
<div class="blog-cover-bg"></div>
<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />
<h1>';
    $prefix = false;
    if (function_exists('is_tag') && is_tag()) {
        $prefix = true;
    } elseif (is_archive()) {
        wp_title(' ');
    } elseif (is_page()) {
        the_title();
    }
    echo '
</h1>
<span>';
    if (have_posts())
        while (have_posts()):
            the_post();
            echo the_content();
        endwhile;
    echo '
</span>';
    
    $wp_queryM = new WP_Query($queryM);
    if (have_posts())
        while ($wp_queryM->have_posts()):
            $wp_queryM->the_post();
            $category = get_the_category();
            
            if ($cat != null) {
                echo '
<div class="blog-cover-cat">' . $category[0]->cat_name . '</div>';
            }
        endwhile;
    echo '
</div>';
}

if ($slider) {
    require('slider.php');
}

if ($feature) {
    require('feature.php');
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

if ( is_front_page() ) {
	echo '';
	} else {
?>	
<div class="short-title"><h3><?php wp_title(' '); ?></h3></div>
<?php
	}
	
$wp_query = new WP_Query($query);
if (have_posts())
    echo '
	<div class="bl4page-archive">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    $image_id = get_post_thumbnail_id($post->ID);
    $cover    = wp_get_attachment_image_src($image_id, 'short-four');
    $no_cover = get_template_directory_uri();
    $category = get_the_category();
    $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
    $youtube  = get_post_meta($post->ID, "post_youtube", true);
	$author   = get_the_author_meta('ID');
    echo '
		<div class="short-four-art">
			<div class="short-four-cover">';
			if ($vimeo or $youtube) {
				echo '
				<a href="' . get_permalink() . '"><div class="short-four-video"></div></a>';
			}
			if ($image_id) {
				echo '
				<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
			} else {
				echo '
				<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/short-two.png" alt="no-cover" /></a>';
			}
			echo '
			<div class="comment-bubble">
				<span class="comment-count">' . get_comments_number() . '</span>
			</div>';
			if ($cat != null) {
			} else {
				echo '	
			<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
			}
			echo '
			</div>
			<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
			<div class="short-four-info">' . get_the_date('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a></div>
			' . get_excerpt(130) . '
		</div><!-- end .short-four-art -->
';
endwhile;
echo '
	</div><!-- end .bl4page-archive -->
';

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
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-four-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "sidebar-full":
        echo '
<div id="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-four-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
    case "sidebar-right":
        echo '
<div id="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-four-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}

echo '  
</div><!-- end .blog-fixed -->';

get_footer();
?>