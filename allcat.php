<?php
/**
 * Template Name: List of Categories
 *
 * allcat.php
 *
 * The template file used to display the whole category list 
 * as a page.
 *
 * @package wallow
 * @since 0.29
 */


get_header(); ?>

<?php wallow_hook_content_before(); ?>

<div id="content">

	<?php wallow_hook_content_top(); ?>

	<div class="hentry post">

		<h3 class="storytitle"><?php _e( 'Categories','wallow' ); ?></h3>

		<div class="meta"><?php _e( 'All Categories', 'wallow' ); ?></div>

		<div class="storycontent">
			<ul>
				<?php wp_list_categories( 'title_li=' ); ?>
			</ul>
		</div>

	</div>

	<?php wallow_hook_content_bottom(); ?>

</div>

<?php wallow_hook_content_after(); ?>

<?php get_footer(); ?>
