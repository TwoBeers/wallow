<?php
/**
 * functions.php
 *
 * Contains almost all of the Theme's setup functions and custom functions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package wallow
 * @since 0.29
 */


/* Custom actions - WP hooks */

add_action( 'after_setup_theme'					, 'wallow_setup' );
add_action( 'wp_enqueue_scripts'				, 'wallow_scripts' );
add_action( 'wp_enqueue_scripts'				, 'wallow_stylesheet' );
add_action( 'template_redirect'					, 'wallow_allcat' );
add_action( 'wp_print_styles'					, 'wallow_deregister_styles', 100 );
add_action( 'wp_head'							, 'wallow_custom_css' );
add_action( 'admin_bar_menu'					, 'wallow_admin_bar_plus', 999 );


/* Custom actions - theme hooks */

add_action( 'wallow_hook_header_after'			, 'wallow_primary_menu' );
add_action( 'wallow_hook_comments_list_before'	, 'wallow_navigate_comments' );
add_action( 'wallow_hook_comments_list_after'	, 'wallow_navigate_comments' );
add_action( 'wallow_hook_content_top'			, 'wallow_search_reminder' );
add_action( 'wallow_hook_entry_bottom'			, 'wallow_link_pages' );
add_action( 'wallow_hook_entry_bottom'			, 'wallow_single_widgets_area' );
add_action( 'wallow_hook_post_title_before'		, 'wallow_the_thumb' );
add_action( 'wallow_hook_post_title_after'		, 'wallow_top_meta' );
add_action( 'wallow_hook_entry_bottom'			, 'wallow_bottom_meta' );
add_action( 'wallow_hook_content_bottom'		, 'wallow_nav_posts' );
add_action( 'wallow_hook_content_bottom'		, 'wallow_navigate_archives' );
add_action( 'wallow_hook_entry_before'			, 'wallow_navigate_attachments' );


/* Custom filters - WP hooks */

add_filter( 'use_default_gallery_style'			, '__return_false' );
add_filter( 'img_caption_shortcode'				, 'wallow_img_caption_shortcode', 10, 3 );
add_filter( 'embed_oembed_html'					, 'wallow_wmode_transparent', 10, 3);
add_filter( 'the_title'							, 'wallow_titles_filter', 10, 2 );
add_filter( 'excerpt_length'					, 'wallow_excerpt_length' );
add_filter( 'excerpt_mblength'					, 'wallow_excerpt_length' );
add_filter( 'excerpt_more'						, 'wallow_excerpt_more' );
add_filter( 'the_content_more_link'				, 'wallow_more_link', 10, 2 );
add_filter( 'next_posts_link_attributes'		, 'wallow_next_posts_title' ); 
add_filter( 'previous_posts_link_attributes'	, 'wallow_previous_posts_title' ); 
add_filter( 'wp_title'							, 'wallow_filter_wp_title' );
add_filter( 'body_class'						, 'wallow_body_classes' );
add_filter( 'the_content'						, 'wallow_clear_float', 10 );


/* get the theme options */

$wallow_opt = get_option( 'wallow_options' );


/* load modules (accordingly to http://justintadlock.com/archives/2010/11/17/how-to-load-files-within-wordpress-themes) */

require_once( 'lib/common.php' ); // load common functions

require_once( 'lib/options.php' ); // load options

require_once( 'lib/admin.php' ); // load admin functions

require_once( 'lib/hooks.php' ); // load the custom hooks module

require_once( 'lib/widgets.php' ); // load the custom widgets module

require_once( 'lib/jetpack.php' ); // load the jetpack support module

require_once( 'lib/quickbar.php' ); // load quickbar functions

require_once( 'lib/breadcrumb.php' ); // load breadcrumb functions

$wallow_is_mobile = false;
if ( wallow_get_opt( 'wallow_mobile_css' ) ) require_once( 'mobile/core-mobile.php' ); // load mobile functions


/* conditional tags */

function wallow_is_mobile() { // mobile
	global $wallow_is_mobile;

	return $wallow_is_mobile;

}

