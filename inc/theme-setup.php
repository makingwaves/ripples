<?php
/**
 * This file sets up the theme.
 *
 * @package mywptheme
 */

if( ! isset( $content_width ) ) {
	$content_width = 640;
}

function mywptheme_setup() {
	load_theme_textdomain( 'mywptheme', MYWPTHEME_THEME_PATH . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary'		=> __( 'Primary Menu', 'mywptheme' ),
	) );
}
add_action( 'after_setup_theme', 'mywptheme_setup' );

function mywptheme_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Primary Sidebar', 'mywptheme' ),
		'id'			=> 'primary',
		'description'	=> __( 'This sidebar is shown beside the main content.', 'mywptheme' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1>',
	) );
}
add_action( 'widgets_init', 'mywptheme_widgets_init' );
