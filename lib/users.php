<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 11.03.2016
 * Time: 14.35
 */

namespace MW\Ripples\Users;

class Ripples_Editor_Role {

	protected static $ALLOWED_CAPS = [
						"edit_theme_options", //mwfix: only for menu, disable other caps
						"create_users",
						"list_users",
						"edit_users",
						"edit_user",
						"delete_users",
						"delete_user",
						"remove_users",
						"remove_user"];

	// Add our filters
	function __construct(){
		add_filter( 'editable_roles', array($this, 'editable_roles') );
		add_filter( 'map_meta_cap', array($this, 'map_meta_cap'), 10, 4 );
		add_filter( 'user_has_cap', array( $this, 'set_user_caps_from_php' ), 10, 2 );
		add_filter( 'admin_init', array( $this, 'access_wp_menu' ) );
	}

	public function access_wp_menu() {
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'themes.php' );
		add_menu_page( 'Menu', 'Menu', 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 26 );
	}

	// Remove 'Administrator' from the list of roles if the current user is not an admin
	function editable_roles( $roles ){
		if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
			unset( $roles['administrator']);
		}
		return $roles;
	}

	function set_user_caps_from_php($caps, $cap) {
		if ( ! empty( $cap ) ) {
			if(in_array($cap[0], self::$ALLOWED_CAPS)) {
				$caps[ $cap[0] ] = true;
			}
		}
		return $caps;
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

if ( is_admin() && current_user_can('editor')) {
	new Ripples_Editor_Role();
}
