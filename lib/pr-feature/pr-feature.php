<?php
/**
* pr-nosto post-type
*
* @package edgeone
*/
/**

*/
function create_pr_feature() {
	$labels = array(
		'name'               => __('Features', 'edgeone'),
		'singular_name'      => __('Feature', 'edgeone'),
		'add_new'            => __('Add Feature','edgeone'),
		'add_new_item'       => __('Add New Feature','edgeone'),
		'edit_item'          => __('Edit Feature','edgeone'),
		'new_item'           => __('New Feature','edgeone'),
		'all_items'          => __('All Features', 'edgeone'),
		'view_item'          => __('View Feature', 'edgeone'),
		'search_items'       => __('Search Features', 'edgeone'),
		'not_found'          => __('No Features found', 'edgeone'),
		'not_found_in_trash' => __('No Features found in Trash', 'edgeone'),
		'parent_item_colon'  => __('parent item colon', 'edgeone'),
		'menu_name'          => __('Features', 'edgeone')
	);

	$args = array(
		'labels'             => $labels,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon'			 => "dashicons-screenoptions",
		'rewrite'            => array( 'slug' => __('features', "edgeone" ) ),
		'capability_type'    => 'page',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 10,
		'supports'           => array( 'title', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'pr_feature', $args );
}
add_action( 'init', 'create_pr_feature' );

// add meta boxes
require ('pr-feature-meta.php');
require ('pr-feature-templates.php');

add_action( 'init', 'pr_feature_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts
/**

*/
function pr_feature_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x('Location', 'taxonomy general name', 'edgeone' ),
    'singular_name' => _x( 'Location', 'taxonomy singular name','edgeone' ),
    'search_items' =>  __( 'Search Locations','edgeone' ),
    'all_items' => __( 'All Locations','edgeone' ),
    'parent_item' => __( 'Parent Location','edgeone' ),
    'parent_item_colon' => __( 'Parent Location:','edgeone' ),
    'edit_item' => __( 'Edit Location','edgeone' ),
    'update_item' => __( 'Update Location','edgeone' ),
    'add_new_item' => __( 'Add New Location','edgeone' ),
    'new_item_name' => __( 'New Location Name','edgeone' ),
    'menu_name' => __( 'Locations','edgeone' ),
  );

  register_taxonomy('location',array('pr_feature'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_tagcloud' => false,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'locations' ),
    'capability_type' => 'page',

    'show_in_nav_menus' => false

  ));

}

/**

* Add columns to admin panel
* http://wordpress.org/support/topic/admin-column-sorting
*/

function add_pr_feature_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Title', 'column name', 'edgeone');
    $new_columns['location'] = __('Location', 'edgeone');
    $new_columns['pr_order'] = __('Order', 'edgeone');
    return $new_columns;
}

add_filter('manage_edit-pr_feature_columns', 'add_pr_feature_columns');


function manage_pr_feature_columns($column_name, $post_id) {
    switch ($column_name) {
	 	case 'location':
	 		$terms = wp_get_post_terms( $post_id, 'location' );
	 		if(empty($terms)){
	 			_e('No locations assigned', 'edgeone');
	 		} else {
	 			foreach ($terms as &$term) {
	 				echo $term->name . '<br>';
	 			}
	 		}
	 		break;
	    case 'pr_order':
	    	$order = get_post_meta( $post_id, 'pr_feature_order', true );
	    	if(! empty($order)){
	    		echo $order;
	    	} else {
	    		_e('Order not set', 'edgeone');
	    	}
	        break;
	    default:
	        break;
    }
}
add_action('manage_pr_feature_posts_custom_column', 'manage_pr_feature_columns', 10, 2);


/**

* Function for displaying featurettes
*
*/

function pr_features_show($args)
{

	$defaults = array(
		'length' => 4,
		'order' => 'ASC',
		'before_item' => null,
 		'after_item' => null,
 		'before_list' => null,
 		'after_before' => null,
 		'no_posts' => "<h2>No Posts</h2>",
 		'location' => null,
 		'type' => 'link',

	);

	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	wp_reset_postdata();

	// set the taxonomy query that

	$tax_query = array(
		array(
		'taxonomy' => 'location',
		'field' => 'slug',
		'terms' => $location,
		 'operator' => "AND"
		)
	);

	$queryargs = array(
		'post_type' => 'pr_feature',
		'post_count' => $length,
		'meta_key' => 'pr_feature_order',
		'orderby' => 'meta_value',
		'order' => $order,
		'tax_query' => $tax_query
	);

	//var_dump($queryargs);
	$the_query = new WP_Query( $queryargs );


	if ( $the_query  -> have_posts() ){

		if( isset( $before_list ) ) echo $before_list;
		while ( $the_query  -> have_posts() ) :
			$the_query  -> next_post();
			$curpost = $the_query  -> post;

			if( isset( $before_item ) ) echo $before_item;

			switch ($type) {
					case 'cards':
						pr_feature_item($curpost);
						break;

					case 'link':
						pr_feature_img_link($curpost);
						break;

					default:
						echo "give type!!";
						break;
				}

			if( isset( $after_item ) ) echo $after_item;

		endwhile;

		if( isset( $after_list ) ) echo $after_list;

	} // havepost if
	else {
		echo $no_posts;
	} //havepost else

	wp_reset_postdata();
}


