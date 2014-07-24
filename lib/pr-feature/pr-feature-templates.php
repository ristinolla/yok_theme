<?php
/**
* pr-nosto templates
* 
* @package perttu
*/
/**

*/


function pr_feature_item($curpost)
{
	$ID = $curpost->ID;
	$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id( $ID), 'round')[0];

	//if(!$imgurl) $imgurl = pr_fallback_img('url'); //todo

	printf('<a href="%1$s" title="%2$s">
		<div class="text-hide featured-img img-circle animated-element" data-effect="fadeIn" data-trigger="700" style="background-image: url(%3$s);">%2$s</div><h3>%2$s</h3><p>%4$s</p></a>',
		get_post_meta( $ID, 'pr_feature_link', true ),
		get_the_title($ID),
		$imgurl,
		$curpost->post_excerpt
	);
	/*
	wp_get_attachment_image_src( get_post_thumbnail_id( $ID), 'medium')[0]
	An array containing:
	[0] => url
	[1] => width
	[2] => height
	[3] => boolean: true if $url is a resized image, false if it is the original.
	*/
}

function pr_feature_img_link($curpost)
{
	$ID = $curpost->ID;
	$img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $ID), 'round');
	$imgurl = $img_array[0];
	$width = $img_array[1];
	$height = $img_array[2];
	$optimal_h = 60;

	if($height > $optimal_h ){
		$relation =  $width / $height;
		$width = $relation * $optimal_h ;
		$height = $optimal_h ;

	}
	//if(!$imgurl) $imgurl = pr_fallback_img('url'); //todo

	printf('<a href="%1$s" title="%2$s" class="text-hide featured-img animated-element" data-effect="bigEntrance" data-trigger="400" style="background-image: url(%3$s); width: %4$dpx; height: %5$dpx;">%2$s</a>',
		get_post_meta( $ID, 'pr_feature_link', true ),
		get_the_title($ID),
		$imgurl,
		$width,
		$height
	);
	/*
	wp_get_attachment_image_src( get_post_thumbnail_id( $ID), 'medium')[0]
	An array containing:
	[0] => url
	[1] => width
	[2] => height
	[3] => boolean: true if $url is a resized image, false if it is the original.
	*/
}
