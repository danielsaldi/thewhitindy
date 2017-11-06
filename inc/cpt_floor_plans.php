<?php

add_action('init', 'floor_plans_register');
add_action( 'init', 'floor_plan_taxonomy');
add_shortcode( 'get-bedrooms', 'get_bedrooms' );
add_shortcode( 'get-bathrooms', 'get_bathrooms' );
add_shortcode( 'get-square-feet', 'get_square_feet' );
add_shortcode( 'get-price', 'get_price' );
add_shortcode( 'get-floor-plan', 'get_floor_plan' );

function floor_plans_register() {

	$labels = array(
		'name' => _x('Floor Plans', 'post type general name'),
		'singular_name' => _x('Floor Plan', 'post type singular name'),
		'add_new' => _x('Add New', 'Floor Plan'),
		'add_new_item' => __('Add New Floor Plan'),
		'edit_item' => __('Edit Floor Plan'),
		'new_item' => __('New Floor Plan'),
		'view_item' => __('View Floor Plan'),
		'search_items' => __('Search Floor Plans'),
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
			'slug'       => 'floor-plan',
		),
		'has_archive' => false,
		'supports' => array('page-attributes','title','editor','thumbnail','excerpt', 'author')
		);
	register_post_type( 'floor-plans' , $args );

	add_action('init', 'demo_add_default_boxes');
}

function floor_plan_taxonomy() {
    register_taxonomy(
        'unit_categories',
        'floor-plans',
        array(
            'labels' => array(
                'name' => 'Unit Categories',
                'add_new_item' => 'Add New Unit Category',
                'new_item_name' => "New Unit Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
