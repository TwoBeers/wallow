<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<style type="text/css" media="screen">
		@import url( <?php echo get_stylesheet_uri(); ?> );
	</style>
	
	<style type="text/css" media="screen">
		<?php get_wallow_style(); ?>
	</style>
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory').'/print.css' ?>" type="text/css" media="print"  />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php // if theme option is active, loads js animation
		$wallow_opt = get_option('wallow_options');
		if ($wallow_opt['wallow_jsani'] == 'active' || !isset($wallow_opt['wallow_jsani']) ) {
			wp_enqueue_script('mootools_core', get_bloginfo('stylesheet_directory').'/js/mootools-1.2-core.js');
			wp_enqueue_script('wallowscript', get_bloginfo('stylesheet_directory').'/js/wallowscript.js'); 
		}
	?> 
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<?php 
	if ($wallow_opt['wallow_qbar'] == 'show' || !isset($wallow_opt['wallow_qbar']) ) { 
?>
<!-- begin quickbar -->
<div id="quickbar"> 
	<div id="qb_left"></div>
	<div id="qb_center">
	<div id="avatar_cont">
	<?php
	if ( is_user_logged_in() ) { //fix for notice when user not log-in
		global $current_user;
		get_currentuserinfo();
		wallow_gravatar($current_user->user_email);
	}else{
		wallow_gravatar('default');
	}
	?>
	</div>

	<div class="footer_wig">
		<h4><?php _e('Welcome'); ?> <?php if (is_user_logged_in()) : echo $current_user->display_name; endif; ?> &raquo;</h4>
		<div class="fw_pul_cont">
			<ul class="fw_pul">
				<?php wp_register(); ?>
				<?php if (is_user_logged_in()) {?>
				<li><a href="<?php echo get_option('siteurl')?>/wp-admin/profile.php"><?php _e('Your Profile'); ?></a></li>
				<li><a title="<?php _e('Add New Post'); ?>" href="<?php bloginfo("url")?>/wp-admin/post-new.php"><?php _e('New Post'); ?></a></li>
				<?php } ?>
				<li><?php wp_loginout(); ?></li>
			</ul>
		</div>
	</div>

	<div class="footer_wig">
		<h4><?php _e('Categories'); ?> &raquo;</h4>
		<div class="fw_pul_cont">
			<ul class="fw_pul">
				<?php wp_list_categories('number=10&title_li=&orderby=count&order=DESC&hierarchical=0'); ?>
				<li style="text-align: right;margin-top:12px;"><a title="<?php _e('View all categories'); ?>" href="<?php  bloginfo("url"); ?>/?allcat=y"><?php _e('More...'); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="footer_wig">
		<h4><?php _e('Recent Comments'); ?> &raquo;</h4>
		<div class="fw_pul_cont">
			<ul class="fw_pul">
				<?php get_wallow_recentcomments(); ?>
			</ul>
		</div>
	</div>

	<div class="footer_wig">
		<h4><?php _e('Recent Posts'); ?> &raquo;</h4>
		<div class="fw_pul_cont">
			<ul class="fw_pul">
				<?php get_wallow_recententries() ?> 
			</ul>
		</div>
	</div>
	</div>

	<div id="qb_right"><?php _e('Today is ','wallow'); echo date_i18n('l'); ?><br /><?php echo date_i18n(__('F j, Y')); ?></div>

</div>
<!-- end quickbar -->
<?php } ?>

<div id="rap">

<div id="header">
	<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
	<div class="description"><?php bloginfo('description'); ?></div>
</div>

<!-- begin pages menu -->
<div id="pages">
	<div id="pages_subcont">
		<div id="rss_imglink"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" alt="rss img"/></a></div>
		<?php
			if ( function_exists('wp_nav_menu') ){
				wp_nav_menu( array( 'menu_id' => 'mainmenu', 'fallback_cb' => 'wallow_pages_menu', 'before' => '<div>', 'after' => '</div>', 'theme_location' => 'primary' ) );
			}else{
				wallow_pages_menu();
			}
		?>
		<div class="fixfloat"></div>
	</div>
</div>
<!-- end pages menu -->

<!-- end header -->
