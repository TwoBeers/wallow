<?php
/**
 * The admin stuff
 *
 * @package wallow
 * @since wallow 0.47
 */

add_action( 'admin_init', 'wallow_default_options' ); // Tell WordPress to run wallow_default_options()
add_action( 'admin_head-appearance_page_custom-header', 'wallow_custom_header_scripts' , 99 );
add_action( 'admin_init', 'wallow_remove_custom_header_image' );


global $wallow_options, $wallow_version;

//complete options array, with type, defaults values, description, infos and required option
function wallow_get_coa( $option = false ) {

	$wallow_groups = array(
							'other' => __( 'Other' , 'wallow' ),
							'mobile' => __( 'Mobile' , 'wallow' ),
							'fonts' => __( 'Style' , 'wallow' ),
							'content' => __( 'Contents' , 'wallow' ),
							'quickbar' => __( 'Elements' , 'wallow' ),
							'appearance' => __('Appearance', 'wallow' )
	);
	
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
							'default' => '',
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
							'description' => __( 'quickbar','wallow' ),
							'info' => __( 'the fixed bar on bottom of page','wallow' ),
							'req' => '',
							'sub' => array('wallow_qbar_micronavi', '', 'wallow_qbar_avatar')
		),
		'wallow_qbar_micronavi' => 
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'navigation tool','wallow' ),
							'info' => '',
							'req' => 'wallow_qbar',
							'sub' => false
		),
		'wallow_qbar_avatar' => 
						array(
							'group' => 'quickbar',
							'type' => 'url',
							'default' => '',
							'description' => __( 'custom avatar image','wallow' ),
							'info' => 'image should be 50x50',
							'req' => '',
							'sub' => false
		),
		'wallow_primary_menu' =>
						array(
							'group' => 'quickbar',
							'type' => 'chk',
							'default' => 1,
							'description' => __( 'primary menu', 'wallow' ),
							'info' => __( 'uncheck if you want to hide it','wallow' ),
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
							'sub' => array('wallow_fontsize')
						),
		'wallow_fontsize' =>
						array(
							'group' => 'fonts',
							'type' => 'sel',
							'default' => '11px',
							'options' => array('9px','10px','11px','12px','13px','14px','15px','16px'),
							'options_readable' => array('9px','10px','11px','12px','13px','14px','15px','16px'),
							'description' => __( 'font size','wallow' ),
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
							'sub' => array('wallow_mobile_css_color')
						),
		'wallow_mobile_css_color' =>
						array(
							'group' => 'mobile',
							'type' => 'opt',
							'default' => 'light',
							'options' => array('light','dark'),
							'options_readable' => array('<img src="' . get_template_directory_uri() . '/images/mobile-light.png" alt="light" />','<img src="' . get_template_directory_uri() . '/images/mobile-dark.png" alt="dark" />'),
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
							'description' => __( 'gallery links','wallow' ),
							'info' => __( 'force galleries to use links to image instead of links to attachment','wallow' ),
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
	
	if ( $option == 'groups' )
		return $wallow_groups;
	elseif ( $option )
		return $wallow_coa[$option];
	else
		return $wallow_coa;
}


// Add custom menus
add_action( 'admin_menu', 'wallow_create_menu' );

// create custom theme settings menu
if ( !function_exists( 'wallow_create_menu' ) ) {
	function wallow_create_menu() {
		//create sub menu page to the Appearance menu - Theme Options
		$optionspage = add_theme_page( __( 'Theme Options', 'wallow' ), __( 'Theme Options', 'wallow' ), 'edit_theme_options', 'tb_wallow_functions', 'wallow_edit_options' );
		//call register settings function
		add_action( 'admin_init', 'wallow_register_settings' );
		//call custom stylesheet function
		add_action( 'admin_print_styles-widgets.php', 'wallow_widgets_style' );
		add_action( 'admin_print_scripts-widgets.php', 'wallow_widgets_scripts' );
		add_action( 'admin_print_styles-' . $optionspage, 'wallow_optionspage_style' );
		add_action( 'admin_print_scripts-' . $optionspage, 'wallow_optionspage_script' );
	}
}

if ( !function_exists( 'wallow_widgets_style' ) ) {
	function wallow_widgets_style() {
		//add custom stylesheet
		wp_enqueue_style( 'wlw-widgets-style', get_template_directory_uri() . '/css/admin-widgets.css', '', false, 'screen' );
	}
}

