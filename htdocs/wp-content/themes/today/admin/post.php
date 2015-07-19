<?php
add_action('admin_menu', 'post_sidebar_load');
add_action('save_post', 'post_sidebar_save');
function post_sidebar_load() {
        add_meta_box('post_sidebar_load', __('Sidebar layout settings', 'wizedesign'), 'wz_post_sidebar', 'post', 'normal', 'core');
}
function wz_post_sidebar() {
    global $post;
    $layouts        = array(
        array(
            'icon' => 'sidebar-left.png',
            'name' => 'sidebar-left'
        ),
        array(
            'icon' => 'sidebar-full.png',
            'name' => 'sidebar-full'
        ),
        array(
            'icon' => 'sidebar-right.png',
            'name' => 'sidebar-right'
        )
    );
    $layout_default = 'sidebar-right';
    $wz_sidebar = null;
    $custom         = get_post_custom($post->ID);
    // Check if there is a setup layout
    if (array_key_exists('sidebar-layout', $custom)) {
        $wz_sidebar = $custom["sidebar-layout"][0];
    } else {
        $wz_sidebar = $layout_default;
    }
    echo '<div class="clearfix">';
    foreach ($layouts as $key => $layout) {
        $class = null;
        if ($wz_sidebar == $layout['name']) {
            $class = " active";
        } else {
            $class = null;
        }
        echo '<div style="background:url(' . get_template_directory_uri() . '/includes/images/' . $layout['icon'] . ') no-repeat;" class="wz-sidebar-post' . $class . '"  id="' . $layout['name'] . '" ></div>';
    }
    echo '</div>';
    echo '<input type="hidden" id="wz-sidebar-post" name="wz-sidebar-post" value="' . $wz_sidebar . '" />';
}

function post_sidebar_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $page = get_page( $post_ID );
    $post_status = get_post_status( $post_ID ); 
    if ( $page && "auto-draft" != $post_status ) {
    update_post_meta($post_ID, "sidebar-layout", $_POST["wz-sidebar-post"]);
    }

}

function post_sidebar_layout($default = "sidebar-right") {
    global $post;
    $item_meta = get_post_custom($post->ID); // get the item custom variables
    if (is_array($item_meta) && array_key_exists('sidebar-layout', $item_meta)) {
        $layout = $item_meta["sidebar-layout"][0];
        if ($layout != null) {
            $default = $layout;
        }
    }
    return $default;
}


add_action('admin_menu', 'post_slider_load');
add_action('save_post', 'post_slider_save');
function post_slider_load() {
        add_meta_box('post_slider_load', __('Slider settings', 'wizedesign'), 'wz_post_slider', 'post', 'normal', 'core');
}
function wz_post_slider() {
    global $post;
	$values 		= get_post_custom( $post->ID );
	$read 			= isset( $values['post_read'] ) ? esc_attr( $values['post_read'][0] ) : '';
	$link			= isset( $values['post_link'] ) ? esc_attr( $values['post_link'][0] ) : '';
	$text			= isset( $values['post_text'] ) ? esc_attr( $values['post_text'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    $layouts        = array(
        array(
            'icon' => 'slider-big.png',
            'name' => 'sliderbig'
        ),
        array(
            'icon' => 'slider-up.png',
            'name' => 'sliderup'
        ),
        array(
            'icon' => 'slider-down.png',
            'name' => 'sliderdown'
        ),
		array(
            'icon' => 'slider-none.png',
            'name' => 'slidernone'
        )
    );
    $layout_default = 'slidernone';
    $wz_page_layout = null;
    $custom         = get_post_custom($post->ID);
    // Check if there is a setup layout
    if (array_key_exists('slider-layout', $custom)) {
        $wz_page_layout = $custom["slider-layout"][0];
    } else {
        $wz_page_layout = $layout_default;
    }
    echo '<div class="clearfix">';
    foreach ($layouts as $key => $layout) {
        $class = null;
        if ($wz_page_layout == $layout['name']) {
            $class = " active";
        } else {
            $class = null;
        }
        echo '<div style="background:url(' . get_template_directory_uri() . '/includes/images/' . $layout['icon'] . ') no-repeat;" class="wz_slider' . $class . '"  id="' . $layout['name'] . '" ></div>';
    }
    echo '</div>';
    echo '<input type="hidden" id="wz_slider" name="wz_slider" value="' . $wz_page_layout . '" />';
?>	

	<p>
		<input type="checkbox" name="post_link" id="post_link" <?php checked( $link, 'yes' ); ?> />
		<label for="post_link">Hyperlink for slide</label>
	</p>
	<p>
		<input type="checkbox" name="post_read" id="post_read" <?php checked( $read, 'yes' ); ?> />
		<label for="post_read">Active "Read More"</label>
	</p>
	<p>
		<label for="post_youtube">Text for "Read More"</label>
		<input type="text" name="post_text" id="post_text" value="<?php echo $text; ?>" />
	</p>
	
<?php	
}

function post_slider_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $page = get_page( $post_ID );
    $post_status = get_post_status( $post_ID ); 
    if ( $page && "auto-draft" != $post_status ) {
    update_post_meta($post_ID, "slider-layout", $_POST["wz_slider"]);
    }
	
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['post_text'] ) )
		update_post_meta( $post_ID, 'post_text', wp_kses( $_POST['post_text'], $allowed ) );
		
	if( isset( $_POST['wz_slider'] ) )
		update_post_meta( $post_ID, 'wz_slider', wp_kses( $_POST['wz_slider'], $allowed ) );
		
	// This is purely my personal preference for saving checkboxes
	$chk_read = ( isset( $_POST['post_read'] ) && $_POST['post_read'] ) ? 'yes' : 'no';
	update_post_meta( $post_ID, 'post_read', $chk_read );
	
	$chk_link = ( isset( $_POST['post_link'] ) && $_POST['post_link'] ) ? 'yes' : 'no';
	update_post_meta( $post_ID, 'post_link', $chk_link );

}

