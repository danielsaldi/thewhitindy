<?php

require_once( get_stylesheet_directory() . '/inc/cpt_floor_plans.php' );

function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}
add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );

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
add_action( 'admin_menu', 'remove_admin_menus' );
add_filter('show_admin_bar', '__return_false');

function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'floor-plans';

    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );


function featured_img_in_divi($atts) {
    global $post;

    // Image to display
    $thumbnail = get_the_post_thumbnail($post->ID, 'full');
    
    // ID of featured image
    $thumbnail_id = get_post_thumbnail_id();

    // Link to attachment page
    $link = get_permalink();

    return '<div class="other-floorplans et-waypoint et_pb_animation_left">'
    . $thumbnail
    . '<div class="floorplan-overlay">'
    . '<a class="quick-view-btn" href="' . $link . '">Quick View</a>'
    . '</div>'
    . '</div>';
}
add_shortcode('featured_img', 'featured_img_in_divi');