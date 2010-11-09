<!-- begin comments -->
<?php
if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) :
	die ('Please do not load this page directly. Thanks!');
endif;
		
if ( post_password_required() ) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>

<?php if ( comments_open() ) : ?>

<h3 id="comments"><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments')); ?> &raquo;</h3>

<?php if ( have_comments() ) : ?>
<ol id="commentlist">
	<?php wp_list_comments(); ?>
</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<div class="navigate_comments meta comment_tools">
		<?php previous_comments_link(); ?> | <?php next_comments_link(); ?>
	</div>
<?php endif;?>

<?php else : // If there are no comments yet ?>
	<p><?php _e('No comments yet.'); ?></p>
<?php endif; ?>

<?php $custom_args = array(
	'comment_notes_after'  => '<p class="form-allowed-tags" style="color: #555555; text-align: center;"><small>' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), allowed_tags() ) . '</small></p>',
	'label_submit'         => __( 'Say It!' ),
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>.' ), admin_url( 'profile.php' ), $user_identity ) . '</p>',
);

comment_form($custom_args); ?>
		
	<div class="fixfloat"></div>

<?php endif; ?>
<!-- end comments -->
