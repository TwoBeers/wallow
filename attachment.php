<?php
/**
 * attachment.php
 *
 * Template for Image mime-type attachment pages
 *
 * @package wallow
 * @since 1.00
 */


get_header(); ?>

<?php wallow_hook_content_before(); ?>

<div id="content">

	<?php wallow_hook_content_top(); ?>

	<?php if ( have_posts() ) {

		while ( have_posts() ) {

			the_post(); ?>

			<?php wallow_hook_entry_before(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php wallow_hook_entry_top(); ?>

				<div class="storycontent">

					<?php if ( wp_attachment_is_image() ) { ?>

							<div class="att_content">
								<a class="bz-view-full-size" href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php esc_attr_e( 'View full size','wallow' ) ; ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'large', false, array( 'class' => 'size-full') ); ?></a>
								<?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
							</div>

							<?php if ( !empty( $post->post_content ) ) the_content(); ?>

					<?php } else { ?>

							<?php echo wp_get_attachment_link( $post->ID,'thumbnail', 0,1 ); ?>

							<p><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></p>

					<?php } ?>

				</div>

				<?php wallow_hook_entry_bottom(); ?>

			</div>

			<?php wallow_hook_entry_after(); ?>

			<?php comments_template(); // Get wp-comments.php template ?>

		<?php } //end while ?>

	<?php } else {?>

		<?php get_template_part( 'loop/post-none' ); ?>

	<?php } ?>

	<?php wallow_hook_content_bottom(); ?>

</div>

<?php wallow_hook_content_after(); ?>

<?php get_footer(); ?>
