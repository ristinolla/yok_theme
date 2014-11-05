<?php
/**
* 	Custom post type.
*
*		Include files:
*  			archive-___.php
*			single-___.php
*   		index-___.php
*
* 		If post-formats turned on then check content-types.
*	@package edgeone
**/
function create_pr_event() {
	$labels = array(
		'name'              	=>	__('Events', 'edgeone'),
		'singular_name'     	=>	__('Event', 'edgeone'),
		'add_new'           	=>	__('Add Event','edgeone'),
		'add_new_item'      	=>	__('Add New Event','edgeone'),
		'edit_item'         	=>	__('Edit Event','edgeone'),
		'new_item'          	=>	__('New Event','edgeone'),
		'all_items'         	=>	__('All Events', 'edgeone'),
		'view_item'         	=>	__('View Event', 'edgeone'),
		'search_items'      	=>	__('Search Events', 'edgeone'),
		'not_found'         	=>	__('No Events found', 'edgeone'),
		'not_found_in_trash'	=>	__('No Events found in Trash', 'edgeone'),
		'parent_item_colon' 	=>	__('parent item colon', 'edgeone'),
		'menu_name'         	=>	__('Events', 'edgeone')
	);

	$args = array(
		'labels'            =>	$labels,
		'public' 			=>	true,
		'show_ui'           =>	true,
		'show_in_menu'      =>	true,
		'query_var'         =>	true,
		'menu_icon'			=>	'dashicons-calendar',
		'rewrite'           =>	array( 'slug' => 'events' ),
		'capability_type'   =>	'post',
		'has_archive'       =>	true,
		'hierarchical'      =>	true,
		'menu_position'     =>	5,
		'supports'          =>	array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'pr_event', $args );
}
add_action( 'init', 'create_pr_event' );

/*
// Show posts of 'post', 'page' and 'movie' post types on home page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'page', 'movies' ) );
	return $query;
}
*/

///****** COURSE META BOX
require ('pr-event-meta.php');
require ('pr-event-templates.php');

/**

 TAXONOMY CREATION

*/

add_action( 'init', 'pr_event_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts
/**

*/
function pr_event_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x('Category', 'taxonomy general name', 'edgeone' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name','edgeone' ),
    'search_items' =>  __( 'Search Categories','edgeone' ),
    'all_items' => __( 'All Categories','edgeone' ),
    'parent_item' => __( 'Parent Category','edgeone' ),
    'parent_item_colon' => __( 'Parent Category:','edgeone' ),
    'edit_item' => __( 'Edit Category','edgeone' ),
    'update_item' => __( 'Update Category','edgeone' ),
    'add_new_item' => __( 'Add New Category','edgeone' ),
    'new_item_name' => __( 'New Category Name','edgeone' ),
    'menu_name' => __( 'Categories','edgeone' ),
  );

  register_taxonomy('event_cat',array('pr_event'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_tagcloud' => false,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categories' ),
    'capability_type' => 'page',
    'show_in_nav_menus' => true

  ));

}

/**

	COLUMNS

* Add columns to admin panel
* http://wordpress.org/support/topic/admin-column-sorting
*/

function add_pr_event_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Title', 'column name', 'edgeone');
    $new_columns['event_cat'] = __('Category', 'edgeone');
    $new_columns['author'] = __('Author', 'edgeone');
    $new_columns['date'] = __('Order', 'edgeone');
    return $new_columns;
}

add_filter('manage_edit-pr_event_columns', 'add_pr_event_columns');


function manage_pr_event_columns($column_name, $post_id) {
    switch ($column_name) {
	 	case 'event_cat':
	 		$terms = wp_get_post_terms( $post_id, 'event_cat' );
	 		if(empty($terms)){
	 			_e('--', 'edgeone');
	 		} else {
	 			foreach ($terms as &$term) {
	 				echo $term->name . '<br>';
	 			}
	 		}
	 		break;
	    default:
	        break;
    }
}
add_action('manage_pr_event_posts_custom_column', 'manage_pr_event_columns', 10, 2);




/**
** EVENT LIST PRINTER

**
*	Takes in array with these stuff
* 		before_item
* 		after_item
* 		before_list
* 		after_before
*		'length' => 3,
*		'order' => 'ASC',
*		'item_class' => 'event-item'
**/