function wallow_is_allcat() { //is "all category" page
	static $is_allcat;

	if ( !isset( $is_allcat ) )
		$is_allcat = isset( $_GET['allcat'] ) && md5( $_GET['allcat'] ) == '415290769594460e2e485922904f345d' ? true : false;

	return $is_allcat;

}


// get the theme types
function wallow_get_types() {
	$wallow_types = array(
		'fire'		=> __( 'fire', 'wallow' ),
		'air'		=> __( 'air', 'wallow' ),
		'water'		=> __( 'water', 'wallow' ),
		'earth'		=> __( 'earth', 'wallow' ),
		'smoke'		=> __( 'smoke', 'wallow' ),
		'clouds'	=> __( 'clouds', 'wallow' ),
	);
	return $wallow_types;
}


// Set the content_width (with a 1024x768 window size)
if ( ! isset( $content_width ) )
	$content_width = 640;


if ( !function_exists( 'wallow_setup' ) ) {
	function wallow_setup() {

		// Register localization support
		load_theme_textdomain( 'wallow', get_template_directory() . '/languages' );

		// Theme uses wp_nav_menu() in one location
		register_nav_menus( array( 'primary' => __( 'Main Navigation Menu', 'wallow' ) ) );

		// Register Features Support
		add_theme_support( 'automatic-feed-links' );

		// Thumbnails support
		add_theme_support( 'post-thumbnails' );

		// Post formats
		add_theme_support( 'post-formats', apply_filters( 'wallow_post_formats', array() ) );

		// skip the rest if in mobile view
		if ( wallow_is_mobile() ) return;
		
		// Custom background
		wallow_setup_custom_background();

		// Custom header
		wallow_setup_custom_header();
	}
}


//the custom header support
if ( !function_exists( 'wallow_setup_custom_header' ) ) {
	function wallow_setup_custom_header() {

		$args = array(
			'width'					=> 980, // Header image width (in pixels)
			'height'				=> 120, // Header image height (in pixels)
			'default-image'			=> '', // Header image default
			'header-text'			=> false, // Header text display default
			'default-text-color'	=> 'FFFFFF', // Header text color default
			'wp-head-callback'		=> 'wallow_header_style',
			'admin-head-callback'	=> 'wallow_admin_header_style',
			'flex-width'			=> true,
			'flex-height'			=> true
		);

		$args = apply_filters( 'wallow_custom_header_args', $args );

		add_theme_support( 'custom-header', $args );

	}
}


// the custom background support
if ( !function_exists( 'wallow_setup_custom_background' ) ) {
	function wallow_setup_custom_background() {

		$args = array( 'default-color' => '' );

		add_theme_support( 'custom-background', $args );

	}
}


// the custom header style - add style customization to page - gets included in the site header
if ( !function_exists( 'wallow_header_style' ) ) {
	function wallow_header_style(){

		global $wallow_opt;
		$style = '';
		if ( get_header_image() != '' ) $style = 'display:none;';

?>
		<style type="text/css">
			#header h1 a, #header .description {
				<?php echo $style; ?>
			}
			body {
				font-size: <?php echo isset( $wallow_opt['wallow_fontsize'] ) ? $wallow_opt['wallow_fontsize'] : '11px'; ?>;
<?php if ( $wallow_opt['wallow_google_font_family'] && $wallow_opt['wallow_google_font_body'] ) { ?>
				font-family: <?php echo $wallow_opt['wallow_google_font_family']; ?>;
<?php } else { ?>
				font-family: <?php echo $wallow_opt['wallow_font_family']; ?>;
<?php } ?>
			}
<?php if ( $wallow_opt['wallow_google_font_family'] && $wallow_opt['wallow_google_font_post_title'] ) { ?>
			h3.storytitle {
				font-family: <?php echo $wallow_opt['wallow_google_font_family']; ?>;
			}
<?php } ?>
<?php if ( $wallow_opt['wallow_google_font_family'] && $wallow_opt['wallow_google_font_post_content'] ) { ?>
			.storycontent {
				font-family: <?php echo $wallow_opt['wallow_google_font_family']; ?>;
			}
<?php } ?>

		</style>
		<!-- InternetExplorer really sucks! -->
		<!--[if lte IE 8]>
		<style type="text/css">
			.storycontent img.size-full,
			.storycontent img.size-large,
			.widget img.size-full,
			.widget img.size-large,
			.gallery img {
				width:auto;
			}
		</style>
		<![endif]-->
<?php

	}
}


