<?php
if (function_exists('register_sidebar')) {
    /**	Page Sidebars
     **/
    register_sidebar(array(
        'id' => 'sidebar-page',
        'name' => __('Page Sidebar', 'wizedesign'),
        'description' => __('Sidebar Page', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
	register_sidebar(array(
        'id' => 'blog-one-page',
        'name' => __('Blog Style 1 - Sidebar', 'wizedesign'),
        'description' => __('Blog Style 1 - Sidebar', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
	register_sidebar(array(
        'id' => 'blog-two-page',
        'name' => __('Blog Style 2 - Sidebar', 'wizedesign'),
        'description' => __('Blog Style 2 - Sidebar', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
	register_sidebar(array(
        'id' => 'blog-three-page',
        'name' => __('Blog Style 3 - Sidebar', 'wizedesign'),
        'description' => __('Blog Style 3 - Sidebar', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
	register_sidebar(array(
        'id' => 'blog-four-page',
        'name' => __('Blog Style 4 - Sidebar', 'wizedesign'),
        'description' => __('Blog Style 4 - Sidebar', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
	register_sidebar(array(
        'id' => 'single-page',
        'name' => __('Blog Single - Sidebar', 'wizedesign'),
        'description' => __('Blog Single - Sidebar', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
	register_sidebar(array(
        'id' => 'contact-page',
        'name' => __('Contact Sidebar', 'wizedesign'),
        'description' => __('Contact Sidebar', 'wizedesign'),
        'before_title' => '
			<div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
		<div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
		</div><br/>'
    ));
}
/** Footer sidebar
 **/
register_sidebar(array(
    'id' => 'footer-left',
    'name' => __('Footer Widget 1', 'wizedesign'),
    'description' => __('In the footer the left column', 'wizedesign'),
    'before_title' => '
        <h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-center',
    'name' => __('Footer Widget 2', 'wizedesign'),
    'description' => __('In the footer the center column', 'wizedesign'),
    'before_title' => '
        <h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-right',
    'name' => __('Footer Widget 3', 'wizedesign'),
    'description' => __('In the footer the right column', 'wizedesign'),
    'before_title' => '
        <h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
?>