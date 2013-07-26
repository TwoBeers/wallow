<?php
/**
 * common.php
 *
 * all the common functions
 *
 * @package Wallow
 * @since 0.60
 */


/* Custom actions - WP hooks */

add_action( 'comment_form_before'				, 'wallow_enqueue_comments_reply' );


/* Custom actions - theme hooks */

add_action( 'wallow_hook_body_top'				, 'wallow_init_scripts' );


/* Custom filters - WP hooks */

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
				$output .= $parent_label . '<a href="' . esc_url( get_permalink( $parent ) ) . '" title="' . esc_attr( strip_tags( get_the_title( $parent ) ) ) . '">' . get_the_title( $parent ) . '</a>';

			if ( $childs && $parent )
				$output .= $separator;

			if ( $childs ) {
				$_childs = array();
				foreach ( $childs as $child ) {
					$_childs[] = '<a href="' . esc_url( get_permalink( $child ) ) . '" title="' . esc_attr( strip_tags( get_the_title( $child ) ) ) . '">' . get_the_title( $child ) . '</a>';
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
			'id'					=> 0,
			'fields'				=> array( 'featured', 'author', 'categories', 'tags', 'date', 'comments' ),
			'featured_label'		=> '',
			'author_label'			=> '',
			'categories_label'		=> __( 'Categories', 'wallow' ). ': ',
			'tags_label'			=> __( 'Tags', 'wallow' ). ': ',
			'date_label'			=> __( 'Published', 'wallow' ). ': ',
			'comments_label'		=> __( 'Comments', 'wallow' ). ': ',
			'featured_class'		=> 'thumb',
			'author_class'			=> 'author',
			'categories_class'		=> 'cats',
			'tags_class'			=> 'tags',
			'date_class'			=> 'date',
			'comments_class'		=> 'comments',
			'avatar_size'			=> 48,
			'taxomony_separator'	=> apply_filters( 'wallow_filter_taxomony_separator', ', ' ),
			'class'					=> '',
			'format'				=> 'ul',
			'echo'					=> 1,
		);

		$args = wp_parse_args( $args, $defaults );

		foreach ( array( 'author_label', 'categories_label', 'tags_label', 'date_label', 'comments_label' ) as $label ) {
			$args[$label] = $args[$label] ? '<span class="label">' . $args[$label] . '</span>' : $args[$label];
		}

		$args['id'] = intval( $args['id'] );
		$post = get_post( $args['id'] );

		$args['class'] = $args['class'] ? ' '. esc_attr( $args['class'] ) : '';

		$details = array();

		foreach ( (array)$args['fields'] as $field ) {

			if ( $field == 'featured' )
				$details[$field] = has_post_thumbnail( $post->ID ) ? get_the_post_thumbnail( $post->ID, 'thumbnail') : apply_filters( 'wallow_filter_details_featured', '' );

			elseif ( $field == 'author' ) {
				if ( $args['author_label'] )
					$details[$field] = get_the_author_meta( 'nickname', $post->post_author );
				else
					$details[$field] = wallow_author_badge( $post->post_author, $args['avatar_size'] );
			}

			elseif ( $field == 'categories' )
				$details[$field] = get_the_category_list( $args['taxomony_separator'], '', $post->ID );

			elseif ( $field == 'tags' )
				$details[$field] = has_tag( '', $post->ID ) ? get_the_tag_list( '', $args['taxomony_separator'], '', $post->ID ) : __( 'No Tags', 'wallow' );

			elseif ( $field == 'date' )
				$details[$field] = '<a href="' . esc_url( get_day_link( get_the_time( 'Y', $post->ID ), get_the_time( 'm', $post->ID ), get_the_time( 'd', $post->ID ) ) ) . '">' . get_the_time( get_option( 'date_format' ), $post->ID ) . '</a>';

			elseif ( $field == 'comments' )
				$details[$field] = wallow_get_comments_link();

		}

		if ( $args['format'] == 'array' )
			return $details;

		if ( $args['format'] == 'div' )
			$tag = array( 'out' => 'div', 'in' => 'div' );
		else
			$tag = array( 'out' => 'ul', 'in' => 'li' );

		$output = '<' . $tag['out'] . ' class="post-details' . $args['class'] . '">';

		foreach ( $details as $key => $value ) {
			$text = ( strpos( $args[$key . '_label'], '%s' ) === false ) ? $args[$key . '_label'] . $value : sprintf( $args[$key . '_label'], $value );
			$output .= '<' . $tag['in'] . ' class="post-details-' . $args[$key . '_class'] . '">' . $text . '</' . $tag['in'] . '>';
		}

		$output .= '</' . $tag['out'] . '>';

		if ( ! $args['echo'] )
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

	$author_link = esc_url( get_author_posts_url( $author ) ); // link to author posts

	$author_net = ''; // author social networks
	foreach ( array( 'twitter' => 'Twitter', 'facebook' => 'Facebook', 'googleplus' => 'Google+' ) as $s_key => $s_name ) {
		if ( get_the_author_meta( $s_key, $author ) ) $author_net .= '<a target="_blank" class="url" title="' . esc_attr( sprintf( __('Follow %s on %s', 'wallow'), $name, $s_name ) ) . '" href="' . esc_url( get_the_author_meta( $s_key, $author ) ) . '"><img alt="' . esc_attr( $s_key ) . '" class="social-icon" width="24" height="24" src="' . esc_url( get_template_directory_uri() . '/images/follow/' . $s_key . '.png' ) . '" /></a>';
	}

	$output = '<li class="author-avatar">' . $avatar . '</li>';
	$output .= '<li class="author-name"><a class="fn" href="' . $author_link . '" >' . $name . '</a></li>';
	$output .= $description ? '<li class="author-description note">' . $description . '</li>' : '';
	$output .= $author_net ? '<li class="author-social">' . $author_net . '</li>' : '';

	$output = '<div class="tb-author-bio vcard"><ul>' . $output . '</ul></div>';

	return apply_filters( 'wallow_filter_author_badge', $output );

}


