<?php
/**
 * Clean Bootstrap navigation.
 *
 * from Roots theme (http://roots.io/).
 *
 * @package mywptheme
 */

class MyWPTheme_Nav_Walker extends Walker_Nav_Menu {
	function check_current( $classes ) {
		return preg_match( '/(current[-_])|active|dropdown/', $classes );
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="dropdown-menu">';
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );

		if ( $item->is_dropdown && ( $depth === 0 ) ) {
			$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html );
			$item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
		} elseif( stristr( $item_html, 'li class="divider' ) ) {
			$item_html = preg_replace( '/<a[^>]*>.*?<\/a>/iU', '', $item_html );
		} elseif( stristr( $item_html, 'li class="dropdown-header' ) ) {
			$item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html );
		}

		$output .= $item_html;
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$element->is_dropdown = ( ( !empty( $children_elements[ $element->ID ] ) && ( ( $depth + 1 ) < $max_depth || ( $max_depth === 0 ) ) ) );

			if ( $element->is_dropdown )
			{
			$element->classes[] = 'dropdown';
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

function mywptheme_nav_menu_css_class( $classes, $item ) {
	$slug = sanitize_title( $item->title );
	$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes );
	$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

	$classes[] = 'menu-' . $slug;

	$classes = array_unique( $classes );

	return array_filter( $classes, 'mywptheme_is_element_empty' );
}
add_filter( 'nav_menu_css_class', 'mywptheme_nav_menu_css_class', 10, 2 );

add_filter( 'nav_menu_item_id', '__return_null' );

function mywptheme_nav_menu_args( $args = '' ) {
	$mywptheme_nav_menu_args = array();

	$mywptheme_nav_menu_args['container'] = false;

	if ( ! $args['items_wrap'] ) {
		$mywptheme_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
	}

	if ( ! $args['depth'] ) {
		$mywptheme_nav_menu_args['depth'] = 2;
	}

	if ( ! $args['walker'] ) {
		$mywptheme_nav_menu_args['walker'] = new MyWPTheme_Nav_Walker();
	}

	return array_merge( $args, $mywptheme_nav_menu_args );
}
add_filter( 'wp_nav_menu_args', 'mywptheme_nav_menu_args' );
