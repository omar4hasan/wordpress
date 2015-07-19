<?php
function generate_gallery($post_id = null) {
    if ($post_id == null)
        return;
    $images = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'attachment',
        'post_mime_type' => 'image/jpeg, image/jpg, image/png, image/gif',
        'post_parent' => $post_id,
        'orderby' => 'menu_order',
        'order' => 'DESC'
    ));
    if (count($images) > 0) {
        echo '
<div class="single-media">
    <div class="single-gallery">';
        foreach ($images as $image) {
            $cover_large   = wp_get_attachment_image_src($image->ID, 'photo-large');
            $cover_gallery = wp_get_attachment_image($image->ID, 'photo-gallery');
            echo '
        <div class="single-photo"><a href="' . $cover_large[0] . '" class="photo-preview" data-rel="prettyPhoto[pp_gallery]">' . $cover_gallery . '</a>
        </div>';
        }
        echo '
    </div>
</div><!-- end .single-media -->
';   
    }
}
?>