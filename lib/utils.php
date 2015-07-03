<?php

namespace MW\Ripples\Utils;

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
	$form = '';
	locate_template( '/components/molecule/searchform.php', true, false );

	return $form;
}

add_filter( 'get_search_form', __NAMESPACE__ . '\\get_search_form' );

/**
 * Make a URL relative
 */
function root_relative_url( $input ) {
	preg_match( '|https?://([^/]+)(/.*)|i', $input, $matches );
	if ( ! isset( $matches[1] ) || ! isset( $matches[2] ) ) {
		return $input;
	} elseif ( ( $matches[1] === $_SERVER['SERVER_NAME'] ) || $matches[1] === $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] ) {
		return wp_make_link_relative( $input );
	} else {
		return $input;
	}
}

/**
 * Compare URL against relative URL
 */
function url_compare( $url, $rel ) {
	$url = trailingslashit( $url );
	$rel = trailingslashit( $rel );
	if ( ( strcasecmp( $url, $rel ) === 0 ) || root_relative_url( $url ) == $rel ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if element is empty
 */
function is_element_empty( $element ) {
	$element = trim( $element );

	return ! empty( $element );
}

/**
 * Format uri for friendliness
 */
function format_uri( $string, $separator = '-' )
{
	$accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
	$special_cases = array( '&' => 'og');
	$string = mb_strtolower( trim( $string ), 'UTF-8' );
	$string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
	$string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
	$string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
	$string = preg_replace("/[$separator]+/u", "$separator", $string);
	return $string;
}
