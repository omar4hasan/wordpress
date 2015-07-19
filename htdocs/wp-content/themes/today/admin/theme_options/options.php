<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */


function optionsframework_option_name() {
    
    // This gets the theme name from the stylesheet (lowercase and without spaces)    
    if (function_exists('wp_get_theme')) {
        $theme_data = wp_get_theme('theme-name');
        $themename  = $theme_data->Name;
    } else {
        $theme_data = wp_get_theme(STYLESHEETPATH . '/style.css');
        $themename  = $theme_data['Name'];
    }
    $themename = preg_replace("/\W/", "", strtolower($themename));
    
    $optionsframework_settings       = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
     
    // Pull all the pages into an array
    $options_pages     = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }
    
    // If using image radio buttons, define a directory path
    $imagepath     = get_stylesheet_directory_uri() . '/admin/theme_options/images/';
    $imagecolor    = get_stylesheet_directory_uri() . '/admin/theme_options/images/color-style/';
    $imagepatterns = get_stylesheet_directory_uri() . '/admin/theme_options/images/patterns-style/';
    $imagelogo     = get_stylesheet_directory_uri() . '/images/logo.png';
    $imagefavicon  = get_stylesheet_directory_uri() . '/favicon.ico';
  
    $options[] = array(
        "name" => "General",
		"icon" => "general.png",
        "type" => "heading"
    );
	
    $options[] = array(
        "name" => "Logo",
        "desc" => "Maximum width:250px and height:100px.",
        "id" => "logo_upload",
        "std" => $imagelogo,
        "type" => "upload"
    );
    
    $options[] = array(
        "name" => "Favicon",
        "desc" => "Upload favicon, width:16px and height:16px.",
        "id" => "favicon_upload",
        "std" => $imagefavicon,
        "type" => "upload"
    );
	
    $options[] = array(
        "name" => "Responsive",
        "desc" => "Check the box to activate responsive site.",
        "id" => "responsive",
        "std" => "1",
        "type" => "checkbox"
    );
	
    $options[] = array(
        "name" => "Menu stays on top",
        "desc" => "Check the box to activate menu stays on top.",
        "id" => "top_menu",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Breaking News stays on top",
        "desc" => "Check the box to activate breaking news stays on top.",
        "id" => "top_news",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Search bar in Menu",
        "desc" => "Check the box to activate search bar in menu.",
        "id" => "active_search",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Copyright Text",
        "desc" => "Here you can write a text on Copyright.",
        "id" => "text_copyright",
        "std" => "",
        "type" => "textarea"
    );

    $options[] = array(
        "name" => "Style",
		"icon" => "style.png",
        "type" => "heading"
    );

	$options[] = array(
        "name" => "Theme Color",
        "desc" => "Choose a color for links and buttons.",
        "id" => "color_picker",
        "std" => "#e91b23",
        "type" => "color"
    );
    	
	$options[] = array(
        "name" => "Google Fonts",
        "desc" => "Please write the name of the font from this site http://www.google.com/fonts",
        "id" => "font_pred",
        "std" => "Open Sans",
        "type" => "text",
    );
    
    $options[] = array(
        "name" => "Background",
        "desc" => "Select the type of background.",
        "id" => "type_background",
        "std" => "pattern",
        "type" => "radio",
        "options" => array(
            'pattern' => 'Pattern',
            'image' => 'Image'
        )
    );
    
    $options[] = array(
        "name" => "Background Pattern",
        "desc" => "Choose a pattern for background.",
        "id" => "patterns",
        "std" => "clubber",
        "type" => "images",
        "options" => array(
            'clubber' => $imagepatterns . 's_clubber.png',
            'px_by_Gre3g' => $imagepatterns . 's_px_by_Gre3g.png',
            'random_grey_variations' => $imagepatterns . 's_random_grey_variations.png',
            'irongrip' => $imagepatterns . 's_irongrip.png',
            'darkdenim3' => $imagepatterns . 's_darkdenim3.png',
            'pinstriped_suit' => $imagepatterns . 's_pinstriped_suit.png',
            'tex2res4' => $imagepatterns . 's_tex2res4.png',
            'wild_oliva' => $imagepatterns . 's_wild_oliva.png'
        )
    );
    
    $options[] = array(
        "name" => "Background Image",
        "desc" => "",
        "id" => "background_upload",
        "type" => "upload"
    );
    
	    $options[] = array(
        "name" => "Template",
		"icon" => "template.png",
        "type" => "heading"
    );

    $options[] = array(
        "name" => "Slider for Homepage",
        "desc" => "Check the box to activate slider.",
        "id" => "active_slider",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Rotative Feature for Homepage",
        "desc" => "Check the box to activate rotative feature.",
        "id" => "active_feature",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Rotative Feature Number Posts",
        "desc" => "Enter number of posts here.",
        "id" => "feature_slideshow_number",
        "std" => "5",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Rotative Feature Slideshow Speed",
        "desc" => "Milliseconds between slideshow transitions.",
        "id" => "feature_slideshow",
        "std" => "3000",
        "type" => "text"
    );
		
	$options[] = array(
        "name" => "Breaking News",
        "desc" => "Check the box to activate breaking news.",
        "id" => "active_breaking",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Banner in Header",
        "desc" => "Check the box to activate banner in header.",
        "id" => "active_banner",
        "std" => "0",
        "type" => "checkbox"
    );

	$options[] = array(
        "name" => "Banner CODE",
        "desc" => "Enter your banner code.",
        "id" => "banner_code",
        "std" => "",
        "type" => "textarea"
    );
	
	$options[] = array(
        "name" => "Google Analytics CODE",
        "desc" => "Enter your Google Analytics or other tracking code here.",
        "id" => "analytics_code",
        "std" => "",
        "type" => "textarea"
    );
    
    $options[] = array(
        "name" => "Slider Large",
		"icon" => "slider.png",
        "type" => "heading"
    );
	
    $options[] = array(
        "name" => "Number of Slides",
        "desc" => "Enter number of slides here.",
        "id" => "slide_large_number",
        "std" => "5",
        "type" => "text"
    );
	
    $options[] = array(
        "name" => "Slideshow Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_large_slideshow",
        "std" => "5000",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Animation Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_large_animation",
        "std" => "300",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Navigation Control",
        "desc" => "Select on or off for navigation control.",
        "id" => "slide_large_control",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
	
	$options[] = array(
        "name" => "Navigation Direction",
        "desc" => "Select on or off for navigation direction.",
        "id" => "slide_large_direction",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
	
	$options[] = array(
        "name" => "Slider Up",
		"icon" => "slider.png",
        "type" => "heading"
    );

    $options[] = array(
        "name" => "Number of Slides",
        "desc" => "Enter number of slides here.",
        "id" => "slide_up_number",
        "std" => "5",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Slideshow Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_up_slideshow",
        "std" => "7000",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Animation Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_up_animation",
        "std" => "300",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Navigation Control",
        "desc" => "Select on or off for navigation control.",
        "id" => "slide_up_control",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
	
	$options[] = array(
        "name" => "Navigation Direction",
        "desc" => "Select on or off for navigation direction.",
        "id" => "slide_up_direction",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
	
	$options[] = array(
        "name" => "Slider Down",
		"icon" => "slider.png",
        "type" => "heading"
    );
	
    $options[] = array(
        "name" => "Number of Slides",
        "desc" => "Enter number of slides here.",
        "id" => "slide_down_number",
        "std" => "5",
        "type" => "text"
    );
	
    $options[] = array(
        "name" => "Slideshow Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_down_slideshow",
        "std" => "9000",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Animation Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_down_animation",
        "std" => "300",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => " Navigation Control",
        "desc" => "Select on or off for  navigation control.",
        "id" => "slide_down_control",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
	
	$options[] = array(
        "name" => "Navigation Direction",
        "desc" => "Select on or off for navigation direction.",
        "id" => "slide_down_direction",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );

    $options[] = array(
        "name" => "Photo (lightbox)",
		"icon" => "photo.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Animation Speed",
        "desc" => "Select slow, normal or fast for animation speed.",
        "id" => "photo_animation",
        "std" => "fast",
        "type" => "select",
        "options" => array(
            'slow' => 'Slow',
            'normal' => 'Normal',
            'fast' => 'Fast'
        )
    );
      
    $options[] = array(
        "name" => "Slideshow",
        "desc" => "Interval time in ms",
        "id" => "photo_slideshow",
        "std" => "5000",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Opacity",
        "desc" => "Value between 0 and 1.",
        "id" => "photo_opacity",
        "std" => "0.80",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Show Title",
        "desc" => "Select on or off for show title.",
        "id" => "photo_title",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Social Media",
        "desc" => "The social media icons are appearing.",
        "id" => "photo_social",
        "std" => "off",
        "type" => "radio",
        "options" => array(
            'on' => 'On',
            'off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Autoplay Videos",
        "desc" => "Automatically start videos.",
        "id" => "photo_videos",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Download Images",
        "desc" => "Select on or off for the possibility of image download.",
        "id" => "photo_download",
        "std" => "off",
        "type" => "radio",
        "options" => array(
            'on' => 'On',
            'off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Theme",
        "desc" => "Here you can select a theme for lightbox.",
        "id" => "photo_theme",
        "std" => "pp_default",
        "type" => "select",
        "options" => array(
            'pp_default' => 'Default',
            'light_rounded' => 'Light Rounded',
            'dark_rounded' => 'Dark Rounded',
            'light_square' => 'Light Squar',
            'dark_square' => 'Dark Square',
            'facebook' => 'Facebook'
        )
    );
    
    $options[] = array(
        "name" => "Social Media",
		"icon" => "social.png",
        "type" => "heading"
    );
    
	$options[] = array(
        "name" => "Icons Social Header",
        "desc" => "Check the box to activate social icons in header.",
        "id" => "social_header",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Icons Social Footer",
        "desc" => "Check the box to activate social icons in footer.",
        "id" => "social_footer",
        "std" => "0",
        "type" => "checkbox"
    );
	
    $options[] = array(
        "name" => "Facebook",
        "desc" => "Input facebook link.",
        "id" => "facebook",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Twitter",
        "desc" => "Input Twitter link.",
        "id" => "twitter",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Digg",
        "desc" => "Input Digg link.",
        "id" => "digg",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "YouTube",
        "desc" => "Input YouTube link.",
        "id" => "youtube",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Vimeo",
        "desc" => "Input Vimeo link.",
        "id" => "vimeo",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "RSS",
        "desc" => "Input RSS link.",
        "id" => "rss",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Google +",
        "desc" => "Input Google + link.",
        "id" => "google",
        "std" => "",
        "type" => "text"
    );
     
    $options[] = array(
        "name" => "Flickr",
        "desc" => "Input Flickr link.",
        "id" => "flickr",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "MySpace",
        "desc" => "Input MySpace link.",
        "id" => "my_space",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Soundcloud",
        "desc" => "Input Soundcloud link.",
        "id" => "soundcloud",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Custom CSS",
		"icon" => "custom.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Custom CSS",
        "desc" => "Paste in your custom css here. Please avoid altering the original css files as it'll cause problems when you update the theme. ",
        "id" => "custom_css",
        "std" => "",
        "type" => "textarea"
    );
    
    $options[] = array(
        "name" => "Contact",
		"icon" => "contact.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Email Address",
        "desc" => "Enter the email address where the email from the contact form should be sent to.",
        "id" => "email_adress",
        "std" => "my@email.com",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Subject",
        "desc" => "Enter the subject for messages that are sent via the contact form.",
        "id" => "email_subject",
        "std" => "contact form mail",
        "type" => "text"
    );
    
    return $options;
}