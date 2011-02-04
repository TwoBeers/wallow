
<!-- begin footer -->

<?php get_sidebar(); ?>

<div id="credits" class="fixfloat">
	&copy; <?php echo date("Y"); ?>  <strong><?php bloginfo( 'name' ); ?></strong> <?php _e( 'All rights reserved', 'wallow' ); ?> - Wallow theme v0.44 by <a href="http://www.twobeers.net/" title="<?php _e( 'Visit author homepage', 'wallow' ); ?> @ www.twobeers.net" >([][]) TwoBeers</a> - <?php _e( 'Powered by', 'wallow' ); ?> <a href="http://wordpress.org/" title="<?php _e( 'Powered by WordPress', 'wallow' ); ?>">WordPress</a> - <?php _e( 'Have fun!', 'wallow' ); ?>
	<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
</div>

</div>

<?php wp_footer(); ?>
</body>
</html>