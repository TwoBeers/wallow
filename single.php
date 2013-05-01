<?php
/**
 * single.php
 *
 * The single post template file, used to display single posts.
 *
 * @package wallow
 * @since 0.27
 */


get_header(); ?>

<?php wallow_hook_content_before(); ?>

<div id="content">

	<?php wallow_hook_content_top(); ?>

	<?php if ( have_posts() ) {

		while ( have_posts() ) {

			the_post(); ?>

			<?php wallow_hook_entry_before(); ?>

			<?php if ( !is_page() ) { printf( '<h2 class="posts_date">%1$s</h2>', get_the_date() ); } ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php wallow_hook_entry_top(); ?>

				<?php wallow_hook_post_title_before(); ?>

				<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

				<?php wallow_hook_post_title_after(); ?>

				<div class="storycontent">
					<?php the_content(); ?>
				</div>

				<?php wallow_hook_entry_bottom(); ?>

			</div>

			<?php wallow_hook_entry_after(); ?>

			<?php comments_template(); // Get wp-comments.php template ?>

		<?php } //end while ?>

	<?php } else { ?>

		<?php get_template_part( 'loop/post-none' ); ?>

	<?php } //endif ?>

	<?php wallow_hook_content_bottom(); ?>

</div>

<?php wallow_hook_content_after(); ?>

<?php get_footer(); ?>
