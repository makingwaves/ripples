<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 11.03.2016
 * Time: 14.35
 */

namespace MW\Ripples\Users;

//adjust the menu for the editor role
add_action( 'admin_menu', __NAMESPACE__ . '\\adjust_the_wp_menu', 999 );

$roleObject = get_role( 'editor' );
if (!$roleObject->has_cap( 'edit_theme_options' ) ) {
	$roleObject->add_cap( 'edit_theme_options' );
}

function adjust_the_wp_menu() {
	$currentUser = wp_get_current_user();
	if(!empty($currentUser) && $currentUser->roles[0] === 'editor') {
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'themes.php' );
		add_menu_page( 'Menu', 'Menu', 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 26 );
	}
}
