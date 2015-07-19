<?php
add_shortcode("blog5", "blog_five");

function blog_five($atts, $content) {
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
        $query     = array(
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => 1,
            'category_name' => $cat
        );
        $queryM    = array(
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => 2,
            'category_name' => $cat,
            'offset' => 1
        );
        $wp_query  = new WP_Query($query);
        $wp_queryM = new WP_Query($queryM);
    }
    $items_src .= '
<div id="short-five" class="fixed">';
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'short-five');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
        $vimeo    = get_post_meta($post->ID, "post_vimeo", true);
        $youtube  = get_post_meta($post->ID, "post_youtube", true);
        $items_src .= '	
	<div class="short-five-cover">
		<ul>
			<li class="sb-modern-skin">
				<div class="mediaholder">
					<div class="mediaholder_innerwrap">';
        if ($vimeo or $youtube) {
            $items_src .= '
						<div class="short-five-video"></div>';
        } else {
            $items_src .= '
						<div class="short-five-bg"></div>';
        }
        if ($image_id) {
            $items_src .= '
						<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
						<img src="' . $no_cover . '/images/no-cover/short-five.png" alt="no-cover" />';
        }
        $items_src .= '
					</div>
				</div>
				<div class="comment-bubble">
					<span class="comment-count">' . get_comments_number() . '</span>
				</div>		
				<div class="slider-left-cat">' . $category[0]->cat_name . '</div>
				<div class="detailholder"><span>' . get_the_date('F jS, Y') . '</span>
					<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
					<p class="excerpt">' . get_excerpt(530) . '<a href="' . get_permalink() . '"><span class="short-five-link">' . __('Read more', 'wizedesign') . '</span></a></p>
				</div>
			</li>
		</ul>
	</div><!-- end .short-five-cover -->';
    endwhile;
    
    while ($wp_queryM->have_posts()):
        $wp_queryM->the_post();
        global $post;
        $image_id  = get_post_thumbnail_id();
        $coverM    = wp_get_attachment_image_src($image_id, 'short-fiveM');
        $categoryM = get_the_category();
        $vimeo     = get_post_meta($post->ID, "post_vimeo", true);
        $youtube   = get_post_meta($post->ID, "post_youtube", true);
        $items_src .= '	
	<div class="short-five-coverM">
		<ul>
			<li class="sb-modern-skin">
				<div class="mediaholder">
					<div class="mediaholder_innerwrap">';
        if ($vimeo or $youtube) {
            $items_src .= '
						<div class="short-five-videoM"></div>';
        } else {
            $items_src .= '
						<div class="short-five-bg"></div>';
        }
        if ($image_id) {
            $items_src .= '
						<img src="' . $coverM[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
						<img src="' . $no_cover . '/images/no-cover/short-fiveM.png" alt="no-cover" />';
        }
        $items_src .= '
					</div>
				</div>
				<div class="comment-bubble">
					<span class="comment-count">' . get_comments_number() . '</span>
				</div>';
        $items_src .= '	
				<div class="detailholder"><span>' . get_the_date('F jS, Y') . '</span>
					<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
					<p class="excerpt">' . get_excerpt(70) . '<a href="' . get_permalink() . '"><span class="short-five-link">' . __('Read more', 'wizedesign') . '</span></a></p>
				</div>
			</li>
		</ul>
	</div><!-- end .short-five-coverM -->';
    endwhile;
    wp_reset_query();
    $items_src .= '
</div><!-- end #short-five -->
';
    return $items_src;
}