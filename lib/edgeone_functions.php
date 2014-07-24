<?php
/**
* Edgeone functions
* includes all custom functions, can use events etc.
* @package edgeone
*/

add_filter('show_admin_bar', '__return_false');
/**

* No content function, show maybe search bar or something?
*/
function edgeone_no_content(){
	echo "No content!";
}


function edgeone_device($type){
	require_once get_template_directory() . '/vendor/mobile_detect/Mobile_Detect.php';
	$detect = new Mobile_Detect;
	$return = array(
		'mobile' => $detect->isMobile(),
		'tablet' => $detect->isTablet()
	);


	switch ($type) {
		case 'mobile':
			return ($detect->isMobile()) ? true :false;
			break;
		case 'tablet':
			return ($detect->isTablet()) ? true :false;
			break;
		default:
			return "error";
			break;
	}
	return $return;
}


/**
 * SIDENAV

 * @package yokamerat
 */

function top_parent_sidenav($post){
		?>
		<nav class="side-nav" role="navigation">
				<?php

		if ($post->post_parent)	{
			$ancestors=get_post_ancestors($post->ID);
			$root = count($ancestors) - 1;
			$parent = $ancestors[$root];
		} else {
			$parent = $post->ID;
		}
		/*
		<h2 class="normal"><a href="<?php
			$ancestor = get_post_ancestors($parent->ID)[0];
			$title = get_post_field( 'post_title', $ancestor );
			echo get_permalink( $ancestor ); ?>" title ="<?php echo $title; ?>"><?php echo $title; ?></a></h2>
		*/

		$args = array(
			'title_li' 		=> '',
			"child_of" 		=> $parent,
			'echo'        	=> 0,
			);

		$children = wp_list_pages( $args );

		if ($children) { ?>
		<ul class="list-unstyled">
		<?php echo $children; ?>
		</ul>
		<?php } ?>
		</nav>
	<?php
}


/**
* BREADCRUMBS

*
**/

function edgeone_breadcrumb() {

	echo '<ul id="breadcrumbs">';
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
		echo '</a></li><li class="separator"> / </li>';
		if (is_category() || is_single()) {
			echo '<li>';
			the_category(' </li><li class="separator"> / </li><li> ');
			if (is_single()) {
				echo '</li><li class="separator"> / </li><li>';
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );

				foreach ( $anc as $ancestor ) {
					$output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
				}
				echo $output;
				echo '<strong title="'.$title.'"> '.$title.'</strong>';
			} else {
				echo '<strong> ';
				echo the_title();
				echo '</strong>';
			}
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
}


/**
* Short Post snippet

**
* Takes in array with attributes defaulting to:
* 	before_item
* 	after_item
* 	before_list
* 	after_before
*	'post_type' => "post",
*	'length' => 3,
*	'order' => 'ASC',
*	'item_class' => 'short-list-item'
*  @package edgeone
*/
function pr_short_list_posts($args){

	wp_reset_postdata();
	$defaults = array(
		'post_type' => "post",
		'length' => 3,
		'order' => 'DESC',
		'before_item' => '<li>',
 		'after_item' => '</li>',
 		'before_list' => '<ul>',
 		'after_before' => '</ul>',
 		'date_format' => 'j.m.Y',
 		'category_name' => "",
 		'posts_per_page' => 3
 	);
	// todo, mahollisuus listata myös pr_eventtejä nopsaa desc
	$args = wp_parse_args($args, $defaults);
	extract( $args, EXTR_SKIP );

	$queryargs = array(
		'post_type' => $post_type,
		'posts_per_page' => $length,
		'order' => $order,
		'category_name' => $category_name
	);
	//echo var_dump($queryargs);
	$event_query = new WP_Query( $queryargs );



	//loop
	if ( $event_query -> have_posts() ):

		if( isset( $before_list )) {
			echo $before_list;
		}

		while ( $event_query -> have_posts() ) :

			$event_query -> next_post();
			$curpost = $event_query -> post;

			if( isset( $before_item ) ) echo $before_item;
			printf('<a href="%1$s" title="%2$s"><time datetime="%4$s">%3$s</time>%2$s</a>',
				esc_attr( get_permalink( $curpost->ID ) ),
				esc_attr( $curpost->post_title ),
				mysql2date($date_format, $curpost->post_date ),
				esc_attr($curpost->post_date )
			);
			if( isset( $after_item )) echo $after_item;
		endwhile;

		if( isset( $after_list )){
			echo $after_list;
		}

	endif;

	//
	wp_reset_postdata();
}

