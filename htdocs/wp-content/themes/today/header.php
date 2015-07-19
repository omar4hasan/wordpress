<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- ### BEGIN HEAD ####  -->
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Title -->
<title><?php 
	$prefix = false;
		
		 if (function_exists('is_tag') && is_tag()) {
			single_tag_title('Tag Archive for &quot;'); 
			echo '&quot; - '; 
			
			$prefix = true;
		 } elseif (is_archive()) {
			
			wp_title(''); echo ' '.__('Archive').' - '; 
			$prefix = true;
			
		 } elseif (is_search()) {
			
			echo __('Search for', 'clubber').' &quot;'.wp_specialchars($s).'&quot; - '; 
			$prefix = true;
			
		 } elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title(''); 
				echo '  ';
		 } elseif (is_404()) {
			echo __('Not Found', 'clubber').' - ';
		 }
		 
		 if (is_home()) {
			bloginfo('name'); echo ' - '; bloginfo('description');
		 } else {
		  bloginfo('name');
		 }
		 
		 if ($paged > 1) {
			echo ' - page '. $paged; 
		 }
	?></title>

<!-- Favicon -->
<?php 
		if (of_get_option('favicon_upload','true') == 'true'){					
		    } else {
                if (of_get_option('favicon_upload',null) != null) {
					$favicon_url = of_get_option('favicon_upload');
                    } else {
                    $favicon_url = get_template_directory_uri().'/favicon.ico';
                    }
                echo '<link rel="shortcut icon" href="'.$favicon_url.'" />';
            }
?>


<!-- Wordpress functions -->	
<?php wp_head(); ?>


</head>

<!-- Begin Body -->
<body  <?php body_class(); ?>> 

<!-- Header -->
<div id="header"> 			
	<div class="header-row fixed">		
		<div id="logo"><?php 
		if (of_get_option('logo_upload','true') == 'true'){					
		    } else {
                if (of_get_option('logo_upload',null) != null){
                    $logo_url = of_get_option('logo_upload');
                    } else {
                    $logo_url = get_template_directory_uri().'/_layout/images/logo.png';
                    }		
                echo '
			<a href="'.get_bloginfo('url').'"><img src="'.$logo_url.'" alt="logo" /></a>';
            }
?>

		</div><!-- end #logo -->
<?php 	
$banner   = of_get_option('active_banner', '1') == '1';
if ($banner) {
    require('banner.php');
}	
?>

	</div>    
</div><!-- end #header -->

<div id="header-main">
    <div id="menu">
		<div class="menu-navigation">
				<?php 
                    wp_nav_menu(array(
						'menu' => 'Main Menu', 
						'container_id' => 'wizemenu', 
						'walker' => new CSS_Menu_Maker_Walker()
					)); 
                ?>	
		</div><!-- end .menu-navigation -->
		
<?php 	
$search   = of_get_option('active_search', '1') == '1';
if ($search) {
?>
		<div id="menu-search"> 
			<form id="searchform" method="get">
                <div>
                    <input type="text" name="s" id="searchinput" value="Search here ..." onblur="if (this.value == '') {this.value = 'Search here ...';}" onfocus="if (this.value == 'Search here ...') {this.value = '';}"/>
                    <input type="submit" class="button1" id="search-button" value="" />                         
                </div>
			</form>
		</div><!-- end #menu-search -->
<?php 
}
?>
    </div><!-- end #menu -->

<?php 	
$breaking   = of_get_option('active_breaking', '1') == '1';
 if ($breaking) {
    require('breaking-news.php');
}
?>
</div><!-- end #header-main -->

<!-- Wrap -->
<div id="wrap">