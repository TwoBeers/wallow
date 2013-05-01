<?php
/**
 * index.php
 *
 * This file is the master/default template file, used for Inedx/Archives/Search
 *
 * @package wallow
 * @since 0.27
 */


get_header(); ?>

<?php wallow_hook_content_before(); ?>

<div id="content">

	<?php wallow_hook_content_top(); ?>

	<?php get_template_part( 'loop', 'index' ); ?>

	<?php wallow_hook_content_bottom(); ?>

</div>

<?php wallow_hook_content_after(); ?>

<?php get_footer(); ?>
