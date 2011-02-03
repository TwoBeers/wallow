<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title>
		<?php
		if ( is_front_page() ) {
			bloginfo( 'name' ); ?> - <?php bloginfo( 'description' );
		} else {
			wp_title( '&laquo;', true, 'right' );
			bloginfo( 'name' );
		}
		?>
	</title>

	<style type="text/css" media="screen">
		<?php wallow_get_style(); ?>
	</style>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/print.css' ?>" type="text/css" media="print"  />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php // if theme option is active, loads js animation
		$wallow_opt = get_option('wallow_options');
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
				if (is_user_logged_in()) { //fix for notice when user not log-in
					global $current_user;
					get_currentuserinfo();
					$email = $current_user->user_email;
					echo get_avatar( $email, 50, $default = get_template_directory_uri() . '/images/user.png','user-avatar' );
				} else {
					echo get_avatar( 'dummyemail', 50, $default = get_template_directory_uri() . '/images/user.png','user-avatar' );
				}
			?>
		</div>

		<div class="footer_wig">
			<h4><?php _e('Welcome'); ?> <?php if (is_user_logged_in()) : echo $current_user->display_name; endif; ?> &raquo;</h4>
			<div class="fw_pul_cont">
				<div class="fw_pul">
					<ul>
						<?php if ( ! is_user_logged_in() || current_user_can( 'read' ) ) { wp_register(); }?>
						<?php if ( is_user_logged_in() ) { ?>
							<?php if ( current_user_can( 'read' ) ) { ?>
								<li><a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>"><?php _e( 'Your Profile','wallow' ); ?></a></li>
								<?php if ( current_user_can( 'publish_posts' ) ) { ?>
									<li><a title="<?php _e( 'Add New Post','wallow' ); ?>" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php _e( 'Add New Post','wallow' ); ?></a></li>
								<?php } ?>
								<?php if ( current_user_can( 'moderate_comments' ) ) { ?>
									<li><a title="<?php _e( 'Comments','wallow' ); ?>" href="<?php echo esc_url( admin_url( 'edit-comments.php' ) ); ?>"><?php _e( 'Comments','wallow' ); ?></a></li>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						<li><?php wp_loginout(); ?></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer_wig">
			<h4><?php _e('Categories'); ?> &raquo;</h4>
			<div class="fw_pul_cont">
				<div class="fw_pul">
					<ul>
						<?php wp_list_categories('number=10&title_li=&orderby=count&order=DESC&hierarchical=0'); ?>
						<li style="text-align: right;margin-top:12px;"><a title="<?php _e('View all categories'); ?>" href="<?php  echo home_url(); ?>/?allcat=y"><?php _e('More...'); ?></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer_wig">
			<h4><?php _e('Recent Comments'); ?> &raquo;</h4>
			<div class="fw_pul_cont">
				<div class="fw_pul">
					<ul>
						<?php wallow_get_recentcomments(); ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer_wig">
			<h4><?php _e('Recent Posts'); ?> &raquo;</h4>
			<div class="fw_pul_cont">
				<div class="fw_pul">
					<ul>
						<?php wallow_get_recententries() ?> 
					</ul>
				</div>
			</div>
		</div>
		<?php dynamic_sidebar( 'w-quickbar' ); ?>
	</div>
	<div id="qb_right"><?php printf( __('Today is %1$s','wallow'), date_i18n('l') ); ?><br /><?php echo date_i18n(__('F j, Y')); ?></div>

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
		<div id="rss_imglink"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="rss img"/></a></div>
				<?php wp_nav_menu( array( 'menu_id' => 'mainmenu', 'fallback_cb' => 'wallow_pages_menu', 'theme_location' => 'primary' ) ); ?>
		<div class="fixfloat"></div>
	</div>
</div>
<!-- end pages menu -->

<!-- end header -->
