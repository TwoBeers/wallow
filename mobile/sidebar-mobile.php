<?php
/**
 * The mobile theme - Widget area template
 *
 * @package wallow
 * @subpackage mobile
 * @since 3.03
 */
?>

<!-- here should be the tbm widget area -->
<?php
	/* The tbm widget area is triggered if any of the areas have widgets. */
	if ( !is_active_sidebar( 'tbm-widget-area'  ) ) {
		return;
	}
?>

<div id="tbm-widget-area">
	<?php dynamic_sidebar( 'tbm-widget-area' ); ?>
	<br class="fixfloat" /> 
</div><!-- #tbm-widget-area -->
