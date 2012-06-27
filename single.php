<?php global $wallow_options; ?>

<?php get_header(); ?>

<div id="content">

<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>

		<?php printf( '<h2 class="posts_date">%1$s</h2>', get_the_date() ); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php if ( $wallow_options['wallow_pthumb'] ) the_post_thumbnail( array( $wallow_options['wallow_pthumb_size'], $wallow_options['wallow_pthumb_size'] ), array( 'class' => 'alignleft' ) ); ?>
			<h3 class="storytitle">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>

			<div class="meta"><?php _e( 'by', 'wallow' ); ?> <?php the_author() ?> &#8212; <?php if( !is_page()) { _e( 'Categories', 'wallow'); ?>: <?php the_category( ', ' ) ?> &#8212; <?php the_tags( __( 'Tags: ', 'wallow' ), ', ', ' &#8212; ' ); }; ?> <?php comments_popup_link( __( 'Leave a comment', 'wallow' ), __( '1 Comment', 'wallow' ), __( '% Comments', 'wallow' ) ); ?> <?php edit_post_link( __( 'Edit', 'wallow' ), ' &#8212; ' ); ?></div>

			<div class="storycontent">
				<?php
					the_content();
				?>
			</div>

			<div>
					<?php wp_link_pages( 'before=<div class="meta comment_tools">' . __( 'Pages', 'wallow' ) . ':&after=</div>' ); ?>
			</div>
			<div class="fixfloat"></div>
		</div>

		<?php if ( comments_open() || pings_open() ) { ?>
		<div>
			<div class="meta comment_tools">
				<?php if ( comments_open() && is_singular() ) { ?>
					<?php post_comments_feed_link( '<abbr title="Really Simple Syndication">RSS</abbr> ' . __( 'feed for comments on this post', 'wallow' ) ); ?>
				<?php }; ?>
				<?php if ( pings_open() ) { ?>
					<?php if ( comments_open() && is_singular() ) { ?>
						|
					<?php }; ?>
					<a href="<?php trackback_url() ?>" rel="trackback"><?php _e( 'TrackBack URL', 'wallow' ); ?></a>
				<?php }; ?>
				<?php if ( comments_open() && is_singular() ) { ?>
					| <a href="#postcomment" title="<?php _e( 'Leave a comment', 'wallow' ); ?>"><?php _e( 'Leave a comment', 'wallow' ); ?></a>
				<?php }; ?>
			</div>
			<div class="fixfloat"></div>
		</div>
		<?php }; ?>

		<?php comments_template(); // Get wp-comments.php template ?>

		<div id="nav_pages">
			<?php next_post_link( '&laquo; %link' ) ?> <?php previous_post_link( '&#8212; %link &raquo;' ) ?>
		</div>

	<?php endwhile; 
} ?>

</div>

<?php get_footer(); ?>