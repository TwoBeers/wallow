<?php
/**
 * The admin stuff
 *
 * @package wallow
 * @since wallow 0.47
 */

/* Custom actions - WP hooks */

add_action( 'admin_init'								, 'wallow_default_options' );
add_action( 'admin_head-appearance_page_custom-header'	, 'wallow_custom_header_scripts' , 99 );
add_action( 'admin_init'								, 'wallow_remove_custom_header_image' );
add_action( 'admin_menu'								, 'wallow_create_menu' );


// create custom theme settings menu
if ( !function_exists( 'wallow_create_menu' ) ) {
	function wallow_create_menu() {

		//create sub menu page to the Appearance menu - Theme Options
		$optionspage = add_theme_page(
			__( 'Theme Options', 'wallow' ),
			__( 'Theme Options', 'wallow' ),
			'edit_theme_options',
			'tb_wallow_functions',
			'wallow_edit_options'
		);

		//call register settings function
		add_action( 'admin_init'							, 'wallow_register_settings' );

		//call custom stylesheet and script function
		add_action( 'admin_print_styles-widgets.php'		, 'wallow_widgets_style' );
		add_action( 'admin_print_scripts-widgets.php'		, 'wallow_widgets_scripts' );
		add_action( 'admin_print_styles-' . $optionspage	, 'wallow_optionspage_style' );
		add_action( 'admin_print_scripts-' . $optionspage	, 'wallow_optionspage_script' );

	}
}


//add custom stylesheet
if ( !function_exists( 'wallow_widgets_style' ) ) {
	function wallow_widgets_style() {

		wp_enqueue_style(
			'wlw-widgets-style',
			get_template_directory_uri() . '/css/admin-widgets.css',
			array(),
			wallow_get_info( 'version' ),
			'screen'
		);

	}
}


//add custom stylesheet
if ( !function_exists( 'wallow_optionspage_style' ) ) {
	function wallow_optionspage_style() {

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_style(
			'wlw-options-style',
			get_template_directory_uri() . '/css/admin-options.css',
			array( 'farbtastic' ),
			wallow_get_info( 'version' ),
			'screen'
		);

	}
}


//add script to page
if ( !function_exists( 'wallow_widgets_scripts' ) ) {
	function wallow_widgets_scripts() {

		wp_enqueue_script(
			'wlw-widgets-script',
			get_template_directory_uri() . '/js/admin-widgets.dev.js',
			array('jquery'),
			wallow_get_info( 'version' ),
			true
		);

	}
}


//add script to page
if ( !function_exists( 'wallow_optionspage_script' ) ) {
	function wallow_optionspage_script() {

		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_script(
			'wlw-options-script',
			get_template_directory_uri() . '/js/admin-options.dev.js',
			array( 'jquery', 'farbtastic' ),
			wallow_get_info( 'version' ),
			true
		);

		$data = array(
			'confirm_to_defaults' => __( 'Are you really sure you want to set all the options to their default values?', 'wallow' )
		);
		wp_localize_script(
			'wlw-options-script',
			'wlw_L10n',
			$data
		);
	}
}


//register general settings
if ( !function_exists( 'wallow_register_settings' ) ) {
	function wallow_register_settings() {

		register_setting( 'wallow_theme_options', 'wallow_options', 'wallow_sanitize_options' );

	}
}


