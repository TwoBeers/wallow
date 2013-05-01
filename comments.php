<?php
/**
 * comments.php
 *
 * This template file includes both the comments list and
 * the comment form
 *
 * @package wallow
 * @since 0.27
 */
?>

<!-- begin comments -->
<?php
	if ( post_password_required() ) {
		echo '<div id="comments" class="c_list"><p>' . __( 'Enter your password to view comments.','wallow' ) . '</p></div>';
		return;
	}
?>

<?php wallow_hook_comments_before(); ?>

<div<?php if ( have_comments() || comments_open() ) echo ' class="c_list"'; ?>>

	<?php if ( have_comments() ) { ?>

		<h3 id="comments"><?php comments_number( __( 'No Comments', 'wallow' ), __( '1 Comment', 'wallow' ), __( '% Comments', 'wallow' ) ); ?> &raquo;</h3>

		<?php wallow_hook_comments_list_before(); ?>

		<ol id="commentlist">
			<?php wp_list_comments(); ?>
		</ol>

		<?php wallow_hook_comments_list_after(); ?>

	<?php } ?>

	<?php if ( comments_open() ) {  //if comments are open

		comment_form(); ?>
		<br class="fixfloat" />

	<?php } ?>

</div>
<!-- end comments -->

<?php wallow_hook_comments_after(); ?>