function post_slider_layout($default = "slider-none") {
    global $post;
    $item_meta = get_post_custom($post->ID); // get the item custom variables
    if (is_array($item_meta) && array_key_exists('slider-layout', $item_meta)) {
        $layout = $item_meta["slider-layout"][0];
        if ($layout != null) {
            $default = $layout;
        }
    }
    return $default;
}

add_action( 'add_meta_boxes', 'post_settings_load' );
add_action( 'save_post', 'post_settings_save' );
function post_settings_load() {
	add_meta_box('post_settings_load', __('Post settings', 'wizedesign'), 'wz_post_settings', 'post', 'normal', 'high');
}

function wz_post_settings( $post ) {
	$values = get_post_custom( $post->ID );
	$feature 	= isset( $values['post_feature'] ) ? esc_attr( $values['post_feature'][0] ) : '';
	$cover 		= isset( $values['post_cover'] ) ? esc_attr( $values['post_cover'][0] ) : '';
	$gallery 	= isset( $values['post_gallery'] ) ? esc_attr( $values['post_gallery'][0] ) : '';
	$youtube 	= isset( $values['post_youtube'] ) ? esc_attr( $values['post_youtube'][0] ) : '';
	$vimeo 		= isset( $values['post_vimeo'] ) ? esc_attr( $values['post_vimeo'][0] ) : '';
	$news 		= isset( $values['post_news'] ) ? esc_attr( $values['post_news'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>	
	<p>
		<input type="checkbox" name="post_feature" id="post_feature" <?php checked( $feature, 'yes' ); ?> />
		<label for="post_feature">Prominent article feature</label>
	</p>
	<p>
		<input type="checkbox" name="post_cover" id="post_cover" <?php checked( $cover, 'yes' ); ?> />
		<label for="post_cover">Full width cover</label>
	</p>
	<p>
		<input type="checkbox" name="post_news" id="post_news" <?php checked( $news, 'yes' ); ?> />
		<label for="post_news">Breaking news</label>
	</p>
	<p>
		<input type="checkbox" name="post_gallery" id="post_gallery" <?php checked( $gallery, 'yes' ); ?> />
		<label for="post_gallery">Activate photo gallery</label>
	</p>
	<p>
		<label for="post_youtube">YouTube</label>
		<input type="text" name="post_youtube" id="post_youtube" value="<?php echo $youtube; ?>" />
		
		<label for="post_vimeo"> or Vimeo</label>
		<input type="text" name="post_vimeo" id="post_vimeo" value="<?php echo $vimeo; ?>" />
	</p>

	<?php	
}

function post_settings_save( $post_id ) {
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['post_youtube'] ) )
		update_post_meta( $post_id, 'post_youtube', wp_kses( $_POST['post_youtube'], $allowed ) );
		
	if( isset( $_POST['post_vimeo'] ) )
		update_post_meta( $post_id, 'post_vimeo', wp_kses( $_POST['post_vimeo'], $allowed ) );
		
		
	// This is purely my personal preference for saving checkboxes
	$chk_feature = ( isset( $_POST['post_feature'] ) && $_POST['post_feature'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'post_feature', $chk_feature );
	
	$chk_cover = ( isset( $_POST['post_cover'] ) && $_POST['post_cover'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'post_cover', $chk_cover );
	
	$chk_gallery = ( isset( $_POST['post_gallery'] ) && $_POST['post_gallery'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'post_gallery', $chk_gallery );
	
	$chk_gallery = ( isset( $_POST['post_news'] ) && $_POST['post_news'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'post_news', $chk_gallery );
}