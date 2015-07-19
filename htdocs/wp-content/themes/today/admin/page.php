<?php

add_action('admin_menu', 'page_sidebar_load');
add_action('save_post', 'page_sidebar_save');
function page_sidebar_load() {
        add_meta_box('page_sidebar_load', __('Sidebar layout settings', 'wizedesign'), 'wz_page_sidebar', 'page', 'normal', 'high');
}
function wz_page_sidebar() {
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


function page_sidebar_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $page = get_page( $post_ID );
    $post_status = get_post_status( $post_ID ); 
    if ( $page && "auto-draft" != $post_status ) {
    update_post_meta($post_ID, "sidebar-layout", $_POST["wz-sidebar-post"]);
    }

}

function page_sidebar_layout($default = "sidebar-right") {
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


add_action( 'add_meta_boxes', 'page_settings_load' );
add_action( 'save_post', 'page_settings_save' );
function page_settings_load()
{
	add_meta_box('page_settings_load', __('Page settings for Blog Style', 'wizedesign'), 'wz_page_settings', 'page', 'normal', 'core');
}

function wz_page_settings( $post )
{
	$values = get_post_custom( $post->ID );
	$feature 	= isset( $values['page_feature'] ) ? esc_attr( $values['page_feature'][0] ) : '';
	$slider 	= isset( $values['page_slider'] ) ? esc_attr( $values['page_slider'][0] ) : '';
	$number 	= isset( $values['page_number'] ) ? esc_attr( $values['page_number'][0] ) : '';
	$category 	= isset( $values['page_category'] ) ? esc_attr( $values['page_category'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>	
	<p>
		<input type="checkbox" name="page_slider" id="page_slider" <?php checked( $slider, 'yes' ); ?> />
		<label for="page_slider">Activate slider</label>
	</p>
	<p>
		<input type="checkbox" name="page_feature" id="page_feature" <?php checked( $feature, 'yes' ); ?> />
		<label for="page_feature">Activate feature</label>
	</p>
	<p>
		<label for="page_number">Number of posts</label>
		<input type="text" name="page_number" id="page_number" value="<?php echo $number; ?>" />
	</p>
	<p>
		<label for="page_category">Category slug</label>
		<input type="text" name="page_category" id="page_category" value="<?php echo $category; ?>" />
	</p>
	<?php	
}


function page_settings_save( $post_id )
{
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
	
	if( isset( $_POST['page_number'] ) )
		update_post_meta( $post_id, 'page_number', wp_kses( $_POST['page_number'], $allowed ) );
		
	if( isset( $_POST['page_category'] ) )
		update_post_meta( $post_id, 'page_category', wp_kses( $_POST['page_category'], $allowed ) );
		
		
	// This is purely my personal preference for saving checkboxes
	$chk_feature = ( isset( $_POST['page_slider'] ) && $_POST['page_slider'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'page_slider', $chk_feature );
	
	$chk_cover = ( isset( $_POST['page_feature'] ) && $_POST['page_feature'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'page_feature', $chk_cover );

}

