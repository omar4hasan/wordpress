	<div id="header-breaking">
		<h3><?php _e('breaking news', 'wizedesign'); ?></h3>
		<div class="header-breaking-text">
			<ul id="js-news" class="js-hidden"><?php
$news_nr   = of_get_option('breaking_nr');
$querynews       = array(
    'post_type' => 'post',
	'posts_per_page' => $news_nr,
	'orderby' => 'DATE'
); 
$wp_news = new WP_Query($querynews);
    while ($wp_news->have_posts()):
        $wp_news->the_post();
		global $post;
		$news   		= get_post_meta($post->ID, "post_news", true);
		if ($news == 'yes'){
echo '
				<li class="news-item"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

}
endwhile;
wp_reset_query();
?>

			</ul>
		</div><!-- end .header-breaking-text -->
<?php 
$social   = of_get_option('social_header', '1') == '1';
if ($social){
echo'
		<div class="header-social">
			<ul id="header-social">';
if (of_get_option('facebook') != "") {
echo'
				<li class="facebook header-social"><a href="http://'.of_get_option('facebook').'" target="_blank"></a></li>';
}
if (of_get_option('twitter') != "") {
echo'
				<li class="twitter header-social"><a href="http://'.of_get_option('twitter').'" target="_blank"></a></li>';
}
if (of_get_option('youtube') != "") {
echo'
				<li class="youtube header-social"><a href="http://'.of_get_option('youtube').'" target="_blank"></a></li>';
}
if (of_get_option('vimeo') != "") {
echo'
				<li class="vimeo header-social"><a href="http://'.of_get_option('vimeo').'" target="_blank"></a></li>';
}
if (of_get_option('flickr') != "") {
echo'
				<li class="flickr header-social"><a href="http://'.of_get_option('flickr').'" target="_blank"></a></li>';
}
if (of_get_option('digg') != "") {
echo'
				<li class="digg header-social"><a href="http://'.of_get_option('digg').'" target="_blank"></a></li>';
}
if (of_get_option('my_space') != "") {
echo'
				<li class="myspace header-social"><a href="http://'.of_get_option('my_space').'" target="_blank"></a></li>';
}
if (of_get_option('soundcloud') != "") {
echo'
				<li class="soundcloud header-social"><a href="http://'.of_get_option('soundcloud').'" target="_blank"></a></li>';
}
if (of_get_option('rss') != "") {
echo'
				<li class="rss header-social"><a href="http://'.of_get_option('rss').'" target="_blank"></a></li>';
}
if (of_get_option('google') != "") {
echo'
				<li class="google header-social"><a href="http://'.of_get_option('google').'" target="_blank"></a></li>';
}
echo'
			</ul>
		</div><!-- end .header-social -->
';	
}
?>
	</div><!-- end #header-breaking -->
