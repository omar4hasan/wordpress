<?php
$numberbig  = of_get_option('slide_large_number');
$numberup   = of_get_option('slide_up_number');
$numberdown = of_get_option('slide_down_number');
$argsbig = array(
    'posts_per_page' => $numberbig,
	'meta_key' => 'wz_slider',
	'meta_value' => 'sliderbig',
    'order' => 'DESC',
    'orderby' => 'DATE',
    'category_name' => $cat
);
$argsup = array(
    'posts_per_page' => $numberup,
	'meta_key' => 'wz_slider',
	'meta_value' => 'sliderup',
    'order' => 'DESC',
    'orderby' => 'DATE',
    'category_name' => $cat
);
$argsdown = array(
    'posts_per_page' => $numberdown,
	'meta_key' => 'wz_slider',
	'meta_value' => 'sliderdown',
    'order' => 'DESC',
    'orderby' => 'DATE',
    'category_name' => $cat
);
$wp_sliderbig  = new WP_Query($argsbig); 
$wp_sliderup   = new WP_Query($argsup); 
$wp_sliderdown = new WP_Query($argsdown); 
echo '
<div id="slider">
	<div id="slider-left">
		<div class="flexslider" id="sld-left">
			<ul class="slides">';
    while ($wp_sliderbig->have_posts()):
           $wp_sliderbig->the_post();
    $slider_layout = post_slider_layout();
    $category      = get_the_category();
    $image_id      = get_post_thumbnail_id();
    $slider_left   = wp_get_attachment_image_src($image_id, 'slider-left');
    $link          = get_post_meta($post->ID, "post_link", true) == 'yes';
    $read          = get_post_meta($post->ID, "post_read", true) == 'yes';
    $text          = get_post_meta($post->ID, "post_text", true);
    $no_cover      = get_template_directory_uri();
            echo '
				<li>';
            if ($link) {
                echo '
					<a href="' . get_permalink() . '">';
            }
            echo '<div class="slider-left-bg"></div>';
            if ($link) {
                echo '</a>';
            }
            if ($image_id) {
                echo '
					<img src="' . $slider_left[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
					<img src="' . $no_cover . '/images/no-cover/slider-left.png" alt="no-cover" />';
            }
            
            if ($cat != null) {
            } else {
                echo '
					<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
            }
            echo '
					<div class="slider-left-date">
						<div class="slider-left-day">' . get_the_date('d') . '</div>
						<div class="slider-left-month">' . get_the_date('M') . ' ' . get_the_date('Y') . '</div>
					</div>
					<a href="' . get_permalink() . '"><div class="slider-left-title">' . get_the_title() . '</div></a>
					<div class="slider-left-des">' . get_excerpt(160) . '</div>';
            if ($read) {
                if ($link) {
                } else {
                    if ($text) {
                        echo '
					<a href="' . get_permalink() . '"><p class="slider-right">' . $text . '</p></a>';
                    } else {
                        echo '
					<a href="' . get_permalink() . '"><p class="slider-right">' . __('Read more', 'wizedesign') . '</p></a>';
                    }
                }
            }
            echo '
				</li>';
endwhile;

echo '
			</ul>
		</div>
	</div><!-- end #slider-left -->
	<div id="slider-right-top">
		<div class="flexslider" id="sld-rightT">
			<ul class="slides">';
    while ($wp_sliderup->have_posts()):
           $wp_sliderup->the_post();
    $slider_layout = post_slider_layout();
    $category      = get_the_category();
    $image_id      = get_post_thumbnail_id();
    $slider_left   = wp_get_attachment_image_src($image_id, 'slider-right');
    $link          = get_post_meta($post->ID, "post_link", true) == 'yes';
    $read          = get_post_meta($post->ID, "post_read", true) == 'yes';
    $text          = get_post_meta($post->ID, "post_text", true);
    $no_cover      = get_template_directory_uri();
            echo '
				<li>';
            if ($link) {
                echo '
					<a href="' . get_permalink() . '">';
            }
            echo '<div class="slider-right-bg"></div>';
            if ($link) {
                echo '</a>';
            }
            if ($image_id) {
                echo '
					<img src="' . $slider_left[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
					<img src="' . $no_cover . '/images/no-cover/slider-right.png" alt="no-cover" />';
            }
            
            if ($cat != null) {
            } else {
                echo '
					<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
            }
            echo '
					<div class="slider-right-date">
						<div class="slider-left-day">' . get_the_date('d') . '</div>
						<div class="slider-left-month">' . get_the_date('M') . ' ' . get_the_date('Y') . '</div>
					</div>
					<a href="' . get_permalink() . '"><div class="slider-right-title">' . get_the_title() . '</div></a>
					<div class="slider-right-des">' . get_excerpt(110) . '</div>';
            if ($read) {
                if ($link) {
                } else {
                    if ($text) {
                        echo '
					<a href="' . get_permalink() . '"><p class="slider-right">' . $text . '</p></a>';
                    } else {
                        echo '
					<a href="' . get_permalink() . '"><p class="slider-right">' . __('Read more', 'wizedesign') . '</p></a>';
                    }
                }
            }
            echo '
				</li>';
endwhile;

echo '
			</ul>
		</div>
	</div><!-- end #slider-right-top -->
	<div id="slider-right-bottom">
		<div class="flexslider" id="sld-rightB">
			<ul class="slides">';
    while ($wp_sliderdown->have_posts()):
           $wp_sliderdown->the_post();
    $slider_layout = post_slider_layout();
    $category      = get_the_category();
    $image_id      = get_post_thumbnail_id();
    $slider_left   = wp_get_attachment_image_src($image_id, 'slider-right');
    $link          = get_post_meta($post->ID, "post_link", true) == 'yes';
    $read          = get_post_meta($post->ID, "post_read", true) == 'yes';
    $text          = get_post_meta($post->ID, "post_text", true);
    $no_cover      = get_template_directory_uri();
            echo '
				<li>';
            if ($link) {
                echo '
					<a href="' . get_permalink() . '">';
            }
            echo '<div class="slider-right-bg"></div>';
            if ($link) {
                echo '</a>';
            }
            if ($image_id) {
                echo '
					<img src="' . $slider_left[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
					<img src="' . $no_cover . '/images/no-cover/slider-right.png" alt="no-cover" />';
            }
            
            if ($cat != null) {
            } else {
                echo '
					<div class="slider-left-cat">' . $category[0]->cat_name . '</div>';
            }
            echo '
					<div class="slider-right-date">
						<div class="slider-left-day">' . get_the_date('d') . '</div>
						<div class="slider-left-month">' . get_the_date('M') . ' ' . get_the_date('Y') . '</div>
					</div>
					<a href="' . get_permalink() . '"><div class="slider-right-title">' . get_the_title() . '</div></a>
					<div class="slider-right-des">' . get_excerpt(110) . '</div>';
            if ($read) {
                if ($link) {
                } else {
                    if ($text) {
                        echo '
					<a href="' . get_permalink() . '"><p class="slider-right">' . $text . '</p></a>';
                    } else {
                        echo '
					<a href="' . get_permalink() . '"><p class="slider-right">' . __('Read more', 'wizedesign') . '</p></a>';
                    }
                }
            }
            echo '
				</li>';
endwhile;

echo '
			</ul>
		</div>
	</div><!-- end #slider-right-bottom -->
</div><!-- end #slider -->';
?> 