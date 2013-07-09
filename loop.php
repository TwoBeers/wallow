<?php
/**
 * loop.php
 *
 * The main loop that displays posts.
 *
 *
 * @package wallow
 * @since 0.60
 */
?>

<?php if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();

		get_template_part( 'loop/post', wallow_get_post_format( $post->ID ) );

	} //end while ?>

<?php } else { ?>

	<?php get_template_part( 'loop/post-none' ); ?>

<?php } //endif ?>