// custom css
if ( !function_exists( 'wallow_custom_css' ) ) {
	function wallow_custom_css(){

		if ( ! wallow_get_opt( 'wallow_custom_css' ) ) return;

?>
	<style type="text/css">
		<?php echo wallow_get_opt( 'wallow_custom_css' ); ?>
	</style>
<?php

	}
}


// add links to admin bar
if ( !function_exists( 'wallow_admin_bar_plus' ) ) {
	function wallow_admin_bar_plus() {
		global $wp_admin_bar;

		if (!is_super_admin() || !is_admin_bar_showing() || !current_user_can( 'edit_theme_options' ) ) return;

		$add_menu_meta = array(
			'target'    => '_blank'
		);

		$wp_admin_bar->add_menu( array(
			'id'        => 'wallow_theme_options',
			'parent'    => 'appearance',
			'title'     => __( 'Theme Options','wallow' ),
			'href'      => get_admin_url() . 'themes.php?page=tb_wallow_functions',
			'meta'      => $add_menu_meta
		) );

	}
}


// custom background style - gets included in the site header
if ( !function_exists( 'wallow_custom_bg' ) ) {
	function wallow_custom_bg() {

		$background = get_background_image();
		$color = get_background_color();
		if ( ! $background && ! $color ) return;

		$style = $color ? "background-color: #$color;" : '';

		if ( $background ) {
			$image = " background-image: url('$background');";

			$repeat = get_theme_mod( 'background_repeat', 'repeat' );
			if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) ) $repeat = 'repeat';
			$repeat = " background-repeat: $repeat;";

			$position = get_theme_mod( 'background_position_x', 'left' );
			if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) ) $position = 'left';
			$position = " background-position: top $position;";

			$attachment = get_theme_mod( 'background_attachment', 'scroll' );
			if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) ) $attachment = 'scroll';
			$attachment = " background-attachment: $attachment;";

			$style .= $image . $repeat . $position . $attachment;
		} else {
			$style .= ' background-image: url("");';
		}

?>
	<style type="text/css"> 
		body { <?php echo trim( $style ); ?> }
	</style>
<?php

	}
}


// show all categories list (redirect to allcat.php if allcat=y)
function wallow_allcat () {
	if( wallow_is_allcat() ) {

		get_template_part( 'allcat' );

		exit;

	}
}


// get js modules
function wallow_get_js_modules() {

	$modules = array(
		'main_menu',
		'quickbar',
		'widgets_style',
		'smooth_scroll',
		'resizevideo',
	);

	$modules = implode( ',', $modules);

	return  apply_filters( 'wallow_filter_js_modules', $modules );

}


// add scripts
function wallow_scripts(){

	if ( wallow_is_mobile() ) return;

	if ( wallow_get_opt( 'wallow_jsani' ) )
		wp_enqueue_script( 'wallow-script', get_template_directory_uri() . '/js/wallowscript.min.js', array( 'jquery', 'hoverIntent' ), wallow_get_info( 'version' ), true  ); //wallow js

	$data = array(
		'script_modules' => wallow_get_js_modules(),
	);
	wp_localize_script( 'wallow-script', 'wallow_l10n', $data );

}


// deregister style for installed plugins
function wallow_deregister_styles() {
	//here goes something
}


// Add stylesheets to page
function wallow_stylesheet(){

	if ( wallow_is_mobile() ) return;

	// thickbox
	if ( wallow_get_opt( 'wallow_thickbox' ) )
		wp_enqueue_style( 'thickbox' );

	//normal view
	wp_enqueue_style( 'wallow_general-style', get_stylesheet_uri(), false, wallow_get_info( 'version' ), 'screen' );

	wallow_get_variants();

	//print style
	wp_enqueue_style( 'wallow_print-style', get_template_directory_uri() . '/css/print.css', false, wallow_get_info( 'version' ), 'print' );

	//google font
	if ( wallow_get_opt( 'wallow_google_font_family' ) )
		wp_enqueue_style( 'wallow_google-fonts', '//fonts.googleapis.com/css?family=' . urlencode( wallow_get_opt( 'wallow_google_font_family' ) ) );

}


