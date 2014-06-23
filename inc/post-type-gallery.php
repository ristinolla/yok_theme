<?php
/**
*
* 	Custom post type. 
*
*		Include files: 
*  			archive-___.php
*			single-___.php 
*   		index-___.php
*
* 		If post-formats turned on then check content-types.
*
**/

function create_pr_gallery() {
  $labels = array(
    'name'               => __('Galleries', 'edgeone'),
    'singular_name'      => __('Gallery', 'edgeone'),
    'add_new'            => __('Add Gallery','edgeone'),
    'add_new_item'       => __('Add New Gallery','edgeone'),
    'edit_item'          => __('Edit Gallery','edgeone'),
    'new_item'           => __('New Gallery','edgeone'),
    'all_items'          => __('All Galleries', 'edgeone'),
    'view_item'          => __('View Gallery', 'edgeone'),
    'search_items'       => __('Search Galleries', 'edgeone'),
    'not_found'          => __('No galleries found', 'edgeone'),
    'not_found_in_trash' => __('No galleries found in Trash', 'edgeone'),
    'menu_name'          => __('Galleries', 'edgeone')
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'menu_icon'          => 'dashicons-images-alt2',
    'rewrite'            => array( 'slug' => 'gallery' ),
    'capability_type'    => 'page',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'pr_gallery', $args );
}
add_action( 'init', 'create_pr_gallery' );

/** 
* Add columns to admin panel
* http://wordpress.org/support/topic/admin-column-sorting
*/

function add_pr_gallery_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
     
    $new_columns['id'] = __('ID');
    $new_columns['title'] = _x('Gallery Name', 'column name');
    $new_columns['images'] = __('Images');
    $new_columns['author'] = __('Author');
     
    $new_columns['categories'] = __('Categories');
    $new_columns['tags'] = __('Tags');
 
    /*$new_columns['date'] = _x('Date', 'column name');*/
 
    return $new_columns;
}

add_filter('manage_edit-pr_gallery_columns', 'add_pr_gallery_columns');


function manage_gallery_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
	    case 'id':
	        echo $id;
	            break;
	 
	    case 'images':
	        // Get number of images in gallery
	        echo "TBD";
	        //$num_images = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_parent = {$id};"));
	        //echo $num_images; 
	        break;
	    default:
	        break;
    }
} 
add_action('manage_pr_gallery_posts_custom_column', 'manage_gallery_columns', 10, 2);

/*
// Show posts of 'post', 'page' and 'movie' post types on home page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'page', 'movies' ) );
	return $query;
}
*/

?>