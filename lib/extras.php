<?php

namespace MW\Ripples\Extras;

use MW\Ripples\Config;

/**
 * Add <body> classes
 */
function body_class( $classes ) {
	// Add page slug if it doesn't exist
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	// Add class if sidebar is active
	if ( Config\display_sidebar() ) {
		$classes[] = 'sidebar-primary';
	}

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
	return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'ripples' ) . '</a>';
}

add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );

function my_rewrite_flush() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', __NAMESPACE__ . '\\my_rewrite_flush' );