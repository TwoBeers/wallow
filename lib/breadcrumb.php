<?php
/**
 * breadcrumb.php
 *
 * The breadcrumb class.
 * Supports Breadcrumb NavXT and Yoast Breadcrumbs plugins.
 *
 * @package Wallow
 * @since 0.60
 */


class Wallow_Breadcrumb {

	function __construct() {

		add_action( 'wallow_hook_content_top', array( $this, 'display' ) );

	}


	function display() {

		$output = '';

		if ( function_exists( 'bcn_display' ) ) { // Breadcrumb NavXT

			$output = bcn_display( true );

		} elseif ( function_exists( 'yoast_breadcrumb' ) ) { // Yoast Breadcrumbs

			$output = yoast_breadcrumb( '', '', false );

		}

		if ( $output )
			echo '<div id="breadcrumb-wrap" class="fixfloat">' . $output . '</div>';

	}

}

new Wallow_Breadcrumb;