// Displays the link to the comments
function wallow_get_comments_link( $args = '' ) {

	$defaults = array(
		'zero'		=> false,
		'one'		=> false,
		'more'		=> false,
		'css_class'	=> '',
		'none'		=> false,
		'before'	=> '',
		'after'		=> '',
		'id'		=> false,
	);
	$args = wp_parse_args( $args, $defaults );
	extract($args, EXTR_SKIP);

	if ( false === $zero )	$zero	= __( 'Leave a Comment', 'wallow' );
	if ( false === $one )	$one	= __( '1 Comment', 'wallow' );
	if ( false === $more )	$more	= __( '% Comments', 'wallow' );
	if ( false === $none )	$none	= __( 'Comments Off', 'wallow' );
	$id = ( $id ) ? (int)$id : get_the_ID();
	$css_class = ( ! empty( $css_class ) ) ? ' class="' . esc_attr( $css_class ) . '"' : '';

	$number = get_comments_number( $id );

	if ( 0 == $number && !comments_open() && !pings_open() ) {

		$output = $none ? $before . '<span' . $css_class . '>' . $none . '</span>' . $after : '';

	} elseif ( post_password_required() ) {

		$output = $before . __( 'Enter your password to view comments', 'wallow' ) . $after;

	} else {

		$label = wallow_get_opt( 'wallow_cust_comrep' ) ? '#comments' : '#respond';
		$href = ( 0 == $number ) ? get_permalink() . $label : get_comments_link();
		$title = esc_attr( sprintf( __( 'Comment on %s', 'wallow'), the_title_attribute( array( 'echo' => 0 ) ) ) );

		if ( $number > 1 )
			$text = str_replace( '%', number_format_i18n( $number ), $more );
		elseif ( $number == 0 )
			$text = $zero;
		else
			$text = $one;

		$output = $before . '<a' . $css_class . ' href="' . esc_url( $href ) . '" title="' . esc_attr( $title ) . '">' . $text . '</a>' . $after;

	}

	return apply_filters( 'wallow_get_comments_link' , $output );

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