//output style
function wallow_get_variants() {


	if( wallow_get_opt( 'wallow_theme_set' ) && wallow_get_opt( 'wallow_theme_set' ) == 1 ){ // check if use set or custom combinations

		$args['st']	= wallow_get_opt( 'wallow_theme_genlook' );
		$args['si']	= wallow_get_opt( 'wallow_theme_sidebar' );
		$args['me']	= wallow_get_opt( 'wallow_theme_pages' );
		$args['po']	= wallow_get_opt( 'wallow_theme_popup' );
		$args['qu']	= wallow_get_opt( 'wallow_theme_quickbar' );
		$args['av']	= wallow_get_opt( 'wallow_theme_avatar' );

	} else { // output a default theme set

		$theme_set	= wallow_get_opt( 'wallow_theme_set' ) ? wallow_get_opt( 'wallow_theme_set' ) : 'fire';
		$args['st']	= $theme_set;
		$args['si']	= $theme_set;
		$args['me']	= $theme_set;
		$args['po']	= $theme_set;
		$args['qu']	= $theme_set;
		$args['av']	= $theme_set;

	}
	//$args = array();

	$style_path = add_query_arg( $args, get_template_directory_uri() . '/css/load-styles.php' );

	wp_enqueue_style( 'wallow_variants-style', $style_path, false, wallow_get_info( 'version' ), 'screen' );

}

// get the post thumbnail or (if not set) the format related icon
function wallow_get_the_thumb( $args = '' ) {
	global $post;

	$defaults = array(
		'id'		=> $post->ID,
		'width'		=> wallow_get_opt( 'wallow_pthumb_size' ),
		'height'	=> wallow_get_opt( 'wallow_pthumb_size' ),
		'class'		=> '',
		'linked'	=> 0,
	);

	$args = wp_parse_args( $args, $defaults );

	$output = '';

	if ( has_post_thumbnail( $args['id'] ) )
		$output = get_the_post_thumbnail( $args['id'], array( $args['width'], $args['height'] ), array( 'class' => $args['class'] ) );

	if ( $output && $args['linked'] )
		$output = '<a href="' . get_permalink( $args['id'] ) . '" rel="bookmark">' . $output . '</a>';

	return apply_filters( 'wallow_filter_get_the_thumb', $output );

}


// show page hierarchy
if ( !function_exists( 'wallow_multipages' ) ) {
	function wallow_multipages(){

		echo wallow_get_multipages( array(
			'before'		=> '<br />' . __( 'This page has hierarchy', 'wallow' ) . ' - ',
			'separator'		=> ' - ',
		) );

	}
}


// Pages Menu
if ( !function_exists( 'wallow_pages_menu' ) ) {
	function wallow_pages_menu() {

?>
	<ul id="mainmenu">
		<?php wp_list_pages( 'sort_column=menu_order&title_li=' ); // menu-order sorted ?>
	</ul>
<?php

	}
}


function wallow_get_header() {

	$output = '';

	if ( get_header_image() ) {
		$output .= '<a href="' . home_url() . '/"><img src="' . get_header_image() . '" alt="' . get_bloginfo( 'name' ) . '" title="' . get_bloginfo( 'name' ) . '" /></a>' . "\n";
		$output .= '<h1 class="hidden">' . get_bloginfo( 'name' ) . '</h1>' . "\n";
		$output .= '<span class="description hidden">' . get_bloginfo( 'description' ) . '</span>';
	} else {
		$output .= '<h1><a href="' . home_url() . '/">' . get_bloginfo( 'name' ) . '</a></h1>' . "\n";
		$output .= '<div class="description">' . get_bloginfo( 'description' ) . '</div>';
	}

	$output = apply_filters( 'wallow_filter_header', $output );

	return $output;

}


