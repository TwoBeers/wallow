<?php
/**
 * common.php
 *
 * all the common functions
 *
 * @package Wallow
 * @since 0.60
 */


add_action( 'comment_form_before'				, 'wallow_enqueue_comments_reply' );
add_action( 'wp_footer'							, 'wallow_init_scripts' );
add_filter( 'page_css_class'					, 'wallow_add_parent_class', 10, 4 );
add_filter( 'wp_nav_menu_objects'				, 'wallow_add_menu_parent_class' );
add_filter( 'wp_list_categories'				, 'wallow_wrap_categories_count' );


//theme infos
function wallow_get_info( $field ) {
	static $infos;

	if ( !isset( $infos ) ) {

		$infos['theme'] =			wp_get_theme( 'wallow' );
		$infos['current_theme'] =	wp_get_theme();
		$infos['version'] =			$infos['theme']? $infos['theme']['Version'] : '';

	}

	return $infos[$field];
}


// page hierarchy
if ( !function_exists( 'wallow_get_multipages' ) ) {
	function wallow_get_multipages( $args = '' ) {

		$defaults = array(
			'id'			=> 0,
			'before'		=> '',
			'after'			=> '',
			'separator'		=> '',
			'show_parent'	=> true,
			'show_childs'	=> true,
			'parent_label'	=> __( 'Parent page: ', 'wallow' ),
			'childs_label'	=> __( 'Child pages: ', 'wallow' ),
		);

		$args = wp_parse_args( $args, $defaults );

		extract( $args, EXTR_SKIP );

		$id = intval( $id );
		$post = get_post( $id );

		$param = array(
			'post_type' => 'page',
			'post_parent' => $post->ID,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'numberposts' => 0
		);

		$childs = $childs_label ? get_posts( $param ) : false; // retrieve the child pages

		$parent = $show_parent ? $post->post_parent : false; // retrieve the parent page

		$output = '';

		if ( ( $childs ) || ( $parent ) ) {

			$output .= $before;

			if ( $parent )
				$output .= $parent_label . '<a href="' . get_permalink( $parent ) . '" title="' . esc_attr( strip_tags( get_the_title( $parent ) ) ) . '">' . get_the_title( $parent ) . '</a>';

			if ( $childs && $parent )
				$output .= $separator;

			if ( $childs ) {
				$_childs = array();
				foreach ( $childs as $child ) {
					$_childs[] = '<a href="' . get_permalink( $child ) . '" title="' . esc_attr( strip_tags( get_the_title( $child ) ) ) . '">' . get_the_title( $child ) . '</a>';
				}
				$_childs = implode( ', ' , $_childs );
				$output .= $childs_label . $_childs;
			}

		}

		return $output;

	}
}


// Search reminder
function wallow_get_search_reminder( $args = '' ) {

	$defaults = array(
		'id'			=> 0,
		'before'		=> '',
		'after'			=> '',
		'archive_label'	=> '%s: ',
		'search_label'	=> __( 'Search results for &#8220;%s&#8221;', 'wallow' ),
	);

	$args = wp_parse_args( $args, $defaults );

	extract( $args, EXTR_SKIP );

	$id = intval( $id );
	$post = get_post( $id );

	$output = '';

	if ( is_archive() ) {

		$term = get_queried_object();
		$title = '';
		$type = '';

		if ( is_category() || is_tag() || is_tax() ) {

			if ( is_category() )	$type = __( 'Category', 'wallow' );
			elseif ( is_tag() )		$type = __( 'Tag', 'wallow' );
			elseif ( is_tax() )		$type = __( 'Taxonomy', 'wallow' );
			$title = $term->name;

		} elseif ( is_date() ) {

			$type = __( 'Date', 'wallow' );
			if ( is_day() ) {
				$title = get_the_date();
			} else if ( is_month() ) {
				$title = single_month_title( ' ', false );
			} else if ( is_year() ) {
				$title = get_query_var( 'year' );
			}

		} elseif ( is_author() ) {

			$type = __( 'Author', 'wallow' );
			$title = $term->display_name;

		}

		$output = sprintf( $archive_label, $type ) . '<span class="search-term">' . $title . '</span>';

	} elseif ( is_search() ) {

		$output = sprintf( $search_label, '<span class="search-term">' . esc_html( get_search_query() ) . '</span>' );

	}

	return $output;

}


// print extra info for posts/pages
if ( !function_exists( 'wallow_post_details' ) ) {
	function wallow_post_details( $args = '' ) {

		$defaults = array(
			'id'				=> 0,
			'featured'			=> 0,
			'author'			=> 1,
			'categories'		=> 1,
			'tags'				=> 1,
			'date'				=> 1,
			'author_label'		=> '',
			'categories_label'	=> __( 'Categories', 'wallow' ). ': ',
			'tags_label'		=> __( 'Tags', 'wallow' ). ': ',
			'date_label'		=> __( 'Published', 'wallow' ). ': ',
			'avatar_size'		=> 48,
			'separator'			=> apply_filters( 'wallow_filter_taxomony_separator', ', ' ),
			'class'				=> '',
			'echo'				=> 1,
		);

		$args = wp_parse_args( $args, $defaults );

		extract( $args, EXTR_SKIP );

		$id = intval( $id );
		$post = get_post( $id );

		$class = $class ? ' '. esc_attr( $class ) : '';

		$output = '<ul class="post-details' . $class . '">';

		if ( $featured &&  has_post_thumbnail( $post->ID ) )
			$output .= '<li class="post-details-thumb">' . get_the_post_thumbnail( $post->ID, 'thumbnail') . '</li>';

		if ( $author )
			if ( $author_label )
				$output .= '<li><span class="label">' . $author_label . '</span>' . get_the_author_meta( 'nickname', $post->post_author ) . '</li>';
			else
				$output .= '<li>' . wallow_author_badge( $post->post_author, $avatar_size ) . '</li>';

		if ( $categories )
			$output .= '<li class="post-details-cats"><span class="label">' . $categories_label . '</span>' . get_the_category_list( $separator, '', $post->ID ) . '</li>';

		if ( $tags )
			$tags = has_tag( '', $post->ID ) ? '</span>' . get_the_tags( '', $separator, '', $post->ID ) : __( 'No Tags', 'wallow' ) . '</span>';
			$output .= '<li class="post-details-tags"><span class="label">' . $tags_label . $tags . '</li>';

		if ( $date )
			$output .= '<li class="post-details-date"><span class="label">' . $date_label . '</span><a href="' . esc_url( get_day_link( get_the_time( 'Y', $post->ID ), get_the_time( 'm', $post->ID ), get_the_time( 'd', $post->ID ) ) ) . '">' . get_the_time( get_option( 'date_format' ), $post->ID ) . '</a></li>';

		$output .= '</ul>';

		if ( ! $echo )
			return $output;

		echo $output;

	}
}


