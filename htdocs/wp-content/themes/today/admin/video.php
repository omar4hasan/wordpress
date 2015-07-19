<?php
$vimeo   = get_post_meta($post->ID, "post_vimeo", true);
$youtube = get_post_meta($post->ID, "post_youtube", true);

if ($vimeo) {
    echo '
			<div class="single-video">
				<iframe src="http://player.vimeo.com/video/' . $vimeo . '" width="650" height="380" frameborder="0" allowFullScreen></iframe>
			</div><!-- end .single-video -->
			';
}

if ($youtube) {
    echo '
			<div class="single-video">
				<iframe src="//www.youtube.com/embed/' . $youtube . '" width="650" height="380" frameborder="0" allowfullscreen></iframe>
			</div><!-- end .single-video -->
			';
}
?>