// display the second secondary menu
function wallow_primary_menu() {

	if( ! wallow_get_opt( 'wallow_primary_menu' ) ) return;

?>
	<div id="primary_menu">
		<div id="primary_menu-out">
			<div id="primary_menu-in">
				<?php
					wp_nav_menu( array(
						'menu_id' => 'mainmenu',
						'fallback_cb' => 'wallow_pages_menu',
						'theme_location' => 'primary'
					) );
				?>
				<br class="fixfloat" />
			</div>
		</div>
	</div>
<?php

}


// comments navigation
if ( !function_exists( 'wallow_navigate_comments' ) ) {
	function wallow_navigate_comments(){

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {

?>
	<div class="navigation-links numeric-nav comments-navigation fixfloat">
		<?php if(function_exists('wp_paginate_comments')) {
			wp_paginate_comments();
		} else {
			paginate_comments_links();
		} ?>
	</div>
<?php 

		}

	}
}


// Search reminder
function wallow_search_reminder() {
	global $post;

	$text = wallow_get_search_reminder( array(
		'archive_label'	=> sprintf( __( '%s archive', 'wallow' ), get_bloginfo( 'name' ) ) . '<br />%s: ',
	) );

	if ( $text ) {

?>
	<div class="search-reminder">
		<p><?php echo $text; ?></p>
	</div>
<?php

	}

	if ( wallow_get_opt( 'wallow_cat_description' ) && is_category() && category_description() ) { 

?>
	<div class="search-reminder">
		<p><?php echo category_description(); ?></p>
	</div>
<?php

	}

	if ( is_author() ) echo wallow_author_badge( $post->post_author, 48 );

}


// archives pages navigation
if ( !function_exists( 'wallow_navigate_archives' ) ) {
	function wallow_navigate_archives() {
		global $paged;

		if ( !is_archive() && !is_search() && !is_home() ) return;

		if ( !$paged ) $paged = 1;
			$output = '';
			$output .= get_next_posts_link()? get_next_posts_link( '&laquo; ' . __( 'Older Posts', 'wallow' ) ) : '';
			$output .= ( get_next_posts_link() && get_previous_posts_link() ) ? ' | ' : '';
			$output .= get_previous_posts_link()? get_previous_posts_link( __( 'Newer Posts', 'wallow' ) . ' &raquo;' ) : '';


?>
	<div class="nav_pages archive-navigation numeric-nav navigation-links">
	<?php if ( function_exists( 'wp_pagenavi' ) ) { ?>

		<?php wp_pagenavi(); ?>

	<?php } elseif ( function_exists( 'wp_paginate' ) ) { ?>

		<?php wp_paginate(); ?>

	<?php } else { ?>

		<?php echo $output; ?>

	<?php } ?>
	</div>
<?php

	}
}


// displays page-links for paginated posts
function wallow_link_pages() {

	wp_link_pages( 'before=<div class="navigation-links numeric-nav multipages-navigation fixfloat">' . __( 'Pages', 'wallow' ) . ':&after=</div>' );

}


// the widget area for single posts/pages
function wallow_single_widgets_area() {

	if ( !is_singular() ) return;

	if ( is_active_sidebar( 'single-widgets-area' ) ) {

?>
	<div id="single-widgets-area" class="fixfloat">
		<?php dynamic_sidebar( 'single-widgets-area' ); ?>
		<br class="fixfloat" />
	</div>
<?php

	}
}


// displays prev/next post links
function wallow_nav_posts() {

	if ( ! is_single() || is_attachment() ) return;
?>
	<div class="navigation-links single-navigation fixfloat">
		<?php previous_post_link( '%link', '&laquo; %title' ) ?><?php next_post_link( ' | %link', '%title &raquo;' ) ?>
	</div>
<?php

}


// attachments navigation
if ( !function_exists( 'wallow_navigate_attachments' ) ) {
	function wallow_navigate_attachments() {

		if ( ! is_attachment() || ! wp_attachment_is_image() ) return;

		$attachments = wallow_get_adjacent_attachments();

		if ( ! $attachments['prev'] && ! $attachments['next'] ) return;

?>
	<div class="nav-single">

		<?php if ( $attachments['prev'] ) { ?>
			<span class="nav-previous ">
				<a rel="prev" title="" href="<?php echo get_attachment_link( $attachments['prev']->ID ); ?>">&laquo; <?php echo wp_get_attachment_image( $attachments['prev']->ID, array( 70, 70 ) ); ?></a>
			</span>
		<?php } ?>

		<?php if ( $attachments['next'] ) { ?>
			<span class="nav-next">
				<a rel="next" title="" href="<?php echo get_attachment_link( $attachments['next']->ID ); ?>"><?php echo wp_get_attachment_image( $attachments['next']->ID, array( 70, 70 ) ); ?> &raquo;</a>
			</span>
		<?php } ?>

	</div><!-- #nav-single -->
<?php

	}
}