if ( !function_exists( 'wallow_optionspage_style' ) ) {
	function wallow_optionspage_style() {
		//add custom stylesheet
		wp_enqueue_style( 'wlw-options-style', get_template_directory_uri() . '/css/admin-options.css', array( 'farbtastic' ), false, 'screen' );
	}
}

if ( !function_exists( 'wallow_widgets_scripts' ) ) {
	function wallow_widgets_scripts() {
		global $wallow_version;
		wp_enqueue_script( 'wlw-widgets-script', get_template_directory_uri() . '/js/admin-widgets.dev.js', array('jquery'), $wallow_version, true );
	}
}

if ( !function_exists( 'wallow_optionspage_script' ) ) {
	function wallow_optionspage_script() {
		global $wallow_version;
		wp_enqueue_script( 'wlw-options-script', get_template_directory_uri() . '/js/admin-options.dev.js', array( 'jquery', 'farbtastic' ), $wallow_version, true ); //wallow js
		$data = array(
			'confirm_to_defaults' => __( 'Are you really sure you want to set all the options to their default values?', 'wallow' )
		);
		wp_localize_script( 'wlw-options-script', 'wlw_l10n', $data );
	}
}

if ( !function_exists( 'wallow_register_settings' ) ) {
	function wallow_register_settings() {
		//register general settings
		register_setting( 'wallow_theme_options', 'wallow_options', 'wallow_sanitize_options' );
	}
}


// check and set default options 
function wallow_default_options() {
		global $wallow_version;
		$wallow_options = get_option( 'wallow_options' );
		$wallow_coa = wallow_get_coa();

		// if options are empty, sets the default values
		if ( empty( $wallow_options ) || !isset( $wallow_options ) ) {
			foreach ( $wallow_coa as $key => $val ) {
				$wallow_options[$key] = $wallow_coa[$key]['default'];
			}
			$wallow_options['version'] = ''; //null value to keep admin notice alive and invite user to discover theme options
			update_option( 'wallow_options' , $wallow_options );
		} else if ( !isset( $wallow_options['version'] ) || $wallow_options['version'] < $wallow_version ) {
			// check for unset values and set them to default value -> when updated to new version
			foreach ( $wallow_coa as $key => $val ) {
				if ( !isset( $wallow_options[$key] ) ) $wallow_options[$key] = $wallow_coa[$key]['default'];
				if ( in_array( $wallow_options[$key], array( 'hide', 'inactive' ) ) ) $wallow_options[$key] = 0; //backward compatibility
				if ( in_array( $wallow_options[$key], array( 'show', 'active' ) ) ) $wallow_options[$key] = 1; //backward compatibility
			}
			$wallow_options['version'] = ''; //null value to keep admin notice alive and invite user to discover theme options
			update_option( 'wallow_options' , $wallow_options );
		}
}

// sanitize options value
if ( !function_exists( 'wallow_sanitize_options' ) ) {
	function wallow_sanitize_options( $input ){
		global $wallow_version;
		$wallow_coa = wallow_get_coa();
		// check for updated values and return 0 for disabled ones <- index notice prevention
		foreach ( $wallow_coa as $key => $val ) {

			if( $wallow_coa[$key]['type'] == 'chk' ) {
				if( !isset( $input[$key] ) ) {
					$input[$key] = 0;
				} else {
					$input[$key] = ( $input[$key] == 1 ? 1 : 0 );
				}
			} elseif( $wallow_coa[$key]['type'] == 'sel' ) {
				if ( !in_array( $input[$key], $wallow_coa[$key]['options'] ) ) $input[$key] = $wallow_coa[$key]['default'];
			} elseif( $wallow_coa[$key]['type'] == 'opt' ) {
				if ( !in_array( $input[$key], $wallow_coa[$key]['options'] ) ) $input[$key] = $wallow_coa[$key]['default'];
			} elseif( $wallow_coa[$key]['type'] == 'txt' ) {
				if( !isset( $input[$key] ) ) {
					$input[$key] = '';
				} else {
					$input[$key] = trim( strip_tags( $input[$key] ) );
				}
			} elseif( $wallow_coa[$key]['type'] == 'url' ) {
				if( !isset( $input[$key] ) ) {
					$input[$key] = '';
				} else {
					$input[$key] = esc_url( trim( strip_tags( $input[$key] ) ) );
				}
			} elseif( $wallow_coa[$key]['type'] == 'txtarea' ) {
				if( !isset( $input[$key] ) ) {
					$input[$key] = '';
				} else {
					$input[$key] = trim( strip_tags( $input[$key] ) );
				}
			} elseif( $wallow_coa[$key]['type'] == 'int' ) {
				if( !isset( $input[$key] ) ) {
					$input[$key] = $wallow_coa[$key]['default'];
				} else {
					$input[$key] = (int) $input[$key] ;
				}
			} elseif( $wallow_coa[$key]['type'] == 'col' ) {
				$color = str_replace( '#' , '' , $input[$key] );
				$color = preg_replace( '/[^0-9a-fA-F]/' , '' , $color );
				$input[$key] = '#' . $color;
			}
		}
		// check for required options
		foreach ( $wallow_coa as $key => $val ) {
			if ( $wallow_coa[$key]['req'] != '' ) { if ( $input[$wallow_coa[$key]['req']] == 0 ) $input[$key] = 0; }
		}
		$input['version'] = $wallow_version; // keep version number
		return $input;
	}
}

