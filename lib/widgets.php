<?php
/**
 * widgets.php
 *
 * The widgets
 * Based on WordPress default widgets (wp-includes/default-widgets.php)
 *
 * @package wallow
 * @since 0.27
 */


add_action( 'widgets_init'	, 'wallow_widget_area_init' );
add_action( 'widgets_init'	, 'wallow_register_widgets' );


/**
 * Register all widget areas (sidebars)
 */
function wallow_widget_area_init() {

	// the right sidebar
	register_sidebar( array(
		'name'				=> __( 'Sidebar Widget Area', 'wallow' ),
		'id'				=> 'sidepad',
		'description'		=> __( 'drag here your favorite widgets', 'wallow' ),
		'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widgettitle">',
		'after_title'		=> '</h3>',
	));
	
	if ( wallow_get_opt( 'wallow_qbar' ) ) { 
		// the Quickbar sidebar
		register_sidebar( array(
			'name'			=> 'Quickbar',
			'id'			=> 'w-quickbar',
			'description'	=> __( 'drag here your favorite widgets', 'wallow' ),
			'before_widget' => '<div id="%1$s" class="footer_wig %2$s">',
			'after_widget'	=> '</div></div></div>',
			'before_title'	=> '<h4>',
			'after_title'	=> ' &raquo;</h4><div class="fw_pul_cont"><div class="fw_pul">',
		));
	}
	// the single sidebar
	register_sidebar( array(
		'name'				=> __( 'Single Widget Area', 'wallow' ),
		'id'				=> 'single-widgets-area',
		'description'		=> __( 'Located after the post/page content, it is the ideal place for your widgets related to individual entries', 'wallow' ),
		'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widgettitle">',
		'after_title'		=> '</h3>',
	));
	// 404 sidebar
	register_sidebar( array(
		'name'				=> __( 'Page 404', 'wallow' ),
		'id'				=> 'error404-widgets-area',
		'description'		=> __( 'Enrich the page 404 with some useful widgets', 'wallow' ),
		'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widgettitle">',
		'after_title'		=> '</h3>',
	) );

}


/**
 * Popular_Posts widget class
 */
class Wallow_Widget_Popular_Posts extends WP_Widget {

	function Wallow_Widget_Popular_Posts() {
		$widget_ops = array( 'classname' => 'tb_popular_posts', 'description' => __( 'The most commented posts on your site', 'wallow' ) );
		$this->WP_Widget( 'wlw-popular-posts', __( 'Popular Posts', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'tb_popular_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get( 'wlw-widget-popular-posts', 'widget' );

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Popular Posts', 'wallow' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;
		
		$r = new WP_Query(array( 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count' ));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul<?php if ( $use_thumbs ) echo ' class="with-thumbs"'; ?>>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( $use_thumbs ) echo wallow_get_the_thumb( array( 'id' => get_the_ID(), 'width' => 50, 'height' => 50 ) ); ?> <?php if ( get_the_title() ) the_title(); else the_ID(); ?> <span class="details">(<?php echo get_comments_number(); ?>)</span></a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'wlw-widget-popular-posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wlw-widget-popular-posts']) )
			delete_option( 'wlw-widget-popular-posts' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw-widget-popular-posts', 'widget' );
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
		$thumb = 1;
		if ( isset($instance['thumb']) && !$thumb = (int) $instance['thumb'] )
			$thumb = 0;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show', 'wallow' ); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="1" type="checkbox" <?php checked( 1 , $thumb ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Show post thumbnails', 'wallow' ); ?></label>
		</p>	
<?php
	}
}

/**
 * latest_Commented_Posts widget class
 *
 */
class Wallow_Widget_Latest_Commented_Posts extends WP_Widget {

	function Wallow_Widget_Latest_Commented_Posts() {
		$widget_ops = array( 'classname' => 'tb_latest_commented_posts', 'description' => __( 'The latest commented posts/pages of your site', 'wallow' ) );
		$this->WP_Widget( 'wlw-recent-comments', __( 'Latest activity', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'tb_latest_commented_posts';

		add_action( 'comment_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache' ) );
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw-widget-latest-commented-posts', 'widget' );
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get( 'wlw-widget-latest-commented-posts', 'widget' );

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
 		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Latest activity', 'wallow' ) : $instance['title']);

		if ( ! $number = (int) $instance['number'] )
 			$number = 5;
 		else if ( $number < 1 )
 			$number = 1;
		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;

		$comments = get_comments( array( 'status' => 'approve', 'type' => 'comment', 'number' => 200 ) );
		$post_array = array();
		$counter = 0;
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;
		$ul_class = $use_thumbs ? ' class="with-thumbs"' : '';

		$output .= '<ul' . $ul_class . '>';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				if ( ! in_array( $comment->comment_post_ID, $post_array ) ) {
					$post = get_post( $comment->comment_post_ID );
					setup_postdata( $post );
					if ( $use_thumbs ) {
						$the_thumb = wallow_get_the_thumb( array( 'id' => $post->ID, 'width' => 50, 'height' => 50 ) );
					} else {
						$the_thumb = '';
					}
					$output .=  '<li>' . ' <a href="' . get_permalink( $post->ID ) . '" title="' .  esc_attr( get_the_title( $post->ID ) ) . '">' . $the_thumb . get_the_title( $post->ID ) . '</a></li>';
					$post_array[] = $comment->comment_post_ID;
					if ( ++$counter >= $number ) break;
				}
			}
 		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set( 'wlw-widget-latest-commented-posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wlw-widget-latest-commented-posts']) )
			delete_option( 'wlw-widget-latest-commented-posts' );

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$thumb = 1;
		if ( isset($instance['thumb']) && !$thumb = (int) $instance['thumb'] )
			$thumb = 0;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show', 'wallow' ); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="1" type="checkbox" <?php checked( 1 , $thumb ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Show post thumbnails', 'wallow' ); ?></label>
		</p>
<?php
	}
}


/**
 * latest_Comment_Authors widget class
 *
 */
class Wallow_Widget_Latest_Commentators extends WP_Widget {

