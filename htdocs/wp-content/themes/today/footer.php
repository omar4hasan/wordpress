</div><!-- end #wrap -->

<!-- Footer -->
<div id="footer">
	<div class="footer-row fixed">
<?php
wz_setSection('zone-footer');
?>
		<div class="footer-col">
<?php
wz_setZone(310);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-left'));
?>
    
		</div><!-- end .footer-col -->	
		
		<div class="footer-col">
<?php
wz_setZone(310);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-center'));
?>
    
		</div><!-- end .footer-col -->	
		
		<div class="footer-col">
<?php
wz_setZone(310);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-right'));
?>

		</div><!-- end .footer-col -->		
	</div><!-- end .footer-row fixed -->			
</div><!-- end #footer -->

<div class="footer-bottom"> 
	<div class="footer-row">
		<div class="footer-bottom-copyright"><?php
$the_year = date("Y");
if (of_get_option("text_copyright") != '') {
    echo ''.of_get_option('text_copyright').'';
	} else {
		echo '
			&copy; ' .$the_year. ' ';
			bloginfo('name');
		echo '. ' . __('All Rights Reserved.', 'wizedesign') . ''; 

	}
?>

		</div><!-- end .footer-bottom-copyright -->
<?php
$social   = of_get_option('social_footer', '1') == '1';
if ($social){
echo'
		<div class="footer-bottom-social">
			<ul id="footer-social">';
        
if (of_get_option('facebook') != "") {
echo'
				<li class="facebook footer-social"><a href="http://'.of_get_option('facebook').'" target="_blank"></a></li>';
}
if (of_get_option('twitter') != "") {
echo'
				<li class="twitter footer-social"><a href="http://'.of_get_option('twitter').'" target="_blank"></a></li>';
}
if (of_get_option('youtube') != "") {
echo'
				<li class="youtube footer-social"><a href="http://'.of_get_option('facebook').'" target="_blank"></a></li>';
}
if (of_get_option('vimeo') != "") {
echo'
				<li class="vimeo footer-social"><a href="http://'.of_get_option('youtube').'" target="_blank"></a></li>';
}
if (of_get_option('flickr') != "") {
echo'
				<li class="flickr1 footer-social"><a href="http://'.of_get_option('flickr').'" target="_blank"></a></li>';
}
if (of_get_option('digg') != "") {
echo'
				<li class="digg footer-social"><a href="http://'.of_get_option('digg').'" target="_blank"></a></li>';
}
if (of_get_option('my_space') != "") {
echo'
				<li class="myspace footer-social"><a href="http://'.of_get_option('my_space').'" target="_blank"></a></li>';
}
if (of_get_option('soundcloud') != "") {
echo'
				<li class="soundcloud footer-social"><a href="http://'.of_get_option('soundcloud').'" target="_blank"></a></li>';
}
if (of_get_option('rss') != "") {
echo'
				<li class="rss footer-social"><a href="http://'.of_get_option('rss').'" target="_blank"></a></li>';
}
if (of_get_option('google') != "") {
echo'
				<li class="google footer-social"><a href="http://'.of_get_option('google').'" target="_blank"></a></li>';
}
}
?>

			</ul>
		</div><!-- end .footer-bottom-social -->
	</div><!-- end .footer-row -->
</div><!-- end .footer-bottom -->


<?php
require('js/JSscript.php');
require('js/JSprettyPhoto.php');
?>

<?php wp_footer(); ?>

</body>
</html>