// the option page
if ( !function_exists( 'wallow_edit_options' ) ) {
	function wallow_edit_options() {
		if ( !current_user_can( 'edit_theme_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallow' ) );
		}
		global $wallow_options, $wallow_version, $wallow_current_theme;
		
		if ( isset( $_GET['erase'] ) && ! isset( $_REQUEST['settings-updated'] ) ) {
			delete_option( 'wallow_options' );
			wallow_default_options();
			$wallow_options = get_option( 'wallow_options' );
		}

		$wallow_coa = wallow_get_coa();
		
		// update version value when admin visit options page
		if ( $wallow_options['version'] < $wallow_version ) {
			$wallow_options['version'] = $wallow_version;
			update_option( 'wallow_options' , $wallow_options );
		}
	?>
		<div class="wrap">
			<div class="icon32 icon-appearance" id="wlw-icon"><br></div>
			<h2><?php echo $wallow_current_theme . ' - ' . __( 'Theme Options', 'wallow' ); ?></h2>
			<?php
				// return options save message
				if ( isset( $_REQUEST['settings-updated'] ) ) {
					echo '<div id="message" class="updated fade"><p><strong>' . __( 'Options saved.', 'wallow' ) . '</strong></p></div>';
				}
				// return options save message
				if ( isset( $_GET['erase'] ) && ! isset( $_REQUEST['settings-updated'] ) ) {
					echo '<div id="message" class="updated fade"><p><strong>' . __( 'Defaults values loaded.', 'wallow' ) . '</strong></p></div>';
				}
			?>
			<div id="tabs-container">
				<div id="wallow-options">
					<form method="post" action="options.php">
						<?php settings_fields( 'wallow_theme_options' ); ?>
						<ul id="wlw-tabselector" class="hide-if-no-js">
						<?php
						$wallow_groups = wallow_get_coa( 'groups' );
						foreach( $wallow_groups as $key => $name ) { ?>
							<li id="wlw-selgroup-<?php echo $key; ?>"><a href="#" onClick="wallowOptions.switchTab('<?php echo $key; ?>'); return false;"><?php echo $name; ?></a></li>
						<?php }	?>
						</ul>
						<h2 class="hide-if-js" style="text-align: center;"><?php _e( 'Appearance','wallow' ); ?></h2>
						<div class="wlw-tab-opt wlw-tabgroup-appearance">
							<span class="column-nam"><?php _e( 'Select one of the ready-made styles or mix them to build your custom style', 'wallow' ); ?></span>
							<div class="column-des"><?php _e( 'Default style = fire', 'wallow' ); ?></div>
							<?php wallow_preview(); ?>
							<div id="wallow_theme_sets"><?php
								// use a default style?
								$wallow_use_theme_set = wallow_get_types();
								$wallow_use_theme_set['1'] = __( 'custom...', 'wallow' );
								foreach ($wallow_use_theme_set as $wallow_use_theme_set_value => $wallow_use_theme_set_option) {
									$wallow_use_theme_set_selected = ($wallow_use_theme_set_value == $wallow_options['wallow_theme_set']) ? ' checked="checked"' : '';
									echo '<label><input type="radio" name="wallow_options[wallow_theme_set]" title="' . $wallow_use_theme_set_option . '" value="' . $wallow_use_theme_set_value . '" ' . $wallow_use_theme_set_selected . ' onmouseup="wallowOptions.changePreview(\'\',\'' . $wallow_use_theme_set_value . '\'); wallowOptions.toggleMixer(\'' . $wallow_use_theme_set_value . '\'); return false;">' . $wallow_use_theme_set_option . '</label>';
									}
								?>
							</div>
							<?php 
							if( $wallow_options['wallow_theme_set'] == 1 ){ /* custom style options */
								 $option_style = "display:block";
							}else{
								$option_style = "display:none";
							}
							?>
							<div id="wallow_theme_elements" style="<?php echo $option_style; ?>">
								<table>
									<tr>
										<td><?php _e( 'general looking', 'wallow' ); ?></td>
										<td style="text-align: center;">
											<?php wallow_get_theme_multi_options( 'wallow_theme_genlook' ); ?>
										</td>
									</tr>
									<tr style="background-color:#F5F5F5;">
										<td><?php _e( 'sidebar', 'wallow' ); ?></td>
										<td style="text-align: center;">
											<?php wallow_get_theme_multi_options( 'wallow_theme_sidebar' ); ?>
										</td>
									</tr>
									<tr>
										<td><?php _e( 'pages menu', 'wallow' ); ?></td>
										<td style="text-align: center;">
											<?php wallow_get_theme_multi_options( 'wallow_theme_pages' ); ?>
										</td>
									</tr>
									<tr style="background-color:#F5F5F5;">
										<td><?php _e( 'pop-up menu', 'wallow' ); ?></td>
										<td style="text-align: center;">
											<?php wallow_get_theme_multi_options( 'wallow_theme_popup' ); ?>
										</td>
									</tr>
									<tr>
										<td><?php _e( 'quickbar', 'wallow' ); ?></td>
										<td style="text-align: center;">
											<?php wallow_get_theme_multi_options( 'wallow_theme_quickbar' ); ?>
										</td>
									</tr>
									<tr style="background-color:#F5F5F5;">
										<td><?php _e( 'avatar', 'wallow' ); ?></td>
										<td style="text-align: center;">
											<?php wallow_get_theme_multi_options( 'wallow_theme_avatar' ); ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<h2 class="hide-if-js" style="text-align: center;"><?php _e( 'Options','wallow' ); ?></h2>
						<?php foreach ( $wallow_coa as $key => $val ) { ?>
							<?php if ( isset( $wallow_coa[$key]['sub'] ) && !$wallow_coa[$key]['sub'] ) continue; ?>
							<div class="wlw-tab-opt wlw-tabgroup-<?php echo $wallow_coa[$key]['group']; ?>">
								<span class="column-nam"><?php echo $wallow_coa[$key]['description']; ?></span>
							<?php if ( !isset ( $wallow_options[$key] ) ) $wallow_options[$key] = $wallow_coa[$key]['default']; ?>
							<?php if ( $wallow_coa[$key]['type'] == 'chk' ) { ?>
								<input name="wallow_options[<?php echo $key; ?>]" value="1" type="checkbox" class="ww_opt_p_checkbox" <?php checked( 1 , $wallow_options[$key] ); ?> />
							<?php } elseif ( ( $wallow_coa[$key]['type'] == 'txt' ) || ( $wallow_coa[$key]['type'] == 'int' ) || ( $wallow_coa[$key]['type'] == 'url' ) ) { ?>
								<input name="wallow_options[<?php echo $key; ?>]" value="<?php echo $wallow_options[$key]; ?>" type="text" />
							<?php } elseif ( $wallow_coa[$key]['type'] == 'txtarea' ) { ?>
								<textarea name="wallow_options[<?php echo $key; ?>]"><?php echo $wallow_options[$key]; ?></textarea>
							<?php } elseif ( $wallow_coa[$key]['type'] == 'sel' ) { ?>
								<select name="wallow_options[<?php echo $key; ?>]">
								<?php foreach( $wallow_coa[$key]['options'] as $optionkey => $option ) { ?>
									<option value="<?php echo $option; ?>" <?php selected( $wallow_options[$key], $option ); ?>><?php echo $wallow_coa[$key]['options_readable'][$optionkey]; ?></option>
								<?php } ?>
								</select>
							<?php } elseif ( $wallow_coa[$key]['type'] == 'opt' ) { ?>
								<?php foreach( $wallow_coa[$key]['options'] as $optionkey => $option ) { ?>
									<label title="<?php echo esc_attr($option); ?>"><input type="radio" <?php checked( $wallow_options[$key], $option ); ?> value="<?php echo $option; ?>" name="wallow_options[<?php echo $key; ?>]"> <span><?php echo $wallow_coa[$key]['options_readable'][$optionkey]; ?></span></label>
								<?php } ?>
							<?php } elseif ( $wallow_coa[$key]['type'] == 'col' ) { ?>
								<input class="wlw-color" style="background-color:<?php echo $wallow_options[$key]; ?>;" onclick="wallowOptions.showColorPicker('<?php echo $key; ?>');" id="wlw-color-<?php echo $key; ?>" type="text" name="wallow_options[<?php echo $key; ?>]" value="<?php echo $wallow_options[$key]; ?>" />
								<div class="wlw-colorpicker" id="wlw-colorpicker-<?php echo $key; ?>"></div>
							<?php }	?>
								<?php if ( $wallow_coa[$key]['req'] != '' ) { ?><div class="column-req"><?php echo '<u>' . __('requires','wallow') . '</u>: ' . $wallow_coa[$wallow_coa[$key]['req']]['description']; ?></div><?php } ?>
								<div class="column-des"><?php echo $wallow_coa[$key]['info']; ?></div>
							<?php if ( isset( $wallow_coa[$key]['sub'] ) ) { ?>
									<div class="wlw-sub-opt">
								<?php foreach ( $wallow_coa[$key]['sub'] as $subkey => $subval ) { ?>
									<?php if ( $subval == '' ) { echo '<br>'; continue; } ?>
									<?php if ( !isset ($wallow_options[$subval]) ) $wallow_options[$subval] = $wallow_coa[$subval]['default']; ?>
									<?php if ( $wallow_coa[$subval]['type'] == 'chk' ) { ?>
										<input name="wallow_options[<?php echo $subval; ?>]" value="1" type="checkbox" class="ww_opt_p_checkbox" <?php checked( 1 , $wallow_options[$subval] ); ?> />
										<span class="wlw-sub-opt-nam"><?php echo $wallow_coa[$subval]['description']; ?></span>
									<?php } elseif ( ( $wallow_coa[$subval]['type'] == 'txt' ) || ( $wallow_coa[$subval]['type'] == 'int' ) || ( $wallow_coa[$subval]['type'] == 'url' ) ) { ?>
										<span class="wlw-sub-opt-nam"><?php echo $wallow_coa[$subval]['description']; ?></span> :
										<input name="wallow_options[<?php echo $subval; ?>]" value="<?php echo $wallow_options[$subval]; ?>" type="text" />
									<?php } elseif ( $wallow_coa[$subval]['type'] == 'sel' ) { ?>
										<span class="wlw-sub-opt-nam"><?php echo $wallow_coa[$subval]['description']; ?></span> :
										<select name="wallow_options[<?php echo $subval; ?>]">
										<?php foreach( $wallow_coa[$subval]['options'] as $optionkey => $option ) { ?>
											<option value="<?php echo $option; ?>" <?php selected( $wallow_options[$subval], $option ); ?>><?php echo $wallow_coa[$subval]['options_readable'][$optionkey]; ?></option>
										<?php } ?>
										</select>
									<?php } elseif ( $wallow_coa[$subval]['type'] == 'opt' ) { ?>
										<span class="wlw-sub-opt-nam"><?php echo $wallow_coa[$subval]['description']; ?></span> :
										<?php foreach( $wallow_coa[$subval]['options'] as $optionkey => $option ) { ?>
											<label title="<?php echo esc_attr($option); ?>"><input type="radio" <?php checked( $wallow_options[$subval], $option ); ?> value="<?php echo $option; ?>" name="wallow_options[<?php echo $subval; ?>]"> <span><?php echo $wallow_coa[$subval]['options_readable'][$optionkey]; ?></span></label>
										<?php } ?>
									<?php } elseif ( $wallow_coa[$subval]['type'] == 'col' ) { ?>
										<span class="wlw-sub-opt-nam"><?php echo $wallow_coa[$subval]['description']; ?></span> :
										<input class="wlw-color" style="background-color:<?php echo $wallow_options[$subval]; ?>;" onclick="wallowOptions.showColorPicker('<?php echo $subval; ?>');" id="wlw-color-<?php echo $subval; ?>" type="text" name="wallow_options[<?php echo $subval; ?>]" value="<?php echo $wallow_options[$subval]; ?>" />
										<div class="wlw-colorpicker" id="wlw-colorpicker-<?php echo $subval; ?>"></div>
									<?php }	?>
									<?php if ( $wallow_coa[$subval]['info'] != '' ) { ?> - <span class="wlw-sub-opt-des"><?php echo $wallow_coa[$subval]['info']; ?></span><?php } ?>
									</br>
								<?php }	?>
									</div>
							<?php }	?>
							</div>
						<?php }	?>
						<div id="wlw-submit">
							<input type="hidden" name="wallow_options[hidden_opt]" value="default" />
							<input class="button-primary" type="submit" name="Submit" value="<?php _e( 'Update Options' , 'wallow' ); ?>" />
							<a href="themes.php?page=tb_wallow_functions" target="_self"><?php _e( 'Undo Changes' , 'wallow' ); ?></a>
							|
							<a id="to-defaults" href="themes.php?page=tb_wallow_functions&erase=1" target="_self"><?php _e( 'Back to defaults' , 'wallow' ); ?></a>
						</div>
					</form>
				</div>
				<div id="wallow-infos">
					<h2 class="hide-if-js" style="text-align: center;"><?php _e( 'Info','wallow' ); ?></h2>
					<?php locate_template( 'readme.html',true ); ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="stylediv" style="clear: both; text-align: center; border: 1px solid #ccc;">
				<small>
					<?php _e( 'If you like/dislike this theme, or if you encounter any issues, please let us know it.', 'wallow' ); ?><br />
					<a href="<?php echo esc_url( 'http://www.twobeers.net/annunci/wallow' ); ?>" title="wallow theme" target="_blank"><?php _e( 'Leave a feedback', 'wallow' ); ?></a>
				</small>
			</div>
			<div class="stylediv" style="clear: both; text-align: center; border: 1px solid #ccc; margin-top: 10px;">
				<small>Support the theme in your language, provide a <a href="<?php echo esc_url( 'http://www.twobeers.net/temi-wp/wordpress-themes-translations' ); ?>" title="Themes translation" target="_blank">translation</a>.</small>
			</div>
		</div>
		<?php
	}
}

