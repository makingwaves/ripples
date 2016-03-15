<?php
namespace MW\Ripples\Acf;

add_filter( 'acf/settings/save_json', __NAMESPACE__ . '\\my_acf_json_save_point' );
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\\my_acf_json_load_point' );
add_filter( 'acf/settings/l10n_textdomain', function() {
	return 'ripples';
} );

// Include settings.php (exported fields)
if ( ! defined( 'MW_ACF_SETTINGS_FILEPATH' ) ) {
	define( 'MW_ACF_SETTINGS_FILEPATH', get_template_directory() . '/includes/acf/settings.php' );
}

// We can haz imported fields?
if ( file_exists( MW_ACF_SETTINGS_FILEPATH ) ) {
	// Applies to all sites in production and staging (not local dev)
	if ( WP_ENV !== 'development' ) {
		require_once MW_ACF_SETTINGS_FILEPATH;
		// Hides ACF, see http://www.advancedcustomfields.com/resources/how-to-hide-acf-menu-from-clients/
		add_filter( 'acf/settings/show_admin', '__return_false' );
	} else {
		add_filter('acf/settings/show_admin', function() {
			return current_user_can('manage_options');
		});
	}
}

function my_acf_json_save_point( $path ) {

	// update path
	$path = get_stylesheet_directory() . '/includes/acf/settings';

	// return
	return $path;

}

function my_acf_json_load_point( $paths ) {

	// remove original path (optional)
	unset( $paths[0] );

	// append path
	$paths[] = get_stylesheet_directory() . '/includes/acf/settings';

	// return
	return $paths;

}

//option page : http://www.advancedcustomfields.com/resources/options-page/
/*if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> __('Theme General Settings', 'ripples'),
		'menu_title'	=> __('Theme Settings', 'ripples'),
		'menu_slug' 	=> __('theme-general-settings', 'ripples'),
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}*/

function acf_set_featured_image( $value, $post_id, $field ) {
	delete_post_thumbnail( $post_id );
	if ( $value != '' ) {
		//Add the value which is the image ID to the _thumbnail_id meta data for the current post
		add_post_meta( $post_id, '_thumbnail_id', $value );
	}

	return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
//add_filter( 'acf/update_value/name=post_thumbnail', __NAMESPACE__ . '\\acf_set_featured_image', 10, 3 );