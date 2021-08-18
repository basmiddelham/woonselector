<?php
// Register Custom Post Type
function cpt_homes() {

	$labels = array(
		'name'                  => _x( 'Homes', 'Post Type General Name', 'strt' ),
		'singular_name'         => _x( 'Home', 'Post Type Singular Name', 'strt' ),
		'menu_name'             => __( 'Homes', 'strt' ),
		'name_admin_bar'        => __( 'Home', 'strt' ),
		'archives'              => __( 'Item Archives', 'strt' ),
		'attributes'            => __( 'Item Attributes', 'strt' ),
		'parent_item_colon'     => __( 'Parent Item:', 'strt' ),
		'all_items'             => __( 'All Items', 'strt' ),
		'add_new_item'          => __( 'Add New Item', 'strt' ),
		'add_new'               => __( 'Add New', 'strt' ),
		'new_item'              => __( 'New Item', 'strt' ),
		'edit_item'             => __( 'Edit Item', 'strt' ),
		'update_item'           => __( 'Update Item', 'strt' ),
		'view_item'             => __( 'View Item', 'strt' ),
		'view_items'            => __( 'View Items', 'strt' ),
		'search_items'          => __( 'Search Item', 'strt' ),
		'not_found'             => __( 'Not found', 'strt' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'strt' ),
		'featured_image'        => __( 'Featured Image', 'strt' ),
		'set_featured_image'    => __( 'Set featured image', 'strt' ),
		'remove_featured_image' => __( 'Remove featured image', 'strt' ),
		'use_featured_image'    => __( 'Use as featured image', 'strt' ),
		'insert_into_item'      => __( 'Insert into item', 'strt' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'strt' ),
		'items_list'            => __( 'Items list', 'strt' ),
		'items_list_navigation' => __( 'Items list navigation', 'strt' ),
		'filter_items_list'     => __( 'Filter items list', 'strt' ),
	);
	$args = array(
		'label'                 => __( 'Home', 'strt' ),
		'description'           => __( 'A Post Type for Homes', 'strt' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'home_type', 'home_building'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'homes', $args );

}
add_action( 'init', 'cpt_homes', 0 );

// Register Custom Taxonomy
function tax_home_type() {

	$labels = array(
		'name'                       => _x( 'Home Types', 'Taxonomy General Name', 'strt' ),
		'singular_name'              => _x( 'Home Type', 'Taxonomy Singular Name', 'strt' ),
		'menu_name'                  => __( 'Home Type', 'strt' ),
		'all_items'                  => __( 'All Items', 'strt' ),
		'parent_item'                => __( 'Parent Item', 'strt' ),
		'parent_item_colon'          => __( 'Parent Item:', 'strt' ),
		'new_item_name'              => __( 'New Item Name', 'strt' ),
		'add_new_item'               => __( 'Add New Item', 'strt' ),
		'edit_item'                  => __( 'Edit Item', 'strt' ),
		'update_item'                => __( 'Update Item', 'strt' ),
		'view_item'                  => __( 'View Item', 'strt' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'strt' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'strt' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'strt' ),
		'popular_items'              => __( 'Popular Items', 'strt' ),
		'search_items'               => __( 'Search Items', 'strt' ),
		'not_found'                  => __( 'Not Found', 'strt' ),
		'no_terms'                   => __( 'No items', 'strt' ),
		'items_list'                 => __( 'Items list', 'strt' ),
		'items_list_navigation'      => __( 'Items list navigation', 'strt' ),
	);
	$rewrite = array(
		'slug'                       => 'type',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'home_type', array( 'homes' ), $args );

}
add_action( 'init', 'tax_home_type', 0 );

// Register Custom Taxonomy
function tax_home_building() {

	$labels = array(
		'name'                       => _x( 'Home Building', 'Taxonomy General Name', 'strt' ),
		'singular_name'              => _x( 'Home Building', 'Taxonomy Singular Name', 'strt' ),
		'menu_name'                  => __( 'Home Building', 'strt' ),
		'all_items'                  => __( 'All Items', 'strt' ),
		'parent_item'                => __( 'Parent Item', 'strt' ),
		'parent_item_colon'          => __( 'Parent Item:', 'strt' ),
		'new_item_name'              => __( 'New Item Name', 'strt' ),
		'add_new_item'               => __( 'Add New Item', 'strt' ),
		'edit_item'                  => __( 'Edit Item', 'strt' ),
		'update_item'                => __( 'Update Item', 'strt' ),
		'view_item'                  => __( 'View Item', 'strt' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'strt' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'strt' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'strt' ),
		'popular_items'              => __( 'Popular Items', 'strt' ),
		'search_items'               => __( 'Search Items', 'strt' ),
		'not_found'                  => __( 'Not Found', 'strt' ),
		'no_terms'                   => __( 'No items', 'strt' ),
		'items_list'                 => __( 'Items list', 'strt' ),
		'items_list_navigation'      => __( 'Items list navigation', 'strt' ),
	);
	$rewrite = array(
		'slug'                       => 'building',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'home_building', array( 'homes' ), $args );

}
add_action( 'init', 'tax_home_building', 0 );
