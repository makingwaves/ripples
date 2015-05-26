<?php

namespace MW\Ripples\Config;

use MW\Ripples;

function is_localhost() {
	$whiteList = array( '127.0.0.1', '::1' );
	if( in_array( $_SERVER['REMOTE_ADDR'], $whiteList) )
		return true;
}

// Fallback if WP_ENV isn't defined in your WordPress config & debug mode when local development
// Used in lib/assets.php to check for 'development' or 'production'
if ( ! defined( 'WP_ENV' ) ) {
	if(is_localhost()) {
		define( 'WP_ENV', 'development' );
		if ( ! defined( 'WP_DEBUG' ) ) { define( 'WP_DEBUG', true ); }
	} else {
		define( 'WP_ENV', 'production' );
	}
}

/**
 * Define which pages shouldn't have the sidebar
 */
function display_sidebar() {
	static $display;

	if ( ! isset( $display ) ) {
		$conditionalCheck = new Ripples\ConditionalTagCheck(
		/**
		 * Note: Oppsite of Sage
		 * Any of these conditional tags that return true show the sidebar.
		 * You can also specify your own custom function as long as it returns a boolean.
		 *
		 * To use a function that accepts arguments, use an array instead of just the function name as a string.
		 *
		 * Examples:
		 *
		 * 'is_single'
		 * 'is_archive'
		 * ['is_page', 'about-me']
		 * ['is_tax', ['flavor', 'mild']]
		 * ['is_page_template', 'about.php']
		 * ['is_post_type_archive', ['foo', 'bar', 'baz']]
		 *
		 */
			[
//        'is_404',
//        'is_front_page',
//	    ['is_page', 'testside'],
//        ['is_page_template', 'templates/template-frontpage.php']
			]
		);

		$display = apply_filters( 'ripples/display_sidebar', ! $conditionalCheck->result );
	}

	return $display;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
//add_image_size( 'ripples-thumb-600', 552, 552, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 552 x 552 sized image,
we would use the function:
<?php the_post_thumbnail( 'ripples-thumb-552' ); ?>

*/

//add_filter( 'image_size_names_choose', __NAMESPACE__ . '\\ripples_custom_image_sizes' );

function ripples_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'ripples-thumb-552' => '552px ' . __( 'by', 'ripples' ) . ' 552px'
	) );
}


/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1128px is the default Ripples container width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1128;
}
