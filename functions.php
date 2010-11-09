<?php
load_theme_textdomain('wallow', TEMPLATEPATH . '/languages' );

// Register Features Support
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' ); // Thumbnails support
// add_theme_support('menus'); Menus support --> No need, becuse automatically registered by register_nav_menus() on line 14 (http://codex.wordpress.org/Function_Reference/register_nav_menus/#Notes)

// Sets the content_width (with a 1024x768 window size)
if ( ! isset( $content_width ) )
	$content_width = 640;

// Theme uses wp_nav_menu() in one location
register_nav_menus( array('primary' => __( 'Main Navigation Menu', 'wallow' ),	) );

// Registers the right sidebar
register_sidebar(array(
	'name'          => 'Sidepad',
	'id'            => 'sidepad',
	'description'   => __('drag here your favorite widgets','wallow'),
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '',
	'after_title' => '',
));
	
// Get Recent Comments
function get_wallow_recentcomments() {
	$recentcomments = get_comments('number=12&status=approve');
	
	if($recentcomments) {
		foreach ($recentcomments as $comment) {
			$post_id = $comment->comment_post_ID;
			$post_title = get_the_title($post_id);
			$comment_author = $comment->comment_author;
			$comment_date = "";	// "<span class=\"intr\">".mysql2date('M dS H:i', $post->comment_date_gmt)."</span>&nbsp;"; //uncomment to use
			$comment_id = $comment->comment_ID;
			if (strlen($post_title)>25) {
				$post_title_short = substr($post_title,0,25) . '&hellip;';
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
function get_wallow_recententries($mode = '') {
	$recententries = get_posts('numberposts=12');
	
	if($recententries) {
		foreach ($recententries as $post) {
			setup_postdata($post);
			$post_author = get_the_author();
			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_date = ""; //"<span class=\"intr\">".mysql2date('M dS', esc_html($post->post_date))."</span>&nbsp;"; //uncomment to use
			if (strlen($post_title)>25) {
				$post_title_short = substr($post_title,0,25) . '&hellip;';
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

// Pages Menu
function wallow_pages_menu() {
	echo '
		<ul id="mainmenu">
			<li class="menu-item"><div><a href="'. home_url() .'/">Home</a></div></li>';
	
	$pages = get_pages('parent=0'); 
	foreach ($pages as $pagg) {
	$option = '<li id="menu-item-'.$pagg->ID.'" class="menu-item"><div style="white-space: pre;"><a href="'.get_page_link($pagg->ID).'">';
	$option .= $pagg->post_title;
	echo $option;
	$children = wp_list_pages('title_li=&child_of='.$pagg->ID.'&echo=0');
	if ($children) { 
		echo ' &raquo;</a></div><ul class="sub-menu">' . $children . '</ul>';
	} else {
		echo '</a></div>';
	}
	echo '</li>';
  }
	echo '</ul>';
}

// Gravatar static footer bar
function wallow_gravatar($email) {
	$hash = md5($email);
	$default = urlencode( get_bloginfo('stylesheet_directory') . '/images/user.png' );
	echo "<img class='avatar' src='http://www.gravatar.com/avatar.php?gravatar_id=$hash&amp;size=50&amp;default=$default' alt='avatar' />";
}

//add theme admin menu
add_action('admin_menu', 'add_theme_wallow_option_interface');
add_action('admin_init', 'add_theme_wallow_init');

//Init theme options
function add_theme_wallow_init() {
	register_setting( 'wallow_theme_options', 'wallow_options');
}

//add theme options page
function add_theme_wallow_option_interface() {
	add_theme_page(__('Theme Options','wallow'), __('Theme Options','wallow'), 'manage_options', 'functions', 'edit_wallow_options');
}

//manage theme options
function edit_wallow_options() {
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
	<script language="javascript" type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/mootools-1.2-core.js"></script>
	<script type="text/javascript">
		function changeWPreviewBg(inputName,styleOption){
			if ($moochk(inputName)){
				var imgtofade = $moo('tp_' + inputName);
				var myFx = new Fx.Morph(imgtofade, {duration:200, wait:false});
				myFx.start({'opacity': 0});
				(function (){
				imgtofade.setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
				}).delay(200);
				(function (){
				myFx.start({'opacity': 1});
				}).delay(500);
			}else{
				$moo('tp_wallow_theme_genlook').setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
				$moo('tp_wallow_theme_sidebar').setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
				$moo('tp_wallow_theme_pages').setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
				$moo('tp_wallow_theme_popup').setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
				$moo('tp_wallow_theme_avatar').setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
				$moo('tp_wallow_theme_quickbar').setStyle( 'background-image' , 'url(<?php echo get_bloginfo('stylesheet_directory'); ?>/images/preview_' + styleOption + '.png)' );
			}
		}
		function forceWPreviewOptChng(styleOption){
			if(styleOption == '1'){
				$$moo('input[name=wallow_theme_genlook]').set( 'checked' , '' );
				$$moo('input[name=wallow_theme_sidebar]').set( 'checked' , '' );
				$$moo('input[name=wallow_theme_pages]').set( 'checked' , '' );
				$$moo('input[name=wallow_theme_popup]').set( 'checked' , '' );
				$$moo('input[name=wallow_theme_avatar]').set( 'checked' , '' );
				$$moo('input[name=wallow_theme_quickbar]').set( 'checked' , '' );
				$moo('wallow_options_select').setStyle( 'visibility' , 'visible' );
				$moo('wallow_options_select').setStyle( 'height' , 'auto' );
			}else{
				$$moo('input[name=wallow_theme_genlook][value=' + styleOption + ']').set( 'checked' , 'checked' );
				$$moo('input[name=wallow_theme_sidebar][value=' + styleOption + ']').set( 'checked' , 'checked' );
				$$moo('input[name=wallow_theme_pages][value=' + styleOption + ']').set( 'checked' , 'checked' );
				$$moo('input[name=wallow_theme_popup][value=' + styleOption + ']').set( 'checked' , 'checked' );
				$$moo('input[name=wallow_theme_avatar][value=' + styleOption + ']').set( 'checked' , 'checked' );
				$$moo('input[name=wallow_theme_quickbar][value=' + styleOption + ']').set( 'checked' , 'checked' );
				$moo('wallow_options_select').setStyle( 'visibility' , 'hidden' );
				$moo('wallow_options_select').setStyle( 'height' , '0px' );
			}
		}
	</script>
	<style type="text/css">
		.stylediv {
			-moz-border-radius: 10px;
			-khtml-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			background:#F5F5F5;
			border:1px solid #CCCCCC;
			margin-bottom:10px;
			max-width:800px;
			padding:0 10px 10px;
		}
		.stylediv h3 {
			-moz-border-radius:10px 10px 0 0;
			-khtml-border-radius: 10px 10px 0 0;
			-webkit-border-radius: 10px 10px 0 0;
			border-radius: 10px 10px 0 0;
			background:none repeat scroll 0 0 #F0F0F0;
			border-bottom:1px solid #DDDDDD;
			border-top:1px solid #FFFFFF;
			color:#404040;
			font-size:1em;
			margin:0 -10px;
			padding:5px 10px;
			text-shadow:1px 1px 0 #FFFFFF;
		}
		.ww_opt_p {
			padding: 3px;
			width: 394px;
			border: 1px solid #DFDFDF;
			background-color: #FFFFFF;
			-moz-border-radius: 5px;
			-khtml-border-radius: 5px;
			-webkit-border-radius: 5px;
			border-radius: 5px;
			text-align: center;
		}
		#theme_preview {
			-moz-box-shadow: 2px 2px 3px #555555;
			box-shadow: 2px 2px 3px #555555;
			-webkit-box-shadow: 2px 2px 3px #555555;
			-khtml-box-shadow: 2px 2px 3px #555555;
		}
	</style>
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
										<?php get_theme_multi_options('wallow_theme_genlook'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em; background-color:#F5F5F5;">
									<td style="padding-left: 3px;"><?php _e('sidebar','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php get_theme_multi_options('wallow_theme_sidebar'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em;">
									<td style="padding-left: 3px;"><?php _e('pages menu','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php get_theme_multi_options('wallow_theme_pages'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em; background-color:#F5F5F5;">
									<td style="padding-left: 3px;"><?php _e('pop-up menu','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php get_theme_multi_options('wallow_theme_popup'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em;">
									<td style="padding-left: 3px;"><?php _e('quickbar','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php get_theme_multi_options('wallow_theme_quickbar'); ?>
									</td>
								</tr>
								<tr style="line-height: 1.8em; background-color:#F5F5F5;">
									<td style="padding-left: 3px;"><?php _e('avatar','wallow'); ?>&nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<?php get_theme_multi_options('wallow_theme_avatar'); ?>
									</td>
								</tr>
							</table>
						</div>
						<?php wallow_preview(); ?>
					</div>
				</div>
				<div class="stylediv">
					<h3><?php _e('Quickbar','wallow'); ?></h3>
					<p><?php _e('Hide/Show the fixed bar on bottom of page','wallow'); ?></p>
					<p class="ww_opt_p"><?php
					$wallow_qbar = array('show' => __('show','wallow') , 'hide' => __('hide','wallow'));
					foreach ($wallow_qbar as $wallow_qbar_value => $wallow_qbar_option) {
						$wallow_qbar_selected = ($wallow_qbar_value == $wallow_options['wallow_qbar']) ? ' checked="checked"' : '';
						echo <<<HERE
					<input type="radio" name="wallow_options[wallow_qbar]" title="$wallow_qbar_option" value="$wallow_qbar_value" $wallow_qbar_selected >$wallow_qbar_option&nbsp;&nbsp;
HERE;
						}
					?></p>
				</div>
				<div class="stylediv">
					<h3><?php _e('Pop-up Menu Animations','wallow'); ?></h3>
					<p><?php _e('Try disable animations if you encountered problems with javascript','wallow'); ?></p>
					<p class="ww_opt_p"><?php
					$wallow_jsani = array('active' => __('active','wallow') , 'inactive' => __('inactive','wallow'));
					foreach ($wallow_jsani as $wallow_jsani_value => $wallow_jsani_option) {
						$wallow_jsani_selected = ($wallow_jsani_value == $wallow_options['wallow_jsani']) ? ' checked="checked"' : '';
						echo <<<HERE
					<input type="radio" name="wallow_options[wallow_jsani]" title="$wallow_jsani_option" value="$wallow_jsani_value" $wallow_jsani_selected >$wallow_jsani_option&nbsp;&nbsp;
HERE;
						}
					?></p>
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
function get_theme_multi_options($inputName){
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
	$base_url = get_bloginfo('stylesheet_directory')."/images/preview_";
	
	//check the current theme set
	if( empty($wallow_options) ) {	//no style at all set the default
		$theme_set = "fire";
		$genlook_url = $base_url.$theme_set.".png";
		$pages_url = $base_url.$theme_set.".png";
		$quickbar_url = $base_url.$theme_set.".png";
		$sidebar_url = $base_url.$theme_set.".png";
		$avatar_url = $base_url.$theme_set.".png";
		$popup_url = $base_url.$theme_set.".png";
	}else{
		if( isset($wallow_options['wallow_theme_set']) && $wallow_options['wallow_theme_set'] == 1 ) {	//custom set check if options are set, otherwise leave blank (in output will result fire set)
			if( isset($wallow_options['wallow_theme_genlook']) ) : $genlook = $wallow_options['wallow_theme_genlook']; else: $genlook = ''; endif;
			$genlook_url = $base_url.$genlook.".png";
			if( isset($wallow_options['wallow_theme_pages']) ) : $pages = $wallow_options['wallow_theme_pages']; else: $pages = ''; endif;
			$pages_url = $base_url.$pages.".png";
			if( isset($wallow_options['wallow_theme_quickbar']) ) : $quickbar = $wallow_options['wallow_theme_quickbar']; else: $quickbar = ''; endif;
			$quickbar_url = $base_url.$quickbar.".png";
			if( isset($wallow_options['wallow_theme_sidebar']) ) : $sidebar = $wallow_options['wallow_theme_sidebar']; else: $sidebar = ''; endif;
			$sidebar_url = $base_url.$sidebar.".png";
			if( isset($wallow_options['wallow_theme_avatar']) ) : $avatar = $wallow_options['wallow_theme_avatar']; else: $avatar = ''; endif;
			$avatar_url = $base_url.$avatar.".png";
			if (isset($wallow_options['wallow_theme_popup']) ) : $popup = $wallow_options['wallow_theme_popup']; else: $popup = ''; endif;
			$popup_url = $base_url.$popup.".png";
		}else{	//default theme set
			$theme_set = $wallow_options['wallow_theme_set'];
			$genlook_url = $base_url.$theme_set.".png";
			$pages_url = $base_url.$theme_set.".png";
			$quickbar_url = $base_url.$theme_set.".png";
			$sidebar_url = $base_url.$theme_set.".png";
			$avatar_url = $base_url.$theme_set.".png";
			$popup_url = $base_url.$theme_set.".png";
		}
	}
	
	echo <<<HERE
					<div id="theme_preview" style="background-color:transparent; height:240px; left:420px; position:absolute; top:0px; width:320px; border: 1px solid;">
						<div id="tp_wallow_theme_genlook" style="background: transparent url('$genlook_url') left top no-repeat; height:240px; width:320px; position:absolute; left:0px; top:0px;"></div>
						<div id="tp_wallow_theme_pages" style="background: url('$pages_url') left -240px no-repeat; height:20px; width:320px; position:absolute; left:0px; top:35px;"></div>
						<div id="tp_wallow_theme_quickbar" style="background: url('$quickbar_url') left -260px no-repeat; height:20px; width:320px; position:absolute; left:0px; bottom:0px;"></div>
						<div id="tp_wallow_theme_sidebar" style="background: url('$sidebar_url') right top no-repeat; height:215px; width:80px; position:absolute; right:0px; top:0px;"></div>
						<div id="tp_wallow_theme_avatar" style="background: url('$avatar_url') right -255px no-repeat; height:25px; width:25px; position:absolute; left:5px; bottom:10px;"></div>
						<div id="tp_wallow_theme_popup" style="background: url('$popup_url') right -218px no-repeat; height:30px; width:60px; position:absolute; left:20px; top:50px;"></div>
					</div>
HERE;
}

//output style
function get_wallow_style() {
	$wallow_options = get_option('wallow_options');
	$stylePath = "@import url(".get_bloginfo('stylesheet_directory')."/css/";
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

// if allcat=y redirect to allcat.php
function wallow_allcat () {
	if(isset($_GET['allcat']) && (md5($_GET['allcat']) == '415290769594460e2e485922904f345d')) : 
		include(TEMPLATEPATH . '/allcat.php');
		exit;
	endif;
}
add_action('template_redirect', 'wallow_allcat');


//add a fix for embed videos overlaing quickbar
function wallow_content_replace(){
	$content = get_the_content();
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = str_replace('<param name="allowscriptaccess" value="always">', '<param name="allowscriptaccess" value="always"><param name="wmode" value="transparent">', $content);
	$content = str_replace('<embed ', '<embed wmode="transparent" ', $content);
	echo $content;
}
?>
