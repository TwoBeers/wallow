<?php
/**** begin theme hooks ****/
// Tell WordPress to run wallow_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'wallow_setup' );
// Register sidebars by running wallow_widgets_init() on the widgets_init hook
add_action( 'widgets_init', 'wallow_widgets_init' );
// Add js animations
add_action( 'template_redirect', 'wallow_scripts' );
// Custom filters
add_filter( 'the_content', 'wallow_content_replace' );
// Add stylesheets
add_action( 'wp_print_styles', 'wallow_stylesheet' );
//add theme admin menu
add_action('admin_menu', 'wallow_add_theme_option_page');
add_action('admin_init', 'wallow_theme_init');
// allcat page redirect
add_action('template_redirect', 'wallow_allcat');
/**** end theme hooks ****/


// dummy var
function wallow_get_coa() {
	$wallow_coa = __('ciao','wallow');
	return $wallow_coa;
}

// Set the content_width (with a 1024x768 window size)
if ( ! isset( $content_width ) )
	$content_width = 640;

if ( !function_exists( 'wallow_setup' ) ) {
	function wallow_setup() {
		
		// Register localization support
		load_theme_textdomain('wallow', TEMPLATEPATH . '/languages' );
		// Theme uses wp_nav_menu() in one location
		register_nav_menus( array( 'primary' => __( 'Main Navigation Menu', 'wallow' )	) );
		// Register Features Support
		add_theme_support( 'automatic-feed-links' );
		// Thumbnails support
		add_theme_support( 'post-thumbnails' );
			
		// Add a way for the custom background to be styled in the admin panel that controls
		add_custom_background( 'wallow_custom_bg' , '' , '' );
	}
}

// custom background style - gets included in the site header
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


