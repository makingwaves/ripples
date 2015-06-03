<?php
namespace MW\Ripples\Acf;

add_filter( 'acf/settings/save_json', __NAMESPACE__ . '\\my_acf_json_save_point' );

function my_acf_json_save_point( $path ) {

	// update path
	$path = get_stylesheet_directory() . '/includes/acf/settings';

	// return
	return $path;

}

add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\\my_acf_json_load_point' );

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