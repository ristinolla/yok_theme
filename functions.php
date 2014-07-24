<?php
/**
 * edgeone functions and definitions
 *
 * @package edgeone
 */

define('GOOGLE_ANALYTICS_ID', '');


/**

 * Set the content width based on the theme's design and stylesheet.
 */
/*
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}
*/

/**

 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/lib/init.php';       // customizer additions
require get_template_directory() . '/lib/scripts.php';       // customizer additions

require get_template_directory() . '/lib/template-tags.php';    // template tags ?? what does these do?
require get_template_directory() . '/lib/extras.php';           // extras
require get_template_directory() . '/lib/customizer.php';       // customizer additions

require get_template_directory() . '/lib/jetpack.php';          // jetpack file

// Register Custom Navigation Walker
require_once(get_template_directory() . '/vendor/wp_bootstrap_navwalker/wp_bootstrap_navwalker.php');  // navition

require get_template_directory() . '/lib/pr-events/pr-events.php';    // enable events post type
require get_template_directory() . '/lib/pr-feature/pr-feature.php';  // enable feature post type
//require get_template_directory() . '/lib/post-type-gallery.php';    // enable gallery post type

require get_template_directory() . '/lib/edgeone_shortcodes.php';     // enable shortcodes




require get_template_directory() . '/lib/edgeone_functions.php';      // keep this last




?>
