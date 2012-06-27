<?php

/**
 * wallow Widgets
 *
 * based on WordPress default widgets (wp-includes/default-widgets.php)
 */

/**
 * Popular_Posts widget class
 */
class wallow_Widget_popular_posts extends WP_Widget {

	function wallow_Widget_popular_posts() {
		$widget_ops = array( 'classname' => 'wlw_widget_popular_posts', 'description' => __( 'The most commented posts on your site', 'wallow' ) );
		$this->WP_Widget( 'wlw-popular-posts', __( 'Popular posts', 'wallow' ), $widget_ops );
		$this->alt_option_name = 'wlw_widget_popular_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'wlw_widget_popular_posts', 'widget' );

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Popular posts', 'wallow' ) : $instance['title'], $instance, $this->id_base );
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;
		
		$r = new WP_Query( array( 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count' ) );
		if ( $r->have_posts() ) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul<?php if ( $use_thumbs ) echo ' class="with-thumbs"'; ?>>
		<?php  while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<?php
					if ( $use_thumbs ) {
						$the_thumb = has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), array( 40,40 ) ) : '<img src="' . get_template_directory_uri() . '/images/post-thumb.png' . '" alt="post-thumb" />';
					} else {
						$the_thumb = '';
					}
				 ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo $the_thumb; ?><?php the_title(); ?> <span class="details">(<?php echo get_comments_number(); ?>)</span></a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('wlw_widget_popular_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wlw_widget_popular_posts']) )
			delete_option('wlw_widget_popular_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw_widget_popular_posts', 'widget' );
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
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'wallow' ); ?></label>
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
class wallow_widget_latest_commented_posts extends WP_Widget {

	function wallow_widget_latest_commented_posts() {
		$widget_ops = array( 'classname' => 'wlw_widget_latest_commented_posts', 'description' => __( 'The latest commented posts/pages of your site','wallow' ) );
		$this->WP_Widget( 'wlw-recent-comments', __( 'Latest activity', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'wlw_widget_latest_commented_posts';

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw_widget_latest_commented_posts', 'widget' );
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get( 'wlw_widget_latest_commented_posts', 'widget' );

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
 		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Latest activity', 'wallow' ) : $instance['title'] );

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
						if( has_post_thumbnail( $post->ID ) ) {
							$the_thumb = get_the_post_thumbnail( $post->ID, array( 40,40 ) );
						} else {
							$the_thumb = '<img src="' . get_template_directory_uri() . '/images/post-thumb.png' . '" alt="post-thumb" />';
						}
					} else {
						$the_thumb = '';
					}
					
					$output .=  '<li><a href="' . get_permalink( $post->ID ) . '" title="' .  esc_html( $post->post_title ) . '">' . $the_thumb . $post->post_title . '</a></li>';
					$post_array[] = $comment->comment_post_ID;
					if ( ++$counter >= $number ) break;
				}
			}
 		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('wlw_widget_latest_commented_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['wlw_widget_latest_commented_posts'] ) )
			delete_option( 'wlw_widget_latest_commented_posts' );

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$thumb = 1;
		if ( isset( $instance['thumb'] ) && !$thumb = (int) $instance['thumb'] )
			$thumb = 0;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'wallow' ); ?></label>
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
class wallow_widget_latest_commentators extends WP_Widget {

	function wallow_widget_latest_commentators() {
		$widget_ops = array( 'classname' => 'wlw_widget_latest_commentators', 'description' => __( 'The latest comment authors','wallow' ) );
		$this->WP_Widget( 'wlw-recent-commentators', __( 'Latest comment authors', 'wallow' ), $widget_ops);
		$this->alt_option_name = 'wlw_widget_latest_commentators';

		add_action( 'comment_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'transition_comment_status', array( &$this, 'flush_widget_cache' ) );
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wlw_widget_latest_commentators', 'widget' );
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		if ( get_option( 'require_name_email' ) != '1' ) return; //commentors must be identifiable
		
		$cache = wp_cache_get( 'wlw_widget_latest_commentators', 'widget' );

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		extract( $args, EXTR_SKIP );
 		$output = '';
 		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Latest comment authors', 'wallow' ) : $instance['title'] );

		if ( ! $number = (int) $instance['number'] )
 			$number = 5;
 		else if ( $number < 1 )
 			$number = 1;

		$comments = get_comments( array( 'status' => 'approve', 'type' => 'comment', 'number' => 200 ) );
		$post_array = array();
		$counter = 0;
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul>';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				if ( !in_array( $comment->comment_author_email, $post_array ) ) {
					if ( $comment->comment_author_url == '' ) {
						$output .=  '<li title="' .  $comment->comment_author . '">' . get_avatar( $comment, 32, $default=get_option( 'avatar_default' ) ) . ' ' . $comment->comment_author . '</li>';
					} else {
						$output .=  '<li><a href="' . $comment->comment_author_url . '" title="' .  $comment->comment_author . '">' . get_avatar( $comment, 32, $default=get_option( 'avatar_default' ) ) . ' ' . $comment->comment_author . '</a></li>';
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
		wp_cache_set( 'wlw_widget_latest_commentators', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['wlw_widget_latest_commentators'] ) )
			delete_option( 'wlw_widget_latest_commentators' );

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		if ( get_option( 'require_name_email' ) != '1' ) {
			printf ( __( 'Comment authors <strong>must</strong> use a name and a valid e-mail in order to use this widget. Check the <a href="%1$s">Discussion settings</a>', 'wallow' ), esc_url( admin_url( 'options-discussion.php' ) ) );
			return;
		}
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of users to show:', 'wallow' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
<?php
	}
}

/**
 * User_quick_links widget class
 *
 */
class wallow_user_quick_links extends WP_Widget {

