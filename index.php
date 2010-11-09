<?php get_header(); ?>

<div id="content">

	<?php // search reminder
	if (is_category()) :
		echo '<div class="wp-caption aligncenter"><p class="wp-caption-text">' . __('Search Results') . ' <strong>' . __('Category') . ': '; wp_title('',true,'right'); echo ' </strong></p></div>';
	elseif (is_tag()) :
		echo '<div class="wp-caption aligncenter"><p class="wp-caption-text">' . __('Search Results') . ' <strong>' . __('Tag') . ': '; wp_title('',true,'right'); echo ' </strong></p></div>';
	elseif (is_search()) :
		printf('<div class="wp-caption aligncenter"><p class="wp-caption-text">' . __('Search results for &#8220;%s&#8221;') . '</p></div>', '<strong>' . esc_html( get_search_query() ) . '</strong>');
	elseif (is_date()) :
		echo '<div class="wp-caption aligncenter"><p class="wp-caption-text">' . __('Search Results') . ' <strong>' . __('Archives') . ': '; wp_title('',true,'right'); echo ' </strong></p></div>';
	endif;
	?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php if (!is_page()) the_date(__('F j, Y'),'<h2 class="posts_date">','</h2>'); ?>
	
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h3 class="storytitle">
				<a href="<?php the_permalink() ?>" rel="bookmark">
				<?php
				$post_title = the_title_attribute('echo=0');
				if (!$post_title) : _e('(no title)'); else : echo $post_title;	endif;
				?>
				</a>
			</h3>
	
			<div class="meta"><?php _e('by','wallow'); ?> <?php the_author() ?> &#8212; <?php if(!is_page()) : _e('Categories'); ?>: <?php the_category(', ') ?> &#8212; <?php the_tags(__('Tags: '), ', ', ' &#8212; '); endif; ?> <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); // number of comments?> <?php edit_post_link(__('Edit'),' &#8212; '); ?></div>
	
			<div class="storycontent">
				<?php
					the_post_thumbnail(array(150,150), array('class' => 'alignright'));
					wallow_content_replace();
				?>
			</div>
	
			<div>
					<?php wp_link_pages('before=<div class="meta comment_tools">' . __('Pages:') . '&after=</div><div class="fixfloat"></div>'); ?>
			</div>
	
			<div class="fixfloat"> </div>
	
		</div>
	
	<?php endwhile; else : ?>
		<p><?php _e('Sorry, no posts matched your criteria.');?></p>
	<?php endif; ?>
	
	<div id="nav_pages">
		<?php posts_nav_link(' &#8212; ', '&laquo; ' . __('Newer Posts','wallow'), __('Older Posts','wallow') . ' &raquo;'); ?>
	</div>

</div>

<?php get_footer(); ?>