	function Wallow_Widget_Latest_Commentators() {
		$widget_ops = array( 'classname' => 'tb_latest_commentators', 'description' => __( 'The latest comment authors', 'wallow' ) );
		$this->WP_Widget( 'wlw-recent-commentators', __( 'Latest comment authors', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'tb_latest_commentators';

		add_action( 'comment_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache' ) );
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw-widget-latest-commentators', 'widget' );
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		if ( get_option( 'require_name_email' ) != '1' ) return; //commentors must be identifiable
		
		$cache = wp_cache_get( 'wlw-widget-latest-commentators', 'widget' );

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
 		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Latest comment authors', 'wallow' ) : $instance['title']);

		if ( ! $number = (int) $instance['number'] )
 			$number = 4;
 		else if ( $number < 1 )
 			$number = 1;
		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;

		$comments = get_comments( array( 'status' => 'approve', 'type' => 'comment', 'number' => 200 ) );
		$post_array = array();
		$counter = 0;
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;
		$ul_class = $use_thumbs ? ' class="social-like"' : '';
		$grav_dim = $use_thumbs ? 40 : 32;

		$output .= '<ul' . $ul_class . '>';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				if ( !in_array( $comment->comment_author_email, $post_array ) ) {
					if ( $comment->comment_author_url == '' ) {
						$output .=  '<li title="' .  esc_attr( $comment->comment_author ) . '">' . get_avatar( $comment, $grav_dim, $default=get_option( 'avatar_default' ), $comment->comment_author ) . '<span class="lc-user-name">' . $comment->comment_author . '</span></li>';
					} else {
						$output .=  '<li><a target="_blank" href="' . esc_url( $comment->comment_author_url ) . '" title="' .  esc_attr( $comment->comment_author ) . '">' . get_avatar( $comment, $grav_dim, $default=get_option( 'avatar_default' ), $comment->comment_author ) . '<span class="lc-user-name">' . $comment->comment_author . '</span></a></li>';
					}
					$post_array[] = $comment->comment_author_email;
					if ( ++$counter >= $number ) break;
				}
			}
 		}
		$output .= '</ul><div class="fixfloat"></div>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set( 'wlw-widget-latest-commentators', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wlw-widget-latest-commentators']) )
			delete_option( 'wlw-widget-latest-commentators' );

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 4;
		$thumb = 1;
		if ( isset($instance['thumb']) && !$thumb = (int) $instance['thumb'] )
			$thumb = 0;

		if ( get_option( 'require_name_email' ) != '1' ) {
			printf ( __( 'Comment authors <strong>must</strong> use a name and a valid e-mail in order to use this widget. Check the <a href="%1$s">Discussion settings</a>', 'wallow' ), esc_url( admin_url( 'options-discussion.php' ) ) );
			return;
		}
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of users to show', 'wallow' ); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="1" type="checkbox" <?php checked( 1 , $thumb ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Compact view (only avatars)', 'wallow' ); ?></label>
		</p>
<?php
	}
}

/**
 * User_quick_links widget class
 *
 */
class Wallow_Widget_User_Quick_Links extends WP_Widget {

