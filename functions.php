<?php

add_action( 'after_setup_theme', 'wallow_setup' ); // Tell WordPress to run wallow_setup() when the 'after_setup_theme' hook is run.
add_action( 'widgets_init', 'wallow_widget_area_init' ); // Register sidebars by running wallow_widget_area_init() on the widgets_init hook
add_action( 'template_redirect', 'wallow_scripts' ); // Add js animations
add_action( 'wp_enqueue_scripts', 'wallow_stylesheet' ); // Add stylesheets
add_action( 'template_redirect', 'wallow_allcat' ); // allcat page redirect
add_action( 'wp_print_styles', 'wallow_deregister_styles', 100 ); // deregister styles
add_action( 'wp_footer', 'wallow_init_scripts' ); //initialize some scripts
add_action( 'wp_head', 'wallow_custom_css' ); //custom css code

// Custom filters
add_filter( 'the_content', 'wallow_content_replace' );
add_filter( 'the_title', 'wallow_title_tags_filter', 10, 2 );
add_filter( 'excerpt_length', 'wallow_excerpt_length' );
add_filter( 'excerpt_more', 'wallow_excerpt_more' );
add_filter( 'the_content_more_link', 'wallow_more_link', 10, 2 );
add_filter( 'post_gallery', 'wallow_gallery_shortcode', 10, 2 );
add_filter( 'next_posts_link_attributes', 'wallow_next_posts_title' ); 
add_filter( 'previous_posts_link_attributes', 'wallow_previous_posts_title' ); 


$wallow_options = get_option( 'wallow_options' );
$wallow_is_mobile_browser = false;

// load modules (accordingly to http://justintadlock.com/archives/2010/11/17/how-to-load-files-within-wordpress-themes)
require_once( 'mobile/core-mobile.php' ); // load the mobile theme
require_once( 'lib/admin.php' ); // load the admin stuff
if ( $wallow_options['wallow_custom_widgets'] == 1 ) require_once( 'lib/widgets.php' ); // load the custom widgets module

// get the theme types
function wallow_get_types() {
	$wallow_types = array( 'fire' => __( 'fire', 'wallow' ) , 'air' => __( 'air', 'wallow' ) , 'water' => __( 'water', 'wallow' ) , 'earth' => __( 'earth', 'wallow' ), 'smoke' => __( 'smoke', 'wallow' ) , 'clouds' => __( 'clouds', 'wallow' ) );
	return $wallow_types;
}

// Set the content_width (with a 1024x768 window size)
if ( ! isset( $content_width ) )
	$content_width = 640;

// get theme version
if ( function_exists( 'wp_get_theme' ) ) {
	$wallow_theme = wp_get_theme( 'wallow' );
	$wallow_current_theme = wp_get_theme();
} else { // Compatibility with versions of WordPress prior to 3.4.
	$wallow_theme = get_theme( 'Wallow' );
	$wallow_current_theme = get_current_theme();
}
$wallow_version = $wallow_theme? $wallow_theme['Version'] : '';


if ( !function_exists( 'wallow_setup' ) ) {
	function wallow_setup() {
		global $wallow_is_mobile_browser;

		// Register localization support
		load_theme_textdomain( 'wallow', get_template_directory() . '/languages' );

		// Theme uses wp_nav_menu() in one location
		register_nav_menus( array( 'primary' => __( 'Main Navigation Menu', 'wallow' ) ) );

		// Register Features Support
		add_theme_support( 'automatic-feed-links' );

		// Thumbnails support
		add_theme_support( 'post-thumbnails' );

		// skip the rest if in mobile view
		if ( $wallow_is_mobile_browser ) return;
		
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
	 
		if ( function_exists( 'get_custom_header' ) ) {
			add_theme_support( 'custom-header', $args );
		} else {
			// Compatibility with versions of WordPress prior to 3.4.
			define( 'HEADER_TEXTCOLOR',		$args['default-text-color'] );
			define( 'NO_HEADER_TEXT',		$args['header-text'] );
			define( 'HEADER_IMAGE',			$args['default-image'] );
			define( 'HEADER_IMAGE_WIDTH',	$args['width'] );
			define( 'HEADER_IMAGE_HEIGHT',	$args['height'] );
			add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'] );
		}
	}
}

