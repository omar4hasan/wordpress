
<div id="comments">
<?php
if (post_password_required()):
?>
				<p class="nopassword"><?php
    _e('This post is password protected. Enter the password to view any comments.', 'wizedesign');
?></p>
</div><!-- #comments -->
<?php
    return;
endif;
?>
	<div class="comments-hr"></div><?php if (have_comments()): ?> 
	<div class="short-title"><h3><?php
    printf(_n('One Comment %2$s', '%1$s Comments', get_comments_number(), ''), number_format_i18n(get_comments_number()), '');
?></h3></div>
<?php
    if (get_comment_pages_count() > 1 && get_option('page_comments')):
?>
			<div class="navigation">
				<div class="nav-previous"><?php
        previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'wizedesign'));
?></div>
				<div class="nav-next"><?php
        next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'wizedesign'));
?></div>
			</div> <!-- .navigation -->
<?php
    endif; // check for comment navigation 
?>
	<ol class="commentlist">
<?php
    wp_list_comments(array(
        'callback' => 'wizedesign_comment'
    ));
?>
	</ol>


<?php
else: // or, if we don't have comments:
    /* If there are no comments and comments are closed,
     */ 
    if (!comments_open()):
?>
	<p class="nocomments"><?php
        _e('Comments are closed.', 'wizedesign');
?></p>
<?php
    endif; // end ! comments_open() 
?>

<?php
endif; // end have_comments() 
?>

<?php comment_form(array('comment_notes_after' => '')); ?>

</div><!-- end #comments -->
