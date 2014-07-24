<?php
/** Templates for pr_events
**  DO NOT UPDATE THIS FILE WHEN UPDATING PR EVENT SET...
*/

function default_thumbnail($url)
{
	if($url == 'url' ){
		return "holder.js/300x300";
	} else {
		return "<img data-src='holder.js/300x300' />";
	}
}


function pr_event_list_item($curpost, $class)
{
	$ID = $curpost->ID;
	$startdate = get_post_meta($ID, 'pr_event_startdate', true);
	$enddate = get_post_meta($ID, 'pr_event_startdate', true);
	if( has_post_thumbnail($ID ) ) {
		//$thumbnail_url = get_the_post_thumbnail( $ID, "eventslist" );
		$thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id($ID), 'large_thumb');
	} else {
		$thumbnail_url  = default_thumbnail('');
		//$thumbnail_url  = default_thumbnail('url');
	}
	
	?>
		<article class="<?php echo $class; ?>">
			<a href="<?php echo esc_attr( get_post_permalink($ID) ); ?>" title="<?php echo esc_attr( get_the_title($ID) ); ?>">
				<div class="featured-img text-hide" style="background-image: url(<?php echo $thumbnail_url[0]; ?>);"><?php echo esc_attr( get_the_title($ID) ); ?></div>
				<div class="content">
					<time><?php echo date("j.n.Y", $startdate);?></time>
					<h3 class="text-overflow"><?php echo get_the_title($ID); ?></h3>
					<?php /*<p><?php echo $curpost->post_excerpt; ?></p> */ ?>
				</div>
			</a>
		</article>
	<?php
}