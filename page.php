<?php get_header(); ?>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="posts_date">&nbsp;</h2>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark">
			<?php
			$post_title = the_title_attribute('echo=0');
			if (!$post_title) : _e('(no title)'); else: echo $post_title;	endif;
			?>
			</a>
		</h3>

		<div class="meta"><?php if ( comments_open()) : comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?>&#8212; <?php endif; edit_post_link(__('Edit')); ?></div>

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

	<?php if ( comments_open() || pings_open() ) : ?>
	<div>
		<div class="meta comment_tools">
			<?php if ( comments_open() && is_singular() ) : ?>
				<?php post_comments_feed_link('<abbr title="Really Simple Syndication">RSS</abbr> '. __('feed for comments on this post','wallow')); ?>
			<?php endif; ?>
			<?php if ( pings_open() ) : ?>
				<?php if ( comments_open() && is_singular() ) : ?>
					|
				<?php endif; ?>
				<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack URL'); ?></a>
			<?php endif; ?>
			<?php if ( comments_open() && is_singular() ) : ?>
				| <a href="#postcomment" title="<?php _e("Leave a comment"); ?>"><?php _e("Leave a comment"); ?></a>
			<?php endif; ?>
		</div>
		<div class="fixfloat"></div>
	</div>
	<?php endif; ?>

	<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>