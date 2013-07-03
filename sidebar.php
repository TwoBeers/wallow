<?php
/**
 * sidebar.php
 *
 * Template part file that contains the default sidebar content
 *
 * @package wallow
 * @since 0.27
 */
?>

<?php wallow_hook_sidebars_before( 'primary' ); ?>

<!-- begin primary sidebar -->

<div id="primary-sidebar" class="sidebar">

	<div id="sidebartop"></div>

	<div id="sidebarbody">

		<?php wallow_hook_sidebar_top( 'primary' ); ?>

		<?php if ( !dynamic_sidebar( 'sidepad' ) ) { //if the widget area is empty, we print some standard wigets ?>

			<?php wallow_default_widgets(); ?>

		<?php } ?>

		<?php wallow_hook_sidebar_bottom( 'primary' ); ?>

	</div>

	<div id="sidebarbottom" class="fixfloat"></div>

</div>

<!-- end primary sidebar -->

<?php wallow_hook_sidebars_after( 'primary' ); ?>
