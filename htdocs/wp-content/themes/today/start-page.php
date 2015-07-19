<?php
$slider   = of_get_option('active_slider', '1') == '1';
$feature   = of_get_option('active_feature', '1') == '1';
$page_layout   = page_sidebar_layout();


if ($slider) {
	require('slider.php');
    }
	
if ($feature) {	
	require('feature.php');
	}

switch ($page_layout) {

	case "sidebar-left":

            echo '
<div class="home-fixed">
	<div id="content-right">
';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end #content-right -->
	
	<div id="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end #sidebar-left -->
</div><!-- end .home-fixed -->';
	break;
	
	case "sidebar-full":
            echo '
<div class="home-fixed">
';
			if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;	
	
            echo '
</div><!-- end .home-fixed -->';
echo 'full';
	break;

	case "sidebar-right":
	
            echo '
<div class="home-fixed">
	<div id="content-left">
';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end #content-right -->

	<div id="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end #sidebar-right -->
</div><!-- end .home-fixed -->';
	break;

}