// check and set default options 
if ( !function_exists( 'wallow_default_options' ) ) {
	function wallow_default_options() {

		$wallow_opt = get_option( 'wallow_options' );
		$wallow_coa = wallow_get_coa();

		// if options are empty, sets the default values
		if ( empty( $wallow_opt ) || !isset( $wallow_opt ) ) {

			foreach ( $wallow_coa as $key => $val ) {
				$wallow_opt[$key] = $wallow_coa[$key]['default'];
			}
			$wallow_opt['version'] = ''; //null value to keep admin notice alive and invite user to discover theme options
			update_option( 'wallow_options' , $wallow_opt );

		} else if ( !isset( $wallow_opt['version'] ) || $wallow_opt['version'] < wallow_get_info( 'version' ) ) {

			// check for unset values and set them to default value -> when updated to new version
			foreach ( $wallow_coa as $key => $val ) {
				if ( !isset( $wallow_opt[$key] ) ) $wallow_opt[$key] = $wallow_coa[$key]['default'];
				if ( in_array( $wallow_opt[$key], array( 'hide', 'inactive' ) ) ) $wallow_opt[$key] = 0; //backward compatibility
				if ( in_array( $wallow_opt[$key], array( 'show', 'active' ) ) ) $wallow_opt[$key] = 1; //backward compatibility
			}
			$wallow_opt['version'] = ''; //null value to keep admin notice alive and invite user to discover theme options
			update_option( 'wallow_options' , $wallow_opt );

		}

	}
}


// sanitize options value
if ( !function_exists( 'wallow_sanitize_options' ) ) {
	function wallow_sanitize_options( $input ){

		$the_coa = wallow_get_coa();

		foreach ( $the_coa as $key => $val ) {

			if( $the_coa[$key]['type'] == 'chk' ) {								//chk
				if( !isset( $input[$key] ) ) {
					$input[$key] = 0;
				} else {
					$input[$key] = ( $input[$key] == 1 ? 1 : 0 );
				}

			} elseif( $the_coa[$key]['type'] == 'sel' ) {						//sel
				if ( !isset( $input[$key] ) || !in_array( $input[$key], $the_coa[$key]['options'] ) ) $input[$key] = $the_coa[$key]['default'];

			} elseif( $the_coa[$key]['type'] == 'opt' ) {						//opt
				if ( !isset( $input[$key] ) || !in_array( $input[$key], $the_coa[$key]['options'] ) ) $input[$key] = $the_coa[$key]['default'];

			} elseif( $the_coa[$key]['type'] == 'txt' ) {						//txt
				if( !isset( $input[$key] ) ) {
					$input[$key] = '';
				} else {
					$input[$key] = trim( strip_tags( $input[$key] ) );
				}

			} elseif( $the_coa[$key]['type'] == 'url' ) {						//url
				if( !isset( $input[$key] ) ) {
					$input[$key] = '';
				} else {
					$input[$key] = esc_url( trim( strip_tags( $input[$key] ) ) );
				}

			} elseif( $the_coa[$key]['type'] == 'txtarea' ) {					//txtarea
				if( !isset( $input[$key] ) ) {
					$input[$key] = '';
				} else {
					$input[$key] = trim( strip_tags( $input[$key] ) );
				}

			} elseif( $the_coa[$key]['type'] == 'int' ) {						//int
				if( !isset( $input[$key] ) ) {
					$input[$key] = $the_coa[$key]['default'];
				} else {
					$input[$key] = (int) $input[$key] ;
				}

			} elseif( $the_coa[$key]['type'] == 'col' ) {						//col
				$color = str_replace( '#' , '' , $input[$key] );
				$color = preg_replace( '/[^0-9a-fA-F]/' , '' , $color );
				$input[$key] = '#' . $color;
			}
		}

		// check for required options
		foreach ( $the_coa as $key => $val ) {
			if ( $the_coa[$key]['req'] != '' ) { if ( $input[$the_coa[$key]['req']] == 0 ) $input[$key] = 0; }
		}

		$input['version'] = wallow_get_info( 'version' ); // keep version number

		return $input;

	}
}