// displays the thumbnail
function wallow_the_thumb() {

	if ( wallow_get_opt( 'wallow_pthumb' ) )
		echo wallow_get_the_thumb( array( 'class' => 'alignleft', 'linked' => true ) );

}


// displays meta info (author,tags,comments,etc..)
function wallow_top_meta() {

?>
	<div class="meta">

		<?php
			if ( ! is_page() || get_comments_number() )
				wallow_post_details( array(
					'fields'				=> is_page() ? array( 'comments' ) : array( 'author', 'categories', 'tags', 'comments' ),
					'author_label'			=> __( 'by %s', 'wallow' ),
					'format'				=> 'div',
				) );
		?>

		<?php edit_post_link( __( 'Edit', 'wallow' ), '' ); ?>

		<?php if ( is_page() ) wallow_multipages(); ?>

	</div>
<?php

}


// displays post/page links (trackback, rss feed, comments)
function wallow_bottom_meta() {

	if ( ! is_singular() ) return;

	$links = '';

	if ( comments_open() && is_singular() )
		$links[] = '<a href="' . esc_url( get_post_comments_feed_link() ) . '">' . sprintf( __( '%s feed for comments on this post', 'wallow' ), '<abbr title="Really Simple Syndication">RSS</abbr>' ) . '</a>';

	if ( pings_open() )
		$links[] = '<a href="' . get_trackback_url() . '" rel="trackback">' . __( 'TrackBack URL', 'wallow' ) . '</a>';

	if ( comments_open() && is_singular() )
		$links[] = '<a href="#postcomment" title="' . __( 'Leave a comment', 'wallow' ) . '">' . __( 'Leave a comment', 'wallow' ) . '</a>';

	if ( !comments_open() && is_single() )
		$links[] = '<span>' . __( 'Comments closed', 'wallow' ) . '</span>';

	$links = implode( ' | ', $links );

	if ( $links ) {

?>
	<div class="meta comment_tools fixfloat">
		<?php echo $links; ?>
	</div>
<?php

	}

}


// default widgets to be printed in primary sidebar
if ( !function_exists( 'wallow_default_widgets' ) ) {
	function wallow_default_widgets() {

		$default_widgets = array(
			'WP_Widget_Search' => 'widget_search',
			'WP_Widget_Meta' => 'widget_meta',
			'WP_Widget_Pages' => 'widget_pages',
			'WP_Widget_Categories' => 'widget_categories',
			'WP_Widget_Archives' => 'widget_archive',
		);

		foreach ( apply_filters( 'wallow_default_widgets', $default_widgets ) as $widget => $class ) {
			the_widget( $widget, '', array(
				'before_widget'		=> '<div class="widget ' . $class . '">',
				'after_widget'		=> '</div>',
				'before_title'		=> '<h3 class="widgettitle">',
				'after_title'		=> '</h3>',
			) );
		}

	}
}


// strip tags and apply title format for blank titles
function wallow_titles_filter( $title, $id = null ) {

	if ( is_admin() ) return $title;

	$title = strip_tags( $title, '<abbr><acronym><em><i><del><ins><bdo>' );

	if ( $id == null ) return $title;

	if ( ! wallow_get_opt( 'wallow_blank_title' ) ) return $title;

	if ( empty( $title ) ) {

		if ( ! wallow_get_opt( 'wallow_blank_title_text' ) ) return __( '(no title)', 'wallow' );
		$postdata = array( get_post_format( $id )? get_post_format_string( get_post_format( $id ) ): __( 'Post', 'wallow' ), get_the_time( get_option( 'date_format' ), $id ), $id );
		$codes = array( '%f', '%d', '%n' );

		return str_replace( $codes, $postdata, wallow_get_opt( 'wallow_blank_title_text' ) );

	} else

		return $title;

}


