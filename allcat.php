<?php get_header(); ?>

<div id="content">

<?php
//show "all categories" page
	echo '<div class="post"><h3 class="storytitle">' . __('Categories') . '</h3><div class="meta">' . __('All Categories') . '</div><div class="storycontent"><ul>';
	wp_list_categories('title_li=');
	echo '</ul></div></div>';
?>

</div>

<?php get_footer(); ?>
