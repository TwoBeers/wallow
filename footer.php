<?php global $wallow_version, $wallow_options; ?>

<!-- begin footer -->


</div>
<?php get_sidebar(); ?>
<div class="fixfloat"></div>
<div id="credits" class="fixfloat">
	&copy; <?php echo date("Y"); ?>  <strong><?php bloginfo( 'name' ); ?></strong> <?php _e( 'All rights reserved', 'wallow' ); ?>
	<?php if ( ( !isset( $wallow_options['wallow_mobile_css'] ) || ( $wallow_options['wallow_mobile_css'] == 1) ) ) echo '<span class="hide_if_print"> - <a href="' . home_url() . '?mobile_override=mobile">'. __('Mobile View','wallow') .'</a></span>'; ?>
	<?php if ( $wallow_options['wallow_tbcred'] == 1 ) { ?> - Powered by <a href="http://wordpress.org"><strong>WordPress</strong></a> and <a title="v<?php echo $wallow_version; ?>" href="http://www.twobeers.net/"><strong>Wallow</strong></a><?php } ?> - <?php _e( 'Have fun!', 'wallow' ); ?>
	<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
</div>

<?php wp_footer(); ?>
</body>
</html>