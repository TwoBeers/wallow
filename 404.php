<?php get_header();

$website = get_bloginfo('url');

?> 
<div id="content">
	
	<h2></h2>
	<div class="post" id="post-404-not-found">
		<h3 class="storytitle">Error 404 - <?php _e('Page not found'); ?></h3>
		<div class="meta"><?php _e('by'); ?> system.</div>
		<div class="storycontent">
			<p><?php _e("Sorry, you're looking for something that isn't here",'wallow'); ?>: <u><?php echo " ".$website.esc_html($_SERVER['REQUEST_URI']); ?></u></p>
			<p><?php _e('You can try the following:','wallow'); ?></p>
			<ul>
				<li><?php _e('search the site using the searchbox in the upper-right','wallow'); ?></li>
				<li><?php _e('see the suggested pages in the above menu','wallow'); ?></li>
				<li><?php _e('browse the site throught the navigation bar below','wallow'); ?></li>
			</ul>
		</div>
		<div class="fixfloat"> </div>
	
	</div>

</div>

<?php get_footer(); ?>
