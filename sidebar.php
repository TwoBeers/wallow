<!-- begin sidebar -->
<div id="menu">
		<div id="sidebartop"></div>
		<div id="sidebarbody">
			<ul>
					<li id="search"><div id="searchdiv">
					  <form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
						<div>
							<input type="text" name="s" id="s" size="15" title="<?php esc_attr_e('Enter a word to look up:'); ?>" />
							<input type="submit" value="<?php esc_attr_e('Find'); ?>!" title="<?php esc_attr_e('Find'); ?>!" />
						</div>
						</form>
						</div>
					</li>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidepad') ) : ?>
					<li id="meta"><h3><?php _e('Meta'); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</li>
					<?php wp_list_pages('title_li=<h3>'. __('Pages') .'</h3>'); ?>
					<?php wp_list_bookmarks('title_after=</h3>&title_before=<h3>'); ?>
					<?php wp_list_categories('title_li=<h3>'. __('Categories').'</h3>'); ?>
					<li id="archives"><h3><?php _e('Archives'); ?></h3>
						<ul>
						<?php wp_get_archives('type=monthly'); ?>
						</ul>
					</li>
			<?php endif; ?>

			</ul>
		 </div>
		 <div id="sidebarbottom" class="fixfloat"></div>

</div>
<!-- end sidebar -->