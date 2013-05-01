<?php
/**
 * sidebar-error404.php
 *
 * Template part file that contains the 404 page widget area
 *
 * @package wallow
 * @since 2.05
 */
?>

<?php wallow_hook_sidebars_before( 'error404' ); ?>

<div id="error404-widgets-area">

	<?php wallow_hook_sidebar_top( 'error404' ); ?>

	<?php dynamic_sidebar( 'error404-widgets-area' ); ?>

	<?php wallow_hook_sidebar_bottom( 'error404' ); ?>

</div>

<?php wallow_hook_sidebars_after( 'error404' ); ?>