//multi styles options - return drop down list of set options
function wallow_get_theme_multi_options( $inputName ){
	global $wallow_options;
	//check the current theme set
	if( empty( $wallow_options ) ){	//no style at all
		$current = 'fire';
	}else{
		if( $wallow_options['wallow_theme_set'] == 1 ) {	//custom set
			$current = !isset( $wallow_options[$inputName] ) ? '': $wallow_options[$inputName];
		}else{	//default theme set
			$current = '';
		}
	}
	
	$array = wallow_get_types();
	foreach ( $array as $array_value => $array_option ) {
		$array_selected = ( $array_value == $current ) ? ' checked="checked"' : '';
		
		echo '<label><input type="radio" name="wallow_options[' . $inputName . ']" title="' . $array_option . '" value="' . $array_value . '" ' . $array_selected . ' onchange="wallowOptions.changePreview(\'' . $inputName . '\',\'' . $array_value . '\'); return false;">' . $array_option . '</label>';

	}
	
}

//output preview
function wallow_preview(){
	global $wallow_options;
	//check the current theme set
	if( empty($wallow_options) ) {	//no style at all set the default
		$theme_set = 'fire';
		$genlook = $theme_set;
		$pages = $theme_set;
		$quickbar = $theme_set;
		$sidebar = $theme_set;
		$avatar = $theme_set;
		$popup = $theme_set;
	}else{
		if( isset($wallow_options['wallow_theme_set']) && $wallow_options['wallow_theme_set'] == 1 ) {	//custom set check if options are set, otherwise leave blank (in output will result fire set)
			if( isset($wallow_options['wallow_theme_genlook']) )	:	$genlook =	$wallow_options['wallow_theme_genlook'];	else: $genlook = '';	endif;
			if( isset($wallow_options['wallow_theme_pages']) )		:	$pages =	$wallow_options['wallow_theme_pages'];		else: $pages = '';		endif;
			if( isset($wallow_options['wallow_theme_quickbar']) )	:	$quickbar =	$wallow_options['wallow_theme_quickbar'];	else: $quickbar = '';	endif;
			if( isset($wallow_options['wallow_theme_sidebar']) )	:	$sidebar =	$wallow_options['wallow_theme_sidebar'];	else: $sidebar = '';	endif;
			if( isset($wallow_options['wallow_theme_avatar']) )		:	$avatar =	$wallow_options['wallow_theme_avatar'];		else: $avatar = '';		endif;
			if (isset($wallow_options['wallow_theme_popup']) )		:	$popup =	$wallow_options['wallow_theme_popup'];		else: $popup = '';		endif;
		}else{	//default theme set
			$theme_set = $wallow_options['wallow_theme_set'];
			$genlook = $theme_set;
			$pages = $theme_set;
			$quickbar = $theme_set;
			$sidebar = $theme_set;
			$avatar = $theme_set;
			$popup = $theme_set;
		}
	}
	?>
		<div id="theme_preview">
			<div id="tp_wallow_theme_genlook" class="<?php echo $genlook ?>"></div>
			<div id="tp_wallow_theme_pages" class="<?php echo $pages ?>"></div>
			<div id="tp_wallow_theme_quickbar" class="<?php echo $quickbar ?>"></div>
			<div id="tp_wallow_theme_sidebar" class="<?php echo $sidebar ?>"></div>
			<div id="tp_wallow_theme_avatar" class="<?php echo $avatar ?>"></div>
			<div id="tp_wallow_theme_popup" class="<?php echo $popup ?>"></div>
		</div>
	<?php
}