// get the author badge
function wallow_author_badge( $author = '', $size = 32 ) {
	global $post;

	if ( ! $author )
		$author = $post->post_author;

	$name = get_the_author_meta( 'nickname', $author ); // nickname

	$avatar = get_avatar( $author, $size, 'Gravatar Logo', get_the_author_meta( 'user_nicename', $author ) . '-photo' ); // gravatar

	$description = get_the_author_meta( 'description', $author ); // bio

	$author_link = get_author_posts_url($author); // link to author posts

	$author_net = ''; // author social networks
	foreach ( array( 'twitter' => 'Twitter', 'facebook' => 'Facebook', 'googleplus' => 'Google+' ) as $s_key => $s_name ) {
		if ( get_the_author_meta( $s_key, $author ) ) $author_net .= '<a target="_blank" class="url" title="' . esc_attr( sprintf( __('Follow %s on %s', 'wallow'), $name, $s_name ) ) . '" href="'.get_the_author_meta( $s_key, $author ).'"><img alt="' . $s_key . '" class="social-icon" width="24" height="24" src="' . get_template_directory_uri() . '/images/follow/' . $s_key . '.png" /></a>';
	}

	$output = '<li class="author-avatar">' . $avatar . '</li>';
	$output .= '<li class="author-name"><a class="fn" href="' . $author_link . '" >' . $name . '</a></li>';
	$output .= $description ? '<li class="author-description note">' . $description . '</li>' : '';
	$output .= $author_net ? '<li class="author-social">' . $author_net . '</li>' : '';

	$output = '<div class="tb-post-details tb-author-bio vcard"><ul>' . $output . '</ul></div>';

	return apply_filters( 'wallow_filter_author_badge', $output );

}


//get adjacent attachments
function wallow_get_adjacent_attachments( $id = 0 ) {

	$id = intval( $id );
	$post = get_post( $id );

	$attachments = array_values( get_children( array(
		'post_parent' => $post->post_parent,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID'
	) ) );

	foreach ( $attachments as $key => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}

	$prev_key = $key - 1;
	$next_key = $key + 1;

	return array(
		'prev' => isset( $attachments[ $prev_key ] ) ? $attachments[ $prev_key ] : false,
		'next' => isset( $attachments[ $next_key ] ) ? $attachments[ $next_key ] : false,
	);

}


// get the post format string
if ( !function_exists( 'wallow_get_post_format' ) ) {
	function wallow_get_post_format( $id ) {

		if ( post_password_required() )
			$format = 'protected';
		else
			$format = get_post_format( $id ) ;

		return $format;

	}
}


// add a fix for embed videos
function wallow_wmode_transparent($html, $url = null, $attr = null) {

	if ( strpos( $html, '<embed ' ) !== false ) {

		$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed', $html);
		$html = str_replace('<embed ', '<embed wmode="transparent" ', $html);
		return $html;

	} elseif ( strpos ( $html, 'feature=oembed' ) !== false )

		return str_replace( 'feature=oembed', 'feature=oembed&wmode=transparent', $html );

	else

		return $html;

}


/**
 * Add parent class to wp_page_menu top parent list items
 */
function wallow_add_parent_class( $css_class, $page, $depth, $args ) {

	if ( ! empty( $args['has_children'] ) && $depth == 0 )
		$css_class[] = 'menu-item-parent';

	return $css_class;

}


/**
 * Add parent class to wp_nav_menu top parent list items
 */
function wallow_add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			if ( ! $item->menu_item_parent )
				$item->classes[] = 'menu-item-parent'; 
		}
	}

	return $items;    
}


// wrap the categories count with a span
function wallow_wrap_categories_count( $output ) {
	$pattern = '/<\/a>\s(\(\d+\))/i';
	$replacement = ' <span class="details">$1</span></a>';
	return preg_replace( $pattern, $replacement, $output );
}


//enqueue the 'comment-reply' script when needed
function wallow_enqueue_comments_reply() {

	if( get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}


// initialize scripts
if ( !function_exists( 'wallow_init_scripts' ) ) {
	function wallow_init_scripts(){

?>
	<script type="text/javascript">
		/* <![CDATA[ */
		(function(){
			var c = document.body.className;
			c = c.replace(/wlw-no-js/, 'wlw-js');
			document.body.className = c;
		})();
		/* ]]> */
	</script>
<?php

	}
}
