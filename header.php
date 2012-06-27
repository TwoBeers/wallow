<?php global $wallow_options, $current_user; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
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
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/css/print.css' ?>" type="text/css" media="print"  />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
	if ( !isset( $wallow_options['wallow_qbar'] ) || $wallow_options['wallow_qbar'] ) { 
?>
<!-- begin quickbar -->
<div id="quickbar"> 
	<div id="qb_left"></div>
	<div id="qb_center">
		<div id="avatar_cont">
			<?php
				if ( isset( $wallow_options['wallow_qbar_avatar'] ) && $wallow_options['wallow_qbar_avatar'] ) {
					echo '<img width="50" height="50" class="avatar avatar-50 photo" src="' . $wallow_options['wallow_qbar_avatar'] . '" alt="user-avatar">';
				} elseif ( is_user_logged_in() ) { //fix for notice when user not log-in
					get_currentuserinfo();
					$email = $current_user->user_email;
					echo get_avatar( $email, 50, $default = get_template_directory_uri() . '/images/user.png','user-avatar' );
				} else {
					echo '<img width="50" height="50" class="avatar avatar-50 photo" src="' . get_template_directory_uri() . '/images/user.png" alt="user-avatar">';
				}
			?>
		</div>
		
		<?php dynamic_sidebar( 'w-quickbar' ); ?>
	</div>
	<div id="qb_right"><?php wallow_micronav(); ?><?php printf( __( 'Today is %1$s<br />%2$s', 'wallow' ), date_i18n( __( 'l', 'wallow' ) ), date_i18n( get_option( 'date_format' ) ) ); ?></div>
</div>
<!-- end quickbar -->
<?php } ?>

<div id="rap">

<div id="header">
	<?php if ( get_header_image() != '' ) { ?>
		<a href="<?php echo home_url(); ?>/"><img src="<?php esc_url ( header_image() ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" /></a>
	<?php } else { ?>
		<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="description"><?php bloginfo( 'description' ); ?></div>
	<?php } ?>
</div>

<?php if ( !isset( $wallow_options['wallow_primary_menu'] ) || $wallow_options['wallow_primary_menu'] ) { ?>

<!-- begin pages menu -->
<div id="pages">
	<div id="pages_subcont">
		<div id="rss_imglink"><a href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php _e( 'Syndicate this site using RSS 2.0', 'wallow' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="rss img"/></a></div>
				<?php wp_nav_menu( array( 'menu_id' => 'mainmenu', 'fallback_cb' => 'wallow_pages_menu', 'theme_location' => 'primary' ) ); ?>
		<div class="fixfloat"></div>
	</div>
</div>
<!-- end pages menu -->

<?php } ?>

<!-- end header -->