// Styles the header image displayed on the Appearance > Header admin panel.
if ( !function_exists( 'wallow_admin_header_style' ) ) {
	function wallow_admin_header_style() {
		wp_enqueue_style( 'wallow_admin-style', get_template_directory_uri() . '/css/admin-custom_header.css', false, '', 'all' );
	}
}

//Add new contact methods to author panel
if ( !function_exists( 'wallow_new_contactmethods' ) ) {
	function wallow_new_contactmethods( $contactmethods ) {
		//add Twitter
		$contactmethods['twitter'] = 'Twitter';
		//add Facebook
		$contactmethods['facebook'] = 'Facebook';

		return $contactmethods;
	}
}

//add a default gravatar
if ( !function_exists( 'wallow_addgravatar' ) ) {
	function wallow_addgravatar( $avatar_defaults ) {
	  $myavatar = get_template_directory_uri() . '/images/user.png';
	  $avatar_defaults[$myavatar] = __( 'wallow Default Gravatar', 'wallow' );

	  return $avatar_defaults;
	}
}

/**
 * Prints JavaScript codes in the header admin page, required to add the remove image link.
 *
 * @return void
 */
function wallow_custom_header_scripts() { 
	global $_wp_default_headers;
	$default_headers = $_wp_default_headers;
?>
	<script>
		jQuery(function($){
		<?php
		$uploaded_headers = get_uploaded_header_images();
		if( ! empty( $uploaded_headers ) ) { ?>
			$('.available-headers').closest('form').find('table tr:first') // prevents showing remove links for default headers
			.find('div.default-header')
			.each(function(){
				$(this).append('<br/><a href="#" class="remove_header_image delete" style="padding-left: 25px;"><?php _e( 'Remove', 'wallow' ) ?></a>');
			});
			$('a.remove_header_image').live('click', function(){
				thiz = $(this);
				if( window.confirm(commonL10n.warnDelete) ) {
					$.ajax({
						url: window.location.href,
						type: 'POST',
						data: {
							'header_image_remove': thiz.parent().find('img').attr('src')
						},
						success: function(data){
							thiz.parent().fadeOut('slow', function(){
								$(this).remove();
							});
						}
					});
				}
				return false;
			});
		<?php } ?>
		});
	</script>
<?php }

/**
 * Remove header image
 *
 * @uses wp_delete_attachment
 * @return void
 */
function wallow_remove_custom_header_image() {
	global $wpdb;

	if( isset( $_POST['header_image_remove'] ) ) {
		if( ! $post = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' AND post_content = %s", $_POST['header_image_remove'] ) ) ) {
			return;
		}
		wp_delete_attachment( $post->ID, true ); // true: force_delete, bypass trash
	}
}

?>