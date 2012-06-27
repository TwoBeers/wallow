<?php get_header(); ?>

<div id="content">

<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>

		<?php printf( '<h2 class="posts_date">%1$s</h2>', get_the_date() ); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h3 class="storytitle">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>

			<div class="meta"><?php _e( 'by', 'wallow' ); ?> <?php the_author() ?> &#8212; <?php comments_popup_link( __( 'Leave a comment', 'wallow' ), __( '1 Comment', 'wallow' ), __( '% Comments', 'wallow' ) ); ?> <?php edit_post_link( __( 'Edit', 'wallow' ), ' &#8212; ' ); ?></div>

			<div class="storycontent">
				
				<div class="entry-attachment" style="text-align: center;">
					
					<?php if ( wp_attachment_is_image() ) { //from twentyten WP theme
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID )
								break;
						}
						$k++;
						// If there is more than 1 image attachment in a gallery
						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] ) )
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							else
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
						} else {
							// or, if there's only 1 image attachment, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}
						?>
						<p class="attachment"><a href="<?php echo $next_attachment_url; ?>#posts_content" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'wallow_attachment_size', 686 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
						?></a></p>
					<?php } else { ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
					<?php } ?>
				</div><!-- .entry-attachment -->
					
				<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>
				<div class="meta comment_tools" style="text-align: center;">
					<?php previous_image_link( false , __( '&laquo; Previous Image', 'wallow' ) ); // link to Previous image ?>
					 | 
					<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php _e( 'View full size', 'wallow' ) ;  // link to Full size image ?>" rel="attachment" target="_blank">100%</a>
					 | 
					<?php next_image_link( false , __( 'Next Image &raquo;', 'wallow' ) ); // link to Next image ?>
				</div>
					
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