// the option page
if ( !function_exists( 'wallow_edit_options' ) ) {
	function wallow_edit_options() {

		if ( !current_user_can( 'edit_theme_options' ) ) wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallow' ) );

		global $wallow_opt;

		if ( isset( $_GET['erase'] ) && ! isset( $_REQUEST['settings-updated'] ) ) {
			delete_option( 'wallow_options' );
			wallow_default_options();
			$wallow_opt = get_option( 'wallow_options' );
		}

		$wallow_coa = wallow_get_coa();
		
		// update version value when admin visit options page
		if ( $wallow_opt['version'] < wallow_get_info( 'version' ) ) {
			$wallow_opt['version'] = wallow_get_info( 'version' );
			update_option( 'wallow_options' , $wallow_opt );
		}

?>
	<div class="wrap">

		<div class="icon32 icon-appearance" id="wlw-icon"><br></div>

		<h2><?php echo wallow_get_info( 'current_theme' ) . ' - ' . __( 'Theme Options','wallow' ); ?></h2>

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
								$wallow_use_theme_set_selected = ($wallow_use_theme_set_value == $wallow_opt['wallow_theme_set']) ? ' checked="checked"' : '';
								echo '<label><input type="radio" name="wallow_options[wallow_theme_set]" title="' . $wallow_use_theme_set_option . '" value="' . $wallow_use_theme_set_value . '" ' . $wallow_use_theme_set_selected . ' onchange="wallowOptions.changePreview(\'\',\'' . $wallow_use_theme_set_value . '\'); wallowOptions.toggleMixer(\'' . $wallow_use_theme_set_value . '\'); return false;">' . $wallow_use_theme_set_option . '</label>';
								}
							?>
						</div>
						<?php 
						if( $wallow_opt['wallow_theme_set'] == 1 ){ /* custom style options */
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

						<?php wallow_print_the_option( $key, true ); ?>

						<?php if ( isset( $wallow_coa[$key]['sub'] ) ) { ?>

						<div class="wlw-sub-opt">

						<?php foreach ( $wallow_coa[$key]['sub'] as $subkey => $subval ) { ?>

							<?php if ( $subval == '' ) { echo '<br>'; continue; } ?>

							<?php wallow_print_the_option( $subval, false ); ?>

							<br>

						<?php } ?>

						</div>

						<?php } ?>

					</div>

					<?php } ?>

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


//output options field
if ( !function_exists( 'wallow_print_the_option' ) ) {
	function wallow_print_the_option( $key, $is_top = true ){

		$val = wallow_get_coa( $key );
		$type = $val['type'];
		$output = '';

		switch ( $type ) {

			case "chk":

				if ( $is_top ) {
					$output .= '<span class="column-nam">' . $val['description'] . '</span>';
					$output .= ' <input name="wallow_options[' . $key . ']" value="1" type="checkbox" class="ww_opt_p_checkbox" ' . checked( 1 , wallow_get_opt( $key ), false ) . ' />';
					if ( $val['req'] != '' ) {
						$req = wallow_get_coa( $val['req']);
						$output .= '<div class="column-req"><u>' . __('requires','wallow') . ': ' . $req['description'] . '</u></div>';
					}
					$output .= '<div class="column-des">' . $val['info'] . '</div>';
				} else {
					$output .= '<input name="wallow_options[' . $key . ']" value="1" type="checkbox" class="ww_opt_p_checkbox" ' . checked( 1 , wallow_get_opt( $key ), false ) . ' />';
					$output .= ' <span class="wlw-sub-opt-nam">' . $val['description'] . '</span>';
					if ( $val['info'] != '' ) $output .= ' - <span class="wlw-sub-opt-des">' . $val['info'] . '</span>';
				}
				break;

			case "txt":
			case "int":
			case "url":

				if ( $is_top ) {
					$output .= '<span class="column-nam">' . $val['description'] . '</span>';
					$output .= ' <input name="wallow_options[' . $key . ']" value="' . wallow_get_opt( $key ) . '" type="text" />';
					if ( $val['req'] != '' ) {
						$req = wallow_get_coa( $val['req']);
						$output .= '<div class="column-req"><u>' . __('requires','wallow') . ': ' . $req['description'] . '</u></div>';
					}
					$output .= '<div class="column-des">' . $val['info'] . '</div>';
				} else {
					$output .= '<span class="wlw-sub-opt-nam">' . $val['description'] . '</span> :';
					$output .= ' <input name="wallow_options[' . $key . ']" value="' . wallow_get_opt( $key ) . '" type="text" />';
					if ( $val['info'] != '' ) $output .= ' - <span class="wlw-sub-opt-des">' . $val['info'] . '</span>';
				}
				break;

			case "txtarea":

				if ( $is_top ) {
					$output .= '<span class="column-nam">' . $val['description'] . '</span>';
					$output .= ' <textarea name="wallow_options[' . $key . ']">' . wallow_get_opt( $key ) . '</textarea>';
					if ( $val['req'] != '' ) {
						$req = wallow_get_coa( $val['req']);
						$output .= '<div class="column-req"><u>' . __('requires','wallow') . ': ' . $req['description'] . '</u></div>';
					}
					$output .= '<div class="column-des">' . $val['info'] . '</div>';
				} else {
					$output .= '<!-- txtarea suboption not implemented -->';
				}
				break;

			case "sel":
				if ( $is_top ) {
					$output .= '<span class="column-nam">' . $val['description'] . '</span>';
					$output .= ' <select name="wallow_options[' . $key . ']">';
					foreach( $val['options'] as $optionkey => $option ) {
						$output .= '<option value="' . $option . '" ' . selected( wallow_get_opt( $key ), $option, false ) . '>' . $val['options_readable'][$optionkey] . '</option>';
					}
					$output .= '</select>';
					if ( $val['req'] != '' ) {
						$req = wallow_get_coa( $val['req']);
						$output .= '<div class="column-req"><u>' . __('requires','wallow') . ': ' . $req['description'] . '</u></div>';
					}
					$output .= '<div class="column-des">' . $val['info'] . '</div>';
				} else {
					$output .= '<span class="wlw-sub-opt-nam">' . $val['description'] . '</span> :';
					$output .= ' <select name="wallow_options[' . $key . ']">';
					foreach( $val['options'] as $optionkey => $option ) {
						$output .= '<option value="' . $option . '" ' . selected( wallow_get_opt( $key ), $option, false ) . '>' . $val['options_readable'][$optionkey] . '</option>';
					}
					$output .= '</select>';
					if ( $val['info'] != '' ) $output .= ' - <span class="wlw-sub-opt-des">' . $val['info'] . '</span>';
				}
				break;

			case "opt":
				if ( $is_top ) {
					$output .= '<span class="column-nam">' . $val['description'] . '</span>';
					foreach( $val['options'] as $optionkey => $option ) {
						$output .= ' <label title="' . esc_attr($option) . '"><input type="radio" ' . checked( wallow_get_opt( $key ), $option, false ) . ' value="' . $option . '" name="wallow_options[' . $key . ']"> <span>' . $val['options_readable'][$optionkey] . '</span></label>';
					}
					if ( $val['req'] != '' ) {
						$req = wallow_get_coa( $val['req']);
						$output .= '<div class="column-req"><u>' . __('requires','wallow') . ': ' . $req['description'] . '</u></div>';
					}
					$output .= '<div class="column-des">' . $val['info'] . '</div>';
				} else {
					$output .= '<span class="wlw-sub-opt-nam">' . $val['description'] . '</span> :';
					foreach( $val['options'] as $optionkey => $option ) {
						$output .= ' <label title="' . esc_attr($option) . '"><input type="radio" ' . checked( wallow_get_opt( $key ), $option, false ) . ' value="' . $option . '" name="wallow_options[' . $key . ']"> <span>' . $val['options_readable'][$optionkey] . '</span></label>';
					}
					if ( $val['info'] != '' ) $output .= ' - <span class="wlw-sub-opt-des">' . $val['info'] . '</span>';
				}
				break;

			case "col":
				if ( $is_top ) {
					$output .= '<span class="column-nam">' . $val['description'] . '</span>';
					$output .= ' <input class="wlw-color" id="wlw-color-' . $key . '" type="text" name="wallow_options[' . $key . ']" value="' . wallow_get_opt( $key ) . '" data-default-color="' . $val['default'] . '" />';
					$output .= '<span class="description hide-if-js">' . __( 'Default' , 'wallow' ) . ': ' . $val['default'] . '</span>';
					if ( $val['req'] != '' ) {
						$req = wallow_get_coa( $val['req']);
						$output .= '<div class="column-req"><u>' . __('requires','wallow') . ': ' . $req['description'] . '</u></div>';
					}
					$output .= '<div class="column-des">' . $val['info'] . '</div>';
				} else {
					$output .= '<span class="wlw-sub-opt-nam">' . $val['description'] . '</span> :';
					$output .= ' <input class="wlw-color" id="wlw-color-' . $key . '" type="text" name="wallow_options[' . $key . ']" value="' . wallow_get_opt( $key ) . '" data-default-color="' . $val['default'] . '" />';
					$output .= ' <span class="description hide-if-js">' . __( 'Default' , 'wallow' ) . ': ' . $val['default'] . '</span>';
					if ( $val['info'] != '' ) $output .= ' - <span class="wlw-sub-opt-des">' . $val['info'] . '</span>';
				}
				break;

			default:
				$output .= '<!-- no default output -->';

		}

		$output = apply_filters( 'wallow_filter_print_the_option', $output, $key, $type, $is_top );

		echo $output;

	}
}


//multi styles options - return drop down list of set options
function wallow_get_theme_multi_options( $element ){

	$current = ( wallow_get_opt( 'wallow_theme_set' ) === '1' ) ? wallow_get_opt( $element ) : '';

	$variants = wallow_get_types();

	foreach ( $variants as $slug => $description ) {

		echo '<label><input type="radio" name="wallow_options[' . $element . ']" title="' . $description . '" value="' . $slug . '" ' . checked( $slug, $current, false ) . ' onchange="wallowOptions.changePreview(\'' . $element . '\',\'' . $slug . '\'); return false;">' . $description . '</label>';

	}

}


//output preview
if ( !function_exists( 'wallow_preview' ) ) {
	function wallow_preview(){

		$theme_set	= wallow_get_opt( 'wallow_theme_set' );

		$genlook	= ( $theme_set === '1' ) ? wallow_get_opt( 'wallow_theme_genlook' ) : $theme_set;
		$pages		= ( $theme_set === '1' ) ? wallow_get_opt( 'wallow_theme_pages' ) : $theme_set;
		$quickbar	= ( $theme_set === '1' ) ? wallow_get_opt( 'wallow_theme_quickbar' ) : $theme_set;
		$sidebar	= ( $theme_set === '1' ) ? wallow_get_opt( 'wallow_theme_sidebar' ) : $theme_set;
		$avatar		= ( $theme_set === '1' ) ? wallow_get_opt( 'wallow_theme_avatar' ) : $theme_set;
		$popup		= ( $theme_set === '1' ) ? wallow_get_opt( 'wallow_theme_popup' ) : $theme_set;

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
}


// Styles the header image displayed on the Appearance > Header admin panel.
if ( !function_exists( 'wallow_admin_header_style' ) ) {
	function wallow_admin_header_style() {

		wp_enqueue_style(
			'wlw-admin-header-style',
			get_template_directory_uri() . '/css/admin-custom_header.css',
			array(),
			wallow_get_info( 'version' ),
			'screen'
		);

	}
}


//Add new contact methods to author panel
if ( !function_exists( 'wallow_new_contactmethods' ) ) {
	function wallow_new_contactmethods( $contactmethods ) {

		$contactmethods['twitter'] = 'Twitter'; //add Twitter

		$contactmethods['facebook'] = 'Facebook'; //add Facebook

		$contactmethods['googleplus'] = 'Google+'; //add Google+

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

	$nonce = wp_create_nonce( 'wallow_header_image_remove_nonce' );

?>
	<script type="text/javascript">
		jQuery(function($){
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
							'header_image_remove': thiz.parent().find('img').attr('src'),
							_ajax_nonce: '<?php echo $nonce ?>'
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

		check_ajax_referer( 'wallow_header_image_remove_nonce' );

		if( ! $post = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' AND post_content = %s", $_POST['header_image_remove'] ) ) ) {
			return;
		}
		wp_delete_attachment( $post->ID, true ); // true: force_delete, bypass trash
	}
}

?>