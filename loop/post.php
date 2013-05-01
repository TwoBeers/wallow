<?php
/**
 * post.php
 *
 * Template part file that contains the Standard entry
 * 
 * @package wallow
 * @since 0.60
 */
?>

<?php wallow_hook_entry_before(); ?>

<?php if ( !is_page() ) { printf( '<h2 class="posts_date">%1$s</h2>', get_the_date() ); } ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<?php wallow_hook_entry_top(); ?>

	<?php wallow_hook_post_title_before(); ?>

	<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	<?php wallow_hook_post_title_after(); ?>

	<div class="storycontent">
		<?php
			switch ( wallow_get_opt( 'wallow_postexcerpt' ) ) {
				case 0:
					the_content();
					break;
				case 1:
					the_excerpt();
					break;
			}
		?>
	</div>

	<?php wallow_hook_entry_bottom(); ?>

</div>

<?php wallow_hook_entry_after(); ?>
