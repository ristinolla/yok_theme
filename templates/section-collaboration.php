<?php
/**
 * The template part for displaying features element
 *
 * 
 *
 * @package edgeone
 */
?>

<?php 
$args = array(
	'before_item' => '<li class="collaboration-item">',
	'after_item' => '</li>',
	'location' => 'yhteistyo'
);

pr_features_show($args);


?>