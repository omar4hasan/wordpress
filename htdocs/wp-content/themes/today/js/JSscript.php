<?php
$type = of_get_option('type_background');
$image = of_get_option('background_upload');
$google = of_get_option('analytics_code');
$feat_slideshow = of_get_option('feature_slideshow');
$sld_large_slideshow = of_get_option('slide_large_slideshow');
$sld_large_animation = of_get_option('slide_large_animation');
$sld_large_control = of_get_option('slide_large_control');
$sld_large_direction = of_get_option('slide_large_direction');
$sld_up_slideshow = of_get_option('slide_up_slideshow');
$sld_up_animation = of_get_option('slide_up_animation');
$sld_up_control = of_get_option('slide_up_control');
$sld_up_direction = of_get_option('slide_up_direction');
$sld_down_slideshow = of_get_option('slide_down_slideshow');
$sld_down_animation = of_get_option('slide_down_animation');
$sld_down_control = of_get_option('slide_down_control');
$sld_down_direction = of_get_option('slide_down_direction');
$menu   = of_get_option('top_menu', '1') == '1';
$news   = of_get_option('top_news', '1') == '1';

echo '
<script type="text/javascript">
jQuery(document).ready(function ($) {';
switch ($type ) {
		 case "image": 
	echo '
	
	$.backstretch("'.$image.'");
	';
break;
}

	echo '
	$("#sld-left").flexslider({
		controlNav: '.$sld_large_control.',
		directionNav: '.$sld_large_direction.',
		pauseOnHover: true,
		keyboardNav: false,
		slideshowSpeed: '.$sld_large_slideshow.',
		animationSpeed: '.$sld_large_animation.',
		start: function (slider) {
			slider.removeClass("loading");
		}
	});
				
	$("#sld-rightT").flexslider({
		controlNav: '.$sld_up_control.',
		directionNav: '.$sld_up_direction.',
		pauseOnHover: true,
		keyboardNav: false,
		slideshowSpeed: '.$sld_up_slideshow.',
		animationSpeed: '.$sld_up_animation.',
		start: function (slider) {
			slider.removeClass("loading");
		}
	});
				
	$("#sld-rightB").flexslider({
		controlNav: '.$sld_down_control.',
		directionNav: '.$sld_down_direction.',
		pauseOnHover: true,
		keyboardNav: false,
		slideshowSpeed: '.$sld_down_slideshow.',
		animationSpeed: '.$sld_down_animation.',
		start: function (slider) {
			slider.removeClass("loading");
		}
	});
				
	$("#feat-carousel").flexslider({
		animation: "slide",
		controlNav: false,
		pauseOnHover: true,
		keyboardNav: false,
		itemWidth: 259,
		slideshowSpeed: '.$feat_slideshow.',
		animationLoop: true,
		itemMargin: 3
	});
				
	$("#js-news").ticker({
		speed: 0.10,       
        controls: false,     
        titleText: ""
	});';
	
	if ($menu) {
	echo '
	var stickyHeaderMENU = $("#menu").offset().top;
	$(window).scroll(function(){
		if( $(window).scrollTop() > stickyHeaderMENU ) {
			$("#menu").css({position: "fixed", top: "0px" });
			$("#none").css("display", "block");
		} else {
			$("#menu").css({position: "static", top: "100px"});
			$("#none").css("display", "none");
		}
	});';
	}
	
	if ($news) {
	echo '
	var stickyHeaderNEWS = $("#header-breaking").offset().top;
	$(window).scroll(function(){
		if( $(window).scrollTop() > stickyHeaderNEWS ) {
			$("#header-breaking").css({position: "fixed", top: "49px" });
			$("#none").css("display", "block");
		} else {
			$("#header-breaking").css({position: "static", top: "0px"});
			$("#none").css("display", "none");
		}
	});';
	}
echo '			
});
</script>'; 

if ($google) {
echo '

<!-- Google analytics -->
';

echo $google;
}




?>