<?

define('GOOGLE_ANALYTICS_ID', 'UA-30043118-1');


if ( ! function_exists( 'edgeone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.

 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function edgeone_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on edgeone, use a find and replace
   * to change 'edgeone' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'edgeone', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  set_post_thumbnail_size( 300, 300 );

  add_image_size( 'large_thumb', 500, 500 ); //300 pixels wide (and unlimited height)
  //add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
  add_image_size('round'. 400,400, true);


  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'edgeone' ),
    'footer' => __( 'Footer Menu', 'edgeone' )
  ) );

  // Enable support for Post Formats.
  //add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

  // Setup the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'edgeone_custom_background_args', array(
    'default-color' => 'F6F6F6',
    'default-image' => '',
  ) ) );



  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

}
endif; // edgeone_setup
add_action( 'after_setup_theme', 'edgeone_setup' );


/* Flush rewrite rules for custom post types. */
add_action( 'after_switch_theme', 'edgeone_flush_rewrite_rules' );

/* Flush your rewrite rules */
function edgeone_flush_rewrite_rules() {
     flush_rewrite_rules();
}

function edgeone_init() {
  // add excerpts to pages
  add_post_type_support( 'page', 'excerpt' );
  add_image_size( 'large_thumb', 500, 500 ); //300 pixels wide (and unlimited height)
  add_editor_style( get_template_directory_uri() . '/css/editor-styles.css' );

}
add_action( 'init', 'edgeone_init' );



/**

 * Register widgetized area and update sidebar with default widgets.
 */
function edgeone_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'News Sidebar', 'edgeone' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name' => __('Page Sidebar', 'edgeone'),
    'id' => 'page_right',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ) );

  register_sidebar( array(
    'name' => __('Events sidebar', 'edgeone'),
    'id' => 'events_sidebar',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );

  register_sidebar( array(
    'name' => __('Front page first half', 'edgeone'),
    'id' => 'index_1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
  register_sidebar( array(
    'name' => __('Front page second half', 'edgeone'),
    'id' => 'index_2',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}
add_action( 'widgets_init', 'edgeone_widgets_init' );



/**

 * Enqueue scripts and styles.
 */
function edgeone_scripts() {


  // Styles
  wp_enqueue_style( 'edgeone-style', get_stylesheet_uri() );
  //wp_enqueue_style( 'opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
  //wp_enqueue_style( 'montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:700,400' );

  wp_enqueue_style( 'edgeone-main', get_template_directory_uri() . '/assets/css/main.css' );




  wp_enqueue_script( 'edgeone-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), false , true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
//add_action( 'wp_enqueue_scripts', 'edgeone_scripts' );



?>
