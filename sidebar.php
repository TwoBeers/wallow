<!-- begin sidebar -->
<div id="menu">
		<div id="sidebartop"></div>
		<div id="sidebarbody">
			<ul>
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'sidepad' ) ) { ?>
				<li id="search">
					<?php get_search_form(); ?>
				</li>
				<li id="meta"><h3><?php _e( 'Meta', 'wallow' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</li>
				<?php wp_list_pages( 'title_li=<h3>' . __( 'Pages', 'wallow' ) .'</h3>'); ?>
				<?php wp_list_bookmarks( 'title_after=</h3>&title_before=<h3>' ); ?>
				<?php wp_list_categories( 'title_li=<h3>' . __( 'Categories', 'wallow' ).'</h3>' ); ?>
				<li id="archives"><h3><?php _e( 'Archives', 'wallow' ); ?></h3>
					<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</li>
			<?php } ?>
			</ul>
			<div class="fixfloat"></div>
		 </div>
		 <div id="sidebarbottom" class="fixfloat"></div>

</div>
<!-- end sidebar -->