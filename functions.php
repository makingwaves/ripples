<?php
/**
 * functions.php for loading all theme-specific functionality
 *
 * @package mywptheme
 */

define( 'MYWPTHEME_THEME_VERSION', '1.0.0' );
define( 'MYWPTHEME_THEME_PATH', get_template_directory() );
define( 'MYWPTHEME_THEME_URL', get_template_directory_uri() );

function mywptheme_is_element_empty( $element ) {
	$element = trim( $element );
	return empty( $element ) ? false : true;
}

// load basic theme files
require_once MYWPTHEME_THEME_PATH . '/inc/theme-setup.php';
require_once MYWPTHEME_THEME_PATH . '/inc/backend.php';
require_once MYWPTHEME_THEME_PATH . '/inc/frontend.php';

// load all component files
foreach ( glob( MYWPTHEME_THEME_PATH . '/inc/components/*.php' ) as $file ) {
	require_once $file;
}
