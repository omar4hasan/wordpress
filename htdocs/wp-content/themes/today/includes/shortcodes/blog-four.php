<?php
add_shortcode("blog4", "blog_four");

function blog_four($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 4,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "DATE",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query          = array(
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'category_name' => $cat
        );
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
<div id="short-four" class="fixed">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'short-four');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
        $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
        $youtube  = get_post_meta($post->ID, "post_youtube", true);
		$author   = get_the_author_meta('ID');
        $items_src .= '
	<div class="short-four-art">
		<div class="short-four-cover">';
        if ($vimeo or $youtube) {
            $items_src .= '
			<a href="' . get_permalink() . '"><div class="short-four-video"></div></a>';
        }
        if ($image_id) {
            $items_src .= '
			<a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
        } else {
            $items_src .= '
			<a href="' . get_permalink() . '"><img src="' . $no_cover . '/images/no-cover/short-two.png" alt="no-cover" /></a>';
        }
        $items_src .= '
			<div class="comment-bubble">
				<span class="comment-count">' . get_comments_number() . '</span>
			</div>';
        if ($cat != null) {
        } else {
            $items_src .= '		
			<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
        }
        $items_src .= '
		</div>
		<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
		<div class="short-four-info">' . get_the_date('F jS, Y') . ' | by <a href="' . get_author_posts_url($author) . '">' . get_the_author() . '</a></div>
		' . get_excerpt(130) . '
	</div><!-- end #short-four-art -->';
    endwhile;
    wp_reset_query();
    $items_src .= '
</div><!-- end #short-four -->
';
    return $items_src;
}