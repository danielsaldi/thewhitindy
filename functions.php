<?php

add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );
function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}

add_action( 'admin_menu', 'remove_admin_menus' );

//Remove top level admin menus
function remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'link-manager.php' );
    remove_menu_page( 'tools.php' );
    //remove_menu_page( 'plugins.php' );
    remove_menu_page( 'users.php' );
    remove_menu_page( 'edit.php' );
    //remove_menu_page( 'themes.php' );
}

function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'floorplan';
     
    return $post_types;
}
add_filter('show_admin_bar', '__return_false');

add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );


// Add Shortcode
function get_bedrooms() {
	$bedrooms = get_field('bedrooms');
	if($bedrooms) {
	echo $bedrooms;
	}
}
add_shortcode( 'get-bedrooms', 'get_bedrooms' );

function get_bathrooms() {
	$bathrooms = get_field('bathrooms');
	if($bathrooms) {
	echo $bathrooms;
	}
}
add_shortcode( 'get-bathrooms', 'get_bathrooms' );

function get_square_feet() {
	$square_feet = get_field('square_feet');
	if($square_feet) {
	echo $square_feet;
	}
}
add_shortcode( 'get-square-feet', 'get_square_feet' );

function get_price() {
	$price = get_field('price');
	if($price) {
	echo $price;
	}
}
add_shortcode( 'get-price', 'get_price' );

function get_floor_plan() {
	$floor_plan = get_field('floor_plan');
	if($floor_plan) {
	echo $floor_plan;
	}
}
add_shortcode( 'get-floor-plan', 'get_floor_plan' );

add_action('init', 'floorplans_register');

function floorplans_register() {

	$labels = array(
		'name' => _x('Floorplans', 'post type general name'),
		'singular_name' => _x('Floorplan', 'post type singular name'),
		'add_new' => _x('Add New', 'Floorplan'),
		'add_new_item' => __('Add New Floorplan'),
		'edit_item' => __('Edit Floorplan'),
		'new_item' => __('New Floorplan'),
		'view_item' => __('View Floorplan'),
		'search_items' => __('Search Floorplans'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-building',
		'capability_type' => 'post',
		'menu_position' => null,
		'show_in_rest' => true,
		'rewrite' => array(
			'slug'       => 'floorplan',
		),
		'has_archive' => false,
		'supports' => array('page-attributes','title','editor','thumbnail','excerpt', 'author')
		);
	register_post_type( 'floorplans' , $args );

	add_action('init', 'demo_add_default_boxes');
}