//set the excerpt length
function wallow_excerpt_length( $length ) {

	return (int) wallow_get_opt( 'wallow_excerpt_length' );

}


// use the "excerpt more" string as a link to the post
function wallow_excerpt_more( $more ) {

	if ( is_admin() || wallow_get_opt( 'wallow_excerpt_more_txt' ) == '' ) return $more;

	if ( wallow_get_opt( 'wallow_excerpt_more_txt' ) )
		$more = wallow_get_opt( 'wallow_excerpt_more_txt' );

	if ( wallow_get_opt( 'wallow_excerpt_more_link' ) )
		$more = '<a href="' . get_permalink() . '">' . $more . '</a>';

	return $more;

}


// custom text for the "more" tag
function wallow_more_link( $more_link, $more_link_text ) {

	if ( wallow_get_opt( 'wallow_more_tag' ) && !is_admin() ) {

		$text = str_replace ( '%t', get_the_title(), wallow_get_opt( 'wallow_more_tag' ) );

		return str_replace( $more_link_text, $text, $more_link );

	}

	return $more_link;

}


//filter wp_title
function wallow_filter_wp_title( $title ) {

	if ( is_single() && empty( $title ) ) {
		$_post = get_queried_object();
		$title = wallow_titles_filter( '', $_post->ID ) . ' &laquo; ';
	}

	// Get the Site Name
	$site_name = get_bloginfo( 'name' );

	// Append name
	$filtered_title = $title . $site_name;

	// If site front page, append description
	if ( is_front_page() ) {
		// Get the Site Description
		$site_description = get_bloginfo( 'description' );
		// Append Site Description to title
		$filtered_title .= ' - ' . $site_description;
	}

	// Return the modified title
	return $filtered_title;

}


// Add specific CSS class by filter
function wallow_body_classes( $classes ) {

	if( wallow_get_opt( 'wallow_theme_set' ) === '1' ){ // use custom combinations

		$genlook	= wallow_get_opt( 'wallow_theme_genlook' );
		$sidebar	= wallow_get_opt( 'wallow_theme_sidebar' );
		$menu		= wallow_get_opt( 'wallow_theme_pages' );
		$popup		= wallow_get_opt( 'wallow_theme_popup' );
		$quickbar	= wallow_get_opt( 'wallow_theme_quickbar' );
		$avatar		= wallow_get_opt( 'wallow_theme_avatar' );

	}else{ // output a default theme set

		$theme_set	= wallow_get_opt( 'wallow_theme_set' );
		$genlook	= $theme_set;
		$sidebar	= $theme_set;
		$menu		= $theme_set;
		$popup		= $theme_set;
		$quickbar	= $theme_set;
		$avatar		= $theme_set;

	}

	$classes[] = 'body-' . $genlook;
	$classes[] = 'sidebar-' . $sidebar;
	$classes[] = 'menu-' . $menu;
	$classes[] = 'quickbar-' . $quickbar;
	$classes[] = 'popup-' . $popup;
	$classes[] = 'avatar-' . $avatar;


	$classes[] = 'wlw-no-js';

	if ( wallow_get_opt( 'wallow_qbar' ) ) $classes[] = 'quickbar';

	if ( ! wallow_get_opt( 'wallow_sidebar' ) ) $classes[] = 'no-sidebar';

	return $classes;

}


// custom image caption
function wallow_img_caption_shortcode( $deprecated, $attr, $content = null ) {

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px"><div class="wp-caption-inside">'
	. do_shortcode( $content ) . '<div class="wp-caption-text">' . $caption . '</div></div></div>';

}


function wallow_next_posts_title($content) {

	return 'title="' . __( 'Older Posts', 'wallow' ) . '"';

}


function wallow_previous_posts_title($content) {

	return 'title="' . __( 'Newer Posts', 'wallow' ) . '"';

}


//clear any floats at the end of post content
function wallow_clear_float( $content ) {

	return $content . '<br class="fixfloat" />';

}