/**
 Change post to News
*
**/

function edgeone_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = __('News', 'edgeone');
    $submenu['edit.php'][10][0] = __('Add News', 'edgeone');
    $submenu['edit.php'][16][0] = __('News Tags', 'edgeone');
    echo '';
}

function edgeone_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name		= 	__('News', 'edgeone');
    $labels->add_new 			= 	__('Add News', 'edgeone');
    $labels->add_new_item 		= 	__('Add News', 'edgeone');
    $labels->edit_item 			= 	__('Edit News', 'edgeone');
    $labels->new_item 			= 	__('News', 'edgeone');
    $labels->view_item 			= 	__('View News', 'edgeone');
    $labels->search_items 		= 	__('Search News', 'edgeone');
    $labels->not_found 			=	__('No News found', 'edgeone');
    $labels->not_found_in_trash = 	__('No News found in Trash', 'edgeone');
    $labels->all_items 			=	__('All News', 'edgeone');
    $labels->menu_name 			= 	__('News', 'edgeone');
    $labels->name_admin_bar 	= 	__('News', 'edgeone');
    $labels->all_items 			= 	__('All News', 'edgeone');
	$labels->menu_name 			= 	__('News', 'edgeone');
	$labels->name_admin_bar		= 	__('News', 'edgeone');
}

add_action( 'admin_menu', 'edgeone_change_post_label' );
add_action( 'init', 'edgeone_change_post_object' );


/**

* Edgeone featured image server for posts
*
*/

function edgeone_featured_img()
{
	if ( has_post_thumbnail()) :
	echo '<div class="featured-image">';

		if( edgeone_device('mobile') ) {
			$size = 'medium';
		} else {
			$size = 'large';
		}
		the_post_thumbnail( $size );

	echo '</div>';
	endif;
}




/**
**
**

*/

function pr_post_comments(){ ?>
	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'edgeone' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'edgeone' ) );

			if ( ! edgeone_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'edgeone' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php
}

/**
**
** Facebook script

*/


function edgeone_fb_script(){
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php
}



/**
**
** Facebook like box

*/

function edgeone_fb_likebox(){
 ?>
	<div class="fb-like-box"
			data-href="http://facebook.com/yokamerat"
			data-width="550px"
			data-colorscheme="light"
			data-show-faces="true"
			data-header="false"
			data-stream="true"
			data-show-border="false"></div>
 <?php

}

/**
**
	EDGEONE apple touch device links
**
*/
function edgeone_touch_icons(){

?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch-icon-ipad-retina.png">

<?php
}

add_action('wp_head', 'edgeone_touch_icons');


/**
**

**
**/

function edgeone_headmeta()
{
	?>

	<link rel="shortcut icon" href="<?php echo get_home_url('url'); ?>/favicon.ico" type="image/x-icon">
	<meta name="description" content="Oulun ylioppilaskamerat ry on valokuvauksen harrastajien kerho, tapahtumiin on tervetulleita ihan kaikki, muutkin kuin opiskelijat. Järjestämme valokuvauskursseja, kuvakilpailuita sekä kuvailtoja. Tervetuloa!">
	<meta name="keywords" content="valokvaus oulu photography valokuvauskurssi">

	<?php
	 /* open graph */
	if(is_home()) {
		//echo '<meta property="og:url" content="' . home_url() . '">';
	}
	?>
	<meta property="og:title" content="<?php if(is_home()) bloginfo('name'); else bloginfo('name'); wp_title('||'); ?>">
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png">


	<?
}

add_action('wp_head', 'edgeone_headmeta');


