<?php
/**
 * footer.php
 *
 * Template part file that contains the site footer and
 * closing HTML body elements
 *
 * @package wallow
 * @since 0.27
 */
?>

<!-- begin footer -->
		</div><!-- close main -->

		<?php if ( wallow_get_opt( 'wallow_sidebar' ) ) get_sidebar(); // show primary widgets area ?>

		<br class="fixfloat" />

		<?php wallow_hook_footer_before(); ?>

		<div id="footer">

			<?php wallow_hook_footer_top(); ?>

			<?php //get_sidebar( 'footer' ); // show footer widgets area ?>

			<div id="credits" class="fixfloat">
				&copy; <?php echo date("Y"); ?>  <strong><?php bloginfo( 'name' ); ?></strong> <?php _e( 'All rights reserved', 'wallow' ); ?>
				<?php wallow_hook_change_view(); ?>
				<?php if ( wallow_get_opt( 'wallow_tbcred' ) ) { ?> - Powered by <a href="http://wordpress.org"><strong>WordPress</strong></a> and <a title="v<?php echo esc_attr( wallow_get_info( 'version' ) ); ?>" href="http://www.twobeers.net/"><strong>Wallow</strong></a><?php } ?> - <?php _e( 'Have fun!', 'wallow' ); ?>
			</div>

			<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->

			<?php wallow_hook_footer_bottom(); ?>

		</div><!-- close footer -->

		<?php wallow_hook_footer_after(); ?>

		<?php wallow_hook_body_bottom(); ?>

		<?php wp_footer(); ?>

	</body>

</html>