// the custom background support
if ( !function_exists( 'wallow_setup_custom_background' ) ) {
	function wallow_setup_custom_background() {
		$args = array( 'default-color' => '' );
		if ( function_exists( 'get_custom_header' ) ) {
			add_theme_support( 'custom-background', $args );
		} else {
			// Compat: Versions of WordPress prior to 3.4.
			define( 'BACKGROUND_COLOR', $args['default-color'] );
			add_custom_background();
		}
	}
}

// the custom header style - add style customization to page - gets included in the site header
if ( !function_exists( 'wallow_header_style' ) ) {
	function wallow_header_style(){
		global $wallow_options;
		$style = '';
		if ( get_header_image() != '' ) $style = 'display:none;';
?>

		<style type="text/css">
			#header h1 a, #header .description {
				<?php echo $style; ?>
			}
			body {
				font-size: <?php echo isset( $wallow_options['wallow_fontsize'] ) ? $wallow_options['wallow_fontsize'] : '11px'; ?>;
<?php if ( $wallow_options['wallow_google_font_family'] && $wallow_options['wallow_google_font_body'] ) { ?>
				font-family: <?php echo $wallow_options['wallow_google_font_family']; ?>;
<?php } else { ?>
				font-family: <?php echo $wallow_options['wallow_font_family']; ?>;
<?php } ?>
			}
<?php if ( $wallow_options['wallow_google_font_family'] && $wallow_options['wallow_google_font_post_title'] ) { ?>
			h3.storytitle {
				font-family: <?php echo $wallow_options['wallow_google_font_family']; ?>;
			}
<?php } ?>
<?php if ( $wallow_options['wallow_google_font_family'] && $wallow_options['wallow_google_font_post_content'] ) { ?>
			.storycontent {
				font-family: <?php echo $wallow_options['wallow_google_font_family']; ?>;
			}
<?php } ?>

		</style>

<?php

	}
}

