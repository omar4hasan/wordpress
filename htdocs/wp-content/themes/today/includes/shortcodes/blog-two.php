<?php
add_shortcode("blog2", "blog_two");

function blog_two($atts, $content) {
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
<div id="short-two" class="fixed">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'short-two');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
        $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
        $youtube  = get_post_meta($post->ID, "post_youtube", true);
        $items_src .= '
	<div class="short-two-art">
		<ul>
			<li class="sb-modern-skin">
				<div class="mediaholder">
					<div class="mediaholder_innerwrap">';
        if ($vimeo or $youtube) {
            $items_src .= '
						<div class="short-two-video"></div>';
        } else {
            $items_src .= '
						<div class="short-two-bg"></div>';
        }
        if ($image_id) {
            $items_src .= '
						<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
						<img src="' . $no_cover . '/images/no-cover/short-two.png" alt="no-cover" />';
        }
        $items_src .= '
					</div>
				</div>';
        if ($cat != null) {
        } else {
            $items_src .= '		
				<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
        }
        $items_src .= '			
				<div class="comment-bubble">
					<span class="comment-count">' . get_comments_number() . '</span>
				</div>
				<div class="detailholder">
					<span> ' . get_the_date('F jS, Y') . '</span>
					<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
					<p class="excerpt">' . get_excerpt(130) . '<a href="' . get_permalink() . '"><span class="short-two-link">' . __('Read more', 'wizedesign') . '</span></a></p>
				</div>
			</li>
		</ul>
	</div><!-- end .short-two-art -->';
    endwhile;
    wp_reset_query();
    $items_src .= '
</div><!-- end #short-two -->
';
    return $items_src;
}