	function Wallow_Widget_User_Quick_Links() {
		$widget_ops = array( 'classname' => 'tb_user_quick_links', 'description' => __( 'Some useful links for users', 'wallow' ) );
		$this->WP_Widget( 'wlw-user-quick-links', __( 'User quick links', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'tb_user_quick_links';
	}

	function widget( $args, $instance ) {
		global $current_user;
		
		extract($args, EXTR_SKIP);
		
		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Welcome %s', 'wallow' ) : $instance['title'], $instance, $this->id_base);
		$title = sprintf ( $title, $current_user->display_name );
		
		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;
		if ( $use_thumbs ) {
			if ( is_user_logged_in() ) { //fix for notice when user not log-in
				$email = $current_user->user_email;
				$title = get_avatar( $email, 32, $default = get_template_directory_uri() . '/images/user.png', 'user-avatar' ) . ' ' . $title;
			} else {
				$title = get_avatar( 'dummyemail', 32, $default = get_template_directory_uri() . '/images/user.png', 'user-avatar' ) . ' ' . $title;
			}
		}
		
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
			<?php if ( ! is_user_logged_in() || current_user_can( 'read' ) ) { wp_register(); }?>
			<?php if ( is_user_logged_in() ) { ?>
				<?php if ( current_user_can( 'read' ) ) { ?>
					<li><a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>"><?php _e( 'Your Profile', 'wallow' ); ?></a></li>
					<?php if ( current_user_can( 'publish_posts' ) ) { ?>
						<li><a title="<?php esc_attr_e( 'Add New Post', 'wallow' ); ?>" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php _e( 'Add New Post', 'wallow' ); ?></a></li>
					<?php } ?>
					<?php if ( current_user_can( 'moderate_comments' ) ) {
						$awaiting_mod = wp_count_comments();
						$awaiting_mod = $awaiting_mod->moderated;
						$awaiting_mod = $awaiting_mod ? ' ( ' . number_format_i18n( $awaiting_mod ) . ' )' : '';
					?>
						<li><a title="<?php esc_attr_e( 'Comments', 'wallow' ); ?>" href="<?php echo esc_url( admin_url( 'edit-comments.php' ) ); ?>"><?php _e( 'Comments', 'wallow' ); ?></a><span class="hide-if-mobile"><?php echo $awaiting_mod; ?></span></li>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<li><?php wp_loginout(); ?></li>
		</ul>
		<?php echo $after_widget; ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$thumb = 1;
		if ( isset($instance['thumb']) && !$thumb = (int) $instance['thumb'] )
			$thumb = 0;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:<br /><?php _e( 'default: "Welcome %s" , where %s is the user name', 'wallow' );?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="1" type="checkbox" <?php checked( 1 , $thumb ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Show user gravatar', 'wallow' ); ?></label>
		</p>

<?php
	}
}

/**
 * Popular Categories widget class
 *
 */
class Wallow_Widget_Pop_Categories extends WP_Widget {

	function Wallow_Widget_Pop_Categories() {
		$widget_ops = array( 'classname' => 'tb_categories', 'description' => __( 'A list of popular categories', 'wallow' ) );
		$this->WP_Widget( 'wlw-categories', __( 'Popular Categories', 'wallow' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Popular Categories', 'wallow' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
		<ul>
<?php
		$cat_args = array( 'orderby' => 'count', 'show_count' => 1, 'hierarchical' => 0, 'order' => 'DESC', 'title_li' => '', 'number' => $number );

		wp_list_categories(apply_filters( 'wallow_widget_pop_categories_args', $cat_args));

?>
			<li class="tb_allcat" style="text-align: right;margin-top:12px;"><a title="<?php esc_attr_e( 'View all categories', 'wallow' ); ?>" href="<?php  echo home_url(); ?>/?allcat=y"><?php _e( 'View all', 'wallow' ); ?></a></li>
		</ul>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = esc_attr( $instance['title'] );
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of categories to show', 'wallow' ); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
<?php
	}

}

/**
 * Social network widget class.
 * Social media services supported: Facebook, Twitter, Myspace, Youtube, LinkedIn, Del.icio.us, Digg, Flickr, Reddit, StumbleUpon, Technorati and Github.
 * Optional: RSS icon. 
 *
 */

class Wallow_Widget_Social extends WP_Widget {
	function Wallow_Widget_Social() {
		$widget_ops = array(
			'classname' => 'tb_social',
			'description' => __("This widget lets visitors of your blog subscribe to it and follow you on popular social networks like Twitter, FaceBook etc.", "wallow"));
		$control_ops = array( 'width' => 650);

		$this->WP_Widget("wlw-social", __("Follow Me", "wallow"), $widget_ops, $control_ops);
		$this->follow_urls = array(
			'blogger'		=> 'Blogger',
			'blurb'			=> 'Blurb',
			'delicious'		=> 'Delicious',
			'deviantart'	=> 'deviantART',
			'digg'			=> 'Digg',
			'dropbox'		=> 'Dropbox',
			'facebook'		=> 'Facebook',
			'flickr'		=> 'Flickr',
			'github'		=> 'GitHub',
			'googleplus'	=> 'Google+',
			'hi5'			=> 'Hi5',
			'linkedin'		=> 'LinkedIn',
			'livejournal'	=> 'LiveJournal',
			'myspace'		=> 'Myspace',
			'odnoklassniki'	=> 'Odnoklassniki',
			'orkut'			=> 'Orkut',
			'pengyou'		=> 'Pengyou',
			'picasa'		=> 'Picasa',
			'pinterest'		=> 'Pinterest',
			'qzone'			=> 'Qzone',
			'reddit'		=> 'Reddit',
			'renren'		=> 'Renren',
			'scribd'		=> 'Scribd',
			'sina'			=> 'Sina',
			'slideshare'	=> 'SlideShare',
			'stumbleupon'	=> 'StumbleUpon',
			'soundcloud'	=> 'SoundCloud',
			'technorati'	=> 'Technorati',
			'tencent'		=> 'Tencent',
			'twitter'		=> 'Twitter',
			'tumblr'		=> 'Tumblr',
			'ubuntuone'		=> 'Ubuntu One',
			'vimeo'			=> 'Vimeo',
			'vkontakte'		=> 'VKontakte',
			'windowslive'	=> 'Windows Live',
			'xing'			=> 'Xing',
			'yfrog'			=> 'YFrog',
			'youtube'		=> 'Youtube',
			'rss'			=> 'RSS' );
		}

	function form($instance) {
		$defaults = array("title" => __("Follow Me", "wallow"),
			"icon_size" => '48px',
		);
		foreach ($this->follow_urls as $follow_service => $service_name ) {
			$defaults[$follow_service."_icon"] = $follow_service;
			$defaults["show_".$follow_service] = false;
		}
		$instance = wp_parse_args((array)$instance, $defaults);
?>
	<div>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

	<p><?php echo __( 'NOTE: Enter the <strong>full</strong> addresses ( with <em>http://</em> )', 'wallow' ); ?></p>
<?php
		foreach($this->follow_urls as $follow_service => $service_name ) {
?> 
		<div class="service-input">
			<h2>
				<input id="<?php echo $this->get_field_id( 'show_'.$follow_service); ?>" name="<?php echo $this->get_field_name( 'show_'.$follow_service); ?>" type="checkbox" <?php checked( $instance['show_'.$follow_service], 'on' ); ?>  class="checkbox" />
				<img src="<?php echo get_template_directory_uri(); ?>/images/follow/<?php echo strtolower( $follow_service ); ?>.png" alt="<?php echo esc_attr( $follow_service ); ?>" />
				<?php echo $service_name; ?>
			</h2>
<?php
			if ($follow_service != 'RSS' ) {
				$url_or_account = $follow_service;
?>
		<p>
			<label for="<?php echo $this->get_field_id($follow_service.'_account' ); ?>">
<?php
				printf(__( 'Enter %1$s account link:', 'wallow' ), $service_name);
?>
			</label>
			<input id="<?php echo $this->get_field_id($follow_service.'_account' ); ?>" name="<?php echo $this->get_field_name($follow_service.'_account' ); ?>" value="<?php if (isset($instance[$follow_service.'_account'])) echo $instance[$follow_service.'_account']; ?>" class="widefat" />
		</p>

<?php
			}
?>
		</div>
<?php
		}
?>
		<div class="clear" style="padding: 10px 0; border-top: 1px solid #DFDFDF; text-align: right;">
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e( 'Select your icon size', 'wallow' ); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'icon_size' ); ?>" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" >
<?php
			$size_array = array ( '16px', '24px', '32px', '40px', '50px', '60px' );
			foreach($size_array as $size) {
?>
				<option value="<?php echo $size; ?>" <?php if ($instance['icon_size'] == $size) { echo " selected "; } ?>><?php echo $size; ?></option>
<?php
			}
?>
			</select>
		</div>
	</div>
<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance["title"] = strip_tags($new_instance["title"]);
		$instance["icon_size"] = $new_instance["icon_size"];

		foreach ($this->follow_urls as $follow_service => $service_name ) {
			$instance['show_'.$follow_service] = $new_instance['show_'.$follow_service];
			$instance[$follow_service.'_account'] = $new_instance[$follow_service.'_account'];
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title']);
		$icon_size = ( isset($instance['icon_size']) ) ? $instance['icon_size'] : '48px';
		echo $before_widget;
		if (!empty($title)) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}
?>
	<div class="fix" style="text-align: center;">
<?php
		foreach ($this->follow_urls as $follow_service => $service_name ) {
		
			$show = ( isset($instance['show_'.$follow_service]) ) ? $instance['show_'.$follow_service] : false;
			$account = ( isset($instance[$follow_service.'_account']) ) ? $instance[$follow_service.'_account'] : '';
			if ($follow_service == 'RSS' ) {
				$account = get_bloginfo( 'rss2_url' );
			}
			if ($show && !empty($account)) {
?>
		<a href="<?php echo esc_url( $account ); ?>" target="_blank" class="social-icon" title="<?php echo esc_attr( $service_name );?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/follow/<?php echo strtolower( $follow_service );?>.png" alt="<?php echo esc_attr( $follow_service );?>" style='width: <?php echo $icon_size;?>; height: <?php echo $icon_size;?>;' />
		</a>
<?php
			}
		}
?>
	</div>
<?php
		echo $after_widget;
	}
}

/**
 * Recent Posts in Category widget class
 *
 */
class Wallow_Widget_Recent_Posts extends WP_Widget {

	function Wallow_Widget_Recent_Posts() {
		$widget_ops = array( 'classname' => 'tb_recent_entries', 'description' => __( "The most recent posts in a single category", 'wallow' ) );
		$this->WP_Widget( 'wlw-recent-posts', __( 'Recent Posts in Category', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'tb_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get( 'wlw-widget_recent_posts', 'widget' );

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;
		$category = isset( $instance['category']) ? absint($instance['category'] ) : '';
		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Recent Posts in %s', 'wallow' ) : $instance['title'], $instance, $this->id_base);
		$title = sprintf( $title, '<a href="' . get_category_link( $category ) . '">' . get_cat_name( $category ) . '</a>' );
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query( array( 'cat' => $category, 'posts_per_page' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul<?php if ( $use_thumbs ) echo ' class="with-thumbs"'; ?>>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_date()); ?>"><?php if ( $use_thumbs ) echo wallow_get_the_thumb( array( 'id' => get_the_ID(), 'width' => 50, 'height' => 50 ) ); ?><?php if ( get_the_title() ) the_title(); else echo get_the_date(); ?></a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'wlw-widget_recent_posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['category'] = (int) $new_instance['category'];
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wlw-widget-recent-entries']) )
			delete_option( 'wlw-widget-recent-entries' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw-widget_recent_posts', 'widget' );
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$category = isset($instance['category']) ? absint($instance['category']) : '';
		$thumb = isset($instance['thumb']) ? absint($instance['thumb']) : 1;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'wallow' ); ?>:</label>
			<?php wp_dropdown_categories( Array(
						'orderby'			=> 'ID', 
						'order'			  => 'ASC',
						'show_count'		 => 1,
						'hide_empty'		 => 0,
						'hide_if_empty'	  => false,
						'echo'			   => 1,
						'selected'		   => $category,
						'hierarchical'	   => 1, 
						'name'			   => $this->get_field_name( 'category' ),
						'id'				 => $this->get_field_id( 'category' ),
						'class'			  => 'widefat',
						'taxonomy'		   => 'category',
					) ); ?>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show', 'wallow' ); ?>:</label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="1" type="checkbox" <?php checked( 1 , $thumb ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Show post thumbnails', 'wallow' ); ?></label>
		</p>	

<?php
	}
}

/**
 * Image details widget class
 */
class Wallow_Widget_Image_Details extends WP_Widget {

	function Wallow_Widget_Image_Details() {
		$widget_ops = array( 'classname' => 'tb_image_details', 'description' => __( "Display image details. It's visible ONLY in single attachments", 'wallow' ) );
		$this->WP_Widget( 'wlw-image-details', __( 'Image details', 'wallow' ), $widget_ops );
		$this->alt_option_name = 'tb_image_details';

	}

	function image_info(){
		global $post;
		?>
		<div class="image-info">
			<?php
			$imgmeta = wp_get_attachment_metadata( $post->ID );

			// Convert the shutter speed retrieve from database to fraction
			if ( $imgmeta['image_meta']['shutter_speed'] && (1 / $imgmeta['image_meta']['shutter_speed']) > 1) {
				if ( ( number_format( ( 1 / $imgmeta['image_meta']['shutter_speed'] ), 1 ) ) == 1.3
				or number_format( ( 1 / $imgmeta['image_meta']['shutter_speed'] ), 1 ) == 1.5
				or number_format( ( 1 / $imgmeta['image_meta']['shutter_speed'] ), 1 ) == 1.6
				or number_format( ( 1 / $imgmeta['image_meta']['shutter_speed'] ), 1 ) == 2.5 ){
					$pshutter = "1/" . number_format( ( 1 / $imgmeta['image_meta']['shutter_speed'] ), 1, '.', '' );
				} else {
					$pshutter = "1/" . number_format( ( 1 / $imgmeta['image_meta']['shutter_speed'] ), 0, '.', '' );
				}
			} else {
				$pshutter = $imgmeta['image_meta']['shutter_speed'];
			}

			// Start to display EXIF and IPTC data of digital photograph
			echo __("Width", "wallow" ) . ": " . $imgmeta['width']."px<br />";
			echo __("Height", "wallow" ) . ": " . $imgmeta['height']."px<br />";
			if ( $imgmeta['image_meta']['created_timestamp'] ) echo __("Date Taken", "wallow" ) . ": " . date("d-M-Y H:i:s", $imgmeta['image_meta']['created_timestamp'])."<br />";
			if ( $imgmeta['image_meta']['copyright'] ) echo __("Copyright", "wallow" ) . ": " . $imgmeta['image_meta']['copyright']."<br />";
			if ( $imgmeta['image_meta']['credit'] ) echo __("Credit", "wallow" ) . ": " . $imgmeta['image_meta']['credit']."<br />";
			if ( $imgmeta['image_meta']['title'] ) echo __("Title", "wallow" ) . ": " . $imgmeta['image_meta']['title']."<br />";
			if ( $imgmeta['image_meta']['caption'] ) echo __("Caption", "wallow" ) . ": " . $imgmeta['image_meta']['caption']."<br />";
			if ( $imgmeta['image_meta']['camera'] ) echo __("Camera", "wallow" ) . ": " . $imgmeta['image_meta']['camera']."<br />";
			if ( $imgmeta['image_meta']['focal_length'] ) echo __("Focal Length", "wallow" ) . ": " . $imgmeta['image_meta']['focal_length']."mm<br />";
			if ( $imgmeta['image_meta']['aperture'] ) echo __("Aperture", "wallow" ) . ": f/" . $imgmeta['image_meta']['aperture']."<br />";
			if ( $imgmeta['image_meta']['iso'] ) echo __("ISO", "wallow" ) . ": " . $imgmeta['image_meta']['iso']."<br />";
			if ( $pshutter ) echo __("Shutter Speed", "wallow" ) . ": " . sprintf( __("%s seconds", "wallow" ), $pshutter) . "<br />"
			?>
		</div>
	<?php
	}

	function widget($args, $instance) {
		if ( !is_attachment() || !wp_attachment_is_image() ) return;
		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<?php $this->image_info(); ?>
		<?php echo $after_widget; ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : __( 'Image details', 'wallow' );
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

<?php
	}
}

/**
 * Post share links
 */
class Wallow_Widget_Share_This extends WP_Widget {

	var $default_services = array(
		//'ID' => array( 'NAME', 'LINK' ),
		// LINK -> %1$s: title, %2$s: url, %3$s: image/thumbnail
		'twitter' => array( 'Twitter', 'http://twitter.com/home?status=%1$s - %2$s' ),
		'facebook' => array( 'Facebook', 'http://www.facebook.com/sharer.php?u=%2$s&t=%1$s' ),
		'sina' => array( 'Sina', 'http://v.t.sina.com.cn/share/share.php?url=%2$s' ),
		'tencent' => array( 'Tencent', 'http://v.t.qq.com/share/share.php?url=%2$s&title=%1$s&pic=%3$s' ),
		'qzone' => array( 'Qzone', 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=%2$s' ),
		'reddit' => array( 'Reddit', 'http://reddit.com/submit?url=%2$s&title=%1$s' ),
		'stumbleupon' => array( 'StumbleUpon', 'http://www.stumbleupon.com/submit?url=%2$s&title=%1$s' ),
		'digg' => array( 'Digg', 'http://digg.com/submit?url=%2$s' ),
		'orkut' => array( 'Orkut', 'http://promote.orkut.com/preview?nt=orkut.com&tt=%1$s&du=%2$s&tn=%3$s' ),
		'bookmarks' => array( 'Bookmarks', 'https://www.google.com/bookmarks/mark?op=edit&bkmk=%2$s&title=%1$s' ),
		'blogger' => array( 'Blogger', 'http://www.blogger.com/blog_this.pyra?t&u=%2$s&n=%1$s&pli=1' ),
		'delicious' => array( 'Delicious', 'http://delicious.com/save?v=5&noui&jump=close&url=%2$s&title=%1$s' ),
	);
	
	var $default_icon_size = array ( '16', '24', '32', '48', '64' );
	
	function Wallow_Widget_Share_This() {
		$widget_ops = array( 'classname' => 'tb_share_this', 'description' => __( "Show some popular sharing services links. It's visible ONLY in single posts, pages and attachments", 'wallow' ) );
		$this->WP_Widget( 'wlw-share-this', __( 'Share this', 'wallow' ), $widget_ops );
		$this->alt_option_name = 'tb_share_this';

	}

	function widget( $args, $instance ) {
		global $post;
		
		if ( !is_singular() ) return;
		
		extract( $args );

		$icon_size = !empty( $instance['icon_size'] ) ? absint( $instance['icon_size'] ) : '24';
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		$pName = rawurlencode( $post->post_title );
		$pHref = rawurlencode( home_url() . '/?p=' . get_the_ID() ); //shorturl
		$pPict = rawurlencode( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) );

		$services = $this->default_services;

		$outer = '';
		foreach( $services as $key => $service ) {
			$href = sprintf( $service[1], $pName, $pHref, $pPict );
			if ( $instance[$key] ) $outer .= '<a class="share-item" rel="nofollow" target="_blank" id="wlw-' . $key . '" href="' . $href . '"><img src="' . get_template_directory_uri() . '/images/follow/' . strtolower( $key ) . '.png" width="' . $icon_size . '" height="' . $icon_size . '" alt="' . esc_attr( $service[0] ) . ' Button"  title="' . esc_attr( sprintf( __( 'Share with %s', 'wallow' ), $service[0] ) ) . '" /></a>';
		}
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<?php echo $outer; ?>
		<?php echo $after_widget; ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance["icon_size"] = in_array( $new_instance["icon_size"], $this->default_icon_size ) ? $new_instance["icon_size"] : '16' ;
	
		$services = $this->default_services;
		foreach( $services as $key => $service ) {
			$instance[$key] = (int) $new_instance[$key] ? 1 : 0;
		}

		return $instance;
	}

	function form( $instance ) {
		$size_array = $this->default_icon_size;
		$services = $this->default_services;
		
		foreach( $services as $key => $service ) {
			$def_instance[$key] = 1;
		}
		$def_instance['title'] = __( 'Share this', 'wallow' );
		$def_instance['icon_size'] = '24';
		
		//Defaults
		$instance = wp_parse_args( (array) $instance, $def_instance );
		$title = esc_attr( $instance['title'] );
		$icon_size = absint( $instance['icon_size'] );
		
		
		
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e( 'Select icon size', 'wallow' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'icon_size' ); ?>" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" >
			<?php foreach($size_array as $size) { ?>
				<option value="<?php echo $size; ?>" <?php selected( $icon_size, $size ); ?>><?php echo $size; ?>px</option>
			<?php } ?>
			</select>
		</p>
		<p>
		<?php foreach( $services as $key => $service ) { ?>
			<input id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" value="1" type="checkbox" <?php checked( 1 , $instance[$key] ); ?> />
			<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $service[0]; ?></label><br />
		<?php } ?>
		</p>

<?php
	}
}

/**
 * Post details widget class
 */
class Wallow_Widget_Post_Details extends WP_Widget {

	function Wallow_Widget_Post_Details() {
		$widget_ops = array( 'classname' => 'tb_post_details', 'description' => __( "Show some details and links related to the current post. It's visible ONLY in single posts", 'wallow' ) );
		$this->WP_Widget( 'wlw-post-details', __( 'Post details', 'wallow' ), $widget_ops );
		$this->alt_option_name = 'tb_post_details';

	}

	function post_details( $args = '' ) {
		global $post;

		$defaults = array(
			'author' => 1,
			'date' => 1,
			'tags' => 1,
			'categories' => 1,
			'avatar_size' => 48,
			'featured' => 0,
			'echo' => 1
		);

		$args = wp_parse_args( $args, $defaults );

		$tax_separator = apply_filters( 'wallow_filter_taxomony_separator', ', ' );

		$output = '';

		if ( $args['featured'] &&  has_post_thumbnail( $post->ID ) )
			$output .= '<div class="post-details-thumb">' . get_the_post_thumbnail( $post->ID, 'thumbnail') . '</div>';

		if ( $args['author'] )
			$output .= wallow_author_badge( $post->post_author, $args['avatar_size'] );

		$output .= '<ul class="post-details">';

		if ( $args['categories'] )
			$output .= '<li class="post-details-cats"><i class="icon-folder-close"></i> <span>' . __( 'Categories', 'wallow' ) . ': </span>' . get_the_category_list( $tax_separator ) . '</li>';

		if ( $args['tags'] )
			$tags = get_the_tags() ? get_the_tag_list( '</span>', $tax_separator, '' ) : __( 'No Tags', 'wallow' ) . '</span>';
			$output .= '<li class="post-details-tags"><i class="icon-tags"></i> <span>' . __( 'Tags', 'wallow' ) . ': ' . $tags . '</li>';

		if ( $args['date'] )
			$output .= '<li class="post-details-date"><i class="icon-time"></i> <span>' . __( 'Published', 'wallow' ) . ': </span><a href="' . get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '">' . get_the_time( get_option( 'date_format' ) ) . '</a></li>';

		$output .= '</ul>';

		if ( ! $args['echo'] )
			return $output;

		echo $output;

	}

	function widget($args, $instance) {
		if ( !is_single() || is_attachment() ) return;
		extract($args);

		$avatar_size = isset($instance['avatar_size']) ? absint( $instance['avatar_size'] ) : '48';

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		$this->post_details( array( 'author' => $instance['author'], 'date' => $instance['date'], 'tags' => $instance['tags'], 'categories' => $instance['categories'], 'avatar_size' => $avatar_size, 'featured' => $instance['featured'] ) );
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['featured'] = (int) $new_instance['featured'] ? 1 : 0;
		$instance['author'] = (int) $new_instance['author'] ? 1 : 0;
		$instance['avatar_size'] = in_array( $new_instance['avatar_size'], array ( '32', '48', '64', '96', '128' ) ) ? $new_instance['avatar_size'] : '48' ;
		$instance['date'] = (int) $new_instance['date'] ? 1 : 0;
		$instance['tags'] = (int) $new_instance['tags'] ? 1 : 0;
		$instance['categories'] = (int) $new_instance['categories'] ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Post details', 'wallow' ), 'featured' => 0, 'author' => 1, 'avatar_size' => '48', 'date' => 1, 'tags' => 1, 'categories' => 1 ) );
		$title = esc_attr( $instance['title'] );
		$featured = absint( $instance['featured'] );
		$author = absint( $instance['author'] );
		$avatar_size = absint( $instance['avatar_size'] );
		$date = absint( $instance['date'] );
		$tags = absint( $instance['tags'] );
		$categories = absint( $instance['categories'] );
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'featured' ); ?>" name="<?php echo $this->get_field_name( 'featured' ); ?>" value="1" type="checkbox" <?php checked( 1 , $featured ); ?> />
			<label for="<?php echo $this->get_field_id( 'featured' ); ?>"><?php _e( 'Thumbnail', 'wallow' ); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" value="1" type="checkbox" <?php checked( 1 , $author ); ?> />
			<label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e( 'Author', 'wallow' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'avatar_size' ); ?>"><?php _e( 'Select avatar size', 'wallow' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'avatar_size' ); ?>" id="<?php echo $this->get_field_id( 'avatar_size' ); ?>" >
<?php
			$size_array = array ( '32', '48', '64', '96', '128' );
			foreach( $size_array as $size ) {
?>
				<option value="<?php echo $size; ?>" <?php selected( $avatar_size, $size ); ?>><?php echo $size; ?>px</option>
<?php
			}
?>
			</select>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" value="1" type="checkbox" <?php checked( 1 , $date ); ?> />
			<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Date', 'wallow' ); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" value="1" type="checkbox" <?php checked( 1 , $tags ); ?> />
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags', 'wallow' ); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" value="1" type="checkbox" <?php checked( 1 , $categories ); ?> />
			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'wallow' ); ?></label>
		</p>
<?php
	}
}

/**
 * Recent_Comments widget class
 *
 * based on WP_Widget_Recent_Comments
 * adds the excerpt (optional)
 */
class Wallow_Widget_Recent_Comments extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments', 'wallow' ) );
		parent::__construct( 'recent-comments', __( 'Recent Comments (Enhanced)', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style' ) );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache' ) );
	}

	function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_comments', 'widget' );
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get( 'widget_recent_comments', 'widget' );

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments', 'wallow' ) : $instance['title'], $instance, $this->id_base );

		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 5;

		if ( ! isset($instance['excerpt']) || empty( $instance['excerpt'] ) || ! $excerpt = absint( $instance['excerpt'] ) )
 			$excerpt = 0;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) );
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul id="recentcomments">';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				$the_excerpt = $excerpt ? '<div class="rc-preview">' . get_comment_excerpt( $comment->comment_ID ) . '</div>' : '';
				$the_class = $excerpt ? ' class="small"' : '';
				$output .=  '<li class="recentcomments">
					<span' . $the_class . '>' . /* translators: comments widget: 1: comment author, 2: post link */ sprintf(_x( '%1$s on %2$s', 'widgets', 'wallow' ), get_comment_author_link(), '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>' ) . '</span>
					' . $the_excerpt . '
					</li>';
			}
 		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set( 'widget_recent_comments', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$instance['excerpt'] = isset( $new_instance['excerpt'] ) ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option( 'widget_recent_comments' );

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$excerpt = isset($instance['excerpt']) ? absint($instance['excerpt']) : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show', 'wallow' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input type="checkbox" value="1" class="checkbox" id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>"<?php checked( $excerpt ); ?> />
		<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>"><?php _e( 'Show excerpt', 'wallow' ); ?></label></p>
		
<?php
	}
}

/**
 * Clean Archives Widget
 */
class Wallow_Widget_Clean_Archives extends WP_Widget {

	function Wallow_Widget_Clean_Archives() {
		$widget_ops = array( 'classname' => 'tb_clean_archives', 'description' => __( "Show archives in a cleaner way", 'wallow' ) );
		$this->WP_Widget( 'wlw-clean-archives', __( 'Clean Archives', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'tb_clean_archives';

	}

	function widget($args, $instance) {
		extract($args);
		
		global $wpdb; // Wordpress Database
		
		$years = $wpdb->get_results( "SELECT distinct year(post_date) AS year, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year(post_date) ORDER BY post_date DESC" );
		
		if ( empty( $years ) ) {
			return; // empty archive
		}
		
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);
		$month_style = ( isset($instance['month_style']) && in_array( $instance['month_style'], array ( 'number', 'acronym' ) ) ) ? $instance['month_style'] : 'number';
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<?php
			if ( $month_style == 'acronym' )
				$months_short = array( '', __( 'jan', 'wallow' ), __( 'feb', 'wallow' ), __( 'mar', 'wallow' ), __( 'apr', 'wallow' ), __( 'may', 'wallow' ), __( 'jun', 'wallow' ), __( 'jul', 'wallow' ), __( 'aug', 'wallow' ), __( 'sep', 'wallow' ), __( 'oct', 'wallow' ), __( 'nov', 'wallow' ), __( 'dec', 'wallow' ) );
			else
				$months_short = array( '', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' );
			
		?>
		<ul class="clean-archives">
		<?php foreach ( $years as $year ) {
			echo '<li><a class="year-link" href="' . get_year_link( $year->year ) . '">' . $year->year . '</a>';
			
			for ( $month = 1; $month <= 12; $month++ ) {
				if ( (int) $wpdb->get_var( "SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND year(post_date) = '$year->year' AND month(post_date) = '$month'" ) > 0 ) {
					echo '<a class="month-link" href="' . get_month_link( $year->year, $month ) . '">' . $months_short[$month] . '</a>';
				}
			}
			
			echo '</li>';
		} ?>
		
		</ul>
		<?php echo $after_widget; ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance["month_style"] = in_array( $new_instance["month_style"], array ( 'number', 'acronym' ) ) ? $new_instance["month_style"] : 'number' ;

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : __( 'Archives', 'wallow' );
		$month_style = isset($instance['month_style']) ? esc_attr($instance['month_style']) : 'number';
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'month_style' ); ?>"><?php _e( 'Select month style', 'wallow' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'month_style' ); ?>" id="<?php echo $this->get_field_id( 'month_style' ); ?>" >
				<option value="number" <?php selected( $month_style, 'number' ); ?>><?php _e( 'number', 'wallow' ); ?></option>
				<option value="acronym" <?php selected( $month_style, 'acronym' ); ?>><?php _e( 'acronym', 'wallow' ); ?></option>
			</select>
		</p>
<?php
	}
}


/**
 * Register the widgets on startup.
 * 
 * Widgets list is filterable.
 */
function wallow_register_widgets() {

	if ( !is_blog_installed() )
		return;

	if ( ! wallow_get_opt( 'wallow_custom_widgets' ) )
		return;

	register_widget( 'Wallow_Widget_Popular_Posts' );

	register_widget( 'Wallow_Widget_Latest_Commented_Posts' );

	register_widget( 'Wallow_Widget_Latest_Commentators' );

	register_widget( 'Wallow_Widget_User_Quick_Links' );

	register_widget( 'Wallow_Widget_Pop_Categories' );

	register_widget( 'Wallow_Widget_Social' );

	register_widget( 'Wallow_Widget_Recent_Posts' );

	register_widget( 'Wallow_Widget_Image_Details' );

	register_widget( 'Wallow_Widget_Share_This' );

	register_widget( 'Wallow_Widget_Post_Details' );

	register_widget( 'Wallow_Widget_Clean_Archives' );

}
