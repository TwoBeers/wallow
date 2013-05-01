<?php
/**
 * 404.php
 *
 * This file is the Error 404 Page template file, which is output whenever
 * the server encounters a "404 - file not found" error.
 *
 * @package wallow
 * @since 0.29
 */


get_header(); ?>

<?php wallow_hook_content_before(); ?>

<div id="content">

	<?php wallow_hook_content_top(); ?>

	<div class="hentry not-found" id="post-404-not-found">

		<h3 class="storytitle"><?php _e( 'Error 404','wallow' ); ?> - <?php _e( 'Page not found','wallow' ); ?></h3>

		<div class="storycontent">

			<p><?php _e( "Sorry, you're looking for something that isn't here" ,'wallow' ); ?>: <u><?php echo home_url() . esc_html( $_SERVER['REQUEST_URI'] ); ?></u></p>

			<br>

			<?php if ( is_active_sidebar( 'error404-widgets-area' ) ) { ?>

				<p><?php _e( 'You can try the following:','wallow' ); ?></p>

				<?php get_sidebar( 'error404' ); ?>

			<?php } else { ?>

				<p><?php _e( "There are several links scattered around the page, maybe they can help you on finding what you're looking for.", 'wallow' ); ?></p>

				<p><?php _e( 'Perhaps using the search form will help too...', 'wallow' ); ?></p>

				<?php get_search_form(); ?>

			<?php } ?>

		</div>

		<br class="fixfloat" />

	</div>

	<?php wallow_hook_content_bottom(); ?>

</div>

<?php wallow_hook_content_after(); ?>

<?php get_footer(); ?>
