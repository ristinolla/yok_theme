<?php
/*
** Meta boxes for events
*/

function pr_event_meta_add()
{
	add_meta_box( 'event-box', 'Event Info', 'pr_event_meta_cb', 'pr_event', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'pr_event_meta_add' );

function pr_event_meta_cb( $post )
{
	$values = get_post_custom( $post->ID );
	$venue = isset( $values['pr_event_venue'] ) ? esc_attr( $values['pr_event_venue'][0] ) : '';
	$gmapslink = isset( $values['pr_event_gmapslink'] ) ? esc_attr( $values['pr_event_gmapslink'][0] ) : '';
	$price = isset( $values['pr_event_price'] ) ? esc_attr( $values['pr_event_price'][0] ) : '';
	$prereq = isset( $values['pr_event_prereq'] ) ? esc_attr( $values['pr_event_prereq'][0] ) : '';
	$equipment = isset( $values['pr_event_equipment'] ) ? esc_attr( $values['pr_event_equipment'][0] ) : '';
	$teacher = isset( $values['pr_event_teacher'] ) ? esc_attr( $values['pr_event_teacher'][0] ) : '';
	$groupsize = isset( $values['pr_event_groupsize'] ) ? esc_attr( $values['pr_event_groupsize'][0] ) : '';
	$apply = isset( $values['pr_event_apply'] ) ? esc_attr( $values['pr_event_apply'][0] ) : '';
	

	// START AND END TIME
	$today = strtotime('today');
	$pr_event_startdate = isset( $values['pr_event_startdate'] ) ? esc_attr( $values['pr_event_startdate'][0] ) : $today;
	$clean_sd = date("d.m.Y", $pr_event_startdate);
	$pr_event_starttime = isset( $values['pr_event_starttime'] ) ? esc_attr( $values['pr_event_starttime'][0] ) : $today;
	$clean_st = date("H:i", $pr_event_starttime);
	
	$pr_event_enddate = isset( $values['pr_event_enddate'] ) ? esc_attr( $values['pr_event_enddate'][0] ) : $today;
	$clean_ed = date("d.m.Y", $pr_event_enddate);
	$pr_event_endtime = isset( $values['pr_event_endtime'] ) ? esc_attr( $values['pr_event_endtime'][0] ) : $today;
	$clean_et = date("H:i", $pr_event_endtime);
	
	/* $selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
	$featured = isset( $values['pr_event_featured'] ) ? esc_attr( $values['pr_event_featured'][0] ) : ''; */
	wp_nonce_field( 'pr_event_box', 'pr_event_box_nonce' );

		echo "<h2>" . __("Just fill the ones needed.", "edgeone") . "</h2>";
		$date_format = '<p><label for="%1$s">%2$s</label><input type="text" name="%1$s" id="%1$s" value="%3$s" /></p>';

		printf($date_format,
			"pr_event_startdate",
			__('Start date (dd.mm.yyyy)', 'edgeone'),
			$clean_sd);

		printf($date_format,
			"pr_event_starttime",
			__('Start time (hh:mm)','edgeone'),
			$clean_st);

		printf($date_format,
			"pr_event_enddate",
			__('End date (dd.mm.yyyy)', 'edgeone'),
			$clean_ed);

		printf($date_format,
			"pr_event_endtime",
			__('End time (hh:mm)', 'edgeone'),
			$clean_et);

		echo "<h4>" . __("Kurssille", "edgeone") . "</h4>";
		$normal_format = '<p><label for="%1$s">%2$s</label><input type="text" name="%1$s" id="%1$s" value="%3$s" /></p>';
		
		printf($normal_format,
			"pr_event_venue",
			__('Venue', 'edgeone'),
			$venue);

		printf($normal_format,
			"pr_event_gmapslink",
			__('Google Maps Link', 'edgeone'),
			$gmapslink);

		printf($normal_format,
			"pr_event_price",
			__('Price', 'edgeone'),
			$price);

		printf($normal_format,
			"pr_event_prereq",
			__('Prerequirities', 'edgeone'),
			$prereq);

		printf($normal_format,
			"pr_event_equipment",
			__('Equipment','edgeone'),
			$equipment);

		printf($normal_format,
			"pr_event_groupsize",
			__('Group size', 'edgeone'),
			$groupsize);

		printf($normal_format,
			"pr_event_teacher",
			__('Teacher', 'edgeone'),
			$teacher);
		
		printf($normal_format,
			"pr_event_apply",
			__('Apply information', 'edgeone'),
			$apply);

}




/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 * @package edgeone
 */


function pr_event_box_save( $post_id )
{
	
	// Check if our nonce is set.
	if ( ! isset( $_POST['pr_event_box_nonce'] ) )
		return $post_id;

	$nonce = $_POST['pr_event_box_nonce'];

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $nonce, 'pr_event_box' ) )
		return $post_id;
	
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;

	// Check the user's permissions.
	if ( 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}
	
	// Allowed data for wp_kses
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array(), // and those anchords can only have href attribute
			'title' => array(),
			'target' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array()
	);
	
	// Probably a good idea to make sure your data is set
		
	if( isset( $_POST['pr_event_venue'] ) )
		update_post_meta( $post_id, 'pr_event_venue', wp_kses( $_POST['pr_event_venue'], $allowed ) );
		
	if( isset( $_POST['pr_event_gmapslink'] ) )
		update_post_meta( $post_id, 'pr_event_gmapslink', wp_kses( $_POST['pr_event_gmapslink'], $allowed ) );
		
	if( isset( $_POST['pr_event_price'] ) )
		update_post_meta( $post_id, 'pr_event_price', wp_kses( $_POST['pr_event_price'], $allowed ) );
		
	if( isset( $_POST['pr_event_prereq'] ) )
		update_post_meta( $post_id, 'pr_event_prereq', wp_kses( $_POST['pr_event_prereq'], $allowed ) );
		
	if( isset( $_POST['pr_event_equipment'] ) )
		update_post_meta( $post_id, 'pr_event_equipment', wp_kses( $_POST['pr_event_equipment'], $allowed ) );
	
	if( isset( $_POST['pr_event_teacher'] ) )
		update_post_meta( $post_id, 'pr_event_teacher', wp_kses( $_POST['pr_event_teacher'], $allowed ) );

	if( isset( $_POST['pr_event_groupsize'] ) )
		update_post_meta( $post_id, 'pr_event_groupsize', wp_kses( $_POST['pr_event_groupsize'], $allowed ) );
		
	if( isset( $_POST['pr_event_apply'] ) )
		update_post_meta( $post_id, 'pr_event_apply', wp_kses( $_POST['pr_event_apply'], $allowed ) );
		
	// Start and end stuff
	if( isset( $_POST['pr_event_startdate'] ) )
		update_post_meta( $post_id, 'pr_event_startdate', wp_kses( strtotime($_POST['pr_event_startdate']), $allowed ) );
	
	if( isset( $_POST['pr_event_starttime'] ) )
		update_post_meta( $post_id, 'pr_event_starttime', wp_kses( strtotime($_POST['pr_event_starttime']), $allowed ) );
		
	if( isset( $_POST['pr_event_enddate'] ) )
		update_post_meta( $post_id, 'pr_event_enddate', wp_kses( strtotime($_POST['pr_event_enddate']), $allowed ) );
	
	if( isset( $_POST['pr_event_endtime'] ) )
		update_post_meta( $post_id, 'pr_event_endtime', wp_kses( strtotime($_POST['pr_event_endtime']), $allowed ) );
	
}

add_action( 'save_post', 'pr_event_box_save' );