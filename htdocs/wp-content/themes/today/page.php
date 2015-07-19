<?php
get_header();

global $post;
$location    = str_replace(array(
    strtolower(get_bloginfo('url'))
), '', strtolower(get_permalink()));
$page_layout = page_sidebar_layout();
$image_id    = get_post_thumbnail_id($post->ID);
$cover       = wp_get_attachment_image_src($image_id, 'blog-cover');
$slider      = get_post_meta($post->ID, "page_slider", true) == 'yes';
$feature     = get_post_meta($post->ID, "page_feature", true) == 'yes';
$cat         = get_post_meta($post->ID, "page_category", true);
$queryM      = array(
    'post_type' => 'post',
    'category_name' => $cat
);

if (strlen($location) > 2) {
    
    if ($image_id) {
        echo '
<div class="blog-cover"> 
	<div class="blog-cover-bg"></div>
	<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />
	<h1 class="page-title">';
        $prefix = false;
        if (function_exists('is_tag') && is_tag()) {
            $prefix = true;
        } elseif (is_archive()) {
            wp_title(' ');
        } elseif (is_page()) {
            the_title();
        }
        echo '</h1>';
        
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
</div><!-- end .blog-cover -->';
    } else {    
        echo '
<div class="title-head"><h1>' . get_the_title() . '</h1></div>';
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
	<div id="page-right">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end #page-right -->
';
            echo '
	<div id="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end #sidebar-left -->';
            
            break;
        case "sidebar-full":
            echo '
	<div class="blog-full">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end .blog-full -->';
            break;
        
        case "sidebar-right":
            echo '
	<div id="page-left">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end .page-left -->';
            echo '
	<div id="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end #sidebar-right -->';
            break;
    }
    echo '
</div><!-- end #blog-fixed -->';
    
} else {
    require('start-page.php');
}

get_footer();
?>