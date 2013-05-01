<?php
/**
 * options.php
 *
 * the options array
 *
 * @package Wallow
 * @since 0.60
 */


// Complete Options Array, with type, defaults values, description, infos and required option
function wallow_get_coa( $option = false ) {

	$wallow_groups = array(
							'other'			=> __( 'Other' , 'wallow' ),
							'mobile'		=> __( 'Mobile' , 'wallow' ),
							'fonts'			=> __( 'Style' , 'wallow' ),
							'content'		=> __( 'Contents' , 'wallow' ),
							'quickbar'		=> __( 'Elements' , 'wallow' ),
							'appearance'	=> __( 'Appearance', 'wallow' )
	);
	$wallow_groups = apply_filters( 'wallow_options_groups', $wallow_groups );

	$wallow_coa = array(
		'wallow_theme_set' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_theme_genlook' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_theme_sidebar' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_theme_pages' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_theme_popup' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_theme_quickbar' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_theme_avatar' =>
						array(
							'type' => 'opt',
							'default' => 'fire',
							'options' => array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds', 1 ),
							'req' => '',
							'sub' => false
						),
		'wallow_blank_title' =>
						array(
							'group' => 'content',
							'type' => 'txt',
							'default' => __( '(no title)', 'wallow' ),
							'description' => __( 'blank titles', 'wallow' ),
							'info' => __( 'set the standard text for blank titles. you may use these codes:<br /><code>%d</code> for post date<br /><code>%f</code> for post format (if any)', 'wallow' ),
							'req' => ''
						),
		'wallow_postexcerpt' =>
						array(
							'group' => 'content',
							'type' => 'chk',
							'default' => 0,
							'description' => __( 'content summary', 'wallow' ),
							'info' => __( 'use the summary instead of content in archives', 'wallow' ) . ' (<a href="http://codex.wordpress.org/Template_Tags/the_excerpt" target="_blank">Codex</a>)',
							'req' => '',
							'sub' => array( 'wallow_excerpt_length', 'wallow_excerpt_more_txt', 'wallow_excerpt_more_link' )
						),
		'wallow_excerpt_length' =>
						array(
							'group' => 'content',
							'type' => 'int',
							'default' => 55,
							'description' => __( 'excerpt length', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_excerpt_more_txt' =>
						array(
							'group' => 'content',
							'type' => 'txt',
							'default' => '[...]',
							'description' => __( '<em>excerpt more</em> string', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_excerpt_more_link' =>
						array(
							'group' => 'content',
							'type' => 'chk',
							'default' => 0,
							'description' => __( '<em>excerpt more</em> linked', 'wallow' ),
							'info' => __( 'use the <em>excerpt more</em> string as a link to the full post', 'wallow' ),
							'req' => '',
							'sub' => false
						),
		'wallow_more_tag' =>
						array(
							'group' => 'content',
							'type' => 'txt',
							'default' => '',
							'description' => __( '"more" tag string', 'wallow' ),
							'info' => __( 'only plain text. use <code>%t</code> as placeholder for the post title', 'wallow' ) . ' (<a href="http://codex.wordpress.org/Customizing_the_Read_More" target="_blank">Codex</a>)',
							'req' => ''
						),
		'wallow_pthumb' =>
						array(
							'group' => 'content',
							'type' => 'chk',
							'default' => 0,
							'description' => __( 'posts thumbnail', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => array( 'wallow_pthumb_size' )
						),
		'wallow_pthumb_size' =>
						array(
							'group' => 'content',
							'type' => 'sel',
							'default' => 150,
							'options' => array( 64, 96, 120, 150 ),
							'options_readable' => array( '64px', '96px', '120px', '150px' ),
							'description' => __( 'thumbnail size', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_qbar' => 
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'quickbar', 'wallow' ),
							'info' => __( 'the fixed bar on bottom of page', 'wallow' ),
							'req' => '',
							'sub' => array( 'wallow_qbar_micronavi', '', 'wallow_qbar_show_avatar', 'wallow_qbar_avatar', '', 'wallow_qbar_date' )
						),
		'wallow_qbar_micronavi' => 
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'navigation tool', 'wallow' ),
							'info' => '',
							'req' => 'wallow_qbar',
							'sub' => false
						),
		'wallow_qbar_show_avatar' => 
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'avatar', 'wallow' ),
							'info' => '',
							'req' => 'wallow_qbar',
							'sub' => false
						),
		'wallow_qbar_avatar' => 
						array(
							'group' => 'quickbar',
							'type' => 'url',
							'default' => '',
							'description' => __( 'custom avatar image', 'wallow' ),
							'info' => __( 'image should be 50x50', 'wallow' ),
							'req' => '',
							'sub' => false
						),
		'wallow_qbar_date' => 
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'date', 'wallow' ),
							'info' => '',
							'req' => 'wallow_qbar',
							'sub' => false
						),
		'wallow_primary_menu' =>
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'primary menu', 'wallow' ),
							'info' => __( 'uncheck if you want to hide it', 'wallow' ),
							'req' => ''
						),
		'wallow_sidebar' =>
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'right sidebar', 'wallow' ),
							'info' => __( 'uncheck if you want to hide it', 'wallow' ),
							'req' => ''
						),
		'wallow_font_family'=>
						array(
							'group' => 'fonts',
							'type' => 'sel',
							'default' => 'Verdana, Geneva, sans-serif',
							'description' => __( 'font family', 'wallow' ),
							'info' => '',
							'options' => array( 'Arial, sans-serif', 'Comic Sans MS, cursive', 'Courier New, monospace', 'Georgia, serif', 'Helvetica, sans-serif', 'Lucida Console, Monaco, monospace', 'Lucida Sans Unicode, Lucida Grande, sans-serif', 'monospace', 'Palatino Linotype, Book Antiqua, Palatino, serif', 'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif', 'Trebuchet MS, sans-serif', 'Verdana, Geneva, sans-serif' ),
							'options_readable' => array( 'Arial, sans-serif', 'Comic Sans MS, cursive', 'Courier New, monospace', 'Georgia, serif', 'Helvetica, sans-serif', 'Lucida Console, Monaco, monospace', 'Lucida Sans Unicode, Lucida Grande, sans-serif', 'monospace', 'Palatino Linotype, Book Antiqua, Palatino, serif', 'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif', 'Trebuchet MS, sans-serif', 'Verdana, Geneva, sans-serif' ),
							'req' => '',
							'sub' => array( 'wallow_fontsize' )
						),
		'wallow_fontsize' =>
						array(
							'group' => 'fonts',
							'type' => 'sel',
							'default' => '11px',
							'options' => array( '9px', '10px', '11px', '12px', '13px', '14px', '15px', '16px' ),
							'options_readable' => array( '9px', '10px', '11px', '12px', '13px', '14px', '15px', '16px' ),
							'description' => __( 'font size', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_google_font_family'=>
						array(
							'group' => 'fonts',
							'type' => 'txt',
							'default' => '',
							'description' => __( 'Google web font', 'wallow' ),
							'info' => __( 'Copy and paste <a href="http://www.google.com/webfonts" target="_blank"><strong>Google web font</strong></a> name here. Example: <code>Architects Daughter</code>', 'wallow' ),
							'req' => '',
							'sub' => array( 'wallow_google_font_body', 'wallow_google_font_post_title', 'wallow_google_font_post_content' )
						),
		'wallow_google_font_body' =>
						array(
							'group' => 'fonts',
							'type' => 'chk',
							'default' => 0,
							'description' => __( 'for whole page', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_google_font_post_title' =>
						array(
							'group' => 'fonts',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'for posts/pages title', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_google_font_post_content' =>
						array(
							'group' => 'fonts',
							'type' => 'chk',
							'default' => 0,
							'description' => __( 'for posts/pages content', 'wallow' ),
							'info' => '',
							'req' => '',
							'sub' => false
						),
		'wallow_mobile_css' =>
						array(
							'group' => 'mobile',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'mobile support', 'wallow' ),
							'info' => __( "detect mobile devices and use a dedicated style. Disable it if you don't like it or you're already using a plugin for mobile support", 'wallow' ),
							'req' => '',
							'sub' => array( 'wallow_mobile_css_color' )
						),
		'wallow_mobile_css_color' =>
						array(
							'group' => 'mobile',
							'type' => 'opt',
							'default' => 'light',
							'options' => array( 'light', 'dark' ),
							'options_readable' => array( '<img src="' . get_template_directory_uri() . '/images/mobile-light.png" alt="light" />', '<img src="' . get_template_directory_uri() . '/images/mobile-dark.png" alt="dark" />' ),
							'description' => __( 'colors', 'wallow' ),
							'info' => __( "", 'wallow' ),
							'req' => '',
							'sub' => false
						),
		'wallow_jsani' =>
						array(
							'group' => 'other',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'javascript animations', 'wallow' ),
							'info' => __( 'try disable animations if you encountered problems with javascript', 'wallow' ),
							'req' => ''
						),
		'wallow_thickbox' =>
						array(
							'group' => 'other',
							'type' => 'chk',
							'default' => 0,
							'description' => __( 'thickbox', 'wallow' ),
							'info' => __( 'use thickbox for showing images and galleries', 'wallow' ),
							'req' => 'wallow_jsani',
							'sub' => array( 'wallow_thickbox_link_to_image' )
						),
		'wallow_thickbox_link_to_image' =>
						array(
							'group' => 'other',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'gallery links', 'wallow' ),
							'info' => __( 'force galleries to use links to image instead of links to attachment', 'wallow' ),
							'req' => '',
							'sub' => false
						),
		'wallow_custom_widgets' =>
						array(
							'group' => 'other',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'custom widgets', 'wallow' ),
							'info' => __( 'add a lot of new usefull widgets', 'wallow' ),
							'req' => ''
						),
		'wallow_custom_css' =>
						array(
							'group' => 'fonts',
							'type' => 'txtarea',
							'default' => '',
							'description' => __( 'custom CSS code', 'wallow' ),
							'info' => __( '<strong>For advanced users only</strong>: paste here your custom css code. it will be added after the defatult style', 'wallow' ) . ' (<a href="'. get_stylesheet_uri() .'" target="_blank">style.css</a>)',
							'req' => ''
						),
		'wallow_tbcred' =>
						array(
							'group' => 'other',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'theme credits', 'wallow' ),
							'info' => __( "please, don't hide theme credits. TwoBeers.net's authors reserve themselfs to give support only to those who recognize TwoBeers work, keeping TwoBeers.net credits visible on their site.", 'wallow' ),
							'req' => ''
						)
	);
	$wallow_coa = apply_filters( 'wallow_options_array', $wallow_coa );

	if ( $option == 'groups' )
		return $wallow_groups;
	elseif ( $option )
		return isset( $wallow_coa[$option] ) ? $wallow_coa[$option] : false;
	else
		return $wallow_coa;
}


// retrive the required option. If the option ain't set, the default value is returned
if ( !function_exists( 'wallow_get_opt' ) ) {
	function wallow_get_opt( $opt ) {
		global $wallow_opt;

		if ( isset( $wallow_opt[$opt] ) ) return apply_filters( 'wallow_option_override', $wallow_opt[$opt], $opt );

		$defopt = wallow_get_coa( $opt );

		if ( ! $defopt ) return null;

		if ( ( $defopt['req'] == '' ) || ( wallow_get_opt( $defopt['req'] ) ) )
			return $defopt['default'];
		else
			return null;

	}
}