function wallow_widgets_init() {
	// Registers the right sidebar
	register_sidebar(array(
		'name'          => 'Sidepad',
		'id'            => 'sidepad',
		'description'   => __('drag here your favorite widgets','wallow'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</li>',
		'before_title' 	=> '',
		'after_title' 	=> '',
	));
	// Register the Quickbar as sidebar
	register_sidebar( array(
		'name'          =>	'Quickbar',
		'id'            =>	'w-quickbar',
		'description'   =>	__('drag here your favorite widgets','wallow'),
		'before_widget'	=>	'<div class="footer_wig">',
		'after_widget'	=>	'</div></div></div>',
		'before_title'	=>	'<h4>',
		'after_title'	=>	' &raquo;</h4><div class="fw_pul_cont"><div class="fw_pul">',
	));

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
	$wallow_opt = get_option('wallow_options');
	if ($wallow_opt['wallow_jsani'] == 'active' || !isset($wallow_opt['wallow_jsani']) ) {
		wp_enqueue_script( 'wallowscript', get_template_directory_uri() . '/js/wallowscript.dev.js', array( 'jquery' ), '0.45', true  ); //wallow js
	}
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

// Add stylesheets to page
function wallow_stylesheet(){
	//normal view
	wp_enqueue_style( 'wallow_general-style', get_stylesheet_uri(), false, '0.45', 'screen' );
	//print style
	wp_enqueue_style( 'wallow_print-style', get_template_directory_uri() . '/css/print.css', false, '0.45', 'print' );
}


// Get Recent Comments
function wallow_get_recentcomments() {
	$recentcomments = get_comments('number=12&status=approve');
	
	if($recentcomments) {
		foreach ($recentcomments as $comment) {
			$post_id = $comment->comment_post_ID;
			$post_title = get_the_title($post_id);
			$comment_author = $comment->comment_author;
			$comment_date = "";	// "<span class=\"intr\">".mysql2date('M dS H:i', $post->comment_date_gmt)."</span>&nbsp;"; //uncomment to use
			$comment_id = $comment->comment_ID;
			if (mb_strlen($post_title)>25) {
				$post_title_short = mb_substr($post_title,0,25) . '&hellip;';
			} else {
				$post_title_short = $post_title;
			}
			if ($post_title_short == "") {
				$post_title_short = __('(no title)');
			}
			echo "<li>$comment_date$comment_author " . __('about','wallow') . " <a href=\"".get_permalink($post_id)."#comment-$comment_id\" title=\"$post_title\">$post_title_short</a></li>\n";
		}
	} else {
		echo '<li>'.__('N/A').'</li>';
	}
}

// Get Recent Entries
function wallow_get_recententries($mode = '') {
	$recententries = get_posts('numberposts=12');
	
	if($recententries) {
		foreach ($recententries as $post) {
			setup_postdata($post);
			$post_author = get_the_author();
			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_date = ""; //"<span class=\"intr\">".mysql2date('M dS', esc_html($post->post_date))."</span>&nbsp;"; //uncomment to use
			if (mb_strlen($post_title)>25) {
				$post_title_short = mb_substr($post_title,0,25) . '&hellip;';
			} else {
				$post_title_short = $post_title;
			}
			if ($post_title_short == "") {
				$post_title_short = __('(no title)');
			}
			echo "<li>$post_date<a href=\"".get_permalink($post_id)."\" title=\"$post_title\">$post_title_short</a> " . __('by','wallow') . " $post_author</li>\n";
		}
	} else {
		echo '<li>'.__('N/A').'</li>';
	}
}

// page hierarchy
function wallow_multipages(){
	global $post;
	$args = array(
		'post_type' => 'page',
		'post_parent' => $post->ID
		); 
	$childrens = get_posts($args); // retrieve the child pages
	$the_parent_page = $post->post_parent; // retrieve the parent page

	if ( ( $childrens ) || ( $the_parent_page ) ){ ?>
		<?php
		echo __('<br />This page has hierarchy','wallow') . ' - ';
		if ( $the_parent_page ) {
			$the_parent_link = '<a href="' . get_permalink( $the_parent_page ) . '" title="' . get_the_title( $the_parent_page ) . '">' . get_the_title( $the_parent_page ) . '</a>';
			echo __('Parent page: ','wallow') . $the_parent_link ; // echoes the parent
		}
		if ( ( $childrens ) && ( $the_parent_page ) ) { echo ' - '; } // if parent & child, echoes the separator
		if ( $childrens ) {
			$the_child_list = '';
			foreach ($childrens as $children) {
				$the_child_list[] = '<a href="' . get_permalink( $children ) . '" title="' . get_the_title( $children ) . '">' . get_the_title( $children ) . '</a>';
			}
			$the_child_list = implode(', ' , $the_child_list);
			echo __('Child pages: ','wallow') . $the_child_list; // echoes the childs
		}
		?>
	<?php }
}

// Pages Menu
function wallow_pages_menu() {
	echo '<ul id="mainmenu">';
	wp_list_pages( 'sort_column=menu_order&title_li=' ); // menu-order sorted
	echo '</ul>';
}

//Init theme options
function wallow_theme_init() {
	register_setting( 'wallow_theme_options', 'wallow_options');
}

//add theme options page
function wallow_add_theme_option_page() {
	$topt_page = add_theme_page(__('Theme Options','wallow'), __('Theme Options','wallow'), 'manage_options', 'functions', 'wallow_edit_options');
	add_action( 'admin_print_scripts-' . $topt_page, 'wallow_options_script' );
	add_action( 'admin_print_styles-' . $topt_page, 'wallow_options_style' );
}

function wallow_options_script() {
	wp_enqueue_script( 'wallow_otp_script', get_template_directory_uri().'/js/wallowoptions.dev.js',array('jquery'),'0.45', true );
}
function wallow_options_style() {
	//add custom stylesheet
	wp_enqueue_style( 'wallow_options-style', get_template_directory_uri() . '/css/theme-options.css', false, '0.45', 'screen' );
}

//manage theme options
function wallow_edit_options() {

	// get dummy var
	$wallow_coa = wallow_get_coa();
	
	$wallow_options = get_option('wallow_options');
	if(empty($wallow_options)) { //if options are empty, sets the default values
		$wallow_options['wallow_theme_set'] = 'fire';
		$wallow_options['wallow_jsani'] = 'active';
		$wallow_options['wallow_qbar'] = 'show';
		add_option('wallow_options', $wallow_options, '', 'yes');
	}
	
	//check for jsani and qbar options
	if( !isset($wallow_options['wallow_jsani'])) : $wallow_options['wallow_jsani'] = 'active'; else: update_option('wallow_options', $wallow_options); endif;	
	if( !isset($wallow_options['wallow_qbar'])) : $wallow_options['wallow_qbar'] = 'show'; else: update_option('wallow_options', $wallow_options); endif;
	
	if ( isset( $_REQUEST['updated'] ) ) echo '<div id="message" class="updated"><p><strong>'.__('Options saved.').'</strong></p></div>';
	?>
	<div class="wrap" style="position: relative;">
		<div class="icon32" id="icon-themes"><br></div>
		<h2><?php _e('Wallow - Theme options','wallow'); ?></h2>
		<div>
			<form method="post" action="options.php">
				<div class="stylediv">
					<h3><?php _e('Appearance','wallow'); ?></h3>
					<p><?php _e('Select one of the ready-made styles or mix them to build your custom style','wallow'); ?><br />
					<small><?php _e('Default style = fire','wallow'); ?></small></p>
					<?php settings_fields('wallow_theme_options'); ?>
					<div id="stylesubdiv" style="position:relative; min-height:245px;">
						<p class="ww_opt_p"><?php
						// use a default style?
						$wallow_use_theme_set = array('fire' => 'fire' , 'air' => 'air' , 'water' => 'water' , 'earth' => 'earth' , '1' => __('custom...','wallow'));
						foreach ($wallow_use_theme_set as $wallow_use_theme_set_value => $wallow_use_theme_set_option) {
							$wallow_use_theme_set_selected = ($wallow_use_theme_set_value == $wallow_options['wallow_theme_set']) ? ' checked="checked"' : '';
							echo <<<HERE
						<input type="radio" name="wallow_options[wallow_theme_set]" title="$wallow_use_theme_set_option" value="$wallow_use_theme_set_value" $wallow_use_theme_set_selected onmouseup="changeWPreviewBg('','$wallow_use_theme_set_value'); forceWPreviewOptChng('$wallow_use_theme_set_value'); return false;">$wallow_use_theme_set_option&nbsp;&nbsp;
HERE;
							}
						?></p>
						<?php 
						if($wallow_options['wallow_theme_set'] == 1){ /* custom style options */
							 $option_style = "visibility: visible; height: auto;";
						}else{
							$option_style = "visibility: hidden; height: 0px;";
						}
						?>
						<div id="wallow_options_select" style="<?php echo $option_style; ?> -moz-border-radius: 6px; background-color: #FFFFFF; border: 1px solid #DFDFDF; width: 400px;">
							<p style="font-weight:bold; text-shadow:0 1px 0 #FFFFFF; margin: 0; color: #464646; padding: 0 5px; line-height: 29px; background: url('images/gray-grad.png') repeat-x scroll left top #DFDFDF; -moz-border-radius: 6px 6px 0 0;"><?php _e('Select the style of the elements','wallow'); ?></p>
							<small style="font-style:italic; line-height: 1.8em; color: #777777; padding-left: 5px;"><?php _e('Default style = fire','wallow'); ?></small>
							<table style="border-collapse: collapse; margin-bottom: 14px; margin-top: 0; width: 100%; border-top:1px solid #ECECEC; border-bottom:1px solid #ECECEC;">
								<tr style="line-height: 1.8em;">
									<td style="padding-left: 3px;"><?php _e('general looking','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php wallow_get_theme_multi_options('wallow_theme_genlook'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em; background-color:#F5F5F5;">
									<td style="padding-left: 3px;"><?php _e('sidebar','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php wallow_get_theme_multi_options('wallow_theme_sidebar'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em;">
									<td style="padding-left: 3px;"><?php _e('pages menu','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php wallow_get_theme_multi_options('wallow_theme_pages'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em; background-color:#F5F5F5;">
									<td style="padding-left: 3px;"><?php _e('pop-up menu','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php wallow_get_theme_multi_options('wallow_theme_popup'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em;">
									<td style="padding-left: 3px;"><?php _e('quickbar','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php wallow_get_theme_multi_options('wallow_theme_quickbar'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em; background-color:#F5F5F5;">
									<td style="padding-left: 3px;"><?php _e('avatar','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php wallow_get_theme_multi_options('wallow_theme_avatar'); ?>
									</td>
								</tr>
							</table>
						</div>
						<?php wallow_preview(); ?>
					</div>
				</div>
				
				
				<div class="stylediv">
					<h3><?php _e('Features','wallow'); ?></h3>
					<table style="border-collapse: collapse; width: 100%;border-bottom: 2px groove #fff;">
						<tr style="border-bottom: 2px groove #fff;">
							<th><?php _e( 'name' , 'wallow' ); ?></th>
							<th><?php _e( 'status' , 'wallow' ); ?></th>
							<th><?php _e( 'description' , 'wallow' ); ?></th>
							<th><?php _e( 'require' , 'wallow' ); ?></th>
						</tr>
						<tr>
							<td style="width: 220px;font-weight:bold;border-right:1px solid #ccc;"><?php _e('Quickbar','wallow'); ?></td>
							<td style="width: 200px;border-right:1px solid #ccc;text-align:center;">
								<?php
									$wallow_qbar = array('show' => __('show','wallow') , 'hide' => __('hide','wallow'));
									foreach ($wallow_qbar as $wallow_qbar_value => $wallow_qbar_option) {
										$wallow_qbar_selected = ($wallow_qbar_value == $wallow_options['wallow_qbar']) ? ' checked="checked"' : '';
										echo '<input type="radio" name="wallow_options[wallow_qbar]" title="'. $wallow_qbar_option . '" value="' . $wallow_qbar_value . '" '. $wallow_qbar_selected . ' >' . $wallow_qbar_option . '&nbsp;&nbsp;';
									}
								?>
							</td>
							<td style="font-style:italic;border-right:1px solid #ccc;"><?php _e('Hide/Show the fixed bar on bottom of page','wallow'); ?></td>
							<td><?php ?></td>
						</tr>
						<tr>
							<td style="width: 220px;font-weight:bold;border-right:1px solid #ccc;"><?php _e('Pop-up Menu Animations','wallow'); ?></td>
							<td style="width: 200px;border-right:1px solid #ccc;text-align:center;">
								<?php
									$wallow_jsani = array('active' => __('active','wallow') , 'inactive' => __('inactive','wallow'));
									foreach ($wallow_jsani as $wallow_jsani_value => $wallow_jsani_option) {
										$wallow_jsani_selected = ($wallow_jsani_value == $wallow_options['wallow_jsani']) ? ' checked="checked"' : '';
										echo '<input type="radio" name="wallow_options[wallow_jsani]" title="'. $wallow_jsani_option . '" value="'. $wallow_jsani_value . '" '. $wallow_jsani_selected . ' >'. $wallow_jsani_option . '&nbsp;&nbsp;';
									}
								?>
							</td>
							<td style="font-style:italic;border-right:1px solid #ccc;"><?php _e('Try disable animations if you encountered problems with javascript','wallow'); ?></td>
							<td><?php ?></td>
						</tr>
					</table>
				</div>
				<div class="stylediv" style="clear: both; text-align: center; border: 1px solid #ccc;">
					<small>
						<?php _e( 'If you like/dislike this theme, or if you encounter any issues using it, please let us know it.', 'wallow' ); ?><br />
						<a href="<?php echo esc_url( 'http://www.twobeers.net/annunci/wallow' ); ?>" title="wallow theme" target="_blank"><?php _e( 'Leave a feedback', 'wallow' ); ?></a>
					</small>
				</div>
				
				
				<p style="float:left; clear: both;">
					<input class="button" type="submit" name="Submit" value="<?php _e('Update Options','wallow'); ?>" />
					<a style="font-size: 10px; text-decoration: none; margin-left: 10px; cursor: pointer;" href="themes.php?page=functions" target="_self"><?php _e('Undo Changes','wallow'); ?></a>
				</p>
			</form>
		</div>
	</div>
	<?php
}

//multi styles options - return drop down list of set options
function wallow_get_theme_multi_options($inputName){
	$wallow_options = get_option('wallow_options');
	//check the current theme set
	if(empty($wallow_options)){	//no style at all
		$current = 'fire';
	}else{
		if( $wallow_options['wallow_theme_set'] == 1 ) {	//custom set
			if( !isset($wallow_options[$inputName]) ) : $current = ''; else: $current = $wallow_options[$inputName]; endif;
		}else{	//default theme set
			$current = "";
		}
	}
	
	$array = array('fire' => 'fire' , 'air' => 'air' , 'water' => 'water' , 'earth' => 'earth');
	foreach ($array as $array_value => $array_option) {
		$array_selected = ($array_value == $current) ? ' checked="checked"' : '';
		echo <<<HERE
		<div style="display: inline;white-space:nowrap;"><input type="radio" name="wallow_options[$inputName]" title="$array_option" value="$array_value" $array_selected onmouseup="changeWPreviewBg('$inputName','$array_option'); return false;">$array_option&nbsp;&nbsp;</div>
HERE;
	}
	
}
//output preview
function wallow_preview(){
	$wallow_options = get_option('wallow_options');
	
	//check the current theme set
	if( empty($wallow_options) ) {	//no style at all set the default
		$theme_set = "fire";
		$genlook = $theme_set;
		$pages = $theme_set;
		$quickbar = $theme_set;
		$sidebar = $theme_set;
		$avatar = $theme_set;
		$popup = $theme_set;
	}else{
		if( isset($wallow_options['wallow_theme_set']) && $wallow_options['wallow_theme_set'] == 1 ) {	//custom set check if options are set, otherwise leave blank (in output will result fire set)
			if( isset($wallow_options['wallow_theme_genlook']) ) : $genlook = $wallow_options['wallow_theme_genlook']; else: $genlook = ''; endif;
			if( isset($wallow_options['wallow_theme_pages']) ) : $pages = $wallow_options['wallow_theme_pages']; else: $pages = ''; endif;
			if( isset($wallow_options['wallow_theme_quickbar']) ) : $quickbar = $wallow_options['wallow_theme_quickbar']; else: $quickbar = ''; endif;
			if( isset($wallow_options['wallow_theme_sidebar']) ) : $sidebar = $wallow_options['wallow_theme_sidebar']; else: $sidebar = ''; endif;
			if( isset($wallow_options['wallow_theme_avatar']) ) : $avatar = $wallow_options['wallow_theme_avatar']; else: $avatar = ''; endif;
			if (isset($wallow_options['wallow_theme_popup']) ) : $popup = $wallow_options['wallow_theme_popup']; else: $popup = ''; endif;
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

//output style
function wallow_get_style() {
	$wallow_options = get_option('wallow_options');
	$stylePath = "@import url(".get_template_directory_uri()."/css/";
	if( isset($wallow_options['wallow_theme_set']) && $wallow_options['wallow_theme_set'] == 1 ){ // check if use set or custom combinations
		if ( isset($wallow_options['wallow_theme_genlook']) ) : $genlook = $stylePath."style_".$wallow_options['wallow_theme_genlook'].".css );"; else: $genlook = $stylePath."style_fire.css );"; endif;
		if ( isset($wallow_options['wallow_theme_sidebar']) ) : $sidebar = $stylePath."sidebar_".$wallow_options['wallow_theme_sidebar'].".css );"; else: $sidebar = $stylePath."sidebar_fire.css );"; endif;
		if ( isset($wallow_options['wallow_theme_pages']) ) : $pages = $stylePath."pages_".$wallow_options['wallow_theme_pages'].".css );"; else: $pages = $stylePath."pages_fire.css );"; endif;
		if ( isset($wallow_options['wallow_theme_popup']) ) : $popup = $stylePath."popup_".$wallow_options['wallow_theme_popup'].".css );"; else: $popup = $stylePath."popup_fire.css );"; endif;
		if ( isset($wallow_options['wallow_theme_quickbar']) ) : $quickbar = $stylePath."quickbar_".$wallow_options['wallow_theme_quickbar'].".css );\n"; else: $quickbar = $stylePath."quickbar_fire.css );"; endif;
		if ( isset($wallow_options['wallow_theme_avatar']) ) : $avatar = $stylePath."avatar_".$wallow_options['wallow_theme_avatar'].".css );\n"; else: $avatar = $stylePath."avatar_fire.css );"; endif;
		echo "$genlook\n
		      $sidebar\n
		      $pages\n
		      $popup\n
		      $quickbar\n
		      $avatar\n
		      ";
	}else{ // output a default theme set
		if ($wallow_options['wallow_theme_set']) {
			$theme_set = $wallow_options['wallow_theme_set'];
		}else{
			$theme_set = "fire";
		}
		echo  $stylePath."style_".$theme_set.".css );\n
		      ".$stylePath."sidebar_".$theme_set.".css );\n
		      ".$stylePath."pages_".$theme_set.".css );\n
		      ".$stylePath."popup_".$theme_set.".css );\n
		      ".$stylePath."quickbar_".$theme_set.".css );
		      ".$stylePath."avatar_".$theme_set.".css );
		      ";
	}
}

//add a fix for embed videos overlying quickbar
function wallow_content_replace( $content ){
	$content = str_replace( '<param name="allowscriptaccess" value="always">', '<param name="allowscriptaccess" value="always"><param name="wmode" value="transparent">', $content );
	$content = str_replace( '<embed ', '<embed wmode="transparent" ', $content );
	return $content;
}

?>
