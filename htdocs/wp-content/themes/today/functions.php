<?php

/*** FUNCTIONS
 ****************************************************************/
include('includes/functions-comment.php');
include('includes/functions-setup.php');
include('includes/functions-menu.php');
include('includes/functions-sidebar.php');

/*** ADMIN POSTS
 ****************************************************************/
include('admin/options.php');
include('admin/post.php');
include('admin/page.php');
include('admin/photo.php');

/*** WIDGETS
 ****************************************************************/
include('includes/widgets/widget-twitter.php');
include('includes/widgets/widget-flickr.php');
include('includes/widgets/widget-soundcloud.php');
include('includes/widgets/blog-one.php');
include('includes/widgets/blog-two.php');
include('includes/widgets/blog-three.php');

/*** SHORTCODES
 ****************************************************************/
include('includes/shortcodes/blog-one.php');
include('includes/shortcodes/blog-two.php');
include('includes/shortcodes/blog-three.php');
include('includes/shortcodes/blog-four.php');
include('includes/shortcodes/blog-five.php');
include('includes/shortcodes/shortcode.php');
include('includes/shortcodes/soundcloud.php');

/*** ENQUEUE SCRIPT & STYLE
 ****************************************************************/
add_action('wp_enqueue_scripts', 'wizedesign_load_javascript');
add_action('init', 'loadSetupReference');
function wizedesign_load_javascript() {
	$respon   = of_get_option('responsive', '1') == '1';
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/flexslider.js', array('jquery'), false, true);
    wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/prettyPhoto.js', array('jquery'), false, true);
    wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/backstretch.js', array('jquery'), false, true);
    wp_enqueue_script('ticker', get_template_directory_uri() . '/js/ticker.js', array('jquery'), false, true);
    wp_enqueue_script('rotator', get_template_directory_uri() . '/js/rotator.js', array('jquery'), false, true);
    wp_enqueue_script('idTabs', get_template_directory_uri() . '/js/idTabs.js', array('jquery'), false, true);
	if ($respon){
	wp_enqueue_script('slicknav', get_template_directory_uri() . '/js/slicknav.js', array('jquery'), false, true);
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), false, true);
	}
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true);
}

function loadSetupReference() {
    $protocol = is_ssl() ? 'https' : 'http';
    $font     = of_get_option('font_pred');
	$respon   = of_get_option('responsive', '1') == '1';
    if (is_admin()) {
		wp_enqueue_script('jquery');
        wp_enqueue_style('options-panel', get_template_directory_uri() . '/admin/post/css/options-panel.css');
		wp_enqueue_script('ui-custom-js', get_template_directory_uri() . '/admin/post/js/ui-custom.js');
        wp_enqueue_script('setup-js', get_template_directory_uri() . '/admin/post/js/setup.js');
    } else {
        wp_enqueue_script('jquery');
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_style('options', get_template_directory_uri() . '/css/css_options.php');
        wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
        wp_enqueue_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css');
        wp_enqueue_style('shortcodes-blog', get_template_directory_uri() . '/css/shortcodes-blog.css');
        wp_enqueue_style('slider', get_template_directory_uri() . '/css/slider.css');
        wp_enqueue_style('feature', get_template_directory_uri() . '/css/feature.css');
		wp_enqueue_style('slicknav', get_template_directory_uri() . '/css/slicknav.css');
		if ($respon){	
		wp_enqueue_style('respond', get_template_directory_uri() . '/css/respond.css');
		}
        wp_enqueue_style('font', "$protocol://fonts.googleapis.com/css?family=$font:400,700,900,300");
    }
}

/*** EXCERPT
 ****************************************************************/
function custom_excerpt_length($length) {
    return 45;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
function new_excerpt_more($excerpt) {
    return str_replace('...', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');
function the_excerpt_max_event($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    if (mb_strlen($excerpt) > $charlength) {
        $subex   = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut   = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}
function the_excerpt_max($charlength) {
    $items_src = null;
    $excerpt   = get_the_excerpt();
    $charlength++;
    if (mb_strlen($excerpt) > $charlength) {
        $subex   = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut   = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            $items_src .= ' ' . mb_substr($subex, 0, $excut) . ' ';
            $items_src .= '...';
            return $items_src;
        } else {
            return $subex;
        }
    } else {
        return $excerpt;
    }
}

function get_excerpt($limit, $source = null) { 
    if ($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

/*** PAGE NAVIGATION
 ****************************************************************/

function pagination_wz($pages = '', $range = 5) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo '
	<div class="pagination-bottom">
	<div class="pagination-pos">';
        
        echo "<div class=\"pagination\">";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";
        echo "</div>\n";
        echo '	
    </div>
    </div><!-- end .pagination-pos -->';
    }
}

/*** TAGCLOUD FONT SIZE
 ****************************************************************/
add_filter('widget_tag_cloud_args', 'wz_tag_cloud_filter', 90);
function wz_tag_cloud_filter($args = array()) {
    $args['smallest'] = 14;
    $args['largest']  = 14;
    $args['unit']     = 'px';
    return $args;
}

/*** SHORT TITLE
 ****************************************************************/
function ShortTitle($text) {
    $chars_limit = 53;
    $chars_text  = strlen($text);
    $text        = $text . " ";
    $text        = substr($text, 0, $chars_limit);
    $text        = substr($text, 0, strrpos($text, ' '));
    if ($chars_text > $chars_limit) {
        $text = $text . "...";
    }
    return $text;
}

/*** LANGUAGES poEDIT
 ****************************************************************/
function theme_init(){
    load_theme_textdomain('wizedesign', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

?>