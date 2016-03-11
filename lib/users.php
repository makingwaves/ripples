<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 11.03.2016
 * Time: 14.35
 */

namespace MW\Ripples\Users;

class Ripples_User_Caps {

	// Add our filters
	function __construct(){
		add_filter( 'editable_roles', array($this, 'editable_roles'));
		add_filter( 'map_meta_cap', array($this, 'map_meta_cap'),10,4);
		add_action( 'admin_menu', array($this, 'adjust_the_wp_menu'), 999 );

		$this->adjustMenu();
	}

	protected function adjustMenu() {
		//adjust the menu for the editor role

		$roleObject = get_role( 'editor' );
		if ( ! $roleObject->has_cap( 'edit_theme_options' ) ) {
			$roleObject->add_cap( 'edit_theme_options' );

			$roleObject->add_cap( 'create_users' );
			$roleObject->add_cap( 'list_users' );
			$roleObject->add_cap( 'edit_users' );
			$roleObject->add_cap( 'edit_user' );
			$roleObject->add_cap( 'delete_users' );
			$roleObject->add_cap( 'delete_user' );
			$roleObject->add_cap( 'remove_users' );
			$roleObject->add_cap( 'remove_user' );
		}
	}

	public function adjust_the_wp_menu() {
		$currentUser = wp_get_current_user();
		if ( ! empty( $currentUser ) && $currentUser->roles[0] === 'editor' ) {
			remove_menu_page( 'tools.php' );
			remove_menu_page( 'themes.php' );
			add_menu_page( 'Menu', 'Menu', 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 26 );
		}
	}

	// Remove 'Administrator' from the list of roles if the current user is not an admin
	function editable_roles( $roles ){
		if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
			unset( $roles['administrator']);
		}
		return $roles;
	}

	// If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
	function map_meta_cap( $caps, $cap, $user_id, $args ){
		switch( $cap ){
			case 'edit_user':
			case 'remove_user':
			case 'promote_user':
				if( isset($args[0]) && $args[0] == $user_id )
					break;
				elseif( !isset($args[0]) )
					$caps[] = 'do_not_allow';
				$other = new \WP_User( absint($args[0]) );
				if( $other->has_cap( 'administrator' ) ){
					if(!current_user_can('administrator')){
						$caps[] = 'do_not_allow';
					}
				}
				break;
			case 'delete_user':
			case 'delete_users':
				if( !isset($args[0]) )
					break;
				$other = new \WP_User( absint($args[0]) );
				if( $other->has_cap( 'administrator' ) ){
					if(!current_user_can('administrator')){
						$caps[] = 'do_not_allow';
					}
				}
				break;
			default:
				break;
		}
		return $caps;
	}

}

$currentUser = wp_get_current_user();
if ( is_admin() && ! empty( $currentUser ) && $currentUser->roles[0] === 'editor' ) {
	new Ripples_User_Caps();
}