function pr_event_list($args)
{
	$defaults = array(
		'length' => 10,
		'order' => 'ASC',
		'item_class' => 'event-item',
		'before_item' => null,
 		'after_item' => null,
 		'before_list' => null,
 		'after_before' => null,
 		'offset' => 0,
 		'paged' => false,
 		'past' => false,
 		'posts_per_page' => 4,
 		'item_class_one' => "only-one event-item"
	);

	$today3am = strtotime('today 3:00') + ( get_option( 'gmt_offset' ) * 3600 );

	//echo date('c', $today3am);

	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	wp_reset_postdata();

	// Check if past events
	if($past){
		// These are past events so today shoud be bigger
		$ordervalue = 'ASC';
		$compare = '>=';
	} else {
		// These are current events today shoud be smaller
		$ordervalue = 'DESC';
		$compare = '<=';
	}

	$queryargs = array(
			'post_type' => 'pr_event',
			'meta_key' => 'pr_event_enddate',
			'orderby' => 'meta_value_num',
			'order' => $ordervalue,
			'offset' => $offset,
			'paged' => $paged,
			'posts_per_page' => $length,
			'meta_query' => array(
				array(
					'key' => 'pr_event_enddate',
					'value' => $today3am,
					'compare' => $compare,
				)
			)
		);
	$event_query = new WP_Query( $queryargs );

	//echo "<h1>" . $event_query->post_count. "</h1>";

	if ( $event_query->post_count == 1 ) {
		$item_class = $item_class_one;
	}

	if ( $event_query -> have_posts() ){

		if( isset( $before_list ) ) {
			echo $before_list;
		}

		while ( $event_query -> have_posts() ) :
			$event_query -> next_post();
			$curpost = $event_query -> post;


			// time check
			$today3am = strtotime('today 3:00') + ( get_option( 'gmt_offset' ) * 3600 );
			$today3am = strtotime('-1 day 3:00') + ( get_option( 'gmt_offset' ) * 3600 );
			$startdate = intval( get_post_meta($curpost->ID, 'pr_event_startdate', true) );
			$enddate = intval( get_post_meta($curpost->ID, 'pr_event_enddate', true) );
			$pass = false;


			//echo get_the_title($curpost->ID);
			//echo " Enddate: {$enddate} | Today: {$today3am} ";

			if( $past ){
				if($enddate <= $today3am) {
					$pass = true;
				}
			} else {
				if( $enddate >= $today3am) {
					$pass = true;
				}
			}

			if( $pass ){

				if( isset( $before_item ) ) {
					echo $before_item;
				}

				pr_event_list_item($curpost, $item_class);

				if( isset( $after_item ) ) {
					echo $after_item;
				}

			}
		endwhile;
		if( isset( $after_list ) ) {
			echo $after_list;
		}
	} else {
		echo '<h2 class="text-center">' . __('That\'s a shame, no events at all. We might be having a holiday, hope you too..', 'edgeone') . '</h2>';
	}
	wp_reset_postdata();
}

function pr_event_metalist($post)
{
	echo '<div class="short-list box">';

	setlocale(LC_TIME, get_locale() );

	$list_format = '<li><i class="fa-li fa %1$s fa-2x"></i> <span class="title">%2$s</span><br><span class="value">%3$s</span></li>';

	$startdate = get_post_meta($post->ID, 'pr_event_startdate', true);
	$starttime = get_post_meta($post->ID, 'pr_event_starttime', true);

	$enddate = get_post_meta($post->ID, 'pr_event_enddate', true);
	$endtime = get_post_meta($post->ID, 'pr_event_endtime', true);
	$luokat = "col-xs-6 col-sm-12 col-md-12 col-lg-6";
	$dateformat = 'nadasurf';
	$clockformat = __('from %2$s to %4$s', 'edgeone');
	if($startdate != '' && $startdate == $enddate ){
		$dateformat = '<div class="datetime-box"><date class="title" date="%1$s %2$s">%1$s</date><br><time class="value" time="%2$s to %4$s">' . $clockformat . '</time></div>';
	} else if ( $startdate != '' && $enddate != ''){
		$dateformat = '<div class="datetime-box row"><div class="'. $luokat .'"><date class="title" date="%1$s %2$s">%1$s</date><br><time class="value" time="%2$s">%2$s</time></div><div class="'. $luokat .'"><date class="title" date="%3$s %4$s">%3$s</date><br><time class="value" time="%4$s">%4$s</time></div></div>';
	}
	if($dateformat != ''){
		printf($dateformat,
			strftime("%a %d.%m.%G", $startdate),
			strftime("%H:%M", $starttime),
			strftime("%a %d.%m.%G"	, $enddate),
			strftime("%H:%M", $endtime)
			);
		}
	echo '<ul class="fa-ul">';
	//venue

	$venue = get_post_meta($post->ID, 'pr_event_venue', true);
	if( $venue != '')
		printf($list_format, 'fa-map-marker', __('Location', 'edgeone'), $venue);

	//price
	$price = get_post_meta($post->ID, 'pr_event_price', true);
	if( $price != '')
		printf($list_format, 'fa-eur', __('Price', 'edgeone'), $price);

	//prereq
	$prereq = get_post_meta($post->ID, 'pr_event_prereq', true);
	if( $prereq != '')
		printf($list_format, 'fa-puzzle-piece', __('Pre-requirements', 'edgeone'), $prereq);

	//equipment
	$equipment = get_post_meta($post->ID, 'pr_event_equipment', true);
	if( $equipment != '')
		printf($list_format, 'fa-camera-retro', __('Needed equipment', 'edgeone'), $equipment);

	//teacher
	$teacher = get_post_meta($post->ID, 'pr_event_teacher', true);
	if( $teacher != '')
		printf($list_format, 'fa-user', __('Teacher', 'edgeone'), $teacher);

	//groupsize
	$groupsize = get_post_meta($post->ID, 'pr_event_groupsize', true);
	if( $groupsize != '')
		printf($list_format, 'fa-users', __('Group size', 'edgeone'), $groupsize);

	//apply
	$apply = get_post_meta($post->ID, 'pr_event_apply', true);
	if( $apply != '')
		printf($list_format, 'fa-pencil-square-o', __('Apply information', 'edgeone'), $apply);


	$gmaps = get_post_meta($post->ID, 'pr_event_gmapslink', true);

	echo '</ul>';
	echo "</div>";
}
