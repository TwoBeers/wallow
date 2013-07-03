<?php
/**
 * The fixed quickbar class
 *
 * @package wallow
 * @since 0.60
 */


class Wallow_Quickbar {

	function __construct() {

		add_action( 'wallow_hook_body_bottom', array( $this, 'quickbar' ) );

	}

	/**
	 * the quickbar
	 *
	 */
	function quickbar(){
		global $current_user;
		
		if ( ! wallow_get_opt( 'wallow_qbar' ) ) return;

?>
<!-- begin quickbar -->
<div id="quickbar"> 
	<div id="qb_left"></div>
	<div id="qb_center">
		<?php if ( wallow_get_opt( 'wallow_qbar_show_avatar' ) ) $this->avatar(); ?>
		<?php dynamic_sidebar( 'w-quickbar' ); ?>
	</div>
	<div id="qb_right">
		<?php if ( wallow_get_opt( 'wallow_qbar_micronavi' ) ) $this->micronav(); ?>
		<?php if ( wallow_get_opt( 'wallow_qbar_date' ) ) $this->date(); ?>
	</div>
</div>
<!-- end quickbar -->
<?php

	}


	function avatar(){
		global $current_user;

?>
	<div id="avatar_cont" class="no-grav">
		<?php
			if ( wallow_get_opt( 'wallow_qbar_avatar' ) ) {
				echo '<img width="50" height="50" class="avatar avatar-50 photo" src="' . esc_url( wallow_get_opt( 'wallow_qbar_avatar' ) ) . '" alt="user-avatar">';
			} elseif ( is_user_logged_in() ) { //fix for notice when user not log-in
				get_currentuserinfo();
				$email = $current_user->user_email;
				echo get_avatar( $email, 50, $default = get_template_directory_uri() . '/images/user.png','user-avatar' );
			} else {
				echo '<img width="50" height="50" class="avatar avatar-50 photo" src="' . get_template_directory_uri() . '/images/user.png" alt="user-avatar">';
			}
		?>
	</div>
<?php

	}

	function micronav() {

		wp_reset_postdata();

		$is_post = is_single() && !is_attachment() && ! wallow_is_allcat();
		$is_archive = ( is_archive() || is_search() || is_home() ) && ! wallow_is_allcat();

		if ( $is_post ) {
			$next = get_next_post()? '<a title="' . sprintf( __( 'Next Post', 'wallow' ) . ': %s', get_the_title( get_next_post() ) ) . '" href="' . get_permalink( get_next_post() ) . '">&nbsp;</a>' : '';
			$prev = get_previous_post()? '<a title="' . sprintf( __( 'Previous Post', 'wallow' ) . ': %s', get_the_title( get_previous_post() ) ) . '" href="' . get_permalink( get_previous_post() ) . '">&nbsp;</a>' : '';
		} elseif ( $is_archive ) {
			$prev = get_next_posts_link()? get_next_posts_link('&nbsp;') : '';
			$next = get_previous_posts_link()? get_previous_posts_link('&nbsp;') : '';
		} else {
			$next = '';
			$prev =  '';
		}

?>
	<div id="micronav">
		<div class="next archive-navigation"><?php echo $next; ?></div>
		<div class="prev archive-navigation"><?php echo $prev; ?></div>
		<div class="home"><a title="<?php _e( 'Home', 'wallow' ); ?>" href="<?php echo home_url(); ?>">&nbsp;</a></div>
		<div class="up"><a title="<?php _e( 'Top', 'wallow' ); ?>" href="#">&nbsp;</a></div>
		<div class="down"><a title="<?php _e( 'Bottom', 'wallow' ); ?>" href="#credits">&nbsp;</a></div>
	</div>
<?php

	}

	function date() {

		printf( __( 'Today is %1$s<br>%2$s', 'wallow' ), date_i18n( __( 'l', 'wallow' ) ), date_i18n( get_option( 'date_format' ) ) );

	}

}

new Wallow_Quickbar;
