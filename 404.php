<?php get_header();

$website = home_url();

?> 
<div id="content">

	<div class="post" id="post-404-not-found">
		<h3 class="storytitle">Error 404 - <?php _e( 'Page not found', 'wallow' ); ?></h3>
		<div class="storycontent">
			<p><?php _e( "Sorry, you're looking for something that isn't here", 'wallow' ); ?>: <u><?php echo " " . $website . esc_html( $_SERVER['REQUEST_URI'] ); ?></u></p>
			<?php if ( is_active_sidebar( '404-widgets-area' ) ) { ?>
				<p><?php _e( 'You can try the following:','wallow' ); ?></p>
				<div id="error404-widgets-area">
					<?php dynamic_sidebar( '404-widgets-area' ); ?>
				</div>
			<?php } else { ?>
				<p><?php _e( 'There are several links scattered around the page, maybe you can find what you\'re looking for', 'wallow' ); ?></p>
				<p><?php _e( 'Perhaps using the search form will help...', 'wallow' ); ?></p>
				<?php get_search_form(); ?>
			<?php } ?>
		</div>
		<div class="fixfloat"> </div>

	</div>

</div>

<?php get_footer(); ?>
