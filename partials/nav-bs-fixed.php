<?php
/**
 * The template part for displaying bootsrap style menu.
 *
 * needs- wp_bootstrap_navwalker
 *
 * @package edgeone
 */
?>

<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
	<div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
           	<i class="fa fa-bars"></i>
          </button>

        </div>
        <nav class="navbar-collapse collapse" id="main-nav" role="navigation">
			<?php
	            wp_nav_menu( array(
	                'menu'              => 'primary',
	                'theme_location'    => 'primary',
	                'depth'             => 2,
	                'container'         => '',
	                'container_class'   => '',
	                'menu_class'        => 'nav navbar-nav',
	                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                'walker'            => new wp_bootstrap_navwalker()
	                )
	            );
	        ?>
		</nav>
	</div>
</header>