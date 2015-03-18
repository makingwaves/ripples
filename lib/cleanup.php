<?php

namespace MW\Ripples\Cleanup;

function head_cleanup() {
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
}


function after_setup_theme() {
	// launching operation cleanup
	add_action( 'init', __NAMESPACE__ . '\\head_cleanup' );
}

function kjell() {
	echo 'Hei Kjell';
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\after_setup_theme' );
