<?php
/* =====================================================================
Create custom post type
====================================================================== */
$labels = array(
	'name'               => _x( 'Books', 'post type general name', 'ripples' ),
	'singular_name'      => _x( 'Book', 'post type singular name', 'ripples' ),
	'menu_name'          => _x( 'Books', 'admin menu', 'ripples' ),
	'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'ripples' ),
	'add_new'            => _x( 'Add New', 'book', 'ripples' ),
	'add_new_item'       => __( 'Add New Book', 'ripples' ),
	'new_item'           => __( 'New Book', 'ripples' ),
	'edit_item'          => __( 'Edit Book', 'ripples' ),
	'view_item'          => __( 'View Book', 'ripples' ),
	'all_items'          => __( 'All Books', 'ripples' ),
	'search_items'       => __( 'Search Books', 'ripples' ),
	'parent_item_colon'  => __( 'Parent Books:', 'ripples' ),
	'not_found'          => __( 'No books found.', 'ripples' ),
	'not_found_in_trash' => __( 'No books found in Trash.', 'ripples' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'book' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
);

register_post_type( 'book', $args );

function change_book_title( $title ){
     $screen = get_current_screen();
 
     if  ( 'book' == $screen->post_type ) {
          $title = __( 'Enter book name here', 'ripples' );
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'change_book_title' );