	function wallow_user_quick_links() {
		$widget_ops = array( 'classname' => 'wlw_widget_user_quick_links', 'description' => __( 'Some useful links for users', 'wallow' ) );
		$this->WP_Widget( 'wlw-user-quick-links', __( 'User quick links', 'wallow' ), $widget_ops );
		$this->alt_option_name = 'wlw_widget_user_quick_links';
	}

	function widget( $args, $instance ) {
		global $current_user;
		
		extract( $args, EXTR_SKIP );
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Welcome %s', 'wallow' ) : $instance['title'], $instance, $this->id_base );
		$title = sprintf ( $title, $current_user->display_name );
		
		$use_thumbs = ( !isset($instance['thumb']) || $thumb = (int) $instance['thumb'] ) ? 1 : 0;
		if ( $use_thumbs ) {
			if ( is_user_logged_in() ) { //fix for notice when user not log-in
				$email = $current_user->user_email;
				$title = get_avatar( $email, 32, $default = get_template_directory_uri() . '/images/user.png','user-avatar' ) . ' ' . $title;
			} else {
				$title = get_avatar( 'dummyemail', 32, $default = get_template_directory_uri() . '/images/user.png','user-avatar' ) . ' ' . $title;
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
						<li><a title="<?php _e( 'Add New Post', 'wallow' ); ?>" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php _e( 'Add New Post', 'wallow' ); ?></a></li>
					<?php } ?>
					<?php if ( current_user_can( 'moderate_comments' ) ) {
						$wlw_awaiting_mod = wp_count_comments();
						$wlw_awaiting_mod = $wlw_awaiting_mod->moderated;
						$wlw_awaiting_mod = $wlw_awaiting_mod ? ' <span class="details">(' . number_format_i18n( $wlw_awaiting_mod ) . ')</span>' : '';
					?>
						<li><a title="<?php _e( 'Comments', 'wallow' ); ?>" href="<?php echo esc_url( admin_url( 'edit-comments.php' ) ); ?>"><?php _e( 'Comments', 'wallow' ); echo $wlw_awaiting_mod; ?></a></li>
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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['thumb'] = (int) $new_instance['thumb'] ? 1 : 0;
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$thumb = 1;
		if ( isset( $instance['thumb'] ) && !$thumb = (int) $instance['thumb'] )
			$thumb = 0;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wallow' ); ?><br /><?php _e( 'default: "Welcome %s" , where %s is the user name', 'wallow' );?></label>
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
 * @since 2.8.0
 */
class wallow_widget_pop_categories extends WP_Widget {

	function wallow_widget_pop_categories() {
		$widget_ops = array( 'classname' => 'wlw_widget_categories', 'description' => __( 'A list of popular categories', 'wallow' ) );
		$this->WP_Widget( 'wlw-categories', __( 'Popular categories', 'wallow' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Popular categories', 'wallow' ) : $instance['title'], $instance, $this->id_base );
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
		$cat_args = array( 'orderby' => 'count', 'hierarchical' => 0, 'order' => 'DESC', 'number' => $number );
		$categories =  get_categories( $cat_args ); 
		foreach ($categories as $category) {
			$item = '<li class="cat-item cat-item-' . $category->term_id . '">';
			$cat_name = esc_attr( $category->name );
			$cat_name = apply_filters( 'list_cats', $cat_name, $category );
			$link = '<a href="' . esc_attr( get_term_link($category) ) . '">' .  $cat_name . ' <span class="details">(' . intval($category->count) . ')</span></a>';
			$item .= $link . '</li>';
			echo $item;
		}
?>
			<li class="wlw_allcat"><a title="<?php _e( 'View all categories', 'wallow' ); ?>" href="<?php  echo home_url(); ?>/?allcat=y"><?php _e( 'View all', 'wallow' ); ?></a></li>
		</ul>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wallow' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of categories to show:', 'wallow' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
<?php
	}

}

/**
 * Register all of the default WordPress widgets on startup.
 */
function wallow_widgets_init() {
	if ( !is_blog_installed() )
		return;

	register_widget( 'wallow_Widget_popular_posts' );

	register_widget( 'wallow_Widget_latest_Commented_Posts' );
	
	register_widget( 'wallow_widget_latest_commentators' );
	
	register_widget( 'wallow_user_quick_links' );

	register_widget( 'wallow_widget_pop_categories' );
}

add_action('widgets_init', 'wallow_widgets_init' );
