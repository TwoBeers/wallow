<?php
/**
 * jetpack.php
 *
 * Jetpack support
 *
 * @package wallow
 * @since 0.60
 */


class Wallow_For_Jetpack {

	function __construct () {

		add_action( 'init', array( $this, 'init' ) ); //Jetpack support

	}


	/* initialize Jetpack support */
	function init() {

		if ( wallow_is_mobile() ) return;

		//Infinite Scroll
		add_theme_support( 'infinite-scroll', array(
			'type'			=> 'click',
			'container'		=> 'content',
			'render'		=> array( $this, 'infinite_scroll_render' ),
			'wrapper'		=> false,
		) );
		if ( class_exists( 'The_Neverending_Home_Page' ) ) {
			add_filter		( 'infinite_scroll_results'			, array( $this, 'infinite_scroll_encode' ), 11, 1 );
		}

		//Sharedaddy
		if ( function_exists( 'sharing_display' ) ) {
			remove_filter	( 'the_content'						, 'sharing_display', 19 );
			remove_filter	( 'the_excerpt'						, 'sharing_display', 19 );
			remove_action	( 'wallow_hook_entry_before'		, 'wallow_I_like_it' );
			add_action		( 'wallow_hook_entry_bottom'		, array( $this, 'sharedaddy' ) );
		}

		//Carousel
		if ( class_exists( 'Jetpack_Carousel' ) ) {
			remove_filter	( 'post_gallery'					, 'wallow_gallery_shortcode', 10, 2 );
			add_filter		( 'wallow_option_wallow_thickbox'	, '__return_false' );
		}

		//Likes
		if ( class_exists( 'Jetpack_Likes' ) ) {
			add_action		( 'wallow_hook_entry_bottom'		, array( $this, 'likes' ) );
			remove_filter	( 'the_content'						, array( Jetpack_Likes::init(), 'post_likes' ), 30, 1);
			add_filter		( 'wallow_filter_likes'				, array( Jetpack_Likes::init(), 'post_likes' ), 30, 1);
		}

	}

	//print the "likes" button after post content
	function likes() {

		echo '<br class="fixfloat">' . apply_filters('wallow_filter_likes','') . '<br class="fixfloat">';

	}


	//Set the code to be rendered on for calling posts,
	function infinite_scroll_render() {

		get_template_part( 'loop' );

	}


	//re-encodes html result to UTF8 (jetpack bug?)
	//http://localhost/wordpress/?infinity=scrolling&action=infinite_scroll&page=5&order=DESC
	function infinite_scroll_encode( $results ) {

		$results['html'] = utf8_encode( utf8_decode( $results['html'] ) );
		return $results;

	}


	//print the sharedaddy buttons inside the "I-like-it" container instead of after post content
	function sharedaddy() {

		echo sharing_display();

	}

}

new Wallow_For_Jetpack;
