<?php
get_header();

$page_layout = page_sidebar_layout();
$aut = get_the_author_ID();
$query       = array(
    'post_type' => 'post',
	'author' => $aut,
    'paged' => $paged
);

echo '
<div class="blog-fixed">
	<div id="blog-right">
';

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" . $curauth->ID . "' AND post_type = 'post' AND post_status = 'publish'");
$comment_count = $wpdb->get_var("SELECT COUNT(*) AS total FROM {$wpdb->comments} ");	
$wp_query = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        $wp_query->the_post();
		global $post;
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'short-one');
		$no_cover = get_template_directory_uri();
        $category = get_the_category();
		$vimeo    = get_post_meta($post->ID, "post_vimeo", true);
        $youtube  = get_post_meta($post->ID, "post_youtube", true);
		$author   = get_the_author_meta('ID');
        echo '
	<div class="bl2page-archive">
		<div class="bl2page-cover">';
	        if ($vimeo or $youtube) {
                echo '
			<a href="' . get_permalink() . '"><div class="short-one-video"></div></a>';
            }
			if ($image_id) {
                echo '
			<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
            } else {
                echo '
			<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/short-one.png" alt="no-cover" /></a>';
            }
            if ($cat != null) {
            } else {
                echo '		
			<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
            }
            echo '
			<div class="comment-bubble">
				<span class="comment-count">' . get_comments_number() . '</span>
			</div>
		</div>';
        echo '
		<h2 class="bl2page-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>
		<div class="bl2page-info">' . get_the_time('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a></div>';
		echo ''.get_excerpt(230).'';
        echo '
    </div><!-- end .bl2page-archive -->
';
    endwhile;

if (function_exists("pagination_wz")) {
    pagination_wz();
}
?>	

<div class="display-none">
		<?php posts_nav_link(); ?>
		<?php the_post_thumbnail(); ?>
	 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>></div>
</div>

<?php	
echo '
	</div><!-- end .blog(left&full&right) -->

<div id="sidebar-left">

	<div class="author-info">
	'.wp_link_pages().'
		<div class="author-avatar">';
			echo get_avatar( get_the_author_meta( 'ID' ), 60 );
			echo'
			<p>'.$curauth->display_name.'</p>
			<p>'.$post_count.' ' . __('posts', 'wizedesign') . '</p>
			<p>' . $comment_count . ' ' . __('comments', 'wizedesign') . '</p>
		</div>
		<div class="author-description">
		<p>'.$curauth->description.'</p>
		<p><a href="'.$curauth->user_url.'" target="_blank">'.$curauth->user_url.'</a></p>
		</div>
	</div><!-- end .author-info -->

</div><!-- end .sidebar-left -->
</div><!-- end .blog-fixed -->';

get_footer(); 
?>