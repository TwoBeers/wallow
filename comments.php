<!-- begin comments -->
<?php
if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
	die ( 'Please do not load this page directly. Thanks!' );
endif;
		
if ( post_password_required() ) { ?>
	<div class="c_list"><p><?php _e( 'Enter your password to view comments.', 'wallow' ); ?></p></div>
<?php return; } ?>

<div <?php if ( have_comments() || comments_open() ) echo 'class="c_list"'; ?>>
	<?php if ( have_comments() ) { ?>
		<h3 id="comments"><?php comments_number( __( 'No Comments', 'wallow' ), __( '1 Comment', 'wallow' ), __( '% Comments', 'wallow' ) ); ?> &raquo;</h3>
		<ol id="commentlist">
			<?php wp_list_comments(); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="navigate_comments meta comment_tools">
				<?php paginate_comments_links(); ?>
			</div>
			<div class="fixfloat"> </div>
		<?php }
	} ?>
	<?php if ( comments_open() ) { ?>
		<?php 
			$custom_args = array(
				'comment_notes_after'  => '<p class="form-allowed-tags" style="color: #555555; text-align: center;"><small>' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'wallow' ), allowed_tags() ) . '</small></p>',
				'label_submit'         => __( 'Say It!', 'wallow' ),
				'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>.', 'wallow' ), admin_url( 'profile.php' ), $user_identity ) . '</p>',
			);
			comment_form($custom_args);
		?>
		<div class="fixfloat"></div>
	<?php } ?>
</div>
<!-- end comments -->
