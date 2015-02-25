<?php
/**
 * This file contains important frontend functionality.
 *
 * @package mywptheme
 */

function mywptheme_enqueue_scripts() {
	$style_dependencies = apply_filters( 'mywptheme_style_dependencies', array() );
	$script_dependencies = apply_filters( 'mywptheme_script_dependencies', array( 'jquery' ) );

	wp_enqueue_style( 'mywptheme', MYWPTHEME_THEME_URL . '/assets/dist/mywptheme.min.css', $style_dependencies, MYWPTHEME_THEME_VERSION );
	wp_enqueue_script( 'mywptheme', MYWPTHEME_THEME_URL . '/assets/dist/mywptheme.min.js', $script_dependencies, MYWPTHEME_THEME_VERSION, true );

	$script_vars = apply_filters( 'mywptheme_script_vars', array(
		'load_fancybox'			=> false,
		'load_tooltips'			=> false,
		'load_popovers'			=> false,
		'wrap_embeds'			=> true,
	) );

	wp_localize_script( 'mywptheme', '_theme_config', $script_vars );

	if ( WP_DEBUG ) {
		wp_enqueue_script( 'livereload', untrailingslashit( home_url() ) . ':35729/livereload.js?snipver=1', array(), false, true );
	}
}
add_action( 'wp_enqueue_scripts', 'mywptheme_enqueue_scripts' );

function mywptheme_wp_title( $sep ) {
	if ( defined( 'WPSEO_VERSION' ) ) {
		wp_title( '' );
	} else {
		wp_title( $sep, true, 'right' );
		if ( ! is_feed() ) {
			global $page, $paged;

			bloginfo( 'name', 'display' );

			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) ) {
				echo ' ' . $sep . ' ' . $site_description;
			}

			if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
				echo ' ' . $sep . ' ' . sprintf( __( 'Page %s', 'mywptheme' ), max( $paged, $page ) );
			}
		}
	}
}