// custom css
if ( !function_exists( 'wallow_custom_css' ) ) {
	function wallow_custom_css(){
		global $wallow_options;

?>
		<style type="text/css">
<?php 
		if ( $wallow_options['wallow_custom_css'] )
			echo $wallow_options['wallow_custom_css']; 
?>
		</style>
<?php

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

if ( !function_exists( 'wallow_widget_area_init' ) ) {
	function wallow_widget_area_init() {
		global $wallow_options;
		// Registers the right sidebar
		register_sidebar( array(
			'name'          => 'Sidebar',
			'id'            => 'sidepad',
			'description'   => __( 'drag here your favorite widgets', 'wallow' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3>',
			'after_title' 	=> '</h3>',
		));
		
		if ( !isset( $wallow_options['wallow_qbar'] ) || $wallow_options['wallow_qbar'] ) { 
			// Register the Quickbar as sidebar
			register_sidebar( array(
				'name'          =>	'Quickbar',
				'id'            =>	'w-quickbar',
				'description'   =>	__( 'drag here your favorite widgets', 'wallow' ),
				'before_widget' => '<div id="%1$s" class="footer_wig %2$s">',
				'after_widget'	=>	'</div></div></div>',
				'before_title'	=>	'<h4>',
				'after_title'	=>	' &raquo;</h4><div class="fw_pul_cont"><div class="fw_pul">',
			));
		}
		// 404
		register_sidebar( array(
			'name' => __( 'Page 404', 'wallow' ),
			'id' => '404-widgets-area',
			'description' => __( 'Enrich the page 404 with some useful widgets', 'wallow' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
	}
}

// check if is "all category" page
$wallow_is_allcat_page = false;
if( isset( $_GET['allcat'] ) && ( md5( $_GET['allcat'] ) == '415290769594460e2e485922904f345d' ) ) {
	$wallow_is_allcat_page = true;
}

// show all categories list (redirect to allcat.php if allcat=y)
function wallow_allcat () {
	global $wallow_is_allcat_page;
	if( $wallow_is_allcat_page ) {
		get_template_part( 'allcat' );
		exit;
	}
}

// add scripts
function wallow_scripts(){
	global $wallow_version, $wallow_options, $wallow_is_mobile_browser;

	if ( $wallow_is_mobile_browser ) return;

	if ( !isset($wallow_options['wallow_jsani']) || $wallow_options['wallow_jsani'] ) {
		wp_enqueue_script( 'wallowscript', get_template_directory_uri() . '/js/wallowscript.min.js', array( 'jquery' ), $wallow_version, true  ); //wallow js
	}

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// thickbox
	if ( ( $wallow_options['wallow_thickbox'] == 1 ) ) {
		wp_enqueue_script( 'thickbox' );
	}

}

// initialize scripts
if ( !function_exists( 'wallow_init_scripts' ) ) {
	function wallow_init_scripts(){
		global $wallow_options, $wallow_is_mobile_browser;

?>

		<script type="text/javascript">
			/* <![CDATA[ */
			(function(){
				var c = document.body.className;
				c = c.replace(/ff-no-js/, 'ff-js');
				document.body.className = c;
			})();
			/* ]]> */
		</script>

<?php if ( $wallow_is_mobile_browser || !$wallow_options['wallow_jsani'] ) return; ?>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#error404-widgets-area .widget:nth-child(odd)').css('clear', 'left');
<?php if ( $wallow_options['wallow_thickbox'] ) { ?>
				$('.storycontent a img').parent('a[href$=".jpg"],a[href$=".png"],a[href$=".gif"]').addClass('thickbox');
				$('.storycontent .gallery').each(function() {
					$('a[href$=".jpg"],a[href$=".png"],a[href$=".gif"]',$(this)).attr('rel', $(this).attr('id'));
				});
<?php } ?>
			});
			/* ]]> */
		</script>

<?php

	}
}

// deregister style for installed plugins
function wallow_deregister_styles() {
	//here goes something
}

// Add stylesheets to page
function wallow_stylesheet(){
	global $wallow_version, $wallow_options, $wallow_is_mobile_browser;

	if ( $wallow_is_mobile_browser ) return;

	// thickbox
	if ( ( $wallow_options['wallow_thickbox'] == 1 ) ) {
		wp_enqueue_style( 'thickbox' );
	}

	//normal view
	wp_enqueue_style( 'wallow_general-style', get_stylesheet_uri(), false, $wallow_version, 'screen' );
	wallow_get_style();

	//print style
	wp_enqueue_style( 'wallow_print-style', get_template_directory_uri() . '/css/print.css', false, $wallow_version, 'print' );

	//google font
	if ( $wallow_options['wallow_google_font_family'] ) wp_enqueue_style( 'wallow_google-fonts', 'http://fonts.googleapis.com/css?family=' . str_replace( ' ', '+' , $wallow_options['wallow_google_font_family'] ) );

}

// page hierarchy
if ( !function_exists( 'wallow_multipages' ) ) {
	function wallow_multipages(){
		global $post;
		$args = array(
			'post_type' => 'page',
			'post_parent' => $post->ID,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'numberposts' => 0
			);
		$childrens = get_posts($args); // retrieve the child pages
		$the_parent_page = $post->post_parent; // retrieve the parent page

		if ( ( $childrens ) || ( $the_parent_page ) ){ ?>
			<?php
			echo '<br />' . __( 'This page has hierarchy', 'wallow' ) . ' - ';
			if ( $the_parent_page ) {
				$the_parent_link = '<a href="' . get_permalink( $the_parent_page ) . '" title="' . get_the_title( $the_parent_page ) . '">' . get_the_title( $the_parent_page ) . '</a>';
				echo __( 'Parent page: ', 'wallow' ) . $the_parent_link ; // echoes the parent
			}
			if ( ( $childrens ) && ( $the_parent_page ) ) { echo ' - '; } // if parent & child, echoes the separator
			if ( $childrens ) {
				$the_child_list = '';
				foreach ( $childrens as $children ) {
					$the_child_list[] = '<a href="' . get_permalink( $children ) . '" title="' . get_the_title( $children ) . '">' . get_the_title( $children ) . '</a>';
				}
				$the_child_list = implode( ', ' , $the_child_list );
				echo __( 'Child pages: ', 'wallow' ) . $the_child_list; // echoes the childs
			}
			?>
		<?php }
	}
}

// micronav
if ( !function_exists( 'wallow_micronav' ) ) {
	function wallow_micronav() {
		global $post, $wallow_is_allcat_page, $wallow_options;

		if ( !isset ($wallow_options['wallow_qbar_micronavi'] ) || ( ! $wallow_options['wallow_qbar_micronavi'] ) ) return;

		wp_reset_postdata();
		
		$is_post = is_single() && !is_attachment() && !$wallow_is_allcat_page;
		$is_archive = ( is_archive() || is_search() || is_home() ) && !$wallow_is_allcat_page;

		if ( $is_post ) {
			$prev = get_next_post()? '<a title="' . sprintf( __( 'Next Post', 'wallow' ) . ': %s', get_the_title( get_next_post() ) ) . '" href="' . get_permalink( get_next_post() ) . '">&nbsp;</a>' : '';
			$next = get_previous_post()? '<a title="' . sprintf( __( 'Previous Post', 'wallow' ) . ': %s', get_the_title( get_previous_post() ) ) . '" href="' . get_permalink( get_previous_post() ) . '">&nbsp;</a>' : '';
		} elseif ( $is_archive ) {
			$next = get_next_posts_link()? get_next_posts_link('&nbsp;') : '';
			$prev = get_previous_posts_link()? get_previous_posts_link('&nbsp;') : '';
		} else {
			$next = '';
			$prev =  '';
		}

?>
		<div id="micronav">
			<div class="next"><?php echo $next; ?></div>
			<div class="prev"><?php echo $prev; ?></div>
			<div class="home"><a title="<?php _e( 'Home', 'wallow' ); ?>" href="<?php echo home_url(); ?>">&nbsp;</a></div>
			<div class="up"><a title="<?php _e( 'Top', 'wallow' ); ?>" href="#">&nbsp;</a></div>
			<div class="down"><a title="<?php _e( 'Bottom', 'wallow' ); ?>" href="#credits">&nbsp;</a></div>
		</div>
<?php

	}
}

// Pages Menu
if ( !function_exists( 'wallow_pages_menu' ) ) {
	function wallow_pages_menu() {
		echo '<ul id="mainmenu">';
		wp_list_pages( 'sort_column=menu_order&title_li=' ); // menu-order sorted
		echo '</ul>';
	}
}

//output style
function wallow_get_style() {
	global $wallow_version, $wallow_options;
	$style_path = get_template_directory_uri() . '/css/';
	if( isset($wallow_options['wallow_theme_set']) && $wallow_options['wallow_theme_set'] == 1 ){ // check if use set or custom combinations
		$genlook = 	isset($wallow_options['wallow_theme_genlook'])	? $wallow_options['wallow_theme_genlook']	:'fire';
		$sidebar = 	isset($wallow_options['wallow_theme_sidebar'])	? $wallow_options['wallow_theme_sidebar']	:'fire';
		$pages = 	isset($wallow_options['wallow_theme_pages'])		? $wallow_options['wallow_theme_pages']		:'fire';
		$popup = 	isset($wallow_options['wallow_theme_popup'])		? $wallow_options['wallow_theme_popup']		:'fire';
		$quickbar = isset($wallow_options['wallow_theme_quickbar'])	? $wallow_options['wallow_theme_quickbar']	:'fire';
		$avatar = 	isset($wallow_options['wallow_theme_avatar'])	? $wallow_options['wallow_theme_avatar']	:'fire';
	}else{ // output a default theme set
		if ($wallow_options['wallow_theme_set']) {
			$theme_set = $wallow_options['wallow_theme_set'];
		}else{
			$theme_set = "fire";
		}
		$genlook =	$theme_set;
		$sidebar =	$theme_set;
		$pages =	$theme_set;
		$popup =	$theme_set;
		$quickbar =	$theme_set;
		$avatar =	$theme_set;
		
	}
	$style_path = $style_path . 'load-styles.php?st=' . $genlook . '&amp;si=' . $sidebar . '&amp;pa=' . $pages . '&amp;po=' . $popup . '&amp;qu=' . $quickbar . '&amp;av=' . $avatar;
	wp_enqueue_style( 'wallow_theme_genlook-style', $style_path, false, $wallow_version, 'screen' );
}

//add a fix for embed videos overlying quickbar
function wallow_content_replace( $content ){
	global $wallow_is_mobile_browser;
	
	if ( $wallow_is_mobile_browser )
		return $content;

	$content = str_replace( '<param name="allowscriptaccess" value="always">', '<param name="allowscriptaccess" value="always"><param name="wmode" value="transparent">', $content );
	$content = str_replace( '<embed ', '<embed wmode="transparent" ', $content );
	return $content;
}

// strip tags from titles and apply title format for blank ones
function wallow_title_tags_filter( $title, $id ) {
	global $wallow_options;
	
	if ( is_admin() ) return $title;
	
	$title = strip_tags( $title, '<abbr><acronym><b><em><i><del><ins><bdo><strong>' );
	
	if ( empty( $title ) ) {
		if ( !isset( $wallow_options['wallow_blank_title'] ) || empty( $wallow_options['wallow_blank_title'] ) ) return __( '(no title)', 'wallow' );
		$postdata = array( get_post_format( $id )? __(get_post_format( $id ), 'wallow' ): __( 'post', 'wallow' ), get_the_time( get_option( 'date_format' ), $id ) );
		$codes = array( '%f', '%d' );
		return str_replace( $codes, $postdata, $wallow_options['wallow_blank_title'] );
	} else
		return $title;
}

//set the excerpt length
if ( !function_exists( 'wallow_excerpt_length' ) ) {
	function wallow_excerpt_length( $length ) {
		global $wallow_options;
		return (int) $wallow_options['wallow_excerpt_length'];
	}
}

// use the "excerpt more" string as a link to the post
function wallow_excerpt_more( $more ) {
	global $wallow_options, $post;

	if ( is_admin() || empty( $wallow_options['wallow_excerpt_more_txt'] ) ) return $more;

	if ( $wallow_options['wallow_excerpt_more_link'] ) {
		return ' <a href="' . get_permalink() . '">' . esc_html( $wallow_options['wallow_excerpt_more_txt'] ) . '</a>';
	} else {
		return ' ' . esc_html( $wallow_options['wallow_excerpt_more_txt'] );
	}

	return $more;
}

// custom text for the "more" tag
function wallow_more_link( $more_link, $more_link_text ) {
	global $wallow_options;
	
	if ( isset( $wallow_options['wallow_more_tag'] ) && !is_admin() && !empty( $wallow_options['wallow_more_tag'] ) ) {
		$text = esc_html( str_replace ( '%t', get_the_title(), $wallow_options['wallow_more_tag'] ) );
		return str_replace( $more_link_text, $text, $more_link );
	}
	return $more_link;
}

// The Gallery shortcode
function wallow_gallery_shortcode( $null, $attr ) {
	global $post, $wallow_options;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	if ( $wallow_options['wallow_thickbox_link_to_image'] == 1 ) $attr['link'] = 'file';

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = $gallery_div;

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}

function wallow_next_posts_title($content) {
	return 'title="' . __( 'Older Posts', 'wallow' ) . '"';
}
function wallow_previous_posts_title($content) {
	return 'title="' . __( 'Newer Posts', 'wallow' ) . '"';
}


?>
